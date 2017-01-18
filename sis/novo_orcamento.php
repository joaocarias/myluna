<?php
session_start();

  include_once 'testarLogado.php';  
include_once 'controllers/Paciente.php';
include_once 'controllers/Servico.php';
include_once 'view/ViewOrcamento.php';
include_once 'view/ViewServico.php';
include_once 'partes/header.php';
include_once 'partes/profile.php';    
include_once 'partes/menu_lateral.php';
include_once 'controllers/Usuario.php';
    
$acao = "";
$idUsuario = "";

$idPaciente = 0;

if(isset($_GET['id_paciente'])){
    $idPaciente = $_GET['id_paciente'];
}

include_once 'partes/menu_top.php';
    
    $view = new ViewOrcamento();    
    $view->setTitulo("Orçamento");
    $view->setSubTitulo("Novo <strong> Orçamento: </strong>");
    
    $myDados = Paciente::getInformacoes($idPaciente);
    
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

        <div class='row'>
            <div class='col-md-12 col-sm-12 col-xs-12'>
                <div class='x_panel'>
                    <div class='x_title'>
                        <h2>Dados do Paciente</h2>
                        <ul class='nav navbar-right panel_toolbox'>
                            <li><a class='collapse-link'><i class='fa fa-chevron-up'></i></a>
                            </li>                      
                            <li><a class='close-link'><i class='fa fa-close'></i></a>
                            </li>
                        </ul>
                        <div class='clearfix'></div>
                    </div>
                    <div class='x_content'>
                        <p>
                        <div class='col-md-5 col-sm-12 col-xs-12'>                                         
                            <strong>Nome Completo: </strong> <?php echo $myDados->getNome(); ?>
                        </div>

                        <div class='col-md-3 col-sm-6 col-xs-12'>                                         
                            <strong>Código: </strong> <?php echo $myDados->getId_paciente(); ?>
                        </div>

                        <div class='col-md-4 col-sm-6 col-xs-12'>                                         
                            <strong>CPF: </strong> <?php echo $myDados->getCpf(); ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
                  
                  
                  <?php
                                    
                    if(isset($_GET['dentista'])){
                        $id_dentista = $_GET['dentista'];
                        
                        $dadosDentista = Usuario::getInformacoes($id_dentista);
                        
                        
                        ?>
                  
                  <div class='clearfix'></div>

        <div class='row'>
            <div class='col-md-12 col-sm-12 col-xs-12'>
                <div class='x_panel'>
                    <div class='x_title'>
                        <h2>Dados do Dentista</h2>
                        <ul class='nav navbar-right panel_toolbox'>
                            <li><a class='collapse-link'><i class='fa fa-chevron-up'></i></a>
                            </li>                      
                            <li><a class='close-link'><i class='fa fa-close'></i></a>
                            </li>
                        </ul>
                        <div class='clearfix'></div>
                    </div>
                    <div class='x_content'>                       
                        <div class='col-md-5 col-sm-12 col-xs-12'>                                         
                            <strong>Nome Completo: </strong> <?php echo $dadosDentista->getNome(); ?>
                        </div>

                        <div class='col-md-3 col-sm-6 col-xs-12'>                                         
                            <strong>Código: </strong> <?php echo $dadosDentista->getId_usuario(); ?>
                        </div>

                        <div class='col-md-4 col-sm-6 col-xs-12'>                                         
                            <strong>CPF: </strong> <?php echo $dadosDentista->getCpf(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

                 
            
           <?php ViewServico::imprimirListaServicosParaOrcamento($idPaciente, $id_dentista); ?>
           
                  
              
          
        <!-- /page content -->
                  
                  <?php
                        
                    }else{
                  
                  ?>
                  
                <div class='row'>
            <div class='col-md-12 col-sm-12 col-xs-12'>
                <div class='x_panel'>
                    <div class='x_title'>
                        <h2>Dados do Dentista</h2>
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
                            <input type="hidden" id="id_paciente" name="id_paciente" value="<?php echo $myDados->getId_paciente(); ?>" />
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