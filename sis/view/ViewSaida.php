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
include_once './controllers/Fornecedor.php';
include_once './controllers/Saida.php';
include_once './controllers/Orcamento.php';
include_once './Auxiliares/Auxiliar.php';
include_once './controllers/FormaPagamento.php';
include_once './Auxiliares/Auxiliar.php';


include_once 'ViewPaciente.php';

class ViewSaida {
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
    
    public function imprimirListaFornecedor(){
        
        Mensagem::getMensagem(1, 1, $this->getTitulo(), "index.php");
        
       $myLista = "<div class='col-md-12 col-sm-12 col-xs-12'>
                <div class='x_panel'>
                  <div class='x_title'>
                    <h2>Tabela de Fornecedores</h2>                    
                    <div class='clearfix'></div>
                  </div>
                  <div class='x_content'>
                    <p class='text-muted font-13 m-b-30'>
                      Escolha o Fornecedor.
                    </p>
                     <table id='datatable-responsive' class='table table-striped table-bordered dt-responsive nowrap' cellspacing='0' width='100%'>
                      <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nome</th>
                            <th>CPF/CNPJ</th>                            
                            <th>Cidade</th>
                        </tr>
                      </thead>
                            ". Fornecedor::getLinhasTabelaSaida() ."
                      <tbody>
                             
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              
<label>                            
                <button type='button' class='btn btn btn-danger' data-toggle='modal' data-target='.bs-example-modal-lg'>Cancelar</button>                           
            </label>
            <label>                            
                <a href=nova_saida.php?novo_fornecedor=true><button type='button' class='btn btn btn-primary'>Novo Fornecedor</button></a>                           
            </label>
";
       echo $myLista;
   }
   
   public function imprimirFormNovoFornecedor(){
       $myForm = "<div class='row'>
            <div class='col-md-12 col-sm-12 col-xs-12'>
                <div class='x_panel'>
                    <div class='x_title'>
                        <h2>Cadastrar Novo Fornecedor</h2>
                        <ul class='nav navbar-right panel_toolbox'>
                            <li><a class='collapse-link'><i class='fa fa-chevron-up'></i></a>
                            </li>                      
                            <li><a class='close-link'><i class='fa fa-close'></i></a>
                            </li>
                        </ul>
                        <div class='clearfix'></div>
                    </div>
                    <div class='x_content'>      
                        <form method='POST' action='processa_fornecedor.php' name='myform' id='myform' >                            
                        
                        <div class='col-xs-3'>
                            <label for='cpf'>CPF/CNPJ</label>
                            <input type='text' class='form-control' id='cpf_cnpj' placeholder='' maxlength='20' name='cpf_cnpj' value='' >
                        </div>
                                                                             
                        <div class='col-xs-6'>
                            <label for='nome'>Nome *</label>
                            <input type='text' id='nome' class='form-control' placeholder='' maxlength='244' name='nome' value='' required>
                        </div>
                                                
                        <div class='col-xs-3'>
                            <label for='telefone'>Telefone *</label>
                            <input type='text' class='form-control' id='telefone' placeholder='' maxlength='22' name='telefone' value='' required >
                        </div>
                        
                        <div class='col-xs-6'>
                            <label for='email'>E-Mail</label>
                            <input type='email' id='email' class='form-control' placeholder='' maxlength='100' name='email' value=''>
                        </div>
                        
                        <div class='col-xs-6'>
                            <label for='obs'>Observações</label>
                            <input type='text' id='obs' class='form-control' placeholder='' maxlength='244' name='obs' value=''>
                        </div>
                                                
                                   
                
                    <div class='col-xs-9'>
                        <label for='rua'>Logradouro</label>
                        <input type='text' id='rua' class='form-control' placeholder='' name='rua' value=''>
                    </div>
                        
                    <div class='col-xs-3'>
                        <label for='numero'>Número</label>
                        <input type='text' class='form-control' id='numero' placeholder='' maxlength='10' name='numero' value=''>
                    </div>
                    
                    <div class='col-xs-6'>
                        <label for='complemento'>Complemento</label>
                        <input type='text' id='complemento' class='form-control' placeholder='' maxlength='244' name='complemento' value=''>
                    </div>
                    
                    <div class='col-xs-6'>
                        <label for='bairro'>Bairro</label>
                        <input type='text' id='bairro' class='form-control' placeholder='' maxlength='244' name='bairro' value=''>
                    </div>
                          
                    <div class='col-xs-3'>
                        <label for='cep'>CEP</label>
                        <input type='text' id='cep' placeholder='' class='form-control' name='cep' value=''>                        
                    </div>                    
                    
                    <div class='col-xs-6'>
                        <label for='cidade'>Cidade</label>
                        <input type='text' class='form-control' id='cidade' placeholder='' maxlength='255' name='cidade' value=''>
                    </div>
                    
                    <div class='col-xs-3'>
                        <label for='uf'>UF</label>
                        <select class='form-control' id='uf' name='uf' >                                        
                            <option value='sel'>Selecione</option>
                            
                        ";
       
                                                     
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
                                    
                        <label>
                            <input type='submit' id='btn-salvar_saida_novo_fornecedor' name='btn-salvar_saida_novo_fornecedor' value='Salvar' class='btn btn-success' />                                                                                           
                        </label>        
                    </p>
                </div>
                    
                </div>
                
            </form>         
        </div>
        </div>
        </div>
        </div>
        
        <!-- Fim do form -->
         
         ";
                            
                            echo $myForm;
   }
   
   public function imprimirListaDeServicosFornecedor($id){
       $lista = "";
       
       
        echo "<div class='clearfix'></div>
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
                                <div class='x_content'>
                                    

                                    <label>                            
                                        <a href='nova_saida.php?id_fornecedor=".$id."&novo_servico=true'><button type='button' class='btn btn btn-primary'>Novo Serviço</button>   </a>                        
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>";
      
   }
   
   
   
   public function imprimirDadosFornecedor($id){
        $myDados = Fornecedor::getInformacoes($id);
        
        echo "<div class='clearfix'></div>

                    <div class='row'>
                        <div class='col-md-12 col-sm-12 col-xs-12'>
                            <div class='x_panel'>
                                <div class='x_title'>
                                    <h2>Fornecedor</h2>
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
                                        <strong>Nome: </strong> ".$myDados->getNome()."
                                    </div>
                                    
                                    <div class='col-md-3 col-sm-6 col-xs-12'>                                         
                                        <strong>Código: </strong>".$myDados->getId_fornecedor()."
                                    </div>
                                    
                                    <div class='col-md-4 col-sm-6 col-xs-12'>                                         
                                        <strong>CPF/CNPJ: </strong>".$myDados->getCpf_cnpj()."
                                    </div>
                                                                           
                                </p>
                                    
                                 <p>                                 
                                    <div class='col-md-5 col-sm-12 col-xs-12'>                                         
                                       <strong>E-Mail: </strong>".$myDados->getEmail()."
                                  </div>
                                                                    
                                   <div class='col-md-3 col-sm-6 col-xs-12'>                                         
                                        <strong>Telefone: </strong>".  $myDados->getTelefone()."
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
   }
   
   public function imprimirFormNovoServico($id_fornecedor){
       echo "<div class='clearfix'></div>

                    <div class='row'>
                        <div class='col-md-12 col-sm-12 col-xs-12'>
                            <div class='x_panel'>
                                <div class='x_title'>
                                    <h2>Novo Serviço - Descrição</h2>
                                    <ul class='nav navbar-right panel_toolbox'>
                                        <li><a class='collapse-link'><i class='fa fa-chevron-up'></i></a>
                                        </li>                      
                                        <li><a class='close-link'><i class='fa fa-close'></i></a>
                                        </li>
                                    </ul>
                                    <div class='clearfix'></div>
                                </div>
                                <div class='x_content'>
                                <form method='POST' action='processa_fornecedor.php' name='myform' id='myform' >
                                <p>
                                    <div class='col-xs-9'>                                        
                                        <input type='text' class='form-control' id='descricao_servico' name='descricao_servico' value='' required=''>  
                                        <input type='hidden' id = 'id_fornecedor' name='id_fornecedor' value='".$id_fornecedor."'>
                                    </div>
                                    <div class='col-xs-3'>
                                        <input type='submit' id='btn-salvar_saida_novo_servico_fornecedor' name='btn-salvar_saida_novo_servico_fornecedor' value='Salvar' class='btn btn-success' />
                                    </div>
                                </p>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>";
   }
   
}
