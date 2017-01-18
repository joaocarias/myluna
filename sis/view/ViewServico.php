<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once './controllers/Servico.php';

/**
 * Description of ViewServico
 *
 * @author joao
 */
class ViewServico {
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

    function imprimirForm($acao, $idServico){
        Mensagem::getMensagem(1, 1, $this->getTitulo(), "processa_servico.php");
                
       $descricao = "";
       $valor = "";
        
       if($acao == "editar" && $idServico != ""){
           $dados = Servico::getInformacoes($idServico);
           $descricao = $dados->getDescricao();
           $valor = $dados->getValor();
          
       }
       
       if($acao == "editar"){
            $btn_salvar = "<label>
                    <input type='submit' id='btn-salvar-edicao' name='btn-salvar-edicao' value='Salvar Edição' class='btn btn-success' />                                                                                           
                </label>";
        }else{
           $btn_salvar = "<label>
                    <input type='submit' id='btn-salvar' name='btn-salvar' value='Salvar' class='btn btn-success' />                                                                                           
                </label>";
        }
                        
                        
        $myForm = "<div class='col-lg-12'>
            <form method='POST' action='processa_servico.php' name='myform' id='myform' >                            
                <div class='col-sm-12'>                        
                <div class='panel panel-primary'>
                    <div class='panel-heading'>
                        <h3 class='panel-title'></h3>
                    </div>
                    <div class='panel-body'>                            
                        <div class='col-xs-4'>
                            <label for='id_servico_'>ID Servico</label>
                            <input type='text' class='form-control' id='id_servico_' name='id_servico_' value='".$idServico."' disabled='' />                            
                            <input type='hidden' id='id_servico' name='id_servico' value='".$idServico."' />
                        </div>                                            
                    </div>                    
                </div>        
                </div>
                <div class='col-sm-12'>                        
                <div class='panel panel-primary'>
                    <div class='panel-heading'>
                        <h3 class='panel-title'>Informações Básicas</h3>
                    </div>
                    <div class='panel-body'>     
                    
                        <div class='col-xs-9'>
                           <label for='descricao'>Descrição *</label>
                            <input type='text' class='form-control' id='descricao' maxlength='100' name='descricao' value='".$descricao."' required />
                        </div>
                        
                        <div class='col-xs-3'>
                            <label for='valor'>Valor R$</label>
                            <input type='text' class='form-control' id='valor' name='valor' maxlength='7' value='".$valor."' required/>
                        </div>     
                                                
                    </div>                    
                </div>          
                
                
                <div>
                    <p>
                        <label>                            
                            <button type='button' class='btn btn btn-danger' data-toggle='modal' data-target='.bs-example-modal-lg'>Cancelar</button>                           
                        </label>
                        ".$btn_salvar."                         
                    </p>
                </div>
                    
                </div>
                
            </form>         
        </div>
        
        <!-- Fim do form -->
        
";
       
                            
                            echo $myForm;
   }
   
   
   public function imprimirListaServicos(){
       
       $myLista = "<div class='col-md-12 col-sm-12 col-xs-12'>
                <div class='x_panel'>
                  <div class='x_title'>
                    <h2>Tabela de Serviços</h2>                    
                    <div class='clearfix'></div>
                  </div>
                  <div class='x_content'>
                    <p class='text-muted font-13 m-b-30'>
                      Segue a lista dos Serviços cadastrados no sistema com informações básicas.
                    </p>
                     <table id='datatable-responsive' class='table table-striped table-bordered dt-responsive nowrap' cellspacing='0' width='100%'>
                      <thead>
                        <tr>
                            <th>Código</th>
                            <th>Descrição</th>
                            <th>Valor</th>  
                            <th></th>
                        </tr>
                      </thead>

                      <tbody>
                       
                          ".Servico::getLinhasTabela()."
                                           
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
";
       echo $myLista;
   }
      
   public static function imprimirListaServicosParaOrcamento($idPaciente, $id_dentista){
       
       $myLista = "<div class='clearfix'></div>
                    <div class='row'>
                        <div class='col-md-12 col-sm-12 col-xs-12'>
                            <div class='x_panel'>
                                <div class='x_title'>
                                <h2>Lista de Serviços</h2>
                                <ul class='nav navbar-right panel_toolbox'>
                                    <li><a class='collapse-link'><i class='fa fa-chevron-up'></i></a>
                                        </li>                      
                                    <li><a class='close-link'><i class='fa fa-close'></i></a>
                                        </li>
                                </ul>
                                <div class='clearfix'></div>
                            </div>
                            <p class='text-muted font-13 m-b-30'>
                                Escolha um dos Serviços.
                            </p>
                            <table id='datatable-responsive' class='table table-striped table-bordered dt-responsive nowrap' cellspacing='0' width='100%'>
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Descrição</th>
                                        <th>Valor</th>                                        
                                    </tr>
                                </thead>
                                <tbody>                       
                                    ".Servico::getLinhasTabelaOrcamento($idPaciente, $id_dentista)."                                           
                                </tbody>
                            </table>
                        </div>
                    </div>
              </div>
";
       echo $myLista;
   }
   
}
