<?php
session_start();

  include_once 'testarLogado.php';
include_once 'view/ViewPaciente.php';
include_once 'partes/header.php';
include_once 'partes/profile.php';    
include_once 'partes/menu_lateral.php';
    
$acao = "";
$idUsuario = "";

include_once 'partes/menu_top.php';
    
    $view = new ViewPaciente();    
    $view->setTitulo("Paciente");
    $view->setSubTitulo("Cadastrar Novo Paciente");
    
    ?>

 <!-- page content -->
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3><?php echo $view->getTitulo(); ?> <small><?php echo $view->getSubTitulo(); ?> </small></h3>
              </div>
              
            </div>

            <div class="clearfix"></div>
                    
                      <?php $view->imprimirForm($acao,$idUsuario); ?>

<!--                </div>

                <div class="clearfix"></div>
              </div>
            </div>
          </div>        
        </div>-->

 </div>
          </div>
   
     
     <?php
//include_once 'partes/footer.php'; 
    include_once 'partes/footer_form.php';
    
    ?>