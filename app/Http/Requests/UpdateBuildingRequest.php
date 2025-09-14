<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBuildingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'city' => ['sometimes', 'string', 'max:255'],
            'room_amount' => ['sometimes', 'integer', 'min:0'],
            'bathroom_amount' => ['sometimes', 'integer', 'min:0'],
            'type_consignement' => ['sometimes', 'in:sale,rent'],
            'rental_value' => ['nullable', 'numeric', 'min:0'],
            'sale_value' => ['nullable', 'numeric', 'min:0'],
        ];
    }
}
