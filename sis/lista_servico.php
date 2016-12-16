<!DOCTYPE html>

<?php
session_start(); 

  include_once 'testarLogado.php';
include_once 'view/ViewServico.php';

include_once 'partes/header_tabelas.php'; 
    include_once 'partes/profile.php';
    include_once 'partes/menu_lateral.php';
    
    include_once 'partes/menu_top.php';
    
    $view = new ViewServico();    
    $view->setTitulo("Serviço");
    $view->setSubTitulo("Lista de Serviços");
        
   

  
    
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

            
              <?php $view->imprimirListaServicos(); ?>
              

                  
              
          </div>
          </div>
        </div>
        <!-- /page content -->

       
   <?php
include_once 'partes/footer_tabelas.php'; 
    
    
    ?>