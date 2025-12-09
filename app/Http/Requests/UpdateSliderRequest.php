<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSliderRequest extends FormRequest
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
        $sliderId = $this->route('slider')->id;

        return [
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:500',
            'link' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'order' => 'nullable|integer|min:1',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'is_active' => $this->boolean('is_active', true),
            'order' => $this->integer('order', 1),
        ]);
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'title.required' => 'The slider title is required.',
            'link.url' => 'Please provide a valid URL.',
            'image.image' => 'The file must be an image.',
            'image.max' => 'The image must not exceed 2MB.',
        ];
    }
}
