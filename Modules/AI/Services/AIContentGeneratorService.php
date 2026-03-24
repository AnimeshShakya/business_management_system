<?php

namespace Modules\AI\Services;

use App\Traits\FileManagerTrait;
use Modules\AI\AIProviders\AIProviderManager;
use Modules\AI\AIProviders\ClaudeProvider;
use Modules\AI\AIProviders\OpenAIProvider;
use Modules\AI\app\Models\AISetting;

class AIContentGeneratorService
{
    use FileManagerTrait;
    protected array $templates = [];
    protected array $providers;

    public function __construct()
    {
        $this->loadTemplates();
        $this->providers = [new OpenAIProvider(), new ClaudeProvider()];
    }
    protected function loadTemplates(): void
    {
        $templateClasses = [
            'product_name' =>  \Modules\AI\PromptTemplates\ProductNameTemplate::class,
            'product_description' =>  \Modules\AI\PromptTemplates\ProductDescriptionTemplate::class,
            'product_short_description' =>  \Modules\AI\PromptTemplates\ProductShortDescriptionTemplate::class,
            'general_setup' =>  \Modules\AI\PromptTemplates\GeneralSetupTemplates::class,
            'variation_setup' =>  \Modules\AI\PromptTemplates\ProductVariationSetup::class,
            'generate_product_title_suggestion' =>  \Modules\AI\PromptTemplates\GenerateProductTitleSuggestionTemplate::class,
            'generate_title_from_image' =>  \Modules\AI\PromptTemplates\GenerateTitleFromImageTemplate::class,
        ];
        foreach ($templateClasses as $type => $class) {
            if (class_exists($class)) {
                $this->templates[$type] = new $class();
            }
        }
    }
    public function generateContent(string $contentType, mixed $context = null, string $langCode = 'en', ?string $description = null, ?string $imageUrl = null, ?string $category_id =null ): string
    {
        $template = $this->templates[$contentType];
        $prompt = $template->build(context: $context, langCode: $langCode, description: $description, category_id: $category_id);
        $providerManager = new AIProviderManager($this->providers);
        return $providerManager->generate(prompt: $prompt, imageUrl: $imageUrl, options: ['section' => $contentType, 'context' => $context]);
    }
    public function getAnalyizeImagePath($image): array
    {
        $imageName = file_uploader('product/ai_product_image/', APPLICATION_IMAGE_FORMAT, $image);
        return $this->ai_product_image_full_path($imageName);
    }
    public function ai_product_image_full_path($image_name): array
    {
        //local
        if (in_array(request()->ip(), ['127.0.0.1', '::1'])) {
            return [
                'imageName' =>$image_name,
                'imageFullPath' =>"https://media.istockphoto.com/id/1325196791/photo/the-young-handsome-repairman-in-worker-suit-with-the-professional-tools-box-is-fixing-the.jpg?s=612x612&w=0&k=20&c=m5BjjBmRtz8SDCKX9sSQ_v2wxYMoFbJWNp_hpc6_0zY=",
                //'imageFullPath' =>"https://media.istockphoto.com/id/1309352410/photo/cheeseburger-with-tomato-and-lettuce-on-wooden-board.jpg?s=612x612&w=0&k=20&c=lfsA0dHDMQdam2M1yvva0_RXfjAyp4gyLtx4YUJmXgg=",
//                'imageFullPath' => "https://media.istockphoto.com/id/1453972679/vector/3d-realistic-online-booking-banner-mobile-application-for-book-hotel-accommodation-or.jpg?s=1024x1024&w=is&k=20&c=JGvsuETJ3x86EB0yk3BSfVGZCNfF68jsjcsTG3PsW48=",
            ];
        }
        // live
        return [
            'imageName' =>$image_name,
            'imageFullPath' => asset(path: 'storage/app/public/product/ai_product_image/'.$image_name)
        ];
    }

    public function deleteAiImage($imageName): void
    {
        file_remover('product/ai_product_image/', $imageName);
    }
    public function getAvailableContentTypes(): array
    {
        return array_keys($this->templates);
    }
}
