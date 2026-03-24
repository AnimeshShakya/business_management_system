<?php

namespace App\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Modules\BusinessSettingsModule\Entities\BusinessPageSetting;
use Modules\BusinessSettingsModule\Entities\BusinessSettings;
use Modules\BusinessSettingsModule\Entities\DataSetting;
use Modules\BusinessSettingsModule\Entities\LandingPageFeature;
use Modules\BusinessSettingsModule\Entities\LandingPageSpeciality;
use Modules\BusinessSettingsModule\Entities\LandingPageTestimonial;
use Modules\BusinessSettingsModule\Entities\NotificationSetup;
use Modules\CategoryManagement\Entities\Category;
use Modules\CustomerModule\Entities\SubscribeNewsletter;
use Modules\UserManagement\Entities\EmployeeRoleAccess;
use Modules\UserManagement\Entities\EmployeeRoleSection;
use Modules\UserManagement\Entities\Role;
use Modules\UserManagement\Entities\RoleAccess;
use Modules\UserManagement\Entities\UserRole;

class LandingController extends Controller
{
    private BusinessSettings $businessSettings;
    private DataSetting $dataSetting;
    private Category $category;
    private SubscribeNewsletter $subscribeNewsletter;

    public function __construct(BusinessSettings $businessSettings, Category $category, DataSetting $dataSetting, SubscribeNewsletter $subscribeNewsletter)
    {
        $this->businessSettings = $businessSettings;
        $this->dataSetting = $dataSetting;
        $this->category = $category;
        $this->subscribeNewsletter = $subscribeNewsletter;
    }

    public function home(): Factory|View|Application
    {
        $settings = $this->businessSettings->whereNotIn('settings_type', ['payment_config', 'third_party'])->get();
        $settingss = $this->dataSetting->whereIn('type', ['landing_web_app', 'landing_text_setup'])->get();
        $categories = $this->category->ofType('main')->ofStatus(1)->with(['children'])->withCount('zones')->get();
        $testimonials = LandingPageTestimonial::all();
        $features = LandingPageFeature::all();
        $specialities = LandingPageSpeciality::all();

        $topImageData = [
            'top_image_1' =>  getBusinessSettingsImageFullPath(key: 'top_image_1', settingType: 'landing_images', path: 'landing-page/', defaultPath: 'public/assets/placeholder.png'),
            'top_image_2' =>  getBusinessSettingsImageFullPath(key: 'top_image_2', settingType: 'landing_images', path: 'landing-page/', defaultPath: 'public/assets/placeholder.png'),
            'top_image_3' =>  getBusinessSettingsImageFullPath(key: 'top_image_3', settingType: 'landing_images', path: 'landing-page/', defaultPath: 'public/assets/placeholder.png'),
            'top_image_4' =>  getBusinessSettingsImageFullPath(key: 'top_image_4', settingType: 'landing_images', path: 'landing-page/', defaultPath: 'public/assets/placeholder.png'),
        ];

        return view('welcome', compact('settings', 'categories', 'testimonials', 'features', 'specialities', 'settingss', 'topImageData'));
    }

//    public function aboutUs()
//    {
//        $settings = $this->businessSettings->whereNotIn('settings_type', ['payment_config', 'third_party'])->get();
//        $settingss = $this->dataSetting->whereIn('type', ['landing_web_app', 'landing_text_setup'])->get();
//        $dataSettings = $this->dataSetting->whereIn('type', ['pages_setup', 'landing_text_setup'])->get();
//        return view('about-us', compact('settings', 'dataSettings', 'settingss'));
//    }
//
//    public function privacyPolicy(): Factory|View|Application
//    {
//        $settings = $this->businessSettings->whereNotIn('settings_type', ['payment_config', 'third_party'])->get();
//        $settingss = $this->dataSetting->whereIn('type', ['landing_web_app', 'landing_text_setup'])->get();
//        $dataSettings = $this->dataSetting->where('type', 'pages_setup')->get();
//        return view('privacy-policy', compact('settings', 'dataSettings', 'settingss'));
//    }
//
//    public function termsAndConditions(): Factory|View|Application
//    {
//        $settings = $this->businessSettings->whereNotIn('settings_type', ['payment_config', 'third_party'])->get();
//        $settingss = $this->dataSetting->whereIn('type', ['landing_web_app', 'landing_text_setup'])->get();
//        $dataSettings = $this->dataSetting->where('type', 'pages_setup')->get();
//        return view('terms-and-conditions', compact('settings', 'dataSettings', 'settingss'));
//    }
//
    public function contactUs(): Factory|View|Application
    {
        $settings = $this->businessSettings->whereNotIn('settings_type', ['payment_config', 'third_party'])->get();
        $settingss = $this->dataSetting->whereIn('type', ['landing_web_app', 'landing_text_setup'])->get();
        return view('contact-us', compact('settings', 'settingss'));
    }
//
//    public function cancellationPolicy(): Factory|View|Application
//    {
//        $settings = $this->businessSettings->whereNotIn('settings_type', ['payment_config', 'third_party'])->get();
//        $settingss = $this->dataSetting->whereIn('type', ['landing_web_app', 'landing_text_setup'])->get();
//        $dataSettings = $this->dataSetting->where('type', 'pages_setup')->get();
//        return view('cancellation-policy', compact('settings', 'dataSettings','settingss'));
//    }
//
//    public function refundPolicy(): Factory|View|Application
//    {
//        $settings = $this->businessSettings->whereNotIn('settings_type', ['payment_config', 'third_party'])->get();
//        $settingss = $this->dataSetting->whereIn('type', ['landing_web_app', 'landing_text_setup'])->get();
//        $dataSettings = $this->dataSetting->where('type', 'pages_setup')->get();
//        return view('refund-policy', compact('settings', 'dataSettings', 'settingss'));
//    }

    public function maintenanceMode(): Factory|View|Application
    {
        return view('maintenance-mode');
    }

    public function lang($local): RedirectResponse
    {
        $direction = $this->businessSettings->where('key_name', 'site_direction')->first();
        $direction = $direction->live_values ?? 'ltr';
        $language = $this->businessSettings->where('key_name', 'system_language')->first();
        foreach ($language?->live_values as $key => $data) {
            if ($data['code'] == $local) {
                $direction = isset($data['direction']) ? $data['direction'] : 'ltr';
            }
        }
        session()->forget('landing_language_settings');
        landing_language_load();
        session()->put('landing_site_direction', $direction);
        session()->put('landing_local', $local);
        return redirect()->back();
    }

    public function subscribeNewsletter(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscribe_newsletters',
        ]);

        $newsletter = $this->subscribeNewsletter;
        $newsletter->email = $request->email;
        $newsletter->save();

        Toastr::success(translate(SUBSCRIBE_NEWSLETTER_200['message']));
        return back();
    }

    public function dynamicPage($slug)
    {
        $settingss = $this->dataSetting->whereIn('type', ['landing_web_app', 'landing_text_setup'])->get();
        $settings = $this->businessSettings->whereNotIn('settings_type', ['payment_config', 'third_party'])->get();

        $page = BusinessPageSetting::where('page_key', $slug)
            ->where('is_active', 1)
            ->first();

        if (!$page){
            return redirect()->route('home');
        }

        return view('dynamic-page', compact('page', 'settingss', 'settings'));
    }
}
