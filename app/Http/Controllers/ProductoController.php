<?php

namespace sisPuntoFit\Http\Controllers;

use Illuminate\Http\Request;

use sisPuntoFit\Http\Requests;

use sisPuntoFit\Producto;
use sisPuntoFit\Http\Requests\ProductoFormRequest;
use Illuminate\Support\Facades\Redirect;
use DB;
use Illuminate\Support\Collection as Collection;

class ProductoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function create()
	{
        $codigo = DB::table('producto')
        ->select(DB::raw('max(idproducto) as cod'))
        ->first();
        if ($codigo->cod ==NULL){
            $codigo->cod = 1;
        }
        else{
            $codigo->cod = $codigo->cod +1;
        }
        return view('producto.create',["codigo"=>$codigo]);
    }

    public function store(ProductoFormRequest $request)
	{
        DB::beginTransaction();
            $producto = new Producto;
            $producto->nombre = $request->get('nombre');
            $producto->stock = $request->get('stock');
            $producto->precio = $request->get('precio');
        DB::commit();
        
        if ( $producto->save())
        {
            flash("El producto se guardo exitosamente")->success();

            return Redirect::to('producto/');
        }
    }

    public function index(Request $request)
    {
    	if ($request) 
    	{
            $query=trim($request->get('searchText'));
            $productos=DB::table('producto as p')
            ->select('idproducto', 'nombre', 'precio', 'stock')
            ->where('nombre','LIKE','%'.$query.'%') 
            ->orwhere('idproducto','LIKE','%'.$query.'%')
            ->orderBy('idproducto','desc')
            ->paginate(15);
            return view('producto.index',["productos"=>$productos,"searchText"=>$query]);
    	}
    }

    public function edit($idproducto)
    {
        $producto = Producto::findOrFail($idproducto);
        return view('producto.edit',["producto"=>$producto]);
    }

    public function update(Request $request, $id)
	{
        $this->validate($request,[
            'stock'=>'required',
            'precio'=>'required',
          ]);
        $producto = Producto::findOrFail($id);
        $producto->precio = $request->get('precio');
        $producto->stock = $request->get('stock');
        if ( $producto->update())
        {
            flash("Los cambios se guardaron exitosamente")->success();
            return Redirect::to('producto/');
        } 
    }

    public function destroy($id)
	{
		$producto = Producto::findOrFail($id);
        $producto->delete();
        flash("Se eliminó el producto")->success();
		return Redirect::to('producto');
	}
}
