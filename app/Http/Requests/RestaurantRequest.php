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
            'image' => 'max 2048',
            'description' => 'required',
            'lowest_price' => 'required | integer | min 0 | lte:highest_price',
            'highest_price' => 'required | integer | min 0 | gte:lowest_price',
            'postal_code' => 'required|digits:7|numeric',
            'address' => 'required',
            'opening_time' =>'required | before:closing_time',
            'closing_time' =>'required | after:opening_time',
            'seating_capacity' => 'required | integer | min 0',
        ];
    }
}
