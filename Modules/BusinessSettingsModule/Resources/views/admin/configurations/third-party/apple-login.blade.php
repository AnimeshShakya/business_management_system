@if($webPage == 'apple-login')
    <div class="tab-content">
        <div class="tab-pane fade show active">
            <form action="{{route('admin.configuration.store-third-party-data')}}"
                  class="third-party-data-form"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="party_name" value="apple_login">
                <div class="card view-details-container">
                    <div class="card-body p-20">
                        <div class="row align-items-center">
                            <div class="col-xxl-8 col-md-6 mb-md-0 mb-2">
                                <h4 class="black-color mb-1 d-block">{{ translate('Apple Login') }}</h4>
                                <p class="fz-12 text-c mb-1">{{translate('Use Apple login as your customer Social Media Login turn the switch & setup the required files.')}}</p>
                                <a href="#0" class="text-decoration-underline text-primary" data-bs-toggle="modal" data-bs-target="#apple-login-get-credential-setup">{{ translate('Get Credential Setup') }}</a>
                            </div>
                            <div class="col-xxl-4 col-md-6">
                                @can('configuration_manage_status')
                                    <div class="d-flex flex-sm-nowrap flex-wrap justify-content-end justify-content-end align-items-center gap-sm-3 gap-2">
                                        <div class="mb-0">
                                            <label class="switcher">
                                                <input type="checkbox" name="status" class="switcher_input" @checked($data['status'] ?? false)>
                                                <span class="switcher_control"></span>
                                            </label>
                                        </div>
                                    </div>
                                @endcan
                            </div>
                        </div>
                        <div class="view-details d-block mt-20" >
                            <div class="discount-type d-flex flex-column gap-sm-4 gap-3 body-bg rounded p-20 mb-20">
                                <div class="">
                                    <label class="mb-2 text-dark d-flex align-items-center gap-1">{{translate('Client ID')}}
                                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                           data-bs-placement="top"
                                           title="{{translate('Enter Client ID')}}"
                                        >info</i>
                                    </label>
                                    <input type="text" name="client_id" class="form-control h-46" placeholder="Ex: Client ID" value="{{ $data['client_id'] ?? '' }}" />
                                </div>

                                <div class="">
                                    <label class="mb-2 text-dark d-flex align-items-center gap-1">{{translate('Enter Team ID')}}
                                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                           data-bs-placement="top"
                                           title="{{translate('Team ID')}}"
                                        >info</i>
                                    </label>
                                    <input type="text" class="form-control h-46" name="team_id" placeholder="Ex: Team ID"
                                           value="{{ $data['team_id'] ?? '' }}">
                                </div>

                                <div class="">
                                    <label class="mb-2 text-dark d-flex align-items-center gap-1">{{translate('Enter Key ID')}}
                                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                           data-bs-placement="top"
                                           title="{{translate('Key ID')}}"
                                        >info</i>
                                    </label>
                                    <input type="text" class="form-control h-46" name="key_id" placeholder="Ex: Client Key ID"
                                           value="{{ $data['key_id'] ?? '' }}">
                                </div>
                                <div class="">
                                    <label class="mb-2 text-dark d-flex align-items-center gap-1">{{translate('Service File')}}
                                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                           data-bs-placement="top"
                                           title="{{translate('upload Service File')}}"
                                        >info</i>
                                    </label>
                                    <input type="file" class="form-control h-46"
                                           name="apple_service_file"
                                           placeholder="Ex: Service File"
                                           accept=".p8"
                                           data-maxFileSize="{{ readableUploadMaxFileSize('file') }}">
                                    @if($data['service_file'] ?? false)
                                        <label class="mt-2"> {{translate('service_file_already_exists')}} </label>
                                    @endif
                                </div>
                            </div>
                            @can('configuration_update')
                            <div class="d-flex justify-content-end trans3 mt-4">
                                <div class="d-flex justify-content-sm-end justify-content-center gap-2 gap-sm-3 flex-grow-1 flex-grow-sm-0 bg-white action-btn-wrapper trans3">
                                    <div class="d-flex justify-content-end gap-xl-3 gap-2">
                                        <button type="reset" class="btn btn--secondary rounded">{{translate('Reset')}}</button>
                                        <button type="submit" class="btn btn--primary demo_check rounded">
                                            {{translate('Save')}}
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @endcan
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="apple-login-get-credential-setup" tabindex="-1"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="text-align: left;">
                <div class="modal-header border-0 pb-0 d-flex justify-content-end">
                    <button type="button" class="btn-close border-0 btn-circle bg-section2 shadow-none" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body px-20 py-0 mb-30">
                    <div class="d-flex gap-3 flex-column align-items-center text-center mb-4">
                        <h4 class="modal-title" id="staticBackdropLabel">{{ translate('Apple API Set up Instructions') }}</h4>
                    </div>

                    <ol class="d-flex flex-column gap-2">
                        <li>{{ translate('Go to apple developer page') }} (<a href="https://developer.apple.com/account/resources/identifiers/list" target="_blank">{{ translate('Click here') }}</a>)
                        </li>
                        <li>{{ translate('Here in top left corner you can see the') }}
                            <b>{{ translate('Team ID') }}</b> {{ translate('[Apple developer account name ]- Team ID') }}</li>
                        <li>{{ translate('Click plus icon') }} -&gt; {{ translate('Select app IDs') }}
                            -&gt; {{ translate('Click on continue') }}</li>
                        <li>{{ translate('Put a description and also identifier (identifier that used for app) and this is the') }}
                            <b>{{ translate('Client ID') }}</b></li>
                        <li>{{ translate('Click continue and download the file in device named AuthKey ID.p8 (store it safely and it is used for push notification) ') }}</li>
                        <li>{{ translate('Again click plus icon') }}
                            -&gt; {{ translate('Select service IDs') }} -&gt; {{ translate('Click on continue') }}</li>
                        <li>{{ translate('Push a description and also identifier and continue') }} </li>
                        <li>{{ translate('Download the file in device named') }}
                            <b>{{ translate('AuthKey KeyID.p8') }}</b>
                            {{ translate('[This is the service key ID file and also after AuthKey that is the key ID]') }}
                        </li>
                    </ol>
                    <div class="d-flex justify-content-center mt-4">
                        <button type="button" class="btn btn-primary px-5" data-bs-dismiss="modal">{{ translate('Got it') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
