<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ViewEntrada
 *
 * @author joao
 */
include_once './controllers/Paciente.php';
include_once './controllers/Orcamento.php';
include_once './Auxiliares/Auxiliar.php';

class ViewEntrada {
    private $titulo;
    private $subTitulo;
   
    function getSubTitulo() {
        return $this->subTitulo;
    }

    function setSubTitulo($subTitulo) {
       $this->subTitulo = $subTitulo;
    }

      
    function getTitulo() {
       return $this->titulo;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }
    
    
    public function imprimirListaItensNaoRecebidos($idPaciente){
       $myLista = "
                <div class='x_panel'>
                  <div class='x_title'>
                    <h2>Tabela Receber Entrada</h2>                    
                    <div class='clearfix'></div>
                  </div>
                  <div class='x_content'>
                    <p class='text-muted font-13 m-b-30'>
                      Por favor, escolha os Item a ser Recebido:
                    </p>
                     <table id='datatable-responsive' class='table table-striped table-bordered dt-responsive nowrap' cellspacing='0' width='100%'>
                      <thead>
                        <tr>
                            <th></th>
                            <th>Orçamento</th>
                            <th>Dentista</th>                            
                            <th>Descrição</th>                            
                            <th>Valor R$</th> 
                            <th>Desconto</th>
                            <th>Valor a Pagar R$</th>
                        </tr>
                      </thead>
                      <tbody>                       
                          ". Orcamento::getLinhaTabelaItemNaoPago($idPaciente)."                                           
                      </tbody>
                    </table>
                  </div>
                </div>
              
";
       echo $myLista;
      
    }
    
   public function imprimirListaPacientes(){
       $myLista = "<div class='col-md-12 col-sm-12 col-xs-12'>
                <div class='x_panel'>
                  <div class='x_title'>
                    <h2>Tabela de Pacientes</h2>                    
                    <div class='clearfix'></div>
                  </div>
                  <div class='x_content'>
                    <p class='text-muted font-13 m-b-30'>
                      Por favor, escolha o Paciente:
                    </p>
                     <table id='datatable-responsive' class='table table-striped table-bordered dt-responsive nowrap' cellspacing='0' width='100%'>
                      <thead>
                        <tr>
                            <th></th>
                            <th>Código</th>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>Data de Nascimento</th>                            
                        </tr>
                      </thead>
                      <tbody>                       
                          ".  Paciente::getLinhasTabelaEntrada()."                                           
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
";
       echo $myLista;
   }  
}
