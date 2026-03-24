<?php

namespace Modules\AI\Services;

use Modules\AI\app\Exceptions\ValidationException;

class AIResponseValidatorService
{
    /**
     * @throws ValidationException
     */
    public function validateProductTitle(string $response, ?string $context = null): void
    {
        if ($this->isInvalidProductTitle($response, $context)) {
            throw new ValidationException('The provided input is not valid for generating a service title. Please provide a meaningful service name.');
        }
    }

    /**
     * @throws ValidationException
     */
    public function validateProductDescription(string $response, ?string $context = null): void
    {
        if ($this->isInvalidProductTitle($response, $context)) {
            throw new ValidationException('The provided input is not valid for generating a service description. Please provide a meaningful name or description.');
        }
    }

    /**
     * @throws ValidationException
     */
    public function validateProductShortDescription(string $response, ?string $context = null): void
    {
        if ($this->isInvalidProductTitle($response, $context)) {
            throw new ValidationException('The provided input is not valid for generating a service short description. Please provide a meaningful name or short description.');
        }
    }

    /**
     * @throws ValidationException
     */
    public function validateProductGeneralSetup(string $response, ?string $context = null): void
    {
        if ($this->isInvalidProductTitle($response, $context)) {
            throw new ValidationException('The provided input is not valid for general setup. Please provide meaningful data.');
        }
    }


    /**
     * @throws ValidationException
     */
    public function validateProductVariationSetup(string $response, ?string $context = null): void
    {
        if ($this->isInvalidProductTitle($response, $context)) {
            throw new ValidationException('The provided input is not valid for generating a service variation setup. Please provide a meaningful name or description.');
        }
    }

    /**
     * @throws ValidationException
     */
    public function validateImageResponse(string $response): void
    {
        if ($this->isInvalidImageResponse($response)) {
            throw new ValidationException('The uploaded image is not valid for generating service content. Please provide a meaningful image.');
        }
    }

    /**
     * @throws ValidationException
     */
    public function validateProductTitleSuggestion(string $response, ?string $context = null): void
    {
        if ($this->isInvalidProductTitle($response, $context)) {
            throw new ValidationException('The provided input is not valid for generating a service title. Please provide a meaningful service name.');
        }
    }

    private function isInvalidProductTitle(string $response, ?string $context = null): bool
    {
        return $this->phraseCheck($response, $context);
    }


    private function isInvalidImageResponse(string $response): bool
    {
        return $this->phraseCheck($response, null);
    }

    public function phraseCheck(string $response, ?string $context): bool
    {
        $invalidPhrases = [
            'INVALID_INPUT',
        ];
        foreach ($invalidPhrases as $phrase) {
            if (stripos($response, $phrase) !== false) {
                return true;
            }
        }
        return false;
    }
}
