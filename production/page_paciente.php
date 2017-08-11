<?php
session_start();

include_once 'testarLogado.php';

include_once 'view/ViewPaciente.php';
include_once 'partes/header.php';
include_once 'partes/profile.php';    
include_once 'partes/menu_lateral.php';      
include_once 'partes/menu_top.php';


include_once 'controllers/Mensagem.php';
    
    if(isset($_GET['msg'])){
                    $msg = $_GET['msg'];
                    Mensagem::getMensagem(2, $msg, "Início", "");
                }
$id = "";

if(isset($_GET['id_paciente'])){
    $id = $_GET['id_paciente'];
}
    
    $view = new ViewPaciente();    
    $view->setTitulo("Paciente");
    $view->setSubTitulo("Informações sobre o Paciente");
    
    ?>
     <!-- page content -->
        <div class="right_col" role="main">                
            <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">
             
                <div class="row x_title">
                  <div class="col-md-6">
                    <h3><?php echo $view->getTitulo(); ?> <small><?php echo $view->getSubTitulo(); ?> </small></h3>

                  </div>                  
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                  
                    <?php 
                        $view->informacoesBasicas($id);                        
                    ?>                    
                    
                </div>

                <div class="clearfix"></div>
                    
            <div class='col-md-12 col-sm-12 col-xs-12'>
                <div class='x_panel'>
                    <div class='x_title'>
                        <h2>...</h2>
                        <ul class='nav navbar-right panel_toolbox'>
                            <li><a class='collapse-link'><i class='fa fa-chevron-up'></i></a>
                            </li>
                        </ul>
                        <div class='clearfix'></div>
                    </div>
                    <div class='x_content'>  
                
                        <a href='editar_paciente.php?editar=true&id_paciente=<?php echo $id; ?>' title='Editar'><button type="button" class="btn btn-primary btn-small">
                          <span class="fa fa-pencil-square-o" aria-hidden="true"></span> Editar
                            </button></a>
                        
                         <a href='processa_paciente.php?btn-excluir=true&id_paciente=<?php echo $id; ?>' title='Excluir'><button type="button" class="btn btn-danger btn-small">
                          <span class="fa fa-pencil-square-o" aria-hidden="true"></span> Excluir
                            </button></a>

                        <?php if($_SESSION['tipo'] == 1){ ?>
                        
                        <a href='novo_orcamento.php?novo_orcamento=true&id_paciente=<?php echo $id; ?>' title='Novo Orçamento''><button type="button" class="btn btn-default btn-small">
                          <span class="fa fa-calculator" aria-hidden="true"></span> Novo Orçamento
                            </button></a> 
                      
                        <?php } ?>
                        
                    </div>
                 </div>
            </div>
                
                
                
                <?php 
                
                if($_SESSION['tipo'] == 1){ ?>    
                 
               
             
                    <?php
                        $view->imprimirListaOrcamentoPaciente($id);                        
                    ?>                    
                    
                    

                <div class="clearfix"></div>
              </div>
                
                <?php } ?>
                  
            </div>
          </div>        
        </div>
   
  
   <?php
include_once 'partes/footer.php'; 
    
    
    ?>