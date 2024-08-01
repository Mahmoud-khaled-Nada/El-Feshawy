<?php

namespace App\Http\Requests\AdminPanel;

use App\Models\Employee;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class EmployeeUpdateRequest extends FormRequest
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
        $rules = Employee::$rules;

        $rules['email'] .= $this->id;
        $rules['phone'] .= $this->id;
        $rules['password'] = ['nullable', 'string', Password::min(6)->mixedCase()->letters()->numbers()->symbols()->uncompromised()];

        return $rules;
    }
}
