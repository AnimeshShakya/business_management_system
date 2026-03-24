@extends('adminmodule::layouts.new-master')

@section('title',translate('3rd_party'))

@push('css_or_js')
    <link rel="stylesheet" href="{{asset('public/assets/admin-module')}}/plugins/swiper/swiper-bundle.min.css"/>
@endpush

@section('content')

<!-- FireBase Start -->
<div class="main-content mb-5">
    <div class="container-fluid">
        <div class="page-title-wrap mb-3">
            <h2 class="page-title">{{translate('Firebase')}}</h2>
        </div>
        <div class="mb-20 nav-tabs-responsive position-relative">
            <ul class="nav nav--tabs scrollbar-w flex-nowrap white-nowrap overflow-x-auto flex-wrap-nowrap nav--tabs__style2">
                <li class="nav-item">
                    <a href="#" class="nav-link active" id="configuration-custom-tab1" data-bs-toggle="tab" data-bs-target="#configuration-tabs1" type="button" role="tab" aria-controls="configuration-tabs1" aria-selected="false">
                        {{translate('Configuration')}}
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" id="configuration-custom-tab2" data-bs-toggle="tab" data-bs-target="#configuration-tabs2" type="button" role="tab" aria-controls="configuration-tabs2" aria-selected="false">
                        {{translate('Authentication')}}
                    </a>
                </li> 
            </ul>
            <div class="nav--tab__prev position-absolute top-0 start-3">
                <button class="border-0 w-38 h-38 d-flex align-items-center justify-content-center rounded-full p-0 bg-white text-primary">
                    <span class="material-symbols-outlined">
                        arrow_back_ios
                    </span>
                </button>
            </div>
            <div class="nav--tab__next position-absolute top-0 right-3">
                <button class="border-0 w-38 h-38 d-flex align-items-center justify-content-center rounded-full p-0 bg-white text-primary">
                    <span class="material-symbols-outlined">
                        arrow_forward_ios
                    </span>
                </button>
            </div>
        </div>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="configuration-tabs1" role="tabpanel" aria-labelledby="configuration-custom-tab1" tabindex="0">
                <div class="pick-map mb-20 p-12 rounded d-flex flex-md-nowrap flex-wrap align-items-center gap-1 bg-primary bg-opacity-10">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_9464_2249)">
                        <path d="M9.79125 1.44318L10.5117 0.270677C10.6797 -0.00465646 11.039 -0.0898231 11.3138 0.0793436C11.5885 0.247927 11.6743 0.606677 11.5051 0.881427L10.7847 2.05393C10.675 2.23359 10.4831 2.33218 10.2871 2.33218C10.1827 2.33218 10.0777 2.30418 9.98259 2.24584C9.70784 2.07726 9.62209 1.71793 9.79125 1.44318ZM3.16575 2.05334C3.27542 2.23301 3.46792 2.33218 3.66392 2.33218C3.76775 2.33218 3.87275 2.30418 3.96784 2.24643C4.24259 2.07784 4.32892 1.71909 4.16034 1.44434L3.44109 0.27126C3.2725 -0.00348977 2.91317 -0.0892398 2.639 0.0787602C2.36425 0.247344 2.27792 0.606094 2.4465 0.880844L3.16575 2.05334ZM1.89059 3.34134L0.841754 2.83909C0.552421 2.69851 0.201838 2.82218 0.0641712 3.11326C-0.0752455 3.40376 0.0478378 3.75201 0.338338 3.89084L1.38717 4.39309C1.46825 4.43218 1.554 4.45084 1.63859 4.45084C1.85617 4.45084 2.065 4.32893 2.16475 4.11951C2.30417 3.82901 2.18109 3.48018 1.89059 3.34134ZM6.92067 2.33393C3.70417 2.38701 1.155 5.87301 2.9015 9.23068C3.16692 9.74051 3.56067 10.1675 3.98359 10.5566C4.144 10.7042 4.26825 10.8868 4.37442 11.0828H6.41667V8.05876C5.73942 7.81726 5.25 7.17559 5.25 6.41609C5.25 6.09351 5.51075 5.83276 5.83334 5.83276C6.15592 5.83276 6.41667 6.09351 6.41667 6.41609C6.41667 6.73868 6.678 6.99943 7 6.99943C7.322 6.99943 7.58334 6.73809 7.58334 6.41609C7.58334 6.09409 7.84409 5.83276 8.16667 5.83276C8.48925 5.83276 8.75 6.09351 8.75 6.41609C8.75 7.17559 8.26059 7.81726 7.58334 8.05876V11.0828H9.60634C9.73934 10.8547 9.91084 10.6394 10.1354 10.4522C10.5198 10.1313 10.8815 9.77376 11.1038 9.32518C12.117 7.27593 11.7151 5.09076 10.2719 3.67209C9.373 2.78776 8.18242 2.31468 6.92067 2.33393ZM4.662 12.4122C4.61534 13.2673 5.25584 14 6.11217 14H7.87442C8.68 14 9.33275 13.3473 9.33275 12.5417V12.25H4.65559C4.65559 12.3048 4.6655 12.3562 4.662 12.4122ZM13.9493 3.09168C13.8163 2.79826 13.4715 2.66584 13.1781 2.80001L12.0511 3.30868C11.7571 3.44109 11.6264 3.78643 11.7594 4.07984C11.8568 4.29568 12.0686 4.42343 12.2914 4.42343C12.3713 4.42343 12.453 4.40709 12.5306 4.37151L13.6576 3.86284C13.9516 3.73043 14.0823 3.38509 13.9493 3.09168Z" fill="#3C76F1"></path>
                        </g>
                        <defs>
                        <clipPath id="clip0_9464_2249">
                        <rect width="14" height="14" fill="white"></rect>
                        </clipPath>
                        </defs>
                    </svg>
                    <p class="fz-12">After configuration next go to setup <a href="#" class="text-primary fw-semibold text-decoration-underline">Authentication</a> . Otherwise firebase can’t work properly in your system.</p>
                </div>
                <div class="card mb-20">
                    <div class="card-body p-20">
                        <div class="row g-lg-4 g-4 align-items-center">
                            <div class="col-lg-3">
                                <h3 class="mb-2">{{translate('Firebase Configuration')}}</h3>
                                <p class="fz-12 mb-xl-3 mb-2">{{translate('Here fillup the following data & setup the firebase to work properly the notifications of your system.')}}</p>
                                <a href="#" class="fz-12 text-primary fw-semibold text-decoration-underline">Where to Get This Information</a>
                            </div>
                            <div class="col-lg-9">
                                <div class="bg-light rounded-2 p-20">
                                    <h5 class="mb-10 fw-normal">{{translate('Service Content')}}</h5>
                                    <div class="bg-white rounded-2 p-16">
                                        <div class="row g-xl-4 g-3">
                                            <div class="col-md-6">
                                                <div class="custom-radio">
                                                    <input type="radio" id="firebase-login-active1" name="status" value="1" checked="">
                                                    <label for="firebase-login-active1">
                                                        <h5 class="mb-1">{{translate('File Upload')}}</h5>
                                                        <p class="fz-12 max-w-250">{{translate('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet.')}}</p>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="custom-radio">
                                                    <input type="radio" id="firebase-login-active2" name="status" value="1">
                                                    <label for="firebase-login-active2">
                                                        <h5 class="mb-1">{{translate('File Content')}}</h5>
                                                        <p class="fz-12 max-w-250">{{translate('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet.')}}</p>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-20">
                    <div class="card-body p-20">
                        <div class="row g-3 mb-20 file-upload-div">
                            <div class="col-lg-6">
                                <div class="bg-primary d-flex align-items-center rounded-2 p-20 bg-opacity-10 h-100">
                                    <div class="boxes">
                                        <div class="d-flex align-items-center gap-1 text-primary mb-3">
                                            <img src="{{asset('/public/assets/admin-module/img/lights-icons.png')}}" class="svg" alt=""> <h4 class="text-primary">{{('Instructions')}}</h4>
                                        </div>
                                        <ul class="d-flex flex-column gap-2 px-3 mb-0">
                                            <li class="fz-12">{{translate('Upload file must be JASON file format in and click Update button.')}}
                                            </li>
                                            <li class="fz-12">{{translate('Without update the service File content can’t update properly and you can’t see the updated content in the field.')}}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="bg-light rounded-2 p-20">
                                    <div class="max-w-500 mx-auto">
                                        <div class="trigger-zip-hit position-relative overflow-hidden bg-white border-dashed rounded-2 mx-auto d-center p-30">
                                            <input type="file" accept=".zip" required style="position: absolute; width: 100%; height: 100%; opacity: 0; cursor: pointer;">                                
                                            <div class="global-upload-box">
                                                <div class="upload-content text-center">
                                                    <img class="mb-20" src="{{asset('public/assets/admin-module')}}/img/drop-upload-cloud.png" alt="" class="mb-15">                                                
                                                    <h5 class="mb-1 fw-normal"><strong class="text-primary">Click to upload</strong> or <strong>Drag & Drop</strong> here</h5>
                                                    <span class="fz-12 d-block mb-15">JASON file size no more than 10MB</span>                                                    
                                                </div>
                                            </div>                                
                                        </div>
                                        <div class="inside-upload-zipBox uploaded-zip-box-white mt-20">

                                        </div>
                                        <div class="d-flex justify-content-end gap-3">
                                            <button type="reset" class="btn btn--secondary rounded">{{translate('Reset')}}</button>
                                            <button type="button" class="btn btn--primary demo_check rounded" data-bs-toggle="modal" data-bs-target="#confirmation">{{translate('Update')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-light rounded-2 p-20">
                            <form action="">
                                @csrf
                                @method('PUT')
                                <div class="discount-type">
                                    <div class="row g-lg-4 g-4">
                                        <div class="col-md-12 col-12">
                                            @php
                                                $serviceFile = bs_data($dataValues, 'push_notification')['service_file_content'] ?? '';
                                                $serviceFileValue = is_array($serviceFile) ? json_encode($serviceFile) : $serviceFile;
                                            @endphp
                                            <div class="mb-4">
                                                <div class="">
                                                    <div class="mb-2 text-dark">{{translate('Service File content')}}
                                                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                            data-bs-placement="top"
                                                            title="{{translate('Service File content')}}"
                                                        >info</i>
                                                    </div>
                                                    <input name="party_name" value="push_notification" class="hide-div">
                                                    <textarea type="text" class="form-control" name="service_file_content" placeholder="{{translate('service_file_content')}} *" required="" readonly rows="15">{{ $serviceFileValue }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">                                        
                                            <div class="">
                                                <div class="mb-2 text-dark">{{translate('Api Key')}}
                                                    <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="{{translate('Api Key')}}"
                                                    >info</i>
                                                </div>
                                                <input type="text" placeholder="Ex: Smtp.amailtrap.io" class="form-control" name="apiKey" value="{{bs_data($dataValues,'firebase_message_config')['apiKey']??''}}" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="">
                                                <div class="mb-2 text-dark">{{translate('User Name')}}
                                                    <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="{{translate('Api Key')}}"
                                                    >info</i>
                                                </div>
                                                <input type="text" class="form-control" name="authDomain" value="{{bs_data($dataValues,'firebase_message_config')['authDomain']??''}}" autocomplete="off" placeholder="Ex: Smtp">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="">
                                                <div class="mb-2 text-dark">{{translate('Project ID')}}
                                                    <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="{{translate('User Name')}}"
                                                    >info</i>
                                                </div>
                                                <input type="text" class="form-control" name="projectId" value="{{bs_data($dataValues,'firebase_message_config')['projectId']??''}}" autocomplete="off" placeholder="Ex: 587">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="">
                                                <div class="mb-2 text-dark">{{translate('Storage Bucket')}}
                                                    <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="{{translate('Storage Bucket')}}"
                                                    >info</i>
                                                </div>
                                                <input type="text" class="form-control" name="storageBucket" value="{{bs_data($dataValues,'firebase_message_config')['storageBucket']??''}}" autocomplete="off" placeholder="Ex: yahoo">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="">
                                                <div class="mb-2 text-dark">{{translate('Messaging Sender ID')}}
                                                    <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="{{translate('Ex: example@demo.com')}}"
                                                    >info</i>
                                                </div>
                                                <input type="text" placeholder="Ex: example@demo.com " class="form-control" name="messagingSenderId" value="{{bs_data($dataValues,'firebase_message_config')['messagingSenderId']??''}}" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="">
                                                <div class="mb-2 text-dark">{{translate('App ID')}}
                                                    <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="{{translate('App ID')}}"
                                                    >info</i>
                                                </div>
                                                <input type="text" placeholder="Ex: Tis " class="form-control" name="appId" value="{{bs_data($dataValues,'firebase_message_config')['appId']??''}}" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="">
                                                <div class="mb-2 text-dark">{{translate('Measurement ID')}}
                                                    <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="{{translate('Measurement ID')}}"
                                                    >info</i>
                                                </div>
                                                <input type="text" placeholder="Ex: 123456789 " class="form-control" name="measurementId" value="{{bs_data($dataValues,'firebase_message_config')['measurementId']??''}}" autocomplete="off">                                            
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @can('configuration_update')
                                    <div class="d-flex justify-content-end pt-3 gap-xl-3 gap-2">
                                        <button type="reset" class="btn btn--secondary rounded">
                                            {{translate('reset')}}
                                        </button>
                                        <button type="submit" class="btn btn--primary rounded demo_check d-flex align-items-center gap-2">
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
                                            {{translate('Save Information')}}
                                        </button>
                                    </div>
                                @endcan
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="configuration-tabs2" role="tabpanel" aria-labelledby="configuration-custom-tab2" tabindex="0">
                <div class="pick-map mb-20 p-12 rounded d-flex flex-md-nowrap flex-wrap align-items-center gap-1 bg-primary bg-opacity-10">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_9464_2249)">
                        <path d="M9.79125 1.44318L10.5117 0.270677C10.6797 -0.00465646 11.039 -0.0898231 11.3138 0.0793436C11.5885 0.247927 11.6743 0.606677 11.5051 0.881427L10.7847 2.05393C10.675 2.23359 10.4831 2.33218 10.2871 2.33218C10.1827 2.33218 10.0777 2.30418 9.98259 2.24584C9.70784 2.07726 9.62209 1.71793 9.79125 1.44318ZM3.16575 2.05334C3.27542 2.23301 3.46792 2.33218 3.66392 2.33218C3.76775 2.33218 3.87275 2.30418 3.96784 2.24643C4.24259 2.07784 4.32892 1.71909 4.16034 1.44434L3.44109 0.27126C3.2725 -0.00348977 2.91317 -0.0892398 2.639 0.0787602C2.36425 0.247344 2.27792 0.606094 2.4465 0.880844L3.16575 2.05334ZM1.89059 3.34134L0.841754 2.83909C0.552421 2.69851 0.201838 2.82218 0.0641712 3.11326C-0.0752455 3.40376 0.0478378 3.75201 0.338338 3.89084L1.38717 4.39309C1.46825 4.43218 1.554 4.45084 1.63859 4.45084C1.85617 4.45084 2.065 4.32893 2.16475 4.11951C2.30417 3.82901 2.18109 3.48018 1.89059 3.34134ZM6.92067 2.33393C3.70417 2.38701 1.155 5.87301 2.9015 9.23068C3.16692 9.74051 3.56067 10.1675 3.98359 10.5566C4.144 10.7042 4.26825 10.8868 4.37442 11.0828H6.41667V8.05876C5.73942 7.81726 5.25 7.17559 5.25 6.41609C5.25 6.09351 5.51075 5.83276 5.83334 5.83276C6.15592 5.83276 6.41667 6.09351 6.41667 6.41609C6.41667 6.73868 6.678 6.99943 7 6.99943C7.322 6.99943 7.58334 6.73809 7.58334 6.41609C7.58334 6.09409 7.84409 5.83276 8.16667 5.83276C8.48925 5.83276 8.75 6.09351 8.75 6.41609C8.75 7.17559 8.26059 7.81726 7.58334 8.05876V11.0828H9.60634C9.73934 10.8547 9.91084 10.6394 10.1354 10.4522C10.5198 10.1313 10.8815 9.77376 11.1038 9.32518C12.117 7.27593 11.7151 5.09076 10.2719 3.67209C9.373 2.78776 8.18242 2.31468 6.92067 2.33393ZM4.662 12.4122C4.61534 13.2673 5.25584 14 6.11217 14H7.87442C8.68 14 9.33275 13.3473 9.33275 12.5417V12.25H4.65559C4.65559 12.3048 4.6655 12.3562 4.662 12.4122ZM13.9493 3.09168C13.8163 2.79826 13.4715 2.66584 13.1781 2.80001L12.0511 3.30868C11.7571 3.44109 11.6264 3.78643 11.7594 4.07984C11.8568 4.29568 12.0686 4.42343 12.2914 4.42343C12.3713 4.42343 12.453 4.40709 12.5306 4.37151L13.6576 3.86284C13.9516 3.73043 14.0823 3.38509 13.9493 3.09168Z" fill="#3C76F1"></path>
                        </g>
                        <defs>
                        <clipPath id="clip0_9464_2249">
                        <rect width="14" height="14" fill="white"></rect>
                        </clipPath>
                        </defs>
                    </svg>
                    <p class="fz-12">Please ensure that your firebase configuration is set up before using these features. Check <a href="#" class="text-primary fw-semibold text-decoration-underline">Firebase Configuration.</a></p>
                </div>
                <div class="card mb-3 view-details-container">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-xxl-8 col-md-6 mb-md-0 mb-2">
                                <h3 class="black-color mb-1 d-block">{{ translate('Firebase Authentication') }}</h3>
                                <p class="fz-12 text-c mb-0">{{translate('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet.')}}</p>
                            </div>
                            <div class="col-xxl-4 col-md-6">
                                <div class="d-flex flex-sm-nowrap flex-wrap justify-content-end justify-content-end align-items-center gap-sm-3 gap-2">
                                    <div class="view-btn  order-sm-0 order-3 fz-12 text-primary cursor-pointer fw-semibold d-flex align-items-center gap-1">
                                        View 
                                        <i class="material-symbols-outlined fz-14">arrow_downward</i>
                                    </div>
                                    <div class="mb-0">
                                        <label class="switcher">
                                            <input class="switcher_input section-toggle" type="checkbox"> 
                                            <span class="switcher_control"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 view-details">
                            <div class="body-bg rounded p-20 mb-20">
                                <div class="">
                                    <div class="mb-2 text-dark">{{translate('Web Api Key')}}
                                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                            data-bs-placement="top"
                                            title="{{translate('Web Api Key')}}"
                                        >info</i>
                                    </div>
                                    <input type="text" placeholder="Ex: Smtp.amailtrap.io " class="form-control" name="measurementId" value="">                                    
                                </div>
                            </div>
                            <div class="d-flex justify-content-end gap-3">
                                <button type="reset" class="btn btn--secondary rounded">{{translate('Reset')}}</button>
                                <button type="button" class="btn btn--primary demo_check rounded" data-bs-toggle="modal" data-bs-target="#confirmation">{{translate('Save Information')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
        </div>
    </div>
</div>

<!-- Payment Methods Start -->
<div class="main-content mb-5">
    <div class="container-fluid">
        <div class="page-title-wrap mb-3">
            <h2 class="page-title">{{translate('Payment Methods Setup')}}</h2>
        </div>
        <div class="mb-20 nav-tabs-responsive position-relative">
            <ul class="nav nav--tabs scrollbar-w flex-nowrap white-nowrap overflow-x-auto flex-wrap-nowrap nav--tabs__style2">
                <li class="nav-item">
                    <a href="#" class="nav-link active" id="payment-custom-tab1" data-bs-toggle="tab" data-bs-target="#payment-tabs1" type="button" role="tab" aria-controls="payment-tabs1" aria-selected="false">
                        {{translate('Digital Payment')}}
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" id="payment-custom-tab2" data-bs-toggle="tab" data-bs-target="#payment-tabs2" type="button" role="tab" aria-controls="payment-tabs2" aria-selected="false">
                        {{translate('Offline Payment')}}
                    </a>
                </li> 
            </ul>
            <div class="nav--tab__prev position-absolute top-0 start-3">
                <button class="border-0 w-38 h-38 d-flex align-items-center justify-content-center rounded-full p-0 bg-white text-primary">
                    <span class="material-symbols-outlined">
                        arrow_back_ios
                    </span>
                </button>
            </div>
            <div class="nav--tab__next position-absolute top-0 right-3">
                <button class="border-0 w-38 h-38 d-flex align-items-center justify-content-center rounded-full p-0 bg-white text-primary">
                    <span class="material-symbols-outlined">
                        arrow_forward_ios
                    </span>
                </button>
            </div>
        </div>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="payment-tabs1" role="tabpanel" aria-labelledby="payment-custom-tab1" tabindex="0">
                <div class="bg-warning bg-opacity-10 fs-12 p-12 text-dark rounded mb-10">
                    <div class="d-flex align-items-center gap-2 mb-2">
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
                        <p class="fz-12 fw-medium">Here you can configure payment gateways by obtaining the necessary credentials (e.g., API keys) from each respective payment gateway platform.</p>
                    </div>
                    <ul class="m-0 ps-20 d-flex flex-column gap-1 text-dark">
                        <li>To use digital payments, you need to set up at least one payment method</li>
                        <li>To make available these payment options, you must enable the Digital payment option from <span class="fw-semibold text-dark text-decoration-underline">Business Information</span> page.</li>
                    </ul>
                </div>
                <div class="mb-15 bg-danger bg-opacity-10 fs-12 p-10 rounded d-flex gap-2 align-items-center">
                    <span class="material-symbols-outlined text-danger">
                        warning
                    </span>
                    <span>
                        Currently no payment gateway supported your currency. Active at least one gateway that support your currency. To change currency setup visit <span class="fw-medium text-primary text-decoration-underline">Currency</span> page 
                    </span>
                </div>
                <div class="card">
                    <div class="card-body p-20">
                        <div class="d-flex align-items-center flex-wrap gap-10 justify-content-between mb-20">
                            <h4>{{translate('Digital Payment Methods List')}}</h4>
                            <form action="#0" class="d-flex align-items-center gap-0 border rounded" method="POST">
                                @csrf
                                <input type="search" class="theme-input-style border-0 rounded block-size-36" value="" name="search" placeholder="{{translate('search_here')}}">
                                <button type="submit" class="bg-light border-0 px-2 block-size-36 rounded-end d-flex align-items-center justify-content-center">
                                    <span class="material-symbols-outlined fz-20 opacity-75">
                                        search
                                    </span>
                                </button>                                                    
                            </form>
                        </div>  
                        <div class="row g-4">
                            <div class="col-lg-6">
                                <div class="cus-shadow2 payment-test__wrap p-20 d-flex align-items-center justify-content-between flex-wrap gap-2">
                                    <div class="d-flex align-items-center gap-2">
                                        <h5 class="text-dark">{{translate('PayPal')}}</h5> <span class="bg-primary payment-test bg-opacity-10 rounded py-1 px-2 text-primary fz-12">Test</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-xxl-4 gap-xl-3 gap-2">
                                        <label class="switcher" data-bs-toggle="modal" data-bs-target="#turnOnStatus">
                                            <input class="switcher_input payment__toggle" type="checkbox" name="can" value="">
                                            <span class="switcher_control"></span>
                                        </label>
                                        <button type="button" class="action-btn btn--danger delete_section" data-bs-toggle="offcanvas" data-bs-target="#payment-setup-edit">
                                            <span class="material-icons">settings</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="cus-shadow2 payment-test__wrap p-20 d-flex align-items-center justify-content-between flex-wrap gap-2">
                                    <div class="d-flex align-items-center gap-2">
                                        <h5 class="text-dark">{{translate('Mercado Pago')}}</h5> <span class="bg-primary payment-test bg-opacity-10 rounded py-1 px-2 text-primary fz-12">Test</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-xxl-4 gap-xl-3 gap-2">
                                        <label class="switcher" data-bs-toggle="modal" data-bs-target="#turnOnStatus">
                                            <input class="switcher_input payment__toggle" type="checkbox" name="can" value="">
                                            <span class="switcher_control"></span>
                                        </label>
                                        <button type="button" class="action-btn btn--danger delete_section" data-bs-toggle="offcanvas" data-bs-target="#payment-setup-edit">
                                            <span class="material-icons">settings</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="cus-shadow2 payment-test__wrap p-20 d-flex align-items-center justify-content-between flex-wrap gap-2">
                                    <div class="d-flex align-items-center gap-2">
                                        <h5 class="text-dark">{{translate('Bkash')}}</h5> <span class="bg-primary payment-test bg-opacity-10 rounded py-1 px-2 text-primary fz-12">Test</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-xxl-4 gap-xl-3 gap-2">
                                        <label class="switcher" data-bs-toggle="modal" data-bs-target="#turnOnStatus">
                                            <input class="switcher_input payment__toggle" type="checkbox" name="can" value="">
                                            <span class="switcher_control"></span>
                                        </label>
                                        <button type="button" class="action-btn btn--danger delete_section" data-bs-toggle="offcanvas" data-bs-target="#payment-setup-edit">
                                            <span class="material-icons">settings</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="cus-shadow2 payment-test__wrap p-20 d-flex align-items-center justify-content-between flex-wrap gap-2">
                                    <div class="d-flex align-items-center gap-2">
                                        <h5 class="text-dark">{{translate('PAYTM')}}</h5> <span class="bg-primary payment-test bg-opacity-10 rounded py-1 px-2 text-primary fz-12">Test</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-xxl-4 gap-xl-3 gap-2">
                                        <label class="switcher" data-bs-toggle="modal" data-bs-target="#turnOnStatus">
                                            <input class="switcher_input payment__toggle" type="checkbox" name="can" value="">
                                            <span class="switcher_control"></span>
                                        </label>
                                        <button type="button" class="action-btn btn--danger delete_section" data-bs-toggle="offcanvas" data-bs-target="#payment-setup-edit">
                                            <span class="material-icons">settings</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="cus-shadow2 payment-test__wrap p-20 d-flex align-items-center justify-content-between flex-wrap gap-2">
                                    <div class="d-flex align-items-center gap-2">
                                        <h5 class="text-dark">{{translate('Senang Pay')}}</h5> <span class="bg-primary payment-test bg-opacity-10 rounded py-1 px-2 text-primary fz-12">Test</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-xxl-4 gap-xl-3 gap-2">
                                        <label class="switcher" data-bs-toggle="modal" data-bs-target="#turnOnStatus">
                                            <input class="switcher_input payment__toggle" type="checkbox" name="can" value="">
                                            <span class="switcher_control"></span>
                                        </label>
                                        <button type="button" class="action-btn btn--danger delete_section" data-bs-toggle="offcanvas" data-bs-target="#payment-setup-edit">
                                            <span class="material-icons">settings</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="cus-shadow2 payment-test__wrap p-20 d-flex align-items-center justify-content-between flex-wrap gap-2">
                                    <div class="d-flex align-items-center gap-2">
                                        <h5 class="text-dark">{{translate('SSLCommerz')}}</h5> <span class="bg-primary payment-test bg-opacity-10 rounded py-1 px-2 text-primary fz-12">Test</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-xxl-4 gap-xl-3 gap-2">
                                        <label class="switcher" data-bs-toggle="modal" data-bs-target="#turnOnStatus">
                                            <input class="switcher_input payment__toggle" type="checkbox" name="can" value="">
                                            <span class="switcher_control"></span>
                                        </label>
                                        <button type="button" class="action-btn btn--danger delete_section" data-bs-toggle="offcanvas" data-bs-target="#payment-setup-edit">
                                            <span class="material-icons">settings</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="cus-shadow2 payment-test__wrap p-20 d-flex align-items-center justify-content-between flex-wrap gap-2">
                                    <div class="d-flex align-items-center gap-2">
                                        <h5 class="text-dark">{{translate('Flutter Wave')}}</h5> <span class="bg-primary payment-test bg-opacity-10 rounded py-1 px-2 text-primary fz-12">Test</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-xxl-4 gap-xl-3 gap-2">
                                        <label class="switcher" data-bs-toggle="modal" data-bs-target="#turnOnStatus">
                                            <input class="switcher_input payment__toggle" type="checkbox" name="can" value="">
                                            <span class="switcher_control"></span>
                                        </label>
                                        <button type="button" class="action-btn btn--danger delete_section" data-bs-toggle="offcanvas" data-bs-target="#payment-setup-edit">
                                            <span class="material-icons">settings</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="cus-shadow2 payment-test__wrap p-20 d-flex align-items-center justify-content-between flex-wrap gap-2">
                                    <div class="d-flex align-items-center gap-2">
                                        <h5 class="text-dark">{{translate('Paystack')}}</h5> <span class="bg-primary payment-test bg-opacity-10 rounded py-1 px-2 text-primary fz-12">Test</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-xxl-4 gap-xl-3 gap-2">
                                        <label class="switcher" data-bs-toggle="modal" data-bs-target="#turnOnStatus">
                                            <input class="switcher_input payment__toggle" type="checkbox" name="can" value="">
                                            <span class="switcher_control"></span>
                                        </label>
                                        <button type="button" class="action-btn btn--danger delete_section" data-bs-toggle="offcanvas" data-bs-target="#payment-setup-edit">
                                            <span class="material-icons">settings</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="payment-tabs2" role="tabpanel" aria-labelledby="payment-custom-tab2" tabindex="0">
                <div class="bg-warning bg-opacity-10 fs-12 p-12 text-dark rounded mb-10">
                    <div class="d-flex align-items-center gap-2 mb-2">
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
                        <p class="fz-12 fw-medium">Here you can configure payment gateways by obtaining the necessary credentials (e.g., API keys) from each respective payment gateway platform.</p>
                    </div>
                    <ul class="m-0 ps-20 d-flex flex-column gap-1 text-dark">
                        <li>To use digital payments, you need to set up at least one payment method</li>
                        <li>To make available these payment options, you must enable the Digital payment option from <span class="fw-semibold text-dark text-decoration-underline">Business Information</span> page.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>        
</div>    



<!-- Payment Setup Offcanvas -->
<form action="" method="post" id="update-form-submit">
    @csrf
    <div class="offcanvas offcanvas-end offcanvas-cus-sm" tabindex="-1" id="payment-setup-edit" aria-labelledby="payment-setup-editLabel">
        <div class="offcanvas-header py-md-4 py-3">
            <h2 class="mb-0">{{translate('Setup - Marcado Pago')}}</h2>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body bg-white">
            <div class="body-bg rounded p-20 mb-20">
                <div class="mb-15">
                    <h4 class="mb-1">{{translate('Mercado Pago')}}</h4>
                    <p class="fz-12">{{translate('If you turn off customer can`t pay through this payment geteway.')}}</p>
                </div>
                <div class="border rounded py-3 px-3 bg-white d-flex align-items-center justify-content-between">
                    <h5 class="fw-normal">{{translate('Select social media')}}</h5>
                    <label class="switcher">
                        <input class="switcher_input" type="checkbox" name="can" value="">
                        <span class="switcher_control"></span>
                    </label>
                </div>
            </div>
            <div class="body-bg rounded-2 p-20 mb-20">
                <div class="boxes">
                    <div class="mb-20 text-start">
                        <h5 class="fz-16 mb-1">{{translate('Choose Logo')}} <span class="text-danger">*</span></h5>
                        <p class="fz-12">It will show in website & app.</p>
                    </div>
                    <div class="global-image-upload position-relative max-w-100 overflow-hidden bg-white border-dashed rounded-2 mx-auto mb-20 ratio-3-1 h-100px d-center">
                        <input type="file" accept="image/*" required style="position: absolute; width: 100%; height: 100%; opacity: 0; cursor: pointer;">                                
                        <div class="global-upload-box">
                            <div class="upload-content text-center">
                                <span class="material-symbols-outlined placeholder-icon mb-1 text-primary">photo_camera</span>
                                <span class="fz-10 d-block">Add image</span>
                            </div>
                        </div>                                
                        <img class="global-image-preview d-none" src="" alt="Preview" style="max-height: 100%; max-width: 100%;" />
                        <div class="overlay-icons d-none">
                            <button type="button" class="action-btn btn--light-primary bg-white outline-primary-hover edit-icon" title="Edit">
                                <span class="material-icons">edit</span>
                            </button>
                        </div>
                        <div class="image-file-name d-none mt-2 text-center text-muted" style="font-size: 12px;"></div>
                    </div>
                    <p class="fz-12 mt-lg-4 mt-3 text-center">JPG, JPEG, PNG Less Than 1MB <span class="fw-medium text-dark">(Ratio 3 : 1)</span></p>
                </div>
            </div>
            <div class="body-bg rounded-2 p-20 d-flex flex-column gap-lg-4 gap-3">
                <div>
                    <div class="mb-2 text-dark">{{translate('Choose Use Type')}}
                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="{{translate('Choose Use Type')}}"
                        >info</i>
                    </div>
                    <div class="border setup-box p-12 rounded d-flex align-items-center gap-xl-5 gap-3">
                        <div class="custom-radio">
                            <input type="radio" id="lives" name="choose" value="1">
                            <label for="lives" class="fz-14 text-dark">Live</label>
                        </div>
                        <div class="custom-radio">
                            <input type="radio" id="tests" name="choose" value="1">
                            <label for="tests" class="fz-14 text-dark">Test</label>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="mb-2 text-dark">{{translate('Payment Gateway Title')}}
                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="{{translate('Choose Payment Gateway')}}"
                        >info</i>
                    </div>
                    <input type="number" class="form-control" name="payment-geteway" placeholder="Ex: 587" required="" value="1">
                </div>
                <div>
                    <div class="mb-2 text-dark">{{translate('Access Token')}}
                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="{{translate('Copy Access Token')}}"
                        >info</i>
                    </div>
                    <div class="copy-text border rounded py-2 h-46 px-3 bg-white position-relative d-flex justify-content-between gap-1">
                        <input type="text" class="text border-0 text-light-gray bg-transparent w-100 pe-3" value="https://Demandium.6amtech.com/customer/auth/login/google/callback" />
                        <button class="border-0 outline-0 text-primary p-0 bg-transparent"><span class="material-symbols-outlined">content_copy</span></button>
                    </div>
                </div>
                <div>
                    <div class="mb-2 text-dark">{{translate('Public Key')}}
                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="{{translate('Copy Public Key')}}"
                        >info</i>
                    </div>
                    <div class="copy-text border rounded py-2 h-46 px-3 bg-white position-relative d-flex justify-content-between gap-1">
                        <input type="text" class="text border-0 text-light-gray bg-transparent w-100 pe-3" value="https://Demandium.6amtech.com/customer/auth/login/google/callback" />
                        <button class="border-0 outline-0 text-primary p-0 bg-transparent"><span class="material-symbols-outlined">content_copy</span></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="offcanvas-footer border-top">
            <div class="d-flex justify-content-center gap-2 bg-white px-3 py-sm-3 py-2">
                <button class="btn btn--secondary w-100 rounded h-45" type="reset">{{translate('Reset')}}</button>
                <button class="btn btn--primary w-100 rounded h-45" type="submit">{{translate('Save')}}</button>
            </div>
        </div>
    </div>
</form>

<!--Status On Modal--> 
<div class="modal fade custom-confirmation-modal" id="turnOnStatus" tabindex="-1" aria-labelledby="statusonModelLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-30">
                <button type="button" class="btn-close bg-light rounded-full" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="d-flex flex-column align-items-center text-center">
                    <img class="mb-20" src="{{asset('public/assets/admin-module')}}/img/status-on.png" alt="">
                    <h3 class="mb-15">{{ translate('Turn ON PayPal Payment Method')}}</h3>
                    <p class="mb-4 fz-14">{{ translate('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet ')}}</p>
                    <form action="{{ route('admin.subscription.package.subscription-to-commission') }}" method="post">
                        @csrf
                        <div class="choose-option">
                            <div class="d-flex gap-3 justify-content-center flex-wrap">
                                <button type="button" class="btn px-xl-5 px-4 btn--secondary rounded" data-bs-dismiss="modal">NO</button>
                                <button type="button" class="btn px-xl-5 px-4 btn--primary text-capitalize rounded">Yes</button>                                              
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>













    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-wrap mb-3">
                        <h2 class="page-title">{{translate('3rd_party')}}</h2>
                    </div>

                    <div class="mb-3">
                        <ul class="nav nav--tabs nav--tabs__style2">
                            @include('businesssettingsmodule::admin.partials.third-party-partial')
                        </ul>
                    </div>

                    @if($webPage == 'google_map')
                        <div class="tab-content">
                            <div class="tab-pane fade {{$webPage == 'google_map' ? 'show active' : ''}}"
                                 id="google-map">
                                 <div class="pick-map mb-15 p-12 rounded d-flex flex-md-nowrap flex-wrap align-items-center gap-1 bg-primary bg-opacity-10">
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_9464_2249)">
                                        <path d="M9.79125 1.44318L10.5117 0.270677C10.6797 -0.00465646 11.039 -0.0898231 11.3138 0.0793436C11.5885 0.247927 11.6743 0.606677 11.5051 0.881427L10.7847 2.05393C10.675 2.23359 10.4831 2.33218 10.2871 2.33218C10.1827 2.33218 10.0777 2.30418 9.98259 2.24584C9.70784 2.07726 9.62209 1.71793 9.79125 1.44318ZM3.16575 2.05334C3.27542 2.23301 3.46792 2.33218 3.66392 2.33218C3.76775 2.33218 3.87275 2.30418 3.96784 2.24643C4.24259 2.07784 4.32892 1.71909 4.16034 1.44434L3.44109 0.27126C3.2725 -0.00348977 2.91317 -0.0892398 2.639 0.0787602C2.36425 0.247344 2.27792 0.606094 2.4465 0.880844L3.16575 2.05334ZM1.89059 3.34134L0.841754 2.83909C0.552421 2.69851 0.201838 2.82218 0.0641712 3.11326C-0.0752455 3.40376 0.0478378 3.75201 0.338338 3.89084L1.38717 4.39309C1.46825 4.43218 1.554 4.45084 1.63859 4.45084C1.85617 4.45084 2.065 4.32893 2.16475 4.11951C2.30417 3.82901 2.18109 3.48018 1.89059 3.34134ZM6.92067 2.33393C3.70417 2.38701 1.155 5.87301 2.9015 9.23068C3.16692 9.74051 3.56067 10.1675 3.98359 10.5566C4.144 10.7042 4.26825 10.8868 4.37442 11.0828H6.41667V8.05876C5.73942 7.81726 5.25 7.17559 5.25 6.41609C5.25 6.09351 5.51075 5.83276 5.83334 5.83276C6.15592 5.83276 6.41667 6.09351 6.41667 6.41609C6.41667 6.73868 6.678 6.99943 7 6.99943C7.322 6.99943 7.58334 6.73809 7.58334 6.41609C7.58334 6.09409 7.84409 5.83276 8.16667 5.83276C8.48925 5.83276 8.75 6.09351 8.75 6.41609C8.75 7.17559 8.26059 7.81726 7.58334 8.05876V11.0828H9.60634C9.73934 10.8547 9.91084 10.6394 10.1354 10.4522C10.5198 10.1313 10.8815 9.77376 11.1038 9.32518C12.117 7.27593 11.7151 5.09076 10.2719 3.67209C9.373 2.78776 8.18242 2.31468 6.92067 2.33393ZM4.662 12.4122C4.61534 13.2673 5.25584 14 6.11217 14H7.87442C8.68 14 9.33275 13.3473 9.33275 12.5417V12.25H4.65559C4.65559 12.3048 4.6655 12.3562 4.662 12.4122ZM13.9493 3.09168C13.8163 2.79826 13.4715 2.66584 13.1781 2.80001L12.0511 3.30868C11.7571 3.44109 11.6264 3.78643 11.7594 4.07984C11.8568 4.29568 12.0686 4.42343 12.2914 4.42343C12.3713 4.42343 12.453 4.40709 12.5306 4.37151L13.6576 3.86284C13.9516 3.73043 14.0823 3.38509 13.9493 3.09168Z" fill="#3C76F1"></path>
                                        </g>
                                        <defs>
                                        <clipPath id="clip0_9464_2249">
                                        <rect width="14" height="14" fill="white"></rect>
                                        </clipPath>
                                        </defs>
                                    </svg>
                                    <p class="fz-12"> <a href="#" class="text-primary fw-semibold text-decoration-underline">Client Key</a> should have enable map  <a href="#" class="text-primary fw-semibold text-decoration-underline">Javascript API</a> and you can restrict it with http refer  <a href="#" class="text-primary fw-semibold text-decoration-underline">Server Key</a> should have enable place api key and you can restrict it with ip You can use same api for both field without any restrictions.</p>
                                </div>
                                <div class="bg-warning bg-opacity-10 fs-12 p-12 rounded mb-15">
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
                                        <p class="fz-12 fw-normal">Without configuring this section map functionality will not work properly thus the whole system will not work as it planned</p>
                                    </div>
                                </div>
                                <button type="button" class="rounded transition text-nowrap fz-12 mb-3 fw-semibold btn  d-flex align-items-center gap-1 py-2 px-3" data-bs-toggle="modal" data-bs-target="#map__view__error">
                                    <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_10110_6239)">
                                        <path d="M0.68973 6.18108C0.889813 5.45192 1.38156 4.83067 2.06348 4.47483L2.6579 4.22108C2.77165 5.19642 3.20623 6.10117 3.91965 6.814L4.9889 7.85992C5.52673 8.3855 6.24073 8.67542 6.99965 8.67542C7.75856 8.67542 8.47315 8.3855 9.01098 7.85992L10.0931 6.80117C10.8001 6.09475 11.2329 5.18767 11.3443 4.20825C11.3443 4.20825 11.9154 4.44625 11.9271 4.4515C12.7589 4.86625 13.3195 5.66367 13.428 6.58533L13.5691 7.78292L6.20923 11.1919L0.68973 6.18108ZM13.7115 9.00325L7.14606 12.0442L9.84923 14.4994H11.2761C12.0577 14.4994 12.8044 14.1646 13.3236 13.5801C13.8433 12.9962 14.0889 12.2157 13.9979 11.4387L13.7115 9.00325ZM0.490813 7.57583L0.0363964 11.4387C-0.055187 12.2151 0.190396 12.9962 0.710146 13.5801C1.2299 14.1646 1.97598 14.4994 2.75765 14.4994H8.11498L0.490813 7.57583ZM10.208 3.70775C10.208 4.56525 9.87431 5.37083 9.26823 5.97633L8.1949 7.02692C7.86531 7.3495 7.43248 7.50992 6.99965 7.50992C6.56681 7.50992 6.13456 7.3495 5.80498 7.02692L4.73573 5.981C4.12498 5.37083 3.79131 4.56467 3.79131 3.70833C3.79131 2.852 4.12498 2.04525 4.73106 1.43975C5.33715 0.833667 6.14273 0.5 6.99965 0.5C7.85656 0.5 8.66215 0.833667 9.26823 1.43975C9.87431 2.04583 10.208 2.85083 10.208 3.70775ZM7.87465 3.70425C7.87465 3.22125 7.48265 2.82925 6.99965 2.82925C6.51665 2.82925 6.12465 3.22125 6.12465 3.70425C6.12465 4.18725 6.51665 4.57925 6.99965 4.57925C7.48265 4.57925 7.87465 4.18725 7.87465 3.70425Z" fill="#0461A5"/>
                                        </g>
                                        <defs>
                                        <clipPath id="clip0_10110_6239">
                                        <rect width="14" height="14" fill="white" transform="translate(0 0.5)"/>
                                        </clipPath>
                                        </defs>
                                    </svg>
                                    Map View Error 
                                </button>
                                <div class="card">
                                    <div class="card-body p-20">
                                        <div class="d-flex align-items-center justify-content-between flex-sm-nowrap flex-wrap gap-3 mb-20">
                                            <div>
                                                <h4 class="page-title mb-1">{{translate('Google Map API')}}</h4>
                                                <p class="mb-0 fz-12">{{translate('Fill-up google APIs credentials to setup & active google map integration to your system.')}}</p>
                                            </div>
                                            <button type="button" class="rounded transition text-nowrap fz-12 fw-semibold btn-primary__outline btn d-flex align-items-center gap-1 py-2 px-3" data-bs-toggle="modal" data-bs-target="#map__view">
                                                <span class="material-symbols-outlined m-0">
                                                map
                                                </span>
                                                Test Map View
                                            </button>
                                        </div>
                                        <form action="{{route('admin.configuration.set-third-party-config')}}"
                                              method="POST"
                                              id="google-map-update-form" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="discount-type body-bg rounded p-20 mb-20">
                                                <div class="row g-4">
                                                    <div class="col-md-6 col-12">
                                                        <div class="">
                                                            <label class="mb-2 text-dark">{{translate('map_api_key_server')}}
                                                                <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    title="{{translate('Map api key')}}"
                                                                >info</i>
                                                            </label>
                                                            <input name="party_name" value="google_map"
                                                                   class="hide-div">
                                                            <input type="text" class="form-control"
                                                                   name="map_api_key_server"
                                                                   placeholder="{{translate('map_api_key_server')}} *"
                                                                   required=""
                                                                   value="{{bs_data($dataValues,'google_map')['map_api_key_server']??''}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="">
                                                            <label class="mb-2 text-dark">{{translate('map_api_key_client')}}
                                                                <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    title="{{translate('Map api key')}}"
                                                                >info</i>
                                                            </label>
                                                            <input type="text" class="form-control"
                                                                   name="map_api_key_client"
                                                                   placeholder="{{translate('map_api_key_client')}} *"
                                                                   required=""
                                                                   value="{{bs_data($dataValues,'google_map')['map_api_key_client']??''}}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @can('configuration_update')
                                                <div class="d-flex justify-content-end gap-xl-3 gap-2">
                                                    <button type="reset" class="btn btn--secondary rounded">
                                                        {{translate('reset')}}
                                                    </button>
                                                    <button type="submit" class="btn btn--primary demo_check rounded">
                                                        {{translate('update')}}
                                                    </button>
                                                </div>
                                            @endcan
                                        </form>
                                    </div>
                                </div>
                                <!-- <div class="card">
                                    <div class="card-header">
                                        <h4 class="page-title">{{translate('google_map_api_key_setup')}}</h4>
                                    </div>
                                    <div class="card-body p-30">
                                        <div class="alert alert-danger mb-30">
                                            <p><i class="material-icons">info</i>
                                                {{translate('Client Key Should Have Enable Map Javascript Api And You Can Restrict It With Http Refere. Server Key Should Have Enable Place Api Key And You Can Restrict It With Ip. You Can Use Same Api For Both Field Without Any Restrictions.')}}
                                            </p>
                                        </div>
                                        <form action="{{route('admin.configuration.set-third-party-config')}}"
                                              method="POST"
                                              id="google-map-update-form" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="discount-type body-bg rounded p-20 mb-20">
                                                <div class="row">
                                                    <div class="col-md-6 col-12">
                                                        <div class="mb-30">
                                                            <div class="form-floating">
                                                                <input name="party_name" value="google_map"
                                                                       class="hide-div">
                                                                <input type="text" class="form-control"
                                                                       name="map_api_key_server"
                                                                       placeholder="{{translate('map_api_key_server')}} *"
                                                                       required=""
                                                                       value="{{bs_data($dataValues,'google_map')['map_api_key_server']??''}}">
                                                                <label>{{translate('map_api_key_server')}} *</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="mb-30">
                                                            <div class="form-floating">
                                                                <input type="text" class="form-control"
                                                                       name="map_api_key_client"
                                                                       placeholder="{{translate('map_api_key_client')}} *"
                                                                       required=""
                                                                       value="{{bs_data($dataValues,'google_map')['map_api_key_client']??''}}">
                                                                <label>{{translate('map_api_key_client')}} *</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @can('configuration_update')
                                                <div class="d-flex justify-content-end">
                                                    <button type="submit" class="btn btn--primary demo_check">
                                                        {{translate('update')}}
                                                    </button>
                                                </div>
                                            @endcan
                                        </form>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    @endif

                    <!-- @if($webPage == 'push_notification')
                        <div class="tab-content">
                            <div class="tab-pane fade {{$webPage == 'push_notification' ? 'show active' : ''}}"
                                 id="firebase-push-notification">
                                <div class="card">
                                    <div class="card-header">

                                        <div class="d-flex justify-content-between mb-5">
                                            <div class="page-header align-items-center">
                                                <h4>{{translate('Firebase_Notification_Setup')}}</h4>
                                            </div>
                                            <div class="d-flex align-items-center gap-3 font-weight-bolder">
                                                {{ translate('Read Instructions') }}
                                                <div class="ripple-animation" data-bs-toggle="modal"
                                                     data-bs-target="#carouselModal" type="button">
                                                    <img src="{{asset('/public/assets/admin-module/img/info.svg')}}"
                                                         class="svg"
                                                         alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body p-30">
                                        <form action="{{route('admin.configuration.set-third-party-config')}}"
                                              method="POST"
                                              id="firebase-form" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="discount-type">
                                                <div class="row">
                                                    <div class="col-md-12 col-12 d--none">
                                                        <div class="mb-30">
                                                            <div class="form-floating">
                                                                <input name="party_name" value="push_notification"
                                                                       class="hide-div">
                                                                <input type="text" class="form-control"
                                                                       name="server_key"
                                                                       placeholder="{{translate('server_key')}} *"
                                                                       value="{{bs_data($dataValues,'push_notification')['server_key']??''}}">
                                                                <label>{{translate('server_key')}} *</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-12">
                                                        <div class="d-flex align-items-center gap-4 gap-xl-5">
                                                            <div class="custom-radio">
                                                                <input type="radio" id="active" name="firebase_content_type"
                                                                       value="file" checked>
                                                                <label for="active">{{translate('File Upload')}}</label>
                                                            </div>
                                                            <div class="custom-radio">
                                                                <input type="radio" id="inactive" name="firebase_content_type"
                                                                       value="file_content">
                                                                <label for="inactive">{{translate('File Content')}}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-12 file-upload-div">
                                                        <div class="form-floating mb-30 mt-30">
                                                            <input type="file" accept=".json" class="form-control"
                                                                   name="service_file"
                                                                   value="">
                                                            <label>{{translate('service_file')}}</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-12 mt-4">
                                                        @php
                                                            $serviceFile = bs_data($dataValues, 'push_notification')['service_file_content'] ?? '';
                                                            $serviceFileValue = is_array($serviceFile) ? json_encode($serviceFile) : $serviceFile;
                                                        @endphp
                                                        <div class="mb-30">
                                                            <div class="form-floating">
                                                                <input name="party_name" value="push_notification"
                                                                       class="hide-div">
                                                                <textarea type="text" class="form-control"
                                                                       name="service_file_content"
                                                                       placeholder="{{translate('service_file_content')}} *"
                                                                       required="" readonly rows="15">{{ $serviceFileValue }}</textarea>
                                                                <label>{{translate('service_file_content')}} *</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-floating">
                                                <label class="form-label">API Key</label><br>
                                                <input type="text" placeholder="Ex : " class="form-control" name="apiKey" value="{{bs_data($dataValues,'firebase_message_config')['apiKey']??''}}" autocomplete="off">
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 col-sm-6">
                                                    <div class="form-floating">
                                                        <label class="form-label">Project ID</label><br>
                                                        <input type="text" class="form-control" name="projectId" value="{{bs_data($dataValues,'firebase_message_config')['projectId']??''}}" autocomplete="off" placeholder="Ex : ">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-6">
                                                    <div class="form-floating">
                                                        <label class="form-label">Auth Domain</label><br>
                                                        <input type="text" class="form-control" name="authDomain" value="{{bs_data($dataValues,'firebase_message_config')['authDomain']??''}}" autocomplete="off" placeholder="Ex : ">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-6">
                                                    <div class="form-floating">
                                                        <label class="form-label">Storage Bucket</label><br>
                                                        <input type="text" class="form-control" name="storageBucket" value="{{bs_data($dataValues,'firebase_message_config')['storageBucket']??''}}" autocomplete="off" placeholder="Ex : ">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-6">
                                                    <div class="form-floating">
                                                        <label class="form-label">Messaging Sender ID</label><br>
                                                        <input type="text" placeholder="Ex : " class="form-control" name="messagingSenderId" value="{{bs_data($dataValues,'firebase_message_config')['messagingSenderId']??''}}" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-6">
                                                    <div class="form-floating">
                                                        <label class="form-label">App ID</label><br>
                                                        <input type="text" placeholder="Ex : " class="form-control" name="appId" value="{{bs_data($dataValues,'firebase_message_config')['appId']??''}}" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-6">
                                                    <div class="form-floating">
                                                        <label class="form-label">Measurement ID</label><br>
                                                        <input type="text" placeholder="Ex : " class="form-control" name="measurementId" value="{{bs_data($dataValues,'firebase_message_config')['measurementId']??''}}" autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                            @can('configuration_update')
                                                <div class="d-flex justify-content-end pt-3">
                                                    <button type="submit" class="btn btn--primary demo_check">
                                                        {{translate('update')}}
                                                    </button>
                                                </div>
                                            @endcan
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade firebase-modal" id="carouselModal" tabindex="-1"
                             aria-labelledby="carouselModal"
                             aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header border-0 pb-1">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body px-4 px-sm-5 pt-0">
                                        <div dir="ltr" class="swiper modalSwiper pb-4">
                                            <div class="swiper-wrapper">
                                                <div class="swiper-slide">
                                                    <div class="d-flex flex-column align-items-center gap-2 fs-12">
                                                        <img width="80" class="mb-3"
                                                             src="{{asset('public/assets/admin-module/img/media/firebase-console.png')}}"
                                                             alt="">
                                                        <h5 class="modal-title text-center mb-3">Go to Firebase
                                                            Console</h5>

                                                        <ul class="d-flex flex-column gap-2 px-3">
                                                            <li>{{translate('Open your web browser and go to the Firebase Console')}}
                                                                (
                                                                <a
                                                                    href="https://console.firebase.google.com">https://console.firebase.google.com/</a>
                                                                ).
                                                            </li>
                                                            <li>{{translate('Select the project for which you want to configure FCM
                                                                from the Firebase
                                                                Console dashboard')}}
                                                            </li>
                                                            <li>{{translate('If you don’t have any project before. Create one with
                                                                the website name')}}
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="swiper-slide">
                                                    <div class="d-flex flex-column align-items-center gap-2 fs-12">
                                                        <img width="80" class="mb-3"
                                                             src="{{asset('public/assets/admin-module/img/media/project-settings.png')}}"
                                                             alt="">
                                                        <h5 class="modal-title text-center mb-3">{{translate('Navigate to Project
                                                            Settings')}}</h5>

                                                        <ul class="d-flex flex-column gap-2 px-3">
                                                            <li>{{translate('In the left-hand menu, click on the')}}
                                                                <strong>"Settings"</strong> gear icon,
                                                                {{translate('there you will vae a dropdown. and then select')}}
                                                                <strong>"Project
                                                                    settings"</strong> {{translate('from the dropdown.')}}
                                                            </li>
                                                            <li>{{translate('In the Project settings page, click on the "Cloud
                                                                Messaging" tab from the
                                                                top menu.')}}
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="swiper-slide">
                                                    <div class="d-flex flex-column align-items-center gap-2 fs-12">
                                                        <img width="80" class="mb-3"
                                                             src="{{asset('public/assets/admin-module/img/media/cloud-message.png')}}"
                                                             alt="">
                                                        <h5 class="modal-title text-center mb-3">{{translate('Cloud Messaging
                                                            API')}}</h5>

                                                        <ul class="d-flex flex-column gap-2 px-3">
                                                            <li>{{translate('From Cloud Messaging Page there will be a section called
                                                                Cloud Messaging
                                                                API.')}}
                                                            </li>
                                                            <li>{{translate('Click on the menu icon and enable the API')}}</li>
                                                            <li>{{translate('Refresh the Cloud Messaging Page - You will have your
                                                                server key. Just copy
                                                                the code and paste here')}}
                                                            </li>
                                                        </ul>

                                                        <div class="d-flex justify-content-center mt-2 w-100">
                                                            <button type="button" class="btn btn-primary w-100 max-w320"
                                                                    data-bs-dismiss="modal">Got It
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-pagination mb-2"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif -->

                    @if($webPage == 'recaptcha')
                        <div class="tab-content">
                            <div class="tab-pane fade {{$webPage == 'recaptcha' ? 'show active' : ''}}" id="recaptcha">
                                <div class="card p-20 mb-15">
                                    <div class="d-flex flex-md-nowrap flex-wrap align-items-center justify-content-between gap-3">                                        
                                        <div>
                                            <h4 class="page-title mb-1">{{translate('ReCAPTCHA')}}</h4>
                                            <p class="fz-12">If you turn this feature on users need to verify them through the ReCAPTCHA.</p>
                                        </div>
                                        <div class="w-100 max-w320">
                                            <div class="d-flex justify-content-between align-items-center border rounded px-3 py-lg-3 py-2">
                                                <h5 class="mb-0 fw-normal">{{translate('Status')}}</h5>
                                                <label class="switcher ml-auto mb-0">
                                                    <input type="checkbox" class="switcher_input ">
                                                    <span class="switcher_control"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-danger remove-wrap bg-opacity-10 fs-12 p-10 rounded d-flex gap-2 align-items-center justify-content-between gap-2 mb-15">
                                    <div class="d-flex gap-2 align-items-lg-center">
                                        <span class="material-symbols-outlined text-danger"> warning</span>
                                        <span>
                                           <span class="fw-medium text-dark mb-1 d-block">V3 Version is available now. Must setup for ReCAPTCHA V3</span> 
                                           <span class="fs-12 d-block">You must setup for V3 version. Otherwise the default reCAPTCHA will be displayed automatically</span>
                                        </span>
                                    </div>
                                    <span class="remove-btn w-20 h-20 cursor-pointer fz-10 rounded-full bg-white d-center">
                                        <i class="material-symbols-outlined">close</i>
                                    </span>
                                </div>
                                <div class="card">
                                    <div class="card-body p-20">
                                        <form action="{{route('admin.configuration.set-third-party-config')}}"
                                              method="POST"
                                              id="recaptcha-form" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="d-flex flex-md-nowrap flex-wrap align-items-center justify-content-between gap-2 mb-20">                                        
                                                <div>
                                                    <h4 class="page-title mb-1">{{translate('Google ReCAPTCHA credentials')}}</h4>
                                                    <p class="fz-12">{{translate('Fillup google ReCAPTCHA credentials to setup & active this feature properly.')}}</p>
                                                </div>
                                                <a href="#0" class="text-primary text-decoration-underline fw-medium">How to Get Credential</a>
                                            </div>

                                            <div class="discount-type body-bg rounded p-20 mb-20">                                               
                                                <div class="row g-4">
                                                    <div class="col-md-6 col-12">
                                                        <div class="">
                                                            <label class="mb-2 text-dark d-flex align-items-center gap-1">{{translate('Mailer name')}}
                                                                <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    title="{{translate('Customer satisfaction is our main motto')}}"
                                                                >info</i>
                                                            </label>
                                                            <input name="party_name" value="recaptcha"
                                                                class="hide-div">
                                                            <input type="text" class="form-control"
                                                                name="site_key"
                                                                placeholder="{{translate('site_key')}} *"
                                                                required=""
                                                                value="{{bs_data($dataValues,'recaptcha')['site_key']??''}}">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-12">
                                                        <div class="">
                                                            <label class="mb-2 text-dark d-flex align-items-center gap-1">{{translate('Host')}}
                                                                <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    title="{{translate('Customer satisfaction is our main motto')}}"
                                                                >info</i>
                                                            </label>
                                                            <input type="text" class="form-control"
                                                                   name="secret_key"
                                                                   placeholder="{{translate('secret_key')}} *"
                                                                   required=""
                                                                   value="{{bs_data($dataValues,'recaptcha')['secret_key']??''}}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @can('configuration_update')
                                                <div class="d-flex justify-content-end gap-xl-3 gap-2">
                                                    <button type="reset" class="btn btn--secondary rounded">
                                                        {{translate('reset')}}
                                                    </button>
                                                    <button type="submit" class="btn btn--primary demo_check rounded">
                                                        {{translate('Save')}}
                                                    </button>
                                                </div>
                                            @endcan
                                        </form>
                                    </div>
                                </div>
                                <!-- <div class="card">
                                    <div class="card-header">
                                        <h4 class="page-title">{{translate('recaptcha_setup')}}</h4>
                                    </div>
                                    <div class="card-body p-30">
                                        <form action="{{route('admin.configuration.set-third-party-config')}}"
                                              method="POST"
                                              id="recaptcha-form" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="badge-soft-secondary rounded mb-4 p-3">
                                                <h5 class="m-0">{{ translate('V3 Version is available now. Must setup for ReCAPTCHA V3') }}</h5>
                                                <p class="m-0">{{ translate('If you activate reCAPTCHA, please ensure that reCAPTCHA v3 is properly set up beforehand. Otherwise, you may not be able to access any panels.') }}</p>
                                            </div>

                                            <div class="discount-type">
                                                <div class="d-flex align-items-center gap-4 gap-xl-5 mb-30">
                                                    <div class="custom-radio">
                                                        <input type="radio" id="active" name="status"
                                                               value="1" {{$dataValues->where('key_name','recaptcha')->first()->live_values['status']?'checked':''}}>
                                                        <label for="active">{{translate('active')}}</label>
                                                    </div>
                                                    <div class="custom-radio">
                                                        <input type="radio" id="inactive" name="status"
                                                               value="0" {{$dataValues->where('key_name','recaptcha')->first()->live_values['status']?'':'checked'}}>
                                                        <label for="inactive">{{translate('inactive')}}</label>
                                                    </div>
                                                </div>

                                                <br>

                                                <div class="row">
                                                    <div class="col-md-6 col-12">
                                                        <div class="mb-30">
                                                            <div class="form-floating">
                                                                <input name="party_name" value="recaptcha"
                                                                       class="hide-div">
                                                                <input type="text" class="form-control"
                                                                       name="site_key"
                                                                       placeholder="{{translate('site_key')}} *"
                                                                       required=""
                                                                       value="{{bs_data($dataValues,'recaptcha')['site_key']??''}}">
                                                                <label>{{translate('site_key')}} *</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-12">
                                                        <div class="mb-30">
                                                            <div class="form-floating">
                                                                <input type="text" class="form-control"
                                                                       name="secret_key"
                                                                       placeholder="{{translate('secret_key')}} *"
                                                                       required=""
                                                                       value="{{bs_data($dataValues,'recaptcha')['secret_key']??''}}">
                                                                <label>{{translate('secret_key')}} *</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @can('configuration_update')
                                                <div class="d-flex justify-content-end">
                                                    <button type="submit" class="btn btn--primary demo_check">
                                                        {{translate('update')}}
                                                    </button>
                                                </div>
                                            @endcan
                                        </form>

                                        <div class="mt-3">
                                            <h4 class="mb-3">{{translate('Instructions')}}</h4>
                                            <ol>
                                                <li>{{translate('To get site key and secret keyGo to the Credentials page')}}
                                                    (<a href="https://developers.google.com/recaptcha/docs/v3"
                                                        class="c1">{{translate('Click
                                                        Here')}}</a>)
                                                </li>
                                                <li>{{translate('Add a Label (Ex: abc company)')}}</li>
                                                <li>{{translate('Select reCAPTCHA v3 as ReCAPTCHA Type')}}</li>
                                                <li>{{translate('Select Sub type: I am not a robot Checkbox')}} </li>
                                                <li>{{translate('Add Domain')}} (For ex: demo.6amtech.com)</li>
                                                <li>{{translate('Check in “Accept the reCAPTCHA Terms of Service”')}} </li>
                                                <li>{{translate('Press Submit')}}</li>
                                                <li>{{translate('Copy Site Key and Secret Key, Paste in the input filed below and
                                                    Save.')}}
                                                </li>
                                            </ol>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    @endif
                    @php($appleLogin = (business_config('apple_login', 'third_party'))->live_values)

                    @if($webPage == 'apple_login')
                        <div class="tab-content">
                            <div class="tab-pane fade {{$webPage == 'apple_login' ? 'show active' : ''}}"
                                 id="apple_login">
                                <div class="card view-details-container">
                                    <div class="card-body p-20">
                                        <div class="row align-items-center">
                                            <div class="col-xxl-8 col-md-6 mb-md-0 mb-2">
                                                <h4 class="black-color mb-1 d-block">{{ translate('Apple Login') }}</h4>
                                                <p class="fz-12 text-c mb-1">{{translate('Use Apple login as your customer Social Media Login turn the switch & setup the required files.')}}</p>
                                                <a href="#0" class="text-decoration-underline text-primary">Get Credential Setup</a>
                                            </div>
                                            <div class="col-xxl-4 col-md-6">
                                                <div class="d-flex flex-sm-nowrap flex-wrap justify-content-end justify-content-end align-items-center gap-sm-3 gap-2">
                                                    <div class="view-btn  order-sm-0 order-3 fz-12 text-primary cursor-pointer fw-semibold d-flex align-items-center gap-1">
                                                        View 
                                                        <i class="material-symbols-outlined fz-14">arrow_downward</i>
                                                    </div>
                                                    <div class="mb-0">
                                                        <label class="switcher">
                                                            <input class="switcher_input section-toggle" type="checkbox"> 
                                                            <span class="switcher_control"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <form class="view-details mt-20" action="{{route('admin.configuration.set-third-party-config')}}"
                                            method="POST"
                                            id="apple-login-form" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="discount-type d-flex flex-column gap-sm-4 gap-3 body-bg rounded p-20 mb-20">
                                                <!-- <div class="d-flex align-items-center gap-4 gap-xl-5 mb-30">
                                                    <input name="party_name" value="apple_login"
                                                        class="hide-div">
                                                    <div class="custom-radio">
                                                        <input type="radio" id="apple-login-active"
                                                            name="status"
                                                            value="1" {{$appleLogin['status']?'checked':''}}>
                                                        <label
                                                            for="apple-login-active">{{translate('active')}}</label>
                                                    </div>
                                                    <div class="custom-radio">
                                                        <input type="radio" id="apple-login-inactive"
                                                            name="status"
                                                            value="0" {{$appleLogin['status']?'':'checked'}}>
                                                        <label
                                                            for="apple-login-inactive">{{translate('inactive')}}</label>
                                                    </div>
                                                </div> -->
                                                <div class="">
                                                    <label class="mb-2 text-dark d-flex align-items-center gap-1">{{translate('Callback URL')}}
                                                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                            data-bs-placement="top"
                                                            title="{{translate('Callback URL....')}}"
                                                        >info</i>
                                                    </label>
                                                    <div class="copy-text position-relative d-flex align-items-center h-46 rounded py-2 p-3 justify-content-between gap-1 bg-white">
                                                        <input type="text" class="text border-0 w-100 text-light-gray bg-transparent" value="https://Demandium.6amtech.com/customer/auth/login/google/callback" />
                                                        <button class="border-0 outline-0 text-primary p-0 bg-transparent"><span class="material-symbols-outlined">content_copy</span></button>
                                                    </div>
                                                </div>

                                                <div class="">
                                                    <label class="mb-2 text-dark d-flex align-items-center gap-1">{{translate('Store Client ID')}}
                                                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                            data-bs-placement="top"
                                                            title="{{translate('Store Client ......')}}"
                                                        >info</i>
                                                    </label>
                                                    <input type="text" class="form-control h-46" name="client_id" placeholder="Ex: Client ID"
                                                        value="{{env('APP_ENV')=='demo'?'':$appleLogin['client_id']}}">
                                                </div>

                                                <!-- <div class="form-floating mb-30 mt-30">
                                                    <input type="text" class="form-control" name="team_id"
                                                        value="{{env('APP_ENV')=='demo'?'':$appleLogin['team_id']}}">
                                                    <label>{{translate('team_id')}} *</label>
                                                </div> -->

                                                <div class="">
                                                    <label class="mb-2 text-dark d-flex align-items-center gap-1">{{translate('Store Client Secret Key')}}
                                                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                            data-bs-placement="top"
                                                            title="{{translate('Store Client Secret Key...')}}"
                                                        >info</i>
                                                    </label>
                                                    <input type="text" class="form-control h-46" name="key_id" placeholder="Ex: Client secret key"
                                                        value="{{env('APP_ENV')=='demo'?'':$appleLogin['key_id']}}">
                                                </div>

                                                <!-- <div class="form-floating mb-30 mt-30">
                                                    <input type="file" accept=".p8" class="form-control"
                                                        name="service_file"
                                                        value="{{ 'storage/app/public/apple-login/'.$appleLogin['service_file'] }}">
                                                    <label>{{translate('service_file')}} {{ $appleLogin['service_file']? translate('(Already Exists)'):'*' }}</label>
                                                </div> -->
                                            </div>
                                            @can('configuration_update')
                                                <div class="d-flex justify-content-end gap-xl-3 gap-2">
                                                    <button type="reset" class="btn btn--secondary rounded">{{translate('Reset')}}</button>
                                                    <button type="submit" class="btn btn--primary demo_check rounded">
                                                        {{translate('Save')}}
                                                    </button>
                                                </div>
                                            @endcan
                                        </form>  
                                    </div>
                                </div>
                                <!-- <div class="card">
                                    <div class="card-header">
                                        <h4 class="page-title">
                                            <img src="{{asset('public/assets/admin-module/img/media/apple.png')}}"
                                                 alt="">
                                            {{translate('Apple_login')}}
                                        </h4>
                                    </div>
                                    <div class="card-body p-30">
                                        <div class="row">
                                            <div class="col-12 col-md-12 mb-30">
                                                <form action="{{route('admin.configuration.set-third-party-config')}}"
                                                      method="POST"
                                                      id="apple-login-form" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="discount-type">
                                                        <div class="d-flex align-items-center gap-4 gap-xl-5 mb-30">
                                                            <input name="party_name" value="apple_login"
                                                                   class="hide-div">
                                                            <div class="custom-radio">
                                                                <input type="radio" id="apple-login-active"
                                                                       name="status"
                                                                       value="1" {{$appleLogin['status']?'checked':''}}>
                                                                <label
                                                                    for="apple-login-active">{{translate('active')}}</label>
                                                            </div>
                                                            <div class="custom-radio">
                                                                <input type="radio" id="apple-login-inactive"
                                                                       name="status"
                                                                       value="0" {{$appleLogin['status']?'':'checked'}}>
                                                                <label
                                                                    for="apple-login-inactive">{{translate('inactive')}}</label>
                                                            </div>
                                                        </div>

                                                        <div class="form-floating mb-30 mt-30">
                                                            <input type="text" class="form-control" name="client_id"
                                                                   value="{{env('APP_ENV')=='demo'?'':$appleLogin['client_id']}}">
                                                            <label>{{translate('client_id')}} *</label>
                                                        </div>

                                                        <div class="form-floating mb-30 mt-30">
                                                            <input type="text" class="form-control" name="team_id"
                                                                   value="{{env('APP_ENV')=='demo'?'':$appleLogin['team_id']}}">
                                                            <label>{{translate('team_id')}} *</label>
                                                        </div>

                                                        <div class="form-floating mb-30 mt-30">
                                                            <input type="text" class="form-control" name="key_id"
                                                                   value="{{env('APP_ENV')=='demo'?'':$appleLogin['key_id']}}">
                                                            <label>{{translate('key_id')}} *</label>
                                                        </div>

                                                        <div class="form-floating mb-30 mt-30">
                                                            <input type="file" accept=".p8" class="form-control"
                                                                   name="service_file"
                                                                   value="{{ 'storage/app/public/apple-login/'.$appleLogin['service_file'] }}">
                                                            <label>{{translate('service_file')}} {{ $appleLogin['service_file']? translate('(Already Exists)'):'*' }}</label>
                                                        </div>
                                                    </div>
                                                    @can('configuration_update')
                                                        <div class="d-flex justify-content-end">
                                                            <button type="submit" class="btn btn--primary demo_check">
                                                                {{translate('update')}}
                                                            </button>
                                                        </div>
                                                    @endcan
                                                </form>
                                                <div class="mt-3">
                                                    <h4 class="mb-3">{{translate('Instructions')}}</h4>
                                                    <ol>
                                                        <li>{{translate('Go to Apple Developer page')}} (<a
                                                                href="https://developer.apple.com/account/resources/identifiers/list"
                                                                target="_blank">{{translate('click_here')}}</a>)
                                                        </li>
                                                        <li>{{translate('Here in top left corner you can see the')}}
                                                            <b>{{ translate('Team ID') }}</b> {{ translate('[Apple_Deveveloper_Account_Name - Team_ID]')}}
                                                        </li>
                                                        <li>{{translate('Click Plus icon -> select App IDs -> click on Continue')}}</li>
                                                        <li>{{translate('Put a description and also identifier (identifier that used for app) and this is the')}}
                                                            <b>{{ translate('Client ID') }}</b></li>
                                                        <li>{{translate('Click Continue and Download the file in device named AuthKey_ID.p8 (Store it safely and it is used for push notification)')}} </li>
                                                        <li>{{translate('Again click Plus icon -> select Service IDs -> click on Continue')}} </li>
                                                        <li>{{translate('Push a description and also identifier and Continue')}} </li>
                                                        <li>{{translate('Download the file in device named')}}
                                                            <b>{{ translate('AuthKey_KeyID.p8') }}</b> {{translate('[This is the Service Key ID file and also after AuthKey_ that is the Key ID]')}}
                                                        </li>
                                                    </ol>
                                                </div>
                                            </div>
                                        </div>

                                        </form>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    @endif
                    @if($webPage == 'email_config')
                        <div class="tab-content">
                            <!-- <div class="tab-pane fade {{$webPage == 'email_config' ? 'show active' : ''}}"
                                 id="email_config">
                                <div class="card">
                                    <div class="card-body p-30">
                                        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-40">
                                            <ul class="nav nav--tabs nav--tabs__style2" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active"
                                                       href="{{url('admin/configuration/get-third-party-config')}}?web_page=email_config">{{translate('Email Config')}}</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link"
                                                       href="{{url('admin/configuration/get-third-party-config')}}?web_page=test_mail">{{translate('Send Test Mail')}}</a>
                                                </li>
                                            </ul>
                                            @php($emailStatus =\Modules\BusinessSettingsModule\Entities\BusinessSettings::where(['key_name' => 'email_config_status', 'settings_type' => 'email_config'])->first())
                                            <label class="switcher">
                                                <input class="switcher_input email-config-status"
                                                       id="email-config-status"
                                                    data-values="$(this).is(':checked')===true?1:0"
                                                    type="checkbox"
                                                    {{isset($emailStatus) && $emailStatus->live_values ? 'checked' : ''}}>
                                                <span class="switcher_control"></span>
                                            </label>
                                        </div>
                                        <div class="col-12 col-md-12 mb-30">
                                            <form action="{{route('admin.configuration.set-email-config')}}"
                                                  method="POST"
                                                  id="config-form" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="discount-type">
                                                    <div class="row">
                                                        <div class="col-md-6 col-12 mb-30">
                                                            <div class="form-floating">
                                                                <input type="text" class="form-control"
                                                                       name="mailer_name"
                                                                       placeholder="{{translate('mailer_name')}} *"
                                                                       value="{{bs_data($dataValues,'email_config')['mailer_name']??''}}">
                                                                <label>{{translate('mailer_name')}} *</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12 mb-30">
                                                            <div class="form-floating">
                                                                <input type="text" class="form-control" name="host"
                                                                       placeholder="{{translate('host')}} *"
                                                                       value="{{bs_data($dataValues,'email_config')['host']??''}}">
                                                                <label>{{translate('host')}} *</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12 mb-30">
                                                            <div class="form-floating">
                                                                <input type="text" class="form-control"
                                                                       name="driver"
                                                                       placeholder="{{translate('driver')}} *"
                                                                       value="{{bs_data($dataValues,'email_config')['driver']??''}}">
                                                                <label>{{translate('driver')}} *</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12 mb-30">
                                                            <div class="form-floating">
                                                                <input type="text" class="form-control" name="port"
                                                                       placeholder="{{translate('port')}} *"
                                                                       value="{{bs_data($dataValues,'email_config')['port']??''}}">
                                                                <label>{{translate('port')}} *</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12 mb-30">
                                                            <div class="form-floating">
                                                                <input type="text" class="form-control"
                                                                       name="user_name"
                                                                       placeholder="{{translate('user_name')}} *"
                                                                       value="{{bs_data($dataValues,'email_config')['user_name']??''}}">
                                                                <label>{{translate('user_name')}} *</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12 mb-30">
                                                            <div class="form-floating">
                                                                <input type="text" class="form-control"
                                                                       name="email_id"
                                                                       placeholder="{{translate('email_id')}} *"
                                                                       value="{{bs_data($dataValues,'email_config')['email_id']??''}}">
                                                                <label>{{translate('email_id')}} *</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12 mb-30">
                                                            <div class="form-floating">
                                                                <input type="text" class="form-control"
                                                                       name="encryption"
                                                                       placeholder="{{translate('encryption')}} *"
                                                                       value="{{bs_data($dataValues,'email_config')['encryption']??''}}">
                                                                <label>{{translate('encryption')}} *</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12 mb-30">
                                                            <div class="form-floating">
                                                                <input type="text" class="form-control"
                                                                       name="password"
                                                                       placeholder="{{translate('password')}} *"
                                                                       value="{{bs_data($dataValues,'email_config')['password']??''}}">
                                                                <label>{{translate('password')}} *</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @can('configuration_update')
                                                    <div class="d-flex justify-content-end">
                                                        <button type="submit" class="btn btn--primary">
                                                            {{translate('update')}}
                                                        </button>
                                                    </div>
                                                @endcan
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <div class="card p-20 mb-3">
                                <div class="d-flex align-items-center justify-content-between flex-sm-nowrap flex-wrap gap-3">
                                    <div>
                                        <h3 class="page-title mb-2">{{translate('Mail Configuration')}}</h3>
                                        <p class="mb-0">You can use following mail sending options from <a href="#0" class="text-decoration-underline text-primary">Email Template</a> page.</p>
                                    </div>
                                    <button type="button" class="rounded transition text-nowrap fz-12 fw-semibold btn-primary__outline btn d-flex align-items-center gap-1 py-2 px-3" data-bs-toggle="modal" data-bs-target="#send__mail">
                                        <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_10093_15965)">
                                                <path d="M13.8228 1.50391L3.02539 12.2984C3.25882 12.4122 3.51485 12.472 3.77451 12.4733H5.62373C5.77843 12.4729 5.92684 12.5344 6.0359 12.6441L7.03805 13.6457C7.58151 14.1929 8.32069 14.5009 9.09189 14.5015C9.41031 14.5012 9.72654 14.449 10.0282 14.347C11.068 14.0061 11.8243 13.1047 11.9794 12.0215L13.9493 2.66463C14.0434 2.27476 13.9986 1.86433 13.8228 1.50391Z" fill="#0461A5"/>
                                                <path d="M11.8527 0.545151L2.51853 2.51157C0.923649 2.73068 -0.191634 4.20122 0.0274766 5.79609C0.114022 6.42593 0.404102 7.01025 0.853526 7.45992L1.8551 8.46149C1.96457 8.57094 2.02603 8.71943 2.02592 8.87424V10.7235C2.02726 10.9831 2.08705 11.2392 2.20082 11.4726L12.9965 0.675175C12.6417 0.500826 12.2375 0.454889 11.8527 0.545151Z" fill="#0461A5"/>
                                                </g>
                                                <defs>
                                                <clipPath id="clip0_10093_15965">
                                                <rect width="14" height="14" fill="white" transform="translate(0 0.5)"/>
                                                </clipPath>
                                            </defs>
                                        </svg>
                                        Send Test Mail
                                    </button>
                                </div>
                            </div>                        
                            <div class="tab-pane fade {{$webPage == 'email_config' ? 'show active' : ''}}"
                                 id="email_config">
                                <div class="card view-details-container mb-20">
                                    <div class="card-body p-20">
                                        <div class="row align-items-center">
                                            <div class="col-xxl-8 col-md-6 mb-md-0 mb-2">
                                                <h3 class="black-color mb-1 d-block">{{ translate('SMTP Mail Configuration') }}</h3>
                                                <p class="fz-12 text-c mb-0">{{translate('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet.')}}</p>
                                            </div>
                                            <div class="col-xxl-4 col-md-6">
                                                <div class="d-flex flex-sm-nowrap flex-wrap justify-content-end justify-content-end align-items-center gap-sm-3 gap-2">
                                                    <div class="view-btn  order-sm-0 order-3 fz-12 text-primary cursor-pointer fw-semibold d-flex align-items-center gap-1">
                                                        View 
                                                        <i class="material-symbols-outlined fz-14">arrow_downward</i>
                                                    </div>
                                                    @php($emailStatus =\Modules\BusinessSettingsModule\Entities\BusinessSettings::where(['key_name' => 'email_config_status', 'settings_type' => 'email_config'])->first())
                                                    <label class="switcher">
                                                        <input class="switcher_input section-toggle email-config-status"
                                                            id="email-config-status"
                                                            data-values="$(this).is(':checked')===true?1:0"
                                                            type="checkbox"
                                                            {{isset($emailStatus) && $emailStatus->live_values ? 'checked' : ''}}>
                                                        <span class="switcher_control"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="view-details mt-3">
                                            <form action="{{route('admin.configuration.set-email-config')}}"
                                                  method="POST"
                                                  id="config-form" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="discount-type body-bg rounded p-20">
                                                    <div class="row">
                                                        <div class="col-md-6 col-lg-4 col-12 mb-30">
                                                            <div class="">
                                                                <label for="name" class="mb-2 text-dark">{{translate('mailer_name')}}
                                                                    <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                                        data-bs-placement="top"
                                                                        title="{{translate('Customer satisfaction is our main motto')}}"
                                                                    >info</i>
                                                                </label>
                                                                <input type="text" id="name" class="form-control"
                                                                       name="mailer_name"
                                                                       placeholder="{{translate('mailer_name')}} *"
                                                                       value="{{bs_data($dataValues,'email_config')['mailer_name']??''}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-lg-4 col-12 mb-30">
                                                            <div class="">
                                                                <label for="host" class="mb-2 text-dark">{{translate('host')}}
                                                                    <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                                        data-bs-placement="top"
                                                                        title="{{translate('Customer satisfaction is our main motto')}}"
                                                                    >info</i>
                                                                </label>
                                                                <input type="text" id="host" class="form-control" name="host"
                                                                       placeholder="{{translate('host')}} *"
                                                                       value="{{bs_data($dataValues,'email_config')['host']??''}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-lg-4 col-12 mb-30">
                                                            <div class="">
                                                                <label for="driver" class="mb-2 text-dark">{{translate('driver')}}
                                                                    <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                                        data-bs-placement="top"
                                                                        title="{{translate('Customer satisfaction is our main motto')}}"
                                                                    >info</i>
                                                                </label>
                                                                <input type="text" id="driver" class="form-control"
                                                                       name="driver"
                                                                       placeholder="{{translate('driver')}} *"
                                                                       value="{{bs_data($dataValues,'email_config')['driver']??''}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-lg-4 col-12 mb-30">
                                                            <div class="">
                                                                <label for="port" class="mb-2 text-dark">{{translate('port')}}
                                                                    <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                                        data-bs-placement="top"
                                                                        title="{{translate('Customer satisfaction is our main motto')}}"
                                                                    >info</i>
                                                                </label>
                                                                <input type="text" id="port" class="form-control" name="port"
                                                                       placeholder="{{translate('port')}} *"
                                                                       value="{{bs_data($dataValues,'email_config')['port']??''}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-lg-4 col-12 mb-30">
                                                            <div class="">
                                                                <label for="username" class="mb-2 text-dark">{{translate('Username')}}
                                                                    <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                                        data-bs-placement="top"
                                                                        title="{{translate('Customer satisfaction is our main motto')}}"
                                                                    >info</i>
                                                                </label>
                                                                <input type="text" id="username" class="form-control"
                                                                       name="user_name"
                                                                       placeholder="{{translate('user_name')}} *"
                                                                       value="{{bs_data($dataValues,'email_config')['user_name']??''}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-lg-4 col-12 mb-30">
                                                            <div class="">
                                                                <label for="mainlid" class="mb-2 text-dark">{{translate('Email ID')}}
                                                                    <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                                        data-bs-placement="top"
                                                                        title="{{translate('Customer satisfaction is our main motto')}}"
                                                                    >info</i>
                                                                </label>
                                                                <input type="text" id="mainlid" class="form-control"
                                                                       name="email_id"
                                                                       placeholder="{{translate('email_id')}} *"
                                                                       value="{{bs_data($dataValues,'email_config')['email_id']??''}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-lg-4 col-12">
                                                            <div class="">
                                                                <label for="cryption" class="mb-2 text-dark">{{translate('Encryption')}}
                                                                    <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                                        data-bs-placement="top"
                                                                        title="{{translate('Customer satisfaction is our main motto')}}"
                                                                    >info</i>
                                                                </label>
                                                                <input type="text" id="cryption" class="form-control"
                                                                       name="encryption"
                                                                       placeholder="{{translate('encryption')}} *"
                                                                       value="{{bs_data($dataValues,'email_config')['encryption']??''}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-lg-4 col-12">
                                                            <div class="">
                                                                <label for="pass" class="mb-2 text-dark">{{translate('Password')}}
                                                                    <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                                        data-bs-placement="top"
                                                                        title="{{translate('Customer satisfaction is our main motto')}}"
                                                                    >info</i>
                                                                </label>
                                                                <input type="text" id="pass" class="form-control"
                                                                       name="password"
                                                                       placeholder="{{translate('password')}} *"
                                                                       value="{{bs_data($dataValues,'email_config')['password']??''}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @can('configuration_update')
                                                    <div class="d-flex justify-content-end gap-3 mt-4">
                                                        <button type="reset" class="btn btn--secondary rounded">{{translate('Reset')}}</button>
                                                        <button type="submit" class="btn btn--primary rounded">
                                                            {{translate('Save')}}
                                                        </button>
                                                    </div>
                                                @endcan
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                @endif

                @if($webPage == 'test_mail')
                    <div class="tab-content">
                        <div class="tab-pane fade {{$webPage == 'test_mail' ? 'show active' : ''}}"
                             id="email_config">
                            <div class="card">
                                <div class="card-body p-30">
                                    <div class="row">
                                        <div
                                            class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-30">
                                            <ul class="nav nav--tabs nav--tabs__style2" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link {{$webPage=='email_config' ? 'active':''}}"
                                                       href="{{url('admin/configuration/get-third-party-config')}}?web_page=email_config">{{translate('Email Config')}}</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link {{$webPage == 'test_mail' ?'active':''}}"
                                                       href="{{url('admin/configuration/get-third-party-config')}}?web_page=test_mail">{{translate('Send Test Mail')}}</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-12 col-md-12 mb-30">
                                            <form action="javascript:" method="post">
                                                @csrf
                                                <input type="hidden" name="status" value="{{(isset($data)&& isset($data['status'])) ? $data['status']:0 }}">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="tab-content">
                                                            <div class="tab-pane fade show active" id="test-mail">
                                                                <div class="row">
                                                                    <div class="col-lg-8">
                                                                        <form action="javascript:">
                                                                            <div class="row gx-3 gy-1">
                                                                                <div class="col-md-8 col-sm-7">
                                                                                    <div class="form-floating">
                                                                                        <input type="email"
                                                                                               class="form-control"
                                                                                               id="test-email"
                                                                                               name="email"
                                                                                               placeholder="{{translate('ex: abc@email.com')}}"
                                                                                               required=""
                                                                                               value="{{old('email')}}">
                                                                                        <label>{{translate('email')}}
                                                                                            *</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4 col-sm-5">
                                                                                    <button type="button" id="send-mail"
                                                                                            class="btn btn--primary">
                                                                                        <span class='material-icons'>send</span>
                                                                                        {{ translate('send_mail') }}
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if($webPage == 'sms_config')
                    <div class="tab-content">
                        <div class="tab-pane fade {{$webPage == 'sms_config' ? 'show active' : ''}}"
                             id="sms_config">
                            <div class="pick-map mb-3 p-12 rounded d-flex flex-md-nowrap flex-wrap align-items-center gap-1 bg-primary bg-opacity-10">
                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_9464_2249)">
                                    <path d="M9.79125 1.44318L10.5117 0.270677C10.6797 -0.00465646 11.039 -0.0898231 11.3138 0.0793436C11.5885 0.247927 11.6743 0.606677 11.5051 0.881427L10.7847 2.05393C10.675 2.23359 10.4831 2.33218 10.2871 2.33218C10.1827 2.33218 10.0777 2.30418 9.98259 2.24584C9.70784 2.07726 9.62209 1.71793 9.79125 1.44318ZM3.16575 2.05334C3.27542 2.23301 3.46792 2.33218 3.66392 2.33218C3.76775 2.33218 3.87275 2.30418 3.96784 2.24643C4.24259 2.07784 4.32892 1.71909 4.16034 1.44434L3.44109 0.27126C3.2725 -0.00348977 2.91317 -0.0892398 2.639 0.0787602C2.36425 0.247344 2.27792 0.606094 2.4465 0.880844L3.16575 2.05334ZM1.89059 3.34134L0.841754 2.83909C0.552421 2.69851 0.201838 2.82218 0.0641712 3.11326C-0.0752455 3.40376 0.0478378 3.75201 0.338338 3.89084L1.38717 4.39309C1.46825 4.43218 1.554 4.45084 1.63859 4.45084C1.85617 4.45084 2.065 4.32893 2.16475 4.11951C2.30417 3.82901 2.18109 3.48018 1.89059 3.34134ZM6.92067 2.33393C3.70417 2.38701 1.155 5.87301 2.9015 9.23068C3.16692 9.74051 3.56067 10.1675 3.98359 10.5566C4.144 10.7042 4.26825 10.8868 4.37442 11.0828H6.41667V8.05876C5.73942 7.81726 5.25 7.17559 5.25 6.41609C5.25 6.09351 5.51075 5.83276 5.83334 5.83276C6.15592 5.83276 6.41667 6.09351 6.41667 6.41609C6.41667 6.73868 6.678 6.99943 7 6.99943C7.322 6.99943 7.58334 6.73809 7.58334 6.41609C7.58334 6.09409 7.84409 5.83276 8.16667 5.83276C8.48925 5.83276 8.75 6.09351 8.75 6.41609C8.75 7.17559 8.26059 7.81726 7.58334 8.05876V11.0828H9.60634C9.73934 10.8547 9.91084 10.6394 10.1354 10.4522C10.5198 10.1313 10.8815 9.77376 11.1038 9.32518C12.117 7.27593 11.7151 5.09076 10.2719 3.67209C9.373 2.78776 8.18242 2.31468 6.92067 2.33393ZM4.662 12.4122C4.61534 13.2673 5.25584 14 6.11217 14H7.87442C8.68 14 9.33275 13.3473 9.33275 12.5417V12.25H4.65559C4.65559 12.3048 4.6655 12.3562 4.662 12.4122ZM13.9493 3.09168C13.8163 2.79826 13.4715 2.66584 13.1781 2.80001L12.0511 3.30868C11.7571 3.44109 11.6264 3.78643 11.7594 4.07984C11.8568 4.29568 12.0686 4.42343 12.2914 4.42343C12.3713 4.42343 12.453 4.40709 12.5306 4.37151L13.6576 3.86284C13.9516 3.73043 14.0823 3.38509 13.9493 3.09168Z" fill="#3C76F1"></path>
                                    </g>
                                    <defs>
                                    <clipPath id="clip0_9464_2249">
                                    <rect width="14" height="14" fill="white"></rect>
                                    </clipPath>
                                    </defs>
                                </svg>
                                <p class="fz-12">This SMS gateway will work for <a href="#" class="text-primary fw-semibold text-decoration-underline"> OTP verification </a> or <a href="#" class="text-primary fw-semibold text-decoration-underline">Notification</a> through SMS.</p> 
                            </div>
                            <div class="bg-warning bg-opacity-10 fs-12 p-12 rounded mb-3">
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
                                    <p class="fz-12 fw-normal">Please recheck if you have put all the data correctly or contact your SMS gateway provider for assistance.</p>
                                </div>
                            </div>
                            <div class="card mb-20">
                                <div class="card-body p-20">
                                    <div class="row g-lg-4 g-4 align-items-center">
                                        <div class="col-lg-3">
                                            <h3 class="mb-2">{{translate('SMS Configuration')}}</h3>
                                            <p class="fz-12 mb-xl-3 mb-xxl-4 mb-3">{{translate('Choose the SMS model you want to use for OTP & Other SMS')}}</p>
                                            <div class="mb-15 bg-danger bg-opacity-10 fs-12 p-10 rounded d-flex gap-2 align-items-center">
                                                <span class="material-symbols-outlined text-danger">
                                                    warning
                                                </span>
                                                <span>
                                                    3rd Party is not set up yet. Please configure it first to ensure it works properly.
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="bg-light rounded-2 p-20">
                                                <div class="d-flex align-items-center justify-content-between gap-2 flex-wrap mb-3">
                                                    <label class="text-dark">{{translate('Select Business Model')}}
                                                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                            data-bs-placement="top"
                                                            title="{{translate('This button is now disable to active setup & turned on any sms gateway.')}}"
                                                        >info</i>
                                                    </label>
                                                    <button type="button" class="rounded transition text-nowrap fz-12 fw-semibold btn-primary__outline btn d-flex align-items-center gap-1 py-2 px-3" data-bs-toggle="modal" data-bs-target="#send__sms">
                                                        <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <g clip-path="url(#clip0_10093_15965)">
                                                                <path d="M13.8228 1.50391L3.02539 12.2984C3.25882 12.4122 3.51485 12.472 3.77451 12.4733H5.62373C5.77843 12.4729 5.92684 12.5344 6.0359 12.6441L7.03805 13.6457C7.58151 14.1929 8.32069 14.5009 9.09189 14.5015C9.41031 14.5012 9.72654 14.449 10.0282 14.347C11.068 14.0061 11.8243 13.1047 11.9794 12.0215L13.9493 2.66463C14.0434 2.27476 13.9986 1.86433 13.8228 1.50391Z" fill="#0461A5"/>
                                                                <path d="M11.8527 0.545151L2.51853 2.51157C0.923649 2.73068 -0.191634 4.20122 0.0274766 5.79609C0.114022 6.42593 0.404102 7.01025 0.853526 7.45992L1.8551 8.46149C1.96457 8.57094 2.02603 8.71943 2.02592 8.87424V10.7235C2.02726 10.9831 2.08705 11.2392 2.20082 11.4726L12.9965 0.675175C12.6417 0.500826 12.2375 0.454889 11.8527 0.545151Z" fill="#0461A5"/>
                                                                </g>
                                                                <defs>
                                                                <clipPath id="clip0_10093_15965">
                                                                <rect width="14" height="14" fill="white" transform="translate(0 0.5)"/>
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                        Send Test Mail
                                                    </button>
                                                </div>
                                                <div class="bg-white rounded-2 p-16">
                                                    <div class="row g-xl-4 g-3">
                                                        <div class="col-md-6">
                                                            <div class="custom-radio">
                                                                <input type="radio" id="sms-login-active1" name="status" value="1" checked="">
                                                                <label for="sms-login-active1">
                                                                    <h5 class="mb-1">{{translate('3rd Party')}}</h5>
                                                                    <p class="fz-12 max-w-250">{{translate('You have to setup a SMS module from below fist to active this feature')}}</p>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="custom-radio">
                                                                <input type="radio" id="sms-login-active2" name="status" value="1">
                                                                <label for="sms-login-active2">
                                                                    <h5 class="mb-1">{{translate('Firebase OTP')}}</h5>
                                                                    <p class="fz-12 max-w-250">{{translate('Setup necessary')}} <a href="#" class="text-primary text-decoration-underline">Firebase Configurations.</a></p>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-12 mb-15">
                                    @if($publishedStatus == 1)
                                        <div class="col-md-12 mb-3">
                                            <div class="card">
                                                <div class="card-body d-flex justify-content-around">
                                                    <h4 class="payment-module-warning">
                                                        <i class="tio-info-outined"></i>
                                                        {{translate('Your current sms settings are disabled, because you
                                                        have enabled
                                                        sms gateway addon, To visit your currently active
                                                        sms gateway settings please follow
                                                        the link.')}}</h4>

                                                    <a href="{{!empty($paymentUrl) ? $paymentUrl : ''}}"
                                                        class="btn btn-outline-primary">{{translate('settings')}}</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif


                                    <div class="row">
                                        @php($isPublished = $publishedStatus == 1 ? 'disabled' : '')
                                        @foreach($dataValues as $keyValue => $gateway)
                                            <div class="col-12 col-md-6 mb-15">
                                                <div class="card view-details-container">
                                                    <div class="card-body p-20">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <div class="">
                                                                <h4 class="page-title mb-1">{{translate($gateway->key_name)}}</h4>
                                                                <p class="fz-12">Setup 2Factor as SMS gateway</p>
                                                            </div>
                                                            <div class="d-flex flex-sm-nowrap flex-wrap justify-content-end justify-content-end align-items-center gap-sm-3 gap-2">
                                                                <div class="view-btn  order-sm-0 order-3 fz-12 text-primary cursor-pointer fw-semibold d-flex align-items-center gap-1">
                                                                    View 
                                                                    <i class="material-symbols-outlined fz-14">arrow_downward</i>
                                                                </div>
                                                                <div class="mb-0">
                                                                    <label class="switcher">
                                                                        <input class="switcher_input section-toggle" type="checkbox"> 
                                                                        <span class="switcher_control"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <form class="view-details mt-20" action="{{route('admin.configuration.sms-set')}}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="discount-type body-bg rounded p-20 mb-20">
                                                                <!-- <div
                                                                    class="d-flex align-items-center gap-4 gap-xl-5 mb-30">
                                                                    <div class="custom-radio">
                                                                        <input type="radio"
                                                                                id="{{$gateway->key_name}}-active"
                                                                                name="status"
                                                                                value="1" {{$dataValues->where('key_name',$gateway->key_name)->first()->live_values['status']?'checked':''}} {{$isPublished}}>
                                                                        <label
                                                                            for="{{$gateway->key_name}}-active">{{translate('active')}}</label>
                                                                    </div>
                                                                    <div class="custom-radio">
                                                                        <input type="radio"
                                                                                id="{{$gateway->key_name}}-inactive"
                                                                                name="status"
                                                                                value="0" {{$dataValues->where('key_name',$gateway->key_name)->first()->live_values['status']?'':'checked'}} {{$isPublished}}>
                                                                        <label
                                                                            for="{{$gateway->key_name}}-inactive">{{translate('inactive')}}</label>
                                                                    </div>
                                                                </div> -->

                                                                <input name="gateway"
                                                                        value="{{$gateway->key_name}}"
                                                                        class="hide-div">
                                                                <input name="mode" value="live"
                                                                        class="hide-div">

                                                                @php($skip=['gateway','mode','status'])
                                                                @foreach($dataValues->where('key_name',$gateway->key_name)->first()->live_values as $key=>$value)
                                                                    @if(!in_array($key,$skip))
                                                                        <div class=" mb-30 mt-30">
                                                                            <label class="mb-2 text-dark">{{translate($key)}}
                                                                                <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                                                    data-bs-placement="top"
                                                                                    title="{{translate('Customer satisfaction is our main motto')}}"
                                                                                >info</i>
                                                                            </label>
                                                                            <input type="text"
                                                                                    class="form-control"
                                                                                    name="{{$key}}"
                                                                                    placeholder="{{translate($key)}} *"
                                                                                    value="{{env('APP_ENV')=='demo'?'':$value}}" {{$isPublished}}>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                            @can('configuration_update')
                                                                <div class="d-flex justify-content-end gap-xl-3 gap-2">
                                                                    <button type="reset" class="btn btn--secondary rounded">{{translate('Reset')}}</button>
                                                                    <button type="submit"
                                                                            class="btn btn--primary demo_check rounded" {{$isPublished}}>
                                                                        {{translate('Save')}}
                                                                    </button>
                                                                </div>
                                                            @endcan
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="col-12 col-md-6 mb-15">
                                            <div class="card mb-3 view-details-container">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <div class="">
                                                            <h4 class="page-title mb-1">{{translate('Alphanet SMS')}}</h4>
                                                            <p class="fz-12">Setup 2Factor as SMS gateway</p>
                                                        </div>
                                                        <div class="d-flex flex-sm-nowrap flex-wrap justify-content-end justify-content-end align-items-center gap-sm-3 gap-2">
                                                            <div class="view-btn  order-sm-0 order-3 fz-12 text-primary cursor-pointer fw-semibold d-flex align-items-center gap-1">
                                                                View 
                                                                <i class="material-symbols-outlined fz-14">arrow_downward</i>
                                                            </div>
                                                            <div class="mb-0">
                                                                <label class="switcher">
                                                                    <input class="switcher_input section-toggle" type="checkbox"> 
                                                                    <span class="switcher_control"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mt-20 view-details">
                                                        <div class="body-bg rounded p-20 mb-20">
                                                            <div class="mb-4">
                                                                <div class="mb-2 text-dark">{{translate('Api Key')}}
                                                                    <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                                        data-bs-placement="top"
                                                                        title="{{translate('Web Api Key')}}"
                                                                    >info</i>
                                                                </div>
                                                                <input type="text" placeholder="Ex: Miler " class="form-control" name="measurementId" value="">                                    
                                                            </div>
                                                            <div class="mb-2">
                                                                <div class="mb-2 text-dark">{{translate('OTP Template')}}
                                                                    <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                                        data-bs-placement="top"
                                                                        title="{{translate('Web Api Key')}}"
                                                                    >info</i>
                                                                </div>
                                                                <input type="text" placeholder="Ex: Smtp.mailtrap.io " class="form-control" name="measurementId" value="">                                    
                                                            </div>
                                                        </div>
                                                        @can('configuration_update')
                                                            <div class="d-flex justify-content-end gap-xl-3 gap-2">
                                                                <button type="reset" class="btn btn--secondary rounded">{{translate('Reset')}}</button>
                                                                <button type="submit"
                                                                        class="btn btn--primary demo_check rounded" {{$isPublished}}>
                                                                    {{translate('Save')}}
                                                                </button>
                                                            </div>
                                                        @endcan
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="card">
                                <div class="card-header">
                                    <h4 class="page-title">
                                        {{translate('Sms Setup')}}
                                    </h4>
                                </div>
                                <div class="card-body p-30">
                                    <div class="row">
                                        <div class="col-12 col-md-12 mb-30">
                                            @if($publishedStatus == 1)
                                                <div class="col-md-12 mb-3">
                                                    <div class="card">
                                                        <div class="card-body d-flex justify-content-around">
                                                            <h4 class="payment-module-warning">
                                                                <i class="tio-info-outined"></i>
                                                                {{translate('Your current sms settings are disabled, because you
                                                                have enabled
                                                                sms gateway addon, To visit your currently active
                                                                sms gateway settings please follow
                                                                the link.')}}</h4>

                                                            <a href="{{!empty($paymentUrl) ? $paymentUrl : ''}}"
                                                               class="btn btn-outline-primary">{{translate('settings')}}</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif


                                            <div class="row">
                                                @php($isPublished = $publishedStatus == 1 ? 'disabled' : '')
                                                @foreach($dataValues as $keyValue => $gateway)
                                                    <div class="col-12 col-md-6 mb-30">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h4 class="page-title">{{translate($gateway->key_name)}}</h4>
                                                            </div>
                                                            <div class="card-body p-30">
                                                                <form
                                                                    action="{{route('admin.configuration.sms-set')}}"
                                                                    method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="discount-type">
                                                                        <div
                                                                            class="d-flex align-items-center gap-4 gap-xl-5 mb-30">
                                                                            <div class="custom-radio">
                                                                                <input type="radio"
                                                                                       id="{{$gateway->key_name}}-active"
                                                                                       name="status"
                                                                                       value="1" {{$dataValues->where('key_name',$gateway->key_name)->first()->live_values['status']?'checked':''}} {{$isPublished}}>
                                                                                <label
                                                                                    for="{{$gateway->key_name}}-active">{{translate('active')}}</label>
                                                                            </div>
                                                                            <div class="custom-radio">
                                                                                <input type="radio"
                                                                                       id="{{$gateway->key_name}}-inactive"
                                                                                       name="status"
                                                                                       value="0" {{$dataValues->where('key_name',$gateway->key_name)->first()->live_values['status']?'':'checked'}} {{$isPublished}}>
                                                                                <label
                                                                                    for="{{$gateway->key_name}}-inactive">{{translate('inactive')}}</label>
                                                                            </div>
                                                                        </div>

                                                                        <input name="gateway"
                                                                               value="{{$gateway->key_name}}"
                                                                               class="hide-div">
                                                                        <input name="mode" value="live"
                                                                               class="hide-div">

                                                                        @php($skip=['gateway','mode','status'])
                                                                        @foreach($dataValues->where('key_name',$gateway->key_name)->first()->live_values as $key=>$value)
                                                                            @if(!in_array($key,$skip))
                                                                                <div
                                                                                    class="form-floating mb-30 mt-30">
                                                                                    <input type="text"
                                                                                           class="form-control"
                                                                                           name="{{$key}}"
                                                                                           placeholder="{{translate($key)}} *"
                                                                                           value="{{env('APP_ENV')=='demo'?'':$value}}" {{$isPublished}}>
                                                                                    <label>{{translate($key)}}
                                                                                        *</label>
                                                                                </div>
                                                                            @endif
                                                                        @endforeach
                                                                    </div>
                                                                    @can('configuration_update')
                                                                        <div class="d-flex justify-content-end">
                                                                            <button type="submit"
                                                                                    class="btn btn--primary demo_check" {{$isPublished}}>
                                                                                {{translate('update')}}
                                                                            </button>
                                                                        </div>
                                                                    @endcan
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                @endif

                @if($webPage == 'payment_config' && $type == 'digital_payment')
                    <div class="tab-content">
                        <div
                            class="tab-pane fade {{$webPage == 'payment_config' && $type == 'digital_payment' ? 'show active' : ''}}"
                            id="digital_payment">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="page-title">
                                        {{translate('Payment Gateway Configuration')}}
                                    </h4>
                                </div>
                                <div class="card-body p-30">
                                    <div class="row">
                                        <div class="col-12 col-md-12 mb-30">
                                            <div
                                                class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-3">
                                                <ul class="nav nav--tabs nav--tabs__style2" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link {{$type=='digital_payment'?'active':''}}"
                                                           href="{{url('admin/configuration/get-third-party-config')}}?type=digital_payment&web_page=payment_config">{{translate('Digital Payment Gateways')}}</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link {{$type=='offline_payment'?'active':''}}"
                                                           href="{{url('admin/configuration/offline-payment/list')}}?type=offline_payment&web_page=payment_config">{{translate('Offline Payment')}}</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            @if($publishedStatus == 1)
                                                <div class="col-12 mb-3">
                                                    <div class="card">
                                                        <div class="card-body d-flex justify-content-around">
                                                            <h4 class="text-danger pt-2">
                                                                <i class="tio-info-outined"></i>
                                                                {{translate('Your current payment settings are disabled, because
                                                                you have enabled
                                                                payment gateway addon, To visit your currently
                                                                active payment gateway settings please follow
                                                                the link')}}.</h4>

                                                            <a href="{{!empty($paymentUrl) ? $paymentUrl : ''}}"
                                                               class="btn btn-outline-primary">{{translate('settings')}}</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="row">
                                                @php($isPublished = $publishedStatus == 1 ? 'disabled' : '')
                                                @foreach($dataValues as $gateway)
                                                    <div class="col-12 col-md-6 mb-30">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h4 class="page-title">{{translate($gateway->key_name)}}</h4>
                                                            </div>
                                                            <div class="card-body p-30">
                                                                <form
                                                                    action="{{route('admin.configuration.payment-set')}}"
                                                                    method="POST"
                                                                    id="{{$gateway->key_name}}-form"
                                                                    enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    @php($additional_data = $gateway['additional_data'] != null ? json_decode($gateway['additional_data']) : [])
                                                                    <div class="discount-type">
                                                                        <div
                                                                            class="d-flex align-items-center gap-4 gap-xl-5 mb-30">
                                                                            <div class="custom-radio">
                                                                                <input type="radio"
                                                                                       id="{{$gateway->key_name}}-active"
                                                                                       name="status"
                                                                                       value="1" {{$dataValues->where('key_name',$gateway->key_name)->first()->live_values['status']?'checked':''}} {{$isPublished}}>
                                                                                <label
                                                                                    for="{{$gateway->key_name}}-active">{{translate('active')}}</label>
                                                                            </div>
                                                                            <div class="custom-radio">
                                                                                <input type="radio"
                                                                                       class="{{ checkCurrency($gateway->key_name, 'payment_gateway') === true && $gateway['is_active']  ? 'open-warning-modal' : ''}}"
                                                                                       data-gateway="{{ $gateway->key_name }}" data-status="{{ $gateway['is_active'] }}"
                                                                                       id="{{$gateway->key_name}}-inactive"
                                                                                       name="status"
                                                                                       value="0" {{$dataValues->where('key_name',$gateway->key_name)->first()->live_values['status']?'':'checked'}} {{$isPublished}}>
                                                                                <label
                                                                                    for="{{$gateway->key_name}}-inactive">{{translate('inactive')}}</label>
                                                                            </div>
                                                                        </div>

                                                                        @php($gatewayImageFullPath = getPaymentGatewayImageFullPath(key: $gateway->key_name, settingsType: $gateway->settings_type, defaultPath: 'public/assets/admin-module/img/placeholder.png'))
                                                                        <div class="payment--gateway-img justify-content-center d-flex align-items-center">
                                                                            <img class="payment-image-preview" id="{{$gateway->key_name}}-image-preview"
                                                                                 src="{{ $gatewayImageFullPath }}" alt="{{ translate('image') }}">
                                                                        </div>

                                                                        <input name="gateway"
                                                                               value="{{$gateway->key_name}}"
                                                                               class="hide-div">

                                                                        @php($mode=$dataValues->where('key_name',$gateway->key_name)->first()->live_values['mode'])
                                                                        <div class="form-floating mb-30 mt-30">
                                                                            <select
                                                                                class="js-select theme-input-style w-100"
                                                                                name="mode" {{$isPublished}}>
                                                                                <option
                                                                                    value="live" {{$mode=='live'?'selected':''}}>{{translate('live')}}</option>
                                                                                <option
                                                                                    value="test" {{$mode=='test'?'selected':''}}>{{translate('test')}}</option>
                                                                            </select>
                                                                        </div>

                                                                        @php($skip=['gateway','mode','status'])
                                                                        @foreach($dataValues->where('key_name',$gateway->key_name)->first()->live_values as $key=>$value)
                                                                            @if(!in_array($key,$skip))
                                                                                <div
                                                                                    class="form-floating mb-30 mt-30">
                                                                                    <input type="text"
                                                                                           class="form-control"
                                                                                           name="{{$key}}"
                                                                                           placeholder="{{translate($key)}} *"
                                                                                           value="{{env('APP_ENV')=='demo'?'':$value}}" {{$isPublished}}>
                                                                                    <label>{{translate($key)}}
                                                                                        *</label>
                                                                                </div>
                                                                            @endif
                                                                        @endforeach

                                                                        @if($gateway['key_name'] == 'paystack')
                                                                            <div class="form-floating mb-30 mt-30">
                                                                                <input type="text"
                                                                                       class="form-control"
                                                                                       placeholder="{{translate('Callback Url')}} *"
                                                                                       readonly
                                                                                       value="{{env('APP_ENV')=='demo'?'': route('paystack.callback')}}" {{$isPublished}}>
                                                                                <label>{{translate('Callback Url')}}
                                                                                    *</label>
                                                                            </div>
                                                                        @endif

                                                                        <div class="form-floating gateway-title">
                                                                            <input type="text" class="form-control"
                                                                                   id="{{$gateway->key_name}}-title"
                                                                                   name="gateway_title"
                                                                                   placeholder="{{translate('payment_gateway_title')}}"
                                                                                   value="{{$additional_data != null ? $additional_data->gateway_title : ''}}" {{$isPublished}}>
                                                                            <label
                                                                                for="{{$gateway->key_name}}-title"
                                                                                class="form-label">{{translate('payment_gateway_title')}}</label>
                                                                        </div>

                                                                        <div class="form-floating mb-3">
                                                                            <input type="file" class="form-control"
                                                                                   name="gateway_image"
                                                                                   accept=".jpg, .png, .jpeg|image/*"
                                                                                   id="{{$gateway->key_name}}-image">
                                                                        </div>

                                                                    </div>
                                                                    @can('configuration_update')
                                                                        <div class="d-flex justify-content-end">
                                                                            <button type="submit"
                                                                                    class="btn btn--primary demo_check" {{$isPublished}}>
                                                                                {{translate('update')}}
                                                                            </button>
                                                                        </div>
                                                                    @endcan
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if($webPage == 'payment_config' && $type == 'offline_payment')
                    <div class="tab-content">
                        <div
                            class="tab-pane fade {{$webPage == 'payment_config' && $type == 'offline_payment' ? 'show active' : ''}}"
                            id="offline_payment">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="page-title">
                                        {{translate('Payment Config')}}
                                    </h4>
                                </div>
                                <div class="card-body p-30">
                                    <div class="row">
                                        <div class="col-12 col-md-12 mb-30">
                                            <div
                                                class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-3">
                                                <ul class="nav nav--tabs nav--tabs__style2" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link {{$type=='digital_payment'?'active':''}}"
                                                           href="{{url()->current()}}?type=digital_payment&web_page=payment_config">{{translate('Digital Payment Gateways')}}</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link {{$type=='offline_payment'?'active':''}}"
                                                           href="{{url()->current()}}?type=offline_payment&web_page=payment_config">{{translate('Offline Payment')}}</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            @if($publishedStatus == 1)
                                                <div class="col-12 mb-3">
                                                    <div class="card">
                                                        <div class="card-body d-flex justify-content-around">
                                                            <h4 class="text-danger pt-2">
                                                                <i class="tio-info-outined"></i>
                                                                {{translate(' Your current payment settings are disabled, because
                                                                 you have enabled
                                                                 payment gateway addon, To visit your currently
                                                                 active payment gateway settings please follow
                                                                 the link.')}}</h4>

                                                            <a href="{{!empty($paymentUrl) ? $paymentUrl : ''}}"
                                                               class="btn btn-outline-primary">{{translate('settings')}}</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif


                                            <div class="row">
                                                @php($isPublished = $publishedStatus == 1 ? 'disabled' : '')
                                                @foreach($dataValues as $gateway)
                                                    <div class="col-12 col-md-6 mb-30">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h4 class="page-title">{{translate($gateway->key_name)}}</h4>
                                                            </div>
                                                            <div class="card-body p-30">
                                                                <form
                                                                    action="{{route('admin.configuration.payment-set')}}"
                                                                    method="POST"
                                                                    id="{{$gateway->key_name}}-form"
                                                                    enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    @php($additional_data = $gateway['additional_data'] != null ? json_decode($gateway['additional_data']) : [])
                                                                    <div class="discount-type">
                                                                        <div
                                                                            class="d-flex align-items-center gap-4 gap-xl-5 mb-30">
                                                                            <div class="custom-radio">
                                                                                <input type="radio"
                                                                                       id="{{$gateway->key_name}}-active"
                                                                                       name="status"
                                                                                       value="1" {{$dataValues->where('key_name',$gateway->key_name)->first()->live_values['status']?'checked':''}} {{$isPublished}}>
                                                                                <label
                                                                                    for="{{$gateway->key_name}}-active">{{translate('active')}}</label>
                                                                            </div>
                                                                            <div class="custom-radio">
                                                                                <input type="radio"
                                                                                       id="{{$gateway->key_name}}-inactive"
                                                                                       name="status"
                                                                                       value="0" {{$dataValues->where('key_name',$gateway->key_name)->first()->live_values['status']?'':'checked'}} {{$isPublished}}>
                                                                                <label
                                                                                    for="{{$gateway->key_name}}-inactive">{{translate('inactive')}}</label>
                                                                            </div>
                                                                        </div>

                                                                        <div class="payment--gateway-img justify-content-center d-flex align-items-center">
                                                                            @php($gatewayImageFullPath = getPaymentGatewayImageFullPath(key: $gateway->key_name, settingsType: $gateway->settings_type, defaultPath: 'public/assets/admin-module/img/placeholder.png'))

                                                                            <img class="payment-image-preview" id="{{$gateway->key_name}}-image-preview"
                                                                                src="{{$gatewayImageFullPath}}" alt="{{translate('image')}}">
                                                                        </div>

                                                                        <input name="gateway"
                                                                               value="{{$gateway->key_name}}"
                                                                               class="hide-div">

                                                                        @php($mode=$dataValues->where('key_name',$gateway->key_name)->first()->live_values['mode'])
                                                                        <div class="form-floating mb-30 mt-30">
                                                                            <select
                                                                                class="js-select theme-input-style w-100"
                                                                                name="mode" {{$isPublished}}>
                                                                                <option
                                                                                    value="live" {{$mode=='live'?'selected':''}}>{{translate('live')}}</option>
                                                                                <option
                                                                                    value="test" {{$mode=='test'?'selected':''}}>{{translate('test')}}</option>
                                                                            </select>
                                                                        </div>

                                                                        @php($skip=['gateway','mode','status'])
                                                                        @foreach($dataValues->where('key_name',$gateway->key_name)->first()->live_values as $key=>$value)
                                                                            @if(!in_array($key,$skip))
                                                                                <div
                                                                                    class="form-floating mb-30 mt-30">
                                                                                    <input type="text"
                                                                                           class="form-control"
                                                                                           name="{{$key}}"
                                                                                           placeholder="{{translate($key)}} *"
                                                                                           value="{{env('APP_ENV')=='demo'?'':$value}}" {{$isPublished}}>
                                                                                    <label>{{translate($key)}}
                                                                                        *</label>
                                                                                </div>
                                                                            @endif
                                                                        @endforeach

                                                                        <div class="form-floating gateway-title">
                                                                            <input type="text" class="form-control"
                                                                                   id="{{$gateway->key_name}}-title"
                                                                                   name="gateway_title"
                                                                                   placeholder="{{translate('payment_gateway_title')}}"
                                                                                   value="{{$additional_data != null ? $additional_data->gateway_title : ''}}" {{$isPublished}}>
                                                                            <label
                                                                                for="{{$gateway->key_name}}-title"
                                                                                class="form-label">{{translate('payment_gateway_title')}}</label>
                                                                        </div>

                                                                        <div class="form-floating mb-3">
                                                                            <input type="file" class="form-control"
                                                                                   name="gateway_image"
                                                                                   accept=".jpg, .png, .jpeg|image/*"
                                                                                   id="{{$gateway->key_name}}-image">
                                                                        </div>

                                                                    </div>
                                                                    @can('configuration_update')
                                                                        <div class="d-flex justify-content-end">
                                                                            <button type="submit"
                                                                                    class="btn btn--primary demo_check" {{$isPublished}}>
                                                                                {{translate('update')}}
                                                                            </button>
                                                                        </div>
                                                                    @endcan
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if($webPage == 'storage_connection')
                    <div class="tab-content">
                        <div class="tab-pane fade {{$webPage == 'storage_connection' ? 'show active' : ''}}" id="storage_connection">
                            <div class="pick-map mb-3 p-12 rounded d-flex flex-md-nowrap flex-wrap align-items-center gap-1 bg-primary bg-opacity-10">
                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_9464_2249)">
                                    <path d="M9.79125 1.44318L10.5117 0.270677C10.6797 -0.00465646 11.039 -0.0898231 11.3138 0.0793436C11.5885 0.247927 11.6743 0.606677 11.5051 0.881427L10.7847 2.05393C10.675 2.23359 10.4831 2.33218 10.2871 2.33218C10.1827 2.33218 10.0777 2.30418 9.98259 2.24584C9.70784 2.07726 9.62209 1.71793 9.79125 1.44318ZM3.16575 2.05334C3.27542 2.23301 3.46792 2.33218 3.66392 2.33218C3.76775 2.33218 3.87275 2.30418 3.96784 2.24643C4.24259 2.07784 4.32892 1.71909 4.16034 1.44434L3.44109 0.27126C3.2725 -0.00348977 2.91317 -0.0892398 2.639 0.0787602C2.36425 0.247344 2.27792 0.606094 2.4465 0.880844L3.16575 2.05334ZM1.89059 3.34134L0.841754 2.83909C0.552421 2.69851 0.201838 2.82218 0.0641712 3.11326C-0.0752455 3.40376 0.0478378 3.75201 0.338338 3.89084L1.38717 4.39309C1.46825 4.43218 1.554 4.45084 1.63859 4.45084C1.85617 4.45084 2.065 4.32893 2.16475 4.11951C2.30417 3.82901 2.18109 3.48018 1.89059 3.34134ZM6.92067 2.33393C3.70417 2.38701 1.155 5.87301 2.9015 9.23068C3.16692 9.74051 3.56067 10.1675 3.98359 10.5566C4.144 10.7042 4.26825 10.8868 4.37442 11.0828H6.41667V8.05876C5.73942 7.81726 5.25 7.17559 5.25 6.41609C5.25 6.09351 5.51075 5.83276 5.83334 5.83276C6.15592 5.83276 6.41667 6.09351 6.41667 6.41609C6.41667 6.73868 6.678 6.99943 7 6.99943C7.322 6.99943 7.58334 6.73809 7.58334 6.41609C7.58334 6.09409 7.84409 5.83276 8.16667 5.83276C8.48925 5.83276 8.75 6.09351 8.75 6.41609C8.75 7.17559 8.26059 7.81726 7.58334 8.05876V11.0828H9.60634C9.73934 10.8547 9.91084 10.6394 10.1354 10.4522C10.5198 10.1313 10.8815 9.77376 11.1038 9.32518C12.117 7.27593 11.7151 5.09076 10.2719 3.67209C9.373 2.78776 8.18242 2.31468 6.92067 2.33393ZM4.662 12.4122C4.61534 13.2673 5.25584 14 6.11217 14H7.87442C8.68 14 9.33275 13.3473 9.33275 12.5417V12.25H4.65559C4.65559 12.3048 4.6655 12.3562 4.662 12.4122ZM13.9493 3.09168C13.8163 2.79826 13.4715 2.66584 13.1781 2.80001L12.0511 3.30868C11.7571 3.44109 11.6264 3.78643 11.7594 4.07984C11.8568 4.29568 12.0686 4.42343 12.2914 4.42343C12.3713 4.42343 12.453 4.40709 12.5306 4.37151L13.6576 3.86284C13.9516 3.73043 14.0823 3.38509 13.9493 3.09168Z" fill="#3C76F1"></path>
                                    </g>
                                    <defs>
                                    <clipPath id="clip0_9464_2249">
                                    <rect width="14" height="14" fill="white"></rect>
                                    </clipPath>
                                    </defs>
                                </svg>
                                <p class="fz-12">You can manage all your storage files from  <a href="#" class="text-primary fw-semibold text-decoration-underline"> Galley</a></p> 
                            </div>

                            <div class="card mb-20">
                                <div class="card-body p-20">
                                    <div class="row g-lg-4 g-4 align-items-center">
                                        <div class="col-lg-3">
                                            <h3 class="mb-2">{{translate('Storage Connection')}}</h3>
                                            <p class="fz-12 mb-xl-3 mb-xxl-4 mb-3">{{translate('Choose the SMS model you want to use for OTP & Other SMS')}}</p>
                                            <div class="bg-warning bg-opacity-10 fs-12 p-12 rounded">
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
                                                    <p class="fz-12 fw-normal">3rd Party storage is not set up yet. Please configure it first to ensure it works properly.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="bg-light rounded-2 p-20">
                                                <label class="text-dark mb-3 d-flex align-items-center gap-1">{{translate('Select Business Model')}}
                                                    <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="{{translate('3rd Party Storage is currently disabled. Please configure following data first..')}}"
                                                    >info</i>
                                                </label>
                                                <div class="bg-white rounded-2 p-16">
                                                    <div class="row g-xl-4 g-3">
                                                        <div class="col-md-6">
                                                            <div class="custom-radio">
                                                                <input type="radio" id="storage-login-active1" name="status" value="1" checked="">
                                                                <label for="storage-login-active1">
                                                                    <h5 class="mb-1">{{translate('Local Storage')}}</h5>
                                                                    <p class="fz-12 max-w-250">{{translate('If enable this, newly uploaded/created files and data will store to local
                                                                        storage.')}}</p>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="custom-radio">
                                                                <input type="radio" id="storage-login-active2" name="status" value="1">
                                                                <label for="storage-login-active2">
                                                                    <h5 class="mb-1">{{translate('3rd Party Storage')}}</h5>
                                                                    <p class="fz-12 max-w-250">{{translate('If enable this, newly uploaded/created files and data will store to 3rd party storage.')}}</p>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php
                                $s3Credentials = business_config('s3_storage_credentials', 'storage_settings');
                                if ($s3Credentials !== null && isset($s3Credentials->live_values)) {
                                    $liveValues = json_decode($s3Credentials->live_values, true);
                                } else {
                                    $liveValues = [
                                        'key' => '',
                                        'secret' => '',
                                        'region' => '',
                                        'bucket' => '',
                                        'url' => '',
                                        'endpoint' => '',
                                        'use_path_style_endpoint' => ''
                                    ];
                                }
                            ?>
                            <form action="{{route('admin.configuration.update-storage-connection')}}" id="update-storage-form" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="card mt-3">
                                    <div class="card-body">
                                        <div class="mb-20">
                                            <h4 class="mb-1">{{translate('S3 Credential')}}</h4>
                                            <p class="fs-12">
                                                {{ translate('The Access Key ID is a publicly accessible identifier used to authenticate requests to S3.') }}
                                                <a href="https://aws.amazon.com/s3/" target="_blank" class="c1 text-decoration-underline" data-bs-toggle="tooltip" title="">{{ translate('Learn more') }}</a>
                                            </p>
                                        </div>
                                        <div class="rounded p-20 body-bg">
                                            <div class="d-flex flex-wrap gap-3 align-items-center">
                                                <div class="max-w-353px">
                                                    <div class="min-w180 mb-1"><strong>{{ translate('Key') }}</strong></div>
                                                    <p class="fz-12">{{translate('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet.')}}</p>
                                                </div>
                                                <div class="d-flex flex-column gap-2 flex-grow-1">
                                                    <input type="text" name="key" class="form-control" value="{{ $liveValues['key'] }}" placeholder="{{ translate('Enter key') }}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="rounded p-20 body-bg mt-3">
                                            <div class="d-flex flex-wrap gap-3 align-items-center">
                                                <div class="max-w-353px">
                                                    <div class="min-w180 mb-1"><strong>{{ translate('Secret Credential') }}</strong></div>
                                                    <p class="fz-12">{{translate('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet.')}}</p>
                                                </div>
                                                <div class="d-flex flex-column gap-2 flex-grow-1">
                                                    <input type="text" name="secret" class="form-control" value="{{ $liveValues['secret'] }}" placeholder="{{ translate('Enter secret credential') }}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="rounded p-20 body-bg mt-3">
                                            <div class="d-flex flex-wrap gap-3 align-items-center">
                                                <div class="max-w-353px">
                                                    <div class="min-w180 mb-1"><strong>{{ translate('Region') }}</strong></div>
                                                    <p class="fz-12">{{translate('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet.')}}</p>
                                                </div>
                                                <div class="d-flex flex-column gap-2 flex-grow-1">
                                                    <input type="text" name="region" class="form-control" value="{{ $liveValues['region'] }}" placeholder="{{ translate('Enter region') }}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="rounded p-20 body-bg mt-3">
                                            <div class="d-flex flex-wrap gap-3 align-items-center">
                                                <div class="max-w-353px">
                                                    <div class="min-w180 mb-1"><strong>{{ translate('Bucket') }}</strong></div>
                                                    <p class="fz-12">{{translate('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet.')}}</p>
                                                </div>
                                                <div class="d-flex flex-column gap-2 flex-grow-1">
                                                    <input type="text" name="bucket" class="form-control" value="{{ $liveValues['bucket'] }}" placeholder="{{ translate('Enter bucket') }}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="rounded p-20 body-bg mt-3">
                                            <div class="d-flex flex-wrap gap-3 align-items-center">
                                                <div class="max-w-353px">
                                                    <div class="min-w180 mb-1"><strong>{{ translate('Url') }}</strong></div>
                                                    <p class="fz-12">{{translate('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet.')}}</p>
                                                </div>
                                                <div class="d-flex flex-column gap-2 flex-grow-1">
                                                    <input type="text" name="url" class="form-control" value="{{ $liveValues['url'] }}" placeholder="{{ translate('Enter url') }}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="rounded p-20 body-bg mt-3">
                                            <div class="d-flex flex-wrap gap-3 align-items-center">
                                                <div class="max-w-353px">
                                                    <div class="min-w180 mb-1"><strong>{{ translate('Endpoint') }}</strong></div>
                                                    <p class="fz-12">{{translate('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet.')}}</p>
                                                </div>
                                                <div class="d-flex flex-column gap-2 flex-grow-1">
                                                    <input type="text" name="endpoint" class="form-control" value="{{ $liveValues['endpoint'] }}" placeholder="{{ translate('Enter endpoint') }}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <div class="d-flex justify-content-end gap-3">
                                                <button type="reset" class="btn btn--secondary rounded">{{translate('Reset')}}</button>
                                                <button type="button" class="btn d-flex align-items-center gap-2 btn--primary demo_check rounded" data-bs-toggle="modal" data-bs-target="#confirmation">
                                                    <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <g clip-path="url(#clip0_10110_12184)">
                                                        <path d="M9.91732 0.5H4.08398V4H9.91732V0.5Z" fill="white"/>
                                                        <path d="M7.00065 9.83333C7.64498 9.83333 8.16732 9.311 8.16732 8.66667C8.16732 8.02233 7.64498 7.5 7.00065 7.5C6.35632 7.5 5.83398 8.02233 5.83398 8.66667C5.83398 9.311 6.35632 9.83333 7.00065 9.83333Z" fill="white"/>
                                                        <path d="M11.0833 0.5V5.16667H2.91667V0.5H1.75C1.28587 0.5 0.840752 0.684374 0.512563 1.01256C0.184374 1.34075 0 1.78587 0 2.25L0 14.5H14V3.41667L11.0833 0.5ZM7 11C6.53851 11 6.08738 10.8632 5.70367 10.6068C5.31995 10.3504 5.02088 9.98596 4.84428 9.55959C4.66768 9.13323 4.62147 8.66408 4.7115 8.21146C4.80153 7.75883 5.02376 7.34307 5.35008 7.01675C5.67641 6.69043 6.09217 6.4682 6.54479 6.37817C6.99741 6.28814 7.46657 6.33434 7.89293 6.51095C8.31929 6.68755 8.68371 6.98662 8.94009 7.37034C9.19649 7.75405 9.33333 8.20518 9.33333 8.66667C9.33333 9.28551 9.0875 9.879 8.64992 10.3166C8.21233 10.7542 7.61884 11 7 11Z" fill="white"/>
                                                        </g>
                                                        <defs>
                                                        <clipPath id="clip0_10110_12184">
                                                        <rect width="14" height="14" fill="white" transform="translate(0 0.5)"/>
                                                        </clipPath>
                                                        </defs>
                                                    </svg>
                                                    {{translate('Save Information')}}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <!-- <div class="card">
                                <div class="card-body">
                                    <h4 class="mb-3">
                                        {{translate('storage Connection Setting')}}
                                    </h4>

                                    <div class="row g-4">
                                        @php($storageType = business_config('storage_connection_type', 'storage_settings'))
                                        <div class="col-sm-6 col-lg-4">
                                            <div class="border p-3 rounded d-flex justify-content-between">
                                                <div class="d-flex gap-2">
                                                    <span class="text-capitalize">{{ translate('Local System') }}</span>
                                                    <i class="material-symbols-outlined cursor-pointer" data-bs-toggle="tooltip" title="{{ translate('If enabled System will store all files and images to local storage') }}">info</i>
                                                </div>
                                                <label class="switcher">
                                                    <input class="switcher_input @if(env('app_env')!='demo') change-storage-connection-type @endif"
                                                           type="checkbox"
                                                           data-name="local"
                                                           data-value="$(this).is(':checked')===true?1:0"
                                                           {{isset($storageType) && $storageType->live_values == 'local' ? 'checked' : ''}}
                                                           id="local_system">
                                                    <span class="switcher_control"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-lg-4">
                                            <div class="border p-3 rounded d-flex justify-content-between">
                                                <div class="d-flex gap-2">
                                                    <span class="text-capitalize">{{ translate('3rd Party Storage') }}</span>
                                                    <i class="material-symbols-outlined cursor-pointer" data-bs-toggle="tooltip" title="{{ translate('If enabled System will store all files and images to 3rd party storage') }}">info</i>
                                                </div>
                                                <label class="switcher">
                                                    <input class="switcher_input @if(env('app_env')!='demo') change-storage-connection-type @endif"
                                                           type="checkbox"
                                                           data-name="s3"
                                                           data-value="$(this).is(':checked')===true?1:0"
                                                           {{isset($storageType) && $storageType->live_values == 's3' ? 'checked' : ''}}
                                                           id="3rd_party_storage" @if(env('app_env')=='demo') disabled @endif>
                                                    <span class="switcher_control"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <!-- <div>
                            <?php
                                $s3Credentials = business_config('s3_storage_credentials', 'storage_settings');
                                if ($s3Credentials !== null && isset($s3Credentials->live_values)) {
                                    $liveValues = json_decode($s3Credentials->live_values, true);
                                } else {
                                    $liveValues = [
                                        'key' => '',
                                        'secret' => '',
                                        'region' => '',
                                        'bucket' => '',
                                        'url' => '',
                                        'endpoint' => '',
                                        'use_path_style_endpoint' => ''
                                    ];
                                }
                            ?>
                            </div> -->
                            <!-- <form action="{{route('admin.configuration.update-storage-connection')}}" id="update-storage-form" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="card mt-3">
                                    <div class="card-body border-bottom">
                                        <h4 class="mb-2">{{translate('S3 Credential')}}</h4>
                                        <p class="fs-12">
                                            {{ translate('The Access Key ID is a publicly accessible identifier used to authenticate requests to S3.') }}
                                            <a href="https://aws.amazon.com/s3/" target="_blank" class="c1 text-decoration-underline" data-bs-toggle="tooltip" title="">{{ translate('Learn more') }}</a>
                                        </p>
                                    </div>
                                    <div class="card-body">
                                        <div class="border rounded p-30">
                                            <div class="d-flex flex-wrap gap-3 align-items-center">
                                                <div class="min-w180"><strong>{{ translate('Key') }}</strong></div>
                                                <div class="d-flex flex-column gap-2 flex-grow-1">
                                                    <input type="text" name="key" class="form-control" value="{{ $liveValues['key'] }}" placeholder="{{ translate('Enter key') }}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="border rounded p-30 mt-3">
                                            <div class="d-flex flex-wrap gap-3 align-items-center">
                                                <div class="min-w180"><strong>{{ translate('Secret Credential') }}</strong></div>
                                                <div class="d-flex flex-column gap-2 flex-grow-1">
                                                    <input type="text" name="secret" class="form-control" value="{{ $liveValues['secret'] }}" placeholder="{{ translate('Enter secret credential') }}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="border rounded p-30 mt-3">
                                            <div class="d-flex flex-wrap gap-3 align-items-center">
                                                <div class="min-w180"><strong>{{ translate('Region') }}</strong></div>
                                                <div class="d-flex flex-column gap-2 flex-grow-1">
                                                    <input type="text" name="region" class="form-control" value="{{ $liveValues['region'] }}" placeholder="{{ translate('Enter region') }}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="border rounded p-30 mt-3">
                                            <div class="d-flex flex-wrap gap-3 align-items-center">
                                                <div class="min-w180"><strong>{{ translate('Bucket') }}</strong></div>
                                                <div class="d-flex flex-column gap-2 flex-grow-1">
                                                    <input type="text" name="bucket" class="form-control" value="{{ $liveValues['bucket'] }}" placeholder="{{ translate('Enter bucket') }}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="border rounded p-30 mt-3">
                                            <div class="d-flex flex-wrap gap-3 align-items-center">
                                                <div class="min-w180"><strong>{{ translate('Url') }}</strong></div>
                                                <div class="d-flex flex-column gap-2 flex-grow-1">
                                                    <input type="text" name="url" class="form-control" value="{{ $liveValues['url'] }}" placeholder="{{ translate('Enter url') }}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="border rounded p-30 mt-3">
                                            <div class="d-flex flex-wrap gap-3 align-items-center">
                                                <div class="min-w180"><strong>{{ translate('Endpoint') }}</strong></div>
                                                <div class="d-flex flex-column gap-2 flex-grow-1">
                                                    <input type="text" name="endpoint" class="form-control" value="{{ $liveValues['endpoint'] }}" placeholder="{{ translate('Enter endpoint') }}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <div class="d-flex justify-content-end gap-3">
                                                <button type="reset" class="btn btn--secondary">{{translate('Reset')}}</button>
                                                <button type="button" class="btn btn--primary demo_check" data-bs-toggle="modal" data-bs-target="#confirmation">{{translate('Save Information')}}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form> -->
                        </div>
                    </div>
                @endif

                @if($webPage == 'app_settings')
                    <div class="tab-content">
                        <div class="tab-pane fade {{$webPage == 'app_settings' ? 'show active' : ''}}"
                             id="app_settings">
                             <div class="bg-warning bg-opacity-10 fs-12 p-12 text-dark rounded mb-15">
                                <div class="d-flex align-items-center gap-2 mb-2">
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
                                    <p class="fz-12 fw-medium">In this page you can setup latest version app forcefully activate for the users. Please input proper data for the app link & versions. </p>
                                </div>
                                <ul class="m-0 ps-20 d-flex flex-column gap-1 text-dark">
                                    <li>Some time older version app can’t work properly and crash when start the app.</li>
                                    <li>This section may help user to get the update features in their app.</li>
                                </ul>
                            </div>
                            <div class="card mb-15">
                                <div class="p-20 border-bottom">
                                    <h4 class="page-title mb-1">
                                        {{translate('Customer app version control')}}
                                    </h4>
                                    <p class="fz-12">{{translate('Here you setup your Customer app version & app download URL')}}</p>
                                </div>
                                <div class="card-body p-20">
                                    <form action="{{route('admin.configuration.set-app-settings')}}" method="POST" id="google-map-update-form" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="discount-type mb-20">
                                            <div class="row g-lg-4 g-3">
                                                <div class="col-md-6 col-12">
                                                    <div class="d-flex align-items-center gap-2 fw-bold text-dark mb-20">
                                                        <img src="{{asset('public/assets/admin-module/img/google-play-icon.png')}}" alt="">  {{translate('For android')}}
                                                    </div>
                                                    <div class="body-bg rounded p-20">
                                                        <div class="mb-xl-4 mb-3">
                                                            <label class="mb-2 text-dark d-flex align-items-center gap-1">{{translate('Minimum User App Version for Force Update (Android)')}}
                                                                <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    title="{{translate('Customer satisfaction is our main motto')}}"
                                                                >info</i>
                                                            </label>
                                                            <input type="text" class="form-control" name="min_version_for_android" placeholder="{{translate('min_version_for_android')}} *" required=""
                                                                    value="{{$customerDataValues->min_version_for_android??''}}"
                                                                    pattern="^\d+(\.\d+){0,2}$"
                                                                    title="Minimum User App Version for Force Update (Android)">
                                                        </div>
                                                        <div class="">
                                                            <label class="mb-2 text-dark d-flex align-items-center gap-1">{{translate('Download URL for User App (Android)')}}
                                                                <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    title="{{translate('Customer satisfaction is our main motto')}}"
                                                                >info</i>
                                                            </label>
                                                            <input type="text" class="form-control" name="downloads" placeholder="{{translate('Download Url')}} *" required="" value="" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="d-flex align-items-center gap-2 fw-bold text-dark mb-20">
                                                        <img src="{{asset('public/assets/admin-module/img/ios-icon.png')}}" alt="">  {{translate('For ios')}}
                                                    </div>
                                                    <div class="body-bg rounded p-20">
                                                        <div class="mb-xl-4 mb-3">
                                                            <label class="mb-2 text-dark d-flex align-items-center gap-1">{{translate('Minimum User App Version for Force Update (Android)')}}
                                                                <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    title="{{translate('Customer satisfaction is our main motto')}}"
                                                                >info</i>
                                                            </label>
                                                            <input type="text"
                                                                    class="form-control"
                                                                    name="min_version_for_ios"
                                                                    placeholder="{{translate('min_version_for_IOS')}} *"
                                                                    required=""
                                                                    value="{{$customerDataValues->min_version_for_ios??''}}"
                                                                    pattern="^\d+(\.\d+){0,2}$"
                                                                    title="Please enter a version number like 1.0.0 with a maximum of two dots.">
                                                        </div>
                                                        <div class="">
                                                            <label class="mb-2 text-dark d-flex align-items-center gap-1">{{translate('Download URL for User App (Android)')}}
                                                                <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    title="{{translate('Customer satisfaction is our main motto')}}"
                                                                >info</i>
                                                            </label>
                                                            <input type="text" class="form-control" name="downloads" placeholder="{{translate('Download Url')}} *" required="" value="" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <input name="app_type" value="customer"
                                                        class="hide-div">
                                            </div>
                                        </div>
                                        @can('configuration_update')
                                            <div class="d-flex justify-content-end gap-xl-3 gap-2">
                                                <button type="reset" class="btn btn--secondary rounded">
                                                    {{translate('reset')}}
                                                </button>
                                                <button type="submit"
                                                        class="btn btn--primary demo_check rounded">
                                                    {{translate('update')}}
                                                </button>
                                            </div>
                                        @endcan
                                    </form>
                                </div>
                            </div>
                            <div class="card mb-15">
                                <div class="p-20 border-bottom">
                                    <h4 class="page-title mb-1">
                                        {{translate('Vendor app version control')}}
                                    </h4>
                                    <p class="fz-12">{{translate('Here you setup your Vendor app version & app download URL')}}</p>
                                </div>
                                <div class="card-body p-20">
                                    <form action="{{route('admin.configuration.set-app-settings')}}" method="POST" id="google-map-update-form" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="discount-type mb-20">
                                            <div class="row g-lg-4 g-3">
                                                <div class="col-md-6 col-12">
                                                    <div class="d-flex align-items-center gap-2 fw-bold text-dark mb-20">
                                                        <img src="{{asset('public/assets/admin-module/img/google-play-icon.png')}}" alt="">  {{translate('For android')}}
                                                    </div>
                                                    <div class="body-bg rounded p-20">
                                                        <div class="mb-xl-4 mb-3">
                                                            <label class="mb-2 text-dark d-flex align-items-center gap-1">{{translate('Minimum User App Version for Force Update (Android)')}}
                                                                <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    title="{{translate('Customer satisfaction is our main motto')}}"
                                                                >info</i>
                                                            </label>
                                                            <input type="text" class="form-control" name="min_version_for_android" placeholder="{{translate('min_version_for_android')}} *" required=""
                                                                    value="{{$customerDataValues->min_version_for_android??''}}"
                                                                    pattern="^\d+(\.\d+){0,2}$"
                                                                    title="Minimum User App Version for Force Update (Android)">
                                                        </div>
                                                        <div class="">
                                                            <label class="mb-2 text-dark d-flex align-items-center gap-1">{{translate('Download URL for User App (Android)')}}
                                                                <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    title="{{translate('Customer satisfaction is our main motto')}}"
                                                                >info</i>
                                                            </label>
                                                            <input type="text" class="form-control" name="downloads" placeholder="{{translate('Download Url')}} *" required="" value="" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="d-flex align-items-center gap-2 fw-bold text-dark mb-20">
                                                        <img src="{{asset('public/assets/admin-module/img/ios-icon.png')}}" alt="">  {{translate('For ios')}}
                                                    </div>
                                                    <div class="body-bg rounded p-20">
                                                        <div class="mb-xl-4 mb-3">
                                                            <label class="mb-2 text-dark d-flex align-items-center gap-1">{{translate('Minimum User App Version for Force Update (Android)')}}
                                                                <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    title="{{translate('Customer satisfaction is our main motto')}}"
                                                                >info</i>
                                                            </label>
                                                            <input type="text"
                                                                    class="form-control"
                                                                    name="min_version_for_ios"
                                                                    placeholder="{{translate('min_version_for_IOS')}} *"
                                                                    required=""
                                                                    value="{{$customerDataValues->min_version_for_ios??''}}"
                                                                    pattern="^\d+(\.\d+){0,2}$"
                                                                    title="Please enter a version number like 1.0.0 with a maximum of two dots.">
                                                        </div>
                                                        <div class="">
                                                            <label class="mb-2 text-dark d-flex align-items-center gap-1">{{translate('Download URL for User App (Android)')}}
                                                                <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    title="{{translate('Customer satisfaction is our main motto')}}"
                                                                >info</i>
                                                            </label>
                                                            <input type="text" class="form-control" name="downloads" placeholder="{{translate('Download Url')}} *" required="" value="" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <input name="app_type" value="customer"
                                                        class="hide-div">
                                            </div>
                                        </div>
                                        @can('configuration_update')
                                            <div class="d-flex justify-content-end gap-xl-3 gap-2">
                                                <button type="reset" class="btn btn--secondary rounded">
                                                    {{translate('reset')}}
                                                </button>
                                                <button type="submit"
                                                        class="btn btn--primary demo_check rounded">
                                                    {{translate('update')}}
                                                </button>
                                            </div>
                                        @endcan
                                    </form>
                                </div>
                            </div>
                            <div class="card">
                                <div class="p-20 border-bottom">
                                    <h4 class="page-title mb-1">
                                        {{translate('Delivery man app version control')}}
                                    </h4>
                                    <p class="fz-12">{{translate('Here you setup your Delivery Man app version & app download URL')}}</p>
                                </div>
                                <div class="card-body p-20">
                                    <form action="{{route('admin.configuration.set-app-settings')}}" method="POST" id="google-map-update-form" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="discount-type mb-20">
                                            <div class="row g-lg-4 g-3">
                                                <div class="col-md-6 col-12">
                                                    <div class="d-flex align-items-center gap-2 fw-bold text-dark mb-20">
                                                        <img src="{{asset('public/assets/admin-module/img/google-play-icon.png')}}" alt="">  {{translate('For android')}}
                                                    </div>
                                                    <div class="body-bg rounded p-20">
                                                        <div class="mb-xl-4 mb-3">
                                                            <label class="mb-2 text-dark d-flex align-items-center gap-1">{{translate('Minimum User App Version for Force Update (Android)')}}
                                                                <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    title="{{translate('Customer satisfaction is our main motto')}}"
                                                                >info</i>
                                                            </label>
                                                            <input type="text" class="form-control" name="min_version_for_android" placeholder="{{translate('min_version_for_android')}} *" required=""
                                                                    value="{{$customerDataValues->min_version_for_android??''}}"
                                                                    pattern="^\d+(\.\d+){0,2}$"
                                                                    title="Minimum User App Version for Force Update (Android)">
                                                        </div>
                                                        <div class="">
                                                            <label class="mb-2 text-dark d-flex align-items-center gap-1">{{translate('Download URL for User App (Android)')}}
                                                                <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    title="{{translate('Customer satisfaction is our main motto')}}"
                                                                >info</i>
                                                            </label>
                                                            <input type="text" class="form-control" name="downloads" placeholder="{{translate('Download Url')}} *" required="" value="" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="d-flex align-items-center gap-2 fw-bold text-dark mb-20">
                                                        <img src="{{asset('public/assets/admin-module/img/ios-icon.png')}}" alt="">  {{translate('For ios')}}
                                                    </div>
                                                    <div class="body-bg rounded p-20">
                                                        <div class="mb-xl-4 mb-3">
                                                            <label class="mb-2 text-dark d-flex align-items-center gap-1">{{translate('Minimum User App Version for Force Update (Android)')}}
                                                                <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    title="{{translate('Customer satisfaction is our main motto')}}"
                                                                >info</i>
                                                            </label>
                                                            <input type="text"
                                                                    class="form-control"
                                                                    name="min_version_for_ios"
                                                                    placeholder="{{translate('min_version_for_IOS')}} *"
                                                                    required=""
                                                                    value="{{$customerDataValues->min_version_for_ios??''}}"
                                                                    pattern="^\d+(\.\d+){0,2}$"
                                                                    title="Please enter a version number like 1.0.0 with a maximum of two dots.">
                                                        </div>
                                                        <div class="">
                                                            <label class="mb-2 text-dark d-flex align-items-center gap-1">{{translate('Download URL for User App (Android)')}}
                                                                <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    title="{{translate('Customer satisfaction is our main motto')}}"
                                                                >info</i>
                                                            </label>
                                                            <input type="text" class="form-control" name="downloads" placeholder="{{translate('Download Url')}} *" required="" value="" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <input name="app_type" value="customer"
                                                        class="hide-div">
                                            </div>
                                        </div>
                                        @can('configuration_update')
                                            <div class="d-flex justify-content-end gap-xl-3 gap-2">
                                                <button type="reset" class="btn btn--secondary rounded">
                                                    {{translate('reset')}}
                                                </button>
                                                <button type="submit"
                                                        class="btn btn--primary demo_check rounded">
                                                    {{translate('update')}}
                                                </button>
                                            </div>
                                        @endcan
                                    </form>
                                </div>
                            </div>
                            <!-- <div class="card">
                                <div class="card-header">
                                    <h4 class="page-title">
                                        {{translate('Customer App Configuration')}}
                                    </h4>
                                </div>
                                <div class="card-body p-30">
                                    <div class="row">
                                        <div class="col-12 col-md-12 mb-30">
                                            <div class="mb-3">
                                                <ul class="nav nav--tabs nav--tabs__style2">
                                                    <li class="nav-item">
                                                        <button data-bs-toggle="tab" data-bs-target="#customer"
                                                                class="nav-link active">
                                                            {{translate('Customer')}}
                                                        </button>
                                                    </li>
                                                    <li class="nav-item">
                                                        <button data-bs-toggle="tab" data-bs-target="#provider"
                                                                class="nav-link">
                                                            {{translate('Provider')}}
                                                        </button>
                                                    </li>
                                                    <li class="nav-item">
                                                        <button data-bs-toggle="tab" data-bs-target="#serviceman"
                                                                class="nav-link">
                                                            {{translate('Serviceman')}}
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>

                                            <div class="tab-content">
                                                <div class="tab-pane fade show active" id="customer">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h4 class="page-title">{{translate('Customer_app_configuration')}}</h4>
                                                        </div>
                                                        <div class="card-body p-30">
                                                            <div class="alert alert-danger mb-30">
                                                                <p>
                                                                    <i class="material-icons">info</i>
                                                                    {{translate('If there is any update available in the admin panel and for that the previous app will not work. You can force the customer from here by providing the minimum version for force update. That means if a customer has an app below this version the customers must need to update the app first. If you do not need a force update just insert here zero (0) and ignore it.')}}
                                                                </p>
                                                            </div>
                                                            <form
                                                                action="{{route('admin.configuration.set-app-settings')}}"
                                                                method="POST"
                                                                id="google-map-update-form"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="discount-type">
                                                                    <div class="row">
                                                                        <div class="col-md-6 col-12">
                                                                            <div class="mb-30">
                                                                                <div class="form-floating">
                                                                                    <input type="text"
                                                                                           class="form-control"
                                                                                           name="min_version_for_android"
                                                                                           placeholder="{{translate('min_version_for_android')}} *"
                                                                                           required=""
                                                                                           value="{{$customerDataValues->min_version_for_android??''}}"
                                                                                           pattern="^\d+(\.\d+){0,2}$"
                                                                                           title="Please enter a version number like 1.0.0 with a maximum of two dots.">
                                                                                    <label>{{translate('min_version_for_android')}}
                                                                                        *</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-12">
                                                                            <div class="mb-30">
                                                                                <div class="form-floating">
                                                                                    <input type="text"
                                                                                           class="form-control"
                                                                                           name="min_version_for_ios"
                                                                                           placeholder="{{translate('min_version_for_IOS')}} *"
                                                                                           required=""
                                                                                           value="{{$customerDataValues->min_version_for_ios??''}}"
                                                                                           pattern="^\d+(\.\d+){0,2}$"
                                                                                           title="Please enter a version number like 1.0.0 with a maximum of two dots.">
                                                                                    <label>{{translate('min_version_for_IOS')}}
                                                                                        *</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <input name="app_type" value="customer"
                                                                               class="hide-div">
                                                                    </div>
                                                                </div>
                                                                @can('configuration_update')
                                                                    <div class="d-flex justify-content-end">
                                                                        <button type="submit"
                                                                                class="btn btn--primary demo_check">
                                                                            {{translate('update')}}
                                                                        </button>
                                                                    </div>
                                                                @endcan
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-content">
                                                <div class="tab-pane fade" id="provider">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h4 class="page-title">{{translate('Provider_app_configuration')}}</h4>
                                                        </div>
                                                        <div class="card-body p-30">
                                                            <div class="alert alert-danger mb-30">
                                                                <p>
                                                                    <i class="material-icons">info</i>
                                                                    {{translate('If there is any update available in the admin panel and for that the previous app will not work. You can force the user from here by providing the minimum version for force update. That means if a user has an app below this version the users must need to update the app first. If you do not need a force update just insert here zero (0) and ignore it.')}}
                                                                </p>
                                                            </div>
                                                            <form
                                                                action="{{route('admin.configuration.set-app-settings')}}"
                                                                method="POST"
                                                                id="google-map-update-form"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="discount-type">
                                                                    <div class="row">
                                                                        <div class="col-md-6 col-12">
                                                                            <div class="mb-30">
                                                                                <div class="form-floating">
                                                                                    <input type="text"
                                                                                           class="form-control"
                                                                                           name="min_version_for_android"
                                                                                           placeholder="{{translate('min_version_for_android')}} *"
                                                                                           required=""
                                                                                           value="{{$providerDataValues->min_version_for_android??''}}"
                                                                                           pattern="^\d+(\.\d+){0,2}$"
                                                                                           title="Please enter a version number like 1.0.0 with a maximum of two dots.">
                                                                                    <label>{{translate('min_version_for_android')}}
                                                                                        *</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-12">
                                                                            <div class="mb-30">
                                                                                <div class="form-floating">
                                                                                    <input type="text"
                                                                                           class="form-control"
                                                                                           name="min_version_for_ios"
                                                                                           placeholder="{{translate('min_version_for_IOS')}} *"
                                                                                           required=""
                                                                                           value="{{$providerDataValues->min_version_for_ios??''}}"
                                                                                           pattern="^\d+(\.\d+){0,2}$"
                                                                                           title="Please enter a version number like 1.0.0 with a maximum of two dots.">
                                                                                    <label>{{translate('min_version_for_IOS')}}
                                                                                        *</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <input name="app_type" value="provider"
                                                                               class="hide-div">
                                                                    </div>
                                                                </div>
                                                                @can('configuration_update')
                                                                    <div class="d-flex justify-content-end">
                                                                        <button type="submit"
                                                                                class="btn btn--primary demo_check">
                                                                            {{translate('update')}}
                                                                        </button>
                                                                    </div>
                                                                @endcan
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-content">
                                                <div class="tab-pane fade" id="serviceman">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h4 class="page-title">{{translate('Serviceman_app_configuration')}}</h4>
                                                        </div>
                                                        <div class="card-body p-30">
                                                            <div class="alert alert-danger mb-30">
                                                                <p>
                                                                    <i class="material-icons">info</i>
                                                                    {{translate('If there is any update available in the admin panel and for that the previous app will not work. You can force the user from here by providing the minimum version for force update. That means if a user has an app below this version the users must need to update the app first. If you do not need a force update just insert here zero (0) and ignore it.')}}
                                                                </p>
                                                            </div>
                                                            <form
                                                                action="{{route('admin.configuration.set-app-settings')}}"
                                                                method="POST"
                                                                id="google-map-update-form"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="discount-type">
                                                                    <div class="row">
                                                                        <div class="col-md-6 col-12">
                                                                            <div class="mb-30">
                                                                                <div class="form-floating">
                                                                                    <input type="text"
                                                                                           class="form-control"
                                                                                           name="min_version_for_android"
                                                                                           placeholder="{{translate('min_version_for_android')}} *"
                                                                                           required=""
                                                                                           value="{{$servicemanDataValues->min_version_for_android??''}}"
                                                                                           pattern="^\d+(\.\d+){0,2}$"
                                                                                           title="Please enter a version number like 1.0.0 with a maximum of two dots.">
                                                                                    <label>{{translate('min_version_for_android')}}
                                                                                        *</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-12">
                                                                            <div class="mb-30">
                                                                                <div class="form-floating">
                                                                                    <input type="text"
                                                                                           class="form-control"
                                                                                           name="min_version_for_ios"
                                                                                           placeholder="{{translate('min_version_for_IOS')}} *"
                                                                                           required=""
                                                                                           value="{{$servicemanDataValues->min_version_for_ios??''}}"
                                                                                           pattern="^\d+(\.\d+){0,2}$"
                                                                                           title="Please enter a version number like 1.0.0 with a maximum of two dots.">
                                                                                    <label>{{translate('min_version_for_IOS')}}
                                                                                        *</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <input name="app_type" value="serviceman"
                                                                               class="hide-div">
                                                                    </div>
                                                                </div>
                                                                @can('configuration_update')
                                                                    <div class="d-flex justify-content-end">
                                                                        <button type="submit"
                                                                                class="btn btn--primary demo_check">
                                                                            {{translate('update')}}
                                                                        </button>
                                                                    </div>
                                                                @endcan
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                @endif

                @php($firebaseOtpVerification = (business_config('firebase_otp_verification', 'third_party'))?->live_values ?? ['status' => 0, 'web_api_key' => ''])
                @if($webPage == 'firebase_otp_verification')
                    <div class="tab-content">
                        <div class="tab-pane fade {{$webPage == 'firebase_otp_verification' ? 'show active' : ''}}"
                             id="firebase_otp_verification">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="page-title">
                                        {{translate('Firebase_auth_setup')}}
                                    </h4>
                                </div>
                                <div class="card-body p-30">
                                    <form action="{{route('admin.configuration.set-third-party-config')}}"
                                          method="POST"
                                          id="firebase-otp-verification-form" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="d-flex align-items-center gap-4 gap-xl-5 mb-30">
                                            <div class="custom-radio">
                                                <input type="radio" id="firebase-login-active"
                                                       name="status"
                                                       value="1" {{$firebaseOtpVerification['status']?'checked':''}}>
                                                <label for="firebase-login-active">{{translate('active')}}</label>
                                            </div>
                                            <div class="custom-radio">
                                                <input type="radio" id="firebase-login-inactive"
                                                       name="status"
                                                       value="0" {{$firebaseOtpVerification['status']?'':'checked'}}>
                                                <label for="firebase-login-inactive">{{translate('inactive')}}</label>
                                            </div>
                                        </div>
                                        <label>
                                            <input name="party_name" value="firebase_otp_verification"
                                                   class="hide-div">
                                        </label>
                                        <div class="form-floating">
                                            <input type="text" class="form-control"
                                                   name="web_api_key"
                                                   placeholder="{{translate('Web api key')}} *"
                                                   value="{{ env('APP_ENV') != 'demo' ? $firebaseOtpVerification['web_api_key'] : ''}}" required>
                                            <label>{{translate('Web api key')}} *</label>
                                        </div>

                                        @can('configuration_update')
                                            <div class="d-flex justify-content-end mt-4">
                                                <button type="submit" class="btn btn--primary demo_check">
                                                    {{translate('update')}}
                                                </button>
                                            </div>
                                        @endcan
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="confirmation" tabindex="-1" aria-labelledby="confirmationLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-30">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="d-flex flex-column gap-2 align-items-center text-center">
                        <img class="mb-3" src="{{asset('public/assets/admin-module')}}/img/ad_delete.svg" alt="">
                        <h3 class="mb-2">{{ translate('Are you sure you want save this information') }}?</h3>
                        <p>{{ translate('Connecting to S3 server for storage means that only new data will be stored in the S3 server. Existing data saved in local storage will not be migrated to the S3 server.') }}</p>
                        <div class="d-flex gap-3 justify-content-center flex-wrap">
                            <button type="button" class="btn btn--secondary"  data-bs-dismiss="modal">{{ translate('Cancel') }}</button>
                            @if(env('APP_ENV') !='demo')
                            <button type="button" class="btn btn--primary" id="submit-storage-data">{{ translate('Continue') }}</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <!-- Modal -->
     <div class="modal fade" id="send__mail" tabindex="-1" aria-labelledby="send__mailLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-xl-4 p-3">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div>
                            <h4 class="mb-xl-2 mb-1">{{ translate('Send Test Mail') }}?</h4>
                            <p>{{ translate('Insert a valid email addresser to get mail') }}</p>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="pick-map mb-20 p-12 rounded d-flex flex-md-nowrap flex-wrap align-items-center gap-1 bg-primary bg-opacity-10">
                        <svg width="18" height="18" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_9464_2249)">
                            <path d="M9.79125 1.44318L10.5117 0.270677C10.6797 -0.00465646 11.039 -0.0898231 11.3138 0.0793436C11.5885 0.247927 11.6743 0.606677 11.5051 0.881427L10.7847 2.05393C10.675 2.23359 10.4831 2.33218 10.2871 2.33218C10.1827 2.33218 10.0777 2.30418 9.98259 2.24584C9.70784 2.07726 9.62209 1.71793 9.79125 1.44318ZM3.16575 2.05334C3.27542 2.23301 3.46792 2.33218 3.66392 2.33218C3.76775 2.33218 3.87275 2.30418 3.96784 2.24643C4.24259 2.07784 4.32892 1.71909 4.16034 1.44434L3.44109 0.27126C3.2725 -0.00348977 2.91317 -0.0892398 2.639 0.0787602C2.36425 0.247344 2.27792 0.606094 2.4465 0.880844L3.16575 2.05334ZM1.89059 3.34134L0.841754 2.83909C0.552421 2.69851 0.201838 2.82218 0.0641712 3.11326C-0.0752455 3.40376 0.0478378 3.75201 0.338338 3.89084L1.38717 4.39309C1.46825 4.43218 1.554 4.45084 1.63859 4.45084C1.85617 4.45084 2.065 4.32893 2.16475 4.11951C2.30417 3.82901 2.18109 3.48018 1.89059 3.34134ZM6.92067 2.33393C3.70417 2.38701 1.155 5.87301 2.9015 9.23068C3.16692 9.74051 3.56067 10.1675 3.98359 10.5566C4.144 10.7042 4.26825 10.8868 4.37442 11.0828H6.41667V8.05876C5.73942 7.81726 5.25 7.17559 5.25 6.41609C5.25 6.09351 5.51075 5.83276 5.83334 5.83276C6.15592 5.83276 6.41667 6.09351 6.41667 6.41609C6.41667 6.73868 6.678 6.99943 7 6.99943C7.322 6.99943 7.58334 6.73809 7.58334 6.41609C7.58334 6.09409 7.84409 5.83276 8.16667 5.83276C8.48925 5.83276 8.75 6.09351 8.75 6.41609C8.75 7.17559 8.26059 7.81726 7.58334 8.05876V11.0828H9.60634C9.73934 10.8547 9.91084 10.6394 10.1354 10.4522C10.5198 10.1313 10.8815 9.77376 11.1038 9.32518C12.117 7.27593 11.7151 5.09076 10.2719 3.67209C9.373 2.78776 8.18242 2.31468 6.92067 2.33393ZM4.662 12.4122C4.61534 13.2673 5.25584 14 6.11217 14H7.87442C8.68 14 9.33275 13.3473 9.33275 12.5417V12.25H4.65559C4.65559 12.3048 4.6655 12.3562 4.662 12.4122ZM13.9493 3.09168C13.8163 2.79826 13.4715 2.66584 13.1781 2.80001L12.0511 3.30868C11.7571 3.44109 11.6264 3.78643 11.7594 4.07984C11.8568 4.29568 12.0686 4.42343 12.2914 4.42343C12.3713 4.42343 12.453 4.40709 12.5306 4.37151L13.6576 3.86284C13.9516 3.73043 14.0823 3.38509 13.9493 3.09168Z" fill="#3C76F1"></path>
                            </g>
                            <defs>
                            <clipPath id="clip0_9464_2249">
                            <rect width="14" height="14" fill="white"></rect>
                            </clipPath>
                            </defs>
                        </svg>
                        <p class="fz-12">SMTP is configured for Mail. Please test to ensure you are receiving mail correctly.</p>
                    </div>
                    <form action="javascript:" class="body-bg rounded p-20">
                        <label for="sent-mail" class="mb-2 text-dark">{{translate('Type Mail Address')}}
                            <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                title="{{translate('Type Mail Address')}}"
                            >info</i>
                        </label>
                        <div class="d-flex align-items-center gap-xl-3 gap-2">
                            <input type="email"class="form-control" id="test-email"  name="email" placeholder="{{translate('ex: abc@email.com')}}" required="" value="{{old('email')}}">
                            <div class="col-md-4 col-sm-5">
                                <button type="button" id="send-mail" class="btn h-40 btn--primary rounded">
                                    {{ translate('send_mail') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
     <!-- Modal -->
     <div class="modal fade" id="send__sms" tabindex="-1" aria-labelledby="send__smsLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-xl-4 p-3">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div>
                            <h4 class="mb-xl-2 mb-1">{{ translate('Send Test SMS') }}?</h4>
                            <p>{{ translate('Insert a valid phone number to get SMS') }}</p>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="pick-map mb-20 p-12 rounded d-flex flex-md-nowrap flex-wrap align-items-center gap-1 bg-primary bg-opacity-10">
                        <svg width="18" height="18" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_9464_2249)">
                            <path d="M9.79125 1.44318L10.5117 0.270677C10.6797 -0.00465646 11.039 -0.0898231 11.3138 0.0793436C11.5885 0.247927 11.6743 0.606677 11.5051 0.881427L10.7847 2.05393C10.675 2.23359 10.4831 2.33218 10.2871 2.33218C10.1827 2.33218 10.0777 2.30418 9.98259 2.24584C9.70784 2.07726 9.62209 1.71793 9.79125 1.44318ZM3.16575 2.05334C3.27542 2.23301 3.46792 2.33218 3.66392 2.33218C3.76775 2.33218 3.87275 2.30418 3.96784 2.24643C4.24259 2.07784 4.32892 1.71909 4.16034 1.44434L3.44109 0.27126C3.2725 -0.00348977 2.91317 -0.0892398 2.639 0.0787602C2.36425 0.247344 2.27792 0.606094 2.4465 0.880844L3.16575 2.05334ZM1.89059 3.34134L0.841754 2.83909C0.552421 2.69851 0.201838 2.82218 0.0641712 3.11326C-0.0752455 3.40376 0.0478378 3.75201 0.338338 3.89084L1.38717 4.39309C1.46825 4.43218 1.554 4.45084 1.63859 4.45084C1.85617 4.45084 2.065 4.32893 2.16475 4.11951C2.30417 3.82901 2.18109 3.48018 1.89059 3.34134ZM6.92067 2.33393C3.70417 2.38701 1.155 5.87301 2.9015 9.23068C3.16692 9.74051 3.56067 10.1675 3.98359 10.5566C4.144 10.7042 4.26825 10.8868 4.37442 11.0828H6.41667V8.05876C5.73942 7.81726 5.25 7.17559 5.25 6.41609C5.25 6.09351 5.51075 5.83276 5.83334 5.83276C6.15592 5.83276 6.41667 6.09351 6.41667 6.41609C6.41667 6.73868 6.678 6.99943 7 6.99943C7.322 6.99943 7.58334 6.73809 7.58334 6.41609C7.58334 6.09409 7.84409 5.83276 8.16667 5.83276C8.48925 5.83276 8.75 6.09351 8.75 6.41609C8.75 7.17559 8.26059 7.81726 7.58334 8.05876V11.0828H9.60634C9.73934 10.8547 9.91084 10.6394 10.1354 10.4522C10.5198 10.1313 10.8815 9.77376 11.1038 9.32518C12.117 7.27593 11.7151 5.09076 10.2719 3.67209C9.373 2.78776 8.18242 2.31468 6.92067 2.33393ZM4.662 12.4122C4.61534 13.2673 5.25584 14 6.11217 14H7.87442C8.68 14 9.33275 13.3473 9.33275 12.5417V12.25H4.65559C4.65559 12.3048 4.6655 12.3562 4.662 12.4122ZM13.9493 3.09168C13.8163 2.79826 13.4715 2.66584 13.1781 2.80001L12.0511 3.30868C11.7571 3.44109 11.6264 3.78643 11.7594 4.07984C11.8568 4.29568 12.0686 4.42343 12.2914 4.42343C12.3713 4.42343 12.453 4.40709 12.5306 4.37151L13.6576 3.86284C13.9516 3.73043 14.0823 3.38509 13.9493 3.09168Z" fill="#3C76F1"></path>
                            </g>
                            <defs>
                            <clipPath id="clip0_9464_2249">
                            <rect width="14" height="14" fill="white"></rect>
                            </clipPath>
                            </defs>
                        </svg>
                        <p class="fz-12">2Factor is configured for SMS. Please test to ensure you are receiving SMS messages correctly.</p>
                    </div>
                    <form action="javascript:" class="body-bg rounded p-20">
                        <label for="sent-mail" class="mb-2 text-dark">{{translate('Phone number')}}
                            <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                title="{{translate('Phone number')}}"
                            >info</i>
                        </label>
                        <div class="d-flex align-items-center gap-xl-3 gap-2">
                            <input type="email"class="form-control" id="test-email"  name="email" placeholder="{{translate('+880 Ex: abc@email.com')}}" required="" value="{{old('email')}}">
                            <div class="col-md-4 col-sm-5">
                                <button type="button" id="send-mail" class="btn h-40 btn--primary rounded">
                                    {{ translate('Send SMS') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="map__view" tabindex="-1" aria-labelledby="map__viewLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-xl-4 p-3">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div>
                            <h4>{{ translate('Map View') }}?</h4>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="view-map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d52858603.10913246!2d-161.47084896700602!3d36.039016616416845!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x54eab584e432360b%3A0x1c3bb99243deb742!2sUnited%20States!5e0!3m2!1sen!2sbd!4v1746511941597!5m2!1sen!2sbd" width="100%" height="280" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <!-- Modal -->
     <div class="modal fade" id="map__view__error" tabindex="-1" aria-labelledby="map__viewLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-xl-4 p-3">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div>
                            <h4>{{ translate('Map View') }}?</h4>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="view-map-error d-center py-5 px-3 body-bg rounded border">
                        <div class="boxes text-center">
                            <img src="{{asset('public/assets/admin-module')}}/img/map-error.png" alt="">                         
                            <h5 class="my-3 fz-16 text-dark">404 Error</h5>
                            <p class="fz-14">Map is not Found. Ensure the Map API Key (Client & Server) is entered correctly.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@php($currency = business_config('currency_code', 'business_information')->live_values)
    <div class="modal fade" id="payment-gateway-warning-modal">
        <div class="modal-dialog modal-dialog-centered status-warning-modal">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body pb-5 pt-0">
                    <div class="max-349 mx-auto mb-20">
                        <div>
                            <div class="text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="76" height="76" viewBox="0 0 76 76" fill="none">
                                    <path d="M38 0.5C17.3 0.5 0.5 17.3 0.5 38C0.5 58.7 17.3 75.5 38 75.5C58.7 75.5 75.5 58.7 75.5 38C75.5 17.3 58.7 0.5 38 0.5ZM38 60.5C35.25 60.5 33 58.25 33 55.5C33 52.75 35.25 50.5 38 50.5C40.75 50.5 43 52.75 43 55.5C43 58.25 40.75 60.5 38 60.5ZM43.725 21.725L42.05 41.775C41.875 43.875 40.125 45.5 38 45.5C35.875 45.5 34.125 43.875 33.95 41.775L32.275 21.725C32 18.375 34.625 15.5 38 15.5C41.2 15.5 43.75 18.1 43.75 21.25C43.75 21.4 43.75 21.575 43.725 21.725Z" fill="#FF6174"/>
                                </svg>
                                <h5 class="modal-title"></h5>
                            </div>
                            <div class="text-center" >
                                <h3 class="mb-4 mt-4"> {{ translate('Important Alert!')}}</h3><span class="d-none" id="gateway_name"></span>
                                <div class="mb-4 mt-4"> <p>{{ translate('You must activate at least one digital payment method that support your system currency (')}} {{ $currency }} {{ translate(').Otherwise customer won’t see the digital payment option & won’t be able to pay via digitally from website and apps. ') }}</h3></p></div>
                            </div>

                            <div class="text-center mb-4 mt-4" >
                                <a class="text-underline" href="{{ route('admin.business-settings.get-business-information') }}"> {{ translate('View_Currency_Settings.') }}</a>
                            </div>
                        </div>

                        <div class="btn--container justify-content-center">
                            <button data-bs-dismiss="modal" id="confirm-currency-change" type="button"  class="btn btn--primary min-w-120">{{translate('Turn Off')}}</button>
                            <button data-bs-dismiss="modal" class="btn btn-secondary min-w-120" >{{translate("Cancel")}}</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{asset('public/assets/admin-module')}}/plugins/swiper/swiper-bundle.min.js"></script>
    <script>
        "use strict";

        $(document).on('click', '.open-warning-modal', function(event) {
            const elements = document.querySelectorAll('.open-warning-modal');
            const count = elements.length;

            if(elements.length === 1){

                let gateway = $(this).data('gateway');
                if ($(this).val() == 0) {
                    event.preventDefault();
                    $('#payment-gateway-warning-modal').modal('show');
                    var formated_text=  gateway.split('_').map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(' ')
                    $('#gateway_name').attr('data-gateway_key', gateway).html(formated_text);
                    $(this).data('originalEvent', event);
                }
            }
        });

        $(document).on('click', '#confirm-currency-change', function() {
            var gatewayName =   $('#gateway_name').data('gateway_key');
            if (gatewayName) {
                $('#span_on_' + gatewayName).removeClass('checked');
            }

            var originalEvent = $('.open-warning-modal[data-gateway="' + gatewayName + '"]').data('originalEvent');
            if (originalEvent) {
                var newEvent = $.Event(originalEvent);
                $(originalEvent.target).trigger(newEvent);
            }

            $('#payment-gateway-warning-modal').modal('hide');
        });


        $('#submit-storage-data').on('click', function () {
            let isValid = true;
            $('#update-storage-form input').each(function() {
                let value = $(this).val();
                let fieldName = $(this).attr('name');
                if (value == '' || value == null || value.trim() === '' || /\s/.test(value)) {
                    isValid = false;
                    let errorMessage = "{{ translate('The ') }}" + fieldName;
                    if (value == '' || value == null || value.trim() === '') {
                        errorMessage += "{{ translate(' field is required') }}";
                    } else {
                        errorMessage += "{{ translate(' field cannot contain any kind of space') }}";
                    }
                    toastr.error(errorMessage);
                }
            });

            if (isValid) {
                $('#update-storage-form').submit();
            } else {
                $("#confirmation").modal("hide");
            }
        });

        $(document).ready(function ($) {
            $("#local_system").on('change', function () {
                const local = $(this).is(':checked') === true ? 1 : 0;

                if (local === 1) {
                    $("#3rd_party_storage").prop('checked', false);
                }
            });

            $("#3rd_party_storage").on('change', function () {
                const thirdParty = $(this).is(':checked') === true ? 1 : 0;

                if (thirdParty === 1) {
                    $("#local_system").prop('checked', false);
                }
            });
        });

        $('.change-storage-connection-type').on('click', function () {
            let name = $(this).data('name');
            let status = $(this).is(':checked') === true ? 1 : 0;

            Swal.fire({
                title: "{{translate('are_you_sure')}}?",
                text: '{{translate('You cannot activate both storage connection statuses at the same time. You must activate at least one status')}}',
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
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{route('admin.configuration.change-storage-connection-type')}}",
                        data: {
                            name: name,
                            status: status,
                        },
                        type: 'put',
                        success: function (response) {
                            toastr.success('{{translate('successfully_updated')}}')
                        },
                        error: function (error) {
                            toastr.error(error.responseJSON.message)
                        }
                    });
                }
            })
        });

        $('#google-map').on('submit', function (event) {
            event.preventDefault();
            let formData = new FormData(document.getElementById("google-map-update-form"));

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('admin.configuration.set-third-party-config')}}",
                data: formData,
                processData: false,
                contentType: false,
                type: 'post',
                success: function (response) {
                    console.log(response)
                    toastr.success('{{translate('successfully_updated')}}')
                },
                error: function () {

                }
            });
        });

        $('#firebase-form').on('submit', function (event) {
            event.preventDefault();

            let formData = new FormData(document.getElementById("firebase-form"));

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{route('admin.configuration.set-third-party-config')}}",
                data: formData,
                processData: false,
                contentType: false,
                type: 'post',
                success: function (response) {
                    console.log(response)
                    toastr.success('{{translate('successfully_updated')}}')
                },
                error: function () {

                }
            });
        });

        $('#recaptcha-form').on('submit', function (event) {
            event.preventDefault();

            let formData = new FormData(document.getElementById("recaptcha-form"));

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{route('admin.configuration.set-third-party-config')}}",
                data: formData,
                processData: false,
                contentType: false,
                type: 'post',
                success: function (response) {
                    console.log(response)
                    toastr.success('{{translate('successfully_updated')}}')
                },
                error: function () {

                }
            });
        });

        $('#apple-login-form').on('submit', function (event) {
            event.preventDefault();

            let formData = new FormData(document.getElementById("apple-login-form"));

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('admin.configuration.set-third-party-config')}}",
                data: formData,
                processData: false,
                contentType: false,
                type: 'post',
                success: function (response) {
                    console.log(response)
                    toastr.success('{{translate('successfully_updated')}}')
                },
                error: function () {

                }
            });
        });
        $('#firebase-otp-verification-form').on('submit', function (event) {
            event.preventDefault();

            let formData = new FormData(document.getElementById("firebase-otp-verification-form"));

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('admin.configuration.set-third-party-config')}}",
                data: formData,
                processData: false,
                contentType: false,
                type: 'post',
                success: function (response) {
                    console.log(response)
                    toastr.success('{{translate('successfully_updated')}}')
                },
                error: function () {

                }
            });
        });

        $('#config-form').on('submit', function (event) {
            event.preventDefault();
            if ('{{env('APP_ENV')=='demo'}}') {
                demo_mode()
            } else {
                let formData = new FormData(document.getElementById("config-form"));

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{route('admin.configuration.set-email-config')}}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    type: 'post',
                    success: function (response) {
                        console.log(response)
                        if (response.response_code === 'default_400') {
                            toastr.error('{{translate('all_fields_are_required')}}')
                        } else {
                            toastr.success('{{translate('successfully_updated')}}')
                        }
                    },
                    error: function () {

                    }
                });
            }
        });

        let swiper = new Swiper(".modalSwiper", {
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
                dynamicBullets: true,
                autoHeight: true,
            },
        });
    </script>

    <script>
        "use strict";

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

        $(document).ready(function () {
            $('input[name="firebase_content_type"]').change(function () {
                if ($(this).val() === 'file') {
                    $('.file-upload-div').show();

                    $('textarea[name="service_file_content"]').prop('readonly', true);
                } else if ($(this).val() === 'file_content') {
                    $('.file-upload-div').hide();
                    $('textarea[name="service_file_content"]').prop('readonly', false);
                }
            });
        });

        $(document).ready(function () {
            $('.email-config-status').on('click', function () {
                let status = $(this).is(':checked') === true ? 1 : 0;

                Swal.fire({
                    title: "{{translate('are_you_sure')}}?",
                    text: '{{translate('want_to_update_email_status')}}?',
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
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: "{{route('admin.configuration.email-status-update')}}",
                            data: {
                                value: status
                            },
                            type: 'put',
                            success: function (response) {
                                toastr.success('{{translate('successfully_updated')}}')
                            },
                            error: function () {

                            }
                        });
                    } else {
                        if (status == 1) $(`#email-config-status`).prop('checked', false);
                        if (status == 0) $(`#email-config-status`).prop('checked', true);
                        Swal.fire('{{translate('Changes are not saved')}}', '', 'info')
                    }
                })
            });
        });

    </script>

    <script>
         $(".view-btn").on("click", function () {
                var container = $(this).closest(".view-details-container");
                var details = container.find(".view-details");
                var icon = $(this).find("i");
            
                $(this).toggleClass("active");
                details.slideToggle(300);
                icon.toggleClass("rotate-180deg");
            });


            $(".section-toggle").on("change", function () {
                if ($(this).is(':checked')) {
                    $(this).closest(".view-details-container").find(".view-details").slideDown(300);
                } else {
                    $(this).closest(".view-details-container").find(".view-details").slideUp(300);
                }
            });
    </script>

    <script>
        $(window).on('load', function () {
            $('.remove-wrap').show(); // Show on window load
        });

        $(document).ready(function () {
            $('.remove-btn').on('click', function () {
            $('.remove-wrap').remove(); // Remove the element
            });
        });
    </script>
    
@endpush
