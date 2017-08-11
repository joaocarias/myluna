<?php
session_start();

include_once 'testarLogado.php';
  
include_once 'partes/header.php';

include_once 'partes/profile.php';
    
include_once 'partes/menu_lateral.php';
       
include_once 'partes/menu_top.php';
 
include_once 'view/ViewSaida.php';


$id = "";

if(isset($_GET['id_saida'])){
    $id = $_GET['id_saida'];
}

    $view = new ViewSaida();    
    $view->setTitulo("Saida");
    $view->setSubTitulo("Informações sobre a Saída");
        
    
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
                                      
                    <?php
                        $view->informacoesBasicas($id);               
                    ?>

                </div>

                <div class="clearfix"></div>
              </div>
            </div>
          </div>        
        </div>
   
  
   <?php
include_once 'partes/footer.php'; 
    
    
    ?>