<?php

namespace Modules\AI\PromptTemplates;

use Modules\AI\Contracts\PromptTemplateInterface;
use Modules\AI\Services\ProductResourceService;

class ProductVariationSetup implements  PromptTemplateInterface
{
    protected ProductResourceService $productResource;

    public function __construct()
    {
        $this->productResource = new ProductResourceService();
    }

    public function build(?string $context = null, ?string $langCode = null, ?string $description = null, ?string $category_id = null): string
    {
        $langCode = strtoupper($langCode);

        $resource = $this->productResource->getVariationData($category_id);
        $zones    = $resource['zones'];
        $zonesString = collect($zones)
            ->map(fn($z) => "{$z['id']} ({$z['name']})")
            ->implode(', ');

        return <<<PROMPT
            You are a Demandium  booking service variation expert.

            Given the following service:
                - Name: '{$context}'
                - Description: '{$description}'

            Available Zone options:
                - Zones: '{$zonesString}'

            === TASK ===
            Generate ONLY a JSON array of variation objects with the following structure:

            [
              {
                "variant": "Variant Name",
                "variant_key": "variant_key",  // lowercase, snake_case version of variant
                "zone_id": "zone-uuid",        // MUST match one of the available zones
                "price": 100                   // integer or float, > 0
              }
            ]

          === RULES ===
            1. Variants must always include at least one valid entry.
               - If no clear variants can be derived from the name and description, use the service name itself as a single default variant.
               - Never return an empty array unless there are no available zones.
            2. Variants should be derived from the service name and description (e.g., laptop repair, Rent Ambulance, wedding reception makeover, car touch up paint etc.) Variants must be relevant to the service (which users can book).
            3. For each variant, duplicate entries across ALL available zones.
            4. Use correct zone IDs from the provided list.
            5. Generate realistic but placeholder prices (e.g., 50–500).
            6. Ensure variant_key is unique and based on variant (snake_case).
            7. The response must be valid JSON, no markdown, no explanations, no leading/trailing text.
            8. If no zones are available, return an empty array [].

             **Output Format Rule:**
             Return ONLY the raw JSON object — no code blocks, no markdown, no explanation, no labels, no timestamps, no extra text, no triple backticks (``` or ```json```). The response must start with "{" and end with "}".

        PROMPT;

    }

    public function getType(): string
    {
        return 'variation_setup';
    }

}
