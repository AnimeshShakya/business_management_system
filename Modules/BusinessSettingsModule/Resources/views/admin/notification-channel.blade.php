@extends('adminmodule::layouts.new-master')

@section('title',translate('notification_channel'))

@push('css_or_js')
    <link rel="stylesheet" href="{{asset('public/assets/admin-module')}}/plugins/select2/select2.min.css"/>
    <link rel="stylesheet" href="{{asset('public/assets/admin-module')}}/plugins/dataTables/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="{{asset('public/assets/admin-module')}}/plugins/dataTables/select.dataTables.min.css"/>
    <link rel="stylesheet" href="{{asset('public/assets/admin-module')}}/plugins/swiper/swiper-bundle.min.css"/>
@endpush

@section('content')
    <div class="main-content">
        <div class="container-fluid">
            <div class="page-title-wrap mb-3">
                <div class="">
                    <h2 class="page-title">{{translate('Notification Channels')}}</h2>
                </div>
            </div>

                <div class="position-relative mb-3">
                    <ul class="nav nav--tabs scrollbar-w flex-nowrap white-nowrap overflow-x-auto flex-wrap-nowrap nav--tabs__style2">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->get('notification_type') == 'user' ? 'active' : '' }}" href="{{ url()->current() }}?notification_type=user">
                                {{ translate('Customer') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->get('notification_type') == 'provider' ? 'active' : '' }}" href="{{ url()->current() }}?notification_type=provider">
                                {{ translate('Provider') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->get('notification_type') == 'serviceman' ? 'active' : '' }}" href="{{ url()->current() }}?notification_type=serviceman">
                                {{ translate('Serviceman') }}
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

                <div class="bg-warning bg-opacity-10 fs-12 p-12 text-dark rounded mt-3 mb-3">
                    <div class="d-flex align-items-center gap-2 mb-2">
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
                        <p class="fz-12">{{ translate('Setup Push Notification Messages for customers.') }} {{ translate('Must setup') }} <a @can('push_notification_view') href="{{ route('admin.configuration.get-notification-setting', ['type' => 'customers']) }}" @endcan target="_blank" class="text-primary text-decoration-underline fw-medium">{{ translate('Firebase Configuration') }}</a>  {{ translate('to work notifications.') }}</p>
                    </div>
                    <ul class="m-0 ps-20 d-flex flex-column gap-1 text-dark">
                        <li>{{ translate('Push notifications will work properly once the') }} <a @can('firebase_view') href="{{ route('admin.configuration.third-party', 'firebase-configuration') }}" @endcan target="_blank" class="fw-medium text-primary text-decoration-underline">{{ translate('Firebase configure') }}</a> {{ translate('setup properly') }}</li>
                        <li>{{ translate('Setup') }} <a @can('configuration_view') href="{{ route('admin.configuration.third-party', 'email-config') }}" @endcan target="_blank" class="fw-medium text-primary text-decoration-underline">{{ translate('Mail Configuration') }}</a> {{ translate('to work mail properly') }}</li>
                        <li>{{ translate('At least one') }} <a @can('configuration_view') href="{{ route('admin.configuration.third-party', 'sms_config') }}" @endcan target="_blank" class="fw-medium text-primary text-decoration-underline">{{ translate('SMS Method') }} </a>{{ translate('must be enable to Work SMS properly') }}</li>
                    </ul>
                </div>

                <div class="card mb-3">
                    <div class="card-body">
                        <div class="data-table-top d-flex flex-wrap gap-10 justify-content-between align-items-center">
                            <div class="">
                                <h3 class="mb-1">{{ translate('Admin Notification Channels') }}</h3>
                                <p class="fz-12">{{ translate('From here you setup who can see what types of notification from the system') }}</p>
                            </div>
                            <form action="{{ url()->current() }}" class="d-flex align-items-center gap-0 border rounded" method="GET">
                                <input type="hidden" name="notification_type" value="{{ request()->get('notification_type') }}">
                                <input type="search" class="theme-input-style border-0 rounded block-size-36" value="{{ request()->search }}" name="search" placeholder="{{translate('search_by_topics')}}">
                                <button type="submit" class="bg-light border-0 px-2 block-size-36 rounded-end d-flex align-items-center justify-content-center">
                                    <span class="material-symbols-outlined fz-20 opacity-75">
                                        search
                                    </span>
                                </button>
                            </form>
                        </div>
                        <div class="table-responsive table-admin-channels cus-shadow rounded">
                            <table class="table align-middle mb-0">
                                <thead class="text-nowrap">
                                    <tr>
                                        <th class="text-dark fw-medium bg-light p-0">
                                            <div class="table-custom-td gap-2 d-flex align-items-center justify-content-between p-20 py-2">
                                                <div class="d-flex sl-topics">
                                                    <span class="text-dark fw-medium">{{ translate('Sl') }}</span>
                                                    <div class="table-cont">
                                                        <span class="text-dark fw-medium fz-12">{{ trans('Topics') }}</span>
                                                    </div>
                                                </div>
                                                <span class="text-dark fw-medium w-120 text-center">{{ translate('Push Notification') }}</span>
                                                <span class="text-dark fw-medium w-120 text-center">{{ translate('Mail') }}</span>
                                                <span class="text-dark fw-medium w-120 text-center">{{ translate('SMS') }}</span>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @php $serial = 1; @endphp
                                    @foreach($notificationSetup as $groupTitle => $notifications)
                                        <tr>
                                            <td colspan="5" class="p-0">
                                                <div class="d-flex gap-2 p-20 py-2 table-toggle-btn cursor-pointer transition">
                                                    <span class="rounded-full bg-light w-20 h-20 fz-14">
                                                        <i class="material-symbols-outlined">keyboard_arrow_down</i>
                                                    </span>
                                                    <h5 class="fz-16 text-capitalize">{{ str_replace('_', ' ', $groupTitle) }}</h5>
                                                </div>

                                                <div class="table-custom-wrap">
                                                    @foreach($notifications as $notification)
                                                        @php
                                                            $value = json_decode($notification->value, true);
                                                            $data = json_decode($notification->value);
                                                            $email = $data->email;
                                                            $sms = $data->sms;
                                                            $notificationSetting = $data->notification;
                                                        @endphp
                                                        <div class="table-custom-td gap-2 d-flex align-items-center justify-content-between border-bottom p-20 py-2">
                                                            <div class="d-flex sl-topics">
                                                                <span class="text-dark">{{ $serial++ }}</span>
                                                                <div class="table-cont">
                                                                    <h5 class="mb-1">{{ $notification->title }}</h5>
                                                                    <p class="fz-12">{{ $notification->sub_title }}</p>
                                                                </div>
                                                            </div>

                                                            @can('notification_channel_manage_status')
                                                                <div class="w-120 text-center">
                                                                    @if(is_null($notificationSetting))
                                                                        N/A
                                                                    @else
                                                                        @can('notification_channel_manage_status')
                                                                            <label class="switcher mx-auto status-update">
                                                                                <input class="switcher_input" type="checkbox"
                                                                                       data-id="{{ $notification->id }}"
                                                                                       data-type="notification"
                                                                                    {{ $value['notification'] ? 'checked' : '' }}>
                                                                                <span class="switcher_control"></span>
                                                                            </label>
                                                                        @endcan
                                                                    @endif
                                                                </div>
                                                                <div class="w-120 text-center">
                                                                    @if(is_null($email))
                                                                        N/A
                                                                    @else
                                                                        @can('notification_channel_manage_status')
                                                                            <label class="switcher mx-auto" data-bs-toggle="modal" data-bs-target="#turnOffStatus">
                                                                                <input class="switcher_input" type="checkbox"
                                                                                       data-id="{{ $notification->id }}" data-type="email"
                                                                                    {{ $value['email'] ? 'checked' : '' }}>
                                                                                <span class="switcher_control"></span>
                                                                            </label>
                                                                        @endcan
                                                                    @endif
                                                                </div>
                                                                <div class="w-120 text-center">
                                                                    @if(is_null($sms))
                                                                        N/A
                                                                    @else
                                                                        @can('notification_channel_manage_status')
                                                                            <label class="switcher mx-auto" data-bs-toggle="modal" data-bs-target="#turnOffStatus">
                                                                                <input class="switcher_input" type="checkbox"
                                                                                       data-id="{{ $notification->id }}" data-type="sms"
                                                                                    {{ $value['sms'] ? 'checked' : '' }}>
                                                                                <span class="switcher_control"></span>
                                                                            </label>
                                                                        @endcan
                                                                    @endif
                                                                </div>
                                                            @endcan

                                                        </div>
                                                    @endforeach
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
                        <h3 class="mb-15 confirmation-title-text">{{ translate('Are you sure Turn Off the status?')}}</h3>
                        <p class="mb-4 fz-14 confirmation-description-text">{{ translate('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet ')}}</p>
                        <form id="hidden-status-form" method="POST" action="{{ route('admin.business-settings.updateNotificationStatus') }}">
                            @csrf
                            <input type="hidden" name="id" value="">
                            <input type="hidden" name="email" value="" disabled>
                            <input type="hidden" name="sms" value="" disabled>
                            <input type="hidden" name="notification" value="" disabled>
                            <div class="choose-option">
                                <div class="d-flex gap-3 justify-content-center flex-wrap">
                                    <button type="button" class="btn px-xl-5 px-4 btn--secondary rounded" data-bs-dismiss="modal">NO</button>
                                    <button type="button" class="btn btn--primary text-capitalize rounded" id="confirmChange">Yes</button>

                                </div>
                            </div>
                        </form>
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

        {{--$('.switcher_input').change(function() {--}}
        {{--    var id = $(this).data('id');--}}
        {{--    var type = $(this).data('type');--}}
        {{--    var status = $(this).is(':checked') ? 1 : 0;--}}

        {{--    $.ajax({--}}
        {{--        url: '{{ route("admin.business-settings.updateNotificationStatus") }}',--}}
        {{--        type: 'POST',--}}
        {{--        data: {--}}
        {{--            _token: '{{ csrf_token() }}',--}}
        {{--            id: id,--}}
        {{--            [type]: status--}}
        {{--        },--}}
        {{--        success: function(response) {--}}
        {{--            if (response.success) {--}}
        {{--                toastr.success('{{translate('successfully_updated')}}')--}}
        {{--            } else {--}}
        {{--                toastr.error('{{translate('something worng')}}')--}}
        {{--            }--}}
        {{--        }--}}
        {{--    });--}}
        {{--});--}}


        let selectedItem;
        let selectedId;
        let selectedType;
        let initialStatus;

        $(document).on('change', '.switcher_input', function (e) {
            e.preventDefault();

            selectedItem = $(this);
            selectedId = selectedItem.data('id');
            selectedType = selectedItem.data('type');
            initialStatus = selectedItem.prop('checked');

            // Revert visual checkbox state until confirmed
            selectedItem.prop('checked', !initialStatus);

            $('.confirmation-title-text').text(
                initialStatus
                    ? '{{ translate('Are you sure to Turn On the Status') }}?'
                    : '{{ translate('Are you sure to Turn Off the Status') }}?'
            );

            $('.confirmation-description-text').text('This action will change the notification settings.');

            $('#turnOffStatus').modal('show');
        });

        $('#confirmChange').on('click', function () {
            // Clear and disable all inputs except 'id'
            $('#hidden-status-form input[name="email"]').val('').prop('disabled', true);
            $('#hidden-status-form input[name="sms"]').val('').prop('disabled', true);
            $('#hidden-status-form input[name="notification"]').val('').prop('disabled', true);

            // Set id
            $('#hidden-status-form input[name="id"]').val(selectedId);

            // Enable and set the correct type input only
            let input = $('#hidden-status-form input[name="' + selectedType + '"]');
            input.val(initialStatus ? 1 : 0);
            input.prop('disabled', false);

            // Submit the form
            $('#hidden-status-form').submit();
        });


        $('.cancel-change').on('click', function () {
            if (selectedItem) {
                selectedItem.prop('checked', !initialStatus);
            }
            $('#turnOffStatus').modal('hide');
        });

        $('#turnOffStatus').on('hidden.bs.modal', function () {
            if (selectedItem) {
                selectedItem.prop('checked', !initialStatus);
            }
        });


    </script>
@endpush
