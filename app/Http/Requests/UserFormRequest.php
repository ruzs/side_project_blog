<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserFormRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        $rule=[
            'name'      => 'required|string|max:128',
            'account'   => 'required|string|max:128',
            'password'  => 'nullable|string|min:8|max:128|confirmed',
            'email'     => 'nullable|email|max:128',
            'role'      => 'nullable|int',
            'role.*'    => 'nullable|int',
        ];
        return $rule;
    }
}
