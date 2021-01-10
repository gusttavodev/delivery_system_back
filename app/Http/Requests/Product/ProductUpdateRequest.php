<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $this->category = json_decode($this->category);
        $this->additionals = json_decode($this->additionals);

        if($this->updateImage != "false"){
            return [
                'name' => 'required',
                'photo' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
                'priority' => 'required',
                'enable' => 'required',
                'price' => 'required',
                'description' => 'required',
                'category' => 'required|min:3',
            ];
        }else {
            return [
                'name' => 'required',
                'priority' => 'required',
                'enable' => 'required',
                'price' => 'required',
                'description' => 'required',
                'category' => 'required|min:3',
            ];
        }

    }
}
