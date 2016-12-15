<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Auxiliar
 *
 * @author joao
 */
class Auxiliar {
   //put your code here
    
    private static $acao_form;
    
    public static function getGenero($sexo){
        if($sexo  == 'M'){
            return 'Masculino';
        }else if($sexo == 'F'){
            return 'Feminino';
        }else{
            return "";
        }
    }
    
    public static function getAcao(){
        return self::$acao_form;
    }
    
    public static function setAcao($param){
        self::$acao_form = $param;
    }
    
    public static function idSuperAdmin(){
        return 1;
    }
    
    public static function idAdmin(){
        return 2;
    }

    public static function dateToBR($dataAmericana){
        $d = explode('-', $dataAmericana);
        $dOK = $d[2].'/'.$d[1].'/'.$d[0];
        return $dOK;
    }
    
    public static function dateToUS($dataBrasil){
        $d = explode('/', $dataBrasil);
        $dOK = $d[2].'-'.$d[1].'-'.$d[0];
        return $dOK;
    }


    public static function convParaReal($str){
        $string = $str;
              
        $number = number_format($string, 2, ',','.');
        return $number;
    }
    
    public static function convParaDecimal($str){
        $string = $str;
        $number = str_replace(',','.',$string); 
        return $number;
    }
    
    public static function getDataAtualBR(){
        return date('d/m/y');
    }
    
}
