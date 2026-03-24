@extends('adminmodule::layouts.new-master')

@section('title',translate('create_offline_payment'))

@section('content')
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form action="{{route('admin.configuration.offline-payment.store')}}" method="POST">
                        @csrf
                        <div class="d-flex align-items-center justify-content-between flex-sm-nowrap flex-wrap gap-3 mb-20">
                            <div>
                                <h1 class="page-title mb-2">{{translate('Payment Methods Setup')}}</h1>
                                <a href="{{ route('admin.configuration.third-party', ['webPage' => 'payment_config', 'type' => 'offline_payment'] ) }}" class="d-flex align-items-center gap-2 text-primary fz-14">
                                    <i class="material-symbols-outlined">arrow_back</i> {{ translate('Back to Offline Payment Methods') }}
                                </a>
                            </div>
                            <button type="button" class="rounded transition text-nowrap fz-12 fw-semibold btn-primary__outline btn d-flex align-items-center gap-1 py-2 px-3" data-bs-toggle="offcanvas" data-bs-target="#offline-offcanvas_preview">
                                <span class="material-symbols-outlined">visibility</span> {{ translate('Section View') }}
                            </button>
                        </div>
                        <div class="card mb-20">
                            <div class="card-body p-20">
                                <div class="d-flex align-items-center flex-wrap justify-content-between gap-2 mb-20">
                                    <div class="max-w-700">
                                        <h3 class="page-title mb-1">{{translate('payment_information')}}</h3>
                                        <p class="fz-12">{{translate('Add relevant input fields for customers to fill-up after completing the offline payment . You can add multiple input fields & place holders and define them as ‘Is Required’, so customers cannot complete offline payment without adding that information.')}}</p>
                                    </div>
                                    <button class="btn btn--primary rounded d-flex align-items-center gap-1" id="add-more-field-payment">
                                        <span class="absolute-white-bg rounded-full d-center text-primary w-14 h-14">+</span> {{translate('Add_new_field')}}
                                    </button>
                                </div>
                                <div class="row gy-3">
                                    <div class="col-sm-12">
                                        <div class="body-bg rounded p-20">
                                            <div class="mb-2 text-dark d-flex align-items-center gap-1">{{translate('Payment method name')}}
                                                <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    title="{{translate('Add payment method name.')}}"
                                                >info</i>
                                            </div>
                                            <input type="text" class="form-control" name="method_name" id="method_name"
                                                   placeholder="PayPal" value="" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 d-flex flex-column gap-3">
                                        <div class="d-flex flex-column gap-3" id="custom-field-section-payment"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body p-20">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-20">
                                    <div class="max-w-700">
                                        <h3 class="page-title mb-1">{{translate('Required Information from Customer')}}</h3>
                                        <p class="fz-12">{{translate('Add required input fields for customers to complete offline payments. Mark fields as ‘Required’ to ensure necessary info is provided.')}}</p>
                                    </div>
                                    <button class="btn btn--primary rounded d-flex align-items-center gap-1" id="add-more-field-customer">
                                        <span class="absolute-white-bg rounded-full d-center text-primary w-14 h-14">+</span> {{translate('Add_new_field')}}
                                    </button>
                                </div>
                                <div class="row gy-3">
                                    <div class="col-sm-6 col-lg-4">
                                        <div class="form-floating">
                                            <textarea class="form-control" name="payment_note" id="payment_note"
                                                      placeholder="Select Payment Note" disabled></textarea>
                                            <label for="payment_note">{{translate('payment_note')}} *</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex flex-column gap-3" id="custom-field-section-customer">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end trans3 mt-4">
                            <div class="d-flex justify-content-sm-end justify-content-center gap-2 gap-sm-3 flex-grow-1 flex-grow-sm-0 bg-white action-btn-wrapper trans3">
                                <div class="d-flex gap-3 justify-content-end">
                                    <button type="reset" class="btn btn--secondary rounded">{{translate('Reset')}}</button>
                                    <button type="submit" class="btn btn--primary d-flex align-items-center gap-2 rounded demo_check">
                                        <img src="{{ asset('public/assets/admin-module/img/icons/save-icon.svg') }}" alt="save icon">
                                        {{translate('Save Information')}}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Offline Offcanvas -->
    <form action="" method="post" id="update-form-submit">
        @csrf
        <div class="offcanvas offcanvas-end offcanvas-cus-sm" tabindex="-1" id="offline-offcanvas_preview" aria-labelledby="testimonial-landing-pageLabel">
            <div class="offcanvas-header py-md-4 py-3">
                <h3 class="mb-0">{{translate('Offline Payment')}}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body bg-white">
                <div class="max-w-300 mx-auto">
                    <div class="text-center mb-20">
                        <img width="100" src="{{asset('public/assets/admin-module/img/offline_payment.png')}}" alt="" class="mb-2">
                        <p class="fz-12 mb-2" {{translate('This view is from the user app.')}} class="d-none d-sm-block"> {{translate('This is how customer will see in the app')}}</p>
                        <h4>{{translate('Amount : xxx')}}</h4>
                    </div>
                    <div class="rounded cus-shadow2 p-16 mb-20">
                        <div class="d-flex align-items-center justify-content-between mb-15">
                            <h4>{{translate('Bank Info')}}</h4>
                            <button type="button" class="d-flex align-items-center text-primary border-0 gap-1 bg-primary bg-opacity-10 py-1 px-3 rounded fz-10">
                                Pay on this account  <span class="material-symbols-outlined fz-14">check_circle</span>
                            </button>
                        </div>
                        <ul class="d-flex flex-column gap-sm-2 gap-1 list-inline">
                            <li class="d-flex align-items-center gap-2 fz-12">
                                Holder Name : <span class="text-dark">Jhone Doe</span>
                            </li>
                            <li class="d-flex align-items-center gap-2 fz-12">
                                Branch : <span class="text-dark">Branch-1</span>
                            </li>
                            <li class="d-flex align-items-center gap-2 fz-12">
                                A/C No : <span class="text-dark">4857394057234</span>
                            </li>
                            <li class="d-flex align-items-center gap-2 fz-12">
                                Bank Name : <span class="text-dark">Abc Bank</span>
                            </li>
                        </ul>
                    </div>
                    <h4 class="mb-10">{{translate('Payment Info')}}</h4>
                    <div class="body-bg rounded p-16 d-flex flex-column gap-4">
                        <div>
                            <div class="mb-10 text-dark">{{translate('Payment By')}}
                                <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    title="{{translate('Enter the name of the person making the payment')}}"
                                >info</i>
                            </div>
                            <input type="text" placeholder="Ex : Devid Miler" class="form-control" name="" value="" readonly>
                        </div>
                        <div>
                            <div class="mb-10 text-dark">{{translate('Bank Name')}}
                                <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    title="{{translate('Add Bank name')}}"
                                >info</i>
                            </div>
                            <input type="text" placeholder="Ex : 66587698780" class="form-control" name="" value="" readonly>
                        </div>
                        <div>
                            <div class="mb-10 text-dark">{{translate('A/C No')}}
                                <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    title="{{translate(' Add A/C number')}}"
                                >info</i>
                            </div>
                            <input type="text" placeholder="Ex : 66587698780" class="form-control" name="" value="" readonly>
                        </div>
                        <div>
                            <div class="mb-10 text-dark">{{translate('Payment Note ')}}
                                <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    title="{{translate('Write a payment note')}}"
                                >info</i>
                            </div>
                            <textarea type="text" class="form-control" name="" placeholder="Write a payment note" required="" readonly rows="5"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="modal fade" id="sectionViewModal" tabindex="-1" aria-labelledby="sectionViewModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex align-items-center flex-column gap-3 text-center">
                        <h3>{{translate('Offline Payment')}}</h3>
                        <img width="100" src="{{asset('public/assets/admin-module/img/offline_payment.png')}}" alt="">
                        <p class="text-muted">{{translate('This view is from the user app.')}} <br
                                class="d-none d-sm-block"> {{translate('This is how customer will see in the app')}}</p>
                    </div>

                    <div class="rounded p-4 mt-3" id="offline_payment_top_part">
                        <div class="d-flex justify-content-between gap-2 mb-3">
                            <h4 id="payment_modal_method_name"><span></span></h4>
                            <div class="text-primary d-flex align-items-center gap-2">
                                {{translate('Pay on this account')}}
                                <span class="material-icons">check_circle</span>
                            </div>
                        </div>

                        <div class="d-flex flex-column gap-2" id="methodNameDisplay">

                        </div>
                        <div class="d-flex flex-column gap-2" id="displayDataDiv">

                        </div>
                    </div>

                    <div class="rounded p-4 mt-3 mt-4" id="offline_payment_bottom_part">
                        <h2 class="text-center mb-4">{{translate('Amount')}} : xxx</h2>

                        <h4 class="mb-3">{{translate('Payment Info')}}</h4>
                        <div class="d-flex flex-column gap-3 mb-3" id="customer-info-display-div">

                        </div>
                        <div class="d-flex flex-column gap-3">
                    <textarea name="payment_note" id="payment_note" class="form-control"
                              readonly rows="10" placeholder="Note"></textarea>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-3 mt-3">
                        <button type="button" class="btn btn--secondary">{{translate('Close')}}</button>
                        <button type="button" class="btn btn--primary">{{translate('Submit')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')

    <script>
        "use strict"

        function openModal(contentArgument) {
            if (contentArgument === "bkashInfo") {
                $("#sectionViewModal #offline_payment_top_part").addClass("active");
                $("#sectionViewModal #offline_payment_bottom_part").removeClass("active");

                let methodName = $('#method_name').val();

                if (methodName !== '') {
                    $('#payment_modal_method_name').text(methodName + ' ' + 'Info');
                }

                function extractPaymentData() {
                    let data = [];

                    $('.field-row-payment').each(function (index) {
                        console.log('modal')
                        let title = $(this).find('input[name="title[]"]').val();
                        let dataValue = $(this).find('input[name="data[]"]').val();
                        data.push({title: title, data: dataValue});
                    });

                    return data;
                }

                let extractedData = extractPaymentData();


                function displayPaymentData() {
                    let displayDiv = $('#displayDataDiv');
                    let methodNameDisplay = $('#methodNameDisplay');
                    methodNameDisplay.empty();
                    displayDiv.empty();

                    let paymentElement = $('<span>').text('Payment Method');
                    let payementDataElement = $('<span>').html(methodName);

                    let dataRow = $('<div>').addClass('d-flex gap-3 align-items-center mb-2');
                    dataRow.append(paymentElement).append($('<span>').text(':')).append(payementDataElement);


                    methodNameDisplay.append(dataRow);

                    extractedData.forEach(function (item) {
                        let titleElement = $('<span>').text(item.title);
                        let dataElement = $('<span>').html(item.data);

                        let dataRow = $('<div>').addClass('d-flex gap-3 align-items-center');

                        if (item.title !== '') {
                            dataRow.append(titleElement).append($('<span>').text(':')).append(dataElement);
                            displayDiv.append(dataRow);
                        }

                    });
                }

                displayPaymentData();

                //customer info
                function extractCustomerData() {
                    let data = [];

                    $('.field-row-customer').each(function (index) {
                        let fieldName = $(this).find('input[name="field_name[' + index + ']"]').val();
                        let placeholder = $(this).find('input[name="placeholder[' + index + ']"]').val();
                        let isRequired = $(this).find('input[name="is_required[' + index + ']"]').prop('checked');
                        data.push({fieldName: fieldName, placeholder: placeholder, isRequired: isRequired});
                    });

                    return data;
                }

                let extractedCustomerData = extractCustomerData();
                $('#customer-info-display-div').empty();

                $.each(extractedCustomerData, function (index, item) {
                    let isRequiredAttribute = item.isRequired ? 'required' : '';
                    let displayHtml = `
                        <input type="text" class="form-control" name="payment_by" readonly
                        id="payment_by" placeholder="${item.placeholder}"  ${isRequiredAttribute}>
                    `;
                    $('#customer-info-display-div').append(displayHtml);
                });

            } else {
                $("#sectionViewModal #offline_payment_top_part").removeClass("active");
                $("#sectionViewModal #offline_payment_bottom_part").addClass("active");

                let methodName = $('#method_name').val();

                if (methodName !== '') {
                    $('#payment_modal_method_name').text(methodName + ' ' + 'Info');
                }

                function extractPaymentData() {
                    let data = [];

                    $('.field-row-payment').each(function (index) {
                        console.log('modal')
                        let title = $(this).find('input[name="title[]"]').val();
                        let dataValue = $(this).find('input[name="data[]"]').val();
                        data.push({title: title, data: dataValue});
                    });

                    return data;
                }

                let extractedData = extractPaymentData();


                function displayPaymentData() {
                    let displayDiv = $('#displayDataDiv');
                    let methodNameDisplay = $('#methodNameDisplay');
                    methodNameDisplay.empty();
                    displayDiv.empty();

                    let paymentElement = $('<span>').text('Payment Method');
                    let payementDataElement = $('<span>').html(methodName);

                    let dataRow = $('<div>').addClass('d-flex gap-3 align-items-center mb-2');
                    dataRow.append(paymentElement).append($('<span>').text(':')).append(payementDataElement);


                    methodNameDisplay.append(dataRow);

                    extractedData.forEach(function (item) {
                        let titleElement = $('<span>').text(item.title);
                        let dataElement = $('<span>').html(item.data);

                        let dataRow = $('<div>').addClass('d-flex gap-3 align-items-center');

                        if (item.title !== '') {
                            dataRow.append(titleElement).append($('<span>').text(':')).append(dataElement);
                            displayDiv.append(dataRow);
                        }

                    });
                }

                displayPaymentData();

                //customer info
                function extractCustomerData() {
                    let data = [];

                    $('.field-row-customer').each(function (index) {
                        let fieldName = $(this).find('input[name="field_name[' + index + ']"]').val();
                        let placeholder = $(this).find('input[name="placeholder[' + index + ']"]').val();
                        let isRequired = $(this).find('input[name="is_required[' + index + ']"]').prop('checked');
                        data.push({fieldName: fieldName, placeholder: placeholder, isRequired: isRequired});
                    });

                    return data;
                }

                let extractedCustomerData = extractCustomerData();
                $('#customer-info-display-div').empty();

                $.each(extractedCustomerData, function (index, item) {
                    let isRequiredAttribute = item.isRequired ? 'required' : '';
                    let displayHtml = `
                        <input type="text" class="form-control" name="payment_by" readonly
                            id="payment_by" placeholder="${item.placeholder}"  ${isRequiredAttribute}>
                    `;
                    $('#customer-info-display-div').append(displayHtml);
                });
            }

            $("#sectionViewModal").modal("show");
        }

        $(document).ready(function () {
            $("#bkashInfoModalButton").on('click', function () {
                console.log("something");
                let contentArgument = "bkashInfo";
                openModal(contentArgument);
            });
            $("#paymentInfoModalButton").on('click', function () {
                let contentArgument = "paymentInfo";
                openModal(contentArgument);
            });
        });
    </script>


    <script>
        function remove_field(fieldRowId) {
            $(`#field-row-customer--${fieldRowId}`).remove();
            counter--;
        }

        function remove_field_payment(fieldRowId) {
            $(`#field-row-payment--${fieldRowId}`).remove();
            counterPayment--;
        }

        jQuery(document).ready(function ($) {
            var counter = 0;
            var counterPayment = 0;

            $(document).on('click', '.remove-field-btn', function () {
                var counter = $(this).data('counter');
                remove_field(counter);
            });

            $(document).on('click', '.remove-field-payment-btn', function () {
                var counter = $(this).data('counter-payment');
                remove_field_payment(counter);
            });

            $('#add-more-field-customer').on('click', function (event) {
                if (counter < 14) {
                    event.preventDefault();

                    $('#custom-field-section-customer').append(
                        `<div id="field-row-customer--${counter}" class="field-row-customer body-bg rounded p-20 position-relative">
                            <div class="row gy-3 align-items-center">
                                <div class="col-md-4">
                                    <div class="">
                                        <div class="mb-2 text-dark d-flex align-items-center gap-1">{{translate('input_field_name')}}
                                        </div>
                                        <input type="text" class="form-control" name="field_name[]"
                                               placeholder="Select Field Name" value="" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="">
                                        <div class="mb-2 text-dark d-flex align-items-center gap-1">{{translate('placeholder')}}
                                        </div>
                                        <input type="text" class="form-control" name="placeholder[]"
                                               placeholder="Select placeholder" value="" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="d-flex justify-content-between gap-2 align-items-center pt-4 mt-1">
                                        <div class="form-check d-flex align-items-center gap-1">
                                            <input class="form-check-input" type="checkbox" value="1" name="is_required[]" id="flexCheckDefault__${counter}" checked>
                                            <label class="form-check-label" for="flexCheckDefault__${counter}">
                                                {{translate('Is Required')}}
                                            </label>
                                        </div>

                                        </div>
                                    </div>
                                    <span class="btn btn--danger offline-delete-icon position-absolute top-0 end-3 w-30 h-30 p-0 remove-field-btn rounded-1 d-center" data-counter="${counter}">
                                        <i class="material-symbols-outlined m-0 fz-20">delete</i>
                                    </span>
                                </div>
                        </div>`
                    );

                    $(".js-select").select2();

                    counter++;
                } else {
                    Swal.fire({
                        title: '{{translate('Reached maximum')}}',
                        confirmButtonText: '{{translate('ok')}}',
                    });
                }
            })

            $('#add-more-field-payment').on('click', function (event) {
                if (counterPayment < 14) {
                    event.preventDefault();

                    $('#custom-field-section-payment').append(
                        `<div id="field-row-payment--${counterPayment}" class="field-row-payment body-bg rounded p-20">
                            <div class="row gy-3">
                                <div class="col-md-4">
                                    <div class="">
                                        <div class="mb-2 text-dark d-flex align-items-center gap-1">{{translate('Title')}}
                                        </div>
                                        <input type="text" class="form-control" name="title[]" id="" placeholder="Select field name" value="" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="">
                                        <div class="mb-2 text-dark d-flex align-items-center gap-1">{{translate('Data')}}
                                        </div>
                                        <input type="text" class="form-control" name="data[]" id="" placeholder="Select field name" value="" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="d-flex justify-content-end">
                                        <span class="btn btn--danger w-30 h-30 p-0 remove-field-payment-btn rounded-1 d-center" data-counter-payment="${counterPayment}">
                                            <i class="material-symbols-outlined m-0 fz-20">delete</i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>`
                    );

                    $(".js-select").select2();

                    counterPayment++;
                } else {
                    Swal.fire({
                        title: '{{translate('Reached maximum')}}',
                        confirmButtonText: '{{translate('ok')}}',
                    });
                }
            })

            $('form').on('reset', function (event) {
                if (counter > 1) {
                    $('#custom-field-section-payment').html("");
                    $('#custom-field-section-customer').html("");
                    $('#method_name').val("");
                    $('#payment_note').val("");
                }

                counter = 1;
            })
        });
    </script>

@endpush
