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

class NepalPayPaymentController extends Controller
{
    use Processor;

    private mixed $configValues = null;

    public function __construct(private readonly PaymentRequest $payment)
    {
        $config = $this->payment_config('nepal_pay', 'payment_config');
        if (!is_null($config)) {
            $mode = $config->mode === 'live' ? 'live' : 'test';
            $this->configValues = json_decode($mode === 'live' ? $config->live_values : $config->test_values);
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

        $redirectTemplate = trim((string) $this->getConfigValue('redirect_url', ''));
        if ($redirectTemplate === '') {
            Log::warning('NepalPay redirect_url is not configured.');
            return $this->handleFailure($paymentData);
        }

        $redirectUrl = $this->buildRedirectUrl($redirectTemplate, $paymentData);
        return redirect($redirectUrl);
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

        $transactionId = (string) ($request->input('transaction_id')
            ?? $request->input('txn_id')
            ?? $request->input('reference_id')
            ?? $request->input('ref_id')
            ?? $paymentData->id);

        $this->payment::where(['id' => $paymentData->id])->update([
            'payment_method' => 'nepal_pay',
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

    private function getConfigValue(string $key, mixed $default = null): mixed
    {
        return $this->configValues->$key ?? $default;
    }

    private function buildRedirectUrl(string $template, PaymentRequest $paymentData): string
    {
        $successUrl = route('nepal-pay.success', ['payment_id' => $paymentData->id]);
        $failureUrl = route('nepal-pay.failure', ['payment_id' => $paymentData->id]);

        $replacements = [
            '{payment_id}' => (string) $paymentData->id,
            '{amount}' => (string) $paymentData->payment_amount,
            '{success_url}' => urlencode($successUrl),
            '{failure_url}' => urlencode($failureUrl),
            '{currency}' => (string) $paymentData->currency_code,
        ];

        return strtr($template, $replacements);
    }
}
