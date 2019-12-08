<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$conexion = mysqli_connect('localhost', 'usrgastos', 'pswgastos', 'gastos');

    $idus = $_POST['usuario'];

    $sentencia = "SELECT `denominacion`,`pkm`,`id_usuario`,`id_grupo` FROM `grupo_fijo` WHERE `id_usuario`=".$idus.";";

    $resultado = mysqli_query($conexion, $sentencia);
    mysqli_close($conexion);
    $i=0;
    while ($fila = mysqli_fetch_assoc($resultado) )
    {
        $ret[$i]=$fila;
        $i++;
    }

    if ($resultado->num_rows>0) {
        $responder = json_encode($ret);

        echo $responder;
    } else {
        echo "vacio";
    }
?>