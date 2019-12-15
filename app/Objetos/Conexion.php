<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Objetos\Conexion;

/**
 * Description of Conexion
 *
 * @author Sergio_RV
 */
class Conexion {
    private $url='localhost';
    private $bd='gastos';
    private $usr='usrgastos';
    private $pass='pswgastos';
    
    function __construct() {
        
    }
    function getUrl() {
        return $this->url;
    }

    function getBd() {
        return $this->bd;
    }

    function getUsr() {
        return $this->usr;
    }

    function getPass() {
        return $this->pass;
    }
}
