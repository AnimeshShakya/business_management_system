@extends('providermanagement::layouts.master')

@section('title', translate('Booking_Service_log'))

@section('content')
    <div class="main-content">
        <div class="container-fluid">
            <div class="page-title-wrap mb-3">
                <h2 class="page-title">{{ translate('Booking_Details') }} </h2>
            </div>

            <div class="pb-3 d-flex justify-content-between align-items-center gap-3 flex-wrap">
                <div>
                    <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                        <h3 class="c1 d-flex align-items-center gap-1">
                            {{ translate('Repeat_Booking') }} # {{ $booking['readable_id'] }}
                            <img width="20" height="20"
                                src="{{ asset('public/assets/admin-module/img/icons/repeat.svg') }}"
                                class="rounded-circle repeat-icon" alt="{{ translate('repeat') }}">
                        </h3>
                        <span class="badge badge-{{
                            $booking->booking_status == 'ongoing' ? 'warning' :
                            ($booking->booking_status == 'completed' ? 'success' :
                            ($booking->booking_status == 'canceled' ? 'danger' : 'info'))
                        }}">
                            {{ ucwords($booking->booking_status) }}
                        </span>
                    </div>
                    <p class="opacity-75 fz-12">{{ translate('Booking_Placed') }}
                        : {{ date('d-M-Y h:ia', strtotime($booking->created_at)) }}</p>
                </div>
                <div class="d-flex flex-wrap flex-xxl-nowrap gap-3">
                    <div class="d-flex flex-wrap gap-3">
                        @if (in_array($booking['booking_status'], ['accepted', 'ongoing']) && !is_null($booking->nextService) && !$booking->nextService['is_paid'] && $booking->nextService['payment_method'] == 'cash_after_service')
                        <button class="btn btn--primary" data-bs-toggle="modal"
                                    data-bs-target="#serviceUpdateModal--{{ $booking['id'] }}" data-toggle="tooltip"
                                    title="{{ translate('Add or remove services') }}">
                                <span class="material-symbols-outlined">edit</span>{{ translate('Edit Services') }}
                            </button>
                        @endif
                        <a href="{{ route('provider.booking.full_repeat_invoice', [$booking->id]) }}" class="btn btn-primary"
                            target="_blank">
                            <span class="material-icons">description</span>{{ translate('Invoice') }}
                        </a>
                    </div>
                </div>
            </div>

            <div class="d-flex flex-wrap justify-content-between align-items-center flex-xxl-nowrap gap-3 mb-4">
                <ul class="nav nav--tabs nav--tabs__style2">
                    <li class="nav-item">
                        <a class="nav-link {{ $webPage == 'details' ? 'active' : '' }}"
                           href="{{ url()->current() }}?web_page=details">{{ translate('details') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $webPage == 'service_log' ? 'active' : '' }}"
                           href="{{ url()->current() }}?web_page=service_log">{{ translate('service_log') }}</a>
                    </li>
                </ul>
            </div>

            <div class="row gy-3">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            @if (!empty($booking['nextService'])  && $booking['booking_status'] != 'pending')
                                <h5 class="mb-3">{{ translate('Ongoing') }}</h5>
                                <div class="p-4 mb-3 d-flex flex-column gap-3">
                                <div class="card card-border">
                                    <div class="card-body">
                                        <div class="d-flex flex-wrap justify-content-between align-content-center gap-3">
                                            <div>
                                                <h6 class="fz-13 mb-2">{{ translate('Booking Id') }}
                                                    #{{ $booking->nextService['readable_id'] }}
                                                </h6>
                                                <p class="fz-12">{{ date('d-M-Y h:ia', strtotime($booking->nextService['service_schedule'])) }}</p>
                                            </div>
                                            <div class="d-flex gap-2 justify-content-center">
                                                <a href="{{ route('provider.booking.single_invoice', [$booking->nextService['id']]) }}" type="button" target="_blank"
                                                    class="action-btn btn--light-primary text-primary fw-medium text-capitalize fz-14"
                                                    style="--size: 30px">
                                                    <span class="material-icons">description</span>
                                                </a>
                                                <a href="{{ route('provider.booking.repeat_single_details', [$booking->nextService['id'], 'web_page' => 'details'])}}" type="button"
                                                    class="action-btn btn--light-primary fw-medium text-capitalize fz-14"
                                                    style="--size: 30px">
                                                    <span class="material-icons">visibility</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if(!empty($booking['completeCancel']))
                                <h5 class="mb-3">{{ translate('Completed & Canceled') }}</h5>
                                @foreach($booking['completeCancel'] as $data)
                                    <div class="d-flex align-items-center mb-3 gap-20">
                                        <div>
                                            <span class="fz-14 color-93A2AE">#{{ $loop->iteration }}</span>
                                        </div>
                                        <div class="card card-border w-100">
                                            <div class="card-body">
                                                <div class="d-flex flex-wrap justify-content-between align-content-center gap-3">
                                                    <div>
                                                        <h6 class="fz-13 mb-2">{{ translate('Booking Id') }}
                                                            #{{ $data['readable_id']}}
                                                        </h6>
                                                        <p class="fz-12">{{ date('d-M-Y h:ia', strtotime($data['service_schedule'])) }}</p>
                                                    </div>
                                                    <div class="d-flex gap-2 justify-content-center">
                                                        <a href="{{ route('provider.booking.single_invoice', [$data['id']]) }}" type="button"
                                                           class="action-btn btn--light-primary text-primary fw-medium text-capitalize fz-14" target="_blank"
                                                           style="--size: 30px">
                                                            <span class="material-icons">description</span>
                                                        </a>
                                                        <a href="{{ route('provider.booking.repeat_single_details', [$data['id'], 'web_page' => 'details'])}}" type="button"
                                                           class="action-btn btn--light-primary fw-medium text-capitalize fz-14"
                                                           style="--size: 30px">
                                                            <span class="material-icons">visibility</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                            @if(!empty($booking['upComing']))
                                <h5 class="mb-3">{{ translate('Upcoming') }}</h5>
                                @foreach($booking['upComing'] as $upComing)
                                    <div class="d-flex align-items-center mb-3 gap-20">
                                        <div>
                                            <span class="fz-14 color-93A2AE">#{{ $loop->iteration }}</span>
                                        </div>
                                        <div class="card card-border w-100 shadow-none">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center gap-3">
                                                    <div>
                                                        <h6 class="fz-13 mb-2">{{ translate('Booking Id') }}
                                                            #{{ $upComing['readable_id'] }}
                                                            @if(count($upComing['schedule_histories']) > 1)
                                                            <span class="title-color opacity-75">({{ translate('Rescheduled') }})</span>
                                                            @endif
                                                        </h6>
                                                        <p class="fz-12 mb-1">{{ date('d-M-Y h:ia', strtotime($upComing['service_schedule'])) }}</p>
                                                        @if($upComing['is_reassign'])
                                                            <span class="text-primary fw-semibold">
                                                                (
                                                                <span class="title-color opacity-75">{{ translate('Reassigned to') }}</span>
                                                                {{ $booking->provider->company_name }}
                                                                )
                                                            </span>
                                                        @endif
                                                    </div>
                                                    <div class="dropstart">
                                                        <a href="javascript:" class="title-color" data-bs-toggle="dropdown">
                                                            <span class="material-icons">more_vert</span>
                                                        </a>
                                                        <ul class="dropdown-menu border-none dropdown-menu-left p-2">
                                                            @if($booking['booking_status'] != 'pending')
                                                            <li><a class="dropdown-item d-flex align-items-center gap-1" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reschedule-{{$upComing['id']}}"
                                                                    href="javascript:">
                                                                    <span class="material-icons">
                                                                        pending_actions
                                                                    </span>
                                                                    {{ translate('Reschedule') }}
                                                                </a>
                                                            </li>
                                                            @endif
                                                            <li><a class="dropdown-item d-flex align-items-center gap-1" target="_blank"
                                                                    href="{{ route('provider.booking.single_invoice', [$upComing['id']]) }}">
                                                                    <span class="material-icons">
                                                                        download
                                                                    </span>
                                                                    {{ translate('download_invoice') }}
                                                                </a>
                                                            </li>
                                                            @if($booking['booking_status'] != 'pending')
                                                            <li><button type="button"
                                                                   data-id="cancel-{{$upComing['id']}}"
                                                                   data-message="{{translate('want_to_cancel_this_booking')}}?"
                                                                   class="dropdown-item d-flex align-items-center gap-1 {{ env('APP_ENV') != 'demo' ? 'form-alert' : 'demo_check' }}">
                                                                    <span class="material-icons">
                                                                        cancel
                                                                    </span>
                                                                    {{ translate('cancel') }}
                                                                </button>
                                                                <form
                                                                    action="{{route('provider.booking.up_coming_booking_cancel',[$upComing['id']])}}"
                                                                    method="post" id="cancel-{{$upComing['id']}}"
                                                                    class="hidden">
                                                                    @csrf
                                                                    @method('GET')
                                                                    <input type="hidden" name="booking_status" value="canceled">
                                                                </form>
                                                            </li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="reschedule-{{$upComing['id']}}" tabindex="-1" aria-labelledby="" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="">{{translate('Repeat Booking reschedule')}}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                    <form action="{{ route('provider.booking.up_coming_booking_schedule_update', [$upComing['id']]) }}" method="post">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <input type="datetime-local" class="form-control h-45" name="service_schedule" value="{{$upComing['service_schedule']}}">
                                                            <div class="pt-3 text-end">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{translate('Close')}}</button>
                                                                <button type="submit" class="btn btn--primary">{{translate('Save changes')}}</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="c1">{{ translate('Booking Setup') }}</h3>
                            <hr>
                            <div class="mt-3">
                                @if ($booking->booking_status != 'pending')
                                    <div class="mt-3">
                                        <select class="js-select without-search" id="booking_status">
                                            @if ($booking->booking_status == 'accepted')
                                                <option value="0" disabled
                                                    {{ $booking['booking_status'] == 'accepted' ? 'selected' : '' }}>
                                                    {{ translate('Booking_Status') }}: {{ translate('Accepted') }}</option>
                                            @elseif($booking->booking_status == 'ongoing')
                                                <option value="0" disabled
                                                    {{ $booking['booking_status'] == 'ongoing' ? 'selected' : '' }}>
                                                    {{ translate('Booking_Status') }}: {{ translate('Ongoing') }}</option>
                                            @elseif($booking->booking_status == 'canceled')
                                                <option value="0" disabled
                                                    {{ $booking['booking_status'] == 'canceled' ? 'selected' : '' }}>
                                                    {{ translate('Booking_Status') }}: {{ translate('Canceled') }}</option>
                                            @endif
                                            @if ($booking->booking_status != 'completed'
                                                && isset($booking->nextService)
                                                && !$booking->nextService['is_paid']
                                                && $booking->nextService['payment_method'] == 'cash_after_service')
                                                <option value="canceled"
                                                    {{ $booking->booking_status == 'canceled' ? 'selected' : '' }}>
                                                    {{ translate('Booking_Status') }}: {{ translate('Canceled') }}
                                                </option>
                                            @elseif($booking->booking_status == 'completed')
                                                <option value="completed"
                                                    {{ $booking->booking_status == 'completed' ? 'selected' : '' }}>
                                                    {{ translate('Booking_Status') }}: {{ translate('completed') }}
                                                </option>
                                            @endif
                                        </select>
                                    </div>
                                @else
                                    <div class="c1-light-bg radius-10">
                                        <div class="p-4 d-flex justify-content-center">
                                            <button type="button" class="btn btn-soft--danger g-2 px-5 mx-3 {{ env('APP_ENV') != 'demo' ? 'form-alert' : 'demo_check' }}"
                                                    title="{{ translate('Ignore') }}"
                                                    data-id="cancel-{{$booking['id']}}"
                                                    data-message="{{translate('Once you ignore the request, it will be no longer on your booking request list.')}}?"
                                                    data-title="{{translate('Are you sure to ignore the booking request?')}}">
                                                {{ translate('Ignore') }}
                                            </button>

                                            <button  type="button" class="btn btn--light-primary g-2 px-5 {{ env('APP_ENV') != 'demo' ? 'form-alert' : 'demo_check' }}"
                                                     title="{{ translate('Accept') }}"
                                                     data-id="accept-{{$booking['id']}}"
                                                     data-message=""
                                                     data-title="{{translate('Are you sure to accept the booking request?')}}">
                                                {{ translate('Accept') }}
                                            </button>
                                        </div>
                                    </div>
                                    <form
                                            action="{{route('provider.booking.ignore',[$booking['id']])}}"
                                            method="post" id="cancel-{{$booking['id']}}"
                                            class="hidden">
                                        @csrf
                                        @method('GET')
                                    </form>

                                    <form
                                            action="{{route('provider.booking.accept',[$booking['id']])}}"
                                            method="post" id="accept-{{$booking['id']}}"
                                            class="hidden">
                                        @csrf
                                        @method('GET')
                                        <input type="hidden" name="booking_status" value="accepted">
                                    </form>
                                @endif
                            </div>

                            <div class="py-3 d-flex flex-column gap-3 mb-2">
                                <div class="c1-light-bg radius-10">
                                    <div
                                            class="border-bottom d-flex align-items-center justify-content-between gap-2 py-3 px-4 mb-2">
                                        <h4 class="d-flex align-items-center gap-2">
                                            <span class="material-icons title-color">person</span>
                                            {{ translate('Customer_Information') }}
                                        </h4>
                                    </div>

                                    <div class="py-3 px-4">
                                        @php($customer_name = $booking?->service_address?->contact_person_name)
                                        @php($customer_phone = $booking?->service_address?->contact_person_number)

                                        <div class="media gap-2 flex-wrap">
                                            @if (!$booking?->is_guest && $booking?->customer)
                                                <img width="58" height="58"
                                                     class="rounded-circle border border-white aspect-square object-fit-cover"
                                                     src="{{ $booking?->customer?->profile_image_full_path }}"
                                                     alt="{{ translate('user_image') }}">
                                            @else
                                                <img width="58" height="58"
                                                     class="rounded-circle border border-white aspect-square object-fit-cover"
                                                     src="{{ asset('public/assets/provider-module/img/user2x.png') }}"
                                                     alt="{{ translate('user_image') }}">
                                            @endif

                                            <div class="media-body">
                                                <h5 class="c1 mb-3">
                                                    <span>{{ Str::limit($customer_name ?? '', 30) }}</span>
                                                </h5>
                                                <ul class="list-info">
                                                    @if ($customer_phone)
                                                        <li>
                                                            <span class="material-icons">phone_iphone</span>
                                                            <a
                                                                    href="tel:{{ $customer_phone }}">{{ $customer_phone }}</a>
                                                        </li>
                                                    @endif
                                                    <li>
                                                        <span class="material-icons">map</span>
                                                        <p>{{ Str::limit($booking?->service_address?->address ?? translate('not_available'), 100) }}
                                                        </p>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(!is_null($booking->nextService))
        <div class="modal fade" id="serviceUpdateModal--{{ $booking['id'] }}" tabindex="-1"
             aria-labelledby="serviceUpdateModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header px-4 pt-4 border-0 pb-1">
                        <h3 class="text-capitalize">{{ translate('update_booking_list') }}</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-4">
                        <div class="d-flex align-items-end justify-content-between gap-3 flex-wrap mb-4">
                            <div>
                                <h5 class="mb-2">
                                    {{ translate('Booking') }} # {{ $booking['readable_id'] }}
                                </h5>
                                <h3 class="c1 fw-bold mb-2">{{ translate('Sub-Booking') }} # {{ $booking->nextService['readable_id']}}
                                </h3>
                            </div>
                            <h5 class="d-flex gap-1 flex-wrap align-items-center justify-content-end fw-normal mb-2">
                                <div>{{ translate('Schedule_Date') }} :</div>
                                <div id="service_schedule__span">
                                    <div class="fw-semibold">{{ date('d-M-Y h:ia', strtotime($booking->created_at)) }}</div>
                                </div>
                            </h5>
                        </div>

                        <div class="bg-F8F8F8 p-3 mb-3">
                            <h4 class="mb-3"> {{ translate('Service') }} : {{ translate('AC_Repairing') }}
                            </h4>
                            <div class="d-flex flex-wrap gap-3">
                                <h4> {{ translate('Category') }} : {{ $booking->category->name }}</h4>
                                <h4> {{ translate('SubCategory') }} : {{ $booking->subCategory->name }}</h4>
                            </div>
                        </div>

                        <div class="mb-30">
                            <span class="c1 fw-semibold"> # {{ translate('Note') }}:</span>
                            <span class="title-color">
                            {{ translate('Please provide extra layer in the packaging') }}</span>
                        </div>

                        <form action="{{ route('provider.booking.service.update_repeat_booking_service') }}" method="POST"
                              id="booking-edit-table" class="mb-30">
                            <div class="table-responsive">
                                <table class="table text-nowrap align-middle mb-0" id="service-edit-table">
                                    @csrf
                                    @method('put')
                                    <thead>
                                    <tr>
                                        <th class="ps-lg-3 fw-bold">{{ translate('Service') }}</th>
                                        <th class="fw-bold text--end">{{ translate('Price') }}</th>
                                        <th class="fw-bold text-center">{{ translate('Qty') }}</th>
                                        <th class="fw-bold text--end">{{ translate('Discount') }}</th>
                                        <th class="fw-bold text--end">{{ translate('Total') }}</th>
                                    </tr>
                                    </thead>

                                    <tbody id="service-edit-tbody">
                                    @php($sub_total = 0)
                                    @foreach ($booking->nextService['detail'] as $key => $detail)
                                        <tr id="service-row--{{ $detail['variant_key'] }}">
                                            <td class="text-wrap ps-lg-3">
                                                @if (isset($detail['service']))
                                                    <div class="d-flex flex-column">
                                                        <a class="fw-bold">{{ Str::limit($detail['service']['name'], 30) }}</a>
                                                        <div>{{ Str::limit($detail ? $detail['variant_key'] : '', 50) }}
                                                        </div>
                                                    </div>
                                                @else
                                                    <span
                                                        class="badge badge-pill badge-danger">{{ translate('Service_unavailable') }}</span>
                                                @endif
                                            </td>
                                            <td class="text--end" id="service-cost-{{ $detail['variant_key'] }}">
                                                {{ currency_symbol() . ' ' . $detail['service_cost'] }}</td>
                                            <td>
                                                <input type="number" min="1" name="qty[]"
                                                       class="form-control qty-width dark-color-bo m-auto min-w-100px"
                                                       id="qty-{{ $detail['variant_key'] }}"
                                                       value="{{ $detail['quantity'] }}"
                                                       oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                            </td>
                                            <td class="text--end" id="discount-amount-{{ $detail['variant_key'] }}">
                                                {{ currency_symbol() . ' ' . $detail['discount_amount'] }}</td>
                                            <td class="text--end" id="total-cost-{{ $detail['variant_key'] }}">
                                                {{ currency_symbol() . ' ' . $detail['total_cost'] }}
                                            </td>
                                            <input type="hidden" name="service_ids[]"
                                                   value="{{ $detail['service']['id'] }}">
                                            <input type="hidden" name="variant_keys[]"
                                                   value="{{ $detail['variant_key'] }}">
                                        </tr>
                                        @php($sub_total += $detail['service_cost'] * $detail['quantity'])
                                    @endforeach
                                    <input type="hidden" name="zone_id" value="{{ $booking->zone_id }}">
                                    <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                                    <input type="hidden" name="booking_repeat_id" value="{{ $booking?->nextService['id'] }}">
                                    </tbody>
                                </table>
                            </div>

                            <div class="bg-F8F8F8 p-3 mb-30">
                                <div class="form-check d-flex align-items-center gap-1">
                                    <input class="form-check-input check-28" type="checkbox" name="next_all_booking_change" value="1">
                                    <label class="form-check-label lh-lg" for="">
                                        {{ translate('Check the box') }}
                                        <br>
                                        {{ translate(' If want to Update it for all upcoming bookings') }}

                                    </label>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer d-flex justify-content-end gap-3 border-0 pt-0 pb-4">
                        <button type="button" class="btn btn--secondary" data-bs-dismiss="modal"
                                aria-label="Close">{{ translate('Cancel') }}</button>
                        <button type="submit" class="btn btn--primary"
                                form="booking-edit-table">{{ translate('update_cart') }}</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@push('script')
    <script>
        "use strict";

        $('.switcher_input').on('click', function() {
            let paymentStatus = $(this).is(':checked') === true ? 1 : 0;
            payment_status_change(paymentStatus)
        })

        $('.reassign-provider').on('click', function() {
            let id = $(this).data('provider-reassign');
            updateProvider(id)
        })


        @if ($booking->booking_status == 'pending')
        $(document).ready(function() {
            selectElementVisibility('serviceman_assign', false);
            selectElementVisibility('payment_status', false);
        });
        @endif

        $("#booking_status").change(function() {
            var booking_status = $("#booking_status option:selected").val();
            if (parseInt(booking_status) !== 0) {
                var route = '{{ route('provider.booking.status_update', [$booking->id]) }}' + '?booking_status=' +
                    booking_status;
                if(booking_status === 'canceled'){
                    update_booking_details(route, '{{ translate('Please contact the customer before proceeding with the cancellation process.') }}', 'booking_status',
                        booking_status, '{{ translate('Are you sure you want to cancel the entire booking?') }}');
                }else{
                    update_booking_details(route, '{{ translate('want_to_update_status') }}', 'booking_status',
                        booking_status);
                }
            } else {
                toastr.error('{{ translate('choose_proper_status') }}');
            }
        });

        $("#serviceman_assign").change(function() {
            var serviceman_id = $("#serviceman_assign option:selected").val();
            if (serviceman_id !== 'no_serviceman') {
                var route = '{{ route('provider.booking.serviceman_update', [$booking->id]) }}' + '?serviceman_id=' +
                    serviceman_id;

                update_booking_details(route, '{{ translate('want_to_assign_the_serviceman') }}?',
                    'serviceman_assign', serviceman_id);
            } else {
                toastr.error('{{ translate('choose_proper_serviceman') }}');
            }
        });

        function payment_status_change(payment_status) {
            var route = '{{ route('provider.booking.payment_update', [$booking->id]) }}' + '?payment_status=' +
                payment_status;
            update_booking_details(route, '{{ translate('want_to_update_status') }}', 'payment_status', payment_status);
        }

        function service_schedule_update() {
            var service_schedule = $("#service_schedule").val();
            var route = '{{ route('provider.booking.schedule_update', [$booking->id]) }}' + '?service_schedule=' +
                service_schedule;

            update_booking_details(route, '{{ translate('want_to_update_the_booking_schedule') }}', 'service_schedule',
                service_schedule);
        }

        function update_booking_details(route, message, componentId, updatedValue, title = "{{ translate('are_you_sure') }}?") {
            Swal.fire({
                title: title,
                text: message,
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: 'var(--bs-secondary)',
                confirmButtonColor: 'var(--bs-primary)',
                cancelButtonText: '{{ translate('Cancel') }}',
                confirmButtonText: '{{ translate('Yes') }}',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $.get({
                        url: route,
                        dataType: 'json',
                        data: {},
                        beforeSend: function() {
                            toastr.info('{{ translate('Processing request...') }}');
                        },
                        success: function(data) {
                            update_component(componentId, updatedValue);
                            toastr.success(data.message, {
                                CloseButton: true,
                                ProgressBar: true
                            });

                            if (componentId === 'booking_status' || componentId === 'payment_status' ||
                                componentId === 'service_schedule' || componentId ===
                                'serviceman_assign') {
                                location.reload();
                            }
                            location.reload();
                        },
                        complete: function() {},
                    });
                }
            })
        }

        function update_component(componentId, updatedValue) {

            if (componentId === 'booking_status') {
                $("#booking_status__span").html(updatedValue);

                selectElementVisibility('serviceman_assign', true);
                selectElementVisibility('payment_status', true);

            } else if (componentId === 'payment_status') {
                $("#payment_status__span").html(updatedValue);
                if (updatedValue === 'paid') {
                    $("#payment_status__span").addClass('text-success').removeClass('text-danger');
                } else if (updatedValue === 'unpaid') {
                    $("#payment_status__span").addClass('text-danger').removeClass('text-success');
                }

            }
        }

        function selectElementVisibility(componentId, visibility) {
            if (visibility === true) {
                $('#' + componentId).next(".select2-container").show();
            } else if (visibility === false) {
                $('#' + componentId).next(".select2-container").hide();
            } else {}
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#category_selector__select').select2({
                dropdownParent: "#serviceUpdateModal--{{ $booking['id'] }}"
            });
            $('#sub_category_selector__select').select2({
                dropdownParent: "#serviceUpdateModal--{{ $booking['id'] }}"
            });
            $('#service_selector__select').select2({
                dropdownParent: "#serviceUpdateModal--{{ $booking['id'] }}"
            });
            $('#service_variation_selector__select').select2({
                dropdownParent: "#serviceUpdateModal--{{ $booking['id'] }}"
            });
        });

        $("#serviceUpdateModal--{{ $booking['id'] }}").on('hidden.bs.modal', function() {
            $('#service_selector__select').prop('selectedIndex', 0);
            $("#service_variation_selector__select").html(
                '<option value="" selected disabled>{{ translate('Select Service Variant') }}</option>');
            $("#service_quantity").val('');
        });
    </script>

    <script>

        $(document).ready(function() {
            $('.your-button-selector').on('click', function() {
                updateSearchResults();
            });

            $('.cancellation-note').hide();

            $('.deny-request').click(function() {
                $('.cancellation-note').show();
            });

            $('.approve-request').click(function() {
                $('.cancellation-note').hide();
            });
        });

        $('.customer-chat').on('click', function() {
            $(this).find('form').submit();
        });

        $('.provider-chat').on('click', function() {
            $(this).find('form').submit();
        });

        document.addEventListener('DOMContentLoaded', function() {
            const denyRequestRadio = document.querySelector('.deny-request');
            const cancellationNote = document.querySelector('.cancellation-note');

            denyRequestRadio.addEventListener('change', function() {
                if (this.checked) {
                    cancellationNote.style.display = 'block';
                    document.querySelector('textarea[name="booking_deny_note"]').required = true;
                } else {
                    cancellationNote.style.display = 'none';
                    document.querySelector('textarea[name="booking_deny_note"]').required = false;
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.without-search').select2({
                minimumResultsForSearch: Infinity
            });
        });
    </script>
@endpush
