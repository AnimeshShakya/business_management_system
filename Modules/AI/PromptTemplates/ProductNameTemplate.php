<?php

namespace Modules\AI\PromptTemplates;

use Modules\AI\Contracts\PromptTemplateInterface;

class ProductNameTemplate implements  PromptTemplateInterface
{
    public function build(?string $context = null, ?string $langCode = null, ?string $description = null, ?string $category_id = null): string
    {
        $langCode = strtoupper($langCode);

        return <<<PROMPT
          You are a professional booking service platform copywriter.

          Rewrite the service name "{$context}" as a clean, concise, and professional service title for online service business.

          CRITICAL INSTRUCTION:
          - The output must be 100% in {$langCode} — this is mandatory.
          - If the original name is not in {$langCode}, fully translate it into {$langCode} while keeping the meaning.
          - Do not mix languages; use only {$langCode} characters and words.
          - Keep it short (35–70 characters), plain, and ready for listings.
          - No extra words, slogans, or punctuation.
          - Return only the translated title as plain text in {$langCode}.

          IMPORTANT:
        - Only process inputs that are actual booking services (rent, service, cleaning, shifting, Plumbing etc. or similar services that can be booked by users).
        - If the input is food, vegetables, fruits, clothing, or anything unrelated to booking services, respond with only "INVALID_INPUT".
        - If the original input is not meaningful or cannot be converted into a professional service title, respond with only "INVALID_INPUT".
        - Do not return generic explanations, fallback messages, or translations for unrelated items.

      PROMPT;
    }

    public function getType(): string
    {
        return 'product_name';
    }
}
