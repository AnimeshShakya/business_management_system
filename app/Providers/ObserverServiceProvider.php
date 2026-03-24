<?php

namespace App\Providers;

use App\Observers\ClearCacheObserver;
use Illuminate\Support\ServiceProvider;
use Modules\BookingModule\Entities\Booking;
use Modules\BusinessSettingsModule\Entities\BusinessPageSetting;
use Modules\BusinessSettingsModule\Entities\PackageSubscriber;
use Modules\BusinessSettingsModule\Entities\SubscriptionPackage;
use Modules\CategoryManagement\Entities\Category;
use Modules\CustomerModule\Entities\SubscribeNewsletter;
use Modules\PaymentModule\Entities\Bonus;
use Modules\PromotionManagement\Entities\Advertisement;
use Modules\PromotionManagement\Entities\Banner;
use Modules\PromotionManagement\Entities\Campaign;
use Modules\PromotionManagement\Entities\Coupon;
use Modules\PromotionManagement\Entities\Discount;
use Modules\PromotionManagement\Entities\PushNotification;
use Modules\ProviderManagement\Entities\Provider;
use Modules\ServiceManagement\Entities\Faq;
use Modules\ServiceManagement\Entities\Service;
use Modules\TransactionModule\Entities\LoyaltyPointTransaction;
use Modules\UserManagement\Entities\Role;
use Modules\UserManagement\Entities\User;

class ObserverServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $models = [
            Provider::class,
            User::class,
            Booking::class,
            Service::class,
            Advertisement::class,
            Coupon::class,
            Discount::class,
            Bonus::class,
            Campaign::class,
            Banner::class,
            Category::class,
            SubscribeNewsletter::class,
            PushNotification::class,
            LoyaltyPointTransaction::class,
            PackageSubscriber::class,
            SubscriptionPackage::class,
            Faq::class,
            BusinessPageSetting::class,
            Role::class,
        ];

        foreach ($models as $model) {
            $model::observe(ClearCacheObserver::class);
        }
    }
}
