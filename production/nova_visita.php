<?php
session_start();


include_once 'testarLogado.php';

include_once 'partes/header_tabelas.php'; 
include_once 'partes/profile.php';    
include_once 'partes/menu_lateral.php';
include_once 'partes/menu_top.php';

include_once 'view/ViewAgendamento.php';
include_once 'view/ViewPaciente.php';

$id_paciente = 0;

if($_GET['id_paciente']){
    $id_paciente = $_GET['id_paciente'];
}else{
    $id_paciente = 0;
}

 $view = new ViewAgendamento();    
    $view->setTitulo("Agendamento");
    $view->setSubTitulo("Agendar Visita");
    
    $viewPaciente = new ViewPaciente();
        
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
                    <?php
                        if($id_paciente > 0){
                            $viewPaciente->imprimirInformacoesBasicasPaciente($id_paciente);                            
                            $view->imprimirForm("inserir", $id_paciente);
                            
                        }else{
                            $view->getTabelaPacientesAgendamento();
                        }
                    ?>                        
                </div>
          </div>
 
        
        
    <!-- fim page content -->


<?php
    if($id_paciente > 0){
        include_once 'partes/footer_form.php';
    } else{
        include_once 'partes/footer_tabelas.php'; 
    }
     
     
?>

  </body>
</html>