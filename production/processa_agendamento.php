<?php

session_start();

include_once 'controllers/Agendamento.php';

$obj = new Agendamento();

if(isset($_POST['id_agendamento'])){
    $obj->setId_agendamento($_POST['id_agendamento']);
}else {
    $obj->setId_agendamento("");
}

if(isset($_POST['id_paciente'])){
    $obj->setId_paciente($_POST['id_paciente']);
}else {
    $obj->setId_paciente("");
}

if(isset($_POST['dentista'])){
    $obj->setId_dentista($_POST['dentista']);
}else {
    $obj->setId_dentista("");
}

if(isset($_POST['data'])){
    $obj->setData($_POST['data']);
}else {
    $obj->setData("");
}

if(isset($_POST['hora'])){
    $obj->setHora($_POST['hora']);
}else {
    $obj->setHora("");
}

if(isset($_POST['btn-salvar'])){
    $retorno = $obj->inserir();
//  
    if($retorno > 0){      
        header("Location: page_agendamento.php?id_agendamento=".$retorno."&msg=2");
    }else{       
        header("Location: index.php?msg=3");
    }   
}else if(isset($_GET['btn-cancelar'])){    
    header("Location: index.php?msg=1");
}else if(isset($_POST['btn-salvar-edicao'])){ 
    
 $retorno = $obj->editar();
// print_r($obj);
   // echo $retorno;
//   
    if($retorno == true){      
        header("Location: page_agendamento.php?msg=2&id_agendamento=".$obj->getId_agendamento());
    }else{       
        header("Location: index.php?msg=3");
    }   
    
    //print_r($_POST);
}else if(isset($_GET['btn_excluir'])){
    if(isset($_GET['id_agendamento'])){
        $obj->setId_agendamento($_GET['id_agendamento']);   
    }else{
        $obj->setId_agendamento("");
    }        
    $retorno = $obj->excluir();
   
    if($retorno == true){      
        header("Location: index.php?msg=4");
    }else{       
        header("Location: index.php?msg=0");
    }    
}else {   
    header("Location: index.php?msg=0");    
}