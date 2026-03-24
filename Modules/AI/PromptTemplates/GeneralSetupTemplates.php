<?php

namespace Modules\AI\PromptTemplates;

use Modules\AI\Contracts\PromptTemplateInterface;
use Modules\AI\Services\ProductResourceService;

class GeneralSetupTemplates implements  PromptTemplateInterface
{
    protected ProductResourceService $productResource;

    public function __construct()
    {
        $this->productResource = new ProductResourceService();
    }

    public function build(?string $context = null, ?string $langCode = null, ?string $description = null, ?string $category_id = null): string
    {
        $resource = $this->productResource->productGeneralSetupData();
        $allCategories      = $resource['categories'];
        $allSubCategories   = $resource['sub_categories'];
        $categories = implode("', '", array_keys($allCategories));
        $subCategories = implode("', '", array_keys($allSubCategories));

       return <<<PROMPT
                 Analyze the service with these details:
                 - Name: '{$context}'
                 - Description: '{$description}'

                 Generate ONLY valid JSON with these exact fields:

                 {
                   "category_name": "Category name",  // Use main categories as category name
                   "sub_category_name": "Sub-category name",  // MUST match selected category's sub-categories
                   "search_tags": ["tag1", "tag2"]  // 3-5 relevant keywords
                   "minimum_bidding_price" : "Minimum bidding price" // numeric only
                   "tax_percentage" : "Tax percentage" // numeric only
                 }
                 === STRICT REQUIREMENTS ===
                 1. ENFORCE category hierarchy (main → sub)
                 2. USE ONLY provided options (case-sensitive)
                 3. SELECT most specific available category
                 5. EXTRACT tags from name/description features
                 6. INCLUDE all fields

                 === AVAILABLE OPTIONS ===
                 [MAIN CATEGORIES] '{$categories}'
                 [SUB CATEGORIES] '{$subCategories}'

                 === RESPONSE FORMAT RULE  ===
                 - If name or description are not service-related terms, or completely irrelevant, nonsensical, or empty (which cannot bookable service for users) — immediately respond ONLY with: INVALID_INPUT
                 - Output ONLY the JSON object or the single word "INVALID_INPUT"
                 - Do NOT include any explanations, comments, or markdown formatting.
                 - Do NOT wrap the JSON in ```json or any other code block.
                 - Ensure the JSON is syntactically valid for json_decode in PHP.
                 - All numeric fields must be valid numbers
                 PROMPT;

    }

    public function getType(): string
    {
        return 'general_setup';
    }

}
