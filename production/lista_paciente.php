<?php
session_start(); 

include_once 'testarLogado.php';
 
include_once './Auxiliares/Config.php';
include_once 'view/ViewPaciente.php';

include_once 'partes/header_tabelas.php'; 
    include_once 'partes/profile.php';
    include_once 'partes/menu_lateral.php';
    
    include_once 'partes/menu_top.php';
    
    $view = new ViewPaciente();    
    $view->setTitulo("Paciente");
    $view->setSubTitulo("Lista de Pacientes");
        
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
           
            <div style="text-align: right">
                <a href="relatorio_pacientes_pdf.php" target="_blank"><button class="btn btn-primary">Relatório em PDF</button></a>
              </div>

          </div>
          </div>
        </div>
        <!-- /page content -->

       
   <?php
include_once 'partes/footer_tabelas.php'; 
    
    
    ?>