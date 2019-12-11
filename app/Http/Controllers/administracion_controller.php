<?php

namespace App\Http\Controllers;
use App\Objetos\Usuario;
use Illuminate\Http\Request;

class administracion_controller extends Controller
{
    
    
    public function show() {
        if(\Session::has('usuario')){
            $usr=new Usuario("", "", "", "","","");
            $usr=\Session::get('usuario');
            $usrs = \DB::select("SELECT `id`,`nombre`,`apellidos`,`user`,`email`,`tipo` FROM `usuarios`");
            $datos=['usuarios'=>$usrs];
            return view('administracion_vista',$datos);
        }
    }
  
    public function logoff(){
        if(\Session::has('usuario')){
            \Session::forget('usuario');
        }
        return view('login');
    }
}
