<?php

namespace sisPuntoFit\Http\Controllers;

use Illuminate\Http\Request;

use sisPuntoFit\Http\Requests;
use DB;
use Carbon\Carbon;
use sisPuntoFit\Movimiento;
use sisPuntoFit\Producto;
use Illuminate\Support\Facades\Redirect;

class VentaController extends Controller
{
    public function create()
	{
        $productos = DB::table('producto as p')->where('stock','>',0)->get();
        $formas_de_pago = DB::table('forma_de_pago')->get();
		return view('venta.create',["productos"=>$productos, "formas_de_pago"=>$formas_de_pago]);
    }
    public function store(Request $request)
    {   
        $producto = $request->get('producto'); 
        $total=$request->get("total");
        $cantidad=$request->get('cantidad');
        //dd($producto);
        if ($producto!=0 && $total!="" && $cantidad!=""){
            $pos=strpos($producto,'_'); //busco la posición del guion bajo
            $id_prod=substr($producto,0, $pos); //obtengo el id del producto elegido
            $p = Producto::findOrFail($id_prod);
            $p->stock=(int)$p->stock - (int)$request->get("cantidad");
            $p->update();
            $movimiento= new Movimiento();
            $movimiento->concepto= " VENTA DE ".$p->nombre." - CANTIDAD: ".$request->get("cantidad");
            $movimiento->tipo="INGRESO";
            $movimiento->idforma_de_pago= $request->get("idforma_de_pago");
            $movimiento->monto=$request->get("total");
            $movimiento->fecha=Carbon::now()->toDateString();
            if($movimiento->save()){
                flash("Se registro venta exitosamente")->success();
            }
        } else {
            flash("Debe seleccionar un producto")->error()->important();
        }
    }
}
