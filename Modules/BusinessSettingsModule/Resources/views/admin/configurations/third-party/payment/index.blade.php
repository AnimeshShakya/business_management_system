@extends('adminmodule::layouts.new-master')

@section('title',translate('3rd_party'))

@push('css_or_js')
    <link rel="stylesheet" href="{{asset('public/assets/admin-module')}}/plugins/swiper/swiper-bundle.min.css"/>
@endpush

@section('content')
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="main-content mb-5">
                        <div class="container-fluid">
                            <div class="page-title-wrap mb-3">
                                <h2 class="page-title">{{translate('Payment Methods Setup')}}</h2>
                            </div>
                            @include('businesssettingsmodule::admin.configurations.third-party.partials.payment-method-inline-menu')
                            <div class="tab-content">
                                @include('businesssettingsmodule::admin.configurations.third-party.payment.payment-digital')
                                @include('businesssettingsmodule::admin.configurations.third-party.payment.payment-offline')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <span id="payment-gateway-published-status" data-status="{{ $data['payment_gateway_publish_status'] ?? 0 == 1 ? 'true' : 'false' }}"></span>
@endsection

@push('script')
    <script>
        $('.third-party-data-form').on('submit', function (event) {
            event.preventDefault();
            let formElement = this;
            let formData = new FormData(formElement);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: $(formElement).attr('action'),
                data: formData,
                processData: false,
                contentType: false,
                type: 'post',
                success: function (response) {
                    console.log(response)
                    if (response?.errors.length > 0)
                    {
                        response.errors.forEach((error, index) => {
                            toastr.error(error.message);
                        })
                    } else {
                        toastr.success('{{translate('successfully_updated')}}');
                        if (!$(formElement).hasClass('no-reload')) {
                            setTimeout(function () {
                                window.location.reload();
                            }, 1000);
                        }
                    }
                },
                error: function (error) {
                    toastr.error(JSON.parse(error.responseText).message)
                }
            });
        });

        $(document).ready(function () {
            function toggleFileContentBox() {
                if ($('#firebase-login-active2').is(':checked')) {
                    $('.file-upload-div').hide();
                    $("textarea[name='service_file_content']").attr('readonly', false);
                } else {
                    $('.file-upload-div').show();
                    $("textarea[name='service_file_content']").attr('readonly', true);
                }
            }

            toggleFileContentBox();

            $('input[name="status"]').on('change', toggleFileContentBox);

            $('.process-json-file input[type="file"]').on('change', function (event) {
                const files = event.target.files;
                if (!files.length) return;
                const uploadBox = $('.inside-upload-zipBox');
                uploadBox.empty();

                for (let i = 0; i < files.length; i++) {
                    const file = files[i];
                    const fileName = file.name;
                    const fileSizeMB = (file.size / 1024 / 1024).toFixed(1);
                    if (!fileName.toLowerCase().endsWith('.json')) {
                        alert('Only .json files are allowed.');
                        continue;
                    }

                    const uploadedContent = `
                    <div class="uploaded-zip-box position-relative bg-light rounded p-3 mb-md-3 mb-2">
                        <div class="d-flex align-items-center gap-2">
                            <div class="zip-icon mt-1">
                                <span class="material-symbols-outlined text-primary">insert_drive_file</span>
                            </div>
                            <div class="d-flex align-items-center w-100 justify-content-between gap-1 flex-wrap">
                                <div class="fz-12 text-break">${fileName}</div>
                                <div class="text-muted text-color fz-12">${fileSizeMB}MB</div>
                            </div>
                        </div>
                        <button class="btn btn-danger p-1 position-absolute top-0 end-cus-0 w-20 h-20 rounded-full d-center remove-uploaded-file">✕</button>
                    </div>
                `;

                    uploadBox.append(uploadedContent);
                }
            });

            $(document).on('click', '.remove-uploaded-file, .reset-uploaded-file', function () {
                $('.uploaded-zip-box').remove();
                $("input[name='service_file']").val('');
            });

            let paymentGatewayPublishedStatus = $('#payment-gateway-published-status').data('status');
            if (paymentGatewayPublishedStatus?.toString() === 'true') {
                'use strict';
                let gatewayCards = $('#gateway-cards');
                gatewayCards.find('input').each(function () {
                    $(this).attr('disabled', true);
                });
                gatewayCards.find('select').each(function () {
                    $(this).attr('disabled', true);
                });
                gatewayCards.find('.switcher_input').each(function () {
                    $(this).removeAttr('checked', true);
                });
                gatewayCards.find('button').each(function () {
                    $(this).attr('disabled', true);
                });
            }

            var visibleCount = 3;

            $('.data-group').each(function () {
                var $group = $(this);
                var $items = $group.find('.items');
                var $button = $group.find('.toggle-btn');
                // Only show the button if more than 3 items
                if ($items.length > visibleCount) {
                    $button.show();

                    // Hide items beyond the first 3
                    $items.each(function (index) {
                        if (index >= visibleCount) {
                            $(this).hide();
                        }
                    });

                    // Button click toggle
                    $button.on('click', function () {
                        var hidden = $items.filter(':hidden').length > 0;

                        if (hidden) {
                            $items.slideDown();
                            $(this).text('See Less');
                        } else {
                            $items.each(function (index) {
                                if (index >= visibleCount) {
                                    $(this).slideUp();
                                }
                            });
                            $(this).text('See More');
                        }
                    });
                }
            });

            $('.load-delete-modal').on('click', function () {
                let itemId = $(this).data('delete');
                @if(env('APP_ENV')!='demo')
                form_alert('delete-' + itemId, '{{translate('want_to_delete_this')}}?')
                @endif
            })

            $('.update-status').on('click', function () {
                let itemId = $(this).data('status');
                let route = '{{ route('admin.configuration.offline-payment.status-update', ['id' => ':itemId']) }}';
                route = route.replace(':itemId', itemId);
                route_alert_reload(route, '{{ translate('want_to_update_status') }}');
            })
        });
        $(".view-btn").on("click", function () {
            var container = $(this).closest(".view-details-container");
            var details = container.find(".view-details");
            var icon = $(this).find("i");

            $(this).toggleClass("active");
            details.slideToggle(300);
            icon.toggleClass("rotate-180deg");
        });
        $(".section-toggle").on("change", function () {
            if (!$(this).hasClass('section-toggle')) return;
            if ($(this).is(':checked')) {
                $(this).closest(".view-details-container").find(".view-details").slideDown(300);
            } else {
                $(this).closest(".view-details-container").find(".view-details").slideUp(300);
            }
        });

        function ValidateEmail(inputText) {
            let mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            return !!inputText.match(mailformat);
        }

        $('#send-mail').on('click', function () {
            if (ValidateEmail($('#test-email').val())) {
                Swal.fire({
                    title: '{{ translate('Are you sure?') }}?',
                    text: "{{ translate('a_test_mail_will_be_sent_to_your_email') }}!",
                    showCancelButton: true,
                    cancelButtonColor: 'var(--bs-secondary)',
                    confirmButtonColor: 'var(--bs-primary)',
                    confirmButtonText: '{{ translate('Yes') }}!'
                }).then((result) => {
                    if (result.value) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: "{{ route('admin.configuration.send-mail') }}",
                            method: 'GET',
                            data: {
                                "email": $('#test-email').val()
                            },
                            beforeSend: function () {
                                $('#loading').show();
                            },
                            success: function (data) {
                                if (data.success === 2) {
                                    toastr.error(
                                        '{{ translate('email_configuration_error') }} !!'
                                    );
                                } else if (data.success === 1) {
                                    toastr.success(
                                        '{{ translate('email_configured_perfectly!') }}!'
                                    );
                                } else {
                                    toastr.info(
                                        '{{ translate('email_status_is_not_active') }}!'
                                    );
                                }
                            },
                            complete: function () {
                                $('#loading').hide();

                            }
                        });
                    }
                })
            } else {
                toastr.error('{{ translate('invalid_email_address') }} !!');
            }
        });
    </script>
@endpush
