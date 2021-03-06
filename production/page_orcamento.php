<?php
session_start();

include_once 'testarLogado.php';

include_once 'view/ViewOrcamento.php';
include_once 'view/ViewServico.php';
include_once 'view/ViewPaciente.php';
include_once 'view/ViewUsuario.php';

include_once 'partes/header.php';

include_once 'partes/profile.php';
    
include_once 'partes/menu_lateral.php';
    
//include_once 'partes/footer_buttons.php';
    
include_once 'partes/menu_top.php';

$idPaciente = 0;
$idServico = 0;
$idOrcamento = 0;
$idDentista = 0;

if(isset($_GET['id_orcamento'])){
    $id = $_GET['id_orcamento'];
}
    
    $view = new ViewOrcamento();    
    $view->setTitulo("Orcamento");
    $view->setSubTitulo("Informações sobre o Orcamento");
    
    $viewPaciente = new ViewPaciente();
    $viewDentista = new ViewUsuario();
    
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
                        if(isset($_GET['id_orcamento'])){
                            $idOrcamento = $_GET['id_orcamento'];

                            $dadosOrcamento = Orcamento::getInformacoes($idOrcamento, 1);
                            $idPaciente = $dadosOrcamento->getId_paciente();
                            $idDentista = $dadosOrcamento->getId_dentista();
                            
                                                      
                            $viewPaciente->imprimirInformacoesBasicasPaciente($idPaciente);
                                             
                            if($idDentista != 0){
                                $viewDentista->imprimirInformacaoDentistaOrcamento($idDentista);                      

                                echo "<div class='clearfix'></div>";

                                ViewServico::getItensDoOrcamento($idOrcamento, '1');  
                            }
                        }                        
                    ?>                    
                    

          </div>
          </div>
        </div>
        <!-- /page content -->
   
  
   <?php
include_once 'partes/footer_tabelas.php'; 
    
    
    ?>