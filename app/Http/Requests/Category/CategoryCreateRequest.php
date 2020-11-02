<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class CategoryCreateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'photo' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'priority' => 'required',
            'enable' => 'required',
		];
    }
}
