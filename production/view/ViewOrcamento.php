<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once './controllers/Orcamento.php';

/**
 * Description of ViewOrcamento
 *
 * @author joao
 */
class ViewOrcamento {
    private $titulo;
    private $subTitulo;
    
    function getTitulo() {
        return $this->titulo;
    }

    function getSubTitulo() {
        return $this->subTitulo;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setSubTitulo($subTitulo) {
        $this->subTitulo = $subTitulo;
    }


    public function imprimirListaDeOrcamento(){
           $myLista = "<div class='col-md-12 col-sm-12 col-xs-12'>
                <div class='x_panel'>
                  <div class='x_title'>
                    <h2>".$this->getSubTitulo()."</h2>                    
                    <div class='clearfix'></div>
                  </div>
                  <div class='x_content'>
                    <p class='text-muted font-13 m-b-30'>
                      Segue a lista de Orçamentos:
                    </p>
                     <table id='datatable-responsive' class='table table-striped table-bordered dt-responsive nowrap' cellspacing='0' width='100%'>
                      <thead>
                        <tr>                            
                            <th>Código</th>
                            <th>Data</th>
                            <th>Paciente</th>
                            <th>Dentista</th>
                            <th>Serviços</th>
                            <th>Total R$</th>
                        </tr>
                      </thead>

                      <tbody>
                       
                          ". Orcamento::getLinhasTabelaOrcamento()."
                                           
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
";
       echo $myLista;     
    }
    
    
}
