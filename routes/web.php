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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/inicio', function(){
	return view('layouts.inicio');
	});

Route::get('/agenda/ver/{estado}', 'OperacionesController@index')->where('estado', 'pendientes|entregados');
Route::get('/agenda/crear', 'OperacionesController@create')->name('agenda_crear');
Route::get('/agenda/modificar', 'OperacionesController@show')->name('agenda_modificar');
Route::post('/agenda', 'OperacionesController@store')->name('agenda_guardar');

Route::get('/agenda/recuperar', 'OperacionesController@mostrar_consulta')->name('agenda_recuperar');
Route::get('/agenda/crear_desde_consulta', 'Operaciones_PA_Controller@index')->name('crear_desde_consulta');
Route::post('/agenda/guardar_desde_consulta', 'OperacionesController@store_desde_consulta')->name('guardar_desde_consulta');

