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

Route::get('/', 'usuario_controller@show');

Route::post('nuevo_gasto_vista', 'nuevo_gasto_controller@show');

//Fin rutas de Sergio
//Rutas de Bea

//Fin rutas de Bea