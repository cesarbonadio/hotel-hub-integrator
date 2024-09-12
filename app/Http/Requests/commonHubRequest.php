<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class commonHubRequest extends FormRequest
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
            'hotelId' => 'required|numeric|gt:0',
            'checkIn' => 'required|date_format:Y-m-d',
            'checkOut' => 'required|date_format:Y-m-d',
            'numberOfGuests' => 'required|numeric|gt:0',
            'numberOfRooms' => 'required|numeric|gt:0',
            'currency' => 'required|string'
        ];
    }


    public function messages(): array
    {
        // custom messages for 'required' rule to provide more meaningful error validation messages
        // default behaviour does not provide the exact variable name

        return [
            'hotelId.required' => 'Es requerido el id del hotel',
            'checkIn.required' => 'Es requerida la fecha de checkin',
            'checkOut.required' => 'Es requerida la fecha de checkout',
            'numberOfGuests.required' => 'Es requerida la cantidad de huespedes',
            'numberOfRooms.required' => 'Es requerida la cantidad de habitaciones',
            'currency.required' => 'Es requerida la moneda'
        ];
    }
}
