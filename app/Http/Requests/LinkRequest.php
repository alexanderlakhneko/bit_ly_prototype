<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LinkRequest extends FormRequest
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
        return [
            'link' => 'required|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
            'slug' => 'required|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/|unique:links,slug',
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {

        return [
            'link.required' => 'Link is required',
            'link.regex'  => 'Link is not valid',

            'slug.required' => 'Slug is required',
            'slug.regex'  => 'Slug is not valid',
            'slug.unique'  => 'This slug is already taken',
        ];
    }
}
