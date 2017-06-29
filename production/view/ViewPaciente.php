<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ViewPaciente
 *
 * @author joao
 */

include_once './controllers/Paciente.php';
include_once './controllers/Orcamento.php';
include_once './Auxiliares/Auxiliar.php';

class ViewPaciente {
    //put your code here
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

   public static function getQuantidadeNovosPacientes(){ 
       
       echo "<!-- top tiles -->
           <div class='col-md-12 col-sm-12 col-xs-12'>
                <div class='x_panel'>
                  
                  <div class='x_content'>
          <div class='row tile_count'>            
            <div class='col-md-4 col-sm-4 col-xs-12 tile_stats_count'>
              <span class='count_top'><i class='a fa-user'></i> Novos Pacientes Hoje</span>
              <div class='count blue'>".Paciente::getQuantidadeNovosPacientesDia()."</div>
              <span class='count_bottom'><i class='blue'><i class='fa fa-sort-asc'></i></i><a href='relatorio_novos_pacientes.php?dias=1'>Mais Delhates</a></span>
            </div>
            <div class='col-md-4 col-sm-4 col-xs-12 tile_stats_count'>
              <span class='count_top'><i class='fa fa-user'></i> Novos Pacientes nos Últimos 7 dias</span>
              <div class='count green'>".Paciente::getQuantidadeNovosPacientesSemana()."</div>
              <span class='count_bottom'><i class='green'><i class='fa fa-sort-asc'></i></i><a href='relatorio_novos_pacientes.php?dias=7'>Mais Delhates</a></span>
            </div>
            <div class='col-md-4 col-sm-4 col-xs-12 tile_stats_count'>
              <span class='count_top'><i class='fa fa-user'></i> Novos Pacientes nos Últimos 30 dias</span>
              <div class='count red'>".Paciente::getQuantidadeNovosPacientesMes()."</div>
              <span class='count_bottom'><i class='red'><i class='fa fa-sort-asc'></i></i><a href='relatorio_novos_pacientes.php?dias=30'>Mais Delhates</a></span>
            </div>
          </div>
          </div>
          </div>
          </div>
                      <!-- /top tiles -->";
   }
   
   function imprimirForm($acao, $idPaciente){
       Mensagem::getMensagem(1, 1, $this->getTitulo(), "processa_paciente.php");
       
        $nome = "";
        $cpf = "";
        $dataNascimento = "";
        $sexo = "";
        $telefone = "";
        $email = "";            
        $rua = "";
        $numero = "";
        $bairro = "";
        $cep = "";
        $cidade = "";
        $uf = "";
        $complemento = "";
        $obs = ""; 
        $n_ficha = "";
               
        if($acao == "editar" && $idPaciente != ""){
            $dados = Paciente::getInformacoes($idPaciente);
            
            $nome = $dados->getNome();
            $cpf = $dados->getCpf();
            $dataNascimento = $dados->getData_nascimento();
            $sexo = $dados->getSexo();
            $telefone = $dados->getTelefone();
            $email = $dados->getEmail();            
            $rua = $dados->getRua();
            $numero = $dados->getNumero();
            $bairro = $dados->getBairro();
            $cep = $dados->getCep();
            $cidade = $dados->getCidade();
            $uf = $dados->getUf();
            $complemento = $dados->getComplemento();
            $obs = $dados->getObs();
            $n_ficha = $dados->getN_ficha();
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
            <form method='POST' action='processa_paciente.php' name='myform' id='myform' >                            
                <div class='col-sm-12'>                        
                <div class='panel panel-primary'>
                    <div class='panel-heading'>
                        <h3 class='panel-title'></h3>
                    </div>
                    <div class='panel-body'>                            
                        <div class='col-xs-4'>
                            <label for='id_paciente'>ID Paciente</label>
                            <input type='text' class='form-control' id='id_paciente' name='id_paciente' value='".$idPaciente."' readonly=true>    
                            <input type='hidden' id = 'id_paciente_' name='id_paciente_' value='".$idPaciente."'>
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
                        <div class='col-xs-3'>
                            <label for='cpf'>CPF </label>
                            <input type='text' class='form-control' id='cpf' placeholder='' maxlength='11' name='cpf' value='".$cpf."'>
                        </div>
                                                                             
                        <div class='col-xs-9'>
                            <label for='nome'>Nome *</label>
                            <input type='text' id='nome' class='form-control' placeholder='' maxlength='244' name='nome' value='".$nome."' required>
                        </div>
                             
                        <div class='col-xs-3'>
                            <label for='sexo'>Gênero *</label>
                            <select class='form-control' id='sexo' name='sexo'>
                                <option value='sel'>Selecione</option>
                                ";
                            
                                if($sexo == "M"){
                                   $myForm = $myForm . "<option value='M' selected='selected'>Masculino</option>";
                                }else{
                                    $myForm = $myForm . "<option value='M'>Masculino</option>";
                                }

                               if($sexo == "F"){
                                   $myForm = $myForm . "<option value='F' selected='selected'>Feminino</option>";
                                }else{
                                    $myForm = $myForm . "<option value='F'>Feminino</option>";
                                }

                                $myForm = $myForm . "</select>
                            </select>
                        </div>
                            
                        <div class='col-xs-3'>
                            <label for='data_nascimento'>Data de Nasc.</label>
                            <input type='text' id='data_nascimento' name='data_nascimento' class='form-control' placeholder='' value='".Auxiliar::dateToBR($dataNascimento)."' maxlength='10'>
                        </div>
                        

                        <div class='col-xs-6'>
                            <label for='email'>E-Mail </label>
                            <input type='email' id='email' class='form-control' placeholder='' maxlength='244' length='150' name='email' value='".$email."' >
                        </div>
                        
                        <div class='col-xs-3'>
                            <label for='telefone'>Telefone </label>
                            <input type='text' class='form-control' id='telefone' placeholder='' maxlength='22' name='telefone' value='".$telefone."'  >
                        </div>
                        
                        <div class='col-xs-3'>
                            <label for='n_ficha'>Nº da Ficha</label>
                            <input type='text' id='n_ficha' class='form-control' placeholder='' maxlength='8' name='n_ficha' value='".$n_ficha."'>
                        </div>

                        <div class='col-xs-6'>
                            <label for='obs'>Observações</label>
                            <input type='text' id='obs' class='form-control' placeholder='' maxlength='244' name='obs' value='".$obs."'>
                        </div>                       
                    </div>                    
                </div>        
                </div>
                <div class='col-sm-12'>                        
                <div class='panel panel-primary'>
                    <div class='panel-heading'>
                        <h3 class='panel-title'>Endereço</h3>
                    </div>
                <div class='panel-body'>                      
                
                    <div class='col-xs-9'>
                        <label for='rua'>Logradouro</label>
                        <input type='text' id='rua' class='form-control' placeholder='' name='rua' value='".$rua."'>
                    </div>
                        
                    <div class='col-xs-3'>
                        <label for='numero'>Número</label>
                        <input type='text' class='form-control' id='numero' placeholder='' maxlength='10' name='numero' value='".$numero."'>
                    </div>
                    
                    <div class='col-xs-6'>
                        <label for='complemento'>Complemento</label>
                        <input type='text' id='complemento' class='form-control' placeholder='' maxlength='244' name='complemento' value='".$complemento."'>
                    </div>
                    
                    <div class='col-xs-6'>
                        <label for='bairro'>Bairro</label>
                        <input type='text' id='bairro' class='form-control' placeholder='' maxlength='244' name='bairro' value='".$bairro."'>
                    </div>
                          
                    <div class='col-xs-3'>
                        <label for='cep'>CEP</label>
                        <input type='text' id='cep' placeholder='' class='form-control' name='cep' value='".$cep."'>                        
                    </div>                    
                    
                    <div class='col-xs-6'>
                        <label for='cidade'>Cidade</label>
                        <input type='text' class='form-control' id='cidade' placeholder='' maxlength='255' name='cidade' value='".$cidade."'>
                    </div>
                    
                    <div class='col-xs-3'>
                        <label for='uf'>UF</label>
                        <select class='form-control' id='uf' name='uf' >                                        
                            <option value='sel'>Selecione</option>
                            
                        ";
                            
                            $uf_ = $uf;
                            
                            if($uf_==''){
                                $uf_ = 'RN';                                
                            }
                        
                            $estados = array(0=>'AC', 1=>'AL', 2=>'AM', 3=>'AP',4=>'BA',5=>'CE',
                                    6=>'DF',7=>'ES',8=>'GO',9=>'MA',10=>'MT',11=>'MS',12=>'MG',13=>'PA',
                                    14=>'PB',15=>'PR',16=>'PE',17=>'PI',18=>'RJ',19=>'RN',20=>'RO',21=>'RS',
                                    22=>'RR',23=>'SC',24=>'SE',25=>'SP',26=>'TO');

                            for($i=0; $i<sizeof($estados); $i++){
                        
                               $myForm = $myForm . "<option value='". $estados[$i]." '";
                                    
                                        if(strcasecmp($uf_,$estados[$i]) == 0):
                                            $myForm = $myForm . " selected='selected'";
                                        endif;
                                    
                                        $myForm = $myForm . ">". $estados[$i]." </option>";
                            }
                            $myForm = $myForm . "
                                
                        </select>                       
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
   
   public function informacoesBasicas($id){        
        $myDados = Paciente::getInformacoes($id);
       
        echo "<div class='clearfix'></div>

                    <div class='row'>
                        <div class='col-md-12 col-sm-12 col-xs-12'>
                            <div class='x_panel'>
                                <div class='x_title'>
                                    <h2>Dados Pessoais</h2>
                                    <ul class='nav navbar-right panel_toolbox'>
                                        <li><a class='collapse-link'><i class='fa fa-chevron-up'></i></a>
                                        </li>                      
                                        <li><a class='close-link'><i class='fa fa-close'></i></a>
                                        </li>
                                    </ul>
                                    <div class='clearfix'></div>
                                </div>
                                <div class='x_content'>
                                    <p>
                                    <div class='col-md-5 col-sm-12 col-xs-12'>                                         
                                        <strong>Nome Completo: </strong>".$myDados->getNome()."
                                    </div>
                                    
                                    <div class='col-md-3 col-sm-6 col-xs-12'>                                         
                                        <strong>Código: </strong>".$myDados->getId_paciente()."
                                    </div>
                                    
                                    <div class='col-md-4 col-sm-6 col-xs-12'>                                         
                                        <strong>CPF: </strong>".$myDados->getCpf()."
                                    </div>

                                    
                                        
                                    </p>
                                    
                                 <p>
                                 
                                    <div class='col-md-5 col-sm-12 col-xs-12'>                                         
                                        <strong>E-Mail: </strong>".$myDados->getEmail()."
                                    </div>
                                    <div class='col-md-3 col-sm-6 col-xs-12'>                                         
                                        <strong>Gênero: </strong>".  Auxiliar::getGenero($myDados->getSexo())."
                                    </div>
                                    
                                    <div class='col-md-4 col-sm-6 col-xs-12'>                                         
                                        <strong>Data de Nascimento: </strong>". Auxiliar::dateToBR($myDados->getData_nascimento())."
                                    </div>

                                   
                                        
                                </p>

                                <p>
                                    <div class='col-md-5 col-sm-6 col-xs-12'>                                         
                                        <strong>Telefone: </strong>".  $myDados->getTelefone()."
                                    </div>

                                    <div class='col-md-3 col-sm-6 col-xs-12'>                                         
                                        <strong>Nº da Ficha: </strong>". $myDados->getN_ficha()."
                                    </div>

                                    <div class='col-md-4 col-sm-6 col-xs-12'>                                         
                                        <strong>Observações: </strong>". $myDados->getObs()."
                                    </div>
                                    
                                </p>


                                </div>
                            </div>
                        </div>
                    </div>
                   ";
   
        
        echo "
                    <div class='row'>
                        <div class='col-md-12 col-sm-12 col-xs-12'>
                            <div class='x_panel'>
                                <div class='x_title'>
                                    <h2>Endereço</h2>
                                    <ul class='nav navbar-right panel_toolbox'>
                                        <li><a class='collapse-link'><i class='fa fa-chevron-up'></i></a>
                                        </li>                      
                                        <li><a class='close-link'><i class='fa fa-close'></i></a>
                                        </li>
                                    </ul>
                                    <div class='clearfix'></div>
                                </div>
                                <div class='x_content'>
                                <p>
                                    <div class='col-md-5 col-sm-12 col-xs-12'>                                         
                                        <strong>Logadouro: </strong>".$myDados->getRua()."
                                    </div>
                                    
                                    <div class='col-md-3 col-sm-6 col-xs-12'>                                         
                                        <strong>Número: </strong>".$myDados->getNumero()."
                                    </div>

                                    <div class='col-md-4 col-sm-6 col-xs-12'>                                         
                                        <strong>Complemento: </strong>".$myDados->getComplemento()."
                                    </div>
                                        
                                </p>
                                    
                                 <p>
                                    <div class='col-md-5 col-sm-12 col-xs-12'>                                         
                                        <strong>Bairro: </strong>".  $myDados->getBairro()."
                                    </div>
                                    
                                    <div class='col-md-3 col-sm-6 col-xs-12'>                                         
                                        <strong>CEP: </strong>". $myDados->getCep()."
                                    </div>

                                    <div class='col-md-4 col-sm-6 col-xs-12'>                                         
                                        <strong>Cidade: </strong>".$myDados->getCidade()."-".$myDados->getUf()."
                                    </div>
                                        
                                </p>
                            
                                </div>
                            </div>
                        </div>
                    </div>
                   ";
      
   }
   
   public function imprimirListaOrcamentoPaciente($id){        
       $myLista = "<div class='col-md-12 col-sm-12 col-xs-12'>
                <div class='x_panel'>
                  <div class='x_title'>
                    <h2>Orçamento(s)</h2>                    
                    <div class='clearfix'></div>
                  </div>
                  <div class='x_content'>
                    <p class='text-muted font-13 m-b-30'>
                      Segue a lista de Orçamento(s) para este paciente:
                    </p>
                     <table id='datatable-responsive' class='table table-striped table-bordered dt-responsive nowrap' cellspacing='0' width='100%'>
                      <thead>
                        <tr>                            
                            <th>Código</th>
                            <th>Data</th> 
                            
                            <th>Dentista</th>
                            <th>Serviços</th>
                            <th>Total R$</th>
                        </tr>
                      </thead>

                      <tbody>
                       
                          ". Orcamento::getLinhasTabelaOrcamentoPaciente($id)."
                                           
                      </tbody>
                    </table>
                  </div>
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
                      Segue a lista dos Pacientes cadastrados no sistema:
                    </p>
                     <table id='datatable-responsive' class='table table-striped table-bordered dt-responsive nowrap' cellspacing='0' width='100%'>
                      <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>Data de Nascimento</th>
                            <th>Gênero</th>
                            <th>Telefone</th>
                            <th>Nº da Ficha</th>
                            <th>E-mail</th>                            
                            <th>Rua</th>
                            <th>Número</th>
                            <th>Bairro</th>
                            <th>CEP</th>
                            <th>Cidade</th>
                            <th>UF</th>
                            <th>Complemento</th>
                            <th>Obs</th>
                            <th></th>
                        </tr>
                      </thead>
                      <tbody>                       
                          ".  Paciente::getLinhasTabela()."                                           
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
";
       echo $myLista;
   }
   
   public function imprimirInformacoesBasicasPaciente($id){
       $myDados = Paciente::getInformacoes($id);
        
        $imprimir = "
                <div class='x_panel'>
                    <div class='x_title'>
                        <h2>Dados do Paciente</h2>
                        <ul class='nav navbar-right panel_toolbox'>
                            <li><a class='collapse-link'><i class='fa fa-chevron-up'></i></a>
                            </li>                      
                            <li><a class='close-link'><i class='fa fa-close'></i></a>
                            </li>
                        </ul>
                        <div class='clearfix'></div>
                    </div>
                    <div class='x_content'>
                        <p>
                        <div class='col-md-5 col-sm-12 col-xs-12'>                                         
                            <strong>Nome Completo: </strong>".$myDados->getNome()."
                        </div>

                        <div class='col-md-3 col-sm-6 col-xs-12'>                                         
                            <strong>Código: </strong> ".$myDados->getId_paciente()."
                        </div>

                        <div class='col-md-4 col-sm-6 col-xs-12'>                                         
                            <strong>CPF: </strong>".  Auxiliar::ImprimirCpfCaracteres($myDados->getCpf())."
                        </div>

                    </div>
                </div>
            ";
        
        echo $imprimir;
   }
   
    public function imprimirListaPacientesAniverariantes($mes){
       $myLista = "<div class='col-md-12 col-sm-12 col-xs-12'>
                <div class='x_panel'>
                  <div class='x_title'>
                    <h2>Aniversáriantes do Mês</h2>                    
                    <div class='clearfix'></div>
                  </div>
                  <div class='x_content'>
                    <p class='text-muted font-13 m-b-30'>
                      Segue a lista dos Pacientes que são aniversáriantes no mês ".$mes.":
                    </p>
                     <table id='datatable-responsive' class='table table-striped table-bordered dt-responsive nowrap' cellspacing='0' width='100%'>
                      <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>Data de Nascimento</th>
                            <th>Gênero</th>
                            <th>Telefone</th>
                            <th>Nº da Ficha</th>
                            <th>E-mail</th>                            
                            <th>Rua</th>
                            <th>Número</th>
                            <th>Bairro</th>
                            <th>CEP</th>
                            <th>Cidade</th>
                            <th>UF</th>
                            <th>Complemento</th>
                            <th>Obs</th>
                        </tr>
                      </thead>

                      <tbody>
                       
                          ".  Paciente::getLinhasTabelaAniversariantesMes($mes)."
                                           
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
";
       echo $myLista;
    }
    
    public static function getUltimosPacientes(){
        echo "<div class='col-md-12 col-sm-12 col-xs-12'>
                <div class='x_panel'>
                  <div class='x_title'>
                    <h2>Pacientes <small>Lista de Últimos Pacientes Cadastrados</small></h2>
                    
                    <div class='clearfix'></div>
                  </div>
                  <div class='x_content'>
                    <table class='table table-hover'>
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Data do Cadastro</th>
                          <th>Nome</th>
                          <th>Gênero</th>
                          <th>Data de Nascimento</th>
                          <th>Telefone</th>
                          <th>Cidade</th>
                        </tr>
                      </thead>
                      <tbody>
                        ";
        
            echo Paciente::getLinhasTabelaUltimosPacientes();
            
            echo "</tbody>
                    </table>
                  </div>
                </div>
              </div>";
    } 
    
    public function imprimirRelatoriosNovosPacientes($dias){
        $linhas = Paciente::getLinhasTabelaUltimosPacientes($dias);
        
        if($linhas == ""){
            echo "Não encontrado registro";
        }else{
            echo "<div class='col-md-12 col-sm-12 col-xs-12'>
                <div class='x_panel'>
                  <div class='x_title'>
                    <h2>Pacientes <small>Lista de Últimos Pacientes Cadastrados</small></h2>
                    
                    <div class='clearfix'></div>
                  </div>
                  <div class='x_content'>
                    <table class='table table-hover'>
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Data do Cadastro</th>
                          <th>Nome</th>
                          <th>Gênero</th>
                          <th>Data de Nascimento</th>
                          <th>Telefone</th>
                          <th>Cidade</th>
                        </tr>
                      </thead>
                      <tbody>
                        ";
        
                        echo $linhas ;
            
                        echo "</tbody>
                    </table>
                  </div>
                </div>
              </div>";
     
        }
        
    }
   
}
