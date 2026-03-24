@extends('adminmodule::layouts.new-master')

@section('title',translate('payment_gateway_configuration'))

@push('css_or_js')
    <link rel="stylesheet" href="{{asset('public/assets/admin-module/plugins/select2/select2.min.css')}}"/>
@endpush

@section('content')
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
                    <!-- <div
                        class="page-title-wrap d-flex justify-content-end flex-wrap align-items-center gap-3 mb-4">
                        <a href="{{route('admin.configuration.offline-payment.create')}}"
                           class="btn btn--primary">+ {{translate('Add_method')}}</a>
                    </div> -->

                    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-3">
                        <ul class="nav nav--tabs nav--tabs__style2" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link {{$type=='digital_payment'?'active':''}}"
                                   href="{{url('admin/configuration/get-third-party-config')}}?web_page=payment_config&type=digital_payment">{{translate('Digital Payment Gateways')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{$type=='offline_payment'?'active':''}}"
                                   href="{{route('admin.configuration.offline-payment.list')}}?web_page=payment_config&type=offline_payment">{{translate('Offline Payment')}}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="data-table-top d-flex align-items-center flex-wrap gap-10 justify-content-between mb-20">
                                <h4>{{translate('Offline Payment Methods List')}}</h4>
                                <div class="d-flex align-items-center gap-lg-3 gap-2 flex-wrap">
                                    <form action="#0" class="d-flex align-items-center gap-0 border rounded" method="POST">
                                        @csrf
                                        <input type="search" class="theme-input-style border-0 rounded block-size-36" value="" name="search" placeholder="{{translate('search_here')}}">
                                        <button type="submit" class="bg-light border-0 px-2 block-size-36 rounded-end d-flex align-items-center justify-content-center">
                                            <span class="material-symbols-outlined fz-20 opacity-75">
                                                search
                                            </span>
                                        </button>
                                    </form>
                                    <div class="page-title-wrap d-flex justify-content-end flex-wrap align-items-center gap-3">
                                        <a href="{{route('admin.configuration.offline-payment.create')}}" class="btn btn--primary rounded d-flex align-items-center gap-1">
                                            <span class="absolute-white-bg rounded-full d-center text-primary w-14 h-14">+</span>
                                             {{translate('Add New Method')}}
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table id="example" class="table align-start">
                                    <thead class="text-nowrap">
                                    <tr>
                                        <th>{{translate('SL')}}</th>
                                        <th>{{translate('Payment Method Name')}}</th>
                                        <th>{{translate('Payment Info')}}</th>
                                        <th>{{translate('Required Info From Customer')}}</th>
                                        <th>{{translate('Active_Status')}}</th>
                                        <th>{{translate('Action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($withdrawalMethods as $key => $withdrawalMethod)
                                        <tr>
                                            <td>{{$withdrawalMethods->firstitem()+$key}}</td>
                                            <td>{{$withdrawalMethod['method_name']}}</td>
                                            <td class="data-group">
                                                @foreach($withdrawalMethod['payment_information'] as $key=>$method_field)
                                                <div class="">
                                                    <div class="d-flex flex-column gap-2 table-data-limit">
                                                        <div class="items">
                                                            <b>{{translate('A/C No')}}:</b> {{translate($method_field['title'])}}
                                                        </div>
                                                        <div class="items">
                                                            <b>{{translate('Holder Name')}}:</b> {{ $method_field['data'] }}
                                                        </div>
                                                        <div class="items">
                                                            <b>{{translate('Bank Name')}}:</b> {{translate($method_field['title'])}}
                                                        </div>
                                                        <div class="items">
                                                            <b>{{translate('Bank Name')}}:</b> {{ $method_field['data'] }}
                                                        </div>
                                                        <div class="items">
                                                            <b>{{translate('Bank Name')}}:</b> {{translate($method_field['title'])}}
                                                        </div>
                                                        <div class="items">
                                                            <b>{{translate('Bank Name')}}:</b> {{ $method_field['data'] }}
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                                <button class="toggle-btn mt-2 fz-14 bg-transparent border-0 p-0 text-primary">See More</button>
                                            </td>
                                            <td>
                                                @foreach($withdrawalMethod['customer_information'] as $key=>$methodFields)
                                                <div class="d-flex flex-column gap-2">
                                                    <div class="py-1">
                                                        {{translate('Mobile Number (Mandatory)')}} <br> {{translate('Reference Date')}}
                                                    </div>
                                                </div>
                                                @endforeach
                                            </td>
                                            <td>
                                                <label class="switcher">
                                                    <input class="switcher_input"
                                                           data-status="{{$withdrawalMethod->id}}"
                                                           type="checkbox" {{$withdrawalMethod->is_active?'checked':''}}>
                                                    <span class="switcher_control"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <div class="table-actions gap-lg-3 gap-2">
                                                    <a href="#" class="action-btn btn--light-primary demo_check">
                                                        <i class="material-icons">visibility</i>
                                                    </a>
                                                    <!-- <a href="{{route('admin.configuration.offline-payment.edit',[$withdrawalMethod->id])}}" class="action-btn btn--light-primary demo_check">
                                                        <i class="material-icons">edit</i>
                                                    </a> -->
                                                    <a href="{{route('admin.configuration.offline-payment.create')}}" class="action-btn btn--light-primary demo_check">
                                                        <i class="material-icons">edit</i>
                                                    </a>
                                                    <button type="button" data-delete="{{$withdrawalMethod->id}}" class="action-btn btn--danger delete_section demo_check" data-bs-toggle="modal" data-bs-target="#deleteAlertModal">
                                                        <i class="material-icons">delete</i>
                                                    </button>
                                                    <form action="{{route('admin.configuration.offline-payment.delete',[$withdrawalMethod->id])}}" method="post" id="delete-{{$withdrawalMethod->id}}" class="hidden">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr class="text-center">
                                            <td colspan="8">{{translate('No_data_available')}}</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-end">
                                {!! $withdrawalMethods->links() !!}
                            </div>
                        </div>
                    </div>
                    <!--No Payment Method List--->
                    <h1 class="my-5">No Payment Method List</h1>
                    <div class="card">
                        <div class="card-body">
                            <div class="data-table-top d-flex align-items-center flex-wrap gap-10 justify-content-between mb-20">
                                <h4>{{translate('Offline Payment Methods List')}}</h4>
                                <div class="d-flex align-items-center gap-lg-3 gap-2 flex-wrap">
                                    <form action="#0" class="d-flex align-items-center gap-0 border rounded" method="POST">
                                        @csrf
                                        <input type="search" class="theme-input-style border-0 rounded block-size-36" value="" name="search" placeholder="{{translate('search_here')}}">
                                        <button type="submit" class="bg-light border-0 px-2 block-size-36 rounded-end d-flex align-items-center justify-content-center">
                                            <span class="material-symbols-outlined fz-20 opacity-75">
                                                search
                                            </span>
                                        </button>
                                    </form>
                                    <div class="page-title-wrap d-flex justify-content-end flex-wrap align-items-center gap-3">
                                        <a href="{{route('admin.configuration.offline-payment.create')}}" class="btn btn--primary rounded d-flex align-items-center gap-1">
                                            <span class="absolute-white-bg rounded-full d-center text-primary w-14 h-14">+</span>
                                             {{translate('Add New Method')}}
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table id="example" class="table align-start">
                                    <thead class="text-nowrap">
                                    <tr>
                                        <th>{{translate('SL')}}</th>
                                        <th>{{translate('Payment Method Name')}}</th>
                                        <th>{{translate('Payment Info')}}</th>
                                        <th>{{translate('Required Info From Customer')}}</th>
                                        <th>{{translate('Active_Status')}}</th>
                                        <th>{{translate('Action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center bg-white  pt-5 pb-5" colspan="7">
                                                <div class="">
                                                    <img src="{{asset('public/assets/admin-module')}}/img/payment-list-error.png" alt="error" class="w-100px mx-auto mb-3">
                                                    <p>{{translate('No Payment Method List')}}</p>
                                                    <a href="{{route('admin.configuration.offline-payment.create')}}" class="btn btn--primary rounded d-inline-flex align-items-center gap-1">
                                                        <span class="absolute-white-bg rounded-full d-center text-primary w-14 h-14">+</span>
                                                        {{translate('Add New Method')}}
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-end">
                                {!! $withdrawalMethods->links() !!}
                            </div>
                        </div>
                    </div>
                    <!-- <div class="card">
                        <div class="card-body">
                            <div class="data-table-top d-flex flex-wrap gap-10 justify-content-between">
                                <form action="{{url()->current()}}?status={{$status}}"
                                      class="search-form search-form_style-two"
                                      method="POST">
                                    @csrf
                                    <div class="input-group search-form__input_group">
                                    <span class="search-form__icon">
                                        <span class="material-icons">search</span>
                                    </span>
                                        <input type="search" class="theme-input-style search-form__input"
                                               value="{{$search}}" name="search"
                                               placeholder="{{translate('search_here')}}">
                                    </div>
                                    <button type="submit"
                                            class="btn btn--primary">{{translate('search')}}</button>
                                </form>
                            </div>

                            <div class="table-responsive">
                                <table id="example" class="table align-middle">
                                    <thead class="text-nowrap">
                                    <tr>
                                        <th>{{translate('SL')}}</th>
                                        <th>{{translate('Method_name')}}</th>
                                        <th>{{translate('payment_Information')}}</th>
                                        <th>{{translate('customer_Information')}}</th>
                                        <th>{{translate('Active_Status')}}</th>
                                        <th>{{translate('Action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($withdrawalMethods as $key => $withdrawalMethod)
                                        <tr>
                                            <td>{{$withdrawalMethods->firstitem()+$key}}</td>
                                            <td>{{$withdrawalMethod['method_name']}}</td>
                                            <td>
                                                @foreach($withdrawalMethod['payment_information'] as $key=>$method_field)
                                                    <span
                                                        class="badge badge-success opacity-75 fz-12 border border-white">
                                                    <b>{{translate('Title')}}:</b> {{translate($method_field['title'])}} |
                                                    <b>{{translate('Data')}}:</b> {{ $method_field['data'] }}
                                                </span><br/>
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach($withdrawalMethod['customer_information'] as $key=>$methodFields)
                                                    <span
                                                        class="badge badge-success opacity-75 fz-12 border border-white">
                                                    <b>{{translate('Name')}}:</b> {{translate($methodFields['field_name'])}} |
                                                    <b>{{translate('Placeholder')}}:</b> {{ $methodFields['placeholder'] }} |
                                                    <b>{{translate('Is Required')}}:</b> {{ $methodFields['is_required'] ? translate('yes') : translate('no') }}
                                                </span><br/>
                                                @endforeach
                                            </td>
                                            <td>
                                                <label class="switcher">
                                                    <input class="switcher_input"
                                                           data-status="{{$withdrawalMethod->id}}"
                                                           type="checkbox" {{$withdrawalMethod->is_active?'checked':''}}>
                                                    <span class="switcher_control"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <div class="table-actions">
                                                    <a href="{{route('admin.configuration.offline-payment.edit',[$withdrawalMethod->id])}}"
                                                       class="table-actions_edit demo_check">
                                                        <span class="material-icons">edit</span>
                                                    </a>
                                                    <button type="button" data-delete="{{$withdrawalMethod->id}}"
                                                            class="table-actions_delete bg-transparent border-0 p-0 demo_check"
                                                            data-bs-toggle="modal" data-bs-target="#deleteAlertModal"
                                                    >
                                                        <span class="material-icons">delete</span>
                                                    </button>
                                                    <form
                                                        action="{{route('admin.configuration.offline-payment.delete',[$withdrawalMethod->id])}}"
                                                        method="post" id="delete-{{$withdrawalMethod->id}}"
                                                        class="hidden">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr class="text-center">
                                            <td colspan="8">{{translate('No_data_available')}}</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-end">
                                {!! $withdrawalMethods->links() !!}
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
<script>
// $(document).ready(function () {
//     var visibleCount = 3;

//     $('.data-group').each(function () {
//         var $group = $(this);
//         var $items = $group.find('.items');
//         var $button = $group.find('.toggle-btn');

//         // Hide items beyond the first 3
//         $items.each(function (index) {
//             if (index >= visibleCount) {
//                 $(this).hide();
//             }
//         });

//         $button.on('click', function () {
//             var isCollapsed = $items.filter(':hidden').length > 0;

//             if (isCollapsed) {
//                 // Show all items
//                 $items.slideDown();
//                 $button.text('See Less');
//             } else {
//                 // Hide only items after the first 3
//                 $items.each(function (index) {
//                     if (index >= visibleCount) {
//                         $(this).slideUp();
//                     }
//                 });
//                 $button.text('See More');
//             }
//         });
//     });
// });
$(document).ready(function () {
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
});

</script>


    <script>
        "use strict"

        $('.switcher_input').on('click', function () {
            let itemId = $(this).data('status');
            let route = '{{ route('admin.configuration.offline-payment.status-update', ['id' => ':itemId']) }}';
            route = route.replace(':itemId', itemId);
            route_alert_reload(route, '{{ translate('want_to_update_status') }}');
        })

        $('.action-btn.btn--danger').on('click', function () {
            let itemId = $(this).data('delete');
            @if(env('APP_ENV')!='demo')
            form_alert('delete-' + itemId, '{{translate('want_to_delete_this')}}?')
            @endif
        })
    </script>
@endpush
