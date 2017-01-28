<?php

session_start();

  include_once 'testarLogado.php';  
include_once 'partes/header.php';  
include_once 'controllers/Paciente.php';
include_once 'controllers/Servico.php';
include_once 'controllers/Orcamento.php';
include_once 'controllers/Usuario.php';
include_once 'view/ViewOrcamento.php';
include_once 'view/ViewServico.php';
include_once 'view/ViewPaciente.php';
include_once 'view/ViewUsuario.php';

include_once 'partes/profile.php';    
include_once 'partes/menu_lateral.php';
    
$acao = "";
$idUsuario = "";

$idPaciente = 0;
$idServico = 0;
$idOrcamento = 0;
$idDentista = 0;

if(isset($_GET['id_orcamento'])){
    $idOrcamento = $_GET['id_orcamento'];
    
    if(isset($_GET['novo_orcamento'])){
        if($_GET['novo_orcamento'] == "true"){
            $dadosOrcamento = Orcamento::getInformacoes($idOrcamento, 3);
            $idPaciente = $dadosOrcamento->getId_paciente();
            $idDentista = $dadosOrcamento->getId_dentista();
            
            //echo "<script>alert('".$idPaciente." : ".$idDentista."'); </script>";
        }
    }  
    
      
}else if(isset($_GET['id_paciente'])){
    $idPaciente = $_GET['id_paciente'];
      
}

if(isset($_GET['servico'])){
    $idServico = $_GET['servico'];
}

include_once 'partes/menu_top.php';
    
    $view = new ViewOrcamento();    
    $view->setTitulo("Orçamento");
    $view->setSubTitulo("Novo <strong> Orçamento: </strong>");
    
    $viewPaciente = new ViewPaciente();
    $viewDentista = new ViewUsuario();
    
    //Mensagem de Cancelar
    if($idOrcamento == ""){
        Mensagem::getMensagem(1, 1, $view->getTitulo(), "processa_orcamento.php");
    }else{
        Mensagem::getMensagem(1, 3, $view->getTitulo(), "processa_orcamento.php?btn-cancelar=true&id_orcamento=".$idOrcamento);
    }
   
   //  Mensagem::getMensagem(1, 3, $view->getTitulo(), "processa_orcamento.php?btn-cancelar=true&id_orcamento=".$id_orcamento);
        
    ?>
     <!-- page content -->
        <div class="right_col" role="main">                
            <div class="row">
                
                
                
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">
             
                <div class="row x_title">
                  <div class="col-md-12">
                    <h3><?php echo $view->getTitulo(); ?> <small><?php echo $view->getSubTitulo(); ?> </small></h3>

                  </div>                  
                </div>

                  <div class='clearfix'></div>

                <?php
                 
                    $viewPaciente->imprimirInformacoesBasicasPaciente($idPaciente);
                      
                    if($idDentista != 0){
                        $viewDentista->imprimirInformacaoDentistaOrcamento($idDentista);                      
                  
                        echo "<div class='clearfix'></div>";
                       
                        if($idServico > 0){
                            ViewServico::imprimirFormServicoOrcamento($idOrcamento, $idServico);
                        }else{
                            ViewServico::imprimirListaServicosParaOrcamento($idOrcamento);
                        }   
                        
                        ViewServico::getItensDoOrcamento($idOrcamento, '3');  
                       
                        echo "                                
                                <label>                            
                                    <button type='button' class='btn btn btn-danger' data-toggle='modal' data-target='.bs-example-modal-lg'>Cancelar</button>                           
                                </label>
                           ";                
                    }else{
                  
                  ?>
                  
                <div class='row'>
            <div class='col-md-12 col-sm-12 col-xs-12'>
                <div class='x_panel'>
                    <div class='x_title'>
                        <h2>Escolher o Dentista</h2>
                        <ul class='nav navbar-right panel_toolbox'>
                            <li><a class='collapse-link'><i class='fa fa-chevron-up'></i></a>
                            </li>                      
                            <li><a class='close-link'><i class='fa fa-close'></i></a>
                            </li>
                        </ul>
                        <div class='clearfix'></div>
                    </div>
                    <div class='x_content'>      
                        <form method='POST' action='processa_orcamento.php' name='myform' id='myform' > 
                            <input type="hidden" id="id_paciente" name="id_paciente" value="<?=$idPaciente; ?>" />
                            <div class='col-xs-4'>
                                <label for='dentista'>Lista</label>
                                <select class='form-control' id='dentista' name='dentista' >      
                                    <?php echo Usuario::getOpcoesSelecaoDentista(); ?>
                                </select>                                         
                            </div>       
                            <div class="col-xs-4">
                                <input type="submit" class="btn btn-primary" name="btn-selecionar-dentista" value="Selecionar">
                            </div>
                        </form>
                    </div>
                    </div>
            </div>
                </div>
                  <label>                            
                            <button type='button' class='btn btn btn-danger' data-toggle='modal' data-target='.bs-example-modal-lg'>Cancelar</button>                           
                        </label>
                  
        </div>
                
                <?php 
                    }   //fechamento do else
                    ?>
                
                </div>

                <div class="clearfix"></div>
              </div>
            </div>
          </div>        
        </div>
   
  
   <?php
include_once 'partes/footer.php';     
    
    ?>