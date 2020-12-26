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
            'name' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'is_auth' => ['boolean'],
            'phone' =>   ['required', 'string', 'max:255'],

            'wa_browser_id' => ['string', 'max:600'],
            'wa_secret_bundle' => ['string', 'max:600'],
            'wa_token_1' => ['string', 'max:600'],
            'wa_token_2' => ['string', 'max:600'],

            'qr_code' => ['string', 'max:600'],

            'encKey' => ['string', 'max:600'],
            'macKey' => ['string', 'max:600'],
		];
    }
}
