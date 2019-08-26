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
    return view('asistencia.buscar');
});

Route::resource('actividad','ActividadController');
Route::resource('alumno','AlumnoController');

Route::resource('profesor','ProfesorController');

Route::get('alumno/inscripcion/create/{idalumno}','InscripcionController@create');
Route::post('alumno/inscripcion/create/{idalumno}','InscripcionController@store');
Route::get('alumno/inscripcion/{idalumno}','InscripcionController@index');

Route::post('actividad/plan/create','PlanController@create');
Route::post('actividad/plan/create','PlanController@store');

Route::post('actividad/create','ActividadController@store');

Route::get('asistencia','InscripcionController@buscar');
Route::get('asistencia/mostrarAlumno','InscripcionController@mostrarAlumno');
Route::get('asistencia/cambiarCantidad/{idinscripcion}','InscripcionController@updateCantidad');

Route::get('alumno/fichaControlCorporal/create/{idalumno}','FichaControlController@create');
Route::post('alumno/fichaControlCorporal/create/{idalumno}','FichaControlController@store');

Route::get('dropdown', function(){
	$id = Input::get('option');
	//dd($id);
	$planes = DB::table('plan as p')
			->join('plan_actividad as pa','pa.idplan','=','p.idplan')
			->join('actividad as a','pa.idactividad','=','a.idactividad')
			->where ('pa.idactividad','=', $id)
			->lists('p.nombre', DB::raw('CONCAT(p.idplan,"_",precio) as plan'));
	return $planes;
	//dd($planes);
});

Route::get('dropdown2', function(){
	$id = Input::get('option');
	$asistencias = DB::table('asistencia as a')
		->join('inscripcion as i','a.idinscripcion','=','i.idinscripcion')
		->join('actividad as ac','ac.idactividad','=','i.idactividad')
		->join('alumno as al','al.idalumno','=','i.idalumno')
		->orderBy('al.nombre')
		->where ('ac.idactividad','=', $id)
		->where ('a.fecha','=', DB::raw('curdate()'))
		->lists('al.idalumno',DB::raw('CONCAT(al.nombre," ",al.apellido)AS alu'));
	return $asistencias;
});

Route::get('dropdown3', function(){
	$id = Input::get('option');
	$cantidad = DB::table('asistencia as a')
		->join('inscripcion as i','a.idinscripcion','=','i.idinscripcion')
		->join('actividad as ac','ac.idactividad','=','i.idactividad')
		->join('alumno as al','al.idalumno','=','i.idalumno')
		->where('a.fecha','=', DB::raw('curdate()'))
		->where ('ac.idactividad','=', $id)
		->lists(DB::raw('COUNT(idasistencia)'));
	return $cantidad;
});

Route::get('asistencia/mostrarAsistencias','AsistenciaController@index');
Route::post('asistencia/mostrarAsistencias','AsistenciaController@mostrarAsistenciaPorDia');

Route::post('actividad/{idactividad}/plan/create/','PlanController@store');

Route::patch('actividad/{idactividad}/edit/','ActividadController@update');

Route::get('alumno/inscripcion/{idinscripcion}/mostrarInscripcion','InscripcionController@mostrarInscripcion');
Route::post('alumno/inscripcion/{idinscripcion}/mostrarInscripcion','InscripcionController@actualizarSaldo');

Route::get('alumno/fichaControlCorporal/{idalumno}','FichaControlController@index');

Route::get('cumpleaños','CumpleañosController@mostrarCumpleañeros');

Route::get('actividad/{idactividad}/mostrarInscripciones','ActividadController@mostrarInscripcionesPorActividad');
Route::post('actividad/{idactividad}/mostrarInscripciones','ActividadController@mostrarInscripcionesPorActividadDesdeHasta');

Route::get('movimiento/reporte','MovimientoController@show');

Route::resource('movimiento','MovimientoController');
Route::post('movimiento/create','MovimientoController@store');
Route::post('movimiento','MovimientoController@mostrarMovimientosDesdeHasta');
Route::get('movimiento/reporte/{startDate}/{endDate}','MovimientoController@generarReporte')->name('movimientoReporte');