<?php
    $setup = getSetupGuideSteps('admin_panel', auth()->user());
    $steps = collect($setup['steps'])->sortBy('order');
    $percentage = $setup['percentage'];
    $rotation = $setup['rotation'];
    $isFirstTimeGuide = $setup['isFirstTimeGuide'];
    $arrowStep = $steps->take(1)->firstWhere('checked', false);
    $firstUncheckedStep = $steps->firstWhere('checked', false);
    $allCompleted = $steps->every(fn ($step) => $step['checked'] === true);
    $uncheckedCount = $steps->where('checked', false);

    $uncheckedStepKeys  = $steps->where('checked', false)->pluck('key')->values();
?>

@if(!$allCompleted)
    <!-- Guidline Button -->
    <div class="setup-guide">
        <div class="setup-guide__button d-flex gap-2 justify-content-between align-items-center bg-primary text-white p-3 position-relative rounded pointer shadow"
             data-bs-toggle="modal" data-bs-target="#guideModal">
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger border border-3 d-center fs-12 fw-semibold text-absolute-white p-1 w-h-26 w-max-content"
                  id="setupGuideBadge">
                {{ count($uncheckedCount) }}
            </span>
            <div class="d-flex gap-2 align-items-center font-weight-bold text-absolute-white">
                <img width="20" src="{{asset('public/assets/admin-module/img/setup_guide.png')}}" alt="">
                <span class="d-none d-lg-flex">{{ translate('Setup_Guide') }}</span>
            </div>
            <div class="d-none d-lg-flex text-white">
                <img width="20" src="{{asset('public/assets/admin-module/img/comment-alt-dots.png')}}" alt="">
            </div>
        </div>
    </div>

    <!-- Guidline Modal -->
    <div class="modal fade" id="guideModal" tabindex="-1" aria-labelledby="guideModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-end" style="max-width: 400px">
            <div class="modal-content modal-content_cont rounded-3 overflow-visible">

                <div class="modal-header justify-content-between p-xxl-4 p-3 bg-light rounded border-0 gap-3">
                    <div class="">
                        <h3 class="mb-1">{{ translate('Set up and take bookings.') }}</h3>
                        <p>{{ translate('Set up and start managing your business with ease.') }}</p>
                    </div>

                    <div class="progress-pie-chart {{ $percentage > 50 ? 'gt-50' : '' }}">
                        <div class="ppc-progress">
                            <div class="ppc-progress-fill" style="transform: rotate({{ $rotation }}deg);">

                            </div>
                        </div>
                        <div class="ppc-percents">
                            <div class="pcc-percents-wrapper">
                                <span id="setupGuidePercentage">{{ $percentage }}</span>
                                <span class="fs-12 fw-bold text-dark">%</span>
                            </div>
                        </div>
                    </div>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"
                            class="close border-0 bg-white rounded-circle d-flex align-items-center justify-content-center w-30 h-30 guideline-close m-2 p-1">
                        <span class="material-symbols-outlined position-relative top-01">close</span>
                    </button>
                </div>

                <div class="modal-body">
                    @if($arrowStep)
                        <div class="modal-instruction-content position-absolute top-0">
                            <img class="mb-3" src="{{ asset('public/assets/admin-module/img/modal-arrow.svg') }}" alt="">
                            <h3 class="fs-28 max-w-250 text-white ms-5 text-start">
                                {{ translate('Setup Your') }} <br> {{ translate('Business') }}
                            </h3>
                        </div>
                    @endif

                    <div class="d-flex flex-column gap-3 overflow-y-auto" style="max-height: 340px;">
                        @foreach ($steps as $step)
                            <div class="p-20 bg-light rounded">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="custom-checkbox d-flex gap-1 align-items-center">
                                        <input class="mb-1 custom-checkbox__input"
                                               type="checkbox"
                                               id="guide-step-{{ $step['key'] }}"
                                               {{ $step['checked'] ? 'checked' : '' }} disabled>

                                        <label class="custom-checkbox__label user-select-none flex-grow-1" for="{{ $step['key'] }}">
                                            <a href="{{ setupGuidelineRouteModify($step['route']) }}" class="text-decoration-none text-dark">
                                                {{ ucwords(str_replace('_', ' ', $step['title'])) }}
                                            </a>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>


                        <div data-bs-dismiss="modal" aria-label="Close" class="">
                            <div class="d-flex justify-content-between align-items-center pt-2">
                                <a class="btn btn--secondary rounded" href="javascript:void(0)" id="skipSetupGuide">{{ translate('skip_for_now') }}</a>
                                @if($firstUncheckedStep)
                                    <a class="btn btn--primary rounded px-3 d-inline-flex  align-items-center bottom-0 gap-1 btn-sm position-relative"
                                       href="{{ setupGuidelineRouteModify($firstUncheckedStep['route']) }}">
                                        {{ translate('Lets_Start') }}
                                        <span class="material-symbols-outlined">arrow_right_alt</span>
                                    </a>
                                @endif
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>

@endif


<div class="view-guideline-btn w-50px h-50px bg-white position-fixed pointer show">
    <div class="d-flex justify-content-center align-items-center h-100 w-100">
        <button type="button" class="btn bg-info text-absolute-white border-0 p-0 action-btn" style="--size: 36px">
            <img src="{{asset('public/assets/admin-module')}}/img/multiple-forward.svg" alt="icon/img" class="icon">
        </button>
    </div>
</div>


{{-- Easy Setup Dropdown --}}
<div class="easy-setup-dropdown bg-white p-3 p-sm-20">
    <div class="d-flex justify-content-between align-items-center gap-2 mb-20">
        <h5 class="mb-0"> {{ translate('Easy Setup') }}</h5>
        <button type="button" class="p-0 m-0 border-0 shadow-none text-secondary bg-transparent easy-setup-dropdown_close"><span class="border rounded-circle d-flex align-items-center justify-content-center w-24 h-24 fs-14" aria-hidden="true">&times;</span></button>
    </div>

    @php
        $currentRouteToCheckGuideLine = request()->route()->getName();
        $currentWebPageToCheckGuideLine = request()->query('web_page', '');
        $currentPathToCheckGuideLine = request()->path();
    @endphp

    @if($currentRouteToCheckGuideLine === 'admin.business-settings.get-business-information' && $currentWebPageToCheckGuideLine === 'business_setup')
        <div class="bg-light p-3 p-sm-20 rounded-10 d-flex justify-content-between align-items-center gap-2 mb-20 cursor-pointer"
             data-bs-toggle="offcanvas" data-bs-target="#offcanvasSetupGuideForBusinessInformation">
            <i class="fi fi-sr-book-bookmark"></i>
            <span class="flex-grow-1">{{ translate('See Guideline') }} </span>
            <span class="text-primary cursor-pointer">
                <i class="fi fi-rr-up-right-from-square"></i>
            </span>
        </div>
    @elseif($currentRouteToCheckGuideLine === 'admin.business-settings.get-business-information' && $currentWebPageToCheckGuideLine === 'business_plan')
        <div class="bg-light p-3 p-sm-20 rounded-10 d-flex justify-content-between align-items-center gap-2 mb-20 cursor-pointer"
             data-bs-toggle="offcanvas" data-bs-target="#offcanvasSetupGuideForBusinessPlan">
            <i class="fi fi-sr-book-bookmark"></i>
            <span class="flex-grow-1">{{ translate('See Guideline') }} </span>
            <span class="text-primary cursor-pointer">
                <i class="fi fi-rr-up-right-from-square"></i>
            </span>
        </div>

    @elseif($currentRouteToCheckGuideLine === 'admin.configuration.third-party' && str_contains($currentPathToCheckGuideLine, 'map-api'))
        <div class="bg-light p-3 p-sm-20 rounded-10 d-flex justify-content-between align-items-center gap-2 mb-20 cursor-pointer"
             data-bs-toggle="offcanvas" data-bs-target="#offcanvasSetupGuideForGoogleMap">
            <i class="fi fi-sr-book-bookmark"></i>
            <span class="flex-grow-1">{{ translate('See Guideline') }} </span>
            <span class="text-primary cursor-pointer">
                <i class="fi fi-rr-up-right-from-square"></i>
            </span>
        </div>

    @elseif($currentRouteToCheckGuideLine === 'admin.configuration.third-party' && str_contains($currentPathToCheckGuideLine, 'email-config'))
        <div class="bg-light p-3 p-sm-20 rounded-10 d-flex justify-content-between align-items-center gap-2 mb-20 cursor-pointer"
             data-bs-toggle="offcanvas" data-bs-target="#offcanvasSetupGuideForEmailConfiguration">
            <i class="fi fi-sr-book-bookmark"></i>
            <span class="flex-grow-1">{{ translate('See Guideline') }} </span>
            <span class="text-primary cursor-pointer">
                <i class="fi fi-rr-up-right-from-square"></i>
            </span>
        </div>

    @elseif($currentRouteToCheckGuideLine === 'admin.configuration.third-party' && str_contains($currentPathToCheckGuideLine, 'firebase-configuration'))
        <div class="bg-light p-3 p-sm-20 rounded-10 d-flex justify-content-between align-items-center gap-2 mb-20 cursor-pointer"
             data-bs-toggle="offcanvas" data-bs-target="#offcanvasSetupGuideForNotificationConfiguration">
            <i class="fi fi-sr-book-bookmark"></i>
            <span class="flex-grow-1">{{ translate('See Guideline') }} </span>
            <span class="text-primary cursor-pointer">
                <i class="fi fi-rr-up-right-from-square"></i>
            </span>
        </div>

    @elseif($currentRouteToCheckGuideLine === 'admin.business-settings.login.setup')
        <div class="bg-light p-3 p-sm-20 rounded-10 d-flex justify-content-between align-items-center gap-2 mb-20 cursor-pointer"
             data-bs-toggle="offcanvas" data-bs-target="#offcanvasSetupGuideForLoginOption">
            <i class="fi fi-sr-book-bookmark"></i>
            <span class="flex-grow-1">{{ translate('See Guideline') }} </span>
            <span class="text-primary cursor-pointer">
                <i class="fi fi-rr-up-right-from-square"></i>
            </span>
        </div>

    @elseif($currentRouteToCheckGuideLine === 'admin.configuration.third-party' && str_contains($currentPathToCheckGuideLine, 'payment_config'))
        <div class="bg-light p-3 p-sm-20 rounded-10 d-flex justify-content-between align-items-center gap-2 mb-20 cursor-pointer"
             data-bs-toggle="offcanvas" data-bs-target="#offcanvasSetupGuideForPaymentMethod">
            <i class="fi fi-sr-book-bookmark"></i>
            <span class="flex-grow-1">{{ translate('See Guideline') }} </span>
            <span class="text-primary cursor-pointer">
                <i class="fi fi-rr-up-right-from-square"></i>
            </span>
        </div>
    @endif



    <div class="bg-light p-3 p-sm-20 rounded-10">
        <div class="d-flex align-items-center gap-2 mb-20">
            <span>{{ translate('Theme Mode') }} </span>
        </div>
        <div class="">
            <div class="d-flex gap-3 gap-sm-4 flex-wrap">
                <div class="setting-box flex-grow-1 light-mode">
                    <img src="{{asset('public/assets/provider-module')}}/img/icons/light-mode.svg" width="30" alt="{{ translate('provider-module') }}">
                </div>
                <div class="setting-box flex-grow-1 dark-mode">
                    <img src="{{asset('public/assets/provider-module')}}/img/icons/dark-mode.svg" width="30" alt="{{ translate('provider-module') }}">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Guidline Offcanvas for business information-->
<div class="offcanvas offcanvas-cus-sm offcanvas-end" tabindex="-1" id="offcanvasSetupGuideForBusinessInformation" aria-labelledby="offcanvasSetupGuideForBusinessInformationLabel">
    <div class="offcanvas-header bg-light p-20">
        <h3 class="mb-0">{{ translate('Business Information Setup Guideline') }}</h3>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-20 bg-white">
        <div class="py-3 px-3 bg-light rounded mb-3 mb-sm-20">
            <div class="d-flex gap-3 align-items-center justify-content-between overflow-hidden">
                <button class="btn-collapse d-flex gap-3 align-items-center bg-transparent border-0 p-0" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapseGeneralSetup_01" aria-expanded="true">
                    <div class="btn-collapse-icon d-flex align-items-center justify-content-center border icon-btn rounded-circle fs-12 lh-1">
                        <i class="fi fi-rr-angle-up"></i>
                    </div>
                    <span class="fw-bold text-start text-dark">{{ translate('System Maintenance') }}</span>
                </button>
            </div>
            <div class="collapse mt-3 show" id="collapseGeneralSetup_01">
                <div class="card card-body">
                    <p class="fs-12">
                        {{ translate('Turning on Maintenance mode will temporarily close your online site. So that the admin can do important updates or fixes') }}
                    </p>
                    <p class="fs-12">
                        {{ translate('Admin can choose a specific section, like mobile app, web app, provider panel, provider app, serviceman app, or all systems, to temporarily deactivate for maintenance.') }}
                    </p>
                    <p class="fs-12">
                        {{ translate('Also, there is an option to choose a specific date & time to go to maintenance mode.') }}
                    </p>
                </div>
            </div>
        </div>

        <div class="p-12 p-sm-20 bg-light rounded mb-3 mb-sm-20">
            <div class="d-flex gap-3 align-items-center justify-content-between overflow-hidden">
                <button class="btn-collapse d-flex gap-3 align-items-center bg-transparent border-0 p-0 collapsed" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapseGeneralSetup_02" aria-expanded="true">
                    <div class="btn-collapse-icon d-flex align-items-center justify-content-center border icon-btn rounded-circle fs-12 lh-1 collapsed">
                        <i class="fi fi-rr-angle-up"></i>
                    </div>
                    <span class="fw-bold text-start text-dark">{{ translate('Basic Information Setup') }}</span>
                </button>
            </div>

            <div class="collapse mt-3" id="collapseGeneralSetup_02">
                <div class="card card-body">
                    <p class="fs-12">
                        <strong>{{ translate('Business Name') }}:</strong>
                        {{ translate('The Business name often serves as the primary identifier for your business as a legal entity.') }}
                    </p>
                    <p class="fs-12">
                        <strong>{{ translate('Email') }}:</strong>
                        {{ translate('A company email system often provides centralised management and archiving of business communication.') }}
                    </p>
                    <p class="fs-12">
                        <strong>{{ translate('phone') }}:</strong>
                        {{ translate('A phone number provides customers and providers with a direct and immediate way to reach your business for urgent inquiries, support needs, or quick questions.') }}
                    </p>
                    <p class="fs-12">
                        <strong>{{ translate('country') }}:</strong>
                        {{ translate('The Country Name field, when setting up a business is essential for a multitude of reasons, spanning legal, operational, financial, and marketing aspects.') }}
                    </p>
                    <p class="fs-12">
                        <strong>{{ translate('address') }}:</strong>
                        {{ translate('This address represents the business location from which the admin operates and manages providers, customers, and service personnel.') }}
                    </p>
                    <p class="fs-12">
                        <strong>{{ translate('Logo and Fav Icon') }}:</strong>
                        {{ translate('This logo is the main visual identity of the business. It represents the brand and is usually displayed on the website/app header, login pages, invoices, and promotional materials. The Fav Icon helps users quickly identify the site among multiple open tabs') }}
                    </p>
                </div>
            </div>
        </div>

        <div class="py-3 px-3 bg-light rounded mb-3 mb-sm-20">
            <div class="d-flex gap-3 align-items-center justify-content-between overflow-hidden">
                <button class="btn-collapse d-flex gap-3 align-items-center bg-transparent border-0 p-0 collapsed" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapseGeneralSetup_03" aria-expanded="true">
                    <div class="btn-collapse-icon d-flex align-items-center justify-content-center border icon-btn rounded-circle fs-12 lh-1 collapsed">
                        <i class="fi fi-rr-angle-up"></i>
                    </div>
                    <span class="fw-bold text-start text-dark">{{ translate('General Setup') }}</span>
                </button>
            </div>
            <div class="collapse mt-3" id="collapseGeneralSetup_03">
                <div class="card card-body">
                    <p class="fs-12">
                        {{ translate('General Setup is the basic configuration stage where you define essential business settings. This section currently includes Time Zone & Date Format, Pagination Limit, Phone Number Visibility in Chat, and Currency configuration.') }}
                    </p>
                </div>
            </div>
        </div>

        <div class="py-3 px-3 bg-light rounded mb-3 mb-sm-20">
            <div class="d-flex gap-3 align-items-center justify-content-between overflow-hidden">
                <button class="btn-collapse d-flex gap-3 align-items-center bg-transparent border-0 p-0 collapsed" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapseGeneralSetup_04" aria-expanded="true">
                    <div class="btn-collapse-icon d-flex align-items-center justify-content-center border icon-btn rounded-circle fs-12 lh-1 collapsed">
                        <i class="fi fi-rr-angle-up"></i>
                    </div>
                    <span class="fw-bold text-start text-dark">{{ translate('Customer') }}</span>
                </button>
            </div>
            <div class="collapse mt-3" id="collapseGeneralSetup_04">
                <div class="card card-body">
                    <p class="fs-12">
                        {{ translate('Enabling guest checkout allows customers to place orders without creating an account, making the checkout process faster. You can also allow automatic account creation using guest information to convert guests into registered users.') }}
                    </p>
                </div>
            </div>
        </div>

        <div class="py-3 px-3 bg-light rounded mb-3 mb-sm-20">
            <div class="d-flex gap-3 align-items-center justify-content-between overflow-hidden">
                <button class="btn-collapse d-flex gap-3 align-items-center bg-transparent border-0 p-0 collapsed" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapseGeneralSetup_05" aria-expanded="true">
                    <div class="btn-collapse-icon d-flex align-items-center justify-content-center border icon-btn rounded-circle fs-12 lh-1 collapsed">
                        <i class="fi fi-rr-angle-up"></i>
                    </div>
                    <span class="fw-bold text-start text-dark">{{ translate('Booking Notification') }}</span>
                </button>
            </div>
            <div class="collapse mt-3" id="collapseGeneralSetup_05">
                <div class="card card-body">
                    <p class="fs-12">
                        {{ translate('The Admin Notification Setup for booking allows the administrator to configure how system notifications are sent and managed. Admin notifications can be delivered either manually or through Firebase, depending on the selected configuration') }}
                    </p>
                </div>
            </div>
        </div>

        <div class="py-3 px-3 bg-light rounded mb-3 mb-sm-20">
            <div class="d-flex gap-3 align-items-center justify-content-between overflow-hidden">
                <button class="btn-collapse d-flex gap-3 align-items-center bg-transparent border-0 p-0 collapsed" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapseGeneralSetup_06" aria-expanded="true">
                    <div class="btn-collapse-icon d-flex align-items-center justify-content-center border icon-btn rounded-circle fs-12 lh-1 collapsed">
                        <i class="fi fi-rr-angle-up"></i>
                    </div>
                    <span class="fw-bold text-start text-dark">{{ translate('Copyright & Cookies Text') }}</span>
                </button>
            </div>
            <div class="collapse mt-3" id="collapseGeneralSetup_06">
                <div class="card card-body">
                    <h5 class="mb-2">{{ translate('Copyright text') }}</h5>
                    <p class="fs-12">
                        {{ translate('This is a short statement that shows your company owns the content on your website. It usually includes the copyright symbol (©), the year, and your company name.') }}
                    </p>
                    <h5 class="mb-2">{{ translate('Cookies text') }}</h5>
                    <p class="fs-12">
                        {{ translate('This is a short message shown on the website to let visitors know that the site uses cookies to collect information and improve their browsing experience') }}
                    </p>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Guidline Offcanvas for business plan-->
<div class="offcanvas offcanvas-cus-sm offcanvas-end" tabindex="-1" id="offcanvasSetupGuideForBusinessPlan" aria-labelledby="offcanvasSetupGuideForBusinessPlanLabel">
    <div class="offcanvas-header bg-light p-20">
        <h3 class="mb-0">{{ translate('Set up Business Plan Guideline') }}</h3>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-20 bg-white">
        <div class="py-3 px-3 bg-light rounded mb-3 mb-sm-20">
            <div class="d-flex gap-3 align-items-center justify-content-between overflow-hidden">
                <button class="btn-collapse d-flex gap-3 align-items-center bg-transparent border-0 p-0" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapseGeneralSetup_01" aria-expanded="true">
                    <div class="btn-collapse-icon d-flex align-items-center justify-content-center border icon-btn rounded-circle fs-12 lh-1">
                        <i class="fi fi-rr-angle-up"></i>
                    </div>
                    <span class="fw-bold text-start text-dark">{{ translate('Business Model') }}</span>
                </button>
            </div>
            <div class="collapse mt-3 show" id="collapseGeneralSetup_01">
                <div class="card card-body">
                    <h5 class="mb-2">{{ translate('Subscription Based') }}</h5>
                    <p class="fs-12">
                        {{ translate('A subscription-based business model allows providers to access specific features, services, or system functionalities by paying a recurring fee (monthly, quarterly, or yearly). Instead of one-time payments, users remain active as long as their subscription is valid.') }}
                    </p>
                    <h5 class="mb-2">{{ translate('Commission Based') }}</h5>
                    <p class="fs-12">
                        {{ translate('A commission-based business model allows the platform to earn revenue by charging a predefined percentage amount from each successful transaction completed through the system. The commission is automatically deducted from the order value before the remaining amount is settled with the vendor or service provider.') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Guidline Offcanvas for google map-->
<div class="offcanvas offcanvas-cus-sm offcanvas-end" tabindex="-1" id="offcanvasSetupGuideForGoogleMap" aria-labelledby="offcanvasSetupGuideForGoogleMapLabel">
    <div class="offcanvas-header bg-light p-20">
        <h3 class="mb-0">{{ translate('Setup Google Map Configuration Guideline') }}</h3>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-20 bg-white">
        <div class="py-3 px-3 bg-light rounded mb-3 mb-sm-20">
            <div class="d-flex gap-3 align-items-center justify-content-between overflow-hidden">
                <button class="btn-collapse d-flex gap-3 align-items-center bg-transparent border-0 p-0" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapseGeneralSetup_01" aria-expanded="true">
                    <div class="btn-collapse-icon d-flex align-items-center justify-content-center border icon-btn rounded-circle fs-12 lh-1">
                        <i class="fi fi-rr-angle-up"></i>
                    </div>
                    <span class="fw-bold text-start text-dark">{{ translate('Google Map API') }}</span>
                </button>
            </div>
            <div class="collapse mt-3 show" id="collapseGeneralSetup_01">
                <div class="card card-body">
                    <p class="fs-12">
                        {{ translate('This section is used to configure Google Map integration for your system. To enable map-based features such as location selection, serviceman tracking, and distance calculation, you must provide valid Google Map API keys.') }}
                    </p>
                    <p class="fs-12">
                        {{ translate('Use the Server API Key to enable Place API access for backend services, and the Client API Key to enable the Maps JavaScript API for frontend usage.') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Guidline Offcanvas for email configuration-->
<div class="offcanvas offcanvas-cus-sm offcanvas-end" tabindex="-1" id="offcanvasSetupGuideForEmailConfiguration" aria-labelledby="offcanvasSetupGuideForEmailConfigurationLabel">
    <div class="offcanvas-header bg-light p-20">
        <h3 class="mb-0">{{ translate('Setup Email Configuration Guideline') }}</h3>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-20 bg-white">
        <div class="py-3 px-3 bg-light rounded mb-3 mb-sm-20">
            <div class="d-flex gap-3 align-items-center justify-content-between overflow-hidden">
                <button class="btn-collapse d-flex gap-3 align-items-center bg-transparent border-0 p-0" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapseGeneralSetup_01" aria-expanded="true">
                    <div class="btn-collapse-icon d-flex align-items-center justify-content-center border icon-btn rounded-circle fs-12 lh-1">
                        <i class="fi fi-rr-angle-up"></i>
                    </div>
                    <span class="fw-bold text-start text-dark">{{ translate('SMTP Mail Configuration') }}</span>
                </button>
            </div>
            <div class="collapse mt-3 show" id="collapseGeneralSetup_01">
                <div class="card card-body">
                    <p class="fs-12">
                        {{ translate('This section allows you to configure SMTP email settings so the system can send emails reliably. By providing valid SMTP credentials, the platform can deliver system notifications, OTPs, password reset emails, booking updates, and other automated messages.') }}
                    </p>
                    <p class="fs-12">
                        {{ translate('Enter the mailer name, SMTP host, port, encryption type, username, password, and sender email address based on your email service provider. Once configured, use the Send Test Mail option to verify that emails are working correctly.') }}
                    </p>
                    <h5 class="mb-2">{{ translate('Note') }}</h5>
                    <p class="fs-12">
                        {{ translate('If SMTP configuration is disabled or incorrect, the system will not be able to send any email notifications.') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Guidline Offcanvas for notification configuration-->
<div class="offcanvas offcanvas-cus-sm offcanvas-end" tabindex="-1" id="offcanvasSetupGuideForNotificationConfiguration" aria-labelledby="offcanvasSetupGuideForNotificationConfigurationLabel">
    <div class="offcanvas-header bg-light p-20">
        <h3 class="mb-0">{{ translate('Setup Notification Configuration Guideline') }}</h3>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-20 bg-white">
        <div class="py-3 px-3 bg-light rounded mb-3 mb-sm-20">
            <div class="d-flex gap-3 align-items-center justify-content-between overflow-hidden">
                <button class="btn-collapse d-flex gap-3 align-items-center bg-transparent border-0 p-0" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapseGeneralSetup_01" aria-expanded="true">
                    <div class="btn-collapse-icon d-flex align-items-center justify-content-center border icon-btn rounded-circle fs-12 lh-1">
                        <i class="fi fi-rr-angle-up"></i>
                    </div>
                    <span class="fw-bold text-start text-dark">{{ translate('Firebase Configuration') }}</span>
                </button>
            </div>
            <div class="collapse mt-3 show" id="collapseGeneralSetup_01">
                <div class="card card-body">
                    <p class="fs-12">
                        {{ translate('Firebase Configuration is required to enable push notifications, real-time services, and authentication support in your system. This setup connects your application with your Firebase project using official credentials provided by Google.') }}
                    </p>
                    <h5 class="mb-2">{{ translate('Important') }}</h5>
                    <p class="fs-12">
                        {{ translate('Firebase must be configured first before enabling Firebase Authentication. Without this setup, Firebase-based features will not work properly.') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Guidline Offcanvas for login option-->
<div class="offcanvas offcanvas-cus-sm offcanvas-end" tabindex="-1" id="offcanvasSetupGuideForLoginOption" aria-labelledby="offcanvasSetupGuideForLoginOptionLabel">
    <div class="offcanvas-header bg-light p-20">
        <h3 class="mb-0">{{ translate('Explore Login Option Setup Guideline') }}</h3>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-20 bg-white">
        <div class="py-3 px-3 bg-light rounded mb-3 mb-sm-20">
            <div class="d-flex gap-3 align-items-center justify-content-between overflow-hidden">
                <button class="btn-collapse d-flex gap-3 align-items-center bg-transparent border-0 p-0" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapseGeneralSetup_01" aria-expanded="true">
                    <div class="btn-collapse-icon d-flex align-items-center justify-content-center border icon-btn rounded-circle fs-12 lh-1">
                        <i class="fi fi-rr-angle-up"></i>
                    </div>
                    <span class="fw-bold text-start text-dark">{{ translate('Choose How to Login') }}</span>
                </button>
            </div>
            <div class="collapse mt-3 show" id="collapseGeneralSetup_01">
                <div class="card card-body">
                    <p class="fs-12">
                        {{ translate('Select at least one login method to allow customers to access the system.') }}
                    </p>
                    <h5 class="mb-2">{{ translate('Manual Login') }}</h5>
                    <p class="fs-12">
                        {{ translate('Customers can sign up and log in using their credentials (email/phone and password).') }}
                    </p>
                    <h5 class="mb-2">{{ translate('OTP Login') }}</h5>
                    <p class="fs-12">
                        {{ translate('Customers can log in using a one-time password sent to their phone number. Requires SMS Gateway setup to be configured first.') }}
                    </p>
                    <h5 class="mb-2">{{ translate('Social Media Login') }}</h5>
                    <p class="fs-12">
                        {{ translate('Customers can log in using their social media accounts, such as Google or Facebook. At least one login method must remain enabled.') }}
                    </p>
                </div>
            </div>
        </div>
        <div class="py-3 px-3 bg-light rounded mb-3 mb-sm-20">
            <div class="d-flex gap-3 align-items-center justify-content-between overflow-hidden">
                <button class="btn-collapse d-flex gap-3 align-items-center bg-transparent border-0 p-0" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapseGeneralSetup_02" aria-expanded="true">
                    <div class="btn-collapse-icon d-flex align-items-center justify-content-center border icon-btn rounded-circle fs-12 lh-1">
                        <i class="fi fi-rr-angle-up"></i>
                    </div>
                    <span class="fw-bold text-start text-dark">{{ translate('Social Media') }}</span>
                </button>
            </div>
            <div class="collapse mt-3" id="collapseGeneralSetup_02">
                <div class="card card-body">
                    <p class="fs-12">
                        {{ translate('Enable social platforms that customers can use to log in.') }}
                    </p>
                    <h5 class="mb-2">{{ translate('Google Login') }}</h5>
                    <p class="fs-12">
                        {{ translate('Log in using Google email credentials') }}
                    </p>
                    <h5 class="mb-2">{{ translate('Facebook Login') }}</h5>
                    <p class="fs-12">
                        {{ translate('Log in using Google facebook credentials') }}
                    </p>
                    <h5 class="mb-2">{{ translate('Apple Login') }}</h5>
                    <p class="fs-12">
                        {{ translate('Available only for Apple devices') }}
                    </p>
                    <p class="fs-12">
                        {{ translate('Click “Connect 3rd party login system” to configure social login credentials.') }}
                    </p>
                    <p class="fs-12">
                        {{ translate('At least one social media option must remain active if social login is enabled.') }}
                    </p>
                </div>
            </div>
        </div>
        <div class="py-3 px-3 bg-light rounded mb-3 mb-sm-20">
            <div class="d-flex gap-3 align-items-center justify-content-between overflow-hidden">
                <button class="btn-collapse d-flex gap-3 align-items-center bg-transparent border-0 p-0" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapseGeneralSetup_03" aria-expanded="true">
                    <div class="btn-collapse-icon d-flex align-items-center justify-content-center border icon-btn rounded-circle fs-12 lh-1">
                        <i class="fi fi-rr-angle-up"></i>
                    </div>
                    <span class="fw-bold text-start text-dark">{{ translate('Verification') }}</span>
                </button>
            </div>
            <div class="collapse mt-3" id="collapseGeneralSetup_03">
                <div class="card card-body">
                    <p class="fs-12">
                        {{ translate('Choose how customers verify their identity during signup.') }}
                    </p>
                    <h5 class="mb-2">{{ translate('Email Verification') }}</h5>
                    <p class="fs-12">
                        {{ translate('Customers receive a verification code via email.') }}
                    </p>
                    <h5 class="mb-2">{{ translate('Phone Number Verification') }}</h5>
                    <p class="fs-12">
                        {{ translate('Customers receive an OTP on their phone number.') }}
                    </p>
                </div>
            </div>
        </div>


    </div>
</div>

<!-- Guidline Offcanvas for payment method-->
<div class="offcanvas offcanvas-cus-sm offcanvas-end" tabindex="-1" id="offcanvasSetupGuideForPaymentMethod" aria-labelledby="offcanvasSetupGuideForPaymentMethodLabel">
    <div class="offcanvas-header bg-light p-20">
        <h3 class="mb-0">{{ translate('Setup Payments Guideline') }}</h3>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-20 bg-white">
        <div class="py-3 px-3 bg-light rounded mb-3 mb-sm-20">
            <div class="d-flex gap-3 align-items-center justify-content-between overflow-hidden">
                <button class="btn-collapse d-flex gap-3 align-items-center bg-transparent border-0 p-0" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapseGeneralSetup_01" aria-expanded="true">
                    <div class="btn-collapse-icon d-flex align-items-center justify-content-center border icon-btn rounded-circle fs-12 lh-1">
                        <i class="fi fi-rr-angle-up"></i>
                    </div>
                    <span class="fw-bold text-start text-dark">{{ translate('Digital Payment Methods') }}</span>
                </button>
            </div>
            <div class="collapse mt-3 show" id="collapseGeneralSetup_01">
                <div class="card card-body">
                    <p class="fs-12">
                        {{ translate('A digital payment method is a way to pay or receive money electronically without using cash') }}
                    </p>
                    <p class="fs-12">
                        {{ translate('How to Set Up & Use - choose the digital payment method you want to use, enter the required provider details (like API or merchant info), turn it on, and save to activate it for customers.') }}
                    </p>
                </div>
            </div>
        </div>
        <div class="py-3 px-3 bg-light rounded mb-3 mb-sm-20">
            <div class="d-flex gap-3 align-items-center justify-content-between overflow-hidden">
                <button class="btn-collapse d-flex gap-3 align-items-center bg-transparent border-0 p-0" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapseGeneralSetup_02" aria-expanded="true">
                    <div class="btn-collapse-icon d-flex align-items-center justify-content-center border icon-btn rounded-circle fs-12 lh-1">
                        <i class="fi fi-rr-angle-up"></i>
                    </div>
                    <span class="fw-bold text-start text-dark">{{ translate('Offline Payment') }}</span>
                </button>
            </div>
            <div class="collapse mt-3" id="collapseGeneralSetup_02">
                <div class="card card-body">
                    <p class="fs-12">
                        {{ translate('An offline payment method allows customers to pay manually after booking placement, and the admin confirms the payment late') }}
                    </p>
                    <p class="fs-12">
                        {{ translate('How to Set Up & Use - Add the Offline Payment Method to the list by entering the method name & required information, and enable it, and saving it to make it available for use.') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {

        /* ===============================
         * ELEMENTS
         * =============================== */
        const uncheckedStepKeys = @json($uncheckedStepKeys);
        const guideModalEl  = document.getElementById('guideModal');

        const offcanvasMap = {
            business_setup: document.getElementById('offcanvasSetupGuideForBusinessInformation'),
            business_plan: document.getElementById('offcanvasSetupGuideForBusinessPlan'),
            map_api: document.getElementById('offcanvasSetupGuideForGoogleMap'),
            email_config: document.getElementById('offcanvasSetupGuideForEmailConfiguration'),
            firebase_config: document.getElementById('offcanvasSetupGuideForNotificationConfiguration'),
            payment_config: document.getElementById('offcanvasSetupGuideForPaymentMethod'),
            login_option: document.getElementById('offcanvasSetupGuideForLoginOption'),
        };

        /* ===============================
         * CONTEXT FROM BACKEND
         * =============================== */
        const isFirstTimeGuide = {{ $isFirstTimeGuide ? 'true' : 'false' }};
        const allCompleted    = {{ $allCompleted ? 'true' : 'false' }};

        const currentRoute   = "{{ request()->route()->getName() }}";
        const currentWebPage = "{{ request()->query('web_page', '') }}";
        const currentPath    = "{{ request()->path() }}";

        const fromGuide = {{ request()->boolean('from_guide') ? 'true' : 'false' }};

        /* ===============================
         * LOCAL STORAGE
         * =============================== */
        const SKIP_KEY = 'setup_guide_skipped';
        const isSkipped = localStorage.getItem(SKIP_KEY) === '1';

        /* ===============================
         * HELPERS
         * =============================== */
        function cleanupBackdrop() {
            document.querySelectorAll('.modal-backdrop, .offcanvas-backdrop')
                .forEach(el => el.remove());

            document.body.classList.remove('modal-open', 'offcanvas-backdrop');
            document.body.style.removeProperty('overflow');
            document.body.style.removeProperty('padding-right');
        }

        function removeFromGuideParam() {
            const url = new URL(window.location.href);
            if (url.searchParams.has('from_guide')) {
                url.searchParams.delete('from_guide');
                window.history.replaceState({}, document.title, url.pathname + url.search);
            }
        }

        function showOffcanvas(el) {
            if (!el) return false;

            cleanupBackdrop();
            guideModalEl && bootstrap.Modal.getInstance(guideModalEl)?.hide();

            new bootstrap.Offcanvas(el).show();
            removeFromGuideParam();
            return true;
        }

        /* ===============================
         * AUTO OPEN LOGIC
         * =============================== */
        let offcanvasOpened = false;

        if(fromGuide){
            // Business Info
            if (currentRoute === 'admin.business-settings.get-business-information' &&
                currentWebPage === 'business_setup' &&
                uncheckedStepKeys.includes('business_information')) {
                offcanvasOpened = showOffcanvas(offcanvasMap.business_setup);
            }

            // Business Plan
            else if (currentRoute === 'admin.business-settings.get-business-information' &&
                currentWebPage === 'business_plan' &&
                uncheckedStepKeys.includes('business_plan')) {
                offcanvasOpened = showOffcanvas(offcanvasMap.business_plan);
            }

            // Google Map
            else if (currentRoute === 'admin.configuration.third-party' &&
                currentPath.includes('map-api') &&
                uncheckedStepKeys.includes('google_map_configuration')) {
                offcanvasOpened = showOffcanvas(offcanvasMap.map_api);
            }

            // Email
            else if (currentRoute === 'admin.configuration.third-party' &&
                currentPath.includes('email-config') &&
                uncheckedStepKeys.includes('email_configuration')) {
                offcanvasOpened = showOffcanvas(offcanvasMap.email_config);
            }

            // Notification
            else if (currentRoute === 'admin.configuration.third-party' &&
                currentPath.includes('firebase-configuration') &&
                uncheckedStepKeys.includes('notification_configuration')) {
                offcanvasOpened = showOffcanvas(offcanvasMap.firebase_config);
            }

            // Payment
            else if (currentRoute === 'admin.configuration.third-party' &&
                currentPath.includes('payment_config') &&
                uncheckedStepKeys.includes('digital_payment')) {
                offcanvasOpened = showOffcanvas(offcanvasMap.payment_config);
            }

            // Login Option
            else if (currentRoute === 'admin.business-settings.login.setup' &&
                uncheckedStepKeys.includes('login_option')) {
                offcanvasOpened = showOffcanvas(offcanvasMap.login_option);
            }
        }


        /* ===============================
         * GUIDE MODAL (ONLY IF NO OFFCANVAS)
         * =============================== */
        if (!offcanvasOpened && isFirstTimeGuide && !allCompleted && !isSkipped && guideModalEl) {
            cleanupBackdrop();
            new bootstrap.Modal(guideModalEl).show();
            removeFromGuideParam();
        }

        /* ===============================
         * SKIP FOR NOW
         * =============================== */
        document.getElementById('skipSetupGuide')?.addEventListener('click', function () {
            localStorage.setItem(SKIP_KEY, '1');

            const modal = bootstrap.Modal.getInstance(guideModalEl);
            modal?.hide();

            cleanupBackdrop();
        });

        /* ===============================
         * CLEANUP ON CLOSE
         * =============================== */
        guideModalEl?.addEventListener('hidden.bs.modal', cleanupBackdrop);
        Object.values(offcanvasMap).forEach(el => {
            el?.addEventListener('hidden.bs.offcanvas', cleanupBackdrop);
        });

    });

    function refreshSetupGuideUI() {
        fetch('{{ route('admin.setup-guide.status') }}')
            .then(res => res.json())
            .then(data => {

                // Badge count
                const badge = document.getElementById('setupGuideBadge');
                if (badge) {
                    badge.textContent = data.unchecked_count;
                }

                // Percentage
                const percentageEl = document.getElementById('setupGuidePercentage');
                if (percentageEl) {
                    percentageEl.innerHTML = data.percentage;
                }

                // Checkboxes
                Object.values(data.steps).forEach(step => {
                    const checkbox = document.getElementById(`guide-step-${step.key}`);
                    if (checkbox) {
                        checkbox.checked = step.checked === true;
                    }
                });

                // Hide guide completely if done
                if (data.all_completed) {
                    document.querySelector('.setup-guide')?.remove();
                    bootstrap.Modal.getInstance(document.getElementById('guideModal'))?.hide();
                }
            });
    }

</script>
