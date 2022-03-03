<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddDepartmentRequest extends FormRequest
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

    public function rules()
    {
        return [
            'name' => 'required|unique:departments,name'

        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The  name input is required',
            'name.unique' => 'There exists a department with same name',
        ];
    }
}
