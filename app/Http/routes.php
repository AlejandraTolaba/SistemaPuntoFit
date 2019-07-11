<?php
use Illuminate\Support\Facades\Input;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('layouts/admin');
});
Route::resource('actividad','ActividadController');
Route::resource('alumno','AlumnoController');
Route::get('alumno/inscripcion/create/{idalumno}','InscripcionController@create');
Route::post('alumno/inscripcion/create/{idalumno}','InscripcionController@store');

/* Route::resource('alumno/inscripcion','InscripcionController'); */

Route::get('dropdown',function(){
    $id=Input::get('option');
    $planes = DB::table('plan as p')
        ->join('plan_actividad as pa','pa.idplan','=','p.idplan')
        ->join('actividad as a','pa.idactividad','=','a.idactividad')
        ->where ('pa.idactividad','=',$id)
        ->lists ('p.nombre','precio');
    return $planes;
});