<?php

namespace Modules\PaymentModule\Http\Controllers\Api\V1\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Modules\BusinessSettingsModule\Entities\BusinessSettings;

class PaymentConfigController extends Controller
{
    private BusinessSettings $business_setting;

    public function __construct(BusinessSettings $business_setting)
    {
        $this->business_setting = $business_setting;
    }

    /**
     * Display a listing of the resource.
     * @return JsonResponse
     */
    public function payment_config_get(): JsonResponse
    {
        $data_values = $this->business_setting->whereIn('settings_type', ['payment_config'])->get();
        return response()->json(response_formatter(DEFAULT_200, $data_values), 200);
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function payment_config_set(Request $request): JsonResponse
    {
        $validation = [
            'gateway' => 'required|in:esewa,khalti,nepal_pay',
            'mode' => 'required|in:live,test'
        ];
        $additional_data = [];

        if ($request['gateway'] == 'esewa') {
            $additional_data = [
                'status' => 'required|in:1,0',
                'product_code' => 'required',
                'secret_key' => 'required',
            ];
        } elseif ($request['gateway'] == 'khalti') {
            $additional_data = [
                'status' => 'required|in:1,0',
                'secret_key' => 'required',
                'website_url' => 'nullable|url',
            ];
        } elseif ($request['gateway'] == 'nepal_pay') {
            $additional_data = [
                'status' => 'required|in:1,0',
                'redirect_url' => 'required|url',
            ];
        }
        $validator = Validator::make($request->all(), array_merge($validation, $additional_data));

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        $this->business_setting->updateOrCreate(['key_name' => $request['gateway'], 'settings_type' => 'payment_config'], [
            'key_name' => $request['gateway'],
            'live_values' => $validator->validated(),
            'test_values' => $validator->validated(),
            'settings_type' => 'payment_config',
            'mode' => $request['mode'],
            'is_active' => $request['status'],
        ]);

        return response()->json(response_formatter(DEFAULT_UPDATE_200), 200);
    }
}
