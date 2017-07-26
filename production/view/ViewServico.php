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
   
   public static function getItensDoOrcamento($idOrcamento, $idStatus){
          
       if($idStatus == '1'){
           $inicio_row = "<div class='row'>";
           $fim_row = "</div>";
           $tamanho_tabela = "<div class='col-md-12 col-sm-12 col-xs-12'>";
           $acao_cabecalho = "";
           $botoes = "";           
       }else{
           $tamanho_tabela = "<div class='col-md-6 col-sm-6 col-xs-12'>";
           $acao_cabecalho = "<th></th>";
           $botoes = "<div class='col-xs-12' style='text-align:right'>
                                <form method='POST' action='processa_orcamento.php'>
                                    <label>                            
                                        <button type='button' class='btn btn btn-danger' data-toggle='modal' data-target='.bs-example-modal-lg'>Cancelar</button>                           
                                    </label>
                                
                                    <label>
                                        <input type='hidden' id='id_orcamento' name='id_orcamento' value='".$idOrcamento."' />
                                        <input type='submit' id='btn-salvar' name='btn-salvar' value='Finalizar Orçamento' class='btn btn-success' />                                                                                           
                                    </label>
                                </form>
                              </div>
                              </div>
              </div>";
           $inicio_row = "";
           $fim_row = "";
       }
       
       $myLista = $inicio_row . $tamanho_tabela . "
                <div class='x_panel'>
                  <div class='x_title'>
                    <h2>Serviços do Orçamento <small>Selecionados</small></h2>
                    <ul class='nav navbar-right panel_toolbox'>
                      <li><a class='collapse-link'><i class='fa fa-chevron-up'></i></a>
                      </li>
                    </ul>
                    <div class='clearfix'></div>
                  </div>
                  <div class='x_content'>

                    <table class='table'>                     
                        <thead>
                            <tr>"
                                 .$acao_cabecalho.                                     
                                "<th>Descrição</th>
                                <th>Valor</th>  
                                <th>Desconto</th>
                                <th>Valor Pagar<th>
                            </tr>
                        </thead>
                        <tbody>                       
                            ".Servico::getLinhasTabelaItensOrcamento($idOrcamento, $idStatus)."
                        </tbody>
                    </table>
                    <p class='text-muted font-20 m-b-30'>
                                <strong>Valor do Orcamento: R$ ".Orcamento::getValorTotalDoOrcamento($idOrcamento, $idStatus)."</strong>
                    </p>
                  </div>
                </div>
              
                    ".$botoes."
              
              </div>" . $fim_row;
       echo $myLista;
   }
           
   public static function imprimirFormServicoOrcamento($idOrcamento, $idServico){
       $dados = Servico::getInformacoes($idServico);
       
       $myForm = "<div class='clearfix'></div>
                    <div class='row'>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                            <div class='x_panel'>
                                <div class='x_title'>
                                    <h2>Serviço<small>Confirme</h2>
                                    <ul class='nav navbar-right panel_toolbox'>
                                        <li><a class='collapse-link'><i class='fa fa-chevron-up'></i></a>
                                        </li>
                                    </ul>
                                    <div class='clearfix'></div>
                                </div>
                                <div class='x_content'>
                            

             <form class='form-horizontal form-label-left' method='POST' action='processa_orcamento.php' name='myform' id='myform' > 
                                   
                    <div class='form-group'>
                        <label class='control-label col-md-3 col-sm-3 col-xs-3'>ID Serviço: </label>
                        <div class='col-md-4 col-sm-4 col-xs-9'>
                            <input type='text' class='form-control' id='id_servico_' name='id_servico_' value='".$idServico."' disabled='' />                            
                            <input type='hidden' id='id_servico' name='id_servico' value='".$idServico."' />  
                                 <input type='hidden' id='id_orcamento' name='id_orcamento' value='".$idOrcamento."' />  
                        </div>
                    </div>
                                
                    <div class='form-group'>
                        <label class='control-label col-md-3 col-sm-3 col-xs-3'>Descrição: </label>
                        <div class='col-md-8 col-sm-8 col-xs-9'>
                            <input type='text' class='form-control' id='descricao_' maxlength='100' name='descricao_' value='".$dados->getDescricao()."' disabled />
                        </div>
                    </div>
                    
                   <div class='form-group'>
                        <label class='control-label col-md-3 col-sm-3 col-xs-3'>Valor: </label>
                        <div class='col-md-4 col-sm-4 col-xs-9'>
                            <input type='text' class='form-control' id='valor' name='valor' maxlength='7' value='".  Auxiliar::convParaReal($dados->getValor())."' disabled/>
                                <input type='hidden' id='valor' name='valor' value='".$dados->getValor()."'/>
                        </div>  
                   </div>
                   
                    <div class='form-group'>
                        <label class='control-label col-md-3 col-sm-3 col-xs-3'>Valor a Pagar (R$): </label>
                        <div class='col-md-4 col-sm-4 col-xs-9'>
                            <input type='text' class='form-control' id='total' name='total' maxlength='7' value='".  Auxiliar::convParaReal($dados->getValor())."' required/>                                
                        </div>
                    </div>
                       
                    <div class='form-group'>
                        <div class='col-md-9 col-md-offset-3'>
                                <input type='submit' id='btn-confirmar' name='btn-confirmar' value='Adicionar' class='btn btn-success' />                                                                                                  
                        </div>
                    </div>
                </form>
            </div>
            </di>
</div>
</div>
                
";
       echo $myForm;
   }
   
   public function imprimirForm($acao, $idServico){
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
                        
                        
        $myForm = " <div class='row'>
            <div class='col-md-12 col-sm-12 col-xs-12'>
                <div class='x_panel'>
                    <div class='x_title'>
                        <h2>Serviço</h2>
                        <ul class='nav navbar-right panel_toolbox'>
                            <li><a class='collapse-link'><i class='fa fa-chevron-up'></i></a>
                            </li>                      
                            <li><a class='close-link'><i class='fa fa-close'></i></a>
                            </li>
                        </ul>
                        <div class='clearfix'></div>
                    </div>
                    <div class='x_content'>          
            <form class='form-horizontal form-label-left' method='POST' action='processa_servico.php' name='myform' id='myform' >                            
                    
                        <div>
                            <input type='hidden' id='id_servico' name='id_servico' value='".$idServico."' />
                        </div>                                            
                        
                        <div class='form-group'>
                            <label class='control-label col-md-3 col-sm-3 col-xs-12'>Descrição: </label>
                            <div class='col-md-8 col-sm-8 col-xs-12'>
                                <input type='text' class='form-control' id='descricao' maxlength='100' minlength='4' name='descricao' value='".$descricao."' required />
                            </div>
                        </div>
                       
                        <div class='form-group'>
                            <label class='control-label col-md-3 col-sm-3 col-xs-12'>Valor R$: </label>
                            <div class='col-md-4 col-sm-4 col-xs-12'>
                                <input type='text' class='form-control' id='valor' name='valor' maxlength='7' value='".$valor."' required/>
                            </div>     
                        </div>
                                                
                    </div>                    
                </div>          
                
                
                <div class='form-group'>
                        <div class='col-md-9 col-md-offset-3'>                                                                              
                            <button type='button' class='btn btn btn-danger' data-toggle='modal' data-target='.bs-example-modal-lg'>Cancelar</button>                           
                       
                        ".$btn_salvar."                         
                    </div>
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
      
   public static function imprimirListaServicosParaOrcamento($idOrcamento){
       $myLista = "
           <div class='clearfix'></div>
            <div class='row'>
                 <div class='col-md-6 col-sm-6 col-xs-12'>
                <div class='x_panel'>
                  <div class='x_title'>
                    <h2>Lista de Serviços <small>Selecione o Serviço</small></h2>
                    <ul class='nav navbar-right panel_toolbox'>
                      <li><a class='collapse-link'><i class='fa fa-chevron-up'></i></a>
                      </li>
                    </ul>
                    <div class='clearfix'></div>
                  </div>
                  <div class='x_content'>

                    <table class='table'>                     
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Descrição</th>
                                <th>Valor</th>                                        
                            </tr>
                        </thead>
                        <tbody>                       
                            ".Servico::getLinhasTabelaOrcamento($idOrcamento)."                                           
                        </tbody>
                    </table>

                  </div>
                </div>
              </div>";              
               
       echo $myLista;
   }
   
   
   
   public static function imprimirListaServicosDoOrcamento($idOrcamento){
                   
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
                                    ".Servico::getLinhasTabelaOrcamento($idOrcamento)."                                           
                                </tbody>
                            </table>
                        </div>
                    </div>
              </div>
";
       echo $myLista;
   }
   
}
