@extends('layouts.landing.app')

@section('title',translate('terms_and_conditions'))

@section('content')
    @php($image = getDataSettingsImageFullPath(key: 'terms_and_conditions_image', settingType: 'pages_setup_image', path: 'page-setup/', defaultPath: asset('public/assets/admin-module/img/page-default.png')))
    <div class="container pt-3">
        <section class="page-header bg__img" data-img="{{ $image }}">
            <h3 class="title">{{translate('terms_and_conditions')}}</h3>
        </section>
    </div>
    <section class="privacy-section py-5">
        <div class="container">
            {!! bs_data_text($dataSettings,'terms_and_conditions', 1) !!}
        </div>
    </section>
@endsection
