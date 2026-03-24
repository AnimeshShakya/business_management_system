@extends('adminmodule::layouts.new-master')

@section('title',translate('Language Setup'))

@section('content')
    <div class="main-content">
        <div class="container-fluid">
            <div class="page-title-wrap mb-3">
                <h2 class="page-title">{{translate('Translated_Content ')}}</h2>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                <div class="bg-warning bg-opacity-10 fs-12 p-12 text-dark rounded mb-20">
                    <div class="d-flex align-items-center gap-2">
                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_9562_195)">
                            <path d="M7 14C8.38447 14 9.73785 13.5895 10.889 12.8203C12.0401 12.0511 12.9373 10.9579 13.4672 9.67879C13.997 8.3997 14.1356 6.99224 13.8655 5.63437C13.5954 4.2765 12.9287 3.02922 11.9497 2.05026C10.9708 1.07129 9.7235 0.404603 8.36563 0.134506C7.00777 -0.13559 5.6003 0.003033 4.32122 0.532846C3.04213 1.06266 1.94888 1.95987 1.17971 3.11101C0.410543 4.26216 0 5.61553 0 7C0.0020073 8.8559 0.74015 10.6352 2.05247 11.9475C3.36479 13.2599 5.1441 13.998 7 14ZM7 2.91667C7.17306 2.91667 7.34223 2.96799 7.48612 3.06413C7.63002 3.16028 7.74217 3.29694 7.8084 3.45682C7.87462 3.61671 7.89195 3.79264 7.85819 3.96237C7.82443 4.13211 7.74109 4.28802 7.61872 4.41039C7.49635 4.53276 7.34044 4.6161 7.1707 4.64986C7.00097 4.68362 6.82504 4.66629 6.66515 4.60006C6.50527 4.53384 6.36861 4.42169 6.27246 4.27779C6.17632 4.1339 6.125 3.96473 6.125 3.79167C6.125 3.55961 6.21719 3.33705 6.38128 3.17295C6.54538 3.00886 6.76794 2.91667 7 2.91667ZM6.41667 5.83334H7C7.30942 5.83334 7.60617 5.95625 7.82496 6.17505C8.04375 6.39384 8.16667 6.69058 8.16667 7V10.5C8.16667 10.6547 8.10521 10.8031 7.99581 10.9125C7.88642 11.0219 7.73804 11.0833 7.58333 11.0833C7.42862 11.0833 7.28025 11.0219 7.17086 10.9125C7.06146 10.8031 7 10.6547 7 10.5V7H6.41667C6.26196 7 6.11358 6.93855 6.00419 6.82915C5.89479 6.71975 5.83333 6.57138 5.83333 6.41667C5.83333 6.26196 5.89479 6.11359 6.00419 6.00419C6.11358 5.8948 6.26196 5.83334 6.41667 5.83334Z" fill="#FFBB38"/>
                            </g>
                            <defs>
                            <clipPath id="clip0_9562_195">
                            <rect width="14" height="14" fill="white"/>
                            </clipPath>
                            </defs>
                        </svg>
                        <p class="fz-12">{{ translate('After change or type Translated Value or click Auto Translate button, make sure you click Save Button') }}</p>
                    </div>
                </div>
                    <div class="data-table-top d-flex align-items-center flex-wrap gap-2 justify-content-between mb-0">
                        <h5 class="text-dark fw-semibold">{{ translate('Language Content Table') }}</h5>
                        <div class="d-flex align-items-center flex-md-nowrap flex-wrap gap-xl-3 gap-2">
                            <form action="#" class="search-form search-form_style-two d-flex align-items-center gap-0 border rounded" method="GET">
                                @csrf
                                <div class="input-group search-form__input_group bg-transparent">
                                    <input type="search" class="theme-input-style search-form__input border-0  block-size-36" name="search"
                                            placeholder="{{translate('search_here')}}"
                                            value="{{ request()?->search ?? null }}">
                                </div>
                                <button type="submit" class="bg-light border-0 px-2 block-size-36 rounded-end d-flex align-items-center justify-content-center">
                                    <span class="material-symbols-outlined fz-20 opacity-75">
                                        search
                                    </span>
                                </button>
                            </form>
                            <button type="button" class="btn btn--primary rounded d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#translation-warning-modal">
                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14 4.08333V5.25C14 5.572 13.7387 5.83333 13.4167 5.83333C13.0947 5.83333 12.8333 5.572 12.8333 5.25V4.08333C12.8333 3.43992 12.3101 2.91667 11.6667 2.91667H10.4831L11.2122 3.67908C11.4357 3.91125 11.4287 4.2805 11.1959 4.50392C11.0828 4.613 10.9375 4.66667 10.7917 4.66667C10.6388 4.66667 10.486 4.60658 10.3711 4.48758L9.08075 3.14533C8.63683 2.70142 8.63683 1.96525 9.08833 1.51317L10.3711 0.179083C10.5945 -0.0530833 10.9643 -0.0600833 11.1959 0.16275C11.4281 0.386167 11.4357 0.755417 11.2122 0.987583L10.479 1.75H11.6667C12.9535 1.75 14 2.7965 14 4.08333ZM3.62892 9.51242C3.4055 9.28025 3.03625 9.27383 2.80408 9.49667C2.57192 9.72008 2.56433 10.0893 2.78775 10.3215L3.51692 11.0839H2.33333C1.68992 11.0839 1.16667 10.5607 1.16667 9.91725V8.75058C1.16667 8.428 0.905333 8.16725 0.583333 8.16725C0.261333 8.16725 0 8.428 0 8.75058V9.91725C0 11.2041 1.0465 12.2506 2.33333 12.2506H3.52042L2.78775 13.013C2.56433 13.2452 2.57133 13.6144 2.80408 13.8378C2.91725 13.9469 3.0625 14.0006 3.20833 14.0006C3.36117 14.0006 3.514 13.9405 3.62892 13.8215L4.91167 12.4868C5.36258 12.0353 5.36258 11.2992 4.91925 10.8547L3.62892 9.51242ZM7 4.66667C7 5.95525 5.95525 7 4.66667 7H2.33333C1.04475 7 0 5.95525 0 4.66667V2.33333C0 1.04475 1.04475 0 2.33333 0H4.66667C5.95525 0 7 1.04475 7 2.33333V4.66667ZM5.54167 2.10933C5.54167 1.911 5.38067 1.75 5.18233 1.75H3.86575V1.526C3.86575 1.32767 3.70475 1.16667 3.50642 1.16667H3.49417C3.29583 1.16667 3.13483 1.32767 3.13483 1.526V1.75H1.81767C1.61933 1.75 1.45833 1.911 1.45833 2.10933V2.12158C1.45833 2.31992 1.61933 2.48092 1.81767 2.48092H4.263C4.19825 3.04267 3.98067 3.73567 3.50292 4.27233C3.34192 4.0915 3.20717 3.89433 3.09925 3.689C3.03742 3.57117 2.91375 3.49942 2.78133 3.49942C2.51067 3.49942 2.33275 3.78642 2.45875 4.02617C2.59 4.277 2.751 4.51792 2.94292 4.73783C2.6285 4.92917 2.24933 5.06392 1.78967 5.10825C1.603 5.12633 1.45833 5.27917 1.45833 5.46642V5.47867C1.45833 5.69158 1.64267 5.85667 1.85442 5.83683C2.52292 5.77442 3.06717 5.55392 3.50642 5.24067C3.94333 5.55158 4.48117 5.77325 5.14442 5.83683C5.35675 5.85725 5.54108 5.69217 5.54108 5.47925V5.467C5.54108 5.28267 5.40108 5.12692 5.21733 5.10942C4.75533 5.06567 4.37617 4.92858 4.06 4.73667C4.6375 4.07458 4.92625 3.22525 4.99742 2.4815H5.18175C5.38008 2.4815 5.54108 2.3205 5.54108 2.12217V2.10992L5.54167 2.10933ZM14 9.33333V11.6667C14 12.9552 12.9552 14 11.6667 14H9.33333C8.04475 14 7 12.9552 7 11.6667V9.33333C7 8.04475 8.04475 7 9.33333 7H11.6667C12.9552 7 14 8.04475 14 9.33333ZM12.1357 12.334L11.3406 8.86433C11.2782 8.59367 11.1055 8.3475 10.8494 8.24017C10.3133 8.01558 9.76733 8.33058 9.65008 8.83575L8.82583 12.3317C8.76517 12.5877 8.96 12.8333 9.22308 12.8333C9.41208 12.8333 9.57658 12.7032 9.62033 12.5189L9.78017 11.8417H11.1854L11.34 12.5166C11.3826 12.7021 11.5477 12.8333 11.7378 12.8333H11.739C12.0009 12.8333 12.1952 12.5895 12.1368 12.334H12.1357ZM10.4918 8.98333C10.4697 8.98333 10.4504 8.9985 10.4457 9.02008L9.97267 11.025H10.9976L10.5385 9.02008C10.5332 8.9985 10.514 8.98333 10.4918 8.98333Z" fill="white"/>
                                </svg>
                                {{ translate('Translate All') }}
                            </button>
                        </div>
                    </div>
                    <input type="hidden" value="0" id="translating-count">
                </div>
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table id="example" class="table table-bordered align-middle">
                            <thead class="text-nowrap bg-transparent">
                            <tr>
                                <th>{{translate('SL')}}</th>
                                <th>{{translate('Current_Value')}}</th>
                                <th>{{translate('Translated_Value')}}</th>
                                @can('configuration_update')
                                    <th>{{translate('Auto_Translate')}}</th>
                                    <th>{{translate('Update')}}</th>
                                @endcan
                            </tr>
                            </thead>
                            <tbody>
                            @php($count=0)
                            @foreach($fullData as $key=>$value)
                                @php($count++)
                                <tr id="lang-{{$count}}">
                                    <td>{{ $count+$fullData->firstItem() -1}}</td>
                                    <td>
                                        <input type="text" name="key[]"
                                                value="{{$key}}" hidden>
                                        <label>{{$key }}</label>
                                    </td>
                                    <td class="lan-key-name">
                                        <input type="text" class="form-control" name="value[]"
                                                id="value-{{$count}}" value="{{$fullData[$key]}}">
                                    </td>
                                    @can('configuration_update')
                                        <td>
                                            <button class="btn btn--light-primary rounded btn-outline-primary p-2 w-35px h-35px d-center mx-auto auto-translate-data"
                                                    data-key="{{$key}}"
                                                    data-id="{{$count}}">
                                                <span class="material-icons m-0">translate</span>
                                            </button>
                                        </td>
                                        <td>
                                            <button class="btn btn--primary rounded update-language-data w-35px h-35px p-2 d-center" type="button"
                                                    data-key="{{urlencode($key)}}"
                                                    data-id="{{$count}}">
                                                <span class="material-icons m-0">save</span>
                                            </button>
                                        </td>
                                    @endcan
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @if(count($fullData) !== 0)
                            <hr>
                        @endif
                        <div class="page-area">
                            <div class="d-flex justify-content-end">
                                {!! $fullData->withQueryString()->links() !!}
                            </div>
                        </div>
                        @if(count($fullData) === 0)
                            <div class="empty--data text-center">
                                <h5>
                                    {{translate('no_data_found')}}
                                </h5>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade language-complete-modal" id="complete-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body text-center px-5">
                        <button type="button" class="btn-close location_reload"></button>
                        <div class="py-5">
                            <div class="mb-4">
                                <img src="{{asset('/public/assets/admin-module/img/language-complete.png')}}" alt="">
                            </div>
                            <h4 class="mb-3">
                                {{ translate('Your_file_has_been_successfully_translated') }}
                            </h4>
                            <p class="mb-4 text-9EADC1">
                                {{translate(' Your all selected items that you wanted to translate those successfully translated &
                                do not forget to click the save button, otherwise file will not be translated.')}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade language-warning-modal" id="warning-modal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="d-flex gap-3 align-items-start">
                            <img src="{{asset('/public/assets/admin-module/img/invalid-icon.png')}}" alt="">
                            <div class="w-0 flex-grow-1">
                                <h3>{{ translate('Warning!') }}</h3>
                                <span class="pt-2">{{ translate('Translating in progress. Are you sure, want to close this tab?')}}</span>
                                <p  class="pb-2">{{ translate('If you close the tab, the progress made will be saved but remaining content will not be translated.') }}</p>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end gap-3">
                            <button type="button" class="btn btn-secondary" id="cancelBtn">{{ translate('Cancel') }}</button>
                            <button type="button" class="btn btn--primary location_reload" id="close-tab" >{{ translate('Yes,_Close') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="translation-warning-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body modal-body-color-border">
                        <div class="d-flex gap-3 mb-3">
                            <div>
                                <img src="{{asset('/public/assets/admin-module/img/invalid-icon.png')}}" alt="">
                            </div>
                            <div class="w-0 flex-grow-1">
                                <h3 class="mb-2">{{ translate('warning') }}!</h3>
                                <p class="mb-0">
                                    {{ translate('are_you_sure,_want_to_start_auto_translation') }} ?
                                </p>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end gap-3">
                            @if(env('APP_ENV') != 'demo')
                                <button type="button" class="btn btn--primary rounded" data-bs-dismiss="modal" id="translating-modal-start">
                                    {{ translate('Continue') }}
                                </button>
                            @else
                                <button type="button" class="btn btn-primary rounded demo_check" data-bs-dismiss="modal">
                                    {{ translate('Continue') }}
                                </button>
                            @endif

                            <button type="button" class="btn btn--secondary rounded" data-bs-dismiss="modal">
                                {{ translate('cancel') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade language-complete-modal" id="translating-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body text-center px-5">
                        <button type="button" class="btn-close" id="translateCancel"></button>
                        <div class="py-5 px-sm-2">
                            <div class="progress-circle-container mb-4">
                                <img width="80px" src="{{asset('/public/assets/admin-module/img/loader-icon.gif')}}" alt="{{translate('progress')}}">
                            </div>
                            <h4 class="mb-2">{{ translate('Translating_may_take_up_to') }} <span id="time-data"> {{ translate('Hours') }}</span></h4>
                            <p class="mb-4">
                                {{ translate('Be patient, don’t close or terminate your tab or browser.') }}
                            </p>
                            <div class="max-w-215px mx-auto">
                                <div class="d-flex flex-wrap mb-1 justify-content-between font-semibold text--title">
                                    <span>{{ translate('in_Progress') }}</span>
                                    <span class="translating-modal-success-rate">0.4%</span>
                                </div>
                                <div class="upload--progress progress mb-3 h-5px">
                                    <div class="progress-bar bg-success rounded-pill translating-modal-success-bar" style="width: 0.4%"></div>
                                </div>
                            </div>
                            <p class="mb-4 text-9EADC1">
                                {{ translate('If you close now, the progress made so far will be saved. The remaining content will not be translated.') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function () {
            $('#translating-modal-start').on('click', function() {
                autoTranslationFunction();
            });

            $(document).on('click', '.location_reload', function () {
                $(window).off('beforeunload');
                window.location.reload();
            });


            $(document).on('click', '.close-tab', function () {
                $('#translating-modal').removeClass('prevent-close');
                window.close();
            });

            $(document).on('click', '#translateCancel', function () {
                $('#warning-modal').modal('show');
                $('#translating-modal').css({
                    opacity: "0.3",
                    pointerEvents: "none"
                })
            });

            $(document).on('click', '#cancelBtn', function () {
                $('#warning-modal').modal('hide');
                $('#translating-modal').css({
                    opacity: "1",
                    pointerEvents: ""
                })
            });

            function autoTranslationFunction() {
                var translatingCount = $('#translating-count').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "{{ route('admin.language.auto-translate-all', [$lang]) }}",
                    method: 'GET',
                    data: { translating_count: translatingCount },
                    beforeSend: function () {
                        $('#translating-modal').addClass('prevent-close');
                        $('#translating-modal').modal('show');
                    },
                    success: function (response) {
                        if (response.data === 'data_prepared') {
                            $('#translating-count').val(response.total);
                            autoTranslationFunction();
                        } else if (response.data === 'translating' && response.status === 'pending') {
                            if ($('#translating-count').val() == 0) {
                                $('#translating-count').val(response.total);
                            }

                            updateProgress(response.percentage);
                            updateTimeRemaining(response.hours, response.minutes, response.seconds);

                            autoTranslationFunction();
                        } else if ((response.data === 'translating' && response.status === 'done') ||
                            response.data === 'success' || response.data === 'error') {
                            $('#translating-modal').removeClass('prevent-close');
                            $('#translating-modal').addClass('d-none');
                            $('#translating-count').val(0);

                            console.log('gfhfhfgh')
                            if (response.data !== 'error') {
                                $('#complete-modal').modal('show');
                            } else {
                                toastr.error(response.message);
                            }
                        }
                    },
                    complete: function () {
                    }
                });
            }

            function updateProgress(percentage) {
                percentage = Math.max(1, Math.round(percentage));
                $('.translating-modal-success-rate').html(percentage + '%');
                $('.translating-modal-success-bar').css('width', percentage + '%');
                // setProgress(percentage);
            }

            function updateTimeRemaining(hours, minutes, seconds) {
                let timeString = '';
                if (hours > 0) {
                    timeString = hours + ' {{ translate('hours') }} ' + minutes + ' {{ translate('min') }}';
                } else if (minutes > 0) {
                    timeString = minutes + ' {{ translate('min') }} ' + seconds + ' {{ translate('seconds') }}';
                } else if (seconds > 0) {
                    timeString = seconds + ' {{ translate('seconds') }}';
                }
                $('#time-data').html(timeString);
            }

            const modal = document.getElementById('translating-modal');
            window.addEventListener('beforeunload', (event) => {
                if (modal.classList.contains('prevent-close')) {
                    event.preventDefault();
                    event.returnValue = '';
                } else {
                    $('#translating-modal').modal('hide');
                }
            });

            // function setProgress(percentage) {
            //     const circle = $('.progress-circle .progress');
            //     const radius = circle.attr('r');
            //     const circumference = 2 * Math.PI * radius;
            //     const offset = circumference - (percentage / 100 * circumference);
            //
            //     circle.css('stroke-dashoffset', offset);
            // }
            // setTimeout(() => setProgress(87), 1000);
        });
    </script>


    <script>
        "use strict";

        $(".update-language-data").on('click', function () {
            let key = $(this).data('key');
            let id = $(this).data('id');
            let value = $('#value-' + id).val()
            update_lang(key, value);
        })

        function update_lang(key, value) {
            console.log(key);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('admin.language.translate-submit',[$lang])}}",
                method: 'POST',
                data: {
                    key: key,
                    value: value
                },

                beforeSend: function () {
                    $('.preloader').show();
                },
                success: function (response) {
                    toastr.success('{{translate('text_updated_successfully')}}');
                },
                complete: function () {
                    $('.preloader').hide();
                },
            });
        }

        $(".auto-translate-data").on('click', function () {
            let key = $(this).data('key');
            let id = $(this).data('id');
            auto_translate(key, id);
        })

        function auto_translate(key, id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('admin.language.auto-translate',[$lang])}}",
                method: 'POST',
                data: {
                    key: key
                },
                beforeSend: function () {
                    $('.preloader').show();
                },
                success: function (response) {
                    toastr.success('{{translate('Key translated successfully')}}');
                    console.log(response.translated_data)
                    $('#value-' + id).val(response.translated_data);
                },
                complete: function () {
                    $('.preloader').hide();
                },
            });
        }
    </script>
@endpush
