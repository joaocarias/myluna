<?php
session_start();

include_once 'testarLogado.php';

include_once 'partes/header.php';
include_once 'partes/profile.php';    
include_once 'partes/menu_lateral.php';    
include_once 'partes/menu_top.php';

include_once 'view/ViewUsuario.php';

   
    $view = new ViewUsuario();    
    $view->setTitulo("Usuário");
    $view->setSubTitulo("Resetar Senha");
       
    if(isset($_GET['msg'])){
        $msg = $GET['msg'];
        
        switch ($msg){
            case 0:
                $msg_texto = "Tente Novamente - Senha Inválida!";
                break;
            case 1:
                $msg_texto = "Tente Novamente - Senha Inválida!";
                break;
            default :
                $msg_texto = "Tente Novamente - Erro Desconhecido!";
                break;
        }
    }else{
        $msg = "";
        $msg_texto = "";
    }
    
    
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
                        $view->imprimirFormNovaSenha(); 
                    ?>
                    
                 
                
            <?php
            
                if($msg_texto){
                
            ?>
                  <div class="clearfix"></div>
                    <div class='col-md-12 col-sm-12 col-xs-12'>
                <div class='x_panel'>
                  <div class='x_title'>
                    <h2>[Atenção] <small>Aconteceu algum erro!</small></h2>
                    <ul class='nav navbar-right panel_toolbox'>
                      <li><a class='collapse-link'><i class='fa fa-chevron-up'></i></a>
                      </li>
                    </ul>
                    <div class='clearfix'></div>
                  </div>
                    <div class='x_content'>
                        <strong><p style="color: red"><?php echo $msg_texto; ?></p></strong>
                    </div>
                </div>
              </div>
                  <?php
                  }
                  ?>
          </div>
          </div>
      </div>
        
        <!-- /page content -->
  
 
        <?php
        
         include_once 'partes/footer_tabelas.php';    
    
    ?>
