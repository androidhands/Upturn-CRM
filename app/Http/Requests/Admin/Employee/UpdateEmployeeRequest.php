<?php

namespace App\Http\Requests\Admin\Employee;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UpdateEmployeeRequest extends FormRequest
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

            'role_id' => ['required'],
            'date_of_birth' => ['required', 'date'],
            'department_id' => ['required'],
            'gender' => ['required', 'integer', 'max:2'],
            'education_degree' => ['required', 'string', 'max:150'],
            'graduation_year' => ['required', 'integer'],
            'military_status' => ['required', 'string', 'max:50'],
            'marital_status' => ['required', 'string', 'max:50'],
            'hiring_date' => ['required', 'date'],
            'termination_date' => ['nullable', 'date'],
            'is_active' => ['required', 'boolean']

        ];
    }
}
