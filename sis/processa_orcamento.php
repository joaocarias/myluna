<?php

session_start();

$id_paciente = "";
$dentista = "";

if(isset($_POST['id_paciente'])){
    $id_paciente = $_POST['id_paciente'];
}

if(isset($_POST['dentista'])){
    $dentista = $_POST['dentista'];
}

if(isset($_POST['btn-selecionar-dentista'])){
   // print_r($_POST);
    
    //if(){
                
    //}
    
    header("location: novo_orcamento.php?novo_orcamento=true&id_paciente=".$id_paciente."&dentista=".$dentista);
}