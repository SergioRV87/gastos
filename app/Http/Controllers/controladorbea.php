<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class controladorbea extends Controller {

    function login(Request $req) {
        $pass = $req->get('pass');
        $select = \DB::select("SELECT usuarios.nombre, usuarios.apellidos, usuarios.email, usuarios.user,usuarios.pass, tipo_usuario.tipo FROM usuarios,tipo_usuario "
                        . "where usuarios.user = '" . $req->get('usuario') . "' AND tipo_usuario.id = usuarios.tipo");
        $datos = [
            'nombre' => $select[0]->nombre,
            'apellidos' => $select[0]->apellidos,
            'email'=>$select[0]->email,
            'user'=>$select[0]->user,
            'tipo' => $select[0]->tipo
        ];
        if (password_verify($pass, $select[0]->pass)) {
//            \Session::put('usuario', $datos);
            return view('usuario_vista',$datos);
        } else {
            return view("error");
        }
    }

    function registro(Request $req) {
        $nombre = $req->get('nombre');
        $apellidos = $req->get('apellidos');
        $email = $req->get('email');
        $user = $req->get('user');
        $pass = $req->get('pass');
        $pass_cifrado = password_hash($pass, PASSWORD_DEFAULT);
        $resultado = \DB::Insert('INSERT INTO usuarios (id, nombre, apellidos, email, user, pass, tipo) '
                        . 'VALUES (DEFAULT, "' . $nombre . '", "' . $apellidos . '", "' . $email . '", "' . $user . '", "' . $pass_cifrado . '", 2)');
        return view('usuario_vista');
    }

}
