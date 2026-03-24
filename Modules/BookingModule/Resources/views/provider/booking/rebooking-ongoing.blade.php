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
                    <h5 class="mb-2">{{ translate('Booking') }} # {{ $booking->booking->readable_id }}
                        <span class="fw-normal title-color">({{ translate('Total_Booking') }} - {{ count($booking->booking->repeat) }})</span>
                    </h5>
                    <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                        <h3 class="c1 fw-bold">{{ translate('Sub-Booking') }} # {{ $booking['readable_id'] }}</h3>
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
                        @if (in_array($booking['booking_status'], ['accepted', 'ongoing']) && $booking['payment_method'] == 'cash_after_service' && !$booking['is_paid'])
                            <button class="btn btn--primary" data-bs-toggle="modal"
                                    data-bs-target="#serviceUpdateModal--{{ $booking['id'] }}" data-toggle="tooltip"
                                    title="{{ translate('Add or remove services') }}">
                                <span class="material-symbols-outlined">edit</span>{{ translate('Edit Services') }}
                            </button>
                        @endif
                        <a href="{{ route('provider.booking.single_invoice', [$booking->id]) }}" class="btn btn-primary"
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
                        <a class="nav-link {{ $webPage == 'status' ? 'active' : '' }}"
                           href="{{ url()->current() }}?web_page=status">{{ translate('status') }}</a>
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
                    <div class="card mb-3">
                        <div class="card-body pb-5">
                            <div class="border-bottom pb-3 mb-3">
                                <div
                                    class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center gap-3 flex-wrap mb-40">
                                    <div>
                                        <h4 class="mb-2">{{ translate('Payment_Info') }}</h4>
                                        <p class="mb-2">
                                            {{ translate('Payment_Method') }} :
                                            <span class="text-info fw-semibold">{{ ucwords(str_replace(['_', '-'], ' ', $booking->payment_method)) }}
                                            </span>
                                        </p>
                                        <p class="mb-2">
                                            <span>{{ translate('Amount') }} : </span>
                                            <span
                                                class="c1">{{ with_currency_symbol($booking->total_booking_amount) }}</span>
                                        </p>
                                        @if($booking->is_paid)
                                        <p>
                                            <span>{{ translate('Payment by') }} : </span>
                                            <span
                                                class="c1">{{ ($booking?->booking?->customer?->first_name . ' ' . $booking?->booking?->customer?->last_name) }}</span>
                                        </p>
                                        @endif
                                    </div>
                                    <div class="text-start text-sm-end">
                                        <p class="mb-2">
                                            <span>{{ translate('Payment_Status') }} : </span>
                                            <span class="ms-3 badge badge-{{ $booking->is_paid ? 'success' : 'danger' }}"
                                                  id="payment_status__span">{{ $booking->is_paid ? translate('Paid') : translate('Unpaid') }}</span>
                                        </p>

                                            @if($booking?->scheduleHistories->count() > 1)
                                                <h5 class="d-flex gap-1 flex-wrap align-items-center">
                                                    <div>{{ translate('Schedule_Date') }} :</div>
                                                    <div>
                                                        <div>{{ date('d-M-Y h:ia', strtotime($booking->scheduleHistories->first()->schedule)) }}</div>
                                                    </div>
                                                </h5>
                                                <h5 class="d-flex gap-1 flex-wrap align-items-center mt-3">
                                                    <div>{{ translate('Re-schedule_Date') }} :</div>
                                                    <div id="service_schedule__span">
                                                        <div>{{ date('d-M-Y h:ia', strtotime($booking->service_schedule)) }}</div>
                                                        <div class="timeline-container">
                                                            <ul class="timeline-sessions">
                                                                <p class="fs-14">{{ translate('Schedule Change Log') }}</p>
                                                                @foreach ($booking?->scheduleHistories()->orderBy('created_at', 'desc')->get() as $key => $history)
                                                                    <li class="{{ $booking->service_schedule == $history->schedule ? 'active' : '' }}">
                                                                        <div class="timeline-date">
                                                                            {{ \Carbon\Carbon::parse($history->schedule)->format('d-M-Y') }}
                                                                        </div>
                                                                        <div class="timeline-time">
                                                                            {{ \Carbon\Carbon::parse($history->schedule)->format('h:i A') }}
                                                                        </div>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </h5>
                                            @else
                                                <h5 class="d-flex gap-1 flex-wrap align-items-center">
                                                    <div>{{ translate('Schedule_Date') }} :</div>
                                                    <div id="service_schedule__span">
                                                        <div>{{ date('d-M-Y h:ia', strtotime($booking->service_schedule)) }}</div>
                                                        <div class="timeline-container">
                                                            <ul class="timeline-sessions">
                                                                <p class="fs-14">{{ translate('Schedule Change Log') }}</p>
                                                                @foreach ($booking?->scheduleHistories()->orderBy('created_at', 'desc')->get() as $key => $history)
                                                                    <li class="{{ $booking->service_schedule == $history->schedule ? 'active' : '' }}">
                                                                        <div class="timeline-date">
                                                                            {{ \Carbon\Carbon::parse($history->schedule)->format('d-M-Y') }}
                                                                        </div>
                                                                        <div class="timeline-time">
                                                                            {{ \Carbon\Carbon::parse($history->schedule)->format('h:i A') }}
                                                                        </div>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </h5>
                                            @endif
                                    </div>
                                </div>
{{--                                <div class="bg-soft-light rounded py-3 px-3 title-color mb-20">--}}
{{--                                    <span>--}}
{{--                                        <span class="c1 fw-semibold"> # {{ translate('Note') }}: </span>--}}
{{--                                        {{ translate('Please provide extra layer in the packaging') }}--}}

{{--                                    </span>--}}
{{--                                </div>--}}
                            </div>

                            <div class="d-flex justify-content-start gap-2">
                                <h3 class="mb-3">{{ translate('Booking_Summary') }}</h3>
                            </div>

                            <div class="table-responsive border-bottom">
                                <table class="table text-nowrap align-middle mb-0">
                                    <thead>
                                    <tr>
                                        <th class="ps-lg-3">{{ translate('Service') }}</th>
                                        <th>{{ translate('Price') }}</th>
                                        <th>{{ translate('Qty') }}</th>
                                        <th>{{ translate('Discount') }}</th>
                                        <th>{{ translate('Vat') }}</th>
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
                                                <span>{{ $detail->quantity }}</span>
                                            </td>
                                            <td>
                                                @if ($detail?->discount_amount > 0)
                                                    {{ with_currency_symbol($detail->discount_amount) }}
                                                @elseif($detail?->campaign_discount_amount > 0)
                                                    {{ with_currency_symbol($detail->campaign_discount_amount) }}
                                                    <br><span
                                                        class="fz-12 text-capitalize">{{ translate('campaign') }}</span>
                                                @endif
                                            </td>
                                            <td>{{ with_currency_symbol($detail->tax_amount) }}</td>
                                            <td class="text--end">{{ with_currency_symbol($detail->total_cost) }}</td>
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
                                                <td class="text-capitalize">{{ translate('service_amount') }} <small
                                                        class="fz-12">({{ translate('Vat_Excluded') }})</small></td>
                                                <td class="text--end pe--4">{{ with_currency_symbol($subTotal) }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-capitalize">{{ translate('service_discount') }}</td>
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
                            <div class="d-flex justify-content-between align-items-center gap-10 form-control h-45">
                                <span class="title-color">{{ translate('Payment Status') }}</span>

                                <div class="on-off-toggle">
                                    <input class="on-off-toggle__input switcher_input"
                                           value="{{ $booking['is_paid'] ? '1' : '0' }}"
                                           {{ $booking['is_paid'] ? 'checked' : '' }} type="checkbox"
                                           id="payment_status" />
                                    <label for="payment_status" class="on-off-toggle__slider">
                                        <span class="on-off-toggle__on">
                                            <span class="on-off-toggle__text">{{ translate('Paid') }}</span>
                                            <span class="on-off-toggle__circle"></span>
                                        </span>
                                        <span class="on-off-toggle__off">
                                            <span class="on-off-toggle__circle"></span>
                                            <span class="on-off-toggle__text">{{ translate('Unpaid') }}</span>
                                        </span>
                                    </label>
                                </div>
                            </div>

                            <div class="mt-3">
                                <div class="mt-3">
                                    <select class="js-select without-search" id="booking_status">
                                        @if($booking->booking_status == 'completed')
                                            <option
                                                    value="completed" {{$booking['booking_status'] == 'completed' ? 'selected' : ''}}>{{translate('Completed')}}</option>
                                        @else
                                            @if($booking['booking_status'] != 'canceled')
                                            <option
                                                    value="0"
                                                    disabled {{$booking['booking_status'] == 'accepted' ? 'selected' : ''}}>{{translate('Accepted')}}</option>
                                            <option
                                                    value="ongoing" {{$booking['booking_status'] == 'ongoing' ? 'selected' : ''}}>{{translate('Ongoing')}}</option>
                                            <option
                                                    value="completed" {{$booking['booking_status'] == 'completed' ? 'selected' : ''}}>{{translate('Completed')}}</option>
                                            @endif
                                            @if((business_config('provider_can_cancel_booking', 'provider_config'))->live_values && !$booking->is_paid && $booking->payment_method == 'cash_after_service')
                                                <option value="canceled" {{$booking['booking_status'] == 'canceled' ? 'selected' : ''}}>{{translate('Canceled')}}</option>
                                            @endif
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="mt-3">
                                @if (!in_array($booking->booking_status, ['ongoing', 'completed']))
                                    <input type="datetime-local" class="form-control h-45"
                                           name="service_schedule"
                                           value="{{ $booking->service_schedule }}"
                                           id="service_schedule"
                                           data-original="{{ $booking->service_schedule }}"
                                           min="<?php echo date('Y-m-d\TH:i'); ?>"
                                           onchange="service_schedule_update()">
                                @endif
                            </div>
                            @endif
                            <div class="py-3 d-flex flex-column gap-3 mb-2">
                                <div class="modal fade" id="upload_picture_modal" data-bs-backdrop="static"
                                     tabindex="-1" aria-labelledby="upload_picture_modalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header border-0">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <h3 class="text-center mb-4">{{translate('Upload_Picture_Before_Completing_The')}}
                                                    <br class="d-none d-sm-block"> {{translate('Service')}} ? </h3>
                                                <form id="uploadPictureForm" name="uploadPictureForm"
                                                      enctype="multipart/form-data" action="javascript:void(0)">
                                                    @csrf
                                                    <div class="d-flex justify-content-center">
                                                        <div class="mx-auto">
                                                            <div class="d-flex flex-wrap gap-3 __new-coba"
                                                                 id="evidence-photoss"></div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex gap-4 flex-wrap justify-content-center mt-20">
                                                        <button type="button" class="btn btn--secondary"
                                                                id="skip_button">Skip
                                                        </button>
                                                        <button type="submit"
                                                                class="btn btn--primary">{{translate('Save')}}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="otpModal" tabindex="-1" data-bs-backdrop="static"
                                     aria-labelledby="otpModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header border-0">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="otp-form mx-auto" id="otp_form" name="otp_form"
                                                      enctype="multipart/form-data" action="javascript:void(0)">
                                                    <h4 class="text-center mb-5">{{translate('Please Collect OTP from your customer
                                                        &
                                                        Insert Here')}}</h4>
                                                    <div
                                                            class="d-flex gap-2 gap-sm-3 align-items-end justify-content-center">
                                                        <input class="otp-field" type="number" name="otp_field[]"
                                                               maxlength="1" autofocus>
                                                        <input class="otp-field" type="number" name="otp_field[]"
                                                               maxlength="1" autocomplete="off">
                                                        <input class="otp-field" type="number" name="otp_field[]"
                                                               maxlength="1" autocomplete="off">
                                                        <input class="otp-field" type="number" name="otp_field[]"
                                                               maxlength="1" autocomplete="off">
                                                        <input class="otp-field" type="number" name="otp_field[]"
                                                               maxlength="1" autocomplete="off">
                                                        <input class="otp-field" type="number" name="otp_field[]"
                                                               maxlength="1" autocomplete="off">
                                                    </div>

                                                    <input class="otp-value" type="hidden" name="opt-value">

                                                    <div class="d-flex justify-content-between gap-2 mb-5 mt-30">
                                                        <span
                                                                class="text-muted">{{translate('Did not get any OTP')}} ?</span>
                                                        <span
                                                                class="text-muted cursor-pointer resend-otp">{{translate('Resend it')}}</span>
                                                    </div>

                                                    <div class="d-flex justify-content-center mb-4">
                                                        <button type="submit"
                                                                class="btn btn--primary">{{translate('Submit')}}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div></div>
                                @if ($booking->evidence_photos)
                                    <div class="c1-light-bg radius-10 py-3 px-4">
                                        <div class="d-flex justify-content-start gap-2">
                                            <h4 class="mb-2">{{ translate('uploaded_Images') }}</h4>
                                        </div>

                                        <div class="py-3 px-4">
                                            <div class="d-flex flex-wrap gap-3 justify-content-lg-start">
                                                @foreach ($booking->evidence_photos_full_path ?? [] as $key => $img)
                                                    <img width="100" class="max-height-100"
                                                         src="{{ $img }}"
                                                         alt="{{ translate('evidence-photo') }}" @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif

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
                                                         data-bs-target="#repeatServiceLocationModal--{{ $booking['id'] }}"
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

                                            <div class="btn-group">
                                                @if (in_array($booking->booking_status, ['ongoing', 'accepted']))
                                                    @if (!$booking?->is_guest)
                                                        <div
                                                            class="d-flex align-items-center gap-2 cursor-pointer customer-chat">
                                                            <span class="material-symbols-outlined">chat</span>
                                                            <form action="{{ route('provider.chat.create-channel') }}"
                                                                  method="post" id="chatForm-{{ $booking?->booking?->id }}">
                                                                @csrf
                                                                <input type="hidden" name="customer_id"
                                                                       value="{{ $booking?->booking?->customer?->id }}">
                                                                <input type="hidden" name="type" value="booking">
                                                                <input type="hidden" name="user_type" value="customer">
                                                            </form>
                                                        </div>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>

                                        <div class="py-3 px-4">
                                            @php($customer_name = $booking?->booking?->service_address?->contact_person_name)
                                            @php($customer_phone = $booking?->booking?->service_address?->contact_person_number)

                                            @php($name = $booking->service_address?->contact_person_name)
                                            @php($phone = $booking->service_address?->contact_person_number)

                                            <div class="media gap-2 flex-wrap">
                                                @if (!$booking?->is_guest && $booking?->booking?->customer)
                                                    <img width="58" height="58"
                                                         class="rounded-circle border border-white aspect-square object-fit-cover"
                                                         src="{{ $booking?->booking?->customer?->profile_image_full_path }}"
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
                                                            @if(!empty($booking?->booking?->service_address?->address))
                                                                <li>
                                                                    <span class="material-icons">map</span>
                                                                    <p>{{ Str::limit($booking?->booking?->service_address?->address ?? translate('not_available'), 100) }}
                                                                    </p>
                                                                </li>
                                                            @endif
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <div class="c1-light-bg radius-10 serviceman-information">
                                    <div
                                        class="border-bottom d-flex align-items-center justify-content-between gap-2 py-3 px-4 mb-2">
                                        <h4 class="d-flex align-items-center gap-2">
                                            <span class="material-icons title-color">person</span>
                                            {{ translate('Serviceman_Information') }}
                                        </h4>
                                        @if (isset($booking->serviceman) && in_array($booking->booking_status, ['ongoing', 'accepted']))
                                            <div class="btn-group">
                                                <div class="cursor-pointer" data-bs-toggle="dropdown"
                                                     aria-expanded="false">
                                                    <span class="material-symbols-outlined">more_vert</span>
                                                </div>
                                                <ul
                                                    class="dropdown-menu dropdown-menu__custom border-none dropdown-menu-end">
                                                    <li>
                                                        <div class="d-flex align-items-center gap-2"
                                                             data-bs-target="#servicemanModal" data-bs-toggle="modal">
                                                            <span
                                                                class="material-symbols-outlined">manage_history</span>
                                                            {{ translate('change serviceman') }}
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        @endif
                                    </div>
                                    @if (isset($booking->serviceman))
                                        <div class="py-3 px-4">
                                            <div class="media gap-2 flex-wrap">
                                                <img width="58" height="58"
                                                     class="rounded-circle border border-white aspect-square object-fit-cover"
                                                     src="{{ $booking?->serviceman?->user?->profile_image_full_path }}"
                                                     alt="{{ translate('serviceman') }}">
                                                <div class="media-body">
                                                    <h5 class="c1 mb-3">
                                                        {{ Str::limit($booking->serviceman && $booking->serviceman->user ? $booking->serviceman->user->first_name . ' ' . $booking->serviceman->user->last_name : '', 30) }}
                                                    </h5>
                                                    <ul class="list-info">
                                                        <li>
                                                            <span class="material-icons">phone_iphone</span>
                                                            <a
                                                                href="tel:{{ $booking->serviceman && $booking->serviceman->user ? $booking->serviceman->user->phone : '' }}">
                                                                {{ $booking->serviceman && $booking->serviceman->user ? $booking->serviceman->user->phone : '' }}
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="d-flex flex-column gap-2 mt-30 align-items-center">
                                            <span class="material-icons text-muted fs-2">account_circle</span>
                                            <p class="text-muted text-center fw-medium mb-3">
                                                {{ translate('No Serviceman Information') }}</p>
                                        </div>

                                        <div class="text-center pb-4">
                                            <button
                                                class="btn btn--primary"
                                                data-bs-target="#servicemanModal"
                                                data-bs-toggle="modal"
                                                @if($booking['booking_status'] == 'completed' || $booking['booking_status'] == 'canceled' || !isset($booking->provider))
                                                    disabled
                                                @endif>
                                                {{ translate('assign Serviceman') }}
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="servicemanModal" tabindex="-1" aria-labelledby="servicemanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content modal-content-data1" id="modal-data-info1">
                @include('bookingmodule::provider.booking.partials.details.serviceman-info-modal-data')
            </div>
        </div>
    </div>

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
                            <h3 class="c1 fw-bold mb-2">{{ translate('Sub-Booking') }} # {{ $booking['readable_id']}}
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
                            <h4> {{ translate('Category') }} : {{ $booking->booking->category->name }}</h4>
                            <h4> {{ translate('SubCategory') }} : {{ $booking->booking->subCategory->name }}</h4>
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
                                @foreach ($booking->detail as $key => $detail)
                                    <tr id="service-row--{{ $detail?->variant_key }}">
                                        <td class="text-wrap ps-lg-3">
                                            @if (isset($detail->service))
                                                <div class="d-flex flex-column">
                                                    <a class="fw-bold">{{ Str::limit($detail->service->name, 30) }}</a>
                                                    <div>{{ Str::limit($detail ? $detail->variant_key : '', 50) }}
                                                    </div>
                                                </div>
                                            @else
                                                <span
                                                    class="badge badge-pill badge-danger">{{ translate('Service_unavailable') }}</span>
                                            @endif
                                        </td>
                                        <td class="text--end" id="service-cost-{{ $detail?->variant_key }}">
                                            {{ currency_symbol() . ' ' . $detail->service_cost }}</td>
                                        <td>
                                            <input type="number" min="1" name="qty[]"
                                                   class="form-control qty-width dark-color-bo m-auto min-w-100px"
                                                   id="qty-{{ $detail?->variant_key }}"
                                                   value="{{ $detail->quantity }}"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                        </td>
                                        <td class="text--end" id="discount-amount-{{ $detail?->variant_key }}">
                                            {{ currency_symbol() . ' ' . $detail->discount_amount }}</td>
                                        <td class="text--end" id="total-cost-{{ $detail?->variant_key }}">
                                            {{ currency_symbol() . ' ' . $detail->total_cost }}
                                        </td>
                                        <input type="hidden" name="service_ids[]"
                                               value="{{ $detail->service->id }}">
                                        <input type="hidden" name="variant_keys[]"
                                               value="{{ $detail->variant_key }}">
                                    </tr>
                                    @php($sub_total += $detail->service_cost * $detail->quantity)
                                @endforeach
                                <input type="hidden" name="zone_id" value="{{ $booking->booking->zone_id }}">
                                <input type="hidden" name="booking_id" value="{{ $booking->booking_id }}">
                                <input type="hidden" name="booking_repeat_id" value="{{ $booking->id }}">
                                </tbody>
                            </table>
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

    @include('bookingmodule::provider.booking.partials.details._repeat-ongoing-service-location-modal')

    @include('bookingmodule::provider.booking.partials.details._update-customer-address-modal')
@endsection

@push('script')
    <script src="{{ asset('public/assets/admin-module/js/spartan-multi-image-picker.js') }}"></script>
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

        $('.reassign-serviceman').on('click', function() {
            let id = $(this).data('serviceman-reassign');
            updateServiceman(id)
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
                update_booking_details(route, '{{ translate('want_to_update_status') }}', 'booking_status',
                    booking_status);
            } else {
                toastr.error('{{ translate('choose_proper_status') }}');
            }
        });

        $("#evidence-photoss").spartanMultiImagePicker({
            fieldName: 'evidence_photos[]',
            maxCount: 6,
            rowHeight: '100px !important',
            groupClassName: 'spartan_item_wrapper min-w-100px max-w-100px',
            maxFileSize: '',
            placeholderImage: {
                image: '{{asset('public/assets/admin-module')}}/img/media/banner-upload-file.png',
                width: '100%',
            },
            dropFileLabel: "Drop Here",
            onAddRow: function (index, file) {

            },
            onRenderedPreview: function (index) {

            },
            onRemoveRow: function (index) {

            },
            onExtensionErr: function (index, file) {
                toastr.error(
                    "{{ translate('messages.please_only_input_png_or_jpg_type_file') }}", {
                        CloseButton: true,
                        ProgressBar: true
                    });
            },
            onSizeErr: function (index, file) {
                toastr.error("{{ translate('messages.file_size_too_big') }}", {
                    CloseButton: true,
                    ProgressBar: true
                });
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

        $(document).ready(function () {
            $(".otp-form *:input[type!=hidden]:first").focus();
            let otp_fields = $(".otp-form .otp-field"),
                otp_value_field = $(".otp-form .otp-value");
            otp_fields.first().focus();
            otp_fields
                .on("input", function (e) {
                    $(this).val(
                        $(this)
                            .val()
                            .replace(/[^0-9]/g, "")
                    );
                    let opt_value = "";
                    otp_fields.each(function () {
                        let field_value = $(this).val();
                        if (field_value != "") opt_value += field_value;
                    });
                    otp_value_field.val(opt_value);
                })
                .on("keyup", function (e) {
                    let key = e.keyCode || e.charCode;
                    if (key == 8 || key == 46 || key == 37 || key == 40) {
                        // Backspace or Delete or Left Arrow or Down Arrow
                        $(this).prev().focus();
                    } else if (key == 38 || key == 39 || $(this).val() != "") {
                        // Right Arrow or Top Arrow or Value not empty
                        $(this).next().focus();
                    }
                })
                .on("paste", function (e) {
                    let paste_data = e.originalEvent.clipboardData.getData("text");
                    let paste_data_splitted = paste_data.split("");
                    $.each(paste_data_splitted, function (index, value) {
                        otp_fields.eq(index).val(value);
                    });
                });
        });

        function payment_status_change(payment_status) {
            var route = '{{ route('provider.booking.payment_update', [$booking->id]) }}' + '?payment_status=' +
                payment_status;
            update_booking_details(route, '{{ translate('want_to_update_status') }}', 'payment_status', payment_status);
        }

        function service_schedule_update() {
            var $input = $("#service_schedule");
            var service_schedule = $input.val();
            var original = $input.data('original');

            if (!service_schedule) {
                $input.val(original);
                return;
            }

            // Normalize formats (replace space with 'T' for parsing)
            var newDate = new Date(service_schedule);
            var originalDate = new Date(original.replace(" ", "T"));
            var now = new Date();

            // Compare with current time
            if (newDate < now) {
                toastr.error("Reschedule cannot be earlier than the current time");
                $input.val(original);
                return;
            }

            // Compare with original schedule
            if (newDate < originalDate) {
                toastr.error("Reschedule cannot be earlier than the original schedule");
                $input.val(original);
                return;
            }
            var route = '{{ route('provider.booking.schedule_update', [$booking->id]) }}' + '?service_schedule=' + service_schedule;

            update_booking_details(route, '{{ translate('want_to_update_the_booking_schedule') }}', 'service_schedule', service_schedule);
        }

        function update_booking_details(route, message, componentId, updatedValue, type = 'get') {
            Swal.fire({
                title: "{{translate('are_you_sure')}}?",
                text: message,
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: 'var(--bs-secondary)',
                confirmButtonColor: 'var(--bs-primary)',
                cancelButtonText: '{{translate('Cancel')}}',
                confirmButtonText: '{{translate('Yes')}}',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    let evidence_status = {{ (business_config('service_complete_photo_evidence', 'booking_setup'))->live_values == 1 ? 'true' : 'false' }};
                    let booking_otp_status = {{ (business_config('booking_otp', 'booking_setup'))->live_values == 1 ? 'true' : 'false' }};
                    if (componentId === 'booking_status' && updatedValue === 'completed') {
                        if (evidence_status) {
                            $('#upload_picture_modal').modal('show');
                            $('#uploadPictureForm').on('submit', function (e) {
                                e.preventDefault();

                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });
                                var formData = new FormData(this);

                                $.ajax({
                                    url: "{{route('provider.booking.evidence_photos_upload',[$booking->id])}}",
                                    data: formData,
                                    processData: false,
                                    contentType: false,
                                    type: 'POST',
                                    success: function (response) {
                                        toastr.success(response.message, {
                                            CloseButton: true,
                                            ProgressBar: true
                                        });
                                        if (booking_otp_status) {
                                            $('#upload_picture_modal').modal('hide');
                                            open_otp_modal();
                                            $('#otp_form').on('submit', function (e) {
                                                e.preventDefault();
                                                var formData = $(this).serialize(); // Serialize the form data
                                                proceed_with_main_ajax_request(route, componentId, updatedValue, 'PUT', formData);
                                            });
                                        } else {
                                            proceed_with_main_ajax_request(route, componentId, updatedValue, 'PUT');
                                        }
                                    },
                                    error: function (error) {
                                    }
                                });
                            });

                            $('#skip_button').on('click', function (e) {
                                $('#otp_form').off('submit');

                                if (booking_otp_status) {
                                    $('#upload_picture_modal').modal('hide');
                                    open_otp_modal();
                                    $('#otp_form').on('submit', function (e) {
                                        e.preventDefault();
                                        var formData = $(this).serialize();
                                        proceed_with_main_ajax_request(route, componentId, updatedValue, 'PUT', formData);
                                    });
                                } else {
                                    proceed_with_main_ajax_request(route, componentId, updatedValue, 'PUT');
                                }
                            });


                        } else if (booking_otp_status) {
                            open_otp_modal();
                            $('#otp_form').on('submit', function (e) {
                                e.preventDefault();
                                var formData = $(this).serialize();
                                proceed_with_main_ajax_request(route, componentId, updatedValue, 'PUT', formData);
                            });
                        } else {
                            proceed_with_main_ajax_request(route, componentId, updatedValue, 'PUT');
                        }
                    } else {
                        proceed_with_main_ajax_request(route, componentId, updatedValue, 'PUT');
                    }
                }
            });
        }

        function proceed_with_main_ajax_request(route, componentId, updatedValue, type = 'get', formData = null) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: route,
                type: type,
                dataType: 'json',
                data: formData,
                beforeSend: function () {
                },
                success: function (data) {
                    update_component(componentId, updatedValue);
                    toastr.success(data.message, {
                        CloseButton: true,
                        ProgressBar: true
                    });
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                },
                complete: function () {
                },
            });
        }

        function open_otp_modal() {
            $('#otpModal').modal('show');
            $('.otp-field:first').focus();
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
                    lat: {{ $customerAddress->lat ?? 23.811842872190343 }},
                    lng: {{ $customerAddress->lon ?? 90.356331 }}
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
    </script>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('keyup', '.search-form-input1', function() {
                const route = '{{ url('provider/booking/serviceman-update', $booking->id) }}';
                let searchTerm = $('.search-form-input1').val();

                $.ajax({
                    url: route,
                    type: 'PUT',
                    dataType: 'json',
                    data: {
                        booking_id: "{{ $booking->id }}",
                        search: searchTerm,
                    },
                    beforeSend: function() {},
                    success: function(response) {
                        $('.modal-content-data1').html(response.view);
                    },
                    complete: function() {},
                    error: function(xhr) {
                        if (xhr.status === 419) {
                            toastr.error('{{ translate('Session expired, please refresh the page.') }}');
                        } else {
                            toastr.error('{{ translate('Failed to load') }}');
                        }
                    }
                });
            });
        });


        function updateServiceman(servicemanId) {
            const bookingId = "{{ $booking->id }}";
            const route = '{{ url('provider/booking/serviceman-update') }}' + '/' + bookingId;
            const searchTerm = $('.search-form-input1').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: route,
                type: 'PUT',
                dataType: 'json',
                data: {
                    booking_id: bookingId,
                    search: searchTerm,
                    serviceman_id: servicemanId
                },
                beforeSend: function() {
                    toastr.info('{{ translate('Processing request...') }}');
                },
                success: function(response) {
                    $('.modal-content-data').html(response.view);
                    toastr.success('{{ translate('Successfully reassign provider') }}');
                    setTimeout(function() {
                        location.reload()
                    }, 600);
                },
                complete: function() {},
                error: function() {
                    toastr.error('{{ translate('Failed to load') }}');
                }
            });
        }

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
            $('#repeatServiceLocationModal--' + bookingId).on('shown.bs.modal', function () {
                toggleServiceLocation();
            });

            // When the address modal opens, hide the first modal
            $('#customerAddressModal--' + bookingId).on('show.bs.modal', function () {
                $('#repeatServiceLocationModal--' + bookingId).modal('hide'); // Hide the first modal
            });

            // When the address modal closes, reopen the service location modal and update the address
            $('#customerAddressModal--' + bookingId).on('hidden.bs.modal', function () {
                $('#repeatServiceLocationModal--' + bookingId).modal('show'); // Show the first modal again
            });
        });

        $(document).ready(function () {
            $("#customerAddressModalSubmit").on("submit", function (e) {
                e.preventDefault(); // Prevent form submission

                var bookingId = "{{ $booking['id'] }}";

                let customerAddressModal = $("#customerAddressModal--" + bookingId);
                let repeatServiceLocationModal = $("#repeatServiceLocationModal--" + bookingId);

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

                // Update the corresponding hidden inputs in repeatServiceLocationModal
                repeatServiceLocationModal.find("input[name='contact_person_name']").val(contactPersonName);
                repeatServiceLocationModal.find("input[name='contact_person_number']").val(contactPersonNumber);
                repeatServiceLocationModal.find("input[name='address_label']").val(addressLabel);
                repeatServiceLocationModal.find("input[name='address']").val(address);
                repeatServiceLocationModal.find("input[name='latitude']").val(latitude);
                repeatServiceLocationModal.find("input[name='longitude']").val(longitude);
                repeatServiceLocationModal.find("input[name='city']").val(city);
                repeatServiceLocationModal.find("input[name='street']").val(street);
                repeatServiceLocationModal.find("input[name='zip_code']").val(zipCode);
                repeatServiceLocationModal.find("input[name='country']").val(country);

                $('.updated_customer_name').text(contactPersonName); // Update the customer name
                $('#updated_customer_phone').text(contactPersonNumber); // Update the customer
                $('#customer_service_location').removeClass('text-danger'); // Update the customer service location
                $('#customer_service_location').text(address); // Update the customer service location
                $('.customer-address-update-btn').removeAttr('disabled'); // Update the customer service location update button

                // Close the customerAddressModal
                customerAddressModal.modal("hide");

                // Open the repeatServiceLocationModal to show updated data
                repeatServiceLocationModal.modal("show");
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
    <script>
        $(document).ready(function() {
            $('.without-search').select2({
                minimumResultsForSearch: Infinity
            });
        });
    </script>
@endpush
