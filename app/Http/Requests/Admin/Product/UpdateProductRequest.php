<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'name'=>['required','string','max:225'],
            'code'=>['required','string','max:225'],
            'price'=>['required','max:225',"regex:/^(\d+|\d+(\.\d{1,2})?|(\.\d{1,2}))$/" ],
            'package'=>['required','string','max:225'],
            'unit'=>['required','string','max:225'],
            'imageUrl'=>['nullable','image'],
        ];
    }
}
