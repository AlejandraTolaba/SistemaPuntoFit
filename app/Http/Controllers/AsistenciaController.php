<?php

namespace sisPuntoFit\Http\Controllers;

use Illuminate\Http\Request;

use sisPuntoFit\Http\Requests;

//use sisPuntoFit\Actividad;

use Illuminate\Support\Facades\Redirect; //(para poder hacer redirecciones)
use Illuminate\Support\Facades\Input;
use DB; //(QUE USAMOS LA BD QUE INDICAMOS EN .ENV)
use Carbon\Carbon;
use Illuminate\Support\Collection;

class AsistenciaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $fecha=Carbon::now()->toDateString();
        $actividades = DB::table('actividad')->get();
        $id=0;
        $asistencias=DB::table('asistencia as a')
        ->join('inscripcion as i','a.idinscripcion','=','i.idinscripcion')
        ->join('actividad as ac','ac.idactividad','=','i.idactividad')
        ->join('alumno as al','al.idalumno','=','i.idalumno')
        ->select('ac.nombre as actividad','al.idalumno',DB::raw('CONCAT(al.nombre," ",al.apellido)AS alu'))
        ->where('fecha','=',$fecha)
        ->orderBy('alu')
        ->paginate(20);
        $cantidad = DB::table('asistencia as a')
        ->join('inscripcion as i','a.idinscripcion','=','i.idinscripcion')
        ->join('actividad as ac','ac.idactividad','=','i.idactividad')
        ->join('alumno as al','al.idalumno','=','i.idalumno')
        ->select(DB::raw('COUNT(idasistencia) as cant'))
        ->where('fecha','=', $fecha)
        ->first();
    
        return view('asistencia.index',["actividades"=>$actividades, "asistencias"=>$asistencias,"fecha"=>$fecha, "cantidad"=>$cantidad, "id"=>$id]); 
    }

    public function mostrarAsistenciaPorDia(Request $request){
        $fecha=Carbon::createFromFormat('Y-m-d',$request->get('fecha'))->toDateString();
        $actividades = DB::table('actividad')->get();
        $id= $request->input('actividad');
        
        if($id == 0){
            $asistencias=DB::table('asistencia as a')
            ->join('inscripcion as i','a.idinscripcion','=','i.idinscripcion')
            ->join('actividad as ac','ac.idactividad','=','i.idactividad')
            ->join('alumno as al','al.idalumno','=','i.idalumno')
            ->select('ac.nombre as actividad','al.idalumno',DB::raw('CONCAT(al.nombre," ",al.apellido)AS alu'))
            ->where('fecha','=',$fecha)
            ->orderBy('alu')
            ->paginate(10);
            $cantidad = DB::table('asistencia as a')
            ->join('inscripcion as i','a.idinscripcion','=','i.idinscripcion')
            ->join('actividad as ac','ac.idactividad','=','i.idactividad')
            ->join('alumno as al','al.idalumno','=','i.idalumno')
            ->select(DB::raw('COUNT(idasistencia) as cant'))
            ->where('fecha','=', $fecha)
            ->first();
        }
        else{
        $asistencias=DB::table('asistencia as a')
        ->join('inscripcion as i','a.idinscripcion','=','i.idinscripcion')
        ->join('actividad as ac','ac.idactividad','=','i.idactividad')
        ->join('alumno as al','al.idalumno','=','i.idalumno')
        ->select('ac.nombre as actividad','al.idalumno',DB::raw('CONCAT(al.nombre," ",al.apellido)AS alu'))
        ->orderBy('alu')
        ->where('fecha','=',$fecha)
        ->where('ac.idactividad','=',$id)
        ->paginate(20);
        $cantidad = DB::table('asistencia as a')
        ->join('inscripcion as i','a.idinscripcion','=','i.idinscripcion')
        ->join('actividad as ac','ac.idactividad','=','i.idactividad')
        ->join('alumno as al','al.idalumno','=','i.idalumno')
        ->select(DB::raw('COUNT(idasistencia) as cant'))
        ->where ('fecha','=', $fecha)
        ->where('ac.idactividad','=',$id)
        ->first();
        }
        return view('asistencia.index',["actividades"=>$actividades, "asistencias"=>$asistencias, "fecha"=>$fecha, "cantidad"=>$cantidad, "id"=>$id]);
    }
}
