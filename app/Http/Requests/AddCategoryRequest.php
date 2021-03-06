<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddCategoryRequest extends FormRequest
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
            'name' => 'required|unique:categories,name,{$this->Category->id}',
            'description' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The  name input is required',
            'description.required' => 'The category `description is required',
        ];
    }
}
