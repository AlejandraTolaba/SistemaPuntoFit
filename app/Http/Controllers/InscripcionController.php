<?php

namespace sisPuntoFit\Http\Controllers;

use Illuminate\Http\Request;

use sisPuntoFit\Http\Requests;
use Carbon\Carbon;
use sisPuntoFit\Inscripcion;
use sisPuntoFit\Alumno;
use sisPuntoFit\Actividad;
use sisPuntoFit\Plan;
use sisPuntoFit\Movimiento;
use sisPuntoFit\Asistencia;
use Illuminate\Support\Facades\Redirect; //(para poder hacer redirecciones)
use Illuminate\Support\Facades\Input;
use sisPuntoFit\Http\Requests\InscripcionFormRequest;
use Illuminate\Support\Collection;

use DB;

class InscripcionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($idalumno)
    {
        $alumno= DB::table('alumno as a')
        ->select('a.idalumno', DB::raw('CONCAT(a.nombre," ",a.apellido) as nombrecompleto'))
        ->where('a.idalumno','=',$idalumno)->first();
            
        $inscripciones=DB::table('inscripcion as i')
        ->join('plan as p','i.idplan','=','p.idplan')
        ->join('actividad as a','a.idactividad','=','i.idactividad')
        ->select('a.nombre as actividad','p.nombre as plan','fecha_vencimiento_inscripcion','i.cantidad_clases as cantidad','i.saldo as saldo','i.estado','i.idinscripcion')
        ->where ('i.idalumno','=', $idalumno)
        ->orderBy('fecha_inscripcion','desc')
        ->paginate(10);
        //dd($inscripciones);
    
        return view('alumno.inscripcion.index',["inscripciones"=>$inscripciones,"alumno"=>$alumno]);

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

            $plan = $request->get('idplan'); //obtengo una cadena de la forma "1_50.00"
            $pos=strpos($plan,'_'); //busco la posición del guion bajo
            $id_plan=substr($plan,0, $pos); //obtengo el id del plan elegido
            $inscripcion->idplan = $id_plan;
            
            $pln = Plan::findOrFail($id_plan);
            $inscripcion->cantidad_clases = $pln->cantidad_clases;

            $precio_plan=(double)substr($plan,$pos+1); //obtengo el precio del plan elegido
            $monto_pagado=(double)$request->get('monto'); //convierto el monto en decimal
            
            if($precio_plan!=$monto_pagado){
                $alumno = Alumno::findOrFail($idalumno);
                $saldo_anterior=(double)$alumno->saldo;
                $nuevo_saldo=$precio_plan-$monto_pagado;
                $alumno->saldo=$saldo_anterior+$nuevo_saldo;
                $alumno->update();
                $inscripcion->saldo=$nuevo_saldo;
            } else {
                $inscripcion->saldo=0;
            }

            DB::commit();
            
            if ( $inscripcion->save())
            {
                flash("La inscripción se guardo exitosamente")->success();
                
                $movimiento= new Movimiento();
                $movimiento->concepto= "Inscripción N° ".$inscripcion->idinscripcion;
                $movimiento->tipo="INGRESO";
                $movimiento->monto=$request->get('monto');
                $movimiento->idforma_de_pago= $request->get("idforma_de_pago");
                $movimiento->fecha=$mytime;
                $movimiento->save();
    
                /* $alumno= DB::table('alumno as a')
                ->select('a.idalumno', DB::raw('CONCAT(a.nombre," ",a.apellido) as nombrecompleto'),'foto')
                ->where('a.idalumno','=',$idalumno)->first();
                    
                $inscripciones=DB::table('inscripcion as i')
                ->join('plan as p','i.idplan','=','p.idplan')
                ->join('actividad as a','a.idactividad','=','i.idactividad')
                ->select('a.nombre as actividad','p.nombre as plan','fecha_vencimiento_inscripcion','i.cantidad_clases as cantidad','i.saldo as saldo','i.estado','i.idinscripcion')
                ->where ('i.idalumno','=', $idalumno)
                ->orderBy('fecha_inscripcion','desc')           
                ->paginate(10);

                return view('alumno.inscripcion.index',["inscripciones"=>$inscripciones,"alumno"=>$alumno]); */
                return Redirect::to('alumno/inscripcion/'.$idalumno);
            }
            
        } else {
           
            flash("Debe seleccionar un plan")->error()->important();
            return Redirect::back();
        }

    }

    public function buscar(){
        return view('asistencia.buscar');
    } 

    public function mostrarAlumno(Request $request){
        $query=trim($request->get('searchText')); //filtro de busqueda
        if ($query!="") {
            $inscripcionA=DB::table('alumno as a')
            ->join('inscripcion as i','a.idalumno','=','i.idalumno')
            ->join('actividad as ac','ac.idactividad','=','i.idactividad')
            ->join('plan as p','p.idplan','=','i.idplan')
            ->select('i.idinscripcion','a.idalumno', DB::raw('CONCAT(a.nombre," ",a.apellido) as nombrecompleto'),'ac.nombre as actividad','p.nombre as plan','fecha_vencimiento_inscripcion',DB::raw('i.cantidad_clases-1 as cantidad'),'i.saldo as saldo','i.estado', 'a.foto',DB::raw('date_format(a.fecha_nacimiento,"%m-%d") as fecha_nacimiento'))
            ->where('dni','LIKE',$query)
            ->where('i.estado','=','Activa')
            ->first();
            
            if($inscripcionA == NULL){
                flash("El DNI ". $query . " no tiene inscripciones activas")->error();
                return Redirect::back()->with('alarma','Debe sonar alarma');
            }
            else{
                $inscripcion= Inscripcion::find($inscripcionA->idinscripcion);
                $inscripcion->cantidad_clases = (int)$inscripcion->cantidad_clases - 1;
                $mytime = Carbon::now();
                $mytime2 = $inscripcion->fecha_vencimiento_inscripcion;
                $inscripcion->update();

                $asistencia = new Asistencia();
                $asistencia->idinscripcion = $inscripcion->idinscripcion;
                $asistencia->fecha = $mytime;
                $asistencia->save();

                $fecha_nac=$inscripcionA->fecha_nacimiento;

                $mytime3=$mytime->toDateString();
                $pos=strpos($mytime3,'-'); //busco la posición del primer guion, para quitar el año
                $mes_dia=substr($mytime3,$pos+1); //obtengo la cadena de la forma "08-13"
                
                if($mes_dia==$fecha_nac){
                    flash("¡¡Feliz Cumpleaños!!");
                }
                if (($mytime->toDateString())==($mytime2->toDateString())){
                    flash("Hoy se vence tu inscripción")->warning();
                } else {
                    $diff = $mytime2->diffInDays($mytime)+1;
                    if (($diff<=5) && ($diff>=1)){
                        flash("En ". $diff . " días se vence tu inscripción")->warning();
                    }
                }
                
                return view('asistencia.mostrarAlumno',["inscripcionA"=>$inscripcionA]);
            } 

        } else { 
            return Redirect::back();
        }
            
    }

    public function mostrarInscripcion($id)
    {
        $inscripcion=DB::table('inscripcion as i')
        ->join('plan as p','i.idplan','=','p.idplan')
        ->join('actividad as a','a.idactividad','=','i.idactividad')
        ->join('alumno as al','al.idalumno','=','i.idalumno')
        ->join('forma_de_pago as f','f.idforma_de_pago','=','i.idforma_de_pago')
        ->select(DB::raw('CONCAT(al.nombre," ",al.apellido) as nombrecompleto'),'a.nombre as actividad','p.nombre as plan','fecha_inscripcion','i.monto','i.saldo','i.idinscripcion','f.nombre as forma')
        ->where ('i.idinscripcion','=', $id)->first();
        return view('alumno.inscripcion.mostrarInscripcion',["inscripcion"=>$inscripcion]);
        
    }

    public function actualizarSaldo(Request $request,$id)
    {
        $inscripcion= Inscripcion::find($id); 
        $saldo_anterior=(double)$inscripcion->saldo;
        $monto_movimiento=$request->get("monto_movimiento");

        if($saldo_anterior<$monto_movimiento){
            flash("El monto a pagar es superior al saldo")->error()->important();
            return Redirect::back();
        } else{
            $alumno = Alumno::find($inscripcion->idalumno);
            $alumno->saldo=(double)$alumno->saldo-$monto_movimiento;
            $alumno->update();

            $inscripcion->monto=(double)$inscripcion->monto+$monto_movimiento;
            /* if($saldo_anterior>$monto_movimiento){
                $inscripcion->saldo=$saldo_anterior-$monto_movimiento;
            } else {
                $inscripcion->saldo=0;
            } */
            $inscripcion->saldo=$saldo_anterior-$monto_movimiento;
            $inscripcion->update();

            $movimiento= new Movimiento();
            $movimiento->concepto= "Act. Inscripción N° ".$inscripcion->idinscripcion;
            $movimiento->tipo="INGRESO";
            $movimiento->monto=$monto_movimiento;
            $movimiento->idforma_de_pago= 1;
            $mytime= Carbon::now();
            $movimiento->fecha=$mytime;
            $movimiento->save();
            
            flash("Los cambios se realizaron con éxito")->success();
            return Redirect::to('alumno/inscripcion/'.$inscripcion->idalumno);
        } 

    }

    public function mostrarFechasInscripcion($id)
    {
        $inscripcion=DB::table('inscripcion as i')
        ->join('actividad as a','a.idactividad','=','i.idactividad')
        ->join('alumno as al','al.idalumno','=','i.idalumno')
        ->select(DB::raw('CONCAT(al.nombre," ",al.apellido) as nombrecompleto'),'a.nombre as actividad','fecha_inscripcion','fecha_vencimiento_inscripcion','idinscripcion','cantidad_clases')
        ->where ('i.idinscripcion','=', $id)->first();
        return view('alumno.inscripcion.mostrarFechasInscripcion',["inscripcion"=>$inscripcion]);    
    }

    public function actualizarFechaVencimiento(Request $request,$id)
    {
        $inscripcion= Inscripcion::find($id); 
        $inscripcion->fecha_vencimiento_inscripcion=$request->get("fecha_vencimiento_inscripcion");
        $inscripcion->update();
        flash("Los cambios se realizaron con éxito")->success();
        return Redirect::to('alumno/inscripcion/'.$inscripcion->idalumno);
    }

}