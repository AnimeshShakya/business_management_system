<form action="{{ route('admin.configuration.payment-set') }}" method="post" id="{{$gateway->key_name}}-form" enctype="multipart/form-data" class="third-party-data-form">
    @csrf @method('PUT')
    <div class="offcanvas offcanvas-end offcanvas-cus-sm" tabindex="-1" id="offcanvas-{{ $gateway->key_name }}" aria-labelledby="offcanvas-{{ str_replace('_',' ',$gateway->key_name) }}-Label">
        <div class="offcanvas-header py-md-4 py-3">
            <h2 class="mb-0">
                {{ translate('Setup') }} - {{ ucwords(str_replace('_',' ',$gateway->key_name)) }}
            </h2>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body bg-white">
            <div class="body-bg rounded p-20 mb-20">
                <div class="mb-15">
                    <h4 class="mb-1">{{ str_replace('_',' ', $gateway->key_name) }}</h4>
                    <p class="fz-12">{{translate('If you turn off customer can`t pay through this payment gateway.')}}</p>
                </div>
                <div class="border rounded py-3 px-3 bg-white d-flex align-items-center justify-content-between">
                    <h5 class="fw-normal">{{translate('Status')}}</h5>
                    @php($gatewayImageFullPath = getPaymentGatewayImageFullPath(key: $gateway->key_name, settingsType: $gateway->settings_type, defaultPath: 'public/assets/admin-module/img/placeholder.png'))
                    @php($additionalData = $gateway['additional_data'] != null ? json_decode($gateway['additional_data']) : [])

                    @if(($gateway->is_active == 0 && checkCurrency($gateway->key_name, 'payment_gateway')) || ($gateway->is_active == 1))
                        <label class="switcher">
                            <input type="checkbox"
                                   name="status"
                                   @checked($gateway->is_active)
                                   class="update-status-modal switcher_input"
                                   data-id="{{ $gateway->key_name }}"
                                   data-url=""
                                   data-on-title="{{ translate('want_to_Turn_ON_') }}{{str_replace('_',' ',strtoupper($gateway->key_name))}}{{ translate('_as_the_Digital_Payment_method').'?' }}"
                                   data-off-title="{{ translate('want_to_Turn_OFF_') }}{{str_replace('_',' ',strtoupper($gateway->key_name))}}{{ translate('_as_the_Digital_Payment_method').'?' }}"
                                   data-on-description="{{ translate('if_enabled_customers_can_use_this_payment_method') }}"
                                   data-off-description="{{ translate('if_disabled_this_payment_method_will_be_hidden_from_the_checkout_page') }}"
                                   data-on-image="{{ $gatewayImageFullPath }}"
                                   data-off-image="{{ $gatewayImageFullPath }}"
                            >
                            <span class="switcher_control"></span>
                        </label>
                    @else
                        <label class="switcher">
                            <input type="checkbox"
                                   @checked($gateway['is_active'])
                                   class="update-status-modal switcher_input no-visual"
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
                            <span class="switcher_control"></span>
                        </label>
                    @endif

                </div>
            </div>
            <div class="body-bg rounded-2 p-20 mb-20">
                <div class="boxes">
                    <div class="mb-20 text-start">
                        <h5 class="fz-16 mb-1">{{translate('Choose Logo')}} <span class="text-danger">*</span></h5>
                        <p class="fz-12">{{ translate('It will show in website & app.') }}</p>
                    </div>
                    <div class="global-image-upload position-relative max-w-100 overflow-hidden bg-white border-dashed rounded-2 mx-auto mb-20 ratio-3-1 h-100px d-center {{ isset($gatewayImageFullPath) ? 'has-image' : '' }}">
                        <input type="file" name="gateway_image" accept="image/png, image/jpeg, image/jpg" {{ isset($gatewayImageFullPath) ? '' : 'required' }} style="position: absolute; width: 100%; height: 100%; opacity: 0; cursor: pointer;">
                        <div class="global-upload-box {{ isset($gatewayImageFullPath) ? 'd-none' : '' }}">
                            <div class="upload-content text-center">
                                <span class="material-symbols-outlined placeholder-icon mb-1 text-primary">photo_camera</span>
                                <span class="fz-10 d-block">Add image</span>
                            </div>
                        </div>
                        <img class="global-image-preview {{ isset($gatewayImageFullPath) ? '' : 'd-none' }}" src="{{ $gatewayImageFullPath }}" alt="Preview" style="max-height: 100%; max-width: 100%;" />
                        <div class="overlay-icons {{ isset($gatewayImageFullPath) ? '' : 'd-none' }}">
                            <button type="button" class="action-btn btn--light-primary bg-white outline-primary-hover edit-icon" title="Edit">
                                <span class="material-icons">edit</span>
                            </button>
                        </div>
                        <div class="image-file-name d-none mt-2 text-center text-muted" style="font-size: 12px;"></div>
                    </div>
                    <p class="fz-12 mt-lg-4 mt-3 text-center">
                        {{ translate('Image format')}} - {{ implode(', ', array_column(IMAGEEXTENSION, 'key')) }}
                        {{ translate("Image Size") }} - {{ translate('maximum size') }} {{ readableUploadMaxFileSize('image') }}
                        {{ translate('Image Ratio') }} - 3:1
                    </p>
                </div>
            </div>
            <div class="body-bg rounded-2 p-20 d-flex flex-column gap-lg-4 gap-3">
                <input type="hidden" name="gateway" value="{{ $gateway->key_name }}">
                <div>
                    <div class="mb-2 text-dark">{{translate('Choose Use Type')}}
                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                           data-bs-placement="top"
                           data-bs-html="true"
                           data-bs-title="<div>{{ translate('when_select_live_option') }}: {{ translate('during_use_this_from_website_or_app_need_real_required_data.') }} {{ translate('other_wise_this_gateway_can_not_work.') }}</div>
                                        <div class='p-2'></div>
                                        <div>{{ translate('when_select_test_option') }} : {{ translate('during_use_this_from_website_or_app_use_fake_required_data_to_test_payment_gateway_work_properly_or_not') }}</div>"
                        >info</i>
                    </div>
                    @php($mode = $gateway->live_values['mode'])
                    <div class="border setup-box p-12 rounded d-flex align-items-center gap-xl-5 gap-3">
                        <div class="custom-radio w-50">
                            <input type="radio" id="live-{{ $gateway->key_name }}" name="mode" value="live" {{ $mode == 'live' ? 'checked' : '' }} required>
                            <label for="live-{{ $gateway->key_name }}" class="fz-14 text-dark">Live</label>
                        </div>
                        <div class="custom-radio w-50">
                            <input type="radio" id="test-{{ $gateway->key_name }}" name="mode" value="test" {{ $mode == 'test' ? 'checked' : '' }} required>
                            <label for="test-{{ $gateway->key_name }}" class="fz-14 text-dark">Test</label>
                        </div>
                    </div>
                </div>
                @if($gateway->key_name === 'paystack')
                    @php($skip=['gateway', 'mode', 'status', 'supported_country', 'callback_url'])
                @else
                    @php($skip=['gateway','mode','status', 'supported_country'])
                @endif
                @foreach($gateway->live_values as $gatewayKey => $value)
                    @if(!in_array($gatewayKey , $skip))
                        <div>
                            <div class="mb-2 text-dark">
                                {{ucwords(str_replace('_',' ',$gatewayKey))}}
                                <span class="text-danger">*</span>
                            </div>
                            <input type="text" class="form-control" name="{{ $gatewayKey }}" placeholder="{{ ucwords(str_replace('_',' ',$gatewayKey)) }} *"  value="{{ env('APP_ENV') == 'demo' ? '' : $value }}" required>
                        </div>
                    @endif
                @endforeach
                <div>
                    <div class="mb-2 text-dark">
                        {{ translate('payment_gateway_title') }}
                        <span class="text-danger">*</span>
                    </div>
                    <input type="text" class="form-control" name="gateway_title" placeholder="{{ translate('payment_gateway_title') }} *"  value="{{ $additionalData != null ? $additionalData->gateway_title : '' }}" required>
                </div>
            </div>
        </div>
        @can('payment_method_update')
            <div class="offcanvas-footer border-top">
                <div class="d-flex justify-content-center gap-2 bg-white px-3 py-sm-3 py-2">
                    <button class="btn btn--secondary w-100 rounded h-45" type="reset">{{translate('Reset')}}</button>
                    <button class="btn btn--primary w-100 rounded h-45 demo_check" type="submit">{{translate('Save')}}</button>
                </div>
            </div>
        @endcan
    </div>
</form>
