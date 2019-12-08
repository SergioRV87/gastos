<?php

namespace App\Http\Controllers;
use App\Objetos\Usuario;
use Illuminate\Http\Request;

class usuario_controller extends Controller
{
    
    
    public function show() {
        if(\Session::has('usuario')){
            /*$usr=new Usuario("", "", "", "","","");
            $usr=\Session::get('usuario');
            $id= $usr->getId();
            $usuario= $usr->getUsuario();
            $nombre= $usr->getNombre();
            $apellidos= $usr->getApellidos();
            $email= $usr->getEmail();
            $rol= $usr->getRol();*/
            return view('usuario_vista');
        }else {
            return view('login');
        }
    } 
  
    public function logoff(){
        if(\Session::has('usuario')){
            \Session::forget('usuario');
        }
        return view('login');
    }
}
