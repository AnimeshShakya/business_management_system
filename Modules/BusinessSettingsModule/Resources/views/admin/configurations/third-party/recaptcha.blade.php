@if($webPage == 'recaptcha')
    <div class="tab-content">
        <form action="{{route('admin.configuration.store-third-party-data')}}"
              method="POST"
              class="third-party-data-form"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="party_name" value="recaptcha">
            <div class="tab-pane fade show active">
                <div
                    class="bg-danger remove-wrap bg-opacity-10 fs-12 p-10 rounded d-flex gap-2 align-items-center justify-content-between gap-2 mb-15">
                    <div class="d-flex gap-2 align-items-lg-center">
                        <span class="material-symbols-outlined text-danger"> warning</span>
                        <span>
                                           <span class="fw-medium text-dark mb-1 d-block">{{ translate('V3 Version is available now. Must setup for ReCAPTCHA V3') }}</span>
                                           <span class="fs-12 d-block">{{ translate('You must setup for V3 version. Otherwise the default reCAPTCHA will be displayed automatically') }}</span>
                                        </span>
                    </div>
                    <span class="remove-btn w-20 h-20 cursor-pointer fz-10 rounded-full bg-white d-center">
                                        <i class="material-symbols-outlined">close</i>
                                    </span>
                </div>
                <div class="card">
                    <div class="card-body p-20">
                        <div
                            class="d-flex flex-md-nowrap flex-wrap align-items-center justify-content-between gap-2 mb-20">
                            <div>
                                <h4 class="page-title mb-1">{{translate('ReCAPTCHA')}}</h4>
                                <p class="fz-12">{{translate('Enable this to require user verification via reCAPTCHA. Set up your Google credentials to activate the feature properly.')}}
                                    <a href="#0" class="text-primary text-decoration-underline fw-medium" data-bs-toggle="modal" data-bs-target="#recaptcha-how-to-get-credentials">{{ translate('How to Get
                                        Credential') }}</a></p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center px-3 py-lg-3 py-2">
                                <label class="switcher ml-auto mb-0">
                                    <input type="checkbox" name="status" class="switcher_input" @checked($data['status'] ?? false)>
                                    <span class="switcher_control"></span>
                                </label>
                            </div>
                        </div>

                        <div class="discount-type body-bg rounded p-20 mb-20">
                            <div class="row g-4">
                                <div class="col-md-6 col-12">
                                    <div class="">
                                        <label
                                            class="mb-2 text-dark d-flex align-items-center gap-1">{{translate('Site Key')}}
                                            <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                               data-bs-placement="top"
                                               title="{{translate('Enter the site key')}}"
                                            >info</i>
                                        </label>
                                        <input name="party_name" value="recaptcha"
                                               class="hide-div">
                                        <input type="text" class="form-control"
                                               name="site_key"
                                               placeholder="{{translate('site_key')}} *"
                                               required=""
                                               value="{{ $data['site_key'] ?? '' }}">
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="">
                                        <label class="mb-2 text-dark d-flex align-items-center gap-1">{{translate('Secret Key')}}
                                            <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                               data-bs-placement="top"
                                               title="{{translate('Enter the secret key')}}"
                                            >info</i>
                                        </label>
                                        <input type="text" class="form-control"
                                               name="secret_key"
                                               placeholder="{{translate('secret_key')}} *"
                                               required=""
                                               value="{{ $data['secret_key'] ?? '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @can('configuration_update')
                            <div class="d-flex justify-content-end gap-xl-3 gap-2">
                                <button type="reset" class="btn btn--secondary rounded">{{translate('reset')}}</button>
                                <button type="submit" class="btn btn--primary demo_check rounded">{{translate('Save')}}</button>
                            </div>
                        @endcan
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="modal fade" id="recaptcha-how-to-get-credentials" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0 d-flex justify-content-end">
                    <button type="button" class="btn-close border-0" data-bs-dismiss="modal" aria-label="Close"><i class="tio-clear"></i></button>
                </div>
                <div class="modal-body px-4 px-sm-5 pt-0">
                    <div class="d-flex flex-column align-items-center gap-2">
                        <h4 class="lh-md mb-3 text-capitalize">{{ translate('Google recaptcha instructions') }}</h4>
                        <ol class="pl-4 instructions-list">
                            <li>
                                {{ translate('To get site key and secret key Go to the Credentials page') }}
                                (<a href="https://www.google.com/recaptcha/admin/create" target="_blank" class="text-primary">{{ translate('Click here') }}</a>)
                            </li>
                            <li>{{ translate('Add a label (Ex: abc company)') }}</li>
                            <li>{{ translate('Select reCAPTCHA v3 as ReCAPTCHA Type') }}</li>
                            <li>{{ translate('Select sub type:Im not a robot checkbox') }}</li>
                            <li>{{ translate('Add Domain (For ex: demo.6amtech.com)') }}</li>
                            <li>{{ translate('Check in Accept the reCAPTCHA Terms of Service') }}</li>
                            <li>{{ translate('Press Submit') }}</li>
                            <li>{{ translate('Copy Site Key and Secret Key  Paste in the input filed below and Save.') }}</li>
                        </ol>
                        <div class="d-flex justify-content-center mt-4">
                            <button type="button" class="btn btn--primary px-5" data-bs-dismiss="modal">{{ translate('Got it') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
