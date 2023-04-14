<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TableLayoutRequest extends FormRequest
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
            'floor_number' => ['required','integer'],
            'floor_name' => ['required'],
            'image' => ['required', 'image'],
        ];
    }
    public function messages()
    {
        return [
            'floor_number.required' => 'The floor_number name is required.',
            'floor_name.required' => 'The floor_name required.',
            'image.image' => 'The image must be a valid image file.',
            'image.required' => 'The image is required.',
            'floor_number.integer' => 'The floor number needs to be integer',
        ];
    }
}
