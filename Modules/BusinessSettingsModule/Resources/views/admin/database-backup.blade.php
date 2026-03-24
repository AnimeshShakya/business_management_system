@extends('adminmodule::layouts.new-master')

@section('title',translate('database_backup'))

@push('css_or_js')

@endpush

@section('content')
    <div class="main-content">
        <div class="container-fluid">

            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between gap-2">
                    <div class="page-title-wrap">
                        <h3 class="mb-2">{{translate('database_Backup')}}</h3>
                        <p class="text-muted fs-12">{{ translate('Safe guard Your Information with Database Backups') }}</p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="bg-light p-20 rounded mb-20">
                        <div class="d-flex flex-column gap-2 align-items-start text-start mb-4">
                            <h4 class="fw-normal d-flex align-items-center gap-2">{{ translate('Update DUMP_BINARY_PATH') }}
                                <i class="material-icons fz-16 text-light-gray" data-bs-toggle="tooltip"
                                   data-bs-placement="top"
                                   title="{{translate('Find your mysqldump location and update here. Most of the time it is /usr/bin/. In case you are using differently, find your mysqldump by running command which mysqldump or locate mysqldump from your terminal, or ask your server provider')}}"
                                >info</i>
                            </h4>
                        </div>
                        <form action="{{route('admin.business-settings.database-backup.update-binary-path')}}" method="post">
                            @csrf
                            <div class="d-flex flex-wrap gap-3">
                                <input type="text" name="binary_path" value="{{env('DUMP_BINARY_PATH')}}" class="form-control w-0 flex-grow-1" placeholder="{{ translate('/usr/bin') }}">
                                <button type="submit" class="btn px-xl-5 btn--primary radius-button text-end demo_check rounded">{{translate('Update')}}</button>
                            </div>
                        </form>
                    </div>
                    <div class="pick-map p-12 rounded d-flex flex-md-nowrap flex-wrap align-items-center gap-1 bg-primary bg-opacity-10">
                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_9464_2249)">
                            <path d="M9.79125 1.44318L10.5117 0.270677C10.6797 -0.00465646 11.039 -0.0898231 11.3138 0.0793436C11.5885 0.247927 11.6743 0.606677 11.5051 0.881427L10.7847 2.05393C10.675 2.23359 10.4831 2.33218 10.2871 2.33218C10.1827 2.33218 10.0777 2.30418 9.98259 2.24584C9.70784 2.07726 9.62209 1.71793 9.79125 1.44318ZM3.16575 2.05334C3.27542 2.23301 3.46792 2.33218 3.66392 2.33218C3.76775 2.33218 3.87275 2.30418 3.96784 2.24643C4.24259 2.07784 4.32892 1.71909 4.16034 1.44434L3.44109 0.27126C3.2725 -0.00348977 2.91317 -0.0892398 2.639 0.0787602C2.36425 0.247344 2.27792 0.606094 2.4465 0.880844L3.16575 2.05334ZM1.89059 3.34134L0.841754 2.83909C0.552421 2.69851 0.201838 2.82218 0.0641712 3.11326C-0.0752455 3.40376 0.0478378 3.75201 0.338338 3.89084L1.38717 4.39309C1.46825 4.43218 1.554 4.45084 1.63859 4.45084C1.85617 4.45084 2.065 4.32893 2.16475 4.11951C2.30417 3.82901 2.18109 3.48018 1.89059 3.34134ZM6.92067 2.33393C3.70417 2.38701 1.155 5.87301 2.9015 9.23068C3.16692 9.74051 3.56067 10.1675 3.98359 10.5566C4.144 10.7042 4.26825 10.8868 4.37442 11.0828H6.41667V8.05876C5.73942 7.81726 5.25 7.17559 5.25 6.41609C5.25 6.09351 5.51075 5.83276 5.83334 5.83276C6.15592 5.83276 6.41667 6.09351 6.41667 6.41609C6.41667 6.73868 6.678 6.99943 7 6.99943C7.322 6.99943 7.58334 6.73809 7.58334 6.41609C7.58334 6.09409 7.84409 5.83276 8.16667 5.83276C8.48925 5.83276 8.75 6.09351 8.75 6.41609C8.75 7.17559 8.26059 7.81726 7.58334 8.05876V11.0828H9.60634C9.73934 10.8547 9.91084 10.6394 10.1354 10.4522C10.5198 10.1313 10.8815 9.77376 11.1038 9.32518C12.117 7.27593 11.7151 5.09076 10.2719 3.67209C9.373 2.78776 8.18242 2.31468 6.92067 2.33393ZM4.662 12.4122C4.61534 13.2673 5.25584 14 6.11217 14H7.87442C8.68 14 9.33275 13.3473 9.33275 12.5417V12.25H4.65559C4.65559 12.3048 4.6655 12.3562 4.662 12.4122ZM13.9493 3.09168C13.8163 2.79826 13.4715 2.66584 13.1781 2.80001L12.0511 3.30868C11.7571 3.44109 11.6264 3.78643 11.7594 4.07984C11.8568 4.29568 12.0686 4.42343 12.2914 4.42343C12.3713 4.42343 12.453 4.40709 12.5306 4.37151L13.6576 3.86284C13.9516 3.73043 14.0823 3.38509 13.9493 3.09168Z" fill="#3C76F1"/>
                            </g>
                            <defs>
                            <clipPath id="clip0_9464_2249">
                            <rect width="14" height="14" fill="white"/>
                            </clipPath>
                            </defs>
                        </svg>
                        <p class="fz-12">{{ translate('If your servers DUMP BINARY PATH does not match the following input field path, you must update it.') }}</p>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <div class="row g-lg-4 g-3">
                        <div class="col-lg-6">
                            <div class="bg-light p-20 rounded">
                                <div class="d-flex flex-column gap-2 mb-30">
                                    <h4>{{ translate('Backup To Server & Download') }}</h4>
                                    <p>
                                        {{ translate('Backup your database and download the file instantly') }}
                                    </p>
                                </div>
                                <a class="btn btn--secondary rounded text-capitalize {{ env('APP_ENV') != 'demo' ? 'db-backup' : 'demo_check' }} db-download"
                                   data-route="{{route('admin.business-settings.backup-database-backup', ['download' => 1])}}"
                                   data-message="{{translate('Want to take new backup').'?'}}">
                                    <span class="material-icons">backup</span>
                                    {{translate('Backup to Server & Download')}}
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="bg-light p-20 rounded">
                                <div class="d-flex flex-column gap-2 mb-30">
                                    <h4>{{ translate('Take A New Backup On Your Server') }}</h4>
                                    <p>
                                        {{ translate('Saves a backup that stays only on the server.') }}
                                    </p>
                                </div>
                                @can('backup_view')
                                    <a class="btn btn--primary rounded {{ env('APP_ENV') != 'demo' ? 'db-backup' : 'demo_check' }} text-capitalize"
                                    data-route="{{route('admin.business-settings.backup-database-backup', ['download' => 0])}}"
                                    data-message="{{translate('Want to take new backup').'?'}}">
                                        <span class="material-icons">backup</span> {{translate('Take a New Backup On your Server')}}
                                    </a>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex flex-wrap justify-content-end align-items-center border-bottom mx-lg-4 mb-10 gap-3">
                <div class="d-flex gap-2 fw-medium mb-1">
                    <span class="opacity-75">{{translate('Total_Backup_Databases')}}:</span>
                    <span class="title-color">{{count($fileNames)}}</span>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="data-table-top mb-20 d-flex align-items-center flex-wrap gap-xl-3 gap-2 justify-content-between">
                        <h4 class="fw-bold text-dark">{{translate('Page List')}}</h4>
                        <form action="{{ url()->current() }}" class="search-form search-form_style-two d-flex align-items-center gap-0 border rounded" method="GET">
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
                    </div>
                    <div class="table-responsive">
                        <table id="example" class="table align-middle">
                            <thead>
                            <tr>
                                <th>{{translate('SL')}}</th>
                                <th>{{translate('File_Name')}}</th>
                                <th>{{translate('Backup Time')}}</th>
                                <th>{{translate('File Size')}}</th>
                                @canany(['backup_delete', 'backup_export', 'backup_add'])
                                    <th class="text-center">{{translate('action')}}</th>
                                @endcan
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($fileNames as $key=>$file)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$file['name']}}</td>
                                    <td>{{$file['last_modified']}}</td>
                                    <td>{{$file['size']}}</td>
                                    @canany(['backup_delete', 'backup_export', 'backup_add'])
                                        <td>
                                            <div class="d-flex gap-2 justify-content-center">
                                                @can('backup_add')
                                                    <button type="button" class="action-btn btn--light-primary db-restore demo_check"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="{{ env('APP_ENV') != 'demo' ? '#restoreModal_' . $key : '' }}"
                                                            title="{{ translate('Restore') }}">
                                                        <span class="material-icons">settings_backup_restore</span>
                                                    </button>
                                                    <div class="modal fade" id="restoreModal_{{$key}}" tabindex="-1" aria-labelledby="restoreModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-body p-30">
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    <div class="d-flex flex-column gap-2 align-items-center text-center">
                                                                        <img class="mb-3" src="{{asset('public/assets/admin-module')}}/img/ad_delete.svg" alt="">
                                                                        <h3 class="mb-2">{{ translate('Are you sure you want to restore this backup') }}?</h3>
                                                                        <p>{{ translate('This action will replace the current database with the selected backup. Any unsaved changes made after the backup date will be lost.') }}</p>
                                                                        <div class="d-flex gap-3 justify-content-center flex-wrap">
                                                                            <button type="button" class="btn btn--secondary text-capitalize" class="btn-close" data-bs-dismiss="modal">{{ translate('Cancel') }}</button>
                                                                            <a class="btn btn--primary text-capitalize demo_check" href="{{route('admin.business-settings.restore-database-backup',[$file['name']])}}">{{ translate('Restore Backup') }}</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endcan
                                                @can('backup_export')
                                                        <button type="button" class="action-btn btn--success {{ env('APP_ENV') != 'demo' ? 'db-backup' : 'demo_check' }}" title="{{ translate('Download') }}"
                                                                data-route="{{route('admin.business-settings.download-database-backup',[$file['name']])}}"
                                                                data-message="{{translate('Do you really want to download the database locally')}}">
                                                            <span class="material-icons">download</span>
                                                        </button>
                                                @endcan
                                                @can('backup_export')
                                                        <button type="button" class="action-btn btn--danger {{ env('APP_ENV') != 'demo' ? 'db-backup' : 'demo_check' }}" title="{{ translate('Remove') }}"
                                                                data-route="{{route('admin.business-settings.delete-database-backup', urlencode($file['name']))}}"
                                                                data-message="{{translate('Do you really want to delete this file')}}">
                                                            <span class="material-icons">delete</span>
                                                        </button>
                                                @endcan
                                            </div>
                                        </td>
                                    @endcan
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="5">{{translate('No backup of the database has been taken yet')}}</td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script>
        "use strict";

        $('.db-download').on('click', function () {
            setTimeout(function() {
                location.reload();
            }, 5000);
        });

        $('.db-backup').on('click', function () {
            let route = $(this).data('route');
            let message = $(this).data('message');
            database_backup_modification(route, message)
        });

        function database_backup_modification(route, message) {
            Swal.fire({
                title: "{{translate('are_you_sure')}}?",
                text: message,
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
                    location.href = route;
                }
            })
        }
    </script>
@endpush
