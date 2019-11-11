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
//Route::get('usuario_viata', function () {
//    return view('usuario_vista');  
//});
//
//
//Route::get('/', 'usuario_controller@show');
//
//bea
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