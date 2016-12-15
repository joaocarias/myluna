<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();

include_once 'controllers/Fornecedor.php';

$obj = new Fornecedor();

if(isset($_POST['id_fornecedor'])){
    $obj->setId_fornecedor($_POST['id_fornecedor']);
}else{
    $obj->setId_fornecedor("");;    
}

if(isset($_POST['cpf_cnpj'])){
    $obj->setcpf_Cnpj($_POST['cpf_cnpj']);
}else{
    $obj->setcpf_Cnpj("");
}

if(isset($_POST['nome'])){
    $obj->setNome($_POST['nome']);
}else{
    $obj->setNome("");
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
    //echo $retorno;
    if($retorno == true){
       // echo "<script>alert('Cadastrado com Sucesso!');</script>";
        header("Location: index.php?msg=2");
    }else{
        //echo "<script>alert('Erro ao Salvar Cadastro!');</script>";
        header("Location: index.php?msg=3");
    }
    //echo $retorno;
}else if(isset($_GET['btn-cancelar'])){    
    header("Location: index.php?msg=1");
}else{   
    header("Location: index.php?msg=0");
}