<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', 'App\Http\Controllers\AuthController@index')->name('auth.login');
Route::post('/signin', 'App\Http\Controllers\AuthController@signIn')->name('auth.signin'); 
Route::get('/logout', 'App\Http\Controllers\AuthController@logOut')->name('logout');

Route::get('/register', 'App\Http\Controllers\AuthController@showRegister')->name('auth.register');
Route::post('/signup', 'App\Http\Controllers\AuthController@signUp')->name('auth.signup'); 

Route::get('/modulos', 'App\Http\Controllers\AuthController@options')->name('auth.modulos');

Route::get('/nomina', 'App\Http\Controllers\NominaController@index')->name('nomina.index');
Route::get('/nomina/cargar', 'App\Http\Controllers\NominaController@load')->name('nomina.load');
Route::post('/nomina/cargar', 'App\Http\Controllers\NominaController@open')->name('nomina.open');

Route::post('/nomina/guardar', 'App\Http\Controllers\NominaController@store')->name('nomina.store');
Route::get('/nomina/procesar', 'App\Http\Controllers\NominaController@process')->name('nomina.process');

Route::get('/prenomina', 'App\Http\Controllers\PreNominaController@index')->name('prenomina.index');
Route::get('/prenomina/{id}', 'App\Http\Controllers\PreNominaController@show')->name('prenomina.show');

Route::get('/prenomina/cargar/{id}', 'App\Http\Controllers\PreNominaController@load')->name('prenomina.load');
Route::post('/prenomina/cargar/{id}', 'App\Http\Controllers\PreNominaController@open')->name('prenomina.open');

Route::post('/prenomina/guardar/{id}', 'App\Http\Controllers\PreNominaController@store')->name('prenomina.store');
Route::get('/prenomina/procesar/{id}', 'App\Http\Controllers\PreNominaController@process')->name('prenomina.process');

Route::get('/empleados', 'App\Http\Controllers\EmployeeController@index')->name('empleados.index');
Route::post('/create_empleado', 'App\Http\Controllers\EmployeeController@create')->name('empleado.create');
Route::post('/edit_empleado', 'App\Http\Controllers\EmployeeController@edit')->name('empleado.edit');
Route::post('/delete_empleado', 'App\Http\Controllers\EmployeeController@delete')->name('empleado.delete');

Route::get('/departamentos', 'App\Http\Controllers\DepartamentoController@index')->name('departamentos.index');
Route::post('/store_departamento', 'App\Http\Controllers\DepartamentoController@create')->name('departamento.create');
Route::post('/edit_departamento', 'App\Http\Controllers\DepartamentoController@edit')->name('departamento.edit');
Route::post('/delete_departamento', 'App\Http\Controllers\DepartamentoController@delete')->name('departamento.delete');

Route::get('/cargos', 'App\Http\Controllers\CargoController@index')->name('cargos.index');
Route::post('/store_cargo', 'App\Http\Controllers\CargoController@create')->name('cargo.create');
Route::post('/edit_cargo', 'App\Http\Controllers\CargoController@edit')->name('cargo.edit');
Route::post('/delete_cargo', 'App\Http\Controllers\CargoController@delete')->name('cargo.delete');

Route::get('/asignaciones', 'App\Http\Controllers\AsignacionController@index')->name('asignaciones.index');
Route::post('/create_asignacion', 'App\Http\Controllers\AsignacionController@create')->name('asignacion.create');
Route::post('/delete_asignacion', 'App\Http\Controllers\AsignacionController@delete')->name('asignacion.delete');
Route::post('/edit_asignacion', 'App\Http\Controllers\AsignacionController@edit')->name('asignacion.edit');

Route::get('/deducciones', 'App\Http\Controllers\DeduccionController@index')->name('deducciones.index');
Route::post('/create_deduccion', 'App\Http\Controllers\DeduccionController@create')->name('deduccion.create');
Route::post('/delete_deduccion', 'App\Http\Controllers\DeduccionController@delete')->name('deduccion.delete');
Route::post('/edit_deduccion', 'App\Http\Controllers\DeduccionController@edit')->name('deduccion.edit');

Route::get('/asistencias', 'App\Http\Controllers\AsistenciaController@index')->name('asistencias.index');
Route::post('/asistencias/create', 'App\Http\Controllers\AsistenciaController@create')->name('asistencia.create');
Route::post('/asistencias/delete', 'App\Http\Controllers\AsistenciaController@delete')->name('asistencia.delete');
Route::post('/asistencias/edit', 'App\Http\Controllers\AsistenciaController@edit')->name('asistencia.edit');

Route::get('/horarios', 'App\Http\Controllers\HorarioController@index')->name('horarios.index');
Route::post('/horarios/create', 'App\Http\Controllers\HorarioController@create')->name('horario.create');
Route::post('/horarios/delete', 'App\Http\Controllers\HorarioController@delete')->name('horario.delete');
Route::post('/horarios/edit', 'App\Http\Controllers\HorarioController@edit')->name('horario.edit');

Route::get('/reportes', 'App\Http\Controllers\ReporteController@index')->name('reportes.index');

Route::post('/reportes/prenomina/view/{id}', 'App\Http\Controllers\PrintController@showpdf')->name('prenominaview.pdf');
Route::post('/reportes/nomina/view/{id}', 'App\Http\Controllers\PrintController@shownominapdf')->name('nominaview.pdf');