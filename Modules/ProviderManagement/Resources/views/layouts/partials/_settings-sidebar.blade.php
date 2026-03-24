<!-- <div class="settings-sidebar">
    <div class="settings-toggle-icon">
        <span class="material-icons">settings</span>
    </div>
    <div class="settings-content">
        <h4>{{translate('Settings')}}</h4>
        <div class="switchers-wrap">
            <div class="switch-items">
                <div class="setting-box-wrap">
                    <div class="setting-box active light-mode">
                        <img src="{{asset('public/assets/provider-module')}}/img/light-mode.png" width="36px" alt="{{ translate('provider-module') }}">
                    </div>
                    <h5>{{translate('Light_Mode')}}</h5>
                </div>
                <div class="setting-box-wrap">
                    <div class="setting-box dark-mode">
                        <img src="{{asset('public/assets/provider-module')}}/img/dark-mode.png" width="36px" alt="{{ translate('provider-module') }}">
                    </div>
                    <h5>{{translate('Dark_Mode')}}</h5>
                </div>
            </div>
        </div>
    </div>
</div> -->


<div class="view-guideline-btn w-50px h-50px bg-white position-fixed pointer show">
        <div class="d-flex justify-content-center align-items-center h-100 w-100">
            <button type="button" class="btn bg-info text-absolute-white border-0 p-0 action-btn" style="--size: 36px">
                <img src="{{asset('public/assets/admin-module')}}/img/multiple-forward.svg" alt="icon/img" class="icon">
            </button>
        </div>
    </div>

    {{-- Easy Setup Dropdown --}}
    <div class="easy-setup-dropdown bg-white p-3 p-sm-20">
        <div class="d-flex justify-content-between align-items-center gap-2 mb-20">
            <h5 class="mb-0"> {{ translate('Easy Setup') }}</h5>
            <button type="button" class="p-0 m-0 border-0 shadow-none text-secondary bg-transparent easy-setup-dropdown_close"><span class="border rounded-circle d-flex align-items-center justify-content-center w-24 h-24 fs-14" aria-hidden="true">&times;</span></button>
        </div>
        {{-- <div class="bg-light p-3 p-sm-20 rounded-10 d-flex justify-content-between align-items-center gap-2 mb-20">
            <i class="fi fi-sr-book-bookmark"></i>
            <span class="flex-grow-1">{{ translate('See Guideline') }} </span>
            <span class="text-primary cursor-pointer" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSetupGuide">
                <i class="fi fi-rr-up-right-from-square"></i>
            </span>
        </div> --}}
        <div class="bg-light p-3 p-sm-20 rounded-10">
            <div class="d-flex align-items-center gap-2 mb-20">
                {{-- <i class="fi fi-sr-table-layout"></i> --}}
                <span>{{ translate('Theme Mode') }} </span>
            </div>
            <div class="">
                <div class="d-flex gap-3 gap-sm-4 flex-wrap">
                    <div class="setting-box flex-grow-1 light-mode">
                        <img src="{{asset('public/assets/provider-module')}}/img/icons/light-mode.svg" width="30" alt="{{ translate('provider-module') }}">
                    </div>
                    <div class="setting-box flex-grow-1 dark-mode">
                        <img src="{{asset('public/assets/provider-module')}}/img/icons/dark-mode.svg" width="30" alt="{{ translate('provider-module') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
