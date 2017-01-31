<?php

session_start();

include_once 'controllers/Orcamento.php';
include_once 'controllers/ItemOrcamento.php';

$id_paciente = "";
$id_dentista = "";
$id_orcamento = "";
$id_servico = "";
$desconto = "";
$valor = "";
$total = "";

if(isset($_POST['id_orcamento'])){
    $id_orcamento = $_POST['id_orcamento'];
}

if(isset($_GET['id_orcamento'])){
    $id_orcamento = $_GET['id_orcamento'];
}

if(isset($_POST['id_servico'])){
    $id_servico = $_POST['id_servico'];
}

if(isset($_POST['desconto'])){
    $desconto = $_POST['desconto'];
}

if(isset($_POST['valor'])){
    $valor = $_POST['valor'];
}

if(isset($_POST['total'])){
    $total = $_POST['total'];
}

if(isset($_POST['id_paciente'])){
    $id_paciente = $_POST['id_paciente'];
}

if(isset($_POST['dentista'])){
    $id_dentista = $_POST['dentista'];
}

if(isset($_POST['btn-selecionar-dentista'])){
   
    $novo_orcamento = new Orcamento();
    $novo_orcamento->setId_paciente($id_paciente);
    $novo_orcamento->setId_dentista($id_dentista);
    $novo_orcamento->setId_pai($_SESSION['id_usuario']);
    
    $retorno = $novo_orcamento->inserir();    
    
    header("location: novo_orcamento.php?novo_orcamento=true&id_orcamento=".$retorno);
}else if(isset($_POST['btn-confirmar'])){
    
    $item_orcamento = new ItemOrcamento();
    $item_orcamento->setId_orcamento($id_orcamento);
    $item_orcamento->setId_servico($id_servico);
    $item_orcamento->setValor($valor);
    $item_orcamento->setDesconto($desconto);
    $item_orcamento->setTotal($total);
    
    $retorno = $item_orcamento->inserir();
    
    header("location: novo_orcamento.php?novo_orcamento=true&id_orcamento=".$id_orcamento);
    
}else if(isset($_GET['remover_item'])){
    if($_GET['remover_item'] == 'true'){
        
        $id_item_orcamento = -1;
        
        if($_GET['id_item_orcamento']){
            $id_item_orcamento = $_GET['id_item_orcamento'];
            
            $item_orcamento = new ItemOrcamento();
            $item_orcamento->setId_item_orcamento($id_item_orcamento);
            
            $item_orcamento->remover($id_item_orcamento);
            
            if($_GET['novo_orcamento']){
                header("location: novo_orcamento.php?novo_orcamento=true&id_orcamento=".$id_orcamento);
            }            
        }
    }
}else if(isset($_GET['btn-cancelar'])){    
    $retorno = "";
    
    if($id_orcamento != ""){
        $orcamento = new Orcamento();
        $orcamento->setId_orcamento($id_orcamento);
        $retorno = $orcamento->cancelar();
    }
    
    //print_r($_GET);
    
    //echo " Retorno: ".$retorno;
    header("Location: index.php?msg=1");
}else if(isset($_POST['btn-salvar'])){
    if($id_orcamento != ""){
        $orcamento = new Orcamento();
        $orcamento->setId_orcamento($id_orcamento);
        $retorno = $orcamento->ativar();
        header("Location: index.php?msg=2");
    }
}
else {   
    header("Location: index.php?msg=0");
}