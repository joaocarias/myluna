<?php
session_start();

include_once 'testarLogado.php';
  
include_once 'partes/header.php';

include_once 'partes/profile.php';
    
include_once 'partes/menu_lateral.php';
       
include_once 'partes/menu_top.php';
 
include_once 'view/ViewAgendamento.php';


$id = "";

if(isset($_GET['id_agendamento'])){
    $id = $_GET['id_agendamento'];
}
    $view = new ViewAgendamento();    
    $view->setTitulo("Agendamento");
    $view->setSubTitulo("Editar o Agendamento");
         
    
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
                        $view->imprimirFormEditar($id);                        
                    ?>

               </div>
          </div>
 
        
        
    <!-- fim page content -->
  
   <?php
include_once 'partes/footer.php'; 
    
    
    ?>