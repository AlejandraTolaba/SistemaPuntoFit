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
            $actividades=DB::table('actividad')->where('nombre','LIKE','%'.$query.'%')
            ->where('estado','=','Activa')
            ->orderBy('idactividad','desc')
            ->paginate(10);
            
            return view('actividad.index',["actividades"=>$actividades,"searchText"=>$query]);

        }
    }
    public function create()
    {
        return view('actividad.create');
    }
    public function store(ActividadFormRequest $request)
    {
        DB::beginTransaction();
        $actividad= new Actividad;
        $actividad->nombre = $request->get('nombre');
        $actividad->estado = 'Activa';
        $actividad->save();

        
        $id_actividad=$actividad->idactividad;
        
		if($request->has('check1')){
            $plan_actividad1 = new PlanActividad();
			$plan_actividad1->idactividad = $id_actividad;
			$plan_actividad1->idplan=1;
			$plan_actividad1->precio=$request->get('precio1');
			$plan_actividad1->save();
		}
		if($request->has('check2')){
            
            $plan_actividad2 = new PlanActividad();
            $plan_actividad2->idactividad = $id_actividad;
			$plan_actividad2->idplan=2;
			$plan_actividad2->precio=$request->get('precio2');
			$plan_actividad2->save();
        }
        if($request->has('check3')){
            $plan_actividad3 = new PlanActividad();
			$plan_actividad3->idactividad = $id_actividad;
			$plan_actividad3->idplan=3;
			$plan_actividad3->precio=$request->get('precio3');
			$plan_actividad3->save();
		}
		if($request->has('check4')){
            $plan_actividad4 = new PlanActividad();
			$plan_actividad4->idactividad = $id_actividad;
			$plan_actividad4->idplan=4;
			$plan_actividad4->precio=$request->get('precio4');
			$plan_actividad4->save();
		}

        DB::commit();
        return Redirect::to('actividad'); 
    }

    public function show($id)
    {
        
    }

    public function edit($id)
    {
        
    }

    public function update(ActividadFormRequest $request,$id)
    {
       
    }

    public function destroy($id)
    {
        
    }
}
