<?php

namespace App\Lib;

use Illuminate\Support\Facades\Cache;
use JetBrains\PhpStorm\NoReturn;

class AdvancedSearchCacheHelper
{
    #[NoReturn]
    public static function clearCache(string $model): void
    {   $discountCacheKey = '';
        if($model == "Modules\PromotionManagement\Entities\Coupon"){
            $discountCacheKey = "advanced_search_Modules\PromotionManagement\Entities\Discount";
        }
        $cacheKey = 'advanced_search_' . $model;
        Cache::forget($cacheKey);
        Cache::forget($discountCacheKey);
    }
}
