<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuStoreRequest extends FormRequest
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
            'description' => ['required'],
            'price' => ['required'],
            'image' => ['required', 'image'],
            'categories' => ['required'],
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'The menu name is required.',
            'image.required' => 'The image field is required.',
            'image.image' => 'The image must be a valid image file.',
            'description.required' => 'The description field is required.',
            'price.required' => 'The price is required',
            'categories.required'=> 'please choose the categories',
        ];
    }
}
