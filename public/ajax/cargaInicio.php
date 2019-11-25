<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$conexion = mysqli_connect('localhost', 'Sergio', 'asd', 'burriking');

    $sentencia = "SELECT *
FROM gastos, c_com_pub, transporte_personal
WHERE gastos.id = c_com_pub.id_gasto OR gastos.id = transporte_personal.id_gasto
GROUP BY gastos.id";

    //$sentencia = "SELECT * FROM `vehiculos` WHERE dni='1'";

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