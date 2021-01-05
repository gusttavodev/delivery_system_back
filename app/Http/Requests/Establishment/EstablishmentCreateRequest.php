<?php

namespace App\Http\Requests\Establishment;

use Illuminate\Foundation\Http\FormRequest;

class EstablishmentCreateRequest extends FormRequest
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
            'name' => 'required|min:3|max:255',
            'description' => 'required|min:3|max:655',
            'picture' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'delivery_time' => 'required|min:3|max:255',
            'min_value' => 'required',
            'background_picture' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'phone' => 'required|min:3|max:655',
        ];
    }
}
