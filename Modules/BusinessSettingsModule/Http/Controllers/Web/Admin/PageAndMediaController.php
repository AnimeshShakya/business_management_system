<?php

namespace Modules\BusinessSettingsModule\Http\Controllers\Web\Admin;

use App\Traits\ActivationClass;
use App\Traits\FileManagerTrait;
use App\Traits\UnloadedHelpers;
use App\Traits\UploadSizeHelperTrait;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Modules\BusinessSettingsModule\Entities\BusinessSettings;
use Modules\BusinessSettingsModule\Entities\DataSetting;
use Modules\BusinessSettingsModule\Entities\NotificationSetup;
use Modules\BusinessSettingsModule\Entities\BusinessPageSetting;
use Modules\ProviderManagement\Entities\Provider;

use \Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Ramsey\Uuid\Uuid;

class PageAndMediaController extends Controller
{
    use ActivationClass;
    use FileManagerTrait;
    use AuthorizesRequests;
    use UnloadedHelpers;
    use UploadSizeHelperTrait;

    private BusinessSettings $businessSetting;
    private DataSetting $dataSetting;
    private NotificationSetup $notificationSetup;
    private Provider $provider;
    private BusinessPageSetting $businessPageSetting;

    public function __construct(BusinessSettings $businessSetting, DataSetting $dataSetting, NotificationSetup $notificationSetup, Provider $provider, BusinessPageSetting $businessPageSetting)
    {
        $this->businessSetting = $businessSetting;
        $this->dataSetting = $dataSetting;
        $this->notificationSetup = $notificationSetup;
        $this->provider = $provider;
        $this->businessPageSetting = $businessPageSetting;
    }

    public function list(Request $request): View|Factory|Application
    {
        $this->authorize('page_view');
        $searchTerm = $request->input('search', '');

        $pages = $this->businessPageSetting
            ->where(function($query) use ($searchTerm) {
                $query->where('page_key', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('title', 'LIKE', "%{$searchTerm}%");
            })
            ->latest()->paginate(pagination_limit());

        $defaultPages = ['about-us', 'terms-and-conditions', 'cancellation-policy', 'privacy-policy', 'refund-policy'];
        $customPageCount = $this->businessPageSetting->whereNotIn('page_key', $defaultPages)->count();

        return view('businesssettingsmodule::admin.page-settings.list', compact('pages', 'defaultPages', 'customPageCount'));
    }

    public function index()
    {
        $this->authorize('page_add');
        return view('businesssettingsmodule::admin.page-settings.index');
    }

    public function store(Request $request)
    {
        $this->authorize('page_add');

        $check = $this->validateUploadedFile($request, ['image']);
        if ($check !== true) {
            return $check;
        }

        $request->validate([
            'page_title.0' => 'required',
            'page_content.0' => 'required',
            'image' =>'nullable|image|max:'. uploadMaxFileSizeInKB('image') .'|mimes:' . implode(',', array_column(IMAGEEXTENSION, 'key')),
        ], [
            'page_content.0.required' => 'The default content is required.',
        ]);

        $defaultPages = ['about-us', 'terms-and-conditions', 'cancellation-policy', 'privacy-policy', 'refund-policy'];
        $customPageCount = $this->businessPageSetting->whereNotIn('page_key', $defaultPages)->count();

        if ($customPageCount >= 10) {
            Toastr::error(translate(translate('You can only add up to 10 custom pages.')));
            return redirect()->back();
        }

        $baseKey = strtolower(str_replace(' ', '-', trim($request->page_title[array_search('default', $request->lang)])));

        if (BusinessPageSetting::where('page_key', $baseKey)->exists()) {
            return redirect()->back()->withErrors([
                'page_title.0' => translate('A page with this name already exists.')
            ])->withInput();
        }

        $image = file_uploader('page-setup/', APPLICATION_IMAGE_FORMAT, $request->file('image'));

        $page = $this->businessPageSetting;
        $page->page_key = $baseKey;
        $page->title = $request->page_title[array_search('default', $request->lang)];
        $page->content = $request->page_content[array_search('default', $request->lang)];
        $page->is_active = $request->has('is_active') ? 1 : 0;
        $page->image = $image;
        $page->save();

        foreach ($request->lang as $index => $locale) {
            if ($locale === 'default') continue;

            // Title translation
            if (!empty($request->page_title[$index])) {
                $page->translations()->updateOrCreate(
                    [
                        'locale' => $locale,
                        'key' => $page->page_key . '_title',
                    ],
                    [
                        'value' => $request->page_title[$index],
                    ]
                );
            }

            // Content translation
            if (!empty($request->page_content[$index])) {
                $page->translations()->updateOrCreate(
                    [
                        'locale' => $locale,
                        'key' => $page->page_key. '_content',
                    ],
                    [
                        'value' => $request->page_content[$index],
                    ]
                );
            }
        }


        Toastr::success(translate(DEFAULT_STORE_200['message']));
        return redirect()->route('admin.business-page-setup.list');

    }

    public function view($id)
    {
        $this->authorize('page_update');

        $page = BusinessPageSetting::withoutGlobalScope('translate')->with('translations')->findOrFail($id);

        $local = session('local', 'en');

        $titles = $page->translations
            ->firstWhere(fn($t) => $t->locale === $local && $t->key === $page->page_key . '_title')
            ->value ?? '';

        $contents = $page->translations
            ->firstWhere(fn($t) => $t->locale === $local && $t->key === $page->page_key . '_content')
            ->value ?? '';

        return view('businesssettingsmodule::admin.page-settings.view', compact('page', 'titles', 'contents'));
    }

    public function edit($id)
    {
        $this->authorize('page_update');

        $page = BusinessPageSetting::withoutGlobalScope('translate')->with('translations')->findOrFail($id);

        $languageSetting = BusinessSettings::where('key_name', 'system_language')->first();
        $languages = $languageSetting?->live_values ?? [];

        $titles = [];
        $contents = [];

        foreach ($languages as $lang) {
            $code = $lang['code'];
            $titles[$code] = '';
            $contents[$code] = '';

            foreach ($page->translations as $translation) {

                if ($translation->locale === $code && $translation->key === $page->page_key.'_title') {
                    $titles[$code] = $translation->value;
                }
                if ($translation->locale === $code && $translation->key === $page->page_key.'_content') {
                    $contents[$code] = $translation->value;
                }
            }
        }

        $route = route('business.page.dynamic', ['slug' => $page->page_key]);
        $defaultActivePages = ['about-us', 'terms-and-conditions', 'privacy-policy'];

        return view('businesssettingsmodule::admin.page-settings.edit', compact('page', 'languages', 'titles', 'contents', 'route', 'defaultActivePages'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('page_update');

        $check = $this->validateUploadedFile($request, ['image']);
        if ($check !== true) {
            return $check;
        }

        $defaultIndex = array_search('default', $request->lang);
        $defaultTitle = $request->page_title[$defaultIndex] ?? '';
        $pageKey = strtolower(str_replace(' ', '-', trim($defaultTitle)));

        $request->validate([
            'page_title.0' => [
                'required',
                Rule::unique('business_page_settings', 'page_key')->ignore($id)->where(function ($query) use ($pageKey) {
                    return $query->where('page_key', $pageKey);
                }),
            ],
            'page_content.0' => 'required',
            'image' =>'nullable|image|max:'. uploadMaxFileSizeInKB('image') .'|mimes:' . implode(',', array_column(IMAGEEXTENSION, 'key')),
        ], [
            'page_title.0.unique' => 'The default page title already exists.',
            'page_content.0.required' => 'The default content is required.',
        ]);

        $page = BusinessPageSetting::withoutGlobalScope('translate')->with('translations')->findOrFail($id);

        $image = $page->image;
        if ($request->hasFile('image')) {
            file_remover('page-setup/', $page?->image);
            $image = file_uploader('page-setup/', APPLICATION_IMAGE_FORMAT, $request->file('image'));
        }

        $defaultActivePages = ['about-us', 'terms-and-conditions', 'privacy-policy'];

        $page->title = $defaultTitle;
        $page->content = $request->page_content[$defaultIndex];
        $page->is_active = in_array($page->page_key, $defaultActivePages) ? 1 : ($request->has('is_active') ? 1 : 0);
        $page->image = $image;
        $page->save();

        foreach ($request->lang as $index => $locale) {
            if ($locale === 'default') continue;

            if (!empty($request->page_title[$index])) {
                $page->translations()->updateOrCreate(
                    ['locale' => $locale, 'key' => $page->page_key . '_title'],
                    ['value' => $request->page_title[$index]]
                );
            }

            if (!empty($request->page_content[$index])) {
                $page->translations()->updateOrCreate(
                    ['locale' => $locale, 'key' => $page->page_key . '_content'],
                    ['value' => $request->page_content[$index]]
                );
            }
        }

        if (in_array($request['page_name'], ['privacy_policy', 'terms_and_conditions'])) {
            $message = translate('page_information_has_been_updated') . '!';

            $customerTncCheck = isNotificationActive(null, 'terms_&_conditions_update', 'notification', 'user');
            $providerTncCheck = isNotificationActive(null, 'terms_&_conditions_update', 'notification', 'provider');
            $servicemanTncCheck = isNotificationActive(null, 'terms_&_conditions_update', 'notification', 'serviceman');
            if ($request['page_name'] == 'terms_and_conditions' && $request['is_active'] == 1) {
                if ($customerTncCheck) {
                    topic_notification('customer', translate($request['page_name']), $message, 'def.png', null, $request['page_name']);
                }
                if ($providerTncCheck) {
                    topic_notification('provider-admin', translate($request['page_name']), $message, 'def.png', null, $request['page_name']);
                }
                if ($servicemanTncCheck) {
                    topic_notification('provider-serviceman', translate($request['page_name']), $message, 'def.png', null, $request['page_name']);
                }
            }


            $customerCheck = isNotificationActive(null, 'privacy_policy_update', 'notification', 'user');
            $providerCheck = isNotificationActive(null, 'privacy_policy_update', 'notification', 'provider');
            $servicemanCheck = isNotificationActive(null, 'privacy_policy_update', 'notification', 'serviceman');
            if ($request['page_name'] == 'privacy_policy' && $request['is_active'] == 1) {
                if ($customerCheck) {
                    topic_notification('customer', translate($request['page_name']), $message, 'def.png', null, $request['page_name']);
                }
                if ($providerCheck) {
                    topic_notification('provider-admin', translate($request['page_name']), $message, 'def.png', null, $request['page_name']);
                }
                if ($servicemanCheck) {
                    topic_notification('provider-serviceman', translate($request['page_name']), $message, 'def.png', null, $request['page_name']);
                }
            }
        }

        Toastr::success(translate(DEFAULT_UPDATE_200['message']));
        return redirect()->route('admin.business-page-setup.list');
    }

    public function changeStatus($id)
    {
        $this->authorize('page_manage_status');

        $page = $this->businessPageSetting->findOrFail($id);
        $page->is_active = !$page->is_active;
        $page->save();

        return response()->json(['message' => translate('Status updated successfully')]);
    }

    public function destroy(Request $request, $id): RedirectResponse|JsonResponse
    {
        $this->authorize('page_delete');

        $page = $this->businessPageSetting->findOrFail($id);
        $page->delete();
        if ($request->ajax()) {
            return response()->json(response_formatter(DEFAULT_UPDATE_200), 200);
        } else {
            Toastr::success(translate(DEFAULT_DELETE_200['message']));
            return back();
        }
    }

    public function socialIndex()
    {
        $this->authorize('page_view');

        $social = BusinessSettings::where('settings_type', 'landing_social_media')->first();
        $socialPages = $social->live_values;

        return view('businesssettingsmodule::admin.social-media', compact('socialPages'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function socialStore(Request $request): RedirectResponse
    {
        $this->authorize('page_add');

        $request->validate([
            'media' => 'required',
            'link'  => 'required|url',
        ]);

        $data = BusinessSettings::where('settings_type', 'landing_social_media')->first();

        $array = [];
        if ($data && is_array($data->live_values)) {
            $array = $data->live_values;
        }

        $found = false;

        foreach ($array as &$item) {
            if ($item['media'] == $request->media) {
                $item['link'] = $request->link;
                $found = true;
                Toastr::error(translate('This social media link has already been added. Please choose a different platform or update the existing one'));
                return back();
            }
        }


        if (!$found) {
            $array[] = [
                'id'    => Uuid::uuid4()->toString(),
                'media' => $request->media,
                'link'  => $request->link,
                'status'  => 1,
            ];
        }

        if ($data) {
            $data->live_values = $array;
            $data->save();
        } else {
            BusinessSettings::create([
                'settings_type' => 'landing_social_media',
                'live_values'   => $array,
            ]);
        }

        Toastr::success(translate(DEFAULT_STORE_200['message']));
        return back();
    }

    public function socialDelete($id): RedirectResponse
    {
        $this->authorize('page_delete');

        $array = [];
        $data = BusinessSettings::where('settings_type', 'landing_social_media')->first();

        foreach ($data->live_values as $value) {
            if ($value['id'] != $id) {
                $array[] = $value;
            }
        }

        BusinessSettings::updateOrCreate(['key_name' => 'social_media'], [
            'key_name' => 'social_media',
            'live_values' => $array,
            'test_values' => $array,
            'settings_type' => 'landing_social_media',
            'mode' => 'live',
            'is_active' => 1,
        ]);

        Toastr::success(translate(DEFAULT_DELETE_200['message']));
        return back();
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function socialUpdate(Request $request, $id): RedirectResponse
    {

        $this->authorize('page_update');

        $request->validate([
            'media' => 'required',
            'link'  => 'required|url',
        ]);

        $data = BusinessSettings::where('settings_type', 'landing_social_media')->first();

        $array = $data->live_values;
        $found = false;

        foreach ($array as &$item) {
            if ($item['id'] == $id) {
                $item['media'] = $request->media;
                $item['link']  = $request->link;
                $found = true;
                break;
            }
        }

        if (!$found) {
            Toastr::error(translate('Social media entry not found.'));
            return back();
        }

        $data->live_values = $array;
        $data->save();

        Toastr::success(translate(DEFAULT_UPDATE_200['message']));
        return back();
    }

    public function socialStatus(Request $request, $id)
    {
        $this->authorize('page_manage_status');

        $data = BusinessSettings::where('settings_type', 'landing_social_media')->first();

        if (!$data || !is_array($data->live_values)) {
            return response()->json([
                'status' => false,
                'message' => translate('Social media settings not found.')
            ], 404);
        }

        $liveValues = $data->live_values;
        $found = false;

        foreach ($liveValues as &$item) {
            if ($item['id'] == $id) {
                $item['status'] = (isset($item['status']) && $item['status'] == 1) ? 0 : 1;
                $found = true;
                break;
            }
        }

        if (!$found) {
            return response()->json([
                'status' => false,
                'message' => translate('Item not found.')
            ], 404);
        }

        $data->live_values = $liveValues;
        $data->save();

        return response()->json([
            'status' => true,
            'message' => translate('Status updated successfully.')
        ]);
    }

}
