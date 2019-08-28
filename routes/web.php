<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/loguear', function () {
    return view('login');
});

Auth::routes();

Auth::routes(['register' => false]);

Route::group(['middleware' => ['auth']], function(){

	Route::get('/', function(){return redirect('/agenda/ver/pendientes');});

	Route::get('/home', 'HomeController@index')->name('home');

	Route::get('/agenda', 'OperacionesController@index')->where('estado', 'pendientes|entregados');

	Route::get('/agenda/ver/{estado}', 'OperacionesController@index')->where('estado', 'pendientes|entregados');

	Route::get('/agenda/crear', 'OperacionesController@create')->name('agenda_crear');
	Route::post('/agenda', 'OperacionesController@store')->name('agenda_guardar');
	Route::get('/agenda/{operacion}/editar', 'OperacionesController@edit')->name('agenda_mostrar');
	Route::put('/agenda/modificar', 'OperacionesController@update')->name('agenda_modificar');
	Route::get('/agenda/{operacion}/entrega/editar', 'OperacionesController@edit_entrega')->name('agenda_mostrar_entrega');
	Route::put('/agenda/{operacion}/entrega', 'OperacionesController@update_datos_entrega')->name('agenda_modificar_entrega');

	Route::put('/agenda/entregar', 'OperacionesController@update_entrega')->name('agenda_entregar');

	Route::get('/agenda/recuperar', 'OperacionesController@mostrar_consulta')->name('agenda_recuperar');
	Route::get('/agenda/crear_desde_consulta', 'Operaciones_PA_Controller@index')->name('crear_desde_consulta');
	Route::post('/agenda/guardar_desde_consulta', 'OperacionesController@store_desde_consulta')->name('guardar_desde_consulta');

});

