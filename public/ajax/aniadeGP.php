<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$conexion = mysqli_connect('localhost', 'usrgastos', 'pswgastos', 'gastos');

    $idus = $_POST["usuario"];
    $den = $_POST["denominacion"];
    $pkm = $_POST["pkm"];
    $idg=1;
    
    $sentencia = "SELECT MAX(`id_grupo`) AS maxid FROM `grupo_fijo`";
    $resultado = mysqli_query($conexion, $sentencia);
    
    $e=0;
    while ($fila = mysqli_fetch_assoc($resultado))
    {
        $ret[$e]=$fila;
        $e++;
    }
    if ($resultado->num_rows>0) {
        $idg= ($ret[0]['maxid'])+1;
    }
    
    $sentencia = "INSERT INTO `grupo_fijo`(`id_grupo`, `id_usuario`, `pkm`, `denominacion`) VALUES (".$idg.",".$idus.",".$pkm.",'".$den."')";
    mysqli_query($conexion, $sentencia);
    mysqli_close($conexion);
    echo "insertado";
?>