<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FormaPagamento
 *
 * @author joao
 */

include_once 'Conexao.php';
include_once './Auxiliares/Auxiliar.php';

class FormaPagamento extends Conexao {
    private $id_forma_de_pagamento;
    private $descricao;
    private $valor_minimo_parcela;
    private $numero_max_de_parcelas;
    private $id_pai;
    private $data_cadastro;
    private $modificado_por;
    private $data_modificacao;
    private $id_status;
    
    function gerarFormaDePagamento($forma_de_pagamento){
        switch ($forma_de_pagamento):
            case "DINHEIRO":                
                $this->setId_forma_de_pagamento(2);
                break;
            case "CARTAO":
                $this->setId_forma_de_pagamento(3);
                break;
            case "DEBITO":
                $this->setId_forma_de_pagamento(1);
                break;            
            default :                
                break;                
        endswitch;
        
        
         try{
            $pdo = parent::getDB();

            $query = $pdo->prepare("SELECT * FROM "
                    . " forma_de_pagamento WHERE "
                    . " id_forma_de_pagamento = ? "
                    . " AND id_status = '1';");        

            $query->bindValue(1, $this->getId_forma_de_pagamento());                            
            $query->execute();

             while($row = $query->fetch(PDO::FETCH_OBJ)){     
                 $this->setId_forma_de_pagamento($row->id_forma_de_pagamento);
                 $this->setDescricao($row->descricao);
                 $this->setValor_minimo_parcela($row->valor_mimino_parcela);
                 $this->setNumero_max_de_parcelas($row->numero_max_de_parcelas);
                 $this->setId_pai($row->id_pai);
                 $this->setData_cadastro($row->data_cadastro);
                 $this->setModificado_por($row->modificado_por);
                 $this->setData_modificacao($row->data_modificacao);
                 $this->setId_status($row->id_status);

             }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
    
    function getId_forma_de_pagamento() {
        return $this->id_forma_de_pagamento;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getValor_minimo_parcela() {
        return $this->valor_minimo_parcela;
    }

    function getNumero_max_de_parcelas() {
        return $this->numero_max_de_parcelas;
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

    function setId_forma_de_pagamento($id_forma_de_pagamento) {
        $this->id_forma_de_pagamento = $id_forma_de_pagamento;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setValor_minimo_parcela($valor_minimo_parcela) {
        $this->valor_minimo_parcela = $valor_minimo_parcela;
    }

    function setNumero_max_de_parcelas($numero_max_de_parcelas) {
        $this->numero_max_de_parcelas = $numero_max_de_parcelas;
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

    function getValorParcela($valorTotal){
        $valor = (int) $this->getNumero_max_de_parcelas();
        if( $valor == 1){
            return $valorTotal;
        }else{
            return ($valorTotal / $this->getNumero_max_de_parcelas());
        }
    }
    
    function getOptionsCartao($valor_total){
        $num_max_de_parcelas = (int) $this->getNumero_max_de_parcelas();
        $valor_minimo = $this->getValor_minimo_parcela();
        
        $option = "";
        
        if($valor_minimo < $valor_total){            
            $temp_parcela = (($valor_total)/$valor_minimo);
            $parcelas = $num_max_de_parcelas;
            if($temp_parcela < $num_max_de_parcelas){
                $parcelas = $temp_parcela;                        
            }
                $i = 1;
                while($i <= $parcelas){
                    $valor_parcela = (($valor_total)/$i);
                    $option = $option . "<option value='".$i."'>".$i." x ".$valor_parcela."</option>";            
                    $i++;
                }
        }else{
            $option = $option . "<option value='1'>1 x ".(float) $valor_total."</option>";
        }          
        
        return $option;
    }
    

    
    
}
