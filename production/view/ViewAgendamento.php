
<?php

/**
 * Description of ViewEntrada
 *
 * @author joao
 */

include_once './controllers/Paciente.php';
include_once 'ViewUsuario.php';

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
    
    function imprimirForm($acao, $id_paciente){
       Mensagem::getMensagem(1, 1, $this->getTitulo(), "processa_agendamento.php");
       
        $id_dentista = "";
        $data_visita = "";
        $hora_visita = "";
                   
        if($acao == "editar" && $id_paciente != ""){
//            $dados = Paciente::getInformacoes($idPaciente);
//            
//            $nome = $dados->getNome();
//            $cpf = $dados->getCpf();
//            $dataNascimento = $dados->getData_nascimento();
//            $sexo = $dados->getSexo();
//            $telefone = $dados->getTelefone();
//            $email = $dados->getEmail();            
//            $rua = $dados->getRua();
//            $numero = $dados->getNumero();
//            $bairro = $dados->getBairro();
//            $cep = $dados->getCep();
//            $cidade = $dados->getCidade();
//            $uf = $dados->getUf();
//            $complemento = $dados->getComplemento();
//            $obs = $dados->getObs();
//            $n_ficha = $dados->getN_ficha();
        }
       
        if($acao == "editar"){
            $btn_salvar = "
                    <input type='submit' id='btn-salvar-edicao' name='btn-salvar-edicao' value='Salvar Edição' class='btn btn-success' />                                                                                           
                ";
        }else{
           $btn_salvar = "
                    <input type='submit' id='btn-salvar' name='btn-salvar' value='Salvar' class='btn btn-success' />                                                                                           
                ";
        }
   
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
}