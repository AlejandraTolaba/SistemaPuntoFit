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
            //return Redirect::back(); //para redireccionar 

            $alumno= DB::table('alumno as a')
            ->select('a.idalumno', DB::raw('CONCAT(a.nombre," ",a.apellido) as nombrecompleto'),'foto')
            ->where('a.idalumno','=',$idalumno)->first();
                
            $fichas=DB::table('ficha_control as f')
            ->select('idficha_control as idficha','fecha_registro as fecha','peso','edad_corporal','imc','grasa_corporal','imm','mb','grasa_viceral')
            ->where ('f.idalumno','=', $ficha->idalumno)
            ->orderBy('fecha_registro','desc')
            ->paginate(10);
        
            return view('alumno.fichaControlCorporal.index',["fichas"=>$fichas,"alumno"=>$alumno]);
        }
    }

    public function index($idalumno)
    {
        $alumno= DB::table('alumno as a')
        ->select('a.idalumno', DB::raw('CONCAT(a.nombre," ",a.apellido) as nombrecompleto'),'foto')
        ->where('a.idalumno','=',$idalumno)->first();
            
        $fichas=DB::table('ficha_control as f')
        ->select('idficha_control as idficha','fecha_registro as fecha','peso','edad_corporal','imc','grasa_corporal','imm','mb','grasa_viceral')
        ->where ('f.idalumno','=', $idalumno)
        ->orderBy('fecha_registro','desc')
        ->paginate(10);
    
        return view('alumno.fichaControlCorporal.index',["fichas"=>$fichas,"alumno"=>$alumno]);

    }

    public function edit($idficha)
	{
        $ficha =FichaControl::findOrFail($idficha);
        $alumno = Alumno::find($ficha->idalumno);
		return view('alumno.fichaControlCorporal.edit',["ficha"=>$ficha, "alumno"=>$alumno]);
    }

    public function update(FichaFormRequest $request, $id)
	{
        $ficha = FichaControl::findOrFail($id);
        $ficha->peso = $request->get('peso');
        $ficha->imc = $request->get('imc');
        $ficha->edad_corporal = $request->get('edad_corporal');
        $ficha->grasa_corporal = $request->get('grasa_corporal');
        $ficha->imm = $request->get('imm');
        $ficha->mb = $request->get('mb');
        $ficha->grasa_viceral = $request->get('grasa_viceral');
        if ( $ficha->update())
        {
            flash("Los cambios se guardaron exitosamente")->success();
            return Redirect::to('alumno/fichaControlCorporal/'.$ficha->idalumno);
        } 
    }

}
