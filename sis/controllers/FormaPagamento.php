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


    

    
    
}
