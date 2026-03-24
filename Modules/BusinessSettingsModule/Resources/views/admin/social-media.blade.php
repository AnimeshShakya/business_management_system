@extends('adminmodule::layouts.new-master')

@section('title',translate('social_media'))

@push('css_or_js')

@endpush

@section('content')
    <div class="main-content">
        <div class="container-fluid">

            <h3 class="mb-15">{{translate('Social Media')}}</h3>
            <div class="card mb-15">
                <div class="card-body p-20">
                    <div class="mb-20">
                        <h4 class="mb-1">{{translate('Setup Social Media Link')}}</h4>
                        <p class="fz-12">{{translate('Here you can add your social media links. This will help you to show your social activity to the customers.')}}</p>
                    </div>
                    <form action="{{ route('admin.social-media.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="discount-type body-bg rounded p-20 mb-20">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="">
                                        <label class="mb-2 text-dark d-flex align-items-center gap-1">{{translate('Select Social Media')}}
                                            <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                               data-bs-placement="top"
                                               title="{{translate('Select the social media platform you want to add to the list.')}}">info</i>
                                        </label>
                                        <select class="js-select select-dark-color theme-input-style w-100" name="media" required>
                                            <option value="" selected disabled>---{{translate('Select_media')}}---</option>
                                            <option value="facebook">{{translate('Facebook')}}</option>
                                            <option value="instagram">{{translate('Instagram')}}</option>
                                            <option value="linkedin">{{translate('LinkedIn')}}</option>
                                            <option value="twitter">{{translate('Twitter')}}</option>
                                            <option value="youtube">{{translate('Youtube')}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="">
                                        <label class="mb-2 text-dark d-flex align-items-center gap-1">{{translate('Social Media Link')}}
                                            <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                               data-bs-placement="top"
                                               title="{{translate('Paste the correct link for your chosen social media.')}}">info</i>
                                        </label>
                                        <div class="">
                                            <input type="text" class="form-control" name="link" placeholder="{{translate('link')}}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @can('page_add')
                            <div class="d-flex gap-2 justify-content-end">
                                <button type="reset" class="btn btn--secondary rounded">{{translate('reset')}}</button>
                                <button type="submit" class="btn btn--primary rounded">{{translate('Save')}}</button>
                            </div>
                        @endcan
                    </form>
                </div>
            </div>

            <div class="mb-15 bg-warning bg-opacity-10 fs-12 p-10 rounded d-flex gap-2 align-items-center">
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7 0C3.13414 0 0 3.13414 0 7C0 10.8659 3.13414 14 7 14C10.8659 14 14 10.8659 14 7C14 3.13414 10.8659 0 7 0ZM7.88648 9.94164C7.88648 10.0581 7.86355 10.1733 7.81901 10.2809C7.77446 10.3884 7.70916 10.4862 7.62684 10.5685C7.54452 10.6508 7.4468 10.7161 7.33924 10.7606C7.23169 10.8052 7.11641 10.8281 7 10.8281C6.88359 10.8281 6.76831 10.8052 6.66076 10.7606C6.5532 10.7161 6.45548 10.6508 6.37316 10.5685C6.29084 10.4862 6.22554 10.3884 6.18099 10.2809C6.13645 10.1733 6.11352 10.0581 6.11352 9.94164V6.39543C6.11352 6.27902 6.13645 6.16374 6.18099 6.05619C6.22554 5.94863 6.29084 5.85091 6.37316 5.76859C6.45548 5.68627 6.5532 5.62098 6.66076 5.57642C6.76831 5.53187 6.88359 5.50895 7 5.50895C7.11641 5.50895 7.23169 5.53187 7.33924 5.57642C7.4468 5.62098 7.54452 5.68627 7.62684 5.76859C7.70916 5.85091 7.77446 5.94863 7.81901 6.05619C7.86355 6.16374 7.88648 6.27902 7.88648 6.39543V9.94164ZM7 4.94484C6.82467 4.94484 6.65328 4.89285 6.5075 4.79544C6.36171 4.69804 6.24809 4.55959 6.18099 4.3976C6.1139 4.23562 6.09634 4.05738 6.13055 3.88541C6.16475 3.71345 6.24918 3.5555 6.37316 3.43152C6.49714 3.30754 6.65509 3.22311 6.82706 3.18891C6.99902 3.1547 7.17726 3.17226 7.33924 3.23935C7.50123 3.30645 7.63968 3.42007 7.73708 3.56586C7.83449 3.71164 7.88648 3.88303 7.88648 4.05836C7.88652 4.17478 7.86362 4.29008 7.81908 4.39764C7.77454 4.50521 7.70924 4.60295 7.62692 4.68528C7.54459 4.7676 7.44685 4.8329 7.33928 4.87744C7.23172 4.92197 7.11643 4.94488 7 4.94484Z" fill="#FFBB38"/>
                </svg>
                <span>{{ translate('Those social media links are visible in footer section of the websites') }}</span>
            </div>

            <div class="card">
                <div class="card-body p-20">
                    <div class="table-responsive table-custom-responsive">
                        <table id="example" class="table align-middle">
                            <thead class="text-nowrap">
                            <tr>
                                <th class="text-dark fw-medium bg-light">{{translate('Sl')}}</th>
                                <th class="text-dark fw-medium bg-light">{{translate('Name')}}</th>
                                <th class="text-dark fw-medium bg-light">{{translate('Social media link')}}</th>
                                @can('page_manage_status')
                                    <th class="text-dark fw-medium bg-light">{{translate('status')}}</th>
                                @endcan
                                <th class="text-dark fw-medium bg-light text-end">{{translate('action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($socialPages ?? [] as $key => $item)
                                <tr>
                                    <td>1</td>
                                    <td>{{ $item['media'] }}</td>
                                    <td><a href="{{ $item['link'] }}" target="_blank">{{ $item['link'] }}</a></td>
                                    @can('page_manage_status')
                                        <td>
                                            <label class="switcher" data-bs-toggle="modal" data-bs-target="#deactivateAlertModal">
                                                <input class="switcher_input status-update" type="checkbox"
                                                       data-id="{{ $item['id'] }}"
                                                    {{ isset($item['status']) && $item['status'] == 1 ? 'checked' : '' }}>
                                                <span class="switcher_control"></span>
                                            </label>
                                        </td>
                                    @endcan
                                    <td>
                                        <div class="d-flex gap-2 justify-content-end">
                                            @can('page_manage_status')
                                                <a href="#" class="action-btn btn--light-primary edit-social-media"
                                                   data-bs-toggle="offcanvas"
                                                   data-bs-target="#social-media-edit-offcanvas"
                                                   data-media="{{ $item['media'] }}"
                                                   data-link="{{ $item['link'] }}"
                                                   data-url="{{ route('admin.social-media.update', $item['id']) }}">
                                                    <span class="material-icons">edit</span>
                                                </a>
                                            @endcan
                                                @can('page_delete')
                                                    <button type="button" class="action-btn btn--danger delete_section"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#deleteModal"
                                                            data-media="{{ $item['media'] }}"
                                                            data-link="{{ $item['link'] }}"
                                                            data-url="{{ route('admin.social-media.delete', $item['id']) }}">
                                                        <i class="material-symbols-outlined">delete</i>
                                                    </button>
                                                @endcan

                                        </div>
                                    </td>
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
                </div>
            </div>
        </div>
    </div>

    <div class="offcanvas offcanvas-end offcanvas-cus-sm" tabindex="-1" id="social-media-edit-offcanvas" aria-labelledby="social-media-edit-offcanvasLabel">
        <div class="offcanvas-header py-md-4 py-3">
            <h3 class="mb-0">{{ translate('Edit Social Media Link') }}</h3>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <form action="" method="post" id="update-form-submit">
            @csrf
            <div class="offcanvas-body bg-white">
                <div class="discount-type body-bg rounded p-20 mb-20">
                    <div class="row g-4">
                        <div class="col-md-12">
                            <div class="">
                                <label class="mb-2 text-dark d-flex align-items-center gap-1">{{translate('Select Social Media')}}
                                    <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                       data-bs-placement="top"
                                       title="{{translate('Select the social media platform you want to add to the list.')}}">info</i>
                                </label>
                                <select class="js-select theme-input-style w-100" name="media" id="edit-media" required>
                                    <option value="" selected disabled>---{{translate('Select_media')}}---</option>
                                    <option value="facebook">{{translate('Facebook')}}</option>
                                    <option value="instagram">{{translate('Instagram')}}</option>
                                    <option value="linkedin">{{translate('LinkedIn')}}</option>
                                    <option value="twitter">{{translate('Twitter')}}</option>
                                    <option value="youtube">{{translate('Youtube')}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="">
                                <label class="mb-2 text-dark d-flex align-items-center gap-1">{{translate('Social Media Link')}}
                                    <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                       data-bs-placement="top"
                                       title="{{translate('Paste the correct link for your chosen social media.')}}">info</i>
                                </label>
                                <div class="">
                                    <input type="text" class="form-control" name="link" id="edit-link" placeholder="{{translate('link')}}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="offcanvas-footer border-top">
                <div class="d-flex justify-content-center gap-2 bg-white px-3 py-sm-3 py-2">
                    <button type="reset" class="btn btn--secondary rounded w-100"> {{translate('reset')}} </button>
                    <button type="submit" class="btn btn--primary rounded w-100"> {{translate('Save')}} </button>
                </div>
            </div>
        </form>
    </div>

    <div class="modal fade custom-confirmation-modal" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-30">
                    <button type="button" class="btn-close bg-light rounded-full" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="d-flex flex-column align-items-center text-center">
                        <img class="mb-20" src="{{asset('public/assets/admin-module')}}/img/delete.png" alt="">
                        <h3 class="mb-15">{{ translate('Do you want to delete Facebook?')}}</h3>
                        <p class="mb-4 fz-14">{{ translate(' Once deleted, it will no longer appear in the website footer.')}}</p>
                        <form action="" method="post">
                            @csrf
                            @method('DELETE')
                            <div class="choose-option">
                                <div class="d-flex gap-3 justify-content-center flex-wrap">
                                    <button type="button" class="btn px-xl-5 px-4 btn--secondary rounded" data-bs-dismiss="modal">{{ translate('No') }}</button>
                                    <button type="submit" class="btn px-xl-5 px-4 btn--danger text-capitalize rounded">{{ translate('Yes') }}, {{ translate('Delete') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script>
        "use strict";

        $(document).ready(function () {

            $(document).on('click', '.edit-social-media', function () {
                let button = $(this);
                let url = button.data('url');
                let media = button.data('media');
                let link = button.data('link');

                let offcanvas = $('#social-media-edit-offcanvas');

                offcanvas.find('form').attr('action', url);

                let $mediaSelect = offcanvas.find('#edit-media');

                $mediaSelect.data('default', media);
                $mediaSelect.val(media).trigger('change');

                offcanvas.find('#edit-link').val(link).prop('defaultValue', link)
            });

            $('#update-form-submit').on('reset', function () {
                let $mediaSelect = $(this).find('#edit-media');
                let defaultValue = $mediaSelect.data('default'); // we will set this when opening
                $mediaSelect.val(defaultValue).trigger('change');
            });

            $(document).on('click', '.delete_section', function () {
                let button = $(this)
                let deleteUrl = button.data('url');
                let media = button.data('media');
                let link = button.data('link');

                $('#deleteModal h3').text(`Do you want to delete ${media}?`);
                $('#deleteModal form').attr('action', deleteUrl);
            });


        });

        let selectedSocialIem;
        let selectedStatusRoute;
        let socialInitialState;

        $(document).on('change', '.status-update', function (e) {
            e.preventDefault();
            console.log('here')

            selectedSocialIem = $(this);
            socialInitialState = selectedSocialIem.prop('checked');

            // Revert checkbox visual state until confirmation
            selectedSocialIem.prop('checked', !socialInitialState);

            let itemId = selectedSocialIem.data('id');
            selectedStatusRoute = '{{ route('admin.social-media.status', ['id' => ':itemId']) }}'.replace(':itemId', itemId);

            let confirmationTitleText = socialInitialState
                ? '{{ translate('Are you sure') }}?'
                : '{{ translate('Are you sure') }}?';

            $('.confirmation-title-text').text(confirmationTitleText);

            let confirmationDescriptionText = socialInitialState
                ? '{{ translate('You want to turn On this social media status') }}?'
                : '{{ translate('You want to turn Off the social media status') }}?';

            $('.confirmation-description-text').text(confirmationDescriptionText);

            let imgSrc = socialInitialState
                ? "{{ asset('public/assets/admin-module/img/icons/status-on.png') }}"
                : "{{ asset('public/assets/admin-module/img/icons/status-off.png') }}";

            $('#confirmChangeModal img').attr('src', imgSrc);

            showModal();
        });

        $('#confirmChange').on('click', function () {
            updateStatus(selectedStatusRoute);
        });

        //  Cancel and reset checkbox state
        $('.cancel-change').on('click', function () {
            resetCheckboxState();
            hideModal();
        });

        $('#confirmChangeModal').on('hidden.bs.modal', function () {
            resetCheckboxState();
        });

        //  Show/hide modal functions
        function showModal() {
            $('#confirmChangeModal').modal('show');
        }
        function hideModal() {
            $('#confirmChangeModal').modal('hide');
        }

        //  Reset the checkbox if change canceled
        function resetCheckboxState() {
            if (selectedSocialIem) {
                selectedSocialIem.prop('checked', !socialInitialState);
            }
        }
    </script>
@endpush
