<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


include_once 'Conexao.php';

/**
 * Description of ServicoFornecedor
 *
 * @author joao
 */
class ServicoFornecedor extends Conexao {
    private $id_servico;
    private $id_fornecedor;
    private $descricao;
    private $id_pai;
    private $data_cadastro;
    private $modificado_por;
    private $data_modificacao;
    private $id_status;
    
    function getId_servico() {
        return $this->id_servico;
    }

    function getId_fornecedor() {
        return $this->id_fornecedor;
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

    function getModificado_por() {
        return $this->modificado_por;
    }

    function getData_modificacao() {
        return $this->data_modificacao;
    }

    function getId_status() {
        return $this->id_status;
    }

    function setId_servico($id_servico) {
        $this->id_servico = $id_servico;
    }

    function setId_fornecedor($id_fornecedor) {
        $this->id_fornecedor = $id_fornecedor;
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

    function setModificado_por($modificado_por) {
        $this->modificado_por = $modificado_por;
    }

    function setData_modificacao($data_modificacao) {
        $this->data_modificacao = $data_modificacao;
    }

    function setId_status($id_status) {
        $this->id_status = $id_status;
    }

    public static function getInformacoes($id){
        try{
            $dados = new ServicoFornecedor();            
            
            $pdo = parent::getDB();

            $query = $pdo->prepare("SELECT * FROM `servico_fornecedor` WHERE id_status = ? AND id_servico = ?");        

            $query->bindValue(1, "1");
            $query->bindValue(2, $id);
                            
            $query->execute();               
                           
            while($row = $query->fetch(PDO::FETCH_OBJ)){                    
                $dados->setId_servico($row->id_servico);
                $dados->setId_fornecedor($row->id_fornecedor);
                $dados->setDescricao($row->descricao);                
                $dados->setId_pai($row->id_pai);
                $dados->setData_cadastro($row->data_cadastro);            
                $dados->setModificado_por($row->modificado_por);
                $dados->setData_modificacao($row->daa_modificacao);
                $dados->setId_status($row->id_status);                                               
            }
               
            return $dados;       
        } catch (Exception $ex) {
            return "";
        }
    }
    
}
