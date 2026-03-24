@if($webPage == 'email-config')
    <div class="tab-content">
        <div class="card p-20 mb-3">
            <div class="d-flex align-items-center justify-content-between flex-sm-nowrap flex-wrap gap-3">
                <div>
                    <h3 class="page-title mb-2">{{translate('Mail Configuration')}}</h3>
                </div>
                <button type="button"
                        class="rounded transition text-nowrap fz-12 fw-semibold btn-primary__outline btn d-flex align-items-center gap-1 py-2 px-3"
                        data-bs-toggle="modal" data-bs-target="#send__mail">
                    <img src="{{ asset('public/assets/admin-module/img/icons/send-icon.svg') }}" class="svg"
                         alt="send icon">
                    {{ translate('Send Test Mail') }}
                </button>
            </div>
        </div>
        <div class="tab-pane fade show active"
             id="email_config">
            <div class="card view-details-container mb-20">
                <form action="{{route('admin.configuration.store-third-party-data')}}"
                      method="POST"
                      class="third-party-data-form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="party_name" value="email_config">
                    <div class="card-body p-20">
                        <div class="row align-items-center">
                            <div class="col-xxl-8 col-md-6 mb-md-0 mb-2">
                                <h3 class="black-color mb-1 d-block">{{ translate('SMTP Mail Configuration') }}</h3>
                                <p class="fz-12 text-c mb-0">{{translate('Setup the SMTP settings so you can use email for sending and receiving')}}</p>
                            </div>
                            <div class="col-xxl-4 col-md-6">
                                @can('configuration_manage_status')
                                    <div
                                        class="d-flex flex-sm-nowrap flex-wrap justify-content-end justify-content-end align-items-center gap-sm-3 gap-2">
                                        <label class="switcher">
                                            <input type="checkbox" name="status"
                                                   class="switcher_input change-smtp-mail-status" @checked($data['status'] ?? false)>
                                            <span class="switcher_control"></span>
                                        </label>
                                    </div>
                                @endcan
                            </div>
                        </div>
                        <div class="view-details d-block mt-3">
                            <div class="discount-type body-bg rounded p-20">
                                <div class="row">
                                    <div class="col-md-6 col-lg-4 col-12 mb-30">
                                        <div class="">
                                            <label for="name" class="mb-2 text-dark">{{translate('mailer_name')}}
                                                <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                   data-bs-placement="top"
                                                   title="{{translate('Type mailer name')}}"
                                                >info</i>
                                            </label>
                                            <input type="text" id="name" class="form-control"
                                                   name="mailer_name"
                                                   placeholder="{{translate('mailer_name')}} *"
                                                   value="{{ $data['mailer_name'] ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4 col-12 mb-30">
                                        <div class="">
                                            <label for="host" class="mb-2 text-dark">{{translate('host')}}
                                                <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                   data-bs-placement="top"
                                                   title="{{translate('Enter the name of the host of your mailing service')}}"
                                                >info</i>
                                            </label>
                                            <input type="text" id="host" class="form-control" name="host"
                                                   placeholder="{{translate('host')}} *"
                                                   value="{{ $data['host'] ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4 col-12 mb-30">
                                        <div class="">
                                            <label for="driver" class="mb-2 text-dark">{{translate('driver')}}
                                                <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                   data-bs-placement="top"
                                                   title="{{translate('Enter the driver for your mailing service')}}"
                                                >info</i>
                                            </label>
                                            <input type="text" id="driver" class="form-control"
                                                   name="driver"
                                                   placeholder="{{translate('driver')}} *"
                                                   value="{{ $data['driver'] ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4 col-12 mb-30">
                                        <div class="">
                                            <label for="port" class="mb-2 text-dark">{{translate('port')}}
                                                <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                   data-bs-placement="top"
                                                   title="{{translate('Enter the port number for your mailing service')}}"
                                                >info</i>
                                            </label>
                                            <input type="text" id="port" class="form-control" name="port"
                                                   placeholder="{{translate('port')}} *"
                                                   value="{{ $data['port'] ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4 col-12 mb-30">
                                        <div class="">
                                            <label for="username" class="mb-2 text-dark">{{translate('Username')}}
                                                <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                   data-bs-placement="top"
                                                   title="{{translate('Enter the username of your account')}}"
                                                >info</i>
                                            </label>
                                            <input type="text" id="username" class="form-control"
                                                   name="user_name"
                                                   placeholder="{{translate('user_name')}} *"
                                                   value="{{ $data['user_name'] ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4 col-12 mb-30">
                                        <div class="">
                                            <label for="mainlid" class="mb-2 text-dark">{{translate('Email ID')}}
                                                <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                   data-bs-placement="top"
                                                   title="{{translate('Enter your email ID')}}"
                                                >info</i>
                                            </label>
                                            <input type="text" id="mainlid" class="form-control"
                                                   name="email_id"
                                                   placeholder="{{translate('email_id')}} *"
                                                   value="{{ $data['email_id'] ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4 col-12">
                                        <div class="">
                                            <label for="cryption" class="mb-2 text-dark">{{translate('Encryption')}}
                                                <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                   data-bs-placement="top"
                                                   title="{{translate('Enter the encryption type')}}"
                                                >info</i>
                                            </label>
                                            <input type="text" id="cryption" class="form-control"
                                                   name="encryption"
                                                   placeholder="{{translate('encryption')}} *"
                                                   value="{{ $data['encryption'] ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4 col-12">
                                        <div class="">
                                            <label for="pass" class="mb-2 text-dark">{{translate('Password')}}
                                                <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                   data-bs-placement="top"
                                                   title="{{translate('Enter your password')}}"
                                                >info</i>
                                            </label>
                                            <input type="text" id="pass" class="form-control"
                                                   name="password"
                                                   placeholder="{{translate('password')}} *"
                                                   value="{{ $data['password'] ?? '' }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @can('configuration_update')
                            <div class="d-flex justify-content-end trans3 mt-4">
                                <div class="d-flex justify-content-sm-end justify-content-center gap-2 gap-sm-3 flex-grow-1 flex-grow-sm-0 bg-white action-btn-wrapper trans3">
                                    <div class="d-flex justify-content-end gap-3">
                                        <button type="reset"
                                                class="btn btn--secondary rounded">{{translate('Reset')}}</button>
                                        <button type="submit" class="btn btn--primary rounded demo_check">
                                            {{translate('Save')}}
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @endcan
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="send__mail" tabindex="-1" aria-labelledby="send__emailLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered max-w-600">
            <div class="modal-content">
                <div class="modal-body p-xl-4 p-3">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div>
                            <h4 class="mb-xl-2 mb-1">{{ translate('Send Test Mail') }}</h4>
                            <p>{{ translate('Insert a valid email address to get mail') }}</p>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="javascript:" class="body-bg rounded p-20">
                        <label for="sent-mail" class="mb-2 text-dark">{{translate('Type Mail Address')}}
                            <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                               data-bs-placement="top"
                               title="{{translate('Type Mail Address')}}"
                            >info</i>
                        </label>
                        <div class="d-flex align-items-center gap-xl-3 gap-2">
                            <input type="email" class="form-control" id="test-email"  name="email" placeholder="{{translate('Ex: abc@email.com')}}" required="">
                            <div class="col-md-3 col-sm-5">
                                <button type="button" id="send-mail" class="btn h-40 btn--primary rounded">
                                    {{ translate('Send Mail') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif
