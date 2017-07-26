<!DOCTYPE html>

<?php
session_start(); 

include_once './Auxiliares/Config.php';
include_once 'view/ViewAgendamento.php';

include_once 'partes/header_tabelas.php'; 
    include_once 'partes/profile.php';
    include_once 'partes/menu_lateral.php';
    
    include_once 'partes/menu_top.php';
    
    $periodo = '1';
    
    if(isset($_GET['periodo'])){
        $periodo = $_GET['periodo'];
    }else{
        $periodo = '1';
    }
    
    
    $view = new ViewAgendamento();    
    $view->setTitulo("Agendamento");
    
    if($periodo == '1'){
        $subTitulo = "Lista de Agendamento do dia";
    }else{
        $subTitulo = "Lista de Agendamento";
    }
    
    $view->setSubTitulo($subTitulo);
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

              <?php  if($periodo == '1'){
                        $view->imprimirListaAgendamento($periodo);
                     }else if($periodo == '2'){
                         if(isset($_GET['de']) AND isset($_GET['ate'])){
                            $view->imprimirListaAgendamento($periodo, $_GET['de'], $_GET['ate']);
                         }else{
                            $view->imprimirFormPeriodoData();
                         }
                     }else{
                         $view->imprimirListaAgendamento($periodo);
                     }
               ?>
            

          </div>
          </div>
        </div>
        <!-- /page content -->

       
   <?php

    if($periodo == '2'){
        include_once 'partes/footer_form.php';
    }else{
        include_once 'partes/footer_tabelas.php'; 
    }
    
    ?>