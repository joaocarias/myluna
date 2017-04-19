<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once 'Conexao.php';
include_once 'Orcamento.php';
include_once './Auxiliares/Auxiliar.php';

/**
 * Description of Entrada
 *
 * @author joao
 */
class Entrada extends Conexao{
    private $idEntrada;
    private $idPaciente;
    private $valorDinheiro;
    private $parcelaDinheiro;
    private $valorCartao;
    private $parcelaCartao;
    private $valorDebito;
    private $parcelaDebito;
    private $idPai;
    private $idStatus;
    private $dataCadastro;
    private $dataModificacao;
    private $modificadoPor;
    
    function __construct($idPaciente, $valorDinheiro, $valorCartao, $parcelaCartao, $valorDebito) {
        $this->valorDinheiro = $valorDinheiro;
        $this->parcelaDinheiro = 1;
        $this->idPaciente = $idPaciente;
        $this->valorCartao = $valorCartao;
        $this->parcelaCartao = $parcelaCartao;
        $this->valorDebito = $valorDebito;
        $this->parcelaDebito = 1;
    }
    
    function getIdEntrada() {
        return $this->idEntrada;
    }

    function getValorDinheiro() {
        return $this->valorDinheiro;
    }

    function getIdPaciente() {
        return $this->idPaciente;
    }

    function setIdPaciente($idPaciente) {
        $this->idPaciente = $idPaciente;
    }

        
    function getParcelaDinheiro() {
        return $this->parcelaDinheiro;
    }

    function getValorCartao() {
        return $this->valorCartao;
    }

    function getParcelaCartao() {
        return $this->parcelaCartao;
    }

    function getValorDebito() {
        return $this->valorDebito;
    }

    function getParcelaDebito() {
        return $this->parcelaDebito;
    }

    function getIdPai() {
        return $this->idPai;
    }

    function getIdStatus() {
        return $this->idStatus;
    }

    function getDataCadastro() {
        return $this->dataCadastro;
    }

    function getDataModificacao() {
        return $this->dataModificacao;
    }

    function getModificadoPor() {
        return $this->modificadoPor;
    }

    function setIdEntrada($idEntrada) {
        $this->idEntrada = $idEntrada;
    }

    function setValorDinheiro($valorDinheiro) {
        $this->valorDinheiro = $valorDinheiro;
    }

    function setParcelaDinheiro($parcelaDinheiro) {
        $this->parcelaDinheiro = $parcelaDinheiro;
    }

    function setValorCartao($valorCartao) {
        $this->valorCartao = $valorCartao;
    }

    function setParcelaCartao($parcelaCartao) {
        $this->parcelaCartao = $parcelaCartao;
    }

    function setValorDebito($valorDebito) {
        $this->valorDebito = $valorDebito;
    }

    function setParcelaDebito($parcelaDebito) {
        $this->parcelaDebito = $parcelaDebito;
    }

    function setIdPai($idPai) {
        $this->idPai = $idPai;
    }

    function setIdStatus($idStatus) {
        $this->idStatus = $idStatus;
    }

    function setDataCadastro($dataCadastro) {
        $this->dataCadastro = $dataCadastro;
    }

    function setDataModificacao($dataModificacao) {
        $this->dataModificacao = $dataModificacao;
    }

    function setModificadoPor($modificadoPor) {
        $this->modificadoPor = $modificadoPor;
    }


    public function inserir(){
        try {
            $pdo = parent::getDB();
           
            $query = $pdo->prepare("insert into entrada 
                (
                id_paciente
                , valor_dinheiro
                , parcela_dinheiro
                , valor_cartao
                , parcela_cartao
                , valor_debito
                , parcela_debito
                , id_pai
                )
                values (
                ?,?,?,?,?,?,?,?)
                ;");        
            
            $query->bindValue(1, $this->getIdPaciente());
            $query->bindValue(2, $this->getValorDinheiro());  
            $query->bindValue(3, $this->getParcelaDinheiro());            
            $query->bindValue(4, $this->getValorCartao());        
            $query->bindValue(5, $this->getParcelaCartao());            
            $query->bindValue(6, $this->getValorDebito());
            $query->bindValue(7, $this->getParcelaDebito());
            $query->bindValue(8, $_SESSION['id_usuario']);
            
            $query->execute();    
            
            $id_entrada = $pdo->lastInsertId();
            
            Orcamento::finalizarEntrada($this->getIdPaciente(), $id_entrada);
            
            return $id_entrada;          
        } catch (Exception $ex) {
            return $ex->getMessage();
        }        
    }    
}
