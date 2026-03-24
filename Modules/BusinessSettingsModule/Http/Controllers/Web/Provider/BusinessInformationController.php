<?php

namespace Modules\BusinessSettingsModule\Http\Controllers\Web\Provider;

use App\Traits\ActivationClass;
use App\Traits\FileManagerTrait;
use App\Traits\UploadSizeHelperTrait;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Modules\BusinessSettingsModule\Entities\BusinessSettings;
use Modules\ProviderManagement\Entities\Provider;
use Modules\ProviderManagement\Entities\ProviderSetting;
use Modules\UserManagement\Entities\User;
use Modules\ZoneManagement\Entities\Zone;

class BusinessInformationController extends Controller
{
    use ActivationClass;
    use FileManagerTrait;
    use UploadSizeHelperTrait;

    private BusinessSettings $businessSetting;
    private ProviderSetting $providerSetting;
    private Provider $provider;
    private Zone $zone;
    private User $user;

    public function __construct(BusinessSettings $businessSetting, ProviderSetting $providerSetting, Provider $provider, Zone $zone, User $user)
    {
        $this->businessSetting = $businessSetting;
        $this->providerSetting = $providerSetting;
        $this->provider = $provider;
        $this->zone = $zone;
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     */
    public function businessInformationGet(Request $request): Factory|View|Application
    {
        if ($this->providerSetting->where(['key_name' => 'provider_serviceman_can_edit_booking', 'settings_type' => 'serviceman_config', 'provider_id' => auth()->user()->provider->id])->first() == false) {
            $this->providerSetting->updateOrCreate(['key_name' => 'provider_serviceman_can_edit_booking', 'settings_type' => 'serviceman_config'], [
                'provider_id' => auth()->user()->provider->id,
                'live_values' => 0,
                'test_values' => 0
            ]);
        }

        if ($this->providerSetting->where(['key_name' => 'provider_serviceman_can_cancel_booking', 'settings_type' => 'serviceman_config', 'provider_id' => auth()->user()->provider->id])->first() == false) {
            $this->providerSetting->updateOrCreate(['key_name' => 'provider_serviceman_can_cancel_booking', 'settings_type' => 'serviceman_config'], [
                'provider_id' => auth()->user()->provider->id,
                'live_values' => 0,
                'test_values' => 0
            ]);
        }

        $providerId = auth()->user()->provider->id;
        $coordinates = auth()->user()->provider?->coordinates;

        $addressLat = $coordinates['latitude'] ?? '23.8435348';
        $addressLong = $coordinates['longitude'] ?? '90.3778993';

        $dataValues = $this->providerSetting->where('settings_type', 'serviceman_config')->get();
        $webPage = $request->has('web_page') ? $request['web_page'] : 'businessinfos';

        $timeSchedule = provider_config('time_schedule', 'service_schedule', $providerId)->live_values ?? '';
        $timeSchedule = json_decode($timeSchedule, true);
        $weekEnds = provider_config('weekends', 'service_schedule', $providerId)->live_values ?? '';
        $weekEnds = json_decode($weekEnds);

        $serviceLocation = $this->providerSetting->where(['key_name' => 'service_location', 'provider_id' => $providerId, 'settings_type' => 'provider_config'])->first();
        $serviceLocations = $serviceLocation ? json_decode($serviceLocation->live_values, true) : [];
        $zones = $this->zone->ofStatus(1)->select('id', 'name')->get();

        return view('businesssettingsmodule::provider.business', compact('dataValues', 'providerId', 'webPage', 'timeSchedule', 'weekEnds', 'serviceLocations', 'zones', 'addressLat', 'addressLong'));
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     * @throws ValidationException
     */
    public function businessInformationSet(Request $request): JsonResponse|RedirectResponse
    {
        collect(['provider_serviceman_can_edit_booking', 'provider_serviceman_can_cancel_booking'])->each(fn($item, $key) => $request[$item] = $request->has($item) ? (int)$request[$item] : 0);

        $validator = Validator::make($request->all(), [
            'provider_serviceman_can_edit_booking' => 'required|in:0,1',
            'provider_serviceman_can_cancel_booking' => 'required|in:0,1',
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }


        foreach ($validator->validated() as $key => $value) {
            $this->providerSetting->updateOrCreate(['key_name' => $key, 'provider_id' => auth()->user()->provider->id, 'settings_type' => 'serviceman_config'], [
                'key_name' => $key,
                'live_values' => $value,
                'test_values' => $value,
                'settings_type' => 'serviceman_config',
                'mode' => 'live',
                'is_active' => 1,
            ]);
        }

        // Collect only checked service location options
        $serviceAtProviderPlace = (int)((business_config('service_at_provider_place', 'provider_config'))->live_values ?? 0);

        if($serviceAtProviderPlace == 0){
            Toastr::error(translate(SERVICE_LOCATION_400['message']));
            return back();
        }

        $serviceLocation = [];

        if ($request->filled('customer_location')) {
            $serviceLocation[] = 'customer';
        }
        if ($request->filled('provider_location')) {
            $serviceLocation[] = 'provider';
        }

        if (empty($serviceLocation)) {
            Toastr::error(translate('At least one service location must be active'));
            return back();
        }

        if ($serviceAtProviderPlace == 0 && $request->service_location == 'provider') {
            Toastr::error(translate('Cannot switch to provider when provider service location is off'));
            return back();
        }

        if ($serviceAtProviderPlace == 0 && in_array('provider', $serviceLocation)) {
            Toastr::error(translate('Cannot switch to provider when provider service location is off'));
            return back();
        }

        $this->providerSetting->updateOrCreate(['key_name' => 'service_location', 'provider_id' => auth()->user()->provider->id, 'settings_type' => 'provider_config'], [
            'key_name' => 'service_location',
            'live_values' => json_encode($serviceLocation),
            'test_values' => json_encode($serviceLocation),
            'settings_type' => 'provider_config',
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
     * @throws ValidationException
     */
    public function availabilityStatus(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'service_availability' => 'in:1,0',
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        $provider = Provider::where('user_id', $request->user()->id)->first();

        if ($provider){
            $provider->service_availability = $request->service_availability;
            $provider->save();
            return response()->json(response_formatter(DEFAULT_UPDATE_200), 200);
        }

        return response()->json(response_formatter(DEFAULT_UPDATE_200), 200);
    }

    public function availabilitySchedule(Request $request): RedirectResponse
    {
       $request->validate([
           'start_time' => 'nullable|date_format:H:i',
           'end_time' => 'nullable|date_format:H:i|after:start_time',
           'day' => 'array',
           'day.*' => 'in:saturday,sunday,monday,tuesday,wednesday,thursday,friday',
        ]);
        $requestData = $request->all();

        $timeSchedulesData = [
            'start_time' => $requestData['start_time'],
            'end_time' => $requestData['end_time'],
        ];

        $weekend = $requestData['day'] ?? [];

        $this->providerSetting::updateOrCreate(
            [
                'key_name' => 'time_schedule',
                'settings_type' => 'service_schedule',
                'provider_id' => $request->user()->provider->id,
            ],
            [
                'live_values' => json_encode($timeSchedulesData),
                'test_values' => json_encode($timeSchedulesData),
            ]
        );

        $this->providerSetting::updateOrCreate(
            [
                'key_name' => 'weekends',
                'settings_type' => 'service_schedule',
                'provider_id' => $request->user()->provider->id,
            ],
            [
                'live_values' => isset($weekend) ? json_encode($weekend) : null,
                'test_values' => isset($weekend) ? json_encode($weekend) : null,
            ]
        );

        //update setup guideline data
        updateSetupGuidelineTutorialsOptions(auth()->user()->id,'service_availability', 'web');

        Toastr::success(translate('successfully updated'));
        return back();
    }

    public function updateBusinessInformation(Request $request)
    {
        $check = $this->validateUploadedFile($request, ['logo', 'cover_image']);
        if ($check !== true) {
            return $check;
        }

        Validator::make($request->all(), [
            'company_name' => 'required',
            'company_email' => 'required|email',
            'company_phone' => 'required',
            'zone_id' => 'required',
            'company_address' => 'required',

            'logo' => 'image|max:'. uploadMaxFileSizeInKB('image') .'|mimes:' . implode(',', array_column(IMAGEEXTENSION, 'key')),
            'cover_image' => 'image|max:'. uploadMaxFileSizeInKB('image') .'|mimes:' . implode(',', array_column(IMAGEEXTENSION, 'key')),

            'contact_person_name' => 'required',
            'contact_person_phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            'contact_person_email' => 'required',

            'identity_type' => 'required|in:passport,driving_license,nid,trade_license,company_id',
            'identity_number' => 'required',
           // 'identity_images' => 'array',
           // 'identity_images.*' => 'image|mimes:jpeg,jpg,png,gif',

        ])->validate();


        $provider = $this->provider::where('user_id', $request->user()->id)->first();

        $provider->company_name = $request->company_name;
        $provider->company_email = $request->company_email;
        $provider->company_phone = $request->company_phone;
        $provider->zone_id = $request['zone_id'];
        $provider->company_address = $request->company_address;

        if ($request->has('logo')) {
            $provider->logo = file_uploader('provider/logo/', APPLICATION_IMAGE_FORMAT, $request->file('logo'), $provider->logo);
        }
        if ($request->has('cover_image')) {
            $provider->cover_image = file_uploader('provider/logo/', APPLICATION_IMAGE_FORMAT, $request->file('cover_image'), $provider->cover_image);
        }

        $provider->contact_person_name = $request->contact_person_name;
        $provider->contact_person_phone = $request->contact_person_phone;
        $provider->contact_person_email = $request->contact_person_email;

        $provider->coordinates = [
            'latitude' => $request['latitude'],
            'longitude' => $request['longitude'],
        ];

        $owner = $this->user->where('id', $request->user()->id)->first();
        $owner->identification_number = $request->identity_number;
        $owner->identification_type = $request->identity_type;

        $identityImages = [];
        if (!is_null($request->identity_images)) {
            foreach ($request->identity_images as $image) {
                $imageName = file_uploader('provider/identity/', APPLICATION_IMAGE_FORMAT, $image);
                $identityImages[] = ['image'=>$imageName, 'storage'=> getDisk()];
            }
        }

        if (count($identityImages) > 0) {
            $owner->identification_image = $identityImages;
        }

        DB::transaction(function () use ($provider, $owner) {
            $owner->save();
            $provider->save();

            //update setup guideline data
            updateSetupGuidelineTutorialsOptions(auth()->user()->id,'business_information', 'web');
        });

        Toastr::success(translate(DEFAULT_UPDATE_200['message']));
        return back();
    }

}
