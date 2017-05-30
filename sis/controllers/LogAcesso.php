<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once 'Conexao.php';
/**
 * Description of LogAcesso
 *
 * @author joao
 */
class LogAcesso extends Conexao{
    private $id_log;
    private $id_usuario;
    private $login;
    private $Acesso;
    private $data_cadastro;
    private $id_status;
    
    function __construct($id_usuario, $login, $Acesso, $id_status) {
        $this->id_usuario = $id_usuario;
        $this->login = $login;
        $this->Acesso = $Acesso;
        $this->id_status = $id_status;
    }
    
    function getId_log() {
        return $this->id_log;
    }

    function getLogin() {
        return $this->login;
    }

    function getAcesso() {
        return $this->Acesso;
    }

    function getData_cadastro() {
        return $this->data_cadastro;
    }

    function getId_status() {
        return $this->id_status;
    }

    function setId_log($id_log) {
        $this->id_log = $id_log;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function setAcesso($Acesso) {
        $this->Acesso = $Acesso;
    }

    function setData_cadastro($data_cadastro) {
        $this->data_cadastro = $data_cadastro;
    }

    function setId_status($id_status) {
        $this->id_status = $id_status;
    }
    
    function getId_usuario() {
        return $this->id_usuario;
    }

    function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }
    
    public function inserir(){
         try {
            $pdo = parent::getDB();
           
            $query = $pdo->prepare("insert into "
                    . " log_acesso ("
                    . " id_usuario"
                    . ", login"
                    . ", acesso"
                    . ", id_status"                    
                    . ") "
                    . " VALUES "
                    . "(?, ?, ?, ?);");        
            
            $query->bindValue(1, $this->getId_usuario());
            $query->bindValue(2, $this->getLogin());  
            $query->bindValue(3, $this->getAcesso());            
            $query->bindValue(4, $this->getId_status());           
            
            $query->execute();    
            
            return true;          
        } catch (Exception $ex) {
            return $ex->getMessage();
        }        
    }       
}
