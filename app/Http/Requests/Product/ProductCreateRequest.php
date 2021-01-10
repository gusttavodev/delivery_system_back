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
        $this->category = json_decode($this->category);
        $this->additionals = json_decode($this->additionals);

        return [
            'name' => 'required',
            'photo' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'priority' => 'required',
            'enable' => 'required',
            'price' => 'required',
            'description' => 'required',
            'category' => 'required|min:3',
            'additionals' => 'required|min:3'
		];
    }
}
