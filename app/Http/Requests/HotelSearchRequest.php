<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\RequiredIf;

class HotelSearchRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => 'nullable|string',
            'bedrooms' => 'nullable|numeric|min:1',
            'bathrooms' => 'nullable|numeric|min:0',
            'storeys' => 'nullable|numeric|min:1',
            'garages' => 'nullable|numeric|min:0',
            'price_from' => ['nullable', 'numeric', 'min:0', new RequiredIf($this->filled('price_to'))],
            'price_to' => ['nullable', 'numeric', 'min:0', new RequiredIf($this->filled('price_from'))],
        ];
    }
}
