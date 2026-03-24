<li class="nav-item">
    <a class="nav-link {{ $webPage == 'map-api' ? 'active' : '' }}"
       href="{{ route('admin.configuration.third-party', 'map-api') }}">
        {{translate('Map Api')}}
    </a>
</li>

<li class="nav-item">
    <a class="nav-link {{ $webPage=='recaptcha' ? 'active' : '' }}"
       href="{{ route('admin.configuration.third-party', 'recaptcha') }}">
        {{translate('recaptcha')}}
    </a>
</li>
<li class="nav-item">
    <a class="nav-link {{ $webPage=='apple-login' ? 'active' : '' }}"
       href="{{ route('admin.configuration.third-party', 'apple-login') }}">
        {{translate('apple_login')}}
    </a>
</li>

<li class="nav-item">
    <a class="nav-link {{ $webPage=='email-config' ?'active':'' }}"
       href="{{ route('admin.configuration.third-party', 'email-config') }}">
        {{translate('email_config')}}
    </a>
</li>

<li class="nav-item">
    <a class="nav-link {{ $webPage == 'sms_config' ? 'active' : '' }}"
       href="{{ route('admin.configuration.third-party', 'sms_config') }}">
        {{translate('Sms Config')}}
    </a>
</li>


<li class="nav-item">
    <a class="nav-link {{ $webPage == 'storage_connection' ? 'active' :'' }}"
       href="{{ route('admin.configuration.third-party', 'storage_connection') }}">
        {{translate('Storage Connection')}}
    </a>
</li>

<li class="nav-item">
    <a class="nav-link {{ $webPage=='app_settings'?'active':'' }}"
       href="{{ route('admin.configuration.third-party', 'app_settings') }}">
        {{translate('App Settings')}}
    </a>
</li>
