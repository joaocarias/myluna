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

if(isset($_POST['senha_atual'])){
    $obj->setSenha($_POST['senha_atual']);
}else{
    $obj->setSenha("");
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
}else if(isset($_GET['btn-cadastrar-dentista'])){
   // print_r($_GET);
    if(isset($_GET['id_usuario'])){
        $obj->setId_usuario($_GET['id_usuario']);   
    }else{
        $obj->setId_usuario("");
    }    
    
   // print_r($obj);
    
    $retorno = $obj->definirComoDentista("inserir");
   
    if($retorno == true){      
        header("Location: page_usuario.php?id_usuario=".$obj->getId_usuario()."&msg=2");
    }else{       
        header("Location: page_usuario.php?id_usuario=".$obj->getId_usuario()."&msg=0");
    }
}else if(isset($_GET['btn-remover-dentista'])){
    if(isset($_GET['id_usuario'])){
        $obj->setId_usuario($_GET['id_usuario']);        
    }else{
        $obj->setId_usuario("");
    }    
    
    $retorno = $obj->definirComoDentista("remover");
   
    if($retorno == true){      
        header("Location: page_usuario.php?id_usuario=".$obj->getId_usuario()."&msg=2");
    }else{       
        header("Location: page_usuario.php?id_usuario=".$obj->getId_usuario()."&msg=0");
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
}else if(isset($_POST['resetar_senha'])){
//  print_r($_POST);
    $retorno = $obj->atualziarSenha($obj->getCpf());
    
    if($retorno == true){
        header("Location: index.php?msg=5");
    }else{
        header("Location: index.php?msg=3");
    }
}else if(isset ($_POST['atualizar_senha'])){
    
    print_r($_POST);
//    $obj->setId_usuario($_SESSION['id_usuario']);
//    
    if($obj->testarSenha()){
        if(isset($_POST['nova_senha'])){
            $senha_nova = $_POST['nova_senha'];

            if(isset($_POST['confirmar_senha'])){
                $confirmar_senha = $_POST['confirmar_senha'];
                
                if($confirmar_senha == $senha_nova){
                    $retorno = $obj->atualziarSenha($senha_nova);
                    
                    if($retorno==true){
                        header("Location: index.php?msg=5");
                    }else{
                        header("Location: index.php?msg=3");
                    }
                }else{
                    header("Location: nova_senha.php?msg=4");
                }
            }else{
                header("Location: nova_senha.php?msg=0");
            }
        } else {
            header("Location: nova_senha.php?msg=2");
        }       
    }else{
        header("Location: nova_senha.php?msg=1");
    }
        
}else {   
    header("Location: index.php?msg=0");
}
