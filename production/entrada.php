
<?php
session_start();

$idPaciente = "";
$forma_de_pagamento = ""; 
$n_parcela_cartao = "";
$valor_dinheiro_receber = "";
$valor_debito_receber = "";

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

if(isset($_GET['id_paciente'])){
    $idPaciente = $_GET['id_paciente'];
}else{
    $idPaciente = "";
}

if(isset($_GET['forma_de_pagamento'])){
    $forma_de_pagamento = $_GET['forma_de_pagamento'];    
}else{
    $forma_de_pagamento = "";
}

if(isset($_GET['n_parcela_cartao'])){
    $n_parcela_cartao = $_GET['n_parcela_cartao'];    
}else{
    $n_parcela_cartao = "";
}

include_once 'testarLogado.php';

include_once 'partes/header.php';

include_once 'view/ViewEntrada.php';
include_once 'view/ViewPaciente.php';

include_once 'partes/profile.php';
    
include_once 'partes/menu_lateral.php';
    
include_once 'partes/menu_top.php';
    
    $view = new ViewEntrada();    
    $view->setTitulo("Entrada");
    $view->setSubTitulo("Cadastrar Nova Entrada");
    
    $viewPaciente = new ViewPaciente();
            
    if($idPaciente == ""){
        //Paciente não passado como parâmentos, logo, é necessário seleciona-lo.
        
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

            
              <?php $view->imprimirListaPacientes(); ?>
              

          </div>
          </div>
        </div>
        <!-- /page content -->
  
   <?php
   
   
    }else{
        //Paciente informado...
   
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
                    $viewPaciente->imprimirInformacoesBasicasPaciente($idPaciente);
                    
                    $permissao_remover = TRUE;
                    if($forma_de_pagamento == ""){
                        $view->imprimirListaItensNaoRecebidos($idPaciente);
                        $permissao_remover = TRUE;
                   
                         
                        $view->imprimirListaItensSelecionados($idPaciente, $permissao_remover, strtoupper($forma_de_pagamento));
                    }else{
                        $permissao_remover = FALSE;
                         
                        $view->imprimirListaItensSelecionados($idPaciente, $permissao_remover, strtoupper($forma_de_pagamento));
                        
                        if($forma_de_pagamento == "escolher"){
                            $view->imprimirFormEscolherFomarmaDePagamento($idPaciente);
                        }else{
                            $view->imprimirFormPagamento($forma_de_pagamento, $idPaciente, $n_parcela_cartao, $valor_dinheiro_receber, $valor_debito_receber);                            
                        }
                    }
                   
                                        
                ?>
            
                <label>                            
                    <button type='button' class='btn btn btn-danger' data-toggle='modal' data-target='.bs-example-modal-lg'>Cancelar</button>                           
                </label>  
              </div>

        </div>
        </div>
        <!-- /page content -->

        <?php
            
        
    }
   
include_once 'partes/footer_tabelas.php';    
    
    ?>