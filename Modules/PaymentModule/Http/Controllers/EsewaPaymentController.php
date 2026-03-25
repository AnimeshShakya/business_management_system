<?php

namespace Modules\PaymentModule\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Modules\PaymentModule\Entities\PaymentRequest;
use Modules\PaymentModule\Traits\Processor;

class EsewaPaymentController extends Controller
{
    use Processor;

    private mixed $configValues = null;
    private string $mode = 'test';

    public function __construct(private readonly PaymentRequest $payment)
    {
        $config = $this->payment_config('esewa', 'payment_config');

        if (!is_null($config)) {
            $this->mode = $config->mode === 'live' ? 'live' : 'test';
            $this->configValues = json_decode($this->mode === 'live' ? $config->live_values : $config->test_values);
        }
    }

    public function index(Request $request): View|Factory|JsonResponse|Application
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

        $productCode = $this->getConfigValue('product_code', $this->getConfigValue('merchantCode', 'EPAYTEST'));
        $secretKey = $this->getConfigValue('secret_key', '8gBm/:&EnhH.1/q');

        $totalAmount = $this->formatAmount($paymentData->payment_amount);
        $transactionUuid = $paymentData->id;
        $signedFieldNames = 'total_amount,transaction_uuid,product_code';

        $signature = $this->generateSignature(
            signedFieldNames: $signedFieldNames,
            payload: [
                'total_amount' => $totalAmount,
                'transaction_uuid' => $transactionUuid,
                'product_code' => $productCode,
            ],
            secretKey: $secretKey,
        );

        $formData = [
            'amount' => $totalAmount,
            'tax_amount' => '0',
            'product_service_charge' => '0',
            'product_delivery_charge' => '0',
            'total_amount' => $totalAmount,
            'transaction_uuid' => $transactionUuid,
            'product_code' => $productCode,
            'success_url' => route('esewa.success', ['payment_id' => $paymentData->id]),
            'failure_url' => route('esewa.failure', ['payment_id' => $paymentData->id]),
            'signed_field_names' => $signedFieldNames,
            'signature' => $signature,
        ];

        $formAction = $this->mode === 'live'
            ? 'https://epay.esewa.com.np/api/epay/main/v2/form'
            : 'https://rc-epay.esewa.com.np/api/epay/main/v2/form';

        return view('paymentmodule::esewa', compact('paymentData', 'formData', 'formAction'));
    }

    public function success(Request $request): JsonResponse|Redirector|RedirectResponse|Application
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

        if ((int) $paymentData->is_paid === 1) {
            return $this->payment_response($paymentData, 'success');
        }

        $responseData = $this->decodeEsewaResponseData($request->input('data'));
        if (!empty($responseData) && !$this->verifyResponseSignature($responseData)) {
            return $this->handleFailure($paymentData);
        }

        $productCode = $this->getConfigValue('product_code', $this->getConfigValue('merchantCode', 'EPAYTEST'));
        $transactionUuid = $responseData['transaction_uuid'] ?? $paymentData->id;
        $totalAmount = $responseData['total_amount'] ?? $this->formatAmount($paymentData->payment_amount);

        $statusData = $this->checkTransactionStatus($productCode, $totalAmount, $transactionUuid);
        $isComplete = ($statusData['status'] ?? null) === 'COMPLETE'
            || (($responseData['status'] ?? null) === 'COMPLETE');

        if (!$isComplete) {
            return $this->handleFailure($paymentData);
        }

        $transactionId = $statusData['ref_id']
            ?? ($responseData['transaction_code'] ?? $transactionUuid);

        $this->payment::where(['id' => $paymentData->id])->update([
            'payment_method' => 'esewa',
            'is_paid' => 1,
            'transaction_id' => $transactionId,
        ]);

        $updatedPayment = $this->payment::where(['id' => $paymentData->id])->first();
        if (isset($updatedPayment) && function_exists($updatedPayment->success_hook)) {
            call_user_func($updatedPayment->success_hook, $updatedPayment);
        }

        return $this->payment_response($updatedPayment, 'success');
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

    private function decodeEsewaResponseData(?string $encodedData): array
    {
        if (empty($encodedData)) {
            return [];
        }

        $decoded = base64_decode($encodedData, true);
        if ($decoded === false) {
            return [];
        }

        $data = json_decode($decoded, true);
        return is_array($data) ? $data : [];
    }

    private function verifyResponseSignature(array $responseData): bool
    {
        $signature = $responseData['signature'] ?? null;
        $signedFieldNames = $responseData['signed_field_names'] ?? null;

        if (empty($signature) || empty($signedFieldNames)) {
            return false;
        }

        $secretKey = $this->getConfigValue('secret_key', '8gBm/:&EnhH.1/q');
        $generatedSignature = $this->generateSignature($signedFieldNames, $responseData, $secretKey);

        return hash_equals($signature, $generatedSignature);
    }

    private function generateSignature(string $signedFieldNames, array $payload, string $secretKey): string
    {
        $keys = array_map('trim', explode(',', $signedFieldNames));
        $parts = [];

        foreach ($keys as $key) {
            $parts[] = $key . '=' . ($payload[$key] ?? '');
        }

        $message = implode(',', $parts);
        return base64_encode(hash_hmac('sha256', $message, $secretKey, true));
    }

    private function checkTransactionStatus(string $productCode, string $totalAmount, string $transactionUuid): array
    {
        $statusUrl = $this->mode === 'live'
            ? 'https://esewa.com.np/api/epay/transaction/status/'
            : 'https://rc.esewa.com.np/api/epay/transaction/status/';

        $query = http_build_query([
            'product_code' => $productCode,
            'total_amount' => $totalAmount,
            'transaction_uuid' => $transactionUuid,
        ]);

        try {
            $responseBody = @file_get_contents($statusUrl . '?' . $query);
            if ($responseBody !== false) {
                $decoded = json_decode($responseBody, true);
                if (is_array($decoded)) {
                    return $decoded;
                }
            }
        } catch (\Throwable $exception) {
            Log::warning('eSewa status check failed: ' . $exception->getMessage());
        }

        return [];
    }

    private function getConfigValue(string $key, mixed $default = null): mixed
    {
        return $this->configValues->$key ?? $default;
    }

    private function formatAmount(float|int|string $amount): string
    {
        return number_format((float) $amount, 2, '.', '');
    }
}
