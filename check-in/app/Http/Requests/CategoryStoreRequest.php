<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryStoreRequest extends FormRequest
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
            'name' => ['required'],
            'image' => ['required', 'image'],
            'description' => ['required'],
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'The category name is required.',
            'image.required' => 'The image field is required.',
            'image.image' => 'The image must be a valid image file.',
            'description.required' => 'The description field is required.',
        ];
    }
}
