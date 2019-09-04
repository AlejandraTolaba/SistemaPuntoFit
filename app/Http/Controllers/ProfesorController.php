<?php

namespace sisPuntoFit\Http\Controllers;

use Illuminate\Http\Request;

use sisPuntoFit\Http\Requests;

use sisPuntoFit\Profesor; //(el modelo que vamos usar)
use Illuminate\Support\Facades\Redirect; //(para poder hacer redirecciones)
use Illuminate\Support\Facades\Input;
use sisPuntoFit\Http\Requests\ProfesorFormRequest; //(el request que vamos a usar)
use DB; //(QUE USAMOS LA BD QUE INDICAMOS EN .ENV)
use Image;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class ProfesorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

	protected function random_string()
    {
        $key = '';
        $keys = array_merge( range('a','z'), range(0,9) );
        for($i=0; $i<10; $i++){
            $key .= $keys[array_rand($keys)];
        }
        return $key;
    }

    public function create()
	{
		return view("profesor.create");
	}

	public function store(ProfesorFormRequest $request)
	{
		$profesor = new Profesor;
        $profesor->nombre = $request->get('nombrea');
        $profesor->apellido = $request->get('apellido');
        $img = $request->get('fotocamara');
        // Para guardar la foto del alumno en la carpeta public/imagenes/alumnos
        if ($img!=""){
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $image = base64_decode($img);
            $temp_name = $this->random_string();
            $extension="png";
            $nombrefoto=$temp_name.date('Y-m-d').'.'.$extension; 
            Image::make($image)->resize(144,144)->save(public_path('/imagenes/profesores/'.$nombrefoto));
            $profesor->foto=$nombrefoto;
        } else {
            $profesor->foto=$img;
        }
        //ya se guardo la foto
        $profesor->dni = $request->get('dni');
        $mytime1 = Carbon::createFromFormat('Y-m-d',$request->get('fecha_nacimiento'));
        $profesor->fecha_nacimiento = $mytime1->toDateString();
        $profesor->sexo = $request->get('sexo');
        $profesor->domicilio = $request->get('domicilio');
        $profesor->telefono_celular = $request->get('telefono_celular');
        $profesor->numero_contacto = $request->get('numero_contacto');
        $profesor->email = $request->get('email');
        $mytime3 = Carbon::now();
		$profesor->fecha_alta= $mytime3->toDateString();
		$profesor->estado = 'Activo';
		//$profesor->save();

        if ( $profesor->save())
        {
            flash("El profesor se guardo exitosamente")->success();
            return Redirect::to('profesor/');  
        } 
    }

    public function index(Request $request)
    {
    	if ($request) 
    	{
            $query=trim($request->get('searchText'));
            $profesores=DB::table('profesor')
            ->select('idprofesor','foto',DB::raw('CONCAT(nombre," ",apellido)as profesor'), 'dni', 'telefono_celular', 'estado')
            ->where(DB::raw('CONCAT(nombre," ",apellido)'),'LIKE','%'.$query.'%')
            ->orwhere('dni','LIKE','%'.$query.'%')
            ->orderBy('idprofesor','desc')
            ->paginate(10);
            return view('profesor.index',["profesores"=>$profesores,"searchText"=>$query]);
    	}
    }

    public function edit($id)
	{
		return view("profesor.edit",["profesor"=>Profesor::findOrFail($id)]);
    }
    
    public function update(ProfesorFormRequest $request, $id)
	{
        $profesor =Profesor::findOrFail($id);
        $profesor->nombre = $request->get('nombrea');
        $profesor->apellido = $request->get('apellido');
        $img = $request->get('fotocamara');
        // Para guardar la foto del alumno en la carpeta public/imagenes/alumnos
        if ($img!=""){
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $image = base64_decode($img);
            $temp_name = $this->random_string();
            $extension="png";
            $nombrefoto=$temp_name.date('Y-m-d').'.'.$extension; 
            Image::make($image)->resize(144,144)->save(public_path('/imagenes/profesores/'.$nombrefoto));
            $profesor->foto=$nombrefoto;
        } else {
            $profesor->foto=$profesor->foto;
        }
        $profesor->dni = $request->get('dni');
        $mytime1 = Carbon::createFromFormat('Y-m-d',$request->get('fecha_nacimiento'));
        $profesor->fecha_nacimiento = $mytime1->toDateString();
        $profesor->sexo = $request->get('sexo');
		$profesor->domicilio = $request->get('domicilio');
		$profesor->telefono_celular = $request->get('telefono_celular');
		$profesor->numero_contacto = $request->get('numero_contacto');
        $profesor->email = $request->get('email');
        //$alumno->update();
        if ( $profesor->update())
        {
            flash("Los cambios se guardaron exitosamente")->success();
            return Redirect::to('profesor/'); //para redireccionar 
        } 
    }
    
    public function show($id) 
    {
        $profesor = Profesor::findOrFail($id);
		return view("profesor.show",['profesor'=>$profesor]);
    } 
}
