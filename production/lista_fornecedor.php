<!DOCTYPE html>

<?php
session_start(); 

include_once './Auxiliares/Config.php';
include_once 'view/ViewFornecedor.php';

include_once 'partes/header_tabelas.php'; 
    include_once 'partes/profile.php';
    include_once 'partes/menu_lateral.php';
    
    include_once 'partes/menu_top.php';
    
    $view = new ViewFornecedor();    
    $view->setTitulo("Paciente");
    $view->setSubTitulo("Lista de Fornecedores");
    
    
  
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

            
              <?php $view->imprimirListaFornecedor(); ?>
              

          </div>
          </div>
        </div>
        <!-- /page content -->

       
   <?php
include_once 'partes/footer_tabelas.php'; 
    
    
    ?>