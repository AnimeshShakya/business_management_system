<?php

namespace Modules\AI\PromptTemplates;

use Modules\AI\Contracts\PromptTemplateInterface;

class ProductShortDescriptionTemplate implements PromptTemplateInterface
{
    public function build(?string $context = null, ?string $langCode = null, ?string $description = null, ?string $category_id = null): string
    {
        $langCode = strtolower($langCode) ?? "en";
        return <<<PROMPT
        You are a creative and professional booking service platform copywriter.

        Generate a detailed, engaging, and persuasive service short description for the service named "{$context}".

        CRITICAL LANGUAGE RULES:
        - The entire description must be written 100% in "{$langCode}" — this is mandatory.
        - If the service name is in another language, translate and localize it naturally into "{$langCode}".
        - Do not mix languages; use only "{$langCode}" characters and words.
        - Adapt the tone, phrasing, and examples to be natural for "{$langCode}" readers.

        Content & Structure:
        - The short introductory paragraph describing the product and key features, its main benefit, and who it is for.
        - Keep text clear, concise, and marketing-friendly.
        - Use clear, compelling, and marketing-friendly language.

        Formatting:
        - Do NOT include any markdown syntax, code fences, or triple backticks (``` or ```html```) — remove them completely.
        - Avoid multiple consecutive <p> tags or empty lines that cause large gaps.
        - Return only the HTML content without any commentary or explanation.
        - Retun only one paragraph

        LANGUAGE-AWARE VALIDATION RULE:
        - Before checking if the input is a valid booking service, first translate "{$context}" into English internally (without outputting it).
        - Use that translated meaning to determine whether it is a valid booking service or not.
        - Then continue writing the final description entirely in "{$langCode}".

          IMPORTANT:
       - Only process inputs that are actual booking services (rent, service, cleaning, shifting, plumbing, healthcare, emergency, transportation, or similar services that can be booked by users).
        - If the input is food, vegetables, fruits, clothing, or anything unrelated to booking services, respond with only "INVALID_INPUT".
        - If the original input is not meaningful or cannot be converted into a professional service short description, respond with only "INVALID_INPUT".
        - Do not return generic explanations, fallback messages, or translations for unrelated items.
PROMPT;
    }

    public function getType(): string
    {
        return 'product_short_description';
    }
}
