@extends('adminmodule::layouts.new-master')

@section('title',translate('CronJob list'))

@push('css_or_js')
<link rel="stylesheet" href="{{asset('public/assets/admin-module/plugins/swiper/swiper-bundle.min.css')}}">
@endpush

@section('content')
    <div class="main-content">
        <div class="container-fluid">
            <div class="page-title-wrap d-flex gap-2 align-items-center mb-20 justify-content-between">
                <h2 class="page-title">{{translate('Cron Job')}}</h2>
            </div>
            <div class="pick-map mb-10 p-12 rounded d-flex flex-md-nowrap flex-wrap align-items-center gap-1 bg-primary bg-opacity-10">
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_9464_2249)">
                    <path d="M9.79125 1.44318L10.5117 0.270677C10.6797 -0.00465646 11.039 -0.0898231 11.3138 0.0793436C11.5885 0.247927 11.6743 0.606677 11.5051 0.881427L10.7847 2.05393C10.675 2.23359 10.4831 2.33218 10.2871 2.33218C10.1827 2.33218 10.0777 2.30418 9.98259 2.24584C9.70784 2.07726 9.62209 1.71793 9.79125 1.44318ZM3.16575 2.05334C3.27542 2.23301 3.46792 2.33218 3.66392 2.33218C3.76775 2.33218 3.87275 2.30418 3.96784 2.24643C4.24259 2.07784 4.32892 1.71909 4.16034 1.44434L3.44109 0.27126C3.2725 -0.00348977 2.91317 -0.0892398 2.639 0.0787602C2.36425 0.247344 2.27792 0.606094 2.4465 0.880844L3.16575 2.05334ZM1.89059 3.34134L0.841754 2.83909C0.552421 2.69851 0.201838 2.82218 0.0641712 3.11326C-0.0752455 3.40376 0.0478378 3.75201 0.338338 3.89084L1.38717 4.39309C1.46825 4.43218 1.554 4.45084 1.63859 4.45084C1.85617 4.45084 2.065 4.32893 2.16475 4.11951C2.30417 3.82901 2.18109 3.48018 1.89059 3.34134ZM6.92067 2.33393C3.70417 2.38701 1.155 5.87301 2.9015 9.23068C3.16692 9.74051 3.56067 10.1675 3.98359 10.5566C4.144 10.7042 4.26825 10.8868 4.37442 11.0828H6.41667V8.05876C5.73942 7.81726 5.25 7.17559 5.25 6.41609C5.25 6.09351 5.51075 5.83276 5.83334 5.83276C6.15592 5.83276 6.41667 6.09351 6.41667 6.41609C6.41667 6.73868 6.678 6.99943 7 6.99943C7.322 6.99943 7.58334 6.73809 7.58334 6.41609C7.58334 6.09409 7.84409 5.83276 8.16667 5.83276C8.48925 5.83276 8.75 6.09351 8.75 6.41609C8.75 7.17559 8.26059 7.81726 7.58334 8.05876V11.0828H9.60634C9.73934 10.8547 9.91084 10.6394 10.1354 10.4522C10.5198 10.1313 10.8815 9.77376 11.1038 9.32518C12.117 7.27593 11.7151 5.09076 10.2719 3.67209C9.373 2.78776 8.18242 2.31468 6.92067 2.33393ZM4.662 12.4122C4.61534 13.2673 5.25584 14 6.11217 14H7.87442C8.68 14 9.33275 13.3473 9.33275 12.5417V12.25H4.65559C4.65559 12.3048 4.6655 12.3562 4.662 12.4122ZM13.9493 3.09168C13.8163 2.79826 13.4715 2.66584 13.1781 2.80001L12.0511 3.30868C11.7571 3.44109 11.6264 3.78643 11.7594 4.07984C11.8568 4.29568 12.0686 4.42343 12.2914 4.42343C12.3713 4.42343 12.453 4.40709 12.5306 4.37151L13.6576 3.86284C13.9516 3.73043 14.0823 3.38509 13.9493 3.09168Z" fill="#3C76F1"></path>
                    </g>
                    <defs>
                    <clipPath id="clip0_9464_2249">
                    <rect width="14" height="14" fill="white"></rect>
                    </clipPath>
                    </defs>
                </svg>
                <p class="fz-12">{{ translate('It looks like your server might not have the necessary permissions to automatically set up the cron job. Please ensure that your server has shell/bash access enabled, as it’s required for automated cron job configuration.') }}</p>
            </div>
            <div class="pick-map mb-15 p-12 rounded bg-warning bg-opacity-10 d-flex flex-md-nowrap flex-wrap align-items-start gap-1">
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_9562_195)">
                    <path d="M7 14C8.38447 14 9.73785 13.5895 10.889 12.8203C12.0401 12.0511 12.9373 10.9579 13.4672 9.67879C13.997 8.3997 14.1356 6.99224 13.8655 5.63437C13.5954 4.2765 12.9287 3.02922 11.9497 2.05026C10.9708 1.07129 9.7235 0.404603 8.36563 0.134506C7.00777 -0.13559 5.6003 0.003033 4.32122 0.532846C3.04213 1.06266 1.94888 1.95987 1.17971 3.11101C0.410543 4.26216 0 5.61553 0 7C0.0020073 8.8559 0.74015 10.6352 2.05247 11.9475C3.36479 13.2599 5.1441 13.998 7 14ZM7 2.91667C7.17306 2.91667 7.34223 2.96799 7.48612 3.06413C7.63002 3.16028 7.74217 3.29694 7.8084 3.45682C7.87462 3.61671 7.89195 3.79264 7.85819 3.96237C7.82443 4.13211 7.74109 4.28802 7.61872 4.41039C7.49635 4.53276 7.34044 4.6161 7.1707 4.64986C7.00097 4.68362 6.82504 4.66629 6.66515 4.60006C6.50527 4.53384 6.36861 4.42169 6.27246 4.27779C6.17632 4.1339 6.125 3.96473 6.125 3.79167C6.125 3.55961 6.21719 3.33705 6.38128 3.17295C6.54538 3.00886 6.76794 2.91667 7 2.91667ZM6.41667 5.83334H7C7.30942 5.83334 7.60617 5.95625 7.82496 6.17505C8.04375 6.39384 8.16667 6.69058 8.16667 7V10.5C8.16667 10.6547 8.10521 10.8031 7.99581 10.9125C7.88642 11.0219 7.73804 11.0833 7.58333 11.0833C7.42862 11.0833 7.28025 11.0219 7.17086 10.9125C7.06146 10.8031 7 10.6547 7 10.5V7H6.41667C6.26196 7 6.11358 6.93855 6.00419 6.82915C5.89479 6.71975 5.83333 6.57138 5.83333 6.41667C5.83333 6.26196 5.89479 6.11359 6.00419 6.00419C6.11358 5.8948 6.26196 5.83334 6.41667 5.83334Z" fill="#FFBB38"/>
                    </g>
                    <defs>
                    <clipPath id="clip0_9562_195">
                    <rect width="14" height="14" fill="white"/>
                    </clipPath>
                    </defs>
                </svg>
                <p class="fz-12">{{ translate('If the required permissions are not in place, you’ll need to manually configure the cron job by adding the following command to your server’s crontab') }}</p>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="data-table-top d-flex flex-wrap gap-10 justify-content-between align-items-center">
                        <h4 class="title">{{translate('Cron Job List')}}</h4>
                        <form action="{{url()->current()}}" class="d-flex align-items-center gap-0 border rounded" method="GET">
                            @csrf
                            <input type="search" class="theme-input-style border-0 rounded block-size-36" name="search" value="{{ request()->search }}" placeholder="{{translate('Search cronjob')}}">
                            <button type="submit" class="bg-light border-0 px-2 block-size-36 rounded-end d-flex align-items-center justify-content-center">
                                <span class="material-symbols-outlined fz-20 opacity-75">
                                    search
                                </span>
                            </button>
                        </form>
                    </div>

                    <div class="table-responsive">
                        <table id="example" class="table align-middle">
                            <thead class="align-middle">
                            <tr>
                                <th class="">{{translate('Sl')}}</th>
                                <th class="">{{translate('Job Title')}}</th>
                                <th class="">{{translate('Mail Send')}}</th>
                                <th class="">{{translate('Activity')}}</th>
                                @can('cron_job_manage_status')
                                    <th class="">{{translate('Status')}}</th>
                                @endcan
                                <th class="text-center">{{translate('Action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($lists as $key => $list)
                                <tr>
                                    <td>{{ $lists->firstItem() + $key }}</td>
                                    <td>{{ $list->title }}</td>
                                    <td>{{ $list->send_mail_type ? ucwords($list->send_mail_type) . ' ' . $list->send_mail_day . translate(' days') : translate('not_set') }}</td>
                                    <td>
                                        @if($list->activity)
                                            <span class="{{ $list->activity == 'running' ? 'badge badge badge-success radius-50' : 'badge badge badge-danger radius-50' }}">
                                                {{ ucwords($list->activity) }}
                                            </span>
                                        @else
                                            <span>{{ translate('not_set') }}</span>
                                        @endif
                                    </td>
                                    @can('cron_job_manage_status')
                                    <td>
                                        <label class="switcher">
                                            <input class="switcher_input route-alert-reload"
                                                   type="checkbox"
                                                   {{ $list?->status ? 'checked' : '' }}
                                                   data-route="{{ route('admin.business-settings.cron-job.status', $list->id) }}"
                                                   data-message="{{ translate('If you turn off this job ' . $list?->title . '. Your user will no longer get the mail at that scheduled time for this specific job') }}">
                                            <span class="switcher_control"></span>
                                        </label>
                                    </td>
                                    @endcan
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            @can('cron_job_update')
                                                <button type="button" class="action-btn btn--light-primary  edit-cron-btn" style="--size: 30px"
                                                       data-bs-toggle="offcanvas"
                                                       data-bs-target="#offcanvasCronEdit"
                                                       data-link="{{ route('admin.business-settings.cron-job.edit', $list->id) }}"
                                                       data-title="{{ $list->title }}"
                                                       data-send_mail_type="{{ $list->send_mail_type }}"
                                                       data-send_mail_day="{{ $list->send_mail_day }}"
                                                       data-php_file_path="{{ $list->php_file_path }}"
                                                       data-command="{{ $list->command }}">
                                                    <span class="material-icons">edit</span>
                                                </button>
                                            @endcan
                                            @can('cron_job_view')
                                                <button  type="button" data-bs-toggle="modal" data-bs-target="#viewCronJobs"
                                                         data-name="{{ $list->title }}"
                                                         data-link="{{ route('admin.business-settings.cron-job.edit', $list->id) }}"
                                                         data-send_mail_type="{{ $list->send_mail_type }}"
                                                         data-send_mail_day="{{ $list->send_mail_day }}"
                                                         data-php_file_path="{{ $list->php_file_path }}"
                                                         data-command="{{ $list->command }}"
                                                         class="action-btn btn--light-primary"
                                                         style="--size: 30px">
                                                    <span class="material-icons">visibility</span>
                                                </button>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center bg-white  pt-5 pb-5" colspan="7">
                                        <div class="d-flex flex-column gap-2">
                                            <img src="{{asset('public/assets/admin-module')}}/img/no-cron-data.svg " alt="error" class="w-100px mx-auto">
                                            <p>{{translate('No Cron Job List')}}</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end">
                        {!! $lists->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Offcanvas Global Sidebar -->

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasCronEdit" aria-labelledby="offcanvasCronEditLabel">
        <div class="offcanvas-header py-3 ">
            <h3 class="mb-0 edit-title">Renewal Reminder Mail</h3>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <form action="" method="post" id="update-form-submit">
            @csrf
            <div class="offcanvas-body">
                <div class="d-flex flex-column gap-xl-4 gap-3">
                    <div>
                        <label class="floating-label-info d-flex text-dark align-items-center gap-1 mb-2" id="timing-label">{{ translate('mail send') }}
                            <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip" data-bs-placement="top"
                               title="{{ translate('Define the when you want to send the automated message') }}">info</i>
                        </label>
                        <div class="form-floating form-floating__icon">
                            <select id="mail-timing-select" class="js-select theme-input-style h-46 form-control" name="send_mail_type" required>
                                <option value="before">{{ translate('Before') }}</option>
                                <option value="after">{{ translate('After') }}</option>
                            </select>
                            <span class="material-symbols-outlined">schedule_send</span>
                        </div>
                    </div>
                    <div>
                        <label class="floating-label-info d-flex text-dark align-items-center gap-1 mb-2" id="timing-label">{{ translate('Execute Time') }}
                            <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip" data-bs-placement="top"
                               title="{{translate('Set the executing time when the job will execute')}}">info</i>
                        </label>
                        <div class="d-flex align-items-center restriction-time rounded border">
                            <div class="flex-grow-1">
                                <input class="form-control border-0 h-46 edit-send-mail-day" placeholder="1" min="1" type="number" value="" name="send_mail_day" required="">
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="floating-label-info d-flex text-dark align-items-center gap-1 mb-2" id="timing-label">{{ translate('PHP File Path') }}
                            <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip" data-bs-placement="top"
                               title="{{ translate('Set PHP file path from here. To find out the PHP file path, run "which php" command in your server terminal or ask your server provider') }}">info</i>
                        </label>
                        <div class="message-textarea position-relative form-floating__icon">
                            <input type="text" name="php_file_path" class="form-control h-46 py-0 edit-php-file-path" value="" required>
                            <span class="material-symbols-outlined">conversion_path</span>
                        </div>
                    </div>
                    <div>
                        <label class="floating-label-info d-flex text-dark align-items-center gap-1 mb-2" id="timing-label">{{ translate('Command') }}
                            <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip" data-bs-placement="top"
                               title="{{ translate('For linux server, add the command in your /etc/crontab file. And for any hosting panel, find add cron option add use the command to create cron job.') }}">info</i>
                        </label>
                        <div class="copy-text position-relative">
                            <input type="text" class="text form-control edit-command pe-5" value="" readonly
                                   data-bs-toggle="tooltip"
                                   data-bs-placement="top"
                                   title="{{ translate('The command is not editable. Click copy button to copy the command') }}">
                            <button type="button" class="border-0 outline-0 text-primary p-0 bg-transparent position-absolute top-0 m-3 icon-po edit-copy-button"><span class="material-symbols-outlined">content_copy</span></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="offcanvas-footer">
                <div class="d-flex justify-content-center gap-2 bg-white px-3 py-sm-3 py-2">
                    <button class="btn btn--secondary w-100 rounded h-45" data-bs-dismiss="offcanvas" type="reset">{{translate('Cancel')}}</button>
                    @can('cron_job_update')
                        <button class="btn btn--primary w-100 rounded h-45" type="submit">{{translate('Update')}}</button>
                    @endcan
                </div>
            </div>
        </form>
    </div>

    {{-- Cron Jobs View Modal --}}
    <div class="modal fade" id="viewCronJobs">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-scrollable">
            <div class="modal-content border-0">
                <div class="modal-header border-0 pb-0 bg-card position-sticky top-0 z-10">
                    <button type="button" class="btn-close text-body" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <h3 class="ps-4 mb-2">{{translate('View Cron Job Details')}}</h3>
                <div class="modal-body pt-0">
                    <div class="p-sm-3 fs-13">
                        <div class="bg--secondary rounded mb-20">
                            <div class="card-body">
                                <div class="d-flex flex-sm-nowrap flex-wrap align-items-center gap-3">
                                    <div class="w-100px flex-grow-1">
                                        <h5 class="mb-1">{{translate('Job')}}: <label class="job-name"></label></h5>
                                    </div>
                                    <div class="executing-time bg-white">
                                        <span class="fz-14 mb-1">{{translate('Mail Send')}}</span>
                                        <div class="fz-18 text-dark">
                                            <span class="send-mail-type text-capitalize"></span>
                                            <span class="send-mail-day"></span>
                                            {{translate('days')}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg--secondary rounded p-20 mb-20">
                            <div class="row g-sm-3 g-2">
                                <div class="col-lg-6">
                                    <div class="d-flex h-100 align-items-start gap-xl-3 gap-2 bg-white cus-shadow2 rounded p-20">
                                        <img src="{{asset('public/assets/admin-module/img/php.png')}}" alt="">
                                        <div class="w-0 flex-grow-1">
                                            <h6 class="fs-12 mb-1">{{translate('PHP File Path')}}</h6>
                                            <p class="fz-12 text-break mb-0"></p>
                                            <div class="fs-12 php-file-path"></div>
                                            <div class="fs-12 text-danger d-flex align-items-start gap-1"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex h-100 align-items-start gap-xl-3 gap-2 bg-white cus-shadow2 rounded p-20">
                                        <img src="{{asset('public/assets/admin-module/img/command.png')}}" alt="">
                                        <div class="w-0 flex-grow-1">
                                            <h6 class="fs-12 mb-1">{{translate('PHP File Path')}}</h6>
                                            <div class="fs-12 command"></div>
                                            <div class="copy-text position-relative d-flex justify-content-between gap-1">
                                                <input type="text" class="text border-0 text-light-gray bg-transparent copy-command" value="" />
                                                <button class="border-0 outline-0 text-primary p-0 bg-transparent"><span class="material-symbols-outlined">content_copy</span></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-primary bg-opacity-10 rounded p-12 text-scrolling">
                            <h5 class="fs-16 d-flex align-items-center gap-2  mb-2">
                                <img src="{{asset('public/assets/admin-module')}}/img/lights-icons.png" alt=""> {{translate('Instructions')}}
                            </h5>
                            <ol class="text--grey instruction-info">
                                <li class="text-body">
                                    {{translate('You can get the PHP file path from your server. Here is an example of Apache Server -')}} -  <br>
                                    <strong class="text-break">/usr/local/bin/php/home/mrfrog/public_html/path/to/cron/script.</strong> <br>
                                    {{translate('This will vary based on servers')}}.
                                </li>
                                <li class="text-body">
                                    {{translate('Copy the command from here & to write the auto generated Command.')}}
                                </li>
                                <li class="text-body">
                                    {{translate('Your Cron Job will execute on The Executing Time you have set')}}.
                                </li>
                                <li class="text-body">
                                    {{translate('Please recheck all link and file before save.')}}
                                </li>
                                <li class="text-body">
                                    <div>
                                        {{translate('The Cron Job PHP configuration error occurs when')}}
                                    </div>
                                    <ul class="list-lower-list">
                                        <li class="text-body">
                                            {{translate('Insert the wrong PHP file path - Copy the correct path and input it in the PHP
                                            file path Section')}}
                                        </li>
                                        <li class="text-body">
                                            <span class="text-dark">{{translate('PHP version mismatch')}}</span> - {{translate('Please
                                            go to your cPanel or VPS and check if the PHP version is compatible, then insert
                                            the correct PHP path.')}}
                                        </li>
                                    </ul>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-end gap-2 border-0 bg-card position-sticky bottom-0">
                    <button class="btn btn--secondary rounded"  data-bs-dismiss="modal" aria-label="Close">{{translate('Cancel')}}</button>
                    @can('cron_job_update')
                        <button type="button" class="btn btn--primary rounded view-edit-btn" aria-label="Close">{{ translate('Edit') }}</button>
                    @endcan
                </div>
            </div>
        </div>
    </div>

    {{-- How It Works Modal --}}
    <div class="modal fade" id="howItWorks">
        <div class="modal-dialog modal-dialog-centered how-it-works-dialog">
            <div class="modal-content border-0">
                <div class="modal-body p-0">
                    <button type="button" class="btn-close invert-1 border-0" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                    <img src="{{asset('/public/assets/admin-module/img/cron-job.png')}}" alt="">
                    <div class="p-4 pb-md-5">
                        <div class="cron-jobs-slider">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="item">
                                        <h4 class="fs-16 mb-3">{{translate('What is Cron Job')}}</h4>
                                        <p class="m-0 fs-13">
                                            {{translate('A Cron job is an automated task scheduler that helps run routine processes
                                            without manual effort. It can improve efficiency by automating repetitive
                                            work and ensuring important tasks happen consistently')}}
                                        </p>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="item">
                                        <h4 class="fs-16 mb-3">{{translate('Cron Job Title')}}</h4>
                                        <p class="m-0 fs-13">
                                            {{translate('The title of a Cron Job refers to the command that will be automatically
                                            executed at specific time intervals or dates when scheduled.')}}
                                        </p>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="item">
                                        <h4 class="fs-16 mb-3">{{translate('Executing Time')}}</h4>
                                        <p class="m-0 fs-13">'
                                            {{translate('The execution time of a cron job is defined by the schedule when the job
                                            will be done.')}}
                                        </p>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="item">
                                        <h4 class="fs-16 mb-3">{{translate('PHP File Path')}}</h4>
                                        <p class="m-0 fs-13">
                                            {{translate('The PHP file path for a Cron Job refers to the location on the server where
                                            the PHP script to be executed is stored.')}}
                                        </p>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="item">
                                        <h4 class="fs-16 mb-3">{{translate('Command')}}</h4>
                                        <p class="m-0 fs-13">
                                            {{translate('A Cron Job command is the actual instruction used in a Cron scheduler to
                                            execute a specific task at defined intervals.')}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="d-flex flex-wrap align-items-center justify-content-between w-100">
                        <button class="btn btn--primary swiper-prev"><span class="material-icons">arrow_back</span>{{translate('Back')}}</button>
                        <div class="swiper-pagination swiper--pagination"></div>
                        <button class="btn btn--primary swiper-next">{{translate('Next')}}<span class="material-icons">arrow_forward</span></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')
<script src="{{asset('public/assets/admin-module/plugins/swiper/swiper-bundle.min.js')}}"></script>
<script>
    var swiper = new Swiper('.cron-jobs-slider', {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: false,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-next',
            prevEl: '.swiper-prev',
        }
    });

    $('#viewCronJobs').on('show.bs.modal', function (event) {
        const button = $(event.relatedTarget);
        const modal = $(this);

        modal.find('.job-name').text(button.data('name'));
        modal.find('.send-mail-type').text(button.data('send_mail_type'));
        modal.find('.send-mail-day').text(button.data('send_mail_day'));
        modal.find('.php-file-path').text(button.data('php_file_path'));
        modal.find('.command').text(button.data('command'));
        modal.find('.copy-command').val(button.data('command'));
    });

    $('.copy-button').on('click', function(){
        var commandText = $(this).closest('.copy-div').find('.command').text();

        navigator.clipboard.writeText(commandText).then(function() {
        }).catch(function(error) {
        });
    });

    $(document).on('click', '.edit-cron-btn', function () {
        const button = $(this);
        const title = button.data('title');
        const link = button.data('link');
        const sendMailType = button.data('send_mail_type');
        const sendMailDay = button.data('send_mail_day');
        const phpFilePath = button.data('php_file_path');
        const command = button.data('command');

        const offcanvas = $('#offcanvasCronEdit');

        offcanvas.find('form').attr('action', link);
        offcanvas.find('.edit-title').text(title);
        offcanvas.find('#mail-timing-select').val(sendMailType).trigger('change');
        offcanvas.find('.edit-send-mail-day').val(sendMailDay);
        offcanvas.find('.edit-php-file-path').val(phpFilePath);
        offcanvas.find('.edit-command').val(command);

    });

    $('.edit-copy-button').on('click', function(){
        $(this).closest('.form-floating').find('.copy-input').select()
        document.execCommand("copy");
    })

    $(document).on('click', '.view-edit-btn', function () {
        const modal = $('#viewCronJobs');

        // Hide the details modal first
        modal.modal('hide');

        // Get data that was populated in modal
        const name = modal.find('.job-name').text();
        const sendMailType = modal.find('.send-mail-type').text().toLowerCase();
        const sendMailDay = modal.find('.send-mail-day').text();
        const phpFilePath = modal.find('.php-file-path').text();
        const command = modal.find('.command').text();
        const link = modal.find('button[data-link]').data('link'); // hidden link

        // Fill Edit Offcanvas
        const offcanvas = $('#offcanvasCronEdit');
        offcanvas.find('form').attr('action', link);
        offcanvas.find('.edit-title').text(name);
        offcanvas.find('#mail-timing-select').val(sendMailType).trigger('change');
        offcanvas.find('.edit-send-mail-day').val(sendMailDay);
        offcanvas.find('.edit-php-file-path').val(phpFilePath);
        offcanvas.find('.edit-command').val(command);

        // Now show the offcanvas after modal closes
        modal.on('hidden.bs.modal', function () {
            const bsOffcanvas = new bootstrap.Offcanvas(document.getElementById('offcanvasCronEdit'));
            bsOffcanvas.show();
            // remove this event after first trigger
            modal.off('hidden.bs.modal');
        });
    });



</script>
@endpush
