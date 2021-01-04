<?php

namespace App\Http\Requests\RoadmapStep;

use Illuminate\Foundation\Http\FormRequest;

class RoadmapStepCreateRequest extends FormRequest
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
            'title' => 'required',
            'message_before_options' => 'required',
            'message_after_options' => 'required',
            'message_invalid_response' => 'required',
            'has_options' => 'required'
		];
    }
}
