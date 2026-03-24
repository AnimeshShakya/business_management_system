<?php

namespace Modules\AI\app\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use AWS\CRT\Log;
use http\Exception\RuntimeException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use JetBrains\PhpStorm\NoReturn;
use Modules\AI\app\Exceptions\ValidationException;
use Modules\AI\app\Http\Requests\GeneralSetupRequest;
use Modules\AI\app\Http\Requests\GenerateProductTitleSuggestionRequest;
use Modules\AI\app\Http\Requests\GenerateTitleFromImageRequest;
use Modules\AI\app\Http\Requests\ProductDescriptionAutoFillRequest;
use Modules\AI\app\Http\Requests\ProductPricingRequest;
use Modules\AI\app\Http\Requests\ProductSeoSectionAutoFillRequest;
use Modules\AI\app\Http\Requests\ProductShortDescriptionAutoFillRequest;
use Modules\AI\app\Http\Requests\ProductTitleAutoFillRequest;
use Modules\AI\app\Http\Requests\ProductVariationSetupAutoFillRequest;
use Modules\AI\PromptTemplates\ProductVariationSetup;
use Modules\AI\Response\ProductResponse;
use Modules\AI\Services\AIContentGeneratorService;


class AIProductController extends Controller
{

    protected AIContentGeneratorService $aiContentGeneratorService;
    protected ProductResponse $productResponse;
    public function __construct(AIContentGeneratorService $AIContentGeneratorService, ProductResponse $productResponse){
        $this->aiContentGeneratorService = $AIContentGeneratorService;
        $this->productResponse = $productResponse;
    }
    public function titleAutoFill(ProductTitleAutoFillRequest $request): \Illuminate\Http\JsonResponse
    {
      try{
          $result = $this->aiContentGeneratorService->generateContent(contentType: "product_name", context:  $request['name'], langCode:  $request['langCode']);
          return $this->successResponse(data: $result, status: 200);
      }catch (\Exception $e){
        $status = $e->getCode() > 0 ? $e->getCode() : 500;
        return $this->errorResponse(message: $e->getMessage(), status: $status);
      }
    }

    public function shortDescriptionAutoFill(ProductShortDescriptionAutoFillRequest $request): \Illuminate\Http\JsonResponse
    {
        try{
            $result = $this->aiContentGeneratorService->generateContent(contentType: "product_short_description", context:  $request['name'], langCode:  $request['langCode']);
            return $this->successResponse(data: $result, status: 200);
        }catch (\Exception $e){
            $status = $e->getCode() > 0 ? $e->getCode() : 500;
            return $this->errorResponse(message: $e->getMessage(), status: $status);
        }
    }

    public function descriptionAutoFill(ProductDescriptionAutoFillRequest $request): \Illuminate\Http\JsonResponse
    {
       try{
           $result = $this->aiContentGeneratorService->generateContent(contentType: "product_description", context:  $request['name'], langCode:  $request['langCode']);
           return $this->successResponse(data: $result, status: 200);
       }catch (\Exception $e){
          $status = $e->getCode() > 0 ? $e->getCode() : 500;
          return $this->errorResponse(message: $e->getMessage(), status: $status);
       }
    }

    public function generalSetupAutoFill(GeneralSetupRequest $request): \Illuminate\Http\JsonResponse
    {
        try{
            $result = $this->aiContentGeneratorService->generateContent(contentType: "general_setup", context:  $request['name'], description:  $request['description']);
            $data = $this->productResponse->productGeneralSetupAutoFillFormat(result:$result);
            return $this->successResponse(data: $data, status: 200);
        }catch (\Exception $e){
            $status = $e->getCode() > 0 ? $e->getCode() : 500;
            return $this->errorResponse(message: $e->getMessage(), status: $status);
        }

    }

    public function productVariationSetupAutoFill(ProductVariationSetupAutoFillRequest $request): \Illuminate\Http\JsonResponse
    {
       try{
           $result = $this->aiContentGeneratorService->generateContent(contentType: "variation_setup", context:  $request['name'], description:  $request['description'], category_id: $request['category_id']);
           $response = $this->productResponse->variationSetupAutoFill(result: $result);

           \Illuminate\Support\Facades\Log::info("variation",[
               "result" => $result,
               "response" => $response
           ]);
           $zones = session()->has('category_wise_zones') ? session('category_wise_zones') : [];
           $existingData = session()->has('variations') ? session('variations') : [];

           $variants = $response['data'] ?? [];


           if (is_array($variants) && !empty($variants)) {
               foreach ($variants as $variant) {
                   $data = [
                       'variant' => $variant['variant'] ?? null,
                       'variant_key' => str_replace(' ', '-', $variant['variant']) ?? null,
                       'price' => $variant['price'] ?? 0,
                   ];
                   if ($data['variant'] && !self::searchForKey($data['variant'], $existingData)) {
                       $existingData[] = $data;
                   }
               }
           }else{
               throw new ValidationException('AI unable to generate variation setup data, Please regenerate again.');
           }
           session()->put('variations', $existingData);

           return response()->json([
               'flag' => 1,
               'template' => view('servicemanagement::admin.partials._variant-data', compact('zones'))->render()
           ]);
       }catch (\Exception $e){
          $status = $e->getCode() > 0 ? $e->getCode() : 500;
          return $this->errorResponse(message: $e->getMessage(), status: $status);
       }
    }

    public function generateProductTitleSuggestion(GenerateProductTitleSuggestionRequest $request): \Illuminate\Http\JsonResponse{
       try{
           $result = $this->aiContentGeneratorService->generateContent(contentType: "generate_product_title_suggestion", context:  $request['keywords'], description:  $request['description']);
           $response = $this->productResponse->generateTitleSuggestions(result: $result);
           return $this->successResponse(data: $response, status: 200);
       }catch (\Exception $e){
            $status = $e->getCode() > 0 ? $e->getCode() : 500;
            return $this->errorResponse(message: $e->getMessage(), status: $status);
       }
    }
    public function generateTitleFromImages(GenerateTitleFromImageRequest $request): \Illuminate\Http\JsonResponse{
      try{
          $imageFile = $request->file('image');
          $imagePath = $this->aiContentGeneratorService->getAnalyizeImagePath($imageFile);
          $result = $this->aiContentGeneratorService->generateContent(contentType: "generate_title_from_image", imageUrl: $imagePath['imageFullPath']);
          $this->aiContentGeneratorService->deleteAiImage($imagePath['imageName']);
          return $this->successResponse(data: $result, status: 200);
      }catch (\Exception $e){
          $status = $e->getCode() > 0 ? $e->getCode() : 500;
          return $this->errorResponse(message: $e->getMessage(), status: $status);
      }
    }

    function searchForKey($variant, $array): int|string|null
    {
        foreach ($array as $key => $val) {
            if ($val['variant'] === $variant) {
                return true;
            }
        }
        return false;
    }
}
