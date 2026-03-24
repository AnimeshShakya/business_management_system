<?php

namespace Modules\BusinessSettingsModule\Http\Controllers\Api\V1\Provider;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Modules\ProviderManagement\Entities\ProviderSetting;

class BusinessInformationController extends Controller
{
    private ProviderSetting $providerSetting;

    public function __construct(ProviderSetting $providerSetting)
    {
        $this->providerSetting = $providerSetting;
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return JsonResponse
     */
    public function businessSettingsGet(Request $request): JsonResponse
    {
        $request['key'] = ['provider_serviceman_can_cancel_booking', 'provider_serviceman_can_edit_booking'];

        $dataValues = $this->providerSetting
            ->select('key_name', 'live_values', 'test_values', 'mode')
            ->when(!is_null($request['key']), fn($query) => $query->whereIn('key_name', $request['key'])->where('provider_id', $request->user()->provider->id))
            ->get();

        $serviceLocation = $this->providerSetting->where(['key_name' => 'service_location', 'provider_id' => $request->user()->provider->id, 'settings_type' => 'provider_config'])->first();
        $serviceLocations = $serviceLocation ? json_decode($serviceLocation->live_values, true) : [];

        $data = [
            'provider_serviceman_config' => $dataValues,
            'service_location' =>$serviceLocations
        ];

        return response()->json(response_formatter(DEFAULT_200, $data), 200);
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function businessSettingsSet(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'data' => 'required',
            'data.*.key' => 'required|string',
            'data.*.value' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        $customerLocationData = collect(json_decode($request->data, true))->firstWhere('key', 'customer_location');
        $providerLocationData = collect(json_decode($request->data, true))->firstWhere('key', 'provider_location');

        $customerLocation = $customerLocationData['value'] ?? '0';
        $providerLocation = $providerLocationData['value'] ?? '0';

        // Prevent both customer_location and provider_location from being inactive
        if ($customerLocation == '0' && $providerLocation == '0') {
            $error = [[
                    "error_code" => "data",
                    "message" => translate('At least one service location must be active')
                ]];
            return response()->json(response_formatter(DEFAULT_400, null, $error), 400);
        }

        $serviceLocation = [];

        foreach (collect(json_decode($request['data'], true)) as $key => $item) {
            $key = $item['key'];
            $value = $item['value'];

            $settingType = in_array($item['key'], ['provider_serviceman_can_edit_booking', 'provider_serviceman_can_cancel_booking']) ? 'serviceman_config' : null;

            if (!is_null($settingType)) {
                $this->providerSetting->updateOrCreate(['key_name' => $item['key'], 'provider_id' => $request->user()->provider->id], [
                    'key_name' => $item['key'],
                    'live_values' => $item['value'],
                    'test_values' => $item['value'],
                    'settings_type' => $settingType,
                    'mode' => 'live',
                    'is_active' => 1,
                ]);
            }

            // Collect service location settings
            if ($key == 'customer_location' && $value == '1') {
                $serviceLocation[] = 'customer';
            }
            if ($key === 'provider_location' && $value == '1') {
                $serviceLocation[] = 'provider';
            }
        }

        $serviceAtProviderPlace = (int)((business_config('service_at_provider_place', 'provider_config'))->live_values ?? 0);

        if($serviceAtProviderPlace == 0){
            return response()->json(response_formatter(SERVICE_LOCATION_400), 200);
        }

        if (!empty($serviceLocation)) {
            $this->providerSetting->updateOrCreate(
                ['key_name' => 'service_location', 'provider_id' => $request->user()->provider->id, 'settings_type' => 'provider_config'],
                [
                    'key_name' => 'service_location',
                    'live_values' => json_encode($serviceLocation),
                    'test_values' => json_encode($serviceLocation),
                    'settings_type' => 'provider_config',
                    'mode' => 'live',
                    'is_active' => 1,
                ]
            );
        }

        return response()->json(response_formatter(DEFAULT_UPDATE_200), 200);
    }
}
