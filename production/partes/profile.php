<?php 
//session_start();

    include_once './controllers/Usuario.php';
    
?>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
                <a href="index.php" class="site_title"><i class="<?php echo Config::getIconTitulo(); ?>"></i> <span><?php echo Config::getSigla(); ?></span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile">
              <div class="profile_pic">
                  
                  <?php 
                  
                    if($_SESSION['sexo'] == 'F'){
                        $imagem = 'female_user.png';
                    }else{
                        $imagem = 'man_user.png';
                    }
                  ?>
                  
                <img src="images/<?php echo $imagem; ?>" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Olá,</span>
                <h2><?php echo Usuario::primeiroESegundoNomeUsuarioLogado(); ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />