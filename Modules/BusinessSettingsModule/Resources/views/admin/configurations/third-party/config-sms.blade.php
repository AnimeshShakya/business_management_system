@if($webPage == 'sms_config')
    <div class="tab-content">
        <div class="tab-pane fade show active"
             id="sms_config">
            <div class="pick-map mb-3 p-12 rounded d-flex flex-md-nowrap flex-wrap align-items-center gap-1 bg-primary bg-opacity-10">
                <img src="{{ asset('public/assets/admin-module/img/icons/focus_mode.svg') }}" alt="focus mode icon">
                <p class="fz-12">{{ translate('This SMS gateway will work for') }} <a @can('login_setup_view') href="{{ route('admin.business-settings.login.setup') }}" @endcan class="text-primary fw-semibold text-decoration-underline" target="_blank"> {{ translate('OTP verification') }} </a> {{ translate('_or') }} <a @can('firebase_view') href="{{ route('admin.configuration.third-party', 'firebase-authentication') }}" @endcan target="_blank" class="text-primary fw-semibold text-decoration-underline">{{ translate('Notification') }}</a> {{ translate('_through SMS.') }}</p>
            </div>
            <div class="bg-warning bg-opacity-10 fs-12 p-12 rounded mb-3">
                <div class="d-flex align-items-center gap-2">
                    <img src="{{ asset('public/assets/admin-module/img/icons/alert_info.svg') }}" alt="alert info icon">
                    <p class="fz-12 fw-normal">{{ translate('Please recheck if you have put all the data correctly or contact your SMS gateway provider for assistance.') }}</p>
                </div>
            </div>
            <div class="card mb-20">
                <div class="card-body p-20">
                    <div class="row g-lg-4 g-4 align-items-center">
                        <div class="col-lg-3">
                            <h3 class="mb-2">{{translate('SMS Configuration')}}</h3>
                            <p class="fz-12 mb-xl-3 mb-xxl-4 mb-3">{{translate('Choose the SMS model you want to use for OTP & Other SMS')}}</p>
                            @if(!(count(collect($data['gateways'])->where('is_active', 1)) > 0) && $data['firebase_otp_verification']['live_values']['status'] == 0)
                                <div
                                    class="mb-15 bg-danger bg-opacity-10 fs-12 p-10 rounded d-flex gap-2 align-items-center">
                                        <span class="material-symbols-outlined text-danger">
                                                    warning
                                                </span>
                                    <span>{{ translate('3rd_party_is_not_set_up_yet_please_configure_it_first_to_ensure_it_works_properly') }}.</span>
                                </div>
                            @endif
                            @if($data['firebase_otp_verification']['live_values']['status'] == 1 && empty($data['firebase_otp_verification']['live_values']['web_api_key']))
                                <div
                                    class="mb-15 bg-danger bg-opacity-10 fs-12 p-10 rounded d-flex gap-2 align-items-center">
                                        <span class="material-symbols-outlined text-danger">
                                                    warning
                                                </span>
                                    <span>{{ translate('Firebase OTP is not set up yet. Please configure it first to ensure it works properly.') }}</span>
                                </div>
                            @endif
                        </div>
                        <div class="col-lg-9">
                            <div class="bg-light rounded-2 p-20">
                                <div class="d-flex align-items-center justify-content-between gap-2 flex-wrap mb-3">
                                    <label class="text-dark">{{translate('Select Business Model')}}
                                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                           data-bs-placement="top"
                                           title="{{translate('Select a configuration model to ensure proper operation')}}"
                                        >info</i>
                                    </label>
                                </div>
                                <div class="bg-white rounded-2 p-16">
                                    <div class="row g-xl-4 g-3">
                                        <div class="col-md-6">
                                            <div class="custom-radio">
                                                <input type="radio"
                                                       id="radio-option-1"
                                                       value="0"
                                                       @checked($data['firebase_otp_verification']['live_values']['status'] == 0)
                                                       class="{{ env('APP_ENV') == 'demo' ? '' : 'update-status-modal' }}"
                                                       data-url="{{ route('admin.configuration.update-firebase-otp-status') }}"
                                                       data-on-title="{{ translate('Are you sure you want to use third party gateway for sms') }}?"
                                                       data-off-title="{{ translate('Are you sure you want to use third party gateway for sms') }}?"
                                                       data-on-description="This action will make SMS Gateways your default SMS provider"
                                                       data-off-description="This action will make SMS Gateways your default SMS provider"
                                                       data-on-image="{{ asset('public/assets/admin-module/img/icons/swap.svg') }}"
                                                       data-off-image="{{ asset('public/assets/admin-module/img/icons/swap.svg') }}"
                                                >
                                                <label for="radio-option-1">
                                                    <h5 class="mb-1">{{translate('3rd Party')}}</h5>
                                                    <p class="fz-12 max-w-250">{{translate('You have to setup a SMS module from below fist to active this feature')}}</p>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="custom-radio">
                                                <input type="radio"
                                                       id="radio-option-2"
                                                       value="1"
                                                       @checked($data['firebase_otp_verification']['live_values']['status'] == 1)
                                                       class="{{ env('APP_ENV') == 'demo' ? '' : 'update-status-modal' }}"
                                                       data-url="{{ route('admin.configuration.update-firebase-otp-status') }}"
                                                       data-on-title="{{ translate('Are you sure you want to use firebase for sms') }}?"
                                                       data-off-title="{{ translate('Are you sure you want to use firebase for sms') }}?"
                                                       data-on-description="This action will make Firebase your default SMS provider"
                                                       data-off-description="This action will make Firebase your default SMS provider"
                                                       data-on-image="{{ asset('public/assets/admin-module/img/icons/swap.svg') }}"
                                                       data-off-image="{{ asset('public/assets/admin-module/img/icons/swap.svg') }}"
                                                >
                                                <label for="radio-option-2">
                                                    <h5 class="mb-1">{{translate('Firebase OTP')}}</h5>
                                                    <p class="fz-12 max-w-250">{{translate('Setup necessary')}} <a @can('firebase_view') href="{{ route('admin.configuration.third-party', 'firebase-configuration') }}" @endcan target="_blank" class="text-primary text-decoration-underline">{{ translate('Firebase Configurations') }}.</a></p>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-md-12 mb-15">
                    @if($publishedStatus == 1)
                        <div class="col-md-12 mb-3">
                            <div class="card">
                                <div class="card-body d-flex justify-content-around">
                                    <h4 class="payment-module-warning">
                                        <i class="tio-info-outined"></i>
                                        {{translate('Your current sms settings are disabled, because you
                                        have enabled
                                        sms gateway addon, To visit your currently active
                                        sms gateway settings please follow
                                        the link.')}}</h4>
                                    <a href="{{!empty($paymentUrl) ? $paymentUrl : ''}}"
                                       class="btn btn-outline-primary">{{translate('settings')}}</a>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="row {{ $publishedStatus == 1 ? 'disabled' : '' }}" id="gateway-cards">
                        @php($phoneVerificationStatus = (int) (login_setup('phone_verification'))->value ?? 0)

                        @foreach($data['gateways'] as $key => $smsConfig)
                            <div class="col-12 col-md-6 mb-15">
                                <div class="card view-details-container">
                                    <div class="card-body p-20">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="">
                                                <h4 class="page-title mb-1">
                                                    {{ str_replace('_', ' ', $smsConfig['key_name'])}}
                                                </h4>
                                                <p class="fz-12">
                                                    {{ translate('setup') }} {{ str_replace('_', ' ', $smsConfig['key_name'])}} {{ translate('_as_sms_gateway') }}
                                                </p>
                                            </div>
                                            <div class="d-flex flex-sm-nowrap flex-wrap justify-content-end justify-content-end align-items-center gap-sm-3 gap-2">
                                                <div class="view-btn  order-sm-0 order-3 fz-12 text-primary cursor-pointer fw-semibold d-flex align-items-center gap-1">
                                                    {{ translate('View') }}
                                                    <i class="material-symbols-outlined fz-14">arrow_downward</i>
                                                </div>
                                                <div class="mb-0">
                                                    <label class="switcher">
                                                        <input type="checkbox"
                                                               @checked($smsConfig['is_active'])
                                                               class="switcher_input {{ $smsConfig['key_name'] }}
                                                                    {{ env('APP_ENV') == 'demo' ? '' : ($phoneVerificationStatus == 1 && $smsConfig['is_active'] == 1 && $data['firebase_otp_verification']['live_values']['status'] == 0 ? 'check-phone-verification-status' : 'update-status-modal') }}"
                                                               data-id="{{ $smsConfig['key_name'] }}"
                                                               data-url="{{ route('admin.configuration.update-gateway-status', ['gateway' => $smsConfig['key_name'], 'status' => (int)!$smsConfig['is_active']]) }}"
                                                               data-on-title="{{translate('want_to_Turn_ON_').' '.ucwords(str_replace('_',' ',$smsConfig['key_name'])).' '.translate('_as_the_SMS_Gateway').'?'}}"
                                                               data-off-title="{{translate('want_to_Turn_OFF_').' '.ucwords(str_replace('_',' ',$smsConfig['key_name'])).' '.translate('_as_the_SMS_Gateway').'?'}}"
                                                               data-on-description="{{translate('if_enabled_system_can_use_this_SMS_Gateway')}}"
                                                               data-off-description="{{translate('if_disabled_system_cannot_use_this_SMS_Gateway')}}"
                                                               data-on-image="{{ asset('public/assets/admin-module/img/modal/sms/'. $smsConfig['key_name'] . '.png' ) }}"
                                                               data-off-image="{{ asset('public/assets/admin-module/img/icons/swap.svg') }}">
                                                        <span class="switcher_control {{ env('APP_ENV') == 'demo' ? 'disabled' : '' }}"  ></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <form class="view-details mt-20 third-party-data-form" action="{{route('admin.configuration.sms-set')}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="discount-type body-bg rounded p-20 mb-20">
                                                <input name="gateway"
                                                       value="{{$smsConfig['key_name']}}"
                                                       class="hide-div">
                                                <input name="mode" value="live"
                                                       class="hide-div">
                                                <input type="hidden" id="{{ $smsConfig['key_name'] }}-status" name="status" value="{{ (int)$smsConfig['is_active'] }}">
                                                @php($skip = ['gateway','mode','status'])
                                                @foreach($smsConfig['live_values'] as $keyName => $value)
                                                    @if(!in_array($keyName, $skip))
                                                        <div class=" mb-30 mt-30">
                                                            <label class="mb-2 text-dark">
                                                                {{ucwords(str_replace('_',' ',$keyName))}}
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text"
                                                                   class="form-control"
                                                                   name="{{$keyName}}"
                                                                   placeholder="{{ucwords(str_replace('_',' ',$keyName))}}"
                                                                   value="{{env('APP_ENV')=='demo' ? '' : $value}}" required>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                            @can('configuration_update')
                                                <div class="d-flex justify-content-end gap-xl-3 gap-2">
                                                    <button type="reset" class="btn btn--secondary rounded">{{translate('Reset')}}</button>
                                                    <button type="{{ env('APP_ENV') == 'demo' ? 'button' : 'submit' }}"
                                                            class="btn btn--primary demo_check rounded">
                                                        {{ translate('Save') }}
                                                    </button>
                                                </div>
                                            @endcan
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="send__sms" tabindex="-1" aria-labelledby="send__smsLabel" aria-hidden="true">
        <?php
            $activeSMSGateway = collect($data['gateways'])->where('is_active', 1)->first()?->key_name ?? '';
        ?>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-xl-4 p-3">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div>
                            <h4 class="mb-xl-2 mb-1">{{ translate('Send Test SMS') }}</h4>
                            <p>{{ translate('Insert a valid phone number to get SMS') }}</p>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="pick-map mb-20 p-12 rounded d-flex flex-md-nowrap flex-wrap align-items-center gap-1 bg-primary bg-opacity-10">
                        <img src="{{ asset('public/assets/admin-module/img/icons/focus_mode.svg') }}" alt="focus mode icon">
                        <p class="fz-12"> {{ $data['firebase_otp_verification']['live_values']['status'] == 1 ? 'Firebase OTP' : $activeSMSGateway }} is configured for SMS. Please test to ensure you are receiving SMS messages correctly.</p>
                    </div>
                    <form action="javascript:" class="body-bg rounded p-20">
                        <label for="sent-mail" class="mb-2 text-dark">{{translate('Phone number')}}
                            <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                               data-bs-placement="top"
                               title="{{translate('Phone number')}}"
                            >info</i>
                        </label>
                        <div class="d-flex align-items-center gap-1 iti__custom">
                             <input type="tel"
                                    class="form-control"
                                    id="exampleInputPhone"
                                    name="phone"
                                    placeholder="{{translate('Phone_number')}}"
                                    value="" required>
                            <div class="">
                                <button type="button" id="send-mail" class="btn h-40 btn--primary rounded">
                                    {{ translate('Send SMS') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif
