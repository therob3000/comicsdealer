<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Cambio de datos</title>
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap -->
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link rel="shortcut icon" href="../img/ComicDico-01.png">
    <link href="../bootstrap/css/navbar.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/comicsD.css">
    <script src="../bootstrap/assets/js/jquery.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../js/cambios.js"></script>
    <script src="../js/login.js"></script>

    <style>
      .container {
        background: url(../img/superman1.jpg) no-repeat center center fixed;
        background-size: cover;
      }    
      body{
        background: url(../img/superman.jpg) no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
      }
    </style>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../../assets/js/html5shiv.js"></script>
      <script src="../../assets/js/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
      <?php
        $html = file_get_contents("layouts/navbar_login_layout.html");
        $doc = new DOMDocument();
        
        $doc->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
      ?>
    <div id="nav_bar"><?php echo $doc->saveHTML(); ?></div>
    <div class="container">
      <div class="container tres">
        <div class="jumbotron">
          <img src="../img/Cambios.svg" vspace="10" hspace="10"
               class="img-responsive text-center" />
            <!-- Formulario Cambio de password-->
            <div id="mensajepass"></div>
            <form role="form" id="cambio_pass">
              <div class="highlight">
                <div class="form-group" id="formpass1">
                  <label for="Cambios">Cambio de password</label>
                  <input type="password" class="form-control" id="password" placeholder="Password actual" name="usuario_password" autocomplete="off">
                </div>
                <div class="form-group" id="formpass2">
                  <input type="password" class="form-control" id="password1" placeholder="Nuevo password de al menos 8 caracteres" name="password1" autocomplete="off">
                </div>
                <div class="form-group" id="formpassnew2">
                  <input type="password" class="form-control" id="password2" placeholder="Tu nuevo password otra vez, cómo la vez" name="password2" autocomplete="off">
                </div>
              
                <p></p>
                <p align="right">
                  <button type="submit" class="btn btn-danger">Cambio de password</button>
                </p>
              </div> 
            </form>
            <!-- Formulario Cambio de email-->
            <div id="mensajemail"></div>
            <form role="form" id="cambio_email">
              <div class="highlight">
                <div class="form-group" id="formpass">
                  <label for="Cambios">Cambio de E-mail</label>
                  <div class="form-group" id="formemail">
                  <input type="email" class="form-control" id="email" placeholder="Tu e-mail actual" name="usuario_email">
                </div>
                  <input type="password" class="form-control" id="password" placeholder="Password" name="usuario_password" autocomplete="off">
                </div>
                <div class="form-group" id="formemail">
                  <input type="email" class="form-control" id="email" placeholder="Tu nuevo e-mail" name="usuario_email_nuevo">
                </div>
              
                <p></p>
                <p align="right">
                  <button type="submit" class="btn btn-danger">Cambio de e-mail</button>
                </p>
              </div> 
            </form>
        </div>
      </div>

      <div id="infos">
      </div>

      <div class="container tres">  
        <div class="jumbotron">
          <blockquote style="font-size:12pt">
            <p>"One ring to rule them all, one ring to find them, one ring the bring them all, and in the darkness bind them. In the land of Mordor where the shadows lie.” -</p>
            <small><cite title="The Lord Of The Rings">Dark Lord Sauron</cite></small>
          </blockquote>
        </div>
      </div>

      <div id="footer"></div>
      

          <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      
      <!-- Include all compiled plugins (below), or include individual  files as needed -->
    </div> 
  </body>
</html>