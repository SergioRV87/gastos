<?php

namespace App\Http\Controllers;

use App\Objetos\Usuario;
use Illuminate\Http\Request;

class controladorbea extends Controller {

    function login() {
        $user = $_POST['user'];
        $pass = $_POST['pass'];
        $select = \DB::select("SELECT usuarios.id, usuarios.nombre, usuarios.apellidos, usuarios.email, usuarios.user,usuarios.pass, tipo_usuario.tipo FROM usuarios,tipo_usuario "
                        . "where usuarios.user = '" . $user . "' AND tipo_usuario.id = usuarios.tipo");

      if ($select != null) {
            if (password_verify($pass, $select[0]->pass)) {
                $usr = new Usuario($select[0]->id, $select[0]->user, $select[0]->nombre, $select[0]->apellidos, $select[0]->email, $select[0]->tipo);
                \Session::put('usuario', $usr);
                $respuesta = 'correcto';
            } else {
                $respuesta = 'passIncorrecta';
            }
        } else {
            $respuesta = 'noExiste';
        }

        echo $respuesta;
    }

    function registro() {
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $user = $_POST['user'];
        $pass = $_POST['pass'];
        $email = $_POST['email'];

        $existeEmail = \DB::select("SELECT email FROM usuarios "
                        . "where email = '" . $email . "'");
        $existeUser = \DB::select("SELECT user FROM usuarios "
                        . "where user = '" . $user . "'");
        $respuesta = 'correcto';
        if ($existeEmail != null && $existeUser != null) {
           $respuesta = 'El nombre de usuario y email ya existen';
        } else {
            if ($existeEmail != null) {
                $respuesta = 'El email ya existe';
            }
            if ($existeUser != null) {
                $respuesta = 'El nombre de usuario ya existe';
            }
        }
        if ($respuesta === 'correcto') {
            $pass_cifrado = password_hash($pass, PASSWORD_DEFAULT);
            \DB::Insert('INSERT INTO usuarios (id, nombre, apellidos, email, user, pass, tipo) '
                    . 'VALUES (DEFAULT, "' . $nombre . '", "' . $apellidos . '", "' . $email . '", "' . $user . '", "' . $pass_cifrado . '", 2)');
        }
        echo $respuesta;
    }

}