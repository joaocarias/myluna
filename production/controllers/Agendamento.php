<?php

include_once 'Conexao.php';
include_once './Auxiliares/Auxiliar.php';

/**
 * Description of Agendamento
 *
 * @author joao
 */
class Agendamento extends Conexao {
    private $id_paciente;
    private $id_dentista;
    private $data;
    private $hora;
    private $criado_por;
    private $data_criacao;
    private $modificado_por;
    private $data_modificacao;
    private $id_status;

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

}
