<?php

namespace Modules\BusinessSettingsModule\Http\Controllers\Web\Admin;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Modules\AI\app\Models\AISetting;
use Modules\BusinessSettingsModule\Emails\TestMailSender;
use Modules\BusinessSettingsModule\Entities\BusinessSettings;
use Modules\BusinessSettingsModule\Entities\NotificationSetup;
use Modules\BusinessSettingsModule\Entities\Translation;
use Modules\BusinessSettingsModule\Http\Requests\ThirdPartyDataStoreOrUpdateRequest;
use Modules\PaymentModule\Entities\OfflinePayment;
use Modules\PaymentModule\Entities\Setting;
use \Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Config;


class ConfigurationController extends Controller
{

    private BusinessSettings $businessSetting;

    private Setting $addonSetting;
    private NotificationSetup $notificationSetup;

    use AuthorizesRequests;

    public function __construct(BusinessSettings $businessSetting, Setting $addonSetting, NotificationSetup $notificationSetup)
    {
        $this->businessSetting = $businessSetting;
        $this->addonSetting = $addonSetting;
        $this->notificationSetup = $notificationSetup;
    }

    /**
     * Display a listing of the resource.
     */
    public function notificationSettingsGet(Request $request): Factory|View|Application
    {
        $this->authorize('notification_message_view');
        $queryParams = $request->type;
        $dataSettingsValue = $this->businessSetting->whereIn('settings_type', ['notification_settings'])->get();
        $dataValues = $this->businessSetting->whereIn('settings_type', ['customer_notification', 'provider_notification', 'serviceman_notification'])->with('translations')->get();
        return view('businesssettingsmodule::admin.notification', compact('dataValues', 'queryParams', 'dataSettingsValue'));
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException|AuthorizationException
     */
    public function notificationSettingsSet(Request $request): JsonResponse
    {
        $this->authorize('configuration_update');
        $request[$request['key']] = $request['value'];

        $validator = Validator::make($request->all(), [
            'push_notification_booking' => 'in:0,1',
            'email_booking' => 'in:0,1',
            'push_notification_subscription' => 'in:0,1',
            'email_subscription' => 'in:0,1',
            'push_notification_rating_review' => 'in:0,1',
            'email_rating_review' => 'in:0,1',
            'push_notification_tnc_update' => 'in:0,1',
            'email_tnc_update' => 'in:0,1',
            'push_notification_pp_update' => 'in:0,1',
            'email_pp_update' => 'in:0,1'
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        $keys = ['booking', 'subscription', 'rating_review', 'tnc_update', 'pp_update'];
        foreach ($keys as $key => $value) {
            $request['email_' . $value] = 0;
            if ($request->has('push_notification_' . $value) && $request->has('email_' . $value)) {
                $this->businessSetting->updateOrCreate(['key_name' => $value, 'settings_type' => 'notification_settings'], [
                    'key_name' => $value,
                    'live_values' => [
                        'push_notification_' . $value => $request['push_notification_' . $value],
                        'email_' . $value => $request['email_' . $value],
                    ],
                    'test_values' => [
                        'push_notification_' . $value => $request['push_notification_' . $value],
                        'email_' . $value => $request['email_' . $value],
                    ],
                    'settings_type' => 'notification_settings',
                    'mode' => 'live',
                    'is_active' => 1,
                ]);
            }
        }

        return response()->json(response_formatter(DEFAULT_UPDATE_200), 200);
    }

    public function messageSettingsSet(Request $request): RedirectResponse
    {
        $this->authorize('notification_message_update');

        collect(['status'])->each(fn($item, $key) => $request[$item] = $request->has($item) ? (int)$request[$item] : 0);

        if ($request->type === 'customers') {
            $notificationArray = NOTIFICATION_FOR_USER;
            $settingsType = 'customer_notification';
        } elseif ($request->type === 'providers') {
            $notificationArray = NOTIFICATION_FOR_PROVIDER;
            $settingsType = 'provider_notification';
        } elseif ($request->type === 'serviceman') {
            $notificationArray = NOTIFICATION_FOR_SERVICEMAN;
            $settingsType = 'serviceman_notification';
        } else {
            $notificationArray = [];
            $settingsType = '';
        }

        if ($request->has('change_type') && $request->change_type == 'status'){
            $existingData = $this->businessSetting->where('key_name', $request->id)->first();

            // Check if `live_values` exists and is an array or JSON string
            if ($existingData && is_string($existingData->live_values)) {
                $existingLiveValues = json_decode($existingData->live_values, true);
            } elseif ($existingData && is_array($existingData->live_values)) {
                $existingLiveValues = $existingData->live_values;
            } else {
                $existingLiveValues = [];
            }

            // Update only the status field, keeping the rest of the data unchanged
            $updatedLiveValues = array_merge($existingLiveValues, [
                $request->id . '_status' => $request['status'],
            ]);

            $this->businessSetting->updateOrCreate(
                ['key_name' => $request->id, 'settings_type' => $settingsType],
                [
                    'key_name' => $request->id,
                    'live_values' => $updatedLiveValues,
                    'test_values' => $updatedLiveValues,
                    'is_active' => $request['status'],
                ]
            );

            Toastr::success(translate(DEFAULT_UPDATE_200['message']));
            return back();
        }


        $columnName = $request->id . '_message';
        $requiredMessage = $columnName . '.0.' . 'required';
        $requiredMessageValue = "default_{$columnName}_is_required";

        $request->validate([
            'type' => 'required|in:customers,providers,serviceman',
            $columnName . '.0' => 'required'
        ],
            [
                $requiredMessage => translate($requiredMessageValue),
            ]
        );


        $request->validate([
            'id' => 'required|in:' . implode(',', array_column($notificationArray, 'key')),
            "$columnName.0" => 'required'
        ]);

        $businessData = $this->businessSetting->updateOrCreate(['key_name' => $request->id, 'settings_type' => $settingsType], [
            'key_name' => $request->id,
            'live_values' => [
                $request->id . '_status' => $request['status'],
                $request->id . '_message' => $request[$columnName][array_search('default', $request->lang)],
            ],
            'test_values' => [
                $request->id . '_status' => $request['status'],
                $request->id . '_message' => $request[$columnName][array_search('default', $request->lang)],
            ],
            'is_active' => $request['status'],
        ]);

        $defaultLanguage = str_replace('_', '-', app()->getLocale());

        foreach ($request->lang as $index => $key) {
            if ($defaultLanguage == $key && !($request[$columnName][$index])) {
                if ($key != 'default') {
                    Translation::updateOrInsert(
                        [
                            'translationable_type' => 'Modules\BusinessSettingsModule\Entities\BusinessSettings',
                            'translationable_id' => $businessData->id,
                            'locale' => $key,
                            'key' => $businessData->key_name],
                        ['value' => $businessData[$columnName]]
                    );
                }
            } else {
                if ($request[$columnName][$index] && $key != 'default') {
                    Translation::updateOrInsert(
                        [
                            'translationable_type' => 'Modules\BusinessSettingsModule\Entities\BusinessSettings',
                            'translationable_id' => $businessData->id,
                            'locale' => $key,
                            'key' => $businessData->key_name],
                        ['value' => $request[$columnName][$index]]
                    );
                }
            }
        }

        Toastr::success(translate(DEFAULT_UPDATE_200['message']));
        return back();
    }


    /**
     * Display a listing of the resource.
     * @return Application|Factory|View
     */
    public function emailConfigGet(): View|Factory|Application
    {
        $dataValues = $this->businessSetting->whereIn('settings_type', ['email_config'])->get();
        return view('businesssettingsmodule::admin.email-config', compact('dataValues'));
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function emailConfigSet(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'mailer_name' => 'required',
            'host' => 'required',
            'driver' => 'required',
            'port' => 'required',
            'user_name' => 'required',
            'email_id' => 'required',
            'encryption' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 200);
        }

        $this->businessSetting->updateOrCreate(['key_name' => 'email_config'], [
            'key_name' => 'email_config',
            'live_values' => $validator->validated(),
            'test_values' => $validator->validated(),
            'settings_type' => 'email_config',
            'mode' => 'live',
            'is_active' => 1,
        ]);

        return response()->json(response_formatter(DEFAULT_UPDATE_200), 200);
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Application|Factory|View
     * @throws ValidationException|AuthorizationException
     */
    public function thirdPartyConfigGet(Request $request): View|Factory|Application
    {
        $this->authorize('configuration_view');
        $request->validate([
            'web_page' => 'required|in:google_map,recaptcha,push_notification,firebase_otp_verification,apple_login,email_config,sms_config,payment_config,app_settings,social_login,test_mail,storage_connection'
        ]);

        $webPage = $request['web_page'];
        $publishedStatus = 0;
        $paymentUrl = '';
        $type = '';
        $customerDataValues = [];
        $providerDataValues = [];
        $servicemanDataValues = [];
        $socialLoginConfigs = [];
        $dataValues = [];

        if ($webPage == 'sms_config') {

            try {
                $full_data = include('Modules/Gateways/Addon/info.php');
                $publishedStatus = $full_data['is_published'] == 1 ? 1 : 0;
            } catch (\Exception $exception) {
            }

            $routes = config('addon_admin_routes');
            $desiredName = 'sms_setup';
            $paymentUrl = '';

            foreach ($routes as $routeArray) {
                foreach ($routeArray as $route) {
                    if ($route['name'] === $desiredName) {
                        $paymentUrl = $route['url'];
                        break 2;
                    }
                }
            }
            $dataValues = $this->addonSetting
                ->whereIn('settings_type', ['sms_config'])
                ->whereIn('key_name', array_column(SMS_GATEWAY, 'key'))
                ->get();
        } elseif ($webPage == 'payment_config') {

            Validator::make($request->all(), [
                'type' => 'in:digital_payment,offline_payment'
            ])->validate();

            try {
                $full_data = include('Modules/Gateways/Addon/info.php');
                $publishedStatus = $full_data['is_published'] == 1 ? 1 : 0;
            } catch (\Exception $exception) {
            }

            $routes = config('addon_admin_routes');
            $desiredName = 'payment_setup';
            $paymentUrl = '';

            foreach ($routes as $routeArray) {
                foreach ($routeArray as $route) {
                    if ($route['name'] === $desiredName) {
                        $paymentUrl = $route['url'];
                        break 2;
                    }
                }
            }

            $dataValues = $this->addonSetting
                ->whereIn('settings_type', ['payment_config'])
                ->whereIn('key_name', array_merge(array_column(PAYMENT_METHODS, 'key'), ['ssl_commerz']))
                ->get();

            $type = $request->type;
        } else if ($webPage == 'app_settings') {
            $values = $this->businessSetting->whereIn('key_name', ['customer_app_settings'])->first();
            $customerDataValues = isset($values) ? json_decode($values->live_values) : null;

            $values = $this->businessSetting->whereIn('key_name', ['provider_app_settings'])->first();
            $providerDataValues = isset($values) ? json_decode($values->live_values) : null;

            $values = $this->businessSetting->whereIn('key_name', ['serviceman_app_settings'])->first();
            $servicemanDataValues = isset($values) ? json_decode($values->live_values) : null;
        } else if ($webPage == 'social_login') {
            $values = $this->businessSetting->whereIn('key_name', ['customer_app_settings'])->first();
            $customerDataValues = isset($values) ? json_decode($values->live_values) : null;

            $values = $this->businessSetting->whereIn('key_name', ['provider_app_settings'])->first();
            $providerDataValues = isset($values) ? json_decode($values->live_values) : null;

            $values = $this->businessSetting->whereIn('key_name', ['serviceman_app_settings'])->first();
            $servicemanDataValues = isset($values) ? json_decode($values->live_values) : null;
            $socialLoginConfigs = $this->businessSetting->where('settings_type', 'social_login')->get();
        } else {
            $dataValues = $this->businessSetting->where('key_name', $webPage)->first();
        }

        return view('businesssettingsmodule::admin.third-party', compact('dataValues', 'webPage', 'publishedStatus', 'paymentUrl', 'type', 'customerDataValues', 'providerDataValues', 'servicemanDataValues', 'socialLoginConfigs'));
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException|AuthorizationException
     */
    public function thirdPartyConfigSet(Request $request): JsonResponse
    {
        $this->authorize('configuration_update');
        $validation = [
            'party_name' => 'required|in:google_map,push_notification,recaptcha,apple_login,firebase_otp_verification',
            'status' => 'in:0,1'
        ];

        $additionalData = [];
        if ($request['party_name'] == 'google_map') {
            $additionalData = [
                'map_api_key_client' => 'required',
                'map_api_key_server' => 'required'
            ];
        } elseif ($request['party_name'] == 'recaptcha') {
            $additionalData = [
                'status' => 'sometimes',
                'site_key' => 'required',
                'secret_key' => 'required'
            ];
        } elseif ($request['party_name'] == 'apple_login') {
            $additionalData = [
                'status' => 'sometimes',
                'client_id' => 'required',
                'team_id' => 'required',
                'key_id' => 'required',
                'service_file' => 'nullable',
            ];
        } elseif ($request['party_name'] == 'firebase_otp_verification') {
            $additionalData = [
                'status' => 'sometimes',
                'web_api_key' => 'required',
            ];
        }
        $validator = Validator::make($request->all(), array_merge($validation, $additionalData));

        if ($validator->fails()) {
            throw new HttpResponseException(response()->json(response_formatter(DEFAULT_400, null, error_processor($validator))));
        }

        if ($request['party_name'] == 'push_notification'){
            if ($request->has('service_file')){
                $fileContent = file_get_contents($request->file('service_file')->path());
                $liveValues = [
                    'server_key' => $request['server_key'],
                    'service_file_content' => $fileContent
                ];
            }else{
                $liveValues = [
                    'server_key' => $request['server_key'],
                    'service_file_content' => $request['service_file_content']
                ];
            }
        }elseif($request['party_name'] == 'apple_login'){
            $apple_login = (business_config('apple_login', 'third_party'))->live_values;

            if ($request->hasfile('service_file')) {
                $fileName = file_uploader('apple-login/', 'p8', $request->file('service_file'));
                $liveValues = $validator->validated();
                $liveValues['service_file'] = $fileName;
            } else {
                $liveValues = $validator->validated();
                $liveValues['service_file'] = $apple_login['service_file'];
            }
        }else{
            $liveValues = $validator->validated();
        }
        if (array_key_exists('status', $liveValues))
        {
            $liveValues['status'] =  1;
        }
        if (!array_key_exists('status', $liveValues) && ($request['party_name'] == 'firebase_otp_verification' || $request['party_name'] == 'recaptcha' || $request['party_name'] == 'apple_login'))
        {
            $liveValues['status'] = 0;
        }
        $this->businessSetting->updateOrCreate(['key_name' => $request['party_name'], 'settings_type' => 'third_party'], [
            'key_name' => $request['party_name'],
            'live_values' => $liveValues,
            'test_values' => $liveValues,
            'settings_type' => 'third_party',
            'mode' => 'live',
            'is_active' => isset($liveValues['status'])
                ? (int) $liveValues['status']
                : ($request->has('status') ? 1 : 0),
        ]);

        if ($request['party_name'] == 'push_notification' && $request->filled('service_file_content')){
            $liveValues = [
                'apiKey'=> $request['apiKey'],
                'authDomain'=> $request['authDomain'],
                'projectId'=> $request['projectId'],
                'storageBucket'=> $request['storageBucket'],
                'messagingSenderId'=> $request['messagingSenderId'],
                'appId'=> $request['appId'],
                'measurementId'=> $request['measurementId']
            ];

            $this->businessSetting->updateOrCreate(['key_name' => 'firebase_message_config', 'settings_type' => 'third_party'], [
                'key_name' => 'firebase_message_config',
                'live_values' => $liveValues,
                'test_values' => $liveValues,
                'settings_type' => 'third_party',
                'mode' => 'live',
                'is_active' => $request->status ?? 0,
            ]);

            self::firebaseMessageConfigFileGen();
        }

        if ($request['party_name'] == 'firebase_otp_verification'){
            if ($request->status == 1) {
                foreach (['twilio', 'nexmo', '2factor', 'msg91', 'signal_wire'] as $gateway) {
                    $keep = Setting::where(['key_name' => $gateway, 'settings_type' => 'sms_config'])->first();
                    if (isset($keep)) {
                        $hold = $keep->live_values;
                        $hold['status'] = 0;
                        Setting::where(['key_name' => $gateway, 'settings_type' => 'sms_config'])->update([
                            'live_values' => $hold,
                            'test_values' => $hold,
                            'is_active' => 0,
                        ]);
                    }
                }
            }
        }

        return response()->json(response_formatter(constant: DEFAULT_UPDATE_200, content: $request->has('service_file') ? $fileContent ?? null : null), 200);
    }

    function firebaseMessageConfigFileGen(): void
    {
        $config = business_config('firebase_message_config', 'third_party')?->live_values;
        $apiKey = $config['apiKey'] ?? '';
        $authDomain = $config['authDomain'] ?? '';
        $projectId = $config['projectId'] ?? '';
        $storageBucket = $config['storageBucket'] ?? '';
        $messagingSenderId = $config['messagingSenderId'] ?? '';
        $appId = $config['appId'] ?? '';
        $measurementId = $config['measurementId'] ?? '';
        $filePath = base_path('firebase-messaging-sw.js');
        try {
            if (file_exists($filePath) && !is_writable($filePath)) {
                if (!chmod($filePath, 0644)) {
                    throw new \Exception('File is not writable and permission change failed: ' . $filePath);
                }
            }
            $fileContent = <<<JS
                importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
                importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');
                firebase.initializeApp({
                    apiKey: "$apiKey",
                    authDomain: "$authDomain",
                    projectId: "$projectId",
                    storageBucket: "$storageBucket",
                    messagingSenderId: "$messagingSenderId",
                    appId: "$appId",
                    measurementId: "$measurementId"
                });
                const messaging = firebase.messaging();
                messaging.setBackgroundMessageHandler(function (payload) {
                    return self.registration.showNotification(payload.data.title, {
                        body: payload.data.body ? payload.data.body : '',
                        icon: payload.data.icon ? payload.data.icon : ''
                    });
                });
                JS;
            if (file_put_contents($filePath, $fileContent) === false) {
                throw new \Exception('Failed to write to file: ' . $filePath);
            }
        } catch (\Exception $e) {
        }
    }

    /**
     * Display a listing of the resource.
     * @return Application|Factory|View
     */
    public function appSettingsConfigGet(): View|Factory|Application
    {
        $values = $this->businessSetting->whereIn('key_name', ['customer_app_settings'])->first();
        $customerDataValues = isset($values) ? json_decode($values->live_values) : null;

        $values = $this->businessSetting->whereIn('key_name', ['provider_app_settings'])->first();
        $providerDataValues = isset($values) ? json_decode($values->live_values) : null;

        $values = $this->businessSetting->whereIn('key_name', ['serviceman_app_settings'])->first();
        $servicemanDataValues = isset($values) ? json_decode($values->live_values) : null;


        $socialLoginConfigs = $this->businessSetting->where('settings_type', 'social_login')->get();

        return view('businesssettingsmodule::admin.app-settings', compact('customerDataValues', 'providerDataValues', 'servicemanDataValues', 'socialLoginConfigs'));
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function appSettingsConfigSet(Request $request): RedirectResponse
    {
        $this->authorize('configuration_update');
        $request->validate([
            'min_version_for_android' => 'required',
            'min_version_for_ios' => 'required',
            'download_link_for_android' => 'nullable|url',
            'download_link_for_ios' => 'nullable|url',
            'app_type' => 'in:customer,provider,serviceman'
        ]);

        match ($request['app_type'])
        {
            'customer' => $keyName = 'customer_app_settings',
            'provider' => $keyName = 'provider_app_settings',
            'serviceman' => $keyName = 'serviceman_app_settings',
        };

        $this->businessSetting->updateOrCreate(['key_name' => $keyName, 'settings_type' => 'app_settings'], [
            'key_name' => $keyName,
            'live_values' => json_encode([
                'min_version_for_android' => $request['min_version_for_android'],
                'min_version_for_ios' => $request['min_version_for_ios'],
                'download_link_for_android' => $request['download_link_for_android'] ?? '',
                'download_link_for_ios' => $request['download_link_for_ios'] ?? '',

            ]),
            'test_values' => json_encode([
                'min_version_for_android' => $request['min_version_for_android'],
                'min_version_for_ios' => $request['min_version_for_ios'],
                'download_link_for_android' => $request['download_link_for_android'] ?? '',
                'download_link_for_ios' => $request['download_link_for_ios'] ?? '',
            ]),
            'settings_type' => 'app_settings',
            'mode' => 'live',
            'is_active' => 1,
        ]);

        Toastr::success(translate(DEFAULT_UPDATE_200['message']));
        return back();
    }

    public function changeStorageConnectionType(Request $request)
    {
        $this->authorize('configuration_update');

        $request->validate([
            'storage_connection_type' => 'in:local,s3',
        ]);

        $this->businessSetting->updateOrCreate(['key_name' => 'storage_connection_type', 'settings_type' => 'storage_settings'], [
            'key_name' => 'storage_connection_type',
            'live_values' => $request['storage_connection_type'],
            'test_values' => $request['storage_connection_type'],
            'settings_type' => 'storage_settings',
            'mode' => 'live',
            'is_active' => 1,
        ]);

        return response()->json(response_formatter(DEFAULT_UPDATE_200), 200);

    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function updateStorageConnectionSettings(Request $request): RedirectResponse
    {
        $this->authorize('configuration_update');
        $request->validate([
            'key' => 'required',
            'secret' => 'required',
            'region' => 'required',
            'bucket' => 'required',
            'url' => 'required',
            'endpoint' => 'required',
        ]);

        $this->businessSetting->updateOrCreate(['key_name' => 's3_storage_credentials', 'settings_type' => 'storage_settings'], [
            'key_name' => 's3_storage_credentials',
            'live_values' => json_encode([
                'key' => $request['key'],
                'secret' => $request['secret'],
                'region' => $request['region'],
                'bucket' => $request['bucket'],
                'url' => $request['url'],
                'endpoint' => $request['endpoint'],
                'path' => $request['path'],
            ]),
            'test_values' => json_encode([
                'key' => $request['key'],
                'secret_credential' => $request['secret_credential'],
                'region' => $request['region'],
                'bucket' => $request['bucket'],
                'url' => $request['url'],
                'endpoint' => $request['endpoint'],
                'path' => $request['path'],
            ]),
            'settings_type' => 'storage_settings',
            'mode' => 'live',
            'is_active' => 1,
        ]);

        Toastr::success(translate(DEFAULT_UPDATE_200['message']));
        return back();
    }

    /**
     * Update resource.
     * @param Request $request
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function setSocialLoginConfig(Request $request): JsonResponse
    {
        $this->authorize('configuration_update');
        $this->businessSetting->updateOrCreate(['key_name' => $request['key'], 'settings_type' => 'social_login'], [
            'key_name' => $request['key'],
            'live_values' => $request['value'],
            'test_values' => $request['value'],
            'settings_type' => 'social_login',
            'mode' => 'live',
            'is_active' => 1,
        ]);

        return response()->json(response_formatter(DEFAULT_UPDATE_200), 200);
    }

    public function emailStatusUpdate(Request $request)
    {
        $this->authorize('configuration_update');

        $this->businessSetting->updateOrCreate(['key_name' => 'email_config_status', 'settings_type' => 'email_config'], [
            'key_name' => 'email_config_status',
            'live_values' => (int)$request['value'],
            'test_values' => (int)$request['value'],
            'settings_type' => 'email_config',
            'mode' => 'live',
            'is_active' => 1,
        ]);

        return response()->json(response_formatter(DEFAULT_UPDATE_200), 200);
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Application|Factory|View
     */
    public function getCustomerSettings(Request $request): View|Factory|Application
    {
        $web_page = $request->has('web_page') ? $request['web_page'] : 'wallet';
        $data_values = $this->businessSetting->where('settings_type', 'customer_config')->get();
        return view('customermodule::admin.customer.settings', compact('web_page', 'data_values'));
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function setCustomerSettings(Request $request): RedirectResponse
    {
        if ($request['web_page'] == 'wallet') {
            $validator = Validator::make($request->all(), [
                'customer_wallet' => 'in:0,1',
            ]);

            $filter = $validator->validated();
            $filter['customer_wallet'] = $request['customer_wallet'] ?? 0;
        } elseif ($request['web_page'] == 'loyalty_point') {
            $validator = Validator::make($request->all(), [
                //loyalty point
                'customer_loyalty_point' => 'in:0,1',
                'loyalty_point_value_per_currency_unit' => 'required',
                'loyalty_point_percentage_per_booking' => 'required',
                'min_loyalty_point_to_transfer' => 'required',
            ]);

            $filter = $validator->validated();
            $filter['customer_loyalty_point'] = $request['customer_loyalty_point'] ?? 0;
        } elseif ($request['web_page'] == 'referral_earning') {
            $validator = Validator::make($request->all(), [
                'customer_referral_earning' => 'in:0,1',
                'referral_value_per_currency_unit' => 'required'
            ]);

            $filter = $validator->validated();
            $filter['customer_referral_earning'] = $request['customer_referral_earning'] ?? 0;
        } else {
            Toastr::success(translate(DEFAULT_400['message']));
            return back();
        }

        foreach ($filter as $key => $value) {
            $this->businessSetting->updateOrCreate(['key_name' => $key], [
                'key_name' => $key,
                'live_values' => $value,
                'test_values' => $value,
                'settings_type' => 'customer_config',
                'mode' => 'live',
                'is_active' => 1,
            ]);
        }

        Toastr::success(translate(DEFAULT_UPDATE_200['message']));
        return back();
    }

    public function sendMail(Request $request): \Illuminate\Http\JsonResponse|RedirectResponse
    {
        if (env('APP_MODE') == 'demo') {
            Toastr::info(translate('update_option_is_disable_for_demo'));
            return back();
        }
        $responseFlag = 0;
        $emailStatus = business_config('email_config_status', 'email_config')->live_values;

        if ($emailStatus){
            try {
                Mail::to($request->email)->send(new TestMailSender());
                $responseFlag = 1;
            } catch (\Exception $exception) {
                info($exception->getMessage());
                $responseFlag = 2;
            }
        }

        return response()->json(['success' => $responseFlag]);
    }

    public function languageSetup(Request $request): Factory|View|Application
    {
        $this->authorize('language_view');

        $system_language = BusinessSettings::where('key_name', 'system_language')->where('settings_type', 'business_information')->first();

        return view('businesssettingsmodule::admin.language-setup', compact('system_language'));
    }

    public function thirdParty(Request $request, $webPage)
    {
        $publishedStatus = 0;
        $paymentUrl = '';


        $validator = Validator::make(
            ['web_page' => $webPage],
            ['web_page' => 'required|in:map-api,recaptcha,firebase-configuration,firebase-authentication,apple-login,email-config,sms_config,payment_config,app_settings,social_login,test_mail,storage_connection']
        );
        $validator->validate();

        if (in_array($webPage, ['sms_config', 'payment_config']))
        {
            if ($webPage === 'payment_config') {
                Validator::make($request->all(), [
                    'type' => 'in:digital_payment,offline_payment',
                ])->validate();
                $type = $request->input('type', null);
            }


            try {
                $full_data = include('Modules/Gateways/Addon/info.php');
                $publishedStatus = $full_data['is_published'] == 1 ? 1 : 0;
            } catch (\Exception $exception) {
            }

            $routes = config('addon_admin_routes');
            $desiredName = $webPage === 'sms_config' ? 'sms_setup' : 'payment_setup';

            $paymentUrl = '';

            foreach ($routes as $routeArray) {
                foreach ($routeArray as $route) {
                    if ($route['name'] === $desiredName) {
                        $paymentUrl = $route['url'];
                        break 2;
                    }
                }
            }

            $settingType = $webPage;
            $keyNames = $webPage === 'sms_config'
                ? array_column(SMS_GATEWAY, 'key')
                : array_merge(array_column(DIGITAL_PAYMENT_METHODS, 'key'));

            $gatewayList = $this->addonSetting
                ->whereIn('settings_type', [$settingType])
                ->whereIn('key_name', $keyNames)
                ->when($request->has('search'), function ($query) use ($request) {
                    $keys = explode(' ', $request['search']);
                    return $query->where(function ($query) use ($keys) {
                        foreach ($keys as $key) {
                            $query->where('key_name', 'LIKE', '%' . $key . '%');
                        }
                    });
                })
                ->get();
            $gateways = $gatewayList
                ->sortBy(function ($item) {
                return count($item['live_values']);
            })
                ->values()
                ->all();
            $recaptcha = $this->businessSetting->where('key_name', 'recaptcha')->first()?->toArray() ?? [];
            $firebaseOtpVerification = $this->businessSetting->where('key_name', 'firebase_otp_verification')->first()?->toArray() ?? [];
            $withdrawalMethods = OfflinePayment::
            when($request->has('search'), function ($query) use ($request) {
                $keys = explode(' ', $request['search']);
                return $query->where(function ($query) use ($keys) {
                    foreach ($keys as $key) {
                        $query->where('method_name', 'LIKE', '%' . $key . '%');
                    }
                });
            })
                ->paginate(pagination_limit());
            $search = $request['search'];
        }

        match ($webPage)
        {
            'map-api' => $data = $this->getThirdPartyData(webPage: 'google_map'),
            'firebase-configuration', 'firebase-authentication' => $data = $this->getFirebaseConfigurationData(),
            'recaptcha' => $data = $this->getThirdPartyData(webPage: 'recaptcha'),
            'apple-login' => $data = $this->getThirdPartyData(webPage: 'apple_login'),
            'email-config' => $data = array_merge($this->getThirdPartyData(webPage: 'email_config'), ['status' => $this->getThirdPartyData(webPage: 'email_config_status')]),
            'sms_config' => $data = array_merge(['gateways' => $gateways], [ 'recaptcha' => $recaptcha, 'firebase_otp_verification' => $firebaseOtpVerification]),
            'payment_config' => $data =
                [   'gateways' => $gateways,
                    'type' => $type,
                    'withdrawalMethods' => $withdrawalMethods,
                    'search' => $search
                ],
            'storage_connection' => $data = array_merge(['storage_connection_type' => $this->getThirdPartyData(webPage: 'storage_connection_type')], ['s3_storage_credentials' => $this->getThirdPartyData(webPage: 's3_storage_credentials')]) ,
            'app_settings' => $data = array_merge(
                [
                    'customer_app_settings' => is_string($this->getThirdPartyData(webPage: 'customer_app_settings'))
                        ? (json_decode($this->getThirdPartyData(webPage: 'customer_app_settings'), true) ?? [])
                        : $this->getThirdPartyData(webPage: 'customer_app_settings')
                ],
                [
                    'provider_app_settings' => is_string($this->getThirdPartyData(webPage: 'provider_app_settings'))
                        ? (json_decode($this->getThirdPartyData(webPage: 'provider_app_settings'), true) ?? [])
                        : $this->getThirdPartyData(webPage: 'provider_app_settings')
                ],
                [
                    'serviceman_app_settings' => is_string($this->getThirdPartyData(webPage: 'serviceman_app_settings'))
                        ? (json_decode($this->getThirdPartyData(webPage: 'serviceman_app_settings'), true) ?? [])
                        : $this->getThirdPartyData(webPage: 'serviceman_app_settings')
                ]
            ),
        };

        if ($webPage == 'firebase-configuration' || $webPage == 'firebase-authentication'){
            return view('businesssettingsmodule::admin.configurations.third-party.firebase', compact('webPage', 'data'));
        }
        elseif ($webPage == 'payment_config'){
            //update setup guideline data
            updateSetupGuidelineTutorialsOptions(auth()->user()->id,'digital_payment', 'web');

            return view('businesssettingsmodule::admin.configurations.third-party.payment.index', compact('webPage', 'data', 'publishedStatus', 'paymentUrl'));
        }
        else{
            return view('businesssettingsmodule::admin.configurations.third-party.index', compact('webPage', 'data', 'publishedStatus', 'paymentUrl'));
        }
    }

    public function AIConfiguration(Request $request)
    {
        $this->authorize('ai_configuration_view');

        $data = AISetting::where('ai_name', 'OpenAI')->first();
        return view('businesssettingsmodule::admin.configurations.third-party.ai-settings', compact( 'data'));
    }

    public function AIConfigurationUpdate(Request $request)
    {
        $this->authorize('ai_configuration_update');

        $request->validate([
            'api_key' => 'required',
            'organization_id' => 'required',
        ]);

        AISetting::updateOrCreate(
            ['ai_name' => 'OpenAI'],
            [
                'ai_name' => 'OpenAI',
                'api_key' => $request->api_key,
                'organization_id' => $request->organization_id,
            ]
        );

        Toastr::success(translate(DEFAULT_UPDATE_200['message']));
        return back();
    }

    public function AIConfigurationStatusUpdate(Request $request)
    {
        $this->authorize('ai_configuration_manage_status');

        $openAI = AISetting::where('ai_name', 'OpenAI')->first();

        if (!$openAI){
            return response()->json([
                'response_code' => 'ai_404',
                'message' => 'Add the api key and organization id first'
            ], 404);

        }

        $openAI->status = !$openAI->status;
        $openAI->save();

        return response()->json(response_formatter(constant: DEFAULT_UPDATE_200), 200);
    }

    public function storeThirdPartyData(ThirdPartyDataStoreOrUpdateRequest $request)
    {
        $data = $request->validated();

        if (array_key_exists('service_file_content', $data))
        {
            $pushNotification = bs_data($this->businessSetting, 'push_notification');
                $pushNotificationData = ['party_name' => 'push_notification', 'server_key' => $pushNotification['server_key'] ?? null, 'service_file_content' => $data['service_file_content']];
                $this->businessSetting->updateOrCreate(
                    ['key_name' => 'push_notification', 'settings_type' => 'third_party'],
                    [
                        'key_name' => 'push_notification',
                        'live_values' => $pushNotificationData,
                        'test_values' => $pushNotificationData,
                        'settings_type' => 'third_party',
                        'mode' => 'live',
                        'is_active' => $data['status'] ?? 1,
                    ]
                );
        }

        if (array_key_exists('web_api_key', $data))
        {
            collect(['twilio', 'nexmo', '2factor', 'msg91', 'signal_wire'])->each(function ($gateway) {
                if ($setting = Setting::where('key_name', $gateway)->where('settings_type', 'sms_config')->first()) {
                    tap($setting, function ($setting) {
                        $updatedValues = array_merge($setting->live_values, ['status' => 0]);

                        $setting->update([
                            'live_values' => $updatedValues,
                            'test_values' => $updatedValues,
                            'is_active' => 0,
                        ]);
                    });
                }
            });
        }

        $appleLogin = bs_data($this->businessSetting, 'apple_login');
        $fileName = array_key_exists('apple_service_file', $data) ? file_uploader('apple-login/', 'p8', $request->file('apple_service_file')) : ($appleLogin['service_file'] ?? null);

        if ($data['party_name'] == 'email_config')
        {

            $processedData = [];
            $processedData[] = array_merge(Arr::except($data, 'status'), ['party_name' => 'email_config']);
            $processedData[] = $data['status'] ?? 1;
            foreach ($processedData as $configData)
            {
                $this->businessSetting->updateOrCreate(
                    ['key_name' => $configData['party_name'] ?? 'email_config_status', 'settings_type' => 'email_config'],
                    [
                        'key_name' => $configData['party_name'] ?? 'email_config_status',
                        'live_values' => $configData,
                        'test_values' => $configData,
                        'settings_type' => 'email_config',
                        'mode' => 'live',
                        'is_active' => $configData['status'] ?? 1,
                    ]
                );
            }

            //update setup guideline data
            updateSetupGuidelineTutorialsOptions(auth()->user()->id,'email_configuration', 'web');

            return response()->json(response_formatter(constant: DEFAULT_UPDATE_200), 200);
        }

        match ($data['party_name']) {
            'push_notification' => $processedData = ['party_name' => $data['party_name'], 'server_key' => $data['server_key'], 'service_file_content' => file_get_contents($data['service_file']->path())],
            'firebase' => $processedData = array_merge(Arr::except($data, 'service_file_content'), ['party_name' => 'firebase_message_config']),
            'apple_login' => $processedData = array_merge(Arr::except($data, 'apple_service_file'), ['service_file' => $fileName]),
            default => $processedData = $data,
        };

        if ($data['party_name'] == 'firebase')
        {
            self::firebaseMessageConfigFileGen();

            //update setup guideline data
            updateSetupGuidelineTutorialsOptions(auth()->user()->id,'notification_configuration', 'web');
        }
        $this->businessSetting->updateOrCreate(
            ['key_name' => $processedData['party_name'], 'settings_type' => 'third_party'],
            [
                'key_name' => $processedData['party_name'],
                'live_values' => $processedData,
                'test_values' => $processedData,
                'settings_type' => 'third_party',
                'mode' => 'live',
                'is_active' => $processedData['status'] ?? 1,
            ]
        );

        if ($data['party_name'] == 'google_map'){
            //update setup guideline data
            updateSetupGuidelineTutorialsOptions(auth()->user()->id,'google_map_configuration', 'web');
        }

        return response()->json(response_formatter(constant: DEFAULT_UPDATE_200), 200);
    }

    public function updateFirebaseOtpStatus()
    {
        $firebaseAuthentication = $this->businessSetting->where('key_name', 'firebase_otp_verification')->first();
        $newStatus = $firebaseAuthentication->live_values['status'] ? 0 : 1;
        if ($newStatus == 1 && (in_array(null, $firebaseAuthentication->live_values, true) || in_array('', $firebaseAuthentication->live_values, true))) {
            return response()->json([
                'response_code' => 'default_fail_200',
                'error' => translate('Cannot update Firebase OTP status when Web Api Key is empty.')
            ], 200);
        }

        $values = [
            'party_name' => 'firebase_otp_verification',
            'status' => $newStatus,
            'web_api_key' => $firebaseAuthentication->live_values['web_api_key'] ?? '',
        ];

        $this->businessSetting->updateOrCreate(['key_name' => 'firebase_otp_verification', 'settings_type' => 'third_party'], [
            'key_name' => 'firebase_otp_verification',
            'live_values' => $values,
            'test_values' => $values,
            'settings_type' => 'third_party',
            'mode' => 'live',
            'is_active' => $newStatus,
        ]);

        return response()->json(response_formatter(constant: DEFAULT_UPDATE_200), 200);
    }

    private function getFirebaseConfigurationData()
    {
        $pushNotificationData = bs_data($this->businessSetting, 'push_notification');
        $messageConfigData = bs_data($this->businessSetting, 'firebase_message_config');
        $firebaseAuthData = bs_data($this->businessSetting, 'firebase_otp_verification');
        return array_merge($pushNotificationData ?? [], $messageConfigData ?? [], $firebaseAuthData ?? []);
    }

    private function getThirdPartyData($webPage)
    {
        $data = bs_data($this->businessSetting, $webPage);
        if ($data) {
            return $data;
        }

        return [];
    }
}
