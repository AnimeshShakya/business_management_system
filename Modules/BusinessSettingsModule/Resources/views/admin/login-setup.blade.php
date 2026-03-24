@extends('adminmodule::layouts.new-master')

@section('title',translate('login_setup'))

@section('content')
    <div class="main-content">
        <div class="container-fluid">
            <div class="page-title-wrap mb-4">
                <h2 class="page-title">{{translate('Login Setup')}}</h2>
            </div>
            <div class="mb-4">
                <ul class="nav nav--tabs nav--tabs__style2">
                    <li class="nav-item">
                        <a href="{{url()->current()}}?web_page=customer_login" class="nav-link {{$webPage=='customer_login'?'active':''}}">
                            {{translate('General Login Setup')}}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url()->current()}}?web_page=admin_provider_login" class="nav-link {{$webPage=='admin_provider_login'?'active':''}}">
                            {{translate('Rules & Restrictions')}}
                        </a>
                    </li>
                </ul>
            </div>
            @if($webPage=='customer_login')
                <form id="login-setup-form" action="{{route('admin.business-settings.login-setup-update')}}" method="post">
                    @csrf
                    <div class="card mb-20">
                        <div class="p-20 border-bottom">
                            <h3 class="mb-1">{{ translate('Login Setup') }}</h3>
                            <p class="fz-12 mb-20">{{ translate('The option you select customer will have the to option to login') }}</p>
                        </div>
                        <div class="p-20">
                            <div class="">
                                <div class="mb-20">
                                    <h4 class="mb-1">{{ translate('Choose How to Login') }}</h4>
                                    <p class="fz-12 mb-20">{{ translate('The option you select customer will have the option to login customer app and websites') }}</p>
                                </div>
                                <div class="bg-warning bg-opacity-10 fs-12 p-12 text-dark rounded mb-20">
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
                                        <p class="fz-12">
                                            {{ translate('At least one login method must remain active for the customer. Otherwise they will be unable to log in to the system') }}
                                        </p>
                                    </div>
                                </div>
                                <div class="card2 p-20">
                                    <div class="cus-shadow rounded p-sm-3 p-2 bg-white">
                                        <div class="row g-3">
                                            <div class="col-md-6 col-lg-4">
                                                <div class="check-disabled-custom d-flex flex-sm-nowrap flex-wrap gap-lg-3 gap-2 align-items-start">
                                                    <div class="form-check form--check">
                                                        <input class="form-check-input"
                                                               type="checkbox"
                                                               name="manual_login"
                                                               {{ $loginOptions?->manual_login == 1 ? 'checked' : '' }}
                                                               id="otp-manual_login">
                                                    </div>
                                                    <div>
                                                        <h5 class="text-dark mb-10">{{ translate('Manual Login') }}</h5>
                                                        <p class="fz-13 max-w-500">
                                                            {{ translate('By enabling manual login, customers will get the option to create an account and log in using the necessary credentials & password in the app & website') }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-4">
                                                <div class="d-flex flex-sm-nowrap flex-wrap gap-lg-3 gap-2 align-items-start">
                                                    <div class="form-check form--check">
                                                        <input class="form-check-input" name="otp_login" type="checkbox"
                                                               {{ $loginOptions?->otp_login == 1 ? 'checked' : '' }}
                                                               id="otp-login">
                                                    </div>
                                                    <div>
                                                        <h5 class="text-dark mb-10">{{ translate('OTP Login') }}</h5>
                                                        <p class="fz-13 max-w-500">
                                                            {{ translate('With OTP Login, customers can log in using their phone number without password. To enable this feature') }}
                                                            <a @can('configuration_view') href="{{ route('admin.configuration.third-party', 'sms_config') }}" @endcan target="_blank" class="text-primary text-decoration-underline fw-semibold">{{ translate('Configure SMS Setup') }} </a> {{ translate('Here') }}.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-4">
                                                <div class="d-flex flex-sm-nowrap flex-wrap gap-lg-3 gap-2 align-items-start">
                                                    <div class="form-check form--check">
                                                        <input class="form-check-input" name="social_media_login" type="checkbox"
                                                               {{ $loginOptions?->social_media_login == 1 ? 'checked' : '' }}
                                                               id="social-media-login">
                                                    </div>
                                                    <div>
                                                        <h5 class="text-dark mb-10">
                                                            {{ translate('Social Media Login') }}
                                                        </h5>
                                                        <p class="fz-13 max-w-500">
                                                            {{ translate('With Social Login, customers can log in using social media accounts. To enable this feature you have to active social media from below Social media login setup option') }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card p-20 mb-20" id="social-media-setup" style="display: none;">
                        <div class="row g-2 justify-content-between align-items-center mb-20">
                            <div class="col-md-6">
                                <h3 class="mb-1">{{ translate('Social media login setup') }}</h3>
                                <p class="fz-12 mb-20">{{ translate('The option you select customers will be able to log in to both the app and website based on the option you select.') }}</p>
                            </div>
                            <div class="col-md-6">
                                <a @can('configuration_view') href="{{ route('admin.configuration.third-party', 'apple-login')  }}" @endcan target="_blank" class="text-primary fz-14 text-md-end d-block">{{ translate('Connect 3rd party login system from here') }}</a>
                            </div>
                        </div>
                        <div class="bg-warning bg-opacity-10 fs-12 p-12 text-dark rounded mb-20">
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
                                <p class="fz-12">
                                    {{ translate('At least one social media must remain active for login. Otherwise they will be unable to log in to the system') }}
                                </p>
                            </div>
                        </div>
                        <div class="card2 p-20">
                            <div class="cus-shadow rounded p-sm-3 p-2 bg-white">
                                <div class="row g-3">
                                    <div class="col-md-6 col-lg-4">
                                        <div class="d-flex flex-sm-nowrap flex-wrap gap-lg-3 gap-2 align-items-start">
                                            <div class="form-check form--check">
                                                <input class="form-check-input form-check-lg" name="google" type="checkbox"
                                                       {{ $socialMediaLoginOptions?->google == 1 ? 'checked' : '' }}
                                                       id="google">
                                            </div>
                                            <div>
                                                <h5 class="text-dark mb-10">{{ translate('Google') }}</h5>
                                                <p class="fz-13 max-w-500">
                                                    {{ translate('Enabling Google Login, customers can log in to the site using their existing Email credentials.') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="d-flex flex-sm-nowrap flex-wrap gap-lg-3 gap-2 align-items-start">
                                            <div class="form-check form--check">
                                                <input class="form-check-input form-check-lg" name="facebook" type="checkbox"
                                                       {{ $socialMediaLoginOptions?->facebook == 1 ? 'checked' : '' }}
                                                       id="facebook">
                                            </div>
                                            <div>
                                                <h5 class="text-dark mb-10">
                                                    {{ translate('Facebook') }}
                                                </h5>
                                                <p class="fz-13 max-w-500">
                                                    {{ translate('Enabling Facebook Login, customers can log in to the site using their existing Facebook credentials') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="d-flex flex-sm-nowrap flex-wrap gap-lg-3 gap-2 align-items-start">
                                            <div class="form-check form--check">
                                                <input class="form-check-input form-check-lg" name="apple" type="checkbox"
                                                       {{ $socialMediaLoginOptions?->apple == 1 ? 'checked' : '' }}
                                                       id="apple">
                                            </div>
                                            <div>
                                                <h5 class="text-dark mb-10">
                                                    {{ translate('Apple') }}
                                                </h5>
                                                <p class="fz-13 max-w-500">
                                                    {{ translate('Enabling Apple Login, customers can log in to the site using their existing Apple login credentials, Only for Apple devices') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card p-20 mb-20">
                        <div class="mb-20">
                            <h3 class="mb-1">{{ translate('Verification') }}</h3>
                            <p class="fz-12 mb-20">{{ translate('The option you select from below will need to verify by customer from customer app/website') }}</p>
                        </div>
                        <div class="bg-warning bg-opacity-10 fs-12 p-12 text-dark rounded mb-20">
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
                                <p class="fz-12">
                                    {{ translate('At least one login option must remain active for Verification. Otherwise you will be unable to select & Save.') }}
                                </p>
                            </div>
                        </div>
                        <div class="card2 p-20 mb-20">
                            <div class="cus-shadow rounded p-sm-3 p-2 bg-white">
                                <div class="row g-3">
                                    <div class="col-md-6 col-lg-4">
                                        <div class="d-flex flex-sm-nowrap flex-wrap gap-lg-3 gap-2 align-items-start">
                                            <div class="form-check form--check">
                                                <input class="form-check-input form-check-lg" name="email_verification" type="checkbox"
                                                       {{ $emailVerification == 1 ? 'checked' : '' }}
                                                       id="email-verification">
                                            </div>
                                            <div>
                                                <h5 class="text-dark mb-10">{{ translate('Email Verification') }}</h5>
                                                <p class="fz-13 max-w-500">
                                                    {{ translate('If Email verification is on, Customers must verify their Email with an verification code to complete the signup process.') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="d-flex flex-sm-nowrap flex-wrap gap-lg-3 gap-2 align-items-start">
                                            <div class="form-check form--check">
                                                <input class="form-check-input form-check-lg" name="phone_verification" type="checkbox"
                                                       {{ $phoneVerification == 1 ? 'checked' : '' }}
                                                       id="phone-verification">
                                            </div>
                                            <div>
                                                <h5 class="text-dark mb-10">
                                                    {{ translate('Phone Number Verification') }}
                                                </h5>
                                                <p class="fz-13 max-w-500">
                                                    {{ translate('If Phone Number verification is on, Customers must verify their Phone Number with an OTP to complete the signup process.') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @can('login_setup_update')
                        <div class="d-flex justify-content-end trans3 mt-4">
                            <div class="d-flex justify-content-sm-end justify-content-center gap-2 gap-sm-3 flex-grow-1 flex-grow-sm-0 bg-white action-btn-wrapper trans3">
                                <button type="reset" class="btn btn--secondary rounded">
                                    {{translate('reset')}}
                                </button>
                                <button type="{{env('APP_ENV')!='demo'?'submit':'button'}}" class="btn btn--primary d-flex align-items-center gap-2 rounded demo_check">
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

            @endif


            @if($webPage=='admin_provider_login')
                <form action="{{route('admin.business-settings.set-otp-login-information')}}"
                      method="POST">
                    @csrf

                    <div class="card p-20 mb-20">
                        <div class="mb-20">
                            <h3 class="mb-1">{{ translate('OTP Setup') }}</h3>
                            <p class="fz-12 mb-20">{{ translate('Manage the settings for OTP and login attempt policies') }}</p>
                        </div>
                        <div class="card2 p-20 rounded">
                            <div class="row g-3">
                                <div class="col-md-6 col-lg-4">
                                    <div class="mb-2 text-dark d-flex align-items-center gap-1">{{translate('Maximum OTP hit')}}
                                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                           data-bs-placement="top"
                                           title="{{translate('Set the maximum number of incorrect OTP attempts allowed. After reaching the limit, the user will be temporarily blocked.')}}"
                                        >info</i>
                                    </div>
                                    <input type="number" class="form-control"
                                           name="maximum_otp_hit"
                                           placeholder="{{translate('Maximum OTP Hit')}} *"
                                           min="0" required
                                           value="{{$dataValues->where('key_name', 'maximum_otp_hit')->first()->live_values ?? ''}}">
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="mb-2 text-dark d-flex align-items-center gap-1">{{translate('OTP resend time (Sec)')}}
                                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                           data-bs-placement="top"
                                           title="{{translate('Set the time for requesting a new OTP.')}}"
                                        >info</i>
                                    </div>
                                    <input type="number" class="form-control" name="otp_resend_time"
                                           placeholder="{{translate('OTP Resend Time')}}"
                                           min="0" required
                                           value="{{$dataValues->where('key_name', 'otp_resend_time')->first()->live_values ?? ''}}">
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="mb-2 text-dark d-flex align-items-center gap-1">{{translate('Temporary block time (Sec)')}}
                                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                           data-bs-placement="top"
                                           title="{{translate('Users will be unable to request another OTP until the waiting time has passed.')}}"
                                        >info</i>
                                    </div>
                                    <input type="number" class="form-control"
                                           name="temporary_otp_block_time"
                                           placeholder="{{translate('Temporary OTP Block Time')}}"
                                           min="0" required
                                           value="{{$dataValues->where('key_name', 'temporary_otp_block_time')->first()->live_values ?? ''}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card p-20 mb-20">
                        <div class="mb-20">
                            <h3 class="mb-1">{{ translate('Login Setup') }}</h3>
                            <p class="fz-12 mb-20">{{ translate('Manage the settings for how many times a user can try to log in to the system.') }}</p>
                        </div>
                        <div class="card2 p-20 rounded">
                            <div class="row g-3">
                                <div class="col-md-6 col-lg-4">
                                    <div class="mb-2 text-dark d-flex align-items-center gap-1">{{translate('Maximum Login hit')}}
                                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                           data-bs-placement="top"
                                           title="{{translate('Set the maximum unsuccessful login attempt the user can make using the wrong password.')}}"
                                        >info</i>
                                    </div>
                                    <input type="number" class="form-control"
                                           name="maximum_login_hit"
                                           placeholder="{{translate('Maximum Login Hit')}} *"
                                           min="0" required
                                           value="{{$dataValues->where('key_name', 'maximum_login_hit')->first()->live_values ?? ''}}">
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="mb-2 text-dark d-flex align-items-center gap-1">{{translate('Temporary login block time (Sec)')}}
                                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                           data-bs-placement="top"
                                           title="{{translate('Set the time duration during which the user can not log in after reaching the maximum log in hit limit.')}}"
                                        >info</i>
                                    </div>
                                    <input type="number" class="form-control" name="temporary_login_block_time"
                                           placeholder="{{translate('Temporary Login Block Time')}}"
                                           min="0" required
                                           value="{{$dataValues->where('key_name', 'temporary_login_block_time')->first()->live_values ?? ''}}"
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                    @can('login_setup_update')
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

             @endif
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="smsConfigModal" tabindex="-1" role="dialog" aria-labelledby="smsConfigModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close position-absolute right-3 top-3 z-10" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body text-center">
                    <div>
                        <img src="{{ asset('public/assets/admin-module/img/sms-img.png') }}" alt="{{ translate('image') }}">
                    </div>
                    <div class="py-4">
                        <h4 class="modal-title" id="smsConfigModalLabel">{{ translate('Set Up SMS Configuration First') }}</h4>
                    </div>
                    <p>{{ translate('It looks like your SMS configuration is not set up yet. To enable the OTP system, please set up the SMS configuration first.') }}</p>
                </div>
                <div class="text text-center mb-5">
                    <a href="{{route('admin.configuration.third-party', 'sms_config')}}" target="_blank" class="btn btn--primary">{{ translate('Go to SMS Configuration') }}</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="socialMediaConfigModal" tabindex="-1" role="dialog" aria-labelledby="socialMediaConfigModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close position-absolute right-3 top-3 z-10" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body text-center">
                    <div>
                        <img src="{{ asset('public/assets/admin-module/img/sms-img.png') }}" alt="{{ translate('image') }}">
                    </div>
                    <div class="py-4">
                        <h4 class="modal-title" id="socialMediaConfigModalLabel">{{ translate('Set Up Social Media Configuration First') }}</h4>
                    </div>
                    <p id="socialMediaConfigModalDescription">{{ translate('It looks like your social media configuration is not set up yet. To enable the social media login system, please set up the social media configuration first.') }}</p>
                </div>
                <div class="text text-center mb-5">
                    <a id="socialLink" href="{{route('admin.configuration.get-third-party-config', ['web_page' => 'social_login'])}}" target="_blank" class="btn btn--primary">{{ translate('Go to Social Media Configuration') }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        "use strict";

        $(document).ready(function() {
            toggleSocialMediaSetup();

            $('#social-media-login').change(function() {
                toggleSocialMediaSetup();
            });

            $('button[type="reset"]').click(function() {
                setTimeout(function() {
                    toggleSocialMediaSetup();
                }, 0);
            });

            $(window).on('pageshow', function() {
                toggleSocialMediaSetup();
            });

            function toggleSocialMediaSetup() {
                if ($('#social-media-login').is(':checked')) {
                    $('#social-media-setup').show();

                    if (!$('#google').is(':checked') && !$('#facebook').is(':checked')) {
                        $('#google').prop('checked', true);
                    }
                } else {
                    $('#social-media-setup').hide();
                }
            }

            $('#google, #facebook').change(function() {
                if (!$('#google').is(':checked') && !$('#facebook').is(':checked')) {
                    $(this).prop('checked', true);
                }
            });

        });

        $(document).ready(function() {
            $('#otp-login').change(function(event) {
                if ($(this).is(':checked')) {
                    isSmsGatewayActivated(function(isActivated) {
                        if (!isActivated) {
                            event.preventDefault();
                            $('#otp-login').prop('checked', false);
                            $('#smsConfigModal').modal('show');
                        }
                    });
                }
            });

            function isSmsGatewayActivated(callback) {
                $.ajax({
                    url: '{{ route('admin.business-settings.check-active-sms-gateway') }}',
                    method: 'GET',
                    success: function(response) {
                        callback(response > 0);
                    },
                    error: function() {
                        callback(false);
                    }
                });
            }
        });

        $(document).ready(function() {
            function isSocialMediaActivated(socialMedia, callback) {
                $.ajax({
                    url: '{{ route('admin.business-settings.check-active-social-media') }}',
                    method: 'GET',
                    success: function(response) {
                        callback(response[socialMedia] == 1);
                    },
                    error: function() {
                        callback(false);
                    }
                });
            }

            function isEmailOrSMSConfigured(type, callback) {
                $.ajax({
                    url: '{{ route('admin.business-settings.check-email-or-sms-configured') }}',
                    method: 'GET',
                    data: { type: type }, // send the type (email or sms)
                    success: function(response) {
                        console.log(response);
                        callback(response[type] == 1);
                    },
                    error: function() {
                        callback(false);
                    }
                });
            }

            function showModal(title, description, imageUrl, link, linkTitle) {
                $('#socialMediaConfigModalLabel').text(title);
                $('#socialMediaConfigModalDescription').text(description);
                $('#socialLink').attr('href', link);
                $('#socialMediaConfigModal img').attr('src', imageUrl);
                $('#socialMediaConfigModal a').text(linkTitle);
                $('#socialMediaConfigModal').modal('show');
            }

            $('#apple').change(function(event) {
                if ($(this).is(':checked')) {
                    isSocialMediaActivated('apple', function(isActivated) {
                        if (!isActivated) {
                            event.preventDefault();
                            $('#apple').prop('checked', false);
                            showModal(
                                '{{ translate("Set Up Apple Configuration First") }}',
                                '{{ translate("It looks like your Apple configuration is not set up yet. To enable the Apple login system, please set up the Apple configuration first.") }}',
                                '{{ asset("public/assets/admin-module/img/apple-logo.png") }}',
                                '{{ route('admin.configuration.third-party', 'apple-login')}}',
                                '{{ translate('Go to Social Media Configuration') }}'
                            );
                        }
                    });
                }
            });

            $('#email-verification').change(function(event) {
                if ($(this).is(':checked')) {
                    isEmailOrSMSConfigured('email', function(isActivated) {
                        if (!isActivated) {
                            event.preventDefault();
                            $('#email-verification').prop('checked', false);
                            showModal(
                                '{{ translate("Set Up Email Configuration First") }}',
                                '{{ translate("It looks like your Email configuration is not set up yet. To enable the Email verification, please set up the Email configuration and turn on the status first.") }}',
                                '{{ asset("public/assets/admin-module/img/sms-img.png") }}',
                                '{{ route('admin.configuration.third-party', 'email-config', 'apple-login')}}',
                                '{{ translate('Go to Email Configuration') }}'
                            );
                        }
                    });
                }
            });

            $('#phone-verification').change(function(event) {
                if ($(this).is(':checked')) {
                    isEmailOrSMSConfigured('sms', function(isActivated) {
                        if (!isActivated) {
                            event.preventDefault();
                            $('#phone-verification').prop('checked', false);
                            showModal(
                                '{{ translate("Set Up SMS Configuration First") }}',
                                '{{ translate("It looks like your SMS configuration is not set up yet. To enable the Phone verification, please set up the SMS configuration and turn on the status first.") }}',
                                '{{ asset("public/assets/admin-module/img/sms-img.png") }}',
                                '{{ route('admin.configuration.third-party', 'sms_config')}}',
                                '{{ translate('Go to SMS Configuration') }}'
                            );
                        }
                    });
                }
            });
        });


        $('#login-setup-form').submit(function(event) {
            let manualLogin = $('#otp-manual_login').prop('checked');
            let otpLogin = $('#otp-login').prop('checked');
            let socialMediaLogin = $('#social-media-login').prop('checked');

            if (!manualLogin && !otpLogin && !socialMediaLogin) {
                event.preventDefault();
                Swal.fire({
                    type: 'warning',
                    title: '{{ translate("No Login Option Selected") }}!',
                    text: '{{ translate("Please select at least one login option.") }}',
                    confirmButtonText: '{{ translate("OK") }}',
                    confirmButtonColor: '#FC6A57',
                });
            }
        });

    </script>
@endpush
