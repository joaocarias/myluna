<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once 'controllers/Login.php';
include_once 'controllers/LogAcesso.php';

session_start();

if(isset($_POST['username'])){
    $username_ = $_POST['username'];
}else{
    $username_ = "";
}

if(isset($_POST['password'])){
    $password_ = $_POST['password'];
}else{
    $password_ = "";
}

if($username_ != "" && $password_ != ""){
    $_SESSION['login'] = $username_;
    $_SESSION['senha'] = $password_;
    
    Login::autentica($_SESSION['login'], $_SESSION['senha']);
    
    if ($_SESSION['logado'] == 1) {
       $log = new LogAcesso($_SESSION['id_usuario'], $_SESSION['login'], "PERMITIDO", '1');
       $log->inserir();
       header("Location: index.php");
    } else {
        $log = new LogAcesso(null, $_SESSION['login'], "NEGADO", '1');
//        $retorno = $log->inserir();
//        echo $retorno;
        header("Location: erro_nao_logado.php");
    }
} else {
    header("Location: erro_nao_logado.php");
}



