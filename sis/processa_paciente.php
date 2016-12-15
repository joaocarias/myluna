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
    //echo $retorno;
    if($retorno == true){
       // echo "<script>alert('Cadastrado com Sucesso!');</script>";
        header("Location: index.php");
    }else{
        //echo "<script>alert('Erro ao Salvar Cadastro!');</script>";
        header("Location: index.php");
    }
    //echo $retorno;
}else if(isset($_GET['btn-cancelar'])){
    echo "<script>alert('Cadastrado Cancelado!');</script>";
    header("Location: index.php");
}else{
    echo "<script>alert('Ação Desconhecida... Ação Cancelada!');</script>";
    header("Location: index.php");
}