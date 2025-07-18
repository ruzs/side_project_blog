<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleFormRequest extends FormRequest
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
            'name'          => 'required|string|max:128',
            'protect'       => 'nullable|int|max:128',
            'guard_name'    => 'required|string|max:128',
            'remark'        => 'nullable|string|max:128',
        ];
        return $rule;
    }
}
