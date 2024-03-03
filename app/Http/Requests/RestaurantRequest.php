<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RestaurantRequest extends FormRequest
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
            'name' => 'required',
            'image' => 'required',
            'description' => 'required',
            'lowest_price' => 'required | integer | min 0 | ',
            'highest_price' => 'required | integer | min 0 | ',
            'postal_code' => 'required|digits:7|numeric',
            'address' => 'required',
            'opening_time' =>'required',
            'closing_time' =>'required',
            'seating_capacity' => 'required | integer | min 0',
        ];
    }
}
