<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoomTypeRequest extends FormRequest
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
            'hotel_id' => 'sometimes|integer|exists:hotels,id',
            'type_name' => 'sometimes|string|max:100',
            'description' => 'nullable|string',
            'max_occupancy' => 'sometimes|integer|min:1',
            'price_per_night' => 'sometimes|numeric|min:0',
        ];
    }
}
