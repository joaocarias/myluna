<?php

include_once 'Conexao.php';
include_once 'Orcamento.php';
include_once './Auxiliares/Auxiliar.php';

/**
 * Description of Saida
 *
 * @author joao
 */
class Saida extends Conexao{
    private $idSaida;
    private $idFornecedor;
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
    
    function __construct($idFornecedor, $valorDinheiro, $valorCartao, $parcelaCartao, $valorDebito) {
        $this->valorDinheiro = (double) $valorDinheiro;
        if($valorDinheiro > 0){
            $this->parcelaDinheiro = 1;
        }else{
            $this->parcelaDinheiro = 0;
        }
        
        $this->idFornecedor = $idFornecedor;
        
        $this->valorCartao = (double) $valorCartao;        
        $this->parcelaCartao = $parcelaCartao;
        
        $this->valorDebito = (double) $valorDebito;
        if($valorDebito > 0){
            $this->parcelaDebito = 1;
        }else{
            $this->parcelaDebito = 0;
        }
    }    
    
    function getIdSaida() {
        return $this->idSaida;
    }

    function getValorDinheiro() {
        return $this->valorDinheiro;
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

    function setIdSaida($idSaida) {
        $this->idSaida = $idSaida;
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

    function getIdFornecedor() {
        return $this->idFornecedor;
    }

    function setIdFornecedor($idFornecedor) {
        $this->idFornecedor = $idFornecedor;
    }

    public function inserir(){
        try {
            $pdo = parent::getDB();
           
            $query = $pdo->prepare("insert into saida 
                (
                 id_fornecedor
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
            
            $query->bindValue(1, $this->getIdFornecedor());
            $query->bindValue(2, $this->getValorDinheiro());  
            $query->bindValue(3, $this->getParcelaDinheiro());            
            $query->bindValue(4, $this->getValorCartao());        
            $query->bindValue(5, $this->getParcelaCartao());            
            $query->bindValue(6, $this->getValorDebito());
            $query->bindValue(7, $this->getParcelaDebito());
            $query->bindValue(8, $_SESSION['id_usuario']);
            
            $query->execute();    
            
            $id_saida = $pdo->lastInsertId();
            
            ServicoFornecedorSaida::finalizarSaida($this->getIdFornecedor(), $id_saida);
         //   $id_saida = '1';
            return $id_saida;          
        } catch (Exception $ex) {
            return $ex->getMessage();
        }        
    }

    
    
}
