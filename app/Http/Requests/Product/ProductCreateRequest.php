<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductCreateRequest extends FormRequest
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
            'price' => 'required',
            'description' => 'required',
            'category' => 'required|min:3',
		];
    }
}
