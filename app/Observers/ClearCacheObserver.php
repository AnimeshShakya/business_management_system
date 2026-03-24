<?php

namespace App\Observers;

use App\Lib\AdvancedSearchCacheHelper;

class ClearCacheObserver
{
    public function created($model)
    {
        AdvancedSearchCacheHelper::clearCache(get_class($model));
    }

    public function deleted($model)
    {
        AdvancedSearchCacheHelper::clearCache(get_class($model));
    }

    public function forceDeleted($model)
    {
        AdvancedSearchCacheHelper::clearCache(get_class($model));
    }

    public function restored($model)
    {
        AdvancedSearchCacheHelper::clearCache(get_class($model));
    }
     public function updated($model)
     {
         AdvancedSearchCacheHelper::clearCache(get_class($model));
     }
}
