<?php

namespace Modules\AI\PromptTemplates;

use Modules\AI\Contracts\PromptTemplateInterface;

class GenerateTitleFromImageTemplate implements PromptTemplateInterface
{

    public function build(?string $context = null, ?string $langCode = null, ?string $description = null, ?string $category_id = null): string
    {
        $langCode ??= 'en';
        $langCode = strtoupper($langCode);

        return <<<PROMPT
            You are an  advanced booking service platform service analyst with strong skills in image recognition.

            Analyze the uploaded product image provided by the user.
            Your task is to generate a clean, concise, and professional  booking service title for online service provider business.

            CRITICAL INSTRUCTION:
            - The output must be 100% in {$langCode} — this is mandatory.
            - Identify the main service in the image and name it clearly.
            - Do not add extra descriptions like "high quality" or "best".
            - Keep it short (35–70 characters), plain, and ready for listings.
            - Return only the translated booking service title as plain text in {$langCode}.

            IMPORTANT:
            - If the image is not relevant to booking services (e.g., food items, clothing, vegetables, random objects, or meaningless images, which cannot bookable service for users), unrelated to booking services respond with only the word "INVALID_INPUT".
            - Do not return generic explanations, fallback messages, or apologies.
            PROMPT;
    }

    public function getType(): string
    {
       return 'generate_title_from_image';
    }
}
