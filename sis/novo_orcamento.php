<?php
session_start();

  include_once 'testarLogado.php';  
include_once 'controllers/Paciente.php';
include_once 'view/ViewOrcamento.php';
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
    $view->setSubTitulo("Nome do Paciente: <strong>".Paciente::getInformacoes($idPaciente)->getNome()."</strong>");
    
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

                <div class="col-md-12 col-sm-12 col-xs-12">
                  
                <div class='col-lg-12'>        
                    <form method='POST' action='processa_orcamento.php' name='myform' id='myform' >                            
                        <div class='col-sm-12'>                        
                            <div class='panel panel-primary'>
                                <div class='panel-heading'>
                                    <h3 class='panel-title'>Escolha o Dentista</h3>
                                </div>
                                <div class='panel-body'>                            
                                    <div class='col-xs-4'>
                                        <label for='dentista'>Lista</label>
                                        <select class='form-control' id='uf' name='uf' >                                        
                                            <option value='sel'>Selecione</option>
                                            <?php echo Usuario::getOpcoesSelecaoDentista(); ?>
                                        </select>
                                    </div>                                            
                                </div>                    
                            </div>        
                        </div>
                    <div class='col-sm-12'>                        
                    
                    <div class='panel panel-primary'>
                    <div class='panel-heading'>
                        <h3 class='panel-title'>Informações Básicas</h3>
                    </div>
                    <div class='panel-body'>     
                    
                        <div class='col-xs-9'>
                           <label for='descricao'>Descrição *</label>
                            <input type='text' class='form-control' id='descricao' maxlength='100' name='descricao' value='".$descricao."' required />
                        </div>
                        
                        <div class='col-xs-3'>
                            <label for='valor'>Valor R$</label>
                            <input type='text' class='form-control' id='valor' name='valor' maxlength='7' value='".$valor."' required/>
                        </div>     
                                                
                    </div>                    
                </div>          
                
                
                <div>
                    <p>
                        <label>                            
                            <button type='button' class='btn btn btn-danger' data-toggle='modal' data-target='.bs-example-modal-lg'>Cancelar</button>                           
                        </label>
                        ".$btn_salvar."                         
                    </p>
                </div>
                    
                </div>
                
            </form>         
        </div>

                </div>

                <div class="clearfix"></div>
              </div>
            </div>
          </div>        
        </div>
   
  
   <?php
include_once 'partes/footer.php'; 
    
    
    ?>