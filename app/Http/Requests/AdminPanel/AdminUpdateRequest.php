<?php

namespace App\Http\Requests\AdminPanel;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class AdminUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $roles = User::$rules;
        $roles['password'] = 'nullable|same:confirm-password|min:8';
        $roles['name'] = 'required|string|unique:users,name,' . $this->id;
        $roles['email'] = 'required|email|unique:users,email,' . $this->id;
        return $roles;
    }

    public function messages()
    {
        return
            [
                'required' => __('validation.required'),
                'string' => __('validation.string'),
                'email' => __('validation.email'),
                'max' => __('validation.max'),
                'min' => __('validation.min'),
                'same' => __('validation.confirmed')
            ];
    }
}
