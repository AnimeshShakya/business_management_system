<?php

namespace Modules\AI\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductVariationSetupAutoFillRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name'        => 'required|string|max:255',
            'description' => 'required',
            'category_id' => 'required',
        ];
    }

    public  function messages(): array{
        return [
            'name.required' => translate('service_name_is_required_to_generate_variation'),
            'description.required' => translate('service_description_is_required_to_generate_variation'),
            'category_id.required' => translate('category_is_required_to_generate_variation'),
        ];
    }
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
