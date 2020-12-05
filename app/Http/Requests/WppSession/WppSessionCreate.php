<?php

namespace App\Http\Requests\WppSession;

use Illuminate\Foundation\Http\FormRequest;

class WppSessionCreate extends FormRequest
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
            'name' => ['required', 'string', 'max:255', 'unique:wpp_sessions'],
            'status' => ['required', 'string', 'max:255'],
            'is_auth' => ['required', 'boolean'],
            'phone' =>   ['required', 'string', 'max:255'],

            'wa_browser_id' => ['required', 'string', 'max:600'],
            'wa_secret_bundle' => ['required', 'string', 'max:600'],
            'wa_token_1' => ['required', 'string', 'max:600'],
            'wa_token_2' => ['required', 'string', 'max:600'],
		];
    }
}
