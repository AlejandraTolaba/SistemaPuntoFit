<?php

namespace sisPuntoFit\Http\Controllers;

use Illuminate\Http\Request;

use sisPuntoFit\Http\Requests;

use Carbon\Carbon;
use sisPuntoFit\FichaControl;
use sisPuntoFit\Alumno;
use Illuminate\Support\Facades\Redirect; //(para poder hacer redirecciones)
use Illuminate\Support\Facades\Input;
use sisPuntoFit\Http\Requests\FichaFormRequest;
use Illuminate\Support\Collection;

use DB;

class FichaControlController extends Controller
{
    public function create($idalumno)
	{
        $alumno =Alumno::findOrFail($idalumno);
		return view('alumno.fichaControlCorporal.create',["alumno"=>$alumno]);
    }

    public function store(FichaFormRequest $request, $idalumno)
	{
        DB::beginTransaction();
        $ficha = new FichaControl;
        $ficha->idalumno=$idalumno;
        $mytime = Carbon::now();
        $ficha->fecha_registro= $mytime->toDateString();
        $ficha->peso = $request->get('peso');
        $ficha->imc = $request->get('imc');
        $ficha->edad_corporal = $request->get('edad_corporal');
        $ficha->grasa_corporal = $request->get('grasa_corporal');
        $ficha->imm = $request->get('imm');
        $ficha->mb = $request->get('mb');
        $ficha->grasa_viceral = $request->get('grasa_viceral');

        $ficha->save();
        DB::commit();
        
        if ( $ficha->save())
        {
            flash("La ficha de control corporal se guardo exitosamente")->success();
            return Redirect::back(); //para redireccionar 
        }
    }

}
