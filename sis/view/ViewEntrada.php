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
include_once './controllers/FormaPagamento.php';

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
        
        if(Orcamento::getLinhaTabelaItemNaoPago($idPaciente) != ""){
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
   
   public function imprimirListaItensSelecionados($idPaciente, $permissao_remover = TRUE, $forma_de_pagamento = "ESCOLHER") {
       
        if($forma_de_pagamento == ""){
            $buttonFormaPagamento = " <label>                            
                    <a href='entrada.php?id_paciente=".$idPaciente."&forma_de_pagamento=escolher'><button type='button' class='btn btn btn-primary'>Forma de Pagamento</button></a>                           
                </label>  ";
        }else{
            $buttonFormaPagamento = "";
        }       
       
        $linhas = Orcamento::getLinhaTabelaItemSelecionadosNaoRecebidos($idPaciente, $permissao_remover);
        $row_remover = "<th></th>";
        $mensagem_de_remocao = "Deseja remover algum item, clique em Remover:";
        
        if(!($permissao_remover)){
            $row_remover = "";
            $mensagem_de_remocao = ""; 
        }
        
        
        
        if($linhas != ""){
            $myLista = "
                <div class='x_panel'>
                  <div class='x_title'>
                    <h2>Item Selecionado(s)</h2>                    
                    <div class='clearfix'></div>
                  </div>
                  <div class='x_content'>
                    <p class='text-muted font-13 m-b-30'>
                      ".$mensagem_de_remocao."
                    </p>
                     <table id='datatable-responsive' class='table table-striped table-bordered dt-responsive nowrap' cellspacing='0' width='100%'>
                      <thead>
                        <tr>
                            ".$row_remover."
                            <th>Orçamento</th>
                            <th>Dentista</th>                            
                            <th>Descrição</th>                            
                            <th>Valor R$</th> 
                            <th>Desconto</th>
                            <th>Valor a Pagar R$</th>
                        </tr>
                      </thead>
                      <tbody>                       
                          ". $linhas."                                           
                      </tbody>
                    </table>
                  </div>
                  
                  <h3>Total a Receber: <strong>R$ ". Orcamento::getValorReceber($idPaciente)."</strong></h3>
                </div>
              
            ";            
                   
            $myLista = $myLista." ".$buttonFormaPagamento;
            
            echo $myLista;
        }  
    }

    public function imprimirFormEscolherFomarmaDePagamento($id_paciente) {
        $imprimir = "<div class='row'>
            <div class='col-md-12 col-sm-12 col-xs-12'>
                <div class='x_panel'>
                    <div class='x_title'>
                        <h2>Escolha a forma de Pagamento</h2>
                        <ul class='nav navbar-right panel_toolbox'>
                            <li><a class='collapse-link'><i class='fa fa-chevron-up'></i></a>
                            </li>                      
                            <li><a class='close-link'><i class='fa fa-close'></i></a>
                            </li>
                        </ul>
                        <div class='clearfix'></div>
                    </div>
                    <div class='x_content'>      
                        <form method='GET' action='entrada.php' name='myform' id='myform' >
                       
                            <input type='hidden' name='id_paciente' value='".$id_paciente."'>
                            <div class='col-xs-4'>
                                <label for='dentista'>Lista</label>
                                <select class='form-control' id='forma_de_pagamento' name='forma_de_pagamento' >      
                                    <option value='1'>DINHEIRO</option>
                                    <option value='2'>CARTÃO</option>
                                    <option value='3'>DÉBITO</option>
                                    <option value='4'>DINHEIRO E CARTÃO</option>
                                    <option value='5'>DINHEIRO E DÉBITO</option>
                                    <option value='6'>CARTÃO E DÉBITO</option>
                                    <option value='7'>DINHEIRO, CARTÃO E DÉBITO</option>
                                </select>                                         
                            </div>    
                            <div class='col-xs-4'>
                                <label>
                                    <input type='submit' id='btn-escolher' name='btn-escolher' value='Escolher' class='btn btn-primary' />                                                                                           
                                </label>
                            </div>                            
                        </form>
                    </div>
                </div>
            </div>
            </div>        
        ";
        
       echo $imprimir;
                  
    }

    public function imprimirFormPagamento($forma_de_pagamento, $id_paciente, $n_parcela_cartao, $valor_dinheiro_receber) {
        $valor_total = Orcamento::getValorReceber($id_paciente);
        $rows = "";
        
        if($forma_de_pagamento != "ESCOLHER" && $forma_de_pagamento != ""){
            
            if($forma_de_pagamento == 1){                
                    $formaEscolhida = new FormaPagamento();
                    $formaEscolhida->gerarFormaDePagamento("DINHEIRO");

                    $rows = $rows."<tr>"
                            . "<td>1</td>"
                        . "<td>".$formaEscolhida->getDescricao()."</td>"
                        . "<td>".(int) $formaEscolhida->getValor_minimo_parcela()."</td>"
                        . "<td>".$formaEscolhida->getValorParcela($valor_total)."</td>"
                        . "<td>".$valor_total."</td>"
                            . "</tr>";
                                                
            }else if($forma_de_pagamento == 2){                                
                    $formaEscolhida = new FormaPagamento();
                    $formaEscolhida->gerarFormaDePagamento("CARTAO");

                    if($n_parcela_cartao != ""){
                        $rows = $rows."<tr>"
                            . "<td>1</td>"
                        . "<td>".$formaEscolhida->getDescricao()."</td>"
                        . "<td>".$n_parcela_cartao."</td>"
                        . "<td>".(($valor_total)/$n_parcela_cartao)."</td>"
                        . "<td>".$valor_total."</td>"
                            . "</tr>";
                    }else{
                    
                        echo "<div class='x_panel'>
                            <div class='x_title'>
                                <h2>Escolher o número de Parcelas</h2>
                                <div class='clearfix'></div>
                            </div>
                            <div class='x_content'>
                                <form method='GET' action='entrada.php' name='myform' id='myform'>
                                    <input type='hidden' name='id_paciente' value='".$id_paciente."'>
                                    <input type='hidden' name='forma_de_pagamento' value='".$forma_de_pagamento."'>
                                
                                    <div class='col-xs-4'>
                                        <label for='n_parcela_cartao'>Número de Parcelas</label>
                                        <select class='form-control' id='n_parcela_cartao' name='n_parcela_cartao' >      
                                            ".$formaEscolhida->getOptionsCartao($valor_total)."                                      
                                        </select> 
                                    </div>
                                    <div class='col-xs-4'>
                                        <label>
                                            <input type='submit' id='btn-escolher' name='btn-escolher' value='Escolher' class='btn btn-primary' />                                                                                           
                                        </label>
                                    </div>  
                                </form>
                            </div>
                        </div>";
                    }                    
            
            }else if($forma_de_pagamento == 3){                                
                    $formaEscolhida = new FormaPagamento();
                    $formaEscolhida->gerarFormaDePagamento("DEBITO");
                   
                    $rows = $rows."<tr>"
                            . "<td>1</td>"
                        . "<td>".$formaEscolhida->getDescricao()."</td>"
                        . "<td>".(int) $formaEscolhida->getValor_minimo_parcela()."</td>"
                        . "<td>".$formaEscolhida->getValorParcela($valor_total)."</td>"
                        . "<td>".$valor_total."</td></tr>";
                                
            }else if($forma_de_pagamento == 4){                                
                   
                if($valor_dinheiro_receber == ""){
                    echo "<div class='x_panel'>
                            <div class='x_title'>
                                <h2>Escolher o número de Parcelas</h2>
                                <div class='clearfix'></div>
                            </div>
                            <div class='x_content'>
                                <form method='GET' action='entrada.php' name='myform' id='myform'>
                                    <input type='hidden' name='id_paciente' value='".$id_paciente."'>
                                    <input type='hidden' name='forma_de_pagamento' value='".$forma_de_pagamento."'>
                                
                                    <div class='col-xs-4'>
                                        <label for='valor_dinheiro_receber'>Valor em Dinheiro R$</label>
                                        <input type='text' id='valor_dinheiro_receber' class='form-control' placeholder='0,00' maxlength='10' name='valor_dinheiro_receber' value='".$valor_dinheiro_receber."' required> 
                                    </div>
                                    <div class='col-xs-4'>
                                        <label>
                                            <input type='submit' id='btn-escolher' name='btn-escolher' value='Próximo' class='btn btn-primary' />                                                                                           
                                        </label>
                                    </div>  
                                </form>
                            </div>
                        </div>";
                }else if($n_parcela_cartao == ""){
                       
                         $formaEscolhida = new FormaPagamento();
                    $formaEscolhida->gerarFormaDePagamento("DINHEIRO");

                    $rows = $rows."<tr><td>2</td>"
                        . "<td>".$formaEscolhida->getDescricao()."</td>"
                        . "<td>".(int) $formaEscolhida->getValor_minimo_parcela()."</td>"
                        . "<td>".$valor_dinheiro_receber."</td>"
                        . "<td>".$valor_dinheiro_receber."</td></tr>";
                    
                        echo "<div class='x_panel'>
                            <div class='x_title'>
                                <h2>Escolher o número de Parcelas</h2>
                                <div class='clearfix'></div>
                            </div>
                            <div class='x_content'>
                                <form method='GET' action='entrada.php' name='myform' id='myform'>
                                    <input type='hidden' name='id_paciente' value='".$id_paciente."'>
                                    <input type='hidden' name='forma_de_pagamento' value='".$forma_de_pagamento."'>
                                    <input type='hidden' name='valor_dinheiro_receber' value='".$valor_dinheiro_receber."'>
                                
                                    <div class='col-xs-4'>
                                        <label for='n_parcela_cartao'>Número de Parcelas</label>
                                        <select class='form-control' id='n_parcela_cartao' name='n_parcela_cartao' >      
                                            ".$formaEscolhida->getOptionsCartao(($valor_total - $valor_dinheiro_receber))."                                      
                                        </select> 
                                    </div>
                                    <div class='col-xs-4'>
                                        <label>
                                            <input type='submit' id='btn-escolher' name='btn-escolher' value='Escolher' class='btn btn-primary' />                                                                                           
                                        </label>
                                    </div>  
                                </form>
                            </div>
                        </div>";          
                    
                }else{
                    $formaEscolhida = new FormaPagamento();
                    $formaEscolhida->gerarFormaDePagamento("CARTAO");
                    
                    $rows = $rows."<tr>"
                            . "<td>1</td>"
                        . "<td>".$formaEscolhida->getDescricao()."</td>"
                        . "<td>".$n_parcela_cartao."</td>"
                        . "<td>".(($valor_total - $valor_dinheiro_receber)/$n_parcela_cartao)."</td>"
                        . "<td>".($valor_total - $valor_dinheiro_receber)."</td>"
                            . "</tr>";
                                
                    $formaEscolhida = new FormaPagamento();
                    $formaEscolhida->gerarFormaDePagamento("DINHEIRO");

                     $rows = $rows."<tr><td>2</td>"
                        . "<td>".$formaEscolhida->getDescricao()."</td>"
                        . "<td>".(int) $formaEscolhida->getValor_minimo_parcela()."</td>"
                        . "<td>".$valor_dinheiro_receber."</td>"
                        . "<td>".$valor_dinheiro_receber."</td></tr>";
                }

            }else if($forma_de_pagamento == 5){
                    
                if($valor_dinheiro_receber == ""){
                    echo "<div class='x_panel'>
                            <div class='x_title'>
                                <h2>Escolher o número de Parcelas</h2>
                                <div class='clearfix'></div>
                            </div>
                            <div class='x_content'>
                                <form method='GET' action='entrada.php' name='myform' id='myform'>
                                    <input type='hidden' name='id_paciente' value='".$id_paciente."'>
                                    <input type='hidden' name='forma_de_pagamento' value='".$forma_de_pagamento."'>
                                
                                    <div class='col-xs-4'>
                                        <label for='valor_dinheiro_receber'>Valor em Dinheiro R$</label>
                                        <input type='text' id='valor_dinheiro_receber' class='form-control' placeholder='0,00' maxlength='10' name='valor_dinheiro_receber' value='".$valor_dinheiro_receber."' required> 
                                    </div>
                                    <div class='col-xs-4'>
                                        <label>
                                            <input type='submit' id='btn-escolher' name='btn-escolher' value='Próximo' class='btn btn-primary' />                                                                                           
                                        </label>
                                    </div>  
                                </form>
                            </div>";
                }else{
                    $formaEscolhida = new FormaPagamento();
                    $formaEscolhida->gerarFormaDePagamento("DINHEIRO");
                    
                    $rows = $rows."<tr><td>1</td>"
                        . "<td>".$formaEscolhida->getDescricao()."</td>"
                        . "<td>".(int) $formaEscolhida->getValor_minimo_parcela()."</td>"
                        . "<td>".$formaEscolhida->getValorParcela($valor_total)."</td>"
                        . "<td>".$valor_total."</td></tr>";
                                
                    $formaEscolhida = new FormaPagamento();
                    $formaEscolhida->gerarFormaDePagamento("DEBITO");
                  
                    $rows = $rows."<tr><td>2</td>"
                        . "<td>".$formaEscolhida->getDescricao()."</td>"
                        . "<td>".(int) $formaEscolhida->getValor_minimo_parcela()."</td>"
                        . "<td>".$formaEscolhida->getValorParcela($valor_total)."</td>"
                        . "<td>".$valor_total."</td></tr>";
                }
            }else if($forma_de_pagamento == 6){
                                
                    $formaEscolhida = new FormaPagamento();
                    $formaEscolhida->gerarFormaDePagamento("DEBITO");
                    
                    $rows = $rows."<tr><td>1</td>"
                        . "<td>".$formaEscolhida->getDescricao()."</td>"
                        . "<td>".(int) $formaEscolhida->getValor_minimo_parcela()."</td>"
                        . "<td>".$formaEscolhida->getValorParcela($valor_total)."</td>"
                        . "<td>".$valor_total."</td></tr>";
                                
                    $formaEscolhida = new FormaPagamento();
                    $formaEscolhida->gerarFormaDePagamento("CARTAO");
                  
                    $rows = $rows."<tr><td>2</td>"
                        . "<td>".$formaEscolhida->getDescricao()."</td>"
                        . "<td>".(int) $formaEscolhida->getValor_minimo_parcela()."</td>"
                        . "<td>".$formaEscolhida->getValorParcela($valor_total)."</td>"
                        . "<td>".$valor_total."</td></tr>";
            
            }else if($forma_de_pagamento == 7){
                                
                    $formaEscolhida = new FormaPagamento();
                    $formaEscolhida->gerarFormaDePagamento("DEBITO");
                    
                    $rows = $rows."<tr><td>1</td>"
                        . "<td>".$formaEscolhida->getDescricao()."</td>"
                        . "<td>".(int) $formaEscolhida->getValor_minimo_parcela()."</td>"
                        . "<td>".$formaEscolhida->getValorParcela($valor_total)."</td>"
                        . "<td>".$valor_total."</td></tr>";
                                
                    $formaEscolhida = new FormaPagamento();
                    $formaEscolhida->gerarFormaDePagamento("CARTAO");
                  
                    $rows = $rows."<tr><td>2</td>"
                        . "<td>".$formaEscolhida->getDescricao()."</td>"
                        . "<td>".(int) $formaEscolhida->getValor_minimo_parcela()."</td>"
                        . "<td>".$formaEscolhida->getValorParcela($valor_total)."</td>"
                        . "<td>".$valor_total."</td></tr>";
                    
                    $formaEscolhida = new FormaPagamento();
                    $formaEscolhida->gerarFormaDePagamento("DINHEIRO");
                  
                    
                    $rows = $rows."<tr><td>3</td>"
                        . "<td>".$formaEscolhida->getDescricao()."</td>"
                        . "<td>".(int) $formaEscolhida->getValor_minimo_parcela()."</td>"
                        . "<td>".$formaEscolhida->getValorParcela($valor_total)."</td>"
                        . "<td>".$valor_total."</td></tr>";                
            }else{
                echo "<p>Escolha não conhecida</p>";
            }
           
        }
        
        if($rows != ""){
            
            $myTable = " 
                    <div class='x_panel'>
                      <div class='x_title'>
                        <h2>Detalhamento de Forma de Pagamento</h2>

                        <div class='clearfix'></div>
                      </div>
                      <div class='x_content'>

                        <table class='table table-bordered'>
                          <thead>
                            <tr>    
                                <th>#</th>
                                <th>FORMA DE PAGAMENTO</th>
                                <th>Nº DE PARCELAS</th>
                                <th>VALOR DA PARCELA</th>
                                <th>VALOR TOTAL</th>
                            </tr>
                          </thead>
                          <tbody>
                                ".$rows."
                          </tbody>
                        </table>

                      </div>
                    </div>

                " ;

                echo $myTable;
        }
        
    }

}
