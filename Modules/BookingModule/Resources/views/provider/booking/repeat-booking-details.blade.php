@extends('providermanagement::layouts.master')

@section('title', translate('Booking_Details'))

@push('css_or_js')
    <link rel="stylesheet" href="{{ asset('public/assets/admin-module/plugins/swiper/swiper-bundle.min.css') }}">

    <style>
        .btn:disabled {
            background-color: var(--bs-primary) !important;
            color: #fff !important;
        }

        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield;
        }
    </style>
@endpush

@section('content')
    <div class="main-content">
        <div class="container-fluid">
            <div class="page-title-wrap mb-3">
                <h2 class="page-title">{{ translate('Booking_Details') }} </h2>
            </div>

            <div class="pb-3 d-flex justify-content-between align-items-center gap-3 flex-wrap">
                <div>
                    <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                        <h3 class="c1 d-flex align-items-center gap-1 fw-bold">
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
                @php($max_booking_amount = business_config('max_booking_amount', 'booking_setup')->live_values ?? 0)

                @if (
                    $booking->is_verified == 2 &&
                        $booking->payment_method == 'cash_after_service' &&
                        $max_booking_amount <= $booking->total_booking_amount)
                    <div class="border border-danger-light bg-soft-danger rounded py-3 px-3 text-dark">
                        <span class="text-danger"># {{ translate('Note: ') }}</span>
                        <span>{{ $booking?->bookingDeniedNote?->value }}</span>
                    </div>
                @endif

                @if ($booking->is_paid == 0 && $booking->payment_method == 'offline_payment')
                    <div class="border border-danger-light bg-soft-danger rounded py-3 px-3 text-dark">
                        <span>
                            <span class="text-danger fw-semibold"> # {{ translate('Note: ') }} </span>
                            {{ translate('Please Check & Verify the payment information weather it is correct or not before confirm the booking. ') }}
                        </span>
                    </div>
                @endif

            </div>

            <div class="row gy-3">
                <div class="col-lg-8">
                    @if(!is_null($booking->nextService))
                    <div class="card mb-3">
                        <div class="card-header shadow-none border-bottom">
                            <div
                                class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center gap-3 flex-wrap">
                                <div class="d-flex align-items-center gap-2">
                                    <h3>
                                        {{ translate('Next Upcoming') }} # {{ $booking->nextService['readable_id'] }}
                                    </h3>
                                    <span class="badge badge-{{
                                        $booking->nextService['booking_status'] == 'ongoing' ? 'warning' :
                                        ($booking->nextService['booking_status'] == 'completed' ? 'success' :
                                        ($booking->nextService['booking_status'] == 'canceled' ? 'danger' : 'info'))
                                    }}">
                                        {{ ucwords($booking->nextService['booking_status']) }}
                                    </span>
                                </div>

                                <a href="{{ route('provider.booking.repeat_single_details', [$booking->nextService['id'], 'web_page' => 'details'])}}" class="btn btn--secondary-two text-capitalize fw-semibold fz-14">
                                    {{ translate('view_details') }}
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <button type="button"
                                        class="btn btn--light border-dashed text-capitalize title-color d-flex flex-wrap gap-1">
                                        {{ translate('Scheduled At') }}:
                                        <span class="opacity-75">{{ date('d-M-Y h:ia', strtotime($booking->nextService['service_schedule'])) }}</span>
                                    </button>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex gap-30 justify-content-md-around mt-3 mt-md-0">
                                        <div>
                                            <p class="mb-2">
                                                <span>{{ translate('Booking_Amount') }}</span>
                                            </p>
                                            <h5 class="fz-14">{{ with_currency_symbol($booking->nextService['total_booking_amount']) }}
                                            </h5>
                                        </div>
                                        <div class="border--start ps-30">
                                            <p class="mb-2">
                                                <span>{{ translate('Payment_Status') }}</span>
                                            </p>
                                            <h5 class="fz-14">
                                                <span class="text-{{ $booking->nextService['is_paid'] ? 'success' : 'danger' }}"
                                                    id="payment_status__span">{{ $booking->nextService['is_paid'] ? translate('Paid') : translate('Unpaid') }}</span>
                                            </h5>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex gap-5">

                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="card mb-3">
                        <div class="card-header shadow-none border-bottom">
                            <div class="d-flex justify-content-between flex-wrap gap-3">
                                <h3>{{ translate('All_Booking_Summary') }}</h3>
                                <a href="{{ url()->current() }}?web_page=service_log" class="btn-link text-primary fw-semibold">{{translate('View All Booking')}}</a>
                            </div>
                        </div>
                        <div class="card-body pb-5">
                            <div
                                class="border-bottom d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center gap-3 flex-wrap mb-3 pb-3">
                                <div>
                                    <p>
                                        <span>{{ translate('Total_Booking') }} : </span>
                                        <span class="fw-semibold">{{ $booking->totalCount }}</span>
                                    </p>
                                    <p>
                                        <span>{{ translate('Booking_Type') }} : </span>
                                        <span class="fw-semibold">
                                            {{ ucwords($booking->bookingType) }}
                                        </span>
                                    </p>
                                    <p>
                                        <span>{{ translate('Booking_Date_Range') }} : </span>
                                        <span class="fw-semibold">
                                            {{ $booking->startDate }} - {{ $booking->endDate }}
                                        </span>
                                    </p>
                                    @if($booking->bookingType == 'weekly')
                                        <p>
                                            <span>{{ translate('Weekly Selected Days') }} : </span>
                                            <span class="fw-semibold">
                                                {{ implode(', ', $booking->weekNames) }}
                                            </span>
                                        </p>
                                    @endif
                                    <p>
                                        <span>{{ translate('Arrival') }} : </span>
                                        <span class="fw-semibold">
                                            {{ $booking->time }}
                                        </span>
                                    </p>
                                </div>
                                <div>
                                    <p>
                                        <span>{{ translate('Completed') }} : </span>
                                        <span class="fw-semibold">
                                            {{ $booking->completedCount }}
                                        </span>
                                    </p>
                                    <p>
                                        <span>{{ translate('Canceled') }} : </span>
                                        <span class="fw-semibold">
                                            {{ $booking->canceledCount }}
                                        </span>
                                    </p>
                                    <p>
                                        <span>{{ translate('Payment') }} : </span>
                                        <span class="fw-semibold">
                                            {{ ucwords(str_replace('_', ' ', $booking->payment_method)) }}
                                        </span>
                                    </p>
                                    <p>
                                        <span>{{ translate('Total_Amount') }} : </span>
                                        <span class="fw-semibold">
                                            {{ with_currency_symbol($booking->total_booking_amount) }}
                                        </span>
                                    </p>
                                </div>

                            </div>

                            <div class="d-flex justify-content-start gap-2">
                                <h3 class="mb-3">{{ translate('Billing_Summary') }}</h3>
                            </div>

                            <div class="table-responsive border-bottom">
                                <table class="table text-nowrap align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th class="ps-lg-3">{{ translate('Service') }}</th>
                                            <th>{{ translate('Price') }}</th>
                                            <th>{{ translate('Order_Qty') }}</th>
                                            <th>{{ translate('Discount') }}</th>
                                            <th class="text--end">{{ translate('Total') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php($subTotal = 0)
                                        @foreach ($booking->detail as $detail)
                                            <tr>
                                                <td class="text-wrap ps-lg-3">
                                                    @if (isset($detail->service))
                                                        <div class="d-flex flex-column">
                                                            <a class="fw-bold">{{ Str::limit($detail->service->name, 30) }}</a>
                                                            <div class="text-capitalize">
                                                                {{ Str::limit($detail ? $detail->variant_key : '', 50) }}
                                                            </div>
                                                            @if ($detail->overall_coupon_discount_amount > 0)
                                                                <small
                                                                    class="fz-10 text-capitalize">{{ translate('coupon_discount') }}
                                                                    :
                                                                    -{{ with_currency_symbol($detail->overall_coupon_discount_amount) }}</small>
                                                            @endif
                                                        </div>
                                                    @else
                                                        <span
                                                            class="badge badge-pill badge-danger">{{ translate('Service_unavailable') }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ with_currency_symbol($detail->service_cost) }}</td>
                                                <td>
                                                    <span class="margin-left-20">{{ $detail->quantity }}</span>
                                                    @if ($booking['repeatHistory'])
                                                        <p class="text-primary fs-12 fw-semibold" data-bs-toggle="modal"
                                                            data-bs-target="#tableModal">{{ translate('Updated') }}</p>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($detail?->discount_amount > 0)
                                                        {{ with_currency_symbol($detail->discount_amount) }}
                                                    @elseif($detail?->campaign_discount_amount > 0)
                                                        {{ with_currency_symbol($detail->campaign_discount_amount) }}
                                                    @endif
                                                </td>
                                                <td class="text--end">{{ with_currency_symbol($detail->total_cost) }}
                                                </td>
                                            </tr>
                                            @php($subTotal += $detail->service_cost * $detail->quantity)
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="row justify-content-end mt-3">
                                <div class="col-sm-10 col-md-6 col-xl-5">
                                    <div class="table-responsive">
                                        <table class="table-md title-color align-right w-100">
                                            <tbody>
                                                <tr>
                                                    <td class="text-capitalize">{{ translate('Initial Sub Total') }} x
                                                        {{ count($booking->repeat) }} {{ translate('days') }}</td>
                                                    <td class="text--end pe--4">
                                                        {{ with_currency_symbol($subTotal * $booking->totalCount) }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-capitalize">{{ translate('Updated Sub Total') }}
                                                        @if ($booking['repeatHistory'])
                                                            <span class="text-primary fs-12 fw-semibold"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#tableModal">({{ translate('view_History') }})</span>
                                                        @endif
                                                    </td>
                                                    <td class="text--end pe--4">
                                                        {{ with_currency_symbol($booking->total_booking_amount + ($booking->total_discount_amount + $booking->total_coupon_discount_amount + $booking->total_campaign_discount_amount + $booking->total_referral_discount_amount) - ($booking->total_tax_amount + $booking->extra_fee)) }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-capitalize">{{ translate('Discount') }}</td>
                                                    <td class="text--end pe--4">
                                                        {{ with_currency_symbol($booking->total_discount_amount) }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-capitalize">{{ translate('coupon_discount') }}</td>
                                                    <td class="text--end pe--4">
                                                        {{ with_currency_symbol($booking->total_coupon_discount_amount) }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-capitalize">{{ translate('campaign_discount') }}</td>
                                                    <td class="text--end pe--4">
                                                        {{ with_currency_symbol($booking->total_campaign_discount_amount) }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-capitalize">{{ translate('Referral Discount') }}</td>
                                                    <td class="text--end pe--4">
                                                        {{ with_currency_symbol($booking->total_referral_discount_amount) }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-capitalize">{{ translate('vat_/_tax') }}</td>
                                                    <td class="text--end pe--4">
                                                        {{ with_currency_symbol($booking->total_tax_amount) }}</td>
                                                </tr>
                                                @if ($booking->extra_fee > 0)
                                                    @php($additional_charge_label_name = business_config('additional_charge_label_name', 'booking_setup')->live_values ?? 'Fee')
                                                    <tr>
                                                        <td class="text-capitalize">{{ $additional_charge_label_name }}
                                                        </td>
                                                        <td class="text--end pe--4">
                                                            {{ with_currency_symbol($booking->extra_fee) }}</td>
                                                    </tr>
                                                @endif

                                                <tr>
                                                    <td><strong>{{ translate('Grand_Total') }}</strong></td>
                                                    <td class="text--end pe--4">
                                                        <strong>{{ with_currency_symbol($booking->total_booking_amount) }}</strong>
                                                    </td>
                                                </tr>
                                                <?php
                                                    $repeats = collect($booking->repeats); // Convert repeats to a collection
                                                    $paidAmount = $repeats->where('booking_status', 'completed')->sum('total_booking_amount');
                                                    $canceledAmount = $repeats->where('booking_status', 'canceled')->sum('total_booking_amount');
                                                    $paid = $repeats->where('booking_status', 'completed')->count();
                                                ?>
                                                <tr>
                                                    <td>
                                                        {{ translate('Paid') }}
                                                        <small
                                                            class="fz-12">({{ translate('for ' . $paid . ' Bookings') }})</small>
                                                    </td>
                                                    <td class="text--end pe--4">
                                                        {{ with_currency_symbol($paidAmount) }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>{{ translate('Canceled_Amount') }}</td>
                                                    <td class="text--end pe--4">
                                                        {{ with_currency_symbol($canceledAmount) }}</td>
                                                </tr>

                                                <?php
                                                    $dueAmount = $booking->total_booking_amount - ($paidAmount + $canceledAmount);
                                                ?>

                                                @if ($dueAmount > 0 && $booking['booking_status'] != 'canceled')
                                                    <tr>
                                                        <td>{{ translate('Due_Amount') }}</td>
                                                        <td class="text--end pe--4">
                                                            {{ with_currency_symbol($dueAmount) }}</td>
                                                    </tr>
                                                @endif

                                                @if ($booking->payment_method != 'cash_after_service' && $booking->additional_charge < 0)
                                                    <tr>
                                                        <td>{{ translate('Refund') }}</td>
                                                        <td class="text--end pe--4">
                                                            {{ with_currency_symbol(abs($booking->additional_charge)) }}
                                                        </td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="c1">{{ translate('Booking Setup') }}</h3>
                            <hr>
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
                                            @if ($booking->booking_status != 'completed' && $booking->booking_status != 'accepted' &&
                                                        isset($booking->nextService) &&
                                                        !$booking->nextService['is_paid'] &&
                                                        $booking->nextService['payment_method'] == 'cash_after_service')
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
                                    <div class="p-4 d-flex justify-content-center gap-3">
                                        <button type="button"
                                            class="btn btn-soft--danger g-2 max-w120 flex-grow-1 {{ env('APP_ENV') != 'demo' ? 'form-alert' : 'demo_check' }}"
                                            title="{{ translate('Ignore') }}" data-id="cancel-{{ $booking['id'] }}"
                                            data-message="{{ translate('Once you ignore the request, it will be no longer on your booking request list.') }}?"
                                            data-title="{{ translate('Are you sure to ignore the booking request?') }}">
                                            {{ translate('Ignore') }}
                                        </button>

                                        <button type="button"
                                            class="btn btn--light-primary g-2 max-w120 flex-grow-1 {{ env('APP_ENV') != 'demo' ? 'form-alert' : 'demo_check' }}"
                                            title="{{ translate('Accept') }}" data-id="accept-{{ $booking['id'] }}"
                                            data-message=""
                                            data-title="{{ translate('Are you sure to accept the booking request?') }}">
                                            {{ translate('Accept') }}
                                        </button>
                                    </div>
                                </div>
                                <form action="{{ route('provider.booking.ignore', [$booking['id']]) }}" method="post"
                                    id="cancel-{{ $booking['id'] }}" class="hidden">
                                    @csrf
                                    @method('GET')
                                </form>

                                <form action="{{ route('provider.booking.accept', [$booking['id']]) }}" method="post"
                                    id="accept-{{ $booking['id'] }}" class="hidden">
                                    @csrf
                                    @method('GET')
                                    <input type="hidden" name="booking_status" value="accepted">
                                </form>
                            @endif

                            <div class="py-3 d-flex flex-column gap-3 mb-2">

                                @php($serviceAtProviderPlace = (int)((business_config('service_at_provider_place', 'provider_config'))->live_values ?? 0))
                                <div class="c1-light-bg radius-10">
                                    <div class="border-bottom d-flex align-items-center justify-content-between gap-2 py-3 px-4 mb-2">
                                        <h4 class="d-flex align-items-center gap-2">
                                            <span class="material-icons title-color">map</span>
                                            {{ translate('Service_location') }}
                                        </h4>
                                        @if($serviceAtProviderPlace == 1 && $booking->booking_status != 'pending' && $booking->booking_status != 'completed'  && $booking->booking_status != 'canceled')
                                            @php($serviceLocation = getProviderSettings(providerId: auth()->user()->provider->id, key: 'service_location', type: 'provider_config'))
                                            @if(in_array('customer', $serviceLocation) && in_array('provider', $serviceLocation))
                                                <div class="btn-group">
                                                    <div data-bs-toggle="modal"
                                                         data-bs-target="#serviceLocationModal--{{ $booking['id'] }}"
                                                         data-toggle="tooltip" data-placement="top">
                                                        <div class="d-flex align-items-center gap-2">
                                                            <span class="material-symbols-outlined">edit_square</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endif
                                    </div>

                                    <div class="py-3 px-4">
                                        @if($booking->service_location == 'provider')
                                            <div class="bg-warning p-3 rounded">
                                                <h5>{{ translate('The Customer will come to the your Location to receive the service') }}</h5>
                                            </div>
                                            <div class="mt-3">
                                                @if($booking->provider_id != null)
                                                    @if($booking->provider)
                                                        <h5 class="mb-1">{{ translate('Service Location') }}:</h5>
                                                        <div class="d-flex justify-content-between">
                                                            <p>{{ Str::limit($booking?->provider?->company_address ?? translate('not_available'), 100) }}</p>
                                                            <span class="material-icons">map</span>
                                                        </div>
                                                    @else
                                                        <p>{{ translate('Provider Unavailable') }}</p>
                                                    @endif
                                                @else
                                                    <h5 class="mb-1">{{ translate('Service Location') }}:</h5>
                                                    <p>{{ translate('The Service Location will be available after this booking accepts or assign to a provider') }}</p>
                                                @endif
                                            </div>
                                        @else
                                            <div class="bg-warning p-3 rounded">
                                                <h5>{{ translate('You need to go to the Customer Location to provide the service') }}</h5>
                                            </div>
                                            <div class="mt-3">
                                                <h5 class="mb-1">{{ translate('Service Location') }}:</h5>
                                                <div class="d-flex justify-content-between">
                                                    <p>{{ Str::limit($booking?->service_address?->address ?? translate('not_available'), 100) }}</p>
                                                    <span class="material-icons">map</span>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>


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

                                                        @if(!empty($booking?->service_address?->address))
                                                            <li>
                                                                <span class="material-icons">map</span>
                                                                <p>{{Str::limit($booking?->service_address?->address??translate('not_available'), 100)}}</p>
                                                            </li>
                                                        @endif
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

    @if (!is_null($booking->nextService))
        <div class="modal fade" id="serviceUpdateModal--{{ $booking['id'] }}" tabindex="-1"
            aria-labelledby="serviceUpdateModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header px-4 pt-4 border-0 pb-1">
                        <h3 class="text-capitalize">{{ translate('update_booking') }}</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-4">
                        <div class="d-flex align-items-end justify-content-between gap-3 flex-wrap mb-4">
                            <div>
                                <h5 class="mb-2">
                                    {{ translate('Booking') }} # {{ $booking['readable_id'] }}
                                </h5>
                                <h3 class="c1 fw-bold mb-2">{{ translate('Sub-Booking') }} #
                                    {{ $booking->nextService['readable_id'] }}
                                </h3>
                            </div>
                            <h5 class="d-flex gap-1 flex-wrap align-items-center justify-content-end fw-normal mb-2">
                                <div>{{ translate('Schedule_Date') }} :</div>
                                <div id="service_schedule__span">
                                    <div class="fw-semibold">{{ date('d-M-Y h:ia', strtotime($booking->created_at)) }}
                                    </div>
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

                        {{--                    <div class="mb-30"> --}}
                        {{--                        <span class="c1 fw-semibold"> # {{ translate('Note') }}:</span> --}}
                        {{--                        <span class="title-color"> --}}
                        {{--                            {{ translate('Please provide extra layer in the packaging') }}</span> --}}
                        {{--                    </div> --}}

                        <form action="{{ route('provider.booking.service.update_repeat_booking_service') }}"
                            method="POST" id="booking-edit-table" class="mb-30">
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
                                                            <a
                                                                class="fw-bold">{{ Str::limit($detail['service']['name'], 30) }}</a>
                                                            <div>
                                                                {{ Str::limit($detail ? $detail['variant_key'] : '', 50) }}
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
                                        <input type="hidden" name="booking_repeat_id"
                                            value="{{ $booking?->nextService['id'] }}">
                                    </tbody>
                                </table>
                            </div>

                            <div class="bg-F8F8F8 p-3 mb-30">
                                <div class="form-check d-flex align-items-center gap-1">
                                    <input class="form-check-input check-28" type="checkbox"
                                        name="next_all_booking_change" value="1">
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

    @if ($booking['repeatHistory'])
        <!-- Modal -->
        <div class="modal fade" id="tableModal" tabindex="-1" aria-labelledby="tableModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h3 class="modal-title" id="tableModalLabel">{{ translate('edit_history_log') }}</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body flex-grow-1 overflow-y-auto scrollbar-thin py-0">
                        <div class="table-responsive border rounded">
                            <table class="table align-middle fs-12">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-end">{{ translate('SL') }}</th>
                                        <th scope="col">{{ translate('booking_ID') }}</th>
                                        <th scope="col">{{ translate('date_&_Time') }}</th>
                                        <th scope="col" class="text-center">{{ translate('total_Quantity') }}</th>
                                        <th scope="col" class="text-center">{{ translate('remark') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($booking['repeatHistory'] as $repeat)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <button type="button"
                                                        class="table-collapse-btn bg-soft-dark border-0 img-circle"
                                                        style="--size: 40px" data-bs-toggle="collapse"
                                                        data-bs-target="#collapseExample-{{ $repeat['id'] }}"
                                                        aria-expanded="false" aria-controls="collapseExample">
                                                        <span
                                                            class="material-symbols-outlined user-select-none">keyboard_arrow_down</span>
                                                    </button>
                                                    {{ $loop->iteration }}
                                                </div>
                                            </td>
                                            <td>#{{ $repeat['readable_id'] }}</td>
                                            <td>
                                                <div>{{ date('d-M-Y h:ia', strtotime($booking['created_at'])) }}</div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center gap-1 justify-content-center">
                                                    {{ $repeat['old_quantity'] }} <span
                                                        class="material-symbols-outlined fs-12">arrow_forward</span>
                                                    {{ $repeat['new_quantity'] }}
                                                </div>
                                            </td>
                                            @if ($repeat['is_multiple'])
                                                <td class="text-center">{{ translate('Edited multiple booking') }}</td>
                                            @else
                                                <td class="text-center">
                                                    {{ translate('Edited only this single booking') }}</td>
                                            @endif
                                        </tr>
                                        <tr class="bg--secondary collapse" id="collapseExample-{{ $repeat['id'] }}">
                                            <td colspan="5">
                                                <div class="p-2 rounded bg-white d-flex flex-column gap-1">
                                                    @if ($repeat['log_details'])
                                                        @foreach ($repeat['log_details'] as $serviceLog)
                                                            <div
                                                                class="bg--secondary p-3 rounded d-flex align-items-center gap-2 justify-content-between">
                                                                <div>{{ $serviceLog->service_name }}</div>
                                                                <div>{{ $serviceLog->quantity }} x
                                                                    {{ $serviceLog->service_cost }}</div>
                                                                <div>
                                                                    {{ with_currency_symbol($serviceLog->quantity * $serviceLog->service_cost) }}
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                        <div class="d-flex gap-4 justify-content-end mt-1 px-2">
                                                            <div>{{ translate('Sub Total') }}:</div>
                                                            <div class="fw-bold">
                                                                {{ with_currency_symbol($serviceLog->quantity * $serviceLog->service_cost) }}
                                                            </div>
                                                        </div>
                                                        <div class="d-flex gap-4 justify-content-end px-2">
                                                            <div>{{ 'Service Discount' }}:</div>
                                                            <div class="fw-bold">
                                                                {{ with_currency_symbol($serviceLog->discount_amount) }}
                                                            </div>
                                                        </div>
                                                        <div class="d-flex gap-4 justify-content-end px-2">
                                                            <div>{{ 'Service Vat' }}:</div>
                                                            <div class="fw-bold">{{ with_currency_symbol($repeat['total_tax_amount']) }}</div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn--primary" data-bs-dismiss="modal"
                            aria-label="Close">{{ translate('okay') }}</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @include('bookingmodule::provider.booking.partials.details._repeat-details-service-location-modal')

    @include('bookingmodule::provider.booking.partials.details._update-customer-address-modal')

@endsection

@push('script')
    <script>
        "use strict";

        // $('.table-collapse-btn').on("click", function() {
        //     // $('tr.bg--secondary.collapse.show').each(function() {
        //     //     $(this).prev('tr').addClass('bg--secondary');
        //     // });
        //     $(this).closest('tr').toggleClass('bg--secondary');
        // });

        $('.table-collapse-btn').on("click", function() {
            const parentRow = $(this).closest('tr');

            const collapseTargetId = $(this).attr('data-bs-target');
            const collapseTarget = $(collapseTargetId);

            collapseTarget.on('shown.bs.collapse', function() {
                parentRow.addClass('bg--secondary');
            }).on('hidden.bs.collapse', function() {
                parentRow.removeClass('bg--secondary');
            });
        });

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

        $(".remove-service-row").on('click', function() {
            let row = $(this).data('row');
            removeServiceRow(row)
        })

        function removeServiceRow(row) {
            const row_count = $('#service-edit-tbody tr').length;
            if (row_count <= 1) {
                toastr.error('{{ translate('Can not remove the only service') }}');
                return;
            }

            Swal.fire({
                title: "{{ translate('are_you_sure') }}?",
                text: '{{ translate('want to remove the service from the booking') }}',
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
                    $(`#${row}`).remove();
                }
            })
        }
    </script>


    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ business_config('google_map', 'third_party')?->live_values['map_api_key_client'] }}&libraries=places&v=3.45.8">
    </script>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#viewer').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFileEg1").change(function() {
            readURL(this);
        });

        $(document).ready(function() {
            function initAutocomplete() {
                let myLatLng = {
                    lat: {{ $booking->service_address?->lat ?? 23.811842872190343 }},
                    lng: {{ $booking->service_address?->lon ?? 90.356331 }}
                };
                const map = new google.maps.Map(document.getElementById("location_map_canvas"), {
                    center: myLatLng,
                    zoom: 13,
                    mapTypeId: "roadmap",
                });

                let marker = new google.maps.Marker({
                    position: myLatLng,
                    map: map,
                });

                marker.setMap(map);
                var geocoder = geocoder = new google.maps.Geocoder();
                google.maps.event.addListener(map, 'click', function(mapsMouseEvent) {
                    var coordinates = JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2);
                    var coordinates = JSON.parse(coordinates);
                    var latlng = new google.maps.LatLng(coordinates['lat'], coordinates['lng']);
                    marker.setPosition(latlng);
                    map.panTo(latlng);

                    document.getElementById('latitude').value = coordinates['lat'];
                    document.getElementById('longitude').value = coordinates['lng'];


                    geocoder.geocode({
                        'latLng': latlng
                    }, function(results, status) {
                        if (status == google.maps.GeocoderStatus.OK) {
                            if (results[1]) {
                                document.getElementById('address').value = results[1]
                                    .formatted_address;
                            }
                        }
                    });
                });

                const input = document.getElementById("pac-input");
                const searchBox = new google.maps.places.SearchBox(input);
                map.controls[google.maps.ControlPosition.TOP_CENTER].push(input);

                map.addListener("bounds_changed", () => {
                    searchBox.setBounds(map.getBounds());
                });
                let markers = [];

                searchBox.addListener("places_changed", () => {
                    const places = searchBox.getPlaces();

                    if (places.length == 0) {
                        return;
                    }

                    markers.forEach((marker) => {
                        marker.setMap(null);
                    });
                    markers = [];

                    const bounds = new google.maps.LatLngBounds();
                    places.forEach((place) => {
                        if (!place.geometry || !place.geometry.location) {
                            console.log("Returned place contains no geometry");
                            return;
                        }
                        var mrkr = new google.maps.Marker({
                            map,
                            title: place.name,
                            position: place.geometry.location,
                        });
                        google.maps.event.addListener(mrkr, "click", function(event) {
                            document.getElementById('latitude').value = this.position.lat();
                            document.getElementById('longitude').value = this.position
                                .lng();
                        });

                        markers.push(mrkr);

                        if (place.geometry.viewport) {
                            bounds.union(place.geometry.viewport);
                        } else {
                            bounds.extend(place.geometry.location);
                        }
                    });
                    map.fitBounds(bounds);
                });
            };
            initAutocomplete();
        });


        $('.__right-eye').on('click', function() {
            if ($(this).hasClass('active')) {
                $(this).removeClass('active')
                $(this).find('i').removeClass('tio-invisible')
                $(this).find('i').addClass('tio-hidden-outlined')
                $(this).siblings('input').attr('type', 'password')
            } else {
                $(this).addClass('active')
                $(this).siblings('input').attr('type', 'text')


                $(this).find('i').addClass('tio-invisible')
                $(this).find('i').removeClass('tio-hidden-outlined')
            }
        })

        // for update service location from update customer address modal
        $(document).ready(function() {
            function addressMap() {
                let myLatLng = {
                    lat: {{ $booking->service_address?->lat ?? 23.811842872190343 }},
                    lng: {{ $booking->service_address?->lon ?? 90.356331 }}
                };
                const map = new google.maps.Map(document.getElementById("address_location_map_canvas"), {
                    center: myLatLng,
                    zoom: 13,
                    mapTypeId: "roadmap",
                });

                let marker = new google.maps.Marker({
                    position: myLatLng,
                    map: map,
                });

                marker.setMap(map);
                var geocoder = geocoder = new google.maps.Geocoder();
                google.maps.event.addListener(map, 'click', function(mapsMouseEvent) {
                    var coordinates = JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2);
                    var coordinates = JSON.parse(coordinates);
                    var latlng = new google.maps.LatLng(coordinates['lat'], coordinates['lng']);
                    marker.setPosition(latlng);
                    map.panTo(latlng);

                    document.getElementById('address_latitude').value = coordinates['lat'];
                    document.getElementById('address_longitude').value = coordinates['lng'];


                    geocoder.geocode({
                        'latLng': latlng
                    }, function(results, status) {
                        if (status == google.maps.GeocoderStatus.OK) {
                            if (results[1]) {
                                document.getElementById('address_address').value = results[1].formatted_address;
                            }
                        }
                    });
                });

                const input = document.getElementById("address_pac-input");
                const searchBox = new google.maps.places.SearchBox(input);
                map.controls[google.maps.ControlPosition.TOP_CENTER].push(input);

                map.addListener("bounds_changed", () => {
                    searchBox.setBounds(map.getBounds());
                });
                let markers = [];

                searchBox.addListener("places_changed", () => {
                    const places = searchBox.getPlaces();

                    if (places.length == 0) {
                        return;
                    }

                    markers.forEach((marker) => {
                        marker.setMap(null);
                    });
                    markers = [];

                    const bounds = new google.maps.LatLngBounds();
                    places.forEach((place) => {
                        if (!place.geometry || !place.geometry.location) {
                            console.log("Returned place contains no geometry");
                            return;
                        }
                        var mrkr = new google.maps.Marker({
                            map,
                            title: place.name,
                            position: place.geometry.location,
                        });
                        google.maps.event.addListener(mrkr, "click", function(event) {
                            document.getElementById('address_latitude').value = this.position.lat();
                            document.getElementById('address_longitude').value = this.position.lng();
                        });

                        markers.push(mrkr);

                        if (place.geometry.viewport) {
                            bounds.union(place.geometry.viewport);
                        } else {
                            bounds.extend(place.geometry.location);
                        }
                    });
                    map.fitBounds(bounds);
                });
            };
            addressMap();
        });

        $(document).ready(function() {
            // Get booking ID dynamically
            var bookingId = "{{ $booking['id'] }}";

            function toggleServiceLocation() {
                if ($('#customer_location').is(':checked')) {
                    $('.customer-details').show();
                    $('.provider-details').hide();
                } else {
                    $('.customer-details').hide();
                    $('.provider-details').show();
                }
            }

            // Run toggle function on radio button change
            $('input[name="service_location"]').on('change', function() {
                toggleServiceLocation();
            });

            // Run toggle function when the modal is opened
            $('#serviceLocationModal--' + bookingId).on('shown.bs.modal', function () {
                toggleServiceLocation();
            });

            // When the address modal opens, hide the first modal
            $('#customerAddressModal--' + bookingId).on('show.bs.modal', function () {
                $('#serviceLocationModal--' + bookingId).modal('hide'); // Hide the first modal
            });

            // When the address modal closes, reopen the service location modal and update the address
            $('#customerAddressModal--' + bookingId).on('hidden.bs.modal', function () {
                $('#serviceLocationModal--' + bookingId).modal('show'); // Show the first modal again
            });
        });

        $(document).ready(function () {
            $("#customerAddressModalSubmit").on("submit", function (e) {
                e.preventDefault(); // Prevent form submission

                var bookingId = "{{ $booking['id'] }}";

                let customerAddressModal = $("#customerAddressModal--" + bookingId);
                let serviceLocationModal = $("#serviceLocationModal--" + bookingId);

                // Copy updated data from customerAddressModal inputs
                let contactPersonName = customerAddressModal.find("input[name='contact_person_name']").val();
                let contactPersonNumber = customerAddressModal.find("input[name='contact_person_number']").val();
                let addressLabel = customerAddressModal.find("select[name='address_label']").val();
                let address = customerAddressModal.find("input[name='address']").val();
                let latitude = customerAddressModal.find("input[name='latitude']").val();
                let longitude = customerAddressModal.find("input[name='longitude']").val();
                let city = customerAddressModal.find("input[name='city']").val();
                let street = customerAddressModal.find("input[name='street']").val();
                let zipCode = customerAddressModal.find("input[name='zip_code']").val();
                let country = customerAddressModal.find("input[name='country']").val();

                // Update the corresponding hidden inputs in serviceLocationModal
                serviceLocationModal.find("input[name='contact_person_name']").val(contactPersonName);
                serviceLocationModal.find("input[name='contact_person_number']").val(contactPersonNumber);
                serviceLocationModal.find("input[name='address_label']").val(addressLabel);
                serviceLocationModal.find("input[name='address']").val(address);
                serviceLocationModal.find("input[name='latitude']").val(latitude);
                serviceLocationModal.find("input[name='longitude']").val(longitude);
                serviceLocationModal.find("input[name='city']").val(city);
                serviceLocationModal.find("input[name='street']").val(street);
                serviceLocationModal.find("input[name='zip_code']").val(zipCode);
                serviceLocationModal.find("input[name='country']").val(country);

                $('.updated_customer_name').text(contactPersonName); // Update the customer name
                $('#updated_customer_phone').text(contactPersonNumber); // Update the customer

                $('#customer_service_location').removeClass('text-danger'); // Update the customer service location
                $('#customer_service_location').text(address); // Update the customer service location
                $('.customer-address-update-btn').removeAttr('disabled'); // Update the customer service location update button

                // Close the customerAddressModal
                customerAddressModal.modal("hide");

                // Open the serviceLocationModal to show updated data
                serviceLocationModal.modal("show");
            });
        });

        $(".customer-address-reset-btn").on("click", function (e) {
            let name = "{{ $customer_name }}";
            let phone = "{{ $customer_phone }}";
            let customerAddress = "{{ $booking?->service_address?->address }}";

            $('.updated_customer_name').text(name); // Update the customer name
            $('#updated_customer_phone').text(phone); // Update the customer

            if (customerAddress) {
                $('#customer_service_location').text(customerAddress); // Update the customer service location
                $('#customer_service_location').removeClass('text-danger');
                $('.customer-address-update-btn').removeAttr('disabled');
            } else {
                $('#customer_service_location').text("No address found");
                $('#customer_service_location').addClass('text-danger');
                $('.customer-address-update-btn').attr('disabled', true);
            }
        })

    </script>
@endpush
