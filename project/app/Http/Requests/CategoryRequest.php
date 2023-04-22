<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=> 'required',
            'slug' => 'required|unique:categories|regex:/^[a-zA-Z0-9\s-]+$/',
            'photo' => 'mimes:jpeg,jpg,png,svg',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('Name field is required.'),
            'photo.mimes' => __('Photo Type is Invalid.'),
            'slug.unique' => __('This slug has already been taken.'),
            'slug.regex' => __('Slug Must Not Have Any Special Characters.'),
        ];
    }
}
