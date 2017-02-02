<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

 include_once 'Conexao.php';
include_once './Auxiliares/Auxiliar.php';

/**
 * Description of ItemOrcamento
 *
 * @author joao
 */
class ItemOrcamento extends Conexao {
    private $id_item_orcamento;
    private $id_orcamento;
    private $id_servico;
    private $valor;
    private $desconto;
    private $total;
    private $id_pai; 
    private $data_cadastro;
    private $data_modificacao;
    private $modificado_por;
    private $status;
    
    
    function getId_orcamento() {
        return $this->id_orcamento;
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

    function getId_item_orcamento() {
        return $this->id_item_orcamento;
    }

    function getValor() {
        return $this->valor;
    }

    function getDesconto() {
        return $this->desconto;
    }

    function getTotal() {
        return $this->total;
    }

    function setId_item_orcamento($id_item_orcamento) {
        $this->id_item_orcamento = $id_item_orcamento;
    }

    function setValor($valor) {
        $this->valor = $valor;
    }

    function setDesconto($desconto) {
        $this->desconto = $desconto;
    }

    function setTotal($total) {
        $this->total = $total;
    }

    function getId_servico() {
        return $this->id_servico;
    }

    function setId_servico($id_servico) {
        $this->id_servico = $id_servico;
    }

    public static function getListaItensOrcamento($idOrcamento, $idStatus){
        try{
            $pdo = parent::getDB();
            $query = $pdo->prepare("SELECT s.descricao AS descricao FROM item_orcamento as i
                        INNER JOIN servico as s ON s.id_servico = i.id_servico
                        WHERE
                        i.id_orcamento = ?
                        AND i.id_status = ?;"
                    );
            
            $query->bindValue(1, $idOrcamento);
            $query->bindValue(2, $idStatus);
            
            $query->execute();
                    
            $lista = "";
            $i = 0;
            
            while($row = $query->fetch(PDO::FETCH_OBJ)){                  
                if($i>0){
                    $lista = $lista . "<br />";
                }
                $lista = $lista." ".$row->descricao;
                $i++;
            }
                  
            //
            return $lista;
        } catch (Exception $ex) {
            return -1;
        }
    }
    
    public static function  ativarItemOrcamento($idOrcamento){
        try{
            $pdo = parent::getDB();
            $query = $pdo->prepare("UPDATE item_orcamento SET "
                    . "id_status = '1'"
                    . ", data_modificado = NOW()"
                    . ", modificado_por = ? "
                    . "WHERE "
                    . "id_orcamento = ?;");
            
            $query->bindValue(1, $_SESSION['id_usuario']);
            $query->bindValue(2, $idOrcamento);
            
            $query->execute();
            
            return 1;
        } catch (Exception $ex) {
            return -1;
        }
    }

    public static function cancelarOrcamento($idOrcamento){
        try{
            $pdo = parent::getDB();
            $query = $pdo->prepare("UPDATE item_orcamento SET "
                    . "id_status = '4'"
                    . ", data_modificado = NOW()"
                    . ", modificado_por = ? "
                    . "WHERE "
                    . "id_orcamento = ?;");
            
            $query->bindValue(1, $_SESSION['id_usuario']);
            $query->bindValue(2, $idOrcamento);
            
            $query->execute();
            
            return 1;
        } catch (Exception $ex) {
            return -1;
        }
    }

    public function remover($idItem){
        try{
            $pdo = parent::getDB();
            $query = $pdo->prepare("UPDATE item_orcamento SET "
                    . "id_status = '2'"
                    . ", data_modificado = NOW()"
                    . ", modificado_por = ? "
                    . "WHERE "
                    . "id_item_orcamento = ?;");
            
            $query->bindValue(1, $_SESSION['id_usuario']);
            $query->bindValue(2, $idItem);
            
            $query->execute();
            
            return 1;
        } catch (Exception $ex) {
            return -1;
        }
    }
            
    public function inserir(){
        try{
            $pdo = parent::getDB();
            
            $query = $pdo->prepare("INSERT INTO `item_orcamento`"
                    . "("
                    . "`id_orcamento`"
                    . ", `id_servico`"
                    . ", `valor`"
                    . ", `desconto`"
                    . ", `total`"
                    . ", `id_status`"
                    . ", `id_pai`"
                    . ") "
                    . "VALUES (?,?,?,?,?,?,?);");
            
            $query->bindvalue(1, $this->getId_orcamento());
            $query->bindValue(2, $this->getId_servico());
            $query->bindValue(3, $this->getValor());
            $query->bindValue(4, $this->getDesconto());
            $query->bindValue(5, $this->getTotal());
            $query->bindValue(6, '3');                    
            $query->bindValue(7, $_SESSION['id_usuario']);            
            
            $query->execute();
            
            return 1;            
        } catch (Exception $ex) {
           // return $ex->getMessage();
            return -1;
        }
    }
}
