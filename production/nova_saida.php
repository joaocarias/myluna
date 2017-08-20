<?php
session_start();

include_once 'testarLogado.php';

include_once 'partes/header.php';
include_once 'view/ViewSaida.php';
include_once 'partes/profile.php';    
include_once 'partes/menu_lateral.php';
include_once 'partes/menu_top.php';
    
    $view = new ViewSaida();    
    $view->setTitulo("Saída");
    $view->setSubTitulo("Cadastrar Nova Saída");
    
$novo_fornecedor = false;
$id_fornecedor = 0;
$novo_servico = false;
$id_servico = 0;
$forma_de_pagamento = "";

$n_parcela_cartao = "";
$valor_dinheiro_receber = "";
$valor_debito_receber = "";

if(isset($_GET['novo_fornecedor'])){
    $novo_fornecedor = $_GET['novo_fornecedor'];
}else{
    $novo_fornecedor = false;
}

if(isset($_GET['id_fornecedor'])){
    $id_fornecedor = $_GET['id_fornecedor'];    
}else{
    $id_fornecedor = 0;
}

if(isset($_GET['novo_servico'])){
    $novo_servico = $_GET['novo_servico'];
}else{
    $novo_servico = false;
}

if(isset($_GET['id_servico'])){
    $id_servico = $_GET['id_servico'];
}else{
    $id_servico = 0;
}

if(isset($_GET['forma_de_pagamento'])){
    $forma_de_pagamento = $_GET['forma_de_pagamento'];    
}else{
    $forma_de_pagamento = "";
}

if(isset($_GET['valor_dinheiro_receber'])){
    $valor_dinheiro_receber = $_GET['valor_dinheiro_receber'];    
}else{
    $valor_dinheiro_receber = "";
}

if(isset($_GET['valor_debito_receber'])){
    $valor_debito_receber = $_GET['valor_debito_receber'];    
}else{
    $valor_debito_receber = "";
}

if(isset($_GET['n_parcela_cartao'])){
    $n_parcela_cartao = $_GET['n_parcela_cartao'];    
}else{
    $n_parcela_cartao = "";
}
    
?>
      <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3><?php echo $view->getTitulo(); ?> <small><?php echo $view->getSubTitulo(); ?> </small></h3>
              </div>
                    
            </div>

            <div class="clearfix"></div>

                <?php
                
                    if($novo_fornecedor == true){
                        $view->imprimirFormNovoFornecedor();
                        
                    }else{                        
                        if($id_fornecedor > 0){
                            $view->imprimirDadosFornecedor($id_fornecedor);
                            
                            if($id_servico > 0){
                                    $view->imprimirFormServico($id_servico);                                
                            }
                            
                            $view->imprimirListaDetalhamentoSaida($id_fornecedor, $forma_de_pagamento);
                            
                            if($forma_de_pagamento == ""){
                                $view->imprimirListaDeServicosFornecedor($id_fornecedor);
                                if($novo_servico == true){
                                    $view->imprimirFormNovoServico($id_fornecedor);                            
                                }
                            }else if($forma_de_pagamento == "escolher"){
                                $view->imprimirFormEscolherFomarmaDePagamento($id_fornecedor);                            
                            }else{
                                 $view->imprimirFormPagamento($forma_de_pagamento, $id_fornecedor, $n_parcela_cartao, $valor_dinheiro_receber, $valor_debito_receber);
                            }
                        }else{                        
                            $view->imprimirListaFornecedor();
                        }
                    }
                            
                ?>
          </div>
          </div>
        </div>
        <!-- /page content -->
  
   <?php
   
include_once 'partes/footer_tabelas.php';    
    
    ?>