@extends('adminmodule::layouts.new-master')

@section('title',translate('Language Setup'))

@push('css_or_js')

@endpush

@section('content')
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-wrap mb-3">
                        <h2 class="page-title">{{translate('Language_Setup')}}</h2>
                    </div>

                    <?php
                    $options = [
                        'af' => translate('Afrikaans'),
                        'sq' => translate('Albanian - shqip'),
                        'am' => translate('Amharic - አማርኛ'),
                        'ar' => translate('Arabic - العربية'),
                        'an' => translate('Aragonese - aragonés'),
                        'hy' => translate('Armenian - հայերեն'),
                        'ast' => translate('Asturian - asturianu'),
                        'az' => translate('Azerbaijani - azərbaycan dili'),
                        'eu' => translate('Basque - euskara'),
                        'be' => translate('Belarusian - беларуская'),
                        'bn' => translate('Bengali - বাংলা'),
                        'bs' => translate('Bosnian - bosanski'),
                        'br' => translate('Breton - brezhoneg'),
                        'bg' => translate('Bulgarian - български'),
                        'ca' => translate('Catalan - català'),
                        'ckb' => translate('Central Kurdish - کوردی (دەستنوسی عەرەبی)'),
                        'zh' => translate('Chinese - 中文'),
                        'zh-HK' => translate('Chinese (Hong Kong) - 中文（香港）'),
                        'zh-CN' => translate('Chinese (Simplified) - 中文（简体）'),
                        'zh-TW' => translate('Chinese (Traditional) - 中文（繁體）'),
                        'co' => translate('Corsican'),
                        'hr' => translate('Croatian - hrvatski'),
                        'cs' => translate('Czech - čeština'),
                        'da' => translate('Danish - dansk'),
                        'nl' => translate('Dutch - Nederlands'),
                        'en-AU' => translate('English (Australia)'),
                        'en-CA' => translate('English (Canada)'),
                        'en-IN' => translate('English (India)'),
                        'en-NZ' => translate('English (New Zealand)'),
                        'en-ZA' => translate('English (South Africa)'),
                        'en-GB' => translate('English (United Kingdom)'),
                        'en-US' => translate('English (United States)'),
                        'eo' => translate('Esperanto - esperanto'),
                        'et' => translate('Estonian - eesti'),
                        'fo' => translate('Faroese - føroyskt'),
                        'fil' => translate('Filipino'),
                        'fi' => translate('Finnish - suomi'),
                        'fr' => translate('French - français'),
                        'fr-CA' => translate('French (Canada) - français (Canada)'),
                        'fr-FR' => translate('French (France) - français (France)'),
                        'fr-CH' => translate('French (Switzerland) - français (Suisse)'),
                        'gl' => translate('Galician - galego'),
                        'ka' => translate('Georgian - ქართული'),
                        'de' => translate('German - Deutsch'),
                        'de-AT' => translate('German (Austria) - Deutsch (Österreich)'),
                        'de-DE' => translate('German (Germany) - Deutsch (Deutschland)'),
                        'de-LI' => translate('German (Liechtenstein) - Deutsch (Liechtenstein)'),
                        'de-CH' => translate('German (Switzerland) - Deutsch (Schweiz)'),
                        'el' => translate('Greek - Ελληνικά'),
                        'gn' => translate('Guarani'),
                        'gu' => translate('Gujarati - ગુજરાતી'),
                        'ha' => translate('Hausa'),
                        'haw' => translate('Hawaiian - ʻŌlelo Hawaiʻi'),
                        'he' => translate('Hebrew - עברית'),
                        'hi' => translate('Hindi - हिन्दी'),
                        'hu' => translate('Hungarian - magyar'),
                        'is' => translate('Icelandic - íslenska'),
                        'id' => translate('Indonesian - Indonesia'),
                        'ia' => translate('Interlingua'),
                        'ga' => translate('Irish - Gaeilge'),
                        'it' => translate('Italian - italiano'),
                        'it-IT' => translate('Italian (Italy) - italiano (Italia)'),
                        'it-CH' => translate('Italian (Switzerland) - italiano (Svizzera)'),
                        'ja' => translate('Japanese - 日本語'),
                        'kn' => translate('Kannada - ಕನ್ನಡ'),
                        'kk' => translate('Kazakh - қазақ тілі'),
                        'km' => translate('Khmer - ខ្មែរ'),
                        'ko' => translate('Korean - 한국어'),
                        'ku' => translate('Kurdish - Kurdî'),
                        'ky' => translate('Kyrgyz - кыргызча'),
                        'lo' => translate('Lao - ລາວ'),
                        'la' => translate('Latin'),
                        'lv' => translate('Latvian - latviešu'),
                        'ln' => translate('Lingala - lingála'),
                        'lt' => translate('Lithuanian - lietuvių'),
                        'mk' => translate('Macedonian - македонски'),
                        'ms' => translate('Malay - Bahasa Melayu'),
                        'ml' => translate('Malayalam - മലയാളം'),
                        'mt' => translate('Maltese - Malti'),
                        'mr' => translate('Marathi - मराठी'),
                        'mn' => translate('Mongolian - монгол'),
                        'ne' => translate('Nepali - नेपाली'),
                        'no' => translate('Norwegian - norsk'),
                        'nb' => translate('Norwegian Bokmål - norsk bokmål'),
                        'nn' => translate('Norwegian Nynorsk - nynorsk'),
                        'oc' => translate('Occitan'),
                        'or' => translate('Oriya - ଓଡ଼ିଆ'),
                        'om' => translate('Oromo - Oromoo'),
                        'ps' => translate('Pashto - پښتو'),
                        'fa' => translate('Persian - فارسی'),
                        'pl' => translate('Polish - polski'),
                        'pt' => translate('Portuguese - português'),
                        'pt-BR' => translate('Portuguese (Brazil) - português (Brasil)'),
                        'pt-PT' => translate('Portuguese (Portugal) - português (Portugal)'),
                        'pa' => translate('Punjabi - ਪੰਜਾਬੀ'),
                        'qu' => translate('Quechua'),
                        'ro' => translate('Romanian - română'),
                        'mo' => translate('Romanian (Moldova) - română (Moldova)'),
                        'rm' => translate('Romansh - rumantsch'),
                        'ru' => translate('Russian - русский'),
                        'gd' => translate('Scottish Gaelic'),
                        'sr' => translate('Serbian - српски'),
                        'sh' => translate('Serbo-Croatian - Srpskohrvatski'),
                        'sn' => translate('Shona - chiShona'),
                        'sd' => translate('Sindhi'),
                        'si' => translate('Sinhala - සිංහල'),
                        'sk' => translate('Slovak - slovenčina'),
                        'sl' => translate('Slovenian - slovenščina'),
                        'so' => translate('Somali - Soomaali'),
                        'st' => translate('Southern Sotho'),
                        'es' => translate('Spanish - español'),
                        'es-AR' => translate('Spanish (Argentina) - español (Argentina)'),
                        'es-419' => translate('Spanish (Latin America) - español (Latinoamérica)'),
                        'es-MX' => translate('Spanish (Mexico) - español (México)'),
                        'es-ES' => translate('Spanish (Spain) - español (España)'),
                        'es-US' => translate('Spanish (United States) - español (Estados Unidos)'),
                        'su' => translate('Sundanese'),
                        'sw' => translate('Swahili - Kiswahili'),
                        'sv' => translate('Swedish - svenska'),
                        'tg' => translate('Tajik - тоҷикӣ'),
                        'ta' => translate('Tamil - தமிழ்'),
                        'tt' => translate('Tatar'),
                        'te' => translate('Telugu - తెలుగు'),
                        'th' => translate('Thai - ไทย'),
                        'ti' => translate('Tigrinya - ትግርኛ'),
                        'to' => translate('Tongan - lea fakatonga'),
                        'tr' => translate('Turkish - Türkçe'),
                        'tk' => translate('Turkmen'),
                        'tw' => translate('Twi'),
                        'uk' => translate('Ukrainian - українська'),
                        'ur' => translate('Urdu - اردو'),
                        'ug' => translate('Uyghur'),
                        'uz' => translate('Uzbek - o‘zbek'),
                        'vi' => translate('Vietnamese - Tiếng Việt'),
                        'wa' => translate('Walloon - wa'),
                        'cy' => translate('Welsh - Cymraeg'),
                        'fy' => translate('Western Frisian'),
                        'xh' => translate('Xhosa'),
                        'yi' => translate('Yiddish'),
                        'yo' => translate('Yoruba - Èdè Yorùbá'),
                        'zu' => translate('Zulu - isiZulu'),
                    ];
                    ?>
                    <div class="card">
                        <div class="card-body p-30">
                            <form action="{{route('admin.language.store')}}" method="post" id="language-add-form">
                                @csrf
                                <div class="body-bg rounded p-20">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="">
                                                <div class="mb-2 text-dark d-flex align-items-center gap-1">{{translate('Language')}}
                                                    <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="{{translate('Enter the language name to add to the list')}}"
                                                    >info</i>
                                                </div>
                                                <input type="text" class="form-control" name="name" value="" placeholder="Language Name" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="country-select-whitebg only-country-picker">
                                                <div class="mb-2 text-dark d-flex align-items-center gap-1">
                                                    {{translate('Country code')}}
                                                </div>
                                                <select class="js-select" name="code" id="" required>
                                                    <option value="">{{translate('Select One')}}</option>
                                                    @foreach($options as $value => $label)
                                                        <option value="{{$value}}">{{$label}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="">
                                                <div class="mb-2 text-dark d-flex align-items-center gap-1">{{translate('Direction')}}
                                                    <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="{{translate('Direction Change , Left to Right and Right to Left')}}"
                                                    >info</i>
                                                </div>
                                                <div class="rounded form-control min-h45">
                                                    <div class="d-flex align-items-center gap-4 gap-xl-5">
                                                        <div class="custom-radio">
                                                            <input type="radio" id="ltr" name="direction" value="ltr"
                                                                checked="">
                                                            <label for="ltr">{{translate('Left to Right')}}</label>
                                                        </div>
                                                        <div class="custom-radio">
                                                            <input type="radio" id="rtl" name="direction" value="rtl">
                                                            <label for="rtl">{{translate('Right to Left')}}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @can('language_add')
                                    <div class="d-flex justify-content-end gap-3 mt-20">
                                        <button class="btn btn--secondary rounded"
                                                type="reset">{{translate('reset')}}</button>
                                        <button class="btn btn--primary rounded demo_check"
                                                type="submit">{{translate('submit')}}</button>
                                    </div>
                                @endcan
                            </form>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-body">
                            <div class="data-table-top mb-20 d-flex align-items-center flex-wrap gap-xl-3 gap-2 justify-content-between">
                                <h4 class="fw-bold text-dark">{{ translate('Language List') }}</h4>
                                <form action="#" class="search-form search-form_style-two d-flex align-items-center gap-0 border rounded" method="GET">
                                    @csrf
                                    <div class="input-group search-form__input_group bg-transparent">
                                        <input type="search" class="theme-input-style search-form__input border-0  block-size-36" name="search"
                                               placeholder="{{translate('search by code')}}"
                                               value="{{ request()?->search ?? null }}">
                                    </div>
                                    <button type="submit" class="bg-light border-0 px-2 block-size-36 rounded-end d-flex align-items-center justify-content-center">
                                        <span class="material-symbols-outlined fz-20 opacity-75">
                                            search
                                        </span>
                                    </button>
                                </form>
                            </div>

                            <div class="table-responsive">
                                <table id="example" class="table align-middle">
                                    <thead class="text-nowrap">
                                    <tr>
                                        <th>{{translate('SL')}}</th>
                                        <th class="text-center">{{translate('Language')}}</th>
                                        <th class="text-center">{{translate('Code')}}</th>
                                        @can('language_manage_status')
                                            <th class="text-center">{{translate('Status')}}</th>
                                        @endcan
                                        @canany(['language_update', 'language_delete', 'language_view', 'language_manage_status'])
                                            <th class="text-center">{{translate('action')}}</th>
                                        @endcan
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $searchValue = request()->search;

                                        $collection = collect($system_language['live_values'] ?? []);

                                        $filteredValues = $collection;

                                        if (!empty($searchValue)) {
                                            $filteredValues = $filteredValues->filter(function ($item) use ($searchValue) {
                                                return isset($item['code']) && $item['code'] == $searchValue;
                                            });
                                        }
                                        $filteredValues = $filteredValues->all();
                                    @endphp
                                    @foreach($filteredValues ?? [] as $key =>$data)
                                        <tr>
                                            <td class="text-start">{{$key+1}}</td>
                                            <td class="text-center">
                                                {{ $data['name'] ?? '' }}
                                                @if($data['default'])
                                                    <span class="badge badge-info font-weight-light fz-10">{{ translate('default') }}</span>
                                                @endif
                                            </td>
                                            <td class="text-center">{{$data['code']}}</td>
                                            @can('language_manage_status')
                                                <td class="text-center">
                                                    @if (array_key_exists('default', $data) && $data['default']==true)
                                                        <label class="switcher default-language-status mx-auto"
                                                               data-bs-toggle="modal"
                                                               data-bs-target="#deactivateAlertModal">
                                                            <input class="switcher_input"
                                                                   checked disabled
                                                                   type="checkbox" {{$data['status']?'checked':''}}>
                                                            <span class="switcher_control disabled"></span>
                                                        </label>
                                                    @elseif(array_key_exists('default', $data) && $data['default']==false)
                                                        <label class="switcher mx-auto" data-bs-toggle="modal"
                                                               data-bs-target="#deactivateAlertModal">
                                                            <input class="switcher_input language-status-update"
                                                                   data-route="{{route('admin.language.update-status',['code' =>$data['code']])}}"
                                                                   data-message="{{translate('want_to_update_status')}}"
                                                                   type="checkbox" {{$data['status']?'checked':''}}>
                                                            <span class="switcher_control"></span>
                                                        </label>
                                                    @endif
                                                </td>
                                            @endcan
                                            @canany(['language_update', 'language_delete', 'language_view', 'language_manage_status'])
                                                <td>
                                                    <div class="d-flex gap-2 justify-content-center">
                                                            @can('language_view')
                                                                <a href="{{( env('APP_ENV') == 'demo') ? 'javascript:' :route('admin.language.translate',[$data['code']]) }}" class="rounded transition fw-bold text-nowrap fz-12 fw-semibold text-primary outline-primary-hover btn-primary btn-outline-primary d-flex align-items-center gap-1 py-2 px-3">
    {{--                                                                <span class="material-symbols-outlined">translate</span> View--}}
                                                                    <img src="{{ asset('public/assets/admin-module/img/icons/translate-icon.svg') }}"> {{ translate('view') }}
                                                                </a>
                                                            @endcan
                                                            @canany(['language_manage_status', 'language_update', 'language_delete'])
                                                                <div class="btn-group">
                                                                <button type="button" class="rounded transition fw-bold text-nowrap fz-12 fw-semibold text-primary outline-primary-hover btn-primary btn-outline-primary d-flex align-items-center gap-1 py-2 px-1 d-center w-35px" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <span class="material-symbols-outlined">more_vert </span>
                                                                </button>
                                                                <div class="dropdown-menu cus-shadow2 p-3 dropdown-menu-right">
                                                                    @can('language_manage_status')
                                                                        @if($data['default']==false)
                                                                            <button class="dropdown-item mb-1 d-flex align-items-center gap-2 fz-14 text-dark default-language"
                                                                                    type="button"
                                                                                    data-message="{{translate('want_to_update_default_status')}}"
                                                                                    data-route="{{route('admin.language.update-default-status',['code' =>$data['code']])}}">
                                                                                <i class="material-symbols-outlined">schedule</i> {{ translate('Mark As Default') }}
                                                                            </button>
                                                                        @endif
                                                                    @endcan

                                                                    @can('language_update')
                                                                            <button class="dropdown-item mb-1 d-flex align-items-center gap-2 fz-14 text-dark edit-language-btn" type="button"
                                                                                    data-bs-toggle="offcanvas"
                                                                                    data-bs-target="#Edit__languageOffcanvas"
                                                                                    data-id="{{ $data['id'] }}"
                                                                                    data-name="{{ $data['name'] ?? '' }}"
                                                                                    data-code="{{ $data['code'] }}"
                                                                                    data-direction="{{ $data['direction'] }}">
                                                                                <i class="material-symbols-outlined">edit_square</i> {{ translate('Edit') }}
                                                                            </button>
                                                                    @endcan
                                                                        @can('language_delete')
                                                                            @if($data['default']==false)
                                                                                <button type="button"
                                                                                        class="{{ env('APP_ENV') == 'demo' ? 'demo_check' : 'delete-content' }} dropdown-item  d-flex align-items-center gap-2 fz-14 text-dark"
                                                                                        data-id="{{ $data['id'] }}"
                                                                                        data-url="{{route('admin.language.delete',[$data['code']])}}"
                                                                                        data-title="{{ translate('want_to_delete_this_language')}}?"
                                                                                        data-description="{{ translate('Once delete, you would not be translate this language') }}"
                                                                                        data-image="{{ asset('public/assets/admin-module/img/modal/delete-icon.svg') }}">
                                                                                    <i class="material-symbols-outlined">delete</i> {{ translate('Delete') }}
                                                                                </button>
                                                                            @endif
                                                                        @endcan
                                                                </div>
                                                            </div>
                                                            @endcanany
                                                    </div>
                                                </td>
                                            @endcanany
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Offcanvas edit -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="Edit__languageOffcanvas" aria-labelledby="Edit__languageOffcanvasLabel">
        <div class="offcanvas-header bg-white py-lg-4 py-3">
            <h2 class="mb-0">{{ translate('Edit Language') }}</h2>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <form action="" method="post" id="update-form-submit">
            @csrf

            <input type="hidden" name="code" id="language_code_hidden">

            <div class="offcanvas-body">
                <div class="d-flex flex-column gap-xl-4 gap-3">
                    <div class="">
                        <div class="mb-2 text-dark d-flex align-items-center gap-1">{{translate('Language')}}
                            <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                               data-bs-placement="top"
                               title="{{translate('Change Language name')}}"
                            >info</i>
                        </div>
                        <input type="text" class="form-control" name="name" value="" id="language_name" placeholder="Language Name" required>
                    </div>
                    <div class="country-select-whitebg only-country-picker">
                        <div class="mb-2 text-dark d-flex align-items-center gap-1">
                            {{translate('Country code')}}
                        </div>
                        <select class="js-select" name="code" id="language_code" disabled>
                            @foreach($options as $value => $label)
                                <option value="{{$value}}">{{$label}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="">
                        <div class="mb-2 text-dark d-flex align-items-center gap-1">{{translate('Direction')}}
                            <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                               data-bs-placement="top"
                               title="{{translate('Direction Change , Left to Right and Right to Left')}}"
                            >info</i>
                        </div>
                        <div class="rounded form-control min-h45">
                            <div class="d-flex align-items-center gap-4 gap-xl-5">
                                <div class="custom-radio">
                                    <input type="radio" id="ltr1" name="direction" value="ltr">
                                    <label for="ltr1">{{translate('Left to Right')}}</label>
                                </div>
                                <div class="custom-radio">
                                    <input type="radio" id="rtl1" name="direction" value="rtl">
                                    <label for="rtl1">{{translate('Right to Left')}}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="offcanvas-footer">
                @can('configuration_add')
                    <div class="d-flex justify-content-center gap-2 bg-white px-3 py-sm-3 py-2">
                        <button class="btn btn--secondary w-100 rounded"
                                type="reset">{{translate('reset')}}</button>
                        <button class="btn btn--primary w-100 rounded demo_check"
                                type="submit">{{translate('Update')}}</button>
                    </div>
                @endcan
            </div>
        </form>
    </div>

    @foreach($system_language['live_values'] ?? [] as $key =>$data)
        <div class="modal fade" id="lang-modal-update-{{$data['code']}}" tabindex="-1" role="dialog"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{translate('new_language')}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{route('admin.language.update')}}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <input type="hidden" name="code" value="{{ $data['code'] }}">
                                        <label for="message-text" class="col-form-label">{{translate('language')}}</label>
                                        <select disabled id="lang_code" class="form-control js-select2-custom">
                                            @foreach($options as $value => $label)
                                                <option
                                                    value="{{$value}}" {{ $data['code'] == $value?'selected':'' }}>{{$label}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="col-form-label">{{translate('direction')}} :</label>
                                        <select class="form-control" name="direction">
                                            <option
                                                value="ltr" {{isset($data['direction'])?$data['direction']=='ltr'?'selected':'':''}}>
                                                {{translate('LTR')}}
                                            </option>
                                            <option
                                                value="rtl" {{isset($data['direction'])?$data['direction']=='rtl'?'selected':'':''}}>
                                                {{translate('RTL')}}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">{{translate('close')}}</button>
                            <button type="submit" class="btn btn--primary">{{translate('update')}} <i
                                    class="fa fa-plus"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@push('script')
    <script>
        function default_language_status_alert() {
            toastr.warning('{{translate("default_language_can_not_be_deactive") }}!');
        }
    </script>

    <script>
        "use strict";

        $('.delete-language').on('click', function () {
            let id = $(this).data('id');
            let message = "{{translate('delete_this_language')}}?"
            @if(env('APP_ENV')!='demo')
            form_alert(id, message)
            @endif
        });

        $('.default-language').on('click', function () {
            let route = $(this).data('route');
            let message = $(this).data('message');
            @if(env('APP_ENV')!='demo')
            default_status_change(route, message)
            @endif
        });

        $('.language-status-update').on('click', function () {
            let route = $(this).data('route');
            let message = $(this).data('message');
            @if(env('APP_ENV')!='demo')
            route_alert(route, message)
            @endif
        });


        $('.default-language-status').on('click', function () {
            default_language_status_alert()
        });

        function default_status_change(route, message) {
            Swal.fire({
                title: "<?php echo e(translate('are_you_sure')); ?>?",
                text: message,
                type: 'warning',
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
                        success: function (data) {
                            console.log(data)
                            setTimeout(function () {
                                location.reload();
                            }, 1000);

                            toastr.success(data.message, {
                                CloseButton: true,
                                ProgressBar: true
                            });
                        },
                        complete: function () {

                        },
                    });
                }
            })
        }

        $(document).ready(function () {
            $('.edit-language-btn').on('click', function () {
                let name = $(this).data('name');
                let code = $(this).data('code');
                let direction = $(this).data('direction');

                // text input
                $('#language_name').val(name || code).prop('defaultValue', name || code); // set defaultValue for reset

                // select
                $('#language_code').val(code).trigger('change').find('option[value="' + code + '"]').prop('selected', true);
                $('#language_code_hidden').val(code);

                // radio buttons
                $('input[name="direction"]').prop('checked', false).prop('defaultChecked', false);
                $('input[name="direction"][value="' + direction + '"]').prop('checked', true).prop('defaultChecked', true);

                $('#update-form-submit').attr('action', '/admin/language/update');
            });
        });

        $(document).on('reset', '#language-add-form', function () {
            let $form = $(this);

            $form.find('.js-select').val('').trigger('change');
            $form.find('input[name="direction"][value="ltr"]').prop('checked', true);

        });


    </script>

@endpush
