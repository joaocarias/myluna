<?php

abstract class Conexao{
    
    //const USER = "u428736402_sis";
    //const PASS = "minhasenha";
    
	const USER = "root";
    const PASS = "";
    const BDNAME = "bd_sisgcon";
    const LOCAL = "localhost";
	
    private static $instance_ = null;
    
    private static function conectar(){
        try{
            if(self::$instance_ == null):
                //$dsn = "mysql:host=localhost;dbname=u428736402_sis";
				$dsn = "mysql:host=".self::LOCAL.";dbname=".self::BDNAME;
                self::$instance_ = new PDO($dsn, self::USER, self::PASS);
                self::$instance_->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            endif;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return self::$instance_;
    }
    
    protected static function getDB(){        
        return self::conectar();
    }
   
}