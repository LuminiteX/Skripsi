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
}
