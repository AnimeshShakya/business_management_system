@extends('adminmodule::layouts.new-master')

@section('title',translate('gallery_settings'))

@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">

        <div class="d-md-flex_ align-items-center justify-content-between mb-2">
            <div class="row gy-2 align-items-center d-flex justify-content-between">
                <div class="col-sm-auto">
                    <h3 class="h3 m-0 text-capitalize dark-color fw-bold">{{translate('Gallery')}}</h3>
                </div>
            </div>
        </div>


        <div class="mb-15 mt-2">
            <div class="js-nav-scroller hs-nav-scroller-horizontal">
                <div class="d-flex flex-wrap justify-content-between align-items-center __gap-12px">
                    <div class="js-nav-scroller hs-nav-scroller-horizontal mt-2">
                        <ul class="nav nav-tabs border-0 nav--tabs nav--tabs__style2">
                            <li class="nav-item">
                                <a class="nav-link {{ $storage == 'local' ? 'active' : '' }}"
                                   href="{{ route('admin.business-settings.get-gallery-setup', ['path' => 'cHVibGlj', 'storage' => 'local']) }}">
                                    {{ translate('local_storage') }}
                                </a>
                            </li>
                            @if(getDisk() == 's3')
                                <li class="nav-item">
                                    <a class="nav-link {{ $storage == 's3' ? 'active' : '' }}"
                                       href="{{ route('admin.business-settings.get-gallery-setup', ['path' => 'cHVibGlj', 'storage' => 's3']) }}">
                                        {{ translate('3rd Party Storage ') }}
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        @if($storage == 'local')
            <div class="pick-map p-12 rounded d-flex flex-md-nowrap flex-wrap align-items-center gap-1 bg-primary bg-opacity-10 mb-20">
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
                <p class="fz-12">{{ translate('Currently you are using local storage, if you want to use 3rd party storage, need to setup connection with') }} <a @can('configuration_view') href="{{ route('admin.configuration.third-party', 'storage_connection') }}" @endcan target="_blank" class="fw-semibold text-primary text-decoration-underline">{{ translate('3rd Party Storage') }}</a></p>
            </div>
        @endif

        <div class="card mb-20">
            <div class=" p-20 d-flex gap-2 flex-wrap justify-content-between">
                @php
                    $pwd = explode('/',base64_decode($folderPath));
                    $awsUrl = config('filesystems.disks.s3.url');
                    $awsBucket = config('filesystems.disks.s3.bucket');
                @endphp
                <h5 class="card-title text-capitalize d-flex align-items-center gap-2">
                    <span class="card-header-icon">
                        <i class="tio-folder-opened-labeled"></i>
                    </span> {{end($pwd)}} <span class="badge badge-soft-dark text-dark rounded-pill fs-12" id="itemCount">
                        {{count($data)}}
                    </span>
                </h5>
                <div class="d-flex align-items-center flex-wrap gap-xl-3 gap-2">
                    <form action="{{ url()->current() }}" class="search-form search-form_style-two bg-white d-flex align-items-center gap-0 border rounded" method="GET">
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
                    @can('gallery_add')
                        <button type="button" class="btn btn--primary bg-cus-info d-flex align-items-center gap-2 rounded" data-bs-toggle="offcanvas" data-bs-target="#AddImage__offcanvas">
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_10181_5173)">
                                <path d="M6.4891 7.30984C6.32659 7.14721 6.13362 7.01821 5.92123 6.93019C5.70883 6.84218 5.48118 6.79688 5.25127 6.79688C5.02136 6.79688 4.79371 6.84218 4.58132 6.93019C4.36892 7.01821 4.17595 7.14721 4.01344 7.30984L0.0234375 11.2998C0.0773728 12.0314 0.405467 12.7156 0.942113 13.2157C1.47876 13.7158 2.1844 13.9949 2.91794 13.9972H11.0846C11.6561 13.9971 12.2148 13.828 12.6905 13.5113L6.4891 7.30984Z" fill="white"/>
                                <path d="M10.4987 4.66927C11.143 4.66927 11.6654 4.14694 11.6654 3.5026C11.6654 2.85827 11.143 2.33594 10.4987 2.33594C9.85437 2.33594 9.33203 2.85827 9.33203 3.5026C9.33203 4.14694 9.85437 4.66927 10.4987 4.66927Z" fill="white"/>
                                <path d="M11.0833 0H2.91667C2.1434 0.00092625 1.40208 0.308515 0.855295 0.855295C0.308514 1.40208 0.00092625 2.1434 0 2.91667L0 9.67517L3.18733 6.48783C3.45818 6.21691 3.77975 6.00201 4.13366 5.85538C4.48758 5.70876 4.86691 5.63329 5.25 5.63329C5.63309 5.63329 6.01242 5.70876 6.36634 5.85538C6.72025 6.00201 7.04182 6.21691 7.31267 6.48783L13.5141 12.6893C13.8308 12.2136 13.9999 11.6548 14 11.0833V2.91667C13.9991 2.1434 13.6915 1.40208 13.1447 0.855295C12.5979 0.308515 11.8566 0.00092625 11.0833 0ZM10.5 5.83333C10.0385 5.83333 9.58738 5.69649 9.20367 5.4401C8.81995 5.18371 8.52089 4.81929 8.34428 4.39293C8.16768 3.96657 8.12147 3.49741 8.2115 3.04479C8.30153 2.59217 8.52376 2.17641 8.85008 1.85008C9.17641 1.52376 9.59217 1.30153 10.0448 1.2115C10.4974 1.12147 10.9666 1.16768 11.3929 1.34428C11.8193 1.52089 12.1837 1.81995 12.4401 2.20367C12.6965 2.58738 12.8333 3.03851 12.8333 3.5C12.8333 4.11884 12.5875 4.71233 12.1499 5.14992C11.7123 5.5875 11.1188 5.83333 10.5 5.83333Z" fill="white"/>
                                </g>
                                <defs>
                                <clipPath id="clip0_10181_5173">
                                <rect width="14" height="14" fill="white"/>
                                </clipPath>
                                </defs>
                            </svg>
                            {{translate('Add Image')}}
                        </button>
                        <button type="button" class="btn btn--primary d-flex align-items-center gap-2 rounded" data-bs-toggle="offcanvas" data-bs-target="#AddFile__offcanvas">
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12.4918 2.91667H9.91699V0.341833L12.4918 2.91667ZM8.75033 4.08333V0H5.25033V1.16667H4.08366V0H2.91699C1.95041 0 1.16699 0.783417 1.16699 1.75V14H12.8337V4.08333H8.75033ZM4.08366 1.75H5.25033V2.91667H4.08366V1.75ZM4.08366 3.5H5.25033V4.66667H4.08366V3.5ZM4.08366 5.25H5.25033V6.41667H4.08366V5.25ZM5.83366 10.5H3.50033V9.91667L4.08366 7H5.25033L5.83366 9.91667V10.5Z" fill="white"/>
                            </svg>
                            {{translate('Add ZIP')}}
                        </button>
                    @endcan

                </div>
            </div>
            <div class="body-bg rounded m-sm-4 m-3 mt-0">
                <div class="card-body">
                    <div class="d-grid grid-folder flex-wrap gap-sm-3 gap-2 gap-xl-4">
                        @foreach($data as $key=>$file)
                            <div class="">
                                @if($file['type']=='folder')
                                    <a class="p-0 row text-capitalize"
                                       href="{{route('admin.business-settings.get-gallery-setup', [base64_encode($file['path']), 'storage' => $storage])}}">
                                        <div class="mx-auto text-center"><img class=""
                                                  src="{{asset('public/assets/admin-module/img/folder.png')}}"
                                                  alt=""></div>
                                        <div class="mb-1 text-center fw-medium text-capitalize"><p>{{Str::limit($file['name'],10)}}</p></div>
                                        <span class="fz-12 text-center">{{ $file['total_items'] ?? 0 }}</span>
                                    </a>
                                @elseif($file['type']=='file')
                                    <div class=""  title="{{$file['name']}}">
                                        <div class="gallary-card gallary-card-overlay overflow-hidden position-relative initial-25 mb-2">
                                            <img class="initial-26 ratio-1 w-100 mx-auto text-center rounded-2" style="object-fit: contain;" width="150" src="{{$storage == 's3'? rtrim($awsUrl, '/').'/'.ltrim($awsBucket.'/'.$file['path'], '/') : asset('storage/app/'.$file['path'])}}" alt="{{$file['name']}}">
                                            <div class="icon-view d-flex flex-column gap-2 position-absolute top-3">
                                                <button class="btn bg-white p-1 rounded w-30 h-30 d-center d-flex align-items-center gap-2 rounded db-path" data-text="{{$file['db_path']}}" data-bs-toggle="tooltip"
                                                            data-bs-placement="left"
                                                            title="{{translate('Copy')}}">
                                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <g clip-path="url(#clip0_9854_15822)">
                                                        <path d="M4.57062 9.43163C4.43645 9.29746 4.31045 9.15046 4.1967 8.99529C4.00712 8.73512 4.06429 8.36996 4.32504 8.18037C4.5852 7.99079 4.94979 8.04796 5.13995 8.30812C5.2152 8.41196 5.29979 8.51171 5.39487 8.60621C5.86329 9.07463 6.4857 9.33246 7.14779 9.33246C7.80987 9.33246 8.43287 9.07463 8.9007 8.60621L12.109 5.39787C13.0756 4.43129 13.0756 2.85804 12.109 1.89146C11.1425 0.924875 9.5692 0.924875 8.60262 1.89146L7.98545 2.50862C7.75737 2.73671 7.3887 2.73671 7.16062 2.50862C6.93254 2.28054 6.93254 1.91187 7.16062 1.68379L7.77779 1.06662C9.19937 -0.355542 11.5123 -0.355542 12.9339 1.06662C14.3555 2.48821 14.3555 4.80112 12.9339 6.22271L9.72554 9.43104C9.0372 10.12 8.12137 10.4991 7.14779 10.4991C6.1742 10.4991 5.25837 10.12 4.57062 9.43163ZM3.64779 13.9991C4.62195 13.9991 5.5372 13.62 6.22554 12.931L6.8427 12.3139C7.07079 12.0864 7.07079 11.7171 6.8427 11.489C6.6152 11.261 6.24595 11.2615 6.01787 11.489L5.40012 12.1062C4.9317 12.5746 4.30929 12.8325 3.6472 12.8325C2.98512 12.8325 2.3627 12.5746 1.89429 12.1062C1.42587 11.6378 1.16804 11.0154 1.16804 10.3533C1.16804 9.69121 1.42587 9.06821 1.89429 8.60037L5.10262 5.39204C5.57104 4.92362 6.19345 4.66579 6.85554 4.66579C7.51762 4.66579 8.14062 4.92362 8.60845 5.39204C8.70179 5.48596 8.78695 5.58571 8.86279 5.68954C9.05179 5.95029 9.41637 6.00862 9.6777 5.81846C9.93845 5.62887 9.9962 5.26429 9.80662 5.00354C9.69579 4.85071 9.57037 4.70429 9.43387 4.56779C8.74495 3.87829 7.82912 3.49912 6.85554 3.49912C5.88195 3.49912 4.96612 3.87829 4.27779 4.56721L1.07004 7.77554C0.38112 8.46387 0.00195312 9.37971 0.00195312 10.3533C0.00195312 11.3269 0.38112 12.2427 1.07004 12.931C1.75837 13.62 2.67362 13.9991 3.64779 13.9991Z" fill="#0461A5"/>
                                                        </g>
                                                        <defs>
                                                        <clipPath id="clip0_9854_15822">
                                                        <rect width="14" height="14" fill="white"/>
                                                        </clipPath>
                                                        </defs>
                                                    </svg>
                                                </button>
                                                <button type="button" class="btn bg-white p-1 rounded w-30 h-30 d-center d-flex align-items-center gap-2 rounded"
                                                            data-bs-placement="left"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#imagemodal{{$key}}"
                                                            title="{{translate('View')}}">
                                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <g clip-path="url(#clip0_9854_15824)">
                                                        <path d="M11.0833 0H2.91667C2.1434 0.00092625 1.40208 0.308514 0.855295 0.855295C0.308514 1.40208 0.00092625 2.1434 0 2.91667L0 11.0833C0.00092625 11.8566 0.308514 12.5979 0.855295 13.1447C1.40208 13.6915 2.1434 13.9991 2.91667 14H11.0833C11.8566 13.9991 12.5979 13.6915 13.1447 13.1447C13.6915 12.5979 13.9991 11.8566 14 11.0833V2.91667C13.9991 2.1434 13.6915 1.40208 13.1447 0.855295C12.5979 0.308514 11.8566 0.00092625 11.0833 0ZM2.91667 1.16667H11.0833C11.5475 1.16667 11.9926 1.35104 12.3208 1.67923C12.649 2.00742 12.8333 2.45254 12.8333 2.91667V11.0833C12.8323 11.3432 12.7725 11.5995 12.6583 11.8329L7.31325 6.48783C7.0424 6.21691 6.72084 6.00201 6.36692 5.85538C6.013 5.70876 5.63367 5.63329 5.25058 5.63329C4.8675 5.63329 4.48816 5.70876 4.13425 5.85538C3.78033 6.00201 3.45876 6.21691 3.18792 6.48783L1.16667 8.5085V2.91667C1.16667 2.45254 1.35104 2.00742 1.67923 1.67923C2.00742 1.35104 2.45254 1.16667 2.91667 1.16667ZM2.91667 12.8333C2.45254 12.8333 2.00742 12.649 1.67923 12.3208C1.35104 11.9926 1.16667 11.5475 1.16667 11.0833V10.1582L4.01217 7.31267C4.17468 7.15005 4.36765 7.02104 4.58004 6.93302C4.79244 6.84501 5.02009 6.79971 5.25 6.79971C5.47991 6.79971 5.70756 6.84501 5.91996 6.93302C6.13235 7.02104 6.32532 7.15005 6.48783 7.31267L11.8329 12.6583C11.5995 12.7725 11.3432 12.8323 11.0833 12.8333H2.91667Z" fill="#FFBB38"/>
                                                        <path d="M9.33464 6.1224C9.73844 6.1224 10.1332 6.00266 10.4689 5.77831C10.8047 5.55397 11.0664 5.23511 11.2209 4.86204C11.3754 4.48898 11.4159 4.07847 11.3371 3.68242C11.2583 3.28638 11.0638 2.92259 10.7783 2.63705C10.4928 2.35152 10.129 2.15707 9.73294 2.07829C9.3369 1.99952 8.92639 2.03995 8.55332 2.19448C8.18026 2.349 7.86139 2.61069 7.63705 2.94644C7.41271 3.28219 7.29297 3.67693 7.29297 4.08073C7.29297 4.62221 7.50807 5.14152 7.89096 5.52441C8.27385 5.90729 8.79315 6.1224 9.33464 6.1224ZM9.33464 3.20573C9.50769 3.20573 9.67687 3.25705 9.82076 3.35319C9.96465 3.44934 10.0768 3.586 10.143 3.74588C10.2093 3.90577 10.2266 4.0817 10.1928 4.25143C10.1591 4.42117 10.0757 4.57708 9.95335 4.69945C9.83098 4.82182 9.67507 4.90516 9.50534 4.93892C9.33561 4.97268 9.15967 4.95535 8.99979 4.88912C8.8399 4.8229 8.70325 4.71075 8.6071 4.56685C8.51095 4.42296 8.45964 4.25379 8.45964 4.08073C8.45964 3.84867 8.55182 3.62611 8.71592 3.46201C8.88001 3.29792 9.10257 3.20573 9.33464 3.20573Z" fill="#FFBB38"/>
                                                        </g>
                                                        <defs>
                                                        <clipPath id="clip0_9854_15824">
                                                        <rect width="14" height="14" fill="white"/>
                                                        </clipPath>
                                                        </defs>
                                                    </svg>
                                                </button>
                                                <a class="btn bg-white p-1 rounded w-30 h-30 d-center d-flex align-items-center gap-2 rounded" href="{{route('admin.business-settings.download-gallery-image', [base64_encode($file['path']), 'storage' => $storage])}}" data-bs-toggle="tooltip"
                                                            data-bs-placement="left"
                                                            title="{{translate('Download')}}">
                                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <g clip-path="url(#clip0_9854_15826)">
                                                        <path d="M9.33333 7V8.16667C9.33333 8.81008 8.81008 9.33333 8.16667 9.33333H5.83333C5.18992 9.33333 4.66667 8.81008 4.66667 8.16667V7H0V12.25C0 13.2148 0.785167 14 1.75 14H12.25C13.2148 14 14 13.2148 14 12.25V7H9.33333ZM12.8333 12.25C12.8333 12.572 12.572 12.8333 12.25 12.8333H1.75C1.428 12.8333 1.16667 12.572 1.16667 12.25V8.16667H3.5C3.5 9.4535 4.5465 10.5 5.83333 10.5H8.16667C9.4535 10.5 10.5 9.4535 10.5 8.16667H12.8333V12.25ZM6.17517 6.07483L4.25425 4.15392L5.07908 3.32908L6.41667 4.66667V0H7.58333V4.66667L8.92092 3.32908L9.74575 4.15392L7.82483 6.07483C7.59733 6.30233 7.29867 6.41608 7 6.41608C6.70133 6.41608 6.40267 6.30233 6.17517 6.07483Z" fill="#04BB7B"/>
                                                        </g>
                                                        <defs>
                                                        <clipPath id="clip0_9854_15826">
                                                        <rect width="14" height="14" fill="white"/>
                                                        </clipPath>
                                                        </defs>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                        <p class="overflow-hidden text-center fz-12 text-color">{{Str::limit($file['name'],10)}}</p>
                                    </div>
                                    <div class="modal fade" id="imagemodal{{$key}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header border-0 pb-0 d-flex align-items-center justify-content-between gap-2">
                                                    <h4 class="modal-title" id="myModalLabel">{{$file['name']}}</h4>
                                                    <button type="button" class="close btn w-30 h-30 d-center p-1 text-color btn--secondary" data-bs-dismiss="modal">
                                                        <span class="material-icons m-0">close</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <img src="{{$storage == 's3'? rtrim($awsUrl, '/').'/'.ltrim($awsBucket.'/'.$file['path'], '/') : asset('storage/app/'.$file['path'])}}"
                                                         class="initial-27 rounded-3 w-auto" >
                                                </div>
                                                <div class="modal-footer justify-content-center border-0 pt-0 gap-lg-3 gap-2">
                                                    @can('gallery_export')
                                                        <a class="btn btn--secondary d-flex align-items-center gap-2 rounded"
                                                           href="{{route('admin.business-settings.download-gallery-image', [base64_encode($file['path']), 'storage' => $storage])}}">
                                                            <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <g clip-path="url(#clip0_10223_4976)">
                                                                <path d="M11.453 4.7149C10.6882 2.87681 8.88925 1.66406 6.875 1.66406C4.14092 1.66406 1.91667 3.88831 1.91667 6.6224C1.91667 6.94381 1.94758 7.26231 2.00825 7.57498C1.2225 8.17698 0.75 9.11848 0.75 10.1224C0.75 11.8911 2.05842 13.3307 3.66667 13.3307H10.375C12.7877 13.3307 14.75 11.3684 14.75 8.95573C14.75 6.93331 13.3827 5.20081 11.453 4.7149ZM8.57483 10.6556C8.34733 10.8831 8.04867 10.9968 7.75 10.9968C7.45133 10.9968 7.15267 10.8831 6.92517 10.6556L5.00425 8.73465L5.82908 7.90981L7.16667 9.2474V5.7474H8.33333V9.2474L9.67092 7.90981L10.4958 8.73465L8.57483 10.6556Z" fill="#232323"/>
                                                                </g>
                                                                <defs>
                                                                <clipPath id="clip0_10223_4976">
                                                                <rect width="14" height="14" fill="white" transform="translate(0.75 0.5)"/>
                                                                </clipPath>
                                                                </defs>
                                                            </svg>
                                                            {{translate('download')}}
                                                        </a>
                                                        <button class="btn btn--primary d-flex align-items-center gap-2 rounded db-path" data-text="{{$file['db_path']}}">
                                                            <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <g clip-path="url(#clip0_10223_3598)">
                                                                <path d="M5.35635 9.8924C5.01452 9.55115 5.01452 8.9964 5.35635 8.65515C5.69818 8.31331 6.25177 8.31331 6.5936 8.65515C7.3671 9.42865 8.71693 9.42923 9.49043 8.65515L12.4007 5.7449C13.1993 4.94631 13.1993 3.64665 12.4007 2.84806C11.6021 2.04948 10.3024 2.04948 9.50385 2.84806C9.16201 3.1899 8.60843 3.1899 8.2666 2.84806C7.92477 2.50681 7.92477 1.95206 8.2666 1.61081C9.7471 0.129729 12.1574 0.129729 13.6379 1.61081C15.119 3.0919 15.119 5.50106 13.6379 6.98215L10.7277 9.8924C9.98685 10.6332 9.01443 11.0031 8.04202 11.0031C7.0696 11.0031 6.0966 10.6326 5.35635 9.8924ZM4.54902 14.4966C5.52143 14.4966 6.49385 14.1262 7.23468 13.386C7.57652 13.0447 7.57652 12.49 7.23468 12.1487C6.89285 11.8069 6.33927 11.8069 5.99743 12.1487C5.19827 12.9479 3.8986 12.9473 3.1006 12.1487C2.30202 11.3501 2.30202 10.0505 3.1006 9.2519L5.99451 6.35798C6.79368 5.55881 8.09335 5.55881 8.89135 6.35798C9.23318 6.69981 9.78677 6.69981 10.1286 6.35798C10.4704 6.01673 10.4704 5.46198 10.1286 5.12073C8.64751 3.63965 6.23835 3.63965 4.75727 5.12073L1.86277 8.01465C0.381682 9.49573 0.381682 11.9049 1.86277 13.386C2.6036 14.1268 3.5766 14.4966 4.54902 14.4966Z" fill="white"/>
                                                                </g>
                                                                <defs>
                                                                <clipPath id="clip0_10223_3598">
                                                                <rect width="14" height="14" fill="white" transform="translate(0.75 0.5)"/>
                                                                </clipPath>
                                                                </defs>
                                                            </svg>
                                                            {{ translate('Copy path') }}
                                                        </button>
                                                    @endcan
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>


        <div class="card">
            <div class="card-body p-20">
                <div class="data-table-top mb-20 d-flex align-items-center flex-wrap gap-xl-3 gap-2 justify-content-between">
                    <h4 class="fw-bold text-dark">{{ translate('Recently Added Items') }}</h4>
                    <form action="{{ url()->current() }}" class="search-form search-form_style-two d-flex align-items-center gap-0 border rounded" method="GET">
                        @csrf
                        <div class="input-group search-form__input_group bg-transparent">
                            <input type="search" class="theme-input-style search-form__input border-0  block-size-36" name="file_search"
                                    placeholder="{{translate('search_here')}}"
                                    value="{{ request()?->file_search ?? null }}">
                        </div>
                        <button type="submit" class="bg-light border-0 px-2 block-size-36 rounded-end d-flex align-items-center justify-content-center">
                            <span class="material-symbols-outlined fz-20 opacity-75">
                                search
                            </span>
                        </button>
                    </form>
                </div>
                <div class="table-responsive table-custom-responsive">
                    <table id="example" class="table align-middle">
                        <thead class="text-nowrap">
                            <tr>
                                <th class="text-dark fw-medium bg-light">{{translate('Sl')}}</th>
                                <th class="text-dark fw-medium bg-light">{{translate('Full Name')}}</th>
                                <th class="text-dark fw-medium bg-light">{{translate('File path')}}</th>
                                <th class="text-dark fw-medium bg-light">{{translate('File Size')}}</th>
                                <th class="text-dark fw-medium bg-light">{{translate('Uploaded')}}</th>
                                <th class="text-dark fw-medium bg-light text-end">{{translate('action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($recentFiles as $recentKey => $recentFile)
                            <tr>
                                <td>{{ $recentKey+1 }}</td>
                                <td>{{ $recentFile['name'] }}</td>
                                <td>{{ $recentFile['format'] ?? 'N/A' }}</td>
                                <td>{{ $recentFile['size'] ?? 'N/A' }}</td>
                                <td>{{ \Carbon\Carbon::createFromTimestamp($recentFile['modified'])->format('d M Y') }}</td>
                                <td>
                                    <div class="d-flex gap-2 justify-content-end">
                                        @can('gallery_view')
                                            <button type="button" class="action-btn btn--light-primary"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#recentimagemodal{{$recentKey}}">
                                                <span class="material-icons">visibility</span>
                                            </button>
                                        @endcan
                                        @can('gallery_export')
                                                <a  class="action-btn btn--success"
                                                    href="{{route('admin.business-settings.download-gallery-image', [base64_encode($recentFile['path']), 'storage' => $storage])}}">
                                                    <span class="material-symbols-outlined">vertical_align_bottom</span>
                                                </a>
                                        @endcan
                                        @php
                                            $encodedPath = base64_encode($recentFile['path']);
                                            $safeId = 'delete-' . md5($recentFile['name']); // or use Str::slug() if preferred
                                        @endphp
                                        @can('gallery_delete')
                                            <button type="button"
                                                    class="{{ env('APP_ENV') == 'demo' ? 'demo_check' : 'delete-content' }} action-btn btn--danger"
                                                    data-id="{{ $safeId }}"
                                                    data-url="{{ route('admin.business-settings.remove-gallery-image', [$encodedPath]) }}"
                                                    data-title="{{ translate('want_to_delete_this_file')}}?"
                                                    data-description="{{ translate('You will not be able to revert this!') }}"
                                                    data-image="{{ asset('public/assets/admin-module/img/modal/delete-icon.svg') }}"
                                            >
                                                <i class="material-symbols-outlined">delete</i>
                                            </button>
                                        @endcan

                                    </div>
                                </td>
                            </tr>


                            <div class="modal fade" id="recentimagemodal{{$recentKey}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header border-0 pb-0 d-flex align-items-center justify-content-between gap-2">
                                            <h4 class="modal-title" id="myModalLabel">{{$recentFile['name']}}</h4>
                                            <button type="button" class="close btn w-30 h-30 d-center p-1 text-color btn--secondary" data-bs-dismiss="modal">
                                                <span class="material-icons m-0">close</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <img src="{{$storage == 's3'? rtrim($awsUrl, '/').'/'.ltrim($awsBucket.'/'.$recentFile['path'], '/') : asset('storage/app/'.$recentFile['path'])}}"
                                                 class="initial-27 rounded-3 w-auto" >
                                        </div>
                                        <div class="modal-footer justify-content-center border-0 pt-0 gap-lg-3 gap-2">
                                            @can('gallery_export')
                                                <a class="btn btn--secondary d-flex align-items-center gap-2 rounded"
                                                   href="{{route('admin.business-settings.download-gallery-image', [base64_encode($recentFile['path']), 'storage' => $storage])}}">
                                                    <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <g clip-path="url(#clip0_10223_4976)">
                                                            <path d="M11.453 4.7149C10.6882 2.87681 8.88925 1.66406 6.875 1.66406C4.14092 1.66406 1.91667 3.88831 1.91667 6.6224C1.91667 6.94381 1.94758 7.26231 2.00825 7.57498C1.2225 8.17698 0.75 9.11848 0.75 10.1224C0.75 11.8911 2.05842 13.3307 3.66667 13.3307H10.375C12.7877 13.3307 14.75 11.3684 14.75 8.95573C14.75 6.93331 13.3827 5.20081 11.453 4.7149ZM8.57483 10.6556C8.34733 10.8831 8.04867 10.9968 7.75 10.9968C7.45133 10.9968 7.15267 10.8831 6.92517 10.6556L5.00425 8.73465L5.82908 7.90981L7.16667 9.2474V5.7474H8.33333V9.2474L9.67092 7.90981L10.4958 8.73465L8.57483 10.6556Z" fill="#232323"/>
                                                        </g>
                                                        <defs>
                                                            <clipPath id="clip0_10223_4976">
                                                                <rect width="14" height="14" fill="white" transform="translate(0.75 0.5)"/>
                                                            </clipPath>
                                                        </defs>
                                                    </svg>
                                                    {{translate('download')}}
                                                </a>
                                                <button class="btn btn--primary d-flex align-items-center gap-2 rounded db-path" data-text="{{$recentFile['db_path']}}">
                                                    <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <g clip-path="url(#clip0_10223_3598)">
                                                            <path d="M5.35635 9.8924C5.01452 9.55115 5.01452 8.9964 5.35635 8.65515C5.69818 8.31331 6.25177 8.31331 6.5936 8.65515C7.3671 9.42865 8.71693 9.42923 9.49043 8.65515L12.4007 5.7449C13.1993 4.94631 13.1993 3.64665 12.4007 2.84806C11.6021 2.04948 10.3024 2.04948 9.50385 2.84806C9.16201 3.1899 8.60843 3.1899 8.2666 2.84806C7.92477 2.50681 7.92477 1.95206 8.2666 1.61081C9.7471 0.129729 12.1574 0.129729 13.6379 1.61081C15.119 3.0919 15.119 5.50106 13.6379 6.98215L10.7277 9.8924C9.98685 10.6332 9.01443 11.0031 8.04202 11.0031C7.0696 11.0031 6.0966 10.6326 5.35635 9.8924ZM4.54902 14.4966C5.52143 14.4966 6.49385 14.1262 7.23468 13.386C7.57652 13.0447 7.57652 12.49 7.23468 12.1487C6.89285 11.8069 6.33927 11.8069 5.99743 12.1487C5.19827 12.9479 3.8986 12.9473 3.1006 12.1487C2.30202 11.3501 2.30202 10.0505 3.1006 9.2519L5.99451 6.35798C6.79368 5.55881 8.09335 5.55881 8.89135 6.35798C9.23318 6.69981 9.78677 6.69981 10.1286 6.35798C10.4704 6.01673 10.4704 5.46198 10.1286 5.12073C8.64751 3.63965 6.23835 3.63965 4.75727 5.12073L1.86277 8.01465C0.381682 9.49573 0.381682 11.9049 1.86277 13.386C2.6036 14.1268 3.5766 14.4966 4.54902 14.4966Z" fill="white"/>
                                                        </g>
                                                        <defs>
                                                            <clipPath id="clip0_10223_3598">
                                                                <rect width="14" height="14" fill="white" transform="translate(0.75 0.5)"/>
                                                            </clipPath>
                                                        </defs>
                                                    </svg>
                                                    {{ translate('Copy path') }}
                                                </button>
                                            @endcan
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @empty
                                <tr class="text-center">
                                    <td colspan="7">{{translate('No data available')}}</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="indicator"></div>
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{translate('Upload Image')}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('admin.business-settings.upload-gallery-image')}}" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            <input type="text" name="path" value="{{base64_decode($folderPath)}}" hidden>
                            <input type="text" name="disk" value = "{{$storage}}" hidden>

                            <div class="form-group mb-1">
                                <div class="custom-file">
                                    <label class="mb-2" for="customFileUpload">{{translate('choose images')}}</label>
                                    <input type="file" name="images[]" id="customFileUpload" class="form-control"
                                           accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" multiple>
                                </div>
                            </div>

                            <div class="row mb-3" id="files"></div>
                            <div class="d-flex justify-content-end">
                                <input class="btn btn--primary rounded" type="submit" value="{{translate('upload')}}">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="addZipFile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="indicator"></div>
                    <div class="modal-header">
                        <h5 class="modal-title" id="addZipFileLabel">{{translate('upload file')}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('admin.business-settings.upload-gallery-image')}}" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            <input type="text" name="path" value="{{base64_decode($folderPath)}}" hidden>
                            <input type="text" name="disk" value = "{{$storage}}" hidden>

                            <div class="form-group mb-1">
                                <div class="custom-file">
                                    <label class="mb-2" id="zipFileLabel"
                                           for="customZipFileUpload">{{translate('upload_zip_file')}}</label>
                                    <input type="file" name="file" id="customZipFileUpload" class="form-control"
                                           accept=".zip">
                                </div>
                            </div>

                            <div class="row mb-3" id="files"></div>
                            <div class="d-flex justify-content-end">
                                <input class="btn btn--primary rounded" type="submit" value="{{translate('upload')}}">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Multiple Image Upload Offcanvas -->

        <div class="offcanvas offcanvas-end offcanvas-cus-sm" tabindex="-1" id="AddImage__offcanvas" aria-labelledby="AddImage__offcanvasLabel">
            <div class="offcanvas-header py-md-4 py-3">
                <h3 class="mb-0">{{ translate('Image Upload') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            <form action="{{route('admin.business-settings.upload-gallery-image')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="offcanvas-body bg-white p-20">
                    <div class="discount-type mb-20">
                        <div class="bg-primary d-flex align-items-center rounded-2 p-20 bg-opacity-10 mb-20">
                            <div class="boxes">
                                <div class="d-flex align-items-center gap-1 text-primary mb-3">
                                    <img src="{{asset('/public/assets/admin-module/img/lights-icons.png')}}" class="svg" alt=""> <h4 class="text-primary">{{('Instructions')}}</h4>
                                </div>
                                <ul class="d-flex flex-column gap-2 px-3 mb-0">
                                    <li class="fz-12">
                                        {{translate('Upload file must be ')}}  {{ implode(', ', array_column(IMAGEEXTENSION, 'key')) }}
                                    </li>
                                    <li class="fz-12">
                                        {{translate('Uploaded file total size maximum ')}} {{ readableUploadMaxFileSize('image') }}
                                    </li>
                                    <li class="fz-12">
                                        {{translate('Without click Upload the items are not uploaded to your server and can’t see the items in your gallery.')}}
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div>
                            <input type="text" name="path" value="{{base64_decode($folderPath)}}" hidden>
                            <input type="text" name="disk" value ="{{$storage}}" hidden>

                            <div class="body-bg rounded p-20 mb-20">
                                <h5 class="fw-normal mb-15 text-center">{{ translate('Choose Image') }} <span class="text-danger">*</span></h5>
                                <div class="trigger-image-hit ratio-1 position-relative max-w-100 overflow-hidden bg-white border-dashed rounded-2 mx-auto h-100px d-center">
                                    <input type="file" name="images[]" multiple
                                           accept=".{{ implode(',.', array_column(IMAGEEXTENSION, 'key')) }}, |image/*"
                                           data-maxFileSize="{{ readableUploadMaxFileSize('image') }}"
                                           required style="position: absolute; width: 100%; height: 100%; opacity: 0; cursor: pointer;">
                                    <div class="global-upload-box">
                                        <div class="upload-content text-center">
                                            <span class="material-symbols-outlined placeholder-icon mb-1 text-primary">photo_camera</span>
                                            <span class="fz-10 d-block">{{ translate('Add image') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="inside-upload-imageBox">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="offcanvas-footer border-top">
                    <div class="d-flex justify-content-center gap-sm-3 gap-2 bg-white p-20">
                        <button type="reset" class="btn btn--secondary rounded w-100" data-bs-dismiss="offcanvas"> {{translate('Cancel')}} </button>
                        <button type="submit" class="btn btn--primary rounded w-100">{{translate('Upload')}}</button>
                    </div>
                </div>
            </form>
        </div>

    <!-- File Upload Offcanvas -->

        <div class="offcanvas offcanvas-end offcanvas-cus-sm" tabindex="-1" id="AddFile__offcanvas" aria-labelledby="AddFile__offcanvasLabel">
            <div class="offcanvas-header py-md-4 py-3">
                <h3 class="mb-0">File Upload</h3>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            <form action="{{route('admin.business-settings.upload-gallery-image')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="offcanvas-body bg-white p-20">
                    <div class="discount-type mb-20">
                        <div class="bg-primary d-flex align-items-center rounded-2 p-20 bg-opacity-10 mb-20">
                            <div class="boxes">
                                <div class="d-flex align-items-center gap-1 text-primary mb-3">
                                    <img src="{{asset('/public/assets/admin-module/img/lights-icons.png')}}" class="svg" alt=""> <h4 class="text-primary">{{('Instructions')}}</h4>
                                </div>
                                <ul class="d-flex flex-column gap-2 px-3 mb-0">
                                    <li class="fz-12">
                                        {{translate('Upload file must be  ZIP file format in and click upload.')}}
                                    </li>
                                    <li class="fz-12">
                                        {{translate('Uploaded file total size maximum ')}} {{ readableUploadMaxFileSize('file') }}
                                    </li>
                                    <li class="fz-12">
                                        {{translate('Without click Upload the items are not uploaded to your server and can’t see the items in your gallery.')}}
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div>
                            <input type="text" name="path" value="{{base64_decode($folderPath)}}" hidden>
                            <input type="text" name="disk" value = "{{$storage}}" hidden>

                            <div class="body-bg rounded p-20 mb-20">
                                <h5 class="fw-normal mb-15 text-center">Choose Zip File <span class="text-danger">*</span></h5>
                                <div class="trigger-zip-hit ratio-1 position-relative max-w-100 overflow-hidden bg-white border-dashed rounded-2 mx-auto h-100px d-center">
                                    <input type="file" name="file"
                                           accept=".zip"
                                           data-maxFileSize="{{ readableUploadMaxFileSize('file') }}"
                                           required style="position: absolute; width: 100%; height: 100%; opacity: 0; cursor: pointer;">
                                    <div class="global-upload-box">
                                        <div class="upload-content text-center">
                                            <span class="material-symbols-outlined placeholder-icon mb-1 text-primary">folder</span>
                                            <span class="fz-10 d-block">{{ translate('Upload File') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="inside-upload-zipBox">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="offcanvas-footer border-top">
                    <div class="d-flex justify-content-center gap-sm-3 gap-2 bg-white p-20">
                        <button type="reset" class="btn btn--secondary rounded w-100" data-bs-dismiss="offcanvas"> {{translate('Cancel')}} </button>
                        <button type="submit" class="btn btn--primary rounded w-100"> {{translate('Upload')}} </button>
                    </div>
                </div>
            </form>

        </div>

    <!--cant Uploaded Modal-->
    <div class="modal fade custom-confirmation-modal" id="cantBe__uploaded" tabindex="-1" aria-labelledby="cantBe__uploadedLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-30">
                    <button type="button" class="btn-close bg-light rounded-full" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="d-flex flex-column align-items-center text-center">
                        <img class="mb-20" src="{{asset('public/assets/admin-module')}}/img/cant-uploaded.png" alt="">
                        <h3 class="mb-15">{{ translate('Some Files Can’t Uploaded')}}</h3>
                        <p class="mb-4 fz-14">{{ translate('Your maximum file upload limit is 128MB. Please select files between 128MB to avoid any upload interruption.')}}</p>
                        <form action="{{ route('admin.subscription.package.subscription-to-commission') }}" method="post">
                            @csrf
                            <div class="choose-option">
                                <div class="d-flex gap-3 justify-content-center flex-wrap">
                                    <button type="button" class="btn px-xl-5 px-4 btn--primary text-capitalize rounded">{{  translate('Okay, Got it') }}</button>
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

        function readURL(input) {
            $('#files').html("");
            for (var i = 0; i < input.files.length; i++) {
                if (input.files && input.files[i]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#files').append('<div class="col-md-2 col-sm-4 m-1"><img class="initial-28" id="viewer" src="' + e.target.result + '"/></div>');
                    }
                    reader.readAsDataURL(input.files[i]);
                }
            }

        }

        $("#customFileUpload").change(function () {
            readURL(this);
        });

        $('#customZipFileUpload').change(function (e) {
            var fileName = e.target.files[0].name;
            $('#zipFileLabel').html(fileName);
        });

        $('.db-path').on('click', function () {
            let text = $(this).data('text');
            copy_test(text)
        });

        function copy_test(copyText) {
            navigator.clipboard.writeText(copyText);

            toastr.success('{{ translate('File path copied successfully!') }}', {
                CloseButton: true,
                ProgressBar: true
            });
        }

    </script>
@endpush
