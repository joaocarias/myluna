<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();

include_once 'controllers/Usuario.php';

$obj = new Usuario();

if(isset($_POST['id_usuario'])){
    $obj->setId_usuario($_POST['id_usuario']);
}else{
    $obj->setId_usuario("");;    
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

if(isset($_POST['tipo'])){
    $obj->setId_tipo($_POST['tipo']);
}else{
    $obj->setId_tipo("");
}

if(isset($_POST['comissao'])){
    $obj->setComissao($_POST['comissao']);
}else{
    $obj->setComissao("");
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
    if($retorno == true){      
        header("Location: index.php?msg=2");
    }else{       
        header("Location: index.php?msg=3");
    }   
}else if(isset($_GET['btn-cancelar'])){    
    header("Location: index.php?msg=1");
}else if(isset($_GET['btn-excluir'])){

    if(isset($_GET['id_usuario'])){
        $obj->setId_usuario($_GET['id_usuario']);   
    }else{
        $obj->setId_usuario("");
    }    
    
    $retorno = $obj->excluir();
   
    if($retorno == true){      
        header("Location: index.php?msg=4");
    }else{       
        header("Location: index.php?msg=0");
    }
}else if(isset($_POST['btn-salvar-edicao'])){ 
    
   $retorno = $obj->editar();
   
    if($retorno == true){      
        header("Location: index.php?msg=2");
    }else{       
        header("Location: index.php?msg=3");
    }   
    
   // print_r($_POST);
//   echo $retorno;
}else {   
    header("Location: index.php?msg=0");
}