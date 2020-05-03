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

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::resource('camiones', 'CamionesController');
Route::resource('empleados', 'EmpleadosController');
Route::resource('clientes', 'ClientesController');
Route::resource('gastos', 'GastosController');
Route::resource('facturas', 'FacturasController');
Route::resource('viajes', 'ViajesController');
Route::post('clientes/find_cliente','ClientesController@find_cliente')->name('clientes.buscar_cliente');

Route::post('configuraciones/create_conceptos_gastos','Configuraciones@set_conceptos_gastos')->name('conceptos.store')->middleware('role:1,2,6');
Route::get('configuraciones/edit_conceptos_gastos/{id}/edit','Configuraciones@edit_conceptos_gastos')->name('conceptos.edit')->middleware('role:1,2,6');
Route::put('configuraciones/update_conceptos_gastos/{id}','Configuraciones@update_conceptos_gastos')->name('conceptos.update')->middleware('role:1,2,6');
Route::delete('configuraciones/destroy_conceptos_gastos/{id}','Configuraciones@destroy_conceptos_gastos')->name('conceptos.destroy')->middleware('role:1,2,6');
Route::get('configuraciones/conceptos_gastos','Configuraciones@conceptos_gastos_view')->name('configuraciones.conceptos')->middleware('role:1,2,6');
Route::get('configuraciones/crear_conceptos_gastos','Configuraciones@crear_conceptos_gastos_view')->name('configuraciones.crear_conceptos')->middleware('role:1,2,6');

Route::post('configuraciones/create_tipo_camiones','Configuraciones@set_tipo_camiones')->name('tipos_cmc.store')->middleware('role:1,2,6');
Route::get('configuraciones/edit_tipo_camiones/{id}/edit','Configuraciones@edit_tipo_camiones')->name('tipos_cmc.edit')->middleware('role:1,2,6');
Route::put('configuraciones/update_tipo_camiones/{id}','Configuraciones@update_tipo_camiones')->name('tipos_cmc.update')->middleware('role:1,2,6');
Route::delete('configuraciones/destroy_tipo_camiones/{id}','Configuraciones@destroy_tipo_camiones')->name('tipos_cmc.destroy')->middleware('role:1,2,6');
Route::get('configuraciones/tipo_camiones','Configuraciones@tipo_camiones_view')->name('configuraciones.tipos_cmc')->middleware('role:1,2,6');
Route::get('configuraciones/crear_tipo_camiones','Configuraciones@crear_tipo_camiones_view')->name('configuraciones.crear_tipo_cmc')->middleware('role:1,2,6');

Route::post('configuraciones/create_item_ft','Configuraciones@create_item_ft')->name('item_ft.create')->middleware('role:1,2,6');
Route::get('configuraciones/edit_item_ft/{id}/edit','Configuraciones@edit_item_ft')->name('item_ft.edit')->middleware('role:1,2,6');
Route::put('configuraciones/update_item_ft/{id}','Configuraciones@update_item_ft')->name('item_ft.update')->middleware('role:1,2,6');
Route::delete('configuraciones/destroy_item_ft/{id}','Configuraciones@destroy_item_ft')->name('item_ft.destroy')->middleware('role:1,2,6');
Route::get('configuraciones/item_ft_view','Configuraciones@item_ft_view')->name('configuraciones.item_ft_view')->middleware('role:1,2,6');
Route::get('configuraciones/create_item_ft_view','Configuraciones@create_item_ft_view')->name('item_ft.create_item_ft_view')->middleware('role:1,2,6');

Route::post('configuraciones/create_posiciones','Configuraciones@create_posiciones')->name('posiciones.create')->middleware('role:1,2,6');
Route::get('configuraciones/edit_posiciones/{id}/edit','Configuraciones@edit_posiciones')->name('posiciones.edit')->middleware('role:1,2,6');
Route::put('configuraciones/update_posiciones/{id}','Configuraciones@update_posiciones')->name('posiciones.update')->middleware('role:1,2,6');
Route::delete('configuraciones/destroy_posiciones/{id}','Configuraciones@destroy_posiciones')->name('posiciones.destroy')->middleware('role:1,2,6');
Route::get('configuraciones/posiciones_view','Configuraciones@posiciones_view')->name('configuraciones.posiciones_view')->middleware('role:1,2,6');
Route::get('configuraciones/create_posiciones_view','Configuraciones@create_posiciones_view')->name('posiciones.create_posiciones_view')->middleware('role:1,2,6');

Route::get('configuraciones/asignar_viajes_index','Configuraciones@asignar_viajes_view')->name('configuraciones.asignar_viajes')->middleware('role:1,2,6');
Route::put('configuraciones/asignar_viajes/{id}','Configuraciones@asignar_viajes')->name('configuraciones.setasignar_viajes')->middleware('role:1,2,6');
Route::post('configuraciones/get_viajes','Configuraciones@get_viajes')->name('configuraciones.get_viajes')->middleware('role:1,2,6');
Route::get('configuraciones/get_viajes/{id}','Configuraciones@get_asignar_modal')->name('configuraciones.get_asignar_modal')->middleware('role:1,2,6');

Route::get('reportes/facturacion', 'ReportesController@rep_facturacion_view')->name('reportes.facturacion')->middleware('role:1,2,6,4');
Route::post('reportes/facturacion', 'ReportesController@get_facturacion_rep')->name('reportes.getfacturacion')->middleware('role:1,2,6,4');
Route::get('reportes/viajes', 'ReportesController@rep_viajes_view')->name('reportes.viajes')->middleware('role:1,2,6,4');
Route::post('reportes/viajes', 'ReportesController@get_viajes_rep')->name('reportes.getviajes')->middleware('role:1,2,6,4');
Route::get('reportes/gastos', 'ReportesController@rep_gastos_view')->name('reportes.gastos')->middleware('role:1,2,6,4');
Route::post('reportes/gastos', 'ReportesController@get_gastos_rep')->name('reportes.getgastos')->middleware('role:1,2,6,4');

// Route::resource('posiciones', 'PosicionesController');
