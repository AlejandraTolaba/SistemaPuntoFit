<?php

namespace sisPuntoFit\Http\Requests;

use sisPuntoFit\Http\Requests\Request;

class ProfesorFormRequest extends Request
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
            'fecha_alta' =>'date',
            'fecha_nacimiento' => 'date',
            'nombrea'=>'required|max:45',
            'apellido'=>'required|max:45',
            'dni'=>'required|max:8|unique:profesor',
            'fecha_nacimiento'=>'required',
            'sexo'=>'required|max:1',
            'domicilio'=>'required|max:250',
            'telefono_celular'=>'required|max:45',
            'numero_contacto'=>'max:45',
            'email'=>'max:100',
        ];
    }
}
