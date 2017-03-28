<?php

session_start();

include_once 'controllers/Orcamento.php';

$acao = "";
$id_paciente = "";
$id_item_orcamento = "";
$valor = "";

if(isset($_GET['acao'])){
    $acao = $_GET['acao'];    
}else{
    $acao = "";
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
}