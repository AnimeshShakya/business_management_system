<div class="mb-20 nav-tabs-responsive position-relative">
    <ul class="nav nav--tabs scrollbar-w flex-nowrap white-nowrap overflow-x-auto flex-wrap-nowrap nav--tabs__style2">
        <li class="nav-item">
            <a href="{{ route('admin.configuration.third-party', 'firebase-configuration') }}" class="nav-link {{ $webPage == 'firebase-configuration' ? 'active' : '' }}">
                {{translate('Configuration')}}
            </a>
        </li>
        <li class="nav-item">
            <a href="{{  route('admin.configuration.third-party', 'firebase-authentication') }}" class="nav-link  {{ $webPage == 'firebase-authentication' ? 'active' : '' }}">
                {{translate('Authentication')}}
            </a>
        </li>
    </ul>
    <div class="nav--tab__prev position-absolute top-0 start-3">
        <button class="border-0 w-38 h-38 d-flex align-items-center justify-content-center rounded-full p-0 bg-white text-primary">
                    <span class="material-symbols-outlined">
                        arrow_back_ios
                    </span>
        </button>
    </div>
    <div class="nav--tab__next position-absolute top-0 right-3">
        <button class="border-0 w-38 h-38 d-flex align-items-center justify-content-center rounded-full p-0 bg-white text-primary">
                    <span class="material-symbols-outlined">
                        arrow_forward_ios
                    </span>
        </button>
    </div>
</div>
