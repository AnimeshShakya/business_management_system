@extends('providermanagement::layouts.new-master')

@section('title',translate('business_settings'))

@section('content')
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-wrap mb-3">
                        <h2 class="page-title">{{translate('Payment_Information')}}</h2>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade active show">
                            <div class="card card-body mb-3">
                                <div class="mb-4">
                                    <h3 class="mb-1">{{translate('Payment_Information')}}</h3>
                                    <p class="fz-12 mb-0">
                                        {{translate('Please add or update your payment details accurately to ensure timely and successful withdrawals.')}}
                                    </p>
                                </div>
                                <div class="bg-warning d-flex align-items-center bg-opacity-10 gap-2 p-12 lh-1 rounded text-dark">
                                    <i class="fi fi-sr-info text-warning"></i>
                                    <p class="fz-12">{{ translate('When you add or edit payment info please make sure all data are correct. Other wise you don’t receive any payment.') }}</p>
                                </div>
                            </div>
                            <div class="card card-body">
                                <div class="data-table-top mb-20 d-flex align-items-center flex-wrap gap-xl-3 gap-2 justify-content-between">
                                    <h4 class="fw-bold text-dark flex-grow-1">
                                        {{ translate('Payment Method list') }} <span class="opacity-75">{{ $methods->total() }}</span>
                                    </h4>
                                    <form action="{{ url()->current() }}" class="search-form search-form_style-two d-flex align-items-center gap-0 border rounded"
                                          method="GET">
                                        <div class="input-group search-form__input_group bg-transparent">
                                            <input type="search" class="theme-input-style search-form__input border-0  block-size-36" name="search"
                                                   placeholder="Search here" value="{{ request('search') }}">
                                        </div>
                                        <button type="submit"
                                                class="bg-light border-0 text-dark px-12 block-size-36 rounded-end d-flex align-items-center justify-content-center">
                                            <i class="fi fi-rr-search fz-12 opacity-75"></i>
                                        </button>
                                    </form>
                                    <a href="#" class="btn btn--primary" data-bs-toggle="offcanvas" data-bs-target="#add_payment_info_offcanvas">
                                        <i class="fi fi-sr-add"></i>
                                        {{ translate('Add Payment Info') }}
                                    </a>
                                </div>
                                <div class="table-responsive">
                                    <table id="example" class="table align-middle text-dark">
                                        <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>{{ translate('Withdraw Methods') }}</th>
                                            <th>{{ translate('Payment Info') }}</th>
                                            <th class="text-center">{{ translate('Status') }}</th>
                                            <th class="text-center">{{ translate('Action') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($methods as $key => $method)
                                            <tr>
                                                <td>{{ $methods->firstItem()+$key }}</td>
                                                <td>
                                                    {{ $method->method_name }}
                                                    @if($method->is_default == 1)
                                                        <span class="badge badge-info font-weight-light fz-10">{{ translate('default') }}</span>

                                                    @endif
                                                </td>
                                                <td>
                                                    @foreach($method->method_field_data ?? [] as $key => $value)
                                                        <div class="d-flex gap-2">
                                                            <span class="w-100px text-capitalize">{{ str_replace('_', ' ', $key) }}</span>:
                                                            <span>{{ $value ?? 'N/A' }}</span>
                                                        </div>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <label class="switcher" data-bs-toggle="modal"
                                                               data-bs-target="#deactivateAlertModal">
                                                            <input class="switcher_input status-update" type="checkbox"  {{ $method->is_default == 1 ? 'disabled' : '' }}
                                                                   data-route="{{route('provider.settings.payment-information.status-update', [$method->id])}}"
                                                                   data-id="{{ $method->id }}"
                                                                   data-title="{{ $method->is_active == 1 ? 'Do you want to '. $method->method_name .' status OFF' : 'Do you want to '. $method->method_name .' status ON' }}"
                                                                   data-description="{{ $method->is_active == 1 ? 'If you turn status off for '. $method->method_name .' it will not show in withdraw methods dropdown list.' : 'If you turn status on for '. $method->method_name .' it will show in withdraw methods dropdown list.' }}"
                                                                   data-image="{{ $method->is_active == 1 ? asset('public/assets/admin-module/img/icons/status-off.png') : asset('public/assets/admin-module/img/icons/status-on.png') }}"
                                                                {{ $method->is_active == 1 ? 'checked' : '' }}>
                                                            <span class="switcher_control {{ $method->is_default == 1 ? 'disabled' : '' }}"></span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center">
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-outline-info action-btn rounded transition lh-1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="fi fi-rr-menu-dots-vertical m-0 fs-12 top-02"></i>
                                                            </button>
                                                            <ul class="dropdown-menu cus-shadow2 py-3 dropdown-menu-right">
                                                                @if($method->is_default == 0)
                                                                    <a href="{{ route('provider.settings.payment-information.default-status-update', [$method->id])}}" class="dropdown-item mb-1 d-flex align-items-center gap-2 fz-14 text-dark" type="button">
                                                                        <i class="fi fi-rr-clock-three"></i> {{ translate('Mark As Default') }}
                                                                    </a>
                                                                @endif
                                                                <button class="dropdown-item mb-1 d-flex align-items-center gap-2 fz-14 text-dark edit-payment-method" type="button"
                                                                        data-id="{{ $method->id }}">
                                                                    <i class="fi fi-rr-pencil"></i> {{ translate('Edit') }}
                                                                </button>
                                                                @if($method->is_default == 0)
                                                                        <button type="button"
                                                                                class="dropdown-item d-flex align-items-center gap-2 fz-14 text-dark trigger-confirmation"
                                                                                data-id="delete-{{$method->id}}"
                                                                                data-title="{{ translate('are you sure') }}?"
                                                                                data-message="Want to delete {{ $method->method_name }} payment information?"
                                                                                data-action="delete">
                                                                            <i class="fi fi-rr-trash"></i> {{ translate('Delete') }}
                                                                        </button>
                                                                @endif
                                                            </ul>

                                                            <form action="{{ route('provider.settings.payment-information.delete', [$method->id]) }}"
                                                                  method="post"
                                                                  id="delete-{{$method->id}}"
                                                                  class="hidden">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="text-center bg-white  pt-5 pb-5" colspan="7">
                                                    <div class="d-flex flex-column gap-2">
                                                        <img width="50" height="50" src="{{ asset('public/assets/provider-module/img/icons/no-payment-add.png') }}" alt="error" class="aspect-square mx-auto">
                                                        <p>{{ translate('No payment info added yet') }}</p>
                                                        <a href="#" class="btn btn--primary mx-auto" data-bs-toggle="offcanvas" data-bs-target="#add_payment_info_offcanvas">
                                                            <i class="fi fi-sr-add"></i>
                                                            {{ translate('Add Payment Info') }}
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-flex justify-content-end">
                                    {!! $methods->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- add payment offcanvas --}}
    <div class="offcanvas offcanvas-end" tabindex="-1" id="add_payment_info_offcanvas">
        <div class="offcanvas-header bg-light py-md-4 py-3">
            <h3 class="mb-0">{{ translate('Add Payment Info') }}</h3>
            <button type="button" class="action-btn border-0 btn bg-secondary rounded-circle text-white" data-bs-dismiss="offcanvas" aria-label="Close">
                <i class="fi fi-rr-cross fs-10 m-0 text-white"></i>
            </button>
        </div>
        <form action="{{ route('provider.settings.payment-information.store') }}" method="POST">
            @csrf
            <div class="offcanvas-body bg-white">
                <div class="mb-4">
                    <div class="bg-warning d-flex align-items-center bg-opacity-10 gap-2 p-12 lh-1 rounded text-dark mb-20">
                        <i class="fi fi-sr-info text-warning"></i>
                        <p class="fz-12">{{ translate('If you turn on The Status, this payment will show in dropdown list when withdraw request sent to admin.') }}</p>
                    </div>
                    <div class="bg-light rounded p-3 p-sm-20">
                        <div class="form-business mb-20">
                            <label class="mb-2 title-color">{{translate('Select payment Method')}}</label>
                            <select class="js-select theme-input-style w-100" name="withdrawal_method_id" id="withdrawal-method-select" required>
                                <option value="" selected disabled>{{ translate('---Select_Payment_Method---') }}</option>
                                @foreach($withdrawalMethods as $withdrawalMethod)
                                    <option value="{{ $withdrawalMethod->id }}" data-method-fields='@json($withdrawalMethod->method_fields)'>{{ $withdrawalMethod->method_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-business mb-20">
                            <label class="mb-2 title-color">{{ translate('payment method status') }}<span class="text-danger">*</span></label>
                            <div class="form-control d-flex justify-content-between align-items-center gap-3">
                                <span>Status</span>
                                <label class="switcher m-0">
                                    <input class="switcher_input" type="checkbox" name="is_active" value="1">
                                    <span class="switcher_control"></span>
                                </label>
                            </div>
                        </div>

                        <div id="dynamic-fields-wrapper"></div>

                    </div>
                </div>
            </div>
            <div class="offcanvas-footer border-0 bg-white p-3 px-sm-4 shadow-sm">
                <div class="d-flex justify-content-between gap-3">
                    <button type="reset" class="btn btn--secondary flex-grow-1">{{ translate('reset') }}</button>
                    <button type="submit" class="btn btn--primary flex-grow-1">{{ translate('save') }}</button>
                </div>
            </div>
        </form>
    </div>

    {{-- edit payment offcanvas --}}
    <div class="offcanvas offcanvas-end" tabindex="-1" id="edit_payment_info_offcanvas">
        <div class="offcanvas-header bg-light py-md-4 py-3">
            <h3 class="mb-0">{{ translate('Edit Payment Info') }}</h3>
            <button type="button" class="action-btn border-0 btn bg-secondary rounded-circle text-white" data-bs-dismiss="offcanvas" aria-label="Close">
                <i class="fi fi-rr-cross fs-10 m-0 text-white"></i>
            </button>
        </div>
        <form id="edit-payment-info-form" method="POST">
            @csrf
            @method('PUT')
            <div class="offcanvas-body bg-white">
                <div class="mb-4">
                    <div class="bg-warning d-flex align-items-center bg-opacity-10 gap-2 p-12 lh-1 rounded text-dark mb-20">
                        <i class="fi fi-sr-info text-warning"></i>
                        <p class="fz-12">{{ translate('If you turn on The Status, this payment will show in dropdown list when withdraw request sent to admin.') }}</p>
                    </div>
                    <div class="bg-light rounded p-3 p-sm-20">
                        <div class="form-business mb-20">
                            <label class="mb-2 title-color">{{translate('Status')}} <span class="text-danger">*</span></label>
                            <div class="form-control d-flex justify-content-between align-items-center gap-3">
                                <span>Status</span>
                                <label class="switcher m-0">
                                    <input class="switcher_input" type="checkbox" name="is_active" id="edit-status" value="1">
                                    <span class="switcher_control"></span>
                                </label>
                            </div>
                        </div>

                        <div id="edit-dynamic-fields-wrapper"></div>
                    </div>
                </div>
            </div>
            <div class="offcanvas-footer border-0 bg-white p-3 px-sm-4 shadow-sm">
                <div class="d-flex justify-content-between gap-3">
                    <button type="reset" class="btn btn--secondary flex-grow-1">{{ translate('reset') }}</button>
                    <button type="submit" class="btn btn--primary flex-grow-1">{{ translate('update') }}</button>
                </div>
            </div>
        </form>
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
                        <button type="button" class="btn btn--secondary min-w-120 cancel-change" id="cancelChange">{{ translate('No') }}</button>
                        <button type="button" class="btn btn--primary min-w-120" id="confirmChange">{{ translate('Yes') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="changeStatusModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close cancel-change" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body mb-30 pb-0 text-center">
                    <img width="80" src="{{ asset('public/assets/admin-module/img/delete.png') }}" alt="{{ translate('image') }}" class="mb-20">
                    <h3 class="mb-3 confirmation-title-text" id="confirmationTitle">{{ translate('Are you sure') }}?</h3>
                    <p class="mb-0 confirmation-description-text" id="confirmationMessage">{{ translate('Do you want to change the status') }}?</p>
                    <div class="btn--container mt-30 justify-content-center">
                        <button type="button" class="btn btn--secondary min-w-120 cancel-change" data-bs-dismiss="modal">{{ translate('No') }}</button>
                        <button type="button" class="btn btn--primary min-w-120" id="confirmDelete">{{ translate('Yes') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>



    {{-- Payment Information page ends --}}
@endsection

@push('script')

    <script>
        "use strict";

        $(document).ready(function () {
            $('#withdrawal-method-select').on('change', function () {
                const selectedOption = $(this).find('option:selected');
                const methodFields = selectedOption.data('method-fields') || [];
                const wrapper = $('#dynamic-fields-wrapper');
                wrapper.empty();

                methodFields.forEach(field => {
                    const isRequired = field.is_required ? 'required' : '';
                    const label = field.input_name.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase());
                    const inputId = 'field_' + field.input_name;

                    let inputElement = '';

                    switch (field.input_type) {
                        case 'string':
                            inputElement = `<input type="text" name="method_field_data[${field.input_name}]" class="form-control h-45" id="${inputId}" placeholder="${field.placeholder}" ${isRequired}>`;
                            break;
                        case 'number':
                            inputElement = `<input type="number" name="method_field_data[${field.input_name}]" class="form-control h-45" id="${inputId}" placeholder="${field.placeholder}" ${isRequired}>`;
                            break;
                        case 'date':
                            inputElement = `<input type="text" name="method_field_data[${field.input_name}]" class="form-control h-45" id="${inputId}" placeholder="${field.placeholder}" ${isRequired}>`;
                            break;
                        default:
                            inputElement = `<input type="text" name="method_field_data[${field.input_name}]" class="form-control h-45" id="${inputId}" placeholder="${field.placeholder}" ${isRequired}>`;
                            break;
                    }

                    wrapper.append(`
                    <div class="form-business mb-20">
                        <label for="${inputId}" class="mb-2 title-color">${label} ${field.is_required ? '<span class="text-danger">*</span>' : ''}</label>
                        ${inputElement}
                    </div>
                `);
                });
            })


            $('.edit-payment-method').on('click', function () {
                const methodId = $(this).data('id');

                $.ajax({
                    url: `/provider/settings/payment-information/edit/${methodId}`,
                    type: 'GET',
                    success: function (response) {
                        const form = $('#edit-payment-info-form');
                        const method = response.method;
                        const fields = response.method_fields || [];
                        const values = response.method_field_data || {};
                        const status = method.is_active;

                        console.log(status)

                        // Set form action
                        form.attr('action', `/provider/settings/payment-information/update/${method.id}`);

                        // Set status
                        $('#edit-status').prop('checked', status == 1);

                        // Generate dynamic fields
                        const wrapper = $('#edit-dynamic-fields-wrapper');
                        wrapper.empty();

                        fields.forEach(field => {
                            const isRequired = field.is_required ? 'required' : '';
                            const label = field.input_name.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase());
                            const inputId = 'edit_field_' + field.input_name;
                            const value = values[field.input_name] ?? '';

                            let inputElement = '';

                            switch (field.input_type) {
                                case 'string':
                                    inputElement = `<input type="text" name="method_field_data[${field.input_name}]" value="${value}" class="form-control h-45" id="${inputId}" placeholder="${field.placeholder}" ${isRequired}>`;
                                    break;
                                case 'number':
                                    inputElement = `<input type="number" name="method_field_data[${field.input_name}]" value="${value}" class="form-control h-45" id="${inputId}" placeholder="${field.placeholder}" ${isRequired}>`;
                                    break;
                                case 'date':
                                    inputElement = `<input type="text" name="method_field_data[${field.input_name}]" value="${value}" class="form-control h-45" id="${inputId}" placeholder="${field.placeholder}" ${isRequired}>`;
                                    break;
                                default:
                                    inputElement = `<input type="text" name="method_field_data[${field.input_name}]" value="${value}" class="form-control h-45" id="${inputId}" placeholder="${field.placeholder}" ${isRequired}>`;
                                    break;
                            }

                            wrapper.append(`
                                <div class="form-business mb-20">
                                    <label for="${inputId}" class="mb-2 title-color">${label} ${field.is_required ? '<span class="text-danger">*</span>' : ''}</label>
                                    ${inputElement}
                                </div>
                            `);
                        });

                        // Open offcanvas
                        const offcanvas = new bootstrap.Offcanvas($('#edit_payment_info_offcanvas')[0]);
                        offcanvas.show();
                    },
                    error: function () {
                        toastr.error('{{ translate('Something went wrong!') }}');
                    }
                });
            });


        });

        let selectedItem;
        let selectedRoute;
        let originalChecked;

        $(document).on('change', '.status-update', function (e) {
            e.preventDefault();

            selectedItem = $(this);
            originalChecked = selectedItem.prop('checked'); // This is the new value user *wants* to set

            // Revert it visually immediately
            selectedItem.prop('checked', !originalChecked);

            selectedRoute = selectedItem.data('route')
            let confirmationTitleText = selectedItem.data('title')
            let confirmationDescriptionText = selectedItem.data('description')
            let imgSrc = selectedItem.data('image')
            let confirmBtn = selectedItem.data("confirm-btn")

            $('.confirmation-title-text').text(confirmationTitleText);
            $('.confirmation-description-text').text(confirmationDescriptionText);
            $('#changeStatusModal img').attr('src', imgSrc);
            $("#confirmChange").text(confirmBtn)


            showModal();
        });

        $('#confirmChange').on('click', function () {
            updateStatus(selectedRoute);
        });

        $('.cancel-change').on('click', function () {
            hideModal();
        });

        function showModal() {
            $('#changeStatusModal').modal('show');
        }
        function hideModal() {
            $('#changeStatusModal').modal('hide');
        }

        function updateStatus(url) {
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function (response) {
                    toastr.success(response.message ?? '{{ translate('Status updated successfully') }}');
                    selectedItem.prop('checked', originalChecked); // Now apply the change
                    hideModal();
                },
                error: function (xhr) {
                    toastr.error(xhr.responseJSON?.message ?? '{{ translate('Something went wrong') }}');
                    selectedItem.prop('checked', !originalChecked); // Keep old state
                    hideModal();
                }
            });
        }


        let currentFormId = null;

        // Trigger modal
        $(document).on("click", ".trigger-confirmation", function () {
            const title = $(this).data("title");
            const message = $(this).data("message");
            currentFormId = $(this).data("id");

            $("#confirmationTitle").text(title);
            $("#confirmationMessage").text(message);

            // Open modal
            $("#deleteModal").modal('show');
        });

        // Confirm button
        $(document).on("click", "#confirmDelete", function () {
            if (currentFormId) {
                $("#" + currentFormId).submit();
            }
        });
    </script>

@endpush
