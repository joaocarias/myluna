<?php
session_start();

include_once 'testarLogado.php';
  
include_once 'view/ViewPaciente.php';

include_once 'partes/header.php';

include_once 'partes/profile.php';
    
include_once 'partes/menu_lateral.php';
    
include_once 'partes/menu_top.php';
    
$acao = "";
$idServico = "";


if(isset($_GET['editar'])){
    $acao = "editar";
    if(isset($_GET['id_paciente'])){
        $idPaciente = $_GET['id_paciente'];
    }
}

    $view = new ViewPaciente();    
    $view->setTitulo("Paciente");
    $view->setSubTitulo("Editar Cadastro de Paciente");
    
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
                  
                   <?php $view->imprimirForm($acao, $idPaciente); ?>

                </div>

                <div class="clearfix"></div>
              </div>
            </div>
          </div>        
        </div>
   
  
   <?php
include_once 'partes/footer.php'; 
    
    
    ?>