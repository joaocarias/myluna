<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Login
 *
 * @author joao
 */
include_once 'Conexao.php';

session_start();

class Login extends Conexao  {
    
    
    public static function autentica($login, $senha){
        
        //$senha_cp = md5($senha);
        
          $senha_cp = $senha;
    
          try{
              $pdo = parent::getDB();

                $logar = $pdo->prepare("SELECT * FROM usuario WHERE login = ? AND senha = ?;");        

                $logar->bindValue(1, $login);
                $logar->bindValue(2, $senha_cp);        
                $logar->execute();

                if($logar->rowCount()== 1):
                    $dados = $logar->fetch(PDO::FETCH_OBJ);
                    $_SESSION['id_usuario'] = $dados->id_usuario;
                    $_SESSION['nome'] = $dados->nome;
                    $_SESSION['login'] = $dados->login;
                    $_SESSION['tipo'] = $dados->id_tipo;                    
                    $_SESSION['logado'] = 1;
                else:
                    $_SESSION['logado'] = 0;
                endif;
          } catch (Exception $ex) {
               $_SESSION['logado'] = 0;  
          }
                
    }
}
