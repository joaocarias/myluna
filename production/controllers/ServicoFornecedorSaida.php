<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once 'Conexao.php';
include_once './Auxiliares/Auxiliar.php';

/**
 * Description of ServicoFornecedorSaida
 *
 * @author joao
 */
class ServicoFornecedorSaida extends Conexao{
    private $id_servico_fornecedor_saida;
    private $id_servico_fornecedor;
    private $quantidade;
    private $valor_unitario;
    private $valor_pago;
    private $id_pai;
    private $data_cadastro;
    private $modificado_por;
    private $data_modificacao;
    private $id_status;
    
    
    function getId_servico_fornecedor_saida() {
        return $this->id_servico_fornecedor_saida;
    }
    
    function getQuantidade() {
        return $this->quantidade;
    }

    function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
    }

    
    function getId_servico_fornecedor() {
        return $this->id_servico_fornecedor;
    }

    function getValor_unitario() {
        return $this->valor_unitario;
    }

    function getValor_pago() {
        return $this->valor_pago;
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

    function setId_servico_fornecedor_saida($id_servico_fornecedor_saida) {
        $this->id_servico_fornecedor_saida = $id_servico_fornecedor_saida;
    }

    function setId_servico_fornecedor($id_servico_fornecedor) {
        $this->id_servico_fornecedor = $id_servico_fornecedor;
    }

    function setValor_unitario($valor_unitario) {
        $this->valor_unitario = $valor_unitario;
    }

    function setValor_pago($valor_pago) {
        $this->valor_pago = $valor_pago;
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

    public function inserir(){
        try {
            $pdo = parent::getDB();
           
            $query = $pdo->prepare("insert into "
                    . " servico_fornecedor_saida ("
                    . " id_servico_fornecedor"
                    . ", quantidade"
                    . ", valor_unitario"
                    . ", valor_pago"
                    . ", id_pai"
                    . ") "
                    . " VALUES "
                    . "(?, ?, ?, ?, ?);");        
            
            $query->bindValue(1, $this->getId_servico_fornecedor());
            $query->bindValue(2, $this->getQuantidade());  
            $query->bindValue(3, Auxiliar::convParaDecimal($this->getValor_unitario()));            
            $query->bindValue(4, Auxiliar::convParaDecimal($this->getValor_pago())); 
            $query->bindValue(5, $_SESSION['id_usuario']);
            
            $query->execute();    
            
            return true;          
        } catch (Exception $ex) {
            return $ex->getMessage();
        }        
    }  
    
    public static function removerItemSelecionado($id_servico_fornecedor_saida){
        try{
            $pdo = parent::getDB();
            $query = $pdo->prepare("update 
                servico_fornecedor_saida 
                set 
                id_status = '2'
                , modificado_por = ?
                , data_modificacao = NOW()  
                where 
                id_status = '3' 
                AND id_servico_fornecedor_saida = ?
                ;");
            
            $query->bindValue(1, $_SESSION['id_usuario']);
            $query->bindValue(2, $id_servico_fornecedor_saida);
            $query->execute();
            
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }
    
    public static function getListaServicoSelecionados($id_fornecedor){
        try{
            $pdo = parent::getDB();
            $query = $pdo->prepare("select 	
                                sfs.id_servico_fornecedor_saida as id
                                , sf.descricao as descricao
                                , sfs.quantidade as quantidade
                                , sfs.valor_unitario as valor_unitario
                                , sfs.valor_pago as valor_pago 	
                            from servico_fornecedor_saida as sfs
                            inner join servico_fornecedor as sf on sf.id_servico = sfs.id_servico_fornecedor AND sf.id_fornecedor = ?  
                            where 
                                sfs.id_status = '3' 
                                ;
                            ;");
           
            $query->bindValue(1, $id_fornecedor);
                                               
            $lista = "";
            $i = 1;
            
            $query->execute();               
                           
            while($row = $query->fetch(PDO::FETCH_OBJ)){               
           
                $valor_total = ($row->quantidade) * ($row->valor_unitario);
                $lista = $lista . "<tr>"
                        . "<th scope='row'>".$i."</th>"
                        . "<td>".$row->descricao."</td>"
                        . "<td>".$row->quantidade."</td>"
                        . "<td>".Auxiliar::convParaReal($row->valor_unitario)."</td>"
                        . "<td>".Auxiliar::convParaReal($valor_total)."</td>"
                        . "<td>".Auxiliar::convParaReal(($valor_total) - ($row->valor_pago))."</td>"
                        . "<td>".Auxiliar::convParaReal($row->valor_pago)."</td>"
                        . "<td><a href='processa_saida.php?id_fornecedor=".$id_fornecedor."&id_servico_fornecedor_saida=".$row->id."&remover_item_selecionado=true'>Remover</a></td>"
                        . "<tr>";
                $i++;
            }
                
            return $lista;
                    
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
}
