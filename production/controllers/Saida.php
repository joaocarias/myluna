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

     public static function getInformacoes($id){
        try{
            $dados = new Saida(1, 1, 1, 1, 1);           
            
            $pdo = parent::getDB();
//
            $query = $pdo->prepare("SELECT s.*, date_format(s.data_cadastro, '%d/%m/%Y %H:%i:%s') as data_cadastro
             FROM `saida` as s WHERE s.id_status = ? AND s.id_saida = ?" );        

            $query->bindValue(1, "1");
            $query->bindValue(2, $id);
                            
            $query->execute();               
//                           
            while($row = $query->fetch(PDO::FETCH_OBJ)){    
                $dados->setIdSaida($row->id_saida);
                $dados->setIdFornecedor($row->id_fornecedor);
                $dados->setValorDinheiro($row->valor_dinheiro);
                $dados->setParcelaDinheiro($row->parcela_dinheiro);
                $dados->setValorCartao($row->valor_cartao);
                $dados->setParcelaCartao($row->parcela_cartao);
                $dados->setValorDebito($row->valor_debito);
                $dados->setParcelaDebito($row->parcela_debito);
                $dados->setIdPai($row->id_pai);
                $dados->setIdStatus($row->id_status);
                $dados->setDataCadastro($row->data_cadastro);
                $dados->setDataModificacao($row->data_modificacao);
                $dados->setModificadoPor($row->modificado_por); 
                                
            }
               
            return $dados;       
        } catch (Exception $ex) {
            return $ex;
        }
    }
    
    public static function getLinhasServicosSaidas($id_saida){
        try{
            
            $pdo = parent::getDB();
            $query = $pdo->prepare("select s.*, sf.descricao as descricao "
                    . " from servico_fornecedor_saida as s "
                    . " INNER JOIN servico_fornecedor as sf ON sf.id_servico = s.id_servico_fornecedor "
                    . " WHERE s.id_saida = ?");
            $query->bindValue(1, $id_saida);
            
            $query->execute();
                        
            $i = 1;
            $linhas = "";
            while($row = $query->fetch(PDO::FETCH_OBJ)){
                $linhas = $linhas . ""
                        . "<tr>
                              <th scope='row'>".$row->descricao."</th>
                              <td>".$row->quantidade."</td>
                              <td>".Auxiliar::convParaReal($row->valor_unitario)."</td>
                              <td>".Auxiliar::convParaReal((2*($row->valor_unitario))-($row->valor_pago))."</td>
                              <td>".Auxiliar::convParaReal($row->valor_pago)."</td>                              
                           </tr>";
                $i++;
            }

            return $linhas;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    
}
