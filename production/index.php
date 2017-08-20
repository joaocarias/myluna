<?php 

    session_start();

    include 'testarLogado.php';
   
    include 'partes/header.php';   
    include 'partes/profile.php';
    include 'partes/menu_lateral.php';
    include 'partes/menu_top.php'; 
    
    include 'view/ViewPaciente.php';
    include 'view/ViewEntrada.php';
    include_once 'controllers/Mensagem.php';
    
    if(isset($_GET['msg'])){
                    $msg = $_GET['msg'];
                    Mensagem::getMensagem(2, $msg, "Início", "");
                }
    
    ?>

        <!-- page content -->
        <div class="right_col" role="main">
        
          <div class="row">
              
            <?php
                
            
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