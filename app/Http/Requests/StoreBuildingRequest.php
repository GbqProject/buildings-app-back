<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBuildingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // or add authorization logic if needed
    }

    public function rules(): array
    {
        return [
            'city' => ['required', 'string', 'max:255'],
            'room_amount' => ['required', 'integer', 'min:0'],
            'bathroom_amount' => ['required', 'integer', 'min:0'],
            'type_consignement' => ['required', 'in:sale,lease'], // adjust if you have other types
            'rental_value' => ['nullable', 'numeric', 'min:0'],
            'sale_value' => ['nullable', 'numeric', 'min:0'],
            'images' => ['array'], // must be an array
            'images.*' => ['string'], // each image must be a base64 string
        ];
    }
}
