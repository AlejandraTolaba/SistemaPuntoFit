<?php

namespace sisPuntoFit\Http\Controllers;

use Illuminate\Http\Request;

use sisPuntoFit\Http\Requests;

use sisPuntoFit\Alumno; //(el modelo que vamos usar)
use Illuminate\Support\Facades\Redirect; //(para poder hacer redirecciones)
use Illuminate\Support\Facades\Input;
use sisPuntoFit\Http\Requests\AlumnoFormRequest; //(el request que vamos a usar)
use DB; //(QUE USAMOS LA BD QUE INDICAMOS EN .ENV)
use Image;

//composer require intervention/image
// en providers: Intervention\Image\ImageServiceProvider::class,
// en aliases: 'Image' => Intervention\Image\Facades\Image::class,

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class AlumnoController extends Controller
{
    protected function random_string()
    {
        $key = '';
        $keys = array_merge( range('a','z'), range(0,9) );
        for($i=0; $i<10; $i++){
            $key .= $keys[array_rand($keys)];
        }
        return $key;
    }

    public function index(Request $request)
    {
    	if ($request) 
    	{
            $query=trim($request->get('searchText'));
            $alumnos=DB::table('alumno as a')
            ->select('idalumno',DB::raw('CONCAT(a.nombre," ",a.apellido)AS alumno'), 'a.dni', 'a.telefono_celular', 'a.estado', 'a.saldo')
            ->where(DB::raw('CONCAT(nombre," ",apellido)'),'LIKE','%'.$query.'%') 
            /* ->where('nombre','LIKE','%'.$query.'%')
            ->orwhere('apellido','LIKE','%'.$query.'%') */
            ->orwhere('dni','LIKE','%'.$query.'%')
            ->orderBy('idalumno','desc')
            ->paginate(10);
        
            return view('alumno.index',["alumnos"=>$alumnos,"searchText"=>$query]);
    	}

    }
    public function create()
	{
		return view("alumno.create");
	}

	public function store(AlumnoFormRequest $request)
	{
		$alumno = new Alumno;
        $alumno->nombre = $request->get('nombrea');
        $alumno->apellido = $request->get('apellido');
        $img = $request->get('fotocamara');
        // Para guardar la foto del alumno en la carpeta public/imagenes/alumnos
        if ($img!=""){
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $image = base64_decode($img);
            $temp_name = $this->random_string();
            $extension="png";
            $nombrefoto=$temp_name.date('Y-m-d').'.'.$extension; 
            Image::make($image)->resize(144,144)->save(public_path('/imagenes/alumnos/'.$nombrefoto));
            $alumno->foto=$nombrefoto;
        } else {
            $alumno->foto=$img;
        }
        //ya se guardo la foto
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
        $alumno->rutina= $request->get('rutina');
        $mytime3 = Carbon::now();
		$alumno->fecha_alta= $mytime3->toDateString();
        $alumno->estado = 'Activo';
        $alumno->saldo = 0;

        if ( $alumno->save())
        {
            flash("El alumno se guardo exitosamente")->success();
            return Redirect::to('alumno/'); //para redireccionar 
        } 
        
    }
    
    public function show($id) //recibe el parametro que es el id de la categoria que voy a retornar
    {
        $alumno = Alumno::findOrFail($id);
		//->first();
		return view("alumno.show",['alumno'=>$alumno]);
        //retorna una vista
    } //con la funcion findOrFail devuelvo solo la categoria que le mando como parametro

    public function edit($id)
	{
		return view("alumno.edit",["alumno"=>Alumno::findOrFail($id)]);
	}

	public function update(AlumnoFormRequest $request, $id)
	{
        $alumno =Alumno::findOrFail($id);
        $alumno->nombre = $request->get('nombrea');
        $alumno->apellido = $request->get('apellido');
        $img = $request->get('fotocamara');
        // Para guardar la foto del alumno en la carpeta public/imagenes/alumnos
        if ($img!=""){
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $image = base64_decode($img);
            $temp_name = $this->random_string();
            $extension="png";
            $nombrefoto=$temp_name.date('Y-m-d').'.'.$extension; 
            Image::make($image)->resize(144,144)->save(public_path('/imagenes/alumnos/'.$nombrefoto));
            $alumno->foto=$nombrefoto;
        } else {
            $alumno->foto=$alumno->foto;
        }
        $alumno->dni = $request->get('dni');
        $mytime1 = Carbon::createFromFormat('Y-m-d',$request->get('fecha_nacimiento'));
        $alumno->fecha_nacimiento = $mytime1->toDateString();
        $alumno->sexo = $request->get('sexo');
		$alumno->domicilio = $request->get('domicilio');
		$alumno->telefono_celular = $request->get('telefono_celular');
		$alumno->numero_contacto = $request->get('numero_contacto');
        $alumno->email = $request->get('email');
        $alumno->certificado = $request->get('certificado');
        $alumno->fecha_certificado = $request->get('fecha_certificado');
        $alumno->observaciones= $request->get('observaciones');
        $alumno->rutina= $request->get('rutina');
        $alumno->update();

        if ( $alumno->update())
        {
            flash("Los cambios se guardaron exitosamente")->success();
            return Redirect::to('alumno/'); //para redireccionar 
        } 
        //return Redirect::to('alumno');
	}

    public function destroy($id)
    {
    
    }
}
