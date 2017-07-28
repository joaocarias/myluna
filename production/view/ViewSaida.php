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
include_once './controllers/ServicoFornecedor.php';
include_once './controllers/ServicoFornecedorSaida.php';
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
    
    public function  imprimirListaDetalhamentoSaida($id_fornecedor, $forma_de_pagamento){
        $lista = ServicoFornecedorSaida::getListaServicoSelecionados($id_fornecedor);
        
        if($lista != ""){
            echo "<div class='clearfix'></div>
                    <div class='row'>
                        <div class='col-md-12 col-sm-12 col-xs-12'>
                            <div class='x_panel'>
                                <div class='x_title'>
                                    <h2>Detalhamento de Saída</h2>
                                    <ul class='nav navbar-right panel_toolbox'>
                                        <li><a class='collapse-link'><i class='fa fa-chevron-up'></i></a>
                                        </li>                      
                                        <li><a class='close-link'><i class='fa fa-close'></i></a>
                                        </li>
                                    </ul>
                                    <div class='clearfix'></div>
                                </div>
                                <div class='x_content'>
                                     <table class='table table-hover'>
                                              <thead>
                                                <tr>
                                                  <th>#</th>
                                                  <th>Serviço</th>
                                                  <th>Quant.</th>
                                                  <th>Valor Unit. R$</th>                                                  
                                                  <th>Total R$</th>
                                                  <th>Desconto R$</th>
                                                  <th>Valor Pago R$</th>
                                                  <th></th>
                                                </tr>
                                              </thead>
                                              <tbody>";
            
                                                echo $lista;
                                                
                                                echo "
                                              </tbody>
                                            </table>
                                    <p>Total do Valor: ".Auxiliar::convParaReal(ServicoFornecedorSaida::getTotalSaida($id_fornecedor))."</p>
                                </div>
                            </div>
                        </div>
                    </div>
               ";
                           
                                                
                if($forma_de_pagamento == ""){
                                                echo "<label>                            
                        <a href='nova_saida.php?id_fornecedor=".$id_fornecedor."&forma_de_pagamento=escolher'><button type='button' class='btn btn btn-primary'>Escolher Forma de Pagamento</button></a>                           
                    </label>";
                }
                
                
        }
   }
   
   public function imprimirFormPagamento($forma_de_pagamento, $id_fornecedor, $n_parcela_cartao, $valor_dinheiro_receber, $valor_debito_receber) {
        $valor_total = ServicoFornecedorSaida::getTotalSaida($id_fornecedor);
        $rows = "";
        
        if($forma_de_pagamento != "ESCOLHER" && $forma_de_pagamento != ""){
            
            if($forma_de_pagamento == 1){                
                    $formaEscolhida = new FormaPagamento();
                    $formaEscolhida->gerarFormaDePagamento("DINHEIRO");

                    $rows = $rows."<tr>"
                            . "<td>1</td>"
                        . "<td>".$formaEscolhida->getDescricao()."</td>"
                        . "<td>".(int) $formaEscolhida->getValor_minimo_parcela()."</td>"
                        . "<td>".$valor_total."</td>"
                        . "<td>".$valor_total."</td>"
                            . "</tr>";
                    
                    $valor_debito_receber = 0;
                    $valor_dinheiro_receber = $valor_total;
                    $n_parcela_cartao = 0;
                                                
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
                        
                         
                        $valor_debito_receber = 0;
                        $valor_dinheiro_receber = 0;
                        
                    }else{
                    
                        echo "<div class='x_panel'>
                            <div class='x_title'>
                                <h2>Número de Parcelas</h2>
                                <div class='clearfix'></div>
                            </div>
                            <div class='x_content'>
                                <form method='GET' action='entrada.php' name='myform' id='myform'>
                                    <input type='hidden' name='id_paciente' value='".$id_paciente."'>
                                    <input type='hidden' name='forma_de_pagamento' value='".$forma_de_pagamento."'>
                                
                                    <div class='col-xs-4'>                                        
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
                        . "<td>".$valor_total."</td>"
                        . "<td>".$valor_total."</td></tr>";
                        
                     
                    $valor_debito_receber = $valor_total;
                    $valor_dinheiro_receber = 0;
                    $n_parcela_cartao = 0;
                    
            }else if($forma_de_pagamento == 4){                                
                   
                if($valor_dinheiro_receber == ""){
                    echo "<div class='x_panel'>
                            <div class='x_title'>
                                <h2>Valor em Dinheiro</h2>
                                <div class='clearfix'></div>
                            </div>
                            <div class='x_content'>
                                <form method='GET' action='entrada.php' name='myform' id='myform'>
                                    <input type='hidden' name='id_paciente' value='".$id_paciente."'>
                                    <input type='hidden' name='forma_de_pagamento' value='".$forma_de_pagamento."'>
                                
                                    <div class='col-xs-4'>                                        
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

                    $rows = $rows."<tr><td>1</td>"
                        . "<td>".$formaEscolhida->getDescricao()."</td>"
                        . "<td>".(int) $formaEscolhida->getValor_minimo_parcela()."</td>"
                        . "<td>".$valor_dinheiro_receber."</td>"
                        . "<td>".$valor_dinheiro_receber."</td></tr>";
                    
                    $restante = ($valor_total) - ($valor_dinheiro_receber);
                    
                    $formaEscolhida = new FormaPagamento();
                    $formaEscolhida->gerarFormaDePagamento("CARTAO");
                        echo "<div class='x_panel'>
                            <div class='x_title'>
                                <h2>Número de Parcelas</h2>
                                <div class='clearfix'></div>
                            </div>
                            <div class='x_content'>
                                <form method='GET' action='entrada.php' name='myform' id='myform'>
                                    <input type='hidden' name='id_paciente' value='".$id_paciente."'>
                                    <input type='hidden' name='forma_de_pagamento' value='".$forma_de_pagamento."'>
                                    <input type='hidden' name='valor_dinheiro_receber' value='".$valor_dinheiro_receber."'>
                                
                                    <div class='col-xs-4'>                                        
                                        <select class='form-control' id='n_parcela_cartao' name='n_parcela_cartao' >      
                                            ".$formaEscolhida->getOptionsCartao($restante)."                                      
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
                        . "<td>".($valor_total-$valor_dinheiro_receber)."</td>"
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
                                <h2>Valor em Dinheiro R$</h2>
                                <div class='clearfix'></div>
                            </div>
                            <div class='x_content'>
                                <form method='GET' action='entrada.php' name='myform' id='myform'>
                                    <input type='hidden' name='id_paciente' value='".$id_paciente."'>
                                    <input type='hidden' name='forma_de_pagamento' value='".$forma_de_pagamento."'>
                                
                                    <div class='col-xs-4'>                                        
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
                        . "<td>".$valor_dinheiro_receber."</td>"
                        . "<td>".$valor_dinheiro_receber."</td></tr>";      
                    
                    $formaEscolhida = new FormaPagamento();
                    $formaEscolhida->gerarFormaDePagamento("DEBITO");
                   
                    $rows = $rows."<tr><td>2</td>"
                        . "<td>".$formaEscolhida->getDescricao()."</td>"
                        . "<td>".(int) $formaEscolhida->getValor_minimo_parcela()."</td>"
                        . "<td>".$formaEscolhida->getValorParcela($valor_total - $valor_dinheiro_receber)."</td>"
                        . "<td>".($valor_total - $valor_dinheiro_receber)."</td></tr>";
                    
                     
                    $valor_debito_receber = ($valor_total) - ($valor_dinheiro_receber);                    
                    $n_parcela_cartao = 0;
                }
            }else if($forma_de_pagamento == 6){
                                
                 if($valor_debito_receber == ""){
                    echo "<div class='x_panel'>
                            <div class='x_title'>
                                <h2>Valor em Débito R$</h2>
                                <div class='clearfix'></div>
                            </div>
                            <div class='x_content'>
                                <form method='GET' action='entrada.php' name='myform' id='myform'>
                                    <input type='hidden' name='id_paciente' value='".$id_paciente."'>
                                    <input type='hidden' name='forma_de_pagamento' value='".$forma_de_pagamento."'>
                                
                                    <div class='col-xs-4'>                                        
                                        <input type='text' id='valor_debito_receber' class='form-control' placeholder='0,00' maxlength='10' name='valor_debito_receber' value='' required> 
                                    </div>
                                    <div class='col-xs-4'>
                                        <label>
                                            <input type='submit' id='btn-escolher' name='btn-escolher' value='Próximo' class='btn btn-primary' />                                                                                           
                                        </label>
                                    </div>  
                                </form>
                            </div>";
                
                 }else if($n_parcela_cartao == ""){
                       
                    $formaEscolhida = new FormaPagamento();
                    $formaEscolhida->gerarFormaDePagamento("DEBITO");

                    $rows = $rows."<tr><td>1</td>"
                        . "<td>".$formaEscolhida->getDescricao()."</td>"
                        . "<td>".(int) $formaEscolhida->getValor_minimo_parcela()."</td>"
                        . "<td>".$valor_debito_receber."</td>"
                        . "<td>".$valor_debito_receber."</td></tr>";
                    
                    $formaEscolhida = new FormaPagamento();
                    $formaEscolhida->gerarFormaDePagamento("CARTAO");
                        echo "<div class='x_panel'>
                            <div class='x_title'>
                                <h2>Número de Parcelas</h2>
                                <div class='clearfix'></div>
                            </div>
                            <div class='x_content'>
                                <form method='GET' action='entrada.php' name='myform' id='myform'>
                                    <input type='hidden' name='id_paciente' value='".$id_paciente."'>
                                    <input type='hidden' name='forma_de_pagamento' value='".$forma_de_pagamento."'>
                                    <input type='hidden' name='valor_debito_receber' value='".$valor_debito_receber."'>
                                
                                    <div class='col-xs-4'>                                        
                                        <select class='form-control' id='n_parcela_cartao' name='n_parcela_cartao' >      
                                            ".$formaEscolhida->getOptionsCartao(($valor_total - $valor_debito_receber))."                                      
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
                        . "<td>".(($valor_total - $valor_debito_receber)/$n_parcela_cartao)."</td>"
                        . "<td>".($valor_total - $valor_debito_receber)."</td>"
                            . "</tr>";
                                
                    $formaEscolhida = new FormaPagamento();
                    $formaEscolhida->gerarFormaDePagamento("DEBITO");

                    $rows = $rows."<tr><td>2</td>"
                        . "<td>".$formaEscolhida->getDescricao()."</td>"
                        . "<td>".(int) $formaEscolhida->getValor_minimo_parcela()."</td>"
                        . "<td>".$valor_debito_receber."</td>"
                        . "<td>".$valor_debito_receber."</td></tr>";
                }
            }else if($forma_de_pagamento == 7){
                
                 if($valor_dinheiro_receber == ""){
                    echo "<div class='x_panel'>
                            <div class='x_title'>
                                <h2>Valor em Dinheiro</h2>
                                <div class='clearfix'></div>
                            </div>
                            <div class='x_content'>
                                <form method='GET' action='entrada.php' name='myform' id='myform'>
                                    <input type='hidden' name='id_paciente' value='".$id_paciente."'>
                                    <input type='hidden' name='forma_de_pagamento' value='".$forma_de_pagamento."'>
                                
                                    <div class='col-xs-4'>                                        
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
                    
                 }else if($valor_debito_receber == ""){
                     
                      
                    $formaEscolhida = new FormaPagamento();
                    $formaEscolhida->gerarFormaDePagamento("DINHEIRO");

                    $rows = $rows."<tr><td>1</td>"
                        . "<td>".$formaEscolhida->getDescricao()."</td>"
                        . "<td>".(int) $formaEscolhida->getValor_minimo_parcela()."</td>"
                        . "<td>".$valor_dinheiro_receber."</td>"
                        . "<td>".$valor_dinheiro_receber."</td></tr>";
                     
                    echo "<div class='x_panel'>
                            <div class='x_title'>
                                <h2>Valor em Débito R$</h2>
                                <div class='clearfix'></div>
                            </div>
                            <div class='x_content'>
                                <form method='GET' action='entrada.php' name='myform' id='myform'>
                                    <input type='hidden' name='id_paciente' value='".$id_paciente."'>
                                    <input type='hidden' name='forma_de_pagamento' value='".$forma_de_pagamento."'>
                                         <input type='hidden' name='valor_dinheiro_receber' value='".$valor_dinheiro_receber."'>
                                
                                
                                    <div class='col-xs-4'>                                        
                                        <input type='text' id='valor_debito_receber' class='form-control' placeholder='0,00' maxlength='10' name='valor_debito_receber' value='' required> 
                                    </div>
                                    <div class='col-xs-4'>
                                        <label>
                                            <input type='submit' id='btn-escolher' name='btn-escolher' value='Próximo' class='btn btn-primary' />                                                                                           
                                        </label>
                                    </div>  
                                </form>
                            </div>";
                
                 }else if($n_parcela_cartao == ""){
                       
                    $restante = ($valor_total) - ($valor_debito_receber + $valor_dinheiro_receber);
                                        
                    $formaEscolhida = new FormaPagamento();
                    $formaEscolhida->gerarFormaDePagamento("DINHEIRO");

                    $rows = $rows."<tr><td>1</td>"
                        . "<td>".$formaEscolhida->getDescricao()."</td>"
                        . "<td>".(int) $formaEscolhida->getValor_minimo_parcela()."</td>"
                        . "<td>".$valor_dinheiro_receber."</td>"
                        . "<td>".$valor_dinheiro_receber."</td></tr>";
                 
                    $formaEscolhida = new FormaPagamento();
                    $formaEscolhida->gerarFormaDePagamento("DEBITO");

                    $rows = $rows."<tr><td>2</td>"
                        . "<td>".$formaEscolhida->getDescricao()."</td>"
                        . "<td>".(int) $formaEscolhida->getValor_minimo_parcela()."</td>"
                        . "<td>".$valor_debito_receber."</td>"
                        . "<td>".$valor_debito_receber."</td></tr>";
                    
                    $formaEscolhida = new FormaPagamento();
                    $formaEscolhida->gerarFormaDePagamento("CARTAO");
                        echo "<div class='x_panel'>
                            <div class='x_title'>
                                <h2>Número de Parcelas</h2>
                                <div class='clearfix'></div>
                            </div>
                            <div class='x_content'>
                                <form method='GET' action='entrada.php' name='myform' id='myform'>
                                    <input type='hidden' name='id_paciente' value='".$id_paciente."'>
                                    <input type='hidden' name='forma_de_pagamento' value='".$forma_de_pagamento."'>
                                    <input type='hidden' name='valor_debito_receber' value='".$valor_debito_receber."'>
                                    <input type='hidden' name='valor_dinheiro_receber' value='".$valor_dinheiro_receber."'>
                                
                                    <div class='col-xs-4'>                                        
                                        <select class='form-control' id='n_parcela_cartao' name='n_parcela_cartao' >      
                                            ".$formaEscolhida->getOptionsCartao(($restante))."                                      
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
                
                                
                    $restante = (($valor_total) - ($valor_debito_receber + $valor_dinheiro_receber));
                    
                    $formaEscolhida = new FormaPagamento();
                    $formaEscolhida->gerarFormaDePagamento("DINHEIRO");                     
                     
                     $rows = $rows."<tr><td>1</td>"
                        . "<td>".$formaEscolhida->getDescricao()."</td>"
                        . "<td>".(int) $formaEscolhida->getValor_minimo_parcela()."</td>"
                        . "<td>".$valor_dinheiro_receber."</td>"
                        . "<td>".$valor_dinheiro_receber."</td></tr>";
                 
                    $formaEscolhida = new FormaPagamento();
                    $formaEscolhida->gerarFormaDePagamento("DEBITO");

                    $rows = $rows."<tr><td>2</td>"
                        . "<td>".$formaEscolhida->getDescricao()."</td>"
                        . "<td>".(int) $formaEscolhida->getValor_minimo_parcela()."</td>"
                        . "<td>".$valor_debito_receber."</td>"
                        . "<td>".$valor_debito_receber."</td></tr>";
                                
                    $formaEscolhida = new FormaPagamento();
                    $formaEscolhida->gerarFormaDePagamento("CARTAO");
                    
                    $rows = $rows."<tr>"
                            . "<td>3</td>"
                        . "<td>".$formaEscolhida->getDescricao()."</td>"
                        . "<td>".$n_parcela_cartao."</td>"
                        . "<td>".(($restante)/$n_parcela_cartao)."</td>"
                        . "<td>".$restante."</td>"
                            . "</tr>";
                    
                }
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
                
                echo "<form method='GET' action='processa_saida.php' name='myform' id='myform'>
                                <input type='hidden' name='id_fornecedor' value='".$id_fornecedor."'>
                                <input type='hidden' name='forma_de_pagamento' value='".$forma_de_pagamento."'>
                                <input type='hidden' name='valor_debito_receber' value='".$valor_debito_receber."'>
                                <input type='hidden' name='valor_dinheiro_receber' value='".$valor_dinheiro_receber."'>
                                
                                <input type='hidden' name='n_parcela_cartao' value='".$n_parcela_cartao."'>"
                    . "
                        <input type='submit' id='btn-confirmar_forma_pagamento' name='btn-confirmar_forma_pagamento' value='Confirmar Forma de Pagamento' class='btn btn-primary' />                                                                                           
                       "                         
                    ;
        }
        
    }
   
   public function imprimirFormEscolherFomarmaDePagamento($id_fornecedor) {
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
                        <form method='GET' action='nova_saida.php' name='myform' id='myform' >
                       
                            <input type='hidden' name='id_fornecedor' value='".$id_fornecedor."'>
                            <div class='col-xs-4'>                                
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
       $lista = Fornecedor::getLinhasTabelaServicoSaida($id);
              
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
                                <div class='x_content'>";
                                    
                                    if($lista != ""){
                                        echo " 
                                                <table id='datatable-responsive' class='table table-striped table-bordered dt-responsive nowrap' cellspacing='0' width='100%'>
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Nome</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        ".$lista."
                                                    </tbody>
                                                </table>";
                                        }

                                    echo "<label>                            
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
   
   
   public static function imprimirFormServico($id_servico){
       
        $dados_servicos = ServicoFornecedor::getInformacoes($id_servico);
                
        echo "<div class='clearfix'></div>

                    <div class='row'>
                        <div class='col-md-12 col-sm-12 col-xs-12'>
                            <div class='x_panel'>
                                <div class='x_title'>
                                    <h2>Serviço - Detalhamento</h2>
                                    <ul class='nav navbar-right panel_toolbox'>
                                        <li><a class='collapse-link'><i class='fa fa-chevron-up'></i></a>
                                        </li>                      
                                        <li><a class='close-link'><i class='fa fa-close'></i></a>
                                        </li>
                                    </ul>
                                    <div class='clearfix'></div>
                                </div>
                                <div class='x_content'>
                                <form method='POST' action='processa_saida.php' name='myform' id='myform' >
                                
                                    <div class='col-xs-6'>     
                                        <label for='descricao_servico'>Descrição</label>
                                        <input type='text' class='form-control' id='descricao_servico' name='descricao_servico' value='".$dados_servicos->getDescricao()."' disabled=''>  
                                        <input type='hidden' id = 'id_servico' name='id_servico' value='".$id_servico."'>
                                            <input type='hidden' id = 'id_fornecedor' name='id_fornecedor' value='".$dados_servicos->getId_fornecedor()."'>
                                    </div>

                                    <div class='col-xs-2'>     
                                            <label for='quantidade'>Quantidade</label>
                                        <input type='text' class='form-control' id='quantidade' name='quantidade' value='' required=''>  
                                    </div>
                                    
                                    <div class='col-xs-2'>     
                                        <label for='valor_unitario'>Valor Unitário</label>
                                        <input type='text' class='form-control' id='valor_unitario' name='valor_unitario' value='' required=''>  
                                    </div>
                                                                                                           
                                    <div class='col-xs-2'>     
                                        <label for='valor_pago'>Valor Pago</label>
                                        <input type='text' class='form-control' id='valor_pago' name='valor_pago' value='' required=''>  
                                    </div>
                                    
                                    <div class='col-xs-12'>     
                                        <br />
                                    </div>
                                                         
                                    <div class='col-xs-10'>                               
                                        <input type='submit' id='btn-salvar_selecionar_servico' name='btn-salvar_selecionar_servico' value='Salvar' class='btn btn-success' />                                    
                                    </div>
                                    
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>";
   }
}
