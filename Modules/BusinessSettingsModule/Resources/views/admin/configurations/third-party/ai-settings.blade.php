@extends('adminmodule::layouts.new-master')

@section('title',translate('AI Configuration'))

@section('content')
    <div class="main-content">
        <div class="container-fluid">

            <div class="tab-content">
                <form action="{{route('admin.configuration.ai-configuration.update')}}" method="POST" class="">
                    @csrf
                    <div class="tab-pane fade show active">
                        <div class="card">
                            <div class="card-body p-20">
                                <div class="d-flex flex-md-nowrap flex-wrap align-items-center justify-content-between gap-2 mb-20">
                                    <div>
                                        <h4 class="page-title mb-1">{{translate('AI Configuration')}}</h4>
                                        <p class="fz-12">{{translate('Manage your AI settings, including API credentials.')}}</p>
                                    </div>
                                    <button type="button" class="rounded transition text-nowrap fz-12 fw-semibold btn-primary__outline btn d-flex align-items-center gap-1 py-2 px-3"
                                            data-bs-toggle="offcanvas" data-bs-target="#offcanvasSetupGuide">
                                        <span class="material-symbols-outlined">visibility</span> {{ translate('View_Guideline') }}
                                    </button>
                                </div>

                                @can('payment_method_manage_status')
                                    <div class="mt-3">
                                        <div class="d-flex justify-content-between align-items-center gap-3 border rounded px-3 py-lg-3 py-2">
                                            <span class="fw-semibold text-dark">{{ translate('AI Status') }}</span>

                                            <label class="switcher ml-auto mb-0">
                                                <input type="checkbox"
                                                       data-name="status"
                                                       class="switcher_input {{ env('APP_ENV') == 'demo' ? 'demo_check' : 'update-status-modal' }}"
                                                       data-url="{{ route('admin.configuration.ai-configuration.status-update') }}"
                                                       data-on-title="{{ translate('Do you want to activate AI feature') }}?"
                                                       data-off-title="{{ translate('Do you want to deactivate AI feature') }}?"
                                                       data-on-description="If enabled, AI feature will be active and able to to generate content by AI"
                                                       data-off-description="If disabled, AI feature will be inactive and could not able to generate content by AI"
                                                       data-on-image="{{ asset('public/assets/admin-module/img/icons/status-on.png') }}"
                                                       data-off-image="{{ asset('public/assets/admin-module/img/icons/status-off.png') }}"
                                                    {{ isset($data['status']) && $data['status'] == 1 ? 'checked' : '' }}>
                                                <span class="switcher_control"></span>
                                            </label>
                                        </div>
                                    </div>
                                @endcan

                                <div class="discount-type body-bg rounded p-20 mb-20 mt-4">
                                    <div class="row g-4">
                                        <div class="col-md-6 col-12">
                                            <div class="">
                                                <label class="mb-2 text-dark d-flex align-items-center gap-1">{{translate('OpenAI API Key')}}<span class="text-danger"> *</span>
                                                    <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                       data-bs-placement="top"
                                                       title="{{ translate('Sign in to OpenAI, create an API key, and use it here.') }}"
                                                    >info</i>
                                                </label>
                                                <input type="text" class="form-control" name="api_key" placeholder="{{translate('Type API Key')}} *" required="" value="{{env('APP_ENV')=='demo' ? '' : $data['api_key'] ?? ''}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="">
                                                <label class="mb-2 text-dark d-flex align-items-center gap-1">{{translate('OpenAI Organization Id')}}<span class="text-danger"> *</span>
                                                    <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                       data-bs-placement="top"
                                                       title="{{ translate('Get your OpenAI Organization ID and enter it here for access and billing.') }}"
                                                    >info</i>
                                                </label>
                                                <input type="text" class="form-control" name="organization_id" placeholder="{{translate('Type Organization Id')}} *" required="" value="{{env('APP_ENV')=='demo' ? '' : $data['organization_id'] ?? ""}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @can('ai_configuration_update')
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
        </div>
    </div>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasSetupGuide" aria-labelledby="offcanvasSetupGuideLabel">

        <div class="offcanvas-header bg-body">
            <div>
                <h3 class="mb-1">{{ translate('AI_Configuration_Guideline') }}</h3>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <div class="offcanvas-body ai-offcanvas-body">
            <div class="p-12 p-sm-20 body-bg rounded mb-3 mb-sm-20">
                <div class="d-flex gap-3 align-items-center justify-content-between overflow-hidden">
                    <button class="btn-collapse d-flex gap-3 align-items-center bg-transparent border-0 p-0 collapsed" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapsePurpose" aria-expanded="true">
                        <div class="btn-collapse-icon border bg-light icon-btn rounded-circle text-dark collapsed">
                            <i class="fi fi-sr-angle-down"></i>
                        </div>
                        <span class="fw-bold text-start">{{ translate('Purpose') }} </span>
                    </button>
                </div>

                <div class="collapse mt-3 show" id="collapsePurpose">
                    <div class="card card-body">
                        <p class="fs-12">
                            {{ translate('To_configure_your_preferred_AI_provider_(e.g.,_OpenAI)_by_entering_the_necessary_credentials_and_AI_based_features_like_content_generation_or_image_processing') }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="p-12 p-sm-20 body-bg rounded mb-3 mb-sm-20">
                <div class="d-flex gap-3 align-items-center justify-content-between overflow-hidden">
                    <button class="btn-collapse d-flex gap-3 align-items-center bg-transparent border-0 p-0 collapsed" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapseAiFeatureToggle" aria-expanded="true">
                        <div class="btn-collapse-icon border bg-light icon-btn rounded-circle text-dark collapsed">
                            <i class="fi fi-sr-angle-down"></i>
                        </div>
                        <span class="fw-bold text-start">{{ translate('AI_Feature_Toggle') }} </span>
                    </button>
                </div>

                <div class="collapse mt-3" id="collapseAiFeatureToggle">
                    <div class="card card-body">
                        <p class="fs-12">
                            {{ translate('Use_this_switch_to_turn_AI_features_on_or_off_for_your_platform.') }}
                        </p>
                        <ul class="fs-12">
                            <li>
                                {{ translate('When_ON') }}: {{ translate('AI_tools_like_content_and_image_generation_will_work.') }}
                            </li>
                            <li>
                                {{ translate('When_OFF') }}: {{ translate('all_AI_features_will_stop_working_until_you_turn_it_back_on.') }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="p-12 p-sm-20 body-bg rounded mb-3 mb-sm-20">
                <div class="d-flex gap-3 align-items-center justify-content-between overflow-hidden">
                    <button class="btn-collapse d-flex gap-3 align-items-center bg-transparent border-0 p-0 collapsed" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapseAiFeatureEnableOpenAlConfigurationToggle" aria-expanded="true">
                        <div class="btn-collapse-icon border bg-light icon-btn rounded-circle text-dark collapsed">
                            <i class="fi fi-sr-angle-down"></i>
                        </div>
                        <span class="fw-bold text-start">{{ translate('Enable OpenAl Configuration') }} </span>
                    </button>
                </div>

                <div class="collapse mt-3" id="collapseAiFeatureEnableOpenAlConfigurationToggle">
                    <div class="card card-body">
                        <ul class="fs-12">
                            <li>
                                {{ translate('Go to the OpenAl API platform and') }}
                                <a target="_blank" href="{{ 'https://platform.openai.com/docs/overview' }}">{{ translate('Sign up') }}</a>
                                <span class="px-1">{{ translate('or') }}</span>
                                <a target="_blank" href="{{ 'https://platform.openai.com/docs/overview' }}">{{ translate('Log in.') }}</a>
                            </li>
                            <li>
                                {{ translate('Create a new API key and use it in the OpenAI API key section.') }}
                            </li>
                            <li>
                                {{ translate('Get your OpenAI Organization ID and enter it here for access and billing.') }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>


            <div class="p-12 p-sm-20 body-bg rounded mb-3 mb-sm-20">
                <div class="d-flex gap-3 align-items-center justify-content-between overflow-hidden">
                    <button class="btn-collapse d-flex gap-3 align-items-center bg-transparent border-0 p-0 collapsed" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapseTip" aria-expanded="true">
                        <div class="btn-collapse-icon border bg-light icon-btn rounded-circle text-dark collapsed">
                            <i class="fi fi-sr-angle-down"></i>
                        </div>
                        <span class="fw-bold text-start">{{ translate('Tip') }} </span>
                    </button>
                </div>

                <div class="collapse mt-3" id="collapseTip">
                    <div class="card card-body">
                        <p class="fs-12">
                            {{ translate('you_need_to_enter_the_correct_api_details_so_the_AI_tools_(like_text_or_image_generation)_can_work_without_errors.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('script')
@endpush
