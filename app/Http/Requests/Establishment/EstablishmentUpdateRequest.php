<?php

namespace App\Http\Requests\Establishment;

use Illuminate\Foundation\Http\FormRequest;

class EstablishmentUpdateRequest extends FormRequest
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
        $validationRulesArray = [
            'name' => 'required|min:3|max:255',
            'description' => 'required|min:3|max:655',
            'delivery_time' => 'required|min:3|max:255',
            'min_value' => 'required',
            'phone' => 'required|min:3|max:655',
        ];

        if($this->picture != "false"){
            array_push($validationRulesArray, [ 'picture' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048']);
        }
        if($this->background_picture != "false"){
            array_push($validationRulesArray, [ 'background_picture' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048']);
        }

        return $validationRulesArray;
    }
}
