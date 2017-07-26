
<?php

/**
 * Description of ViewEntrada
 *
 * @author joao
 */

include_once './controllers/Paciente.php';
include_once 'ViewUsuario.php';
include_once './controllers/Agendamento.php';
include_once './controllers/Usuario.php';
include_once 'view/ViewPaciente.php';


class ViewAgendamento {
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
    
    public function getTabelaPacientesAgendamento(){
        $linhas = Paciente::getLinhasTabelaPacientesAgendamento();
        
        
            echo "<div class='col-md-12 col-sm-12 col-xs-12'>
                <div class='x_panel'>
                  <div class='x_title'>
                    <h2>Pacientes</h2>                    
                    <div class='clearfix'></div>
                  </div>
                  <div class='x_content'>
                    <p class='text-muted font-9 m-b-30'>
                      Segue a lista dos Pacientes:
                    </p>
                     <table id='datatable-responsive' class='table table-striped table-bordered dt-responsive nowrap' cellspacing='0' width='100%'>
                      <thead>
                        <tr>
                            <th>Nome</th>
                            <th>CPF</th>                           
                            <th>Nº da Ficha</th>                            
                            <th>Cidade</th>
                            <th>UF</th>   
                            <th></th>
                        </tr>
                      </thead>
                      <tbody>                       
                          ".  $linhas."                                           
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>";
        
        
    }
    
    function imprimirFormPeriodoData(){
       $my_form = "<div class='row'>
            <div class='col-md-12 col-sm-12 col-xs-12'>
                <div class='x_panel'>
                    <div class='x_title'>
                        <h2>Informe o Período</h2>
                        <ul class='nav navbar-right panel_toolbox'>
                            <li><a class='collapse-link'><i class='fa fa-chevron-up'></i></a>
                            </li>                      
                            <li><a class='close-link'><i class='fa fa-close'></i></a>
                            </li>
                        </ul>
                        <div class='clearfix'></div>
                    </div>
                    <div class='x_content'>      
                        <form class='form-horizontal form-label-left' method='GET' action='lista_agendamento.php' name='myform' id='myform' > 
                            <input type='hidden' id='periodo' name='periodo' value='2' />
                        <div class='form-group'>
                                <label class='control-label col-md-3 col-sm-3 col-xs-3'>De: </label>
                                <div class='col-md-4 col-sm-6 col-xs-9'>
                                    <input type='text' class='form-control' name='de' id='de' data-inputmask='\"mask\": \"99/99/9999\"'>
                                </div>
                            </div>
                            
                            <div class='form-group'>
                                <label class='control-label col-md-3 col-sm-3 col-xs-3'>Até: </label>
                                <div class='col-md-4 col-sm-4 col-xs-9'>
                                    <input type='text' class='form-control' name='ate' id='ate' data-inputmask='\"mask\": \"99/99/9999\"'>
                                </div>
                            </div>
                            

                    <div class='form-group'>
                        <div class='col-md-9 col-md-offset-3 '>
                                                   
                            <input type='submit' class='btn btn-primary' value='Buscar Relatório' />                           
                        
                            </div>
                      </div>

                    </form>  
        </div>
        </div>
        </div>

                ";
       
       echo $my_form;
          
    }
    
    function imprimirForm($acao, $id_paciente){
       Mensagem::getMensagem(1, 1, $this->getTitulo(), "processa_agendamento.php");
       
        $id_dentista = "";
        $data_visita = "";
        $hora_visita = "";
                   
             
        $btn_salvar = "
                    <input type='submit' id='btn-salvar' name='btn-salvar' value='Salvar' class='btn btn-success' />                                                                                           
                ";
       
   
       $myForm = "<div class='row'>
            <div class='col-md-12 col-sm-12 col-xs-12'>
                <div class='x_panel'>
                    <div class='x_title'>
                        <h2>Agendamento</h2>
                        <ul class='nav navbar-right panel_toolbox'>
                            <li><a class='collapse-link'><i class='fa fa-chevron-up'></i></a>
                            </li>                      
                            <li><a class='close-link'><i class='fa fa-close'></i></a>
                            </li>
                        </ul>
                        <div class='clearfix'></div>
                    </div>
                    <div class='x_content'>      
                        <form class='form-horizontal form-label-left' method='POST' action='processa_agendamento.php' name='myform' id='myform' > 
                            <input type='hidden' id='id_paciente' name='id_paciente' value='".$id_paciente."' />
                      
                            <div class='form-group'>
                                <label class='control-label col-md-3 col-sm-3 col-xs-3'>Dentista: </label>
                                <div class='col-md-4 col-sm-4 col-xs-4'>
                                    <select class='form-control' id='dentista' name='dentista' >      
                                        ".Usuario::getOpcoesSelecaoDentista()."
                                    </select>
                                </div>
                            </div>
                      
                            <div class='form-group'>
                                <label class='control-label col-md-3 col-sm-3 col-xs-3'>Data: </label>
                                <div class='col-md-4 col-sm-4 col-xs-4'>
                                    <input type='text' class='form-control' name='data' id='data' data-inputmask='\"mask\": \"99/99/9999\"'>
                                </div>
                            </div>
                            
                            <div class='form-group'>
                                <label class='control-label col-md-3 col-sm-3 col-xs-3'>Horário: </label>
                                <div class='col-md-4 col-sm-4 col-xs-4'>
                                    <input type='text' class='form-control' name='hora' id='hora' data-inputmask='\"mask\": \"99:99\"'>
                                </div>
                            </div>
                                            
                      <div class='ln_solid'></div>

                      <div class='form-group'>
                        <div class='col-md-9 col-md-offset-3'>
                                                   
                            <button type='button' class='btn btn btn-danger' data-toggle='modal' data-target='.bs-example-modal-lg'>Cancelar</button>                           
                       
                          ".$btn_salvar."   
                        </div>
                      </div>

                    </form>  
        </div>
        </div>
        </div>
        
        <!-- Fim do form -->
         
         ";
                            
                            echo $myForm;
   }
   
   function imprimirFormEditar($id){
        try{
           Mensagem::getMensagem(1, 1, $this->getTitulo(), "processa_agendamento.php");
           $dados = Agendamento::getInformacoes($id);
           
          if($dados != null or $dados !=""){
              $viewPaciente = new ViewPaciente();
              
              $viewPaciente->imprimirInformacoesBasicasPaciente($dados->getId_paciente());
           
                $myForm = "
                <div class='x_panel'>
                    <div class='x_title'>
                        <h2>Agendamento</h2>
                        <ul class='nav navbar-right panel_toolbox'>
                            <li><a class='collapse-link'><i class='fa fa-chevron-up'></i></a>
                            </li>                      
                            <li><a class='close-link'><i class='fa fa-close'></i></a>
                            </li>
                        </ul>
                        <div class='clearfix'></div>
                    </div>
                    <div class='x_content'>      
                        <form class='form-horizontal form-label-left' method='POST' action='processa_agendamento.php' name='myform' id='myform' > 
                            <input type='hidden' id='id_agendamento' name='id_agendamento' value='".$dados->getId_agendamento()."' />
                      
                            <div class='form-group'>
                                <label class='control-label col-md-3 col-sm-3 col-xs-3'>Dentista: </label>
                                <div class='col-md-4 col-sm-4 col-xs-4'>
                                        <select class='form-control' id='dentista' name='dentista' >      
                                        ".Usuario::getOpcoesSelecaoDentistaSelecionar($dados->getId_dentista())."
                                    </select>
                                </div>
                            </div>
                      
                            <div class='form-group'>
                                <label class='control-label col-md-3 col-sm-3 col-xs-3'>Data: </label>
                                <div class='col-md-4 col-sm-4 col-xs-4'>
                                    <input type='text' value='".$dados->getData()."' class='form-control' name='data' id='data'>
                                </div>
                            </div>
                            
                            <div class='form-group'>
                                <label class='control-label col-md-3 col-sm-3 col-xs-3'>Horário: </label>
                                <div class='col-md-4 col-sm-4 col-xs-4'>
                                    <input type='text' value='".$dados->getHora()."' class='form-control' name='hora' id='hora'>
                                </div>
                            </div>
                                            
                      <div class='ln_solid'></div>

                      <div class='form-group'>
                        <div class='col-md-9 col-md-offset-3'>
                                                   
                            <button type='button' class='btn btn btn-danger' data-toggle='modal' data-target='.bs-example-modal-lg'>Cancelar</button>    
                            <input type='submit' class='btn btn btn-primary' name='btn-salvar-edicao' id='btn-salvar-edicao' value='Salvar'>    
                            
                        </div>
                      </div>

                    </form>  
                   </div>
                   
                    <!-- Fim do form -->
         
         ";
        }else{
               $myForm = "Não encontrado nenhum registro!";
           }
//                            
            echo $myForm;
           
       } catch (Exception $ex) {
           echo "Não encontrado nenhum registro!";
       }
   }
   
   public function informacoesBasicas($id){
       try{
           Mensagem::getMensagem(1, 2, $this->getTitulo(), "processa_agendamento.php?id_agendamento=".$id);
           $dados = Agendamento::getInformacoes($id);
//           
           
          if($dados != null or $dados !=""){
              $viewPaciente = new ViewPaciente();
              
              $viewPaciente->imprimirInformacoesBasicasPaciente($dados->getId_paciente());
           
                $myForm = "
                <div class='x_panel'>
                    <div class='x_title'>
                        <h2>Agendamento</h2>
                        <ul class='nav navbar-right panel_toolbox'>
                            <li><a class='collapse-link'><i class='fa fa-chevron-up'></i></a>
                            </li>                      
                            <li><a class='close-link'><i class='fa fa-close'></i></a>
                            </li>
                        </ul>
                        <div class='clearfix'></div>
                    </div>
                    <div class='x_content'>      
                        <form class='form-horizontal form-label-left' method='POST' action='processa_agendamento.php' name='myform' id='myform' > 
                            <input type='hidden' id='id_agendamento' name='id_agendamento' value='".$dados->getId_agendamento()."' />
                      
                            <div class='form-group'>
                                <label class='control-label col-md-3 col-sm-3 col-xs-3'>Dentista: </label>
                                <div class='col-md-4 col-sm-4 col-xs-4'>
                                    <input type='text' value='".  Usuario::getNomePorId($dados->getId_dentista())."' class='form-control' name='data' id='data' disabled>
                                </div>
                            </div>
                      
                            <div class='form-group'>
                                <label class='control-label col-md-3 col-sm-3 col-xs-3'>Data: </label>
                                <div class='col-md-4 col-sm-4 col-xs-4'>
                                    <input type='text' value='".$dados->getData()."' class='form-control' name='data' id='data' disabled>
                                </div>
                            </div>
                            
                            <div class='form-group'>
                                <label class='control-label col-md-3 col-sm-3 col-xs-3'>Horário: </label>
                                <div class='col-md-4 col-sm-4 col-xs-4'>
                                    <input type='text' value='".$dados->getHora()."' class='form-control' name='hora' id='hora' disabled>
                                </div>
                            </div>
                                            
                      <div class='ln_solid'></div>

                      <div class='form-group'>
                        <div class='col-md-9 col-md-offset-3'>
                                                   
                            <button type='button' class='btn btn btn-danger' data-toggle='modal' data-target='.bs-example-modal-lg'>Excluir</button>    
                            <a href='editar_agendamento.php?acao=editar&id_agendamento=".$dados->getId_agendamento()."'><button type='button' class='btn btn btn-primary'>Editar</button></a>    
                            
                        </div>
                      </div>

                    </form>  
                   </div>
                   
                    <!-- Fim do form -->
         
         ";
        }else{
               $myForm = "Não encontrado nenhum registro!";
           }
//                            
            echo $myForm;
           
       } catch (Exception $ex) {
           echo "Não encontrado nenhum registro!";
       }
   }
   
   public function imprimirListaAgendamento($periodo, $de = null, $ate = null){
       
       if($de !== null AND $ate != null){
           $titulo_tabela = "Agendamentos do período de ".$de." até ".$ate;
           $linhas = Agendamento::getLinhasTabela($periodo, $de, $ate);
       }else{
           $titulo_tabela = "Tabela Agendamentos";
           $linhas = Agendamento::getLinhasTabela($periodo);
       }
       
       $myLista = "<div class='col-md-12 col-sm-12 col-xs-12'>
                <div class='x_panel'>
                  <div class='x_title'>
                    <h2>".$titulo_tabela."</h2>                    
                    <div class='clearfix'></div>
                  </div>
                  <div class='x_content'>
                    <p class='text-muted font-13 m-b-30'>
                      Segue a lista de Angendamentos Solicitada.
                    </p>
                     <table id='datatable-responsive' class='table table-striped table-bordered dt-responsive nowrap' cellspacing='0' width='100%'>
                      <thead>
                        <tr>
                            <th>Data</th>
                            <th>Hora</th>                            
                            <th>Parciente</th>
                            <th>Dentista</th>
                            <th></th>
                        </tr>
                      </thead>

                      <tbody>
                       
                          ".  $linhas."
                                           
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
";
       echo $myLista;
   }
   
}