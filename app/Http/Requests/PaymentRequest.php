<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'payment_method' => 'required|in:cod,bank_transfer,midtrans',
            'customer_name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'customer_phone' => 'required|string|regex:/^[0-9+\-\s]+$/|max:20',
            'customer_address' => 'required|string|max:500|min:10',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'customer_name.regex' => 'Name can only contain letters and spaces.',
            'customer_phone.regex' => 'Please enter a valid phone number.',
            'customer_address.min' => 'Please provide a complete address (at least 10 characters).',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'customer_name' => strip_tags(trim($this->customer_name)),
            'customer_phone' => strip_tags(trim($this->customer_phone)),
            'customer_address' => strip_tags(trim($this->customer_address)),
        ]);
    }
}
