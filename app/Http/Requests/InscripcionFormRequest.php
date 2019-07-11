<?php

namespace sisPuntoFit\Http\Requests;

use sisPuntoFit\Http\Requests\Request;

class InscripcionFormRequest extends Request
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
            'fecha_inscripcion' => 'date',
            'fecha_vencimiento_inscripcion' => 'date',
            'idactividad' => 'required|exists:actividad,idactividad',
            'idforma_de_pago' => 'required|exists:forma_de_pago,idforma_de_pago',
            'monto' => 'required',
            'precio'=>'numeric'
        ];
    }
}
