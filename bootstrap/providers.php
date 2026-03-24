<?php

return [

    /*
     * Package Service Providers...
     */
    Nwidart\Modules\LaravelModulesServiceProvider::class,

    /*
     * Application Service Providers...
     */
    App\Providers\AppServiceProvider::class,
    App\Providers\AuthServiceProvider::class,
    App\Providers\EventServiceProvider::class,
    App\Providers\RouteServiceProvider::class,
    Spatie\Backup\BackupServiceProvider::class,
    App\Providers\StorageServiceProvider::class,
    App\Providers\FirebaseServiceProvider::class,
    App\Providers\ObserverServiceProvider::class
];
