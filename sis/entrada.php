
<?php
session_start();

$idPaciente = "";

if(isset($_GET['id_paciente'])){
    $idPaciente = $_GET['id_paciente'];
}else{
    $idPaciente = "";
}

include_once 'testarLogado.php';

include_once 'partes/header.php';

include_once 'view/ViewEntrada.php';
include_once 'view/ViewPaciente.php';

include_once 'partes/profile.php';
    
include_once 'partes/menu_lateral.php';
    
include_once 'partes/menu_top.php';
    
    $view = new ViewEntrada();    
    $view->setTitulo("Entrada");
    $view->setSubTitulo("Cadastrar Nova Entrada");
    
    $viewPaciente = new ViewPaciente();
    
    $idPaciente = "";
    if(isset($_GET['id_paciente'])){
        $idPaciente = $_GET['id_paciente'];
    }else{
        $idPaciente = "";
    }
            
    if($idPaciente == ""){
        //Paciente não passado como parâmentos, logo, é necessário seleciona-lo.
        
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
              

          </div>
          </div>
        </div>
        <!-- /page content -->
  
   <?php
   
   
    }else{
        //Paciente informado...
   
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
                    $viewPaciente->imprimirInformacoesBasicasPaciente($idPaciente);
                    $view->imprimirListaItensNaoRecebidos($idPaciente);
                    $view->imprimirListaItensSelecionados($idPaciente);
                ?>
              </div>
          </div>
        </div>
        <!-- /page content -->

        
        <?php
        
        
    }
   
include_once 'partes/footer_tabelas.php';    
    
    ?>