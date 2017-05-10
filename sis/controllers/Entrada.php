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
        $this->valorDinheiro = (double) $valorDinheiro;
        if($valorDinheiro > 0){
            $this->parcelaDinheiro = 1;
        }else{
            $this->parcelaDinheiro = 0;
        }
        
        $this->idPaciente = $idPaciente;
        
        $this->valorCartao = (double) $valorCartao;        
        $this->parcelaCartao = $parcelaCartao;
        
        $this->valorDebito = (double) $valorDebito;
        if($valorDebito > 0){
            $this->parcelaDebito = 1;
        }else{
            $this->parcelaDebito = 0;
        }
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
    
     public static function getInformacoes($id){
        try{
            $dados = new Entrada(1, 1, 1, 1, 1);            
            
            $pdo = parent::getDB();

            $query = $pdo->prepare("SELECT e.*, date_format(e.data_cadastro, '%d/%m/%Y %H:%i:%s') as data_cadastro FROM `entrada` as e WHERE e.id_status = ? AND e.id_entrada = ?" );        

            $query->bindValue(1, "1");
            $query->bindValue(2, $id);
                            
            $query->execute();               
                           
            while($row = $query->fetch(PDO::FETCH_OBJ)){    
                $dados->setIdEntrada($row->id_entrada);
                $dados->setIdPaciente($row->id_paciente);
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
            return "";
        }
    }
    
    public static function getLinhasServicosEntrada($idEntrada){
        try{
            
            $pdo = parent::getDB();
            $query = $pdo->prepare("SELECT ie.id_entrada as id_entrada
                                        , o.id_orcamento as id_orcamento
                                        , s.descricao as servico
                                        , u.nome as dentista
                                        , it.valor as valor
                                        , it.desconto as desconto
                                        , it.total as total
                                        FROM item_entrada as ie
                                        INNER JOIN item_orcamento as it on it.id_item_orcamento = ie.id_item_orcamento AND it.id_status = '1'
                                        INNER JOIN orcamento as o on o.id_orcamento = it.id_orcamento AND o.id_status = '1'
                                        INNER JOIN servico as s on s.id_servico = it.id_servico AND s.id_status = '1'
                                        INNER JOIN usuario as u on u.id_usuario = o.id_dentista AND u.status = '1'
                                        WHERE ie.cod_entrada = ? AND ie.id_status = '7';");
            $query->bindValue(1, $idEntrada);
            $query->execute();
                        
            $i = 1;
            $linhas = "";
            while($row = $query->fetch(PDO::FETCH_OBJ)){
                $linhas = $linhas . ""
                        . "<tr>
                              <th scope='row'>".$row->id_orcamento."</th>
                              <td>".$row->servico."</td>
                              <td>".$row->dentista."</td>
                              <td>".Auxiliar::convParaReal($row->valor)."</td>
                              <td>".Auxiliar::convParaReal($row->desconto)."</td>
                              <td>".Auxiliar::convParaReal($row->total)."</td>
                           </tr>";
                $i++;
            }

            return $linhas;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    
    public static function getLinhasTabelaUltimasEntradas(){
        try{
            $pdo = parent::getDB();
            $query = $pdo->prepare("select 
                                        date_format(e.data_cadastro, '%d/%m/%Y') as data_cadastro
                                    , e.id_entrada as id_entrada
                                    , p.id_paciente as id_paciente
                                    , p.nome as nome
                                    , e.parcela_dinheiro as parcela_dinheiro
                                    , e.parcela_cartao as parcela_cartao
                                    , e.parcela_debito as parcela_debito
                                    , e.valor_dinheiro as valor_dinheiro
                                    , e.valor_cartao as valor_cartao
                                    , e.valor_debito as valor_debito
                                    from entrada as e
                                    inner join paciente as p on p.id_paciente = e.id_paciente and p.id_status = '1'
                                    where e.id_status = '1' order by id_entrada desc limit 10; 
                                ");
            $query->execute();
            
            $linhas = "";
            
            while($row = $query->fetch(PDO::FETCH_OBJ)){                    
                $linhas = $linhas . "<tr>
                          <th scope='row'>".$row->id_entrada."</th>
                          <td>".$row->data_cadastro."</td>
                          <td><a href='page_paciente.php?id_paciente=".$row->id_paciente."'>".$row->nome."</a></td>
                          <td>".Auxiliar::convParaReal(($row->parcela_dinheiro * $row->valor_dinheiro) + ($row->parcela_cartao * $row->valor_cartao) + ($row->parcela_debito * $row->valor_debito) )."</td>
                          <td><a href='page_entrada.php?id_entrada=".$row->id_entrada."'>Mais Detalhes</a></td>                          
                        </tr>";            
            }
            
            return $linhas;            
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
 }
