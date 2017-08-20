<?php

 include("./mpdf60/mpdf.php");
 include_once './Auxiliares/Config.php';

/**
 * Description of GeradorDePDF
 *
 * @author joao
 */
class GeradorDePDF {
    private $empresa = "";
    private $endreco = "";
    private $telefones = "";
    private $email = "";
    private $tituloRelatorio = "";
    private $html = "";
    private $sistema = "";
    private $sigla_sistema = "";
    private $orientacao_pagina = "";
            
    function __construct($tituloRelatorio, $html, $orientacao_pagina = null) {
        $this->html = $html;
        $this->tituloRelatorio = $tituloRelatorio;
        
        $this->empresa = Config::getClinicaNome() .' - '.Config::getClinicaNomeParte2();
        $this->endreco = Config::getEnderecoClinica();
        $this->telefones = Config::getTelefonesClinica();
        $this->email = Config::getPageWeb();
        $this->sigla_sistema = Config::getSigla();
        $this->sistema = Config::getTitulo();
        $this->orientacao_pagina = $orientacao_pagina;       
                
    }
    
    
    public function gerarPDF(){
        if($this->getOrientacao_pagina() == "L"){
            $mpdf=new mPDF('utf-8', 'A4-L');
        }else{
            $mpdf=new mPDF('utf-8', 'A4-P'); 
        }
	 
	$mpdf->SetDisplayMode('fullpage');
        $mpdf->SetHeader(''.$this->getEmpresa().''
                . '<br \>'.$this->getEndreco().''
                . '<br \>'.$this->getTelefones().''
                . '<br \>'.$this->getEmail().''
                , 'R');
        
	$mpdf->SetFooter(''.$this->getTituloRelatorio().'|'.$this->getSistema() .' - '. $this->getSigla_sistema() .'|{PAGENO}');
	
        $mpdf->SetTopMargin('30%');
        
        $mpdf->WriteHTML($this->html);        
	$mpdf->Output();

	exit;
    }
    
    function getEmpresa() {
        return $this->empresa;
    }

    function getEndreco() {
        return $this->endreco;
    }

    function getTelefones() {
        return $this->telefones;
    }

    function getEmail() {
        return $this->email;
    }

    function getTituloRelatorio() {
        return $this->tituloRelatorio;
    }

    function getHtml() {
        return $this->html;
    }

    function setEmpresa($empresa) {
        $this->empresa = $empresa;
    }

    function setEndreco($endreco) {
        $this->endreco = $endreco;
    }

    function setTelefones($telefones) {
        $this->telefones = $telefones;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setTituloRelatorio($tituloRelatorio) {
        $this->tituloRelatorio = $tituloRelatorio;
    }

    function setHtml($html) {
        $this->html = $html;
    }

    function getSistema() {
        return $this->sistema;
    }

    function getSigla_sistema() {
        return $this->sigla_sistema;
    }

    function setSistema($sistema) {
        $this->sistema = $sistema;
    }

    function setSigla_sistema($sigla_sistema) {
        $this->sigla_sistema = $sigla_sistema;
    }

    function getOrientacao_pagina() {
        return $this->orientacao_pagina;
    }

    function setOrientacao_pagina($orientacao_pagina) {
        $this->orientacao_pagina = $orientacao_pagina;
    }



    
}
