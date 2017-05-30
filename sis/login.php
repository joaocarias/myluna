<?php
    session_start();
    session_destroy();
    session_start();

    include_once 'Auxiliares/Config.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo Config::getSigla(); ?> | <?php echo Config::getTitulo();?></title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="../vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
              <form action="processa_login.php" method="POST">
              <h1>Login</h1>
              <div>
                  <input type="text" id="username" name="username" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                  <input type="password" id="password" name="password" class="form-control" placeholder="Senha" required="" />
              </div>
              <div>
                  <input type='submit' class='btn btn-default submit'  name='entrar' id='entrar' value='Entrar' />               
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                   <br />
                <p class="change_link">
                  <a href="#signup" class="to_register"> Sobre </a>
                </p>

                <div class="clearfix"></div>
               
                <br />

                <div>
                    <h1><?php echo Config::getClinicaNome(); ?></h1>
                    <h1><?php echo Config::getClinicaNomeParte2(); ?></h1>
                    <p>©<?php echo Config::getAno(); ?> - Todos os Diretos Resevaos. </p><p>Desenvolvido por <?php echo Config::getDesenvolvido_por(); ?></p>
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
           
              <h1>Sobre</h1>
              <div class="separator">
                <p class="change_link"> </p>

                <div class="clearfix"></div>
                 <p>O <strong><?php echo Config::getSigla() ." - ".Config::getTitulo(); ?></strong> é um sistema voltado para a gestão 
                     administrativa de clínica ondotológia, proporcionando e presevando a eficiência de atividades administrativas a qual se 
                     destina, permitindo assim sempre crescimento e consitência na gestão administrativa.                  
                </p>
                <p class="change_link">Voltar e realizar
                  <a href="#signin" class="to_register"> Login </a>
                </p>
                <br />

              </div>
                <div class="separator">
                <div>
                   <div>
                    <h1><?php echo Config::getClinicaNome(); ?></h1>
                    <h1><?php echo Config::getClinicaNomeParte2(); ?></h1>
                    <p>©<?php echo Config::getAno(); ?> - Todos os Diretos Resevaos. </p><p>Desenvolvido por <?php echo Config::getDesenvolvido_por(); ?></p>
                    <p>Contato: <e-mail><?php echo Config::getEmail(); ?></e-mail></p>
                </div>
                </div>
              </div>
           
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
