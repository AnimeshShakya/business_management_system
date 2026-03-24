<div class="tab-pane fade {{ request()->has('type') && request()->type == 'digital_payment' ? 'show active' : '' }}" id="payment-tabs1" role="tabpanel" aria-labelledby="payment-custom-tab1" tabindex="0">
    <div class="bg-warning bg-opacity-10 fs-12 p-12 text-dark rounded mb-10">
        <div class="d-flex align-items-center gap-2 mb-2">
            <p class="fz-12 fw-medium">
                <img src="{{ asset('public/assets/admin-module/img/icons/alert_info.svg') }}" alt="alert info icon">
                {{ translate('Here you can configure payment gateways by obtaining the necessary credentials (e.g., API keys) from each respective payment gateway platform.') }}</p>
        </div>
        <ul class="m-0 ps-20 d-flex flex-column gap-1 text-dark">
            <li>{{ translate('To use digital payments, you need to set up at least one payment method') }}</li>
            <li>{{ translate('To make available these payment options, you must enable the Digital payment option from ') }} <a @can('business_view') href="{{ route('admin.business-settings.get-business-information') }}" @endcan class="fw-semibold text-primary text-decoration-underline" target="_blank">{{ translate('Business Information') }}</a> {{ translate('_page.') }}</li>
        </ul>
    </div>
    <?php
        $currencySupported = 0;
        if (isset($data['gateways']))
        {
            foreach ($data['gateways'] as $gateway)
            {
                if ((bool)$gateway->is_active == 1 && checkCurrency($gateway->key_name, 'payment_gateway'))
                {
                    $currencySupported = 1;
                    break;
                }
            }
        }
    ?>
    @if(!$currencySupported)
        <div class="mb-15 bg-danger bg-opacity-10 fs-12 p-10 rounded d-flex gap-2 align-items-center">
                    <span class="material-symbols-outlined text-danger">
                        warning
                    </span>
            <span>{{ translate('Currently no payment gateway supported your currency. Active at least one gateway that support your currency. To change currency setup visit') }} <a href="{{ route('admin.business-settings.get-business-information') }}" class="fw-medium text-primary text-decoration-underline">{{ translate('Business Information') }}</a> {{ translate('_page') }}</span>
        </div>
    @endif

    <div class="card">
        <div class="card-body p-20">
            <div class="d-flex align-items-center flex-wrap gap-10 justify-content-between mb-20">
                <h4>{{translate('Digital Payment Methods List')}}</h4>
                <form action="{{ route('admin.configuration.third-party', 'payment_config') }}" class="d-flex align-items-center gap-0 border rounded" method="GET">
                    <input type="hidden" name="type" value="digital_payment">
                    <input type="search" class="theme-input-style border-0 rounded block-size-36" value="{{ $data['search'] ?? '' }}" name="search" placeholder="{{translate('search_here')}}">
                    <button type="submit" class="bg-light border-0 px-2 block-size-36 rounded-end d-flex align-items-center justify-content-center">
                                    <span class="material-symbols-outlined fz-20 opacity-75">
                                        search
                                    </span>
                    </button>
                </form>
            </div>
            @if($publishedStatus == 1)
                <div class="col-12 mb-3">
                    <div class="card">
                        <div class="card-body d-flex justify-content-around">
                            <h4 class="text-danger pt-2">
                                <i class="tio-info-outined"></i>
                                {{translate('Your current payment settings are disabled, because
                                you have enabled
                                payment gateway addon, To visit your currently
                                active payment gateway settings please follow
                                the link')}}.</h4>

                            <a href="{{!empty($paymentUrl) ? $paymentUrl : ''}}"
                               class="btn btn-outline-primary">{{translate('settings')}}</a>
                        </div>
                    </div>
                </div>
            @endif
            <div class="row g-4 {{ $publishedStatus == 1 ? 'disabled' : '' }}" id="gateway-cards" >
                @forelse($data['gateways'] as $key=> $gateway)
                    <div class="col-lg-6">
                        <div
                            class="cus-shadow2 payment-test__wrap p-20 d-flex align-items-center justify-content-between flex-wrap gap-2">
                                <?php
                                $gatewayReadyToUse = 1;
                                foreach (\Illuminate\Support\Arr::except($gateway['live_values'], 'status') as $liveValueKey => $liveValues) {
                                    if (empty($liveValues)) {
                                        $gatewayReadyToUse = 0;
                                    }
                                }
                                $gatewayImageFullPath = getPaymentGatewayImageFullPath(key: $gateway->key_name, settingsType: $gateway->settings_type, defaultPath: 'public/assets/admin-module/img/placeholder.png');
                                ?>
                            <div class="d-flex align-items-center gap-2">
                                <h5 class="text-dark"> {{ ucwords(str_replace('_',' ',$gateway->key_name)) }}</h5> <span
                                    class="bg-primary payment-test bg-opacity-10 rounded py-1 px-2 text-primary fz-12">{{ $gateway->live_values['mode'] }}</span>
                                @if(!$gatewayReadyToUse)
                                    <span
                                        class="bg-danger payment-test bg-opacity-10 rounded py-1 px-2 text-danger fz-12"> {{ translate('Not_Configured') }}</span>
                                @endif
                            </div>

                            <div class="d-flex align-items-center gap-xxl-4 gap-xl-3 gap-2">
                                @can('payment_method_manage_status')
                                    @if(checkCurrency($gateway->key_name, 'payment_gateway'))
                                        @if(!$gatewayReadyToUse)
                                            <label class="switcher"
                                                   data-bs-toggle="offcanvas"
                                                   data-bs-target="#offcanvas-{{ $gateway->key_name }}">
                                                <input class="switcher_input"
                                                       type="checkbox" value="1" name="status" disabled>
                                                <span class="switcher_control"></span>
                                            </label>
                                        @else
                                            <label class="switcher">
                                                <input type="checkbox"
                                                       @checked($gateway->is_active)
                                                       class="{{ env('APP_ENV') == 'demo' ? '' : 'update-status-modal' }} switcher_input"
                                                       data-id="{{ $gateway->key_name }}"
                                                       data-url="{{ route('admin.configuration.update-payment-status', ['gateway' => $gateway->key_name, 'status' => (int)!$gateway->is_active]) }}"
                                                       data-on-title="{{ translate('want_to_Turn_ON_') }}{{str_replace('_',' ',strtoupper($gateway->key_name))}}{{ translate('_as_the_Digital_Payment_method').'?'}}"
                                                       data-off-title="{{ translate('want_to_Turn_OFF_') }}{{str_replace('_',' ',strtoupper($gateway->key_name))}}{{ translate('_as_the_Digital_Payment_method').'?'}}"
                                                       data-on-description="{{ translate('if_enabled_customers_can_use_this_payment_method') }}"
                                                       data-off-description="{{ translate('if_disabled_this_payment_method_will_be_hidden_from_the_checkout_page') }}"
                                                       data-on-image="{{ $gatewayImageFullPath }}"
                                                       data-off-image="{{ $gatewayImageFullPath }}"
                                                       data-cancel-button-text="{{ translate('Cancel') }}"
                                                       data-confirm-button-text="{{ translate('Ok') }}"
                                                >
                                                <span class="switcher_control {{ env('APP_ENV') == 'demo' ? 'disabled' : '' }}"></span>
                                            </label>
                                        @endif
                                    @else
                                        @if((bool)$gateway->is_active == 1)
                                            <label class="switcher">
                                                <input type="checkbox"
                                                       @checked($gateway->is_active)
                                                       class="{{ env('APP_ENV') == 'demo' ? '' : 'update-status-modal' }} switcher_input"
                                                       data-id="{{ $gateway->key_name }}"
                                                       data-url="{{ route('admin.configuration.update-payment-status', ['gateway' => $gateway->key_name, 'status' => (int)!$gateway->is_active]) }}"
                                                       data-on-title="{{ translate('want_to_Turn_ON_') }}{{str_replace('_',' ',strtoupper($gateway->key_name))}}{{ translate('_as_the_Digital_Payment_method').'?'}}"
                                                       data-off-title="{{ translate('want_to_Turn_OFF_') }}{{str_replace('_',' ',strtoupper($gateway->key_name))}}{{ translate('_as_the_Digital_Payment_method').'?'}}"
                                                       data-on-description="{{ translate('if_enabled_customers_can_use_this_payment_method') }}"
                                                       data-off-description="{{ translate('if_disabled_this_payment_method_will_be_hidden_from_the_checkout_page') }}"
                                                       data-on-image="{{ $gatewayImageFullPath }}"
                                                       data-off-image="{{ $gatewayImageFullPath }}"
                                                       data-cancel-button-text="{{ translate('Cancel') }}"
                                                       data-confirm-button-text="{{ translate('Ok') }}"
                                                >
                                                <span class="switcher_control {{ env('APP_ENV') == 'demo' ? 'disabled' : '' }}"></span>
                                            </label>
                                        @else
                                            <label class="switcher">
                                                <input type="checkbox"
                                                       @checked($gateway['is_active'])
                                                       class="{{ env('APP_ENV') == 'demo' ? '' : 'update-status-modal' }} switcher_input no-visual"
                                                       id="{{ $gateway->key_name }}"
                                                       data-url=""
                                                       data-on-title="{{str_replace('_',' ',strtoupper($gateway->key_name))}}{{ translate('_can_not_be_turned_on')}}"
                                                       data-off-title="{{str_replace('_',' ',strtoupper($gateway->key_name))}}{{ translate('_can_not_be_turned_on')}}"
                                                       data-on-description="{{ translate('Your current currency is not supported by this gateway') }}"
                                                       data-off-description="{{ translate('Your current currency is not supported by this gateway') }}"
                                                       data-on-image="{{ $gatewayImageFullPath }}"
                                                       data-off-image="{{ $gatewayImageFullPath }}"
                                                       data-cancel-button-text="{{ translate('Cancel') }}"
                                                       data-confirm-button-text="{{ translate('Ok') }}"
                                                >
                                                <span class="switcher_control {{ env('APP_ENV') == 'demo' ? 'disabled' : '' }}"></span>
                                            </label>
                                        @endif
                                    @endif
                                @endcan

                                @can('payment_method_update')
                                    <button type="button" class="action-btn btn--danger"
                                            data-bs-toggle="offcanvas" data-bs-target="#offcanvas-{{ $gateway->key_name }}">
                                        <span class="material-icons">settings</span>
                                    </button>
                                @endcan
                            </div>
                        </div>
                    </div>
                @empty
                        <div class="text-center bg-white  pt-5 pb-5">
                            <img src="{{asset('public/assets/admin-module')}}/img/payment-list-error.png" alt="error" class="w-100px mx-auto mb-3">
                            <p>{{translate('No Payment Method List')}}</p>
                        </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

@foreach($data['gateways'] as $key=> $gateway)
    @include("businesssettingsmodule::admin.configurations.third-party.partials.offcanvas-edit-digital-payment-method", ['gateway' => $gateway])
@endforeach
