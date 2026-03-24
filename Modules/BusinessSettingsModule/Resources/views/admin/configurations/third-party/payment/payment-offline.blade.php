<div class="tab-pane fade {{ request()->has('type') && request()->type == 'offline_payment' ? 'show active' : '' }}" id="payment-tabs2" role="tabpanel" aria-labelledby="payment-custom-tab2" tabindex="0">
    <div class="bg-warning bg-opacity-10 fs-12 p-12 text-dark rounded mb-10">
        <div class="d-flex align-items-center gap-2 mb-2">
            <img src="{{ asset('public/assets/admin-module/img/icons/alert_info.svg') }}" alt="alert info icon">
            <p class="fz-12 fw-medium">{{ translate('In this section, you can add offline payment methods to make them available as offline payment options for the customers') }}</p>
        </div>
        <ul class="m-0 ps-20 d-flex flex-column gap-1 text-dark">
            <li>{{ translate('To use offline payments, you need to set up at least one offline payment method.') }}</li>
            <li>{{ translate('To make available these payment options, you must enable the Offline payment option from ') }}<a @can('business_view') href="{{ route('admin.business-settings.get-business-information') }}" @endcan class="fw-semibold text-primary text-decoration-underline" target="_blank">{{ translate('Business Information') }}</a> {{ translate('page.') }} </li>
        </ul>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="data-table-top d-flex align-items-center flex-wrap gap-10 justify-content-between mb-20">
                <h4>{{translate('Offline Payment Methods List')}}</h4>
                <div class="d-flex align-items-center gap-lg-3 gap-2 flex-wrap">
                    <form action="{{ route('admin.configuration.third-party', ['webPage'=>'payment_config']) }}" class="d-flex align-items-center gap-0 border rounded" method="GET">
                        <input type="hidden" name="type" value="offline_payment">
                        <input type="search" class="theme-input-style border-0 rounded block-size-36" value="{{ request()->input('search') }}" name="search" placeholder="{{translate('search_by_method_name')}}">
                        <button type="submit" class="bg-light border-0 px-2 block-size-36 rounded-end d-flex align-items-center justify-content-center">
                                            <span class="material-symbols-outlined fz-20 opacity-75">
                                                search
                                            </span>
                        </button>
                    </form>

                    @can('payment_method_add')
                        <div class="page-title-wrap d-flex justify-content-end flex-wrap align-items-center gap-3">
                            <a href="{{route('admin.configuration.offline-payment.create')}}" class="btn btn--primary rounded d-flex align-items-center gap-1">
                                <span class="absolute-white-bg rounded-full d-center text-primary w-14 h-14">+</span>
                                {{translate('Add New Method')}}
                            </a>
                        </div>
                    @endcan
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
                    @forelse($data['withdrawalMethods'] as $key => $withdrawalMethod)
                        <tr>
                            <td>{{$data['withdrawalMethods']->firstitem()+$key}}</td>
                            <td>{{$withdrawalMethod['method_name']}}</td>
                            <td class="data-group">
                                @foreach ($withdrawalMethod['payment_information'] as $item)
                                    <div class="items">{{ ucwords(str_replace('_',' ',$item['title'])) }}
                                        : {{ $item['data'] }}</div>
                                @endforeach
                                @if(count($withdrawalMethod['payment_information']) > 3)
                                        <button class="toggle-btn mt-2 fz-14 bg-transparent border-0 p-0 text-primary">See
                                            More
                                        </button>
                                @endif
                            </td>
                            <td>
                                @foreach($withdrawalMethod['customer_information'] as $item)
                                    <div class="d-flex flex-column gap-2">
                                        <div class="py-1">
                                            {{ ucwords(str_replace('_',' ',$item['field_name'])) }} {{ $item['is_required'] ? translate('(mandatory)') : '' }}
                                            <br>
                                        </div>
                                    </div>
                                @endforeach
                            </td>
                            <td>
                                @can('payment_method_manage_status')
                                    <label class="switcher">
                                        <input type="checkbox"
                                               @checked($withdrawalMethod->is_active)
                                               class="update-status-modal switcher_input"
                                               data-id="{{ $withdrawalMethod->id }}"
                                               data-url="{{ route('admin.configuration.offline-payment.status-update', $withdrawalMethod->id) }}"
                                               data-on-title="{{ translate('want_to_Turn_ON_') . $withdrawalMethod->method_name . translate('payment_method') }}?"
                                               data-off-title="{{ translate('want_to_Turn_OFF_') . $withdrawalMethod->method_name . translate('payment_method') }}?"
                                               data-on-description="{{ translate('If enabled customers can only pay through this payment methods') }}"
                                               data-off-description="{{ translate('If disabled customers can not pay through this payment methods') }}"
                                               data-on-image="{{ asset('public/assets/admin-module/img/modal/offline-payment-method.svg') }}"
                                               data-off-image="{{ asset('public/assets/admin-module/img/modal/offline-payment-method.svg') }}"
                                               data-cancel-button-text="{{ translate('Cancel') }}"
                                               data-confirm-button-text="{{ translate('Ok') }}">
                                        <span class="switcher_control"></span>
                                    </label>
                                @endcan
                            </td>
                            <td>
                                <div class="table-actions gap-lg-3 gap-2">
                                    @can('payment_method_update')
                                        <a href="{{route('admin.configuration.offline-payment.edit', $withdrawalMethod->id)}}" class="action-btn btn--light-primary demo_check">
                                            <i class="material-icons">edit</i>
                                        </a>
                                    @endcan
                                    @can('payment_method_delete')
                                            <button type="button"
                                                    class="delete-content action-btn btn--danger demo_check"
                                                    data-id="{{ $withdrawalMethod->id }}"
                                                    data-url="{{ route('admin.configuration.offline-payment.delete', $withdrawalMethod->id) }}"
                                                    data-title="{{ translate('want_to_delete_') . $withdrawalMethod->method_name . translate('payment_method') }}?"
                                                    data-description="{{ translate('You will not be able to revert this!') }}"
                                                    data-image="{{ asset('public/assets/admin-module/img/modal/delete-icon.svg') }}">
                                                <i class="material-icons">delete</i>
                                            </button>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center bg-white  pt-5 pb-5" colspan="7">
                                <div class="">
                                    <img src="{{asset('public/assets/admin-module')}}/img/payment-list-error.png" alt="error" class="w-100px mx-auto mb-3">
                                    <p>{{translate('No Payment Method List')}}</p>
                                    @if(!request()->filled('search'))
                                        <a href="{{route('admin.configuration.offline-payment.create')}}" class="btn btn--primary rounded d-inline-flex align-items-center gap-1">
                                            <span class="absolute-white-bg rounded-full d-center text-primary w-14 h-14">+</span>
                                            {{translate('Add New Method')}}
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end">
                {!! $data['withdrawalMethods']->links() !!}
            </div>
        </div>
    </div>
</div>
