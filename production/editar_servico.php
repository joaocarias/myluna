<?php
session_start();

  include_once 'testarLogado.php';

include_once 'view/ViewServico.php';

include_once 'partes/header.php';

include_once 'partes/profile.php';
    
include_once 'partes/menu_lateral.php';
    
//include_once 'partes/footer_buttons.php';
    
include_once 'partes/menu_top.php';

$acao = "";
$idServico = "";

if(isset($_GET['editar'])){
    $acao = "editar";
    if(isset($_GET['id_servico'])){
        $idServico = $_GET['id_servico'];
    }
}

    
    $view = new ViewServico();    
    $view->setTitulo("Serviço");
    $view->setSubTitulo("Editar Cadastro de Serviço");
    
    ?>
     <!-- page content -->
        <div class="right_col" role="main">                
            <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">
             
                <div class="row x_title">
                  <div class="col-md-6">
                    <h3><?php echo $view->getTitulo(); ?> <small><?php echo $view->getSubTitulo(); ?> </small></h3>

                  </div>                  
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                  
                    <?php $view->imprimirForm($acao, $idServico); ?>

                </div>

                <div class="clearfix"></div>
              </div>
            </div>
          </div>        
        </div>
   
  
   <?php
include_once 'partes/footer.php'; 
    
    
    ?>