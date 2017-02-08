<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once 'Conexao.php';
include_once './Auxiliares/Auxiliar.php';
include_once 'ItemOrcamento.php';

/**
 * Description of Orcamento
 *
 * @author joao
 */
class Orcamento extends Conexao{
    private $id_orcamento;
    private $id_paciente;
    private $id_dentista;
    private $id_pai; 
    private $data_cadastro;
    private $data_modificacao;
    private $modificado_por;
    private $status;
    
    function getId_orcamento() {
        return $this->id_orcamento;
    }

    function getId_paciente() {
        return $this->id_paciente;
    }

    function getId_dentista() {
        return $this->id_dentista;
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

    function setId_orcamento($id_orcamento) {
        $this->id_orcamento = $id_orcamento;
    }

    function setId_paciente($id_paciente) {
        $this->id_paciente = $id_paciente;
    }

    function setId_dentista($id_dentista) {
        $this->id_dentista = $id_dentista;
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

    public function cancelar(){
        try{
            $pdo = parent::getDB();
            
            $query = $pdo->prepare("UPDATE `orcamento` "
                    . "SET "
                    . "`id_status`='4'"
                    . ",`data_modificacao`=NOW()"
                    . ",`modificado_por`= ? "
                    . "WHERE "
                    . "`id_orcamento` = ?");
            
            
            $query->bindValue(1, $_SESSION['id_usuario']);
            $query->bindValue(2, $this->getId_orcamento());
            
            $query->execute();
            
           // echo "<script>alert('".$this->getId_orcamento()."');<script>";
            
            ItemOrcamento::cancelarOrcamento($this->getId_orcamento());
            
            return $this->getId_orcamento();            
        } catch (Exception $ex) {
            return -1;
        }
    }
    
    public function ativar(){
        try{
            $pdo = parent::getDB();
            
            $query = $pdo->prepare("UPDATE `orcamento` "
                    . "SET "
                    . "`id_status`='1'"
                    . ",`data_modificacao`=NOW()"
                    . ",`modificado_por`= ? "
                    . "WHERE "
                    . "`id_orcamento` = ?");
            
            
            $query->bindValue(1, $_SESSION['id_usuario']);
            $query->bindValue(2, $this->getId_orcamento());
            
            $query->execute();
            
           // echo "<script>alert('".$this->getId_orcamento()."');<script>";
            
            ItemOrcamento::ativarItemOrcamento($this->getId_orcamento());
            
            return $this->getId_orcamento();            
        } catch (Exception $ex) {
            return -1;
        }
    }
    
    public function inserir(){
        try{
            $pdo = parent::getDB();
            
            $query = $pdo->prepare("INSERT INTO orcamento "
                    . "("
                    . "id_paciente"
                    . ", id_dentista"
                    . ", id_pai"
                    . ", id_status"
                    . ", data_cadastro"
                    . ") "
                   // . "OUTPUT INSERTED.id_orcamento "
                    . "VALUES ("
                    . "?,?,?,?,NOW());");
            
            $query->bindvalue(1, $this->getId_paciente());
            $query->bindValue(2, $this->getId_dentista());
            $query->bindValue(3, $this->getId_pai());
            $query->bindValue(4, '3');            
            
            $query->execute();
            
            //$retorno = $query->fetch(PDO::FETCH_ASSOC);
            
            return $pdo->lastInsertId();            
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    
    public static function getValorTotalDoOrcamento($idOrcamento, $idStatus){
        try{
            $pdo = parent::getDB();
            $query = $pdo->prepare("SELECT SUM(total) AS soma FROM item_orcamento "
                    . "WHERE id_orcamento = ? AND id_status = ?;");
            $query->bindValue(1, $idOrcamento);
            $query->bindValue(2, $idStatus);
            
            $query->execute();
            
            $valorTotal = 0;
            
            while($row = $query->fetch(PDO::FETCH_OBJ)){
                $valorTotal = $row->soma;
            }
                    
            return $valorTotal;
        } catch (Exception $ex) {
            return 0;
        }
    }
    
    public static function getInformacoes($id, $idStatus){
        try{
            $dados = new Orcamento();            
            
            $pdo = parent::getDB();

            $query = $pdo->prepare("SELECT * FROM `orcamento` WHERE id_status = ? AND id_orcamento = ?" );        

            $query->bindValue(1, $idStatus);
            $query->bindValue(2, $id);
                            
            $query->execute();               
                           
            while($row = $query->fetch(PDO::FETCH_OBJ)){                    
                $dados->setId_orcamento($row->id_orcamento);
                $dados->setId_paciente($row->id_paciente);
                $dados->setId_dentista($row->id_dentista);
                $dados->setId_pai($row->id_pai);
                $dados->setData_cadastro($row->data_cadastro);
                $dados->setData_modificacao($row->data_modificacao);
                $dados->setModificado_por($row->modificado_por);            
                $dados->setStatus($row->id_status);                      
            }
               
            return $dados;       
        } catch (Exception $ex) {
            return "";
        }
    }
    
    
    public static function getArrayListOrcamento($idPaciente){
        try{
            $pdo = parent::getDB();

            $query = $pdo->prepare("SELECT * FROM `orcamento` "
                                   . "WHERE  "                    
                                        . "id_status = ?"
                                        . "AND idPaciente = ?"
                    );        

            $query->bindValue(1, "1");
            $query->bindValue(2, $idPaciente);
                            
            $query->execute();
               
            $lista = Array();
            $i = 0;
                
            while($row = $query->fetch(PDO::FETCH_OBJ)){       
                $obj = new Orcamento();
                $obj->setId_orcamento($row->id_orcamento);
                $obj->setId_paciente($row->id_paciente);
                $lista[i] = $obj;   
                $i++;
            }
               
            return $orcamento;    
            return null;
        } catch (Exception $ex) {
            return null;
        }
    }
    
    public static function getLinhasTabelaOrcamento(){
         $pdo = parent::getDB();
            $query = $pdo->prepare("SELECT o.id_orcamento, DATE_FORMAT(o.data_cadastro,'%d/%m/%Y') as data_cadastro
                                    , p.nome as paciente, u.nome as dentista, p.id_paciente as id_paciente
                                    FROM `orcamento` o
                                    INNER JOIN paciente p ON o.id_paciente = p.id_paciente
                                    INNER JOIN usuario u ON u.id_usuario = o.id_dentista
                                    WHERE o.id_status = 1 
                                    ORDER BY id_orcamento DESC;");
                            
                            
            $query->execute();
               
            $linhas = "";
             while($row = $query->fetch(PDO::FETCH_OBJ)){                    
                $linhas = $linhas . "<tr>"
                        . "<td><a href='page_orcamento.php?id_orcamento=".$row->id_orcamento."'>".$row->id_orcamento."</a></td>"
                        . "<td>".$row->data_cadastro."</td>"
                        . "<td><a href='page_paciente.php?id_paciente=".$row->id_paciente."'>".$row->paciente."</a></td>"
                        . "<td>".$row->dentista."</td>"
                        . "<td>".ItemOrcamento::getListaItensOrcamento($row->id_orcamento, '1')."</td>" 
                        . "<td>".self::getValorTotalDoOrcamento($row->id_orcamento, '1')."</td> "                       
                        . "</tr> ";                
            }
               
            return $linhas;               
    }
    
    public  static function getLinhasTabelaOrcamentoPaciente($idPaciente){
        $pdo = parent::getDB();
            $query = $pdo->prepare("SELECT o.id_orcamento, DATE_FORMAT(o.data_cadastro,'%d/%m/%Y') as data_cadastro
                                    , p.nome as paciente, u.nome as dentista, p.id_paciente as id_paciente
                                    FROM `orcamento` o
                                    INNER JOIN paciente p ON o.id_paciente = p.id_paciente AND o.id_paciente = ?
                                    INNER JOIN usuario u ON u.id_usuario = o.id_dentista
                                    WHERE o.id_status = 1 
                                    ORDER BY id_orcamento DESC;");
                                        
            $query->bindValue(1, $idPaciente);
            
            $query->execute();
               
            $linhas = "";
             while($row = $query->fetch(PDO::FETCH_OBJ)){                    
                $linhas = $linhas . "<tr>"
                        . "<td><a href='page_orcamento.php?id_orcamento=".$row->id_orcamento."'>".$row->id_orcamento."</a></td>"
                        . "<td>".$row->data_cadastro."</td>"
                    //    . "<td><a href='page_paciente.php?id_paciente=".$row->id_paciente."'>".$row->paciente."</a></td>"
                        . "<td>".$row->dentista."</td>"
                        . "<td>".ItemOrcamento::getListaItensOrcamento($row->id_orcamento, '1')."</td>" 
                        . "<td>".self::getValorTotalDoOrcamento($row->id_orcamento, '1')."</td> "                       
                        . "</tr> ";                
            }
               
            return $linhas; 
    }
    
}
