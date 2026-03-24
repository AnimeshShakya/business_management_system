<?php

namespace Modules\AdminModule\Services;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Modules\AdminModule\Traits\AdminMenuWithRoutes;
use Modules\AdminModule\Traits\AdminModelWithRoutes;
use Modules\AdminModule\Traits\ProviderModelWithRoutes;
use Modules\AdminModule\Traits\ProviderMenuWithRoutes;
use Modules\UserManagement\Entities\Serviceman;
use stdClass;

class AdvanceSearch
{
    use ProviderModelWithRoutes;
    use ProviderMenuWithRoutes;
    use AdminMenuWithRoutes;
    use AdminModelWithRoutes;

    public function getCacheTimeoutByDays(int $days = 3): int
    {
        return 60 * 60 * 24 * $days;
    }

    public function getModelPrefix(): string
    {
        return 'advanced_search_';
    }

    public function searchModelList($keyword, $type, $user = null): JsonResponse|array
    {
        $result = [];
        $models = $this->getModels($type);
        if (empty($keyword) || empty($models)) {
            return empty($models) ? response()->json(['error' => 'Access type not found'], 500) : $result;
        }
        $keyword = strtolower($keyword);

        foreach ($models as $key => $table) {
            if ($type === 'admin') {
                $allItems = $this->getCachedModelItems($table);
            } else {
                $allItems = $this->getProviderCachedModelItems($table, $user);
            }
            $filteredItems = $this->filterItemsByKeyword($allItems, $keyword, $table);
            if ($filteredItems->count() > 0) {
                $this->processFilteredItems($filteredItems, $table, $key, $keyword, $type, $result);
            }
        }

        return collect($result)->unique('uri')->values()->all();
    }


    private function getModels($type): array
    {
        return $type == "admin" ? $this->getAdminModels() : $this->getProviderModels();
    }


    private function getCachedModelItems($table)
    {
        $modelClass = $table['model'];
        $cache_key = $this->getModelPrefix() . $modelClass;

        return Cache::remember(
            $cache_key,
            $this->getCacheTimeoutByDays(days: 2),
            function () use ($table, $modelClass) {
                $query = $modelClass::select($table['column']);
                if (in_array(SoftDeletes::class, class_uses_recursive($modelClass))) {
                    $query->whereNull('deleted_at');
                }
                if (!empty($table['relations']) && is_array($table['relations'])) {
                    $query->with(array_keys($table['relations']));
                }
                return $query->get();
            }
        );
    }

    private function getProviderCachedModelItems($table, $user)
    {
        if (!$user) {
            return collect();
        }
        $modelClass = $table['model'];
        $cache_key = $this->getModelPrefix() . $modelClass;
        if ($user) {
            $cache_key .= '_user_' . $user->id;
            if ($user->provider) {
                $cache_key .= '_provider_' . $user->provider->id;
            }
        }
        return Cache::remember(
            $cache_key,
            $this->getCacheTimeoutByDays(days: 2),
            function () use ($table, $modelClass,$user) {
                $query = $modelClass::select($table['column']);
                if (isset($table['type']) && $table['type'] === 'providers') {
                    $query->where('user_id', $user->id);
                }
                if (isset($table['type']) && $table['type'] === 'users') {
                    $query->where('id', $user->id);
                }
                if (isset($table['type']) && $table['type'] === 'bookings') {
                    $query->where('provider_id', $user->provider?->id);
                }
                if (isset($table['type']) && $table['type'] === 'advertisements') {
                    $query->where('provider_id', $user->provider?->id);
                }
                if (in_array(SoftDeletes::class, class_uses_recursive($modelClass))) {
                    $query->whereNull('deleted_at');
                }
                if (!empty($table['relations']) && is_array($table['relations'])) {
                    $query->with(array_keys($table['relations']));
                }
                return $query->get();
            }
        );
    }


    private function filterItemsByKeyword($allItems, $keyword, $table)
    {
        return $allItems->filter(function ($item) use ($keyword, $table) {
            if ($this->checkMainColumns($item, $keyword, $table)) {
                return true;
            }
            if ($this->checkFullName($item, $keyword, $table)) {
                return true;
            }
            if ($this->checkRelations($item, $keyword, $table)) {
                return true;
            }
            return false;
        });
    }

    private function checkMainColumns($item, $keyword, $table): bool
    {
        foreach ($table['column'] as $column) {
            if ($table['type'] === "users" && $column === "user_type") {
                continue;
            }
            $value = strtolower((string)($item->{$column} ?? ''));
            if (stripos($value, $keyword) !== false) {
                return true;
            }
        }
        return false;
    }

    private function checkFullName($item, $keyword, $table): bool
    {
        if (in_array('first_name', $table['column']) && in_array('last_name', $table['column'])) {
            $fullName = strtolower(trim(($item->first_name ?? '') . ' ' . ($item->last_name ?? '')));
            if (preg_match('/' . preg_quote(strtolower($keyword), '/') . '/', $fullName)) {
                return true;
            }
        }
        return false;
    }

    private function checkRelations($item, $keyword, $table): bool
    {
        if (empty($table['relations'])) {
            return false;
        }

        foreach ($table['relations'] as $relationName => $relationData) {
            $relatedItems = $item->{$relationName} ?? null;

            if ($relatedItems) {
                if ($relatedItems instanceof \Illuminate\Support\Collection) {
                    // hasMany
                    foreach ($relatedItems as $relatedItem) {
                        if ($this->checkRelationColumns($relatedItem, $keyword, $relationData)) {
                            return true;
                        }
                    }
                } else {
                    // hasOne / belongsTo
                    if ($this->checkRelationColumns($relatedItems, $keyword, $relationData)) {
                        return true;
                    }
                }
            }
        }
        return false;
    }

    private function checkRelationColumns($relatedItem, $keyword, $relationData): bool
    {
        foreach ($relationData['columns'] as $relColumn) {
            $relValue = strtolower((string)($relatedItem->{$relColumn} ?? ''));
            if (preg_match('/(?<![a-zA-Z0-9])' . preg_quote($keyword, '/') . '(?![a-zA-Z0-9])/i', $relValue)) {
                return true;
            }
        }
        return false;
    }

    private function processFilteredItems($filteredItems, $table, $key, $keyword, $type, &$result): void
    {
        foreach ($filteredItems as $item) {
            $hasValidRoute = false;
            $routeDataList = [];
            foreach ($table['routes'] as $route) {
                $routeData = $this->processItemRoute($item, $route, $key, $type);
                $routeDataList[] = $routeData;

                if (!empty($routeData['finalUrl'])) {
                    $hasValidRoute = true;
                }
            }
            $this->processItemRelations($item, $table, $keyword, $key, $type, $result);
            if ($hasValidRoute) {
                foreach ($routeDataList as $index => $routeData) {
                    if (!empty($routeData['finalUrl'])) {
                        $result[] = $this->buildResultItem($routeData, $keyword, $key, $table['routes'][$index], $item->id ?? '');
                    }
                }
            }
        }
    }

    private function processItemRoute($item, $route, $key, $type): array
    {
        $finalRoute = $route;
        $pageTitle = $item->name ?? ucfirst($this->getRouteName($route));
        $finalUrl = $finalRoute;
        if (strpos($route, '{id}') !== false && isset($item->id)) {
            $finalUrl = str_replace('{id}', (string)$item->id, $route);
        }
        switch ($key) {
            case "users":
                return $this->processUserRoute($item, $finalRoute, $type);
            case "faqs":
                return $this->processFaqRoute($item, $finalRoute);
            case "providers":
                return $this->processProviderRoute($item, $finalRoute, $route, $type);
            case "services":
                $pageTitle = $item->name ?? $pageTitle;
                return ['pageTitle' => $pageTitle, 'finalUrl' => $finalUrl];
            case "categories":
                return $this->processCategoryRoute($item, $finalRoute, $type);
            case "advertisements":
                return ['pageTitle' => $item->title, 'finalUrl' => $finalUrl];
            case "discounts":
                $pageTitle = $item->discount_title;

                if (($item->promotion_type ?? '') !== 'discount') {
                    return ['pageTitle' => $pageTitle, 'finalUrl' => null];
                }
                if (strpos($route, '{id}') !== false && isset($item->id)) {
                    $finalUrl = str_replace('{id}', (string)$item->id, $route);
                }
                return ['pageTitle' => $pageTitle, 'finalUrl' => $finalUrl];

            case "bonuses":
                return ['pageTitle' => $item->bonus_title, 'finalUrl' => $finalUrl];
            case "campaigns":
                return ['pageTitle' => $item->campaign_name, 'finalUrl' => $finalUrl];
            case "banners":
                return ['pageTitle' => $item->banner_title, 'finalUrl' => $finalUrl];
            case "subscribe_newsletters":
                return ['pageTitle' => $item->email, 'finalUrl' => $finalUrl];
            case "coupons":
                return ['pageTitle' => $item->coupon_code, 'finalUrl' => $finalUrl];
            case "transactions":
                return $this->processTransactionRoute($item, $route, $type);
            case "bookings":
                return $this->processBookingRoute($item, $route);
        }

        if ($key !== "faqs" && strpos($route, '{id}') !== false && isset($item->id) && $type == "admin") {
            $finalRoute = str_replace('{id}', (string)$item->id, $route);
            $finalUrl = str_replace('{id}', (string)$item->id, $finalUrl);
        }

        return ['pageTitle' => $pageTitle, 'finalUrl' => $finalUrl];
    }

    private function processUserRoute($item, $finalRoute, $type): array
    {
        $pageTitle = trim($item->first_name . ' ' . $item->last_name);

        if ($type == "admin") {
            if ($item->user_type == "admin-employee") {
                if (strpos($finalRoute, '/edit/') !== false) {
                    $finalRoute = str_replace('customer', 'employee', $finalRoute);
                }
            }
            if ($finalRoute === 'admin/employee/list' && $item->user_type !== "admin-employee") {
                return ['pageTitle' => $pageTitle, 'finalUrl' => null];
            }
            if (strpos($finalRoute, 'admin/customer/edit') !== false && $item->user_type !== "customer") {
                return ['pageTitle' => $pageTitle, 'finalUrl' => null];
            }
            if (strpos($finalRoute, '{id}') !== false) {
                $finalRoute = str_replace('{id}', $item->id, $finalRoute);
            }
        } else {
            $id = $item->serviceman?->id;
            if ($id && strpos($finalRoute, '{id}') !== false) {
                $finalRoute = str_replace('{id}', $id, $finalRoute);
            } else {
                return ['pageTitle' => $pageTitle, 'finalUrl' => null];
            }
        }

        return ['pageTitle' => $pageTitle, 'finalUrl' => $finalRoute];
    }

    private function processFaqRoute($item, $finalRoute): array
    {
        $finalRoute = str_replace('{id}', $item->service_id, $finalRoute);
        return ['pageTitle' => $item->question ?? 'Service Detail', 'finalUrl' => $finalRoute];
    }

    private function processProviderRoute($item, $finalRoute, $route, $type): array
    {
        if (strpos($route, '{id}') !== false) {
            $finalRoute = str_replace('{id}', $item->id, $route);
        }
        return ['pageTitle' => $item->company_name, 'finalUrl' => $finalRoute];
    }

    private function processCategoryRoute($item, $finalRoute, $type): array
    {
        $pageTitle = $item->name;
        if ($finalRoute === 'admin/category/create') {
            return ['pageTitle' => 'Category List', 'finalUrl' => $finalRoute];
        }
        if ($type == "admin") {
            if ($item->position == 2) {
                $finalRoute = "admin/sub-category/edit/" . $item->id;
            } else {
                $finalRoute = str_replace('{id}', (string)$item->id, 'admin/category/edit/{id}');
            }
        }
        return ['pageTitle' => $pageTitle, 'finalUrl' => $finalRoute];
    }

    private function processTransactionRoute($item, $route, $type): array
    {
        $pageTitle = "Transaction";
        if ($type == "admin") {
            if ($item->debit != 0) {
                $url = 'transaction_type=debit';
            } elseif ($item->credit != 0) {
                $url = 'transaction_type=credit';
            } else {
                $url = 'transaction_type=all';
            }
            $finalUrl = $route . '?' . $url;
        } else {
            $finalUrl = $route;
        }
        return ['pageTitle' => $pageTitle, 'finalUrl' => $finalUrl];
    }

    private function processBookingRoute($item, $route): array
    {
        $title = '';
        $url = '';
        if (!empty($item->booking_status)) {
            $url .= 'booking_status=' . $item->booking_status;
            $title .= '-' . $item->booking_status;
        }

        if (isset($item->is_repeated)) {
            if ($item->is_repeated == 1) {
                $url .= ($url ? '&' : '') . 'service_type=repeat';
                $title .= '-Repeat';
            } elseif ($item->is_repeated == 0) {
                $url .= ($url ? '&' : '') . 'service_type=regular';
                $title .= '-Regular';
            }
        }

        $finalUrl = !empty($url) ? $route . '?' . $url : $route;

        if ($route == "admin/booking/details/{id}?web_page=details") {
            $route = "admin/booking/details/{id}?web_page=details";
            $title = "-Details";
            $finalUrl = str_replace('{id}', (string)$item->id, $route);
        } elseif ($route == "provider/booking/details/{id}?web_page=details") {
            $route = "provider/booking/details/{id}?web_page=details";
            $finalUrl = str_replace('{id}', (string)$item->id, $route);
            $title = "-Details";
        }
        $pageTitle = "Booking - #" . ($item->readable_id ?? ($item->id ?? '')) . $title;
        return ['pageTitle' => $pageTitle, 'finalUrl' => $finalUrl];
    }

    private function buildResultItem($routeData, $keyword, $key, $route, $itemId): array
    {
        return [
            "page_title" => !empty(trim($routeData['pageTitle'])) ? trim($routeData['pageTitle']) : "Unknown",
            "page_title_value" => !empty(trim($routeData['pageTitle'])) ? trim($routeData['pageTitle']) : "Unknown",
            "full_route" => url($routeData['finalUrl']),
            "key" => base64_encode("dbsearch" . $route . $itemId),
            "uri" => $routeData['finalUrl'],
            "uri_count" => count(explode('/', $routeData['finalUrl'])),
            "method" => "GET",
            "keywords" => $keyword,
            "type" => $key,
            "priority" => 3
        ];
    }

    private function processItemRelations($item, $table, $keyword, $key, $type, &$result): void
    {
        if (empty($table['relations'])) {
            return;
        }

        foreach ($table['relations'] as $relationName => $relationData) {
            $relatedData = $item->{$relationName} ?? null;

            if ($relatedData) {
                $relatedData = is_array($relatedData) || $relatedData instanceof \Illuminate\Support\Collection
                    ? collect($relatedData)
                    : collect([$relatedData]);

                $relationRoutes = $relationData['admin_routes'] ?? [];

                foreach ($relatedData as $relatedItem) {
                    $this->processRelationRoutes($relatedItem, $relationRoutes, $keyword, $key, $type, $result);
                }
            }
        }
    }

    private function processRelationRoutes($relatedItem, $relationRoutes, $keyword, $key, $type, &$result): void
    {
        foreach ($relationRoutes as $relRoute => $label) {
            if (strpos($relRoute, '{id}') !== false && isset($relatedItem->id)) {
                $finalRelRoute = str_replace('{id}', (string)$relatedItem->id, $relRoute);
            } else {
                $finalRelRoute = $relRoute;
            }

            if ($type === 'provider' && $key === 'users') {
                if (strpos($finalRelRoute, 'booking_status=') !== false) {
                    $status = $relatedItem->booking_status ?? 'all';
                    $finalRelRoute = preg_replace('/booking_status=[^&]+/', 'booking_status=' . $status, $finalRelRoute);
                }
            }

            $relatedId = $relatedItem->id ?? '';
            $result[] = [
                "page_title" => !empty(trim($label)) ? ucfirst(trim($label)) : "Unknown",
                "page_title_value" => !empty(trim($label)) ? ucfirst(trim($label)) : "Unknown",
                "uri" => $finalRelRoute,
                "key" => base64_encode("dbsearch" . $relRoute . $relatedId),
                "uri_count" => count(explode('/', $finalRelRoute)),
                "full_route" => url($finalRelRoute),
                "method" => "GET",
                "keywords" => $keyword,
                "type" => $key,
                "priority" => 3
            ];
        }
    }

    function formatRouteTitle($route)
    {
        $route = preg_replace('/\{id\}/', '', $route);
        $parts = parse_url($route);
        $pathSegments = explode('/', $parts['path'] ?? '');
        $base = ucfirst(end($pathSegments));
        $title = $base;
        if (isset($parts['query'])) {
            parse_str($parts['query'], $query);
            foreach ($query as $key => $value) {
                $title .= " - " . ucfirst(str_replace('_', ' ', $value));
            }
        }
        return trim($title);
    }

    private function getRouteName($actualRouteName)
    {
        $actualRouteName = preg_replace('/\{[^}]+\}/', '', $actualRouteName);
        $routeNameParts = explode('/', $actualRouteName);

        if (count($routeNameParts) >= 2) {
            $lastPart = $routeNameParts[count($routeNameParts) - 1];
            $secondLastPart = $routeNameParts[count($routeNameParts) - 2];

            if (strtolower($lastPart) === 'index') {
                $lastPart = 'List';
            }

            $lastPartWords = explode(' ', str_replace(['_', '-'], ' ', $lastPart));
            $secondLastPartWords = explode(' ', str_replace(['_', '-'], ' ', $secondLastPart));
            $allWords = array_merge($secondLastPartWords, $lastPartWords);
            $uniqueWords = [];

            foreach ($allWords as $word) {
                $lowerWord = strtolower($word);
                if (empty($uniqueWords) || strtolower(end($uniqueWords)) !== $lowerWord) {
                    $uniqueWords[] = $word;
                }
            }

            if (count($uniqueWords) > 1 && strtolower($uniqueWords[0]) === strtolower(end($uniqueWords))) {
                array_shift($uniqueWords);
            }

            $uniqueWords = array_filter($uniqueWords, function ($word) {
                return strtolower($word) !== 'rental';
            });

            $routeName = $this->formatRouteTitle(ucwords(implode(' ', $uniqueWords)));
        } else {
            $routeName = $this->formatRouteTitle(ucwords(str_replace(['.', '_', '-'], ' ', Str::afterLast($actualRouteName, '.'))));
        }
        return $routeName;
    }

    public function searchMenuList($searchKeyword, $type): array
    {
        $result = $type == "admin" ? $this->adminMenuWithRoutes() : $this->providerMenuWithRoutes();

        $translatedMenus = $this->getTranslatedMenus($result, $searchKeyword);
        $rawMenus = $this->getRawMenus($result, $searchKeyword);

        return $this->processAndSortMenus($translatedMenus, $rawMenus);
    }

    private function getTranslatedMenus($result, $searchKeyword): array
    {
        $translatedMenus = [];
        $defaultLang = session()->has('local') ? session('local') : 'en';

        if ($defaultLang != 'en') {
            $allMessages = include(base_path('resources/lang/' . $defaultLang . '/lang.php'));

            $allMessageKeys = [];
            foreach ($allMessages as $key => $value) {
                if (str_contains(strtolower((string)$value), $searchKeyword)) {
                    $allMessageKeys[] = strtolower($key);
                }
            }

            $translatedMenus = collect($result)->filter(function ($item) use ($searchKeyword, $allMessageKeys) {
                $value = strtolower((string)($item['page_title'] ?? ''));
                return in_array($value, $allMessageKeys);
            })
                ->unique('uri')
                ->values()
                ->map(function ($item) {
                    return $this->formatMenuItem($item);
                })
                ->toArray();
        }

        return $translatedMenus;
    }

    private function getRawMenus($result, $searchKeyword): array
    {
        return collect($result)
            ->filter(function ($item) use ($searchKeyword) {
                return $this->matchesMenuSearch($item, $searchKeyword);
            })
            ->unique('uri')
            ->values()
            ->map(function ($item) {
                return $this->formatMenuItem($item);
            })
            ->toArray();
    }

    private function matchesMenuSearch($item, $searchKeyword): bool
    {
        $pageTitleValue = strtolower($this->removeUnderscore($item['page_title_value'] ?? ''));
        $keywords = strtolower($item['keywords'] ?? '');
        $search = strtolower(trim($searchKeyword));

        if ($pageTitleValue === $search || str_contains($pageTitleValue, $search)) {
            return true;
        }

        $keywordList = array_map('trim', explode(',', $keywords));
        foreach ($keywordList as $key) {
            if ($key === $search || str_contains($key, $search)) {
                return true;
            }
        }

        return false;
    }

    private function formatMenuItem($item): array
    {
        return [
            'page_title' => ucwords($item['page_title'] ?? ''),
            'page_title_value' => $item['page_title_value'] ?? '',
            'uri' => $item['uri'] ?? '',
            'full_route' => $item['full_route'] ?? '',
            'type' => $item['type'] ?? '',
            'priority' => $item['priority'] ?? 1,
            'sorting' => $item['sorting'] ?? '',
            'module' => $item['module'] ?? '',
        ];
    }

    private function processAndSortMenus($translatedMenus, $rawMenus): array
    {
        return collect(array_merge($translatedMenus, $rawMenus))
            ->map(function ($item) {
                $item['page_title_value'] = translate($item['page_title_value']);
                return $item;
            })
            ->unique('uri')
            ->values()
            ->sortBy(function ($item) {
                $priority = match ($item['modules'] ?? '') {
                    'bookings' => 1,
                    'services' => 2,
                    'reports' => 3,
                    default => 999,
                };
                $sorting = $item['sorting'] ?? PHP_INT_MAX;
                return [$priority, $sorting];
            })
            ->values()
            ->toArray();
    }

    public function pageSearchList($keyword, $type): JsonResponse|array
    {
        $skipRouts = [
            'admin/configuration/get-third-party-config',
            'admin/configuration/get-email-config',
            'admin/customer/settings',
            'admin/configuration/get-app-settings',
            'admin/configuration/sms-get',
            'admin/configuration/offline-payment/list'
        ];

        $paths = $this->getLanguagePaths($type);
        $this->ensureLanguageFileExists($paths['langPath'], $paths['engPath']);

        $langData = json_decode(File::get($paths['langPath']), true);
        $routesData = json_decode(File::get($paths['formattedRoutesPath']), true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return response()->json(['error' => 'Invalid JSON in routes.json'], 500);
        }

        $matchedRoutes = $this->findMatchedRoutes($langData, strtolower($keyword));
        $finalMatchedRoutes = $this->buildFinalRoutes($routesData, $matchedRoutes, $skipRouts, $keyword);

        return $finalMatchedRoutes;
    }

    private function getLanguagePaths($type): array
    {
        $defaultLang = session()->has('local') ? session('local') : 'en';

        if ($type == "admin") {
            return [
                'langPath' => public_path("json/admin/lang/{$defaultLang}.json"),
                'engPath' => public_path("json/admin/lang/en.json"),
                'formattedRoutesPath' => public_path('json/admin/admin_formatted_routes.json')
            ];
        } else {
            return [
                'langPath' => public_path("json/provider/lang/{$defaultLang}.json"),
                'engPath' => public_path("json/provider/lang/en.json"),
                'formattedRoutesPath' => public_path('json/provider/provider_formatted_routes.json')
            ];
        }
    }

    private function ensureLanguageFileExists($langPath, $engPath): void
    {
        if (!File::exists($langPath)) {
            if (!file_exists(dirname($langPath))) {
                File::makeDirectory(dirname($langPath), 0777, true, true);
            }

            if (file_exists($engPath)) {
                $content = file_get_contents($engPath);
                file_put_contents($langPath, $content);
            } else {
                file_put_contents($langPath, json_encode(new stdClass(), JSON_PRETTY_PRINT));
            }
        }
    }

    private function findMatchedRoutes($langData, $keyword): array
    {
        $matchedRoutes = [];

        foreach ($langData as $key => $route) {
            if (empty($route['keywords'])) {
                continue;
            }

            $title = $this->formatTitle($route['page_title_value']);

            if ($title == $keyword) {
                $matchedRoutes[] = $route['key'];
            } elseif (preg_match('/' . preg_quote($keyword, '/') . '/i', $title)) {
                $matchedRoutes[] = $route['key'];
            } else {
                foreach ($route['keywords'] as $value) {
                    $normalizedValue = strtolower(trim($value));
                    if (strpos($normalizedValue, $keyword) !== false) {
                        $matchedRoutes[] = $route['key'];
                        break;
                    }
                }
            }
        }

        return array_unique($matchedRoutes);
    }

    private function buildFinalRoutes($routesData, $matchedRoutes, $skipRouts, $keyword): array
    {
        $finalMatchedRoutes = [];

        foreach ($routesData as $route) {
            if (in_array($route['key'], $matchedRoutes) && !in_array($route['uri'], $skipRouts)) {
                $uri = $this->adjustSpecialUris($route['uri'] ?? '');

                $finalMatchedRoutes[] = [
                    "page_title" => translate($route['page_title'] ?? 'Unknown'),
                    "page_title_value" => translate($route['page_title'] ?? 'Unknown'),
                    "key" => $route['key'] ?? base64_encode("page_search_" . ($route['uri'] ?? '')),
                    "uri" => $uri,
                    "full_route" => url($uri),
                    "uri_count" => isset($route['uri']) ? count(explode('/', $route['uri'])) : 0,
                    "method" => $route['method'] ?? "GET",
                    "keywords" => $keyword,
                    "priority" => 2,
                    "type" => 'page',
                ];
            }
        }

        return $finalMatchedRoutes;
    }

    private function adjustSpecialUris($uri): string
    {
        if ($uri === 'provider/booking/list') {
            return 'provider/booking/list?booking_status=pending&service_type=all';
        }
        if ($uri === 'provider/booking/post') {
            return 'provider/booking/post?type=all&service_type=all';
        }
        if ($uri === "admin/configuration/get-notification-setting") {
            return "admin/configuration/get-notification-setting?type=customers";
        }
        return $uri;
    }

    function formatTitle($input): string
    {
        $withSpaces = str_replace('_', ' ', $input);
        return strtolower(ucwords($withSpaces));
    }

    public function sortByPriority($formattedRoutes, $validRoutes, $menuSearchResults, $searchKeyword): mixed
    {
        $allRoutes = collect(array_merge($formattedRoutes, $validRoutes, $menuSearchResults))
            ->map(function ($item) use ($searchKeyword) {
                $score = 0;
                if (isset($item['page_title_value']) && str_contains(strtolower($item['page_title_value']), strtolower($searchKeyword))) {
                    $score += 1;
                }
                $item['match_score'] = $score;
                $typeOrder = [
                    'menu' => 1,
                    'page' => 2,
                ];
                $item['type_order'] = $typeOrder[$item['type']] ?? 3;
                return $item;
            });

        $sorted = $allRoutes->sort(function ($a, $b) {
            if ($a['type_order'] !== $b['type_order']) {
                return $a['type_order'] <=> $b['type_order'];
            }
            if ($a['match_score'] !== $b['match_score']) {
                return $b['match_score'] <=> $a['match_score'];
            }

            return $a['priority'] <=> $b['priority'];
        })->values();

        return $this->groupByType($sorted);
    }

    public function groupByType($sorted)
    {
        return $sorted->groupBy('type')->map(function ($items) {
            return $items->unique('uri')->values();
        })->toArray();
    }

    public function getSortRecentSearchByType(object|array $searchData): array
    {
        $fallbackResults = collect();

        foreach ($searchData as $search) {
            $response = is_string($search['response'])
                ? json_decode($search['response'], true)
                : $search['response'];

            if (is_array($response) && isset($response['priority'])) {
                $fallbackResults->push($response);
            }
        }
        $fallbackResults = $fallbackResults->sortBy('priority')->values();

        return $fallbackResults->groupBy('type')->toArray();
    }

    public function removeUnderscore($input)
    {
        if (strpos($input, '_') !== false) {
            return str_replace('_', ' ', $input);
        }
        return $input;
    }
}
