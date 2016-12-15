<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Config
 *
 * @author joao
 */
class Config {
    private static $titulo = "Sistema de Gereciamento e Controle";
    private static $sigla = "SisGCon";
    private static $clinicaNome = "Dra. Luanda Almeida";
    private static $clinicaNomeParte2 = "Odontologia Integrada";
    private static $iconTitulo = "fa fa-id-card-o";
    
    static function getTitulo() {
        return self::$titulo;
    }

    static function getSigla() {
        return self::$sigla;
    }

    static function setTitulo($titulo) {
        self::$titulo = $titulo;
    }

    static function setSigla($sigla) {
        self::$sigla = $sigla;
    }
    
    static function getClinicaNome() {
        return self::$clinicaNome;
    }

    static function getClinicaNomeParte2() {
        return self::$clinicaNomeParte2;
    }

    static function setClinicaNome($clinicaNome) {
        self::$clinicaNome = $clinicaNome;
    }

    static function setClinicaNomeParte2($clinicaNomeParte2) {
        self::$clinicaNomeParte2 = $clinicaNomeParte2;
    }

    static function getIconTitulo() {
        return self::$iconTitulo;
    }

    static function setIconTitulo($iconTitulo) {
        self::$iconTitulo = $iconTitulo;
    }




}
