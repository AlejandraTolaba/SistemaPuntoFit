<?php

namespace sisPuntoFit\Http\Controllers;

use Illuminate\Http\Request;

use sisPuntoFit\Http\Requests;

use Illuminate\Support\Facades\Redirect; 
use DB; 

use Carbon\Carbon;
use Illuminate\Support\Collection;

class CumpleañosController extends Controller
{
    public function mostrarCumpleañeros()
    {
            $cumpleañerosA=DB::table('alumno')
            ->select('idalumno',DB::raw('CONCAT(nombre," ",apellido)AS alumno'), DB::raw('YEAR(CURDATE())-YEAR(fecha_nacimiento) as edad'), 'foto')
            ->where(DB::raw('date_format(fecha_nacimiento,"%m-%d")'),'=',DB::raw('date_format(now(),"%m-%d")'))
            ->get();
            $cumpleañerosP=DB::table('profesor')
            ->select('idprofesor',DB::raw('CONCAT(nombre," ",apellido)as profesor'), DB::raw('YEAR(CURDATE())-YEAR(fecha_nacimiento) as edad'), 'foto')
            ->where(DB::raw('date_format(fecha_nacimiento,"%m-%d")'),'=',DB::raw('date_format(now(),"%m-%d")'))
            ->get();
            return view("cumpleaños.mostrarCumpleañeros",["cumpleañerosA"=>$cumpleañerosA,"cumpleañerosP"=>$cumpleañerosP]);
    }
}
