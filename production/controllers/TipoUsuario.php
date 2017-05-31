<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TipoUsuario
 *
 * @author joao
 */
include_once 'Conexao.php';

class TipoUsuario extends Conexao{
    private $id_tipo;
    private $descricao;
    private $id_pai;
    private $data_cadastro;
    private $data_modificacao;
    private $modificado_por;
    private $status;
    
    function getId_tipo() {
        return $this->id_tipo;
    }

    function getDescricao() {
        return $this->descricao;
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

    function setId_tipo($id_tipo) {
        $this->id_tipo = $id_tipo;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
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

    public static function getOpcoesSelecao($idTipo){
        try{
             $pdo = parent::getDB();

                $query = $pdo->prepare("SELECT `id_tipo`, `descricao` "                         
                        . "FROM `tipo_usuario` WHERE `status` = ? AND id_tipo != '1'" );        

                $query->bindValue(1, "1");
                
                $query->execute();
                
                $option = "";
                
               while($row = $query->fetch(PDO::FETCH_OBJ)){   
                   $selecionado = "";
                   
                    if($idTipo == $row->id_tipo){
                        $selecionado = "selected='selected'";
                    }
                   
                    $option = $option . "<option value='".$row->id_tipo."' $selecionado>".$row->descricao."</option>";
               }
                
                return $option;                
        } catch (Exception $ex) {
            return "";
        }
    }
    
    public static function getLinhasTabela(){
        try{
            $pdo = parent::getDB();

            $query = $pdo->prepare("SELECT * FROM `tipo_usuario` WHERE `status` = ?" );        

            $query->bindValue(1, "1");                            
            $query->execute();
               
            $linhas = "";                
            while($row = $query->fetch(PDO::FETCH_OBJ)){                    
                $linhas = $linhas . "<tr>"
                        . "<td>".$row->id_tipo."</td>"
                        . "<td>".$row->descricao."</a></td>"                        
                        . "</tr> ";                
            }
               
            return $linhas;                
        } catch (Exception $ex) {
            return "";
        }
    }
    
    public static function getDescricaoPorID($id){
        try{
            $pdo = parent::getDB();

            $query = $pdo->prepare("SELECT descricao FROM `tipo_usuario` WHERE `id_tipo` = ? AND `status` = ?" );        

            $query->bindValue(1, $id);  
            $query->bindValue(2, "1");                            
            $query->execute();
                            
            while($row = $query->fetch(PDO::FETCH_OBJ)){
                return $row->descricao;                
            }
               
            return "";                
        } catch (Exception $ex) {
            return "";
        }
    }
    
    
}
