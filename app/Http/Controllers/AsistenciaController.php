<?php

namespace sisPuntoFit\Http\Controllers;

use Illuminate\Http\Request;

use sisPuntoFit\Http\Requests;

use sisPuntoFit\Alumno;
use sisPuntoFit\Asistencia;
use sisPuntoFit\Inscripcion;

use Illuminate\Support\Facades\Redirect; //(para poder hacer redirecciones)
use Illuminate\Support\Facades\Input;
use DB; //(QUE USAMOS LA BD QUE INDICAMOS EN .ENV)
use Carbon\Carbon;
use Illuminate\Support\Collection;

class AsistenciaController extends Controller
{
    public function index()
    {
        $actividades = DB::table('actividad')->get();
        $mytime = Carbon::now();
        $asistencias=DB::table('asistencia as a')
        ->join('inscripcion as i','a.idinscripcion','=','i.idinscripcion')
        ->join('actividad as ac','ac.idactividad','=','i.idactividad')
        ->join('alumno as al','al.idalumno','=','i.idalumno')
        ->select('i.idinscripcion','al.idalumno',DB::raw('CONCAT(al.nombre," ",al.apellido)AS alu'))
        ->where('fecha','=',$mytime->toDateString())
        ->orderBy('alu','desc')
        ->paginate(10);
        //dd($asistencias);
        
        return view('asistencia.index',["actividades"=>$actividades, "asistencias"=>$asistencias]);
    }

    public function mostrar_asistencias_por_actividad()
    {
        $idactividad = Input::get('option');
        dd('$idactividad');
        /* $asistencias=DB::table('asistencia as a')
        ->join('inscripcion as i','a.idinscripcion','=','i.idinscripcion')
        ->join('actividad as ac','ac.idactividad','=','i.idactividad')
        ->join('alumno as al','al.idalumno','=','i.idalumno')
        ->select('i.idinscripcion','al.idalumno',DB::raw('CONCAT(al.nombre," ",al.apellido)AS alu'))
        ->where('ac.idactividad','=',$idactividad)
        ->orderBy('alu','desc')
        ->paginate(10); */
        //dd($asistencias);
        
        return view('asistencia.index',["actividades"=>$actividades, "asistencias"=>$asistencias]);
    }
}
