<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            'postal_code' => 'required|digits:7|numeric',
            'address' => 'required',
            'representative' =>'required',
            'establishment_date' =>'required',
            'capital' => 'required',
            'business' => 'required',
            'number_of_employees' => 'required'
        ];
    }
}
