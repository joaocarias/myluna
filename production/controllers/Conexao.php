<?php

abstract class Conexao{
    
    //const USER = "u428736402_sis";
    //const PASS = "minhasenha";
    
//	const USER = "u568007443_luna";
//    const PASS = "minhasenha";    
//    const BDNAME = "bd_sisgcon";
//    const LOCAL = "localhost";
    
        const USER = "u568007443_luna";
    const PASS = "7XTZ4ZfwCOW3";    
    const BDNAME = "u568007443_luna";
    const LOCAL = "mysql.hostinger.com.br";
	
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