<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();

//print_r($_POST);

include_once 'controllers/Servico.php';

$obj = new Servico();

if(isset($_POST['id_servico'])){
    $obj->setId_servico($_POST['id_servico']);
//    echo "entrou no id_servidor";
}else{
    $obj->setId_servico("");    
//    echo "não entrou";
}

if(isset($_POST['descricao'])){
    $obj->setDescricao($_POST['descricao']);
}else{
    $obj->setDescricao("");    
}

if(isset($_POST['valor'])){
    $obj->setValor($_POST['valor']);
}else{
    $obj->setValor("");    
}

//print_r($_POST);
if(isset($_POST['btn-salvar'])){
    $retorno = $obj->inserir();
   
    if($retorno == true){      
        header("Location: index.php?msg=2");
    }else{       
        header("Location: index.php?msg=3");
    }   
}else if(isset($_GET['btn-cancelar'])){    
    header("Location: index.php?msg=1");
}else if(isset($_GET['btn-excluir'])){

    if(isset($_GET['id_servico'])){
        $obj->setId_servico($_GET['id_servico']);   
    }else{
        $obj->setId_servico("");
    }    
    
    $retorno = $obj->excluir();
   
    if($retorno == true){      
        header("Location: index.php?msg=4");
    }else{       
        header("Location: index.php?msg=0");
    }
}else if(isset($_POST['btn-salvar-edicao'])){ 
    
//    print_r($obj);
    
   $retorno = $obj->editar();
   
    if($retorno == true){      
        header("Location: index.php?msg=2");
    }else{       
        header("Location: index.php?msg=3");
    }   
}else {   
    header("Location: index.php?msg=0");
}