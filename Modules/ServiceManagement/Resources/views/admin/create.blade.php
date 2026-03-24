@extends('adminmodule::layouts.master')

@section('title',translate('service_setup'))

@push('css_or_js')
    <link rel="stylesheet" href="{{asset('public/assets/admin-module')}}/plugins/select2/select2.min.css"/>
    <link rel="stylesheet" href="{{asset('public/assets/admin-module')}}/plugins/dataTables/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="{{asset('public/assets/admin-module')}}/plugins/dataTables/select.dataTables.min.css"/>
    <link rel="stylesheet" href="{{asset('public/assets/admin-module')}}/plugins/wysiwyg-editor/froala_editor.min.css"/>
    <link rel="stylesheet" href="{{asset('public/assets/admin-module')}}/css/tags-input.min.css"/>

    {{--AI--}}
    <link rel="stylesheet" href="{{asset('public/assets/admin-module/css/ai-sidebar.css') }}"/>

@endpush

@section('content')
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-wrap mb-3">
                        <h2 class="page-title">{{translate('add_new_service')}}</h2>
                    </div>
                    <div class="card-wrap">
                        <div class="card-body-inner">
                            <div>
                                <form action="{{route('admin.service.store')}}" method="post" enctype="multipart/form-data" id="form-wizard">
                                    @csrf

                                    <h3>{{translate('service_information')}}</h3>
                                    <section class="card-offset-animation">
                                        <div class="row service-description-wrapper">
                                            <div class="col-xxl-9 col-lg-8 mb-5 mb-lg-0">
                                                <div class="card h-100">
                                                    <div class="card-body">
                                                        <div class="mb-20">
                                                            <h3 class="mb-1 text-dark">{{ translate('Basic Setup') }}</h3>
                                                            <p class="fs-12 text-color">{{ translate('Provide essential service details') }}</p>
                                                        </div>
                                                        <div class="bg-light p-xxl-20 p-12px rounded">
                                                            @php($language= Modules\BusinessSettingsModule\Entities\BusinessSettings::where('key_name','system_language')->first())
                                                            @php($default_lang = str_replace('_', '-', app()->getLocale()))
                                                            @if($language)
                                                                <ul class="nav nav--tabs text-nowrap overflow-auto flex-nowrap border-color-primary mb-4">
                                                                    <li class="nav-item">
                                                                        <a class="nav-link lang_link active" href="#"
                                                                        id="default-link">{{translate('default')}}</a>
                                                                    </li>
                                                                    @foreach ($language?->live_values as $lang)
                                                                        <li class="nav-item">
                                                                            <a class="nav-link lang_link" href="#"
                                                                            id="{{ $lang['code'] }}-link">{{ get_language_name($lang['code']) }}</a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            @endif
                                                            @if($language)
                                                                <div class="mb-30 lang-form" id="default-form">
                                                                    <button type="button" class="btn bg-white text-primary bg-transparent shadow-none border-0 opacity-1 generate_btn_wrapper p-0 auto_fill_title title-btn-wrapper"
                                                                            id="title-default-action-btn"
                                                                            data-lang="default"
                                                                            data-route="{{ route('admin.product.title-auto-fill') }}">
                                                                        <div class="btn-svg-wrapper">
                                                                            <img width="18" height="18" class="" src="{{ asset(path: 'public/assets/admin-module/img/ai/blink-right-small.svg') }}" alt="">
                                                                        </div>
                                                                        <span class="ai-text-animation d-none" role="status">{{ translate('Just_a_second') }}</span>
                                                                        <span class="btn-text">{{ translate('Generate') }}</span>
                                                                    </button>
                                                                    <div class="form-floating form-floating__icon outline-wrapper title-container-default">
                                                                        <input type="text" name="name[]" id="default_name" class="form-control default-name" required placeholder="{{translate('service_name')}}">
                                                                        <label>{{translate('service_name')}} ({{ translate('default') }})</label>
                                                                        <span class="material-icons">subtitles</span>
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" name="lang[]" value="default">
                                                                @foreach ($language?->live_values as $lang)
                                                                    <div class="mb-30 d-none lang-form" id="{{$lang['code']}}-form">
                                                                        <button type="button" class="btn bg-white text-primary bg-transparent shadow-none border-0 opacity-1 generate_btn_wrapper p-0 auto_fill_title title-btn-wrapper"
                                                                                id="title-{{ $lang['code'] }}-action-btn"
                                                                                data-route="{{ route('admin.product.title-auto-fill') }}"
                                                                                data-lang="{{ $lang['code'] }}">
                                                                            <div class="btn-svg-wrapper">
                                                                                <img width="18" height="18" class="" src="{{ asset(path: 'public/assets/admin-module/img/ai/blink-right-small.svg') }}" alt="">
                                                                            </div>
                                                                            <span class="ai-text-animation d-none" role="status">{{ translate('Just_a_second') }}</span>
                                                                            <span class="btn-text">{{ translate('Generate') }}</span>
                                                                        </button>
                                                                        <div class="form-floating form-floating__icon outline-wrapper title-container-{{$lang['code']}}">

                                                                            <input type="text" name="name[]" id="{{$lang['code']}}_name" class="form-control input-language" placeholder="{{translate('service_name')}}">
                                                                            <label>{{translate('service_name')}}({{strtoupper($lang['code'])}})</label>
                                                                            <span class="material-icons">subtitles</span>
                                                                        </div>
                                                                    </div>
                                                                    <input type="hidden" name="lang[]" value="{{$lang['code']}}">
                                                                @endforeach
                                                                @else
                                                                    <div class="lang-form">
                                                                        <div class="mb-30">
                                                                            <div class="form-floating form-floating__icon">
                                                                                <input type="text" class="form-control" name="name[]" placeholder="{{translate('service_name')}} *" required>
                                                                                <label>{{translate('service_name')}} *</label>
                                                                                <span class="material-icons">subtitles</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <input type="hidden" name="lang[]" value="default">
                                                                    <button type="button" class="btn bg-white text-primary bg-transparent shadow-none border-0 opacity-1 generate_btn_wrapper p-0 auto_fill_title title-btn-wrapper"
                                                                            id="title-en-action-btn"
                                                                            data-lang="en"
                                                                            data-route="{{ route('admin.product.title-auto-fill') }}">
                                                                        <div class="btn-svg-wrapper">
                                                                            <img width="18" height="18" class="" src="{{ asset(path: 'public/assets/admin-module/img/ai/blink-right-small.svg') }}" alt="">
                                                                        </div>
                                                                        <span class="ai-text-animation d-none" role="status">{{ translate('Just_a_second') }}</span>
                                                                        <span class="btn-text">{{ translate('Generate') }}</span>
                                                                    </button>
                                                            @endif

                                                            <!-- shortDescription -->
                                                            @if($language)
                                                            <div class="lang-form2" id="default-form2">
                                                                <div class="mb-30">
                                                                    <div class="d-flex align-items-center justify-content-between gap-1 flex-wrap mb-3">
                                                                        <label class="m-0 lh-1">{{translate('short_description')}}({{translate('default')}}) *</label>
                                                                        <button type="button" class="btn bg-white mb-0 text-primary bg-transparent shadow-none border-0 opacity-1 generate_btn_wrapper p-0 auto_fill_short_description short-description-btn-wrapper"
                                                                                id="short-description-default-action-btn"
                                                                                data-lang="default"
                                                                                data-route="{{ route('admin.product.short-description-auto-fill') }}">
                                                                            <div class="btn-svg-wrapper">
                                                                                <img width="18" height="18" class=""
                                                                                    src="{{ asset(path: 'public/assets/admin-module/img/ai/blink-right-small.svg') }}" alt="">
                                                                            </div>
                                                                            <span class="ai-text-animation d-none" role="status">{{ translate('Just_a_second') }}</span>
                                                                            <span class="btn-text">{{ translate('Generate') }}</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="outline-wrapper" id="">
                                                                        <textarea type="text" class="form-control default_short_description" name="short_description[]" required></textarea>
                                                                    </div>
                                                                </div>

                                                                <div class="mb-30">
                                                                    <div class="form-error-wrap">
                                                                        <div class="d-flex align-items-end justify-content-between flex-wrap gap-1 mb-3">
                                                                            <label for="editor" class="mb-0 lh-1 fs-14">{{translate('long_Description')}}({{translate('default')}})<span class="text-danger">*</span></label>
                                                                            <button type="button" class="btn bg-white mb-0 text-primary bg-transparent shadow-none border-0 opacity-1 generate_btn_wrapper p-0 auto_fill_description description-btn-wrapper"
                                                                                    id="description-default-action-btn"
                                                                                    data-lang="default"
                                                                                    data-route="{{ route('admin.product.description-auto-fill') }}">
                                                                                <div class="btn-svg-wrapper">
                                                                                    <img width="18" height="18" class=""
                                                                                        src="{{ asset(path: 'public/assets/admin-module/img/ai/blink-right-small.svg') }}" alt="">
                                                                                </div>
                                                                                <span class="ai-text-animation d-none" role="status">{{ translate('Just_a_second') }}</span>
                                                                                <span class="btn-text">{{ translate('Generate') }} </span>
                                                                            </button>
                                                                        </div>
                                                                        <section id="editor" class="dark-support dark-support-02 outline-wrapper header-light body-customize-editor rounded-10">
                                                                            <textarea class="ckeditor default_description" name="description[]" id="default_description" required></textarea>
                                                                        </section>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                            @foreach ($language?->live_values as $lang)
                                                                <div class="d-none lang-form2" id="{{$lang['code']}}-form2">
                                                                    <div class="col-lg-12 mt-5">
                                                                        <div class="mb-30">
                                                                            <div class="d-flex align-items-center justify-content-between gap-1 flex-wrap mb-3">
                                                                                <label class="m-0">{{translate('short_description')}}({{strtoupper($lang['code'])}}) *</label>
                                                                                <button type="button" class="btn bg-white text-primary bg-transparent shadow-none border-0 mb-0 opacity-1 generate_btn_wrapper p-0 auto_fill_short_description short-description-btn-wrapper"
                                                                                        id="short-description-{{ $lang['code'] }}-action-btn"  data-lang="{{ $lang['code'] }}"
                                                                                        data-route="{{ route('admin.product.short-description-auto-fill') }}">
                                                                                    <div class="btn-svg-wrapper">
                                                                                        <img width="18" height="18" class=""
                                                                                             src="{{ asset(path: 'public/assets/admin-module/img/ai/blink-right-small.svg') }}" alt="">
                                                                                    </div>
                                                                                    <span class="ai-text-animation d-none" role="status">{{ translate('Just_a_second') }}</span>
                                                                                    <span class="btn-text">{{ translate('Generate') }}</span>
                                                                                </button>
                                                                            </div>

                                                                            <div class="form-floating outline-wrapper">
                                                                                <textarea type="text" class="form-control {{ $lang['code'] }}_short_description" name="short_description[]"></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-12 mt-4 mt-md-5">
                                                                        <div class="form-error-wrap">
                                                                            <div class="d-flex align-items-end justify-content-between flex-wrap gap-1 mb-3">
                                                                                <label for="editor" class="mb-0">{{translate('long_Description')}}({{strtoupper($lang['code'])}})<span class="text-danger">*</span></label>
                                                                                <button type="button" class="btn bg-white text-primary bg-transparent shadow-none border-0 mb-0 opacity-1 generate_btn_wrapper p-0 auto_fill_description description-btn-wrapper"
                                                                                        id="description-{{ $lang['code'] }}-action-btn"  data-lang="{{ $lang['code'] }}"
                                                                                        data-route="{{ route('admin.product.description-auto-fill') }}">
                                                                                    <div class="btn-svg-wrapper">
                                                                                        <img width="18" height="18" class=""
                                                                                             src="{{ asset(path: 'public/assets/admin-module/img/ai/blink-right-small.svg') }}" alt="">
                                                                                    </div>
                                                                                    <span class="ai-text-animation d-none" role="status">{{ translate('Just_a_second') }}</span>
                                                                                    <span class="btn-text">{{ translate('Generate') }}</span>
                                                                                </button>
                                                                            </div>

                                                                            <section id="editor" class="dark-support dark-support-02 outline-wrapper header-light body-customize-editor rounded-10">
                                                                                <textarea class="ckeditor {{ $lang['code'] }}_description" name="description[]" id="{{ $lang['code'] }}_description"></textarea>
                                                                            </section>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endforeach
                                                            @else
                                                                <div class="normal-form">
                                                                    <div class="col-lg-12 mt-5">
                                                                        <div class="mb-30">
                                                                            <div class="">
                                                                                <textarea type="text" class="form-control en_short_description" name="short_description[]" required></textarea>
                                                                                <label>{{translate('short_description')}} *</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <button type="button" class="btn bg-white text-primary bg-transparent shadow-none border-0 opacity-1 generate_btn_wrapper p-0 auto_fill_short_description short-description-btn-wrapper"
                                                                            id="short-description-en-action-btn"  data-lang="en"
                                                                            data-route="{{ route('admin.product.short-description-auto-fill') }}">
                                                                        <div class="btn-svg-wrapper">
                                                                            <img width="18" height="18" class=""
                                                                                src="{{ asset(path: 'public/assets/admin-module/img/ai/blink-right-small.svg') }}" alt="">
                                                                        </div>
                                                                        <span class="ai-text-animation d-none" role="status">{{ translate('Just_a_second') }}</span>
                                                                        <span class="btn-text">{{ translate('Generate') }}</span>
                                                                    </button>

                                                                    <div class="col-12 mt-4">
                                                                        <div class="form-error-wrap m-0">
                                                                            <label for="editor" class="mb-2">{{translate('long_Description')}}
                                                                                <span class="text-danger">*</span>
                                                                            </label>
                                                                            <section id="editor" class="dark-support header-light body-customize-editor">
                                                                                <textarea class="ckeditor en_description" name="description[]" id="en_description" required></textarea>
                                                                            </section>
                                                                        </div>
                                                                    </div>


                                                                    <button type="button" class="btn bg-white text-primary bg-transparent shadow-none border-0 opacity-1 generate_btn_wrapper p-0 auto_fill_description description-btn-wrapper"
                                                                            id="description-en-action-btn"  data-lang="en"
                                                                            data-route="{{ route('admin.product.description-auto-fill') }}">
                                                                        <div class="btn-svg-wrapper">
                                                                            <img width="18" height="18" class=""
                                                                                src="{{ asset(path: 'public/assets/admin-module/img/ai/blink-right-small.svg') }}" alt="">
                                                                        </div>
                                                                        <span class="ai-text-animation d-none" role="status">{{ translate('Just_a_second') }}</span>
                                                                        <span class="btn-text">{{ translate('Generate') }}</span>
                                                                    </button>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xxl-3 col-lg-4">
                                                <div class="card h-100">
                                                    <div class="card-body">
                                                        <div class="bg-light rounded w-100 mb-30">
                                                            <div class="d-flex flex-column align-items-center gap-0 text-center px-2 py-5">
                                                                <div class="mb-30">
                                                                    <h5 class="mb-1 fs-14 font-semibold text-dark">{{translate('thumbnail_image')}} <span class="text-danger">*</span></h5>
                                                                    <span class="fs-12 text-color">{{ translate('Upload your thumbnail Image') }}</span>
                                                                </div>
                                                                <div class="d-flex flex-column align-items-center mb-30">
                                                                    <div class="upload-file ratio-1 w-100px form-error-wrap">
                                                                        <input type="file" class="upload-file__input"
                                                                               name="thumbnail"
                                                                               accept=".{{ implode(',.', array_column(IMAGEEXTENSION, 'key')) }}, |image/*"
                                                                               data-maxFileSize="{{ readableUploadMaxFileSize('image') }}"
                                                                               required>
                                                                        <div class="upload-file__img border-dashed-1-gray rounded">
                                                                            <img src="{{asset('public/assets/admin-module/img/img-upload-new-small.png')}}"
                                                                                    alt="{{ translate('service') }}" class="w-100">
                                                                        </div>
                                                                        <span class="upload-file__edit">
                                                                            <span class="material-icons">edit</span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <p class="text-center fs-10 text-color mb-0">
                                                                    {{ translate('Image format')}} - {{ implode(', ', array_column(IMAGEEXTENSION, 'key')) }}
                                                                    {{ translate("Image Size") }} - {{ translate('maximum size') }} {{ readableUploadMaxFileSize('image') }}
                                                                    {{ translate('Image Ratio') }} - 1:1
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="bg-light rounded w-100 text-center">
                                                            <div class="d-flex flex-column align-items-center gap-0 px-2 py-5">
                                                                <div class="mb-30">
                                                                    <p class="mb-1 fs-14 font-semibold text-dark">{{translate('cover_image')}} <span class="text-danger">*</span></p>
                                                                    <span class="fs-12 text-color">{{ translate('Upload your cover Image') }}</span>
                                                                </div>
                                                                <div class="mb-30">
                                                                    <div class="upload-file h-100px form-error-wrap">
                                                                        <input type="file" class="upload-file__input"
                                                                               name="cover_image"
                                                                               accept=".{{ implode(',.', array_column(IMAGEEXTENSION, 'key')) }}, |image/*"
                                                                               data-maxFileSize="{{ readableUploadMaxFileSize('image') }}"
                                                                               required>
                                                                        <div class="upload-file__img h-100px  border-dashed-1-gray rounded upload-file__img_banner">
                                                                            <img src="{{asset('public/assets/admin-module/img/img-upload-new.png')}}"
                                                                                 alt="{{ translate('service-cover-image') }}" class="w-100 h-100">
                                                                        </div>
                                                                        <span class="upload-file__edit">
                                                                            <span class="material-icons">edit</span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <p class="text-center fs-10 text-color mb-0">
                                                                    {{ translate('Image format')}} - {{ implode(', ', array_column(IMAGEEXTENSION, 'key')) }}
                                                                    {{ translate("Image Size") }} - {{ translate('maximum size') }} {{ readableUploadMaxFileSize('image') }}
                                                                    {{ translate('Image Ratio') }} - 3:1
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="general_wrapper mt-4">
                                            <div class="outline-wrapper">
                                                <div class="card bg-animate">
                                                    <div class="card-body">
                                                        <button type="button"
                                                                class="btn bg-white text-primary mt-0 mb-md-0 mb-2 bg-transparent shadow-none border-0 opacity-1 generate_btn_wrapper p-0 general_setup_auto_fill"
                                                                id="general_setup_auto_fill"
                                                                data-route="{{ route('admin.product.general-setup-auto-fill') }}"  data-lang="default">
                                                            <div class="btn-svg-wrapper">
                                                                <img width="18" height="18" class=""
                                                                        src="{{ asset(path: 'public/assets/admin-module/img/ai//blink-right-small.svg') }}" alt="">
                                                            </div>
                                                            <span class="ai-text-animation d-none" role="status">{{ translate('Just_a_second') }}</span>
                                                            <span class="btn-text">{{ translate('Generate') }}</span>
                                                        </button>
                                                        <div class="mb-20 max-w-500">
                                                            <h3 class="mb-1 text-dark">{{ translate('General Setup') }}</h3>
                                                            <p class="fs-12 text-color m-0">{{ translate('Here you can set up the foundational details required for service creation.') }}</p>
                                                        </div>
                                                        <div class="row g-3">
                                                            <div class="bg-light rounded p-xxl-20 p-12px">
                                                                <div class="row g-lg-4 g-3">
                                                                    <div class="col-lg-4 col-md-6">
                                                                        <div class="form-error-wrap m-0">
                                                                            <select class="js-select theme-input-style w-100 form-error-wrap" name="category_id" id="category-id">
                                                                                <option value="0" selected disabled>{{translate('choose_Category')}} *</option>
                                                                                @foreach($categories as $category)
                                                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4 col-md-6">
                                                                        <div class="m-0 form-error-wrap" id="sub-category-selector">
                                                                            <div class="m-0 form-error-wrap">
                                                                                <select class="subcategory-select theme-input-style w-100"
                                                                                        name="sub_category_id" id="sub-category-id">
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4 col-md-6">
                                                                        <div class="m-0 form-floating form-floating__icon">
                                                                            <input type="number" class="form-control" name="tax" min="0"
                                                                                max="100" step="any"
                                                                                placeholder="{{translate('add_tax_percentage')}} *"
                                                                                required="" value="{{old('tax')}}">
                                                                            <label>{{translate('add_tax_percentage')}} *</label>
                                                                            <span class="material-icons">percent</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4 col-md-5">
                                                                        <div class="m-0 form-floating form-floating__icon">
                                                                            <input type="number" class="form-control"
                                                                                name="min_bidding_price" min="0" step="any"
                                                                                placeholder="{{translate('Minimum bidding price')}} *"
                                                                                required="" value="{{old('min_bidding_price')}}">
                                                                            <label>{{translate('Minimum bidding price')}} *</label>
                                                                            <span class="material-icons">price_change</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-8 col-md-7">
                                                                        <div class="m-0 form-floating taginput-dark-support">
                                                                            <input type="text" class="form-control w-100" name="tags"
                                                                                placeholder="{{translate('Enter_tags')}}"
                                                                                data-role="tagsinput">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>

                                    <h3>{{translate('price_variation')}}</h3>
                                    <section>
                                        <div class="general_wrapper mb-20">
                                            <div class="outline-wrapper">
                                                <div class="card bg-animate">
                                                    <div class="card-body">
                                                        <button type="button" class="btn bg-white text-primary bg-transparent shadow-none border-0 opacity-1 generate_btn_wrapper p-0 variation_setup_auto_fill"
                                                                id="description-en-action-btn"  data-lang="en"
                                                                data-route="{{ route('admin.product.variation-setup-auto-fill') }}">
                                                            <div class="btn-svg-wrapper">
                                                                <img width="18" height="18" class=""
                                                                     src="{{ asset(path: 'public/assets/admin-module/img/ai/blink-right-small.svg') }}" alt="">
                                                            </div>
                                                            <span class="ai-text-animation d-none" role="status">{{ translate('Just_a_second') }}</span>
                                                            <span class="btn-text">{{ translate('Generate') }}</span>
                                                        </button>
                                                        <div class="p-xxl-20 p-12px bg-light rounded">
                                                            <div class="d-flex flex-wrap gap-20 mb-0">
                                                                <div class="form-floating flex-grow-1">
                                                                    <input type="text" class="form-control" name="variant_name"
                                                                           id="variant-name"
                                                                           placeholder="{{translate('add_variant')}} *">
                                                                    <label>{{translate('add_variant')}} *</label>
                                                                </div>
                                                                <div class="form-floating flex-grow-1">
                                                                    <input type="number" class="form-control" name="variant_price"
                                                                           id="variant-price"
                                                                           placeholder="{{translate('price')}} *" value="0">
                                                                    <label>{{translate('price')}} *</label>
                                                                </div>
                                                                <button type="button" class="btn rounded btn--primary" id="service-ajax-variation">
                                                                    <span class="material-icons">add</span>
                                                                    {{translate('add')}}
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="table-responsive p-01">
                                            <table class="table align-middle table-variation">
                                                <thead id="category-wise-zone" class="text-nowrap">
                                                    @include('servicemanagement::admin.partials._category-wise-zone',['zones'=>session()->has('category_wise_zones')?session('category_wise_zones'):[]])
                                                </thead>
                                                <tbody id="variation-table">
                                                    @include('servicemanagement::admin.partials._variant-data',['zones'=>session()->has('category_wise_zones')?session('category_wise_zones'):[]])
                                                </tbody>
                                            </table>
                                        </div>
                                    </section>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        @include("servicemanagement::admin.partials.ai-sidebar")

        {{--AI assistant--}}
        <div class="floating-ai-button">
            <button type="button" class="btn btn-lg rounded-circle shadow-lg position-relative" data-bs-toggle="modal" data-bs-target="#aiAssistantModal"
                    data-action="main" title="AI Assistant">
                <span class="ai-btn-animation">
                    <span class="gradientCirc"></span>
                </span>
                <span class="position-relative z-1 text-white-absolute d-flex flex-column gap-1 align-items-center">
                    <img width="16" height="17" src="{{ asset(path: 'public/assets/admin-module/img/ai/hexa-ai.svg') }}" alt="">
                    <span class="fs-12 fw-semibold">{{ translate('Use_AI') }}</span>
                </span>
            </button>
            <div class="ai-tooltip">
                <span>{{translate("AI_Assistant")}}</span>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{asset('public/assets/admin-module')}}/js//tags-input.min.js"></script>
    <script src="{{asset('public/assets/admin-module')}}/plugins/select2/select2.min.js"></script>
    <script src="{{asset('public/assets/admin-module')}}/plugins/jquery-steps/jquery.steps.min.js"></script>
    <script src="{{asset('public/assets/provider-module')}}/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="{{asset('public/assets/admin-module/plugins/tinymce/tinymce.min.js')}}"></script>
    <script src="{{asset('public/assets/ckeditor/jquery.js')}}"></script>

    {{--AI--}}
    <script src="{{ asset('public/assets/admin-module/js/AI/products/ai-sidebar.js') }}"></script>
    <script src="{{ asset('public/assets/admin-module/js/AI/products/general-setup.js') }}"></script>
    <script src="{{ asset('public/assets/admin-module/js/AI/products/product-short-description-autofill.js') }}"></script>
    <script src="{{ asset('public/assets/admin-module/js/AI/products/product-description-autofill.js') }}"></script>
    <script src="{{ asset('public/assets/admin-module/js/AI/products/product-title-autofill.js') }}"></script>
    <script src="{{ asset('public/assets/admin-module/js/AI/products/product-variation-setup.js') }}"></script>
    <script src="{{ asset('public/assets/admin-module/js/AI/image-compressor/image-compressor.js') }}"></script>
    <script src="{{ asset('public/assets/admin-module/js/AI/image-compressor/compressor.min.js') }}"></script>
    <script>
        (function ($) {
            "use strict";

            let formWizard = $("#form-wizard");

            $('body').on('click', function (event) {
                if (!$(event.target).closest('#editor').length) {
                    if($("#editor iframe").contents().find("body").text() !== ""){
                        formWizard.find('.desc-err').remove();
                    };
                }

                if (!$(event.target).closest('[name=category_id], [name=category_id] + .select2').length) {
                    if($('[name=category_id]').val()) {
                        $('[name=category_id]').parents('.form-error-wrap').siblings('[for="category-id"]').remove();
                    }
                }
            });



            // Form validation with jQuery
            formWizard.validate({
                errorPlacement: function (error, element) {
                    element.parents('.form-floating, .form-error-wrap').after(error);
                },
                rules: {
                    "name[]": "required",
                    category_id: "required",
                    sub_category_id: "required",
                    tax: "required",
                    min_bidding_price: "required",
                    "short_description[]": "required",
                    thumbnail: "required",
                    cover_image: "required",
                    "description[]": "required",
                },
                messages: {
                    "name[]": "Please enter name",
                    category_id: "Please enter category id",
                    sub_category_id: "Please select sub category",
                    tax: "Please enter Tax",
                    min_bidding_price: "Please enter min bidding price",
                    "short_description[]": "Please enter short description",
                    thumbnail: "Please enter thumbnail",
                    cover_image: "Please upload cover image",
                    "description[]": "Please enter description",
                },
            });

            formWizard.steps({
                headerTag: "h3",
                bodyTag: "section",
                transitionEffect: "fade",
                stepsOrientation: "vertical",
                autoFocus: true,
                labels: {
                    finish: "Submit",
                    next: "Next",
                    previous: "Previous"
                },
                onStepChanging: function (event, currentIndex, newIndex) {
                    if (newIndex < currentIndex) {
                        return true;
                    }

                    if (currentIndex == 0) {
                        var errorMessageElement = formWizard.find(".desc-err");

                        if ($("#editor iframe").contents().find("body").text() == "") {
                            if (errorMessageElement.length > 0) {
                                errorMessageElement.text("Please Add Description");
                            } else {
                                formWizard.find("#editor").after(
                                    `<span class="text-danger desc-err mt-2">Please Add Description</span>`
                                );
                                return false;
                            }
                        } else {
                            formWizard.find(".desc-err").remove();
                        }
                    }

                    formWizard.validate().settings.ignore = ":disabled,:hidden";
                    return formWizard.valid();
                },
                onStepChanged: function (event, currentIndex, priorIndex) {
                    let nextBtn = $(".actions a[href='#next']");
                    if (nextBtn.hasClass("proceed-to-next")) {
                        setTimeout(function () {
                            $(".variation_setup_auto_fill").trigger("click");
                        }, 1000);
                    }
                },
                onFinished: function (event, currentIndex) {
                    event.preventDefault();
                    let isValid = true;
                    $(".desc-err").remove();

                    let variationSections = $("#variation-table");

                    // Loop through all number inputs
                    variationSections.find('input[type="number"]').each(function () {
                        let value = parseFloat($(this).val());
                        let minValue = parseFloat($(this).attr("min"));

                        if (isNaN(value) || value === "") {
                            toastr.error("Please enter a valid number");
                            isValid = false;
                        } else if (value <= 0) {
                            toastr.error("Value must be greater than zero");
                            isValid = false;
                        } else if (!isNaN(minValue) && value < minValue) {
                            toastr.error(`Minimum allowed value is ${minValue}`);
                            isValid = false;
                        }
                    });

                    if (!isValid) {
                        return false;
                    }

                    let hasRows = $("#variation-table > tr").length > 0;
                    let submitButton = formWizard.find("button[type='submit']");
                    if (submitButton.prop("disabled")) {
                        return false;
                    }
                    if (hasRows) {
                        $(".actions a[href='#finish']")
                            .css("pointer-events", "none")
                            .text("Submitting...");
                        submitButton.prop("disabled", true);
                        formWizard.off("submit").submit();
                    } else {
                        var errorMessageElement = formWizard.find(".table-row-err");
                        if (errorMessageElement.length > 0) {
                            errorMessageElement.text("Please Add Variation");
                        } else {
                            formWizard
                                .find("#variation-table")
                                .parents(".table-responsive")
                                .after(
                                    `<span class="text-danger table-row-err">Please Add Variation</span>`
                                );
                        }
                    }
                }
            });

        })(jQuery);
    </script>

    <script>
        "use strict";

        $(document).ready(function () {
            $('.js-select').select2();
            $('.subcategory-select').select2({
                placeholder: "Choose Subcategory"
            });
        });

        var variationCount = $("#variation-table > tbody > tr").length;


        $("#service-ajax-variation").on('click', function (){
            let route = "{{route('admin.service.ajax-add-variant')}}";
            let id = "variation-table";
            ajax_variation(route, id);
        })

        function ajax_variation(route, id) {

            let name = $('#variant-name').val();
            let price = $('#variant-price').val();

            if (name.length > 0 && price > 0) {
                $.get({
                    url: route,
                    dataType: 'json',
                    data: {
                        name: $('#variant-name').val(),
                        price: $('#variant-price').val(),
                    },
                    success: function (response) {
                        if (response.flag == 0) {
                            toastr.info('Already added');
                        } else {
                            $('#new-variations-table').show();
                            $('#' + id).html(response.template);
                            $('#variant-name').val("");
                            $('#variant-price').val(0);
                        }
                        variationCount++;
                    },
                });
            } else {
                if(price <= 0){
                    toastr.warning('{{translate('price can not be 0 or negative')}}');
                }else{
                    toastr.warning('{{translate('fields_are_required')}}');
                }
            }
        }

        document.querySelectorAll('.service-ajax-remove-variant').forEach(function(element) {
            element.addEventListener('click', function() {
                var route = this.getAttribute('data-route');
                var id = this.getAttribute('data-id');
                ajax_remove_variant(route, id);
            });
        });


        function ajax_remove_variant(route, id) {
            Swal.fire({
                title: "{{translate('are_you_sure')}}?",
                text: "{{translate('want_to_remove_this_variation')}}",
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
                    $.get({
                        url: route,
                        dataType: 'json',
                        data: {},
                        beforeSend: function () {
                        },
                        success: function (response) {
                            $('#' + id).html(response.template);
                        },
                        complete: function () {
                        },
                    });
                }
            })
        }

        $("#category-id").change(function (){
            let id = this.value;
            let route = "{{ url('/admin/category/ajax-childes/') }}/" + id;
            ajax_switch_category(route)
        });

        function ajax_switch_category(route) {
            $.get({
                url: route,
                dataType: 'json',
                data: {},
                beforeSend: function () {
                },
                success: function (response) {
                    $('#sub-category-selector').html(response.template);
                    $('#category-wise-zone').html(response.template_for_zone);
                    $('#variation-table').html(response.template_for_variant);
                },
                complete: function () {
                },
            });
        }

        $(document).ready(function () {
            $(".lang_link").on('click', function (e) {
                e.preventDefault();
                $(".lang_link").removeClass('active');
                $(".lang-form").addClass('d-none');
                $(".lang-form2").addClass('d-none');

                $(".title-btn-wrapper").addClass('d-none');
                $(".short-description-btn-wrapper").addClass('d-none');
                $(".description-btn-wrapper").addClass('d-none');

                $(this).addClass('active');

                let form_id = this.id;
                let lang = form_id.substring(0, form_id.length - 5);

                // show the right input(s)
                $("#" + lang + "-form").removeClass('d-none');
                $("#" + lang + "-form2").removeClass('d-none');

                // show the right button
                $("#title-" + lang + "-action-btn").removeClass('d-none');
                $("#short-description-" + lang + "-action-btn").removeClass('d-none');
                $("#description-" + lang + "-action-btn").removeClass('d-none');

            });
        });



        $(document).ready(function () {
            tinymce.init({
                selector: 'textarea.ckeditor'
            });
        });

    </script>
@endpush
