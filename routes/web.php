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

/*Route::get('/', function () {
    return view('welcome');
    
});*/
//Rutas de Sergio
Route::get('usuario_vista', function () {
    return view('usuario_vista');  
});
Route::get('nuevo_gasto_vista', function () {
    return view('nuevo_gasto_vista');  
});

//Route::get('/', 'usuario_controller@show');

Route::post('nuevo_gasto_apertura', 'nuevo_gasto_controller@show');

Route::post('nuevo_gasto_guardado', 'nuevo_gasto_controller@nuevo_gasto_guardado');

Route::post('cierra_sesion', 'usuario_controller@logoff');
//Fin rutas de Sergio
//Rutas de Bea
Route::get('/' , function () {
   return view('login');
});
Route::get('index', function () {
   return view('login');
});

Route::get('registro', function () {
   return view('registro');
});
Route::post('validar','Controladorbea@login');
Route::post('nuevoregistro','Controladorbea@registro');
//Fin rutas de Bea