@extends('adminmodule::layouts.new-master')

@section('title',translate('seo settings'))

@push('css_or_js')

@endpush

@section('content')
    <div class="main-content">
        <div class="container-fluid">
            <div class="card p-20 mb-20">
                <div class="">
                    <h3 class="title mb-2">{{translate('404 Logs')}}</h3>
                    <p class="m-0 fs-12">{{translate("Logs track instances where users encounter 'page not found' errors on a website")}}
                        <a href="https://6amtech.com/blog/404-logs/" target="_blank" class="text-primary text-underline font-semibold">{{translate('Learn more')}}</a>
                    </p>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header pb-0 d-flex flex-wrap justify-content-between align-items-center gap-2">
                    <div class="">
                        <h3 class="title">{{translate('404 Logs List')}}</h3>
                    </div>
                    @can('error_logs_delete')
                        <div class="mb-2">
                            <a href="javascript:void(0);"
                               class="btn btn-danger-hover bg-soft-danger text-danger border rounded border-danger text-capitalize"
                               id="clear-all-log"
                               data-action-url="{{ route('admin.business-settings.seo.error-log-bulk-destroy') }}"
                               style="display: none;">
                                <span class="material-symbols-outlined">delete</span> {{ translate('Clear Log') }}
                            </a>
                        </div>
                    @endcan
                </div>

                <div class="card-body px-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="thead-light">
                                <tr>
                                    @can('error_logs_delete')
                                        <th class="w-95px">
                                            <div class="d-flex align-items-center gap-2">
                                            <span class="check-item-2">
                                                <input type="checkbox" id="selectAll">
                                            </span>
                                            </div>
                                        </th>
                                    @endcan
                                    <th><span>{{translate('SL')}}</span></th>
                                    <th><span>{{translate('URL')}}</span></th>
                                    <th>{{translate('Hits')}}</th>
                                    <th class="text-nowrap">{{translate('Last Hit Date')}}</th>
                                    @can('error_logs_update')
                                        <th class="text-nowrap">{{translate('Redirection Link')}}</th>
                                    @endcan
                                    @can('error_logs_delete')
                                        <th>{{translate('Action')}}</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($errorLogs as $key => $errorLog)
                                <tr data-id="{{$errorLog->id}}">
                                    @can('error_logs_delete')
                                        <td class="bg-white">
                                            <div class="d-flex align-items-center gap-2">
                                            <span class="check-item-2">
                                                <input type="checkbox" name="url" value="{{ $errorLog->id }}">
                                            </span>
                                            </div>
                                        </td>
                                    @endcan
                                    <td class="bg-white"><a href="javascript:" class="text-dark">{{ $errorLogs->firstItem()+$key }}</a></td>
                                    <td class="bg-white">
                                        <a href="{{ $errorLog->url }}" target="_blank" class="text-primary text-underline">
                                            {{ $errorLog->url }}
                                        </a>
                                    </td>
                                    <td class="bg-white"><a href="javascript:" class="text-dark">{{ $errorLog->hit_counts }}</a></td>
                                    <td class="bg-white">
                                        <span class="text-nowrap">{{date('d-M-Y',strtotime($errorLog->updated_at))}} <small class="fz-12 d-block text-body">{{date('h:ia',strtotime($errorLog->updated_at))}}</small></span>
                                    </td>
                                    @can('error_logs_update')
                                        <td class="bg-white">
                                            @if($errorLog->redirect_url != null)
                                                <button type="button" class="btn rounded btn-outline-primary edit-content-btn text-capitalize add-edit-log-btn"
                                                        data-bs-toggle="offcanvas"
                                                        data-bs-target="#offcanvasLogEdit"
                                                        data-id="{{ $errorLog->id }}"
                                                        data-url="{{ $errorLog->url }}"
                                                        data-redirect_url="{{ $errorLog->redirect_url }}"
                                                        data-redirect_status="{{ $errorLog->redirect_status }}"
                                                        data-action="{{ route('admin.business-settings.seo.error-log-link', $errorLog->id) }}">
                                                    <span class="icon rounded-full text-white fz-12 d-center material-symbols-outlined">edit</span>
                                                    <span>{{ translate('Edit Link')}}</span>
                                                </button>
                                            @else
                                                <button type="button" class="btn btn--primary rounded btn-outline-primary add-content-btn text-capitalize add-edit-log-btn"
                                                        data-bs-toggle="offcanvas"
                                                        data-bs-target="#offcanvasLogEdit"
                                                        data-id="{{ $errorLog->id }}"
                                                        data-url="{{ $errorLog->url }}"
                                                        data-redirect_url="{{ $errorLog->redirect_url }}"
                                                        data-redirect_status="{{ $errorLog->redirect_status }}"
                                                        data-action="{{ route('admin.business-settings.seo.error-log-link', $errorLog->id) }}">
                                                    <span class="icon rounded-full text-white fz-12 d-center bg-primary material-symbols-outlined">add</span>
                                                    <span>{{translate('Add Link')}}</span>
                                                </button>
                                            @endif
                                        </td>
                                    @endcan
                                    @can('error_logs_delete')
                                        <td class="bg-white">
                                            <button type="button"
                                                    class="action-btn btn--danger delete-log"
                                                    data-id="delete-{{$errorLog->id}}"
                                                    style="--size: 30px"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#delete-modal"
                                                    data-action="{{route('admin.business-settings.seo.error-log-destroy',[$errorLog->id])}}">
                                                <span class="material-symbols-outlined">delete</span>
                                            </button>
                                        </td>
                                    @endcan
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center bg-white  pt-5 pb-5" colspan="7">
                                        <div class="d-flex flex-column gap-2">
                                            <img src="{{asset('public/assets/admin-module')}}/img/log-list-error.svg" alt="error" class="w-100px mx-auto">
                                            <p>{{translate('data not found')}}</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end">
                        {!! $errorLogs->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasLogEdit" aria-labelledby="offcanvasLogEditLabel">
        <div class="offcanvas-header py-3 ">
            <h2 class="mb-0">Redirection link</h2>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <form action="" method="post" id="update-form-submit">
            @csrf
            <div class="offcanvas-body">
                <div class="d-flex flex-column gap-xl-4 gap-3">
                    <div class="message-textarea">
                        <div class="mb-2 text-dark d-flex align-items-center gap-1">{{translate('Redirection link')}}
                            <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                               data-bs-placement="top"
                               title="{{translate('Enter the URL you want users to be redirected to when they visit the broken (404) link')}}"
                            >info</i>
                        </div>
                        <input type="text" class="form-control" name="redirection_link" id="edit-redirection-link" placeholder="redirection link">
                    </div>
                    <div class="message-textarea">
                        <div class="mb-2 text-dark d-flex align-items-center gap-1">{{translate('Status')}}
                            <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                               data-bs-placement="top"
                               title="{{translate('301: Permanent redirect (good for SEO) and 302: Temporary redirect (URL may change later)')}}"
                            >info</i>
                        </div>
                        <div class="border setup-box p-12 rounded d-flex align-items-center gap-xl-5 gap-3">
                            <div class="custom-radio">
                                <input type="radio" id="301_status" name="redirect_status" value="301">
                                <label for="301_status" class="fz-14">301</label>
                            </div>
                            <div class="custom-radio">
                                <input type="radio" id="302_status" name="redirect_status" value="302">
                                <label for="302_status" class="fz-14">302</label>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="offcanvas-footer">
                <div class="d-flex justify-content-center gap-2 bg-white px-3 py-sm-3 py-2">
                    <button type="reset" class="btn btn--secondary rounded w-100 px-3 px-sm-4 flex-grow-1">{{ translate('reset') }}</button>
                    <button type="submit" class="btn btn--primary rounded w-100 px-3 px-sm-4 flex-grow-1">
                        {{ translate('update') }}
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="delete-modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                    </div>
                </div>
                <div class="modal-body text-center pb-4">
                    <div class="mx-auto text-center rounded-full bg-danger d-center text-white max-w80 mb-20">
                        <span class="material-symbols-outlined fz-30"> delete</span>
                    </div>
                    <h3 class="modal-title w-100 text-center mb-2">{{translate('Do you want to delete this URL?')}}</h3>
                    <p class="fz-14 mb-4">{{ translate('You can not undo this after deleting this logs') }}</p>
                   <form action="" method="post">
                       @csrf
                       @method('DELETE')

                       <div class="d-flex align-items-center gap-2 justify-content-center">
                           <button type="button" class="btn min-w128 rounded btn--secondary" data-bs-dismiss="modal">{{ translate('No') }}</button>
                           <button type="submit" class="btn min-w128 rounded btn--danger">{{ translate('Yes, Delete') }}</button>
                       </div>
                   </form>

                </div>
            </div>
        </div>
    </div>

    <!-- modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="deleteConfirmModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                    </div>
                </div>
                <div class="modal-body text-center pb-4">
                    <div class="mx-auto text-center rounded-full bg-danger d-center text-white max-w80 mb-20">
                        <span class="material-symbols-outlined fz-30"> delete</span>
                    </div>
                    <h3 class="modal-title w-100 text-center mb-2">{{translate('Do you want to delete selected Logs?')}}</h3>
                    <p class="fz-14 mb-4">{{ translate('You cannot undo this after deleting the selected logs.') }}</p>

                    <div class="d-flex align-items-center gap-2 justify-content-center">
                        <button type="button" class="btn min-w128 rounded btn--secondary" data-bs-dismiss="modal">{{ translate('No') }}</button>
                        <button type="submit" class="btn min-w128 rounded btn--danger" id="confirmDeleteBtn">{{ translate('Yes, Delete') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script>
        "use strict"


        $(document).ready(function () {
            const $selectAll = $('#selectAll');
            const $individualCheckboxes = $('input[name="url"]');
            const $clearAllBtn = $('#clear-all-log');

            $clearAllBtn.hide();

            // Handle Select All
            $selectAll.on('change', function () {
                const isChecked = $(this).is(':checked');
                $individualCheckboxes.prop('checked', isChecked);
                $clearAllBtn.toggle(isChecked);
            });

            // Handle individual checkboxes
            $(document).on('change', 'input[name="url"]', function () {
                const total = $individualCheckboxes.length;
                const checked = $('input[name="url"]:checked').length;

                $selectAll.prop('checked', total === checked);
                $clearAllBtn.toggle(checked > 0);
            });

            // Clear all button click
            $clearAllBtn.on('click', function (e) {
                e.preventDefault();

                const selectedLogs = $('input[name="url"]:checked')
                    .map(function () {
                        return $(this).val();
                    })
                    .get();

                if (selectedLogs.length === 0) {
                    toastr.warning('Please select at least one log to delete.');
                    return;
                }

                const actionUrl = $(this).data('action-url');

                // Show modal
                $('#deleteConfirmModal').modal('show');

                // Confirm delete action
                $('#confirmDeleteBtn').off('click').on('click', function () {
                    $.ajax({
                        url: actionUrl,
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            log_ids: selectedLogs
                        },
                        success: function () {
                            toastr.success('Selected logs have been deleted.');
                            location.reload();
                        },
                        error: function () {
                            toastr.error('Something went wrong while deleting logs.');
                            location.reload();
                        }
                    });

                    // Close modal after confirm
                    $('#deleteConfirmModal').modal('hide');
                });
            });
        });



        $(document).on('click', '.add-edit-log-btn', function () {
            const button = $(this);
            const id = button.data('id');
            const url = button.data('url');
            const redirectUrl = button.data('redirect_url');
            const redirectStatus = button.data('redirect_status');
            const actionUrl = button.data('action');

            const offcanvas = $('#offcanvasLogEdit');

            offcanvas.find('form').attr('action', actionUrl);


            // text input
            offcanvas.find('#edit-redirection-link').val(redirectUrl).prop('defaultValue', redirectUrl);
            // radio buttons
            offcanvas.find('input[name="redirect_status"]').prop('checked', false).prop('defaultChecked', false);
            offcanvas.find(`input[name="redirect_status"][value="${redirectStatus}"]`)
                .prop('checked', true)
                .prop('defaultChecked', true);
        });

        $(document).on('click', '.delete-log', function () {
            const button = $(this);
            const id = button.data('id');
            const actionUrl = button.data('action');

            const modal = $('#delete-modal');

            modal.find('form').attr('action', actionUrl);
        });

    </script>
@endpush
