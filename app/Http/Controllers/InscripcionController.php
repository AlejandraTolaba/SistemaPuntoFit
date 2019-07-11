<?php

namespace sisPuntoFit\Http\Controllers;

use Illuminate\Http\Request;

use sisPuntoFit\Http\Requests;
use Carbon\Carbon;
use sisPuntoFit\Inscripcion;
use sisPuntoFit\Alumno;
use sisPuntoFit\Actividad;
use Illuminate\Support\Facades\Redirect; //(para poder hacer redirecciones)
use Illuminate\Support\Facades\Input;
use sisPuntoFit\Http\Requests\InscripcionFormRequest;
use Illuminate\Support\Collection;
use DB;

class InscripcionController extends Controller
{
    public function index(Request $request)
    {

    }

    public function create($idalumno)
	{
        $actividades = DB::table('actividad as a')->where('estado','=','Activa')->get();
        
        $formas_de_pago = DB::table('forma_de_pago')->get();
        
        $alumno= DB::table('alumno as a')
        ->select('a.idalumno', DB::raw('CONCAT(a.nombre," ",a.apellido) as nombrecompleto'))
        ->where('a.idalumno','=',$idalumno)->first();

		return view('alumno.inscripcion.create',["actividades"=>$actividades, "formas_de_pago"=>$formas_de_pago,"alumno"=>$alumno]);
    }

	public function store(InscripcionFormRequest $request,$idalumno)
	{
        $id_actividad=$request->get('idactividad');
        $id_plan=$request->get('idplan');
        if ($id_actividad!=0 && $id_plan!=0){
            DB::beginTransaction();
            $inscripcion = new Inscripcion;
            $inscripcion->idalumno=$idalumno;
            $mytime = Carbon::now();
            $mytime2 = Carbon::now()->addMonth()->subDay();
            $inscripcion->fecha_inscripcion= $mytime->toDateString();
            $inscripcion->fecha_vencimiento_inscripcion= $mytime2->toDateString();
            $inscripcion->idactividad = $request->get('idactividad');
            $inscripcion->idforma_de_pago= $request->get('idforma_de_pago');

            $inscripcion->monto = $request->get('monto');
            $inscripcion->estado = 'Activa';

            $plan = $request->get('idplan'); //obtengo una cadena de la forma "50.00_1 Clase"
            $pos=strpos($plan,'_'); //busco la posición del guion bajo
            $nombre_plan=substr($plan, $pos+1); //obtengo el nombre del plan elegido

            if($nombre_plan=='1 Clase'){
                $inscripcion->cantidad_clases = 1;
            } else if ($nombre_plan=='8 Clases'){
                $inscripcion->cantidad_clases = 8;
            } else if ($nombre_plan=='12 Clases'){
                $inscripcion->cantidad_clases = 12;
            } else if ($nombre_plan=='20 Clases'){
                $inscripcion->cantidad_clases = 20;
            }

            $precio_plan=(double)substr($plan,0,$pos); //obtengo el precio del plan elegido
            $monto_pagado=(double)$request->get('monto'); //convierto el monto en decimal
            
            if($precio_plan!=$monto_pagado){
                $alumno = Alumno::findOrFail($idalumno);
                $saldo_anterior=(double)$alumno->saldo;
                $nuevo_saldo=$precio_plan-$monto_pagado;
                $alumno->saldo=$saldo_anterior+$nuevo_saldo;
                $alumno->update();
                $inscripcion->saldo=$nuevo_saldo;
            }
            $inscripcion->save();
            DB::commit();
            
            return Redirect::to('alumno/');
            
        } else {
            $request->session()->flash('alert-danger', 'Debe completar todos los campos');
        }

    }
}
