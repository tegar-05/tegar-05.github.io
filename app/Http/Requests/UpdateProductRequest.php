<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $productId = $this->route('product')->id;

        return [
            'name' => 'required|string|max:255',
            'slug' => 'sometimes|nullable|alpha_dash|unique:products,slug,' . $productId,
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_signature' => 'boolean',
            'is_flores' => 'boolean',
            'is_active' => 'boolean',
            'sold' => 'integer|min:0',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'is_signature' => $this->boolean('is_signature'),
            'is_flores' => $this->boolean('is_flores'),
            'is_active' => $this->boolean('is_active', true),
            'sold' => $this->integer('sold', 0),
        ]);
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The product name is required.',
            'price.required' => 'The price is required.',
            'category_id.required' => 'Please select a category.',
            'image.image' => 'The file must be an image.',
            'image.max' => 'The image must not exceed 2MB.',
        ];
    }
}
