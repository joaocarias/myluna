<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



session_start();

include_once 'controllers/ServicoFornecedorSaida.php';
include_once 'controllers/ServicoFornecedor.php';
include_once 'controllers/Saida.php';

$id_fornecedor = 0;
$id_servico_fornecedor_saida = 0;


if(isset($_GET['valor_debito_receber'])){
    $valor_debito_receber = $_GET['valor_debito_receber'];     
}else{
    $valor_debito_receber = 0;
}

if(isset($_GET['valor_dinheiro_receber'])){
    $valor_dinheiro_receber = $_GET['valor_dinheiro_receber'];    
}else{
    $valor_dinheiro_receber = 0;
}

if(isset($_GET['n_parcela_cartao'])){
    $n_parcela_cartao = $_GET['n_parcela_cartao'];    
}else{
    $n_parcela_cartao = 0;
}

if(isset($_GET['id_fornecedor'])){
    $id_fornecedor = $_GET['id_fornecedor'];    
}else{
    $id_fornecedor = "";
}

if(isset($_GET['id_servico_fornecedor_saida'])){
    $id_servico_fornecedor_saida = $_GET['id_servico_fornecedor_saida'];
}else{
    $id_servico_fornecedor_saida = $_GET['id_servico_fornecedor_saida'];
}

$obj = new ServicoFornecedorSaida();

if(isset($_POST['id_servico'])){
    $obj->setId_servico_fornecedor($_POST['id_servico']);
}else{
    $obj->setId_servico_fornecedor("");
}

if(isset($_POST['quantidade'])){
    $obj->setQuantidade($_POST['quantidade']);
}else{
    $obj->setQuantidade("");
}

if(isset($_POST['valor_unitario'])){
    $obj->setValor_unitario($_POST['valor_unitario']);
}else{
    $obj->setValor_unitario("");
}

if(isset($_POST['valor_pago'])){
    $obj->setValor_pago($_POST['valor_pago']);
}else{
    $obj->setValor_pago("");
}


if(isset($_POST['btn-salvar_selecionar_servico'])){


  $dados = ServicoFornecedor::getInformacoes($obj->getId_servico_fornecedor());    
  
  $id_fornecedor = $dados->getId_fornecedor();
  $obj->setId_fornecedor($id_fornecedor);
  
    $retorno = $obj->inserir();
    if($retorno == true){       
        header("Location: nova_saida.php?id_fornecedor=".$id_fornecedor);
    }else{
        header("Location: index.php?msg=3");
    }
}else if(isset($_GET['remover_item_selecionado'])){
    $retorno = ServicoFornecedorSaida::removerItemSelecionado($id_servico_fornecedor_saida);
    
    if($retorno == true){       
        header("Location: nova_saida.php?id_fornecedor=".$id_fornecedor);
    }else{
        header("Location: index.php?msg=3");
    }
}else if(isset($_GET['btn-confirmar_forma_pagamento'])){
   // print_r($_GET);
    
    $valor_total = ServicoFornecedorSaida::getTotalSaida($id_fornecedor);
    $valor_receber_cartao = ($valor_total) - ($valor_debito_receber + $valor_dinheiro_receber);
   // print_r($valor_receber_cartao);
  // echo "Fornecedor: ".$id_fornecedor." ".$valor_dinheiro_receber." ".$valor_receber_cartao.
    //       " ".$n_parcela_cartao." ".$valor_debito_receber;
    $nova_saida = new Saida($id_fornecedor, $valor_dinheiro_receber, $valor_receber_cartao, $n_parcela_cartao, $valor_debito_receber);
    print_r($nova_saida);
    
    $id_saida = $nova_saida->inserir();
    echo "id: ".$id_saida;
//    
//    if($id_saida > 0){
//        header("Location: page_saida.php?id_saida=".$id_saida);
//    }else{
////        echo $id_saida;
//        header("Location: inxdex.php?msg=3");
//    }
}else {
    header("Location: index.php?msg=0");
}
