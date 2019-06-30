<?php

namespace sisPuntoFit\Http\Controllers;

use Illuminate\Http\Request;

use sisPuntoFit\Http\Requests;

use sisPuntoFit\Alumno; //(el modelo que vamos usar)
use Illuminate\Support\Facades\Redirect; //(para poder hacer redirecciones)
use Illuminate\Support\Facades\Input;
use sisPuntoFit\Http\Requests\AlumnoFormRequest; //(el request que vamos a usar)
use DB; //(QUE USAMOS LA BD QUE INDICAMOS EN .ENV)

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class AlumnoController extends Controller
{
    public function index(Request $request)
    {
    	if ($request) //si se creo el objeto request entonces
    	{
    	}

    }
    public function create()
	{
		return view("alumno.create");
	}

	public function store(AlumnoFormRequest $request)
	{
		$alumno = new Alumno;
        $alumno->nombre = $request->get('nombre');
        $alumno->apellido = $request->get('apellido');
        $alumno->dni = $request->get('dni');
        $mytime1 = Carbon::createFromFormat('Y-m-d',$request->get('fecha_nacimiento'));
        $alumno->fecha_nacimiento = $mytime1->toDateString();
        $alumno->sexo = $request->get('sexo');
        $alumno->domicilio = $request->get('domicilio');
        $alumno->telefono_celular = $request->get('telefono_celular');
        $alumno->numero_contacto = $request->get('numero_contacto');
        $alumno->email = $request->get('email');
        if ($request->get('certificado')==1){
            $alumno->certificado = $request->get('certificado');
            $mytime2 = Carbon::createFromFormat('Y-m-d',$request->get('fecha_certificado'));
            $alumno->fecha_certificado = $mytime2->toDateString();
        } else {
            $alumno->certificado = $request->get('certificado');
            $alumno->fecha_certificado = '1999-01-01';
        }
        $alumno->observaciones= $request->get('observaciones');
        $mytime3 = Carbon::now();
		$alumno->fecha_alta= $mytime3->toDateString();
		$alumno->estado = 'Activo';

        if ( $alumno->save())
        {
            $request->session()->flash('alert-success', 'El alumno se guardo exitosamente');
            return Redirect::to('alumno/'); //para redireccionar 

        }

        //


        
       
        
    }
    
    public function show($id) //recibe el parametro que es el id de la categoria que voy a retornar
    {
        //retorna una vista
    } //con la funcion findOrFail devuelvo solo la categoria que le mando como parametro

    public function edit($id)
    {

    }

    public function update(AlumnoFormRequest $request,$id)
    {
    	
    }

    public function destroy($id)
    {
    
    }
}
