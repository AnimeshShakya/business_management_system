@extends('adminmodule::layouts.new-master')

@section('title',translate('page_setup'))

@push('css_or_js')

@endpush

@section('content')
    <div class="main-content">
        <div class="container-fluid">
            <div class="page-title-wrap mb-3">
                <h2 class="page-title">{{translate('Page Settings')}}</h2>
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
                <p class="fz-12">{{ translate('In this page you can add, edit and status On/Off your business related pages.') }}</p>
            </div>
            <div class="card mb-20">
                <div class="card-body p-20">
                    <div class="data-table-top mb-20 d-flex align-items-center flex-wrap gap-xl-3 gap-2 justify-content-between">
                        <h4 class="fw-bold text-dark">{{ translate('Page List') }}</h4>
                        <div class="d-flex gap-md-3 gap-2 flex-wrap">
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
                            <button type="button" class="rounded btn btn--primary transition text-nowrap fz-12 fw-semibold d-flex align-items-center gap-0 px-3">
                                <span class="material-symbols-outlined">add_circle</span> {{ translate('Add New Page') }}
                            </button>
                        </div>
                    </div>
                    <div class="table-responsive table-custom-responsive">
                        <table id="example" class="table align-middle">
                            <thead class="text-nowrap">
                                <tr>
                                    <th class="text-dark fw-medium bg-light">{{translate('Sl')}}</th>
                                    <th class="text-dark fw-medium bg-light">{{translate('Page Name')}}</th>
                                    <th class="text-dark fw-medium bg-light text-center">{{translate('Availability')}}</th>
                                    <th class="text-dark fw-medium bg-light text-end">{{translate('action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($dataValues as $key => $pageData)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ ucwords(str_replace('_', ' ', $pageData->key)) }}</td>
                                    <td class="text-end">
                                        <label class="switcher mx-auto">
                                            <input class="switcher_input" type="checkbox">
                                            <span class="switcher_control"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2 justify-content-end">
                                            <a href="#" class="action-btn btn--light-primary">
                                                <span class="material-icons">visibility</span>
                                            </a>
                                            <a href="#" class="action-btn btn--light-primary">
                                                <span class="material-icons">edit</span>
                                            </a>
                                            @if(!in_array($pageData->key, ['about_us', 'cancellation_policy', 'privacy_policy', 'refund_policy', 'terms_and_conditions']))
                                                <button type="button" class="action-btn btn--danger delete_section">
                                                    <i class="material-symbols-outlined">delete</i>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <div class="mb-20">
                <div class="page-settings align-items-center gap-3 flex-wrap">
                    <div>
                        <h2 class="page-title mb-2">{{translate('Add New Business Page')}}</h2>
                        <p class="fz-12">Setup new languages in your system, Website & apps to make order from versatile customers.</p>
                    </div>
                    <a class="btn btn--primary fs-14 text-capitalize gap-2 rounded-2" href="" target="_blank">
                        {{ translate('View URL') }}
                        <span class="material-symbols-outlined">open_in_new</span>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <!-- <div class="mb-3">
                        <ul class="nav nav--tabs nav--tabs__style2">
                            @foreach($dataValues as $pageData)
                                <li class="nav-item">
                                    <a href="{{url()->current()}}?web_page={{$pageData->key}}"
                                       class="nav-link {{$webPage==$pageData->key?'active':''}}">
                                        {{translate($pageData->key)}}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div> -->

                    @foreach($dataValues as $pageData)
                        <div class="tab-content">
                            <div class="tab-pane fade {{$webPage==$pageData->key?'active show':''}}">
                                <div class="card">
                                    <form action="{{route('admin.business-settings.set-pages-setup')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <!-- <div class="card-header page-settings align-items-center flex-wrap">
                                            <div class="d-flex align-items-center gap-3">
                                                <h4 class="page-title">{{translate($pageData->key)}}</h4>
                                                @if(!in_array($pageData->key,['about_us','privacy_policy', 'terms_and_conditions']))
                                                    <label class="switcher">
                                                        <input class="switcher_input"
                                                               type="checkbox"
                                                               name="is_active"
                                                               {{$pageData->is_active?'checked':''}} value="1">
                                                        <span class="switcher_control"></span>
                                                    </label>
                                                @else
                                                    <input name="is_active" value="1" class="hide-div">
                                                @endif
                                            </div>
                                            <?php
                                                $route = '#';
                                                if ($pageData->key == 'about_us') {
                                                    $route =  route('page.about-us') ;
                                                } elseif ($pageData->key == 'cancellation_policy') {
                                                    $route =  route('page.cancellation-policy') ;
                                                }elseif ($pageData->key == 'privacy_policy') {
                                                    $route =  route('page.privacy-policy') ;
                                                }elseif ($pageData->key == 'refund_policy') {
                                                    $route =  route('page.refund-policy') ;
                                                }elseif ($pageData->key == 'terms_and_conditions') {
                                                    $route =  route('page.terms-and-conditions') ;
                                                }
                                            ?>
                                            @if($pageData->is_active)
                                                <a class="btn btn-outline--primary fs-14 text-capitalize gap-2 rounded-2" href="{{ $route }}" target="_blank">
                                                    {{ translate('View URL') }}
                                                    <span class="c1">
                                                    <img class="svg" src="{{asset('public/assets/admin-module/img/icons/arrow-right.svg')}}" alt="">
                                                    </span>
                                                </a>
                                            @endif
                                        </div> -->

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
                                                                <label class="switcher ml-auto mb-0">
                                                                    <input type="checkbox" class="switcher_input" id="maintenance-mode-input">
                                                                    <span class="switcher_control"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-20">
                                                    <h5 class="mb-10 fw-normal">Title Background Image</h5>
                                                    <div class="body-bg rounded p-xl-4 p-3">
                                                        <div class="global-image-upload position-relative max-w-100 overflow-hidden bg-white border-dashed rounded-2 mx-auto mb-20 ratio-7-1 h-100px d-center">
                                                            <input type="file" accept="image/*" required style="position: absolute; width: 100%; height: 100%; opacity: 0; cursor: pointer;">
                                                            <div class="global-upload-box">
                                                                <div class="upload-content text-center">
                                                                    <span class="material-symbols-outlined placeholder-icon mb-1 text-primary">photo_camera</span>
                                                                    <span class="fz-10 d-block">Add image</span>
                                                                </div>
                                                            </div>
                                                            <img class="global-image-preview d-none" src="" alt="Preview" style="max-height: 100%; max-width: 100%;" />
                                                            <div class="overlay-icons d-none">
                                                                <button type="button" class="action-btn btn--light-primary bg-white outline-primary-hover view-icon" title="View" data-bs-toggle="modal" data-bs-target="#imageShowingMOdal">
                                                                    <span class="material-icons">visibility</span>
                                                                </button>
                                                                <button type="button" class="action-btn btn--light-primary bg-white outline-primary-hover edit-icon" title="Edit">
                                                                    <span class="material-icons">edit</span>
                                                                </button>
                                                                <button type="button" class="action-btn btn--danger delete_section bg-white outline-danger-hover remove-icon" title="Remove">
                                                                    <i class="material-symbols-outlined">delete</i>
                                                                </button>
                                                            </div>
                                                            <div class="image-file-name d-none mt-2 text-center text-muted" style="font-size: 12px;"></div>
                                                        </div>
                                                        <p class="fz-10 text-center">JPG, JPEG, PNG Less Than 10MB <span class="dark-color">(7:1)</span></p>
                                                    </div>
                                                </div>
                                                <div class="body-bg rounded p-20 mb-20">
                                                    <!-- <div class="mb-30">
                                                        <div class="d-flex flex-column align-items-center gap-3">
                                                            <p class="title-color mb-0"><span class="fw-bold text-uppercase">{{ translate('Header Image') }}</span> ({{ translate('Resolution: 1280px X 186px') }})</p>
                                                            <div class="upload-file w-100 flex-grow-1 h-180px">
                                                                <input type="file" class="cover_attachment js-upload-input"
                                                                       data-target="main-image"
                                                                       accept=".{{ implode(',.', array_column(IMAGEEXTENSION, 'key')) }}, |image/*"
                                                                       name="cover_image">
                                                                <div class="upload-file__img m-auto max-w-100 h-180px text-center">
                                                                    <img class="h-180px w-100" src="{{getDataSettingsImageFullPath(key: $pageData->key.'_image', settingType: 'pages_setup_image', path: 'page-setup/', defaultPath: asset('public/assets/admin-module/img/page-default.png'))}}" alt="">
                                                                </div>
                                                                <span class="edit-wrapper">
                                                                    <span class="upload-file__edit top">
                                                                        <span class="material-icons">edit</span>
                                                                    </span>
                                                                </span>
                                                            </div>
                                                            <p class="opacity-75 text-center">{{translate("Supports: PNG, JPG, JPEG, WEBP, File Size: Maximum 10 MB")}}</p>
                                                        </div>
                                                    </div> -->
                                                    @php($language= Modules\BusinessSettingsModule\Entities\BusinessSettings::where('key_name','system_language')->first())
                                                    @php($defaultLanguage = str_replace('_', '-', app()->getLocale()))
                                                    @if($language)
                                                        <ul class="nav nav--tabs border-color-primary mb-4">
                                                            <li class="nav-item">
                                                                <a class="nav-link lang_link active"
                                                                   href="#"
                                                                   id="default-link">{{translate('default')}}</a>
                                                            </li>
                                                            @foreach ($language?->live_values as $lang)
                                                                <li class="nav-item">
                                                                    <a class="nav-link lang_link"
                                                                       href="#"
                                                                       id="{{ $lang['code'] }}-link">{{ get_language_name($lang['code']) }}</a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                    <div class="mb-30">
                                                        <div class="mb-2 text-dark">{{translate('Page Title')}}
                                                            <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                                data-bs-placement="top"
                                                                title="{{translate('Page Title')}}"
                                                            >info</i>
                                                        </div>
                                                        <input type="text" class="form-control" name="Terms__Conditions" placeholder="Terms & Conditions" required="" value="">
                                                    </div>
                                                    @if ($language)
                                                        <div class="dark-support lang-form default-form">
                                                            <input name="page_name" value="{{$pageData->key}}"
                                                                   class="hide-div">
                                                            <textarea class="ckeditor" required
                                                                      name="page_content[]">{!! $pageData?->getRawOriginal('value') !!}</textarea>
                                                        </div>
                                                        <input type="hidden" name="lang[]" value="default">
                                                        @foreach ($language?->live_values ?? [] as $lang)
                                                                <?php
                                                                if (count($pageData['translations'])) {
                                                                    $translate = [];
                                                                    foreach ($pageData['translations'] as $t) {
                                                                        if ($t->locale == $lang['code'] && $t->key == $pageData->key) {
                                                                            $translate[$lang['code']][$pageData->key] = $t->value;
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                            <div
                                                                class="form-floating mb-30 d-none lang-form {{$lang['code']}}-form"
                                                            >
                                                               <textarea class="ckeditor"
                                                                         name="page_content[]">
                                                                   {!! $translate[$lang['code']][$pageData->key] ?? '' !!}
                                                               </textarea>
                                                            </div>
                                                            <input type="hidden" name="lang[]"
                                                                   value="{{$lang['code']}}">
                                                        @endforeach
                                                    @else
                                                        <div class="mb-30 dark-support lang-form default-form">
                                                            <input name="page_name" value="{{$pageData->key}}"
                                                                   class="hide-div">
                                                            <textarea class="ckeditor"
                                                                      name="page_content[]">{!! $pageData?->getRawOriginal('live_values') !!}</textarea>
                                                        </div>
                                                        <input type="hidden" name="lang[]" value="default">
                                                    @endif
                                                </div>
                                                @can('page_update')
                                                    <div class="d-flex justify-content-end gap-lg-3 gap-2">
                                                        <button type="reset" class="btn btn--secondary rounded">
                                                            {{translate('reset')}}
                                                        </button>
                                                        <button class="btn btn--primary demo_check d-flex align-items-center gap-2 rounded">
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
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- <div class="row">
                <div class="col-12">
                    <div class="mb-3">
                        <ul class="nav nav--tabs nav--tabs__style2">
                            @foreach($dataValues as $pageData)
                                <li class="nav-item">
                                    <a href="{{url()->current()}}?web_page={{$pageData->key}}"
                                       class="nav-link {{$webPage==$pageData->key?'active':''}}">
                                        {{translate($pageData->key)}}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    @foreach($dataValues as $pageData)
                        <div class="tab-content">
                            <div class="tab-pane fade {{$webPage==$pageData->key?'active show':''}}">
                                <div class="card">
                                    <form action="{{route('admin.business-settings.set-pages-setup')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-header page-settings align-items-center flex-wrap">
                                            <div class="d-flex align-items-center gap-3">
                                                <h4 class="page-title">{{translate($pageData->key)}}</h4>
                                                @if(!in_array($pageData->key,['about_us','privacy_policy', 'terms_and_conditions']))
                                                    <label class="switcher">
                                                        <input class="switcher_input"
                                                               type="checkbox"
                                                               name="is_active"
                                                               {{$pageData->is_active?'checked':''}} value="1">
                                                        <span class="switcher_control"></span>
                                                    </label>
                                                @else
                                                    <input name="is_active" value="1" class="hide-div">
                                                @endif
                                            </div>
                                            <?php
                                                $route = '#';
                                                if ($pageData->key == 'about_us') {
                                                    $route =  route('page.about-us') ;
                                                } elseif ($pageData->key == 'cancellation_policy') {
                                                    $route =  route('page.cancellation-policy') ;
                                                }elseif ($pageData->key == 'privacy_policy') {
                                                    $route =  route('page.privacy-policy') ;
                                                }elseif ($pageData->key == 'refund_policy') {
                                                    $route =  route('page.refund-policy') ;
                                                }elseif ($pageData->key == 'terms_and_conditions') {
                                                    $route =  route('page.terms-and-conditions') ;
                                                }
                                            ?>

                                            @if($pageData->is_active)
                                                <a class="btn btn-outline--primary fs-14 text-capitalize gap-2 rounded-2" href="{{ $route }}" target="_blank">
                                                    {{ translate('View URL') }}
                                                    <span class="c1">
                                                    <img class="svg" src="{{asset('public/assets/admin-module/img/icons/arrow-right.svg')}}" alt="">
                                                    </span>
                                                </a>
                                            @endif

                                        </div>
                                        <div class="card-body p-30">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="mb-30">
                                                        <div class="d-flex flex-column align-items-center gap-3">
                                                            <p class="title-color mb-0"><span class="fw-bold text-uppercase">{{ translate('Header Image') }}</span> ({{ translate('Resolution: 1280px X 186px') }})</p>
                                                            <div class="upload-file w-100 flex-grow-1 h-180px">
                                                                <input type="file" class="cover_attachment js-upload-input"
                                                                       data-target="main-image"
                                                                       accept=".{{ implode(',.', array_column(IMAGEEXTENSION, 'key')) }}, |image/*"
                                                                       name="cover_image">
                                                                <div class="upload-file__img m-auto max-w-100 h-180px text-center">
                                                                    <img class="h-180px w-100" src="{{getDataSettingsImageFullPath(key: $pageData->key.'_image', settingType: 'pages_setup_image', path: 'page-setup/', defaultPath: asset('public/assets/admin-module/img/page-default.png'))}}" alt="">
                                                                </div>
                                                                <span class="edit-wrapper">
                                                                    <span class="upload-file__edit top">
                                                                        <span class="material-icons">edit</span>
                                                                    </span>
                                                                </span>
                                                            </div>
                                                            <p class="opacity-75 text-center">{{translate("Supports: PNG, JPG, JPEG, WEBP, File Size: Maximum 10 MB")}}</p>
                                                        </div>
                                                    </div>

                                                    @php($language= Modules\BusinessSettingsModule\Entities\BusinessSettings::where('key_name','system_language')->first())
                                                    @php($defaultLanguage = str_replace('_', '-', app()->getLocale()))
                                                    @if($language)
                                                        <ul class="nav nav--tabs border-color-primary mb-4">
                                                            <li class="nav-item">
                                                                <a class="nav-link lang_link active"
                                                                   href="#"
                                                                   id="default-link">{{translate('default')}}</a>
                                                            </li>
                                                            @foreach ($language?->live_values as $lang)
                                                                <li class="nav-item">
                                                                    <a class="nav-link lang_link"
                                                                       href="#"
                                                                       id="{{ $lang['code'] }}-link">{{ get_language_name($lang['code']) }}</a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                    @if ($language)
                                                        <div class="mb-30 dark-support lang-form default-form">
                                                            <input name="page_name" value="{{$pageData->key}}"
                                                                   class="hide-div">
                                                            <textarea class="ckeditor" required
                                                                      name="page_content[]">{!! $pageData?->getRawOriginal('value') !!}</textarea>
                                                        </div>
                                                        <input type="hidden" name="lang[]" value="default">
                                                        @foreach ($language?->live_values ?? [] as $lang)
                                                                <?php
                                                                if (count($pageData['translations'])) {
                                                                    $translate = [];
                                                                    foreach ($pageData['translations'] as $t) {
                                                                        if ($t->locale == $lang['code'] && $t->key == $pageData->key) {
                                                                            $translate[$lang['code']][$pageData->key] = $t->value;
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                            <div
                                                                class="form-floating mb-30 d-none lang-form {{$lang['code']}}-form"
                                                            >
                                                               <textarea class="ckeditor"
                                                                         name="page_content[]">
                                                                   {!! $translate[$lang['code']][$pageData->key] ?? '' !!}
                                                               </textarea>
                                                            </div>
                                                            <input type="hidden" name="lang[]"
                                                                   value="{{$lang['code']}}">
                                                        @endforeach
                                                    @else
                                                        <div class="mb-30 dark-support lang-form default-form">
                                                            <input name="page_name" value="{{$pageData->key}}"
                                                                   class="hide-div">
                                                            <textarea class="ckeditor"
                                                                      name="page_content[]">{!! $pageData?->getRawOriginal('live_values') !!}</textarea>
                                                        </div>
                                                        <input type="hidden" name="lang[]" value="default">
                                                    @endif
                                                </div>
                                                @can('page_update')
                                                    <div class="d-flex justify-content-end">
                                                        <button class="btn btn--primary demo_check">
                                                            {{translate('update')}}
                                                        </button>
                                                    </div>
                                                @endcan
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div> -->
        </div>

        <!-- Page & Media Social Media  -->
        <h1 class="mb-3 mt-5">Setting-management > Page & Media > Social Media</h1>
        <h3 class="mb-15">{{translate('Social Media')}}</h3>
        <div class="card mb-15">
            <div class="card-body p-20">
                <div class="mb-20">
                    <h4 class="mb-1">{{translate('Setup Social Media Link')}}</h4>
                    <p class="fz-12">{{translate('Here you can add your social media links. This will help you to show your social activity to the customers.')}}</p>
                </div>
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="discount-type body-bg rounded p-20 mb-20">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="">
                                    <label class="mb-2 text-dark d-flex align-items-center gap-1">{{translate('Select Social Media')}}
                                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                            data-bs-placement="top"
                                            title="{{translate('Select Social Media')}}"
                                        >info</i>
                                    </label>
                                    <select class="js-select theme-input-style w-100"
                                            name="media" required>
                                        <option value="" selected disabled>
                                            ---{{translate('Select_media')}}---
                                        </option>
                                        <option
                                            value="facebook">{{translate('Facebook')}}</option>
                                        <option
                                            value="instagram">{{translate('Instagram')}}</option>
                                        <option
                                            value="linkedin">{{translate('LinkedIn')}}</option>
                                        <option
                                            value="twitter">{{translate('Twitter')}}</option>
                                        <option
                                            value="youtube">{{translate('Youtube')}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="">
                                    <label class="mb-2 text-dark d-flex align-items-center gap-1">{{translate('Social Media Link')}}
                                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                            data-bs-placement="top"
                                            title="{{translate('Social Media Link')}}"
                                        >info</i>
                                    </label>
                                    <div class="">
                                        <input type="text" class="form-control" name="link"
                                                placeholder="{{translate('link')}}" required>
                                    </div>
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
        <div class="mb-15 bg-warning bg-opacity-10 fs-12 p-10 rounded d-flex gap-2 align-items-center">
            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M7 0C3.13414 0 0 3.13414 0 7C0 10.8659 3.13414 14 7 14C10.8659 14 14 10.8659 14 7C14 3.13414 10.8659 0 7 0ZM7.88648 9.94164C7.88648 10.0581 7.86355 10.1733 7.81901 10.2809C7.77446 10.3884 7.70916 10.4862 7.62684 10.5685C7.54452 10.6508 7.4468 10.7161 7.33924 10.7606C7.23169 10.8052 7.11641 10.8281 7 10.8281C6.88359 10.8281 6.76831 10.8052 6.66076 10.7606C6.5532 10.7161 6.45548 10.6508 6.37316 10.5685C6.29084 10.4862 6.22554 10.3884 6.18099 10.2809C6.13645 10.1733 6.11352 10.0581 6.11352 9.94164V6.39543C6.11352 6.27902 6.13645 6.16374 6.18099 6.05619C6.22554 5.94863 6.29084 5.85091 6.37316 5.76859C6.45548 5.68627 6.5532 5.62098 6.66076 5.57642C6.76831 5.53187 6.88359 5.50895 7 5.50895C7.11641 5.50895 7.23169 5.53187 7.33924 5.57642C7.4468 5.62098 7.54452 5.68627 7.62684 5.76859C7.70916 5.85091 7.77446 5.94863 7.81901 6.05619C7.86355 6.16374 7.88648 6.27902 7.88648 6.39543V9.94164ZM7 4.94484C6.82467 4.94484 6.65328 4.89285 6.5075 4.79544C6.36171 4.69804 6.24809 4.55959 6.18099 4.3976C6.1139 4.23562 6.09634 4.05738 6.13055 3.88541C6.16475 3.71345 6.24918 3.5555 6.37316 3.43152C6.49714 3.30754 6.65509 3.22311 6.82706 3.18891C6.99902 3.1547 7.17726 3.17226 7.33924 3.23935C7.50123 3.30645 7.63968 3.42007 7.73708 3.56586C7.83449 3.71164 7.88648 3.88303 7.88648 4.05836C7.88652 4.17478 7.86362 4.29008 7.81908 4.39764C7.77454 4.50521 7.70924 4.60295 7.62692 4.68528C7.54459 4.7676 7.44685 4.8329 7.33928 4.87744C7.23172 4.92197 7.11643 4.94488 7 4.94484Z" fill="#FFBB38"/>
            </svg>
            <span>Those social media links are visible in footer section of the websites & email that you sends to the customer and vendors</span>
        </div>
        <div class="card">
            <div class="card-body p-20">
                <div class="table-responsive table-custom-responsive">
                    <table id="example" class="table align-middle">
                        <thead class="text-nowrap">
                            <tr>
                                <th class="text-dark fw-medium bg-light">{{translate('Sl')}}</th>
                                <th class="text-dark fw-medium bg-light">{{translate('Name')}}</th>
                                <th class="text-dark fw-medium bg-light">{{translate('Social media link')}}</th>
                                <th class="text-dark fw-medium bg-light">{{translate('status')}}</th>
                                <th class="text-dark fw-medium bg-light text-end">{{translate('action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Pinterest</td>
                                <td>https://www.pinterest.com/</td>
                                <td>
                                    <label class="switcher">
                                        <input class="switcher_input" type="checkbox" checked="">
                                        <span class="switcher_control"></span>
                                    </label>
                                </td>
                                <td>
                                    <div class="d-flex gap-2 justify-content-end">
                                        <a href="#" class="action-btn btn--light-primary" data-bs-toggle="offcanvas" data-bs-target="#social__media-lingoffcanvas">
                                            <span class="material-icons">edit</span>
                                        </a>
                                        <button type="button" class="action-btn btn--danger delete_section" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                            <i class="material-symbols-outlined">delete</i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Linkedin</td>
                                <td>https://bd.linkedin.com/</td>
                                <td>
                                    <label class="switcher">
                                        <input class="switcher_input" type="checkbox">
                                        <span class="switcher_control"></span>
                                    </label>
                                </td>
                                <td>
                                    <div class="d-flex gap-2 justify-content-end">
                                        <a href="#" class="action-btn btn--light-primary" data-bs-toggle="offcanvas" data-bs-target="#social__media-lingoffcanvas">
                                            <span class="material-icons">edit</span>
                                        </a>
                                        <button type="button" class="action-btn btn--danger delete_section" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                            <i class="material-symbols-outlined">delete</i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Twitter</td>
                                <td>https://twitter.com/?lang=en</td>
                                <td>
                                    <label class="switcher">
                                        <input class="switcher_input" type="checkbox" checked="">
                                        <span class="switcher_control"></span>
                                    </label>
                                </td>
                                <td>
                                    <div class="d-flex gap-2 justify-content-end">
                                        <a href="#" class="action-btn btn--light-primary" data-bs-toggle="offcanvas" data-bs-target="#social__media-lingoffcanvas">
                                            <span class="material-icons">edit</span>
                                        </a>
                                        <button type="button" class="action-btn btn--danger delete_section" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                            <i class="material-symbols-outlined">delete</i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Facebook</td>
                                <td>https://www.facebook.com/</td>
                                <td>
                                    <label class="switcher">
                                        <input class="switcher_input" type="checkbox">
                                        <span class="switcher_control"></span>
                                    </label>
                                </td>
                                <td>
                                    <div class="d-flex gap-2 justify-content-end">
                                        <a href="#" class="action-btn btn--light-primary" data-bs-toggle="offcanvas" data-bs-target="#social__media-lingoffcanvas">
                                            <span class="material-icons">edit</span>
                                        </a>
                                        <button type="button" class="action-btn btn--danger delete_section" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                            <i class="material-symbols-outlined">delete</i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Instagram</td>
                                <td>https://www.instagram.com/?hl=en</td>
                                <td>
                                    <label class="switcher">
                                        <input class="switcher_input" type="checkbox" checked="">
                                        <span class="switcher_control"></span>
                                    </label>
                                </td>
                                <td>
                                    <div class="d-flex gap-2 justify-content-end">
                                        <a href="#" class="action-btn btn--light-primary" data-bs-toggle="offcanvas" data-bs-target="#social__media-lingoffcanvas">
                                            <span class="material-icons">edit</span>
                                        </a>
                                        <button type="button" class="action-btn btn--danger delete_section" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                            <i class="material-symbols-outlined">delete</i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-body p-20">
                <div class="table-responsive table-custom-responsive">
                    <table id="example" class="table align-middle">
                        <thead class="text-nowrap">
                            <tr>
                                <th class="text-dark fw-medium bg-light">{{translate('Sl')}}</th>
                                <th class="text-dark fw-medium bg-light">{{translate('Name')}}</th>
                                <th class="text-dark fw-medium bg-light">{{translate('Social media link')}}</th>
                                <th class="text-dark fw-medium bg-light">{{translate('status')}}</th>
                                <th class="text-dark fw-medium bg-light text-end">{{translate('action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center bg-white  pt-5 pb-5" colspan="7">
                                    <div class="d-flex flex-column gap-2">
                                        <img src="{{asset('public/assets/admin-module')}}/img/log-list-error.svg" alt="error" class="w-100px mx-auto">
                                        <p>{{translate('data not found')}}</p>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<!-- Specialit Edit Social Media Offcanvas -->
<form action="" method="post" id="update-form-submit">
    @csrf
    <div class="offcanvas offcanvas-end offcanvas-cus-sm" tabindex="-1" id="social__media-lingoffcanvas" aria-labelledby="social__media-lingoffcanvasLabel">
        <div class="offcanvas-header py-md-4 py-3">
            <h3 class="mb-0">Edit Social Media Link</h3>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body bg-white">
            <div class="discount-type body-bg rounded p-20 mb-20">
                <div class="row g-4">
                    <div class="col-md-12">
                        <div class="">
                            <label class="mb-2 text-dark d-flex align-items-center gap-1">{{translate('Select Social Media')}}
                                <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    title="{{translate('Select Social Media')}}"
                                >info</i>
                            </label>
                            <select class="js-select theme-input-style w-100"
                                    name="media" required>
                                <option value="" selected disabled>
                                    ---{{translate('Select_media')}}---
                                </option>
                                <option
                                    value="facebook">{{translate('Facebook')}}</option>
                                <option
                                    value="instagram">{{translate('Instagram')}}</option>
                                <option
                                    value="linkedin">{{translate('LinkedIn')}}</option>
                                <option
                                    value="twitter">{{translate('Twitter')}}</option>
                                <option
                                    value="youtube">{{translate('Youtube')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="">
                            <label class="mb-2 text-dark d-flex align-items-center gap-1">{{translate('Social Media Link')}}
                                <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    title="{{translate('Social Media Link')}}"
                                >info</i>
                            </label>
                            <div class="">
                                <input type="text" class="form-control" name="link"
                                        placeholder="{{translate('link')}}" required>
                            </div>
                            <span class="fs-12 d-block text-light-gray text-end mt-1">0/100</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="offcanvas-footer border-top">
            <div class="d-flex justify-content-center gap-2 bg-white px-3 py-sm-3 py-2">
                <button type="reset" class="btn btn--secondary rounded w-100"> {{translate('reset')}} </button>
                <button type="submit" class="btn btn--primary rounded w-100"> {{translate('Save')}} </button>
            </div>
        </div>
    </div>
</form>
<!--Facebook Delete On Modal-->
<div class="modal fade custom-confirmation-modal" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-30">
                <button type="button" class="btn-close bg-light rounded-full" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="d-flex flex-column align-items-center text-center">
                    <img class="mb-20" src="{{asset('public/assets/admin-module')}}/img/delete.png" alt="">
                    <h3 class="mb-15">{{ translate('Do you want to delete Facebook?')}}</h3>
                    <p class="mb-4 fz-14">{{ translate('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet ')}}</p>
                    <form action="{{ route('admin.subscription.package.subscription-to-commission') }}" method="post">
                        @csrf
                        <div class="choose-option">
                            <div class="d-flex gap-3 justify-content-center flex-wrap">
                                <button type="button" class="btn px-xl-5 px-4 btn--secondary rounded" data-bs-dismiss="modal">No</button>
                                <button type="button" class="btn px-xl-5 px-4 btn--danger text-capitalize rounded">Yes, Delete</button>
                            </div>
                        </div>
                    </form>
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
        "use strict";

        $(document).ready(function () {
            tinymce.init({
                selector: 'textarea.ckeditor'
            });
        });

        $('.switcher_input').on('click', function () {
            $(this).submit()
        });

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
