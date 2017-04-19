<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once 'Conexao.php';
include_once './Auxiliares/Auxiliar.php';

/**
 * Description of Paciente
 *
 * @author joao
 */
class Paciente extends Conexao {
    private $id_paciente;
    private $cpf;
    private $nome;
    private $sexo;
    private $data_nascimento;
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
    
    function getId_paciente() {
        return $this->id_paciente;
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

    function setId_paciente($id_paciente) {
        $this->id_paciente = $id_paciente;
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
           
            $query = $pdo->prepare("INSERT INTO `paciente`("
                    . "`cpf`, `nome`, `sexo`, `data_nascimento`, `telefone`, "
                    . "`email`, `rua`, `numero`, `bairro`, `cep`, `cidade`, `uf`, "
                    . "`complemento`, `obs`, `id_pai`, `data_cadastro`, "
                    . "`id_status`) "
                    . "VALUES "
                    . "(?,?,?,?,?,"
                    . "?,?,?,?,?,?,?,"
                    . "?,?,?,?,"
                    . "?)");        
//                        
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
            $query->bindValue(16, Auxiliar::dateToUS(Auxiliar::getDataAtualBR()));  
            $query->bindValue(17, '1');   
            
            $query->execute();    
            
            return $pdo->lastInsertId();
          
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }    
    
    public static function getLinhasTabelaAniversariantesMes($mes){
        try{
            $pdo = parent::getDB();
            $query = $pdo->prepare("SELECT * FROM `paciente` WHERE id_status = ? "
                    . "AND MONTH(data_nascimento) = ? "
                    . "ORDER BY data_nascimento;");
            
            $query->bindValue(1, "1");
            $query->bindValue(2, $mes);
                            
            $query->execute();
               
            $linhas = "";
             while($row = $query->fetch(PDO::FETCH_OBJ)){                    
                $linhas = $linhas . "<tr>"
                        . "<td>".$row->id_paciente."</td>"
                        . "<td><a href='page_paciente.php?id_paciente=".$row->id_paciente."'>".$row->nome."</a></td>"
                        . "<td>".$row->cpf."</td>"
                        . "<td>".Auxiliar::dateToBR($row->data_nascimento)."</td>"
                        . "<td>".Auxiliar::getGenero($row->sexo)."</td>"
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
                        . "</tr> ";                
            }
               
            return $linhas;       
        } catch (Exception $ex) {

        }
    }
    
    public static function getInformacoesPacienteOrcamento($id){
        
    }
    
    public static function getInformacoes($id){
        try{
            $dados = new Paciente();            
            
            $pdo = parent::getDB();

            $query = $pdo->prepare("SELECT * FROM `paciente` WHERE id_status = ? AND id_paciente = ?" );        

            $query->bindValue(1, "1");
            $query->bindValue(2, $id);
                            
            $query->execute();               
                           
            while($row = $query->fetch(PDO::FETCH_OBJ)){                    
                $dados->setId_paciente($row->id_paciente);
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
            }
               
            return $dados;       
        } catch (Exception $ex) {
            return "";
        }
    }


    public static function getLinhasTabelaEntrada(){
        try{
            $pdo = parent::getDB();

            $query = $pdo->prepare("SELECT * FROM `paciente` WHERE id_status = ?" );        

            $query->bindValue(1, "1");
                            
            $query->execute();
               
            $linhas = "";
                
            while($row = $query->fetch(PDO::FETCH_OBJ)){                    
                $linhas = $linhas . "<tr>"
                        . "<td><a href='entrada.php?id_paciente=".$row->id_paciente."'>Escolher</a></td>"
                        . "<td><a href='entrada.php?id_paciente=".$row->id_paciente."'>".$row->id_paciente."</a></td>"
                        . "<td><a href='entrada.php?id_paciente=".$row->id_paciente."'>".$row->nome."</a></td>"
                        . "<td>".$row->cpf."</td>"
                        . "<td>".Auxiliar::dateToBR($row->data_nascimento)."</td>"
//                        . "<td>".Auxiliar::getGenero($row->sexo)."</td>"
//                        . "<td>".$row->telefone."</td>"
//                        . "<td>".$row->email."</td>"            
//                        . "<td>".$row->rua."</td>"
//                        . "<td>".$row->numero."</td>"
//                        . "<td>".$row->bairro."</td>"
//                        . "<td>".$row->cep."</td>"
//                        . "<td>".$row->cidade."</td>"
//                        . "<td>".$row->uf."</td>"
//                        . "<td>".$row->complemento."</td>"
//                        . "<td>".$row->obs."</td>"
//                        . "<td><a class='btn btn-primary btn-sm' href='editar_paciente.php?editar=true&id_paciente=".$row->id_paciente."' title='Editar'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a> <a class='btn btn-default btn-sm' href='novo_orcamento.php?novo_orcamento=true&id_paciente=".$row->id_paciente."' title='Novo Orçamento'><i class='fa fa-calculator' aria-hidden='true'></i></a> <a class='btn btn-danger btn-sm' href='processa_paciente.php?btn-excluir=true&id_paciente=".$row->id_paciente."' title='Excluir' ><i class='fa fa-trash-o' aria-hidden='true'></i></a></td>"
                        . "</tr> ";                
            }
               
            return $linhas;                
        } catch (Exception $ex) {
            return "";
        }
    }

    public static function getLinhasTabela(){
        try{
            $pdo = parent::getDB();

            $query = $pdo->prepare("SELECT * FROM `paciente` WHERE id_status = ?" );        

            $query->bindValue(1, "1");
                            
            $query->execute();
               
            $linhas = "";
                
            while($row = $query->fetch(PDO::FETCH_OBJ)){                    
                $linhas = $linhas . "<tr>"
                        . "<td>".$row->id_paciente."</td>"
                        . "<td><a href='page_paciente.php?id_paciente=".$row->id_paciente."'>".$row->nome."</a></td>"
                        . "<td>".$row->cpf."</td>"
                        . "<td>".Auxiliar::dateToBR($row->data_nascimento)."</td>"
                        . "<td>".Auxiliar::getGenero($row->sexo)."</td>"
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
                        . "<td><a class='btn btn-primary btn-sm' href='editar_paciente.php?editar=true&id_paciente=".$row->id_paciente."' title='Editar'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a> <a class='btn btn-default btn-sm' href='novo_orcamento.php?novo_orcamento=true&id_paciente=".$row->id_paciente."' title='Novo Orçamento'><i class='fa fa-calculator' aria-hidden='true'></i></a> <a class='btn btn-danger btn-sm' href='processa_paciente.php?btn-excluir=true&id_paciente=".$row->id_paciente."' title='Excluir' ><i class='fa fa-trash-o' aria-hidden='true'></i></a></td>"
                        . "</tr> ";                
            }
               
            return $linhas;                
        } catch (Exception $ex) {
            return "";
        }
     }
     
     function excluir(){                
        try {
            $pdo = parent::getDB();
           
            $query = $pdo->prepare("UPDATE `paciente` "
                    . "SET "
                    . "`data_modificacao`= NOW()"
                    . ", `modificado_por`=?"
                    . ", `id_status`=? "
                    . "WHERE "
                    . "id_paciente = ?;"
                );     
              
            $query->bindValue(1, $_SESSION['id_usuario']);
            $query->bindValue(2, 2);            
            $query->bindValue(3, $this->getId_paciente());        
            
            $query->execute();    
            
            return true;       
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }  
    
    function editar(){        
          try {
            $pdo = parent::getDB();
           
            $query = $pdo->prepare("UPDATE `paciente` SET "
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
                                    . "`id_paciente` = ?"
                    );        
                        
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
            $query->bindValue(16, $this->getId_paciente());
            
//            print_r($query);                    
            
            $query->execute();
                  
            return true;
       
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return false;
        }
    }  
        
}
