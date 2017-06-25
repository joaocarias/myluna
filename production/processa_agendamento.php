<?php

session_start();

include_once 'controllers/Agendamento.php';

$obj = new Agendamento();

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
    
    //print_r($_POST);
   // print_r($obj);
    $retorno = $obj->inserir();
//    print_r($obj);
//    
//    echo $retorno;
    
    if($retorno > 0){      
        header("Location: page_agendamento.php?id_agendamento=".$retorno."&msg=2");
    }else{       
        header("Location: index.php?msg=3");
    }   
}else if(isset($_GET['btn-cancelar'])){    
    header("Location: index.php?msg=1");
}else {   
    header("Location: index.php?msg=0");
}