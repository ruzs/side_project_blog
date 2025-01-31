<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostFormRequest extends FormRequest
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
            'title'         => 'required|string|max:128',
            'subtitle'      => 'nullable|string|max:128',
            'category_id'   => 'required|int|max:128',
            'content'       => 'required|string',
            'delete'        => 'nullable|int',
        ];
        return $rule;
    }
}
