<?php

namespace sisPuntoFit\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use sisPuntoFit\Http\Requests;
use DB;
use sisPuntoFit\Http\Requests\UsuarioFormRequest;
use sisPuntoFit\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UsuarioController extends Controller
{
    public function index(Request $request)
	{
		if($request)
		{
			$query=trim($request->get('searchText'));
			$usuarios=DB::table('users')->where('name', 'LIKE', '%'.$query.'%')
			->orderBy('id','desc')
			->paginate(7);
			return view('usuarios.index',["usuarios"=>$usuarios, "searchText"=>$query]);
		}
	}

	public function create()
	{
		return view('usuarios.create');
	}

	public function store(UsuarioFormRequest $request)
	{
		$usuario = new User;
		$usuario->name = $request->get('name');
		$usuario->email = $request->get('email');
		$usuario->tipo = $request->get('tipoUsuario');
		$usuario->password = bcrypt($request->get('password'));
        $usuario->save();
        flash("El usuario se guardo exitosamente")->success();
		return Redirect::to('usuarios');
	}
	public function edit($id){
		$user = User::findOrFail($id);
		return view('usuarios.modificarContraseña',["user"=>$user]);
	}
	
	public function update(Request $request, $id)
	{
		$this->validate($request,[
			'password'=>'required',
            'newpassword'=> 'required|confirmed',
		]);
		if(Hash::check($request->password,Auth::user()->password)){
			$user=\Auth::user();
			$user->password=bcrypt($request->newpassword);
		   $user->update();
		   flash("Su contraseña se ha cambiado correctamente ")->success()->important();
		   return view('usuarios.modificarContraseña',["user"=>$user]);
		} else {
			flash("La contraseña no coincide con la actual")->error()->important();
			return Redirect::back();
		}
	}
	
	public function destroy($id)
	{
		$user = User::findOrFail($id);
        $user->delete();
        flash("Se eliminó usuario")->success();
		return Redirect::to('usuarios');
	}

}
