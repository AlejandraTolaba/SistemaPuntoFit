<?php

namespace sisPuntoFit\Http\Controllers;

use Illuminate\Http\Request;

use sisPuntoFit\Http\Requests;

use sisPuntoFit\Movimiento;
use Illuminate\Support\Facades\Redirect; 
use sisPuntoFit\Http\Requests\MovimientoFormRequest;
use DB;
use Carbon\Carbon;

class MovimientoController extends Controller
{
    public function index()
    {
        $desde=Carbon::now()->toDateString();
        $hasta=Carbon::now()->toDateString();
        $movimientos=DB::table('movimiento_de_caja as m')
        ->join('forma_de_pago as f','m.idforma_de_pago','=','f.idforma_de_pago')
        ->select('concepto','fecha','hora','tipo','f.nombre as forma','monto')
        ->where ('fecha','=',DB::raw('CURDATE()'))
        ->orderBy('idmovimientodecaja','desc')
        ->paginate(20);
        $totalIngreso=DB::table('movimiento_de_caja as m')
        ->select(DB::raw('ifnull(sum(monto),0) as totalIngreso'))
        ->where('idforma_de_pago','=',1)
        ->where('tipo','=','INGRESO')
        ->where ('fecha','=',DB::raw('CURDATE()'))
        ->first();
        $totalEgreso=DB::table('movimiento_de_caja as m')
        ->select(DB::raw('ifnull(sum(monto),0) as totalEgreso'))
        ->where('idforma_de_pago','=',1)
        ->where('tipo','=','EGRESO')
        ->where ('fecha','=',DB::raw('CURDATE()'))
        ->first();
        $total=$totalIngreso->totalIngreso-$totalEgreso->totalEgreso;
        //dd($total);
        return view('movimiento.index',["movimientos"=>$movimientos,"desde"=>$desde,"hasta"=>$hasta,"totalIngreso"=>$totalIngreso,"totalEgreso"=>$totalEgreso,"total"=>$total]);
    }
    public function create()
    {
        $formas_de_pago = DB::table('forma_de_pago')->get();
        return view('movimiento.create',["formas_de_pago"=>$formas_de_pago]);
    }
    public function store(MovimientoFormRequest $request)
    {   
        $movimiento= new Movimiento();
        $movimiento->concepto= $request->get("concepto");
        $movimiento->tipo=$request->get("tipo");
        $movimiento->idforma_de_pago= $request->get("idforma_de_pago");
        $movimiento->monto=$request->get("monto");
        $movimiento->fecha=$request->get("fecha");
        if($movimiento->save()){
            flash("Se registro movimiento exitosamente")->success();
            return Redirect::to('movimiento');
        }
    }
    public function mostrarMovimientosDesdeHasta(Request $request){
        $desde=Carbon::createFromFormat('Y-m-d',$request->get('desde'))->toDateString();
        $hasta=Carbon::createFromFormat('Y-m-d',$request->get('hasta'))->toDateString();
        $movimientos=DB::table('movimiento_de_caja as m')
        ->join('forma_de_pago as f','m.idforma_de_pago','=','f.idforma_de_pago')
        ->select('concepto','fecha','hora','tipo','f.nombre as forma','monto')
        ->whereBetween('fecha',[$desde,$hasta])
        ->orderBy('idmovimientodecaja','desc')
        ->paginate(20);
        $totalIngreso=DB::table('movimiento_de_caja as m')
        ->select(DB::raw('ifnull(sum(monto),0) as totalIngreso'))
        ->where('idforma_de_pago','=',1)
        ->where('tipo','=','INGRESO')
        ->whereBetween('fecha',[$desde,$hasta])
        ->first();
        $totalEgreso=DB::table('movimiento_de_caja as m')
        ->select(DB::raw('ifnull(sum(monto),0) as totalEgreso'))
        ->where('idforma_de_pago','=',1)
        ->where('tipo','=','EGRESO')
        ->whereBetween('fecha',[$desde,$hasta])
        ->first();
        $total=$totalIngreso->totalIngreso-$totalEgreso->totalEgreso;
        return view('movimiento.index',["movimientos"=>$movimientos,"desde"=>$desde,"hasta"=>$hasta,"totalIngreso"=>$totalIngreso,"totalEgreso"=>$totalEgreso,"total"=>$total]);
    }

    public function crearReporteMovimientos(Request $request){
        $desde=Carbon::createFromFormat('Y-m-d',$request->get('desde'))->toDateString();
        $hasta=Carbon::createFromFormat('Y-m-d',$request->get('hasta'))->toDateString();

        $movimientos=DB::table('movimiento_de_caja as m')
        ->join('forma_de_pago as f','m.idforma_de_pago','=','f.idforma_de_pago')
        ->select('concepto','fecha','hora','tipo','f.nombre as forma','monto')
        ->whereBetween('fecha',[$desde,$hasta])
        ->orderBy('idmovimientodecaja','desc')
        ->paginate(20);
        $totalIngreso=DB::table('movimiento_de_caja as m')
        ->select(DB::raw('ifnull(sum(monto),0) as totalIngreso'))
        ->where('idforma_de_pago','=',1)
        ->where('tipo','=','INGRESO')
        ->whereBetween('fecha',[$desde,$hasta])
        ->first();
        $totalEgreso=DB::table('movimiento_de_caja as m')
        ->select(DB::raw('ifnull(sum(monto),0) as totalEgreso'))
        ->where('idforma_de_pago','=',1)
        ->where('tipo','=','EGRESO')
        ->whereBetween('fecha',[$desde,$hasta])
        ->first();

        $vistaurl="movimiento.reporte";
 
        //$date = date('Y-m-d');
        $view= \View::make($vistaurl,compact('movimientos','totalEgreso','totalIngreso','desde','hasta'))->render();
        $pdf=\App::make('dompdf.wrapper');
        $pdf->loadHTML($view);

        return $pdf->stream();
    }
}
