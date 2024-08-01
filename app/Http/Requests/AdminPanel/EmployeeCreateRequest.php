<?php

namespace App\Http\Requests\AdminPanel;

use App\Models\Employee;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class EmployeeCreateRequest extends FormRequest
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
        // $rules['password'] = ['nullable', 'string', Password::min(6)->letters()->mixedCase()->numbers()->symbols()->uncompromised()];
        $rules['password'] = ['nullable', 'string', Password::min(3)];
        return $rules;
    }
}
