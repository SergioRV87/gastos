<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Objetos\Conexion;

/**
 * Description of gasto
 *
 * @author Sergio_RV
 */
class Conexion {
    //put your code here
    private $url = 'localhost';
    private $bd = 'gastos';
    private $user = 'usrgastos';
    private $pass = 'pswgastos';
    
    function __construct() {
        
    }

    function getUrl() {
        return $this->url;
    }

    function getBd() {
        return $this->bd;
    }

    function getUser() {
        return $this->user;
    }

    function getPass() {
        return $this->pass;
    }

}
