<?php 

    session_start();

    include_once 'testarLogado.php';
   
    include_once 'partes/header.php';   
    include_once 'partes/profile.php';
    include_once 'partes/menu_lateral.php';
    include_once 'partes/menu_top.php'; 
    
    include_once 'view/ViewPaciente.php';
    include_once 'view/ViewEntrada.php';
    
    ?>

        <!-- page content -->
        <div class="right_col" role="main">
        
          <div class="row">
              
              
            <?php
                if(isset($_GET['msg'])){
                    $msg = $_GET['msg'];

                    Mensagem::getMensagem(2, $msg, "Início", "");
                }
            
                if($_SESSION['tipo'] == 1){              
                    ViewEntrada::getUltimasEntradas();           
                }                
                
                ViewPaciente::getQuantidadeNovosPacientes();
                ViewPaciente::getUltimosPacientes(); 
            ?>
                    
	 
           <?php if($_SESSION['tipo'] == 1){ ?>
              
              
        
           <?php } ?>
        
          </div>
        <!-- /page content -->
        
        
        
        

    <?php            include_once 'partes/footer.php'; ?>