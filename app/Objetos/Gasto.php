<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Objetos;

/**
 * Description of gasto
 *
 * @author Sergio_RV
 */
class gasto {
    //put your code here
    private $id_gasto;
    private $id_usuario;
    private $descripcion;
    private $tipo;
    private $fecha;
    private $cuantia;
    private $km;
    
    function __construct($id_gasto, $id_usuario, $descripcion, $tipo, $fecha) {
        $this->id_gasto = $id_gasto;
        $this->id_usuario = $id_usuario;
        $this->descripcion = $descripcion;
        $this->tipo = $tipo;
        $this->fecha = $fecha;
    }

    function esComida(){
        if($this->tipo==1){
            return true;
        }
        else{
            return false;
        }
    }
    
    function esTransportePublico(){
        if($this->tipo==3){
            return true;
        }
        else{
            return false;
        }
    }
    
    function esTransportePersonal(){
        if($this->tipo==4){
            return true;
        }
        else{
            return false;
        }
    }
    
    function getId_gasto() {
        return $this->id_gasto;
    }

    function getId_usuario() {
        return $this->id_usuario;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getTipo() {
        return $this->tipo;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getCuantia() {
        return $this->cuantia;
    }

    function getKm() {
        return $this->km;
    }

    function setId_gasto($id_gasto) {
        $this->id_gasto = $id_gasto;
    }

    function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setCuantia($cuantia) {
        $this->cuantia = $cuantia;
    }

    function setKm($km) {
        $this->km = $km;
    }

}
