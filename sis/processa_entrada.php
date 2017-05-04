<?php

session_start();

include_once 'controllers/Orcamento.php';
include_once 'controllers/Entrada.php';

$acao = "";
$id_paciente = "";
$id_item_orcamento = "";
$valor = "";
$idItemEntrada = "";

$forma_de_pagamento = "";
$valor_debito_receber = 0;
$valor_dinheiro_receber = 0;
$n_parcela_cartao = 0;

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

if(isset($_GET['acao'])){
    $acao = $_GET['acao'];    
}else{
    $acao = "";
}

if(isset($_GET['id_item_entrada'])){
    $idItemEntrada = $_GET['id_item_entrada'];
}else{
    $idItemEntrada = "";
}

if(isset($_GET['valor'])){
    $valor = $_GET['valor'];
}else{
    $valor = "";
}

if(isset($_GET['id_paciente'])){
    $id_paciente = $_GET['id_paciente'];
}else{
    $id_paciente = "";
}

if(isset($_GET['id_item_orcamento'])){
    $id_item_orcamento = $_GET['id_item_orcamento'];
}else{
    $id_item_orcamento = "";
}

if($acao == "receber"){     
    //echo $id_item_orcamento ." : ".$valor;
   $retorno = Orcamento::marcarParaReceber($id_item_orcamento, $valor);
  //  echo $retorno;
    header("Location: entrada.php?id_paciente=".$id_paciente);
}else if($acao == "cancelar"){
    $retorno = Orcamento::marcarComoExcluido($idItemEntrada);
  //  echo $retorno;
    header("Location: entrada.php?id_paciente=".$id_paciente);
}else if(isset($_GET['btn-confirmar_forma_pagamento'])){
    $valor_total = Orcamento::getValorReceber($id_paciente);
    $valor_receber_cartao = ($valor_total) - ($valor_debito_receber + $valor_dinheiro_receber);
    
    $nova_entrada = new Entrada($id_paciente, $valor_dinheiro_receber, $valor_receber_cartao, $n_parcela_cartao, $valor_debito_receber);
    
    
   // print_r($nova_entrada);
    $id_entrada = $nova_entrada->inserir();
    
    if($id_entrada > 0){
        header("Location: page_entrada.php?id_entrada=".$id_entrada);
    }else{
        
        echo $id_entrada;
     //   header("Location: inxdex.php?msg=2");
    }
}