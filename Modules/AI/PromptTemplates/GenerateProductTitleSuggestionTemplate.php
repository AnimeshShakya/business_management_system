<?php

namespace Modules\AI\PromptTemplates;

use Modules\AI\Contracts\PromptTemplateInterface;

class GenerateProductTitleSuggestionTemplate implements PromptTemplateInterface
{

    public function build(mixed $context = null, ?string $langCode = null, ?string $description = null, ?string $category_id = null): string
    {
        $langCode = strtoupper($langCode);
        $keywordsText = $context;
        if (is_array($context)) {
            $keywordsText = implode(' ', $context);
        }
        return <<<PROMPT
               You are an advanced booking service platform service analyst.

               Using the keywords "{$keywordsText}", generate 4 professional, clean, and concise service title for online service provider business.

               CRITICAL INSTRUCTIONS:
               - The output must be 100% in {$langCode}.
               - Titles must use the keywords naturally.
               - Keep them short (35–70 characters), clear, and ready for listings.
               - Return exactly 4 titles in **plain JSON** format as shown below (do not include ```json``` or any extra markdown):

               {
                 "titles": [
                   "Title 1",
                   "Title 2",
                   "Title 3",
                   "Title 4"
                 ]
               }

               Do not include any extra explanation, only return the JSON.

               IMPORTANT:
                - If the keywords are not relevant to booking services or is meaningless, respond with only the word "INVALID_INPUT".
                - Do not return generic explanations, fallback messages, or apologies.

               PROMPT;
    }
    public function getType(): string
    {
        return "generate_product_title_suggestion";
    }

}
