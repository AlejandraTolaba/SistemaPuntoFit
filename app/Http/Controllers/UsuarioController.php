<?php

namespace sisPuntoFit\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use sisPuntoFit\Http\Requests;
use DB;
use sisPuntoFit\Http\Requests\UsuarioFormRequest;
use sisPuntoFit\User;

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
        return view('usuarios.create');
		//return Redirect::to('usuarios');
	}

	public function edit($id)
	{
		return view("usuarios.edit",["usuario"=>User::findOrFail($id)]);
	}
	
	public function update(UsuarioFormRequest $request, $id)
	{
		$usuario = User::findOrFail($id);
		$usuario->name = $request->get('name');
		$usuario->email = $request->get('email');
		$usuario->tipo = $request->get('tipoUsuario');
		$usuario->password = bcrypt($request->get('password'));
		$usuario->update();
		return Redirect::to('usuarios');
	}
	
	public function destroy($id)
	{
		$usuario = User::findOrFail($id);
        $usuario->delete();
        flash("Se eliminó usuario")->success();
		return Redirect::to('usuarios');
	}
}
