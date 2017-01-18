<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once 'Conexao.php';
include_once './Auxiliares/Auxiliar.php';

/**
 * Description of Servico
 *
 * @author joao
 */
class Servico extends Conexao {
    private $id_servico;
    private $descricao;
    private $valor;
    private $id_pai;
    private $data_cadastro;
    private $data_modificacao;
    private $modificado_por;
    private $id_status;
    
    function getId_servico() {
        return $this->id_servico;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getValor() {
        return $this->valor;
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

    function getId_status() {
        return $this->id_status;
    }

    function setId_servico($id_servico) {
        $this->id_servico = $id_servico;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setValor($valor) {
        $this->valor = $valor;
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

    function setId_status($id_status) {
        $this->id_status = $id_status;
    }


    function inserir(){                
        try {
            $pdo = parent::getDB();
           
            $query = $pdo->prepare("INSERT INTO `servico`( "
                    . "`descricao`, `valor`, `id_pai`, "
                    . "`data_cadastro`, `id_status`) "
                    . "VALUES "
                    . "(?,?,?,NOW(),?)"
                    );        
//                        
            $query->bindValue(1, $this->getDescricao());
            $query->bindValue(2, $this->getValor());
            $query->bindValue(3, $_SESSION['id_usuario']);
         //   $query->bindValue(4, Auxiliar::dateToUS(Auxiliar::getDataAtualBR()));            
            $query->bindValue(4, 1);        
            
            
            $query->execute();    
            
            
            return true;
       
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }  
    
    function editar(){                
        try {
            $pdo = parent::getDB();
           
            $query = $pdo->prepare("UPDATE `servico` "
                    . "SET "
                    . "`descricao`=?"
                    . ",`valor`=?"
                    . ",`data_modificacao`=NOW()"
                    . ",`modificado_por`=?"
                    . " WHERE "
                    . "`id_servico` = ?;"
                    );        
//                        
            $query->bindValue(1, $this->getDescricao());
            $query->bindValue(2, $this->getValor());
         //   $query->bindValue(3, Auxiliar::dateToUS(Auxiliar::getDataAtualBR()));            
            $query->bindValue(3, $_SESSION['id_usuario']);            
            $query->bindValue(4, $this->getId_servico());        
            
            
            $query->execute();    
            
            
            return true;
       
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }  
    
    function excluir(){                
        try {
            $pdo = parent::getDB();
           
            $query = $pdo->prepare("UPDATE `servico` "
                    . "SET "                    
                    . "`data_modificacao`=NOW()"
                    . ",`modificado_por`=?"
                    . ",`id_status`=?"                    
                    . " WHERE "
                    . "`id_servico` = ?;"
                );        
                        
           // $query->bindValue(1, $this->getDescricao());            
         //   $query->bindValue(3, Auxiliar::dateToUS(Auxiliar::getDataAtualBR()));            
            $query->bindValue(1, $_SESSION['id_usuario']);
            $query->bindValue(2, 2);            
            $query->bindValue(3, $this->getId_servico());        
            
            
            $query->execute();    
            
            
            return true;
       
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }  
    
    public static function getLinhasTabela(){
        try{
            $pdo = parent::getDB();

            $query = $pdo->prepare("SELECT * FROM `servico` WHERE id_status = '1'" );        
                          
            $query->execute();
               
            $linhas = "";
                
            while($row = $query->fetch(PDO::FETCH_OBJ)){                    
                $linhas = $linhas . "<tr>"
                        . "<td>".$row->id_servico."</td>"
                        . "<td>".$row->descricao."</td>"
                        . "<td>".$row->valor."</td>"  
                        . "<td><a class='btn btn-primary btn-sm' href='editar_servico.php?editar=true&id_servico=".$row->id_servico."' title='Editar'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> <a class='btn btn-danger btn-sm' href='processa_servico.php?btn-excluir=true&id_servico=".$row->id_servico."' title='Excluir' ><i class='fa fa-trash-o' aria-hidden='true'></i></td>"                      
                        . "</tr> ";                
            }
            
            //'processa_servico?excluir=true&id_servico=".$row->id_servico."' title='Excluir' 
               
            return $linhas;                
        } catch (Exception $ex) {
            return "";
        }
    }
    
    public static function getLinhasTabelaOrcamento($idPaciente, $id_dentista){
        try{
            $pdo = parent::getDB();

            $query = $pdo->prepare("SELECT * FROM `servico` WHERE id_status = '1'" );        
                          
            $query->execute();
               
            $linhas = "";
                
            while($row = $query->fetch(PDO::FETCH_OBJ)){                    
                $linhas = $linhas . "<tr>"
                        . "<td>".$row->id_servico."</td>"
                        . "<td><a href='novo_orcamento.php?novo_orcamento=true&id_paciente=".$idPaciente."&dentista=".$id_dentista."&servico=".$row->id_servico."'>".$row->descricao."</a></td>"
                        . "<td>".$row->valor."</td>"  
                     //   . "<td><a class='btn btn-primary btn-sm' href='editar_servico.php?editar=true&id_servico=".$row->id_servico."' title='Editar'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> <a class='btn btn-danger btn-sm' href='processa_servico.php?btn-excluir=true&id_servico=".$row->id_servico."' title='Excluir' ><i class='fa fa-trash-o' aria-hidden='true'></i></td>"                      
                        . "</tr> ";                
            }               
            return $linhas;                
        } catch (Exception $ex) {
            return "";
        }
    }
    
    public static function getInformacoes($id){
        try{
            $dados = new Servico();            
            
            $pdo = parent::getDB();

            $query = $pdo->prepare("SELECT * FROM `servico` WHERE `id_status` = ? AND `id_servico` = ?");        

            $query->bindValue(1, "1");
            $query->bindValue(2, $id);
                            
            $query->execute();               
                           
            while($row = $query->fetch(PDO::FETCH_OBJ)){                    
                $dados->setId_servico($row->id_servico);
                $dados->setDescricao($row->descricao);
                $dados->setValor($row->valor); 
            }
               
            return $dados;       
        } catch (Exception $ex) {
            return "";
        }
    }
    
}
