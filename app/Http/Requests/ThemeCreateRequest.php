<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThemeCreateRequest extends FormRequest
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
            'primary_color'=> ['required', 'string', 'max:255'],
            'secondary_color'=> ['required', 'string', 'max:255'],
            'text_color'=> ['required', 'string', 'max:255'],
            'title_text_color'=> ['required', 'string', 'max:255'],
            'title_text_hover_color'=> ['required', 'string', 'max:255'],
            'background_color'=> ['required', 'string', 'max:255'],
            'button_background_color'=> ['required', 'string', 'max:255'],
            'button_hover_color'=> ['required', 'string', 'max:255'],
            'button_text_color'=> ['required', 'string', 'max:255'],
            'button_count_color'=> ['required', 'string', 'max:255'],
            'card_background_color'=> ['required', 'string', 'max:255'],
            'card_text_color'=> ['required', 'string', 'max:255'],
            'card_price_color' => ['required', 'string', 'max:255']
        ];
    }
}
