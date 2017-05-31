<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



session_start();

include_once 'controllers/ServicoFornecedorSaida.php';
include_once 'controllers/ServicoFornecedor.php';

$id_fornecedor = 0;
$id_servico_fornecedor_saida = 0;

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
  $retorno = $obj->inserir();

  $dados = ServicoFornecedor::getInformacoes($obj->getId_servico_fornecedor());    
  
  $id_fornecedor = $dados->getId_fornecedor();    
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
}else{
    header("Location: index.php?msg=0");
}
