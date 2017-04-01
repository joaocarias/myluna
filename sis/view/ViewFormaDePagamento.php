<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ViewEntrada
 *
 * @author joao
 */
include_once './controllers/FormaPagamento.php';

class ViewFormaPagamento {
    private $titulo;
    private $subTitulo;
   
    function getSubTitulo() {
        return $this->subTitulo;
    }

    function setSubTitulo($subTitulo) {
       $this->subTitulo = $subTitulo;
    }

      
    function getTitulo() {
       return $this->titulo;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }
 
}