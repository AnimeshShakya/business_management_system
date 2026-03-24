@extends('layouts.landing.app')

@section('title',translate('cancellation_policy'))

@section('content')
    @php($image = getDataSettingsImageFullPath(key: 'cancellation_policy_image', settingType: 'pages_setup_image', path: 'page-setup/', defaultPath: asset('public/assets/admin-module/img/page-default.png')))

    <div class="container pt-3">
        <section class="page-header bg__img" data-img="{{ $image }}">
            <h3 class="title">{{translate('cancellation_policy')}}</h3>
        </section>
    </div>
    <section class="privacy-section py-5">
        <div class="container">
            {!! bs_data_text($dataSettings,'cancellation_policy', 1) !!}
        </div>
    </section>
@endsection
