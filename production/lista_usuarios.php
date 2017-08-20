<?php
session_start(); 

include_once 'testarLogado.php';

include_once './Auxiliares/Config.php';
include_once 'view/ViewUsuario.php';

include_once 'partes/header_tabelas.php'; 
    include_once 'partes/profile.php';
    include_once 'partes/menu_lateral.php';
    
    include_once 'partes/menu_top.php';
    
    $view = new ViewUsuario();    
    $view->setTitulo("Usuario");
    $view->setSubTitulo("Lista de Usuário");
    
    
  
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

            
              <?php $view->imprimirListaUsuarios(); ?>
              

                  
              
          </div>
          </div>
        </div>
        <!-- /page content -->

       
   <?php
include_once 'partes/footer_tabelas.php'; 
    
    
    ?>