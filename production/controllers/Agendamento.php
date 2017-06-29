<?php

include_once 'Conexao.php';
include_once './Auxiliares/Auxiliar.php';

/**
 * Description of Agendamento
 *
 * @author joao
 */
class Agendamento extends Conexao {
    private $id_agendamento;
    private $id_paciente;
    private $id_dentista;
    private $data;
    private $hora;
    private $criado_por;
    private $data_criacao;
    private $modificado_por;
    private $data_modificacao;
    private $id_status;

    
    function getId_agendamento() {
        return $this->id_agendamento;
    }

    function setId_agendamento($id_agendamento) {
        $this->id_agendamento = $id_agendamento;
    }
    
    function getId_paciente() {
        return $this->id_paciente;
    }

    
    
    function getId_dentista() {
        return $this->id_dentista;
    }

    function getData() {
        return $this->data;
    }

    function getHora() {
        return $this->hora;
    }

    function getCriado_por() {
        return $this->criado_por;
    }

    function getData_criacao() {
        return $this->data_criacao;
    }

    function getModificado_por() {
        return $this->modificado_por;
    }

    function getData_modificacao() {
        return $this->data_modificacao;
    }

    function getId_status() {
        return $this->id_status;
    }

    function setId_paciente($id_paciente) {
        $this->id_paciente = $id_paciente;
    }

    function setId_dentista($id_dentista) {
        $this->id_dentista = $id_dentista;
    }

    function setData($data) {
        $this->data = $data;
    }

    function setHora($hora) {
        $this->hora = $hora;
    }

    function setCriado_por($criado_por) {
        $this->criado_por = $criado_por;
    }

    function setData_criacao($data_criacao) {
        $this->data_criacao = $data_criacao;
    }

    function setModificado_por($modificado_por) {
        $this->modificado_por = $modificado_por;
    }

    function setData_modificacao($data_modificacao) {
        $this->data_modificacao = $data_modificacao;
    }

    function setId_status($id_status) {
        $this->id_status = $id_status;
    }

    function __construct($id_paciente, $id_dentista, $data, $hora) {
        $this->id_paciente = $id_paciente;
        $this->id_dentista = $id_dentista;
        $this->data = $data;
        $this->hora = $hora;
    }

    function inserir(){                
        try {
            $pdo = parent::getDB();
           
            $query = $pdo->prepare("INSERT INTO `agendamento`("
                    . "`id_paciente`"
                    . ", `id_dentista`"
                    . ", `data_agendamento`"
                    . ", `hora_agendamento`"
                    . ", `id_pai`" 
                    . ", `id_status`) "
                    . "VALUES "
                    . "(?,?,?,?,?,?)");        
//                        
            $query->bindValue(1, $this->getId_paciente());
            $query->bindValue(2, $this->getId_dentista());  
            $query->bindValue(3, Auxiliar::dateToUS($this->getData()));
            $query->bindValue(4, $this->getHora());            
            $query->bindValue(5, $_SESSION['id_usuario']);        
            $query->bindValue(6, '1');
            
            $query->execute();    
            
            return $pdo->lastInsertId();
          
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }   
    
    function editar(){                
        try {
            $pdo = parent::getDB();
           
            $query = $pdo->prepare("UPDATE `agendamento` "
                    . "SET "
                    . " `id_dentista`=?"
                    . ", `data_agendamento`=?"
                    . ", `hora_agendamento`=?"
                    . ", `data_modificacao`=NOW()"
                    . ", `modificado_por`=?"
                    . " WHERE "
                    . " `id_agendamento` = ?;"
                    );        
//                        
            $query->bindValue(1, $this->getId_dentista());
            $query->bindValue(2, Auxiliar::dateToUS($this->getData()));
            $query->bindValue(3, $this->getHora());
            $query->bindValue(4, $_SESSION['id_usuario']);            
            $query->bindValue(5, $this->getId_agendamento());        
            
            $query->execute();    
            
            return true;       
//            print_r($this);
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }  
    
    public static function getInformacoes($id){
        try{
            $dados = new Agendamento();            
            
            $pdo = parent::getDB();

            $query = $pdo->prepare("SELECT * FROM `agendamento` WHERE id_status = ? AND id_agendamento = ?");        

            $query->bindValue(1, "1");
            $query->bindValue(2, $id);
                            
            $query->execute();               
                           
            while($row = $query->fetch(PDO::FETCH_OBJ)){                    
                $dados->setId_agendamento($row->id_agendamento);
                $dados->setId_paciente($row->id_paciente);
                $dados->setId_dentista($row->id_dentista);
                $dados->setData(Auxiliar::dateToBR($row->data_agendamento));
                $dados->setHora($row->hora_agendamento);
                $dados->setCriado_por($row->id_pai);
                $dados->setId_status($row->id_status);
                $dados->setData_criacao($row->data_cadastro);
                $dados->setData_modificacao($row->data_modificacao);
                $dados->setModificado_por($row->modificado_por);         
             
            }
               
            return $dados;  

        } catch (Exception $ex) {
            return "";
        }
    }
    
    function excluir(){                
        try {
            $pdo = parent::getDB();
           
            $query = $pdo->prepare("UPDATE `agendamento` "
                    . "SET "
                    . "`data_modificacao`= NOW()"
                    . ", `modificado_por`=?"
                    . ", `id_status`=? "
                    . "WHERE "
                    . "id_agendamento = ?;"
                );     
              
            $query->bindValue(1, $_SESSION['id_usuario']);
            $query->bindValue(2, 2);            
            $query->bindValue(3, $this->getId_agendamento());        
            
            $query->execute();    
            
            return true;       
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }  
    
    public static function getLinhasTabela($periodo){
        try{
            if($periodo == 1){
                $buscar = "and day(a.data_agendamento) = day(now()) and month(a.data_agendamento) = month(now()) and year(a.data_agendamento) = year(now())";   
            }else{
                $buscar = "";
            }
            
            $pdo = parent::getDB();

            $query = $pdo->prepare("select a.id_agendamento as id_agendamento
                                , p.nome as paciente
                                , u.nome as dentista
                                , a.data_agendamento as data_agendamento
                                , a.hora_agendamento as hora_agendamento
                                from agendamento as a
                                inner join paciente as p on p.id_paciente = a.id_paciente and p.id_status = '1'
                                inner join usuario as u on u.id_usuario = a.id_dentista and u.status = '1'
                                where a.id_status = '1' ".$buscar."
                                order by data_agendamento, hora_agendamento" );        
                          
            $query->execute();
               
            $linhas = "";
                
            while($row = $query->fetch(PDO::FETCH_OBJ)){                    
                $linhas = $linhas . "<tr>"
                        . "<td>".Auxiliar::dateToBR($row->data_agendamento)."</td>"
                        . "<td>".$row->hora_agendamento."</td>"                        
                        . "<td>".$row->paciente."</td>"
                        . "<td>".$row->dentista."</td>"  
                        ."<td><a href='page_agendamento.php?id_agendamento=".$row->id_agendamento."'>Selecionar</a></td>"
                        . "</tr> ";                
            }
            
            //'processa_servico?excluir=true&id_servico=".$row->id_servico."' title='Excluir' 
               
            return $linhas;                
        } catch (Exception $ex) {
            return "";
        }
    }

}
