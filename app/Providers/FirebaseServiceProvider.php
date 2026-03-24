<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Kreait\Firebase\Factory;

class FirebaseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('firebase.firestore', function ($app) {
            $serviceAccountKey = business_config('push_notification', 'third_party')->live_values ??[];
            $jsonDecodeKey = json_decode($serviceAccountKey['service_file_content'], true);

            if (!isset($jsonDecodeKey['client_email'])) {
                return false;
            }

            if(count($jsonDecodeKey)>0){
                $serviceAccount = $jsonDecodeKey;
                return (new Factory)
                    ->withServiceAccount($serviceAccount)
                    ->createMessaging();
            }
            return false;
        });
        $this->app->singleton('firebase.messaging', function ($app) {
            $serviceAccountKey = business_config('push_notification', 'third_party')->live_values ?? [];
            if (!is_array($serviceAccountKey) || empty($serviceAccountKey['service_file_content'])) {
                return false;
            }

            $jsonDecodeKey = json_decode($serviceAccountKey['service_file_content'], true);

            if (!isset($jsonDecodeKey['client_email'])) {
                return false;
            }

            if(isset($jsonDecodeKey) && count($jsonDecodeKey)>0){
                $serviceAccount = $jsonDecodeKey;
                return (new Factory)
                    ->withServiceAccount($serviceAccount)
                    ->createMessaging();
            }
            return false;
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
