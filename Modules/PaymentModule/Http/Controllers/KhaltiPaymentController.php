<?php

namespace Modules\PaymentModule\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Modules\PaymentModule\Entities\PaymentRequest;
use Modules\PaymentModule\Traits\Processor;

class KhaltiPaymentController extends Controller
{
    use Processor;

    private mixed $configValues = null;
    private string $mode = 'test';

    public function __construct(private readonly PaymentRequest $payment)
    {
        $config = $this->payment_config('khalti', 'payment_config');

        if (!is_null($config)) {
            $this->mode = $config->mode === 'live' ? 'live' : 'test';
            $this->configValues = json_decode($this->mode === 'live' ? $config->live_values : $config->test_values);
        }
    }

    public function index(Request $request): RedirectResponse|JsonResponse|Application|Redirector
    {
        $validator = Validator::make($request->all(), [
            'payment_id' => 'required|uuid',
        ]);

        if ($validator->fails()) {
            return response()->json($this->response_formatter(GATEWAYS_DEFAULT_400, null, $this->error_processor($validator)), 400);
        }

        $paymentData = $this->payment::where(['id' => $request['payment_id']])->where(['is_paid' => 0])->first();
        if (!isset($paymentData)) {
            return response()->json($this->response_formatter(GATEWAYS_DEFAULT_204), 200);
        }

        $secretKey = $this->getConfigValue('secret_key', '');
        if (empty($secretKey)) {
            Log::warning('Khalti secret key is not configured.');
            return $this->handleFailure($paymentData);
        }

        $baseUrl = $this->mode === 'live' ? 'https://khalti.com/api/v2' : 'https://dev.khalti.com/api/v2';
        $websiteUrl = rtrim((string) $this->getConfigValue('website_url', config('app.url')), '/');

        $payload = [
            'return_url' => route('khalti.success', ['payment_id' => $paymentData->id]),
            'website_url' => $websiteUrl,
            'amount' => $this->formatAmountInPaisa($paymentData->payment_amount),
            'purchase_order_id' => (string) $paymentData->id,
            'purchase_order_name' => 'Demandium Booking Payment',
        ];

        $payerInfo = $paymentData->payer_information ? json_decode($paymentData->payer_information, true) : [];
        if (is_array($payerInfo) && !empty($payerInfo)) {
            $payload['customer_info'] = [
                'name' => $payerInfo['name'] ?? 'Customer',
                'email' => $payerInfo['email'] ?? null,
                'phone' => $payerInfo['phone'] ?? null,
            ];
        }

        try {
            $responseData = $this->postJson(
                url: $baseUrl . '/epayment/initiate/',
                payload: $payload,
                secretKey: $secretKey
            );

            if (empty($responseData) || !isset($responseData['payment_url'])) {
                Log::warning('Khalti initiate failed', [
                    'response' => $responseData,
                ]);
                return $this->handleFailure($paymentData);
            }

            $paymentUrl = $responseData['payment_url'] ?? null;
            if (empty($paymentUrl)) {
                Log::warning('Khalti initiate response missing payment_url', ['response' => $responseData]);
                return $this->handleFailure($paymentData);
            }

            return redirect($paymentUrl);
        } catch (\Throwable $exception) {
            Log::warning('Khalti initiate exception: ' . $exception->getMessage());
            return $this->handleFailure($paymentData);
        }
    }

    public function success(Request $request): JsonResponse|Redirector|RedirectResponse|Application
    {
        $validator = Validator::make($request->all(), [
            'payment_id' => 'required|uuid',
            'pidx' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($this->response_formatter(GATEWAYS_DEFAULT_400, null, $this->error_processor($validator)), 400);
        }

        $paymentData = $this->payment::where(['id' => $request['payment_id']])->first();
        if (!isset($paymentData)) {
            return response()->json($this->response_formatter(GATEWAYS_DEFAULT_204), 200);
        }

        if ((int) $paymentData->is_paid === 1) {
            return $this->payment_response($paymentData, 'success');
        }

        $secretKey = $this->getConfigValue('secret_key', '');
        if (empty($secretKey)) {
            Log::warning('Khalti secret key is not configured.');
            return $this->handleFailure($paymentData);
        }

        $pidx = (string) $request->input('pidx', '');
        if ($pidx === '') {
            return $this->handleFailure($paymentData);
        }

        $baseUrl = $this->mode === 'live' ? 'https://khalti.com/api/v2' : 'https://dev.khalti.com/api/v2';

        try {
            $lookup = $this->postJson(
                url: $baseUrl . '/epayment/lookup/',
                payload: ['pidx' => $pidx],
                secretKey: $secretKey
            );

            if (empty($lookup) || !isset($lookup['status'])) {
                Log::warning('Khalti lookup failed', [
                    'response' => $lookup,
                ]);
                return $this->handleFailure($paymentData);
            }

            $status = $lookup['status'] ?? null;
            $transactionId = $lookup['transaction_id'] ?? ($request->input('transaction_id') ?: $pidx);

            if ($status !== 'Completed') {
                return $this->handleFailure($paymentData);
            }

            $this->payment::where(['id' => $paymentData->id])->update([
                'payment_method' => 'khalti',
                'is_paid' => 1,
                'transaction_id' => $transactionId,
            ]);

            $updatedPayment = $this->payment::where(['id' => $paymentData->id])->first();
            if (isset($updatedPayment) && function_exists($updatedPayment->success_hook)) {
                call_user_func($updatedPayment->success_hook, $updatedPayment);
            }

            return $this->payment_response($updatedPayment, 'success');
        } catch (\Throwable $exception) {
            Log::warning('Khalti lookup exception: ' . $exception->getMessage());
            return $this->handleFailure($paymentData);
        }
    }

    public function failure(Request $request): JsonResponse|Redirector|RedirectResponse|Application
    {
        $validator = Validator::make($request->all(), [
            'payment_id' => 'required|uuid',
        ]);

        if ($validator->fails()) {
            return response()->json($this->response_formatter(GATEWAYS_DEFAULT_400, null, $this->error_processor($validator)), 400);
        }

        $paymentData = $this->payment::where(['id' => $request['payment_id']])->first();
        if (!isset($paymentData)) {
            return response()->json($this->response_formatter(GATEWAYS_DEFAULT_204), 200);
        }

        return $this->handleFailure($paymentData);
    }

    private function handleFailure(PaymentRequest $paymentData): JsonResponse|Redirector|RedirectResponse|Application
    {
        if (isset($paymentData) && function_exists($paymentData->failure_hook)) {
            call_user_func($paymentData->failure_hook, $paymentData);
        }

        return $this->payment_response($paymentData, 'fail');
    }

    private function getConfigValue(string $key, mixed $default = null): mixed
    {
        return $this->configValues->$key ?? $default;
    }

    private function formatAmountInPaisa(float|int|string $amount): int
    {
        return (int) round(((float) $amount) * 100);
    }

    private function postJson(string $url, array $payload, string $secretKey): array
    {
        $context = stream_context_create([
            'http' => [
                'method' => 'POST',
                'header' => "Authorization: Key {$secretKey}\r\nContent-Type: application/json\r\n",
                'content' => json_encode($payload),
                'ignore_errors' => true,
                'timeout' => 30,
            ],
        ]);

        $response = @file_get_contents($url, false, $context);
        if ($response === false) {
            return [];
        }

        $decoded = json_decode($response, true);
        return is_array($decoded) ? $decoded : [];
    }
}
