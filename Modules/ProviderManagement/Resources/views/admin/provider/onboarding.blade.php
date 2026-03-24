@extends('adminmodule::layouts.master')

@section('title',translate('onboarding_requests'))

@section('content')
    <div class="main-content">
        <div class="container-fluid">
            <div class="page-title-wrap mb-3">
                <h2 class="page-title">{{translate('Onboarding_Request')}}</h2>
            </div>

            <div
                class="d-flex flex-wrap justify-content-between align-items-center border-bottom mx-lg-4 mb-10 gap-3">
                <ul class="nav nav--tabs">
                    <li class="nav-item">
                        <a class="nav-link {{$status=='onboarding'?'active':''}}"
                           href="{{url()->current()}}?status=onboarding">
                            {{translate('Onboarding_Requests')}}
                            <sup class="c2-bg py-1 px-2 radius-50 text-white-absolute">{{$providersCount['onboarding']}}</sup>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{$status=='denied'?'active':''}}"
                           href="{{url()->current()}}?status=denied">
                            {{translate('Denied_Requests')}}
                            <sup class="c2-bg py-1 px-2 radius-50 text-white-absolute">{{$providersCount['denied']}}</sup>
                        </a>
                    </li>
                </ul>

                <div class="d-flex gap-2 fw-medium">
                    <span class="opacity-75">{{translate('Total_Requests')}}:</span>
                    <span class="title-color">{{$providers->total()}}</span>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="data-table-top align-items-center d-flex flex-wrap gap-10 justify-content-between">
                        <h4 class="m-0">{{ translate('Onboarding Request List') }}</h4>
                         <form action="{{url()->current()}}" class="d-flex align-items-center gap-0 border rounded" method="POST">
                            @csrf
                            <input type="search" class="theme-input-style border-0 rounded block-size-36" name="search" value="{{$search??''}}" placeholder="{{translate('search_here')}}">
                            <button type="submit" class="bg-light border-0 px-2 block-size-36 rounded-end d-flex align-items-center justify-content-center">
                                <span class="material-symbols-outlined fz-20 opacity-75">
                                    search
                                </span>
                            </button>
                        </form>
                    </div>

                    <div class="table-responsive">
                        <table id="example" class="table align-middle">
                            <thead>
                            <tr>
                                <th>{{translate('SL')}}</th>
                                <th>{{translate('Provider')}}</th>
                                <th>{{translate('Contact_Info')}}</th>
                                <th>{{translate('Zone')}}</th>
                                @can('onboarding_request_approve_or_deny')
                                    <th class="text-center">{{translate('Action')}}</th>
                                @endcan
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($providers as $key=>$provider)
                                <tr>
                                    <td>{{$providers->firstitem()+$key}}</td>
                                    <td>
                                        <a class="media align-items-center gap-2"
                                           href="{{route('admin.provider.onboarding_details',[$provider->id])}}">
                                            <img class=" h-50 min-w-50 w-50px radius-5"
                                                 alt="{{ translate('image') }}"
                                                 src="{{$provider->logo_full_path}}">
                                            <h5 class="media-body">
                                                {{Str::limit($provider->company_name, 30)}}
                                            </h5>
                                        </a>
                                    </td>
                                    <td>
                                        <div>
                                            <h5 class="mb-2">{{$provider->contact_person_name}}</h5>
                                            <a class="d-flex fz-12"
                                               href="tel:{{$provider->contact_person_phone}}">{{$provider->contact_person_phone}}</a>
                                            <a class="d-flex fz-12"
                                               href="mailto:{{$provider->contact_person_email}}">{{$provider->contact_person_email}}</a>
                                        </div>
                                    </td>
                                    <td>
                                        @if($provider->zone)
                                            <div class="min-w-92px">
                                                {{$provider->zone->name}}
                                            </div>
                                        @else
                                            <div
                                                class="fz-12 badge badge-danger opacity-50">{{translate('Zone is not available')}}</div>
                                        @endif
                                    </td>
                                    @can('onboarding_request_approve_or_deny')
                                        <td>
                                            <div class="table-actions justify-content-center">
                                                @if($provider->is_approved != 0)
                                                    <a type="button"
                                                       class="btn btn-soft--danger text-capitalize provider_approval"
                                                       id="button-deny-{{$provider->id}}"
                                                       data-approve="{{$provider->id}}"
                                                       data-status="deny">
                                                        {{translate('Deny')}}
                                                    </a>
                                                @endif
                                                <a type="button"
                                                   class="btn btn--success text-capitalize approval_provider"
                                                   id="button-{{$provider->id}}" data-approve="{{$provider->id}}"
                                                   data-approve="approve">
                                                    {{translate('Accept')}}
                                                </a>
                                            </div>
                                        </td>
                                    @endcan
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
                                        <div class="review-empty-state py-5">
                                            <div class="d-flex flex-column align-items-center justify-content-center py-5 gap-2 my-5">
                                                <img src="{{asset('public/assets/admin-module/img/onbording-request-empty.svg')}}" alt="No data">
                                                <h5 class="m-0 text-muted opacity-50">{{translate('No Request Found')}}</h5>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end">
                        {!! $providers->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        "use strict";

        $('.provider_approval').on('click', function () {
            let itemId = $(this).data('approve');
            let route = '{{ route('admin.provider.update-approval', ['id' => ':itemId', 'status' => 'deny']) }}';
            route = route.replace(':itemId', itemId);
            route_alert_reload(route, '{{ translate('want_to_deny_the_provider') }}', true);
        });

        $('.approval_provider').on('click', function () {
            let itemId = $(this).data('approve');
            let route = '{{ route('admin.provider.update-approval', ['id' => ':itemId', 'status' => 'approve']) }}';
            route = route.replace(':itemId', itemId);
            route_alert_reload(route, '{{ translate('want_to_approve_the_provider') }}', true);
        });

    </script>

@endpush
