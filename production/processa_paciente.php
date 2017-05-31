<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();

include_once 'controllers/Paciente.php';

$obj = new Paciente();

if(isset($_POST['id_paciente'])){
    $obj->setId_paciente($_POST['id_paciente']);
}else{
    $obj->setId_paciente("");;    
}

if(isset($_POST['cpf'])){
    $obj->setCpf($_POST['cpf']);
}else{
    $obj->setCpf("");
}

if(isset($_POST['nome'])){
    $obj->setNome($_POST['nome']);
}else{
    $obj->setNome("");
}

if(isset($_POST['sexo'])){
    $obj->setSexo($_POST['sexo']);
}else{
    $obj->setSexo("");
}

if(isset($_POST['data_nascimento'])){
    $obj->setData_nascimento($_POST['data_nascimento']);
}else{
    $obj->setData_nascimento("");
}

if(isset($_POST['email'])){
    $obj->setEmail($_POST['email']);
}else{
    $obj->setEmail("");
}

if(isset($_POST['telefone'])){
    $obj->setTelefone($_POST['telefone']);
}else{
    $obj->setTelefone("");
}

if(isset($_POST['obs'])){
    $obj->setObs($_POST['obs']);
}else{
    $obj->setObs("");
}

if(isset($_POST['rua'])){
    $obj->setRua($_POST['rua']);
}else{
    $obj->setRua("");
}

if(isset($_POST['numero'])){
    $obj->setNumero($_POST['numero']);
}else{
    $obj->setNumero("");
}

if(isset($_POST['complemento'])){
    $obj->setComplemento($_POST['complemento']);
}else{
    $obj->setComplemento("");
}

if(isset($_POST['bairro'])){
    $obj->setBairro($_POST['bairro']);
}else{
    $obj->setBairro("");
}

if(isset($_POST['cep'])){
    $obj->setCep($_POST['cep']);
}else{
    $obj->setCep("");
}

if(isset($_POST['cidade'])){
    $obj->setCidade($_POST['cidade']);
}else{
    $obj->setCidade("");
}

if(isset($_POST['uf'])){
    $obj->setUf($_POST['uf']);
}else{
    $obj->setUf("");
}

if(isset($_POST['btn-salvar'])){
    $retorno = $obj->inserir();
    if($retorno > 0){      
        header("Location: page_paciente.php?id_paciente=".$retorno."&msg=2");
    }else{       
        header("Location: index.php?msg=3");
    }   
}else if(isset($_GET['btn-cancelar'])){    
    header("Location: index.php?msg=1");
}else if(isset($_GET['btn-excluir'])){

    if(isset($_GET['id_paciente'])){
        $obj->setId_paciente($_GET['id_paciente']);   
    }else{
        $obj->setId_paciente("");
    }    
    
    $retorno = $obj->excluir();
   
    if($retorno == true){      
        header("Location: index.php?msg=4");
    }else{       
        header("Location: index.php?msg=0");
    }
}else if(isset($_POST['btn-salvar-edicao'])){ 
    
   $retorno = $obj->editar();
//   echo $retorno;
   
    if($retorno == true){      
        header("Location: index.php?msg=2");
    }else{       
        header("Location: index.php?msg=3");
    }   
}else {   
    header("Location: index.php?msg=0");
}