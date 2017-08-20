<?php
session_start();

include_once 'testarLogado.php';

include_once 'partes/header.php';
include_once 'partes/profile.php';    
include_once 'partes/menu_lateral.php';    
include_once 'partes/menu_top.php';

include_once 'view/ViewUsuario.php';

$cpf = "";

if(isset($_GET['cpf'])){
    $cpf = $_GET['cpf'];
    
}else{
    $cpf = "";
}
    
    $view = new ViewUsuario();    
    $view->setTitulo("Usuário");
    $view->setSubTitulo("Resetar Senha");
    
    
    
       

    
    
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

            
                <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Buscar <small>Informe o CPF</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="buscar_usuario" data-parsley-validate class="form-horizontal form-label-left" method="GET">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cpf">CPF <span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <input type="text" id="cpf" name="cpf" required="required" value="<?php echo $cpf; ?>" class="form-control col-md-7 col-xs-12" maxlength="11" placeholder="CPF - Apenas Números">
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12 ">                          
                          <button type="submit" class="btn btn-primary">Buscar</button>
                        </div>
                      </div>
                      
                    </form>
                  </div>
                </div>
              </div>
            </div>

            
                    
                    <?php 
                        if($cpf != "")
                            $view->imprimirFormResetarSenha($cpf); 
                    ?>
                    
                    
            
      

          </div>
          </div>
        </div>
        <!-- /page content -->
  
 
        <?php
        
         include_once 'partes/footer_tabelas.php';    
    
    ?>
