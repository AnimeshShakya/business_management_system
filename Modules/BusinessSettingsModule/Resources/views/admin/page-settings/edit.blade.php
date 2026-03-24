@extends('adminmodule::layouts.new-master')

@section('title',translate('page_setup'))

@push('css_or_js')

@endpush

@section('content')
    <div class="main-content">
        <div class="container-fluid">

            <div class="mb-20">
                <div class="page-settings align-items-center gap-3 flex-wrap">
                    <div>
                        <h2 class="page-title mb-2">{{translate('Edit Business Page')}}</h2>
                        <p class="fz-12">{{ translate('update and customize business pages to expand your system') }}</p>
                    </div>
                    <a class="btn btn--primary fs-14 text-capitalize gap-2 rounded-2" href="{{ $route }}" target="_blank">
                        {{ translate('View URL') }}
                        <span class="material-symbols-outlined">open_in_new</span>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                     <div class="tab-content">
                            <div class="tab-pane fade active show">
                                <div class="card">
                                    <form action="{{route('admin.business-page-setup.update', $page->id)}}" method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <div class="card-body p-20">
                                            <div class="">
                                                <div class="body-bg rounded p-20 mb-20">
                                                    <div class="row g-md-4 g-3">
                                                        <div class="col-xxl-8 col-xl-7 col-md-6">
                                                            <div>
                                                                <h3 class="page-title mb-2">{{translate('Page Availability ')}}</h3>
                                                                <p class="fz-12 mb-0">{{translate('If you turn of the availability status, this page will not show in the customer app and website')}}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-4 col-xl-5 col-md-6">
                                                            <div class="d-flex justify-content-between align-items-center bg-white border rounded px-3 py-3">
                                                                <h5 class="mb-0 fw-normal">{{translate('Status')}}</h5>
                                                                <label class="switcher ml-auto mb-0"
                                                                       @if(in_array($page->page_key, $defaultActivePages))
                                                                           data-bs-toggle="tooltip"
                                                                       data-bs-placement="top"
                                                                       title="{{ translate('status change option is disable for this page') }}"
                                                                    @endif>
                                                                    <input type="checkbox" class="switcher_input" name="is_active"
                                                                           @if(in_array($page->page_key, $defaultActivePages)) disabled @endif
                                                                        {{ $page->is_active == 1 ? 'checked' : '' }}>
                                                                    <span class="switcher_control"></span>
                                                                </label>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-20">
                                                    <h5 class="mb-10 fw-normal">{{ translate('Title Background Image') }}</h5>
                                                    <div class="body-bg rounded p-xl-4 p-3">
                                                        <div class="global-image-upload position-relative max-w-100 overflow-hidden bg-white border-dashed rounded-2 mx-auto mb-20 ratio-7-1 h-100px d-center has-image">
                                                            <input type="file" name="image" style="position: absolute; width: 100%; height: 100%; opacity: 0; cursor: pointer;"
                                                                   accept=".{{ implode(',.', array_column(IMAGEEXTENSION, 'key')) }}, |image/*"
                                                                   data-maxFileSize="{{ readableUploadMaxFileSize('image') }}">
                                                            <div class="global-upload-box">
                                                                <div class="upload-content text-center">
{{--                                                                    <span class="material-symbols-outlined placeholder-icon mb-1 text-primary">photo_camera</span>--}}
{{--                                                                    <span class="fz-10 d-block">Add image</span>--}}
                                                                </div>
                                                            </div>
                                                            <img class="global-image-preview" src="{{ $page->imageFullPath }}" alt="Preview" style="max-height: 100%; max-width: 100%;" />
                                                            <div class="overlay-icons ">
                                                                <button type="button" class="action-btn btn--light-primary bg-white outline-primary-hover view-icon" title="View" data-bs-toggle="modal" data-bs-target="#imageShowingMOdal">
                                                                    <span class="material-icons">visibility</span>
                                                                </button>
                                                                <button type="button" class="action-btn btn--light-primary bg-white outline-primary-hover edit-icon" title="Edit">
                                                                    <span class="material-icons">edit</span>
                                                                </button>
                                                            </div>
                                                            <div class="image-file-name d-none mt-2 text-center text-muted" style="font-size: 12px;"></div>
                                                        </div>
                                                        <p class="fz-10 text-center">
                                                            {{ translate('Image format')}} - {{ implode(', ', array_column(IMAGEEXTENSION, 'key')) }}
                                                            {{ translate("Image Size") }} - {{ translate('maximum size') }} {{ readableUploadMaxFileSize('image') }}
                                                            {{ translate('Image Ratio') }} - 7:1
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="body-bg rounded p-20 mb-20">
                                                    <ul class="nav nav--tabs border-color-primary mb-4">
                                                        <li class="nav-item">
                                                            <a class="nav-link lang_link active" href="#" id="default-link">{{ translate('default') }}</a>
                                                        </li>
                                                        @foreach ($languages as $lang)
                                                            <li class="nav-item">
                                                                <a class="nav-link lang_link" href="#" id="{{ $lang['code'] }}-link">{{ get_language_name($lang['code']) }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>

                                                    {{-- Default Language --}}
                                                    <div class="lang-form default-form">
                                                        <div class="mb-30">
                                                            <label class="mb-2 text-dark">{{ translate('Page Title') }} ({{ translate('Default') }})
                                                                <span class="text-danger">*</span>
                                                                <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                                   data-bs-placement="top"
                                                                   title="{{ translate('Type the name of the page you want to create') }}"
                                                                >info</i>
                                                            </label>
                                                            <input type="text" class="form-control" name="page_title[]" value="{{ $page->getRawOriginal('title') }}">
                                                        </div>
                                                        <div class="mb-30">
                                                            <label class="mb-2 text-dark">{{ translate('Page Content') }} ({{ translate('Default') }})
                                                                <span class="text-danger">*</span>
                                                                <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                                   data-bs-placement="top"
                                                                   title="{{ translate('Type the content of the page you want to create') }}"
                                                                >info</i>
                                                            </label>
                                                            <textarea class="ckeditor" name="page_content[]">{!! $page->getRawOriginal('content') !!}</textarea>
                                                        </div>
                                                        <input type="hidden" name="lang[]" value="default">
                                                    </div>

                                                    {{-- Other Languages --}}
                                                    @foreach ($languages as $lang)
                                                        <div class="lang-form {{ $lang['code'] }}-form d-none">
                                                            <div class="mb-30">
                                                                <label class="mb-2 text-dark">{{ translate('Page Title') }} ({{ get_language_name($lang['code']) }})</label>
                                                                <input type="text" class="form-control" name="page_title[]" value="{{ $titles[$lang['code']] ?? '' }}">
                                                            </div>

                                                            <div class="mb-30">
                                                                <label class="mb-2 text-dark">{{ translate('Page Content') }} ({{ get_language_name($lang['code']) }})</label>
                                                                <textarea class="ckeditor" name="page_content[]">{!! $contents[$lang['code']] ?? '' !!}</textarea>
                                                            </div>

                                                            <input type="hidden" name="lang[]" value="{{ $lang['code'] }}">
                                                        </div>
                                                    @endforeach
                                                </div>


                                            @can('page_update')
                                                <div class="d-flex justify-content-end trans3 mt-4">
                                                    <div class="d-flex justify-content-sm-end justify-content-center gap-2 gap-sm-3 flex-grow-1 flex-grow-sm-0 bg-white action-btn-wrapper trans3">
                                                        <div class="d-flex justify-content-end gap-lg-3 gap-2">
                                                            <button type="reset" class="btn btn--secondary rounded">
                                                                {{translate('reset')}}
                                                            </button>
                                                            <button type="submit" class="btn btn--primary d-flex align-items-center gap-2 rounded demo_check">
                                                                <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <g clip-path="url(#clip0_9562_1632)">
                                                                        <path d="M9.91732 0.5H4.08398V4H9.91732V0.5Z" fill="white"/>
                                                                        <path d="M7.00065 9.83333C7.64498 9.83333 8.16732 9.311 8.16732 8.66667C8.16732 8.02233 7.64498 7.5 7.00065 7.5C6.35632 7.5 5.83398 8.02233 5.83398 8.66667C5.83398 9.311 6.35632 9.83333 7.00065 9.83333Z" fill="white"/>
                                                                        <path d="M11.0833 0.5V5.16667H2.91667V0.5H1.75C1.28587 0.5 0.840752 0.684374 0.512563 1.01256C0.184374 1.34075 0 1.78587 0 2.25L0 14.5H14V3.41667L11.0833 0.5ZM7 11C6.53851 11 6.08738 10.8632 5.70367 10.6068C5.31995 10.3504 5.02088 9.98596 4.84428 9.55959C4.66768 9.13323 4.62147 8.66408 4.7115 8.21146C4.80153 7.75883 5.02376 7.34307 5.35008 7.01675C5.67641 6.69043 6.09217 6.4682 6.54479 6.37817C6.99741 6.28814 7.46657 6.33434 7.89293 6.51095C8.31929 6.68755 8.68371 6.98662 8.94009 7.37034C9.19649 7.75405 9.33333 8.20518 9.33333 8.66667C9.33333 9.28551 9.0875 9.879 8.64992 10.3166C8.21233 10.7542 7.61884 11 7 11Z" fill="white"/>
                                                                    </g>
                                                                    <defs>
                                                                        <clipPath id="clip0_9562_1632">
                                                                            <rect width="14" height="14" fill="white" transform="translate(0 0.5)"/>
                                                                        </clipPath>
                                                                    </defs>
                                                                </svg>
                                                                {{translate('Update')}}
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endcan
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>


    </div>

    <!--image showing-->
    <div class="modal fade custom-confirmation-modal" id="imageShowingMOdal" tabindex="-1" aria-labelledby="imageShowingMOdalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body py-3 px-sm-4 px-3">
                    <button type="button" class="btn-close bg-light rounded-full" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="image-display-container">
                        <!-- Push Inside any images -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{asset('public/assets/admin-module/plugins/tinymce/tinymce.min.js')}}"></script>
<script>

</script>
    <script>
        "use strict";

        $(document).ready(function () {
            tinymce.init({
                selector: 'textarea.ckeditor'
            });
        });

        $(".lang_link").on('click', function (e) {
            e.preventDefault();
            $(".lang_link").removeClass('active');
            $(".lang-form").addClass('d-none');
            $(this).addClass('active');

            let form_id = this.id;
            let lang = form_id.substring(0, form_id.length - 5);
            $("." + lang + "-form").removeClass('d-none');
        });
    </script>

    <!-- Image Upload Handlr -->
    <script>
        "use strict";

        $(document).ready(function () {
            $(".js-upload-input").on("change", function (event) {
                let file = event.target.files[0];
                const target = $(this).data('target');
                let blobURL = URL.createObjectURL(file);
                $(this).closest('.upload-file').find('.upload-file__img').html('<img class="h-180px w-100" src="' + blobURL + '" alt="">');
            })
        });
    </script>
@endpush
