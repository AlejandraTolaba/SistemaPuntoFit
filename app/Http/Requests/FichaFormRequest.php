<?php

namespace sisPuntoFit\Http\Requests;

use sisPuntoFit\Http\Requests\Request;

class FichaFormRequest extends Request
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
            'peso' => 'required',
            'imc' => 'required',
            'edad_corporal' => 'required',
            'grasa_corporal' => 'required',
            'imm' => 'required',
            'mb' => 'required',
            'grasa_viceral' => 'required',
            'edad_corporal' => 'required',
        ];
    }
}
