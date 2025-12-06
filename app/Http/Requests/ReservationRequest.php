<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
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
            'name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'phone' => 'required|string|regex:/^[0-9+\-\s]+$/|max:20',
            'email' => 'required|email|max:255',
            'date' => 'required|date|after_or_equal:today|before_or_equal:' . now()->addMonths(3)->format('Y-m-d'),
            'time' => 'required|string|regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/',
            'people' => 'required|integer|min:1|max:20',
            'note' => 'nullable|string|max:1000',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.regex' => 'Name can only contain letters and spaces.',
            'phone.regex' => 'Please enter a valid phone number.',
            'time.regex' => 'Please enter a valid time in HH:MM format.',
            'date.after_or_equal' => 'Reservation date must be today or later.',
            'date.before_or_equal' => 'Reservations can only be made up to 3 months in advance.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => strip_tags(trim($this->name)),
            'phone' => strip_tags(trim($this->phone)),
            'email' => strtolower(trim($this->email)),
            'note' => strip_tags(trim($this->note ?? '')),
        ]);
    }
}
