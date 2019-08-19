<?php

namespace sisPuntoFit\Http\Controllers;

use Illuminate\Http\Request;

use sisPuntoFit\Http\Requests;

use sisPuntoFit\Movimiento;
use Illuminate\Support\Facades\Redirect; 
use sisPuntoFit\Http\Requests\MovimientoFormRequest;
use DB;
use Carbon\Carbon;

class MovimientoController extends Controller
{
    public function index()
    {
        
    }
    public function create()
    {
        $formas_de_pago = DB::table('forma_de_pago')->get();
        return view('movimiento.create',["formas_de_pago"=>$formas_de_pago]);
    }
    public function store(MovimientoFormRequest $request)
    {   
        $movimiento= new Movimiento();
        $movimiento->concepto= $request->get("concepto");
        $movimiento->tipo=$request->get("tipo");
        $movimiento->idforma_de_pago= $request->get("idforma_de_pago");
        $movimiento->monto=$request->get("monto");
        $movimiento->fecha=$request->get("fecha");
        $movimiento->save();
        flash("Se registro movimiento exitosamente")->success();
        return view('asistencia.buscar');
    }

}
