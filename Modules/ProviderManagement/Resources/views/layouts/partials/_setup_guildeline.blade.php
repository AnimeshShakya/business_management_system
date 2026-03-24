<?php
    $setup = getSetupGuideSteps('provider_panel', auth()->user());
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
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger border border-3 d-center fs-12 fw-semibold text-absolute-white w-h-26 w-max-content"
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
                                <span id="setupGuidePercentage">{{ $percentage }}</span><span class="fs-12 fw-bold text-dark">%</span>
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

<!-- Guidline Offcanvas Btn -->

{{-- Easy Setup Dropdown --}}
<div class="easy-setup-dropdown bg-white p-3 p-sm-20">
    <div class="d-flex justify-content-between align-items-center gap-2 mb-20">
        <h5 class="mb-0"> {{ translate('Easy Setup') }}</h5>
        <button type="button" class="p-0 m-0 border-0 shadow-none text-secondary bg-transparent easy-setup-dropdown_close">
            <span class="border rounded-circle d-flex align-items-center justify-content-center w-24 h-24 fs-14" aria-hidden="true">&times;</span>
        </button>
    </div>

    @php
        $currentRouteToCheckGuideLine = request()->route()->getName();
        $currentWebPageToCheckGuideLine = request()->query('web_page', '');
    @endphp

    {{-- Show only one guideline button per page --}}
    @if($currentRouteToCheckGuideLine === 'provider.business-settings.get-business-information' && $currentWebPageToCheckGuideLine === 'businessinfos')
        <div class="bg-light p-3 p-sm-20 rounded-10 d-flex justify-content-between align-items-center gap-2 mb-20 cursor-pointer"
             data-bs-toggle="offcanvas" data-bs-target="#offcanvasSetupGuideForBusinessInformation">
            <i class="fi fi-sr-book-bookmark"></i>
            <span class="flex-grow-1">{{ translate('See Guideline') }}</span>
            <span class="text-primary cursor-pointer">
                <i class="fi fi-rr-up-right-from-square"></i>
            </span>
        </div>
    @elseif($currentRouteToCheckGuideLine === 'provider.subscription-package.details')
        <div class="bg-light p-3 p-sm-20 rounded-10 d-flex justify-content-between align-items-center gap-2 mb-20 cursor-pointer"
             data-bs-toggle="offcanvas" data-bs-target="#offcanvasSetupGuideForBusinessPlan">
            <i class="fi fi-sr-book-bookmark"></i>
            <span class="flex-grow-1">{{ translate('See Guideline') }}</span>
            <span class="text-primary cursor-pointer">
                <i class="fi fi-rr-up-right-from-square"></i>
            </span>
        </div>
    @elseif($currentRouteToCheckGuideLine === 'provider.business-settings.get-business-information' && $currentWebPageToCheckGuideLine === 'service_availability')
        <div class="bg-light p-3 p-sm-20 rounded-10 d-flex justify-content-between align-items-center gap-2 mb-20 cursor-pointer"
             data-bs-toggle="offcanvas" data-bs-target="#offcanvasSetupGuideForServicevAilability">
            <i class="fi fi-sr-book-bookmark"></i>
            <span class="flex-grow-1">{{ translate('See Guideline') }}</span>
            <span class="text-primary cursor-pointer">
                <i class="fi fi-rr-up-right-from-square"></i>
            </span>
        </div>
    @elseif($currentRouteToCheckGuideLine === 'provider.service.available')
        <div class="bg-light p-3 p-sm-20 rounded-10 d-flex justify-content-between align-items-center gap-2 mb-20 cursor-pointer"
             data-bs-toggle="modal" data-bs-target="#modal-subscribe-gotit">
            <i class="fi fi-sr-book-bookmark"></i>
            <span class="flex-grow-1">{{ translate('See Guideline') }}</span>
            <span class="text-primary cursor-pointer">
                <i class="fi fi-rr-up-right-from-square"></i>
            </span>
        </div>
    @elseif($currentRouteToCheckGuideLine === 'provider.settings.payment-information.index')
        <div class="bg-light p-3 p-sm-20 rounded-10 d-flex justify-content-between align-items-center gap-2 mb-20 cursor-pointer"
             data-bs-toggle="offcanvas" data-bs-target="#offcanvasSetupGuideForPaymentMethod">
            <i class="fi fi-sr-book-bookmark"></i>
            <span class="flex-grow-1">{{ translate('See Guideline') }}</span>
            <span class="text-primary cursor-pointer">
                <i class="fi fi-rr-up-right-from-square"></i>
            </span>
        </div>
    @endif

    <div class="bg-light p-3 p-sm-20 rounded-10">
        <div class="d-flex align-items-center gap-2 mb-20">
            <i class="fi fi-sr-table-layout"></i>
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
                    <span class="fw-bold text-start text-dark">{{ translate('Explore Business Info') }}</span>
                </button>
            </div>
            <div class="collapse mt-3 show" id="collapseGeneralSetup_01">
                <div class="card card-body">
                    <p class="fs-12">
                        <strong>{{ translate('company Name') }}:</strong>
                        {{ translate('The company name often serves as the primary identifier for your business as a legal entity.') }}
                    </p>
                    <p class="fs-12">
                        <strong>{{ translate('Email') }}:</strong>
                        {{ translate('An email system often provides centralised management and archiving of business communication.') }}
                    </p>
                    <p class="fs-12">
                        <strong>{{ translate('Phone') }}:</strong>
                        {{ translate('A phone number provides a direct and immediate way to reach your business for urgent inquiries, support needs, or quick questions.') }}
                    </p>
                    <p class="fs-12">
                        <strong>{{ translate('Zone') }}:</strong>
                        {{ translate('The Zone Selection field helps you select the specific locations from where you provide services.') }}
                    </p>
                    <p class="fs-12">
                        <strong>{{ translate('Address') }}:</strong>
                        {{ translate('This address represents the service location from which, as a provider, you operate and manage customers, services, and service personnel.') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Guidline Offcanvas for business plan-->
<div class="offcanvas offcanvas-cus-sm offcanvas-end" tabindex="-1" id="offcanvasSetupGuideForBusinessPlan" aria-labelledby="offcanvasSetupGuideForBusinessPlanLabel">
    <div class="offcanvas-header bg-light p-20">
        <h3 class="mb-0">{{ translate('Explore Business Plan Guideline') }}</h3>
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
                    <span class="fw-bold text-start text-dark">{{ translate('Billing Summary') }}</span>
                </button>
            </div>
            <div class="collapse mt-3 show" id="collapseGeneralSetup_01">
                <div class="card card-body">
                    <p class="fs-12">
                        {{ translate('This page shows your current subscription details, billing status, and available features.') }}
                    </p>
                    <p class="fs-12">
                        {{ translate('Get a quick overview of your plan status.') }}
                    </p>
                    <p class="fs-12">
                        <strong>{{ translate('Expire Date') }}:</strong>
                        {{ translate('Shows when your current plan will end.') }}
                    </p>
                    <p class="fs-12">
                        <strong>{{ translate('Next Renewal Bill') }}:</strong>
                        {{ translate('Displays the amount to be charged on renewal (VAT included).') }}
                    </p>
                    <p class="fs-12">
                        <strong>{{ translate('Total Subscription Taken') }}:</strong>
                        {{ translate('Total number of subscriptions you have used so far.') }}
                    </p>
                </div>
            </div>
        </div>
        <div class="py-3 px-3 bg-light rounded mb-3 mb-sm-20">
            <div class="d-flex gap-3 align-items-center justify-content-between overflow-hidden">
                <button class="btn-collapse d-flex gap-3 align-items-center bg-transparent border-0 p-0 collapsed" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapseGeneralSetup_02" aria-expanded="true">
                    <div class="btn-collapse-icon d-flex align-items-center justify-content-center border icon-btn rounded-circle fs-12 lh-1 collapsed">
                        <i class="fi fi-rr-angle-up"></i>
                    </div>
                    <span class="fw-bold text-start text-dark">{{ translate('Billing Package Overview') }}</span>
                </button>
            </div>
            <div class="collapse mt-3" id="collapseGeneralSetup_02">
                <div class="card card-body">
                    <p class="fs-12">
                        {{ translate('View details of your active business plan.') }}
                    </p>
                    <p class="fs-12">
                        <strong>{{ translate('Plan Nam') }}:</strong>
                        {{ translate('Displays your current plan (e.g., Basic Plan).') }}
                    </p>
                    <p class="fs-12">
                        <strong>{{ translate('Plan Description') }}:</strong>
                        {{ translate('summary of what the plan offers.') }}
                    </p>
                    <p class="fs-12">
                        <strong>{{ translate('Price & Duration') }}:</strong>
                        {{ translate('Shows the plan cost and total duration, along with remaining days.') }}
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
                    <span class="fw-bold text-start text-dark">{{ translate('Included Features') }}</span>
                </button>
            </div>
            <div class="collapse mt-3" id="collapseGeneralSetup_03">
                <div class="card card-body">
                    <p class="fs-12">
                        {{ translate('See what services and limits are included in your plan') }}
                    </p>
                    <ul>
                        <li>{{ translate('Mobile App access') }}</li>
                        <li>{{ translate('Reviews') }}</li>
                        <li>{{ translate('Service Scheduling') }}</li>
                        <li>{{ translate('Bidding') }}</li>
                        <li>{{ translate('Booking limits (used vs remaining)') }}</li>
                        <li>{{ translate('Service sub-category limits') }}</li>
                    </ul>
                    <p class="fs-12">
                        {{ translate('The remaining count updates automatically as you use services. And an option to change, renew, or change the subscription plan') }}
                    </p>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Guidline modal for subscribe services -->
<div class="modal fade" id="modal-subscribe-gotit" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="text-end m-2">
                <button type="button" class="btn-close fs-10 position-static" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-4 pb-4 pt-0">
                <div class="mb-4 pb-xl-1">
                    <h4 class="text-center fs-18 mb-2">{{ translate('Subscribe a Service') }} !</h4>
                    <p class="text-center fs-14 max-w500 mx-auto">{{ translate('Please subscribe to your preferred service. Otherwise, you won’t get any booking request for provide service.') }}</p>
                </div>

                <div class="ms--auto max-w-500px">
                    <div class="service-list-item max-w-250">
                        <div class="service-img">
                            <a>
                                <img src="{{ asset('public/assets/provider-module/img/basic-painting.png') }}" alt="{{translate('image')}}">
                            </a>
                        </div>
                        <div class="service-content">
                            <div class="service-title pb-4">
                                {{translate('Basic Painting Service ')}}
                            </div>
                            <div class="service-actions">
                                <div class="text-capitalize text-hover-theme text-primary">
                                    <strong>3 </strong>{{translate('services')}}
                                </div>

                                <button type="button" class="btn btn--primary">
                                    {{translate('subscribe')}}
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="boxes-wrap max-w-353px mt-2">
                        <div class="gotit-box text-center pe-12 pt-12 mb-3">
                            <p class="fs-14 text-dark pe-3 mb-12">
                                {{ translate('Click on the “Subscribe” button on the services list to subscribe and get service request from customer.') }}
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Guidline Offcanvas for payment method-->
<div class="offcanvas offcanvas-cus-sm offcanvas-end" tabindex="-1" id="offcanvasSetupGuideForPaymentMethod" aria-labelledby="offcanvasSetupGuideForPaymentMethodLabel">
    <div class="offcanvas-header bg-light p-20">
        <h3 class="mb-0">{{ translate('Setup Payment Info Guideline') }}</h3>
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
                    <span class="fw-bold text-start text-dark">{{ translate('Payment Information') }}</span>
                </button>
            </div>
            <div class="collapse mt-3 show" id="collapseGeneralSetup_01">
                <div class="card card-body">
                    <p class="fs-12">
                        {{ translate('On this page, providers can set up payment information for their listed payment methods, enabling them to manage withdrawals with the admin.') }}
                    </p>
                    <p class="fs-12">
                        {{ translate('Use the Add Payment Method option to add a new method to the list.') }}
                    </p>
                    <p class="fs-12">
                        {{ translate('From the list, you can activate or deactivate methods for withdrawals.') }}
                    </p>
                    <p class="fs-12">
                        {{ translate('You can also mark a method as default, update its information, or remove it if necessary.') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Guidline Offcanvas for service availability-->
<div class="offcanvas offcanvas-cus-sm offcanvas-end" tabindex="-1" id="offcanvasSetupGuideForServicevAilability" aria-labelledby="offcanvasSetupGuideForServicevAilabilityLabel">
    <div class="offcanvas-header bg-light p-20">
        <h3 class="mb-0">{{ translate('Service availability Guideline') }}</h3>
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
                    <span class="fw-bold text-start text-dark">{{ translate('Explore Service availability') }}</span>
                </button>
            </div>
            <div class="collapse mt-3 show" id="collapseGeneralSetup_01">
                <div class="card card-body">
                    <p class="fs-12">
                        {{ translate('On this page, providers can manage their Service Availability.') }}
                    </p>
                    <ul>
                        <li>{{ translate('Enable this option to make yourself available for providing services.') }}</li>
                        <li>{{ translate('Schedule your service hours for each day.') }}</li>
                        <li>{{ translate('Select your weekend days from the multi-select weekend days option.') }}</li>
                    </ul>
                    <p class="fs-12">
                        <strong>{{ translate('Note') }}:</strong>
                        {{ translate('Based on your setup, customers can view your availability.') }}
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
            business_info: document.getElementById('offcanvasSetupGuideForBusinessInformation'),
            business_plan: document.getElementById('offcanvasSetupGuideForBusinessPlan'),
            service_availability: document.getElementById('offcanvasSetupGuideForServicevAilability'),
            payment_method: document.getElementById('offcanvasSetupGuideForPaymentMethod'),
            subscribe_services: document.getElementById('modal-subscribe-gotit'),
        };

        /* ===============================
         * CONTEXT FROM BACKEND
         * =============================== */
        const isFirstTimeGuide = {{ $isFirstTimeGuide ? 'true' : 'false' }};
        const allCompleted     = {{ $allCompleted ? 'true' : 'false' }};

        const currentRoute   = "{{ request()->route()->getName() }}";
        const currentWebPage = "{{ request()->query('web_page', '') }}";
        const currentPath    = "{{ request()->path() }}";

        const fromGuide = {{ request()->boolean('from_guide') ? 'true' : 'false' }};

        /* ===============================
         * LOCAL STORAGE
         * =============================== */
        const SKIP_KEY = 'provider_setup_guide_skipped';
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
         * AUTO OPEN OFFCANVAS LOGIC
         * Only if step is unchecked
         * =============================== */
        let offcanvasOpened = false;

        if(fromGuide){
            // Business Info
            if (currentRoute === 'provider.business-settings.get-business-information' &&
                uncheckedStepKeys.includes('business_information') &&
                currentWebPage === 'businessinfos') {
                offcanvasOpened = showOffcanvas(offcanvasMap.business_info);
            }

            // Business Plan
            else if (currentRoute === 'provider.subscription-package.details' &&
                uncheckedStepKeys.includes('business_plan')) {
                offcanvasOpened = showOffcanvas(offcanvasMap.business_plan);
            }

            // Service Availability
            else if (currentRoute === 'provider.business-settings.get-business-information' &&
                uncheckedStepKeys.includes('service_availability') &&
                currentWebPage === 'service_availability') {
                offcanvasOpened = showOffcanvas(offcanvasMap.service_availability);
            }

            // Payment Method
            else if (currentRoute === 'provider.settings.payment-information.index' &&
                uncheckedStepKeys.includes('payment_information')) {
                offcanvasOpened = showOffcanvas(offcanvasMap.payment_method);
            }

            // Subscribe Services
            else if (currentRoute === 'provider.service.available' &&
                uncheckedStepKeys.includes('subscribe_services') &&
                offcanvasMap.subscribe_services) {
                new bootstrap.Modal(offcanvasMap.subscribe_services).show();
                removeFromGuideParam();
                offcanvasOpened = true;
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
        fetch('{{ route('provider.setup-guide.status') }}')
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






