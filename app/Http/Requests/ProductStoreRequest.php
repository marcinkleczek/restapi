<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Request defines validation rules for all input data.
 */
class ProductStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool True if request is authorized
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array of validation rules.
     */
    public function rules(): array
    {
        return [
            'name'  => ['required'/*,'unique:App\Models\Product\Product,name' */],
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/'
        ];
    }
}
