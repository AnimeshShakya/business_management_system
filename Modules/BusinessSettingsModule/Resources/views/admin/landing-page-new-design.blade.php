@extends('adminmodule::layouts.new-master')

@section('title',translate('landing_page_setup'))

@push('css_or_js')
    <link rel="stylesheet" href="{{asset('public/assets/admin-module')}}/plugins/select2/select2.min.css"/>
    <link rel="stylesheet" href="{{asset('public/assets/admin-module')}}/plugins/dataTables/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="{{asset('public/assets/admin-module')}}/plugins/dataTables/select.dataTables.min.css"/>
@endpush

@section('content')

    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-wrap mb-3">
                        <h2 class="page-title">{{translate('Admin Landing Page')}}</h2>
                    </div>

                    <div class="mb-3 nav-tabs-responsive position-relative">
                        <ul class="nav nav--tabs scrollbar-w flex-nowrap white-nowrap overflow-x-auto flex-wrap-nowrap nav--tabs__style2">
                            <li class="nav-item">
                                <a href="#" class="nav-link active" id="cus-tab1" data-bs-toggle="tab" data-bs-target="#custom-tabs1" type="button" role="tab" aria-controls="custom-tabs1" aria-selected="false">
                                    {{translate('Hero Section')}}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" id="cus-tab2" data-bs-toggle="tab" data-bs-target="#custom-tabs2" type="button" role="tab" aria-controls="custom-tabs2" aria-selected="false">
                                    {{translate('Service')}}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" id="cus-tab3" data-bs-toggle="tab" data-bs-target="#custom-tabs3" type="button" role="tab" aria-controls="custom-tabs3" aria-selected="false">
                                    {{translate('About Us')}}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" id="cus-tab4" data-bs-toggle="tab" data-bs-target="#custom-tabs4" type="button" role="tab" aria-controls="custom-tabs4" aria-selected="false">
                                    {{translate('Specialty')}}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" id="cus-tab5" data-bs-toggle="tab" data-bs-target="#custom-tabs5" type="button" role="tab" aria-controls="custom-tabs5" aria-selected="false">
                                    {{translate('Features')}}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" id="cus-tab6" data-bs-toggle="tab" data-bs-target="#custom-tabs6" type="button" role="tab" aria-controls="custom-tabs6" aria-selected="false">
                                    {{translate('Registration')}}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" id="cus-tab7" data-bs-toggle="tab" data-bs-target="#custom-tabs7" type="button" role="tab" aria-controls="custom-tabs7" aria-selected="false">
                                    {{translate('Testimonials')}}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" id="cus-tab8" data-bs-toggle="tab" data-bs-target="#custom-tabs8" type="button" role="tab" aria-controls="custom-tabs8" aria-selected="false">
                                    {{translate('Button & Links')}}
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
                        <!-- Hero Section -->
                        <div class="tab-pane fade show active" id="custom-tabs1" role="tabpanel" aria-labelledby="cus-tab1" tabindex="0">
                            <div class="card p-20 mb-20">
                                <div class="d-flex align-items-center justify-content-between flex-sm-nowrap flex-wrap gap-2">
                                    <div>
                                        <h3 class="page-title mb-2">{{translate('Hero Section')}}</h3>
                                        <p>{{translate('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet ')}}</p>
                                    </div>
                                    <button type="button" class="rounded transition text-nowrap fz-12 fw-semibold btn-primary__outline btn d-flex align-items-center gap-1 py-2 px-3" data-bs-toggle="offcanvas" data-bs-target="#admin-landing-page">
                                        <span class="material-symbols-outlined">visibility</span> Section Preview
                                    </button>
                                </div>
                            </div>
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
                                <p class="fz-12">It looks like your server might not have the necessary permissions to automatically set up the cron job. Please ensure that your server has shell/bash access enabled, as it’s required for automated cron job configuration.</p>
                            </div>
                            <div class="card mb-20">
                                <div class="card-body p-20">
                                    <div class="mb-20">
                                        <h3 class="page-title mb-2">{{translate('Hero Section Content')}}</h3>
                                        <p>{{translate('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet')}}</p>
                                    </div>
                                    <form action="javascript:void(0)" method="POST" id="landing-info-update-form">
                                        <div class="body-bg rounded p-20 discount-type lang-form default-form mb-20">
                                            <ul class="nav nav--tabs border-color-primary mb-4">
                                                <li class="nav-item">
                                                    <a class="nav-link lang_link active" href="#" id="">{{translate('Default(EN)')}}</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link lang_link" href="#0" id="">{{translate('English(EN)')}}</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link lang_link" href="#0" id="">{{translate('Arabic(AR)')}}</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link lang_link" href="#0" id="">{{translate('Spanish(ES)')}}</a>
                                                </li>
                                            </ul>
                                            <div class="row g-lg-3 g-3">
                                                <div class="col-md-12">
                                                    <div class="mb-2 text-dark">{{translate('Title (EN)')}}
                                                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                            data-bs-placement="top"
                                                            title="{{translate('Customer satisfaction is our main motto')}}"
                                                        >info</i>
                                                    </div>
                                                    <textarea class="form-control block-size-initial" name="copyright_text" rows="1" placeholder="Customer satisfaction is our main motto" data-maxlength="50"></textarea>
                                                    <div class="d-flex justify-content-end mt-1">
                                                        <span class="text-light-gray letter-count fz-12">20/50</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="mb-2 text-dark">{{translate('Sub Title (EN)')}}
                                                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                            data-bs-placement="top"
                                                            title="{{translate('Largest Booking Service Platform')}}"
                                                        >info</i>
                                                    </div>
                                                    <textarea class="form-control block-size-initial" name="copyright_text" rows="1" placeholder="Largest Booking Service Platform" data-maxlength="100"></textarea>
                                                    <div class="d-flex justify-content-end mt-1">
                                                        <span class="text-light-gray letter-count fz-12">0/100</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="mb-2 text-dark">{{translate('Tagline (EN)')}}
                                                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                            data-bs-placement="top"
                                                            title="{{translate('Trusted By Customers & Providers')}}"
                                                        >info</i>
                                                    </div>
                                                    <textarea class="form-control block-size-initial" name="copyright_text" rows="1" placeholder="Trusted By Customers & Providers" data-maxlength="100"></textarea>
                                                    <div class="d-flex justify-content-end mt-1">
                                                        <span class="text-light-gray letter-count fz-12">0/100</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @can('landing_update')
                                            <div class="d-flex gap-2 justify-content-end">
                                                <button type="reset" class="btn btn--secondary rounded">
                                                    {{translate('reset')}}
                                                </button>
                                                <button type="submit" class="btn btn--primary rounded">
                                                    {{translate('Save')}}
                                                </button>
                                            </div>
                                        @endcan
                                    </form>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body p-20">
                                    <div class="mb-20">
                                        <h3 class="page-title mb-2">{{translate('Hero Section Image')}}</h3>
                                        <p>{{translate('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet ')}}</p>
                                    </div>
                                    <div class="body-bg rounded p-20 mb-20">
                                        <div class="row g-lg-4 g-3">
                                            <div class="col-md-6">
                                                <div class="card2 rounded-2 text-center h-100 p-20 mb-15 bg-white">
                                                    <h5 class="fz-16 mb-1">Image 1</h5>
                                                    <p class="fz-12">Upload your Image</p>
                                                    <div class="custom-upload-wrapper upload-group border-dashed rounded-2 mx-auto hero-sec-image1 hero-sec-image1 ratio-2-1">
                                                        <input type="file" id="imageUpload" accept="image/*" required>
                                                        <label for="imageUpload" class="upload-box rounded position-relative d-flex align-items-center justify-content-center text-center overflow-hidden bg-white">
                                                            <div class="upload-content">
                                                                <span class="material-symbols-outlined placeholder-icon mb-1 text-primary">photo_camera</span>
                                                                    <span class="fz-10 d-block">Add image</span>
                                                            </div>
                                                            <img class="image-preview" src="" alt="Preview" />
                                                            <div class="upload-overlay">
                                                                <span class="material-symbols-outlined">photo_camera</span>
                                                            </div>
                                                        </label>
                                                    </div>
                                                    <p class="fz-12 mt-2 text-center">JPG, JPEG, PNG, Gif Image size : Max 5 MB <span class="fw-medium text-dark">(370x200px)</span></p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="card2 rounded-2 text-center h-100 p-20 mb-15 bg-white">
                                                    <h5 class="fz-16 mb-1">Image 2</h5>
                                                    <p class="fz-12">Upload your Image</p>
                                                    <div class="custom-upload-wrapper upload-group border-dashed rounded-2 mx-auto hero-sec-image2 h-100px">
                                                        <input type="file" id="imageUpload2" accept="image/*" required>
                                                        <label for="imageUpload2" class="upload-box rounded position-relative d-flex align-items-center justify-content-center text-center overflow-hidden bg-white">
                                                            <div class="upload-content">
                                                                <span class="material-symbols-outlined placeholder-icon mb-1 text-primary">photo_camera</span>
                                                                    <span class="fz-10 d-block">Add image</span>
                                                            </div>
                                                            <img class="image-preview" src="" alt="Preview" />
                                                            <div class="upload-overlay">
                                                                <span class="material-symbols-outlined">photo_camera</span>
                                                            </div>
                                                        </label>
                                                    </div>
                                                    <p class="fz-12 mt-2 text-center">JPG, JPEG, PNG, Gif Image size : Max 5 MB <span class="fw-medium text-dark">(315x200px)</span></p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="card2 rounded-2 text-center h-100 p-20 mb-15 bg-white">
                                                    <h5 class="fz-16 mb-1">Image 3</h5>
                                                    <p class="fz-12">Upload your Image</p>
                                                    <div class="custom-upload-wrapper upload-group border-dashed rounded-2 mx-auto hero-sec-image3 w-100px ratio-1">
                                                        <input type="file" id="imageUpload3" accept="image/*" required>
                                                        <label for="imageUpload3" class="upload-box rounded position-relative d-flex align-items-center justify-content-center text-center overflow-hidden bg-white">
                                                            <div class="upload-content">
                                                                <span class="material-symbols-outlined placeholder-icon mb-1 text-primary">photo_camera</span>
                                                                    <span class="fz-10 d-block">Add image</span>
                                                            </div>
                                                            <img class="image-preview" src="" alt="Preview" />
                                                        </label>
                                                    </div>
                                                    <p class="fz-12 mt-2 text-center">JPG, JPEG, PNG, Gif Image size : Max 5 MB <span class="fw-medium text-dark">(200x200px)</span></p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="card2 rounded-2 text-center h-100 p-20 mb-15 bg-white">
                                                    <h5 class="fz-16 mb-1">Image 4</h5>
                                                    <p class="fz-12">Upload your Image</p>
                                                    <div class="custom-upload-wrapper upload-group border-dashed rounded-2 mx-auto hero-sec-image4 ratio-2-1">
                                                        <input type="file" id="imageUpload4" accept="image/*" required>
                                                        <label for="imageUpload4" class="upload-box rounded position-relative d-flex align-items-center justify-content-center text-center overflow-hidden bg-white">
                                                            <div class="upload-content">
                                                                <span class="material-symbols-outlined placeholder-icon mb-1 text-primary">photo_camera</span>
                                                                    <span class="fz-10 d-block">Add image</span>
                                                            </div>
                                                            <img class="image-preview" src="" alt="Preview" />
                                                            <div class="upload-overlay">
                                                                <span class="material-symbols-outlined">photo_camera</span>
                                                            </div>
                                                        </label>
                                                    </div>
                                                    <p class="fz-12 mt-2 text-center">JPG, JPEG, PNG, Gif Image size : Max 5 MB <span class="fw-medium text-dark">(370x200px)</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex gap-2 justify-content-end">
                                        <button type="reset" class="btn btn--secondary rounded">
                                            {{translate('reset')}}
                                        </button>
                                        <button type="submit" class="btn btn--primary rounded">
                                            {{translate('Save')}}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Services Section -->
                        <div class="tab-pane fade" id="custom-tabs2" role="tabpanel" aria-labelledby="cus-tab2" tabindex="0">
                            <div class="card p-20 mb-20">
                                <div class="d-flex align-items-center justify-content-between flex-sm-nowrap flex-wrap gap-2">
                                    <div>
                                        <h3 class="page-title mb-2">{{translate('Service Section')}}</h3>
                                        <p>{{translate('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet')}}</p>
                                    </div>
                                    <button type="button" class="rounded transition text-nowrap fz-12 fw-semibold btn-primary__outline btn d-flex align-items-center gap-1 py-2 px-3" data-bs-toggle="offcanvas" data-bs-target="#service-landing-page">
                                        <span class="material-symbols-outlined">visibility</span> Section Preview
                                    </button>
                                </div>
                            </div>
                            <div class="card mb-20">
                                <div class="card-body p-20">
                                    <div class="mb-20">
                                        <h3 class="page-title mb-2">{{translate('Service Section Content')}}</h3>
                                        <p>{{translate('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet ')}}</p>
                                    </div>
                                    <form action="javascript:void(0)" method="POST" id="landing-info-update-form">
                                        <div class="body-bg rounded p-20 discount-type lang-form default-form mb-20">
                                            <ul class="nav nav--tabs border-color-primary mb-4">
                                                <li class="nav-item">
                                                    <a class="nav-link lang_link active" href="#" id="">{{translate('Default(EN)')}}</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link lang_link" href="#0" id="">{{translate('English(EN)')}}</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link lang_link" href="#0" id="">{{translate('Arabic(AR)')}}</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link lang_link" href="#0" id="">{{translate('Spanish(ES)')}}</a>
                                                </li>
                                            </ul>
                                            <div class="row g-lg-3 g-3">
                                                <div class="col-md-12">
                                                    <div class="mb-2 text-dark">{{translate('Title (EN)')}}
                                                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                            data-bs-placement="top"
                                                            title="{{translate('Service We Provide You')}}"
                                                        >info</i>
                                                    </div>
                                                    <textarea class="form-control block-size-initial" name="copyright_text" rows="1" placeholder="Service We Provide You" data-maxlength="50"></textarea>
                                                    <div class="d-flex justify-content-end mt-1">
                                                        <span class="text-light-gray letter-count fz-12">20/50</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="mb-2 text-dark">{{translate('Sub Title (EN)')}}
                                                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                            data-bs-placement="top"
                                                            title="{{translate('Largest Booking Service Platform')}}"
                                                        >info</i>
                                                    </div>
                                                    <textarea class="form-control block-size-initial" name="copyright_text" rows="2" placeholder="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet Lorem ipsum " data-maxlength="160"></textarea>
                                                    <div class="d-flex justify-content-end mt-1">
                                                        <span class="text-light-gray letter-count fz-12">80/160</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @can('landing_update')
                                            <div class="d-flex gap-2 justify-content-end">
                                                <button type="reset" class="btn btn--secondary rounded">
                                                    {{translate('reset')}}
                                                </button>
                                                <button type="submit" class="btn btn--primary rounded">
                                                    {{translate('Save')}}
                                                </button>
                                            </div>
                                        @endcan
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- About Section -->
                        <div class="tab-pane fade" id="custom-tabs3" role="tabpanel" aria-labelledby="cus-tab3" tabindex="0">
                            <div class="card p-20 mb-20">
                                <div class="d-flex align-items-center justify-content-between flex-sm-nowrap flex-wrap gap-2">
                                    <div>
                                        <h3 class="page-title mb-2">{{translate('About Us Section')}}</h3>
                                        <p>{{translate('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet')}}</p>
                                    </div>
                                    <button type="button" class="rounded transition text-nowrap fz-12 fw-semibold btn-primary__outline btn d-flex align-items-center gap-1 py-2 px-3" data-bs-toggle="offcanvas" data-bs-target="#about-landing-page">
                                        <span class="material-symbols-outlined">visibility</span> Section Preview
                                    </button>
                                </div>
                            </div>
                            <div class="card mb-20">
                                <div class="card-body p-20">
                                    <div class="mb-20">
                                        <h3 class="page-title mb-2">{{translate('About Us')}}</h3>
                                        <p>{{translate('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet ')}}</p>
                                    </div>
                                    <form action="javascript:void(0)" method="POST" id="landing-info-update-form">
                                        <div class="row g-xl-4 g-3 mb-20">
                                            <div class="col-lg-8">
                                                <div class="body-bg rounded p-20 discount-type lang-form default-form">
                                                    <ul class="nav nav--tabs border-color-primary mb-4">
                                                        <li class="nav-item">
                                                            <a class="nav-link lang_link active" href="#" id="">{{translate('Default(EN)')}}</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link lang_link" href="#0" id="">{{translate('English(EN)')}}</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link lang_link" href="#0" id="">{{translate('Arabic(AR)')}}</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link lang_link" href="#0" id="">{{translate('Spanish(ES)')}}</a>
                                                        </li>
                                                    </ul>
                                                    <div class="row g-lg-3 g-3">
                                                        <div class="col-md-12">
                                                            <div class="mb-2 text-dark">{{translate('Title (EN)')}}
                                                                <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    title="{{translate('Service We Provide You')}}"
                                                                >info</i>
                                                            </div>
                                                            <textarea class="form-control block-size-initial" name="copyright_text" rows="1" placeholder="Beauty & Salon" data-maxlength="100"></textarea>
                                                            <div class="d-flex justify-content-end mt-1">
                                                                <span class="text-light-gray letter-count fz-12">30/100</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="mb-2 text-dark">{{translate('Description (EN)')}}
                                                                <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    title="{{translate('Largest Booking Service Platform')}}"
                                                                >info</i>
                                                            </div>
                                                            <textarea class="form-control block-size-initial" name="copyright_text" rows="2" placeholder="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet Lorem ipsum " data-maxlength="160"></textarea>
                                                            <div class="d-flex justify-content-end mt-1">
                                                                <span class="text-light-gray letter-count fz-12">80/160</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="body-bg d-center rounded-2 text-center h-100 p-20">
                                                    <div class="boxes">
                                                        <h5 class="fz-16 mb-1">Upload About Us Image</h5>
                                                        <p class="fz-12">Upload your About Us Image</p>
                                                        <div class="custom-upload-wrapper upload-group border-dashed rounded-2 mx-auto hero-sec-image4 ratio-2-1">
                                                            <input type="file" id="imageUpload5" accept="image/*" required>
                                                            <label for="imageUpload5" class="upload-box rounded position-relative d-flex align-items-center justify-content-center text-center overflow-hidden bg-white">
                                                                <div class="upload-content">
                                                                    <span class="material-symbols-outlined placeholder-icon mb-1 text-primary">photo_camera</span>
                                                                        <span class="fz-10 d-block">Add image</span>
                                                                </div>
                                                                <img class="image-preview" src="" alt="Preview" />
                                                                <div class="upload-overlay">
                                                                    <span class="material-symbols-outlined">photo_camera</span>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <p class="fz-12 mt-2 text-center">JPG, JPEG, PNG, Gif Image size : Max 5 MB <span class="fw-medium text-dark">(684x400px)</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @can('landing_update')
                                            <div class="d-flex gap-2 justify-content-end">
                                                <button type="reset" class="btn btn--secondary rounded">
                                                    {{translate('reset')}}
                                                </button>
                                                <button type="submit" class="btn btn--primary rounded">
                                                    {{translate('Save')}}
                                                </button>
                                            </div>
                                        @endcan
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Specialty Section -->
                        <div class="tab-pane fade" id="custom-tabs4" role="tabpanel" aria-labelledby="cus-tab4" tabindex="0">
                            <div class="card p-20 mb-20">
                                <div class="d-flex align-items-center justify-content-between flex-sm-nowrap flex-wrap gap-2">
                                    <div>
                                        <h3 class="page-title mb-2">{{translate('Specialty Section')}}</h3>
                                        <p>{{translate('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet')}}</p>
                                    </div>
                                    <button type="button" class="rounded transition text-nowrap fz-12 fw-semibold btn-primary__outline btn d-flex align-items-center gap-1 py-2 px-3" data-bs-toggle="offcanvas" data-bs-target="#speciality-landing-page">
                                        <span class="material-symbols-outlined">visibility</span> Section Preview
                                    </button>
                                </div>
                            </div>
                            <div class="card mb-20">
                                <div class="border-bottom p-20">
                                    <h3 class="page-title mb-2">{{translate('Add Specialty')}}</h3>
                                    <p>{{translate('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet ')}}</p>
                                </div>
                                <div class="card-body p-20">
                                    <div class="cus-shadow rounded-2 p-20 mb-20">
                                        <form action="javascript:void(0)" method="POST" id="landing-info-update-form">
                                            <div class="row g-xl-4 g-3 mb-20">
                                                <div class="col-lg-8">
                                                    <div class="body-bg rounded p-20 discount-type lang-form default-form">
                                                        <ul class="nav nav--tabs border-color-primary mb-4">
                                                            <li class="nav-item">
                                                                <a class="nav-link lang_link active" href="#" id="">{{translate('Default(EN)')}}</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link lang_link" href="#0" id="">{{translate('English(EN)')}}</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link lang_link" href="#0" id="">{{translate('Arabic(AR)')}}</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link lang_link" href="#0" id="">{{translate('Spanish(ES)')}}</a>
                                                            </li>
                                                        </ul>
                                                        <div class="row g-lg-3 g-3">
                                                            <div class="col-md-12">
                                                                <div class="mb-2 text-dark">{{translate('Title (EN)')}}
                                                                    <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                                        data-bs-placement="top"
                                                                        title="{{translate('Service We Provide You')}}"
                                                                    >info</i>
                                                                </div>
                                                                <textarea class="form-control block-size-initial" name="copyright_text" rows="1" placeholder="46,465+" data-maxlength="50"></textarea>
                                                                <div class="d-flex justify-content-end mt-1">
                                                                    <span class="text-light-gray letter-count fz-12">20/50</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="mb-2 text-dark">{{translate('Sub Title (EN)')}}
                                                                    <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                                        data-bs-placement="top"
                                                                        title="{{translate('Largest Booking Service Platform')}}"
                                                                    >info</i>
                                                                </div>
                                                                <textarea class="form-control block-size-initial" name="copyright_text" rows="1" placeholder="Happy Clients" data-maxlength="50"></textarea>
                                                                <div class="d-flex justify-content-end mt-1">
                                                                    <span class="text-light-gray letter-count fz-12">30/50</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="body-bg d-center rounded-2 text-center h-100 p-20">
                                                        <div class="boxes">
                                                            <h5 class="fz-16 mb-1">Upload Specialty Image</h5>
                                                            <p class="fz-12">Upload your Specialty Image</p>
                                                            <div class="custom-upload-wrapper upload-group border-dashed rounded-2 mx-auto w-100px h-100px">
                                                                <input type="file" id="imageUpload6" accept="image/*" required>
                                                                <label for="imageUpload6" class="upload-box rounded position-relative d-flex align-items-center justify-content-center text-center overflow-hidden bg-white">
                                                                    <div class="upload-content">
                                                                        <span class="material-symbols-outlined placeholder-icon mb-1 text-primary">photo_camera</span>
                                                                            <span class="fz-10 d-block">Add image</span>
                                                                    </div>
                                                                    <img class="image-preview" src="" alt="Preview" />
                                                                    <div class="upload-overlay">
                                                                        <span class="material-symbols-outlined">photo_camera</span>
                                                                    </div>
                                                                </label>
                                                            </div>
                                                            <p class="fz-12 mt-2 text-center">JPG, JPEG, PNG, Gif Image size : Max 5 MB <span class="fw-medium text-dark">(684x400px)</span></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            @can('landing_update')
                                                <div class="d-flex gap-2 justify-content-end">
                                                    <button type="reset" class="btn btn--secondary rounded">
                                                        {{translate('reset')}}
                                                    </button>
                                                    <button type="submit" class="btn btn--primary rounded">
                                                        {{translate('Save')}}
                                                    </button>
                                                </div>
                                            @endcan
                                        </form>
                                    </div>
                                    <div class="cus-shadow2 rounded-2 p-20">
                                        <div class="data-table-top d-flex align-items-center flex-wrap gap-10 justify-content-between">
                                            <h4>Specialty  List</h4>
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
                                        <div class="table-responsive table-custom-responsive">
                                            <table id="example" class="table align-middle">
                                                <thead class="text-nowrap">
                                                    <tr>
                                                        <th class="text-dark fw-medium bg-light">{{translate('Sl')}}</th>
                                                        <th class="text-dark fw-medium bg-light">{{translate('Image')}}</th>
                                                        <th class="text-dark fw-medium bg-light">{{translate('Title')}}</th>
                                                        <th class="text-dark fw-medium bg-light">{{translate('Sub Title')}}</th>
                                                        <th class="text-dark fw-medium bg-light">{{translate('status')}}</th>
                                                        <th class="text-dark fw-medium bg-light">{{translate('action')}}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>
                                                            <img src="{{asset('public/assets/admin-module')}}/img/specialty-thumb1.png" alt="" class="table-cover-img">
                                                        </td>
                                                        <td><span class="text-dark">46,465+</span></td>
                                                        <td><span class="text-dark">Happy Clients</span></td>
                                                        <td>
                                                            <label class="switcher">
                                                                <input class="switcher_input" type="checkbox" checked="">
                                                                <span class="switcher_control"></span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex gap-2">
                                                                <a href="#" class="action-btn btn--light-primary" data-bs-toggle="offcanvas" data-bs-target="#speciality-landing-edit">
                                                                    <span class="material-icons">edit</span>
                                                                </a>
                                                                <button type="button" class="action-btn btn--danger delete_section">
                                                                    <span class="material-icons">delete</span>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>
                                                            <img src="{{asset('public/assets/admin-module')}}/img/specialty-thumb2.png" alt="" class="table-cover-img">
                                                        </td>
                                                        <td><span class="text-dark">46,465+</span></td>
                                                        <td><span class="text-dark">Customer Support</span></td>
                                                        <td>
                                                            <label class="switcher">
                                                                <input class="switcher_input" type="checkbox" checked="">
                                                                <span class="switcher_control"></span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex gap-2">
                                                                <a href="#" class="action-btn btn--light-primary" data-bs-toggle="offcanvas" data-bs-target="#speciality-landing-edit">
                                                                    <span class="material-icons">edit</span>
                                                                </a>
                                                                <button type="button" class="action-btn btn--danger delete_section">
                                                                    <span class="material-icons">delete</span>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>
                                                            <img src="{{asset('public/assets/admin-module')}}/img/specialty-thumb3.png" alt="" class="table-cover-img">
                                                        </td>
                                                        <td><span class="text-dark">46,465+</span></td>
                                                        <td><span class="text-dark">Happy Clients</span></td>
                                                        <td>
                                                            <label class="switcher">
                                                                <input class="switcher_input" type="checkbox" checked="">
                                                                <span class="switcher_control"></span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex gap-2">
                                                                <a href="#" class="action-btn btn--light-primary" data-bs-toggle="offcanvas" data-bs-target="#speciality-landing-edit">
                                                                    <span class="material-icons">edit</span>
                                                                </a>
                                                                <button type="button" class="action-btn btn--danger delete_section">
                                                                    <span class="material-icons">delete</span>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>4</td>
                                                        <td>
                                                            <img src="{{asset('public/assets/admin-module')}}/img/specialty-thumb4.png" alt="" class="table-cover-img">
                                                        </td>
                                                        <td><span class="text-dark">46,465+</span></td>
                                                        <td><span class="text-dark">Happy Clients</span></td>
                                                        <td>
                                                            <label class="switcher">
                                                                <input class="switcher_input" type="checkbox" checked="">
                                                                <span class="switcher_control"></span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex gap-2">
                                                                <a href="#" class="action-btn btn--light-primary" data-bs-toggle="offcanvas" data-bs-target="#speciality-landing-edit">
                                                                    <span class="material-icons">edit</span>
                                                                </a>
                                                                <button type="button" class="action-btn btn--danger delete_section">
                                                                    <span class="material-icons">delete</span>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Features Section -->
                        <div class="tab-pane fade" id="custom-tabs5" role="tabpanel" aria-labelledby="cus-tab5" tabindex="0">
                            <div class="card p-20 mb-20">
                                <div class="d-flex align-items-center justify-content-between flex-sm-nowrap flex-wrap gap-2">
                                    <div>
                                        <h3 class="page-title mb-2">{{translate('Features Section')}}</h3>
                                        <p>{{translate('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet')}}</p>
                                    </div>
                                    <button type="button" class="rounded transition text-nowrap fz-12 fw-semibold btn-primary__outline btn d-flex align-items-center gap-1 py-2 px-3" data-bs-toggle="offcanvas" data-bs-target="#feature-landing-page">
                                        <span class="material-symbols-outlined">visibility</span> Section Preview
                                    </button>
                                </div>
                            </div>
                            <div class="card mb-20">
                                <div class="border-bottom p-20">
                                    <h3 class="page-title mb-2">{{translate('Add Features')}}</h3>
                                    <p>{{translate('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet ')}}</p>
                                </div>
                                <div class="card-body p-20">
                                    <div class="cus-shadow rounded-2 p-20 mb-20">
                                        <form action="javascript:void(0)" method="POST" id="landing-info-update-form">
                                            <div class="body-bg rounded p-20 discount-type lang-form default-form mb-20">
                                                <ul class="nav nav--tabs border-color-primary mb-4">
                                                    <li class="nav-item">
                                                        <a class="nav-link lang_link active" href="#" id="">{{translate('Default(EN)')}}</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link lang_link" href="#0" id="">{{translate('English(EN)')}}</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link lang_link" href="#0" id="">{{translate('Arabic(AR)')}}</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link lang_link" href="#0" id="">{{translate('Spanish(ES)')}}</a>
                                                    </li>
                                                </ul>
                                                <div class="row g-lg-3 g-3">
                                                    <div class="col-md-12">
                                                        <div class="mb-2 text-dark">{{translate('Title (EN)')}}
                                                            <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                                data-bs-placement="top"
                                                                title="{{translate('Service We Provide You')}}"
                                                            >info</i>
                                                        </div>
                                                        <textarea class="form-control block-size-initial" name="copyright_text" rows="1" placeholder="Get Your Service any timeget" data-maxlength="50"></textarea>
                                                        <div class="d-flex justify-content-end mt-1">
                                                            <span class="text-light-gray letter-count fz-12">20/50</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="mb-2 text-dark">{{translate('Sub Title (EN)')}}
                                                            <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                                data-bs-placement="top"
                                                                title="{{translate('Largest Booking Service Platform')}}"
                                                            >info</i>
                                                        </div>
                                                        <textarea class="form-control block-size-initial" name="copyright_text" rows="1" placeholder="Visit our app and select your location to see available services near you" data-maxlength="150"></textarea>
                                                        <div class="d-flex justify-content-end mt-1">
                                                            <span class="text-light-gray letter-count fz-12">30/150</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="body-bg p-20 rounded-2 mb-20">
                                                <div class="row g-3">
                                                    <div class="col-md-6">
                                                        <div class="d-center bg-white rounded-2 text-center p-20">
                                                            <div class="boxes py-2">
                                                                <h5 class="fz-16 mb-1">Upload  Image 01</h5>
                                                                <p class="fz-12">Upload your Features Image</p>
                                                                <div class="custom-upload-wrapper upload-group border-dashed rounded-2 mx-auto w-100px h-120">
                                                                    <input type="file" id="imageUpload8" accept="image/*" required>
                                                                    <label for="imageUpload8" class="upload-box rounded position-relative d-flex align-items-center justify-content-center text-center overflow-hidden bg-white">
                                                                        <div class="upload-content">
                                                                            <span class="material-symbols-outlined placeholder-icon mb-1 text-primary">photo_camera</span>
                                                                                <span class="fz-10 d-block">Add image</span>
                                                                        </div>
                                                                        <img class="image-preview" src="" alt="Preview" />
                                                                        <div class="upload-overlay">
                                                                            <span class="material-symbols-outlined">photo_camera</span>
                                                                        </div>
                                                                    </label>
                                                                </div>
                                                                <p class="fz-12 mt-2 text-center">JPG, JPEG, PNG, Gif Image size : Max 5 MB <span class="fw-medium text-dark">(200x381px)</span></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="d-center bg-white rounded-2 text-center p-20">
                                                            <div class="boxes py-2">
                                                                <h5 class="fz-16 mb-1">Upload  Image 02</h5>
                                                                <p class="fz-12">Upload your Features Image</p>
                                                                <div class="custom-upload-wrapper upload-group border-dashed rounded-2 mx-auto w-100px h-120">
                                                                    <input type="file" id="imageUpload9" accept="image/*" required>
                                                                    <label for="imageUpload9" class="upload-box rounded position-relative d-flex align-items-center justify-content-center text-center overflow-hidden bg-white">
                                                                        <div class="upload-content">
                                                                            <span class="material-symbols-outlined placeholder-icon mb-1 text-primary">photo_camera</span>
                                                                                <span class="fz-10 d-block">Add image</span>
                                                                        </div>
                                                                        <img class="image-preview" src="" alt="Preview" />
                                                                        <div class="upload-overlay">
                                                                            <span class="material-symbols-outlined">photo_camera</span>
                                                                        </div>
                                                                    </label>
                                                                </div>
                                                                <p class="fz-12 mt-2 text-center">JPG, JPEG, PNG, Gif Image size : Max 5 MB <span class="fw-medium text-dark">(200x381px)</span></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex gap-2 justify-content-end">
                                                <button type="reset" class="btn btn--secondary rounded">
                                                    {{translate('reset')}}
                                                </button>
                                                <button type="submit" class="btn btn--primary rounded">
                                                    {{translate('Save')}}
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="cus-shadow2 rounded-2 p-20">
                                        <div class="data-table-top d-flex align-items-center flex-wrap gap-10 justify-content-between">
                                            <h4> Features  List</h4>
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
                                        <div class="table-responsive table-custom-responsive">
                                            <table id="example" class="table align-middle">
                                                <thead class="text-nowrap">
                                                    <tr>
                                                        <th class="text-dark fw-medium bg-light">{{translate('Sl')}}</th>
                                                        <th class="text-dark fw-medium bg-light">{{translate('Image 01')}}</th>
                                                        <th class="text-dark fw-medium bg-light">{{translate('Image 02')}}</th>
                                                        <th class="text-dark fw-medium bg-light">{{translate('Title')}}</th>
                                                        <th class="text-dark fw-medium bg-light">{{translate('Sub Title')}}</th>
                                                        <th class="text-dark fw-medium bg-light">{{translate('status')}}</th>
                                                        <th class="text-dark fw-medium bg-light">{{translate('action')}}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>
                                                            <img src="{{asset('public/assets/admin-module')}}/img/specialty-thumb1.png" alt="" class="table-cover-img">
                                                        </td>
                                                        <td>
                                                            <img src="{{asset('public/assets/admin-module')}}/img/feature-thumb1.png" alt="" class="table-cover-img">
                                                        </td>
                                                        <td><span class="text-dark text-uppercase title-text">GET YOUR SERVICE ANYTIMEGET </span></td>
                                                        <td><span class="text-dark max-w-260px d-block fz-14">Visit our app and select your location to see available services near you</span></td>
                                                        <td>
                                                            <label class="switcher">
                                                                <input class="switcher_input" type="checkbox" checked="">
                                                                <span class="switcher_control"></span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex gap-2">
                                                                <a href="#" class="action-btn btn--light-primary" data-bs-toggle="offcanvas" data-bs-target="#feature-landing-edit">
                                                                    <span class="material-icons">edit</span>
                                                                </a>
                                                                <button type="button" class="action-btn btn--danger delete_section">
                                                                    <span class="material-icons">delete</span>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>
                                                            <img src="{{asset('public/assets/admin-module')}}/img/specialty-thumb2.png" alt="" class="table-cover-img">
                                                        </td>
                                                        <td>
                                                            <img src="{{asset('public/assets/admin-module')}}/img/feature-thumb2.png" alt="" class="table-cover-img">
                                                        </td>
                                                        <td><span class="text-dark text-uppercase title-text">GET YOUR SERVICE ANYTIMEGET </span></td>
                                                        <td><span class="text-dark max-w-260px d-block fz-14">Visit our app and select your location to see available services near you</span></td>
                                                        <td>
                                                            <label class="switcher">
                                                                <input class="switcher_input" type="checkbox" checked="">
                                                                <span class="switcher_control"></span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex gap-2">
                                                                <a href="#" class="action-btn btn--light-primary" data-bs-toggle="offcanvas" data-bs-target="#feature-landing-edit">
                                                                    <span class="material-icons">edit</span>
                                                                </a>
                                                                <button type="button" class="action-btn btn--danger delete_section">
                                                                    <span class="material-icons">delete</span>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>
                                                            <img src="{{asset('public/assets/admin-module')}}/img/specialty-thumb3.png" alt="" class="table-cover-img">
                                                        </td>
                                                        <td>
                                                            <img src="{{asset('public/assets/admin-module')}}/img/feature-thumb3.png" alt="" class="table-cover-img">
                                                        </td>
                                                        <td><span class="text-dark text-uppercase title-text">GET YOUR SERVICE ANYTIMEGET </span></td>
                                                        <td><span class="text-dark max-w-260px d-block fz-14">Visit our app and select your location to see available services near you</span></td>
                                                        <td>
                                                            <label class="switcher">
                                                                <input class="switcher_input" type="checkbox" checked="">
                                                                <span class="switcher_control"></span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex gap-2">
                                                                <a href="#" class="action-btn btn--light-primary" data-bs-toggle="offcanvas" data-bs-target="#feature-landing-edit">
                                                                    <span class="material-icons">edit</span>
                                                                </a>
                                                                <button type="button" class="action-btn btn--danger delete_section">
                                                                    <span class="material-icons">delete</span>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>4</td>
                                                        <td>
                                                            <img src="{{asset('public/assets/admin-module')}}/img/specialty-thumb4.png" alt="" class="table-cover-img">
                                                        </td>
                                                        <td>
                                                            <img src="{{asset('public/assets/admin-module')}}/img/feature-thumb4.png" alt="" class="table-cover-img">
                                                        </td>
                                                        <td><span class="text-dark text-uppercase title-text">GET YOUR SERVICE ANYTIMEGET </span></td>
                                                        <td><span class="text-dark max-w-260px d-block fz-14">Visit our app and select your location to see available services near you</span></td>
                                                        <td>
                                                            <label class="switcher">
                                                                <input class="switcher_input" type="checkbox" checked="">
                                                                <span class="switcher_control"></span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex gap-2">
                                                                <a href="#" class="action-btn btn--light-primary" data-bs-toggle="offcanvas" data-bs-target="#feature-landing-edit">
                                                                    <span class="material-icons">edit</span>
                                                                </a>
                                                                <button type="button" class="action-btn btn--danger delete_section">
                                                                    <span class="material-icons">delete</span>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Registration Section -->
                        <div class="tab-pane fade" id="custom-tabs6" role="tabpanel" aria-labelledby="cus-tab6" tabindex="0">
                            <div class="card p-20 mb-20">
                                <div class="d-flex align-items-center justify-content-between flex-sm-nowrap flex-wrap gap-2">
                                    <div>
                                        <h3 class="page-title mb-2">{{translate('Registration Section')}}</h3>
                                        <p>{{translate('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet')}}</p>
                                    </div>
                                    <button type="button" class="rounded transition text-nowrap fz-12 fw-semibold btn-primary__outline btn d-flex align-items-center gap-1 py-2 px-3" data-bs-toggle="offcanvas" data-bs-target="#registration-landing-page">
                                        <span class="material-symbols-outlined">visibility</span> Section Preview
                                    </button>
                                </div>
                            </div>
                            <div class="card mb-20">
                                <div class="border-bottom p-20">
                                    <h3 class="page-title mb-2">{{translate('Registration')}}</h3>
                                    <p>{{translate('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet ')}}</p>
                                </div>
                                <div class="card-body p-20">
                                    <form action="javascript:void(0)" method="POST" id="landing-info-update-form">
                                        <div class="row g-xl-4 g-3 mb-20">
                                            <div class="col-lg-8">
                                                <div class="body-bg rounded p-20 discount-type lang-form default-form">
                                                    <ul class="nav nav--tabs border-color-primary mb-4">
                                                        <li class="nav-item">
                                                            <a class="nav-link lang_link active" href="#" id="">{{translate('Default(EN)')}}</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link lang_link" href="#0" id="">{{translate('English(EN)')}}</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link lang_link" href="#0" id="">{{translate('Arabic(AR)')}}</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link lang_link" href="#0" id="">{{translate('Spanish(ES)')}}</a>
                                                        </li>
                                                    </ul>
                                                    <div class="row g-lg-3 g-3">
                                                        <div class="col-md-12">
                                                            <div class="mb-2 text-dark">{{translate('Title (EN)')}}
                                                                <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    title="{{translate('Service We Provide You')}}"
                                                                >info</i>
                                                            </div>
                                                            <textarea class="form-control block-size-initial" name="copyright_text" rows="1" placeholder="Register As Provider" data-maxlength="50"></textarea>
                                                            <div class="d-flex justify-content-end mt-1">
                                                                <span class="text-light-gray letter-count fz-12">30/50</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="mb-2 text-dark">{{translate('Sub Title (EN)')}}
                                                                <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    title="{{translate('Largest Booking Service Platform')}}"
                                                                >info</i>
                                                            </div>
                                                            <textarea class="form-control block-size-initial" name="copyright_text" rows="1" placeholder="Become e provider & Start your own business online with on demand service platform" data-maxlength="50"></textarea>
                                                            <div class="d-flex justify-content-end mt-1">
                                                                <span class="text-light-gray letter-count fz-12">30/50</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="body-bg d-center rounded-2 text-center h-100 p-20">
                                                    <div class="boxes">
                                                        <h5 class="fz-16 mb-1">Upload Registration Image</h5>
                                                        <p class="fz-12">Upload your About Us Image</p>
                                                        <div class="custom-upload-wrapper upload-group border-dashed rounded-2 mx-auto w-100px h-100px">
                                                            <input type="file" id="imageUpload12" accept="image/*" required>
                                                            <label for="imageUpload12" class="upload-box rounded position-relative d-flex align-items-center justify-content-center text-center overflow-hidden bg-white">
                                                                <div class="upload-content">
                                                                    <span class="material-symbols-outlined placeholder-icon mb-1 text-primary">photo_camera</span>
                                                                        <span class="fz-10 d-block">Add image</span>
                                                                </div>
                                                                <img class="image-preview" src="" alt="Preview" />
                                                                <div class="upload-overlay">
                                                                    <span class="material-symbols-outlined">photo_camera</span>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <p class="fz-12 mt-2 text-center">JPG, JPEG, PNG, Gif Image size : Max 5 MB <span class="fw-medium text-dark">(238x228px)</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex gap-2 justify-content-end">
                                            <button type="reset" class="btn btn--secondary rounded">
                                                {{translate('reset')}}
                                            </button>
                                            <button type="submit" class="btn btn--primary rounded">
                                                {{translate('Save')}}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Testimonial Section -->
                        <div class="tab-pane fade" id="custom-tabs7" role="tabpanel" aria-labelledby="cus-tab7" tabindex="0">
                            <div class="card p-20 mb-20">
                                <div class="d-flex align-items-center justify-content-between flex-sm-nowrap flex-wrap gap-2">
                                    <div>
                                        <h3 class="page-title mb-2">{{translate('Testimonials Section')}}</h3>
                                        <p>{{translate('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet')}}</p>
                                    </div>
                                    <button type="button" class="rounded transition text-nowrap fz-12 fw-semibold btn-primary__outline btn d-flex align-items-center gap-1 py-2 px-3" data-bs-toggle="offcanvas" data-bs-target="#testimonial-landing-page">
                                        <span class="material-symbols-outlined">visibility</span> Section Preview
                                    </button>
                                </div>
                            </div>
                            <div class="card mb-20">
                                <div class="card-body p-20">
                                    <div class="mb-20">
                                        <h3 class="page-title mb-2">{{translate('Testimonials Content')}}</h3>
                                        <p>{{translate('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet ')}}</p>
                                    </div>
                                    <form action="javascript:void(0)" method="POST" id="landing-info-update-form">
                                        <div class="body-bg rounded p-20 discount-type lang-form default-form mb-20">
                                            <ul class="nav nav--tabs border-color-primary mb-4">
                                                <li class="nav-item">
                                                    <a class="nav-link lang_link active" href="#" id="">{{translate('Default(EN)')}}</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link lang_link" href="#0" id="">{{translate('English(EN)')}}</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link lang_link" href="#0" id="">{{translate('Arabic(AR)')}}</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link lang_link" href="#0" id="">{{translate('Spanish(ES)')}}</a>
                                                </li>
                                            </ul>
                                            <div class="row g-lg-3 g-3">
                                                <div class="col-md-12">
                                                    <div class="mb-2 text-dark">{{translate('Title (EN)')}}
                                                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                            data-bs-placement="top"
                                                            title="{{translate('Service We Provide You')}}"
                                                        >info</i>
                                                    </div>
                                                    <textarea class="form-control block-size-initial" name="copyright_text" rows="1" placeholder="Trusted By Customers & PRoviders" data-maxlength="50"></textarea>
                                                    <div class="d-flex justify-content-end mt-1">
                                                        <span class="text-light-gray letter-count fz-12">20/50</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex gap-2 justify-content-end">
                                            <button type="reset" class="btn btn--secondary rounded">
                                                {{translate('reset')}}
                                            </button>
                                            <button type="submit" class="btn btn--primary rounded">
                                                {{translate('Save')}}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="card">
                                <div class="border-bottom p-20">
                                    <h3 class="page-title mb-2">{{translate('Add Testimonial')}}</h3>
                                    <p>{{translate('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet ')}}</p>
                                </div>
                                <div class="cus-shadow p-20 rounded mb-20">
                                    <div class="card-body p-20">
                                        <form action="javascript:void(0)" method="POST" id="landing-info-update-form">
                                            <div class="row g-xl-4 g-3 mb-20">
                                                <div class="col-lg-8">
                                                    <div class="body-bg rounded p-20 discount-type lang-form default-form">
                                                        <ul class="nav nav--tabs border-color-primary mb-4">
                                                            <li class="nav-item">
                                                                <a class="nav-link lang_link active" href="#" id="">{{translate('Default(EN)')}}</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link lang_link" href="#0" id="">{{translate('English(EN)')}}</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link lang_link" href="#0" id="">{{translate('Arabic(AR)')}}</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link lang_link" href="#0" id="">{{translate('Spanish(ES)')}}</a>
                                                            </li>
                                                        </ul>
                                                        <div class="row g-lg-3 g-3">
                                                            <div class="col-md-12">
                                                                <div class="mb-2 text-dark">{{translate('Review (EN)')}}
                                                                    <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                                        data-bs-placement="top"
                                                                        title="{{translate('Review (EN)')}}"
                                                                    >info</i>
                                                                </div>
                                                                <textarea class="form-control block-size-initial" name="copyright_text" rows="2" placeholder="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet Lorem ipsum " data-maxlength="200"></textarea>
                                                                <div class="d-flex justify-content-end mt-1">
                                                                    <span class="text-light-gray letter-count fz-12">120/200</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-2 text-dark">{{translate('Reviewer Name (EN)')}}
                                                                    <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                                        data-bs-placement="top"
                                                                        title="{{translate('Review (EN)')}}"
                                                                    >info</i>
                                                                </div>
                                                                <input type="text" class="form-control" name="" placeholder="{{translate('Darrell Steward')}}" required="" value="">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-2 text-dark">{{translate('Designation (EN)')}}
                                                                    <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                                        data-bs-placement="top"
                                                                        title="{{translate('Designaion Here')}}"
                                                                    >info</i>
                                                                </div>
                                                                <input type="text" class="form-control" name="" placeholder="{{translate('Customer')}}" required="" value="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="body-bg d-center rounded-2 text-center h-100 p-20">
                                                        <div class="boxes">
                                                            <h5 class="fz-16 mb-1">Upload Specialty Image</h5>
                                                            <p class="fz-12">Upload your Specialty Image</p>
                                                            <div class="custom-upload-wrapper upload-group border-dashed rounded-2 mx-auto w-100px h-100px">
                                                                <input type="file" id="imageUpload13" accept="image/*" required>
                                                                <label for="imageUpload13" class="upload-box rounded position-relative d-flex align-items-center justify-content-center text-center overflow-hidden bg-white">
                                                                    <div class="upload-content">
                                                                        <span class="material-symbols-outlined placeholder-icon mb-1 text-primary">photo_camera</span>
                                                                            <span class="fz-10 d-block">Add image</span>
                                                                    </div>
                                                                    <img class="image-preview" src="" alt="Preview" />
                                                                    <div class="upload-overlay">
                                                                        <span class="material-symbols-outlined">photo_camera</span>
                                                                    </div>
                                                                </label>
                                                            </div>
                                                            <p class="fz-12 mt-2 text-center">JPG, JPEG, PNG, Gif Image size : Max 5 MB <span class="fw-medium text-dark">(1:1)</span></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="d-flex gap-2 justify-content-end">
                                                <button type="reset" class="btn btn--secondary rounded">
                                                    {{translate('reset')}}
                                                </button>
                                                <button type="button" class="btn btn--primary rounded">
                                                    {{translate('Add')}}
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="cus-shadow p-20 rounded">
                                    <div class="data-table-top d-flex align-items-center flex-wrap gap-10 justify-content-between">
                                        <h4>Testimonial list</h4>
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
                                    <div class="table-responsive table-custom-responsive">
                                        <table id="example" class="table align-middle">
                                            <thead class="text-nowrap">
                                                <tr>
                                                    <th class="text-dark fw-medium bg-light">{{translate('Sl')}}</th>
                                                    <th class="text-dark fw-medium bg-light">{{translate('Reviewer Image')}}</th>
                                                    <th class="text-dark fw-medium bg-light">{{translate('Designation')}}</th>
                                                    <th class="text-dark fw-medium bg-light">{{translate('Review')}}</th>
                                                    <th class="text-dark fw-medium bg-light">{{translate('status')}}</th>
                                                    <th class="text-dark fw-medium bg-light">{{translate('action')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>
                                                        <img src="{{asset('public/assets/admin-module')}}/img/reviewer-author1.png" alt="" class="table-cover-img">
                                                    </td>
                                                    <td><span class="text-dark">Customer</span></td>
                                                    <td class="max-w-400">
                                                        <span class="text-dark max-w-400 d-block">Lorem ipsum dolor sit amet, consectetur adipiscing elit.  odio tellus, laoreet Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam</span>
                                                    </td>
                                                    <td>
                                                        <label class="switcher">
                                                            <input class="switcher_input" type="checkbox" checked="">
                                                            <span class="switcher_control"></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex gap-2">
                                                            <a href="#" class="action-btn btn--light-primary" data-bs-toggle="offcanvas" data-bs-target="#testimonial-landing-edit">
                                                                <span class="material-icons">edit</span>
                                                            </a>
                                                            <button type="button" class="action-btn btn--danger delete_section">
                                                                <span class="material-icons">delete</span>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>
                                                        <img src="{{asset('public/assets/admin-module')}}/img/reviewer-author2.png" alt="" class="table-cover-img">
                                                    </td>
                                                    <td><span class="text-dark">Customer</span></td>
                                                    <td class="max-w-400">
                                                        <span class="text-dark max-w-400 d-block">Lorem ipsum dolor sit amet, consectetur adipiscing elit.  odio tellus, laoreet Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam</span>
                                                    </td>
                                                    <td>
                                                        <label class="switcher">
                                                            <input class="switcher_input" type="checkbox" checked="">
                                                            <span class="switcher_control"></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex gap-2">
                                                            <a href="#" class="action-btn btn--light-primary" data-bs-toggle="offcanvas" data-bs-target="#testimonial-landing-edit">
                                                                <span class="material-icons">edit</span>
                                                            </a>
                                                            <button type="button" class="action-btn btn--danger delete_section">
                                                                <span class="material-icons">delete</span>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>
                                                        <img src="{{asset('public/assets/admin-module')}}/img/reviewer-author3.png" alt="" class="table-cover-img">
                                                    </td>
                                                    <td><span class="text-dark">Customer</span></td>
                                                    <td class="max-w-400">
                                                        <span class="text-dark max-w-400 d-block">Lorem ipsum dolor sit amet, consectetur adipiscing elit.  odio tellus, laoreet Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam</span>
                                                    </td>
                                                    <td>
                                                        <label class="switcher">
                                                            <input class="switcher_input" type="checkbox" checked="">
                                                            <span class="switcher_control"></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex gap-2">
                                                            <a href="#" class="action-btn btn--light-primary" data-bs-toggle="offcanvas" data-bs-target="#testimonial-landing-edit">
                                                                <span class="material-icons">edit</span>
                                                            </a>
                                                            <button type="button" class="action-btn btn--danger delete_section">
                                                                <span class="material-icons">delete</span>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td>
                                                        <img src="{{asset('public/assets/admin-module')}}/img/reviewer-author4.png" alt="" class="table-cover-img">
                                                    </td>
                                                    <td><span class="text-dark">Customer</span></td>
                                                    <td class="max-w-400">
                                                        <span class="text-dark max-w-400 d-block">Lorem ipsum dolor sit amet, consectetur adipiscing elit.  odio tellus, laoreet Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam</span>
                                                    </td>
                                                    <td>
                                                        <label class="switcher">
                                                            <input class="switcher_input" type="checkbox" checked="">
                                                            <span class="switcher_control"></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex gap-2">
                                                            <a href="#" class="action-btn btn--light-primary" data-bs-toggle="offcanvas" data-bs-target="#testimonial-landing-edit">
                                                                <span class="material-icons">edit</span>
                                                            </a>
                                                            <button type="button" class="action-btn btn--danger delete_section">
                                                                <span class="material-icons">delete</span>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Button & Links -->
                        <div class="tab-pane fade" id="custom-tabs8" role="tabpanel" aria-labelledby="cus-tab8" tabindex="0">
                            <div class="card">
                                <div class="border-bottom p-20">
                                    <h3 class="page-title mb-2">{{translate('Button & Links')}}</h3>
                                    <p>{{translate('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet')}}</p>
                                </div>
                                <div class="card-body p-20">
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <div class="body-bg rounded p-20">
                                                @php($value=$dataValues->where('key_name','app_url_playstore')->first()->is_active??0)
                                                <div class="d-flex align-items-center justify-content-between gap-2 mb-2">
                                                    <div class="mb-2 text-dark">{{translate('App url (Play store)')}}
                                                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                            data-bs-placement="top"
                                                            title="{{translate('App url (Play store)')}}"
                                                        >info</i>
                                                    </div>
                                                    <label class="switcher">
                                                        <input class="switcher_input" type="checkbox"
                                                                name="app_url_playstore_is_active"
                                                                {{$value?'checked':''}}
                                                                value="1">
                                                        <span class="switcher_control"></span>
                                                    </label>
                                                </div>
                                                <div class="">
                                                    <div class="form-business">
                                                        <input type="text" class="form-control"
                                                                name="app_url_playstore"
                                                                value="{{$dataValues->where('key_name','app_url_playstore')->first()->live_values??''}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="body-bg rounded p-20">
                                                @php($value=$dataValues->where('key_name','app_url_appstore')->first()->is_active??0)
                                                <div class="d-flex align-items-center justify-content-between gap-2 mb-2">
                                                    <div class="mb-2 text-dark">{{translate('App url (Play store)')}}
                                                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                            data-bs-placement="top"
                                                            title="{{translate('App url (Play store)')}}"
                                                        >info</i>
                                                    </div>
                                                    <label class="switcher">
                                                        <input class="switcher_input" type="checkbox"
                                                                name="app_url_appstore_is_active"
                                                                {{$value?'checked':''}}
                                                                value="1">
                                                        <span class="switcher_control"></span>
                                                    </label>
                                                </div>
                                                <div class="">
                                                    <div class="form-business">
                                                        <input type="text" class="form-control"
                                                                name="app_url_appstore"
                                                                value="{{$dataValues->where('key_name','app_url_appstore')->first()->live_values??''}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="body-bg rounded p-20">
                                                @php($value=$dataValues->where('key_name','web_url')->first()->is_active??0)
                                                <div class="d-flex align-items-center justify-content-between gap-2 mb-2">
                                                    <div class="mb-2 text-dark">{{translate('App url (Play store)')}}
                                                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                            data-bs-placement="top"
                                                            title="{{translate('App url (Play store)')}}"
                                                        >info</i>
                                                    </div>
                                                    <label class="switcher">
                                                        <input class="switcher_input" type="checkbox"
                                                                name="web_url_is_active"
                                                                {{$value?'checked':''}}
                                                                value="1">
                                                        <span class="switcher_control"></span>
                                                    </label>
                                                </div>
                                                <div class="">
                                                    <div class="form-business">
                                                        <input type="text" class="form-control"
                                                                name="web_url"
                                                                value="{{$dataValues->where('key_name','web_url')->first()->live_values??''}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @can('landing_update')
                                        <div class="d-flex gap-2 justify-content-end mt-3">
                                            <button type="reset" class="btn btn--secondary rounded">
                                                {{translate('reset')}}
                                            </button>
                                            <button type="submit" class="btn btn--primary rounded">
                                                {{translate('update')}}
                                            </button>
                                        </div>
                                    @endcan
                                    <div class="pick-map mt-4 p-12 rounded d-flex flex-md-nowrap flex-wrap align-items-center gap-1 bg-primary bg-opacity-10">
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
                                        <p class="fz-12">It looks like your server might not have the necessary permissions to automatically set up the cron job. Please ensure that your server has shell/bash access enabled, as it’s required for automated cron job configuration.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<!-- Hero Offcanvas -->
<form action="" method="post" id="update-form-submit">
    @csrf
    <div class="offcanvas offcanvas-end offcanvas-cus-xl" tabindex="-1" id="admin-landing-page" aria-labelledby="admin-landing-pageLabel">
        <div class="offcanvas-header py-3 ">
            <h2 class="mb-0">Hero Section Preview</h2>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="hero-preview-thumb px-md-5 px-0 py-md-4 py-1">
                <img src="{{asset('public/assets/admin-module')}}/img/hero-previews.png" alt="img" class="w-100">
            </div>
        </div>
    </div>
</form>
<!-- Service Offcanvas -->
<form action="" method="post" id="update-form-submit">
    @csrf
    <div class="offcanvas offcanvas-end offcanvas-cus-xl" tabindex="-1" id="service-landing-page" aria-labelledby="service-landing-pageLabel">
        <div class="offcanvas-header py-3 ">
            <h2 class="mb-0">Service Section Preview</h2>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="hero-preview-thumb px-md-5 px-0 py-md-4 py-1">
                <img src="{{asset('public/assets/admin-module')}}/img/service-preview.png" alt="img" class="w-100">
            </div>
        </div>
    </div>
</form>
<!-- About Offcanvas -->
<form action="" method="post" id="update-form-submit">
    @csrf
    <div class="offcanvas offcanvas-end offcanvas-cus-xl" tabindex="-1" id="about-landing-page" aria-labelledby="about-landing-pageLabel">
        <div class="offcanvas-header py-3 ">
            <h2 class="mb-0">About Us Section Preview</h2>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="hero-preview-thumb px-md-5 px-0 py-md-4 py-1">
                <img src="{{asset('public/assets/admin-module')}}/img/about-preview.png" alt="img" class="w-100">
            </div>
        </div>
    </div>
</form>
<!-- Speciality Offcanvas -->
<form action="" method="post" id="update-form-submit">
    @csrf
    <div class="offcanvas offcanvas-end offcanvas-cus-xl" tabindex="-1" id="speciality-landing-page" aria-labelledby="about-landing-pageLabel">
        <div class="offcanvas-header py-md-4 py-3">
            <h2 class="mb-0">Specialty Section Preview</h2>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body bg-white">
            <div class="hero-preview-thumb px-md-5 px-0 py-md-4 py-1">
                <img src="{{asset('public/assets/admin-module')}}/img/speciality-preview.png" alt="img" class="w-100">
            </div>
        </div>
    </div>
</form>
<!-- Speciality Edit Offcanvas -->
<form action="" method="post" id="update-form-submit">
    @csrf
    <div class="offcanvas offcanvas-end offcanvas-cus-sm" tabindex="-1" id="speciality-landing-edit" aria-labelledby="about-landing-pageLabel">
        <div class="offcanvas-header py-md-4 py-3">
            <h2 class="mb-0">Edit Specialty</h2>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body bg-white">
            <div class="body-bg rounded p-20 discount-type lang-form default-form mb-20">
                <ul class="nav nav--tabs border-color-primary mb-4">
                    <li class="nav-item">
                        <a class="nav-link lang_link active" href="#" id="">{{translate('Default(EN)')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link lang_link" href="#0" id="">{{translate('English(EN)')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link lang_link" href="#0" id="">{{translate('Arabic(AR)')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link lang_link" href="#0" id="">{{translate('Spanish(ES)')}}</a>
                    </li>
                </ul>
                <div class="row g-lg-3 g-3">
                    <div class="col-md-12">
                        <div class="mb-2 text-dark">{{translate('Title (EN)')}}
                            <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                title="{{translate('Service We Provide You')}}"
                            >info</i>
                        </div>
                        <textarea class="form-control block-size-initial" name="copyright_text" rows="1" placeholder="46,465+" data-maxlength="50"></textarea>
                        <div class="d-flex justify-content-end mt-1">
                            <span class="text-light-gray letter-count fz-12">20/50</span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-2 text-dark">{{translate('Sub Title (EN)')}}
                            <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                title="{{translate('Largest Booking Service Platform')}}"
                            >info</i>
                        </div>
                        <textarea class="form-control block-size-initial" name="copyright_text" rows="1" placeholder="Happy Clients" data-maxlength="50"></textarea>
                        <div class="d-flex justify-content-end mt-1">
                            <span class="text-light-gray letter-count fz-12">30/50</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="body-bg d-center rounded-2 text-center p-20">
                <div class="boxes">
                    <h5 class="fz-16 mb-1">Upload About Us Image</h5>
                    <p class="fz-12">Upload your About Us Image</p>
                    <div class="custom-upload-wrapper upload-group border-dashed rounded-2 mx-auto w-100px h-100px">
                        <input type="file" id="imageUpload7" accept="image/*" required>
                        <label for="imageUpload7" class="upload-box rounded position-relative d-flex align-items-center justify-content-center text-center overflow-hidden bg-white">
                            <div class="upload-content">
                                <span class="material-symbols-outlined placeholder-icon mb-1 text-primary">photo_camera</span>
                                    <span class="fz-10 d-block">Add image</span>
                            </div>
                            <img class="image-preview" src="" alt="Preview" />
                            <div class="upload-overlay">
                                <span class="material-symbols-outlined">photo_camera</span>
                            </div>
                        </label>
                    </div>
                    <p class="fz-12 mt-2 text-center">JPG, JPEG, PNG, Gif Image size : Max 5 MB <span class="fw-medium text-dark">(684x400px)</span></p>
                </div>
            </div>
        </div>
        <div class="offcanvas-footer border-top">
            <div class="d-flex justify-content-center gap-2 bg-white px-3 py-sm-3 py-2">
                <button class="btn btn--secondary w-100 rounded h-45" type="reset">{{translate('Reset')}}</button>
                <button class="btn btn--primary w-100 rounded h-45" type="submit">{{translate('Update')}}</button>
            </div>
        </div>
    </div>
</form>
<!-- Feature Page Offcanvas -->
<form action="" method="post" id="update-form-submit">
    @csrf
    <div class="offcanvas offcanvas-end offcanvas-cus-xl" tabindex="-1" id="feature-landing-page" aria-labelledby="about-landing-pageLabel">
        <div class="offcanvas-header py-md-4 py-3">
            <h2 class="mb-0">Features Section Preview</h2>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body bg-white">
            <div class="hero-preview-thumb px-md-5 px-0 py-md-4 py-1">
                <img src="{{asset('public/assets/admin-module')}}/img/feature-preview.png" alt="img" class="w-100">
            </div>
        </div>
    </div>
</form>
<!-- Feature Edit Offcanvas -->
<form action="" method="post" id="update-form-submit">
    @csrf
    <div class="offcanvas offcanvas-end offcanvas-cus-sm" tabindex="-1" id="feature-landing-edit" aria-labelledby="about-landing-pageLabel">
        <div class="offcanvas-header py-md-4 py-3">
            <h2 class="mb-0">Edit Features</h2>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body bg-white">
            <div class="body-bg rounded p-20 discount-type lang-form default-form mb-20">
                <ul class="nav nav--tabs border-color-primary mb-4">
                    <li class="nav-item">
                        <a class="nav-link lang_link active" href="#" id="">{{translate('Default(EN)')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link lang_link" href="#0" id="">{{translate('English(EN)')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link lang_link" href="#0" id="">{{translate('Arabic(AR)')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link lang_link" href="#0" id="">{{translate('Spanish(ES)')}}</a>
                    </li>
                </ul>
                <div class="row g-lg-3 g-3">
                    <div class="col-md-12">
                        <div class="mb-2 text-dark">{{translate('Title (EN)')}}
                            <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                title="{{translate('Service We Provide You')}}"
                            >info</i>
                        </div>
                        <textarea class="form-control block-size-initial" name="copyright_text" rows="1" placeholder="Get YOur Service Anytimeget" data-maxlength="100"></textarea>
                        <div class="d-flex justify-content-end mt-1">
                            <span class="text-light-gray letter-count fz-12">23/100</span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-2 text-dark">{{translate('Description (EN)')}}
                            <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                title="{{translate('Largest Booking Service Platform')}}"
                            >info</i>
                        </div>
                        <textarea class="form-control block-size-initial" name="copyright_text" rows="2" placeholder="Visit our app and select your location to see available services near you" data-maxlength="50"></textarea>
                        <div class="d-flex justify-content-end mt-1">
                            <span class="text-light-gray letter-count fz-12">80/160</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="body-bg d-center rounded-2 text-center p-20 mb-20">
                <div class="boxes py-2">
                    <h5 class="fz-16 mb-1">Upload  Image 01</h5>
                    <p class="fz-12">Upload your Features Image</p>
                    <div class="custom-upload-wrapper upload-group border-dashed rounded-2 mx-auto w-100px h-120">
                        <input type="file" id="imageUpload10" accept="image/*" required>
                        <label for="imageUpload10" class="upload-box rounded position-relative d-flex align-items-center justify-content-center text-center overflow-hidden bg-white">
                            <div class="upload-content">
                                <span class="material-symbols-outlined placeholder-icon mb-1 text-primary">photo_camera</span>
                                    <span class="fz-10 d-block">Add image</span>
                            </div>
                            <img class="image-preview" src="" alt="Preview" />
                            <div class="upload-overlay">
                                <span class="material-symbols-outlined">photo_camera</span>
                            </div>
                        </label>
                    </div>
                    <p class="fz-12 mt-2 text-center">JPG, JPEG, PNG, Gif Image size : Max 5 MB <span class="fw-medium text-dark">(200x381px)</span></p>
                </div>
            </div>
            <div class="body-bg d-center rounded-2 text-center p-20">
                <div class="boxes py-2">
                    <h5 class="fz-16 mb-1">Upload  Image 02</h5>
                    <p class="fz-12">Upload your Features Image</p>
                    <div class="custom-upload-wrapper upload-group border-dashed rounded-2 mx-auto w-100px h-120">
                        <input type="file" id="imageUpload11" accept="image/*" required>
                        <label for="imageUpload11" class="upload-box rounded position-relative d-flex align-items-center justify-content-center text-center overflow-hidden bg-white">
                            <div class="upload-content">
                                <span class="material-symbols-outlined placeholder-icon mb-1 text-primary">photo_camera</span>
                                    <span class="fz-10 d-block">Add image</span>
                            </div>
                            <img class="image-preview" src="" alt="Preview" />
                            <div class="upload-overlay">
                                <span class="material-symbols-outlined">photo_camera</span>
                            </div>
                        </label>
                    </div>
                    <p class="fz-12 mt-2 text-center">JPG, JPEG, PNG, Gif Image size : Max 5 MB <span class="fw-medium text-dark">(200x381px)</span></p>
                </div>
            </div>
        </div>
        <div class="offcanvas-footer border-top">
            <div class="d-flex justify-content-center gap-2 bg-white px-3 py-sm-3 py-2">
                <button class="btn btn--secondary w-100 rounded h-45" type="reset">{{translate('Reset')}}</button>
                <button class="btn btn--primary w-100 rounded h-45" type="submit">{{translate('Update')}}</button>
            </div>
        </div>
    </div>
</form>
<!-- Register Offcanvas -->
<form action="" method="post" id="update-form-submit">
    @csrf
    <div class="offcanvas offcanvas-end offcanvas-cus-xl" tabindex="-1" id="registration-landing-page" aria-labelledby="registration-landing-pageLabel">
        <div class="offcanvas-header py-md-4 py-3">
            <h2 class="mb-0">Registration Section Preview</h2>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body bg-white">
            <div class="hero-preview-thumb px-md-5 px-0 py-md-4 py-1">
                <img src="{{asset('public/assets/admin-module')}}/img/registration-preview.png" alt="img" class="w-100">
            </div>
        </div>
    </div>
</form>
<!-- Testimonial Offcanvas -->
<form action="" method="post" id="update-form-submit">
    @csrf
    <div class="offcanvas offcanvas-end offcanvas-cus-xl" tabindex="-1" id="testimonial-landing-page" aria-labelledby="testimonial-landing-pageLabel">
        <div class="offcanvas-header py-md-4 py-3">
            <h2 class="mb-0">Testimonials Section Preview</h2>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body bg-white">
            <div class="hero-preview-thumb px-md-5 px-0 py-md-4 py-1">
                <img src="{{asset('public/assets/admin-module')}}/img/testimonial-preview.png" alt="img" class="w-100">
            </div>
        </div>
    </div>
</form>
<!-- Testimonial Edit Offcanvas -->
<form action="" method="post" id="update-form-submit">
    @csrf
    <div class="offcanvas offcanvas-end offcanvas-cus-sm" tabindex="-1" id="testimonial-landing-edit" aria-labelledby="testimonial-landingLabel">
        <div class="offcanvas-header py-md-4 py-3">
            <h2 class="mb-0">Edit Testimonial</h2>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body bg-white">
            <div class="body-bg rounded p-20 discount-type lang-form default-form mb-20">
                <ul class="nav nav--tabs border-color-primary mb-4">
                    <li class="nav-item">
                        <a class="nav-link lang_link active" href="#" id="">{{translate('Default(EN)')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link lang_link" href="#0" id="">{{translate('English(EN)')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link lang_link" href="#0" id="">{{translate('Arabic(AR)')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link lang_link" href="#0" id="">{{translate('Spanish(ES)')}}</a>
                    </li>
                </ul>
                <div class="row g-lg-4 g-3">
                    <div class="col-md-12">
                        <div class="mb-2 text-dark">{{translate('Reviewer Name (EN)')}}
                            <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                title="{{translate('Review (EN)')}}"
                            >info</i>
                        </div>
                        <input type="text" class="form-control" name="" placeholder="{{translate('Darrell Steward')}}" required="" value="">
                    </div>
                    <div class="col-md-12">
                        <div class="mb-2 text-dark">{{translate('Designation (EN)')}}
                            <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                title="{{translate('Designaion Here')}}"
                            >info</i>
                        </div>
                        <input type="text" class="form-control" name="" placeholder="{{translate('Customer')}}" required="" value="">
                    </div>
                    <div class="col-md-12">
                        <div class="mb-2 text-dark">{{translate('Review (EN)')}}
                            <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                title="{{translate('Review (EN)')}}"
                            >info</i>
                        </div>
                        <textarea class="form-control block-size-initial" name="copyright_text" rows="4" placeholder="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet Lorem ipsum " data-maxlength="200"></textarea>
                        <div class="d-flex justify-content-end mt-1">
                            <span class="text-light-gray letter-count fz-12">120/200</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="body-bg d-center rounded-2 text-center p-20">
                <div class="boxes">
                    <h5 class="fz-16 mb-1">Reviewer Image</h5>
                    <p class="fz-12">Upload Reviewer Image</p>
                    <div class="custom-upload-wrapper upload-group border-dashed rounded-2 mx-auto w-100px h-100px">
                        <input type="file" id="imageUpload14" accept="image/*" required>
                        <label for="imageUpload14" class="upload-box rounded position-relative d-flex align-items-center justify-content-center text-center overflow-hidden bg-white">
                            <div class="upload-content">
                                <span class="material-symbols-outlined placeholder-icon mb-1 text-primary">photo_camera</span>
                                    <span class="fz-10 d-block">Add image</span>
                            </div>
                            <img class="image-preview" src="" alt="Preview" />
                            <div class="upload-overlay">
                                <span class="material-symbols-outlined">photo_camera</span>
                            </div>
                        </label>
                    </div>
                    <p class="fz-12 mt-2 text-center">JPG, JPEG, PNG, Gif Image size : Max 5 MB <span class="fw-medium text-dark">(1:1)</span></p>
                </div>
            </div>
        </div>
        <div class="offcanvas-footer border-top">
            <div class="d-flex justify-content-center gap-2 bg-white px-3 py-sm-3 py-2">
                <button class="btn btn--secondary w-100 rounded h-45" type="reset">{{translate('Reset')}}</button>
                <button class="btn btn--primary w-100 rounded h-45" type="submit">{{translate('Update')}}</button>
            </div>
        </div>
    </div>
</form>













<!-- Customer Landing Here -->
<!-- Customer Landing Here -->
<h1 class="py-5 text-center">Customer Landing Here</h1>
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-wrap mb-3">
                    <h2 class="page-title">{{translate('Customer Landing Page')}}</h2>
                </div>

                <div class="mb-3 nav-tabs-responsive position-relative">
                    <ul class="nav nav--tabs scrollbar-w flex-nowrap white-nowrap overflow-x-auto flex-wrap-nowrap nav--tabs__style2">
                        <li class="nav-item">
                            <a href="#" class="nav-link active" id="customer-cus-tab1" data-bs-toggle="tab" data-bs-target="#customer-custom-tabs1" type="button" role="tab" aria-controls="custom-tabs1" aria-selected="false">
                                {{translate('Hero Section')}}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link " id="customer-cus-tab2" data-bs-toggle="tab" data-bs-target="#customer-custom-tabs2" type="button" role="tab" aria-controls="custom-tabs2" aria-selected="false">
                                {{translate('Feature')}}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link" id="customer-cus-tab3" data-bs-toggle="tab" data-bs-target="#customer-custom-tabs3" type="button" role="tab" aria-controls="custom-tabs3" aria-selected="false">
                                {{translate('Testimonials')}}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link " id="customer-cus-tab4" data-bs-toggle="tab" data-bs-target="#customer-custom-tabs4" type="button" role="tab" aria-controls="custom-tabs4" aria-selected="false">
                                {{translate('Download')}}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link " id="customer-cus-tab5" data-bs-toggle="tab" data-bs-target="#customer-custom-tabs5" type="button" role="tab" aria-controls="custom-tabs5" aria-selected="false">
                                {{translate('Support ')}}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link " id="customer-cus-tab6" data-bs-toggle="tab" data-bs-target="#customer-custom-tabs6" type="button" role="tab" aria-controls="custom-tabs6" aria-selected="false">
                                {{translate('Button & Links')}}
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
                    <!-- Hero Section -->
                    <div class="tab-pane fade show active" id="customer-custom-tabs1" role="tabpanel" aria-labelledby="customer-cus-tab1" tabindex="0">
                        <div class="card p-20 mb-20">
                            <div class="d-flex align-items-center justify-content-between flex-sm-nowrap flex-wrap gap-2">
                                <div>
                                    <h3 class="page-title mb-2">{{translate('Hero Section')}}</h3>
                                    <p>{{translate('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet ')}}</p>
                                </div>
                                <button type="button" class="rounded transition text-nowrap fz-12 fw-semibold btn-primary__outline btn d-flex align-items-center gap-1 py-2 px-3" data-bs-toggle="offcanvas" data-bs-target="#customer-landing-page">
                                    <span class="material-symbols-outlined">visibility</span> Section Preview
                                </button>
                            </div>
                        </div>
                        <div class="card mb-20">
                            <div class="card-body p-20">
                                <div class="mb-20">
                                    <h3 class="page-title mb-2">{{translate('Hero Section Content')}}</h3>
                                    <p>{{translate('Here you setup your all business information.')}}</p>
                                </div>
                                <form action="javascript:void(0)" method="POST" id="landing-info-update-form">
                                    <div class="body-bg rounded p-20 discount-type lang-form default-form mb-20">
                                        <ul class="nav nav--tabs border-color-primary mb-4">
                                            <li class="nav-item">
                                                <a class="nav-link lang_link active" href="#" id="">{{translate('Default(EN)')}}</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link lang_link" href="#0" id="">{{translate('English(EN)')}}</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link lang_link" href="#0" id="">{{translate('Arabic(AR)')}}</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link lang_link" href="#0" id="">{{translate('Spanish(ES)')}}</a>
                                            </li>
                                        </ul>
                                        <div class="row g-lg-3 g-3">
                                            <div class="col-md-6">
                                                <div class="mb-2 text-dark">{{translate('Title (EN)')}}
                                                    <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="{{translate('Services, what you deserve !')}}"
                                                    >info</i>
                                                </div>
                                                <textarea class="form-control block-size-initial" name="copyright_text" rows="1" placeholder="Services, what you deserve !" data-maxlength="50"></textarea>
                                                <div class="d-flex justify-content-end mt-1">
                                                    <span class="text-light-gray letter-count fz-12">20/50</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-2 text-dark">{{translate('Sub Title (EN)')}}
                                                    <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="{{translate('Order any service at any time from anywhere')}}"
                                                    >info</i>
                                                </div>
                                                <textarea class="form-control block-size-initial" name="copyright_text" rows="1" placeholder="Order any service at any time from anywhere" data-maxlength="50"></textarea>
                                                <div class="d-flex justify-content-end mt-1">
                                                    <span class="text-light-gray letter-count fz-12">0/50</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @can('landing_update')
                                        <div class="d-flex gap-2 justify-content-end">
                                            <button type="reset" class="btn btn--secondary rounded">
                                                {{translate('reset')}}
                                            </button>
                                            <button type="submit" class="btn btn--primary rounded">
                                                {{translate('Save')}}
                                            </button>
                                        </div>
                                    @endcan
                                </form>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body p-20">
                                <div class="mb-20">
                                    <h3 class="page-title mb-2">{{translate('Hero Section Image')}}</h3>
                                    <p>{{translate('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet ')}}</p>
                                </div>
                                <div class="body-bg rounded p-20 mb-20">
                                    <div class="row g-lg-4 g-3">
                                        <div class="col-md-6">
                                            <div class="card2 rounded-2 text-center h-100 p-20 mb-15 bg-white">
                                                <h5 class="fz-16 mb-1">Image 1</h5>
                                                <p class="fz-12">Upload your Image</p>
                                                <div class="custom-upload-wrapper upload-group border-dashed rounded-2 mx-auto max-w150 h-100px">
                                                    <input type="file" id="imageUpload_cus" accept="image/*" required>
                                                    <label for="imageUpload_cus" class="upload-box rounded position-relative d-flex align-items-center justify-content-center text-center overflow-hidden bg-white">
                                                        <div class="upload-content">
                                                            <span class="material-symbols-outlined placeholder-icon mb-1 text-primary">photo_camera</span>
                                                                <span class="fz-10 d-block">Add image</span>
                                                        </div>
                                                        <img class="image-preview" src="" alt="Preview" />
                                                        <div class="upload-overlay">
                                                            <span class="material-symbols-outlined">photo_camera</span>
                                                        </div>
                                                    </label>
                                                </div>
                                                <p class="fz-12 mt-2 text-center">JPG, JPEG, PNG, Gif Image size : Max 5 MB <span class="fw-medium text-dark">(300x200px)</span></p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card2 rounded-2 text-center h-100 p-20 mb-15 bg-white">
                                                <h5 class="fz-16 mb-1">Image 2</h5>
                                                <p class="fz-12">Upload your Image</p>
                                                <div class="custom-upload-wrapper upload-group border-dashed rounded-2 mx-auto max-w-200 h-100px">
                                                    <input type="file" id="imageUpload2_cus" accept="image/*" required>
                                                    <label for="imageUpload2_cus" class="upload-box rounded position-relative d-flex align-items-center justify-content-center text-center overflow-hidden bg-white">
                                                        <div class="upload-content">
                                                            <span class="material-symbols-outlined placeholder-icon mb-1 text-primary">photo_camera</span>
                                                                <span class="fz-10 d-block">Add image</span>
                                                        </div>
                                                        <img class="image-preview" src="" alt="Preview" />
                                                        <div class="upload-overlay">
                                                            <span class="material-symbols-outlined">photo_camera</span>
                                                        </div>
                                                    </label>
                                                </div>
                                                <p class="fz-12 mt-2 text-center">JPG, JPEG, PNG, Gif Image size : Max 5 MB <span class="fw-medium text-dark">(400x200px)</span></p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card2 rounded-2 text-center h-100 p-20 mb-15 bg-white">
                                                <h5 class="fz-16 mb-1">Image 3</h5>
                                                <p class="fz-12">Upload your Image</p>
                                                <div class="custom-upload-wrapper upload-group border-dashed rounded-2 mx-auto max-w150 h-100px">
                                                    <input type="file" id="imageUpload3_cus" accept="image/*" required>
                                                    <label for="imageUpload3_cus" class="upload-box rounded position-relative d-flex align-items-center justify-content-center text-center overflow-hidden bg-white">
                                                        <div class="upload-content">
                                                            <span class="material-symbols-outlined placeholder-icon mb-1 text-primary">photo_camera</span>
                                                                <span class="fz-10 d-block">Add image</span>
                                                        </div>
                                                        <img class="image-preview" src="" alt="Preview" />
                                                        <div class="upload-overlay">
                                                            <span class="material-symbols-outlined">photo_camera</span>
                                                        </div>
                                                    </label>
                                                </div>
                                                <p class="fz-12 mt-2 text-center">JPG, JPEG, PNG, Gif Image size : Max 5 MB <span class="fw-medium text-dark">(300x200px)</span></p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card2 rounded-2 text-center h-100 p-20 mb-15 bg-white">
                                                <h5 class="fz-16 mb-1">Image 4</h5>
                                                <p class="fz-12">Upload your Image</p>
                                                <div class="custom-upload-wrapper upload-group border-dashed rounded-2 mx-auto max-w150 h-100px">
                                                    <input type="file" id="imageUpload4_cus" accept="image/*" required>
                                                    <label for="imageUpload4_cus" class="upload-box rounded position-relative d-flex align-items-center justify-content-center text-center overflow-hidden bg-white">
                                                        <div class="upload-content">
                                                            <span class="material-symbols-outlined placeholder-icon mb-1 text-primary">photo_camera</span>
                                                                <span class="fz-10 d-block">Add image</span>
                                                        </div>
                                                        <img class="image-preview" src="" alt="Preview" />
                                                        <div class="upload-overlay">
                                                            <span class="material-symbols-outlined">photo_camera</span>
                                                        </div>
                                                    </label>
                                                </div>
                                                <p class="fz-12 mt-2 text-center">JPG, JPEG, PNG, Gif Image size : Max 5 MB <span class="fw-medium text-dark">(300x200px)</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex gap-2 justify-content-end">
                                    <button type="reset" class="btn btn--secondary rounded">
                                        {{translate('reset')}}
                                    </button>
                                    <button type="submit" class="btn btn--primary rounded">
                                        {{translate('Save')}}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Features Section -->
                    <div class="tab-pane fade " id="customer-custom-tabs2" role="tabpanel" aria-labelledby="customer-cus-tab2" tabindex="0">
                        <div class="card p-20 mb-20">
                            <div class="d-flex align-items-center justify-content-between flex-sm-nowrap flex-wrap gap-2">
                                <div>
                                    <h3 class="page-title mb-2">{{translate('Features Section')}}</h3>
                                    <p>{{translate('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet')}}</p>
                                </div>
                                <button type="button" class="rounded transition text-nowrap fz-12 fw-semibold btn-primary__outline btn d-flex align-items-center gap-1 py-2 px-3" data-bs-toggle="offcanvas" data-bs-target="#customer-feature-landing-page">
                                    <span class="material-symbols-outlined">visibility</span> Section Preview
                                </button>
                            </div>
                        </div>
                        <div class="card mb-20">
                            <div class="card-body p-20">
                                <div class="mb-20">
                                    <h3 class="page-title mb-2">{{translate('Feature Section Tittle')}}</h3>
                                    <p>{{translate('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet')}}</p>
                                </div>
                                <form action="javascript:void(0)" method="POST" id="landing-info-update-form">
                                    <div class="body-bg rounded p-20 discount-type lang-form default-form mb-20">
                                        <ul class="nav nav--tabs border-color-primary mb-4">
                                            <li class="nav-item">
                                                <a class="nav-link lang_link active" href="#" id="">{{translate('Default(EN)')}}</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link lang_link" href="#0" id="">{{translate('English(EN)')}}</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link lang_link" href="#0" id="">{{translate('Arabic(AR)')}}</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link lang_link" href="#0" id="">{{translate('Spanish(ES)')}}</a>
                                            </li>
                                        </ul>
                                        <div class="row g-lg-3 g-3">
                                            <div class="col-md-12">
                                                <div class="mb-2 text-dark">{{translate('Title (EN)')}}
                                                    <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="{{translate('Easiest , Fastest & Trustworthy Place to get a service')}}"
                                                    >info</i>
                                                </div>
                                                <textarea class="form-control block-size-initial" name="copyright_text" rows="1" placeholder="Easiest , Fastest & Trustworthy Place to get a service" data-maxlength="50"></textarea>
                                                <div class="d-flex justify-content-end mt-1">
                                                    <span class="text-light-gray letter-count fz-12">20/50</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex gap-2 justify-content-end">
                                        <button type="reset" class="btn btn--secondary rounded">
                                            {{translate('reset')}}
                                        </button>
                                        <button type="submit" class="btn btn--primary rounded">
                                            {{translate('Save')}}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card mb-20">
                            <div class="border-bottom p-20">
                                <h3 class="page-title mb-2">{{translate('Feature Section Setup')}}</h3>
                                <p>{{translate('Here you setup your all business information.')}}</p>
                            </div>
                            <div class="card-body p-20">
                                <form action="javascript:void(0)" method="POST" id="landing-info-update-form">
                                    <div class="d-center body-bg rounded-2 text-center p-20 mb-20">
                                        <div class="boxes py-2">
                                            <h5 class="fz-16 mb-1">Feature Image</h5>
                                            <p class="fz-12">Upload your feature section image</p>
                                            <div class="custom-upload-wrapper upload-group border-dashed rounded-2 mx-auto w-100px h-100px">
                                                <input type="file" id="imageUpload8_cus" accept="image/*" required>
                                                <label for="imageUpload8_cus" class="upload-box rounded position-relative d-flex align-items-center justify-content-center text-center overflow-hidden bg-white">
                                                    <div class="upload-content">
                                                        <span class="material-symbols-outlined placeholder-icon mb-1 text-primary">photo_camera</span>
                                                            <span class="fz-10 d-block">Add image</span>
                                                    </div>
                                                    <img class="image-preview" src="" alt="Preview" />
                                                    <div class="upload-overlay">
                                                        <span class="material-symbols-outlined">photo_camera</span>
                                                    </div>
                                                </label>
                                            </div>
                                            <p class="fz-12 mt-2 text-center">JPG, JPEG, PNG, Gif Image size : Max 5 MB <span class="fw-medium text-dark">(1:1)</span></p>
                                        </div>
                                    </div>
                                    <div class="cus-shadow rounded-2 p-20 bg-white mb-20">
                                        <h3 class="page-title mb-20">{{translate('Content 1')}}</h3>
                                        <div class="body-bg rounded p-20 discount-type lang-form default-form">
                                            <ul class="nav nav--tabs border-color-primary mb-4">
                                                <li class="nav-item">
                                                    <a class="nav-link lang_link active" href="#" id="">{{translate('Default(EN)')}}</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link lang_link" href="#0" id="">{{translate('English(EN)')}}</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link lang_link" href="#0" id="">{{translate('Arabic(AR)')}}</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link lang_link" href="#0" id="">{{translate('Spanish(ES)')}}</a>
                                                </li>
                                            </ul>
                                            <div class="row g-lg-3 g-3">
                                                <div class="col-md-6">
                                                    <div class="mb-2 text-dark d-flex align-items-center gap-1">{{translate('Title (EN)')}}
                                                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                            data-bs-placement="top"
                                                            title="{{translate('Easiest , Fastest & Trustworthy Place to get a service')}}"
                                                        >info</i>
                                                    </div>
                                                    <textarea class="form-control block-size-initial" name="copyright_text" rows="2" placeholder="Select Your Location" data-maxlength="50"></textarea>
                                                    <div class="d-flex justify-content-end mt-1">
                                                        <span class="text-light-gray letter-count fz-12">20/50</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-2 text-dark d-flex align-items-center gap-1">{{translate('Short Description (EN)')}}
                                                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                            data-bs-placement="top"
                                                            title="{{translate('Short Description,,,,,,,,,,,,,,,')}}"
                                                        >info</i>
                                                    </div>
                                                    <textarea class="form-control block-size-initial" name="copyright_text" rows="2" placeholder="Choose the location where you want to take the service from. It helps to see service providers around your preferred location." data-maxlength="50"></textarea>
                                                    <div class="d-flex justify-content-end mt-1">
                                                        <span class="text-light-gray letter-count fz-12">20/50</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cus-shadow rounded-2 p-20 bg-white mb-20">
                                        <h3 class="page-title mb-20">{{translate('Content 2')}}</h3>
                                        <div class="body-bg rounded p-20 discount-type lang-form default-form">
                                            <ul class="nav nav--tabs border-color-primary mb-4">
                                                <li class="nav-item">
                                                    <a class="nav-link lang_link active" href="#" id="">{{translate('Default(EN)')}}</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link lang_link" href="#0" id="">{{translate('English(EN)')}}</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link lang_link" href="#0" id="">{{translate('Arabic(AR)')}}</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link lang_link" href="#0" id="">{{translate('Spanish(ES)')}}</a>
                                                </li>
                                            </ul>
                                            <div class="row g-lg-3 g-3">
                                                <div class="col-md-6">
                                                    <div class="mb-2 text-dark d-flex align-items-center gap-1">{{translate('Title (EN)')}}
                                                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                            data-bs-placement="top"
                                                            title="{{translate('Easiest , Fastest & Trustworthy Place to get a service')}}"
                                                        >info</i>
                                                    </div>
                                                    <textarea class="form-control block-size-initial" name="copyright_text" rows="2" placeholder="Select Your Location" data-maxlength="50"></textarea>
                                                    <div class="d-flex justify-content-end mt-1">
                                                        <span class="text-light-gray letter-count fz-12">20/50</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-2 text-dark d-flex align-items-center gap-1">{{translate('Short Description (EN)')}}
                                                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                            data-bs-placement="top"
                                                            title="{{translate('Short Description,,,,,,,,,,,,,,,')}}"
                                                        >info</i>
                                                    </div>
                                                    <textarea class="form-control block-size-initial" name="copyright_text" rows="2" placeholder="Choose the location where you want to take the service from. It helps to see service providers around your preferred location." data-maxlength="50"></textarea>
                                                    <div class="d-flex justify-content-end mt-1">
                                                        <span class="text-light-gray letter-count fz-12">20/50</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cus-shadow rounded-2 p-20 bg-white mb-20">
                                        <h3 class="page-title mb-20">{{translate('Content 3')}}</h3>
                                        <div class="body-bg rounded p-20 discount-type lang-form default-form">
                                            <ul class="nav nav--tabs border-color-primary mb-4">
                                                <li class="nav-item">
                                                    <a class="nav-link lang_link active" href="#" id="">{{translate('Default(EN)')}}</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link lang_link" href="#0" id="">{{translate('English(EN)')}}</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link lang_link" href="#0" id="">{{translate('Arabic(AR)')}}</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link lang_link" href="#0" id="">{{translate('Spanish(ES)')}}</a>
                                                </li>
                                            </ul>
                                            <div class="row g-lg-3 g-3">
                                                <div class="col-md-6">
                                                    <div class="mb-2 text-dark d-flex align-items-center gap-1">{{translate('Title (EN)')}}
                                                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                            data-bs-placement="top"
                                                            title="{{translate('Easiest , Fastest & Trustworthy Place to get a service')}}"
                                                        >info</i>
                                                    </div>
                                                    <textarea class="form-control block-size-initial" name="copyright_text" rows="2" placeholder="Select Your Location" data-maxlength="50"></textarea>
                                                    <div class="d-flex justify-content-end mt-1">
                                                        <span class="text-light-gray letter-count fz-12">20/50</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-2 text-dark d-flex align-items-center gap-1">{{translate('Short Description (EN)')}}
                                                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                            data-bs-placement="top"
                                                            title="{{translate('Short Description,,,,,,,,,,,,,,,')}}"
                                                        >info</i>
                                                    </div>
                                                    <textarea class="form-control block-size-initial" name="copyright_text" rows="2" placeholder="Choose the location where you want to take the service from. It helps to see service providers around your preferred location." data-maxlength="50"></textarea>
                                                    <div class="d-flex justify-content-end mt-1">
                                                        <span class="text-light-gray letter-count fz-12">20/50</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex gap-2 justify-content-end">
                                        <button type="reset" class="btn btn--secondary rounded">
                                            {{translate('reset')}}
                                        </button>
                                        <button type="submit" class="btn btn--primary rounded">
                                            {{translate('Save')}}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Testimonial Section -->
                    <div class="tab-pane fade" id="customer-custom-tabs3" role="tabpanel" aria-labelledby="customer-cus-tab3" tabindex="0">
                        <div class="card p-20 mb-20">
                            <div class="d-flex align-items-center justify-content-between flex-sm-nowrap flex-wrap gap-2">
                                <div>
                                    <h3 class="page-title mb-2">{{translate('Testimonials Section')}}</h3>
                                    <p>{{translate('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet')}}</p>
                                </div>
                                <button type="button" class="rounded transition text-nowrap fz-12 fw-semibold btn-primary__outline btn d-flex align-items-center gap-1 py-2 px-3" data-bs-toggle="offcanvas" data-bs-target="#customer-testimonial-landing-page">
                                    <span class="material-symbols-outlined">visibility</span> Section Preview
                                </button>
                            </div>
                        </div>
                        <div class="card mb-20">
                            <div class="card-body p-20">
                                <div class="mb-20">
                                    <h3 class="page-title mb-2">{{translate('Testimonials Content')}}</h3>
                                    <p>{{translate('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet ')}}</p>
                                </div>
                                <form action="javascript:void(0)" method="POST" id="landing-info-update-form">
                                    <div class="body-bg rounded p-20 discount-type lang-form default-form mb-20">
                                        <ul class="nav nav--tabs border-color-primary mb-4">
                                            <li class="nav-item">
                                                <a class="nav-link lang_link active" href="#" id="">{{translate('Default(EN)')}}</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link lang_link" href="#0" id="">{{translate('English(EN)')}}</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link lang_link" href="#0" id="">{{translate('Arabic(AR)')}}</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link lang_link" href="#0" id="">{{translate('Spanish(ES)')}}</a>
                                            </li>
                                        </ul>
                                        <div class="row g-lg-3 g-3">
                                            <div class="col-md-12">
                                                <div class="mb-2 text-dark">{{translate('Title (EN)')}}
                                                    <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="{{translate('Happy Customers , Happy stories')}}"
                                                    >info</i>
                                                </div>
                                                <textarea class="form-control block-size-initial" name="copyright_text" rows="1" placeholder="Happy Customers , Happy stories" data-maxlength="50"></textarea>
                                                <div class="d-flex justify-content-end mt-1">
                                                    <span class="text-light-gray letter-count fz-12">20/50</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex gap-2 justify-content-end">
                                        <button type="reset" class="btn btn--secondary rounded">
                                            {{translate('reset')}}
                                        </button>
                                        <button type="submit" class="btn btn--primary rounded">
                                            {{translate('Save')}}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="card">
                            <div class="border-bottom p-20">
                                <h3 class="page-title mb-2">{{translate('Add Testimonial')}}</h3>
                                <p>{{translate('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet ')}}</p>
                            </div>
                            <div class="card-body p-20">
                                <div class="cus-shadow p-20 rounded mb-20">
                                    <form action="javascript:void(0)" method="POST" id="landing-info-update-form">
                                        <div class="row g-xl-4 g-3 mb-20">
                                            <div class="col-lg-8">
                                                <div class="body-bg rounded p-20 discount-type lang-form default-form">
                                                    <ul class="nav nav--tabs border-color-primary mb-4">
                                                        <li class="nav-item">
                                                            <a class="nav-link lang_link active" href="#" id="">{{translate('Default(EN)')}}</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link lang_link" href="#0" id="">{{translate('English(EN)')}}</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link lang_link" href="#0" id="">{{translate('Arabic(AR)')}}</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link lang_link" href="#0" id="">{{translate('Spanish(ES)')}}</a>
                                                        </li>
                                                    </ul>
                                                    <div class="row g-lg-3 g-3">
                                                        <div class="col-md-6">
                                                            <div class="mb-2 text-dark">{{translate('Reviewer Name (EN)')}}
                                                                <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    title="{{translate('Review (EN)')}}"
                                                                >info</i>
                                                            </div>
                                                            <input type="text" class="form-control" name="" placeholder="{{translate('Darrell Steward')}}" required="" value="">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-2 text-dark">{{translate('Designation (EN)')}}
                                                                <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    title="{{translate('Designaion Here')}}"
                                                                >info</i>
                                                            </div>
                                                            <input type="text" class="form-control" name="" placeholder="{{translate('Marketing Coordinator')}}" required="" value="">
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="mb-2 text-dark">{{translate('Review (EN)')}}
                                                                <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    title="{{translate('Review (EN)')}}"
                                                                >info</i>
                                                            </div>
                                                            <textarea class="form-control block-size-initial" name="copyright_text" rows="2" placeholder="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet Lorem ipsum " data-maxlength="200"></textarea>
                                                            <div class="d-flex justify-content-end mt-1">
                                                                <span class="text-light-gray letter-count fz-12">120/200</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="body-bg d-center rounded-2 text-center h-100 p-20">
                                                    <div class="boxes">
                                                        <h5 class="fz-16 mb-1">Reviewer Image</h5>
                                                        <p class="fz-12">Upload Reviewer Image</p>
                                                        <div class="custom-upload-wrapper upload-group border-dashed rounded-2 mx-auto w-100px h-100px">
                                                            <input type="file" id="imageUpload13_cus" accept="image/*" required>
                                                            <label for="imageUpload13_cus" class="upload-box rounded position-relative d-flex align-items-center justify-content-center text-center overflow-hidden bg-white">
                                                                <div class="upload-content">
                                                                    <span class="material-symbols-outlined placeholder-icon mb-1 text-primary">photo_camera</span>
                                                                        <span class="fz-10 d-block">Add image</span>
                                                                </div>
                                                                <img class="image-preview" src="" alt="Preview" />
                                                                <div class="upload-overlay">
                                                                    <span class="material-symbols-outlined">photo_camera</span>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <p class="fz-12 mt-2 text-center">JPG, JPEG, PNG, Gif Image size : Max 5 MB <span class="fw-medium text-dark">(1:1)</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex gap-2 justify-content-end">
                                            <button type="reset" class="btn btn--secondary rounded">
                                                {{translate('reset')}}
                                            </button>
                                            <button type="button" class="btn btn--primary rounded">
                                                {{translate('Add')}}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="cus-shadow p-20 rounded">
                                    <div class="data-table-top d-flex align-items-center flex-wrap gap-10 justify-content-between">
                                        <h4>Testimonial list</h4>
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
                                    <div class="table-responsive table-custom-responsive">
                                        <table id="example" class="table align-middle">
                                            <thead class="text-nowrap">
                                                <tr>
                                                    <th class="text-dark fw-medium bg-light">{{translate('Sl')}}</th>
                                                    <th class="text-dark fw-medium bg-light">{{translate('Reviewer Image')}}</th>
                                                    <th class="text-dark fw-medium bg-light">{{translate('Designation')}}</th>
                                                    <th class="text-dark fw-medium bg-light">{{translate('Review')}}</th>
                                                    <th class="text-dark fw-medium bg-light">{{translate('status')}}</th>
                                                    <th class="text-dark fw-medium bg-light">{{translate('action')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>
                                                        <img src="{{asset('public/assets/admin-module')}}/img/reviewer-author1.png" alt="" class="table-cover-img">
                                                    </td>
                                                    <td><span class="text-dark">Customer</span></td>
                                                    <td class="max-w-400">
                                                        <span class="text-dark max-w-400 d-block">Lorem ipsum dolor sit amet, consectetur adipiscing elit.  odio tellus, laoreet Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam</span>
                                                    </td>
                                                    <td>
                                                        <label class="switcher">
                                                            <input class="switcher_input" type="checkbox" checked="">
                                                            <span class="switcher_control"></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex gap-2">
                                                            <a href="#" class="action-btn btn--light-primary" data-bs-toggle="offcanvas" data-bs-target="#customer-testimonial-landing-edit">
                                                                <span class="material-icons">edit</span>
                                                            </a>
                                                            <button type="button" class="action-btn btn--danger delete_section">
                                                                <span class="material-icons">delete</span>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>
                                                        <img src="{{asset('public/assets/admin-module')}}/img/reviewer-author2.png" alt="" class="table-cover-img">
                                                    </td>
                                                    <td><span class="text-dark">Customer</span></td>
                                                    <td class="max-w-400">
                                                        <span class="text-dark max-w-400 d-block">Lorem ipsum dolor sit amet, consectetur adipiscing elit.  odio tellus, laoreet Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam</span>
                                                    </td>
                                                    <td>
                                                        <label class="switcher">
                                                            <input class="switcher_input" type="checkbox" checked="">
                                                            <span class="switcher_control"></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex gap-2">
                                                            <a href="#" class="action-btn btn--light-primary" data-bs-toggle="offcanvas" data-bs-target="#customer-testimonial-landing-edit">
                                                                <span class="material-icons">edit</span>
                                                            </a>
                                                            <button type="button" class="action-btn btn--danger delete_section">
                                                                <span class="material-icons">delete</span>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>
                                                        <img src="{{asset('public/assets/admin-module')}}/img/reviewer-author3.png" alt="" class="table-cover-img">
                                                    </td>
                                                    <td><span class="text-dark">Customer</span></td>
                                                    <td class="max-w-400">
                                                        <span class="text-dark max-w-400 d-block">Lorem ipsum dolor sit amet, consectetur adipiscing elit.  odio tellus, laoreet Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam</span>
                                                    </td>
                                                    <td>
                                                        <label class="switcher">
                                                            <input class="switcher_input" type="checkbox" checked="">
                                                            <span class="switcher_control"></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex gap-2">
                                                            <a href="#" class="action-btn btn--light-primary" data-bs-toggle="offcanvas" data-bs-target="#customer-testimonial-landing-edit">
                                                                <span class="material-icons">edit</span>
                                                            </a>
                                                            <button type="button" class="action-btn btn--danger delete_section">
                                                                <span class="material-icons">delete</span>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td>
                                                        <img src="{{asset('public/assets/admin-module')}}/img/reviewer-author4.png" alt="" class="table-cover-img">
                                                    </td>
                                                    <td><span class="text-dark">Customer</span></td>
                                                    <td class="max-w-400">
                                                        <span class="text-dark max-w-400 d-block">Lorem ipsum dolor sit amet, consectetur adipiscing elit.  odio tellus, laoreet Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam</span>
                                                    </td>
                                                    <td>
                                                        <label class="switcher">
                                                            <input class="switcher_input" type="checkbox" checked="">
                                                            <span class="switcher_control"></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex gap-2">
                                                            <a href="#" class="action-btn btn--light-primary" data-bs-toggle="offcanvas" data-bs-target="#customer-testimonial-landing-edit">
                                                                <span class="material-icons">edit</span>
                                                            </a>
                                                            <button type="button" class="action-btn btn--danger delete_section">
                                                                <span class="material-icons">delete</span>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Download Section -->
                    <div class="tab-pane fade" id="customer-custom-tabs4" role="tabpanel" aria-labelledby="customer-cus-tab4" tabindex="0">
                        <div class="card p-20 mb-20">
                            <div class="d-flex align-items-center justify-content-between flex-sm-nowrap flex-wrap gap-2">
                                <div>
                                    <h3 class="page-title mb-2">{{translate('Download Section')}}</h3>
                                    <p>{{translate('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet ')}}</p>
                                </div>
                                <button type="button" class="rounded transition text-nowrap fz-12 fw-semibold btn-primary__outline btn d-flex align-items-center gap-1 py-2 px-3" data-bs-toggle="offcanvas" data-bs-target="#downloads-landing-page">
                                    <span class="material-symbols-outlined">visibility</span> Section Preview
                                </button>
                            </div>
                        </div>
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
                            <p class="fz-12">To setup the Download Sections buttons and links go to  <a href="#" class="text-primary fw-medium text-decoration-underline">Button & Links .</a></p>
                        </div>
                        <div class="card mb-20">
                            <div class="card-body p-20">
                                <div class="mb-20">
                                    <h3 class="page-title mb-2">{{translate('Download Section Setup')}}</h3>
                                    <p>{{translate('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet ')}}</p>
                                </div>
                                <form action="javascript:void(0)" method="POST" id="landing-info-update-form">
                                    <div class="row g-xl-4 g-3 mb-20">
                                        <div class="col-lg-8">
                                            <div class="body-bg rounded p-20 discount-type lang-form default-form">
                                                <ul class="nav nav--tabs border-color-primary mb-4">
                                                    <li class="nav-item">
                                                        <a class="nav-link lang_link active" href="#" id="">{{translate('Default(EN)')}}</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link lang_link" href="#0" id="">{{translate('English(EN)')}}</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link lang_link" href="#0" id="">{{translate('Arabic(AR)')}}</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link lang_link" href="#0" id="">{{translate('Spanish(ES)')}}</a>
                                                    </li>
                                                </ul>
                                                <div class="row g-lg-3 g-3">
                                                    <div class="col-md-12">
                                                        <div class="mb-2 text-dark">{{translate('Title (EN)')}}
                                                            <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                                data-bs-placement="top"
                                                                title="{{translate('Download Our Apps')}}"
                                                            >info</i>
                                                        </div>
                                                        <textarea class="form-control block-size-initial" name="copyright_text" rows="1" placeholder="Download Our Apps" data-maxlength="100"></textarea>
                                                        <div class="d-flex justify-content-end mt-1">
                                                            <span class="text-light-gray letter-count fz-12">30/100</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="mb-2 text-dark">{{translate('Sub Title (EN)')}}
                                                            <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                                data-bs-placement="top"
                                                                title="{{translate('Largest Booking Service Platform')}}"
                                                            >info</i>
                                                        </div>
                                                        <textarea class="form-control block-size-initial" name="copyright_text" rows="1" placeholder="Download user app & provider appfrom google play store & app store." data-maxlength="160"></textarea>
                                                        <div class="d-flex justify-content-end mt-1">
                                                            <span class="text-light-gray letter-count fz-12">80/160</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="body-bg d-center rounded-2 text-center h-100 p-20">
                                                <div class="boxes">
                                                    <h5 class="fz-16 mb-1">Upload About Us Image</h5>
                                                    <p class="fz-12">Upload your About Us Image</p>
                                                    <div class="custom-upload-wrapper upload-group border-dashed rounded-2 mx-auto w-100px h-100px">
                                                        <input type="file" id="imageUpload5_cus" accept="image/*" required>
                                                        <label for="imageUpload5_cus" class="upload-box rounded position-relative d-flex align-items-center justify-content-center text-center overflow-hidden bg-white">
                                                            <div class="upload-content">
                                                                <span class="material-symbols-outlined placeholder-icon mb-1 text-primary">photo_camera</span>
                                                                    <span class="fz-10 d-block">Add image</span>
                                                            </div>
                                                            <img class="image-preview" src="" alt="Preview" />
                                                            <div class="upload-overlay">
                                                                <span class="material-symbols-outlined">photo_camera</span>
                                                            </div>
                                                        </label>
                                                    </div>
                                                    <p class="fz-12 mt-2 text-center">JPG, JPEG, PNG, Gif Image size : Max 5 MB <span class="fw-medium text-dark">(1:1)</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @can('landing_update')
                                        <div class="d-flex gap-2 justify-content-end">
                                            <button type="reset" class="btn btn--secondary rounded">
                                                {{translate('reset')}}
                                            </button>
                                            <button type="submit" class="btn btn--primary rounded">
                                                {{translate('Save')}}
                                            </button>
                                        </div>
                                    @endcan
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Support Section -->
                    <div class="tab-pane fade " id="customer-custom-tabs5" role="tabpanel" aria-labelledby="customer-cus-tab5" tabindex="0">
                        <div class="card p-20 mb-20">
                            <div class="d-flex align-items-center justify-content-between flex-sm-nowrap flex-wrap gap-2">
                                <div>
                                    <h3 class="page-title mb-2">{{translate('Support  Section')}}</h3>
                                    <p>{{translate('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet ')}}</p>
                                </div>
                                <button type="button" class="rounded transition text-nowrap fz-12 fw-semibold btn-primary__outline btn d-flex align-items-center gap-1 py-2 px-3" data-bs-toggle="offcanvas" data-bs-target="#customer-support-landing-page">
                                    <span class="material-symbols-outlined">visibility</span> Section Preview
                                </button>
                            </div>
                        </div>
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
                            <p class="fz-12">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet </a></p>
                        </div>
                        <div class="card mb-20">
                            <div class="card-body p-20">
                                <div class="mb-20">
                                    <h3 class="page-title mb-2">{{translate('Support Section Setup')}}</h3>
                                    <p>{{translate('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet ')}}</p>
                                </div>
                                <form action="javascript:void(0)" method="POST" id="landing-info-update-form">
                                    <div class="row g-xl-4 g-3 mb-20">
                                        <div class="col-lg-8">
                                            <div class="body-bg rounded p-20 discount-type lang-form default-form h-100">
                                                <ul class="nav nav--tabs border-color-primary mb-4">
                                                    <li class="nav-item">
                                                        <a class="nav-link lang_link active" href="#" id="">{{translate('Default(EN)')}}</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link lang_link" href="#0" id="">{{translate('English(EN)')}}</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link lang_link" href="#0" id="">{{translate('Arabic(AR)')}}</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link lang_link" href="#0" id="">{{translate('Spanish(ES)')}}</a>
                                                    </li>
                                                </ul>
                                                <div class="row g-lg-3 g-3">
                                                    <div class="col-md-12">
                                                        <div class="mb-2 text-dark">{{translate('Title (EN)')}}
                                                            <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                                data-bs-placement="top"
                                                                title="{{translate('Contact us Any time, We are 24/7 Available')}}"
                                                            >info</i>
                                                        </div>
                                                        <textarea class="form-control block-size-initial" name="copyright_text" rows="1" placeholder="Contact us Any time, We are 24/7 Available" data-maxlength="100"></textarea>
                                                        <div class="d-flex justify-content-end mt-1">
                                                            <span class="text-light-gray letter-count fz-12">30/100</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="body-bg d-center rounded-2 text-center h-100 p-20">
                                                <div class="boxes">
                                                    <h5 class="fz-16 mb-1">Upload Image</h5>
                                                    <p class="fz-12">Upload your Download Section Image</p>
                                                    <div class="custom-upload-wrapper upload-group border-dashed rounded-2 mx-auto w-100px h-100px">
                                                        <input type="file" id="imageUpload18_cus" accept="image/*" required>
                                                        <label for="imageUpload18_cus" class="upload-box rounded position-relative d-flex align-items-center justify-content-center text-center overflow-hidden bg-white">
                                                            <div class="upload-content">
                                                                <span class="material-symbols-outlined placeholder-icon mb-1 text-primary">photo_camera</span>
                                                                    <span class="fz-10 d-block">Add image</span>
                                                            </div>
                                                            <img class="image-preview" src="" alt="Preview" />
                                                            <div class="upload-overlay">
                                                                <span class="material-symbols-outlined">photo_camera</span>
                                                            </div>
                                                        </label>
                                                    </div>
                                                    <p class="fz-12 mt-2 text-center">JPG, JPEG, PNG, Gif Image size : Max 5 MB <span class="fw-medium text-dark">(1:1)</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @can('landing_update')
                                        <div class="d-flex gap-2 justify-content-end">
                                            <button type="reset" class="btn btn--secondary rounded">
                                                {{translate('reset')}}
                                            </button>
                                            <button type="submit" class="btn btn--primary rounded">
                                                {{translate('Save')}}
                                            </button>
                                        </div>
                                    @endcan
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Button & Links -->
                    <div class="tab-pane fade" id="customer-custom-tabs6" role="tabpanel" aria-labelledby="customer-cus-tab6" tabindex="0">
                        <div class="card">
                            <div class="border-bottom p-20">
                                <h3 class="page-title mb-2">{{translate('Button & Links')}}</h3>
                                <p>{{translate('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet')}}</p>
                            </div>
                            <div class="card-body p-20">
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
                                    <p class="fz-12">The button with an active status will be shown in the hero section & Footer.</p>
                                </div>
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <div class="body-bg rounded p-20">
                                            @php($value=$dataValues->where('key_name','app_url_playstore')->first()->is_active??0)
                                            <div class="d-flex align-items-center justify-content-between gap-2 mb-2">
                                                <div class="mb-2 text-dark">{{translate('App url (Play store)')}}
                                                    <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="{{translate('App url (Play store)')}}"
                                                    >info</i>
                                                </div>
                                                <label class="switcher">
                                                    <input class="switcher_input" type="checkbox"
                                                            name="app_url_playstore_is_active"
                                                            {{$value?'checked':''}}
                                                            value="1">
                                                    <span class="switcher_control"></span>
                                                </label>
                                            </div>
                                            <div class="">
                                                <div class="form-business">
                                                    <input type="text" class="form-control"
                                                            name="app_url_playstore"
                                                            value="{{$dataValues->where('key_name','app_url_playstore')->first()->live_values??''}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="body-bg rounded p-20">
                                            @php($value=$dataValues->where('key_name','app_url_appstore')->first()->is_active??0)
                                            <div class="d-flex align-items-center justify-content-between gap-2 mb-2">
                                                <div class="mb-2 text-dark">{{translate('App url (Play store)')}}
                                                    <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="{{translate('App url (Play store)')}}"
                                                    >info</i>
                                                </div>
                                                <label class="switcher">
                                                    <input class="switcher_input" type="checkbox"
                                                            name="app_url_appstore_is_active"
                                                            {{$value?'checked':''}}
                                                            value="1">
                                                    <span class="switcher_control"></span>
                                                </label>
                                            </div>
                                            <div class="">
                                                <div class="form-business">
                                                    <input type="text" class="form-control"
                                                            name="app_url_appstore"
                                                            value="{{$dataValues->where('key_name','app_url_appstore')->first()->live_values??''}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @can('landing_update')
                                    <div class="d-flex gap-2 justify-content-end mt-3">
                                        <button type="reset" class="btn btn--secondary rounded">
                                            {{translate('reset')}}
                                        </button>
                                        <button type="submit" class="btn btn--primary rounded">
                                            {{translate('Submit')}}
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
</div>

<!--Customer Offcanvs Here-->
<!-- Testimonial Offcanvas -->
<form action="" method="post" id="update-form-submit">
    @csrf
    <div class="offcanvas offcanvas-end offcanvas-cus-xl" tabindex="-1" id="customer-landing-page" aria-labelledby="testimonial-landing-pageLabel">
        <div class="offcanvas-header py-md-4 py-3">
            <h2 class="mb-0">Hero Section Preview</h2>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body bg-white">
            <div class="hero-preview-thumb px-md-5 px-0 py-md-4 py-1">
                <img src="{{asset('public/assets/admin-module')}}/img/customer-hero-preview.png" alt="img" class="w-100">
            </div>
        </div>
    </div>
</form>
<!-- Feature Offcanvas -->
<form action="" method="post" id="update-form-submit">
    @csrf
    <div class="offcanvas offcanvas-end offcanvas-cus-xl" tabindex="-1" id="customer-feature-landing-page" aria-labelledby="customer-feature-landing-pageLabel">
        <div class="offcanvas-header py-md-4 py-3">
            <h2 class="mb-0">Feature Section Preview</h2>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body bg-white">
            <div class="hero-preview-thumb px-md-5 px-0 py-md-4 py-1">
                <img src="{{asset('public/assets/admin-module')}}/img/customer-feature-preview.png" alt="img" class="w-100">
            </div>
        </div>
    </div>
</form>
<!-- Testimonial Offcanvas -->
<form action="" method="post" id="update-form-submit">
    @csrf
    <div class="offcanvas offcanvas-end offcanvas-cus-xl" tabindex="-1" id="customer-testimonial-landing-page" aria-labelledby="customer-feature-landing-pageLabel">
        <div class="offcanvas-header py-md-4 py-3">
            <h2 class="mb-0">Testimonials Section Preview</h2>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body bg-white">
            <div class="hero-preview-thumb px-md-5 px-0 py-md-4 py-1">
                <img src="{{asset('public/assets/admin-module')}}/img/customer-testimonial-preview.png" alt="img" class="w-100">
            </div>
        </div>
    </div>
</form>
<!-- Testimonial Edit Offcanvas -->
<form action="" method="post" id="update-form-submit">
    @csrf
    <div class="offcanvas offcanvas-end offcanvas-cus-sm" tabindex="-1" id="customer-testimonial-landing-edit" aria-labelledby="customer-testimonial-landingLabel">
        <div class="offcanvas-header py-md-4 py-3">
            <h2 class="mb-0">Edit Testimonial</h2>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body bg-white">
            <div class="body-bg rounded p-20 discount-type lang-form default-form mb-20">
                <ul class="nav nav--tabs border-color-primary mb-4">
                    <li class="nav-item">
                        <a class="nav-link lang_link active" href="#" id="">{{translate('Default(EN)')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link lang_link" href="#0" id="">{{translate('English(EN)')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link lang_link" href="#0" id="">{{translate('Arabic(AR)')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link lang_link" href="#0" id="">{{translate('Spanish(ES)')}}</a>
                    </li>
                </ul>
                <div class="row g-lg-4 g-3">
                    <div class="col-md-12">
                        <div class="mb-2 text-dark">{{translate('Reviewer Name (EN)')}}
                            <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                title="{{translate('Review (EN)')}}"
                            >info</i>
                        </div>
                        <input type="text" class="form-control" name="" placeholder="{{translate('Darrell Steward')}}" required="" value="">
                    </div>
                    <div class="col-md-12">
                        <div class="mb-2 text-dark">{{translate('Designation (EN)')}}
                            <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                title="{{translate('Designaion Here')}}"
                            >info</i>
                        </div>
                        <input type="text" class="form-control" name="" placeholder="{{translate('Medical Assistant')}}" required="" value="">
                    </div>
                    <div class="col-md-12">
                        <div class="mb-2 text-dark">{{translate('Review (EN)')}}
                            <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                title="{{translate('Review (EN)')}}"
                            >info</i>
                        </div>
                        <textarea class="form-control block-size-initial" name="copyright_text" rows="4" placeholder="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet Lorem ipsum " data-maxlength="200"></textarea>
                        <div class="d-flex justify-content-end mt-1">
                            <span class="text-light-gray letter-count fz-12">120/200</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="body-bg d-center rounded-2 text-center p-20">
                <div class="boxes">
                    <h5 class="fz-16 mb-1">Reviewer Image</h5>
                    <p class="fz-12">Upload Reviewer Image</p>
                    <div class="custom-upload-wrapper upload-group border-dashed rounded-2 mx-auto w-100px h-100px">
                        <input type="file" id="imageUpload14_cus" accept="image/*" required>
                        <label for="imageUpload14_cus" class="upload-box rounded position-relative d-flex align-items-center justify-content-center text-center overflow-hidden bg-white">
                            <div class="upload-content">
                                <span class="material-symbols-outlined placeholder-icon mb-1 text-primary">photo_camera</span>
                                    <span class="fz-10 d-block">Add image</span>
                            </div>
                            <img class="image-preview" src="" alt="Preview" />
                            <div class="upload-overlay">
                                <span class="material-symbols-outlined">photo_camera</span>
                            </div>
                        </label>
                    </div>
                    <p class="fz-12 mt-2 text-center">JPG, JPEG, PNG, Gif Image size : Max 5 MB <span class="fw-medium text-dark">(1:1)</span></p>
                </div>
            </div>
        </div>
        <div class="offcanvas-footer border-top">
            <div class="d-flex justify-content-center gap-2 bg-white px-3 py-sm-3 py-2">
                <button class="btn btn--secondary w-100 rounded h-45" type="reset">{{translate('Reset')}}</button>
                <button class="btn btn--primary w-100 rounded h-45" type="submit">{{translate('Update')}}</button>
            </div>
        </div>
    </div>
</form>
<!-- Download Offcanvas -->
<form action="" method="post" id="update-form-submit">
    @csrf
    <div class="offcanvas offcanvas-end offcanvas-cus-xl" tabindex="-1" id="downloads-landing-page" aria-labelledby="customer-feature-landing-pageLabel">
        <div class="offcanvas-header py-md-4 py-3">
            <h2 class="mb-0">Download Section Preview</h2>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body bg-white">
            <div class="hero-preview-thumb px-md-5 px-0 py-md-4 py-1">
                <img src="{{asset('public/assets/admin-module')}}/img/customer-download-preview.png" alt="img" class="w-100">
            </div>
        </div>
    </div>
</form>
<!-- Support Offcanvas -->
<form action="" method="post" id="update-form-submit">
    @csrf
    <div class="offcanvas offcanvas-end offcanvas-cus-xl" tabindex="-1" id="customer-support-landing-page" aria-labelledby="customer-support-landing-pageLabel">
        <div class="offcanvas-header py-md-4 py-3">
            <h2 class="mb-0">Support Section Preview</h2>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body bg-white">
            <div class="hero-preview-thumb px-md-5 px-0 py-md-4 py-1">
                <img src="{{asset('public/assets/admin-module')}}/img/customer-support-preview.png" alt="img" class="w-100">
            </div>
        </div>
    </div>
</form>


@endsection






@push('script')
    <script src="{{asset('public/assets/admin-module')}}/plugins/select2/select2.min.js"></script>
    <script>
        "use strict";

        $(document).ready(function () {
            $('.js-select').select2();
        });
    </script>
    <script src="{{asset('public/assets/admin-module')}}/plugins/dataTables/jquery.dataTables.min.js"></script>
    <script src="{{asset('public/assets/admin-module')}}/plugins/dataTables/dataTables.select.min.js"></script>

    <script>
        "use strict";

        $('.action-btn.btn--danger').on('click', function () {
            let id = $(this).data('id');
            let message = "{{translate('want_to_delete_this')}}?"
            @if(env('APP_ENV')!='demo')
            form_alert(id, message)
            @endif
        });

        $('#landing-info-update-form').on('submit', function (event) {
            event.preventDefault();

            var form = $('#landing-info-update-form')[0];
            var formData = new FormData(form);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('admin.business-settings.set-landing-information')}}?web_page={{$webPage}}",
                data: formData,
                processData: false,
                contentType: false,
                type: 'POST',
                success: function (response) {
                    console.log(response)
                    if (response.errors.length > 0) {
                        response.errors.forEach((value, key) => {
                            toastr.error(value.message);
                        });
                    } else {
                        toastr.success('{{translate('successfully_updated')}}');
                    }
                },
                error: function (jqXHR, exception) {
                    toastr.error(jqXHR.responseJSON.message);
                }
            });
        });
    </script>

    <script>
        "use strict";

        $(".lang_link").on('click', function (e) {
            e.preventDefault();
            $(".lang_link").removeClass('active');
            $(".lang-form").addClass('d-none');
            $(this).addClass('active');

            let form_id = this.id;
            let lang = form_id.substring(0, form_id.length - 5);
            console.log(lang);
            $("." + lang + "-form").removeClass('d-none');
        });
    </script>
@endpush
