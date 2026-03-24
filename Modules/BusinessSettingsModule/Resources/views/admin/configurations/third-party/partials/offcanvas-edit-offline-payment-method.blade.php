<form action="{{route('admin.configuration.offline-payment.update')}}" method="post" id="{{$data->method_name}}-form" enctype="multipart/form-data" class="third-party-data-form">
    @csrf @method('PUT')
    <div class="offcanvas offcanvas-end offcanvas-cus-sm" tabindex="-1" id="offcanvas-{{ $data->method_name }}" aria-labelledby="offcanvas-{{ str_replace('_',' ',$data->method_name) }}-Label">
        <div class="offcanvas-header py-md-4 py-3">
            <h2 class="mb-0">
                {{ translate('Edit') }} - {{ str_replace('_',' ',$data->method_name) }}
            </h2>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body bg-white">
            <div class="body-bg rounded p-20 mb-20">
                <div class="mb-15">
                    <h4 class="mb-1">{{ str_replace('_',' ', $data->method_name) }}</h4>
                    <p class="fz-12">{{translate('If you turn off customer can`t pay through this payment geteway.')}}</p>
                </div>
                <div class="border rounded py-3 px-3 bg-white d-flex align-items-center justify-content-between">
                    <h5 class="fw-normal">{{translate('Status')}}</h5>
                    <label class="switcher">
                        <input type="checkbox"
                               name="status"
                               @checked($data->is_active)
                               class="update-status-modal switcher_input"
                               data-id="{{ $data->method_name }}"
                               data-url=""
                               data-on-title="{{ translate('want_to_Turn_ON_') }}{{str_replace('_',' ',strtoupper($data->method_name))}}{{ translate('_as_the_Digital_Payment_method').'?' }}"
                               data-off-title="{{ translate('want_to_Turn_OFF_') }}{{str_replace('_',' ',strtoupper($data->method_name))}}{{ translate('_as_the_Digital_Payment_method').'?' }}"
                               data-on-description="{{ translate('if_enabled_customers_can_use_this_payment_method') }}"
                               data-off-description="{{ translate('if_disabled_this_payment_method_will_be_hidden_from_the_checkout_page') }}"
                               data-on-image=""
                               data-off-image=""
                        >
                        <span class="switcher_control"></span>
                    </label>

                </div>
            </div>
            <div class="body-bg rounded-2 p-20 d-flex flex-column gap-lg-4 gap-3">
                <input type="hidden" value="{{$data['id']}}" name="id">
                <div>
                    <div class="mb-2 text-dark">{{translate('Choose Use Type')}}
                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                           data-bs-placement="top"
                           title="{{translate('Choose Use Type')}}"
                        >info</i>
                    </div>
                </div>
            </div>
        </div>
        <div class="offcanvas-footer border-top">
            <div class="d-flex justify-content-center gap-2 bg-white px-3 py-sm-3 py-2">
                <button class="btn btn--secondary w-100 rounded h-45" type="reset">{{translate('Reset')}}</button>
                <button class="btn btn--primary w-100 rounded h-45" type="submit">{{translate('Save')}}</button>
            </div>
        </div>
    </div>
</form>
