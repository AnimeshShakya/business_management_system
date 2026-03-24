@extends('adminmodule::layouts.new-master')

@section('title',translate('business_setup'))

@push('css_or_js')
    <link rel="stylesheet" href="{{asset('public/assets/new/admin-module')}}/plugins/select2/select2.min.css"/>
    <link rel="stylesheet" href="{{asset('public/assets/new/admin-module')}}/plugins/dataTables/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="{{asset('public/assets/new/admin-module')}}/plugins/dataTables/select.dataTables.min.css"/>


    <link rel="stylesheet" href="{{asset('public/assets/new/admin-module/plugins/swiper/swiper-bundle.min.css')}}">
@endpush

@section('content')
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between">
                        <div class="page-title-wrap mb-3">
                            <h2 class="page-title">{{translate('business_setup')}}</h2>
                        </div>
                    </div>

                    <div class="mb-3 nav-tabs-responsive position-relative">
                        <ul class="nav nav--tabs scrollbar-w flex-nowrap white-nowrap overflow-x-auto flex-wrap-nowrap nav--tabs__style2">
                            <li class="nav-item">
                                <a href="{{url()->current()}}?web_page=business_setup"
                                   class="nav-link {{$webPage=='business_setup'?'active':''}}">
                                    {{translate('Business info')}}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url()->current()}}?web_page=payment"
                                   class="nav-link {{$webPage=='payment'?'active':''}}">
                                    {{translate('Payment')}}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url()->current()}}?web_page=bookings"
                                   class="nav-link {{$webPage=='bookings'?'active':''}}">
                                    {{translate('bookings')}}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url()->current()}}?web_page=providers"
                                   class="nav-link {{$webPage=='providers'?'active':''}}">
                                    {{translate('providers')}}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url()->current()}}?web_page=customers"
                                   class="nav-link {{$webPage=='customers'?'active':''}}">
                                    {{translate('customers')}}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url()->current()}}?web_page=servicemen"
                                   class="nav-link {{$webPage=='servicemen'?'active':''}}">
                                    {{translate('servicemen')}}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url()->current()}}?web_page=promotional_setup"
                                   class="nav-link {{$webPage=='promotional_setup'?'active':''}}">
                                    {{translate('Promotions')}}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url()->current()}}?web_page=business_plan"
                                   class="nav-link {{$webPage=='business_plan'?'active':''}}">
                                    {{translate('Business_Plan')}}
                                </a>
                            </li>
                        </ul>
                        <div class="nav--tab__prev position-absolute top-0 start-3">
                            <button class="border-0 w-38 h-38 d-flex align-items-center justify-content-center rounded-full p-0 bg-white text-primary">
                                <span class="material-symbols-outlined">
                                    arrow_back_ios
                                </span>
                            </button>
                        </div>
                        <div class="nav--tab__next position-absolute top-0 right-3">
                            <button class="border-0 w-38 h-38 d-flex align-items-center justify-content-center rounded-full p-0 bg-white text-primary">
                                <span class="material-symbols-outlined">
                                    arrow_forward_ios
                                </span>
                            </button>
                        </div>
                    </div>

                    <!-- Business Info--->
                    @if($webPage=='business_setup')
                        <div class="tab-content">
                            <div class="tab-pane fade {{$webPage=='business_setup'?'active show':''}}">
                                <div class="card mb-3">
                                    <div class="card-body">
                                            <?php
                                                $config = (int)((business_config('maintenance_mode', 'maintenance_mode'))?->live_values) ?? 0;
                                                $selectedMaintenanceSystem = ((business_config('maintenance_system_setup', 'maintenance_mode'))?->live_values) ?? [];
                                                $selectedMaintenanceDuration = ((business_config('maintenance_duration_setup', 'maintenance_mode'))?->live_values) ?? [];

                                                if (isset($selectedMaintenanceDuration['start_date']) && isset($selectedMaintenanceDuration['end_date'])) {
                                                    $startDate = new DateTime($selectedMaintenanceDuration['start_date']);
                                                    $endDate = new DateTime($selectedMaintenanceDuration['end_date']);
                                                } else {
                                                    $startDate = null;
                                                    $endDate = null;
                                                }
                                            ?>

                                        <div class="d-flex flex-wrap gap-3 justify-content-between align-items-center">
                                            <div>
                                                @if($config)
                                                    <h4 class="">
                                                        {{translate('System Maintenance')}}
                                                    </h4>
                                                    <div class="d-flex flex-wrap gap-3 align-items-center">
                                                            <p class="fz-12 mb-0 maintainance-text-button">
                                                                <span>
                                                                    {{ translate('Your maintenance mode is activated') }}
                                                                    @if(isset($selectedMaintenanceDuration['maintenance_duration']) && $selectedMaintenanceDuration['maintenance_duration'] == 'until_change')
                                                                        {{ translate(' until I change') }}
                                                                    @endif
                                                                    @if($startDate && $endDate)
                                                                        {{translate('from ')}}<strong>{{ $startDate->format('m/d/Y, h:i A') }}</strong> to <strong>{{ $endDate->format('m/d/Y, h:i A') }}</strong>.
                                                                    @endif
                                                                </span>
                                                                <a class="action-btn btn--primary edit square-btn maintenance-mode-show border-0 outline-0 shadow-none d-inline-flex" href="#"><span class="material-icons">edit</span></a>
                                                            </p>
                                                        </div>
                                                @else
                                                    <h4 class="mb-lg-2 mb-1">
                                                        {{translate('System Maintenance')}}
                                                    </h4>
                                                    <p class="fz-12 max-w-570">{{ translate('Turn on the Maintenance Mode will temporarily deactivate your selected systems as of your chosen date and time.') }}</p>
                                                @endif

                                                @if($config && count($selectedMaintenanceSystem) > 0)
                                                    <div class="d-flex flex-wrap gap-3 mt-3 align-items-center">
                                                        <h6 class="mb-0">
                                                            {{ translate('Selected Systems') }}
                                                        </h6>
                                                        <ul class="selected-systems d-flex flex-wrap bg-soft-dark px-4 py-2 mb-0 rounded fs-12">
                                                            @foreach($selectedMaintenanceSystem as $system)
                                                                <li>{{ ucwords(str_replace('_', ' ', $system)) }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif

                                            </div>
                                            @can('business_manage_status')
                                                <div class="w-100 max-w320">
                                                    <div class="d-flex justify-content-between align-items-center border rounded px-3 py-lg-3 py-2">
                                                        <h5 class="mb-0 fw-normal">{{translate('maintenance_mode')}}</h5>
                                                        <label class="switcher ml-auto mb-0">
                                                            <input type="checkbox" class="switcher_input {{ $config ? 'route-alert-reload' : 'maintenance-mode-show' }}"
                                                                   data-route="{{route('admin.business-settings.maintenance-mode-status-update')}}"
                                                                   data-message="{{translate('want_to_update_maintenance_mode_status')}}"
                                                                   id="maintenance-mode-input"
                                                                {{ $config ? 'checked' : '' }}>
                                                            <span class="switcher_control"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            @endcan
                                        </div>
                                    </div>
                                </div>
                                <form action="javascript:void(0)" method="POST" id="business-info-update-form">
                                    @csrf
                                    @method('PUT')
                                    <div class="card mb-3">
                                        <div class="border-bottom px-4 py-3">
                                            <h4 class="mb-1">
                                                {{translate('Basic Information')}}
                                            </h4>
                                            <p class="fz-12">{{ translate('For Start business input the basic info about the business like Business Name, Email, Phone number etc.') }}</p>
                                        </div>
                                        <input type="hidden" name="web_page" value="business_information">

                                        <div class="card-body p-30">
                                            <div class="discount-type">
                                                <div class="row mb-4">
                                                    <div class="col-xxl-9 col-md-8">
                                                        <div class="cus-shadow rounded p-20">
                                                            <div class="row g-3">
                                                                <div class="col-md-6">
                                                                    <div class="form-business">
                                                                        <label class="mb-2 text-dark">{{translate('business_name')}} <span class="text-danger">*</span></label>
                                                                        <input type="text" class="form-control"
                                                                               name="business_name"
                                                                               placeholder="{{translate('Type your business name')}} *"
                                                                               required
                                                                               value="{{$dataValues->where('key_name','business_name')->first()->live_values}}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-business">
                                                                        <label class="mb-2 text-dark">{{translate('email')}} <span class="text-danger">*</span></label>
                                                                        <input type="email" class="form-control"
                                                                               name="business_email"
                                                                               placeholder="{{translate('Type your email')}} *"
                                                                               required
                                                                               value="{{$dataValues->where('key_name','business_email')->first()->live_values}}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-business phone-picker-wrap">
                                                                        <label class="mb-2 text-dark">{{translate('Phone')}} <span class="text-danger">*</span></label>
                                                                        <input type="tel" class="form-control"
                                                                               name="business_phone"
                                                                               placeholder="{{translate('Enter your number')}} *"
                                                                               required="" id="business_phone"
                                                                               value="{{$dataValues->where('key_name','business_phone')->first()->live_values}}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-business">
                                                                        <label class="mb-2 text-dark">{{translate('Country')}} <span class="text-danger">*</span></label>
                                                                        @php($countryCode=$dataValues->where('key_name','country_code')->first()->live_values)
                                                                        <select class="js-select current-black-color theme-input-style w-100" name="country_code">
                                                                            <option value="0" selected disabled>{{translate('---Select_Country---')}}</option>
                                                                            @foreach(COUNTRIES as $country)
                                                                                <option value="{{$country['code']}}" {{$countryCode==$country['code']?'selected':''}}>
                                                                                    {{$country['name']}}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-business">
                                                                        <label class="mb-2 text-dark">{{translate('address')}} <span class="text-danger">*</span>
                                                                            <i class="fi fi-sr-info fz-14 text-muted" data-bs-toggle="tooltip"
                                                                               data-bs-placement="top"
                                                                               title="{{translate('An address is legally required in every country and builds trust with your customers online')}}"
                                                                            ></i>
                                                                        </label>
                                                                        <textarea class="form-control" rows="1" name="business_address" id="business_address" placeholder="{{translate('Ex : House#38, Road#04, Demo City')}} *" required>{{$dataValues->where('key_name','business_address')->first()->live_values}}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12" id="location_map_div">
                                                                    <input id="pac-input" class="controls form-control pac-input-middle w-auto rounded" data-toggle="tooltip"
                                                                           data-placement="right"
                                                                           data-original-title="{{ translate('search_your_location_here') }}"
                                                                           type="text" placeholder="{{ translate('search_here') }}" />
                                                                    <div id="location_map_canvas" class="overflow-hidden rounded h-100"></div>
                                                                </div>

                                                                <input type="hidden" name="address_latitude" id="address_latitude" value="{{$addressLat}}">
                                                                <input type="hidden" name="address_longitude" id="address_longitude" value="{{$addressLong}}">
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="col-xxl-3 col-md-4">
                                                        <div class="card2 rounded p-20 mb-15">
                                                            <h5 class="fz-16 mb-1">{{ translate('Upload Logo') }}</h5>
                                                            <p class="fz-12">{{ translate('Upload your business logo') }}</p>
                                                            <div class="custom-upload-wrapper upload-group image-upload-wrap1">
                                                                <input type="file" id="imageUpload" name="business_logo"
                                                                       accept=".{{ implode(',.', array_column(IMAGEEXTENSION, 'key')) }}, |image/*"
                                                                       data-maxFileSize="{{ readableUploadMaxFileSize('image') }}">
                                                                <label for="imageUpload" class="upload-box rounded position-relative d-flex align-items-center justify-content-center text-center overflow-hidden bg-white">
                                                                    <div class="upload-content">
                                                                        <img src="{{ $businessLogoFullPath }}" alt="placeholder" class="placeholder-icon mb-2">
                                                                        <h6 class="fz-10 text-primary">{{ translate('Click to upload') }}<br> <span class="text-dark d-block mt-1">{{ translate('Or drag and drop') }}</span> </h6>
                                                                    </div>
                                                                    <img class="image-preview" src="" alt="Preview" />
                                                                    <div class="upload-overlay">
                                                                        <span class="material-symbols-outlined">photo_camera</span>
                                                                    </div>
                                                                </label>
                                                            </div>
                                                            <p class="fz-12 mt-2 text-center">
                                                                {{ translate('Image format')}} - {{ implode(', ', array_column(IMAGEEXTENSION, 'key')) }}
                                                                {{ translate("Image Size") }} - {{ translate('maximum size') }} {{ readableUploadMaxFileSize('image') }}
                                                                {{ translate('Image Ratio') }} - 3:1
                                                            </p>
                                                        </div>
                                                        <div class="card2 rounded p-20">
                                                            <h5 class="fz-16 mb-1">{{ translate('Favicon') }}</h5>
                                                            <p class="fz-12">{{ translate('Upload your website favicon') }}</p>
                                                            <div class="custom-upload-wrapper upload-group mx-auto image-upload-wrap2">
                                                                <input type="file" id="imageUpload2" name="business_favicon"
                                                                       accept=".{{ implode(',.', array_column(IMAGEEXTENSION, 'key')) }}, |image/*"
                                                                       data-maxFileSize="{{ readableUploadMaxFileSize('image') }}">
                                                                <label for="imageUpload2" class="upload-box rounded position-relative d-flex align-items-center justify-content-center text-center overflow-hidden bg-white">
                                                                    <div class="upload-content">
                                                                        <img src="{{ $businessFaviconFullPath }}" alt="placeholder" class="placeholder-icon mb-2">
                                                                        <h6 class="fz-10 text-primary">{{ translate('Click to upload') }}<br> <span class="text-dark d-block mt-1">{{ translate('Or drag and drop') }}</span> </h6>
                                                                    </div>
                                                                    <img class="image-preview" src="" alt="Preview" />
                                                                    <div class="upload-overlay">
                                                                        <span class="material-symbols-outlined">photo_camera</span>
                                                                    </div>
                                                                </label>
                                                            </div>
                                                            <p class="fz-12 mt-2 text-center">
                                                                {{ translate('Image format')}} - {{ implode(', ', array_column(IMAGEEXTENSION, 'key')) }}
                                                                {{ translate("Image Size") }} - {{ translate('maximum size') }} {{ readableUploadMaxFileSize('image') }}
                                                                {{ translate('Image Ratio') }} - 1:1
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="pick-map p-12 rounded d-flex flex-md-nowrap flex-wrap align-items-center gap-1 bg-primary bg-opacity-10">
                                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <g clip-path="url(#clip0_9464_2249)">
                                                            <path d="M9.79125 1.44318L10.5117 0.270677C10.6797 -0.00465646 11.039 -0.0898231 11.3138 0.0793436C11.5885 0.247927 11.6743 0.606677 11.5051 0.881427L10.7847 2.05393C10.675 2.23359 10.4831 2.33218 10.2871 2.33218C10.1827 2.33218 10.0777 2.30418 9.98259 2.24584C9.70784 2.07726 9.62209 1.71793 9.79125 1.44318ZM3.16575 2.05334C3.27542 2.23301 3.46792 2.33218 3.66392 2.33218C3.76775 2.33218 3.87275 2.30418 3.96784 2.24643C4.24259 2.07784 4.32892 1.71909 4.16034 1.44434L3.44109 0.27126C3.2725 -0.00348977 2.91317 -0.0892398 2.639 0.0787602C2.36425 0.247344 2.27792 0.606094 2.4465 0.880844L3.16575 2.05334ZM1.89059 3.34134L0.841754 2.83909C0.552421 2.69851 0.201838 2.82218 0.0641712 3.11326C-0.0752455 3.40376 0.0478378 3.75201 0.338338 3.89084L1.38717 4.39309C1.46825 4.43218 1.554 4.45084 1.63859 4.45084C1.85617 4.45084 2.065 4.32893 2.16475 4.11951C2.30417 3.82901 2.18109 3.48018 1.89059 3.34134ZM6.92067 2.33393C3.70417 2.38701 1.155 5.87301 2.9015 9.23068C3.16692 9.74051 3.56067 10.1675 3.98359 10.5566C4.144 10.7042 4.26825 10.8868 4.37442 11.0828H6.41667V8.05876C5.73942 7.81726 5.25 7.17559 5.25 6.41609C5.25 6.09351 5.51075 5.83276 5.83334 5.83276C6.15592 5.83276 6.41667 6.09351 6.41667 6.41609C6.41667 6.73868 6.678 6.99943 7 6.99943C7.322 6.99943 7.58334 6.73809 7.58334 6.41609C7.58334 6.09409 7.84409 5.83276 8.16667 5.83276C8.48925 5.83276 8.75 6.09351 8.75 6.41609C8.75 7.17559 8.26059 7.81726 7.58334 8.05876V11.0828H9.60634C9.73934 10.8547 9.91084 10.6394 10.1354 10.4522C10.5198 10.1313 10.8815 9.77376 11.1038 9.32518C12.117 7.27593 11.7151 5.09076 10.2719 3.67209C9.373 2.78776 8.18242 2.31468 6.92067 2.33393ZM4.662 12.4122C4.61534 13.2673 5.25584 14 6.11217 14H7.87442C8.68 14 9.33275 13.3473 9.33275 12.5417V12.25H4.65559C4.65559 12.3048 4.6655 12.3562 4.662 12.4122ZM13.9493 3.09168C13.8163 2.79826 13.4715 2.66584 13.1781 2.80001L12.0511 3.30868C11.7571 3.44109 11.6264 3.78643 11.7594 4.07984C11.8568 4.29568 12.0686 4.42343 12.2914 4.42343C12.3713 4.42343 12.453 4.40709 12.5306 4.37151L13.6576 3.86284C13.9516 3.73043 14.0823 3.38509 13.9493 3.09168Z" fill="#3C76F1"/>
                                                        </g>
                                                        <defs>
                                                            <clipPath id="clip0_9464_2249">
                                                                <rect width="14" height="14" fill="white"/>
                                                            </clipPath>
                                                        </defs>
                                                    </svg>
                                                    <p class="fz-12">{{ translate('For the address setup you can simply drag the map to pick for the perfect') }} <span class="fw-semibold">Lat(Latitude) & Log(Longitude)</span> value.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mb-3">
                                        <div class="border-bottom px-4 py-3">
                                            <h4 class="mb-1">
                                                {{translate('General Setup')}}
                                            </h4>
                                            <p class="fs-12">{{ translate('Here users can set time zone and format wise time.') }}</p>
                                        </div>
                                        <div class="p-20">
                                            <!--Time Setup-->
                                            <div class="card-body cus-shadow bg-white mb-20">
                                                <h5 class="mb-1 fz-16">{{ translate('Time and General Setup') }}</h5>
                                                <p class="fz-12 mb-20">{{ translate('Setup your business time zone, format and other general settings from here') }}</p>
                                                <div class="rounded card2 p-20">
                                                    <div class="row g-lg-3 g-3">
                                                        <div class="col-lg-4 col-md-6">
                                                            <label class="mb-2 text-dark">{{translate('Time Zone')}}</label>
                                                            @php($timeZone=$dataValues->where('key_name','time_zone')->first()->live_values)
                                                            <select class="js-select current-black-color theme-input-style w-100" name="time_zone">
                                                                <option value="0" selected disabled>{{translate('---Select_Time_Zone---')}}</option>
                                                                @foreach(TIME_ZONES as $time)
                                                                    <option value="{{$time['tzCode']}}" {{$timeZone==$time['tzCode']?'selected':''}}>{{$time['tzCode']}}
                                                                        UTC {{$time['utc']}}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="col-lg-4 col-md-6">
                                                            @php($timeFormat = $dataValues->where('key_name', 'time_format')->first()->live_values ?? '24h')
                                                            <label class="mb-2 text-dark">{{ translate('Time Format') }}<span class="text-danger">*</span></label>
                                                            <div class="border setup-box p-12 rounded d-flex align-items-center gap-xl-5 gap-3">
                                                                <div class="custom-radio">
                                                                    <input type="radio" id="timeformate" name="time_format" value="12" {{ $timeFormat == '12' ? 'checked' : '' }}>
                                                                    <label for="timeformate" class="fz-14 text-dark">12 Hours</label>
                                                                </div>
                                                                <div class="custom-radio">
                                                                    <input type="radio" id="timeformate24" name="time_format" value="24" {{ $timeFormat == '24' ? 'checked' : '' }}>
                                                                    <label for="timeformate24" class="fz-14 text-dark">24 Hours</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6">
                                                            <div class="mb-2 text-dark">{{translate('pagination_limit')}} <span class="text-danger">*</span></div>
                                                            <input type="number" class="form-control" name="pagination_limit" placeholder="{{translate('ex: 2')}} *"
                                                                   min="1"
                                                                   step="1" required
                                                                   value="{{$dataValues->where('key_name','pagination_limit')->first()->live_values}}">
                                                        </div>
                                                        <div class="col-lg-4 col-md-6">
                                                            @php($phoneVisibility = $dataValues->where('key_name', 'phone_number_visibility_for_chatting')?->first()?->live_values ?? null)
                                                            <div class="mb-2 text-dark">{{translate('Phone number visibility for chatting')}}
                                                                <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                                   data-bs-placement="top"
                                                                   title="{{ translate('Customers or providers can not see each other phone numbers during chatting') }}"
                                                                >info</i>
                                                            </div>
                                                            <div class="border p-12 rounded d-flex justify-content-between bg-white">
                                                                <span class="text-dark fz-14">{{ translate('status') }}</span>
                                                                <label class="switcher">
                                                                    <input class="switcher_input" type="checkbox" id="phone_number_visibility_for_chatting"
                                                                           name="phone_number_visibility_for_chatting" value="1"
                                                                        {{ $phoneVisibility == '1' ? 'checked' : ''}}>
                                                                    <span class="switcher_control"></span>
                                                                </label>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <!--Currency Setup-->
                                            <div class="card-body cus-shadow bg-white mb-20">
                                                <h5 class="mb-1 fz-16">{{ translate('Currency Setup') }}</h5>
                                                <p class="fz-12 mb-20">{{ translate('Here users can select currency, choose currency position and can set digit after decimal point.') }}</p>
                                                <div class="rounded card2 p-20">
                                                    <div class="row g-lg-3 g-3">
                                                        <div class="col-lg-4 col-md-6">
                                                            <label class="mb-2 text-dark">{{translate('Currency Code')}}</label>
                                                            @php($currencyCode=$dataValues->where('key_name','currency_code')->first()->live_values)
                                                            <select class="js-select current-black-color theme-input-style w-100"
                                                                    name="currency_code" id="change_currency">
                                                                <option value="0" selected
                                                                        disabled>{{translate('---Select_Currency---')}}</option>
                                                                @foreach(CURRENCIES as $currency)
                                                                    <option
                                                                        value="{{$currency['code']}}" {{$currencyCode==$currency['code']?'selected':''}}>
                                                                        {{$currency['name']}} ( {{$currency['symbol']}} )
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6">
                                                            @php($position=$dataValues->where('key_name','currency_symbol_position')->first()->live_values)
                                                            <label class="mb-2 text-dark">{{translate('Currency Position')}}</label>
                                                            <div class="border setup-box p-12 rounded d-flex align-items-center gap-xl-5 gap-3">
                                                                <div class="custom-radio">
                                                                    <input type="radio" id="currency_position_left" name="currency_symbol_position" value="left" {{ $position == 'left' ? 'checked' : '' }}>
                                                                    <label for="currency_position_left" class="fz-14 text-dark">({{ $currencyCode }}) Left</label>
                                                                </div>
                                                                <div class="custom-radio">
                                                                    <input type="radio" id="currency_position_right" name="currency_symbol_position" value="right" {{ $position == 'right' ? 'checked' : '' }}>
                                                                    <label for="currency_position_right" class="fz-14 text-dark">Right ({{ $currencyCode }})</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6">
                                                            <div class="mb-2 text-dark">{{translate('Digit after decimal point')}}
                                                                <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                                   data-bs-placement="top"
                                                                   title="{{translate('Digits after a decimal point means how many numbers will be shown after the decimal point (for example 10.00 or 10.000).')}}"
                                                                >info</i>
                                                            </div>
                                                            <input type="number" class="form-control" name="currency_decimal_point" min="1" max="10" placeholder="Ex: 2 " step="1" required
                                                                   value="{{$dataValues->where('key_name','currency_decimal_point')->first()->live_values}}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--Customer-->
                                            <div class="card rounded cus-shadow p-20 mb-20">
                                                <h5 class="mb-1 fz-16">{{ translate('Customer') }}</h5>
                                                <p class="fz-12 mb-20">{{ translate('Manage customer related settings for checkout. Enable or disable guest checkout and allow account creation using guest information') }}</p>
                                                <div class="card2 p-20">
                                                    <div class="row g-3 mb-20">
                                                        <div class="col-lg-4 col-md-6">
                                                            @php($guestCheckoutStatus = $dataValues->where('key_name', 'guest_checkout')?->first()?->live_values ?? null)
                                                            <div class="mb-2 text-dark">{{translate('Guest Checkout')}} <span class="text-danger">*</span>
                                                                <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                                   data-bs-placement="top"
                                                                   title="{{ translate('Allow customers to place an order without creating an account') }}"
                                                                >info</i>
                                                            </div>
                                                            <div class="border p-12 rounded d-flex justify-content-between bg-white">
                                                                <span class="text-dark fz-14">{{ translate('status') }}</span>
                                                                <label class="switcher">
                                                                    <input class="switcher_input" type="checkbox" id="guest_checkout"
                                                                           name="guest_checkout" value="1"
                                                                        {{ $guestCheckoutStatus == '1' ? 'checked' : ''}}>
                                                                    <span class="switcher_control"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6">
                                                            @php($storeGuestData=$dataValues->where('key_name','create_user_account_from_guest_info')->first()->live_values??null)
                                                            <div id="create_user_account_box" class="{{ $guestCheckoutStatus != '1' ? 'disabled' : '' }}">
                                                                <div class="mb-2 text-dark">{{translate('Create user account from guest info')}}
                                                                    <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                                       data-bs-placement="top"
                                                                       title="{{ translate('Automatically create a customer account using guest checkout details (such as name, email, and phone).account') }}"
                                                                    >info</i>
                                                                </div>
                                                                <div class="border p-12 rounded d-flex justify-content-between bg-white">
                                                                    <span class="text-dark fz-14">Status</span>
                                                                    <label class="switcher">
                                                                        <input id="create_user_account_input" class="switcher_input" type="checkbox"
                                                                               name="create_user_account_from_guest_info" value="1"
                                                                            {{ isset($storeGuestData) && $storeGuestData == '1' ? 'checked' : '' }}
                                                                            {{ $guestCheckoutStatus != '1' ? 'disabled' : '' }}>
                                                                        <span class="switcher_control"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="pick-map p-12 rounded d-flex flex-md-nowrap flex-wrap align-items-start gap-1 bg-primary bg-opacity-10">
                                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <g clip-path="url(#clip0_9464_2249)">
                                                                <path d="M9.79125 1.44318L10.5117 0.270677C10.6797 -0.00465646 11.039 -0.0898231 11.3138 0.0793436C11.5885 0.247927 11.6743 0.606677 11.5051 0.881427L10.7847 2.05393C10.675 2.23359 10.4831 2.33218 10.2871 2.33218C10.1827 2.33218 10.0777 2.30418 9.98259 2.24584C9.70784 2.07726 9.62209 1.71793 9.79125 1.44318ZM3.16575 2.05334C3.27542 2.23301 3.46792 2.33218 3.66392 2.33218C3.76775 2.33218 3.87275 2.30418 3.96784 2.24643C4.24259 2.07784 4.32892 1.71909 4.16034 1.44434L3.44109 0.27126C3.2725 -0.00348977 2.91317 -0.0892398 2.639 0.0787602C2.36425 0.247344 2.27792 0.606094 2.4465 0.880844L3.16575 2.05334ZM1.89059 3.34134L0.841754 2.83909C0.552421 2.69851 0.201838 2.82218 0.0641712 3.11326C-0.0752455 3.40376 0.0478378 3.75201 0.338338 3.89084L1.38717 4.39309C1.46825 4.43218 1.554 4.45084 1.63859 4.45084C1.85617 4.45084 2.065 4.32893 2.16475 4.11951C2.30417 3.82901 2.18109 3.48018 1.89059 3.34134ZM6.92067 2.33393C3.70417 2.38701 1.155 5.87301 2.9015 9.23068C3.16692 9.74051 3.56067 10.1675 3.98359 10.5566C4.144 10.7042 4.26825 10.8868 4.37442 11.0828H6.41667V8.05876C5.73942 7.81726 5.25 7.17559 5.25 6.41609C5.25 6.09351 5.51075 5.83276 5.83334 5.83276C6.15592 5.83276 6.41667 6.09351 6.41667 6.41609C6.41667 6.73868 6.678 6.99943 7 6.99943C7.322 6.99943 7.58334 6.73809 7.58334 6.41609C7.58334 6.09409 7.84409 5.83276 8.16667 5.83276C8.48925 5.83276 8.75 6.09351 8.75 6.41609C8.75 7.17559 8.26059 7.81726 7.58334 8.05876V11.0828H9.60634C9.73934 10.8547 9.91084 10.6394 10.1354 10.4522C10.5198 10.1313 10.8815 9.77376 11.1038 9.32518C12.117 7.27593 11.7151 5.09076 10.2719 3.67209C9.373 2.78776 8.18242 2.31468 6.92067 2.33393ZM4.662 12.4122C4.61534 13.2673 5.25584 14 6.11217 14H7.87442C8.68 14 9.33275 13.3473 9.33275 12.5417V12.25H4.65559C4.65559 12.3048 4.6655 12.3562 4.662 12.4122ZM13.9493 3.09168C13.8163 2.79826 13.4715 2.66584 13.1781 2.80001L12.0511 3.30868C11.7571 3.44109 11.6264 3.78643 11.7594 4.07984C11.8568 4.29568 12.0686 4.42343 12.2914 4.42343C12.3713 4.42343 12.453 4.40709 12.5306 4.37151L13.6576 3.86284C13.9516 3.73043 14.0823 3.38509 13.9493 3.09168Z" fill="#3C76F1"/>
                                                            </g>
                                                            <defs>
                                                                <clipPath id="clip0_9464_2249">
                                                                    <rect width="14" height="14" fill="white"/>
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                        <p class="fz-12">{{ translate('Enabling guest checkout can improve conversion rates by making checkout faster. For long-term customer engagement, consider enabling automatic account creation from guest information.') }}</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card rounded cus-shadow p-20 mb-20">
                                                <h5 class="mb-1 fz-16">{{ translate('Booking Notification') }}</h5>
                                                <p class="fz-12 mb-20">{{ translate('Manage the booking notification for admin and provider') }}</p>
                                                <div class="card2 p-20">
                                                    <div class="row g-3 mb-20">
                                                        <div class="col-lg-4 col-md-6">
                                                            @php($notificationStatus = $dataValues->where('key_name', 'booking_notification')?->first()?->live_values ?? null)
                                                            <div class="mb-2 text-dark">{{ translate('booking_notification') }}
                                                                <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                                   data-bs-placement="top"
                                                                   title="{{ translate('Admin and Provider will get a pop-up notification with sounds for every booking placed by customers.') }}"
                                                                >info</i>
                                                            </div>
                                                            <div class="border p-12 rounded d-flex justify-content-between bg-white">
                                                                <span class="text-dark fz-14">{{ translate('status') }}</span>
                                                                <label class="switcher">
                                                                    <input class="switcher_input" type="checkbox"
                                                                           name="booking_notification" value="1"
                                                                        {{ $notificationStatus == '1' ? 'checked' : ''}}>
                                                                    <span class="switcher_control"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6">
                                                            @php($bookingNotificationType = $dataValues->where('key_name', 'booking_notification_type')->first()->live_values ?? null)
                                                            <label class="mb-2 text-dark">{{ translate('booking_notification_type') }}<span class="text-danger">*</span></label>
                                                            <div class="border setup-box p-12 rounded d-flex align-items-center gap-xl-5 gap-3">
                                                                <div class="custom-radio">
                                                                    <input type="radio" id="manual" name="booking_notification_type" value="manual" {{ $bookingNotificationType == 'manual' ? 'checked' : '' }}>
                                                                    <label for="manual" class="fz-14 text-dark">{{ translate('manual') }}</label>
                                                                </div>
                                                                <div class="custom-radio">
                                                                    <input type="radio" id="firebase" name="booking_notification_type" value="firebase" {{ $bookingNotificationType == 'firebase' ? 'checked' : '' }}>
                                                                    <label for="firebase" class="fz-14 text-dark">{{ translate('firebase') }}</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card rounded cus-shadow p-20">
                                                <h5 class="mb-1 fz-16">{{ translate('Copyright & Cookies Text') }}</h5>
                                                <p class="fz-12 mb-20">{{ translate('Provide the necessary text that will appear in your website footer or relevant sections to inform users about copyright ownership and cookie usage.') }}</p>
                                                <div class="card2 p-20">
                                                    <div class="row g-3">
                                                        <div class="col-lg-6 col-md-6">
                                                            <div class="mb-2 text-dark">{{translate('Copyright Text')}}
                                                                <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                                   data-bs-placement="top"
                                                                   title="{{translate('Write the statement to inform that this is protected by copyright law')}}"
                                                                >info</i>
                                                            </div>
                                                            <textarea class="form-control" name="footer_text" rows="1" placeholder="Type about the description" data-maxlength="255">{{$dataValues->where('key_name','footer_text')->first()->live_values}}
                                                        </textarea>
                                                            <div class="d-flex justify-content-end mt-1">
                                                                <span class="text-light-gray letter-count fz-12">0/100</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6">
                                                            <div class="mb-2 text-dark">{{translate('Cookies Text')}}
                                                                <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                                   data-bs-placement="top"
                                                                   title="{{translate('Write the statement to inform about cookies on this website')}}"
                                                                >info</i>
                                                            </div>
                                                            <textarea class="form-control" name="cookies_text" rows="1" placeholder="Type about the description" data-maxlength="255">{{$dataValues->where('key_name','cookies_text')->first()->live_values??null}}
                                                        </textarea>
                                                            <div class="d-flex justify-content-end mt-1">
                                                                <span class="text-light-gray letter-count fz-12">0/100</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @can('business_update')
                                        <div class="d-flex justify-content-end trans3 mt-4">
                                            <div class="d-flex justify-content-sm-end justify-content-center gap-2 gap-sm-3 flex-grow-1 flex-grow-sm-0 bg-white action-btn-wrapper trans3">
                                                <button type="button" id="custom-reset" class="btn btn--secondary rounded">
                                                    {{translate('reset')}}
                                                </button>
                                                <button type="submit" class="btn btn--primary d-flex align-items-center gap-2 rounded demo_check">
                                                    <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <g clip-path="url(#clip0_9562_1632)">
                                                            <path d="M9.91732 0.5H4.08398V4H9.91732V0.5Z" fill="white"/>
                                                            <path d="M7.00065 9.83333C7.64498 9.83333 8.16732 9.311 8.16732 8.66667C8.16732 8.02233 7.64498 7.5 7.00065 7.5C6.35632 7.5 5.83398 8.02233 5.83398 8.66667C5.83398 9.311 6.35632 9.83333 7.00065 9.83333Z" fill="white"/>
                                                            <path d="M11.0833 0.5V5.16667H2.91667V0.5H1.75C1.28587 0.5 0.840752 0.684374 0.512563 1.01256C0.184374 1.34075 0 1.78587 0 2.25L0 14.5H14V3.41667L11.0833 0.5ZM7 11C6.53851 11 6.08738 10.8632 5.70367 10.6068C5.31995 10.3504 5.02088 9.98596 4.84428 9.55959C4.66768 9.13323 4.62147 8.66408 4.7115 8.21146C4.80153 7.75883 5.02376 7.34307 5.35008 7.01675C5.67641 6.69043 6.09217 6.4682 6.54479 6.37817C6.99741 6.28814 7.46657 6.33434 7.89293 6.51095C8.31929 6.68755 8.68371 6.98662 8.94009 7.37034C9.19649 7.75405 9.33333 8.20518 9.33333 8.66667C9.33333 9.28551 9.0875 9.879 8.64992 10.3166C8.21233 10.7542 7.61884 11 7 11Z" fill="white"/>
                                                        </g>
                                                        <defs>
                                                            <clipPath id="clip0_9562_1632">
                                                                <rect width="14" height="14" fill="white" transform="translate(0 0.5)"/>
                                                            </clipPath>
                                                        </defs>
                                                    </svg>
                                                    {{translate('Save Information')}}
                                                </button>
                                            </div>
                                        </div>
                                    @endcan
                                </form>
                            </div>
                        </div>
                    @endif

                    @if($webPage=='payment')
                        <div class="">
                            <div class="card p-20 mb-20">
                                <h5 class="mb-1 fz-16">{{ translate('Payment Options') }}</h5>
                                <p class="fz-12 mb-20">{{ translate('Enable preferred payment methods to make payments from customer app and websites.') }}</p>

                                <form action="{{route('admin.business-settings.set-service-setup')}}" method="POST" id="payment-form">
                                    @csrf
                                    @method('PUT')

                                    <div class="card2 p-20 mb-20">
                                        <div class="cus-shadow rounded p-sm-3 p-2 bg-white">
                                            <div class="row g-3">
                                                <div class="col-md-6 col-lg-4">
                                                    @php($CAS = $dataValues->where('key_name', 'cash_after_service')?->first()?->live_values ?? null)
                                                    <div class="d-flex gap-sm-2 gap-2 align-items-start">
                                                        <div class="form-check form--check">
                                                            <input class="form-check-input form-check-lg"
                                                                   type="checkbox"
                                                                   id="cash_after_service"
                                                                   name="cash_after_service"
                                                                   value="1" {{$CAS ? 'checked' : ''}}>
                                                        </div>
                                                        <div>
                                                            <h5 class="text-dark mb-1">{{ translate('Cash After Service') }}</h5>
                                                            <p class="fz-12 max-w-500">
                                                                {{ translate('By selecting Cash After Service Will make it available as a payment option for customers during the checkout process') }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-4">
                                                    @php($digital_payment = $dataValues->where('key_name', 'digital_payment')?->first()?->live_values ?? null)
                                                    <div class="d-flex gap-sm-2 gap-2 align-items-start">
                                                        <div class="form-check form--check">
                                                            <input class="form-check-input form-check-lg"
                                                                   type="checkbox"
                                                                   id="digital_payment"
                                                                   name="digital_payment"
                                                                   value="1" {{$digital_payment ? 'checked' : ''}}>
                                                        </div>
                                                        <div>
                                                            <h5 class="text-dark mb-1">
                                                                {{ translate('Digital Payment') }}
                                                                <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg"
                                                                     data-bs-toggle="tooltip"
                                                                     data-bs-placement="top"
                                                                     title="{{ translate('By selecting digital payment will make it available as a payment option for customers during the checkout process.') }}"
                                                                >
                                                                    <g clip-path="url(#clip0_9434_14928)">
                                                                        <path d="M15.7199 10.2213L10.3332 1.71464C9.8799 1.0613 9.12657 0.667969 8.33323 0.667969C7.5399 0.667969 6.78657 1.05464 6.31324 1.73464L0.953235 10.208C0.273235 11.1813 0.146568 12.348 0.619902 13.248C1.08657 14.148 2.06657 14.6613 3.29323 14.6613H13.3732C14.6066 14.6613 15.5799 14.148 16.0466 13.248C16.5132 12.348 16.3866 11.188 15.7199 10.2213ZM7.66657 4.66797C7.66657 4.3013 7.96657 4.0013 8.33323 4.0013C8.6999 4.0013 8.9999 4.3013 8.9999 4.66797V8.66797C8.9999 9.03464 8.6999 9.33464 8.33323 9.33464C7.96657 9.33464 7.66657 9.03464 7.66657 8.66797V4.66797ZM8.33323 12.668C7.7799 12.668 7.33323 12.2213 7.33323 11.668C7.33323 11.1146 7.7799 10.668 8.33323 10.668C8.88657 10.668 9.33323 11.1146 9.33323 11.668C9.33323 12.2213 8.88657 12.668 8.33323 12.668Z" fill="#FFBB38"/>
                                                                    </g>
                                                                    <defs>
                                                                        <clipPath id="clip0_9434_14928">
                                                                            <rect width="16" height="16" fill="white" transform="translate(0.333008)"/>
                                                                        </clipPath>
                                                                    </defs>
                                                                </svg>
                                                            </h5>
                                                            <p class="fz-12 max-w-500">
                                                                {{ translate('By selecting digital payment will make it available as a payment option for customers during the checkout process.') }}
                                                                <a @can('payment_method_view') href="{{ route('admin.configuration.third-party', ['webPage' => 'payment_config', 'type' => 'digital_payment']) }}" @endcan target="_blank" class="fw-semibold text-primary text-decoration-underline">{{ translate('click here') }}</a>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-4">
                                                    @php($offline_payment = $dataValues->where('key_name', 'offline_payment')?->first()?->live_values ?? null)

                                                    <div class="d-flex gap-sm-2 gap-2 align-items-start">
                                                        <div class="form-check form--check">
                                                            <input class="form-check-input form-check-lg"
                                                                   type="checkbox"
                                                                   id="offline_payment"
                                                                   name="offline_payment"
                                                                   value="1" {{$offline_payment ? 'checked' : ''}}>
                                                        </div>
                                                        <div>
                                                            <h5 class="text-dark mb-1">
                                                                {{ translate('Offline payment') }}
                                                            </h5>
                                                            <p class="fz-12 max-w-500">
                                                                {{ translate('By selecting offline payment will make it available as a payment option for customers during the checkout process.') }}
                                                                <a @can('payment_method_view') href="{{ route('admin.configuration.third-party', ['type' => 'offline_payment', 'webPage' => 'payment_config']) }}" @endcan target="_blank" class="fw-semibold text-primary text-decoration-underline">{{ translate('click here') }}</a>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card p-20 mb-20">

                                        <div class="bg-warning bg-opacity-10 fs-12 p-12 text-dark rounded mb-3">
                                            <div class="d-flex align-items-center gap-2 mb-2">
                                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <g clip-path="url(#clip0_9562_195)">
                                                        <path d="M7 14C8.38447 14 9.73785 13.5895 10.889 12.8203C12.0401 12.0511 12.9373 10.9579 13.4672 9.67879C13.997 8.3997 14.1356 6.99224 13.8655 5.63437C13.5954 4.2765 12.9287 3.02922 11.9497 2.05026C10.9708 1.07129 9.7235 0.404603 8.36563 0.134506C7.00777 -0.13559 5.6003 0.003033 4.32122 0.532846C3.04213 1.06266 1.94888 1.95987 1.17971 3.11101C0.410543 4.26216 0 5.61553 0 7C0.0020073 8.8559 0.74015 10.6352 2.05247 11.9475C3.36479 13.2599 5.1441 13.998 7 14ZM7 2.91667C7.17306 2.91667 7.34223 2.96799 7.48612 3.06413C7.63002 3.16028 7.74217 3.29694 7.8084 3.45682C7.87462 3.61671 7.89195 3.79264 7.85819 3.96237C7.82443 4.13211 7.74109 4.28802 7.61872 4.41039C7.49635 4.53276 7.34044 4.6161 7.1707 4.64986C7.00097 4.68362 6.82504 4.66629 6.66515 4.60006C6.50527 4.53384 6.36861 4.42169 6.27246 4.27779C6.17632 4.1339 6.125 3.96473 6.125 3.79167C6.125 3.55961 6.21719 3.33705 6.38128 3.17295C6.54538 3.00886 6.76794 2.91667 7 2.91667ZM6.41667 5.83334H7C7.30942 5.83334 7.60617 5.95625 7.82496 6.17505C8.04375 6.39384 8.16667 6.69058 8.16667 7V10.5C8.16667 10.6547 8.10521 10.8031 7.99581 10.9125C7.88642 11.0219 7.73804 11.0833 7.58333 11.0833C7.42862 11.0833 7.28025 11.0219 7.17086 10.9125C7.06146 10.8031 7 10.6547 7 10.5V7H6.41667C6.26196 7 6.11358 6.93855 6.00419 6.82915C5.89479 6.71975 5.83333 6.57138 5.83333 6.41667C5.83333 6.26196 5.89479 6.11359 6.00419 6.00419C6.11358 5.8948 6.26196 5.83334 6.41667 5.83334Z" fill="#FFBB38"/>
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_9562_195">
                                                            <rect width="14" height="14" fill="white"/>
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                                <p class="fz-12">{{ translate('To enable this feature must be activated') }}</p>
                                            </div>
                                            <ul class="m-0 ps-20 d-flex flex-column gap-1 text-dark">
                                                <li>{{ translate('Customer wallet from the') }} <a @can('business_view') href="{{ route('admin.business-settings.get-business-information', ['web_page' => 'customers']) }}" @endcan target="_blank" class="fw-semibold text-primary text-decoration-underline">{{ translate('Customer Wallet') }}</a> {{ translate('page') }}</li>
                                                <li>{{ translate('At least one payment method from the previous payment option section') }}</li>
                                            </ul>
                                        </div>

                                        <div class="pick-map p-12 rounded d-flex flex-md-nowrap flex-wrap align-items-center gap-1 mb-20 bg-primary bg-opacity-10">
                                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0_9464_2249)">
                                                    <path d="M9.79125 1.44318L10.5117 0.270677C10.6797 -0.00465646 11.039 -0.0898231 11.3138 0.0793436C11.5885 0.247927 11.6743 0.606677 11.5051 0.881427L10.7847 2.05393C10.675 2.23359 10.4831 2.33218 10.2871 2.33218C10.1827 2.33218 10.0777 2.30418 9.98259 2.24584C9.70784 2.07726 9.62209 1.71793 9.79125 1.44318ZM3.16575 2.05334C3.27542 2.23301 3.46792 2.33218 3.66392 2.33218C3.76775 2.33218 3.87275 2.30418 3.96784 2.24643C4.24259 2.07784 4.32892 1.71909 4.16034 1.44434L3.44109 0.27126C3.2725 -0.00348977 2.91317 -0.0892398 2.639 0.0787602C2.36425 0.247344 2.27792 0.606094 2.4465 0.880844L3.16575 2.05334ZM1.89059 3.34134L0.841754 2.83909C0.552421 2.69851 0.201838 2.82218 0.0641712 3.11326C-0.0752455 3.40376 0.0478378 3.75201 0.338338 3.89084L1.38717 4.39309C1.46825 4.43218 1.554 4.45084 1.63859 4.45084C1.85617 4.45084 2.065 4.32893 2.16475 4.11951C2.30417 3.82901 2.18109 3.48018 1.89059 3.34134ZM6.92067 2.33393C3.70417 2.38701 1.155 5.87301 2.9015 9.23068C3.16692 9.74051 3.56067 10.1675 3.98359 10.5566C4.144 10.7042 4.26825 10.8868 4.37442 11.0828H6.41667V8.05876C5.73942 7.81726 5.25 7.17559 5.25 6.41609C5.25 6.09351 5.51075 5.83276 5.83334 5.83276C6.15592 5.83276 6.41667 6.09351 6.41667 6.41609C6.41667 6.73868 6.678 6.99943 7 6.99943C7.322 6.99943 7.58334 6.73809 7.58334 6.41609C7.58334 6.09409 7.84409 5.83276 8.16667 5.83276C8.48925 5.83276 8.75 6.09351 8.75 6.41609C8.75 7.17559 8.26059 7.81726 7.58334 8.05876V11.0828H9.60634C9.73934 10.8547 9.91084 10.6394 10.1354 10.4522C10.5198 10.1313 10.8815 9.77376 11.1038 9.32518C12.117 7.27593 11.7151 5.09076 10.2719 3.67209C9.373 2.78776 8.18242 2.31468 6.92067 2.33393ZM4.662 12.4122C4.61534 13.2673 5.25584 14 6.11217 14H7.87442C8.68 14 9.33275 13.3473 9.33275 12.5417V12.25H4.65559C4.65559 12.3048 4.6655 12.3562 4.662 12.4122ZM13.9493 3.09168C13.8163 2.79826 13.4715 2.66584 13.1781 2.80001L12.0511 3.30868C11.7571 3.44109 11.6264 3.78643 11.7594 4.07984C11.8568 4.29568 12.0686 4.42343 12.2914 4.42343C12.3713 4.42343 12.453 4.40709 12.5306 4.37151L13.6576 3.86284C13.9516 3.73043 14.0823 3.38509 13.9493 3.09168Z" fill="#3C76F1"></path>
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_9464_2249">
                                                        <rect width="14" height="14" fill="white"></rect>
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                            <p class="fz-12">{{ translate('To use any payment method for Partial payment you need to active them from Previous Section, otherwise the payment method will remain disable.') }}</p>
                                        </div>

                                        <div class="row g-3 mb-20">
                                            <div class="col-md-8">
                                                <h5 class="mb-1 fz-16">{{ translate('Partial Payment') }}</h5>
                                                <p class="fz-12 mb-20">{{ translate('By switching this feature ON, Customer can pay with wallet balance & partially pay from other payment gateways.') }} </p>
                                            </div>
                                            <div class="col-sm-4">
                                                @php($partial_payment = $dataValues->where('key_name', 'partial_payment')?->first()?->live_values ?? null)
                                                <div class="border p-12 rounded d-flex justify-content-between bg-white">
                                                    <span class="text-dark fz-14">Status</span>
                                                    <label class="switcher">
                                                        <input class="switcher_input"
                                                               type="checkbox"
                                                               name="partial_payment"
                                                               id="partial_payment"
                                                               value="1"  {{$partial_payment ? 'checked' : ''}}>
                                                        <span class="switcher_control"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="rounded bg-light p-20 mb-20">
                                            <div class="mb-2 text-dark">{{translate('Available Option to pay the remaining bill')}}
                                                <i class="material-icons fz-14 text-light-gray"
                                                   data-bs-toggle="tooltip"
                                                   data-bs-placement="top"
                                                   title="{{translate('Choose how customers can pay the unpaid portion of their bill when using partial payment. Customers can complete the payment through Cash After Service (CAS), Digital Payment, Offline Payment, or allow all available options.')}}"
                                                >info</i>
                                            </div>

                                            <div class="d-flex flex-wrap border bg-white rounded px-2 py-1 justify-content-between gap-2">
                                                <div class="form-check form--check p-10 px-3">
                                                    <input class="form-check-input system-checkbox" type="radio"
                                                           name="partial_payment_combinator"
                                                           value="cash_after_service"
                                                           id="cash_after_service_combinator"
                                                        {{$dataValues->where('key_name', 'partial_payment_combinator')->first()->live_values == 'cash_after_service' ? 'checked' : ''}}>
                                                    <label class="form-check-label text-dark" for="cash_after_service_combinator">{{ translate('Cash After Service') }} (CAS)</label>
                                                </div>
                                                <div class="form-check form--check p-10 px-3">
                                                    <input class="form-check-input system-checkbox" type="radio"
                                                           name="partial_payment_combinator"
                                                           value="digital_payment"
                                                           id="digital_payment_combinator"
                                                        {{$dataValues->where('key_name', 'partial_payment_combinator')->first()->live_values == 'digital_payment' ? 'checked' : ''}}>
                                                    <label class="form-check-label text-dark" for="digital_payment_combinator">{{ translate('Digital Payment') }}</label>
                                                </div>
                                                <div class="form-check form--check p-10 px-3">
                                                    <input class="form-check-input system-checkbox" type="radio"
                                                           name="partial_payment_combinator"
                                                           value="offline_payment"
                                                           id="offline_payment_combinator"
                                                        {{$dataValues->where('key_name', 'partial_payment_combinator')->first()->live_values == 'offline_payment' ? 'checked' : ''}}>
                                                    <label class="form-check-label text-dark" for="offline_payment_combinator">{{ translate('Offline Payment') }}</label>
                                                </div>
                                                <div class="form-check form--check p-10 px-3">
                                                    <input class="form-check-input system-checkbox" type="radio"
                                                           name="partial_payment_combinator"
                                                           value="all"
                                                           id="all_combinator"
                                                        {{$dataValues->where('key_name', 'partial_payment_combinator')->first()->live_values == 'all' ? 'checked' : ''}}>
                                                    <label class="form-check-label text-dark" for="all_combinator">{{ translate('All') }}</label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    @can('business_update')
                                        <div class="d-flex justify-content-end trans3 mt-4">
                                            <div class="d-flex justify-content-sm-end justify-content-center gap-2 gap-sm-3 flex-grow-1 flex-grow-sm-0 bg-white action-btn-wrapper trans3">
                                                <button type="reset" class="btn btn--secondary rounded">
                                                    {{translate('reset')}}
                                                </button>
                                                <button type="submit" class="btn btn--primary d-flex align-items-center gap-2 rounded demo_check">
                                                    <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <g clip-path="url(#clip0_9562_1632)">
                                                            <path d="M9.91732 0.5H4.08398V4H9.91732V0.5Z" fill="white"/>
                                                            <path d="M7.00065 9.83333C7.64498 9.83333 8.16732 9.311 8.16732 8.66667C8.16732 8.02233 7.64498 7.5 7.00065 7.5C6.35632 7.5 5.83398 8.02233 5.83398 8.66667C5.83398 9.311 6.35632 9.83333 7.00065 9.83333Z" fill="white"/>
                                                            <path d="M11.0833 0.5V5.16667H2.91667V0.5H1.75C1.28587 0.5 0.840752 0.684374 0.512563 1.01256C0.184374 1.34075 0 1.78587 0 2.25L0 14.5H14V3.41667L11.0833 0.5ZM7 11C6.53851 11 6.08738 10.8632 5.70367 10.6068C5.31995 10.3504 5.02088 9.98596 4.84428 9.55959C4.66768 9.13323 4.62147 8.66408 4.7115 8.21146C4.80153 7.75883 5.02376 7.34307 5.35008 7.01675C5.67641 6.69043 6.09217 6.4682 6.54479 6.37817C6.99741 6.28814 7.46657 6.33434 7.89293 6.51095C8.31929 6.68755 8.68371 6.98662 8.94009 7.37034C9.19649 7.75405 9.33333 8.20518 9.33333 8.66667C9.33333 9.28551 9.0875 9.879 8.64992 10.3166C8.21233 10.7542 7.61884 11 7 11Z" fill="white"/>
                                                        </g>
                                                        <defs>
                                                            <clipPath id="clip0_9562_1632">
                                                                <rect width="14" height="14" fill="white" transform="translate(0 0.5)"/>
                                                            </clipPath>
                                                        </defs>
                                                    </svg>
                                                    {{translate('Save Information')}}
                                                </button>
                                            </div>
                                        </div>
                                    @endcan

                                </form>
                            </div>
                        </div>
                    @endif

                    <!-- Bookings--->
                    @if($webPage=='bookings')
                        <div class="tab-content">
                            <div class="tab-pane fade {{$webPage=='bookings'?'active show':''}}" id="business-info">
                                <form action="javascript:void(0)" method="POST" id="booking-system-update-form">
                                    @csrf
                                    @method('PUT')
                                    <!-- General Setup -->
                                    <div class="card p-20 mb-15">
                                        <h5 class="mb-1 fz-16">{{ translate('General Setup') }}</h5>
                                        <p class="fz-12 mb-20">{{ translate('This section allows you to configure basic settings for your services.') }}</p>
                                        <div class="card2 p-20">
                                            <div class="row g-3">
                                                <div class="col-lg-4 col-md-6">
                                                    <div class="mb-2 text-dark">{{translate('Confirmation OTP for Complete Service')}}
                                                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip" data-bs-placement="top"
                                                           title="{{translate('Enable a one-time password (OTP) verification for customers when a service is marked as complete.')}}">info</i>
                                                    </div>
                                                    <div class="border p-12 rounded d-flex justify-content-between bg-white">
                                                        <span class="text-dark fz-14">{{ translate('Status') }}</span>
                                                        <label class="switcher">
                                                            <input class="switcher_input" type="checkbox"
                                                                   name="booking_otp" value="1" id="booking_otp"
                                                                {{$dataValues->where('key_name', 'booking_otp')->first()?->live_values ?'checked':''}}>
                                                            <span class="switcher_control"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6">
                                                    <div class="mb-2 text-dark">{{translate('Service complete Photo Evidence')}}
                                                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                           data-bs-placement="top"
                                                           title="{{translate('Upload images as evidence to confirm the completion of the service.')}}"
                                                        >info</i>
                                                    </div>
                                                    <div class="border p-12 rounded d-flex justify-content-between bg-white">
                                                        <span class="text-dark fz-14">{{ translate('Status') }}</span>
                                                        <label class="switcher">
                                                            <input class="switcher_input" type="checkbox"
                                                                   name="service_complete_photo_evidence" value="1"
                                                                   id="photo_evidence"
                                                                {{$dataValues->where('key_name', 'service_complete_photo_evidence')->first()?->live_values ?'checked':''}}>
                                                            <span class="switcher_control"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6">
                                                    <div class="mb-2 text-dark">{{translate('Direct Provider Booking')}}
                                                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                           data-bs-placement="top"
                                                           title="{{translate('Customers can directly book any provider')}}"
                                                        >info</i>
                                                    </div>
                                                    <div class="border p-12 rounded d-flex justify-content-between bg-white">
                                                        <span class="text-dark fz-14">{{ translate('Status') }}</span>
                                                        <label class="switcher">
                                                            <input class="switcher_input" type="checkbox"
                                                                   name="direct_provider_booking" value="1"
                                                                   id="direct_provider_booking"
                                                                {{$dataValues->where('key_name', 'direct_provider_booking')->first()?->live_values ?'checked':''}}>
                                                            <span class="switcher_control"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Custom Bidding -->
                                    <div class="card p-20 mb-15">
                                        <div class="row g-3 mb-20">
                                            <div class="col-md-8">
                                                <h5 class="mb-1 fz-16">{{ translate('Custom Bidding') }}</h5>
                                                <p class="fz-12 mb-20">{{ translate('Here you can enable or disable a custom bidding feature for your services.') }}</p>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="border p-12 rounded d-flex justify-content-between bg-white">
                                                    <span class="text-dark fz-14">{{ translate('Status') }}</span>
                                                    <label class="switcher">
                                                        <input class="switcher_input"
                                                               type="checkbox"
                                                               name="bidding_status" value="1" id="bidding_status"
                                                               {{$dataValues->where('key_name', 'bidding_status')->first()?->live_values ?'checked':''}}>
                                                        <span class="switcher_control"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card2 p-20" id="custom_bidding_post_section">
                                            <div class="row g-3">
                                                <div class="col-lg-4 col-md-6">
                                                    <div class="mb-2 text-dark">{{translate('Post Validation (Days)')}}
                                                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                           data-bs-placement="top"
                                                           title="{{translate('Users can use the bid feature to create posts for customized service requests while the option is enabled.')}}"
                                                        >info</i>
                                                    </div>
                                                    <input type="number" class="form-control" name="bidding_post_validity"
                                                           value="{{$dataValues->where('key_name', 'bidding_post_validity')->first()->live_values ?? ''}}"
                                                           placeholder="{{translate('Post Validation (days)')}} *" required>
                                                </div>
                                                <div class="col-lg-4 col-md-6">
                                                    <div class="mb-2 text-dark">{{translate('See Other Providers Offers')}}
                                                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip" data-bs-placement="top"
                                                           title="{{translate('Enabling the option allows any provider to view the bid amount offered by the providers.')}}">info</i>
                                                    </div>
                                                    <div class="border p-12 rounded d-flex justify-content-between bg-white">
                                                        <span class="text-dark fz-14">{{ translate('Status') }}</span>
                                                        <label class="switcher">
                                                            <input class="switcher_input" type="checkbox"
                                                                   name="bid_offers_visibility_for_providers" value="1"
                                                                   id="bid_offer_visibility"
                                                                {{$dataValues->where('key_name', 'bid_offers_visibility_for_providers')->first()?->live_values ?'checked':''}}>
                                                            <span class="switcher_control"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Additional booking -->
                                    <div class="card p-20 mb-15">
                                        <div class="row g-3 mb-20">
                                            <div class="col-md-8">
                                                <h5 class="mb-1 fz-16">{{ translate('Additional Charge on Booking') }}</h5>
                                                <p class="fz-12 mb-20">{{ translate('Here you can enable or disable the ability to add extra charges or fees to a customer booking.') }}</p>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="border p-12 rounded d-flex justify-content-between bg-white">
                                                    <span class="text-dark fz-14">{{ translate('Status') }}</span>
                                                    <label class="switcher">
                                                        <input class="switcher_input" type="checkbox"
                                                               name="booking_additional_charge" value="1"
                                                               id="booking_additional_charge"
                                                               {{$dataValues->where('key_name', 'booking_additional_charge')->first()?->live_values ?'checked':''}}>
                                                        <span class="switcher_control"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card2 p-20" id="additional_charge_on_booking_section">
                                            <div class="row g-3">
                                                <div class="col-lg-4 col-md-6">
                                                    <div class="mb-2 text-dark">{{translate('Additional Charge Label')}}
                                                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                           data-bs-placement="top"
                                                           title="{{translate('This will be shown as the level for the additional charge to the customers.')}}"
                                                        >info</i>
                                                    </div>
                                                    <input class="form-control" name="additional_charge_label_name"
                                                           placeholder="{{translate('Additional Charge Label')}} *"
                                                           type="text" required
                                                           value="{{$dataValues->where('key_name', 'additional_charge_label_name')->first()->live_values ?? ''}}">
                                                </div>
                                                <div class="col-lg-4 col-md-6">
                                                    <div class="mb-2 text-dark">{{translate('Additional Charge Fee')}}
                                                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                           data-bs-placement="top"
                                                           title="{{translate('Specify the necessary amount for the additional charge.')}}"
                                                        >info</i>
                                                    </div>
                                                    <input type="number" class="form-control"
                                                           name="additional_charge_fee_amount"
                                                           placeholder="{{translate('Additional charge fee')}} *"
                                                           min="0" step="any" required
                                                           value="{{$dataValues->where('key_name', 'additional_charge_fee_amount')->first()->live_values ?? ''}}"
                                                    >
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Booking Setup -->
                                    <div class="card p-20 mb-15">
                                        <h5 class="mb-1 fz-16">{{ translate('Booking Type') }}</h5>
                                        <p class="fz-12 mb-20">{{ translate('Here you can set up your booking type, how you want to get a booking from a customer.') }}</p>
                                        <div class="card2 p-20 mb-20">
                                            <div class="border rounded p-20 bg-white mb-15">
                                                <div class="row g-3">
                                                    <div class="col-md-6 col-lg-4">
                                                        <div class="d-flex gap-sm-2 gap-2 align-items-start">
                                                            <div class="form-check form--check">
                                                                <input class="form-check-input form-check-lg"
                                                                       type="checkbox"
                                                                       id="instant_booking"
                                                                       value="1"
                                                                       {{$dataValues->where('key_name', 'instant_booking')->first()?->live_values ?'checked':''}}
                                                                       name="instant_booking">
                                                            </div>
                                                            <div>
                                                                <h5 class="text-dark mb-1">{{ translate('Instant Booking') }}</h5>
                                                                <p class="fz-12 max-w-500">
                                                                    {{ translate('By selecting instant booking, customers instantly book a service for a specific date without delays.') }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-lg-4">
                                                        <div class="d-flex gap-sm-2 gap-2 align-items-start">
                                                            <div class="form-check form--check">
                                                                <input class="form-check-input form-check-lg" type="checkbox"
                                                                       id="schedule_booking_switch"
                                                                       name="schedule_booking"
                                                                       {{$dataValues->where('key_name', 'schedule_booking')->first()?->live_values ?'checked':''}}
                                                                       value="1">
                                                            </div>
                                                            <div>
                                                                <h5 class="text-dark mb-1">
                                                                    {{ translate('Schedule Booking') }}
                                                                </h5>
                                                                <p class="fz-12 max-w-500">
                                                                    {{ translate('By selecting schedule booking, to book a service customers have to select specific date and time to book a service.') }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-lg-4">
                                                        <div class="d-flex gap-sm-2 gap-2 align-items-start">
                                                            <div class="form-check form--check">
                                                                <input class="form-check-input form-check-lg" type="checkbox"
                                                                       id="repeat_booking"
                                                                       value="1"
                                                                       name="repeat_booking"
                                                                    {{$dataValues->where('key_name', 'repeat_booking')->first()?->live_values ?'checked':''}}>
                                                            </div>
                                                            <div>
                                                                <h5 class="text-dark mb-1">
                                                                    {{ translate('Repeat Booking') }}
                                                                </h5>
                                                                <p class="fz-12 max-w-500">
                                                                    {{ translate(' If you select repeat booking, the customer can place the same service booking for multiple dates under one booking') }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pick-map p-12 rounded d-flex flex-md-nowrap flex-wrap align-items-center gap-1 bg-primary bg-opacity-10">
                                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <g clip-path="url(#clip0_9464_2249)">
                                                        <path d="M9.79125 1.44318L10.5117 0.270677C10.6797 -0.00465646 11.039 -0.0898231 11.3138 0.0793436C11.5885 0.247927 11.6743 0.606677 11.5051 0.881427L10.7847 2.05393C10.675 2.23359 10.4831 2.33218 10.2871 2.33218C10.1827 2.33218 10.0777 2.30418 9.98259 2.24584C9.70784 2.07726 9.62209 1.71793 9.79125 1.44318ZM3.16575 2.05334C3.27542 2.23301 3.46792 2.33218 3.66392 2.33218C3.76775 2.33218 3.87275 2.30418 3.96784 2.24643C4.24259 2.07784 4.32892 1.71909 4.16034 1.44434L3.44109 0.27126C3.2725 -0.00348977 2.91317 -0.0892398 2.639 0.0787602C2.36425 0.247344 2.27792 0.606094 2.4465 0.880844L3.16575 2.05334ZM1.89059 3.34134L0.841754 2.83909C0.552421 2.69851 0.201838 2.82218 0.0641712 3.11326C-0.0752455 3.40376 0.0478378 3.75201 0.338338 3.89084L1.38717 4.39309C1.46825 4.43218 1.554 4.45084 1.63859 4.45084C1.85617 4.45084 2.065 4.32893 2.16475 4.11951C2.30417 3.82901 2.18109 3.48018 1.89059 3.34134ZM6.92067 2.33393C3.70417 2.38701 1.155 5.87301 2.9015 9.23068C3.16692 9.74051 3.56067 10.1675 3.98359 10.5566C4.144 10.7042 4.26825 10.8868 4.37442 11.0828H6.41667V8.05876C5.73942 7.81726 5.25 7.17559 5.25 6.41609C5.25 6.09351 5.51075 5.83276 5.83334 5.83276C6.15592 5.83276 6.41667 6.09351 6.41667 6.41609C6.41667 6.73868 6.678 6.99943 7 6.99943C7.322 6.99943 7.58334 6.73809 7.58334 6.41609C7.58334 6.09409 7.84409 5.83276 8.16667 5.83276C8.48925 5.83276 8.75 6.09351 8.75 6.41609C8.75 7.17559 8.26059 7.81726 7.58334 8.05876V11.0828H9.60634C9.73934 10.8547 9.91084 10.6394 10.1354 10.4522C10.5198 10.1313 10.8815 9.77376 11.1038 9.32518C12.117 7.27593 11.7151 5.09076 10.2719 3.67209C9.373 2.78776 8.18242 2.31468 6.92067 2.33393ZM4.662 12.4122C4.61534 13.2673 5.25584 14 6.11217 14H7.87442C8.68 14 9.33275 13.3473 9.33275 12.5417V12.25H4.65559C4.65559 12.3048 4.6655 12.3562 4.662 12.4122ZM13.9493 3.09168C13.8163 2.79826 13.4715 2.66584 13.1781 2.80001L12.0511 3.30868C11.7571 3.44109 11.6264 3.78643 11.7594 4.07984C11.8568 4.29568 12.0686 4.42343 12.2914 4.42343C12.3713 4.42343 12.453 4.40709 12.5306 4.37151L13.6576 3.86284C13.9516 3.73043 14.0823 3.38509 13.9493 3.09168Z" fill="#3C76F1"></path>
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_9464_2249">
                                                            <rect width="14" height="14" fill="white"></rect>
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                                <p class="fz-12">{{ translate('From above booking option') }} <span class="text-dark fw-medium">{{ translate('Instant Booking') }}</span> {{ translate('or') }} <span class="text-dark fw-medium">{{ translate('Schedule Booking') }}</span> {{ translate('at least one option must be active. If you want, can active all 3 option as per your business need.') }}</p>
                                            </div>
                                        </div>
                                        <div class="card2 p-20" id="schedule_booking_section">
                                            <div class="row g-3">
                                                <div class="col-xl-3">
                                                    <h5 class="mb-1 fz-16">{{ translate('Booking Restriction') }}</h5>
                                                    <p class="fz-12">{{ translate('If you turn ON the switch this feature will active and customer can make schedule order after the restriction time end. Adjust time as your business need.') }}</p>
                                                </div>
                                                <div class="col-xl-9">
                                                    <div class="row g-xxl-3 g-2">
                                                        <div class="col-md-6">
                                                            <label class="mb-2 text-dark fz-14 fw-medium">
                                                                {{ translate('Active Booking Restriction') }}
                                                            </label>
                                                            <div class="border p-12 rounded d-flex justify-content-between bg-white">
                                                                <span class="text-dark fz-14 fw-medium">{{ translate('Status') }}</span>
                                                                <label class="switcher">
                                                                    <input class="switcher_input" type="checkbox"
                                                                           value="1" id="schedule_booking_checkbox"
                                                                           {{$dataValues->where('key_name', 'schedule_booking_time_restriction')->first()?->live_values ?'checked':''}}
                                                                           name="schedule_booking_time_restriction">
                                                                    <span class="switcher_control"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="mb-2 text-dark">{{translate('Restriction Time')}}</label>
                                                            <div class="d-flex align-items-center restriction-time rounded border">
                                                                <div class="flex-grow-1">
                                                                    <input class="form-control border-0" min="1" type="number"
                                                                           value="{{$dataValues->where('key_name', 'advanced_booking_restriction_value')->first()?->live_values}}"
                                                                           name="advanced_booking_restriction_value"
                                                                           required>
                                                                </div>
                                                                <select class="form-select w-auto bg-light border-0" name="advanced_booking_restriction_type">
                                                                    <option value="0" selected
                                                                            disabled>{{translate('Select')}}</option>
                                                                    <option
                                                                        value="hour" {{$dataValues->where('key_name', 'advanced_booking_restriction_type')->first()?->live_values == 'hour' ?'selected':''}}>{{translate('Hour')}}</option>
                                                                    <option
                                                                        value="day" {{$dataValues->where('key_name', 'advanced_booking_restriction_type')->first()?->live_values == 'day' ?'selected':''}}>{{translate('Days')}}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Booking Setup -->
                                    <div class="card p-20 mb-20">
                                        <div class="border-bottom mb-20 pb-3">
                                            <h4 class="mb-1">{{ translate('Booking Setup') }}</h4>
                                            <p class="fz-12">{{ translate('Here you can configure minimum and maximum booking values for a service.') }}</p>
                                        </div>
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <div class="card2 p-20">
                                                    <h5 class="mb-1 fz-14 fw-medium">{{ translate('Min Booking Amount') }}</h5>
                                                    <p class="fz-12 mb-10">
                                                        {{ translate('Determine the minimum amount needed to book a service. No bookings can be made if the cost is below this.') }}
                                                    </p>
                                                    <div class="message-textarea">
                                                        <input class="form-control" name="min_booking_amount"
                                                               placeholder="{{translate('Post Validation (days)')}} *"
                                                               type="number" required step="any"
                                                               value="{{$dataValues->where('key_name', 'min_booking_amount')->first()->live_values ?? ''}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="card2 p-20">
                                                    <h5 class="mb-1 fz-14 fw-medium">{{ translate('Max Booking Amount') }}</h5>
                                                    <p class="fz-12 mb-10">
                                                        {{ translate('Set the maximum value for booking a service. Any amount exceeding this limit will require verification for that service.') }}
                                                    </p>
                                                    <div class="message-textarea">
                                                        <input class="form-control" name="max_booking_amount"
                                                               placeholder="{{translate('Post Validation (days)')}} *"
                                                               type="number" required step="any"
                                                               value="{{$dataValues->where('key_name', 'max_booking_amount')->first()->live_values ?? ''}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @can('business_update')
                                        <div class="d-flex justify-content-end trans3 mt-4">
                                            <div class="d-flex justify-content-sm-end justify-content-center gap-2 gap-sm-3 flex-grow-1 flex-grow-sm-0 bg-white action-btn-wrapper trans3">
                                                <button type="reset" class="btn btn--secondary rounded">
                                                    {{ translate('Reset') }}
                                                </button>
                                                <button type="submit" class="btn btn--primary d-flex align-items-center gap-2 rounded demo_check">
                                                    <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <g clip-path="url(#clip0_9562_1632)">
                                                            <path d="M9.91732 0.5H4.08398V4H9.91732V0.5Z" fill="white"></path>
                                                            <path d="M7.00065 9.83333C7.64498 9.83333 8.16732 9.311 8.16732 8.66667C8.16732 8.02233 7.64498 7.5 7.00065 7.5C6.35632 7.5 5.83398 8.02233 5.83398 8.66667C5.83398 9.311 6.35632 9.83333 7.00065 9.83333Z" fill="white"></path>
                                                            <path d="M11.0833 0.5V5.16667H2.91667V0.5H1.75C1.28587 0.5 0.840752 0.684374 0.512563 1.01256C0.184374 1.34075 0 1.78587 0 2.25L0 14.5H14V3.41667L11.0833 0.5ZM7 11C6.53851 11 6.08738 10.8632 5.70367 10.6068C5.31995 10.3504 5.02088 9.98596 4.84428 9.55959C4.66768 9.13323 4.62147 8.66408 4.7115 8.21146C4.80153 7.75883 5.02376 7.34307 5.35008 7.01675C5.67641 6.69043 6.09217 6.4682 6.54479 6.37817C6.99741 6.28814 7.46657 6.33434 7.89293 6.51095C8.31929 6.68755 8.68371 6.98662 8.94009 7.37034C9.19649 7.75405 9.33333 8.20518 9.33333 8.66667C9.33333 9.28551 9.0875 9.879 8.64992 10.3166C8.21233 10.7542 7.61884 11 7 11Z" fill="white"></path>
                                                        </g>
                                                        <defs>
                                                            <clipPath id="clip0_9562_1632">
                                                                <rect width="14" height="14" fill="white" transform="translate(0 0.5)"></rect>
                                                            </clipPath>
                                                        </defs>
                                                    </svg>
                                                    {{ translate('Save Information') }}
                                                </button>
                                            </div>
                                        </div>
                                    @endcan
                                </form>
                            </div>
                        </div>
                    @endif

                    @if($webPage=='providers')
                        <div class="tab-content">
                            <div class="tab-pane fade {{$webPage=='providers'?'active show':''}}" id="business-info">
                                <form action="{{route('admin.business-settings.set-provider-setup')}}"
                                      method="POST">
                                    @csrf
                                    @method('PUT')
                                    <!-- Provider General Setup--->
                                    <div class="card p-20 mb-20">
                                        <h3 class="mb-1">{{ translate('General Setup') }}</h3>
                                        <p class="fz-12 mb-20">{{ translate('Configure basic settings to manage your system preferences and defaults') }}</p>
                                        <div class="card2 p-20">
                                            <div class="row g-3">
                                                <div class="col-md-6 col-lg-4">
                                                    <div class="mb-2 text-dark">{{translate('Providers can cancel booking Request')}}
                                                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                           data-bs-placement="top"
                                                           title="{{translate('If enabled, providers can cancel a booking even after it has been placed.')}}"
                                                        >info</i>
                                                    </div>
                                                    <div class="border p-12 rounded d-flex justify-content-between bg-white">
                                                        <span class="text-dark fz-14">{{ translate('Can Cancel') }}</span>
                                                        <label class="switcher">
                                                            <input class="switcher_input" type="checkbox"
                                                                   id="provider_can_cancel_booking"
                                                                   name="provider_can_cancel_booking"
                                                                   value="1"
                                                                {{$dataValues->where('key_name', 'provider_can_cancel_booking')?->first()?->live_values ? 'checked' : ''}}>
                                                            <span class="switcher_control"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-4">
                                                    <div class="mb-2 text-dark">{{translate('Providers can Edit booking Request')}}
                                                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                           data-bs-placement="top"
                                                           title="{{translate('If enabled, providers can edit a booking request after it has been placed')}}"
                                                        >info</i>
                                                    </div>
                                                    <div class="border p-12 rounded d-flex justify-content-between bg-white">
                                                        <span class="text-dark fz-14">{{ translate('Can Edit') }}</span>
                                                        <label class="switcher">
                                                            <input class="switcher_input" type="checkbox"
                                                                   id="provider_can_edit_booking"
                                                                   name="provider_can_edit_booking"
                                                                   value="1"
                                                                {{$dataValues->where('key_name', 'provider_can_edit_booking')?->first()?->live_values ? 'checked' : ''}}>
                                                            <span class="switcher_control"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-4">
                                                    <div class="mb-2 text-dark">{{translate('Providers can Reply Review')}}
                                                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                           data-bs-placement="top"
                                                           title="{{translate('If enabled, providers can review reply')}}"
                                                        >info</i>
                                                    </div>
                                                    <div class="border p-12 rounded d-flex justify-content-between bg-white">
                                                        <span class="text-dark fz-14">{{ translate('Can Reply') }}</span>
                                                        <label class="switcher">
                                                            <input class="switcher_input" type="checkbox"
                                                                   id="provider_can_reply_review"
                                                                   name="provider_can_reply_review"
                                                                   value="1"
                                                                {{$dataValues->where('key_name', 'provider_can_reply_review')?->first()?->live_values ? 'checked' : ''}}>
                                                            <span class="switcher_control"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-4">
                                                    <div class="mb-2 text-dark">{{translate('Provider Self Registration')}}
                                                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                           data-bs-placement="top"
                                                           title="{{translate('If enabled, providers can do self-registration from the admin landing page, provider panel & app, and customer website & app.')}}"
                                                        >info</i>
                                                    </div>
                                                    <div class="border p-12 rounded d-flex justify-content-between bg-white">
                                                        <span class="text-dark fz-14">{{ translate('Self Registration') }}</span>
                                                        <label class="switcher">
                                                            <input class="switcher_input" type="checkbox"
                                                                   id="provider_self_registration"
                                                                   name="provider_self_registration"
                                                                   value="1"
                                                                {{$dataValues->where('key_name', 'provider_self_registration')?->first()?->live_values ? 'checked' : ''}}>
                                                            <span class="switcher_control"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-4">
                                                    <div class="mb-2 text-dark">{{translate('Provider Account Self Delete')}}
                                                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                           data-bs-placement="top"
                                                           title="{{translate('If enabled, provider can delete account')}}"
                                                        >info</i>
                                                    </div>
                                                    <div class="border p-12 rounded d-flex justify-content-between bg-white">
                                                        <span class="text-dark fz-14">{{ translate('Self Delete') }}</span>
                                                        <label class="switcher">
                                                            <input class="switcher_input" type="checkbox"
                                                                   id="provider_self_delete"
                                                                   name="provider_self_delete"
                                                                   value="1"
                                                                {{$dataValues->where('key_name', 'provider_self_delete')?->first()?->live_values ? 'checked' : ''}}>
                                                            <span class="switcher_control"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-4">
                                                    <div class="mb-2 text-dark">{{translate('Provider can provide Service at Provider location')}}
                                                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                           data-bs-placement="top"
                                                           title="{{translate('When enabled, providers can choose where they want to provide service. Customers can book services at the providers location when this feature is active')}}"
                                                        >info</i>
                                                    </div>
                                                    <div class="border p-12 rounded d-flex justify-content-between bg-white">
                                                        <span class="text-dark fz-14">{{ translate('Service at Provider Place') }}</span>
                                                        <label class="switcher">
                                                            <input class="switcher_input" type="checkbox"
                                                                   id="service_at_provider_place"
                                                                   name="service_at_provider_place"
                                                                   value="1"
                                                                {{$dataValues->where('key_name', 'service_at_provider_place')?->first()?->live_values ? 'checked' : ''}}>
                                                            <span class="switcher_control"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Provider Wallet--->
                                    <div class="card p-20 mb-20">
                                        <div class="border-bottom mb-3 pb-3">
                                            <h3 class="mb-1">{{ translate('Wallet') }}</h3>
                                            <p class="fz-12 mb-20">{{ translate('Set up wallet limits and withdrawal rules for providers.') }}</p>
                                        </div>
                                        <div class="card2 p-20">
                                            <div class="mb-20">
                                                <h4 class="mb-1 fz-16">{{ translate('Cash In Hand Setup') }}</h4>
                                                <p class="fz-12">{{ translate('Set the maximum amount of Cash in Hand a provider is allowed to keep. If maximum limit is exceeded provider will be suspended & will not receive any service requests') }}</p>
                                            </div>
                                            <div class="bg-white p-20 rounded mb-20">
                                                <div class="row g-3">
                                                    <div class="col-lg-4 col-md-6">
                                                        <div class="mb-2 text-dark">{{translate('Suspend on Exceed the Limit')}}
                                                            <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                               data-bs-placement="top"
                                                               title="{{translate('If enabled, the provider will be automatically suspended by the system when their ‘Cash in Hand’ limit is exceeded.')}}">info</i>
                                                        </div>
                                                        <div class="border p-12 rounded d-flex justify-content-between bg-white">
                                                            <span class="text-dark fz-14">{{ translate('Status') }}</span>
                                                            <label class="switcher">
                                                                <input class="switcher_input" type="checkbox"
                                                                       name="suspend_on_exceed_cash_limit_provider"
                                                                       id="suspend_on_exceed_cash_limit_provider"
                                                                       value="1"
                                                                    {{$dataValues->where('key_name', 'suspend_on_exceed_cash_limit_provider')?->first()?->live_values ? 'checked' : ''}}>
                                                                <span class="switcher_control"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6">

                                                        <div class="mb-2 text-dark">{{translate('Cash In Hand Limit Amount')}} ({{currency_symbol()}})
                                                            <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                               data-bs-placement="top"
                                                               title="{{translate('Define the maximum amount of ‘Cash in Hand’ a provider is allowed to keep. If the maximum limit is exceeded, the provider will be suspended and will not receive any service requests. ')}}">
                                                                info</i>
                                                        </div>

                                                        <input type="hidden" name="max_cash_in_hand_limit_provider" id="hidden_max_cash"
                                                               value="{{$dataValues->where('key_name', 'max_cash_in_hand_limit_provider')->first()->live_values ?? ''}}">

                                                        <div class="position-relative w-100 cash-field-wrapper"
                                                             data-bs-toggle="tooltip"
                                                             data-bs-placement="top"
                                                             title="This field is disabled because suspended limit status is off">
                                                            <input type="number" class="form-control cash-fields"
                                                                   name="max_cash_in_hand_limit_provider"
                                                                   min="0" step="any"
                                                                   title="This field is disabled"
                                                                   value="{{$dataValues->where('key_name', 'max_cash_in_hand_limit_provider')->first()->live_values ?? ''}}">
                                                            <p class="fz-12 mt-1">{{ translate('It must be greater then') }} <span class="fw-medium text-dark">{{ translate('Minimum Payable Amount') }}</span></p>

                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6">
                                                        <div class="mb-2 text-dark">
                                                            {{translate('Minimum Payable Amount')}} ({{currency_symbol()}})
                                                            <span class="danger">*</span>
                                                        </div>

                                                        <input type="hidden" name="min_payable_amount" id="hidden_min_payable"
                                                               value="{{$dataValues->where('key_name', 'min_payable_amount')->first()->live_values ?? ''}}">

                                                        <div class="position-relative w-100 cash-field-wrapper"
                                                             data-bs-toggle="tooltip"
                                                             data-bs-placement="top"
                                                             title="This field is disabled because suspended limit status is off">
                                                            <input type="number" class="form-control cash-fields"
                                                                   name="min_payable_amount"
                                                                   min="0.1" step="any"
                                                                   title="This field is disabled"
                                                                   value="{{$dataValues->where('key_name', 'min_payable_amount')->first()->live_values ?? ''}}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pick-map p-12 rounded d-flex flex-md-nowrap flex-wrap align-items-start gap-1 bg-primary bg-opacity-10">
                                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <g clip-path="url(#clip0_9464_2249)">
                                                        <path d="M9.79125 1.44318L10.5117 0.270677C10.6797 -0.00465646 11.039 -0.0898231 11.3138 0.0793436C11.5885 0.247927 11.6743 0.606677 11.5051 0.881427L10.7847 2.05393C10.675 2.23359 10.4831 2.33218 10.2871 2.33218C10.1827 2.33218 10.0777 2.30418 9.98259 2.24584C9.70784 2.07726 9.62209 1.71793 9.79125 1.44318ZM3.16575 2.05334C3.27542 2.23301 3.46792 2.33218 3.66392 2.33218C3.76775 2.33218 3.87275 2.30418 3.96784 2.24643C4.24259 2.07784 4.32892 1.71909 4.16034 1.44434L3.44109 0.27126C3.2725 -0.00348977 2.91317 -0.0892398 2.639 0.0787602C2.36425 0.247344 2.27792 0.606094 2.4465 0.880844L3.16575 2.05334ZM1.89059 3.34134L0.841754 2.83909C0.552421 2.69851 0.201838 2.82218 0.0641712 3.11326C-0.0752455 3.40376 0.0478378 3.75201 0.338338 3.89084L1.38717 4.39309C1.46825 4.43218 1.554 4.45084 1.63859 4.45084C1.85617 4.45084 2.065 4.32893 2.16475 4.11951C2.30417 3.82901 2.18109 3.48018 1.89059 3.34134ZM6.92067 2.33393C3.70417 2.38701 1.155 5.87301 2.9015 9.23068C3.16692 9.74051 3.56067 10.1675 3.98359 10.5566C4.144 10.7042 4.26825 10.8868 4.37442 11.0828H6.41667V8.05876C5.73942 7.81726 5.25 7.17559 5.25 6.41609C5.25 6.09351 5.51075 5.83276 5.83334 5.83276C6.15592 5.83276 6.41667 6.09351 6.41667 6.41609C6.41667 6.73868 6.678 6.99943 7 6.99943C7.322 6.99943 7.58334 6.73809 7.58334 6.41609C7.58334 6.09409 7.84409 5.83276 8.16667 5.83276C8.48925 5.83276 8.75 6.09351 8.75 6.41609C8.75 7.17559 8.26059 7.81726 7.58334 8.05876V11.0828H9.60634C9.73934 10.8547 9.91084 10.6394 10.1354 10.4522C10.5198 10.1313 10.8815 9.77376 11.1038 9.32518C12.117 7.27593 11.7151 5.09076 10.2719 3.67209C9.373 2.78776 8.18242 2.31468 6.92067 2.33393ZM4.662 12.4122C4.61534 13.2673 5.25584 14 6.11217 14H7.87442C8.68 14 9.33275 13.3473 9.33275 12.5417V12.25H4.65559C4.65559 12.3048 4.6655 12.3562 4.662 12.4122ZM13.9493 3.09168C13.8163 2.79826 13.4715 2.66584 13.1781 2.80001L12.0511 3.30868C11.7571 3.44109 11.6264 3.78643 11.7594 4.07984C11.8568 4.29568 12.0686 4.42343 12.2914 4.42343C12.3713 4.42343 12.453 4.40709 12.5306 4.37151L13.6576 3.86284C13.9516 3.73043 14.0823 3.38509 13.9493 3.09168Z" fill="#3C76F1"></path>
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_9464_2249">
                                                            <rect width="14" height="14" fill="white"></rect>
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                                <p class="fz-12">{{ translate('You can see all the inactive providers who are suspended from') }} <a @can('provider_view') href="{{route('admin.provider.list', ['status'=>'all'])}}" @endif target="_blank" class="text-primary text-decoration-underline fw-medium">{{ translate('Provider List') }}</a> {{ translate('page.') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ProviderWithdraw amount -->
                                    <div class="card p-20 mb-20">
                                        <h5 class="mb-1 fz-16">{{ translate('Withdraw Amount Setup') }}</h5>
                                        <p class="fz-12 mb-20">{{ translate('Set the maximum & minimum withdraw amount during withdraw wallet balance. Providers can withdraw within Minimum and Maximum amount you set.') }}</p>
                                        <div class="card2 p-20">
                                            <div class="row g-3 mb-20">
                                                <div class="col-lg-6 col-md-6 message-textarea">
                                                    <div class="mb-2 text-dark">{{translate('Minimum Withdraw Amount')}} ({{currency_symbol()}})
                                                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                           data-bs-placement="top"
                                                           title="{{translate('Set Minimum Withdraw Amount')}}"
                                                        >info</i>
                                                    </div>
                                                    <input type="number" class="form-control"
                                                           name="minimum_withdraw_amount"
                                                           placeholder="{{translate('ex: 100')}} *"
                                                           min="1"
                                                           step="any"
                                                           required
                                                           value="{{$dataValues->where('key_name','minimum_withdraw_amount')->first()->live_values??''}}">
                                                </div>
                                                <div class="col-lg-6 col-md-6 message-textarea">
                                                    <div class="mb-2 text-dark">{{translate('Maximum Withdraw Amount')}} ({{currency_symbol()}})
                                                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                           data-bs-placement="top"
                                                           title="{{translate('Set Minimum Withdraw Amount')}}"
                                                        >info</i>
                                                    </div>
                                                    <input type="number" class="form-control"
                                                           name="maximum_withdraw_amount"
                                                           placeholder="{{translate('ex: 2000')}} *"
                                                           min="1"
                                                           step="any"
                                                           required
                                                           value="{{$dataValues->where('key_name','maximum_withdraw_amount')->first()->live_values??''}}">
                                                </div>
                                            </div>
                                            <div class="pick-map p-12 rounded d-flex flex-md-nowrap flex-wrap align-items-start gap-1 bg-primary bg-opacity-10">
                                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <g clip-path="url(#clip0_9464_2249)">
                                                        <path d="M9.79125 1.44318L10.5117 0.270677C10.6797 -0.00465646 11.039 -0.0898231 11.3138 0.0793436C11.5885 0.247927 11.6743 0.606677 11.5051 0.881427L10.7847 2.05393C10.675 2.23359 10.4831 2.33218 10.2871 2.33218C10.1827 2.33218 10.0777 2.30418 9.98259 2.24584C9.70784 2.07726 9.62209 1.71793 9.79125 1.44318ZM3.16575 2.05334C3.27542 2.23301 3.46792 2.33218 3.66392 2.33218C3.76775 2.33218 3.87275 2.30418 3.96784 2.24643C4.24259 2.07784 4.32892 1.71909 4.16034 1.44434L3.44109 0.27126C3.2725 -0.00348977 2.91317 -0.0892398 2.639 0.0787602C2.36425 0.247344 2.27792 0.606094 2.4465 0.880844L3.16575 2.05334ZM1.89059 3.34134L0.841754 2.83909C0.552421 2.69851 0.201838 2.82218 0.0641712 3.11326C-0.0752455 3.40376 0.0478378 3.75201 0.338338 3.89084L1.38717 4.39309C1.46825 4.43218 1.554 4.45084 1.63859 4.45084C1.85617 4.45084 2.065 4.32893 2.16475 4.11951C2.30417 3.82901 2.18109 3.48018 1.89059 3.34134ZM6.92067 2.33393C3.70417 2.38701 1.155 5.87301 2.9015 9.23068C3.16692 9.74051 3.56067 10.1675 3.98359 10.5566C4.144 10.7042 4.26825 10.8868 4.37442 11.0828H6.41667V8.05876C5.73942 7.81726 5.25 7.17559 5.25 6.41609C5.25 6.09351 5.51075 5.83276 5.83334 5.83276C6.15592 5.83276 6.41667 6.09351 6.41667 6.41609C6.41667 6.73868 6.678 6.99943 7 6.99943C7.322 6.99943 7.58334 6.73809 7.58334 6.41609C7.58334 6.09409 7.84409 5.83276 8.16667 5.83276C8.48925 5.83276 8.75 6.09351 8.75 6.41609C8.75 7.17559 8.26059 7.81726 7.58334 8.05876V11.0828H9.60634C9.73934 10.8547 9.91084 10.6394 10.1354 10.4522C10.5198 10.1313 10.8815 9.77376 11.1038 9.32518C12.117 7.27593 11.7151 5.09076 10.2719 3.67209C9.373 2.78776 8.18242 2.31468 6.92067 2.33393ZM4.662 12.4122C4.61534 13.2673 5.25584 14 6.11217 14H7.87442C8.68 14 9.33275 13.3473 9.33275 12.5417V12.25H4.65559C4.65559 12.3048 4.6655 12.3562 4.662 12.4122ZM13.9493 3.09168C13.8163 2.79826 13.4715 2.66584 13.1781 2.80001L12.0511 3.30868C11.7571 3.44109 11.6264 3.78643 11.7594 4.07984C11.8568 4.29568 12.0686 4.42343 12.2914 4.42343C12.3713 4.42343 12.453 4.40709 12.5306 4.37151L13.6576 3.86284C13.9516 3.73043 14.0823 3.38509 13.9493 3.09168Z" fill="#3C76F1"></path>
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_9464_2249">
                                                            <rect width="14" height="14" fill="white"></rect>
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                                <p class="fz-12">{{ translate('All the provider') }} <a @can('withdraw_view') href="{{ route('admin.withdraw.request.list', ['status'=>'all']) }}" @endcan target="_blank" class="text-primary text-decoration-underline fw-medium">{{ translate('Withdraw Request') }}</a> {{ translate('you wil find from Withdraw Request page. For further setup for withdraw request go to') }} <a @can('withdraw_add') href="{{ route('admin.withdraw.method.list') }}" @endcan target="_blank" class="text-primary text-decoration-underline fw-medium">{{ translate('Withdraw Method Setup') }}</a></p>
                                            </div>
                                        </div>
                                    </div>
                                    @can('business_update')
                                        <div class="d-flex justify-content-end trans3 mt-4">
                                            <div class="d-flex justify-content-sm-end justify-content-center gap-2 gap-sm-3 flex-grow-1 flex-grow-sm-0 bg-white action-btn-wrapper trans3">
                                                <button type="reset" class="btn btn--secondary rounded">
                                                    {{ translate('Reset') }}
                                                </button>
                                                <button type="submit" class="btn btn--primary d-flex align-items-center gap-2 rounded demo_check">
                                                    <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <g clip-path="url(#clip0_9562_1632)">
                                                            <path d="M9.91732 0.5H4.08398V4H9.91732V0.5Z" fill="white"></path>
                                                            <path d="M7.00065 9.83333C7.64498 9.83333 8.16732 9.311 8.16732 8.66667C8.16732 8.02233 7.64498 7.5 7.00065 7.5C6.35632 7.5 5.83398 8.02233 5.83398 8.66667C5.83398 9.311 6.35632 9.83333 7.00065 9.83333Z" fill="white"></path>
                                                            <path d="M11.0833 0.5V5.16667H2.91667V0.5H1.75C1.28587 0.5 0.840752 0.684374 0.512563 1.01256C0.184374 1.34075 0 1.78587 0 2.25L0 14.5H14V3.41667L11.0833 0.5ZM7 11C6.53851 11 6.08738 10.8632 5.70367 10.6068C5.31995 10.3504 5.02088 9.98596 4.84428 9.55959C4.66768 9.13323 4.62147 8.66408 4.7115 8.21146C4.80153 7.75883 5.02376 7.34307 5.35008 7.01675C5.67641 6.69043 6.09217 6.4682 6.54479 6.37817C6.99741 6.28814 7.46657 6.33434 7.89293 6.51095C8.31929 6.68755 8.68371 6.98662 8.94009 7.37034C9.19649 7.75405 9.33333 8.20518 9.33333 8.66667C9.33333 9.28551 9.0875 9.879 8.64992 10.3166C8.21233 10.7542 7.61884 11 7 11Z" fill="white"></path>
                                                        </g>
                                                        <defs>
                                                            <clipPath id="clip0_9562_1632">
                                                                <rect width="14" height="14" fill="white" transform="translate(0 0.5)"></rect>
                                                            </clipPath>
                                                        </defs>
                                                    </svg>
                                                    {{ translate('Save Information') }}
                                                </button>
                                            </div>
                                        </div>
                                    @endcan
                                </form>
                            </div>
                        </div>
                    @endif

                    <!-- Customers--->
                    @if($webPage=='customers')
                        <div class="tab-content">
                            <div class="tab-pane fade {{$webPage=='customers'?'active show':''}}" id="business-info">
                                <form action="{{route('admin.business-settings.set-customer-setup')}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <!-- Customers Wallet--->
                                    <div class="card p-20 mb-20">
                                        <div class="d-flex flex-sm-nowrap flex-wrap align-items-center justify-content-between gap-2 mb-20">
                                            @php($customerWallet = $dataValues->where('key_name', 'customer_wallet')?->first()?->live_values ?? null)
                                            <div>
                                                <h3 class="mb-1">{{ translate('Customer Wallet') }}</h3>
                                                <p class="fz-12">{{ translate('For these wallet settings customers can get the refund to the wallet and also can use their wallet money to pay for any order.') }}</p>
                                            </div>
                                            <div class="w-350 d-flex align-items-center justify-content-between border rounded p-10px">
                                                <span class="fs-14 text-dark">{{ translate('Status') }}</span>
                                                <label class="switcher">
                                                    <input class="switcher_input" type="checkbox"
                                                           id="customer_wallet"
                                                           name="customer_wallet"
                                                           value="1" {{$customerWallet ? 'checked' : ''}}>
                                                    <span class="switcher_control"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="card2 p-20 rounded">
                                            <div class="row g-3">
                                                <div class="col-lg-4 col-md-6">
                                                    @php($addFundToWallet = $dataValues->where('key_name', 'add_to_fund_wallet')?->first()?->live_values ?? null)

                                                    <div class="mb-2 text-dark">{{translate('Add Fund to Wallet')}}
                                                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                            data-bs-placement="top"
                                                            title="{{translate('Allow customers to manually add money to their wallet balance. They can use this balance for payments and also receive refunds here')}}"
                                                        >info</i>
                                                    </div>
                                                    <div class="border p-12 rounded d-flex justify-content-between bg-white">
                                                        <span class="text-dark fz-14"></span>
                                                        <label class="switcher">
                                                            <input class="switcher_input" type="checkbox"
                                                                   id="add_to_fund_wallet"
                                                                   name="add_to_fund_wallet"
                                                                   value="1" {{$addFundToWallet ? 'checked' : ''}}>
                                                            <span class="switcher_control"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Customers Laylty point--->
                                    <div class="card p-20 mb-20">
                                        <div class="d-flex flex-sm-nowrap flex-wrap align-items-center justify-content-between gap-2 mb-20">
                                            @php($loyaltyPointStatus = $dataValues->where('key_name', 'customer_loyalty_point')?->first()?->live_values ?? null)

                                            <div>
                                                <h3 class="mb-1">{{ translate('Customer Loyalty Point') }}</h3>
                                                <p class="fz-12">{{ translate('In this settings admin can set the rules for the customers for earning and use the loyalty points.') }}</p>
                                            </div>
                                            <div class="w-350 d-flex align-items-center justify-content-between border rounded p-10px">
                                                <span class="fs-14 text-dark">{{ translate('Status') }}</span>
                                                <label class="switcher">
                                                    <input class="switcher_input" type="checkbox"
                                                           id="customer_loyalty_point"
                                                           name="customer_loyalty_point"
                                                           value="1" {{$loyaltyPointStatus ? 'checked' : ''}}>
                                                    <span class="switcher_control"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="card2 p-20 rounded mb-20">
                                            <div class="row g-3">
                                                <div class="col-lg-4 col-md-6">
                                                    @php($loyaltyPointValuePerUnit = $dataValues->where('key_name', 'loyalty_point_value_per_currency_unit')?->first()?->live_values ?? null)
                                                    <div class="mb-2 text-dark">{{translate('Equivalent Point to 1')}} ({{currency_symbol()}}) <span class="text-danger">*</span>
                                                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                            data-bs-placement="top"
                                                            title="{{translate('Set how many loyalty points are required to equal 1 unit of currency')}}"
                                                        >info</i>
                                                    </div>
                                                    <input type="number" class="form-control"
                                                           name="loyalty_point_value_per_currency_unit" step="any"
                                                           min="1" value="{{$loyaltyPointValuePerUnit}}" required="">
                                                </div>
                                                <div class="col-lg-4 col-md-6">
                                                    @php($minLoyaltyPontToTransfer = $dataValues->where('key_name', 'min_loyalty_point_to_transfer')?->first()?->live_values ?? null)

                                                    <div class="mb-2 text-dark">{{translate('Minimum Point Required To Convert')}} <span class="text-danger">*</span>
                                                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                            data-bs-placement="top"
                                                            title="{{translate('The minimum number of points a customer must have before converting them into wallet money.')}}"
                                                        >info</i>
                                                    </div>
                                                    <input type="number" class="form-control"
                                                           name="min_loyalty_point_to_transfer" step="any"
                                                           min="1" value="{{$minLoyaltyPontToTransfer}}" required="">
                                                </div>

                                                <div class="col-lg-4 col-md-6">
                                                    @php($loyaltyPointPercentage=$dataValues->where('key_name','loyalty_point_percentage_per_booking')->first())

                                                    <div class="mb-2 text-dark">{{translate('Earning Percentage (%)')}} <span class="text-danger">*</span>
                                                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                           data-bs-placement="top"
                                                           title="{{translate('Percentage of the order amount that will be added as loyalty points after a successful order.')}}"
                                                        >info</i>
                                                    </div>
                                                    <input type="number" class="form-control"
                                                           name="loyalty_point_percentage_per_booking"
                                                           min="1" max="100" step="any"
                                                           value="{{$loyaltyPointPercentage->live_values??''}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Customers Referral Enarning Setting--->
                                    <div class="card p-20 mb-20">
                                        <div class="d-flex flex-sm-nowrap flex-wrap align-items-center justify-content-between gap-2 mb-20">
                                            <div>
                                                <h3 class="mb-1">{{ translate('Customer Referral Earning Settings') }}</h3>
                                                <p class="fz-12">{{ translate('Customers will receive this wallet balance rewards for sharing their referral code.') }}</p>
                                            </div>
                                            @php($customerReferralEarning = $dataValues->where('key_name', 'customer_referral_earning')?->first()?->live_values ?? null)
                                            <div class="w-350 d-flex align-items-center justify-content-between border rounded p-10px">
                                                <span class="fs-14 text-dark">{{ translate('Status') }}</span>
                                                <label class="switcher">
                                                    <input class="switcher_input" type="checkbox"
                                                           id="customer_referral_earning"
                                                           name="customer_referral_earning"
                                                           value="1" {{$customerReferralEarning ? 'checked' : ''}}>
                                                    <span class="switcher_control"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="card2 p-20 rounded mb-20">
                                            <div class="row g-3 align-items-center justify-content-between">
                                                <div class="col-xl-3 col-lg-4">
                                                    <h4 class="mb-1 fz-14">{{ translate('Who Share the Code') }}</h4>
                                                    <p class="fz-12">{{ translate('Customers will receive this wallet balance rewards for sharing their referral code with friends who use the code when signing up and completing their first order.') }}</p>
                                                </div>
                                                @php($value=$dataValues->where('key_name','referral_value_per_currency_unit')->first())

                                                <div class="col-lg-8">
                                                    <div class="mb-2 text-dark">{{translate('Earnings To Each Referral')}} ({{currency_symbol()}}) <span class="text-danger">*</span>
                                                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                            data-bs-placement="top"
                                                            title="{{ translate('The wallet reward a customer receives for each successful referral when the invited user places their first order.') }}"
                                                        >info</i>
                                                    </div>
                                                    <input type="number" class="form-control"
                                                           name="referral_value_per_currency_unit" step="any"
                                                           min="1" value="{{$value->live_values??''}}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card2 p-20 rounded">
                                            <div class="row g-3 align-items-center justify-content-between">
                                                <div class="col-xl-3 col-lg-4">
                                                    <h4 class="mb-1 fz-14">{{ translate('Who Use the Code') }}</h4>
                                                    <p class="fz-12">{{ translate('Customers will receive this wallet balance rewards for sharing their referral code with friends who use the code when signing up and completing their first order.') }}</p>
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="mb-20">
                                                        <div class="mb-2 text-dark">{{translate('Customer will Get Discount on First Order ')}}
                                                            <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                                data-bs-placement="top"
                                                                title="{{ translate('The customer who used referral code will get discount when a place their first order.') }}"
                                                            >info</i>
                                                        </div>
                                                        @php($newUserDiscount=$dataValues->where('key_name','referral_based_new_user_discount')->first())
                                                        <div class="border p-12 rounded d-flex justify-content-between bg-white">
                                                            <span class="text-dark fz-14">{{ translate('Status') }}</span>
                                                            <label class="switcher">
                                                                <input class="switcher_input"
                                                                       type="checkbox"
                                                                       name="referral_based_new_user_discount"
                                                                       id="user_discount_switch"
                                                                       value="1" {{$newUserDiscount?->live_values ? 'checked' : ''}}>
                                                                <span class="switcher_control"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="bg-white rounded p-12">
                                                        <div class="row g-3">
                                                            <div class="col-md-6">
                                                                @php($discountAmount=$dataValues->where('key_name','referral_discount_amount')->first())
                                                                @php($referralDiscountType=$dataValues->where('key_name','referral_discount_type')->first())

                                                                <label class="mb-2 text-dark">{{ translate('Discount Amount') }}</label> <span class="text-danger">*</span>
                                                                <div class="d-flex align-items-center restriction-time rounded border">
                                                                    <div class="flex-grow-1">
                                                                        <input class="form-control border-0"
                                                                               type="number"
                                                                               name="referral_discount_amount"
                                                                               id="discount_amount"
                                                                               value="{{$discountAmount?->live_values ?? 0}}"
                                                                               min="1" max="100" step="any" required>
                                                                    </div>
                                                                    <select class="form-selects h-45 custom-select px-2 w-auto bg-light border-0" name="referral_discount_type" id="referral_discount_type">
                                                                        <option value="flat" {{$referralDiscountType?->live_values == 'flat' ? 'selected' : ''}}>{{ currency_symbol() }}</option>
                                                                        <option value="percentage" {{$referralDiscountType?->live_values == 'percentage' ? 'selected' : ''}}>%</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                @php($validity = $dataValues->where('key_name','referral_discount_validity')->first())
                                                                @php($validityType = $dataValues->where('key_name','referral_discount_validity_type')->first())

                                                                <label class="mb-2 text-dark">{{ translate('Validity') }}</label> <span class="text-danger">*</span>
                                                                <div class="d-flex align-items-center restriction-time rounded border">
                                                                    <div class="flex-grow-1">
                                                                        <input class="form-control border-0"
                                                                               name="referral_discount_validity"
                                                                               id="referral_discount_validity"
                                                                               value="{{$validity?->live_values ?? 0}}"
                                                                               placeholder="Ex: 4" min="1" type="number" required="">
                                                                    </div>
                                                                    <select class="form-selects h-45 custom-select px-2 w-auto bg-light border-0" name="referral_discount_validity_type" id="referral_discount_validity_type">
                                                                        <option value="day" {{$validityType?->live_values == 'day' ? 'selected' : ''}}>{{translate('Day')}}</option>
                                                                        <option value="month" {{$validityType?->live_values == 'month' ? 'selected' : ''}}>{{translate('Month')}}</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @can('business_update')
                                    <div class="d-flex justify-content-end trans3 mt-4">
                                        <div class="d-flex justify-content-sm-end justify-content-center gap-2 gap-sm-3 flex-grow-1 flex-grow-sm-0 bg-white action-btn-wrapper trans3">
                                            <button type="reset" class="btn btn--secondary rounded">
                                                {{ translate('Reset') }}
                                            </button>
                                            <button type="submit" class="btn btn--primary d-flex align-items-center gap-2 rounded demo_check">
                                                <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <g clip-path="url(#clip0_9562_1632)">
                                                    <path d="M9.91732 0.5H4.08398V4H9.91732V0.5Z" fill="white"></path>
                                                    <path d="M7.00065 9.83333C7.64498 9.83333 8.16732 9.311 8.16732 8.66667C8.16732 8.02233 7.64498 7.5 7.00065 7.5C6.35632 7.5 5.83398 8.02233 5.83398 8.66667C5.83398 9.311 6.35632 9.83333 7.00065 9.83333Z" fill="white"></path>
                                                    <path d="M11.0833 0.5V5.16667H2.91667V0.5H1.75C1.28587 0.5 0.840752 0.684374 0.512563 1.01256C0.184374 1.34075 0 1.78587 0 2.25L0 14.5H14V3.41667L11.0833 0.5ZM7 11C6.53851 11 6.08738 10.8632 5.70367 10.6068C5.31995 10.3504 5.02088 9.98596 4.84428 9.55959C4.66768 9.13323 4.62147 8.66408 4.7115 8.21146C4.80153 7.75883 5.02376 7.34307 5.35008 7.01675C5.67641 6.69043 6.09217 6.4682 6.54479 6.37817C6.99741 6.28814 7.46657 6.33434 7.89293 6.51095C8.31929 6.68755 8.68371 6.98662 8.94009 7.37034C9.19649 7.75405 9.33333 8.20518 9.33333 8.66667C9.33333 9.28551 9.0875 9.879 8.64992 10.3166C8.21233 10.7542 7.61884 11 7 11Z" fill="white"></path>
                                                    </g>
                                                    <defs>
                                                    <clipPath id="clip0_9562_1632">
                                                    <rect width="14" height="14" fill="white" transform="translate(0 0.5)"></rect>
                                                    </clipPath>
                                                    </defs>
                                                </svg>
                                                {{ translate('Save Information') }}
                                            </button>
                                        </div>
                                    </div>
                                    @endcan
                                </form>
                            </div>
                        </div>
                </div>
            </div>
            @endif

                    <!-- Servicemen--->
                    @if($webPage=='servicemen')
                        <div class="tab-content">
                            <div class="tab-pane fade {{$webPage=='servicemen'?'active show':''}}"
                                 id="business-info">
                                <div class="pick-map p-12 rounded d-flex flex-md-nowrap flex-wrap align-items-center gap-1 mb-20 bg-primary bg-opacity-10">
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_9464_2249)">
                                            <path d="M9.79125 1.44318L10.5117 0.270677C10.6797 -0.00465646 11.039 -0.0898231 11.3138 0.0793436C11.5885 0.247927 11.6743 0.606677 11.5051 0.881427L10.7847 2.05393C10.675 2.23359 10.4831 2.33218 10.2871 2.33218C10.1827 2.33218 10.0777 2.30418 9.98259 2.24584C9.70784 2.07726 9.62209 1.71793 9.79125 1.44318ZM3.16575 2.05334C3.27542 2.23301 3.46792 2.33218 3.66392 2.33218C3.76775 2.33218 3.87275 2.30418 3.96784 2.24643C4.24259 2.07784 4.32892 1.71909 4.16034 1.44434L3.44109 0.27126C3.2725 -0.00348977 2.91317 -0.0892398 2.639 0.0787602C2.36425 0.247344 2.27792 0.606094 2.4465 0.880844L3.16575 2.05334ZM1.89059 3.34134L0.841754 2.83909C0.552421 2.69851 0.201838 2.82218 0.0641712 3.11326C-0.0752455 3.40376 0.0478378 3.75201 0.338338 3.89084L1.38717 4.39309C1.46825 4.43218 1.554 4.45084 1.63859 4.45084C1.85617 4.45084 2.065 4.32893 2.16475 4.11951C2.30417 3.82901 2.18109 3.48018 1.89059 3.34134ZM6.92067 2.33393C3.70417 2.38701 1.155 5.87301 2.9015 9.23068C3.16692 9.74051 3.56067 10.1675 3.98359 10.5566C4.144 10.7042 4.26825 10.8868 4.37442 11.0828H6.41667V8.05876C5.73942 7.81726 5.25 7.17559 5.25 6.41609C5.25 6.09351 5.51075 5.83276 5.83334 5.83276C6.15592 5.83276 6.41667 6.09351 6.41667 6.41609C6.41667 6.73868 6.678 6.99943 7 6.99943C7.322 6.99943 7.58334 6.73809 7.58334 6.41609C7.58334 6.09409 7.84409 5.83276 8.16667 5.83276C8.48925 5.83276 8.75 6.09351 8.75 6.41609C8.75 7.17559 8.26059 7.81726 7.58334 8.05876V11.0828H9.60634C9.73934 10.8547 9.91084 10.6394 10.1354 10.4522C10.5198 10.1313 10.8815 9.77376 11.1038 9.32518C12.117 7.27593 11.7151 5.09076 10.2719 3.67209C9.373 2.78776 8.18242 2.31468 6.92067 2.33393ZM4.662 12.4122C4.61534 13.2673 5.25584 14 6.11217 14H7.87442C8.68 14 9.33275 13.3473 9.33275 12.5417V12.25H4.65559C4.65559 12.3048 4.6655 12.3562 4.662 12.4122ZM13.9493 3.09168C13.8163 2.79826 13.4715 2.66584 13.1781 2.80001L12.0511 3.30868C11.7571 3.44109 11.6264 3.78643 11.7594 4.07984C11.8568 4.29568 12.0686 4.42343 12.2914 4.42343C12.3713 4.42343 12.453 4.40709 12.5306 4.37151L13.6576 3.86284C13.9516 3.73043 14.0823 3.38509 13.9493 3.09168Z" fill="#3C76F1"></path>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_9464_2249">
                                                <rect width="14" height="14" fill="white"></rect>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    <p class="fz-12">{{ translate('You can see all providers service man list from this') }} <span class="text-dark fw-medium">{{ translate('Provider Management > Provider List > Provider Details > Service Man List.') }}</span></p>
                                </div>
                                <div class="card mb-20">
                                    <div class="card-body p-20">
                                        <form action="{{route('admin.business-settings.set-servicemen')}}"
                                              method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="border-bottom mb-20 pb-3">
                                                <h3 class="mb-1">{{ translate('Booking Request Setup') }}</h3>
                                                <p class="fz-12 mb-20">{{ translate('Here you can setup for service man where they want to cancel or edit bookings.') }}</p>
                                            </div>
                                            <div class="card2 p-20 rounded mb-20">
                                                <div class="row g-2 align-items-center">
                                                    <div class="col-lg-8">
                                                        <h4 class="mb-1 fz-16">{{ translate('Cancel Booking Request') }}</h4>
                                                        <p class="fz-12">{{ translate('If enabled, Serviceman can cancel a booking request after it has been place') }}</p>
                                                    </div>
                                                    @php($value = $dataValues->where('key_name', 'serviceman_can_cancel_booking')?->first()?->live_values ?? null)

                                                    <div class="col-lg-4">
                                                        <div class="border p-12 rounded d-flex justify-content-between bg-white">
                                                            <span class="text-dark fz-14">Status</span>
                                                            <label class="switcher">
                                                                <input class="switcher_input" type="checkbox"
                                                                       id="serviceman_can_cancel_booking"
                                                                       name="serviceman_can_cancel_booking"
                                                                       value="1" {{$value ? 'checked' : ''}}>
                                                                <span class="switcher_control"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card2 p-20 rounded mb-20">
                                                <div class="row g-2 align-items-center">
                                                    <div class="col-lg-8">
                                                        <h4 class="mb-1 fz-16">{{ translate('Edit Booking Request') }}</h4>
                                                        <p class="fz-12">{{ translate('If enabled, Serviceman can edit a booking request after it has been place') }}</p>
                                                    </div>
                                                    @php($value = $dataValues->where('key_name', 'serviceman_can_edit_booking')?->first()?->live_values ?? null)
                                                    <div class="col-lg-4">
                                                        <div class="border p-12 rounded d-flex justify-content-between bg-white">
                                                            <span class="text-dark fz-14">Status</span>
                                                            <label class="switcher">
                                                                <input class="switcher_input" type="checkbox"
                                                                       id="serviceman_can_edit_booking"
                                                                       name="serviceman_can_edit_booking"
                                                                       value="1" {{$value ? 'checked' : ''}}>
                                                                <span class="switcher_control"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            @can('business_update')
                                                <div class="d-flex justify-content-end trans3 mt-4">
                                                    <div class="d-flex justify-content-sm-end justify-content-center gap-2 gap-sm-3 flex-grow-1 flex-grow-sm-0 bg-white action-btn-wrapper trans3">
                                                        <button type="reset" class="btn btn--secondary rounded">
                                                            {{ translate('Reset') }}
                                                        </button>
                                                        <button type="submit" class="btn btn--primary d-flex align-items-center gap-2 rounded demo_check">
                                                            <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <g clip-path="url(#clip0_9562_1632)">
                                                                    <path d="M9.91732 0.5H4.08398V4H9.91732V0.5Z" fill="white"></path>
                                                                    <path d="M7.00065 9.83333C7.64498 9.83333 8.16732 9.311 8.16732 8.66667C8.16732 8.02233 7.64498 7.5 7.00065 7.5C6.35632 7.5 5.83398 8.02233 5.83398 8.66667C5.83398 9.311 6.35632 9.83333 7.00065 9.83333Z" fill="white"></path>
                                                                    <path d="M11.0833 0.5V5.16667H2.91667V0.5H1.75C1.28587 0.5 0.840752 0.684374 0.512563 1.01256C0.184374 1.34075 0 1.78587 0 2.25L0 14.5H14V3.41667L11.0833 0.5ZM7 11C6.53851 11 6.08738 10.8632 5.70367 10.6068C5.31995 10.3504 5.02088 9.98596 4.84428 9.55959C4.66768 9.13323 4.62147 8.66408 4.7115 8.21146C4.80153 7.75883 5.02376 7.34307 5.35008 7.01675C5.67641 6.69043 6.09217 6.4682 6.54479 6.37817C6.99741 6.28814 7.46657 6.33434 7.89293 6.51095C8.31929 6.68755 8.68371 6.98662 8.94009 7.37034C9.19649 7.75405 9.33333 8.20518 9.33333 8.66667C9.33333 9.28551 9.0875 9.879 8.64992 10.3166C8.21233 10.7542 7.61884 11 7 11Z" fill="white"></path>
                                                                </g>
                                                                <defs>
                                                                    <clipPath id="clip0_9562_1632">
                                                                        <rect width="14" height="14" fill="white" transform="translate(0 0.5)"></rect>
                                                                    </clipPath>
                                                                </defs>
                                                            </svg>
                                                            {{ translate('Save Information') }}
                                                        </button>
                                                    </div>
                                                </div>
                                            @endcan


                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Promotions--->
                    @if($webPage=='promotional_setup')
                        <div class="tab-content">
                            <div class="tab-pane fade {{$webPage=='promotional_setup'?'active show':''}}">

                                <form action="{{route('admin.business-settings.set-promotion-setup')}}"
                                      method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="card p-20 mb-20">
                                        <div class="mb-20">
                                            <h5 class="mb-2 fz-16">{{ translate('Normal Discount') }}</h5>
                                            <p class="fz-12">{{ translate('Set who bearers the cost of regular discounts Admin, Provider, or Both.') }}</p>
                                        </div>

                                        @php($DiscountCostData = $dataValues->where('key_name', 'discount_cost_bearer')->first()->live_values ?? null)

                                        <div class="card2 rounded p-20 maintenance-dates mb-20">
                                            <h6 class="fw-normal mb-xxl-3 mb-2 text-dark fz-14">{{ translate('Discount Cost Bearer') }}</h6>
                                            <div class="bg-white cus-shadow rounded p-10">
                                                <div class="row g-1">
                                                    <div class="col-sm-6 col-lg-4">
                                                        <div class="form-check mb-0 form--check">
                                                            <input class="form-check-input" type="radio" id="admin-select__discount"
                                                                   name="discount[bearer]"
                                                                   value="admin" {{isset($DiscountCostData) && $DiscountCostData['bearer'] == 'admin' ? 'checked' : ''}}>
                                                            <label class="form-check-label text-dark fw-normal" for="admin-select__discount">{{ translate('Admin') }}</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 col-lg-4">
                                                        <div class="form-check mb-0 form--check">
                                                            <input class="form-check-input" type="radio" id="provider-select__discount"
                                                                   name="discount[bearer]"
                                                                   value="provider" {{isset($DiscountCostData) && $DiscountCostData['bearer'] == 'provider' ? 'checked' : ''}}>
                                                            <label class="form-check-label text-dark fw-normal" for="provider-select__discount">{{ translate('Provider') }}</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 col-lg-4">
                                                        <div class="form-check mb-0 form--check">
                                                            <input class="form-check-input" type="radio"  id="both-select__discount"
                                                                   name="discount[bearer]"
                                                                   value="both" {{isset($DiscountCostData) && $DiscountCostData['bearer'] == 'both' ? 'checked' : ''}}>
                                                            <label class="form-check-label text-dark fw-normal" for="both-select__discount">{{ translate('Both') }}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card2 rounded p-20 mb-20 {{isset($DiscountCostData) && ($DiscountCostData['bearer'] != 'admin' && $DiscountCostData['bearer'] != 'provider') ? '' : 'd-none'}}" id="bearer-section__discount">
                                            <div class="row g-3">
                                                <div class="col-lg-6 col-md-6 message-textarea">
                                                    <div class="mb-1 text-dark d-flex align-items-center gap-1">
                                                        {{translate('Admin_Percentage')}} (%)<span class="text-danger">*</span>
                                                    </div>
                                                    <p class="fz-12 mb-10">{{ translate('Percentage of discount cost bearer by Admin') }}</p>
                                                    <input type="number" class="form-control"
                                                           name="discount[admin_percentage]"
                                                           id="admin_percentage__discount"
                                                           placeholder="{{translate('Admin_Percentage')}} (%)"
                                                           value="{{!is_null($DiscountCostData) ? $DiscountCostData['admin_percentage'] : ''}}"
                                                           min="0" max="100" step="any">
                                                </div>
                                                <div class="col-lg-6 col-md-6 message-textarea">
                                                    <div class="mb-1 text-dark d-flex align-items-center gap-1">
                                                        {{translate('Provider_Percentage')}} (%)<span class="text-danger">*</span>
                                                    </div>
                                                    <p class="fz-12 mb-10">{{ translate('Percentage of discount cost bearer by Provider') }}</p>
                                                    <input type="number" class="form-control"
                                                           name="discount[provider_percentage]"
                                                           id="provider_percentage__discount"
                                                           placeholder="{{translate('Provider_Percentage')}} (%)"
                                                           value="{{!is_null($DiscountCostData) ? $DiscountCostData['provider_percentage'] : ''}}"
                                                           min="0" max="100" step="any">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="pick-map p-12 rounded d-flex flex-md-nowrap flex-wrap align-items-center gap-1 bg-primary bg-opacity-10">
                                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0_9464_2249)">
                                                    <path d="M9.79125 1.44318L10.5117 0.270677C10.6797 -0.00465646 11.039 -0.0898231 11.3138 0.0793436C11.5885 0.247927 11.6743 0.606677 11.5051 0.881427L10.7847 2.05393C10.675 2.23359 10.4831 2.33218 10.2871 2.33218C10.1827 2.33218 10.0777 2.30418 9.98259 2.24584C9.70784 2.07726 9.62209 1.71793 9.79125 1.44318ZM3.16575 2.05334C3.27542 2.23301 3.46792 2.33218 3.66392 2.33218C3.76775 2.33218 3.87275 2.30418 3.96784 2.24643C4.24259 2.07784 4.32892 1.71909 4.16034 1.44434L3.44109 0.27126C3.2725 -0.00348977 2.91317 -0.0892398 2.639 0.0787602C2.36425 0.247344 2.27792 0.606094 2.4465 0.880844L3.16575 2.05334ZM1.89059 3.34134L0.841754 2.83909C0.552421 2.69851 0.201838 2.82218 0.0641712 3.11326C-0.0752455 3.40376 0.0478378 3.75201 0.338338 3.89084L1.38717 4.39309C1.46825 4.43218 1.554 4.45084 1.63859 4.45084C1.85617 4.45084 2.065 4.32893 2.16475 4.11951C2.30417 3.82901 2.18109 3.48018 1.89059 3.34134ZM6.92067 2.33393C3.70417 2.38701 1.155 5.87301 2.9015 9.23068C3.16692 9.74051 3.56067 10.1675 3.98359 10.5566C4.144 10.7042 4.26825 10.8868 4.37442 11.0828H6.41667V8.05876C5.73942 7.81726 5.25 7.17559 5.25 6.41609C5.25 6.09351 5.51075 5.83276 5.83334 5.83276C6.15592 5.83276 6.41667 6.09351 6.41667 6.41609C6.41667 6.73868 6.678 6.99943 7 6.99943C7.322 6.99943 7.58334 6.73809 7.58334 6.41609C7.58334 6.09409 7.84409 5.83276 8.16667 5.83276C8.48925 5.83276 8.75 6.09351 8.75 6.41609C8.75 7.17559 8.26059 7.81726 7.58334 8.05876V11.0828H9.60634C9.73934 10.8547 9.91084 10.6394 10.1354 10.4522C10.5198 10.1313 10.8815 9.77376 11.1038 9.32518C12.117 7.27593 11.7151 5.09076 10.2719 3.67209C9.373 2.78776 8.18242 2.31468 6.92067 2.33393ZM4.662 12.4122C4.61534 13.2673 5.25584 14 6.11217 14H7.87442C8.68 14 9.33275 13.3473 9.33275 12.5417V12.25H4.65559C4.65559 12.3048 4.6655 12.3562 4.662 12.4122ZM13.9493 3.09168C13.8163 2.79826 13.4715 2.66584 13.1781 2.80001L12.0511 3.30868C11.7571 3.44109 11.6264 3.78643 11.7594 4.07984C11.8568 4.29568 12.0686 4.42343 12.2914 4.42343C12.3713 4.42343 12.453 4.40709 12.5306 4.37151L13.6576 3.86284C13.9516 3.73043 14.0823 3.38509 13.9493 3.09168Z" fill="#3C76F1"></path>
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_9464_2249">
                                                        <rect width="14" height="14" fill="white"></rect>
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                            <p class="fz-12">{{ translate('You can manage your normal discount from here') }} <a @can('discount_view') href="{{ route('admin.discount.list') }}" @endcan target="_blank" class="text-primary fw-medium text-underline">{{ translate('Normal Discount') }}</a></p>
                                        </div>
                                    </div>

                                    <div class="card p-20 mb-20">
                                        <div class="mb-20">
                                            <h5 class="mb-2 fz-16">{{ translate('Campaign Discount') }}</h5>
                                            <p class="fz-12">{{ translate('Choose who bears the cost of promotional campaign discounts.') }}</p>
                                        </div>

                                        @php($campaignCostData = $dataValues->where('key_name', 'campaign_cost_bearer')->first()->live_values ?? null)

                                        <div class="card2 rounded p-20 maintenance-dates mb-20">
                                            <h6 class="fw-normal mb-xxl-3 mb-2 text-dark fz-14">{{ translate('Discount Cost Bearer') }}</h6>
                                            <div class="bg-white cus-shadow rounded p-10">
                                                <div class="row g-1">
                                                    <div class="col-sm-6 col-lg-4">
                                                        <div class="form-check mb-0 form--check">
                                                            <input class="form-check-input" type="radio" id="admin-select__campaign"
                                                                   name="campaign[bearer]"
                                                                   value="admin" {{isset($campaignCostData) && $campaignCostData['bearer'] == 'admin' ? 'checked' : ''}}>
                                                            <label class="form-check-label text-dark fw-normal" for="admin-select__campaign">{{ translate('Admin') }}</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 col-lg-4">
                                                        <div class="form-check mb-0 form--check">
                                                            <input class="form-check-input" type="radio" id="provider-select__campaign"
                                                                   name="campaign[bearer]"
                                                                   value="provider" {{isset($campaignCostData) && $campaignCostData['bearer'] == 'provider' ? 'checked' : ''}}>
                                                            <label class="form-check-label text-dark fw-normal" for="provider-select__campaign">{{ translate('Provider') }}</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 col-lg-4">
                                                        <div class="form-check mb-0 form--check">
                                                            <input class="form-check-input" type="radio" id="both-select__campaign"
                                                                   name="campaign[bearer]"
                                                                   value="both" {{isset($campaignCostData) && $campaignCostData['bearer'] == 'both' ? 'checked' : ''}}>
                                                            <label class="form-check-label text-dark fw-normal" for="both-select__campaign">{{ translate('Both') }}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card2 rounded p-20 mb-20 {{isset($campaignCostData) && ($campaignCostData['bearer'] != 'admin' && $campaignCostData['bearer'] != 'provider') ? '' : 'd-none'}}" id="bearer-section__campaign">
                                            <div class="row g-3">
                                                <div class="col-lg-6 col-md-6 message-textarea">
                                                    <div class="mb-1 text-dark d-flex align-items-center gap-1">
                                                        {{translate('Admin_Percentage')}} (%)<span class="text-danger">*</span>
                                                    </div>
                                                    <p class="fz-12 mb-10">{{ translate('Percentage of campaign cost bearer by Admin') }}</p>
                                                    <input type="number" class="form-control"
                                                           name="campaign[admin_percentage]"
                                                           id="admin_percentage__campaign"
                                                           placeholder="{{translate('Admin_Percentage')}} (%)"
                                                           value="{{!is_null($campaignCostData) ? $campaignCostData['admin_percentage'] : ''}}"
                                                           min="0" max="100" step="any">
                                                </div>
                                                <div class="col-lg-6 col-md-6 message-textarea">
                                                    <div class="mb-1 text-dark d-flex align-items-center gap-1">
                                                        {{translate('Provider_Percentage')}} (%)<span class="text-danger">*</span>
                                                    </div>
                                                    <p class="fz-12 mb-10">{{ translate('Percentage of campaign cost bearer by Provider') }}</p>
                                                    <input type="number" class="form-control"
                                                           name="campaign[provider_percentage]"
                                                           id="provider_percentage__campaign"
                                                           placeholder="{{translate('Provider_Percentage')}} (%)"
                                                           value="{{!is_null($campaignCostData) ? $campaignCostData['provider_percentage'] : ''}}"
                                                           min="0" max="100" step="any">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="pick-map p-12 rounded d-flex flex-md-nowrap flex-wrap align-items-center gap-1 bg-primary bg-opacity-10">
                                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0_9464_2249)">
                                                    <path d="M9.79125 1.44318L10.5117 0.270677C10.6797 -0.00465646 11.039 -0.0898231 11.3138 0.0793436C11.5885 0.247927 11.6743 0.606677 11.5051 0.881427L10.7847 2.05393C10.675 2.23359 10.4831 2.33218 10.2871 2.33218C10.1827 2.33218 10.0777 2.30418 9.98259 2.24584C9.70784 2.07726 9.62209 1.71793 9.79125 1.44318ZM3.16575 2.05334C3.27542 2.23301 3.46792 2.33218 3.66392 2.33218C3.76775 2.33218 3.87275 2.30418 3.96784 2.24643C4.24259 2.07784 4.32892 1.71909 4.16034 1.44434L3.44109 0.27126C3.2725 -0.00348977 2.91317 -0.0892398 2.639 0.0787602C2.36425 0.247344 2.27792 0.606094 2.4465 0.880844L3.16575 2.05334ZM1.89059 3.34134L0.841754 2.83909C0.552421 2.69851 0.201838 2.82218 0.0641712 3.11326C-0.0752455 3.40376 0.0478378 3.75201 0.338338 3.89084L1.38717 4.39309C1.46825 4.43218 1.554 4.45084 1.63859 4.45084C1.85617 4.45084 2.065 4.32893 2.16475 4.11951C2.30417 3.82901 2.18109 3.48018 1.89059 3.34134ZM6.92067 2.33393C3.70417 2.38701 1.155 5.87301 2.9015 9.23068C3.16692 9.74051 3.56067 10.1675 3.98359 10.5566C4.144 10.7042 4.26825 10.8868 4.37442 11.0828H6.41667V8.05876C5.73942 7.81726 5.25 7.17559 5.25 6.41609C5.25 6.09351 5.51075 5.83276 5.83334 5.83276C6.15592 5.83276 6.41667 6.09351 6.41667 6.41609C6.41667 6.73868 6.678 6.99943 7 6.99943C7.322 6.99943 7.58334 6.73809 7.58334 6.41609C7.58334 6.09409 7.84409 5.83276 8.16667 5.83276C8.48925 5.83276 8.75 6.09351 8.75 6.41609C8.75 7.17559 8.26059 7.81726 7.58334 8.05876V11.0828H9.60634C9.73934 10.8547 9.91084 10.6394 10.1354 10.4522C10.5198 10.1313 10.8815 9.77376 11.1038 9.32518C12.117 7.27593 11.7151 5.09076 10.2719 3.67209C9.373 2.78776 8.18242 2.31468 6.92067 2.33393ZM4.662 12.4122C4.61534 13.2673 5.25584 14 6.11217 14H7.87442C8.68 14 9.33275 13.3473 9.33275 12.5417V12.25H4.65559C4.65559 12.3048 4.6655 12.3562 4.662 12.4122ZM13.9493 3.09168C13.8163 2.79826 13.4715 2.66584 13.1781 2.80001L12.0511 3.30868C11.7571 3.44109 11.6264 3.78643 11.7594 4.07984C11.8568 4.29568 12.0686 4.42343 12.2914 4.42343C12.3713 4.42343 12.453 4.40709 12.5306 4.37151L13.6576 3.86284C13.9516 3.73043 14.0823 3.38509 13.9493 3.09168Z" fill="#3C76F1"></path>
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_9464_2249">
                                                        <rect width="14" height="14" fill="white"></rect>
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                            <p class="fz-12">{{ translate('You can manage your campaign discount from here') }} <a @can('campaign_view') href="{{ route('admin.campaign.list') }}" @endcan target="_blank" class="text-primary fw-medium text-underline">{{ translate('Campaign Discount') }}</a></p>
                                        </div>
                                    </div>

                                    <div class="card p-20 mb-20">
                                        <div class="mb-20">
                                            <h5 class="mb-2 fz-16">{{ translate('Coupon Discount') }}</h5>
                                            <p class="fz-12">{{ translate('Assign discount responsibility and split costs for coupon-based offers.') }}</p>
                                        </div>

                                        @php($couponDiscountData = $dataValues->where('key_name', 'coupon_cost_bearer')->first()->live_values ?? null)

                                        <div class="card2 rounded p-20 maintenance-dates mb-20">
                                            <h6 class="fw-normal mb-xxl-3 mb-2 text-dark fz-14">{{ translate('Discount Cost Bearer') }}</h6>
                                            <div class="bg-white cus-shadow rounded p-10">
                                                <div class="row g-1">
                                                    <div class="col-sm-6 col-lg-4">
                                                        <div class="form-check mb-0 form--check">
                                                            <input class="form-check-input" type="radio" id="admin-select__coupon"
                                                                   name="coupon[bearer]"
                                                                   value="admin" {{isset($couponDiscountData) && $couponDiscountData['bearer'] == 'admin' ? 'checked' : ''}}>
                                                            <label class="form-check-label text-dark fw-normal" for="admin-select__coupon">{{ translate('Admin') }}</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 col-lg-4">
                                                        <div class="form-check mb-0 form--check">
                                                            <input class="form-check-input" type="radio" id="provider-select__coupon"
                                                                   name="coupon[bearer]"
                                                                   value="provider" {{isset($couponDiscountData) && $couponDiscountData['bearer'] == 'provider' ? 'checked' : ''}}>
                                                            <label class="form-check-label text-dark fw-normal" for="provider-select__coupon">{{ translate('Provider') }}</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 col-lg-4">
                                                        <div class="form-check mb-0 form--check">
                                                            <input class="form-check-input" type="radio" id="both-select__coupon"
                                                                   name="coupon[bearer]"
                                                                   value="both" {{isset($couponDiscountData) && $couponDiscountData['bearer'] == 'both' ? 'checked' : ''}}>
                                                            <label class="form-check-label text-dark fw-normal" for="both-select__coupon">{{ translate('Both') }}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card2 rounded p-20 mb-20 {{isset($couponDiscountData) && ($couponDiscountData['bearer'] != 'admin' && $couponDiscountData['bearer'] != 'provider') ? '' : 'd-none'}}" id="bearer-section__coupon">
                                            <div class="row g-3">
                                                <div class="col-lg-6 col-md-6 message-textarea">
                                                    <div class="mb-1 text-dark d-flex align-items-center gap-1">
                                                        {{translate('Admin_Percentage')}} (%)<span class="text-danger">*</span>
                                                    </div>
                                                    <p class="fz-12 mb-10">{{ translate('Percentage of coupon cost bearer by Admin') }}</p>
                                                    <input type="number" class="form-control"
                                                           name="coupon[admin_percentage]"
                                                           id="admin_percentage__coupon"
                                                           placeholder="{{translate('Admin_Percentage')}} (%)"
                                                           value="{{!is_null($couponDiscountData) ? $couponDiscountData['admin_percentage'] : ''}}"
                                                           min="0" max="100" step="any">
                                                </div>
                                                <div class="col-lg-6 col-md-6 message-textarea">
                                                    <div class="mb-1 text-dark d-flex align-items-center gap-1">
                                                        {{translate('Provider_Percentage')}} (%)<span class="text-danger">*</span>
                                                    </div>
                                                    <p class="fz-12 mb-10">{{ translate('Percentage of coupon cost bearer by Provider') }}</p>
                                                    <input type="number" class="form-control"
                                                           name="coupon[provider_percentage]"
                                                           id="provider_percentage__coupon"
                                                           placeholder="{{translate('Provider_Percentage')}} (%)"
                                                           value="{{!is_null($couponDiscountData) ? $couponDiscountData['provider_percentage'] : ''}}"
                                                           min="0" max="100" step="any">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pick-map p-12 rounded d-flex flex-md-nowrap flex-wrap align-items-center gap-1 bg-primary bg-opacity-10">
                                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0_9464_2249)">
                                                    <path d="M9.79125 1.44318L10.5117 0.270677C10.6797 -0.00465646 11.039 -0.0898231 11.3138 0.0793436C11.5885 0.247927 11.6743 0.606677 11.5051 0.881427L10.7847 2.05393C10.675 2.23359 10.4831 2.33218 10.2871 2.33218C10.1827 2.33218 10.0777 2.30418 9.98259 2.24584C9.70784 2.07726 9.62209 1.71793 9.79125 1.44318ZM3.16575 2.05334C3.27542 2.23301 3.46792 2.33218 3.66392 2.33218C3.76775 2.33218 3.87275 2.30418 3.96784 2.24643C4.24259 2.07784 4.32892 1.71909 4.16034 1.44434L3.44109 0.27126C3.2725 -0.00348977 2.91317 -0.0892398 2.639 0.0787602C2.36425 0.247344 2.27792 0.606094 2.4465 0.880844L3.16575 2.05334ZM1.89059 3.34134L0.841754 2.83909C0.552421 2.69851 0.201838 2.82218 0.0641712 3.11326C-0.0752455 3.40376 0.0478378 3.75201 0.338338 3.89084L1.38717 4.39309C1.46825 4.43218 1.554 4.45084 1.63859 4.45084C1.85617 4.45084 2.065 4.32893 2.16475 4.11951C2.30417 3.82901 2.18109 3.48018 1.89059 3.34134ZM6.92067 2.33393C3.70417 2.38701 1.155 5.87301 2.9015 9.23068C3.16692 9.74051 3.56067 10.1675 3.98359 10.5566C4.144 10.7042 4.26825 10.8868 4.37442 11.0828H6.41667V8.05876C5.73942 7.81726 5.25 7.17559 5.25 6.41609C5.25 6.09351 5.51075 5.83276 5.83334 5.83276C6.15592 5.83276 6.41667 6.09351 6.41667 6.41609C6.41667 6.73868 6.678 6.99943 7 6.99943C7.322 6.99943 7.58334 6.73809 7.58334 6.41609C7.58334 6.09409 7.84409 5.83276 8.16667 5.83276C8.48925 5.83276 8.75 6.09351 8.75 6.41609C8.75 7.17559 8.26059 7.81726 7.58334 8.05876V11.0828H9.60634C9.73934 10.8547 9.91084 10.6394 10.1354 10.4522C10.5198 10.1313 10.8815 9.77376 11.1038 9.32518C12.117 7.27593 11.7151 5.09076 10.2719 3.67209C9.373 2.78776 8.18242 2.31468 6.92067 2.33393ZM4.662 12.4122C4.61534 13.2673 5.25584 14 6.11217 14H7.87442C8.68 14 9.33275 13.3473 9.33275 12.5417V12.25H4.65559C4.65559 12.3048 4.6655 12.3562 4.662 12.4122ZM13.9493 3.09168C13.8163 2.79826 13.4715 2.66584 13.1781 2.80001L12.0511 3.30868C11.7571 3.44109 11.6264 3.78643 11.7594 4.07984C11.8568 4.29568 12.0686 4.42343 12.2914 4.42343C12.3713 4.42343 12.453 4.40709 12.5306 4.37151L13.6576 3.86284C13.9516 3.73043 14.0823 3.38509 13.9493 3.09168Z" fill="#3C76F1"></path>
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_9464_2249">
                                                        <rect width="14" height="14" fill="white"></rect>
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                            <p class="fz-12">{{ translate('You can manage your coupon discount from here') }} <a @can('coupon_view') href="{{ route('admin.coupon.list') }}" @endcan target="_blank" class="text-primary fw-medium text-underline">{{ translate('Coupon Discount') }}</a></p>
                                        </div>
                                    </div>

                                    @can('business_update')
                                        <div class="d-flex justify-content-end trans3 mt-4">
                                            <div class="d-flex justify-content-sm-end justify-content-center gap-2 gap-sm-3 flex-grow-1 flex-grow-sm-0 bg-white action-btn-wrapper trans3">
                                                <button type="reset" class="btn btn--secondary rounded" id="promotion-reset">
                                                    {{ translate('Reset') }}
                                                </button>
                                                <button type="submit" class="btn btn--primary d-flex align-items-center gap-2 rounded demo_check">
                                                    <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <g clip-path="url(#clip0_9562_1632)">
                                                            <path d="M9.91732 0.5H4.08398V4H9.91732V0.5Z" fill="white"></path>
                                                            <path d="M7.00065 9.83333C7.64498 9.83333 8.16732 9.311 8.16732 8.66667C8.16732 8.02233 7.64498 7.5 7.00065 7.5C6.35632 7.5 5.83398 8.02233 5.83398 8.66667C5.83398 9.311 6.35632 9.83333 7.00065 9.83333Z" fill="white"></path>
                                                            <path d="M11.0833 0.5V5.16667H2.91667V0.5H1.75C1.28587 0.5 0.840752 0.684374 0.512563 1.01256C0.184374 1.34075 0 1.78587 0 2.25L0 14.5H14V3.41667L11.0833 0.5ZM7 11C6.53851 11 6.08738 10.8632 5.70367 10.6068C5.31995 10.3504 5.02088 9.98596 4.84428 9.55959C4.66768 9.13323 4.62147 8.66408 4.7115 8.21146C4.80153 7.75883 5.02376 7.34307 5.35008 7.01675C5.67641 6.69043 6.09217 6.4682 6.54479 6.37817C6.99741 6.28814 7.46657 6.33434 7.89293 6.51095C8.31929 6.68755 8.68371 6.98662 8.94009 7.37034C9.19649 7.75405 9.33333 8.20518 9.33333 8.66667C9.33333 9.28551 9.0875 9.879 8.64992 10.3166C8.21233 10.7542 7.61884 11 7 11Z" fill="white"></path>
                                                        </g>
                                                        <defs>
                                                            <clipPath id="clip0_9562_1632">
                                                                <rect width="14" height="14" fill="white" transform="translate(0 0.5)"></rect>
                                                            </clipPath>
                                                        </defs>
                                                    </svg>
                                                    {{ translate('Save Information') }}
                                                </button>
                                            </div>
                                        </div>
                                    @endcan
                                </form>

                            </div>
                        </div>
                    @endif

                    @if($webPage=='business_plan')
                        <div class="tab-content">
                            <div class="tab-pane fade {{$webPage=='business_plan'?'active show':''}}">

                                <form action="{{route('admin.business-settings.set-business-model-setup')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <!--Business Model Setup-->
                                    <div class="card rounded cus-shadow p-20 mb-20">
                                        <h5 class="mb-1 fz-16">{{ translate('Business Model Setup') }}</h5>
                                        <p class="fz-12 mb-20">{{ translate('Setup your business model from here') }}</p>
                                        <div class="card2 p-20">
                                            <div class="mb-2 text-dark">{{translate('Business Model')}}
                                                <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                   data-bs-placement="top"
                                                   title="{{translate('User can select Business model from subscription model or Commission model, also set Default Commission percentage.')}}"
                                                >info</i>
                                            </div>
                                            <div class="cus-shadow card rounded p-20 bg-white mb-20">
                                                <div class="row g-3">
                                                    <div class="col-lg-6">
                                                        @php($subscriptionModel = $dataValues->where('key_name', 'provider_subscription')?->first()?->live_values ?? null)

                                                        <div class="d-flex flex-sm-nowrap flex-wrap gap-sm-3 gap-2 align-items-start">
                                                            <div class="form-check form--check">
                                                                <input class="form-check-input form-check-lg"
                                                                       @if($subscriptionModel && $providerCount > 0) data-bs-toggle="modal" data-bs-target="#subscriptionToCommission" @endif
                                                                       type="checkbox"
                                                                       name="provider_subscription"
                                                                       id="provider_subscription"
                                                                       value="1" {{$subscriptionModel ? 'checked' : ''}}
                                                                       data-id="provider_subscription"
                                                                       data-message="{{ucfirst(translate('provider_subscription'))}}">
                                                            </div>
                                                            <div>
                                                                <h5 class="text-dark mb-2">{{ translate('Subscription') }}</h5>
                                                                <p class="fz-12 mb-3 max-w-500">
                                                                    {{ translate('By selecting the subscription-based business model, provider can operate with you using a chosen subscription package.') }}
                                                                </p>
                                                                <div class="pick-map p-12 rounded bg-warning bg-opacity-10 d-flex flex-md-nowrap flex-wrap align-items-start gap-1">
                                                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <g clip-path="url(#clip0_9562_195)">
                                                                            <path d="M7 14C8.38447 14 9.73785 13.5895 10.889 12.8203C12.0401 12.0511 12.9373 10.9579 13.4672 9.67879C13.997 8.3997 14.1356 6.99224 13.8655 5.63437C13.5954 4.2765 12.9287 3.02922 11.9497 2.05026C10.9708 1.07129 9.7235 0.404603 8.36563 0.134506C7.00777 -0.13559 5.6003 0.003033 4.32122 0.532846C3.04213 1.06266 1.94888 1.95987 1.17971 3.11101C0.410543 4.26216 0 5.61553 0 7C0.0020073 8.8559 0.74015 10.6352 2.05247 11.9475C3.36479 13.2599 5.1441 13.998 7 14ZM7 2.91667C7.17306 2.91667 7.34223 2.96799 7.48612 3.06413C7.63002 3.16028 7.74217 3.29694 7.8084 3.45682C7.87462 3.61671 7.89195 3.79264 7.85819 3.96237C7.82443 4.13211 7.74109 4.28802 7.61872 4.41039C7.49635 4.53276 7.34044 4.6161 7.1707 4.64986C7.00097 4.68362 6.82504 4.66629 6.66515 4.60006C6.50527 4.53384 6.36861 4.42169 6.27246 4.27779C6.17632 4.1339 6.125 3.96473 6.125 3.79167C6.125 3.55961 6.21719 3.33705 6.38128 3.17295C6.54538 3.00886 6.76794 2.91667 7 2.91667ZM6.41667 5.83334H7C7.30942 5.83334 7.60617 5.95625 7.82496 6.17505C8.04375 6.39384 8.16667 6.69058 8.16667 7V10.5C8.16667 10.6547 8.10521 10.8031 7.99581 10.9125C7.88642 11.0219 7.73804 11.0833 7.58333 11.0833C7.42862 11.0833 7.28025 11.0219 7.17086 10.9125C7.06146 10.8031 7 10.6547 7 10.5V7H6.41667C6.26196 7 6.11358 6.93855 6.00419 6.82915C5.89479 6.71975 5.83333 6.57138 5.83333 6.41667C5.83333 6.26196 5.89479 6.11359 6.00419 6.00419C6.11358 5.8948 6.26196 5.83334 6.41667 5.83334Z" fill="#FFBB38"/>
                                                                        </g>
                                                                        <defs>
                                                                            <clipPath id="clip0_9562_195">
                                                                                <rect width="14" height="14" fill="white"/>
                                                                            </clipPath>
                                                                        </defs>
                                                                    </svg>
                                                                    <p class="fz-12">{{ translate('To active subscription based business model first you need to add subscription package from') }} <a @can('subscription_package_view') href="{{ route('admin.subscription.package.list') }}" @endcan target="_blank" class="fw-semibold text-primary text-decoration-underline">{{ translate('Subscription Packages') }}</a></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        @php($commissionModel = $dataValues->where('key_name', 'provider_commision')?->first()?->live_values ?? null)

                                                        <div class="d-flex flex-sm-nowrap flex-wrap gap-sm-3 gap-2 align-items-start">
                                                            <div class="form-check form--check">
                                                                <input class="form-check-input form-check-lg"
                                                                       @if($commissionModel && $providerCount > 0) data-bs-toggle="modal" data-bs-target="#commissionToSubscription" @endif
                                                                       type="checkbox"
                                                                       name="provider_commision"
                                                                       id="provider_commision"
                                                                       value="1" {{$commissionModel ? 'checked' : ''}}
                                                                       data-id="provider_commision"
                                                                       data-message="{{ucfirst(translate('provider_commision'))}}">
                                                            </div>
                                                            <div>
                                                                <h5 class="text-dark mb-2">{{ translate('Commission') }}</h5>
                                                                <p class="fz-12 mb-3 max-w-500">
                                                                    {{ translate('By selecting commission based business model provider can run business with you based on commission based payment per booking.') }}
                                                                </p>
                                                                <div class="pick-map p-12 rounded d-flex flex-md-nowrap flex-wrap align-items-start gap-1 bg-primary bg-opacity-10 bg-primary bg-opacity-10">
                                                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <g clip-path="url(#clip0_9464_2249)">
                                                                            <path d="M9.79125 1.44318L10.5117 0.270677C10.6797 -0.00465646 11.039 -0.0898231 11.3138 0.0793436C11.5885 0.247927 11.6743 0.606677 11.5051 0.881427L10.7847 2.05393C10.675 2.23359 10.4831 2.33218 10.2871 2.33218C10.1827 2.33218 10.0777 2.30418 9.98259 2.24584C9.70784 2.07726 9.62209 1.71793 9.79125 1.44318ZM3.16575 2.05334C3.27542 2.23301 3.46792 2.33218 3.66392 2.33218C3.76775 2.33218 3.87275 2.30418 3.96784 2.24643C4.24259 2.07784 4.32892 1.71909 4.16034 1.44434L3.44109 0.27126C3.2725 -0.00348977 2.91317 -0.0892398 2.639 0.0787602C2.36425 0.247344 2.27792 0.606094 2.4465 0.880844L3.16575 2.05334ZM1.89059 3.34134L0.841754 2.83909C0.552421 2.69851 0.201838 2.82218 0.0641712 3.11326C-0.0752455 3.40376 0.0478378 3.75201 0.338338 3.89084L1.38717 4.39309C1.46825 4.43218 1.554 4.45084 1.63859 4.45084C1.85617 4.45084 2.065 4.32893 2.16475 4.11951C2.30417 3.82901 2.18109 3.48018 1.89059 3.34134ZM6.92067 2.33393C3.70417 2.38701 1.155 5.87301 2.9015 9.23068C3.16692 9.74051 3.56067 10.1675 3.98359 10.5566C4.144 10.7042 4.26825 10.8868 4.37442 11.0828H6.41667V8.05876C5.73942 7.81726 5.25 7.17559 5.25 6.41609C5.25 6.09351 5.51075 5.83276 5.83334 5.83276C6.15592 5.83276 6.41667 6.09351 6.41667 6.41609C6.41667 6.73868 6.678 6.99943 7 6.99943C7.322 6.99943 7.58334 6.73809 7.58334 6.41609C7.58334 6.09409 7.84409 5.83276 8.16667 5.83276C8.48925 5.83276 8.75 6.09351 8.75 6.41609C8.75 7.17559 8.26059 7.81726 7.58334 8.05876V11.0828H9.60634C9.73934 10.8547 9.91084 10.6394 10.1354 10.4522C10.5198 10.1313 10.8815 9.77376 11.1038 9.32518C12.117 7.27593 11.7151 5.09076 10.2719 3.67209C9.373 2.78776 8.18242 2.31468 6.92067 2.33393ZM4.662 12.4122C4.61534 13.2673 5.25584 14 6.11217 14H7.87442C8.68 14 9.33275 13.3473 9.33275 12.5417V12.25H4.65559C4.65559 12.3048 4.6655 12.3562 4.662 12.4122ZM13.9493 3.09168C13.8163 2.79826 13.4715 2.66584 13.1781 2.80001L12.0511 3.30868C11.7571 3.44109 11.6264 3.78643 11.7594 4.07984C11.8568 4.29568 12.0686 4.42343 12.2914 4.42343C12.3713 4.42343 12.453 4.40709 12.5306 4.37151L13.6576 3.86284C13.9516 3.73043 14.0823 3.38509 13.9493 3.09168Z" fill="#3C76F1"/>
                                                                        </g>
                                                                        <defs>
                                                                            <clipPath id="clip0_9464_2249">
                                                                                <rect width="14" height="14" fill="white"/>
                                                                            </clipPath>
                                                                        </defs>
                                                                    </svg>
                                                                    <p class="fz-12">{{ translate('To set different commission for commission based, set the Default commission') }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-2 text-dark">{{translate('Default commission (%)')}} <span class="text-danger">*</span>
                                                <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                   data-bs-placement="top"
                                                   title="{{translate('set admin commission for per booking')}}"
                                                >info</i>
                                            </div>
                                            <input type="number" class="form-control" name="default_commission" min="0" max="100" placeholder="Ex: 2 *" required
                                                   value="{{$dataValues->where('key_name','default_commission')->first()->live_values}}">
                                        </div>
                                    </div>

                                    @can('business_update')
                                        <div class="d-flex justify-content-end trans3 mt-4">
                                            <div class="d-flex justify-content-sm-end justify-content-center gap-2 gap-sm-3 flex-grow-1 flex-grow-sm-0 bg-white action-btn-wrapper trans3">
                                                <button type="reset" class="btn btn--secondary rounded">
                                                    {{ translate('Reset') }}
                                                </button>
                                                <button type="submit" class="btn btn--primary d-flex align-items-center gap-2 rounded demo_check">
                                                    <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <g clip-path="url(#clip0_9562_1632)">
                                                            <path d="M9.91732 0.5H4.08398V4H9.91732V0.5Z" fill="white"></path>
                                                            <path d="M7.00065 9.83333C7.64498 9.83333 8.16732 9.311 8.16732 8.66667C8.16732 8.02233 7.64498 7.5 7.00065 7.5C6.35632 7.5 5.83398 8.02233 5.83398 8.66667C5.83398 9.311 6.35632 9.83333 7.00065 9.83333Z" fill="white"></path>
                                                            <path d="M11.0833 0.5V5.16667H2.91667V0.5H1.75C1.28587 0.5 0.840752 0.684374 0.512563 1.01256C0.184374 1.34075 0 1.78587 0 2.25L0 14.5H14V3.41667L11.0833 0.5ZM7 11C6.53851 11 6.08738 10.8632 5.70367 10.6068C5.31995 10.3504 5.02088 9.98596 4.84428 9.55959C4.66768 9.13323 4.62147 8.66408 4.7115 8.21146C4.80153 7.75883 5.02376 7.34307 5.35008 7.01675C5.67641 6.69043 6.09217 6.4682 6.54479 6.37817C6.99741 6.28814 7.46657 6.33434 7.89293 6.51095C8.31929 6.68755 8.68371 6.98662 8.94009 7.37034C9.19649 7.75405 9.33333 8.20518 9.33333 8.66667C9.33333 9.28551 9.0875 9.879 8.64992 10.3166C8.21233 10.7542 7.61884 11 7 11Z" fill="white"></path>
                                                        </g>
                                                        <defs>
                                                            <clipPath id="clip0_9562_1632">
                                                                <rect width="14" height="14" fill="white" transform="translate(0 0.5)"></rect>
                                                            </clipPath>
                                                        </defs>
                                                    </svg>
                                                    {{ translate('Save Information') }}
                                                </button>
                                            </div>
                                        </div>
                                    @endcan
                                </form>

                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>



    <!-- New Modal Here--->
{{--    <h1 class="mb-4">Confirmation Modal Check</h1>--}}
{{--    <a href="#" data-bs-toggle="modal" data-bs-target="#turnOnStatus" class="border rounded p-12 fw-semibold bg-primary text-white mb-3">Are you sure Turn On the status?</a>--}}
{{--    <a href="#" data-bs-toggle="modal" data-bs-target="#turnOffStatus" class="border rounded p-12 fw-semibold bg-primary text-white mb-3">Are you sure Turn Off the status?</a>--}}
{{--    <a href="#" data-bs-toggle="modal" data-bs-target="#onPartialPayment" class="border rounded p-12 fw-semibold bg-primary text-white mb-3">Are you sure turn on Partial Payment</a>--}}
{{--    <a href="#" data-bs-toggle="modal" data-bs-target="#offPartialPayment" class="border rounded p-12 fw-semibold bg-primary text-white mb-3">Are you sure turn Off Partial Payment</a>--}}
{{--    <a href="#" data-bs-toggle="modal" data-bs-target="#googleConfiguration" class="border rounded p-12 fw-semibold bg-primary text-white mb-3">Set Up Google Configuration First</a>--}}
{{--    <a href="#" data-bs-toggle="modal" data-bs-target="#appleConfiguration" class="border rounded p-12 fw-semibold bg-primary text-white mb-3">Set Up Apple ID Configuration First</a>--}}
{{--    <a href="#" data-bs-toggle="modal" data-bs-target="#facebookConfiguration" class="border rounded p-12 fw-semibold bg-primary text-white mb-3">Set Up Facebook Configuration First</a>--}}


    <!--Maintenance Mode Modal-->
    <div class="modal modal-scrolling-customize maintenance-modal-customize fade" id="maintenance-mode-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl">
            <div class="modal-content rounded-4 p-2">
                <div class="modal-header border-0 pb-0 mb-20">
                    <h3 class="mb-0">
                        <i class="tio-notifications-alert mr-1"></i>
                        {{translate('Maintenance Mode')}}
                    </h3>
                    <button type="button" class="btn-close rounded-full bg-light" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form method="post" action="{{route('admin.business-settings.maintenance-mode-setup')}}" id="maintenanceModeForm">
                    <div class="modal-body">
                        <?php
                            $selectedMaintenanceSystem      = ((business_config('maintenance_system_setup', 'maintenance_mode'))?->live_values) ?? [];
                            $selectedMaintenanceDuration    = ((business_config('maintenance_duration_setup', 'maintenance_mode'))?->live_values) ?? [];
                            $selectedMaintenanceMessage     = ((business_config('maintenance_message_setup', 'maintenance_mode'))?->live_values) ?? [];
                            $maintenanceMode                = (int)((business_config('maintenance_mode', 'maintenance_mode'))?->live_values) ?? 0;
                        ?>
                        <div class="bg-light rounded p-20 mb-20 mx-lg-3 mx-2">
                            <div class="row g-3">
                                <div class="col-lg-8">
                                    <p class="fs-12">*{{ translate('Turn on the Maintenance Mode will temporarily deactivate your selected systems as of your chosen date and time.') }}</p>
                                </div>
                                <div class="col-lg-4">
                                    <div class="d-flex justify-content-between align-items-center bg-white border rounded h-40 px-3 py-2">
                                        <h5 class="mb-0">{{translate('maintenance_mode')}}</h5>

                                        <label class="switcher ml-auto mb-0">
                                            <input type="checkbox" class="switcher_input" name="maintenance_mode"  id="maintenance-mode-checkbox"
                                                {{ $maintenanceMode ?'checked':''}}>
                                            <span class="switcher_control"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class=" bg-light rounded p-20 mx-lg-3 mx-2">
                            @csrf
                            <div class="d-flex flex-column gap-4">
                                <div class="row g-2 align-items-center">
                                    <div class="col-xl-4">
                                        <h5 class="mb-2">{{ translate('Select System') }}</h5>
                                        <p class="fs-12">{{ translate('Select the systems you want to temporarily deactivate for maintenance') }}</p>
                                    </div>
                                    <div class="col-xl-8">
                                        <div class="border p-3 bg-white rounded">
                                            <div class="maintenance-recived d-flex flex-wrap gap-x-30">
                                                <div class="form-check form--check">
                                                    <input class="form-check-input system-checkbox" name="all_system" type="checkbox"
                                                        {{ in_array('mobile_app', $selectedMaintenanceSystem) &&
                                                                in_array('web_app', $selectedMaintenanceSystem) &&
                                                                in_array('provider_panel', $selectedMaintenanceSystem) &&
                                                                in_array('provider_app', $selectedMaintenanceSystem) &&
                                                                in_array('serviceman_app', $selectedMaintenanceSystem) ? 'checked' :'' }}
                                                        id="allSystem">
                                                    <label class="form-check-label text-dark" for="allSystem">{{ translate('All System') }}</label>
                                                </div>
                                                <div class="form-check form--check">
                                                    <input class="form-check-input system-checkbox" name="mobile_app" type="checkbox"
                                                        {{ in_array('mobile_app', $selectedMaintenanceSystem) ? 'checked' :'' }}
                                                        id="mobileApp">
                                                    <label class="form-check-label text-dark" for="mobileApp">{{ translate('Mobile App') }}</label>
                                                </div>
                                                <div class="form-check form--check">
                                                    <input class="form-check-input system-checkbox" name="web_app" type="checkbox"
                                                        {{ in_array('web_app', $selectedMaintenanceSystem) ? 'checked' :'' }}
                                                        id="webApp">
                                                    <label class="form-check-label text-dark" for="webApp">{{ translate('Web App') }}</label>
                                                </div>
                                                <div class="form-check form--check">
                                                    <input class="form-check-input system-checkbox" name="provider_panel" type="checkbox"
                                                        {{ in_array('provider_panel', $selectedMaintenanceSystem) ? 'checked' :'' }}
                                                        id="providerPanel">
                                                    <label class="form-check-label text-dark" for="providerPanel">{{ translate('Provider Panel') }}</label>
                                                </div>
                                                <div class="form-check form--check">
                                                    <input class="form-check-input system-checkbox" name="provider_app" type="checkbox"
                                                        {{ in_array('provider_app', $selectedMaintenanceSystem) ? 'checked' :'' }}
                                                        id="providerApp">
                                                    <label class="form-check-label text-dark" for="providerApp">{{ translate('Provider App') }}</label>
                                                </div>
                                                <div class="form-check form--check">
                                                    <input class="form-check-input system-checkbox" name="serviceman_app" type="checkbox"
                                                        {{ in_array('serviceman_app', $selectedMaintenanceSystem) ? 'checked' :'' }}
                                                        id="servicemanApp">
                                                    <label class="form-check-label text-dark" for="servicemanApp">{{ translate('Serviceman App') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="border-bottom"></div>
                                <div class="row g-2 align-items-center">
                                    <div class="col-xl-4">
                                        <h5 class="mb-2">{{ translate('Maintenance Date') }} & {{ translate('Time') }}</h5>
                                        <p class="fs-12">{{ translate('Choose the maintenance mode duration for your selected system.') }}</p>
                                    </div>
                                    <div class="col-xl-8">
                                        <div class="maintenance-dates">
                                            <div class="p-3 bg-white rounded d-flex flex-wrap gap-x-30">
                                                <div class="custom-radio radio--lg">
                                                    <input type="radio" name="maintenance_duration"
                                                        {{ isset($selectedMaintenanceDuration['maintenance_duration']) && $selectedMaintenanceDuration['maintenance_duration'] == 'one_day' ? 'checked' : '' }}
                                                        value="one_day" id="one_day">
                                                    <label class="fz-14" for="one_day">{{ translate('For 24 Hours') }}</label>
                                                </div>
                                                <div class="custom-radio radio--lg">
                                                    <input type="radio" name="maintenance_duration"
                                                        {{ isset($selectedMaintenanceDuration['maintenance_duration']) && $selectedMaintenanceDuration['maintenance_duration'] == 'one_week' ? 'checked' : '' }}
                                                        value="one_week" id="one_week">
                                                    <label class="fz-14" for="one_week">{{ translate('For 1 Week') }}</label>
                                                </div>
                                                <div class="custom-radio radio--lg">
                                                    <input type="radio" name="maintenance_duration"
                                                        {{ isset($selectedMaintenanceDuration['maintenance_duration']) && $selectedMaintenanceDuration['maintenance_duration'] == 'until_change' ? 'checked' : '' }}
                                                        value="until_change" id="until_change">
                                                    <label class="fz-14" for="until_change">{{ translate('Until I change') }}</label>
                                                </div>
                                                <div class="custom-radio radio--lg">
                                                    <input type="radio" name="maintenance_duration"
                                                        {{ isset($selectedMaintenanceDuration['maintenance_duration']) && $selectedMaintenanceDuration['maintenance_duration'] == 'customize' ? 'checked' : '' }}
                                                        value="customize" id="customize">
                                                    <label class="fz-14" for="customize">{{ translate('Customize') }}</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-business mt-20 custom-dates">
                                                        <label class="text-dark fz-14">{{ translate('Start Date') }} <span class="text-danger">*</span> </label>
                                                        <input type="datetime-local" class="form-control mt-2" name="start_date" id="startDate"
                                                            value="{{ old('start_date', $selectedMaintenanceDuration['start_date'] ?? '') }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-business mt-20 custom-dates">
                                                        <label class="text-dark fz-14">{{ translate('End Date') }} <span class="text-danger">*</span> </label>
                                                        <input type="datetime-local" class="form-control  mt-2" name="end_date" id="endDate"
                                                            value="{{ old('end_date', $selectedMaintenanceDuration['end_date'] ?? '') }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <small id="dateError" class="form-text text-danger" style="display: none;">{{ translate('Start date cannot be greater than end date.') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="advanceFeatureButtonDiv">
                                <div class="d-flex justify-content-center mt-3">
                                    <a href="#" id="advanceFeatureToggle" class="d-block mb-3 text-primary fw-semibold maintenance-advance-feature-button text-decoration-underline">{{ translate('Advanced Settings') }}</a>
                                </div>
                            </div>

                            <div class="row mt-4 g-2 border-top pt-3 align-items-center" id="advanceFeatureSection" style="display: none;">
                                <div class="col-xl-4">
                                    <h5 class="mb-2">{{ translate('Maintenance Massage') }}</h5>
                                    <p class="fs-12">{{ translate('Select & type what massage you want to see your selected system when maintenance mode is active.') }}</p>
                                </div>
                                <div class="col-xl-8">
                                    <div class="">
                                        <div class="form-group">
                                            <label class="mb-2 text-dark fz-14 font-normal">{{ translate('Show Contact Info') }}</label>
                                            <div class="d-flex flex-wrap gap-4 mb--20 bg-white border rounded p-2 px-3">
                                                <div class="form-check form--check">
                                                    <input class="form-check-input" type="checkbox" name="business_number" id="businessNumber">
                                                    <label class="form-check-label mt-0" for="businessNumber">{{ translate('Business Number') }}</label>
                                                </div>
                                                <div class="form-check form--check">
                                                    <input class="form-check-input" type="checkbox" name="business_email"
                                                        {{ isset($selectedMaintenanceMessage['business_email']) && $selectedMaintenanceMessage['business_email'] == 1 ? 'checked' : '' }}
                                                        id="businessEmail">
                                                    <label class="form-check-label mt-0" for="businessEmail">{{ translate('Business Email') }}</label>
                                                </div>
                                            </div>
                                            <div class="">
                                                <div class="mb-2 text-dark">{{translate('Message Title')}}</div>
                                                <textarea class="form-control" name="maintenance_message" placeholder="We're Working On Something Special!" rows="3" maxlength="100">{{ $selectedMaintenanceMessage['maintenance_message'] ?? '' }}</textarea>
                                            </div>
                                            <div class="mt-2">
                                                <div class="mb-2 text-dark">{{translate('Message Body')}}</div>
                                                <textarea class="form-control" name="message_body" maxlength="200" rows="3" placeholder="{{ translate('Message body') }}">{{ $selectedMaintenanceMessage['message_body'] ?? '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <div class="d-flex justify-content-center mt-4">
                                    <a href="#" id="seeLessToggle" class="d-block mb-3 text-primary fw-semibold maintenance-advance-feature-button text-decoration-underline">{{ translate('Basic Settings') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 mt-2">
                        <div class="btn--container justify-content-end gap-xl-3 gap-2">
                            <button type="button" class="btn btn--secondary rounded" data-bs-dismiss="modal">{{ translate('Close') }}</button>
                            <button type="{{env('APP_ENV')!='demo'?'button':'button'}}" onclick="validateMaintenanceMode()" class="btn btn--primary rounded demo_check">{{ translate('Save') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--Status On Modal-->
    <div class="modal fade custom-confirmation-modal" id="turnOnStatus" tabindex="-1" aria-labelledby="statusonModelLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-30">
                    <button type="button" class="btn-close bg-light rounded-full" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="d-flex flex-column align-items-center text-center">
                        <img class="mb-20" src="{{asset('public/assets/admin-module')}}/img/status-on.png" alt="">
                        <h3 class="mb-15">{{ translate('Are you sure Turn On the status?')}}</h3>
                        <p class="mb-4 fz-14">{{ translate('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet ')}}</p>
                        <form action="{{ route('admin.subscription.package.subscription-to-commission') }}" method="post">
                            @csrf
                            <div class="choose-option">
                                <div class="d-flex gap-3 justify-content-center flex-wrap">
                                    <button type="button" class="btn px-xl-5 px-4 btn--secondary rounded" data-bs-dismiss="modal">NO</button>
                                    <button type="button" class="btn px-xl-5 px-4 btn--primary text-capitalize rounded">Yes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Status Off Modal-->
    <div class="modal fade custom-confirmation-modal" id="turnOffStatus" tabindex="-1" aria-labelledby="statusoffModelLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-30">
                    <button type="button" class="btn-close bg-light rounded-full" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="d-flex flex-column align-items-center text-center">
                        <img class="mb-20" src="{{asset('public/assets/admin-module')}}/img/status-of.png" alt="">
                        <h3 class="mb-15">{{ translate('Are you sure Turn Off the status?')}}</h3>
                        <p class="mb-4 fz-14">{{ translate('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet ')}}</p>
                        <form action="{{ route('admin.subscription.package.subscription-to-commission') }}" method="post">
                            @csrf
                            <div class="choose-option">
                                <div class="d-flex gap-3 justify-content-center flex-wrap">
                                    <button type="button" class="btn px-xl-5 px-4 btn--secondary rounded" data-bs-dismiss="modal">NO</button>
                                    <button type="button" class="btn px-xl-5 px-4 btn--primary text-capitalize rounded">Yes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Partial Payment On Modal-->
    <div class="modal fade custom-confirmation-modal" id="onPartialPayment" tabindex="-1" aria-labelledby="onPortialModelLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-30">
                    <button type="button" class="btn-close bg-light rounded-full" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="d-flex flex-column align-items-center text-center">
                        <img class="mb-20" src="{{asset('public/assets/admin-module')}}/img/on-partial-payment.png" alt="">
                        <h3 class="mb-15">{{ translate('Are you sure turn on Partial Payment')}}</h3>
                        <p class="mb-4 fz-14">{{ translate('By enabling Partial Payment, customers will be able to pay a portion of their bill using wallet balance and complete the remaining payment through the selected payment option(s). This can improve flexibility and increase successful order completions.')}}</p>
                        <form action="#">
                            <div class="choose-option">
                                <div class="d-flex gap-3 justify-content-center flex-wrap">
                                    <button type="button" class="btn px-xl-5 px-4 btn--secondary rounded" data-bs-dismiss="modal">{{ translate('NO') }}</button>
                                    <button type="button" class="btn px-xl-5 px-4 btn--primary text-capitalize rounded confirm-button">{{ translate('Yes') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Partial Payment Off Modal-->
    <div class="modal fade custom-confirmation-modal" id="offPartialPayment" tabindex="-1" aria-labelledby="onPortialModelLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-30">
                    <button type="button" class="btn-close bg-light rounded-full" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="d-flex flex-column align-items-center text-center">
                        <img class="mb-20" src="{{asset('public/assets/admin-module')}}/img/of-partial-payment.png" alt="">
                        <h3 class="mb-15">{{ translate('Are you sure turn Off Partial Payment')}}</h3>
                        <p class="mb-4 fz-14">{{ translate('By disabling Partial Payment, customers must pay the full bill using a single payment method. They will no longer be able to combine wallet balance with other payment options.')}}</p>
                        <form action="#" method="">
                            <div class="choose-option">
                                <div class="d-flex gap-3 justify-content-center flex-wrap">
                                    <button type="button" class="btn px-xl-5 px-4 btn--secondary rounded" data-bs-dismiss="modal">{{ translate('NO') }}</button>
                                    <button type="button" class="btn px-xl-5 px-4 btn--primary text-capitalize rounded confirm-button">{{ translate('Yes') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Google Configuration Modal-->
    <div class="modal fade custom-confirmation-modal" id="googleConfiguration" tabindex="-1" aria-labelledby="googleConfigurationLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-30">
                    <button type="button" class="btn-close bg-light rounded-full" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="d-flex flex-column align-items-center text-center">
                        <img class="mb-20" src="{{asset('public/assets/admin-module')}}/img/mgoogle.png" alt="">
                        <h3 class="mb-15">{{ translate('Set Up Google Configuration First')}}</h3>
                        <p class="mb-4 fz-14">{{ translate('It looks like your Google configuration is not set up yet. To enable the OTP system, please set up the Google configuration first.')}}</p>
                        <form action="{{ route('admin.subscription.package.subscription-to-commission') }}" method="post">
                            @csrf
                            <div class="choose-option">
                                <div class="d-flex gap-3 justify-content-center flex-wrap">
                                    <button type="button" class="btn px-xl-5 px-4 btn--primary text-capitalize rounded">Go to Google Configuration</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Apple Configuration Modal-->
    <div class="modal fade custom-confirmation-modal" id="appleConfiguration" tabindex="-1" aria-labelledby="appleConfigurationLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-30">
                    <button type="button" class="btn-close bg-light rounded-full" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="d-flex flex-column align-items-center text-center">
                        <img class="mb-20" src="{{asset('public/assets/admin-module')}}/img/mapple.png" alt="">
                        <h3 class="mb-15">{{ translate('Set Up Apple ID Configuration First')}}</h3>
                        <p class="mb-4 fz-14">{{ translate('It looks like your Apple ID Login configuration is not set up yet. To enable the Apple ID Login option, please set up the Apple ID configuration first.')}}</p>
                        <form action="{{ route('admin.subscription.package.subscription-to-commission') }}" method="post">
                            @csrf
                            <div class="choose-option">
                                <div class="d-flex gap-3 justify-content-center flex-wrap">
                                    <button type="button" class="btn px-xl-5 px-4 btn--primary text-capitalize rounded">Go to Apple ID Configuration</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Facebook Configuration Modal-->
    <div class="modal fade custom-confirmation-modal" id="facebookConfiguration" tabindex="-1" aria-labelledby="appleConfigurationLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-30">
                    <button type="button" class="btn-close bg-light rounded-full" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="d-flex flex-column align-items-center text-center">
                        <img class="mb-20" src="{{asset('public/assets/admin-module')}}/img/mfacebook.png" alt="">
                        <h3 class="mb-15">{{ translate('Set Up Facebook Configuration First')}}</h3>
                        <p class="mb-4 fz-14">{{ translate('It looks like your Facebook Login configuration is not set up yet. To enable the Facebook Login option, please set up the Facebook configuration first.')}}</p>
                        <form action="{{ route('admin.subscription.package.subscription-to-commission') }}" method="post">
                            @csrf
                            <div class="choose-option">
                                <div class="d-flex gap-3 justify-content-center flex-wrap">
                                    <button type="button" class="btn px-xl-5 px-4 btn--primary text-capitalize rounded">Go to Facebook Configuration</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="subscriptionToCommission" tabindex="-1" aria-labelledby="subscriptionToCommissionLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-30">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="d-flex flex-column gap-2 align-items-center text-center">
                        <img class="mb-3" src="{{asset('public/assets/new/admin-module')}}/img/ad_delete.svg" alt="">
                        <h3 class="mb-2">{{ translate('Switch commission base')}}</h3>
                        <p class="old-subscription-name" id="old_subscription_name">{{ translate('If disabled Subscription, All subscriber moved to commission and providers have to give a certain percentage of commission to admin for every booking request')}}</p>
                        <form action="{{ route('admin.subscription.package.subscription-to-commission') }}" method="post">
                            @csrf
                            <div class="choose-option">
                                <div class="d-flex gap-3 justify-content-center flex-wrap">
                                    <?php
                                    $commissionStatus = (int)((business_config('provider_commision', 'provider_config'))?->live_values??null);
                                    ?>
                                    @if($commissionStatus)
                                    <button type="submit" class="btn btn--primary text-capitalize">{{ translate('Switch & Turn Off The Status')}}</button>
                                    @else
                                        <label class="test-start p-3 text-danger">{{ translate('At first commission base system on') }}</label>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="commissionToSubscription" tabindex="-1" aria-labelledby="commissionToSubscriptionLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-30">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="d-flex flex-column gap-2 align-items-center text-center">
                        <img class="mb-3" src="{{asset('public/assets/new/admin-module')}}/img/ad_delete.svg" alt="">
                        <h3 class="mb-2">{{ translate('Want to switch existing business plan')}}?</h3>
                        <p class="old-subscription-name" id="old_subscription_name"></p>
                        <form class="w-100" action="{{ route('admin.subscription.package.commission-to-subscription') }}" method="post">
                            @csrf
                            <input type="hidden" name="old_subscription" id="old_subscription" value="">
                            <div class="choose-option text-start">
                                <?php
                                    $subscriptionPackage = Modules\BusinessSettingsModule\Entities\SubscriptionPackage::ofStatus(1)->get();
                                    $subscriptionStatus = (int)((business_config('provider_subscription', 'provider_config'))?->live_values);
                                ?>
                                @if($subscriptionStatus)
                                    <label class="test-start my-2">{{ translate('Business Plan') }}</label>
                                    <select class="form-select mb-3 js-select-modal" name="subscription_id">
                                        <option selected>{{ translate('Select Plan') }}</option>
                                        @foreach($subscriptionPackage as $package)
                                            <option value="{{ $package->id }}">{{ $package->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="d-flex gap-3 justify-content-center flex-wrap m-3">
                                        @csrf
                                        <button type="submit" class="btn btn--primary text-capitalize">{{ translate('Switch & Turn Off The Status')}}</button>
                                    </div>
                                @else
                                    <label class="test-start p-3">{{ translate('At first subscription base system on') }}</label>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="currency-warning-modal">
        <div class="modal-dialog modal-dialog-centered status-warning-modal">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body pb-5 pt-0">
                    <div class="max-349 mx-auto mb-20">
                        <div>
                            <div class="text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="76" height="76" viewBox="0 0 76 76" fill="none">
                                    <path d="M38 0.5C17.3 0.5 0.5 17.3 0.5 38C0.5 58.7 17.3 75.5 38 75.5C58.7 75.5 75.5 58.7 75.5 38C75.5 17.3 58.7 0.5 38 0.5ZM38 60.5C35.25 60.5 33 58.25 33 55.5C33 52.75 35.25 50.5 38 50.5C40.75 50.5 43 52.75 43 55.5C43 58.25 40.75 60.5 38 60.5ZM43.725 21.725L42.05 41.775C41.875 43.875 40.125 45.5 38 45.5C35.875 45.5 34.125 43.875 33.95 41.775L32.275 21.725C32 18.375 34.625 15.5 38 15.5C41.2 15.5 43.75 18.1 43.75 21.25C43.75 21.4 43.75 21.575 43.725 21.725Z" fill="#FF6174"/>
                                </svg>
                                <h5 class="modal-title"></h5>
                            </div>
                            <div class="text-center">
                                <h3 class="mb-4 mt-4"> {{ translate('Important_Alert !') }}</h3>
                                <div > <p>{{ translate('This currency is not supported by any of your current active digital payment gateways. Customer will not see the digital payment option & will not be able to pay digitally from website and apps') }}</h3></p></div>
                            </div>

                            <div class="text-center mb-4 mt-4" >
                                <a class="text-underline text-primary" href="{{ route('admin.configuration.third-party', ['webPage' => 'payment_config', 'type' => 'digital_payment']) }}"> {{ translate('View Payment gateway Settings') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @php($currencyCode = $dataValues->where('key_name', 'currency_code')->first()->live_values ?? 'USD')
@endsection

@push('script')
    <script src="{{asset('public/assets/new/admin-module')}}/plugins/select2/select2.min.js"></script>
    <script src="{{asset('public/assets/new/admin-module')}}/plugins/dataTables/jquery.dataTables.min.js"></script>
    <script src="{{asset('public/assets/new/admin-module')}}/plugins/dataTables/dataTables.select.min.js"></script>

    @php($api_key=(business_config('google_map', 'third_party'))->live_values)
    <script src="https://maps.googleapis.com/maps/api/js?key={{$api_key['map_api_key_client']}}&libraries=drawing,places&v=3.45.8"></script>



    <script>
        "use strict";

        let selectedCurrency = "{{ $currencyCode ? $currencyCode : 'USD' }}";
        let currencyConfirmed = false;
        let updatingCurrency = false;

        $("#change_currency").change(function() {
            if (!updatingCurrency) check_currency($(this).val());
        });

        $("#confirm-currency-change").click(function() {
            currencyConfirmed = true;
            update_currency(selectedCurrency);
            $('#currency-warning-modal').modal('hide');
        });

        function check_currency(currency) {
            $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                url: "{{route('admin.business-settings.ajax-currency-change')}}",
                method: 'GET',
                data: { currency: currency },
                success: function(response) {
                    if (response.data) {
                        $('#currency-warning-modal').modal('show');
                    } else {
                        update_currency(currency);
                    }
                }
            });
        }

        function update_currency(currency) {
            if (currencyConfirmed) {
                updatingCurrency = true;
                $("#change_currency").val(currency).trigger('change');
                updatingCurrency = false;
                currencyConfirmed = false;
            }
        }

        document.getElementById('subscriptionToCommission').addEventListener('hidden.bs.modal', function () {
            location.reload();
        });
        document.getElementById('commissionToSubscription').addEventListener('hidden.bs.modal', function () {
            location.reload();
        });

        $('#business-info-update-form').on('submit', function (event) {
            event.preventDefault();

            let form = $('#business-info-update-form')[0];
            let formData = new FormData(form);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('admin.business-settings.set-business-information')}}",
                data: formData,
                processData: false,
                contentType: false,
                type: 'POST',
                success: function (response) {
                    toastr.success('{{translate('successfully_updated')}}');

                    // refresh setup guideline UI
                    refreshSetupGuideUI();
                },
                error: function (jqXHR, exception) {
                    if (jqXHR.responseJSON && jqXHR.responseJSON.errors && jqXHR.responseJSON.errors.length > 0) {
                        var errorMessages = jqXHR.responseJSON.errors.map(function (error) {
                            return error.message;
                        });

                        errorMessages.forEach(function (errorMessage) {
                            toastr.error(errorMessage);
                        });
                    } else {
                        toastr.error("An error occurred.");
                    }
                }
            });
        });

        $('#bidding-system-update-form').on('submit', function (event) {
            event.preventDefault();

            let form = $('#bidding-system-update-form')[0];
            let formData = new FormData(form);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('admin.business-settings.set-bidding-system')}}",
                data: formData,
                processData: false,
                contentType: false,
                type: 'POST',
                success: function (response) {
                    toastr.success('{{translate('successfully_updated')}}');
                },
                error: function (jqXHR, exception) {
                    if (jqXHR.responseJSON && jqXHR.responseJSON.errors && jqXHR.responseJSON.errors.length > 0) {
                        var errorMessages = jqXHR.responseJSON.errors.map(function (error) {
                            return error.message;
                        });

                        errorMessages.forEach(function (errorMessage) {
                            toastr.error(errorMessage);
                        });
                    } else {
                        toastr.error("An error occurred.");
                    }
                }
            });
        });

        $('#booking-system-update-form').on('submit', function (event) {
            event.preventDefault();

            let form = $('#booking-system-update-form')[0];
            let formData = new FormData(form);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('admin.business-settings.set-booking-setup')}}",
                data: formData,
                processData: false,
                contentType: false,
                type: 'POST',
                success: function (response) {
                    toastr.success('{{translate('successfully_updated')}}');
                },
                error: function (jqXHR, exception) {
                    if (jqXHR.responseJSON && jqXHR.responseJSON.errors && jqXHR.responseJSON.errors.length > 0) {
                        var errorMessages = jqXHR.responseJSON.errors.map(function (error) {
                            return error.message;
                        });

                        errorMessages.forEach(function (errorMessage) {
                            toastr.error(errorMessage);
                        });
                    } else {
                        toastr.error("An error occurred.");
                    }
                }
            });
        });

        function update_action_status(key_name, value, settings_type, will_reload = false) {
            Swal.fire({
                title: "{{translate('are_you_sure')}}?",
                text: '{{translate('want_to_update_status')}}',
                type: 'warning',
                showCloseButton: true,
                showCancelButton: true,
                cancelButtonColor: 'var(--bs-secondary)',
                confirmButtonColor: 'var(--bs-primary)',
                cancelButtonText: 'Cancel',
                confirmButtonText: 'Yes',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{route('admin.business-settings.update-action-status')}}",
                        data: {
                            key: key_name,
                            value: value,
                            settings_type: settings_type,
                        },
                        type: 'put',
                        success: function (response) {
                            toastr.success('{{translate('successfully_updated')}}');

                            if (will_reload) {
                                setTimeout(() => {
                                    document.location.reload();
                                }, 3000);
                            }
                        },
                        error: function () {

                        }
                    });
                }
            })
        }

        $(document).ready(function () {
            $('.js-select').select2();
        });

        $('.js-select-modal').select2({
            dropdownParent: $('#commissionToSubscription')
        });

        $(window).on('load', function () {

            const initialStates = {
                discount: !$("#bearer-section__discount").hasClass('d-none'),
                campaign: !$("#bearer-section__campaign").hasClass('d-none'),
                coupon: !$("#bearer-section__coupon").hasClass('d-none')
            };

            $("#admin-select__discount, #provider-select__discount").on('click', function (e) {
                $("#bearer-section__discount").addClass('d-none');
            })

            $("#both-select__discount").on('click', function (e) {
                $("#bearer-section__discount").removeClass('d-none');
            })

            $("#admin_percentage__discount").keyup(function (e) {
                if (this.value >= 0 && this.value <= 100) {
                    $("#provider_percentage__discount").val((100 - this.value));
                }
            });

            $("#provider_percentage__discount").keyup(function (e) {
                if (this.value >= 0 && this.value <= 100) {
                    $("#admin_percentage__discount").val((100 - this.value));
                }
            });

            $("#admin-select__campaign, #provider-select__campaign").on('click', function (e) {
                $("#bearer-section__campaign").addClass('d-none');
            })

            $("#both-select__campaign").on('click', function (e) {
                $("#bearer-section__campaign").removeClass('d-none');
            })

            $("#admin_percentage__campaign").keyup(function (e) {
                if (this.value >= 0 && this.value <= 100) {
                    $("#provider_percentage__campaign").val((100 - this.value));
                }
            });

            $("#provider_percentage__campaign").keyup(function (e) {
                if (this.value >= 0 && this.value <= 100) {
                    $("#admin_percentage__campaign").val((100 - this.value));
                }
            });

            $("#admin-select__coupon, #provider-select__coupon").on('click', function (e) {
                $("#bearer-section__coupon").addClass('d-none');
            })

            $("#both-select__coupon").on('click', function (e) {
                $("#bearer-section__coupon").removeClass('d-none');
            })

            $("#admin_percentage__coupon").keyup(function (e) {
                if (this.value >= 0 && this.value <= 100) {
                    $("#provider_percentage__coupon").val((100 - this.value));
                }
            });

            $("#provider_percentage__coupon").keyup(function (e) {
                if (this.value >= 0 && this.value <= 100) {
                    $("#admin_percentage__coupon").val((100 - this.value));
                }
            });

            $("#promotion-reset").on('click', function (e) {
                // Wait for native reset to happen first
                setTimeout(function () {
                    $("#bearer-section__discount").toggleClass('d-none', !initialStates.discount);
                    $("#bearer-section__campaign").toggleClass('d-none', !initialStates.campaign);
                    $("#bearer-section__coupon").toggleClass('d-none', !initialStates.coupon);
                }, 0);
            });
        })

        function switch_alert(id, status, message) {
            Swal.fire({
                title: "{{translate('are_you_sure')}}?",
                text: message,
                type: 'warning',
                showDenyButton: true,
                showCancelButton: true,
                denyButtonColor: 'var(--bs-primary)',
                confirmButtonColor: 'var(--bs-primary)',
                confirmButtonText: 'Save',
                denyButtonText: `Don't save`,
            }).then((result) => {
                if (result.value) {
                } else {
                    if (status === 1) $(`#${id}`).prop('checked', false);
                    if (status === 0) $(`#${id}`).prop('checked', true);
                    Swal.fire('{{translate('Changes are not saved')}}', '', 'info')
                }
            })
        }
        $(document).ready(function ($) {
            $("#provider_commision").on('change', function () {
                if (!$(this).is(':checked') && !$("#provider_subscription").is(':checked')) {
                    $(this).prop('checked', true);
                }
            });
            $("#provider_subscription").on('change', function () {
                if (!$(this).is(':checked') && !$("#provider_commision").is(':checked')) {
                    $(this).prop('checked', true);
                }
            });
        });

    </script>
    <script>
        "use strict";

        @if(!$dataValues->where('key_name', 'schedule_booking')->where('settings_type', 'booking_setup')->first()?->live_values)
        $(document).ready(function () {
            $('#schedule_booking_section').hide();
        })
        @endif

        @if(!$dataValues->where('key_name', 'bidding_status')->where('settings_type', 'bidding_system')->first()?->live_values)
        $(document).ready(function () {
            $('#custom_bidding_post_section').hide();
        })
        @endif

        @if(!$dataValues->where('key_name', 'booking_additional_charge')->where('settings_type', 'booking_setup')->first()?->live_values)
        $(document).ready(function () {
            $('#additional_charge_on_booking_section').hide();
        })
        @endif

        @if(!$dataValues->where('key_name', 'referral_based_new_user_discount')->where('settings_type', 'customer_config')->first()?->live_values)
        $(document).ready(function () {
            $('#user_discount_section').hide();
        })
        @endif

        @if($dataValues->where('key_name', 'referral_discount_validity_type')->where('settings_type', 'customer_config')->first()?->live_values == 'day')
        $('#referral_discount_validity').removeAttr('max');
        @endif

        @if($dataValues->where('key_name', 'referral_discount_type')->where('settings_type', 'customer_config')->first()?->live_values == 'percentage')
        $('#discount_amount__label').html('{{translate('discount_percentage')}} (%)');
        @endif

        $('#referral_discount_type').on('change', function () {
            if ($(this).val() === 'flat') {
                $('#discount_amount').removeAttr('max');
                $('#discount_amount__label').html('{{translate('discount_amount')}} ({{currency_symbol()}})');
            } else if ($(this).val() === 'percentage') {
                $('#discount_amount').attr({"max": 100});
                $('#discount_amount__label').html('{{translate('discount_percentage')}} (%)');
            }
        });

        $('#referral_discount_validity_type').on('change', function () {
            if ($(this).val() === 'day') {
                $('#referral_discount_validity').removeAttr('max');
            } else if ($(this).val() === 'percentage') {
                $('#referral_discount_validity').attr('max');
            }
        });

        $('#schedule_booking_switch').on('change', function () {
            if ($(this).is(':checked') === true) {
                $('#schedule_booking_section').show();
            } else {
                $('#schedule_booking_section').hide();
            }

            const scheduleBookingStatus = $(this).is(':checked') === true ? 1 : 0;
            const instantBooking = $("#instant_booking").is(':checked') === true ? 1 : 0;

            if (scheduleBookingStatus === 0 && instantBooking === 0) {
                $("#instant_booking").prop('checked', true);
            }
        });

        $('#instant_booking').on('change', function () {
            const instantBooking = $(this).is(':checked') === true ? 1 : 0;
            const scheduleBookingStatus = $('schedule_booking_switch').is(':checked') === true ? 1 : 0;

            if (scheduleBookingStatus === 0 && instantBooking === 0) {
                $("#schedule_booking_switch").prop('checked', true);

                $('#schedule_booking_section').show();
            }
        });

        $('#schedule_booking_checkbox').on('change', function () {
            if ($(this).is(':checked') === true) {
                $('#schedule_booking_restriction').show();
            } else {
                $('#schedule_booking_restriction').hide();
            }
        });

        $('#bidding_status').on('change', function () {
            if ($(this).is(':checked') === true) {
                $('#custom_bidding_post_section').show();
            } else {
                $('#custom_bidding_post_section').hide();
            }
        });

        $(document).ready(function () {
            if ($('#booking_additional_charge').is(':checked')) {
                $('[name="additional_charge_label_name"]').prop('required', true);
                $('[name="additional_charge_fee_amount"]').prop('required', true);
            } else {
                $('[name="additional_charge_label_name"]').prop('required', false);
                $('[name="additional_charge_fee_amount"]').prop('required', false);
            }
        });

        $('#booking_additional_charge').on('change', function () {
            if ($(this).is(':checked') === true) {
                $('#additional_charge_on_booking_section').show();
                $('[name="additional_charge_label_name"]').prop('required', true);
                $('[name="additional_charge_fee_amount"]').prop('required', true);
            } else {
                $('#additional_charge_on_booking_section').hide();
                $('[name="additional_charge_label_name"]').prop('required', false);
                $('[name="additional_charge_fee_amount"]').prop('required', false);
            }
        });

        function toggleVisibility(checkbox, element) {
            $(checkbox).on('change', function () {
                $(element).toggle($(this).is(':checked'));
            });
        }

        toggleVisibility('#schedule_booking_switch', '#schedule_booking_section');
        toggleVisibility('#schedule_booking_checkbox', '#schedule_booking_restriction');
        toggleVisibility('#bidding_status', '#custom_bidding_post_section');
        toggleVisibility('#booking_additional_charge', '#additional_charge_on_booking_section');
        toggleVisibility('#user_discount_switch', '#user_discount_section');
    </script>

    <script>

        function validateMaintenanceMode() {

            if ('{{env('APP_ENV')=='demo'}}') {
                event.preventDefault();
                demo_mode()
                return false;
            }

            const maintenanceModeChecked = $('#maintenance-mode-checkbox').is(':checked');

            if (maintenanceModeChecked) {
                const isAnySystemSelected = $('.system-checkbox').is(':checked');

                if (!isAnySystemSelected) {
                    Swal.fire({
                        icon: 'warning',
                        title: '{{ translate("Please select a system") }}!',
                        text: '{{ translate("You must select at least one system when activating Maintenance Mode.") }}',
                        confirmButtonText: '{{ translate("OK") }}',
                        confirmButtonColor: '#4153b3',
                    });
                    return false;
                }
            }

            $('#maintenanceModeForm').submit();
        }

        $(document).ready(function() {

            $('.route-alert-reload').on('click', function () {
                const route = $(this).data('route');
                const message = $(this).data('message');
                const reload = true;
                const status = $(this).is(':checked') ? 1 : 0;
                const id = 'maintenance-mode-input';

                route_alert_reload(route, message, reload, status, id);
            });

            $('.maintenance-mode-show').click(function () {
                $('#maintenance-mode-modal').modal('show');
                let isChecked = $('#maintenance-mode-input').is(':checked');
                $('input[name="maintenance_mode"]').prop('checked', isChecked);
            });

            $('input[name="maintenance_mode"]').click(function () {
                let isChecked = $('input[name="maintenance_mode"]').is(':checked');
                $('#maintenance-mode-input').prop('checked', isChecked);
            });

            $('#advanceFeatureToggle').click(function (event) {
                event.preventDefault();
                $('#advanceFeatureSection').show();
                $('#advanceFeatureButtonDiv').hide();
            });

            $('#seeLessToggle').click(function (event) {
                event.preventDefault();
                $('#advanceFeatureSection').hide();
                $('#advanceFeatureButtonDiv').show();
            });

            $('#allSystem').change(function () {
                var isChecked = $(this).is(':checked');
                $('.system-checkbox').prop('checked', isChecked);
            });

            $('.system-checkbox').not('#allSystem').change(function () {
                if (!$(this).is(':checked')) {
                    $('#allSystem').prop('checked', false);
                } else {
                    // Check if all system-related checkboxes are checked
                    if ($('.system-checkbox').not('#allSystem').length === $('.system-checkbox:checked').not('#allSystem').length) {
                        $('#allSystem').prop('checked', true);
                    }
                }
            });

            $(document).ready(function () {
                var startDate = $('#startDate');
                var endDate = $('#endDate');
                var dateError = $('#dateError');

                function updateDatesBasedOnDuration(selectedOption) {
                    if (selectedOption === 'one_day' || selectedOption === 'one_week') {
                        var now = new Date();
                        var timezoneOffset = now.getTimezoneOffset() * 60000;
                        var formattedNow = new Date(now.getTime() - timezoneOffset).toISOString().slice(0, 16);

                        if (selectedOption === 'one_day') {
                            var end = new Date(now);
                            end.setDate(end.getDate() + 1);
                        } else if (selectedOption === 'one_week') {
                            var end = new Date(now);
                            end.setDate(end.getDate() + 7);
                        }

                        var formattedEnd = new Date(end.getTime() - timezoneOffset).toISOString().slice(0, 16);

                        startDate.val(formattedNow).prop('readonly', false).prop('required', true);
                        endDate.val(formattedEnd).prop('readonly', false).prop('required', true);
                        startDate.closest('div').css('display', 'block');
                        endDate.closest('div').css('display', 'block');
                        dateError.hide();
                    } else if (selectedOption === 'until_change') {
                        startDate.val('').prop('readonly', true).prop('required', false);
                        endDate.val('').prop('readonly', true).prop('required', false);
                        startDate.closest('div').css('display', 'none');
                        endDate.closest('div').css('display', 'none');
                        dateError.hide();
                    } else if (selectedOption === 'customize') {
                        startDate.prop('readonly', false).prop('required', true);
                        endDate.prop('readonly', false).prop('required', true);
                        startDate.closest('div').css('display', 'block');
                        endDate.closest('div').css('display', 'block');
                        dateError.hide();
                    }
                }

                function validateDates() {
                    var start = new Date(startDate.val());
                    var end = new Date(endDate.val());
                    if (start > end) {
                        dateError.show();
                        startDate.val('');
                        endDate.val('');
                    } else {
                        dateError.hide();
                    }
                }

                // Initial load
                var selectedOption = $('input[name="maintenance_duration"]:checked').val();
                updateDatesBasedOnDuration(selectedOption);

                // When maintenance duration changes
                $('input[name="maintenance_duration"]').change(function () {
                    var selectedOption = $(this).val();
                    updateDatesBasedOnDuration(selectedOption);
                });

                // When start date or end date changes
                $('#startDate, #endDate').change(function () {
                    $('input[name="maintenance_duration"][value="customize"]').prop('checked', true);
                    startDate.prop('readonly', false).prop('required', true);
                    endDate.prop('readonly', false).prop('required', true);
                    validateDates();
                });
            });

            function updateCheckboxState() {
                let config = {{ $config }};
                if (config) {
                    $('#maintenance-mode-input').prop('checked', true);
                } else {
                    $('#maintenance-mode-input').prop('checked', false);
                }
            }

            $('#maintenance-mode-modal').on('hidden.bs.modal', function () {
                updateCheckboxState();
            });

            updateCheckboxState();


            function route_alert_reload(route, message, reload, status = null, id = null) {
                Swal.fire({
                    title: "{{translate('are_you_sure')}}?",
                    text: message,
                    type: 'warning',
                    showCancelButton: true,
                    cancelButtonColor: 'var(--bs-secondary)',
                    confirmButtonColor: 'var(--bs-primary)',
                    cancelButtonText: 'Cancel',
                    confirmButtonText: 'Yes',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        $.get({
                            url: route,
                            dataType: 'json',
                            data: {},
                            beforeSend: function () {
                                // Code to run before sending the request
                            },
                            success: function (data) {
                                if (reload) {
                                    setTimeout(location.reload.bind(location), 1000);
                                }
                                toastr.success(data.message, {
                                    CloseButton: true,
                                    ProgressBar: true
                                });
                            },
                            complete: function () {
                                // Code to run after request is complete
                            },
                        });
                    } else {
                        if (status === 1) $(`#${id}`).prop('checked', false);
                        if (status === 0) $(`#${id}`).prop('checked', true);
                    }
                });
            }

            if ($webPage === 'business_setup'){
                if (modal.close) {
                    if ($config) {
                        $('#maintenance-mode-input').prop('checked', true);
                    } else {
                        $('#maintenance-mode-input').prop('checked', false);
                    }
                }
            }

        });

        $(document).ready(function () {
            function toggleCreateUserBox() {
                if ($('#guest_checkout').is(':checked')) {
                    $('#create_user_account_box').removeClass('disabled');
                    $('#create_user_account_input').prop('disabled', false);
                    $('.create-user-switcher-label')
                        .removeAttr('data-bs-toggle data-bs-placement title')
                        .tooltip('dispose');
                } else {
                    $('#create_user_account_box').addClass('disabled');
                    $('#create_user_account_input').prop('disabled', true);
                    $('.create-user-switcher-label')
                        .attr('data-bs-toggle', 'tooltip')
                        .attr('data-bs-placement', 'top')
                        .attr('title', 'Enable guest checkout to create a user account')
                        .tooltip();
                }
            }

            $('#guest_checkout').on('change', toggleCreateUserBox);

            toggleCreateUserBox();
        });

        $(document).ready(function () {
            function initTooltip($element) {
                // Dispose any existing tooltip, then re-init
                $element.tooltip('dispose').tooltip({
                    placement: 'top',
                    trigger: 'hover'
                });
            }

            function toggleCreateUserBox() {
                const $box = $('#create_user_account_box');
                const $label = $('.create-user-switcher-label');

                if ($('#guest_checkout').is(':checked')) {
                    $box.removeClass('disabled');
                    $label
                        .removeAttr('data-bs-toggle data-bs-placement title')
                        .tooltip('dispose');
                } else {
                    $box.addClass('disabled');
                    $label
                        .attr('data-bs-toggle', 'tooltip')
                        .attr('data-bs-placement', 'top')
                        .attr('title', 'Enable guest checkout to create a user account');

                    // Now initialize after attributes are set
                    initTooltip($label);
                }
            }

            $('#guest_checkout').on('change', toggleCreateUserBox);
            toggleCreateUserBox();
        });


        $( document ).ready(function() {
            function initAutocomplete() {
                var myLatLng = {
                    lat: {{ $addressLat }},
                    lng: {{ $addressLong }}
                };

                const map = new google.maps.Map(document.getElementById("location_map_canvas"), {
                    center: {
                        lat: {{ $addressLat }},
                        lng: {{ $addressLong }}
                    },
                    zoom: 13,
                    mapTypeId: "roadmap",
                });

                var marker = new google.maps.Marker({
                    position: myLatLng,
                    map: map,
                });

                marker.setMap(map);
                var geocoder = geocoder = new google.maps.Geocoder();
                google.maps.event.addListener(map, 'click', function(mapsMouseEvent) {
                    var coordinates = JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2);
                    var coordinates = JSON.parse(coordinates);
                    var latlng = new google.maps.LatLng(coordinates['lat'], coordinates['lng']);
                    marker.setPosition(latlng);
                    map.panTo(latlng);

                    document.getElementById('address_latitude').value = coordinates['lat'];
                    document.getElementById('address_longitude').value = coordinates['lng'];

                    geocoder.geocode({
                        'latLng': latlng
                    }, function(results, status) {
                        if (status == google.maps.GeocoderStatus.OK) {
                            if (results[1]) {
                                document.getElementById('business_address').value = results[1].formatted_address;
                            }
                        }
                    });
                });
                // Create the search box and link it to the UI element.
                const input = document.getElementById("pac-input");
                const searchBox = new google.maps.places.SearchBox(input);
                map.controls[google.maps.ControlPosition.TOP_CENTER].push(input);
                // Bias the SearchBox results towards current map's viewport.
                map.addListener("bounds_changed", () => {
                    searchBox.setBounds(map.getBounds());
                });
                let markers = [];
                // Listen for the event fired when the user selects a prediction and retrieve
                // more details for that place.
                searchBox.addListener("places_changed", () => {
                    const places = searchBox.getPlaces();

                    if (places.length == 0) {
                        return;
                    }
                    // Clear out the old markers.
                    markers.forEach((marker) => {
                        marker.setMap(null);
                    });
                    markers = [];
                    // For each place, get the icon, name and location.
                    const bounds = new google.maps.LatLngBounds();
                    places.forEach((place) => {
                        if (!place.geometry || !place.geometry.location) {
                            console.log("Returned place contains no geometry");
                            return;
                        }
                        var mrkr = new google.maps.Marker({
                            map,
                            title: place.name,
                            position: place.geometry.location,
                        });
                        google.maps.event.addListener(mrkr, "click", function(event) {
                            document.getElementById('address_latitude').value = this.position.lat();
                            document.getElementById('address_longitude').value = this.position.lng();
                        });

                        markers.push(mrkr);

                        if (place.geometry.viewport) {
                            // Only geocodes have viewport.
                            bounds.union(place.geometry.viewport);
                        } else {
                            bounds.extend(place.geometry.location);
                        }
                    });
                    map.fitBounds(bounds);
                });
            };
            initAutocomplete();
        });

        //payment page
        $(document).ready(function () {
            $('#payment-form').on('submit', function (e) {
                if (
                    !$('#cash_after_service').is(':checked') &&
                    !$('#digital_payment').is(':checked') &&
                    !$('#offline_payment').is(':checked')
                ) {
                    e.preventDefault();
                    toastr.error('{{ translate('Please select at least one payment method before submitting.') }}');
                }
            });

            function togglePartialPaymentOptions() {
                const isCAS = $('#cash_after_service').is(':checked');
                const isDigital = $('#digital_payment').is(':checked');
                const isOffline = $('#offline_payment').is(':checked');

                const $casLabel = $('label[for="cash_after_service_combinator"]');
                const $digitalLabel = $('label[for="digital_payment_combinator"]');
                const $offlineLabel = $('label[for="offline_payment_combinator"]');
                const $allLabel = $('label[for="all_combinator"]');

                // Helper to toggle tooltip
                function handleTooltip($input, $label, enabled, message) {
                    if (enabled) {
                        $input.prop('disabled', false);
                        $label.removeAttr('data-bs-toggle data-bs-placement title')
                            .tooltip('dispose');
                    } else {
                        $input.prop('disabled', true);
                        $label.attr('data-bs-toggle', 'tooltip')
                            .attr('data-bs-placement', 'top')
                            .attr('title', message)
                            .tooltip();
                    }
                }

                // Apply tooltips
                handleTooltip($('#cash_after_service_combinator'), $casLabel, isCAS, 'Enable Cash After Service to select this option');
                handleTooltip($('#digital_payment_combinator'), $digitalLabel, isDigital, 'Enable Digital Payment to select this option');
                handleTooltip($('#offline_payment_combinator'), $offlineLabel, isOffline, 'Enable Offline Payment to select this option');

                // "All" only available if all three are active
                const allActive = isCAS && isDigital && isOffline;
                handleTooltip($('#all_combinator'), $allLabel, allActive, 'Enable all payment methods to select this option');
            }

            togglePartialPaymentOptions();

            $('#cash_after_service, #digital_payment, #offline_payment').on('change', togglePartialPaymentOptions);


            $('#partial_payment').on('click', function (e) {
                e.preventDefault();

                const currentState = $(this).is(':checked');
                const previousState = !currentState;

                if (previousState) {
                    $('#offPartialPayment').modal('show');
                } else {
                    $('#onPartialPayment').modal('show');
                }
            });

            $('#onPartialPayment .confirm-button').on('click', function () {
                $('#partial_payment').prop('checked', true);
                $('input[name="partial_payment_combinator"]').prop('disabled', false);
                $('#onPartialPayment').modal('hide');
            });

            $('#offPartialPayment .confirm-button').on('click', function () {
                $('#partial_payment').prop('checked', false);
                $('input[name="partial_payment_combinator"]').prop('disabled', true);
                $('#offPartialPayment').modal('hide');
            });
        });


        //providers
        $(document).ready(function () {
            const statusSwitch = $('#suspend_on_exceed_cash_limit_provider');
            const cashFields = $('.cash-fields');

            function toggleCashFields(enable) {
                cashFields.each(function () {
                    const input = $(this);
                    const wrapper = input.closest('.cash-field-wrapper');
                    const value = input.val();
                    const hiddenInputId = 'hidden_' + input.attr('name');
                    $('#' + hiddenInputId).val(value);

                    if (enable) {
                        input.prop('disabled', false);
                        wrapper.tooltip('dispose'); // remove tooltip when enabled
                    } else {
                        input.prop('disabled', true);
                        wrapper.tooltip({ placement: 'top' });
                    }
                });
            }

            // Tooltip initialization
            $('[data-bs-toggle="tooltip"]').tooltip();

            // Click on wrapper focuses input only if enabled
            $(document).on('click', '.cash-field-wrapper', function () {
                const input = $(this).find('.cash-fields');
                if (!input.prop('disabled')) {
                    input.focus();
                }
            });

            // Initial toggle
            toggleCashFields(statusSwitch.is(':checked'));

            // Toggle on change
            statusSwitch.on('change', function () {
                toggleCashFields($(this).is(':checked'));
            });

            // Keep hidden inputs in sync
            $('.cash-fields').on('input', function () {
                const input = $(this);
                const hiddenInputId = 'hidden_' + input.attr('name');
                $('#' + hiddenInputId).val(input.val());
            });
        });


        document.getElementById('custom-reset').addEventListener('click', function () {
            const form = this.closest('form');
            form.querySelectorAll('input, textarea, select').forEach(el => {
                // Skip if input is inside .phone-picker-wrap
                if (el.closest('.phone-picker-wrap')) return;
                const defaultValue = el.defaultValue;
                const type = el.type;
                if (type === 'checkbox' || type === 'radio') {
                    if (el.checked !== el.defaultChecked) {
                        el.checked = el.defaultChecked;
                    }
                } else if (type === 'file') {
                    if (el.files.length > 0) {
                        el.value = '';
                        const viewerId = el.getAttribute('data-viewer-id');
                        if (viewerId) {
                            const viewer = document.getElementById(viewerId);
                            if (viewer) {
                                viewer.src = viewer.getAttribute('data-onerror-image') || '';
                            }
                        }
                    }
                } else {
                    if (el.value !== defaultValue) {
                        el.value = defaultValue;
                    }
                }
            });
        });




    </script>



@endpush
