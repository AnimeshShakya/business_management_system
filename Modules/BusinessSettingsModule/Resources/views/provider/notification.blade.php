@extends('providermanagement::layouts.master')

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
            <div class="page-title-wrap d-flex justify-content-between align-items-center mb-3">
                <div class="">
                    <h2 class="page-title">{{translate('Notification Channels Setup')}}</h2>
                    <p class="mt-1">
                        {{translate('From here Provider can configure which notifications users receive and through which channels (e.g., Email, SMS, Push notification)')}}
                    </p>
                </div>
            </div>
            <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-3">
                <ul class="nav nav--tabs nav--tabs__style2">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->get('notification_type') == 'provider' ? 'active' : '' }}" href="{{ url()->current() }}?notification_type=provider">
                            Provider
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->get('notification_type') == 'serviceman' ? 'active' : '' }}" href="{{ url()->current() }}?notification_type=serviceman">
                            Serviceman
                        </a>
                    </li>
                </ul>
            </div>

            <div class="card mb-3">
                <div class="card-body">
                    <div class="data-table-top d-flex flex-wrap gap-10 justify-content-between align-items-center">
                        <div class="d-flex gap-2 fw-medium me-auto">

                        </div>
                        <form action="{{ url()->current() }}" class="search-form search-form_style-two" method="get">
                            <div class="input-group search-form__input_group">
                            <span class="search-form__icon">
                                <span class="material-icons">search</span>
                            </span>
                                <input type="search" class="theme-input-style search-form__input" name="search" value="{{ request()->search }}" placeholder="{{translate('search_here')}}">
                            </div>
                            <input type="hidden" name="notification_type" value="{{ request()->get('notification_type') }}">

                            <button type="submit" class="btn btn--primary">{{translate('search')}}</button>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead class="text-nowrap">
                                <tr>
                                    <th class="text-dark fw-medium bg-light p-0">
                                        <div class="table-custom-td gap-2 d-flex align-items-center justify-content-between p-20 py-2">
                                            <div class="d-flex sl-topics">
                                                <span class="text-dark fw-medium">{{ translate('Sl') }}</span>
                                                <div class="table-cont">
                                                    <span class="text-dark fw-medium">{{ trans('Topics') }}</span>
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
                                            @foreach($notifications as $index => $notification)
                                                @php
                                                    $admin = json_decode($notification->value);
                                                    $provider = optional($notification->providerNotifications->first());
                                                    $providerValue = $provider ? json_decode($provider->value) : null;

                                                    $email = $providerValue->email ?? $admin->email;
                                                    $push = $providerValue->notification ?? $admin->notification;
                                                    $sms = $providerValue->sms ?? $admin->sms;
                                                @endphp
                                                <div class="table-custom-td gap-2 d-flex align-items-center justify-content-between border-bottom p-20 py-2">
                                                    <div class="d-flex sl-topics">
                                                        <span class="text-dark">{{ $index + 1 }}</span>
                                                        <div class="table-cont">
                                                            <h5 class="mb-1">{{ translate($notification->title) }}</h5>
                                                            <p class="fz-12">{{ translate($notification->sub_title) }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="w-120 text-center">
                                                        @if(is_null($admin->notification))
                                                            N/A
                                                        @else
                                                            <label class="switcher mx-auto" @if($admin->notification == 0 ) data-bs-toggle="tooltip" data-bs-placement="top" title="{{translate('disable from admin')}}" @endif>
                                                                <input class="switcher_input status-update"
                                                                        type="checkbox"
                                                                        data-id="{{ $notification->id }}"
                                                                        data-type="notification"
                                                                        data-title="{{ $push == 1 ? 'Disable Notification Channel' : 'Enable Notification Channel' }}"
                                                                        data-description="{{ $push == 1 ? 'Notifications will no longer be sent' : 'This will start sending notifications' }}"
                                                                        data-image="{{ asset('public/assets/admin-module/img/icons/status_on_off.png')}}"
                                                                       data-confirm-btn="{{ $push == 1 ? 'Disable' : 'Enable' }}"
                                                                    {{ (int)$push === 1 && (int)$admin->notification !== 0 ? 'checked' : '' }}
                                                                    {{ $admin->notification == 0 ? 'disabled' : '' }}>
                                                                <span class="switcher_control"></span>
                                                            </label>
                                                        @endif
                                                    </div>

                                                    <div class="w-120 text-center">
                                                        @if(is_null($admin->email))
                                                            N/A
                                                        @else
                                                            <label class="switcher mx-auto" @if($admin->email == 0 ) data-bs-toggle="tooltip" data-bs-placement="top" title="{{translate('disable from admin')}}" @endif>
                                                                <input class="switcher_input status-update"
                                                                        data-id="{{ $notification->id }}"
                                                                        data-type="email"
                                                                        type="checkbox"
                                                                       data-title="{{ $email == 1 ? 'Disable Email Channel' : 'Enable Email Channel' }}"
                                                                       data-description="{{ $email == 1 ? 'Notifications will no longer be sent' : 'This will start sending notifications' }}"
                                                                        data-image="{{ asset('public/assets/admin-module/img/icons/sms_status_on_off.png')}}"
                                                                       data-confirm-btn="{{ $email == 1 ? 'Disable' : 'Enable' }}"
                                                                    {{ (int)$email === 1 && (int)$admin->email !== 0 ? 'checked' : '' }}
                                                                    {{ $admin->email == 0 ? 'disabled' : '' }}>
                                                                <span class="switcher_control"></span>
                                                            </label>
                                                        @endif
                                                    </div>

                                                    <div class="w-120 text-center">
                                                        @if(is_null($admin->sms))
                                                            N/A
                                                        @else
                                                            <label class="switcher mx-auto" @if($admin->sms == 0 ) data-bs-toggle="tooltip" data-bs-placement="top" title="{{translate('disable from admin')}}" @endif>
                                                                <input class="switcher_input status-update"
                                                                        data-id="{{ $notification->id }}"
                                                                        data-type="sms"
                                                                        type="checkbox"
                                                                       data-title="{{ $sms == 1 ? 'Disable SMS Channel' : 'Enable SMS Channel' }}"
                                                                       data-description="{{ $sms == 1 ? 'Notifications will no longer be sent' : 'This will start sending notifications' }}"
                                                                        data-image="{{ asset('public/assets/admin-module/img/icons/sms_status_on_off.png')}}"
                                                                       data-confirm-btn="{{ $sms == 1 ? 'Disable' : 'Enable' }}"
                                                                    {{ (int)$sms === 1 && (int)$admin->sms !== 0 ? 'checked' : '' }}
                                                                    {{ $admin->sms == 0 ? 'disabled' : '' }}>
                                                                <span class="switcher_control"></span>
                                                            </label>
                                                        @endif
                                                    </div>
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


    <!-- Confirmation Modal for status -->
    <div class="modal fade" id="changeStatusModal" tabindex="-1" role="dialog" aria-labelledby="changeStatusModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close cancel-change" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body mb-30 pb-0 text-center">
                    <img width="80" src="{{ asset('public/assets/admin-module/img/icons/status-on.png') }}" alt="{{ translate('image') }}" class="mb-20">
                    <h3 class="mb-3 confirmation-title-text">{{ translate('Are you sure') }}?</h3>
                    <p class="mb-0 confirmation-description-text">{{ translate('Do you want to change the status') }}?</p>
                    <div class="btn--container mt-30 justify-content-center">
                        <button type="button" class="btn btn--secondary min-w-120 cancel-change" id="cancelChange">{{ translate('Cancel') }}</button>
                        <button type="button" class="btn btn--primary min-w-120" id="confirmChange">{{ translate('Yes') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script>

        let selectedItem;
        let notificationId;
        let type;
        let status;
        let originalChecked;

        $(document).on('change', '.status-update', function (e) {
            e.preventDefault();

            selectedItem = $(this);
            originalChecked = selectedItem.prop('checked');

            selectedItem.prop('checked', !originalChecked);

            notificationId = selectedItem.data('id')
            type = selectedItem.data('type');
            status = selectedItem.is(':checked') ? 0 : 1;

            let confirmationTitleText = selectedItem.data('title')
            let confirmationDescriptionText = selectedItem.data('description')
            let imgSrc = selectedItem.data('image')
            let confirmBtn = selectedItem.data("confirm-btn")

            $('.confirmation-title-text').text(confirmationTitleText);
            $('.confirmation-description-text').text(confirmationDescriptionText);
            $('#changeStatusModal img').attr('src', imgSrc);
            $("#confirmChange").text(confirmBtn)

            selectedItem.blur();
            $('#changeStatusModal').modal('show');
        });

        $('#changeStatusModal').on('shown.bs.modal', function () {
            $('#confirmChange').trigger('focus');
        });

        $('#confirmChange').on('click', function () {
            updateStatus(notificationId, type, status);
        });

        $('.cancel-change').on('click', function () {
            hideModal();
        });

        function hideModal() {
            $('#changeStatusModal').modal('hide');
        }

        function updateStatus(notificationId, type, status) {
            $.ajax({
                url: '{{ route("provider.configuration.updateProviderNotification") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    notification_id: notificationId,
                    type: type,
                    status: status
                },
                success: function (response) {
                    toastr.success(response.message ?? '{{ translate('Status updated successfully') }}');
                   // selectedItem.prop('checked', originalChecked);

                    selectedItem.prop('checked', status === 1);

                    if (status === 1) {
                        selectedItem.data('title', 'Disable Notification Channel');
                        selectedItem.data('description', 'Notifications will no longer be sent');
                        selectedItem.data('confirm-btn', 'Disable');
                    } else {
                        selectedItem.data('title', 'Enable Notification Channel');
                        selectedItem.data('description', 'This will start sending notifications');
                        selectedItem.data('confirm-btn', 'Enable');
                    }
                    hideModal();
                },
                error: function (xhr) {
                    toastr.error(xhr.responseJSON?.message ?? '{{ translate('Something went wrong') }}');
                    selectedItem.prop('checked', !originalChecked);
                    hideModal();
                }
            });
        }

    </script>
@endpush
