<?php

use Illuminate\Auth\Middleware\AuthenticateWithBasicAuth;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;
use Illuminate\Auth\Middleware\RequirePassword;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\{ApiHitLimitMiddleware,
    Authenticate,
    EncryptCookies,
    Localization,
    LocalizationMiddleware,
    MaintenanceMode,
    RedirectIfAuthenticated,
    Subscription,
    SubscriptionModalMiddleware,
    VerifyCsrfToken,
    ZoneAdder};
use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull;
use Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance;
use Illuminate\Foundation\Http\Middleware\TrimStrings;
use Illuminate\Foundation\Http\Middleware\ValidatePostSize;
use Illuminate\Http\Middleware\HandleCors;
use Illuminate\Http\Middleware\SetCacheHeaders;
use Illuminate\Http\Middleware\TrustProxies;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Routing\Middleware\ValidateSignature;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Modules\BidModule\Http\Middleware\EnsureBiddingIsActive;
use Modules\ProviderManagement\Http\Middleware\ProviderMiddleware;
use Modules\UserManagement\Http\Middleware\AdminModulePermission;
use Modules\UserManagement\Http\Middleware\DetectUser;

$app = Application::configure(basePath: dirname(__DIR__))
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->use([
//            TrustHosts::class,
            TrustProxies::class,
            HandleCors::class,
            PreventRequestsDuringMaintenance::class,
            ValidatePostSize::class,
            TrimStrings::class,
            ConvertEmptyStringsToNull::class,
            ZoneAdder::class
        ]);
        $middleware->group('web', [
            EncryptCookies::class,
            AddQueuedCookiesToResponse::class,
            StartSession::class,
            ShareErrorsFromSession::class,
            VerifyCsrfToken::class,
            SubstituteBindings::class,
            Localization::class,
            SubscriptionModalMiddleware::class,
            MaintenanceMode::class,
        ]);
        $middleware->group('api', [
//           EnsureFrontendRequestsAreStateful::class,
            'throttle:180,1',
            SubstituteBindings::class,
            LocalizationMiddleware::class
        ]);
        /*
        |--------------------------------------------------------------------------
        | Route Middleware (Aliases)
        |--------------------------------------------------------------------------
        */
        $middleware->alias([
            'auth' => Authenticate::class,
            'auth.basic' => AuthenticateWithBasicAuth::class,
            'cache.headers' => SetCacheHeaders::class,
            'can' => Authorize::class,
            'guest' => RedirectIfAuthenticated::class,
            'password.confirm' => RequirePassword::class,
            'signed' => ValidateSignature::class,
            'throttle' => ThrottleRequests::class,
            'verified' => EnsureEmailIsVerified::class,
            'mpc' => AdminModulePermission::class,
            'hitLimiter' => ApiHitLimitMiddleware::class,
            'detectUser' => DetectUser::class,
            'admin' => \Modules\AdminModule\Http\Middleware\AdminMiddleware::class,
            'provider' => ProviderMiddleware::class,
            'ensureBiddingIsActive' => EnsureBiddingIsActive::class,
            'subscription' => Subscription::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // You can customize exception handling here if needed
    })
    ->create();

return $app;
