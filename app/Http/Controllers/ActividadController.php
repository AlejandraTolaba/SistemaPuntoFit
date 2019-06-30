<?php

namespace sisPuntoFit\Http\Controllers;

use Illuminate\Http\Request;

use sisPuntoFit\Http\Requests;

use sisPuntoFit\Actividad;
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
            ->where('estado','=','activa')
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
        $actividad= new Actividad;
        $actividad->nombre = $request->get('nombre');
        $actividad->estado = 'activa';
        $actividad->save();
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
