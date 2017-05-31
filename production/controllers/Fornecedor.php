<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Fornecedor
 *
 * @author joao
 */

include_once 'Conexao.php';
include_once './Auxiliares/Auxiliar.php';

class Fornecedor extends Conexao {
    private $id_fornecedor;
    private $cpf_cnpj;
    private $nome;   
    private $telefone;
    private $email;
    private $rua;
    private $numero;    
    private $bairro;
    private $cep;
    private $cidade;
    private $uf;
    private $complemento;
    private $obs;    
    private $id_pai; 
    private $data_cadastro;
    private $data_modificacao;
    private $modificado_por;
    private $status;
    
    function getId_fornecedor() {
        return $this->id_fornecedor;
    }

    function getCpf_cnpj() {
        return $this->cpf_cnpj;
    }

    function getNome() {
        return $this->nome;
    }

    function getTelefone() {
        return $this->telefone;
    }

    function getEmail() {
        return $this->email;
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

    function setId_fornecedor($id_fornecedor) {
        $this->id_fornecedor = $id_fornecedor;
    }

    function setCpf_cnpj($cpf_cnpj) {
        $this->cpf_cnpj = $cpf_cnpj;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    function setEmail($email) {
        $this->email = $email;
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
           
            $query = $pdo->prepare("INSERT INTO `fornecedor`("
                    . "`cpf_cnpj`, `nome`, `telefone`, "
                    . "`email`, `rua`, `numero`, `bairro`, `cep`, `cidade`, `uf`, "
                    . "`complemento`, `obs`, `id_pai`, `data_cadastro`, "
                    . "`id_status`) "
                    . "VALUES "
                    . "(?,?,?,"
                    . "?,?,?,?,?,?,?,"
                    . "?,?,?,?,"
                    . "?)");        
//                        
            $query->bindValue(1, $this->getCpf_cnpj());
            $query->bindValue(2, $this->getNome());
            $query->bindValue(3, $this->getTelefone());
            
            $query->bindValue(4, $this->getEmail());
            $query->bindValue(5, $this->getRua());
            $query->bindValue(6, $this->getNumero());            
            $query->bindValue(7, $this->getBairro());
            $query->bindValue(8, $this->getCep());        
            $query->bindValue(9, $this->getCidade());            
            $query->bindValue(10, $this->getUf());  
            
            $query->bindValue(11, $this->getComplemento());                          
            $query->bindValue(12, $this->getObs()); 
            $query->bindValue(13, $_SESSION['id_usuario']);            
            $query->bindValue(14, Auxiliar::dateToUS(Auxiliar::getDataAtualBR()));  
            $query->bindValue(15, '1');   
            
            $query->execute();    
            
            return $pdo->lastInsertId();;
          
        } catch (Exception $ex) {
            return -1;
        }
    }   
    
    
    public static function getLinhasTabela(){
        try{
            $pdo = parent::getDB();

            $query = $pdo->prepare("SELECT * FROM `fornecedor` WHERE id_status = ?" );        

            $query->bindValue(1, "1");
                            
            $query->execute();
               
            $linhas = "";
                
            while($row = $query->fetch(PDO::FETCH_OBJ)){                    
                $linhas = $linhas . "<tr>"
                        . "<td>".$row->id_fornecedor."</td>"
                        . "<td><a href='page_fornecedor.php?id_fornecedor=".$row->id_fornecedor."'>".$row->nome."</a></td>"
                        . "<td>".$row->cpf_cnpj."</td>"                        
                        . "<td>".$row->telefone."</td>"
                        . "<td>".$row->email."</td>"            
                        . "<td>".$row->rua."</td>"
                        . "<td>".$row->numero."</td>"
                        . "<td>".$row->bairro."</td>"
                        . "<td>".$row->cep."</td>"
                        . "<td>".$row->cidade."</td>"
                        . "<td>".$row->uf."</td>"
                        . "<td>".$row->complemento."</td>"
                        . "<td>".$row->obs."</td>"
                        . "<td><a class='btn btn-primary btn-sm' href='editar_fornecedor.php?editar=true&id_fornecedor=".$row->id_fornecedor."' title='Editar'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> <a class='btn btn-danger btn-sm' href='processa_fornecedor.php?btn-excluir=true&id_fornecedor=".$row->id_fornecedor."' title='Excluir' ><i class='fa fa-trash-o' aria-hidden='true'></i></td>"
                        . "</tr> ";                
            }
               
            return $linhas;                
        } catch (Exception $ex) {
            return "";
        }
     }
     
      public static function getInformacoes($id){
        try{
            $dados = new Fornecedor();            
            
            $pdo = parent::getDB();

            $query = $pdo->prepare("SELECT * FROM `fornecedor` WHERE id_status = ? AND id_fornecedor = ?");        

            $query->bindValue(1, "1");
            $query->bindValue(2, $id);
                            
            $query->execute();               
                           
            while($row = $query->fetch(PDO::FETCH_OBJ)){                    
                $dados->setId_fornecedor($row->id_fornecedor);
                $dados->setNome($row->nome);
                $dados->setCpf_cnpj($row->cpf_cnpj);                
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
            }
               
            return $dados;       
        } catch (Exception $ex) {
            return "";
        }
    }
    

    function excluir(){                
        try {
            $pdo = parent::getDB();
           
            $query = $pdo->prepare("UPDATE `fornecedor` "
                    . "SET "
                    . "`data_modificacao`= NOW()"
                    . ", `modificado_por`=?"
                    . ", `id_status`=? "
                    . "WHERE "
                    . "id_fornecedor = ?;"
                );     
              
            $query->bindValue(1, $_SESSION['id_usuario']);
            $query->bindValue(2, 2);            
            $query->bindValue(3, $this->getId_fornecedor());        
            
            $query->execute();    
            
            return true;       
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }  
    
    function editar(){        
          try {
            $pdo = parent::getDB();
           
            $query = $pdo->prepare("UPDATE `fornecedor` SET "
                                    . "`cpf_cnpj`=?"
                                    . ",`nome`=?"
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
                                    . "`id_fornecedor` = ?"
                    );        
                        
            $query->bindValue(1, $this->getCpf_cnpj());
            $query->bindValue(2, $this->getNome());
            $query->bindValue(3, $this->getTelefone());
            $query->bindValue(4, $this->getEmail());
            $query->bindValue(5, $this->getRua());
            $query->bindValue(6, $this->getNumero());
            $query->bindValue(7, $this->getBairro());
            $query->bindValue(8, $this->getCep());
            $query->bindValue(9, $this->getCidade());
            $query->bindValue(10, $this->getUf());            
            $query->bindValue(11, $this->getComplemento());
            $query->bindValue(12, $this->getObs());
            $query->bindValue(13, $_SESSION['id_usuario']);
            $query->bindValue(14, $this->getId_fornecedor());
            
            $query->execute();
                  
            return true;
       
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return false;
        }
    }  
    
    
    public static function getLinhasTabelaSaida(){
        try{
            $pdo = parent::getDB();

            $query = $pdo->prepare("SELECT * FROM `fornecedor` WHERE id_status = ?" );        

            $query->bindValue(1, "1");
                            
            $query->execute();
               
            $linhas = "";
                
            while($row = $query->fetch(PDO::FETCH_OBJ)){                    
                $linhas = $linhas . "<tr>"
                        . "<td>".$row->id_fornecedor."</td>"
                        . "<td><a href='nova_saida.php?id_fornecedor=".$row->id_fornecedor."'>".$row->nome."</a></td>"
                        . "<td>".$row->cpf_cnpj."</td>"
                        . "<td>".$row->cidade." - ".$row->uf."</td>"                        
                        . "</tr> ";                
            }
               
            return $linhas;                
        } catch (Exception $ex) {
            return "";
        }
    }
    
    public function inserirServico($descricao_servico){
      
            try {
            $pdo = parent::getDB();
           
            $query = $pdo->prepare("insert into servico_fornecedor ("
                    . "id_fornecedor"
                    . ", descricao"
                    . ", id_pai"
                    . ", id_status"
                    . ") values "
                    . "(?,?,?,?);");        
//                        
            $query->bindValue(1, $this->getId_fornecedor());
            $query->bindValue(2, $descricao_servico);
            $query->bindValue(3, $_SESSION['id_usuario']);
            $query->bindValue(4, '1');
            
            $query->execute();    
            
            return $pdo->lastInsertId();;
          
        } catch (Exception $ex) {
            return -1;
        }       
    }
           
    public static function getLinhasTabelaServicoSaida($id_fornecedor){
        try{
            $lista = "";
            $i = 1;
            $pdo = parent::getDB();
            
            $query = $pdo->prepare("SELECT * FROM servico_fornecedor"
                    . " WHERE "
                    . " id_fornecedor = ? AND id_status = '1'");
            
            $query->bindValue(1,  $id_fornecedor);
            
            $query->execute();
            
            while ($row = $query->fetch(PDO::FETCH_OBJ)) {
                $lista = $lista . "<tr>"
                        . "<td>".$i."</td>"
                        . "<td><a href='nova_saida.php?id_fornecedor=".$id_fornecedor."&id_servico=".$row->id_servico."'>".$row->descricao."</a></td>"
                        . "<td><a href='nova_saida.php?id_fornecedor=".$id_fornecedor."&id_servico=".$row->id_servico."'>Selecionar</a></td>"
                    ."</tr>";
                $i++;  
            }
            
            return $lista;
        } catch (Exception $ex) {
            return "1";
        }
    }
}
