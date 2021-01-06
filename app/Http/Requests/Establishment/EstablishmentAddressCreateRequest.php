<?php

namespace App\Http\Requests\Establishment;

use App\Models\Establishment;
use Illuminate\Foundation\Http\FormRequest;

class EstablishmentAddressCreateRequest extends FormRequest
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
        $user_id =  $this->user()->id;
        $this->establishment = Establishment::
            findByUser($this->establishment_id, $user_id);

        return [
            'zip_code' => 'required|min:3|max:255',
            'street' => 'required|min:3|max:655',
            'city' => 'required|min:3|max:255',
            'country' => 'required|min:3|max:255',
            'district' => 'required|min:3|max:655',
            'state' => 'required|max:255',
            'number' => 'required|max:255',
        ];
    }
}
