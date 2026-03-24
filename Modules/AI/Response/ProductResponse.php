<?php

namespace Modules\AI\Response;

use http\Exception\RuntimeException;
use Modules\AI\Services\ProductResourceService;
use Modules\TaxModule\app\Traits\VatTaxManagement;

class ProductResponse
{
    protected ProductResourceService $productResource;
    public function __construct()
    {
        $this->productResource = new ProductResourceService();
    }

    public function productGeneralSetupAutoFillFormat(string $result): array
    {
        $resource = $this->productResource->productGeneralSetupData();

        $data = json_decode($result, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \InvalidArgumentException('Invalid JSON: ' . json_last_error_msg());
        }

        if (empty($data['category_name']) || !is_string($data['category_name'])) {
            throw new \InvalidArgumentException('The "category_name" field is required and must be a non-empty string.');
        }

        $processedData = $this->productGeneralSetConvertNamesToIds($data, $resource);
        if (!$processedData['success']) {
            return $processedData;
        }
        $data = $processedData['data'];

        $fields = [
            'category_name',
            'sub_category_name',
            'minimum_bidding_price',
            'tax_percentage',
            'search_tags'
        ];

        foreach ($fields as $field) {
            if (!array_key_exists($field, $data)) {
                $data[$field] = null;
            }
        }

       return $data;

    }

//    public function productPriceAndOthersAutoFill($result) : array|\Illuminate\Http\JsonResponse
//    {
//        $response = [];
//        $taxData = $this->getTaxSystemType();
//        $productWiseTax = $taxData['productWiseTax'];
//        $taxVats = $taxData['taxVats'];
//        $data = json_decode($result, true);
//
//        if($productWiseTax){
//            $taxVats = $taxData['taxVats']->map(function ($v) {
//                return [
//                    'id' => $v['id'],
//                    'name' => $v['name'],
//                ];
//            })->values()->toArray();
//        }
//        $data['vatTax'] = $taxVats;
//        if (json_last_error() !== JSON_ERROR_NONE) {
//            throw new \InvalidArgumentException('Invalid JSON: ' . json_last_error_msg());
//        }
//        $fields = [
//            'unit_price',
//            'minimum_order_quantity',
//            'current_stock',
//            'discount_type',
//            'discount_amount',
//            'shipping_cost',
//        ];
//
//        $errors = [];
//
//        foreach ($fields as $field) {
//            if (!array_key_exists($field, $data) || $data[$field] === null || $data[$field] === '') {
//                $errors[$field] = "$field is required.";
//            }
//        }
//
//        if (!empty($errors)) {
//            return response()->json(
//                $this->formatAIGenerationValidationErrors($errors),
//                422
//            );
//        }
//    return $data;
//    }

    public function productSeoAutoFill($result): array
    {
        $response = [];
        $data = json_decode($result, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \InvalidArgumentException('Invalid JSON: ' . json_last_error_msg());
        }

        $fields = [
            'meta_title',
            'meta_description',
            'meta_index',
            'meta_no_follow',
            'meta_no_image_index',
            'meta_no_archive',
            'meta_no_snippet',
            'meta_max_snippet',
            'meta_max_snippet_value',
            'meta_max_video_preview',
            'meta_max_video_preview_value',
            'meta_max_image_preview',
            'meta_max_image_preview_value',
        ];



        $errors = [];

        foreach ($fields as $field) {
            if (!array_key_exists($field, $data) || $data[$field] === null || $data[$field] === '') {
                $errors[$field] = "$field is required.";
            }
        }

        if (!empty($errors)) {
            throw new RuntimeException($this->formatAIGenerationValidationErrors($errors));
        }

        return $data;

    }
    private function formatAIGenerationValidationErrors(array $errors): string
    {
        $messages = [];

        foreach ($errors as $field => $message) {
            $messages[] = $message;
        }

        return 'AI failed to generate: ' . implode(' ', $messages);
    }
    public function variationSetupAutoFill(string $result)
    {
        $decoded = json_decode($result, true);
        if (json_last_error() !== JSON_ERROR_NONE || !is_array($decoded)) {
           // \Log::error('Invalid JSON in variationSetupAutoFill: ' . $result . ' | Error: ' . json_last_error_msg());
            return ['data' => null];
        }

        return ['data' => $decoded]; // Adjust based on your needs
    }

    public function generateTitleSuggestions(string $result)
    {
        return json_decode($result, true);

    }

    public  function productGeneralSetConvertNamesToIds(array $data, array $resources): array
    {
        if (isset($data['category_name'])) {
            $categoryName = strtolower(trim($data['category_name']));
            if (isset($resources['categories'][$categoryName])) {
                $data['category_id'] = $resources['categories'][$categoryName];
            } else {
                $errors[] = "Invalid category name: {$data['category_name']}";
            }
        }

        if (isset($data['sub_category_name'])) {
            $subCategoryName = strtolower(trim($data['sub_category_name']));
            if (isset($resources['sub_categories'][$subCategoryName])) {
                $data['sub_category_id'] = $resources['sub_categories'][$subCategoryName];
            }
        }

        if (!empty($errors)) {
            throw new \RuntimeException($this->formatAIGenerationValidationErrors($errors));
        }

        return [
            'success' => true,
            'data' => $data
        ];
    }
}
