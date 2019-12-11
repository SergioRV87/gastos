<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$conexion = mysqli_connect('localhost', 'usrgastos', 'pswgastos', 'gastos');

    $idga = $_POST['idgasto'];
    $idgp = $_POST['idgp'];

    $sentencia = "INSERT INTO `grupo_gastos`(`id_grupo`, `id_gasto`) VALUES (".$idgp.",".$idga.")";

    $resultado = mysqli_query($conexion, $sentencia);
    mysqli_close($conexion);
    echo "ok";
?>