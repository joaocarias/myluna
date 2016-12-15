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
                  <input type='submit' class='btn btn-default submit'  name='entrar' id='entrar' value='Entrar no Sistema' />               
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                   
                <p class="change_link"><a class="reset_pass" href="#">Esqueceu a sua Senha?</a>
                  <a href="#signup" class="to_register"> Sobre </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                    <h1><?php echo Config::getClinicaNome(); ?></h1>
                    <h1><?php echo Config::getClinicaNomeParte2(); ?></h1>
                    <p>©2016 Todos os Diretos Resevaos. </p><p>Desenvolvido por João Carias de França</p>
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form>
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" href="index.html">Submit</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
