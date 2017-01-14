<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once 'Conexao.php';
include_once './Auxiliares/Auxiliar.php';

/**
 * Description of Orcamento
 *
 * @author joao
 */
class Orcamento extends Conexao{
    private $id_orcamento;
    private $id_paciente;
    private $id_dentista;
    private $id_pai; 
    private $data_cadastro;
    private $data_modificacao;
    private $modificado_por;
    private $status;
    
    function getId_orcamento() {
        return $this->id_orcamento;
    }

    function getId_paciente() {
        return $this->id_paciente;
    }

    function getId_dentista() {
        return $this->id_dentista;
    }

    function getId_pai() {
        return $this->id_pai;
    }

    function getData_cadastro() {
        return $this->data_cadastro;
    }

    function getData_modificacao() {
        return $this->data_modificacao;
    }

    function getModificado_por() {
        return $this->modificado_por;
    }

    function getStatus() {
        return $this->status;
    }

    function setId_orcamento($id_orcamento) {
        $this->id_orcamento = $id_orcamento;
    }

    function setId_paciente($id_paciente) {
        $this->id_paciente = $id_paciente;
    }

    function setId_dentista($id_dentista) {
        $this->id_dentista = $id_dentista;
    }

    function setId_pai($id_pai) {
        $this->id_pai = $id_pai;
    }

    function setData_cadastro($data_cadastro) {
        $this->data_cadastro = $data_cadastro;
    }

    function setData_modificacao($data_modificacao) {
        $this->data_modificacao = $data_modificacao;
    }

    function setModificado_por($modificado_por) {
        $this->modificado_por = $modificado_por;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function inserir(){
        
    }
    
    public static function getInformacoes($id){
        
    }
    
    
    public static function getArrayListOrcamento($idPaciente){
        try{
            $pdo = parent::getDB();

            $query = $pdo->prepare("SELECT * FROM `orcamento` "
                                   . "WHERE  "                    
                                        . "id_status = ?"
                                        . "AND idPaciente = ?"
                    );        

            $query->bindValue(1, "1");
            $query->bindValue(2, $idPaciente);
                            
            $query->execute();
               
            $lista = Array();
            $i = 0;
                
            while($row = $query->fetch(PDO::FETCH_OBJ)){       
                $obj = new Orcamento();
                $obj->setId_orcamento($row->id_orcamento);
                $obj->setId_paciente($row->id_paciente);
                $lista[i] = $obj;   
                $i++;
            }
               
            return $orcamento;    
            return null;
        } catch (Exception $ex) {
            return null;
        }
    }
    
}
