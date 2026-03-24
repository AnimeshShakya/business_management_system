@extends('providermanagement::layouts.master')

@section('title',translate('calender_view'))
@push('css_or_js')
<link rel="stylesheet" href="{{ asset('public/assets/admin-module/css/fullcalendar.css') }}">
@endpush
@section('content')


    <div class="main-content">
        <div class="container-fluid">
            <div class="page-title-wrap mb-3">
                <h2 class="page-title">{{translate('Booking_Calendar')}}</h2>
            </div>

            <div class="active-filters mb-3" id="activeFilters"></div>

            <div class="custom-booking-calendar">
                <div id="booking-calendar-view"></div>
            </div>
        </div>
    </div>

    {{-- Bookings Multiple --}}
    <div class="offcanvas offcanvas-h-full offcanvas-500px offcanvas-end" tabindex="-1" id="booking-calender_offcanvas">
        <div class="offcanvas-header bg-light py-md-4 py-3">
            <h3 class="mb-0 line-limit-1 fw-semibold"></h3>
            <button type="button" class="offcanvas-btn-date action-btn border-0 d-flex align-items-center justify-content-center btn bg-secondary rounded-circle bg-white text--grey" data-bs-dismiss="offcanvas" aria-label="Close">
                <i class="material-symbols-outlined fs-5 m-0">
                     close
                </i>
            </button>
        </div>
        <div class="offcanvas-body bg-white">

            <div class="input-group search-form__input_group px-0 bg-white border">
                <input type="search"
                       class="theme-input-style search-form__input px-3 fs-13 bg-transparent"
                       value=""
                       name="search"
                       id="booking-list-search"
                       placeholder="Search by booking id"
                       autocomplete="false">
                <span class="input-group-text bg-transparent border-0">
                    <span class="material-icons fs-5 text--grey">search</span>
                </span>
            </div>

            <div class="d-flex flex-column gap-4 mt-20" id="booking-list-container">

            </div>
        </div>
    </div>

    {{-- Calender Filter --}}
    <div class="offcanvas offcanvas-500px offcanvas-end " tabindex="-1" id="booking_filter_offcanvas">
        <div class="offcanvas-header bg-light py-md-4 py-3">
            <h3 class="mb-0 line-limit-1 fw-semibold">{{ translate('Filter') }}</h3>
            <button type="button" class="offcanvas-btn-date action-btn border-0 d-flex align-items-center justify-content-center btn bg-secondary rounded-circle bg-white text--grey" data-bs-dismiss="offcanvas" aria-label="Close">
                <i class="material-symbols-outlined fs-5 m-0">
                     close
                </i>
            </button>
        </div>
        <form action="#0" method="POST">
            <div class="offcanvas-body bg-white">
               <div class="bg-light rounded py-xl-3 py-2 px-sm-3 px-2 mb-3">
                    <h5 class="mb-10px fw-normal">{{ translate('Booking Type') }}</h5>
                    <div class="d-flex flex-md-nowrap flex-wrap justify-content-between border gap-sm-4 gap-3 bg-white p-3 rounded">
                        <div class="custom-radio custom-radio-sm">
                            <input type="radio" id="all_in" name="booking_type" value="all">
                            <label for="all_in" class="m-0 fs-13">{{ translate('All') }}</label>
                        </div>
                        <div class="custom-radio custom-radio-sm">
                            <input type="radio" id="regular_booking" name="booking_type" value="regular">
                            <label for="regular_booking" class="m-0 fs-13">{{ translate('Regular Booking') }}</label>
                        </div>
                        <div class="custom-radio custom-radio-sm">
                            <input type="radio" id="repeat_booking" name="booking_type" value="repeat">
                            <label for="repeat_booking" class="m-0 fs-13">{{ translate('Repeat Booking') }}</label>
                        </div>
                    </div>
               </div>
               <div class="bg-light rounded py-xl-3 py-2 px-sm-3 px-2 mb-3">
                    <h5 class="mb-10px fw-normal">{{ translate('Date Range') }}</h5>
                    <div class="d-flex flex-md-nowrap flex-wrap justify-content-between gap-sm-3 gap-2">
                        <div class="form-control m-0 w-100 p-0">
                            <input type="date" class="form-control h-45 start_date" placeholder="Start date" name="filter_start_date" id="filter_start_date" value="">
                        </div>
                        <div class="form-control m-0 w-100 p-0">
                            <input type="date" class="form-control h-45 end_date" placeholder="End date" name="filter_end_date" id="filter_end_date" value="">
                        </div>
                    </div>
               </div>
               <div class="bg-light rounded py-xl-3 py-2 px-sm-3 px-2">
                    <h5 class="mb-10px fw-normal">{{ translate('Booking status') }}</h5>
                    <div class="bg-white p-3 rounded">
                        <div class="row gy-4 gx-2">
                            <div class="col-sm-6">
                                <div class="custom__checkbox d-flex align-items-center gap-1">
                                    <input type="checkbox" id="pending_in" name="booking_status" value="pending">
                                    <label for="pending_in" class="m-0 fs-13">{{ translate('Pending') }}</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="custom__checkbox d-flex align-items-center gap-1">
                                    <input type="checkbox" id="accepted_in" name="booking_status" value="accepted">
                                    <label for="accepted_in" class="m-0 fs-13">{{ translate('Accepted') }}</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="custom__checkbox d-flex align-items-center gap-1">
                                    <input type="checkbox" id="ongoing_in" name="booking_status" value="ongoing">
                                    <label for="ongoing_in" class="m-0 fs-13">{{ translate('Ongoing') }}</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="custom__checkbox d-flex align-items-center gap-1">
                                    <input type="checkbox" id="completed_in" name="booking_status" value="completed">
                                    <label for="completed_in" class="m-0 fs-13">{{ translate('Completed') }}</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="custom__checkbox d-flex align-items-center gap-1">
                                    <input type="checkbox" id="canceled_in" name="booking_status" value="canceled">
                                    <label for="canceled_in" class="m-0 fs-13">{{ translate('Canceled') }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
               </div>
            </div>
            <div class="offcanvas-footer border-0 bg-white p-3 px-sm-4 shadow-sm">
                <div class="d-flex justify-content-between gap-3">
                    <button type="reset" class="btn btn--secondary flex-grow-1">{{ translate('reset') }}</button>
                    <button type="submit" class="btn btn--primary flex-grow-1">{{ translate('apply') }}</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('script')
<script src="{{ asset('public/assets/admin-module/js/fullcalendar.js') }}"></script>
<script>

    let requestData = {};
    let filterData = {};
    let calendar;

    let filterStartDate = null;
    let filterEndDate = null;

    document.addEventListener('DOMContentLoaded', function () {
        var calendarElNew = document.getElementById('booking-calendar-view');

         calendar = new FullCalendar.Calendar(calendarElNew, {
             initialView: 'dayGridMonth',
             firstDay: 1,     // Monday start
             allDaySlot: false,

             slotLabelFormat: { hour: '2-digit', hour12: true },
             eventTimeFormat: { hour: '2-digit', hour12: true },

             // remove extra line in day and week view
             slotDuration: '01:00:00',
             slotLabelInterval: '01:00',
             snapDuration: '01:00:00',

             headerToolbar: {
                left: 'dayGridMonth,timeGridWeek,timeGridDay',
                center: 'prev,title,next',
                right: 'today myFilter'
            },

            customButtons: {
                myFilter: {
                    text: '',
                    click: function () {
                        var offcanvasEl = document.getElementById('booking_filter_offcanvas');
                        var bsOffcanvas = new bootstrap.Offcanvas(offcanvasEl);
                        bsOffcanvas.show();
                    }
                }
            },

            buttonText: {
                today: 'Today',
                dayGridMonth: ' ',
                timeGridWeek: ' ',
                timeGridDay: ' ',
            },

            datesSet: function (info) {

                if (filterStartDate && filterEndDate) {

                    if (info.start < filterStartDate) {
                        calendar.prev();
                        return;
                    }

                    if (info.end > filterEndDate) {
                        calendar.next();
                        return;
                    }
                }

                const viewType = info.view.type;
                const currentDate = info.view.currentStart;

                if (viewType === 'dayGridMonth') {
                    requestData = {
                        mode: 'dayGridMonth',
                        month: currentDate.getMonth() + 1,
                        year: currentDate.getFullYear()
                    };
                }
                else if (viewType === 'timeGridWeek') {
                    requestData = {
                        mode: 'timeGridWeek',
                        start_date: info.startStr,
                        end_date: info.endStr
                    };
                }
                else if (viewType === 'timeGridDay') {
                    requestData = {
                        mode: 'timeGridDay',
                        date: info.startStr
                    };
                }

                // Refetch events when date/view changes
                calendar.refetchEvents();
            },

            events: function (fetchInfo, successCallback, failureCallback) {

                const finalRequest = {
                    ...requestData, // month / week / day
                    ...filterData   // offcanvas filters
                };

                $.ajax({
                    url: "{{ route('provider.booking.calendar.events') }}",
                    type: "GET",
                    data: finalRequest,
                    success: function (response) {
                        successCallback(response);
                    },
                    error: function (err) {
                        failureCallback(err);
                    }
                });
            },

            displayEventTime: false,
            eventOrder: "title",
            eventDisplay: "block",

            eventClick: function (info) {
                info.jsEvent.preventDefault();

                openBookingOffcanvas(
                    info.event.extendedProps.bookingIds || [],
                    info.event.start
                );
            },

            eventContent: function(arg) {
                 console.log(arg.event.extendedProps)
                let bookingIdsStr = (arg.event.extendedProps.bookingIds || []).join(',');

                return {
                    html: `
                        <span
                            class="booking-badge calender-view-booking-btn"
                            data-booking-ids="${bookingIdsStr}">
                            ${arg.event.title}
                        </span>
                    `
                };
            },

        });

        calendar.render();
    });


    let ALL_BOOKINGS = [];

    function openBookingOffcanvas(bookingIds, startDate) {

        if (!bookingIds.length) return;

        const offcanvasEl = document.getElementById('booking-calender_offcanvas');
        const offcanvasTitle = offcanvasEl.querySelector('h3');

        const isHourly = startDate.getHours() !== 0;

        const { datePart, hourPart } = formatOffcanvasDateParts(startDate);

        offcanvasTitle.innerHTML = isHourly
            ? `Booking List - ${datePart} <span class="fw-normal dark-color">(${hourPart})</span>`
            : `Booking List - ${datePart}`;

        const container =
            offcanvasEl.querySelector('.offcanvas-body .d-flex.flex-column');

        container.innerHTML =
            '<p class="text-center text-muted">Loading...</p>';

        const searchInput = offcanvasEl.querySelector('input[name="search"]');
        if (searchInput) {
            searchInput.value = '';
        }

        let offcanvas = bootstrap.Offcanvas.getInstance(offcanvasEl);
        if (!offcanvas) {
            offcanvas = new bootstrap.Offcanvas(offcanvasEl);
        }
        offcanvas.show();

        const localDate =
            startDate.getFullYear() + '-' +
            String(startDate.getMonth() + 1).padStart(2, '0') + '-' +
            String(startDate.getDate()).padStart(2, '0');

        $.ajax({
            url: "{{ route('provider.booking.calendar.events.bookings') }}",
            type: 'GET',
            data: { ids: bookingIds , date:  localDate},
            success: function (response) {
                ALL_BOOKINGS = response;
                renderBookings(response);
            },
            error: function () {
                container.innerHTML =
                    `<p class="text-danger text-center">Failed to load bookings</p>`;
            }
        });
    }


    function renderBookings(bookings, startDate = null ) {

        const bookingDetailsUrl = "{{ route('provider.booking.details', ['__ID__', 'web_page' => 'details']) }}";
        const repeatBookingDetailsUrl = "{{ route('provider.booking.repeat_details', ['__ID__', 'web_page' => 'details']) }}";

        const container = document.querySelector('#booking-calender_offcanvas .offcanvas-body .d-flex.flex-column');
        container.innerHTML = '';

        if (!bookings.length) {
            container.innerHTML = `<p class="text-center text-muted">No bookings found</p>`;
            return;
        }

        const { datePart, hourPart } = formatOffcanvasDateParts(startDate);


        bookings.forEach(booking => {
            const bookingUrl = booking.is_repeated == 1
                ? repeatBookingDetailsUrl.replace('__ID__', booking.id)
                : bookingDetailsUrl.replace('__ID__', booking.id);

            container.innerHTML += `
                <div class="border rounded-2">
                    <div class="d-flex align-items-center justify-content-between gap-1 border-bottom py-lg-3 py-2 px-sm-4 px-3">
                        <a class="fw-normal m-0 fs-14" href="${bookingUrl}" target="_blank">
                            Booking #${booking.readable_id}
                        </a>
                        <span class="fs-14 text--grey">${booking.time}</span>
                    </div>

                    <div class="p-20">
                       <div class="d-flex align-items-center gap-1 justify-content-between mb-15px">
                            <h5 class="fw-normal mb-0 text--grey fs-14">Service Date :</h5>
                            <p class="m-0 fs-13 text-dark">
                                ${booking.service_date}
                            </p>
                        </div>

                        <div class="d-flex align-items-center gap-1 justify-content-between">
                            <h5 class="fw-normal mb-0 text--grey fs-14">Service will be provided :</h5>
                            <div class="d-inline-flex badge badge-primary align-items-center gap-1 fs-13 text-dark">
                                <span class="material-symbols-outlined m-0 text-primary">
                                    location_on
                                </span>
                                At ${booking.service_location} location
                            </div>
                        </div>
                    </div>

                    <div class="d-flex align-items-center bg-light justify-content-between gap-1 py-lg-3 py-2 px-sm-4 px-3">
                        <div class="d-inline-flex badge badge-${booking.statusClass} align-items-center gap-1 fs-13">
                            ${booking.status}
                        </div>
                        <h3 class="m-0 text-primary">${booking.amount}</h3>
                    </div>
                </div>
            `;
        });
    }

    $(document).on('input', 'input[name="search"]', function () {

        let keyword = $(this).val().toString().toLowerCase().trim();

        let filtered = ALL_BOOKINGS.filter(booking => {

            let readableId = (booking.readable_id ?? '').toString().toLowerCase();
            let bookingId  = (booking.id ?? '').toString().toLowerCase();

            return (
                readableId.includes(keyword) ||
                bookingId.includes(keyword)
            );
        });

        renderBookings(filtered);
    });

    function formatOffcanvasDateParts(date) {
        const datePart = new Intl.DateTimeFormat('en-GB', {
            day: '2-digit',
            month: 'short',
            year: 'numeric'
        }).format(date);

        const hourPart = new Intl.DateTimeFormat('en-US', {
            hour: 'numeric',
            hour12: true
        }).format(date);

        return { datePart, hourPart };
    }



    $(document).on('submit', '#booking_filter_offcanvas form', function (e) {
        e.preventDefault();

        filterData = {};

        // Booking type
        const bookingType = $('input[name="booking_type"]:checked').val();
        if (bookingType && bookingType !== 'all') {
            filterData.booking_type = bookingType;
        }

        // Date range
        const startDate = $('#filter_start_date').val();
        const endDate   = $('#filter_end_date').val();

        if (startDate && endDate) {
            filterData.filter_start_date = startDate;
            filterData.filter_end_date   = endDate;

            const validEndDate = new Date(endDate);
            validEndDate.setDate(validEndDate.getDate() + 1);

            calendar.setOption('validRange', {
                start: startDate,
                end: validEndDate.toISOString().split('T')[0]
            });

            // Move calendar to start date of filter
            calendar.gotoDate(startDate);
        }

        // Booking status (multiple checkboxes)
        const statuses = [];
        $('input[name="booking_status"]:checked').each(function () {
            statuses.push($(this).val());
        });

        if (statuses.length) {
            filterData.booking_status = statuses.join(',');
        }

        // Close offcanvas
        const offcanvasEl = document.getElementById('booking_filter_offcanvas');
        bootstrap.Offcanvas.getInstance(offcanvasEl).hide();

        // Refetch calendar
        updateFilterButton();
        renderActiveFilters();

        calendar.refetchEvents();
    });

    $(document).on('reset', '#booking_filter_offcanvas form', function () {

        filterData = {};
        filterStartDate = null;
        filterEndDate = null;

        updateFilterButton();
        renderActiveFilters();

        // Remove date restriction
        calendar.setOption('validRange', null);

        // Close offcanvas
        const offcanvasEl = document.getElementById('booking_filter_offcanvas');
        bootstrap.Offcanvas.getInstance(offcanvasEl).hide();

        setTimeout(() => {
            calendar.refetchEvents();
        }, 0);
    });

    function getActiveFilterCount() {
        return Object.values(filterData).filter(v => {
            return v !== null && v !== '' && v !== undefined;
        }).length;
    }

    function updateFilterButton() {
        const count = getActiveFilterCount();
        const btn = document.querySelector('.fc-myFilter-button');

        if (!btn) return;

        // ensure relative positioning
        btn.style.position = 'relative';

        let badge = btn.querySelector('.filter-count-badge');

        if (count > 0) {
            if (!badge) {
                badge = document.createElement('span');
                badge.className = 'filter-count-badge';
                btn.appendChild(badge);
            }
          //  badge.textContent = count;
        } else {
            if (badge) badge.remove();
        }
    }

    function renderActiveFilters() {
        const container = document.getElementById('activeFilters');

        const filters = [];

        if (filterData.booking_type) {
            filters.push({
                label: 'Booking Type',
                value: filterData.booking_type
            });
        }

        if (filterData.filter_start_date && filterData.filter_end_date) {
            filters.push({
                label: 'Date',
                value: `${filterData.filter_start_date} - ${filterData.filter_end_date}`
            });
        }

        if (filterData.booking_status) {
            filters.push({
                label: 'Status',
                value: filterData.booking_status.replaceAll(',', ', ')
            });
        }

        // 🔥 UI handled fully here
        container.innerHTML = filters.length
            ? `
            <div class="filter-wrapper">
                ${filters.map(f => `
                    <span class="filter-chip">
                        <strong>${f.label}:</strong> ${f.value}
                    </span>
                `).join('')}
            </div>
        `
            : '';
    }


</script>


@endpush
