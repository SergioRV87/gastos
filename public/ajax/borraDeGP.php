<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$conexion = mysqli_connect('localhost', 'usrgastos', 'pswgastos', 'gastos');

    $idga = $_POST['idgasto'];
    $idgp = $_POST['idgrupo'];

    $sentencia = "DELETE FROM `grupo_gastos` WHERE `id_grupo`=".$idgp." AND `id_gasto`=".$idga.";";

    $resultado = mysqli_query($conexion, $sentencia);
    mysqli_close($conexion);
    echo "ok";
?>