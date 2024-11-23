<?php

namespace App\Http\Requests\Admin\Country;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCountryRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'=>['required','max:225'],
            'flagUrl'=>['nullable','image'],
            'code'=>['required','string'],
            'phoneCode'=>['required','string'],
        ];
    }
}
