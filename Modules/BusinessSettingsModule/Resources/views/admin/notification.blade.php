@extends('adminmodule::layouts.new-master')

@section('title',translate('notification_setup'))

@push('css_or_js')
    <link rel="stylesheet" href="{{asset('public/assets/admin-module')}}/plugins/select2/select2.min.css"/>
    <link rel="stylesheet" href="{{asset('public/assets/admin-module')}}/plugins/dataTables/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="{{asset('public/assets/admin-module')}}/plugins/dataTables/select.dataTables.min.css"/>
    <link rel="stylesheet" href="{{asset('public/assets/admin-module')}}/plugins/swiper/swiper-bundle.min.css"/>
@endpush

@section('content')
    <div class="main-content">
        <div class="container-fluid">
             <!-- Notification Messages -->
             <h2 class="page-title mb-3">{{translate('Notification Messages')}}</h2>
             <div class="position-relative mb-3">
                <ul class="nav nav--tabs scrollbar-w flex-nowrap white-nowrap overflow-x-auto flex-wrap-nowrap nav--tabs__style2">
                    <li class="nav-item">
                        <a class="nav-link {{ request('type', 'customers') == 'customers' ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['type' => 'customers']) }}">
                            {{ translate('Customer') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request('type', 'providers') == 'providers' ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['type' => 'providers']) }}">
                            {{ translate('Providers') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request('type', 'serviceman') == 'serviceman' ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['type' => 'serviceman']) }}">
                            {{ translate('Servicemen') }}
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
            <div class="bg-warning bg-opacity-10 fs-12 p-12 text-dark rounded mb-3">
                <div class="d-flex align-items-center gap-2">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_9562_195)">
                        <path d="M7 14C8.38447 14 9.73785 13.5895 10.889 12.8203C12.0401 12.0511 12.9373 10.9579 13.4672 9.67879C13.997 8.3997 14.1356 6.99224 13.8655 5.63437C13.5954 4.2765 12.9287 3.02922 11.9497 2.05026C10.9708 1.07129 9.7235 0.404603 8.36563 0.134506C7.00777 -0.13559 5.6003 0.003033 4.32122 0.532846C3.04213 1.06266 1.94888 1.95987 1.17971 3.11101C0.410543 4.26216 0 5.61553 0 7C0.0020073 8.8559 0.74015 10.6352 2.05247 11.9475C3.36479 13.2599 5.1441 13.998 7 14ZM7 2.91667C7.17306 2.91667 7.34223 2.96799 7.48612 3.06413C7.63002 3.16028 7.74217 3.29694 7.8084 3.45682C7.87462 3.61671 7.89195 3.79264 7.85819 3.96237C7.82443 4.13211 7.74109 4.28802 7.61872 4.41039C7.49635 4.53276 7.34044 4.6161 7.1707 4.64986C7.00097 4.68362 6.82504 4.66629 6.66515 4.60006C6.50527 4.53384 6.36861 4.42169 6.27246 4.27779C6.17632 4.1339 6.125 3.96473 6.125 3.79167C6.125 3.55961 6.21719 3.33705 6.38128 3.17295C6.54538 3.00886 6.76794 2.91667 7 2.91667ZM6.41667 5.83334H7C7.30942 5.83334 7.60617 5.95625 7.82496 6.17505C8.04375 6.39384 8.16667 6.69058 8.16667 7V10.5C8.16667 10.6547 8.10521 10.8031 7.99581 10.9125C7.88642 11.0219 7.73804 11.0833 7.58333 11.0833C7.42862 11.0833 7.28025 11.0219 7.17086 10.9125C7.06146 10.8031 7 10.6547 7 10.5V7H6.41667C6.26196 7 6.11358 6.93855 6.00419 6.82915C5.89479 6.71975 5.83333 6.57138 5.83333 6.41667C5.83333 6.26196 5.89479 6.11359 6.00419 6.00419C6.11358 5.8948 6.26196 5.83334 6.41667 5.83334Z" fill="#FFBB38"></path>
                        </g>
                        <defs>
                        <clipPath id="clip0_9562_195">
                        <rect width="14" height="14" fill="white"></rect>
                        </clipPath>
                        </defs>
                    </svg>
                    <p class="fz-12 mb-20">{{ translate('Setup Push Notification Messages for customer. Must setup') }} <a @can('firebase_view') href="{{ route('admin.configuration.third-party','firebase-configuration') }}" @endcan target="_blank" class="text-primary text-decoration-underline fw-medium">{{ translate('Firebase Configuration') }} </a>  {{ translate('page to work notifications.') }}</p>
                </div>
            </div>
            <div class="card">
                <div class="border-bottom p-20">
                    <h3 class="mb-1">{{ translate('Push Notification') }}</h3>
                    <p class="fz-12 mb-20">{{ translate('Here you set up your all push notification.') }}</p>
                </div>
                <div class="card-body p-20">
                    <div class="discount-type">
                        <div class="mb-4">
                            @php($language= Modules\BusinessSettingsModule\Entities\BusinessSettings::where('key_name','system_language')->first())
                            @php($defaultLanguage = str_replace('_', '-', app()->getLocale()))
                            @if($language)
                                <ul class="nav nav--tabs border-color-primary">
                                    <li class="nav-item">
                                        <a class="nav-link lang_link active"
                                            href="#"
                                            id="default-link">{{translate('default')}}</a>
                                    </li>
                                    @foreach ($language?->live_values as $lang)
                                        <li class="nav-item">
                                            <a class="nav-link lang_link"
                                                href="#"
                                                id="{{ $lang['code'] }}-link">{{ get_language_name($lang['code']) }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>

                        <div class="bg-light rounded p-20 mb-20">

                            <div class="row">
                                @if($queryParams == 'customers')
                                    @foreach(NOTIFICATION_FOR_USER as $userNotification)
                                        <div class="col-md-6">
                                            <form method="POST"
                                                  action="{{route('admin.configuration.set-message-setting', ['type' => $queryParams])}}">
                                                @csrf
                                                @method('PUT')
                                                @if($language)
                                                    <div class="mb-30 lang-form default-form">
                                                        <div class="mb-20 d-flex justify-content-between">
                                                            <b>{{ translate($userNotification['value'] . '_Message') }}</b>
                                                            @can('notification_message_manage_status')
                                                                <label class="switcher">
                                                                    <input class="switcher_input update-message"
                                                                           name="status"
                                                                           id="{{$userNotification['key']}}_status"
                                                                           {{$dataValues->where('key_name', $userNotification['key'])->where('settings_type', 'customer_notification')->first()?->live_values[$userNotification['key'].'_status']?'checked':''}}
                                                                           data-key="{{$userNotification['key'] ?? ''}}"
                                                                           type="checkbox"
                                                                           value="1">
                                                                    <span class="switcher_control"></span>
                                                                </label>
                                                            @endcan
                                                        </div>
                                                        <input type="hidden" name="id" value="{{ $userNotification['key'] }}">
                                                        <div class="form-floating">
                                                        <textarea class="form-control"
                                                                  id="{{ $userNotification['key'] }}_message"
                                                                  name="{{ $userNotification['key'] ?? '' }}_message[]">{{$dataValues->where('key_name', $userNotification['key'])->where('settings_type', 'customer_notification')->first()?->live_values[$userNotification['key'].'_message']}}</textarea>
                                                        </div>

                                                        @can('notification_message_update')
                                                            <div class="d-flex justify-content-end mt-10 gap-2">
                                                                <button type="reset" class="btn btn--secondary rounded">{{translate('reset')}}</button>
                                                                <button type="submit" class="btn btn--primary rounded demo_check">{{translate('update')}}</button>
                                                            </div>
                                                        @endcan
                                                    </div>
                                                    <input type="hidden" name="lang[]" value="default">
                                                    @foreach ($language?->live_values as $lang)
                                                            <?php
                                                            $notificationRow = $dataValues->where('key_name', $userNotification['key'])->where('settings_type', 'customer_notification')->first();
                                                            if (isset($notificationRow['translations']) && count($notificationRow['translations'])) {
                                                                $translate = [];
                                                                foreach ($notificationRow['translations'] as $t) {
                                                                    if ($t->locale == $lang['code'] && $t->key == $notificationRow->key_name) {
                                                                        $translate[$lang['code']][$notificationRow->key_name] = $t->value;
                                                                    }
                                                                }
                                                            }
                                                            ?>
                                                        <div class="mb-30 d-none lang-form {{$lang['code']}}-form">
                                                            <div class="mb-20 d-flex justify-content-between">
                                                                <b>{{ translate($userNotification['value'] . '_Message') }}
                                                                    ({{strtoupper($lang['code'])}})</b>

                                                                @can('notification_message_manage_status')
                                                                    <label class="switcher">
                                                                        <input class="switcher_input update-message"
                                                                               name="status"
                                                                               id="{{$userNotification['key']}}_status"
                                                                               {{$dataValues->where('key_name', $userNotification['key'])->where('settings_type', 'customer_notification')->first()?->live_values[$userNotification['key'].'_status']?'checked':''}}
                                                                               data-key="{{$userNotification['key'] ?? ''}}"
                                                                               type="checkbox"
                                                                               value="1">
                                                                        <span class="switcher_control"></span>
                                                                    </label>
                                                                @endcan
                                                            </div>
                                                            <input type="hidden" name="id" value="{{ $userNotification['key'] }}">
                                                            <div class="form-floating">
                                                        <textarea class="form-control"
                                                                  id="{{ $userNotification['key'] }}_message"
                                                                  name="{{ $userNotification['key'] ?? '' }}_message[]">{{$translate[$lang['code']][$notificationRow?->key_name] ?? ''}}</textarea>
                                                            </div>
                                                            @can('notification_message_update')
                                                                <div class="d-flex justify-content-end mt-10 gap-2">
                                                                    <button type="reset" class="btn btn--secondary rounded">{{translate('reset')}}</button>
                                                                    <button type="submit" class="btn btn--primary rounded demo_check">{{translate('update')}}</button>
                                                                </div>
                                                            @endcan
                                                        </div>
                                                        <input type="hidden" name="lang[]" value="{{$lang['code']}}">
                                                    @endforeach
                                                @else
                                                    <div class="mb-30 lang-form">
                                                        <div class="mb-20 d-flex justify-content-between">
                                                            <b>{{ translate($userNotification['value'] . '_Message') }}</b>
                                                            @can('notification_message_manage_status')
                                                                <label class="switcher">
                                                                    <input class="switcher_input update-message"
                                                                           name="status"
                                                                           id="{{$userNotification['key']}}_status"
                                                                           {{$dataValues->where('key_name', $userNotification['key'])->where('settings_type', 'customer_notification')->first()?->live_values[$userNotification['key'].'_status']?'checked':''}}
                                                                           data-key="{{$userNotification['key'] ?? ''}}"
                                                                           type="checkbox"
                                                                           value="1">
                                                                    <span class="switcher_control"></span>
                                                                </label>
                                                            @endcan
                                                        </div>
                                                        <input type="hidden" name="id" value="{{ $userNotification['key'] }}">
                                                        <div class="form-floating">
                                                        <textarea class="form-control"
                                                                  id="{{ $userNotification['key'] }}_message"
                                                                  name="{{ $userNotification['key'] ?? '' }}_message[]">{{$dataValues->where('key_name', $userNotification['key'])->where('settings_type', 'customer_notification')->first()?->live_values[$userNotification['key'].'_message']}}</textarea>
                                                        </div>
                                                        @can('notification_message_update')
                                                            <div class="d-flex justify-content-end mt-10 gap-2">
                                                                <button type="reset" class="btn btn--secondary rounded">{{translate('reset')}}</button>
                                                                <button type="submit" class="btn btn--primary rounded demo_check">{{translate('update')}}</button>
                                                            </div>
                                                        @endcan
                                                    </div>
                                                    <input type="hidden" name="lang[]" value="default">
                                                @endif
                                            </form>
                                        </div>
                                    @endforeach
                                @endif
                                @if($queryParams == 'providers')
                                    @foreach(NOTIFICATION_FOR_PROVIDER as $providerNotification)
                                        <div class="col-md-6">
                                            <form method="POST"
                                                  action="{{route('admin.configuration.set-message-setting', ['type' => $queryParams])}}">
                                                @csrf
                                                @method('PUT')
                                                @if($language)
                                                    <div class="mb-30 lang-form default-form">
                                                        <div class="mb-20 d-flex justify-content-between">
                                                            <b>{{ translate($providerNotification['value'] . '_Message') }}</b>

                                                            @can('notification_message_manage_status')
                                                                <label class="switcher">
                                                                    <input class="switcher_input update-message"
                                                                           name="status"
                                                                           id="{{$providerNotification['key']}}_status"
                                                                           {{$dataValues->where('key_name', $providerNotification['key'])->where('settings_type', 'provider_notification')->first()?->live_values[$providerNotification['key'].'_status']?'checked':''}}
                                                                           data-key="{{$providerNotification['key'] ?? ''}}"
                                                                           type="checkbox"
                                                                           value="1">
                                                                    <span class="switcher_control"></span>
                                                                </label>
                                                            @endcan

                                                        </div>
                                                        <input type="hidden" name="id" value="{{ $providerNotification['key'] }}">
                                                        <div class="form-floating">
                                                        <textarea class="form-control"
                                                                  id="{{ $providerNotification['key'] }}_message"
                                                                  name="{{ $providerNotification['key'] ?? '' }}_message[]">{{$dataValues->where('key_name', $providerNotification['key'])->where('settings_type', 'provider_notification')->first()?->live_values[$providerNotification['key'].'_message']}}</textarea>
                                                        </div>
                                                        @can('notification_message_update')
                                                            <div class="d-flex justify-content-end mt-10 gap-2">
                                                                <button type="reset" class="btn btn--secondary rounded">{{translate('reset')}}</button>
                                                                <button type="submit" class="btn btn--primary rounded demo_check">{{translate('update')}}</button>
                                                            </div>
                                                        @endcan
                                                    </div>
                                                    <input type="hidden" name="lang[]" value="default">
                                                    @foreach ($language?->live_values as $lang)
                                                            <?php
                                                            $notificationRow = $dataValues->where('key_name', $providerNotification['key'])->where('settings_type', 'provider_notification')->first();
                                                            if (isset($notificationRow['translations']) && count($notificationRow['translations'])) {
                                                                $translate = [];
                                                                foreach ($notificationRow['translations'] as $t) {
                                                                    if ($t->locale == $lang['code'] && $t->key == $notificationRow->key_name) {
                                                                        $translate[$lang['code']][$notificationRow->key_name] = $t->value;
                                                                    }
                                                                }
                                                            }
                                                            ?>
                                                        <div class="mb-30 d-none lang-form {{$lang['code']}}-form">
                                                            <div class="mb-20 d-flex justify-content-between">
                                                                <b>{{ translate($providerNotification['value'] . '_Message') }}
                                                                    ({{strtoupper($lang['code'])}})</b>

                                                                @can('notification_message_manage_status')
                                                                    <label class="switcher">
                                                                        <input class="switcher_input update-message"
                                                                               name="status"
                                                                               id="{{$providerNotification['key']}}_status"
                                                                               {{$dataValues->where('key_name', $providerNotification['key'])->where('settings_type', 'provider_notification')->first()?->live_values[$providerNotification['key'].'_status']?'checked':''}}
                                                                               data-key="{{$providerNotification['key'] ?? ''}}"
                                                                               type="checkbox"
                                                                               value="1">
                                                                        <span class="switcher_control"></span>
                                                                    </label>
                                                                @endcan
                                                            </div>
                                                            <input type="hidden" name="id" value="{{ $providerNotification['key'] }}">
                                                            <div class="form-floating">
                                                        <textarea class="form-control"
                                                                  id="{{ $providerNotification['key'] }}_message"
                                                                  name="{{ $providerNotification['key'] ?? '' }}_message[]">{{$translate[$lang['code']][$notificationRow?->key_name] ?? ''}}</textarea>
                                                            </div>
                                                            @can('notification_message_update')
                                                                <div class="d-flex justify-content-end mt-10 gap-2">
                                                                    <button type="reset" class="btn btn--secondary rounded">{{translate('reset')}}</button>
                                                                    <button type="submit" class="btn btn--primary rounded demo_check">{{translate('update')}}</button>
                                                                </div>
                                                            @endcan
                                                        </div>
                                                        <input type="hidden" name="lang[]" value="{{$lang['code']}}">
                                                    @endforeach
                                                @else
                                                    <div class="mb-30 lang-form">
                                                        <div class="mb-20 d-flex justify-content-between">
                                                            <b>{{ translate($providerNotification['value'] . '_Message') }}</b>

                                                            @can('notification_message_manage_status')
                                                                <label class="switcher">
                                                                    <input class="switcher_input update-message"
                                                                           name="status"
                                                                           id="{{$providerNotification['key']}}_status"
                                                                           {{$dataValues->where('key_name', $providerNotification['key'])->where('settings_type', 'provider_notification')->first()?->live_values[$providerNotification['key'].'_status']?'checked':''}}
                                                                           data-key="{{$providerNotification['key'] ?? ''}}"
                                                                           type="checkbox"
                                                                           value="1">
                                                                    <span class="switcher_control"></span>
                                                                </label>
                                                            @endcan
                                                        </div>
                                                        <input type="hidden" name="id"
                                                               value="{{ $providerNotification['key'] }}">
                                                        <div class="form-floating">
                                                        <textarea class="form-control"
                                                                  id="{{ $providerNotification['key'] }}_message"
                                                                  name="{{ $providerNotification['key'] ?? '' }}_message[]">{{$dataValues->where('key_name', $providerNotification['key'])->where('settings_type', 'provider_notification')->first()?->live_values[$providerNotification['key'].'_message']}}</textarea>
                                                        </div>
                                                        @can('notification_message_update')
                                                            <div class="d-flex justify-content-end mt-10 gap-2">
                                                                <button type="reset" class="btn btn--secondary rounded">
                                                                    {{translate('reset')}}
                                                                </button>
                                                                <button type="submit"
                                                                        class="btn btn--primary rounded demo_check">
                                                                    {{translate('update')}}
                                                                </button>
                                                            </div>
                                                        @endcan

                                                    </div>
                                                    <input type="hidden" name="lang[]" value="default">
                                                @endif
                                            </form>
                                        </div>
                                    @endforeach
                                @endif
                                @if($queryParams == 'serviceman')
                                    @foreach(NOTIFICATION_FOR_SERVICEMAN as $servicemanNotification)
                                        <div class="col-md-6">
                                            <form method="POST"
                                                  action="{{route('admin.configuration.set-message-setting', ['type' => $queryParams])}}">
                                                @csrf
                                                @method('PUT')
                                                @if($language)
                                                    <div class="mb-30 lang-form default-form">
                                                        <div class="mb-20 d-flex justify-content-between">
                                                            <b>{{ translate($servicemanNotification['value'] . '_Message') }}</b>

                                                            @can('notification_message_manage_status')
                                                                <label class="switcher">
                                                                    <input class="switcher_input update-message"
                                                                           name="status"
                                                                           id="{{$servicemanNotification['key']}}_status"
                                                                           {{$dataValues->where('key_name', $servicemanNotification['key'])->where('settings_type', 'serviceman_notification')->first()?->live_values[$servicemanNotification['key'].'_status']?'checked':''}}
                                                                           data-key="{{$servicemanNotification['key'] ?? ''}}"
                                                                           type="checkbox"
                                                                           value="1">
                                                                    <span class="switcher_control"></span>
                                                                </label>
                                                            @endcan

                                                        </div>
                                                        <input type="hidden" name="id" value="{{ $servicemanNotification['key'] }}">
                                                        <div class="form-floating">
                                                        <textarea class="form-control"
                                                                  id="{{ $servicemanNotification['key'] }}_message"
                                                                  name="{{ $servicemanNotification['key'] ?? '' }}_message[]">{{$dataValues->where('key_name', $servicemanNotification['key'])->where('settings_type', 'serviceman_notification')->first()?->live_values[$servicemanNotification['key'].'_message']}}</textarea>
                                                        </div>
                                                        @can('notification_message_update')
                                                            <div class="d-flex justify-content-end mt-10 gap-2">
                                                                <button type="reset" class="btn btn--secondary rounded">{{translate('reset')}}</button>
                                                                <button type="submit" class="btn btn--primary rounded demo_check">{{translate('update')}}</button>
                                                            </div>
                                                        @endcan
                                                    </div>
                                                    <input type="hidden" name="lang[]" value="default">
                                                    @foreach ($language?->live_values as $lang)
                                                            <?php
                                                            $notificationRow = $dataValues->where('key_name', $servicemanNotification['key'])->where('settings_type', 'serviceman_notification')->first();
                                                            if (isset($notificationRow['translations']) && count($notificationRow['translations'])) {
                                                                $translate = [];
                                                                foreach ($notificationRow['translations'] as $t) {
                                                                    if ($t->locale == $lang['code'] && $t->key == $notificationRow->key_name) {
                                                                        $translate[$lang['code']][$notificationRow->key_name] = $t->value;
                                                                    }
                                                                }
                                                            }
                                                            ?>
                                                        <div class="mb-30 d-none lang-form {{$lang['code']}}-form">
                                                            <div class="mb-20 d-flex justify-content-between">
                                                                <b>{{ translate($servicemanNotification['value'] . '_Message') }}
                                                                    ({{strtoupper($lang['code'])}})</b>

                                                                @can('notification_message_manage_status')
                                                                    <label class="switcher">
                                                                        <input class="switcher_input update-message"
                                                                               name="status"
                                                                               id="{{$servicemanNotification['key']}}_status"
                                                                               {{$dataValues->where('key_name', $servicemanNotification['key'])->where('settings_type', 'serviceman_notification')->first()?->live_values[$servicemanNotification['key'].'_status']?'checked':''}}
                                                                               data-key="{{$servicemanNotification['key'] ?? ''}}"
                                                                               type="checkbox"
                                                                               value="1">
                                                                        <span class="switcher_control"></span>
                                                                    </label>
                                                                @endcan

                                                            </div>
                                                            <input type="hidden" name="id"
                                                                   value="{{ $servicemanNotification['key'] }}">
                                                            <div class="form-floating">
                                                        <textarea class="form-control"
                                                                  id="{{ $servicemanNotification['key'] }}_message"
                                                                  name="{{ $servicemanNotification['key'] ?? '' }}_message[]">{{$translate[$lang['code']][$notificationRow?->key_name] ?? ''}}</textarea>
                                                            </div>

                                                            @can('notification_message_update')
                                                                <div class="d-flex justify-content-end mt-10 gap-2">
                                                                    <button type="reset" class="btn btn--secondary rounded">{{translate('reset')}}</button>
                                                                    <button type="submit" class="btn btn--primary rounded demo_check">{{translate('update')}}</button>
                                                                </div>
                                                            @endcan
                                                        </div>
                                                        <input type="hidden" name="lang[]" value="{{$lang['code']}}">
                                                    @endforeach
                                                @else
                                                    <div class="mb-30 lang-form">
                                                        <div class="mb-20 d-flex justify-content-between">
                                                            <b>{{ translate($servicemanNotification['value'] . '_Message') }}</b>

                                                            @can('notification_message_manage_status')
                                                                <label class="switcher">
                                                                    <input class="switcher_input update-message"
                                                                           name="status"
                                                                           id="{{$servicemanNotification['key']}}_status"
                                                                           {{$dataValues->where('key_name', $servicemanNotification['key'])->where('settings_type', 'serviceman_notification')->first()?->live_values[$servicemanNotification['key'].'_status']?'checked':''}}
                                                                           data-key="{{$servicemanNotification['key'] ?? ''}}"
                                                                           type="checkbox"
                                                                           value="1">
                                                                    <span class="switcher_control"></span>
                                                                </label>
                                                            @endcan
                                                        </div>
                                                        <input type="hidden" name="id" value="{{ $servicemanNotification['key'] }}">
                                                        <div class="form-floating">
                                                        <textarea class="form-control"
                                                                  id="{{ $servicemanNotification['key'] }}_message"
                                                                  name="{{ $servicemanNotification['key'] ?? '' }}_message[]">{{$dataValues->where('key_name', $servicemanNotification['key'])->where('settings_type', 'serviceman_notification')->first()?->live_values[$servicemanNotification['key'].'_message']}}</textarea>
                                                        </div>

                                                        @can('notification_message_update')
                                                            <div class="d-flex justify-content-end mt-10 gap-2">
                                                                <button type="reset" class="btn btn--secondary rounded">{{translate('reset')}}</button>
                                                                <button type="submit" class="btn btn--primary rounded demo_check">{{translate('update')}}</button>
                                                            </div>
                                                        @endcan
                                                    </div>
                                                    <input type="hidden" name="lang[]" value="default">
                                                @endif
                                            </form>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
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
                                    <button type="button" class="btn px-xl-5 px-4 btn--secondary rounded" data-bs-dismiss="modal">{{ translate('NO') }}</button>
                                    <button type="button" class="btn px-xl-5 px-4 btn--primary text-capitalize rounded">{{ translate('Yes') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade firebase-modal" id="carouselModal" tabindex="-1" aria-labelledby="carouselModal"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0 pb-1">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4 px-sm-5 pt-0">
                    <div dir="ltr" class="swiper modalSwiper pb-4">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="d-flex flex-column align-items-center gap-2 fs-12">
                                    <img width="80" class="mb-3"
                                         src="{{asset('public/assets/admin-module/img/media/firebase-console.png')}}"
                                         alt="">
                                    <h5 class="modal-title text-center mb-3">{{translate('Go to Firebase Console')}}</h5>

                                    @php($firebaseLink = 'https://console.firebase.google.com')
                                    <ul class="d-flex flex-column gap-2 px-3">
                                        <li>{{translate('Open your web browser and go to the Firebase Console')}} <a
                                                href="https://console.firebase.google.com">{{$firebaseLink}}</a>
                                        </li>
                                        <li>{{translate('Select the project for which you want to configure FCM from the Firebase
                                            Console dashboard.')}}
                                        </li>
                                        <li>{{translate('If you don’t have any project before. Create one with the website name.')}}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="d-flex flex-column align-items-center gap-2 fs-12">
                                    <img width="80" class="mb-3"
                                         src="{{asset('public/assets/admin-module/img/media/project-settings.png')}}"
                                         alt="">
                                    <h5 class="modal-title text-center mb-3">{{translate('Navigate to Project Settings')}}</h5>

                                    <ul class="d-flex flex-column gap-2 px-3">
                                        <li>{{translate('In the left-hand menu, click on the')}}
                                            <strong>"Settings"</strong> {{translate('gear icon,
                                            there you will vae a dropdown. and then select ')}}
                                            <strong>{{translate('"Project settings"')}}
                                            </strong> {{translate('from the dropdown.')}}
                                        </li>
                                        <li>{{translate('In the Project settings page, click on the "Cloud Messaging" tab from the
                                            top menu.')}}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="d-flex flex-column align-items-center gap-2 fs-12">
                                    <img width="80" class="mb-3"
                                         src="{{asset('public/assets/admin-module/img/media/cloud-message.png')}}"
                                         alt="">
                                    <h5 class="modal-title text-center mb-3">{{translate('Cloud Messaging API')}}</h5>

                                    <ul class="d-flex flex-column gap-2 px-3">
                                        <li>{{translate('From Cloud Messaging Page there will be a section called Cloud Messaging
                                            API.')}}
                                        </li>
                                        <li>{{translate('Click on the menu icon and enable the API')}}</li>
                                        <li>{{translate('Refresh the Cloud Messaging Page - You will have your server key. Just copy
                                            the code and paste here')}}
                                        </li>
                                    </ul>

                                    <div class="d-flex justify-content-center mt-2 w-100">
                                        <button type="button" class="btn btn-primary w-100 max-w320"
                                                data-bs-dismiss="modal">{{translate('Got It')}}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-pagination mb-2"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="documentationModal" tabindex="-1" aria-labelledby="documentationModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-0 pb-1">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex flex-column align-items-center gap-2 max-w360 mx-auto fs-12">
                        <img width="80" class="mb-3"
                             src="{{asset('public/assets/admin-module/img/media/documentation.png')}}" alt="">
                        <h5 class="modal-title text-center mb-3">{{translate('Documentation')}}</h5>
                        <p>{{translate('If disabled customers and provider will not receive notifications on their devices')}}</p>

                            <?php
                            $providerName = 'providerName';
                            $serviceManName = 'serviceManName';
                            $bookingId = 'bookingId';
                            $scheduleTime = 'scheduleTime';
                            $userName = 'userName';
                            $zoneName = 'zoneName';
                            ?>
                        <ul class="d-flex flex-column gap-2 px-3">
                            <li><span
                                    class="fw-medium">&#123;&#123;{{$providerName}}&#125;&#125;:</span> {{translate('the name of the provider.')}}
                            </li>
                            <li><span
                                    class="fw-medium">&#123;&#123;{{$serviceManName}}&#125;&#125;:</span> {{translate('the name of the service man name.')}}
                            </li>
                            <li><span
                                    class="fw-medium">&#123;&#123;{{$bookingId}}&#125;&#125;:</span> {{translate('the unique ID of the Booking.')}}
                            </li>
                            <li><span
                                    class="fw-medium">&#123;&#123;{{$scheduleTime}}&#125;&#125;:</span> {{translate('the expected sechedule time.')}}
                            </li>
                            <li><span
                                    class="fw-medium">&#123;&#123;{{$userName}}&#125;&#125;:</span> {{translate('the name of the user who placed the order.')}}
                            </li>
                            <li><span
                                    class="fw-medium">&#123;&#123;{{$zoneName}}&#125;&#125;:</span> {{translate('the name of the zone.')}}
                            </li>
                        </ul>
                    </div>

                    <div class="d-flex justify-content-center mt-2">
                        <button type="button" class="btn btn-primary w-100 max-w320" data-bs-dismiss="modal">
                            {{translate('Got It')}}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{asset('public/assets/admin-module')}}/plugins/select2/select2.min.js"></script>
    <script src="{{asset('public/assets/admin-module')}}/plugins/swiper/swiper-bundle.min.js"></script>
    <script src="{{asset('public/assets/admin-module')}}/plugins/dataTables/jquery.dataTables.min.js"></script>
    <script src="{{asset('public/assets/admin-module')}}/plugins/dataTables/dataTables.select.min.js"></script>

    <script>
        "use strict";

        let swiper = new Swiper(".modalSwiper", {
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
                dynamicBullets: true,
                autoHeight: true,
            },
        });

        $(document).ready(function () {
            $('.js-select').select2();
        });

        $('.update-message').on('click', function () {
            let id = $(this).data('key');
            update_message(id)
        });

        $('#business-info-update-form').on('submit', function (event) {
            event.preventDefault();

            var form = $('#business-info-update-form')[0];
            var formData = new FormData(form);

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
                    toastr.success('{{translate('successfully_updated')}}')
                },
                error: function () {

                }
            });
        });

        $(".push-notification-update-action-status").on('click', function () {
            let keyName = $(this).data('keyname');
            let value = $(this).is(':checked') === true ? 1 : 0
            update_action_status(keyName, value);
        })

        function update_action_status(key_name, value) {
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
                        url: "{{route('admin.configuration.set-notification-setting')}}",
                        data: {
                            key: key_name,
                            value: value,
                        },
                        type: 'put',
                        success: function (response) {
                            console.log(response)
                            toastr.success('{{translate('successfully_updated')}}')
                        },
                        error: function () {

                        }
                    });
                }
            })
        }

        function update_message(id) {
            Swal.fire({
                title: "{{translate('are_you_sure')}}?",
                text: '{{translate('want_to_update')}}',
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
                        url: "{{route('admin.configuration.set-message-setting')}}",
                        data: {
                            id: id,
                            status: $('#' + id + '_status').is(':checked') === true ? 1 : 0,
                            message: $('#' + id + '_message').val(),
                            type: "{{$queryParams}}",
                            change_type: "status"
                        },
                        type: 'post',
                        success: function (response) {
                            console.log(response)
                            toastr.success('{{translate('successfully_updated')}}')
                        },
                        error: function () {

                        }
                    });
                }
            })
        }

        $(document).ready(function () {
            $('#notification_type').on('change', function () {
                var selectedOption = $(this).val();

                var currentUrl = window.location.href;
                var url = new URL(currentUrl);

                url.searchParams.set('type', selectedOption);

                window.location.href = url.toString();
            });
        });

        $(".lang_link").on('click', function (e) {
            e.preventDefault();
            $(".lang_link").removeClass('active');
            $(".lang-form").addClass('d-none');
            $(this).addClass('active');

            let form_id = this.id;
            let lang = form_id.substring(0, form_id.length - 5);
            console.log(lang);
            $("." + lang + "-form").removeClass('d-none');
        });
    </script>
@endpush
