@extends('adminmodule::layouts.master')

@section('title',translate('newsletter_list'))

@push('css_or_js')
    <link rel="stylesheet" href="{{asset('public/assets/admin-module/plugins/dataTables/jquery.dataTables.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('public/assets/admin-module/plugins/dataTables/select.dataTables.min.css')}}"/>
@endpush

@section('content')
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-wrap d-flex justify-content-between flex-wrap align-items-center gap-3 mb-3">
                        <h2 class="page-title">{{translate('subscriber_list')}}</h2>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3 fz-16">{{translate('Search_Filter')}}</div>

                            <form action="{{ url()->current() }}" method="GET">
                                <div class="row gy-lg-0 gy-4">
                                    <input type="hidden" name="search" value="{{array_key_exists('search', $queryParam)?$queryParam['search']:''}}">
                                    <div class="col-lg-3 col-sm-6" id="from-filter__div">
                                        <div class="form-floating">
                                            <input type="date" class="form-control" id="from" name="from" value="{{array_key_exists('from', $queryParam)?$queryParam['from']:''}}">
                                            <label for="from">{{translate('start_date')}}</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-6" id="to-filter__div">
                                        <div class="form-floating">
                                            <input type="date" class="form-control" id="to" name="to" value="{{array_key_exists('to', $queryParam)?$queryParam['to']:''}}">
                                            <label for="to">{{translate('end_date')}}</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-6">
                                        <div class="form-floating">
                                            <select class="js-select" name="sort_by">
                                                <option value="" selected>{{translate('Select option')}}</option>
                                                <option value="latest" {{array_key_exists('sort_by', $queryParam) && $queryParam['sort_by'] == 'latest' ? 'selected' : ''}}>{{translate('latest')}}</option>
                                                <option value="oldest" {{array_key_exists('sort_by', $queryParam) && $queryParam['sort_by'] == 'oldest' ? 'selected' : ''}}>{{translate('oldest')}}</option>
                                                <option value="ascending" {{array_key_exists('sort_by', $queryParam) && $queryParam['sort_by'] == 'ascending' ? 'selected' : ''}}>{{translate('ascending')}}</option>
                                                <option value="descending" {{array_key_exists('sort_by', $queryParam) && $queryParam['sort_by'] == 'descending' ? 'selected' : ''}}>{{translate('descending')}}</option>
                                            </select>
                                            <label class="mb-2">{{translate('sort_by')}}</label>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-sm-6">
                                        <div class="form-floating">
                                            <input class="form-control" type="number" name="limit" value="{{array_key_exists('limit', $queryParam)?$queryParam['limit']:''}}">
                                            <label class="mb-2">{{translate('choose_first')}}</label>
                                        </div>
                                    </div>

                                    <div class="col-12 d-flex justify-content-end mt-3">
                                        <button type="submit" class="btn btn--primary btn-sm">{{translate('filter')}}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap justify-content-between align-items-center border-bottom mb-10 gap-3 mt-4">
                        <h4 class="page-title mb-2">{{translate('mail_list')}}</h4>
                        <div class="d-flex gap-2 fw-medium mb-2">
                            <span class="opacity-75">{{translate('Total_Subscribers')}}:</span>
                            <span class="title-color">{{$newsletters->total()}}</span>
                        </div>
                    </div>

                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="all-tab-pane">
                            <div class="card">
                                <div class="card-body">
                                    <div class="data-table-top d-flex flex-wrap gap-10 justify-content-between">
                                        <form action="{{url()->current()}}"
                                              class="search-form search-form_style-two"
                                              method="GET">
                                            <div class="input-group search-form__input_group">
                                                <span class="search-form__icon">
                                                    <span class="material-icons">search</span>
                                                </span>
                                                <input type="search" class="theme-input-style search-form__input"
                                                       value="{{array_key_exists('search', $queryParam)?$queryParam['search']:''}}" name="search"
                                                       placeholder="{{translate('search_here')}}">
                                            </div>

                                            <!-- Preserve all other filters -->
                                            <input type="hidden" name="from" value="{{ $queryParam['from'] ?? '' }}">
                                            <input type="hidden" name="to" value="{{ $queryParam['to'] ?? '' }}">
                                            <input type="hidden" name="sort_by" value="{{ $queryParam['sort_by'] ?? '' }}">
                                            <input type="hidden" name="limit" value="{{ $queryParam['limit'] ?? '' }}">

                                            <button type="submit" class="btn btn--primary">{{translate('search')}}</button>
                                        </form>
                                        @can('newsletter_export')
                                            <div class="d-flex flex-wrap align-items-center gap-3">
                                                <div class="dropdown">
                                                    <button type="button"
                                                            class="btn btn--secondary text-capitalize dropdown-toggle"
                                                            data-bs-toggle="dropdown">
                                                        <span class="material-icons">file_download</span> download
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                                        @can('newsletter_export')
                                                            <li>
                                                                <a class="dropdown-item"
                                                                   href="{{env('APP_ENV') !='demo' ? route('admin.customer.newsletter.download').
                                                                         '?search='. ($queryParam['search'] ?? '') .
                                                                         '&from='. ($queryParam['from'] ?? '') .
                                                                         '&to='. ($queryParam['to'] ?? '') .
                                                                         '&limit='. ($queryParam['limit'] ?? '') .
                                                                         '&sort_by='. ($queryParam['sort_by'] ?? '') : 'javascript:demo_mode()'}}">
                                                                    {{translate('excel')}}
                                                                </a>
                                                            </li>
                                                        @endcan
                                                    </ul>
                                                </div>
                                            </div>
                                        @endcan
                                    </div>

                                    <div class="table-responsive">
                                        <table id="example" class="table align-middle">
                                            <thead>
                                            <tr>
                                                <th>{{translate('Sl')}}</th>
                                                <th>{{translate('email')}}</th>
                                                <th>{{translate('subscribe_at')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @php
                                                $count= 0;
                                            @endphp

                                            @forelse($newsletters as $key => $newsletter)
                                                <tr>
                                                    <td>{{ (request()->get('limit') ?  $count++ : $key  )+ $newsletters->firstItem() }}</td>
                                                    <td><a href="mailto:{{ $newsletter->email }}">{{ $newsletter->email }}</a></td>
                                                    <td>{{date('d M Y h:i A ', strtotime($newsletter->created_at))}}</td>
                                                </tr>
                                            @empty
                                                <tr class="text-center">
                                                    <td colspan="8">{{translate('no data available')}}</td>
                                                </tr>
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        {!! $newsletters->links() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{asset('public/assets/admin-module/plugins/dataTables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('public/assets/admin-module/plugins/dataTables/dataTables.select.min.js')}}"></script>
@endpush
