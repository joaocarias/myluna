<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once 'controllers/Login.php';

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
       header("Location: index.php");
    } else {
        header("Location: erro_nao_logado.php");
    }
} else {
    header("Location: erro_nao_logado.php");
}



