<?php

namespace sisPuntoFit\Http\Controllers;

use Illuminate\Http\Request;

use sisPuntoFit\Http\Requests;

use sisPuntoFit\Plan;
use Illuminate\Support\Facades\Redirect;
use sisPuntoFit\Http\Requests\PlanFormRequest;
use DB;

class PlanController extends Controller
{
    /* public function create()
    {
        return view('actividad/plan/create');
    } */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function store(PlanFormRequest $request)
    {
        DB::beginTransaction();
        $plan= new Plan;
        $plan->nombre = $request->get('nombre');
        $plan->cantidad_clases = $request->get('cantidad_clases');
        $plan->save();
        DB::commit();

        return $plan->idplan;
       /*  return view('actividad.create',["plane"=>$plane->idplan]); */
         
    }
}
