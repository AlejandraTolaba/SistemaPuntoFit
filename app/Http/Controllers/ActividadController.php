<?php

namespace sisPuntoFit\Http\Controllers;

use Illuminate\Http\Request;

use sisPuntoFit\Http\Requests;

use sisPuntoFit\Actividad;
use sisPuntoFit\PlanActividad;


use Illuminate\Support\Facades\Redirect;
use sisPuntoFit\Http\Requests\ActividadFormRequest;

use DB;
use Illuminate\Support\Collection;
use Carbon\Carbon;

class ActividadController extends Controller
{
    public function __construct()
    {
    }
    public function index(Request $request)
    {
        if ($request)
        {
            $query=trim($request->get('searchText')); //filtro de busqueda
            $actividades=DB::table('actividad as a')
            ->select('a.idactividad','a.nombre',DB::RAW('(select count(idinscripcion) from inscripcion as i where a.idactividad=i.idactividad and i.estado="Activa") as cantidad_i_activas'),'a.estado')
            ->where('a.nombre','LIKE','%'.$query.'%')
            //->where('a.estado','=','Activa')
            ->orderBy('idactividad','desc')
            ->paginate(10);
            
            return view('actividad.index',["actividades"=>$actividades,"searchText"=>$query]);

        }
    }
    public function create()
    {
        $planes=DB::table('plan')->get();
        return view('actividad.create',["planes"=>$planes]);
    }
    public function store(ActividadFormRequest $request)
    {
        DB::beginTransaction();
        $actividad= new Actividad;
        $actividad->nombre = $request->get('nombre');
        $actividad->estado = 'Activa';
        $actividad->save();
        $id_actividad=$actividad->idactividad;
        
        $idplan=$request->get('plan');
        $precio=$request->get('precio');
        
           
        //+++++++++++++INICIAMOS CAPTURA DE VARIABLES ARREGLO[]//++++++++++++++

        $cont = 0;

        while ( $cont < count($idplan) ) {
            $plan_actividad = new PlanActividad();
            $plan_actividad->idactividad = $id_actividad; //le asignamos el id de la actividad a la que pertenece el plan
            $plan_actividad->idplan=$idplan[$cont];
            $plan_actividad->precio=$precio[$cont];
            $plan_actividad->save();
            $cont = $cont+1;

        }
        
        DB::commit();
        //return Redirect::to('actividad'); 
    }

    public function show($id)
    {
        
    }

    public function edit($id)
    {
        $actividad=Actividad::findOrFail($id);

        $planes=DB::table('plan')->get();

        $plan_actividad=DB::table('plan_actividad as pa')
        ->join('plan as p','pa.idplan','=','p.idplan')
        ->select('pa.idplan','p.nombre as plan','p.cantidad_clases as cantidad','pa.precio')
        ->where('pa.idactividad','=',$id)->get();

        return view('actividad.edit',["actividad"=>$actividad,"planes"=>$planes,"plan_actividad"=>$plan_actividad]);
    }

    public function update(Request $request,$id)
    {
        DB::beginTransaction();
        $idplan=$request->get('plan');
        $precio=$request->get('precio');
        
        DB::table('plan_actividad')->where('idactividad','=',$id)->delete();
        
        $cont = 0;
        while ( $cont < count($idplan) ) {
            $plan_actividad = new PlanActividad();
            $plan_actividad->idactividad = $id;
            $plan_actividad->idplan=$idplan[$cont];
            $plan_actividad->precio=$precio[$cont];
            $plan_actividad->save();
            $cont = $cont+1;
        }
        flash("Los cambios se realizaron con éxito")->success();
        DB::commit();
    }

    public function destroy($id)
    {
        $actividad=Actividad::findOrFail($id);
    	$actividad->estado='Inactiva';
    	$actividad->update();
    	return Redirect::to('actividad/');
    }

    public function mostrarInscripcionesPorActividad($id){
        $desde=Carbon::now()->toDateString();
        $hasta=Carbon::now()->toDateString();
        $actividad=Actividad::findOrFail($id);
        $inscripciones=DB::table('inscripcion as i')
        ->join('plan as p','i.idplan','=','p.idplan')
        ->join('alumno as al','i.idalumno','=','al.idalumno')
        ->join('actividad as a','i.idactividad','=','a.idactividad')
        ->select('i.idinscripcion',DB::raw('CONCAT(al.nombre," ",al.apellido) as alumno'),'p.nombre as plan','fecha_inscripcion','i.estado','a.nombre as actividad')
        ->where ('i.idactividad','=', $id)
        ->orderBy('idinscripcion','desc')
        ->get();
        return view('actividad.mostrarInscripciones',["inscripciones"=>$inscripciones,"actividad"=>$actividad,"desde"=>$desde,"hasta"=>$hasta]);
    }

    public function mostrarInscripcionesPorActividadDesdeHasta(Request $request,$id){
        $desde=Carbon::createFromFormat('Y-m-d',$request->get('desde'))->toDateString();
        $hasta=Carbon::createFromFormat('Y-m-d',$request->get('hasta'))->toDateString();
        $actividad=Actividad::findOrFail($id);

        $inscripciones=DB::table('inscripcion as i')
        ->join('plan as p','i.idplan','=','p.idplan')
        ->join('alumno as al','i.idalumno','=','al.idalumno')
        ->join('actividad as a','i.idactividad','=','a.idactividad')
        ->select('i.idinscripcion',DB::raw('CONCAT(al.nombre," ",al.apellido) as alumno'),'p.nombre as plan','fecha_inscripcion','i.estado','a.nombre as actividad')
        ->where ('i.idactividad','=', $id)
        ->whereBetween('fecha_inscripcion',[$desde,$hasta])
        ->orderBy('idinscripcion','desc')
        ->get();
        return view('actividad.mostrarInscripciones',["inscripciones"=>$inscripciones,"actividad"=>$actividad,"desde"=>$desde,"hasta"=>$hasta]);
    }
}
