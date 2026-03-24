@extends('adminmodule::layouts.new-master')

@section('title', translate('system_addons'))

@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('public/assets/admin-module/swiper/swiper-bundle.min.css')}}"/>
    <link rel="stylesheet" href="{{ asset('public/assets/admin-module/css/addon-module.css')}}"/>
@endpush

@section('content')
    <div class="content container-fluid">
        <div class="page-header d-flex justify-content-between">
            <h1 class="page-header-title mb-3">
                <span class="page-header-icon">
                    <img src="{{asset('public/assets/admin/img/business-setup.png')}}" class="w--22" alt="">
                </span>
                <span>{{translate('system_addons')}}</span>
            </h1>
            <div class="text-primary d-flex align-items-center gap-3 font-weight-bolder">
                {{ translate('How_the_Setting_Works') }}
                <div class="ripple-animation" data-bs-toggle="modal" data-bs-target="#settingModal" type="button">
                    <img src="{{asset('/public/assets/admin-module/img/info.svg')}}" class="svg" alt="">
                </div>
            </div>
        </div>


        <div class="modal fade" id="settingModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="settingModal"
             aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-0 pb-0 d-flex justify-content-end">
                        <button
                            type="button"
                            class="btn-close border-0"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        ><i class="tio-clear"></i></button>
                    </div>
                    <div class="modal-body px-4 px-sm-5 pt-0 text-center">
                        <div class="row g-2 g-sm-3 mt-lg-0">
                            <div class="col-12">
                                <div class="swiper mySwiper pb-3">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <div class="d-flex flex-column align-items-center mx-w450 mx-auto">
                                                <img src="{{asset('public/assets/admin-module/img/addon-setting.png')}}"
                                                     loading="lazy"
                                                     alt="" class="dark-support rounded mb-4">
                                            </div>

                                            <div class="d-flex flex-column align-items-start">
                                                <h3 class="mb-4">{{translate('To Integrate add-on to your system please follow the instruction below')}}</h3>

                                                <ol class="text-start">
                                                    <li>{{translate('After purchasing the Payment & SMS Module from Codecanyon, you will find a file download option.')}}</li>
                                                    <li>{{translate('Download the file. It will be downloaded as Zip format Filename.Zip.')}}</li>
                                                    <li>{{translate('Extract the file and you will get another file name payment.zip.')}}</li>
                                                    <li>{{translate('Upload the file here and your Addon uploading is complete !')}}</li>
                                                    <li>{{translate('Then active the Addon and setup all the options. you are good to go !')}}</li>
                                                </ol>
                                            </div>

                                            <div class="d-flex flex-column align-items-end mx-w450 mx-auto">
                                                <button class="btn btn-primary px-10 mt-3"
                                                        data-bs-dismiss="modal">{{ translate('Got_It') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-pagination"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-5">
            <div class="card-body pl-md-10">
                <h4 class="mb-3 text-capitalize d-flex align-items-center">{{translate('upload_Payment_Module')}}</h4>
                <form enctype="multipart/form-data" id="theme_form">
                    <div class="row g-3">
                        <div class="col-sm-6 col-lg-5 col-xl-4 col-xxl-3">
                            <div class="uploadDnD">
                                <div class="form-group inputDnD">
                                    <input type="file" name="file_upload"
                                           class="form-control-file text--primary font-weight-bold"
                                           id="inputFile" onchange="readUrl(this)" accept=".zip"
                                           data-title="{{translate('Drag & drop file or Browse file')}}">
                                </div>
                            </div>

                            <div class="mt-5 card px-3 py-2 d--none" id="progress-bar">
                                <div class="d-flex flex-wrap align-items-center gap-3">
                                    <div class="">
                                        <img width="24" src="{{asset('/public/assets/admin/img/zip.png')}}" alt="">
                                    </div>
                                    <div class="flex-grow-1 text-start">
                                        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
                                            <span id="name_of_file" class="text-truncate fz-12"></span>
                                            <span class="text-muted fz-12" id="progress-label">0%</span>
                                        </div>
                                        <progress id="uploadProgress" class="w-100" value="0" max="100"></progress>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @php($condition_one=str_replace('MB','',ini_get('upload_max_filesize'))>=20 && str_replace('MB','',ini_get('upload_max_filesize'))>=20)
                        @php($condition_two=str_replace('MB','',ini_get('post_max_size'))>=20 && str_replace('MB','',ini_get('post_max_size'))>=20)

                        <div class="col-sm-6 col-lg-5 col-xl-4 col-xxl-9">
                            <div class="pl-sm-5">
                                <h5 class="mb-3 d-flex">{{ translate('instructions') }}</h5>
                                <ul class="pl-3 d-flex flex-column gap-2 instructions-list">
                                    <li class="list-unstyled">
                                        1. {{ translate('please_make_sure') }}, {{ translate('your_server_php') }}
                                        "upload_max_filesize" {{translate('value_is_grater
                                   _or_equal_to_20MB') }}. {{ translate('current_value_is') }}
                                        - {{ini_get('upload_max_filesize')}}B
                                    </li>
                                    <li class="list-unstyled">
                                        2. {{ translate('please_make_sure')}}, {{ translate('your_server_php')}}
                                        "post_max_size"
                                        {{translate('value_is_grater_or_equal_to_20MB')}}
                                        . {{translate('current_value_is') }} - {{ini_get('post_max_size')}}B
                                    </li>
                                </ul>
                            </div>
                        </div>

                        @can('addon_add')
                            <div class="col-12">
                                <div class="d-flex justify-content-end mt-3">
                                    @if(env('APP_ENV') != 'demo')
                                        <button type="button"
                                                class="btn btn--primary px-4"
                                                id="upload_theme">{{translate('upload')}}</button>
                                    @else
                                        <button type="button" class="btn btn--primary px-4 demo_check">{{translate('upload')}}</button>
                                    @endif
                                </div>
                            </div>
                        @endcan
                    </div>
                </form>
            </div>
        </div>

        <div class="row g-1 g-sm-2">
            @foreach($addons as $key => $addon)
                @php($data= include $addon.'/Addon/info.php')
                <div class="col-6 col-md-5 col-xxl-3">
                    <div class="card theme-card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title m-0">
                                {{$data['name']}}
                            </h3>

                            <div class="d-flex align-items-center">
                                @if ($data['is_published'] == 0)
                                    @can('addon_delete')
                                        <button class="text-danger bg-transparent p-0 border-0 me-2"
                                                data-bs-toggle="modal"
                                                data-bs-target="#deleteThemeModal_{{$key}}"><img
                                                src="{{asset('public/assets/admin-module/img/delete.svg')}}" class="svg"
                                                alt=""></button>
                                    @endcan

                                    <div class="modal fade" id="deleteThemeModal_{{$key}}" tabindex="-1"
                                         aria-labelledby="deleteThemeModal_{{$key}}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header border-0 pb-0 d-flex justify-content-end">
                                                    <button
                                                        type="button"
                                                        class="btn-close border-0"
                                                        data-bs-dismiss="modal"
                                                        aria-label="Close"
                                                    ><i class="tio-clear"></i></button>
                                                </div>
                                                <div class="modal-body px-4 px-sm-5 text-center">
                                                    <div class="mb-3 text-center">
                                                        <img width="75"
                                                             src="{{asset('public/assets/admin-module/img/delete.png')}}"
                                                             alt="">
                                                    </div>

                                                    <h3>{{ translate('are_you_sure_you_want_to_delete_the_payment_module') }}
                                                        ?</h3>
                                                    <p class="mb-5">{{ translate('once_you_delete') }}
                                                        , {{ translate('you_will_lost_the_this_payment_module') }}</p>
                                                    <div class="d-flex justify-content-center gap-3 mb-3">
                                                        <button type="button" class="fs-16 btn btn-secondary px-sm-5"
                                                                data-bs-dismiss="modal">{{ translate('cancel') }}</button>
                                                        <button type="submit"
                                                                class="fs-16 btn btn-danger px-sm-5 delete-addon"
                                                                data-bs-dismiss="modal"
                                                                data-value="{{ $addon }}">{{ translate('delete') }}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @can('addon_manage_status')
                                    <button
                                        class="{{$data['is_published'] == 1 ? 'checkbox-color-primary' : 'text-muted'}} bg-transparent p-0 border-0"
                                        data-bs-toggle="modal" data-bs-target="#shiftThemeModal_{{$key}}"><img
                                            src="{{asset('public/assets/admin-module/img/check.svg')}}" class="svg"
                                            alt="">
                                    </button>
                                @endcan
                                <div class="modal fade" id="shiftThemeModal_{{$key}}" tabindex="-1"
                                     aria-labelledby="shiftThemeModalLabel_{{$key}}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header border-0 pb-0 d-flex justify-content-end">
                                                <button
                                                    type="button"
                                                    class="btn-close border-0"
                                                    data-bs-dismiss="modal"
                                                    aria-label="Close"
                                                ><i class="tio-clear"></i></button>
                                            </div>
                                            <div class="modal-body px-4 px-sm-5 text-center">
                                                <div class="mb-3 text-center">
                                                    <img width="75"
                                                         src="{{asset('public/assets/admin-module/img/shift.png')}}"
                                                         alt="">
                                                </div>

                                                <h3 class="mb-3">{{ translate('are_you_sure?') }}</h3>
                                                @if ($publishedStatus)
                                                    <p class="mb-5">{{ translate('want_to_change_status') }}</p>
                                                @else
                                                    <p class="mb-5">{{ translate('want_to_active_this_payment_module') }}</p>
                                                @endif
                                                <div class="d-flex justify-content-center gap-3 mb-3">
                                                    <button type="button" class="fs-16 btn btn-secondary px-sm-5"
                                                            data-bs-dismiss="modal">{{ translate('no') }}</button>
                                                    <button type="button"
                                                            class="fs-16 btn btn--primary px-sm-5 publish-addon"
                                                            data-publish="{{$addon}}"
                                                            data-bs-dismiss="modal"
                                                    >{{ translate('yes') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="p-2 p-sm-3">
                            <div class="mb-2 d-none" id="activate_{{$key}}">
                                <form action="" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" name="username" value=""
                                               class="form-control"
                                               placeholder="{{ translate('codecanyon_username') }}">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="purchase_code" value=""
                                               class="form-control" placeholder="{{ translate('purchase_code') }}">
                                        <input type="text" name="path" class="form-control" value="" hidden>
                                    </div>

                                    <div>
                                        <input type="hidden" value="key" name="theme">
                                        <button type="submit"
                                                class="btn btn--primary radius-button text-end">{{translate('activate')}}</button>
                                    </div>
                                </form>
                            </div>

                            <div class="aspect-ration-3:2 border border-color-primary-light radius-10">
                                <img class="img-fit radius-10"
                                     onerror='this.src="{{asset('public/assets/admin/img/placeholder.png')}}"'
                                     src="{{asset($addon.'/public/addon.png')}}">
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            @include('addonmodule::addon.partials.activation-modal')
        </div>
    </div>

{{--    <div class="content container-fluid">--}}
{{--        <div class="card mb-20">--}}
{{--            <div class="card-body p-20">--}}
{{--                <div class="mb-20">--}}
{{--                    <h3 class="mb-1">{{translate('Upload Addon')}}</h3>--}}
{{--                    <p class="fz-12">{{translate("Vendor Logo & Covers")}}</p>--}}
{{--                </div>--}}
{{--                <div class="row g-3">--}}
{{--                    <div class="col-lg-6">--}}
{{--                        <div class="bg-primary d-flex align-items-center rounded-2 p-20 bg-opacity-10 h-100">--}}
{{--                            <div class="boxes">--}}
{{--                                <div class="d-flex align-items-center gap-1 text-primary mb-3">--}}
{{--                                    <img src="{{asset('/public/assets/admin-module/img/lights-icons.png')}}" class="svg" alt=""> <h4 class="text-primary">{{('Instructions')}}</h4>--}}
{{--                                </div>--}}
{{--                                <ul class="d-flex flex-column gap-2 px-3 mb-0">--}}
{{--                                    <li class="fz-12">{{translate('Create an html file named index.blade.php and insert your landing page design code and make a zip file.')}}--}}
{{--                                    </li>--}}
{{--                                    <li class="fz-12">{{translate('Upload file must be zip file format in and click save information.')}}--}}
{{--                                    </li>--}}
{{--                                    <li class="fz-12">{{translate('Without save the changes Landing page can’t update properly and you can’t see the updated preview.')}}--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-6">--}}
{{--                        <div class="bg-light rounded-2 p-20 w-100 h-100">--}}
{{--                            <div class="max-w-500 mx-auto">--}}
{{--                                <div class="trigger-zip-hit position-relative overflow-hidden bg-white border-dashed rounded-2 mx-auto d-center p-30">--}}
{{--                                    <input type="file" accept=".zip" required style="position: absolute; width: 100%; height: 100%; opacity: 0; cursor: pointer;">--}}
{{--                                    <div class="global-upload-box">--}}
{{--                                        <div class="upload-content text-center">--}}
{{--                                            <img class="mb-20" src="{{asset('public/assets/admin-module')}}/img/drop-upload-cloud.png" alt="" class="mb-15">--}}
{{--                                            <h5 class="mb-1 fw-normal">Select a file or <strong>Drag & Drop</strong> here</h5>--}}
{{--                                            <span class="fz-12 d-block mb-15">ZIP file size no more than 10MB</span>--}}
{{--                                            <span class="btn btn--primary py-2 px-3 btn-outline-primary rounded text-primary">Select File</span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="inside-upload-zipBox uploaded-zip-box-white mt-20">--}}

{{--                                </div>--}}
{{--                                <div class="text-center">--}}
{{--                                    <button type="button" class="btn btn--primary demo_check rounded">{{translate('Upload')}}</button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="card mb-20">--}}
{{--            <div class="card-body p-20">--}}
{{--                <div class="mb-20">--}}
{{--                    <h3 class="mb-1">{{translate('Available Addons')}}</h3>--}}
{{--                    <p class="fz-12">{{translate("Select the theme you want to use for your system")}}</p>--}}
{{--                </div>--}}
{{--                <div class="row g-lg-4 g-3">--}}
{{--                    <div class="col-lg-12">--}}
{{--                        <div class="bg-white border-dashed rounded-3 p-20 text-center">--}}
{{--                            <div class="py-5">--}}
{{--                                <img src="{{asset('/public/assets/admin-module/img/addon-explore.png')}}" class="mb-15" alt="">--}}
{{--                                <h4 class="mb-1">{{('Explore Our Addons')}}</h4>--}}
{{--                                <p class="fz-12 mb-15">Browse our themes and add here to enhance your website look and functionality.</p>--}}
{{--                                <a href="#0" class="bg-warning rounded-full py-2 h-45 px-4 text-white fw-semibold d-inline-flex align-items-center gap-2">--}}
{{--                                    Check Addons--}}
{{--                                    <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                        <g clip-path="url(#clip0_10223_7486)">--}}
{{--                                        <path d="M14.5 2.25V6.33333C14.5 6.65533 14.2392 6.91667 13.9167 6.91667C13.5941 6.91667 13.3333 6.65533 13.3333 6.33333V2.4915L6.45408 9.37075C6.34033 9.4845 6.191 9.54167 6.04167 9.54167C5.89233 9.54167 5.743 9.4845 5.62925 9.37075C5.40117 9.14267 5.40117 8.774 5.62925 8.54592L12.5085 1.66667H8.66667C8.34408 1.66667 8.08333 1.40533 8.08333 1.08333C8.08333 0.761333 8.34408 0.5 8.66667 0.5H12.75C13.7148 0.5 14.5 1.28517 14.5 2.25ZM13.9167 8.66667C13.5941 8.66667 13.3333 8.928 13.3333 9.25V11.5833C13.3333 12.5482 12.5482 13.3333 11.5833 13.3333H3.41667C2.45183 13.3333 1.66667 12.5482 1.66667 11.5833V3.41667C1.66667 2.45183 2.45183 1.66667 3.41667 1.66667H5.75C6.07258 1.66667 6.33333 1.40533 6.33333 1.08333C6.33333 0.761333 6.07258 0.5 5.75 0.5H3.41667C1.80842 0.5 0.5 1.80842 0.5 3.41667V11.5833C0.5 13.1916 1.80842 14.5 3.41667 14.5H11.5833C13.1916 14.5 14.5 13.1916 14.5 11.5833V9.25C14.5 8.928 14.2392 8.66667 13.9167 8.66667Z" fill="white"/>--}}
{{--                                        </g>--}}
{{--                                        <defs>--}}
{{--                                        <clipPath id="clip0_10223_7486">--}}
{{--                                        <rect width="14" height="14" fill="white" transform="translate(0.5 0.5)"/>--}}
{{--                                        </clipPath>--}}
{{--                                        </defs>--}}
{{--                                    </svg>--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-12 text-end">--}}
{{--                        <a href="#0" class="bg-warning rounded-full py-2 h-45 px-4 text-white fw-semibold d-inline-flex align-items-center gap-2">--}}
{{--                            Explore Our Add-ons--}}
{{--                            <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                <g clip-path="url(#clip0_10223_7486)">--}}
{{--                                <path d="M14.5 2.25V6.33333C14.5 6.65533 14.2392 6.91667 13.9167 6.91667C13.5941 6.91667 13.3333 6.65533 13.3333 6.33333V2.4915L6.45408 9.37075C6.34033 9.4845 6.191 9.54167 6.04167 9.54167C5.89233 9.54167 5.743 9.4845 5.62925 9.37075C5.40117 9.14267 5.40117 8.774 5.62925 8.54592L12.5085 1.66667H8.66667C8.34408 1.66667 8.08333 1.40533 8.08333 1.08333C8.08333 0.761333 8.34408 0.5 8.66667 0.5H12.75C13.7148 0.5 14.5 1.28517 14.5 2.25ZM13.9167 8.66667C13.5941 8.66667 13.3333 8.928 13.3333 9.25V11.5833C13.3333 12.5482 12.5482 13.3333 11.5833 13.3333H3.41667C2.45183 13.3333 1.66667 12.5482 1.66667 11.5833V3.41667C1.66667 2.45183 2.45183 1.66667 3.41667 1.66667H5.75C6.07258 1.66667 6.33333 1.40533 6.33333 1.08333C6.33333 0.761333 6.07258 0.5 5.75 0.5H3.41667C1.80842 0.5 0.5 1.80842 0.5 3.41667V11.5833C0.5 13.1916 1.80842 14.5 3.41667 14.5H11.5833C13.1916 14.5 14.5 13.1916 14.5 11.5833V9.25C14.5 8.928 14.2392 8.66667 13.9167 8.66667Z" fill="white"/>--}}
{{--                                </g>--}}
{{--                                <defs>--}}
{{--                                <clipPath id="clip0_10223_7486">--}}
{{--                                <rect width="14" height="14" fill="white" transform="translate(0.5 0.5)"/>--}}
{{--                                </clipPath>--}}
{{--                                </defs>--}}
{{--                            </svg>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-6">--}}
{{--                        <div class="bg-white border-dashed rounded-3">--}}
{{--                            <div class="p-20 bg-light">--}}
{{--                                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-10">--}}
{{--                                    <h4 class="mb-0">{{('6amTech Payment & SMS Gateway')}}</h4>--}}
{{--                                    <div class="d-flex align-items-center gap-2">--}}
{{--                                        <label class="switcher mb-0">--}}
{{--                                            <input class="switcher_input section-toggle" type="checkbox" checked="">--}}
{{--                                            <span class="switcher_control"></span>--}}
{{--                                        </label>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="d-flex align-items-center gap-2">--}}
{{--                                    <span class="text-white bg-success rounded py-1 px-2">Active</span> <span class="text-primary bg-opacity-10 bg-primary rounded py-1 px-2">Current Version 1.0.2</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="p-20">--}}
{{--                                <div class="text-center">--}}
{{--                                    <img src="{{asset('/public/assets/admin-module/img/addon-thumbs.png')}}" class="mb-20 mt-20 mx-auto max-w-300 rounded w-100" alt="">--}}
{{--                                </div>--}}
{{--                                <div class="d-flex align-items-center justify-content-center gap-sm-3 gap-2 flex-wrap">--}}
{{--                                        <div class="d-flex align-items-center justify-content-center gap-1 fz-14">--}}
{{--                                            Latest Version <span class="text-primary bg-opacity-10 bg-primary rounded py-1 px-2">15.0</span>--}}
{{--                                        </div>--}}
{{--                                        <a href="#0" class="fz-14 text-primary fw-semibold text-decoration-underline">Click to Buy</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-6">--}}
{{--                        <div class="bg-white border-dashed rounded-3">--}}
{{--                            <div class="p-20 bg-light">--}}
{{--                                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-10">--}}
{{--                                    <h4 class="mb-0">{{('6amTech Payment & SMS Gateway')}}</h4>--}}
{{--                                    <div class="d-flex align-items-center gap-2">--}}
{{--                                        <button type="button" class="action-btn btn--danger ">--}}
{{--                                            <span class="material-symbols-outlined">delete</span>--}}
{{--                                        </button>--}}
{{--                                        <label class="switcher mb-0">--}}
{{--                                            <input class="switcher_input section-toggle" type="checkbox">--}}
{{--                                            <span class="switcher_control"></span>--}}
{{--                                        </label>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="d-flex align-items-center gap-2">--}}
{{--                                    <span class="text-primary bg-opacity-10 bg-primary rounded py-1 px-2">Current Version 1.0.2</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="p-20">--}}
{{--                                <div class="text-center">--}}
{{--                                    <img src="{{asset('/public/assets/admin-module/img/addon-thumbs.png')}}" class="mb-20 mt-20 mx-auto max-w-300 rounded w-100" alt="">--}}
{{--                                </div>--}}
{{--                                <div class="d-flex align-items-center justify-content-center gap-sm-3 gap-2 flex-wrap">--}}
{{--                                        <div class="d-flex align-items-center justify-content-center gap-1 fz-14">--}}
{{--                                            Latest Version <span class="text-primary bg-opacity-10 bg-primary rounded py-1 px-2">15.0</span>--}}
{{--                                        </div>--}}
{{--                                        <a href="#0" class="fz-14 text-primary fw-semibold text-decoration-underline">Click to Buy</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

@endsection

@push('script')
    <script href="{{ asset('public/assets/admin-module/swiper/swiper-bundle.min.js')}}"></script>

    <script>
        'use strict';

        $("img.svg").each(function () {
            var $img = jQuery(this);
            var imgID = $img.attr("id");
            var imgClass = $img.attr("class");
            var imgURL = $img.attr("src");

            jQuery.get(
                imgURL,
                function (data) {
                    var $svg = jQuery(data).find("svg");

                    if (typeof imgID !== "undefined") {
                        $svg = $svg.attr("id", imgID);
                    }

                    if (typeof imgClass !== "undefined") {
                        $svg = $svg.attr("class", imgClass + " replaced-svg");
                    }


                    $svg = $svg.removeAttr("xmlns:a");


                    if (
                        !$svg.attr("viewBox") &&
                        $svg.attr("height") &&
                        $svg.attr("width")
                    ) {
                        $svg.attr(
                            "viewBox",
                            "0 0 " + $svg.attr("height") + " " + $svg.attr("width")
                        );
                    }

                    $img.replaceWith($svg);
                },
                "xml"
            );
        });

        function readUrl(input) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = (e) => {
                    let imgData = e.target.result;
                    let imgName = input.files[0].name;
                    input.setAttribute("data-title", imgName);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $('#upload_theme').on('click', function () {
            zip_upload()
        })

        function zip_upload() {
            var fileInput = document.getElementById('inputFile');
            let maxFileSize = "{{$condition_one}}";
            let maxPostSize = "{{$condition_two}}";

            if (!fileInput.files || !fileInput.files[0]) {
                toastr.warning('Please choose a file for upload.');
                return;
            }

            if (!maxFileSize) {
                toastr.warning('Your server php "upload_max_filesize" is must be grater or equal to 20MB');
                return;
            }

            if (!maxPostSize) {
                toastr.warning('Your server php "post_max_size" is must be grater or equal to 20MB');
                return;
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var formData = new FormData(document.getElementById('theme_form'));
            $.ajax({
                type: 'POST',
                url: "{{route('admin.addon.upload')}}",
                data: formData,
                processData: false,
                contentType: false,
                xhr: function () {
                    var xhr = new window.XMLHttpRequest();
                    $('#progress-bar').show();


                    xhr.upload.addEventListener("progress", function (e) {
                        if (e.lengthComputable) {
                            var percentage = Math.round((e.loaded * 100) / e.total);
                            $("#uploadProgress").val(percentage);
                            $("#progress-label").text(percentage + "%");
                        }
                    }, false);

                    return xhr;
                },
                beforeSend: function () {
                    $('#upload_theme').attr('disabled');
                },
                success: function (response) {
                    if (response.status == 'error') {
                        $('#progress-bar').hide();
                        toastr.error(response.message, {
                            CloseButton: true,
                            ProgressBar: true
                        });
                    } else if (response.status == 'success') {
                        toastr.success(response.message, {
                            CloseButton: true,
                            ProgressBar: true
                        });
                        location.reload();
                    }
                },
                complete: function () {
                    $('#upload_theme').removeAttr('disabled');
                },
            });
        }

        $('.publish-addon').on('click', function () {
            let filePath = $(this).data('publish')
            publish_addon(filePath)
        })

        function publish_addon(path) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: '{{route('admin.addon.publish')}}',
                data: {
                    'path': path
                },
                success: function (data) {
                    if (data.flag === 'inactive') {
                        $('#activatedThemeModal').modal('show');
                        $('#activateData').empty().html(data.view);
                    } else {
                        if (data.errors) {
                            for (var i = 0; i < data.errors.length; i++) {
                                toastr.error(data.errors[i].message, {
                                    CloseButton: true,
                                    ProgressBar: true
                                });
                            }
                        } else {
                            toastr.success('{{ translate("updated successfully!") }}', {
                                CloseButton: true,
                                ProgressBar: true
                            });
                            setTimeout(function () {
                                location.reload()
                            }, 2000);
                        }
                    }
                }
            });
        }

        $('.delete-addon').on('click', function () {
            let path = $(this).data('value')
            theme_delete(path)
        })

        function theme_delete(path) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: '{{route('admin.addon.delete')}}',
                data: {
                    path
                },
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (data) {
                    if (data.status === 'success') {
                        setTimeout(function () {
                            location.reload()
                        }, 2000);

                        toastr.success(data.message, {
                            CloseButton: true,
                            ProgressBar: true
                        });
                    } else if (data.status === 'error') {
                        toastr.error(data.message, {
                            CloseButton: true,
                            ProgressBar: true
                        });
                    }
                },
                complete: function () {
                    $('#loading').hide();
                },
            });
        }

        var swiper = new Swiper(".mySwiper", {
            pagination: {
                el: ".swiper-pagination",
                dynamicBullets: true,
            },
        });
    </script>
@endpush
