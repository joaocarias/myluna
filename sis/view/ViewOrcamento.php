<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ViewOrcamento
 *
 * @author joao
 */
class ViewOrcamento {
    private $titulo;
    private $subTitulo;
    
    function getTitulo() {
        return $this->titulo;
    }

    function getSubTitulo() {
        return $this->subTitulo;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setSubTitulo($subTitulo) {
        $this->subTitulo = $subTitulo;
    }


}
