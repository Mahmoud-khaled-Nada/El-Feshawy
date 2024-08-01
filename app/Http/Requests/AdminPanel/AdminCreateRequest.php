<?php

namespace App\Http\Requests\AdminPanel;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;

class AdminCreateRequest extends FormRequest
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


    public function rules()
    {
        return User::$rules;
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
                'same' => __('validation.confirmed'),
                'exists' => __('validation.exists'),
                'not_in' => __('validation.not_in')
            ];
    }
}
