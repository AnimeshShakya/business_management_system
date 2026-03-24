<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Nwidart\Modules\Module;

class GenerateAdminRoutesJson extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-admin-routes-json {type}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $type = $this->argument('type');
        if($type == "admin"){
            $additionalRoutes = ["admin/business-settings/get-gallery-setup"];
            $adminRoutes = $this->getAdminRoutes();
            $adminItems = array_merge($this->processRoutes($adminRoutes),$this->getAdditionalAdminDynamicUriRoutes());
            $this->generateAndSaveJsonFiles($adminItems,"admin");
        }else{
            $providerRoutes = $this->getProviderRoutes();
            $providerItems = array_merge($this->processRoutes($providerRoutes), $this->getProviderAdditionalDynamicUriRoutes());
            $this->generateAndSaveJsonFiles($providerItems,"provider");
        }
    }
    private function getAdminRoutes(): Collection
    {
        $routes = Route::getRoutes();
        return collect($routes->getRoutesByMethod()['GET'] ?? [])
            ->filter(function ($route) {
                return Str::startsWith($route->uri(), 'admin')
                    && !Str::startsWith($route->uri(), 'admin/component')
                    && !Str::startsWith($route->uri(), 'admin/ajax')
                    && !Str::contains($route->getActionName(), 'Ajax')
                    && !collect($route->middleware())->contains('api');
            }) ->map(function ($route) {
                $uri = preg_replace('/\{[^}]+\?\}/', '', $route->uri());
                $route->uri = trim($uri, '/');
                return $route;
            });
    }
    private function getProviderRoutes(): Collection
    {
        $routes = Route::getRoutes();

        $allRoutes = collect($routes->getRoutesByMethod())
            ->only(['GET', 'HEAD', 'ANY'])
            ->flatten();

        return $allRoutes->filter(function ($route) {
            return Str::startsWith($route->uri(), 'provider')
                && !Str::startsWith($route->uri(), 'provider/component')
                && !Str::startsWith($route->uri(), 'provider/ajax')
                && !Str::contains($route->getActionName(), 'Ajax')
                && !collect($route->middleware())->contains('api');
        });
    }



    private function processRoutes($routes)
    {
        return $routes->map(function ($route) {
            $viewPath = $this->getBladePathFromController($route);

            if (!$viewPath) {
                return null;
            }
            // skip dynamic route parameters
            if (preg_match('/{[^}]+}/', $route->uri())) {
                return '';
            }
            $fullPath  = $this->getFullViewPath($viewPath);
            $keywords = File::exists($fullPath) ? $this->extractKeywordsFromView($fullPath) : [];
            $pageTitle = File::exists($fullPath) ? $this->extractPageTitleFromView($fullPath) : $this->getRouteName($route->getName());
            return [
                'page_title' => $pageTitle,
                'page_title_value' => $pageTitle,
                'key' => base64_encode($route->uri()),
                'uri' => $route->uri(),
                'uri_count' => count(explode('/', $route->uri())),
                'method' => in_array('GET', $route->methods()) ? 'GET' : $route->methods()[0],
                'view' => $viewPath,
                'keywords' => $keywords,
                "priority" => 2,
                "type" => 'page'
            ];
        })
            ->filter()
            ->unique('uri')
            ->values()
            ->all();
    }
    private function extractKeywordsFromView(string $viewPath, array &$processedViews = []): array
    {
        if (in_array($viewPath, $processedViews)) {
            return [];
        }

        $processedViews[] = $viewPath;
        if (!File::exists($viewPath)) {
            return [];
        }

        $content = File::get($viewPath);
        $translationKeys = [];

        // Extract all translate() function calls
        preg_match_all('/translate\s*\(\s*[\'"]([^\'"]+)[\'"]\s*\)/i', $content, $matches);

        foreach ($matches[1] as $key) {
            // Store the original key (like "wallet_bonus_setup")
            $translationKeys[] = $key;
        }

        // Remove duplicates and return
        return array_unique($translationKeys);
    }


    private function extractTextContent(string $viewPath): string
    {
        if (!File::exists($viewPath)) {
            return '';
        }

        $content = File::get($viewPath);
        $extractedContent = [];


        $this->extractContentFromHtmlTags($content, $extractedContent);
        $this->extractTitlesAndArrayData($content, $extractedContent);
        $this->extractTranslations($content, $extractedContent);

        $combinedContent = implode(' ', $extractedContent);

        // Clean up the content
        return trim(preg_replace('/\s+/', ' ', $combinedContent));
    }

    private function extractPageTitleFromView(string $viewPath): string
    {
        if (!File::exists($viewPath)) {
            return '';
        }

        $title = '';
        $content = File::get($viewPath);

        // 1. Match @section('title', translate('...'))
        if (preg_match("/@section\\('title',\\s*translate\\(['\"]([^'\"]*)['\"]\\)\\)/", $content, $matches)) {
            $title = $matches[1];
        } // 2. Match fallback pattern
        elseif (preg_match("/@section\\('title',\\s*translate\\(['\"](.*?)['\"]\\)/", $content, $matches)) {
            $title = $matches[1];
        } // 3. Match <span class="page-header-title">...translate('...')...</span>
        elseif (preg_match_all("/<span[^>]*class=[\"'][^\"']*page-header-title[^\"']*[\"'][^>]*>(.*?)<\/span>/s", $content, $spanMatches)) {
            $translated = [];

            foreach ($spanMatches[1] as $spanContent) {
                if (preg_match_all("/translate\\(['\"]([^'\"]+)['\"]\\)/", $spanContent, $transMatches)) {
                    foreach ($transMatches[1] as $t) {
                        $translated[] = $t;
                    }
                }
            }

            if (!empty($translated)) {
                $title = implode(' ', array_unique($translated));
            }
        }

        $words = preg_split('/\s+/', $title);
        $words = array_unique($words);

        $cleaned = array_map(function ($word) {
            $word = preg_replace('/[^\p{L}\p{N}_\s]/u', '', $word);
            return trim($word);
        }, $words);

        $cleaned = array_filter($cleaned);
        return implode(', ', $cleaned);
    }
    private function getBladePathFromController($route): array|string|null
    {
        $action = $route->getAction();
        $controller = $action['controller'] ?? null;
        if ($controller) {
            return $this->extractViewPathFromControllerMethod($controller);
        } elseif ($route->getAction()['uses'] instanceof \Closure) {
            return $this->extractViewPathFromClosure($route->getAction()['uses']);
        }

        return null;
    }
    private function extractContentFromHtmlTags(string $content, array &$extractedContent): void
    {
        $content = preg_replace('/<code\b[^>]*>.*?<\/code>/is', '', $content);
        preg_match_all('/<(h[1-6]|p|span|div|li|a|button|label|strong|b|i|em)[^>]*>(.*?)<\/\1>/is', $content, $matches);

        foreach ($matches[2] as $tagContent) {
            // Extract translate function content
            preg_match_all('/translate\([\'"]([^\'"]*?)[\'"]\)/', $tagContent, $translateMatches);
            foreach ($translateMatches[1] as $translatedText) {
                $extractedContent[] = $translatedText;
            }

            // Extract blade expressions {{ }}
            preg_match_all('/\{\{\s*(.*?)\s*\}\}/', $tagContent, $bladeMatches);
            foreach ($bladeMatches[1] as $bladeExpression) {
                //  blade expression contains translate
                if (preg_match('/translate\([\'"]([^\'"]*?)[\'"]\)/', $bladeExpression, $translateMatch)) {
                    $extractedContent[] = $translateMatch[1];
                } //  for string concatenation in blade expressions
                elseif (strpos($bladeExpression, 'translate') !== false) {
                    preg_match_all('/translate\([\'"]([^\'"]*?)[\'"]\)/', $bladeExpression, $innerTranslateMatches);
                    foreach ($innerTranslateMatches[1] as $translatedText) {
                        $extractedContent[] = $translatedText;
                    }
                }
            }

            // Strip HTML and blade syntax to get raw text
            $plainText = strip_tags($tagContent);
            $plainText = preg_replace([
                '/\{\{.*?\}\}/',
                '/@[\w]+\s*(\([^\)]*\))?/',
            ], ' ', $plainText);

            if (!empty(trim($plainText))) {
                $extractedContent[] = $plainText;
            }
        }
    }


    private function extractTitlesAndArrayData(string $content, array &$extractedContent): void
    {
        preg_match_all('/[\'"]title[\'"]\s*=>\s*[\'"]([^\'"]*?)[\'"]/i', $content, $titleMatches);
        foreach ($titleMatches[1] as $title) {
            $extractedContent[] = $title;
        }
    }

    private function extractTranslations(string $content, array &$extractedContent): void
    {
        preg_match_all('/translate\([\'"]([^\'"]*?)[\'"]\)/', $content, $allTranslateMatches);
        foreach ($allTranslateMatches[1] as $translatedText) {
            $extractedContent[] = $translatedText;
        }
    }
    private function getRouteName($actualRouteName): string
    {
        $routeNameParts = explode('.', $actualRouteName);
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

            $routeName = ucwords(implode(' ', $uniqueWords));
        } else {
            $routeName = ucwords(str_replace(['.', '_', '-'], ' ', Str::afterLast($actualRouteName, '.')));
        }
        return $routeName;
    }


    private function getFullViewPath(string $viewPath): string
    {

        if (File::exists($viewPath)) {
            return $viewPath;
        }

        if (strpos($viewPath, '::') !== false) {
            [$moduleName, $viewName] = explode('::', $viewPath, 2);
            $properModuleName = str_replace(' ', '', ucwords(str_replace(['_', '-'], ' ', $moduleName)));
            $viewFilePath = str_replace('.', '/', $viewName);

            $modulePaths = [
                base_path('Modules/' . $properModuleName . '/Resources/views/' . $viewFilePath . '.blade.php'),
                base_path('Modules/' . ucfirst($moduleName) . '/Resources/views/' . $viewFilePath . '.blade.php'),
                base_path('Modules/' . $moduleName . '/Resources/views/' . $viewFilePath . '.blade.php'),
            ];

            foreach ($modulePaths as $path) {
                if (File::exists($path)) {
                    return $path;
                }
            }

            if (function_exists('module_path')) {
                try {
                    $moduleViewPath = module_path($properModuleName, 'Resources/views/' . $viewFilePath . '.blade.php');
                    if (File::exists($moduleViewPath)) {
                        return $moduleViewPath;
                    }
                } catch (\Exception $e) {
                    // Continue to next attempt
                }
            }
        }

        // Standard Laravel view path
        $viewFilePath = str_replace('.', '/', $viewPath);
        $fullPath = resource_path('views/' . $viewFilePath . '.blade.php');
        if (File::exists($fullPath)) {
            return $fullPath;
        }

        // PHP view file
        $phpPath = resource_path('views/' . $viewFilePath . '.php');
        if (File::exists($phpPath)) {
            return $phpPath;
        }

        // Index file in directory
        $dirPath = resource_path('views/' . $viewFilePath);
        if (File::exists($dirPath . '/index.blade.php')) {
            return $dirPath . '/index.blade.php';
        }

        // Module views without :: notation
        $modulesBasePath = base_path('Modules');
        if (File::exists($modulesBasePath)) {
            $modules = File::directories($modulesBasePath);

            foreach ($modules as $modulePath) {
                $moduleName = basename($modulePath);
                $moduleViewsPath = $modulePath . '/Resources/views';

                if (File::exists($moduleViewsPath)) {
                    $moduleViewPath = $moduleViewsPath . '/' . $viewFilePath . '.blade.php';
                    if (File::exists($moduleViewPath)) {
                        return $moduleViewPath;
                    }

                    $modulePhpPath = $moduleViewsPath . '/' . $viewFilePath . '.php';
                    if (File::exists($modulePhpPath)) {
                        return $modulePhpPath;
                    }

                    $moduleDirPath = $moduleViewsPath . '/' . $viewFilePath;
                    if (File::exists($moduleDirPath . '/index.blade.php')) {
                        return $moduleDirPath . '/index.blade.php';
                    }
                }

                // Alternative module views path
                $altModuleViewsPath = $modulePath . '/views';
                if (File::exists($altModuleViewsPath)) {
                    $altModuleViewPath = $altModuleViewsPath . '/' . $viewFilePath . '.blade.php';
                    if (File::exists($altModuleViewPath)) {
                        return $altModuleViewPath;
                    }
                }
            }
        }

        // Return the constructed path even if not found (for debugging)
        return $fullPath;
    }

    function removeSpecialCharacters(string|null $text): string|null
    {
        return str_ireplace(['\'', '"', ';', '<', '>', '?', '“', '”'], ' ', preg_replace('/\s\s+/', ' ', $text));
    }
    private function isDirectoryExists($dir): void
    {
        if (!File::exists($dir)) {
            File::makeDirectory($dir, 0755, true);
        }
    }

    private function extractViewPathFromControllerMethod($controllerWithMethod): array|string|null
    {
        list($controllerClass, $method) = explode('@', $controllerWithMethod);

        if (!class_exists($controllerClass) || !method_exists($controllerClass, $method)) {
            return null;
        }

        $reflectionMethod = new \ReflectionMethod($controllerClass, $method);
        $filename = $reflectionMethod->getFileName();
        $startLine = $reflectionMethod->getStartLine();
        $endLine = $reflectionMethod->getEndLine();
        if (!$this->controllerReturnsView($filename, $startLine, $endLine)) {
            return null;
        }

        return $this->extractViewPathFromCode($filename, $startLine, $endLine);
    }
    private function controllerReturnsView(string $filename, int $startLine, int $endLine): bool
    {
        $file = file($filename);
        $codeBody = implode('', array_slice($file, $startLine - 1, $endLine - $startLine + 1));


        if (preg_match("/return\s+(view|View)::|\bview\(/i", $codeBody)) {
            if (
                preg_match("/return\s+(response|redirect|new\s+Response|JsonResponse|\\\$this->.*response)/i", $codeBody)
            ) {
                return false;
            }
            return true;
        }

        return false;
    }

    private function extractViewPathFromClosure(Closure $closure): array|string|null
    {
        $reflectionFunction = new \ReflectionFunction($closure);
        $filename = $reflectionFunction->getFileName();
        $startLine = $reflectionFunction->getStartLine();
        $endLine = $reflectionFunction->getEndLine();

        return $this->extractViewPathFromCode($filename, $startLine, $endLine);
    }

    private function extractViewPathFromCode($filename, $startLine, $endLine): array|string|null
    {
        $file = file($filename);
        $codeBody = implode('', array_slice($file, $startLine - 1, $endLine - $startLine + 1));

        if (preg_match("/view\\(['\"](.*?)['\"]/i", $codeBody, $matches)) {
            $bladePath = $matches[1];
            if (strpos($bladePath, '::') !== false) {
                return $bladePath;
            }
            return str_replace('.', '/', $bladePath);
        }

        return null;
    }
    private function generateAndSaveJsonFiles($items, $type): void
    {
        $filteredItems = collect($items)->filter(function ($item) {
            return !empty($item['page_title']);
        });

        $itemsWithoutKeywords = $filteredItems->map(function ($item) {
            return collect($item)->except('keywords')->toArray();
        })->values()->all();

        $langItems = $filteredItems->map(function ($item) {
            $keywordMap = [];
            if (is_array($item['keywords'])) {
                foreach ($item['keywords'] as $keyword) {
                    $processedValue = ucwords(str_replace('_', ' ', $keyword));
                    $keywordMap[$keyword] = $processedValue;
                }
            } elseif (is_string($item['keywords']) && !empty($item['keywords'])) {
                $keywords = array_map('trim', explode(',', $item['keywords']));
                foreach ($keywords as $keyword) {
                    $processedValue = ucwords(str_replace('_', ' ', $keyword));
                    $keywordMap[$keyword] = $processedValue;
                }
            }

            return [
                'key' => $item['key'],
                'page_title' => $item['page_title'],
                'page_title_value' => $item['page_title'],
                'keywords' => $keywordMap,
            ];
        })->values()->all();

        if ($type == "admin") {
            $json = json_encode($itemsWithoutKeywords, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
            $langJson = json_encode($langItems, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

            $path = public_path('json/admin/admin_formatted_routes.json');
            $langPath = public_path('json/admin/lang/en.json');

            $this->isDirectoryExists(dirname($path));
            $this->isDirectoryExists(dirname($langPath));

            file_put_contents($path, $json);
            file_put_contents($langPath, $langJson);
        } else {
            $json = json_encode($itemsWithoutKeywords, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
            $langJson = json_encode($langItems, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

            $path = public_path('json/provider/provider_formatted_routes.json');
            $langPath = public_path('json/provider/lang/en.json');

            $this->isDirectoryExists(dirname($path));
            $this->isDirectoryExists(dirname($langPath));

            file_put_contents($path, $json);
            file_put_contents($langPath, $langJson);
        }

        $this->info("Wrote " . count($itemsWithoutKeywords) . " URIs to {$path}");
        $this->info("Wrote " . count($langItems) . " URIs to {$langPath}");
    }

    public function getAdditionalAdminDynamicUriRoutes():array{
        $result =  [
           [
               "page_title" => "all",
               "page_title_value" => "all",
               "key" => base64_encode('admin/booking/post?type=all'),
               "uri" => "admin/booking/post?type=all",
               "uri_count" => count(explode('/','admin/booking/post?type=all')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],  [
               "page_title" => "No_bid_request_yet",
               "page_title_value" => "No_bid_request_yet",
               "key" => base64_encode('admin/booking/post?type=new_booking_request'),
               "uri" => "admin/booking/post?type=new_booking_request",
               "uri_count" => count(explode('/','admin/booking/post?type=new_booking_request')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "Already_bid_requested",
               "page_title_value" => "Already_bid_requested",
               "key" => base64_encode('admin/booking/post?type=placed_offer'),
               "uri" => "admin/booking/post?type=placed_offer",
               "uri_count" => count(explode('/','admin/booking/post?type=placed_offer')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "Pending",
               "page_title_value" => "Pending",
               "key" => base64_encode('admin/booking/list/verification?booking_status=pending&type=pending'),
               "uri" => "admin/booking/list/verification?booking_status=pending&type=pending",
               "uri_count" => count(explode('/','admin/booking/list/verification?booking_status=pending&type=pending')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "Denied",
               "page_title_value" => "Denied",
               "key" => base64_encode('admin/booking/list/verification?booking_status=pending&type=denied'),
               "uri" => "admin/booking/list/verification?booking_status=pending&type=denied",
               "uri_count" => count(explode('/','admin/booking/list/verification?booking_status=pending&type=denied')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "All_booking",
               "page_title_value" => "All_booking",
               "key" => base64_encode('admin/booking/list?booking_status=pending&service_type=all'),
               "uri" => "admin/booking/list?booking_status=pending&service_type=all",
               "uri_count" => count(explode('/','admin/booking/list?booking_status=pending&service_type=all')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "Regular_booking",
               "page_title_value" => "Regular_booking",
               "key" => base64_encode('admin/booking/list?booking_status=pending&service_type=regular'),
               "uri" => "admin/booking/list?booking_status=pending&service_type=regular",
               "uri_count" => count(explode('/','admin/booking/list?booking_status=pending&service_type=regular')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "Repeat_booking",
               "page_title_value" => "Repeat_booking",
               "key" => base64_encode('admin/booking/list?booking_status=pending&service_type=repeat'),
               "uri" => "admin/booking/list?booking_status=pending&service_type=repeat",
               "uri_count" => count(explode('/','admin/booking/list?booking_status=pending&service_type=repeat')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "Repeat_booking",
               "page_title_value" => "Repeat_booking",
               "key" => base64_encode('admin/booking/list?booking_status=pending&service_type=repeat'),
               "uri" => "admin/booking/list?booking_status=pending&service_type=repeat",
               "uri_count" => count(explode('/','admin/booking/list?booking_status=pending&service_type=repeat')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "All_booking",
               "page_title_value" => "All_booking",
               "key" => base64_encode('admin/booking/list?booking_status=accepted&service_type=all'),
               "uri" => "admin/booking/list?booking_status=accepted&service_type=all",
               "uri_count" => count(explode('/','admin/booking/list?booking_status=accepted&service_type=all')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "Regular_booking",
               "page_title_value" => "Regular_booking",
               "key" => base64_encode('admin/booking/list?booking_status=accepted&service_type=regular'),
               "uri" => "admin/booking/list?booking_status=accepted&service_type=regular",
               "uri_count" => count(explode('/','admin/booking/list?booking_status=accepted&service_type=regular')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "Repeat_booking",
               "page_title_value" => "Regular_booking",
               "key" => base64_encode('admin/booking/list?booking_status=accepted&service_type=repeat'),
               "uri" => "admin/booking/list?booking_status=accepted&service_type=repeat",
               "uri_count" => count(explode('/','admin/booking/list?booking_status=accepted&service_type=repeat')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "All_booking",
               "page_title_value" => "All_booking",
               "key" => base64_encode('admin/booking/list?booking_status=ongoing&service_type=all'),
               "uri" => "admin/booking/list?booking_status=ongoing&service_type=all",
               "uri_count" => count(explode('/','admin/booking/list?booking_status=ongoing&service_type=all')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "Regular_booking",
               "page_title_value" => "Regular_booking",
               "key" => base64_encode('admin/booking/list?booking_status=ongoing&service_type=regular'),
               "uri" => "admin/booking/list?booking_status=ongoing&service_type=regular",
               "uri_count" => count(explode('/','admin/booking/list?booking_status=ongoing&service_type=regular')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "Repeat_booking",
               "page_title_value" => "Repeat_booking",
               "key" => base64_encode('admin/booking/list?booking_status=ongoing&service_type=repeat'),
               "uri" => "admin/booking/list?booking_status=ongoing&service_type=regular",
               "uri_count" => count(explode('/','admin/booking/list?booking_status=ongoing&service_type=regular')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "All_booking",
               "page_title_value" => "All_booking",
               "key" => base64_encode('admin/booking/list?booking_status=completed&service_type=all'),
               "uri" => "admin/booking/list?booking_status=completed&service_type=all",
               "uri_count" => count(explode('/','admin/booking/list?booking_status=completed&service_type=all')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "Regular_booking",
               "page_title_value" => "Regular_booking",
               "key" => base64_encode('admin/booking/list?booking_status=completed&service_type=regular'),
               "uri" => "admin/booking/list?booking_status=completed&service_type=regular",
               "uri_count" => count(explode('/','admin/booking/list?booking_status=completed&service_type=regular')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "Repeat_booking",
               "page_title_value" => "Repeat_booking",
               "key" => base64_encode('admin/booking/list?booking_status=completed&service_type=repeat'),
               "uri" => "admin/booking/list?booking_status=completed&service_type=repeat",
               "uri_count" => count(explode('/','admin/booking/list?booking_status=completed&service_type=repeat')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "All_booking",
               "page_title_value" => "All_booking",
               "key" => base64_encode('admin/booking/list?booking_status=canceled&service_type=all'),
               "uri" => "admin/booking/list?booking_status=canceled&service_type=all",
               "uri_count" => count(explode('/','admin/booking/list?booking_status=canceled&service_type=all')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "Regular_booking",
               "page_title_value" => "Regular_booking",
               "key" => base64_encode('admin/booking/list?booking_status=canceled&service_type=regular'),
               "uri" => "admin/booking/list?booking_status=canceled&service_type=regular",
               "uri_count" => count(explode('/','admin/booking/list?booking_status=canceled&service_type=regular')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "Repeat_booking",
               "page_title_value" => "Regular_booking",
               "key" => base64_encode('admin/booking/list?booking_status=canceled&service_type=repeat'),
               "uri" => "admin/booking/list?booking_status=canceled&service_type=repeat",
               "uri_count" => count(explode('/','admin/booking/list?booking_status=canceled&service_type=repeat')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "All",
               "page_title_value" => "All",
               "key" => base64_encode('admin/discount/list'),
               "uri" => "admin/discount/list",
               "uri_count" => count(explode('/','admin/discount/list')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "Service_wise",
               "page_title_value" => "Service_wise",
               "key" => base64_encode('admin/discount/list?type=service'),
               "uri" => "admin/discount/list?type=service",
               "uri_count" => count(explode('/','admin/discount/list?type=service')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "Service_wise",
               "page_title_value" => "Service_wise",
               "key" => base64_encode('admin/discount/list?type=service'),
               "uri" => "admin/discount/list?type=service",
               "uri_count" => count(explode('/','admin/discount/list?type=service')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "Category_wise",
               "page_title_value" => "Category_wise",
               "key" => base64_encode('admin/discount/list?type=category'),
               "uri" => "admin/discount/list?type=category",
               "uri_count" => count(explode('/','admin/discount/list?type=category')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "Mixed",
               "page_title_value" => "Mixed",
               "key" => base64_encode('admin/discount/list?type=mixed'),
               "uri" => "admin/discount/list?type=mixed",
               "uri_count" => count(explode('/','admin/discount/list?type=mixed')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "all",
               "page_title_value" => "all",
               "key" => base64_encode('admin/coupon/list'),
               "uri" => "admin/coupon/list",
               "uri_count" => count(explode('/','admin/coupon/list')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "Service_wise",
               "page_title_value" => "Service_wise",
               "key" => base64_encode('admin/coupon/list?discount_type=service'),
               "uri" => "admin/coupon/list?discount_type=service",
               "uri_count" => count(explode('/','admin/coupon/list?discount_type=service')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "Category_wise",
               "page_title_value" => "Category_wise",
               "key" => base64_encode('admin/coupon/list?discount_type=category'),
               "uri" => "admin/coupon/list?discount_type=category",
               "uri_count" => count(explode('/','admin/coupon/list?discount_type=category')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "Mixed",
               "page_title_value" => "Mixed",
               "key" => base64_encode('admin/coupon/list?discount_type=mixed'),
               "uri" => "admin/coupon/list?discount_type=mixed",
               "uri_count" => count(explode('/','admin/coupon/list?discount_type=mixed')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "all",
               "page_title_value" => "all",
               "key" => base64_encode('admin/bonus/list'),
               "uri" => "admin/bonus/list",
               "uri_count" => count(explode('/','admin/bonus/list')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "active",
               "page_title_value" => "active",
               "key" => base64_encode('admin/bonus/list?status=active'),
               "uri" => "admin/bonus/list?status=active",
               "uri_count" => count(explode('/','admin/bonus/list?status=active')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "inactive",
               "page_title_value" => "inactive",
               "key" => base64_encode('admin/bonus/list?status=inactive'),
               "uri" => "admin/bonus/list?status=inactive",
               "uri_count" => count(explode('/','admin/bonus/list?status=inactive')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "all",
               "page_title_value" => "all",
               "key" => base64_encode('admin/campaign/list'),
               "uri" => "admin/campaign/list",
               "uri_count" => count(explode('/','admin/campaign/list')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "Service_wise",
               "page_title_value" => "Service_wise",
               "key" => base64_encode('admin/campaign/list?discount_type=service'),
               "uri" => "admin/campaign/list?discount_type=service",
               "uri_count" => count(explode('/','admin/campaign/list?discount_type=service')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "Category_wise",
               "page_title_value" => "Category_wise",
               "key" => base64_encode('admin/campaign/list?discount_type=category'),
               "uri" => "admin/campaign/list?discount_type=category",
               "uri_count" => count(explode('/','admin/campaign/list?discount_type=category')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "Mixed",
               "page_title_value" => "Mixed",
               "key" => base64_encode('admin/campaign/list?discount_type=mixed'),
               "uri" => "admin/campaign/list?discount_type=mixed",
               "uri_count" => count(explode('/','admin/campaign/list?discount_type=mixed')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "approved",
               "page_title_value" => "approved",
               "key" => base64_encode('admin/advertisements/ads-list?status=approved'),
               "uri" => "admin/advertisements/ads-list?status=approved",
               "uri_count" => count(explode('/','admin/advertisements/ads-list?status=approved')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "running",
               "page_title_value" => "running",
               "key" => base64_encode('admin/advertisements/ads-list?status=running'),
               "uri" => "admin/advertisements/ads-list?status=running",
               "uri_count" => count(explode('/','admin/advertisements/ads-list?status=running')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "expired",
               "page_title_value" => "expired",
               "key" => base64_encode('admin/advertisements/ads-list?status=running'),
               "uri" => "admin/advertisements/ads-list?status=expired",
               "uri_count" => count(explode('/','admin/advertisements/ads-list?status=expired')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "paused",
               "page_title_value" => "paused",
               "key" => base64_encode('admin/advertisements/ads-list?status=paused'),
               "uri" => "admin/advertisements/ads-list?status=paused",
               "uri_count" => count(explode('/','admin/advertisements/ads-list?status=paused')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "customer",
               "page_title_value" => "customer",
               "key" => base64_encode('admin/configuration/get-notification-setting?type=customers'),
               "uri" => "admin/configuration/get-notification-setting?type=customers",
               "uri_count" => count(explode('/','admin/configuration/get-notification-setting?type=customers')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "providers",
               "page_title_value" => "providers",
               "key" => base64_encode('admin/configuration/get-notification-setting?type=providers'),
               "uri" => "admin/configuration/get-notification-setting?type=providers",
               "uri_count" => count(explode('/','admin/configuration/get-notification-setting?type=providers')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "serviceman",
               "page_title_value" => "serviceman",
               "key" => base64_encode('admin/configuration/get-notification-setting?type=serviceman'),
               "uri" => "admin/configuration/get-notification-setting?type=serviceman",
               "uri_count" => count(explode('/','admin/configuration/get-notification-setting?type=serviceman')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "customer",
               "page_title_value" => "customer",
               "key" => base64_encode('admin/business-settings/notification-channel?notification_type=user'),
               "uri" => "admin/business-settings/notification-channel?notification_type=user",
               "uri_count" => count(explode('/','admin/business-settings/notification-channel?notification_type=user')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "provider",
               "page_title_value" => "provider",
               "key" => base64_encode('admin/business-settings/notification-channel?notification_type=provider'),
               "uri" => "admin/business-settings/notification-channel?notification_type=provider",
               "uri_count" => count(explode('/','admin/business-settings/notification-channel?notification_type=provider')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "serviceman",
               "page_title_value" => "serviceman",
               "key" => base64_encode('admin/business-settings/notification-channel?notification_type=serviceman'),
               "uri" => "admin/business-settings/notification-channel?notification_type=serviceman",
               "uri_count" => count(explode('/','admin/business-settings/notification-channel?notification_type=serviceman')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "onboarding_requests",
               "page_title_value" => "onboarding_requests",
               "key" => base64_encode('admin/provider/onboarding-request?status=onboarding'),
               "uri" => "admin/provider/onboarding-request?status=onboarding",
               "uri_count" => count(explode('/','admin/provider/onboarding-request?status=onboarding')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "denied_requests",
               "page_title_value" => "denied_requests",
               "key" => base64_encode('admin/provider/onboarding-request?status=denied'),
               "uri" => "admin/provider/onboarding-request?status=denied",
               "uri_count" => count(explode('/','admin/provider/onboarding-request?status=denied')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "all",
               "page_title_value" => "all",
               "key" => base64_encode('admin/provider/list?status=all'),
               "uri" => "admin/provider/list?status=all",
               "uri_count" => count(explode('/','admin/provider/list?status=all')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "active",
               "page_title_value" => "active",
               "key" => base64_encode('admin/provider/list?status=active'),
               "uri" => "admin/provider/list?status=active",
               "uri_count" => count(explode('/','admin/provider/list?status=active')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "inactive",
               "page_title_value" => "inactive",
               "key" => base64_encode('admin/provider/list?status=inactive'),
               "uri" => "admin/provider/list?status=inactive",
               "uri_count" => count(explode('/','admin/provider/list?status=inactive')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "all",
               "page_title_value" => "all",
               "key" => base64_encode('admin/withdraw/request/list?status=all'),
               "uri" => "admin/withdraw/request/list?status=all",
               "uri_count" => count(explode('/','admin/withdraw/request/list?status=all')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "pending",
               "page_title_value" => "pending",
               "key" => base64_encode('admin/withdraw/request/list?status=pending'),
               "uri" => "admin/withdraw/request/list?status=pending",
               "uri_count" => count(explode('/','admin/withdraw/request/list?status=pending')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "approved",
               "page_title_value" => "approved",
               "key" => base64_encode('admin/withdraw/request/list?status=approved'),
               "uri" => "admin/withdraw/request/list?status=approved",
               "uri_count" => count(explode('/','admin/withdraw/request/list?status=approved')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "denied",
               "page_title_value" => "denied",
               "key" => base64_encode('admin/withdraw/request/list?status=denied'),
               "uri" => "admin/withdraw/request/list?status=denied",
               "uri_count" => count(explode('/','admin/withdraw/request/list?status=denied')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "settled",
               "page_title_value" => "settled",
               "key" => base64_encode('admin/withdraw/request/list?status=settled'),
               "uri" => "admin/withdraw/request/list?status=settled",
               "uri_count" => count(explode('/','admin/withdraw/request/list?status=settled')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "all",
               "page_title_value" => "all",
               "key" => base64_encode('admin/service/list'),
               "uri" => "admin/service/list",
               "uri_count" => count(explode('/','admin/service/list')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "inactive",
               "page_title_value" => "inactive",
               "key" => base64_encode('admin/service/list?status=inactive'),
               "uri" => "admin/service/list?status=inactive",
               "uri_count" => count(explode('/','admin/service/list?status=inactive')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "all",
               "page_title_value" => "all",
               "key" => base64_encode('admin/customer/wallet/report'),
               "uri" => "admin/customer/wallet/report",
               "uri_count" => count(explode('/','admin/customer/wallet/report')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "debit",
               "page_title_value" => "debit",
               "key" => base64_encode('admin/customer/wallet/report?transaction_type=debit'),
               "uri" => "admin/customer/wallet/report?transaction_type=debit",
               "uri_count" => count(explode('/','admin/customer/wallet/report?transaction_type=debit')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "credit",
               "page_title_value" => "credit",
               "key" => base64_encode('admin/customer/wallet/report?transaction_type=credit'),
               "uri" => "admin/customer/wallet/report?transaction_type=credit",
               "uri_count" => count(explode('/','admin/customer/wallet/report?transaction_type=credit')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "all",
               "page_title_value" => "all",
               "key" => base64_encode('admin/customer/loyalty-point/report'),
               "uri" => "admin/customer/loyalty-point/report",
               "uri_count" => count(explode('/','admin/customer/loyalty-point/report')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "debit",
               "page_title_value" => "debit",
               "key" => base64_encode('admin/customer/loyalty-point/report?transaction_type=debit'),
               "uri" => "admin/customer/loyalty-point/report?transaction_type=debit",
               "uri_count" => count(explode('/','admin/customer/loyalty-point/report?transaction_type=debit')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "credit",
               "page_title_value" => "credit",
               "key" => base64_encode('admin/customer/loyalty-point/report?transaction_type=credit'),
               "uri" => "admin/customer/loyalty-point/report?transaction_type=credit",
               "uri_count" => count(explode('/','admin/customer/loyalty-point/report?transaction_type=credit')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "all",
               "page_title_value" => "all",
               "key" => base64_encode('admin/role/list'),
               "uri" => "admin/role/list",
               "uri_count" => count(explode('/','admin/role/list')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "active",
               "page_title_value" => "active",
               "key" => base64_encode('admin/role/list?status=active'),
               "uri" => "admin/role/list?status=active",
               "uri_count" => count(explode('/','admin/role/list?status=active')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "inactive",
               "page_title_value" => "inactive",
               "key" => base64_encode('admin/role/list?status=inactive'),
               "uri" => "admin/role/list?status=inactive",
               "uri_count" => count(explode('/','admin/role/list?status=inactive')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "all",
               "page_title_value" => "all",
               "key" => base64_encode('admin/employee/list'),
               "uri" => "admin/employee/list",
               "uri_count" => count(explode('/','admin/employee/list')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "active",
               "page_title_value" => "active",
               "key" => base64_encode('admin/employee/list?status=active'),
               "uri" => "admin/employee/list?status=active",
               "uri_count" => count(explode('/','admin/employee/list?status=active')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "inactive",
               "page_title_value" => "inactive",
               "key" => base64_encode('admin/employee/list?status=inactive'),
               "uri" => "admin/employee/list?status=inactive",
               "uri_count" => count(explode('/','admin/employee/list?status=inactive')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "all",
               "page_title_value" => "all",
               "key" => base64_encode('admin/transaction/list?trx_type=all'),
               "uri" => "admin/transaction/list?trx_type=all",
               "uri_count" => count(explode('/','admin/transaction/list?trx_type=all')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "debit",
               "page_title_value" => "debit",
               "key" => base64_encode('admin/transaction/list?trx_type=debit'),
               "uri" => "admin/transaction/list?trx_type=debit",
               "uri_count" => count(explode('/','admin/transaction/list?trx_type=debit')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "credit",
               "page_title_value" => "credit",
               "key" => base64_encode('admin/transaction/list?trx_type=credit'),
               "uri" => "admin/transaction/list?trx_type=credit",
               "uri_count" => count(explode('/','admin/transaction/list?trx_type=credit')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "all",
               "page_title_value" => "all",
               "key" => base64_encode('admin/report/transaction?transaction_type=all'),
               "uri" => "admin/report/transaction?transaction_type=all",
               "uri_count" => count(explode('/','admin/report/transaction?transaction_type=all')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "debit",
               "page_title_value" => "debit",
               "key" => base64_encode('admin/report/transaction?transaction_type=debit'),
               "uri" => "admin/report/transaction?transaction_type=debit",
               "uri_count" => count(explode('/','admin/report/transaction?transaction_type=debit')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "credit",
               "page_title_value" => "credit",
               "key" => base64_encode('admin/report/transaction?transaction_type=credit'),
               "uri" => "admin/report/transaction?transaction_type=credit",
               "uri_count" => count(explode('/','admin/report/transaction?transaction_type=credit')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "overview",
               "page_title_value" => "overview",
               "key" => base64_encode('admin/report/business/overview'),
               "uri" => "admin/report/business/overview",
               "uri_count" => count(explode('/','admin/report/business/overview')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "Earning_report",
               "page_title_value" => "Earning_report",
               "key" => base64_encode('admin/report/business/earning'),
               "uri" => "admin/report/business/earning",
               "uri_count" => count(explode('/','admin/report/business/earning')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "Expense_report",
               "page_title_value" => "Expense_report",
               "key" => base64_encode('admin/report/business/expense'),
               "uri" => "admin/report/business/expense",
               "uri_count" => count(explode('/','admin/report/business/expense')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "Business_info",
               "page_title_value" => "Business_info",
               "key" => base64_encode('admin/business-settings/get-business-information'),
               "uri" => "admin/business-settings/get-business-information",
               "uri_count" => count(explode('/','admin/business-settings/get-business-information')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "Payment",
               "page_title_value" => "Payment",
               "key" => base64_encode('admin/business-settings/get-business-information?web_page=payment'),
               "uri" => "admin/business-settings/get-business-information?web_page=payment",
               "uri_count" => count(explode('/','admin/business-settings/get-business-information?web_page=payment')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "bookings",
               "page_title_value" => "bookings",
               "key" => base64_encode('admin/business-settings/get-business-information?web_page=bookings'),
               "uri" => "admin/business-settings/get-business-information?web_page=bookings",
               "uri_count" => count(explode('/','admin/business-settings/get-business-information?web_page=bookings')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "providers",
               "page_title_value" => "providers",
               "key" => base64_encode('admin/business-settings/get-business-information?web_page=providers'),
               "uri" => "admin/business-settings/get-business-information?web_page=providers",
               "uri_count" => count(explode('/','admin/business-settings/get-business-information?web_page=providers')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "providers",
               "page_title_value" => "providers",
               "key" => base64_encode('admin/business-settings/get-business-information?web_page=providers'),
               "uri" => "admin/business-settings/get-business-information?web_page=providers",
               "uri_count" => count(explode('/','admin/business-settings/get-business-information?web_page=providers')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "customers",
               "page_title_value" => "customers",
               "key" => base64_encode('admin/business-settings/get-business-information?web_page=customers'),
               "uri" => "admin/business-settings/get-business-information?web_page=customers",
               "uri_count" => count(explode('/','admin/business-settings/get-business-information?web_page=customers')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "servicemen",
               "page_title_value" => "servicemen",
               "key" => base64_encode('admin/business-settings/get-business-information?web_page=servicemen'),
               "uri" => "admin/business-settings/get-business-information?web_page=servicemen",
               "uri_count" => count(explode('/','admin/business-settings/get-business-information?web_page=servicemen')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "promotions",
               "page_title_value" => "promotions",
               "key" => base64_encode('admin/business-settings/get-business-information?web_page=promotional_setup'),
               "uri" => "admin/business-settings/get-business-information?web_page=promotional_setup",
               "uri_count" => count(explode('/','admin/business-settings/get-business-information?web_page=promotional_setup')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "Business_plan",
               "page_title_value" => "Business_plan",
               "key" => base64_encode('admin/business-settings/get-business-information?web_page=business_plan'),
               "uri" => "admin/business-settings/get-business-information?web_page=business_plan",
               "uri_count" => count(explode('/','admin/business-settings/get-business-information?web_page=business_plan')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "text_setup",
               "page_title_value" => "text_setup",
               "key" => base64_encode('admin/business-settings/get-landing-information?web_page=text_setup'),
               "uri" => "admin/business-settings/get-landing-information?web_page=text_setup",
               "uri_count" => count(explode('/','admin/business-settings/get-landing-information?web_page=text_setup')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "button_&_links",
               "page_title_value" => "button_&_links",
               "key" => base64_encode('admin/business-settings/get-landing-information?web_page=button_and_links'),
               "uri" => "admin/business-settings/get-landing-information?web_page=button_and_links",
               "uri_count" => count(explode('/','admin/business-settings/get-landing-information?web_page=button_and_links')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "speciality",
               "page_title_value" => "speciality",
               "key" => base64_encode('admin/business-settings/get-landing-information?web_page=speciality'),
               "uri" => "admin/business-settings/get-landing-information?web_page=speciality",
               "uri_count" => count(explode('/','admin/business-settings/get-landing-information?web_page=speciality')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "testimonial",
               "page_title_value" => "testimonial",
               "key" => base64_encode('admin/business-settings/get-landing-information?web_page=testimonial'),
               "uri" => "admin/business-settings/get-landing-information?web_page=testimonial",
               "uri_count" => count(explode('/','admin/business-settings/get-landing-information?web_page=testimonial')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "features",
               "page_title_value" => "features",
               "key" => base64_encode('admin/business-settings/get-landing-information?web_page=features'),
               "uri" => "admin/business-settings/get-landing-information?web_page=features",
               "uri_count" => count(explode('/','admin/business-settings/get-landing-information?web_page=features')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "images",
               "page_title_value" => "images",
               "key" => base64_encode('admin/business-settings/get-landing-information?web_page=images'),
               "uri" => "admin/business-settings/get-landing-information?web_page=images",
               "uri_count" => count(explode('/','admin/business-settings/get-landing-information?web_page=images')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "background",
               "page_title_value" => "background",
               "key" => base64_encode('admin/business-settings/get-landing-information?web_page=background'),
               "uri" => "admin/business-settings/get-landing-information?web_page=background",
               "uri_count" => count(explode('/','admin/business-settings/get-landing-information?web_page=background')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "social_media",
               "page_title_value" => "social_media",
               "key" => base64_encode('admin/business-settings/get-landing-information?web_page=social_media'),
               "uri" => "admin/business-settings/get-landing-information?web_page=social_media",
               "uri_count" => count(explode('/','admin/business-settings/get-landing-information?web_page=social_media')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "meta",
               "page_title_value" => "meta",
               "key" => base64_encode('admin/business-settings/get-landing-information?web_page=meta'),
               "uri" => "admin/business-settings/get-landing-information?web_page=meta",
               "uri_count" => count(explode('/','admin/business-settings/get-landing-information?web_page=meta')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "web_app",
               "page_title_value" => "web_app",
               "key" => base64_encode('admin/business-settings/get-landing-information?web_page=web_app'),
               "uri" => "admin/business-settings/get-landing-information?web_page=web_app",
               "uri_count" => count(explode('/','admin/business-settings/get-landing-information?web_page=web_app')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "web_app_image",
               "page_title_value" => "web_app_image",
               "key" => base64_encode('admin/business-settings/get-landing-information?web_page=web_app_image'),
               "uri" => "admin/business-settings/get-landing-information?web_page=web_app_image",
               "uri_count" => count(explode('/','admin/business-settings/get-landing-information?web_page=web_app_image')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "general_login_setup",
               "page_title_value" => "general_login_setup",
               "key" => base64_encode('admin/business-settings/login/setup'),
               "uri" => "admin/business-settings/login/setup",
               "uri_count" => count(explode('/','admin/business-settings/login/setup')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "rules_&_restrictions",
               "page_title_value" => "rules_&_restrictions",
               "key" => base64_encode('admin/business-settings/login/setup?web_page=admin_provider_login'),
               "uri" => "admin/business-settings/login/setup?web_page=admin_provider_login",
               "uri_count" => count(explode('/','admin/business-settings/login/setup?web_page=admin_provider_login')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "Configuration",
               "page_title_value" => "Configuration",
               "key" => base64_encode('admin/configuration/third-party/firebase-configuration'),
               "uri" => "admin/configuration/third-party/firebase-configuration",
               "uri_count" => count(explode('/','admin/configuration/third-party/firebase-configuration')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "authentication",
               "page_title_value" => "authentication",
               "key" => base64_encode('admin/configuration/third-party/firebase-authentication'),
               "uri" => "admin/configuration/third-party/firebase-authentication",
               "uri_count" => count(explode('/','admin/configuration/third-party/firebase-authentication')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "digital_payment",
               "page_title_value" => "digital_payment",
               "key" => base64_encode('admin/configuration/third-party/payment_config?type=digital_payment'),
               "uri" => "admin/configuration/third-party/payment_config?type=digital_payment",
               "uri_count" => count(explode('/','admin/configuration/third-party/payment_config?type=digital_payment')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "offline_payment",
               "page_title_value" => "offline_payment",
               "key" => base64_encode('admin/configuration/third-party/payment_config?type=offline_payment'),
               "uri" => "admin/configuration/third-party/payment_config?type=offline_payment",
               "uri_count" => count(explode('/','admin/configuration/third-party/payment_config?type=offline_payment')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "map_api",
               "page_title_value" => "map_api",
               "key" => base64_encode('admin/configuration/third-party/map-api'),
               "uri" => "admin/configuration/third-party/map-api",
               "uri_count" => count(explode('/','admin/configuration/third-party/map-api')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "recaptcha",
               "page_title_value" => "recaptcha",
               "key" => base64_encode('admin/configuration/third-party/recaptcha'),
               "uri" => "admin/configuration/third-party/recaptcha",
               "uri_count" => count(explode('/','admin/configuration/third-party/recaptcha')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "apple_login",
               "page_title_value" => "apple_login",
               "key" => base64_encode('admin/configuration/third-party/apple-login'),
               "uri" => "admin/configuration/third-party/apple-login",
               "uri_count" => count(explode('/','admin/configuration/third-party/apple-login')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "email_config",
               "page_title_value" => "email_config",
               "key" => base64_encode('admin/configuration/third-party/email-config'),
               "uri" => "admin/configuration/third-party/email-config",
               "uri_count" => count(explode('/','admin/configuration/third-party/email-config')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "sms_config",
               "page_title_value" => "sms_config",
               "key" => base64_encode('admin/configuration/third-party/sms_config'),
               "uri" => "admin/configuration/third-party/sms_config",
               "uri_count" => count(explode('/','admin/configuration/third-party/sms_config')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "storage_connection",
               "page_title_value" => "storage_connection",
               "key" => base64_encode('admin/configuration/third-party/storage_connection'),
               "uri" => "admin/configuration/third-party/storage_connection",
               "uri_count" => count(explode('/','admin/configuration/third-party/storage_connection')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "app_settings",
               "page_title_value" => "app_settings",
               "key" => base64_encode('admin/configuration/third-party/app_settings'),
               "uri" => "admin/configuration/third-party/app_settings",
               "uri_count" => count(explode('/','admin/configuration/third-party/app_settings')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],[
               "page_title" => "Advertisement_Requests",
               "page_title_value" => "Advertisement_Requests",
               "key" => base64_encode('admin/advertisements/new-ads-request?status=new'),
               "uri" => "admin/advertisements/new-ads-request?status=new",
               "uri_count" => count(explode('/','admin/advertisements/new-ads-request?status=new')),
               "method" => "GET",
               "priority" => 2,
               "keywords" => "",
               "type" => "page"
           ],
        ];

        foreach ($result as&$entry) {
            $entry['keywords'] = str_replace('_', ' ', $entry['page_title']);
        }
        return $result;
    }

    public function getProviderAdditionalDynamicUriRoutes(): array {
        $result = [
            [
                "page_title" => "All_booking",
                "page_title_value" => "All_booking",
                "key" => base64_encode('provider/booking/list?booking_status=pending&service_type=all'),
                "uri" => "provider/booking/list?booking_status=pending&service_type=all",
                "uri_count" => count(explode('/', 'provider/booking/list?booking_status=pending&service_type=all')),
                "method" => "GET",
                "priority" => 2,
                "keywords" => "",
                "type" => "page"
            ],
            [
                "page_title" => "Regular_booking",
                "page_title_value" => "Regular_booking",
                "key" => base64_encode('provider/booking/list?booking_status=pending&service_type=regular'),
                "uri" => "provider/booking/list?booking_status=pending&service_type=regular",
                "uri_count" => count(explode('/', 'provider/booking/list?booking_status=pending&service_type=regular')),
                "method" => "GET",
                "priority" => 2,
                "keywords" => "",
                "type" => "page"
            ],
            [
                "page_title" => "Repeat_booking",
                "page_title_value" => "Repeat_booking",
                "key" => base64_encode('provider/booking/list?booking_status=pending&service_type=repeat'),
                "uri" => "provider/booking/list?booking_status=pending&service_type=repeat",
                "uri_count" => count(explode('/', 'provider/booking/list?booking_status=pending&service_type=repeat')),
                "method" => "GET",
                "priority" => 2,
                "keywords" => "",
                "type" => "page"
            ],
            [
                "page_title" => "All_booking",
                "page_title_value" => "All_booking",
                "key" => base64_encode('provider/booking/list?booking_status=accepted&service_type=all'),
                "uri" => "provider/booking/list?booking_status=accepted&service_type=all",
                "uri_count" => count(explode('/', 'provider/booking/list?booking_status=accepted&service_type=all')),
                "method" => "GET",
                "priority" => 2,
                "keywords" => "",
                "type" => "page"
            ],
            [
                "page_title" => "Regular_booking",
                "page_title_value" => "Regular_booking",
                "key" => base64_encode('provider/booking/list?booking_status=accepted&service_type=regular'),
                "uri" => "provider/booking/list?booking_status=accepted&service_type=regular",
                "uri_count" => count(explode('/', 'provider/booking/list?booking_status=accepted&service_type=regular')),
                "method" => "GET",
                "priority" => 2,
                "keywords" => "",
                "type" => "page"
            ],
            [
                "page_title" => "Repeat_booking",
                "page_title_value" => "Repeat_booking",
                "key" => base64_encode('provider/booking/list?booking_status=accepted&service_type=repeat'),
                "uri" => "provider/booking/list?booking_status=accepted&service_type=repeat",
                "uri_count" => count(explode('/', 'provider/booking/list?booking_status=accepted&service_type=repeat')),
                "method" => "GET",
                "priority" => 2,
                "keywords" => "",
                "type" => "page"
            ],
            [
                "page_title" => "All_booking",
                "page_title_value" => "All_booking",
                "key" => base64_encode('provider/booking/list?booking_status=ongoing&service_type=all'),
                "uri" => "provider/booking/list?booking_status=ongoing&service_type=all",
                "uri_count" => count(explode('/', 'provider/booking/list?booking_status=ongoing&service_type=all')),
                "method" => "GET",
                "priority" => 2,
                "keywords" => "",
                "type" => "page"
            ],
            [
                "page_title" => "Regular_booking",
                "page_title_value" => "Regular_booking",
                "key" => base64_encode('provider/booking/list?booking_status=ongoing&service_type=regular'),
                "uri" => "provider/booking/list?booking_status=ongoing&service_type=regular",
                "uri_count" => count(explode('/', 'provider/booking/list?booking_status=ongoing&service_type=regular')),
                "method" => "GET",
                "priority" => 2,
                "keywords" => "",
                "type" => "page"
            ],
            [
                "page_title" => "Repeat_booking",
                "page_title_value" => "Repeat_booking",
                "key" => base64_encode('provider/booking/list?booking_status=ongoing&service_type=repeat'),
                "uri" => "provider/booking/list?booking_status=ongoing&service_type=repeat",
                "uri_count" => count(explode('/', 'provider/booking/list?booking_status=ongoing&service_type=repeat')),
                "method" => "GET",
                "priority" => 2,
                "keywords" => "",
                "type" => "page"
            ],
            [
                "page_title" => "All_booking",
                "page_title_value" => "All_booking",
                "key" => base64_encode('provider/booking/list?booking_status=completed&service_type=all'),
                "uri" => "provider/booking/list?booking_status=completed&service_type=all",
                "uri_count" => count(explode('/', 'provider/booking/list?booking_status=completed&service_type=all')),
                "method" => "GET",
                "priority" => 2,
                "keywords" => "",
                "type" => "page"
            ],
            [
                "page_title" => "Regular_booking",
                "page_title_value" => "Regular_booking",
                "key" => base64_encode('provider/booking/list?booking_status=completed&service_type=regular'),
                "uri" => "provider/booking/list?booking_status=completed&service_type=regular",
                "uri_count" => count(explode('/', 'provider/booking/list?booking_status=completed&service_type=regular')),
                "method" => "GET",
                "priority" => 2,
                "keywords" => "",
                "type" => "page"
            ],
            [
                "page_title" => "Repeat_booking",
                "page_title_value" => "Repeat_booking",
                "key" => base64_encode('provider/booking/list?booking_status=completed&service_type=repeat'),
                "uri" => "provider/booking/list?booking_status=completed&service_type=repeat",
                "uri_count" => count(explode('/', 'provider/booking/list?booking_status=completed&service_type=repeat')),
                "method" => "GET",
                "priority" => 2,
                "keywords" => "",
                "type" => "page"
            ],
            [
                "page_title" => "All_booking",
                "page_title_value" => "All_booking",
                "key" => base64_encode('provider/booking/list?booking_status=canceled&service_type=all'),
                "uri" => "provider/booking/list?booking_status=canceled&service_type=all",
                "uri_count" => count(explode('/', 'provider/booking/list?booking_status=canceled&service_type=all')),
                "method" => "GET",
                "priority" => 2,
                "keywords" => "",
                "type" => "page"
            ],
            [
                "page_title" => "Regular_booking",
                "page_title_value" => "Regular_booking",
                "key" => base64_encode('provider/booking/list?booking_status=canceled&service_type=regular'),
                "uri" => "provider/booking/list?booking_status=canceled&service_type=regular",
                "uri_count" => count(explode('/', 'provider/booking/list?booking_status=canceled&service_type=regular')),
                "method" => "GET",
                "priority" => 2,
                "keywords" => "",
                "type" => "page"
            ],
            [
                "page_title" => "Repeat_booking",
                "page_title_value" => "Repeat_booking",
                "key" => base64_encode('provider/booking/list?booking_status=canceled&service_type=repeat'),
                "uri" => "provider/booking/list?booking_status=canceled&service_type=repeat",
                "uri_count" => count(explode('/', 'provider/booking/list?booking_status=canceled&service_type=repeat')),
                "method" => "GET",
                "priority" => 2,
                "keywords" => "",
                "type" => "page"
            ],
            [
                "page_title" => "Subscribed_Sub_Categories",
                "page_title_value" => "Subscribed_Sub_Categories",
                "key" => base64_encode('provider/sub-category/subscribed?status=subscribed'),
                "uri" => "provider/sub-category/subscribed?status=subscribed",
                "uri_count" => count(explode('/', 'provider/sub-category/subscribed?status=subscribed')),
                "method" => "GET",
                "priority" => 2,
                "keywords" => "",
                "type" => "page"
            ],
            [
                "page_title" => "Unsubscribed_sub_categories",
                "page_title_value" => "Unsubscribed_sub_categories",
                "key" => base64_encode('provider/sub-category/subscribed?status=unsubscribed'),
                "uri" => "provider/sub-category/subscribed?status=unsubscribed",
                "uri_count" => count(explode('/', 'provider/sub-category/subscribed?status=unsubscribed')),
                "method" => "GET",
                "priority" => 2,
                "keywords" => "",
                "type" => "page"
            ],
            [
                "page_title" => "All",
                "page_title_value" => "All",
                "key" => base64_encode('provider/advertisements/ads-list?status=all'),
                "uri" => "provider/advertisements/ads-list?status=all",
                "uri_count" => count(explode('/', 'provider/advertisements/ads-list?status=all')),
                "method" => "GET",
                "priority" => 2,
                "keywords" => "",
                "type" => "page"
            ],
            [
                "page_title" => "Pending",
                "page_title_value" => "Pending",
                "key" => base64_encode('provider/advertisements/ads-list?status=pending'),
                "uri" => "provider/advertisements/ads-list?status=pending",
                "uri_count" => count(explode('/', 'provider/advertisements/ads-list?status=pending')),
                "method" => "GET",
                "priority" => 2,
                "keywords" => "",
                "type" => "page"
            ],
            [
                "page_title" => "approved",
                "page_title_value" => "approved",
                "key" => base64_encode('provider/advertisements/ads-list?status=approved'),
                "uri" => "provider/advertisements/ads-list?status=approved",
                "uri_count" => count(explode('/', 'provider/advertisements/ads-list?status=approved')),
                "method" => "GET",
                "priority" => 2,
                "keywords" => "",
                "type" => "page"
            ],
            [
                "page_title" => "running",
                "page_title_value" => "running",
                "key" => base64_encode('provider/advertisements/ads-list?status=running'),
                "uri" => "provider/advertisements/ads-list?status=running",
                "uri_count" => count(explode('/', 'provider/advertisements/ads-list?status=running')),
                "method" => "GET",
                "priority" => 2,
                "keywords" => "",
                "type" => "page"
            ],
            [
                "page_title" => "paused",
                "page_title_value" => "paused",
                "key" => base64_encode('provider/advertisements/ads-list?status=paused'),
                "uri" => "provider/advertisements/ads-list?status=paused",
                "uri_count" => count(explode('/', 'provider/advertisements/ads-list?status=paused')),
                "method" => "GET",
                "priority" => 2,
                "keywords" => "",
                "type" => "page"
            ],
            [
                "page_title" => "expired",
                "page_title_value" => "expired",
                "key" => base64_encode('provider/advertisements/ads-list?status=expired'),
                "uri" => "provider/advertisements/ads-list?status=expired",
                "uri_count" => count(explode('/', 'provider/advertisements/ads-list?status=expired')),
                "method" => "GET",
                "priority" => 2,
                "keywords" => "",
                "type" => "page"
            ],
            [
                "page_title" => "denied",
                "page_title_value" => "denied",
                "key" => base64_encode('provider/advertisements/ads-list?status=denied'),
                "uri" => "provider/advertisements/ads-list?status=denied",
                "uri_count" => count(explode('/', 'provider/advertisements/ads-list?status=denied')),
                "method" => "GET",
                "priority" => 2,
                "keywords" => "",
                "type" => "page"
            ],
            [
                "page_title" => "all",
                "page_title_value" => "all",
                "key" => base64_encode('provider/serviceman/list?status=all'),
                "uri" => "provider/serviceman/list?status=all",
                "uri_count" => count(explode('/', 'provider/serviceman/list?status=all')),
                "method" => "GET",
                "priority" => 2,
                "keywords" => "",
                "type" => "page"
            ],
            [
                "page_title" => "active",
                "page_title_value" => "active",
                "key" => base64_encode('provider/serviceman/list?status=active'),
                "uri" => "provider/serviceman/list?status=active",
                "uri_count" => count(explode('/', 'provider/serviceman/list?status=active')),
                "method" => "GET",
                "priority" => 2,
                "keywords" => "",
                "type" => "page"
            ],
            [
                "page_title" => "inactive",
                "page_title_value" => "inactive",
                "key" => base64_encode('provider/serviceman/list?status=inactive'),
                "uri" => "provider/serviceman/list?status=inactive",
                "uri_count" => count(explode('/', 'provider/serviceman/list?status=inactive')),
                "method" => "GET",
                "priority" => 2,
                "keywords" => "",
                "type" => "page"
            ],
            [
                "page_title" => "Overview",
                "page_title_value" => "Overview",
                "key" => base64_encode('provider/account-info?page_type=overview'),
                "uri" => "provider/account-info?page_type=overview",
                "uri_count" => count(explode('/', 'provider/account-info?page_type=overview')),
                "method" => "GET",
                "priority" => 2,
                "keywords" => "",
                "type" => "page"
            ],            [
                "page_title" => "Commission_info",
                "page_title_value" => "Commission_info",
                "key" => base64_encode('provider/account-info?page_type=commission-info'),
                "uri" => "provider/account-info?page_type=commission-info",
                "uri_count" => count(explode('/', 'provider/account-info?page_type=commission-info')),
                "method" => "GET",
                "priority" => 2,
                "keywords" => "",
                "type" => "page"
            ],            [
                "page_title" => "review",
                "page_title_value" => "review",
                "key" => base64_encode('provider/account-info?page_type=review'),
                "uri" => "provider/account-info?page_type=review",
                "uri_count" => count(explode('/', 'provider/account-info?page_type=review')),
                "method" => "GET",
                "priority" => 2,
                "keywords" => "",
                "type" => "page"
            ],          [
                "page_title" => "promotional_cost",
                "page_title_value" => "promotional_cost",
                "key" => base64_encode('provider/account-info?page_type=promotional_cost'),
                "uri" => "provider/account-info?page_type=promotional_cost",
                "uri_count" => count(explode('/', 'provider/account-info?page_type=promotional_cost')),
                "method" => "GET",
                "priority" => 2,
                "keywords" => "",
                "type" => "page"
            ],    [
                "page_title" => "withdraw_transaction",
                "page_title_value" => "withdraw_transaction",
                "key" => base64_encode('provider/account-info?page_type=withdraw_transaction'),
                "uri" => "provider/account-info?page_type=withdraw_transaction",
                "uri_count" => count(explode('/', 'provider/account-info?page_type=withdraw_transaction')),
                "method" => "GET",
                "priority" => 2,
                "keywords" => "",
                "type" => "page"
            ],
            [
                "page_title" => "overview",
                "page_title_value" => "overview",
                "key" => base64_encode('provider/report/business/overview'),
                "uri" => "provider/report/business/overview",
                "uri_count" => count(explode('/', 'provider/report/business/overview')),
                "method" => "GET",
                "priority" => 2,
                "keywords" => "",
                "type" => "page"
            ],        [
                "page_title" => "earning",
                "page_title_value" => "earning",
                "key" => base64_encode('provider/report/business/earning'),
                "uri" => "provider/report/business/earning",
                "uri_count" => count(explode('/', 'provider/report/business/earning')),
                "method" => "GET",
                "priority" => 2,
                "keywords" => "",
                "type" => "page"
            ],  [
                "page_title" => "expense",
                "page_title_value" => "expense",
                "key" => base64_encode('provider/report/business/expense'),
                "uri" => "provider/report/business/expense",
                "uri_count" => count(explode('/', 'provider/report/business/expense')),
                "method" => "GET",
                "priority" => 2,
                "keywords" => "",
                "type" => "page"
            ], [
                "page_title" => "Business_information",
                "page_title_value" => "Business_information",
                "key" => base64_encode('provider/business-settings/get-business-information'),
                "uri" => "provider/business-settings/get-business-information",
                "uri_count" => count(explode('/', 'provider/business-settings/get-business-information')),
                "method" => "GET",
                "priority" => 2,
                "keywords" => "",
                "type" => "page"
            ],[
                "page_title" => "service_availability",
                "page_title_value" => "service_availability",
                "key" => base64_encode('provider/business-settings/get-business-information?web_page=service_availability'),
                "uri" => "provider/business-settings/get-business-information?web_page=service_availability",
                "uri_count" => count(explode('/', 'provider/business-settings/get-business-information?web_page=service_availability')),
                "method" => "GET",
                "priority" => 2,
                "keywords" => "",
                "type" => "page"
            ],[
                "page_title" => "bookings",
                "page_title_value" => "bookings",
                "key" => base64_encode('provider/business-settings/get-business-information?web_page=bookings'),
                "uri" => "provider/business-settings/get-business-information?web_page=bookings",
                "uri_count" => count(explode('/', 'provider/business-settings/get-business-information?web_page=bookings')),
                "method" => "GET",
                "priority" => 2,
                "keywords" => "",
                "type" => "page"
            ],[
                "page_title" => "provider",
                "page_title_value" => "provider",
                "key" => base64_encode('provider/configuration/get-notification-setting?notification_type=provider'),
                "uri" => "provider/configuration/get-notification-setting?notification_type=provider",
                "uri_count" => count(explode('/', 'provider/configuration/get-notification-setting?notification_type=provider')),
                "method" => "GET",
                "priority" => 2,
                "keywords" => "",
                "type" => "page"
            ],[
                "page_title" => "serviceman",
                "page_title_value" => "serviceman",
                "key" => base64_encode('provider/configuration/get-notification-setting?notification_type=serviceman'),
                "uri" => "provider/configuration/get-notification-setting?notification_type=serviceman",
                "uri_count" => count(explode('/', 'provider/configuration/get-notification-setting?notification_type=serviceman')),
                "method" => "GET",
                "priority" => 2,
                "keywords" => "",
                "type" => "page"
            ],[
                "page_title" => "new_offer_requests",
                "page_title_value" => "new_offer_requests",
                "key" => base64_encode('provider/booking/post?type=new_booking_request'),
                "uri" => "provider/booking/post?type=new_booking_request",
                "uri_count" => count(explode('/', 'provider/booking/post?type=new_booking_request')),
                "method" => "GET",
                "priority" => 2,
                "keywords" => "",
                "type" => "page"
            ],[
                "page_title" => "my_bid_requests",
                "page_title_value" => "my_bid_requests",
                "key" => base64_encode('provider/booking/post?type=placed_offer'),
                "uri" => "provider/booking/post?type=placed_offer",
                "uri_count" => count(explode('/', 'provider/booking/post?type=placed_offer')),
                "method" => "GET",
                "priority" => 2,
                "keywords" => "",
                "type" => "page"
            ],
        ];


        foreach ($result as&$entry) {
            $entry['keywords'] = str_replace('_', ' ', $entry['page_title']);
        }
        return $result;
    }

}
