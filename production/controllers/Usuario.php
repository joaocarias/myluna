<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario
 *
 * @author joao
 */

include_once 'Conexao.php';
include_once './Auxiliares/Auxiliar.php';
include_once 'TipoUsuario.php';

class Usuario extends Conexao{
    private $id_usuario;
    private $cpf;
    private $nome;
    private $sexo;
    private $data_nascimento;
    private $telefone;
    private $email;    
    private $login;
    private $senha;
    private $id_tipo;    
    private $rua;
    private $numero;    
    private $bairro;
    private $cep;
    private $cidade;
    private $uf;
    private $complemento;
    private $obs;
    private $comissao;
    private $id_pai; 
    private $data_cadastro;
    private $data_modificacao;
    private $modificado_por;
    private $status;
    private $funcao_dentista;
    
    function getFuncao_dentista() {
        return $this->funcao_dentista;
    }

    function setFuncao_dentista($funcao_dentista) {
        $this->funcao_dentista = $funcao_dentista;
    }
        
    function getId_usuario() {
        return $this->id_usuario;
    }

    function getCpf() {
        return $this->cpf;
    }

    function getNome() {
        return $this->nome;
    }

    function getSexo() {
        return $this->sexo;
    }

    function getData_nascimento() {
        return $this->data_nascimento;
    }

    function getTelefone() {
        return $this->telefone;
    }

    function getEmail() {
        return $this->email;
    }

    function getLogin() {
        return $this->login;
    }

    function getSenha() {
        return $this->senha;
    }

    function getId_tipo() {
        return $this->id_tipo;
    }

    function getRua() {
        return $this->rua;
    }

    function getNumero() {
        return $this->numero;
    }

    function getBairro() {
        return $this->bairro;
    }

    function getCep() {
        return $this->cep;
    }

    function getCidade() {
        return $this->cidade;
    }

    function getUf() {
        return $this->uf;
    }

    function getComplemento() {
        return $this->complemento;
    }

    function getObs() {
        return $this->obs;
    }

    function getComissao() {
        return $this->comissao;
    }

    function getId_pai() {
        return $this->id_pai;
    }

    function getData_cadastro() {
        return $this->data_cadastro;
    }

    function getData_modificacao() {
        return $this->data_modificacao;
    }

    function getModificado_por() {
        return $this->modificado_por;
    }

    function getStatus() {
        return $this->status;
    }

    function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    function setData_nascimento($data_nascimento) {
        $this->data_nascimento = $data_nascimento;
    }

    function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }

    function setId_tipo($id_tipo) {
        $this->id_tipo = $id_tipo;
    }

    function setRua($rua) {
        $this->rua = $rua;
    }

    function setNumero($numero) {
        $this->numero = $numero;
    }

    function setBairro($bairro) {
        $this->bairro = $bairro;
    }

    function setCep($cep) {
        $this->cep = $cep;
    }

    function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    function setUf($uf) {
        $this->uf = $uf;
    }

    function setComplemento($complemento) {
        $this->complemento = $complemento;
    }

    function setObs($obs) {
        $this->obs = $obs;
    }

    function setComissao($comissao) {
        $this->comissao = $comissao;
    }

    function setId_pai($id_pai) {
        $this->id_pai = $id_pai;
    }

    function setData_cadastro($data_cadastro) {
        $this->data_cadastro = $data_cadastro;
    }

    function setData_modificacao($data_modificacao) {
        $this->data_modificacao = $data_modificacao;
    }

    function setModificado_por($modificado_por) {
        $this->modificado_por = $modificado_por;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function inserir(){                
        try {
            $pdo = parent::getDB();
           
            $query = $pdo->prepare("INSERT INTO `usuario`("
                    . " `cpf`, `nome`, `sexo`, "
                    . "`data_nascimento`, `telefone`, `email`, `login`, `senha`, "
                    . "`id_tipo`, `rua`, `numero`, `bairro`, `cep`, `cidade`, "
                    . "`uf`, `complemento`, `obs`, `id_pai`, `data_cadastro`, "
                    . "`comissao`, `status`)"
                    . " VALUES "
                    . "(?,?,"
                    . "?,?,?,?"
                    . ",?,?,?"
                    . ",?,?,?,?,?,?"
                    . ",?,?"
                    . ",?,?,?,?"                    
                    . ")");        
//                        
            $query->bindValue(1, $this->getCpf());
            $query->bindValue(2, $this->getNome());  
            $query->bindValue(3, $this->getSexo());
            
            $query->bindValue(4, Auxiliar::dateToUS($this->getData_nascimento()));        
            $query->bindValue(5, $this->getTelefone());
            $query->bindValue(6, $this->getEmail());
            $query->bindValue(7, $this->getCpf());
            $query->bindValue(8, $this->getCpf());
            
            $query->bindValue(9, $this->getId_tipo());            
            $query->bindValue(10, $this->getRua());
            $query->bindValue(11, $this->getNumero());            
            $query->bindValue(12, $this->getBairro());
            $query->bindValue(13, $this->getCep());        
            $query->bindValue(14, $this->getCidade());
            
            $query->bindValue(15, $this->getUf());  
            $query->bindValue(16, $this->getComplemento());                          
            $query->bindValue(17, $this->getObs());                          
//            
            $query->bindValue(18, $_SESSION['id_usuario']);            
            $query->bindValue(19, Auxiliar::dateToUS(Auxiliar::getDataAtualBR()));  
            $query->bindValue(20, $this->getComissao());        
            $query->bindValue(21, '1');   
            
            $query->execute();    
            
//            if(!$pdo->errorCode()){
                return true;
//            }
//            return false;           
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }    
    
    public static function getNomePorId($id){
        try{
            $pdo = parent::getDB();
           
            $query = $pdo->prepare("SELECT nome FROM `usuario` WHERE id_usuario = ? and status = '1'; ");
            
            $query->bindValue(1, $id);
            
            $query->execute();            
            
      
            if($query->rowCount()== 1):
                $dados = $query->fetch(PDO::FETCH_OBJ);                    
                return $dados->nome;
            else:
                return "";
            endif;

            
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    
    
    public static function primeiroNome($id){        
        try{
            $pdo = parent::getDB();
           
            $query = $pdo->prepare("SELECT Substring_index(nome,' ',1) as "
                    . "primeiro_nome FROM `usuario` WHERE id_usuario = ?; ");
            
            $query->bindValue(1, $id);
            
            $query->execute();            
            
//            if(!$pdo->errorCode()){
            if($query->rowCount()== 1):
                $dados = $query->fetch(PDO::FETCH_OBJ);                    
                return $dados->primeiro_nome;
            else:
                return "Usuario Não Encontrado: ".$id;
            endif;
//          }
            
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    
    public static function primeiroESegundoNomeUsuarioLogado(){
        setlocale(LC_CTYPE, 'pt_BR');
        $var = $_SESSION['nome'];
        $nome_explore =  explode(" ", $var);

        if(count($nome_explore) > 0){
            $primeiro_nome = $nome_explore[0];
            
            if(count($nome_explore) > 1){
                $segundo_nome = $nome_explore[1];
                
                $nome = ucwords(strtolower($primeiro_nome." ".$segundo_nome));
                return $nome;
            }else{
                $nome = ucwords(strtolower($primeiro_nome));
                return $nome;
            }            
        }else{
            return "";
        }         
    }
    
    public static function getLinhasTabela(){
        try{
            $pdo = parent::getDB();

            $query = $pdo->prepare("SELECT * FROM `usuario` WHERE id_usuario != ? AND status = ?" );        

            $query->bindValue(1, "1");
            $query->bindValue(2, "1");
                
            $query->execute();
               
            $linhas = "";
                
            while($row = $query->fetch(PDO::FETCH_OBJ)){                    
                $linhas = $linhas . "<tr>"
                        . "<td>".$row->id_usuario."</td>"
                        . "<td><a href='page_usuario.php?id_usuario=".$row->id_usuario."'>".$row->nome."</a></td>"
                        . "<td>".$row->cpf."</td>"
                        . "<td>".Auxiliar::dateToBR($row->data_nascimento)."</td>"
                        . "<td>".Auxiliar::getGenero($row->sexo)."</td>"
                        . "<td>".$row->telefone."</td>"
                        . "<td>".$row->email."</td>"
                        . "<td>".TipoUsuario::getDescricaoPorID($row->id_tipo)."</td>"
                        . "<td>".$row->comissao."%</td>"
                        . "<td>".$row->rua."</td>"
                        . "<td>".$row->numero."</td>"
                        . "<td>".$row->bairro."</td>"
                        . "<td>".$row->cep."</td>"
                        . "<td>".$row->cidade."</td>"
                        . "<td>".$row->uf."</td>"
                        . "<td>".$row->complemento."</td>"
                        . "<td>".$row->obs."</td>"
                        . "<td><a class='btn btn-primary btn-sm' href='editar_usuario.php?editar=true&id_usuario=".$row->id_usuario."' title='Editar'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> <a class='btn btn-danger btn-sm' href='processa_usuario.php?btn-excluir=true&id_usuario=".$row->id_usuario."' title='Excluir' ><i class='fa fa-trash-o' aria-hidden='true'></i></td>"                      
                        . "</tr> ";                
            }
               
            return $linhas;                
        } catch (Exception $ex) {
            return "";
        }
    }
        
     public static function getOpcoesSelecaoDentista(){
        try{
             $pdo = parent::getDB();
                $query = $pdo->prepare("SELECT nome, id_usuario "
                        . "FROM usuario "
                        . "WHERE "
                        . "funcao_dentista = '1' AND status = '1';" );   
                $query->execute();
                $option = "";                
               while($row = $query->fetch(PDO::FETCH_OBJ)){   
                   $option = $option . "<option value='".$row->id_usuario."'>".$row->nome."</option>";
               }                
                return $option;                
        } catch (Exception $ex) {
            return "";
        }
    }
    
    public static function getOpcoesSelecaoDentistaSelecionar($idSelecionado){
        try{
             $pdo = parent::getDB();
                $query = $pdo->prepare("SELECT nome, id_usuario "
                        . "FROM usuario "
                        . "WHERE "
                        . " funcao_dentista = '1' AND status = '1';" );   
                $query->execute();
                $option = "";                
               while($row = $query->fetch(PDO::FETCH_OBJ)){   
                   if($row->id_usuario == $idSelecionado){
                       $selectionar = "selected='selected'";
                   }else{
                       $selectionar = "";
                   }                   
                   $option = $option . "<option value='".$row->id_usuario."' ".$selectionar.">".$row->nome."</option>";
               }                
                return $option;                
        } catch (Exception $ex) {
            return "";
        }
    }
    
    public static function getInformacoes($id){
        try{
            $dados = new Usuario();            
            
            $pdo = parent::getDB();

            $query = $pdo->prepare("SELECT * FROM `usuario` WHERE status = ? AND id_usuario = ?" );        

            $query->bindValue(1, "1");
            $query->bindValue(2, $id);
                            
            $query->execute();               
                           
            while($row = $query->fetch(PDO::FETCH_OBJ)){                    
                $dados->setId_usuario($row->id_usuario);
                $dados->setNome($row->nome);
                $dados->setCpf($row->cpf);
                $dados->setData_nascimento($row->data_nascimento);
                $dados->setSexo($row->sexo);
                $dados->setTelefone($row->telefone);
                $dados->setEmail($row->email);            
                $dados->setRua($row->rua);
                $dados->setNumero($row->numero);
                $dados->setBairro($row->bairro);
                $dados->setCep($row->cep);
                $dados->setCidade($row->cidade);
                $dados->setUf($row->uf);
                $dados->setComplemento($row->complemento);
                $dados->setObs($row->obs); 
                $dados->setId_tipo($row->id_tipo);
                $dados->setComissao($row->comissao);
                $dados->setFuncao_dentista($row->funcao_dentista);
            }
               
            return $dados;       
        } catch (Exception $ex) {
            return "";
        }
    }
    
    public static function getInformacoesCPF($cpf){
        try{
            $dados = new Usuario();            
            
            $pdo = parent::getDB();

            $query = $pdo->prepare("SELECT * FROM `usuario` WHERE status = ? AND cpf = ?" );        

            $query->bindValue(1, "1");
            $query->bindValue(2, $cpf);
                            
            $query->execute();               
                           
            while($row = $query->fetch(PDO::FETCH_OBJ)){                    
                $dados->setId_usuario($row->id_usuario);
                $dados->setNome($row->nome);
                $dados->setCpf($row->cpf);
                $dados->setData_nascimento($row->data_nascimento);
                $dados->setSexo($row->sexo);
                $dados->setTelefone($row->telefone);
                $dados->setEmail($row->email);            
                $dados->setRua($row->rua);
                $dados->setNumero($row->numero);
                $dados->setBairro($row->bairro);
                $dados->setCep($row->cep);
                $dados->setCidade($row->cidade);
                $dados->setUf($row->uf);
                $dados->setComplemento($row->complemento);
                $dados->setObs($row->obs); 
                $dados->setId_tipo($row->id_tipo);
                $dados->setComissao($row->comissao);
                $dados->setFuncao_dentista($row->funcao_dentista);                
            }
               
            return $dados;       
        } catch (Exception $ex) {
            return "";
        }
    }
          
    function excluir(){                
        try {
            $pdo = parent::getDB();
           
            $query = $pdo->prepare("UPDATE `usuario` "
                    . "SET "
                    . "`data_modificacao`= NOW()"
                    . ", `modificado_por`=?"
                    . ", `status`=? "
                    . "WHERE "
                    . "id_usuario = ?;"
                );        
                        
           // $query->bindValue(1, $this->getDescricao());            
         //   $query->bindValue(3, Auxiliar::dateToUS(Auxiliar::getDataAtualBR()));            
            $query->bindValue(1, $_SESSION['id_usuario']);
            $query->bindValue(2, 2);            
            $query->bindValue(3, $this->getId_usuario());        
                        
            $query->execute();    
            
            
            return true;
       
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }  
    
    function definirComoDentista($acao){
        try {
            $funcao = 1;
            
            if($acao == "remover"){
                $funcao = 0;
            }
            
            $pdo = parent::getDB();
           
            $query = $pdo->prepare("UPDATE `usuario` "
                    . " SET "
                    . " `data_modificacao`= NOW() "
                    . ", `modificado_por`= '".$_SESSION['id_usuario']."' "
                    . ", `funcao_dentista`= ".$funcao." "
                    . " WHERE "
                    . " id_usuario = '".$this->getId_usuario()."';");        
                                   
//            $query->bindValue(1, ;
//            $query->bindValue(2, $funcao);            
//            $query->bindValue(3, $this->getId_usuario());  
            
         //   print_r($query);
                        
          $query->execute();    
            
                        
            return true;       
        } catch (Exception $ex) {
            return false;
        }
    }
            
    function editar(){
        try {
            $pdo = parent::getDB();
            
            if($this->getId_usuario() == $_SESSION['id_usuario']){
                $sql = "UPDATE `usuario` SET"                         
                        . "`cpf`=?"
                        . ",`nome`=?"
                        . ",`sexo`=?"
                        . ",`data_nascimento`=?"
                        . ",`telefone`=?"
                        . ",`email`=?"
                        . ",`rua`=?"
                        . ",`numero`=?"
                        . ",`bairro`=?"
                        . ",`cep`=?"
                        . ",`cidade`=?"
                        . ",`uf`=?"
                        . ",`complemento`=?"
                        . ",`obs`=?"
                        . ",`data_modificacao`=NOW()"
                        . ",`modificado_por`=?"
                        . " WHERE "
                        . "id_usuario = ?";
                
                $query = $pdo->prepare($sql); 
                
                $query->bindValue(1, $this->getCpf());
                $query->bindValue(2, $this->getNome());            
                $query->bindValue(3, $this->getSexo());
                $query->bindValue(4, Auxiliar::dateToUS($this->getData_nascimento()));
                $query->bindValue(5, $this->getTelefone());
                $query->bindValue(6, $this->getEmail());
                $query->bindValue(7, $this->getRua());
                $query->bindValue(8, $this->getNumero());
                $query->bindValue(9, $this->getBairro());
                $query->bindValue(10, $this->getCep());
                $query->bindValue(11, $this->getCidade());
                $query->bindValue(12, $this->getUf());
                $query->bindValue(13, $this->getComplemento());
                $query->bindValue(14, $this->getObs());
                $query->bindValue(15, $_SESSION['id_usuario']);
                $query->bindValue(16, $this->getId_usuario());     
                
            }else{
               $sql = "UPDATE `usuario` SET"                         
                       // . "`cpf`=?"
                        . "`nome`=?"
                        . ",`sexo`=?"
                        . ",`data_nascimento`=?"
                        . ",`telefone`=?"
                        . ",`email`=?"
                        . ",`rua`=?"
                        . ",`numero`=?"
                        . ",`bairro`=?"
                        . ",`cep`=?"
                        . ",`cidade`=?"
                        . ",`uf`=?"
                        . ",`complemento`=?"
                        . ",`obs`=?"
                        . ",`data_modificacao`= NOW()"
                        . ",`modificado_por`=?"
                        . ",`id_tipo`=?"
                        . ",`comissao`=?"
                        . " WHERE "
                        . "id_usuario = ?";
                
                $query = $pdo->prepare($sql); 
                              
                $query->bindValue(1, $this->getNome());            
                $query->bindValue(2, $this->getSexo());
                $query->bindValue(3, Auxiliar::dateToUS($this->getData_nascimento()));
                $query->bindValue(4, $this->getTelefone());
                $query->bindValue(5, $this->getEmail());
                $query->bindValue(6, $this->getRua());
                $query->bindValue(7, $this->getNumero());
                $query->bindValue(8, $this->getBairro());
                $query->bindValue(9, $this->getCep());
                $query->bindValue(10, $this->getCidade());
                $query->bindValue(11, $this->getUf());
                $query->bindValue(12, $this->getComplemento());
                $query->bindValue(13, $this->getObs());
                $query->bindValue(14, $_SESSION['id_usuario']);
                $query->bindValue(15, $this->getId_tipo());
                $query->bindValue(16, $this->getComissao());
                $query->bindValue(17, $this->getId_usuario());
            }              
            $query->execute();   
            return true;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
        
    }
    
    function atualziarSenha($novaSenha){
        try{
            $pdo = parent::getDB();
           
            $query = $pdo->prepare("UPDATE `usuario` "
                    . "SET "
                    . "`data_modificacao`= NOW()"
                    . ", `modificado_por`=?"
                    . ", `senha`=? "
                    . "WHERE "
                    . "id_usuario = ?;"
                );        
                        
           // $query->bindValue(1, $this->getDescricao());            
         //   $query->bindValue(3, Auxiliar::dateToUS(Auxiliar::getDataAtualBR()));            
            $query->bindValue(1, $_SESSION['id_usuario']);
            $query->bindValue(2, $novaSenha);            
            $query->bindValue(3, $this->getId_usuario());        
                        
            $query->execute();    
            
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }
    
    public function  testarSenha(){
        try{
            $pdo = parent::getDB();
            $query = $pdo->prepare("SELECT COUNT(id_usuario) as cont FROM "
                    . " usuario "
                    . " WHERE "
                    . " id_usuario = ? "
                    . " AND senha = ? "
                    . " AND status = 1;");
            
            $query->bindValue(1, $this->getId_usuario());
            $query->bindValue(2, $this->getSenha());
            
          
            
            $query->execute();
            
            $cont = 0;
            
            while($row = $query->fetch(PDO::FETCH_OBJ)){
                $cont = $row->cont;
            }
            
            if($cont > 0){
                return true;
            }else{
                return false;
            }
        } catch (Exception $ex) {
            return false;
        }
    }
    
    public static function semFuncaoDeDentista($id){
         try{
            $pdo = parent::getDB();
            $query = $pdo->prepare("SELECT COUNT(id_usuario) as cont FROM "
                    . " usuario "
                    . " WHERE "
                    . " id_usuario = ? "                    
                    . " AND funcao_dentista = ? "
                    . " AND status = 1; ");
            
            $query->bindValue(1, $id);           
            $query->bindValue(2, '0');
            
            $query->execute();
//            
            $cont = 0;
            
            while($row = $query->fetch(PDO::FETCH_OBJ)){
                $cont = $row->cont;
            }
            
            if($cont > 0){
                return true;
            }else{
                return false;
            }
        } catch (Exception $ex) {
            return false;
        }
    }
}
