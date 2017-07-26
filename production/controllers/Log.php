<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Log
 *
 * @author joao
 */
class Log {
    private $id_log;
    private $descricao;
    private $id_tabela;
    private $tabela;
    private $data_criacao;
    private $id_pai;
    private $id_status;
    
    function getId_log() {
        return $this->id_log;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getId_tabela() {
        return $this->id_tabela;
    }

    function getTabela() {
        return $this->tabela;
    }

    function getData_criacao() {
        return $this->data_criacao;
    }

    function getId_pai() {
        return $this->id_pai;
    }

    function getId_status() {
        return $this->id_status;
    }

    function setId_log($id_log) {
        $this->id_log = $id_log;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setId_tabela($id_tabela) {
        $this->id_tabela = $id_tabela;
    }

    function setTabela($tabela) {
        $this->tabela = $tabela;
    }

    function setData_criacao($data_criacao) {
        $this->data_criacao = $data_criacao;
    }

    function setId_pai($id_pai) {
        $this->id_pai = $id_pai;
    }

    function setId_status($id_status) {
        $this->id_status = $id_status;
    }

    public static function inserirLog($descricao, $tabela, $id_tabela){                       
        try {
            $pdo = parent::getDB();
           
            $query = $pdo->prepare("INSERT INTO `agendamento`("
                    . "`id_paciente`"
                    . ", `id_dentista`"
                    . ", `data_agendamento`"
                    . ", `hora_agendamento`"
                    . ", `id_pai`" 
                    . ", `id_status`) "
                    . "VALUES "
                    . "(?,?,?,?,?,?)");        
//                        
            $query->bindValue(1, $this->getId_paciente());
            $query->bindValue(2, $this->getId_dentista());  
            $query->bindValue(3, Auxiliar::dateToUS($this->getData()));
            $query->bindValue(4, $this->getHora());            
            $query->bindValue(5, $_SESSION['id_usuario']);        
            $query->bindValue(6, '1');
            
            $query->execute();    
            
            return $pdo->lastInsertId();
          
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }  
}
