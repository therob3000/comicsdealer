<?php
  ini_set('display_errors',1); 
  error_reporting(E_ALL);

  if(empty($_GET['tipo_registro'])){
    $tipo_registro = 0;
  }
  else{
    $tipo_registro = $_GET['tipo_registro'];
  }

  if(empty($_GET['usuario'])){
    $usuario = "";
  }
  else{
    $usuario = $_GET['usuario'];
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Registro</title>
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link rel="shortcut icon" href="../img/ComicDico-01.png">
    <link href="../bootstrap/css/navbar.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/comicsD.css">
    <script>
      var tipo_registro = <?php echo json_encode($tipo_registro); ?>;
      var nombre = <?php echo json_encode($nombre); ?>;
    </script>
    <script src="../bootstrap/assets/js/jquery.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../js/registro.js"></script>
    <script src="../js/login.js"></script>
    <script src="../js/pie_pagina.js"></script>

    <style>
      .container {
        background: url(../img/spawn1.jpg) no-repeat center center fixed;
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
    <div id="nav_bar">
    </div>
    <div class="container">
      <!-- Inicia ventana modal -->
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel">Bienvenido, haz login!</h4>
            </div>
            <form role="form" id="login">
            <div class="modal-body">
              <form role="form">
                <div class="form-group">
                  <label for="exampleInputEmail1">Correo Electrónico</label>
                  <input type="email" class="form-control" id="email" placeholder="Correo electrónico" name="usuario_email">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input type="password" class="form-control" id="password" placeholder="Password" name="usuario_password">
                </div>
                <a href="html/PerdidaPass.html">¿Olvidaste tu Password?</a>
            </div>
            <div class="modal-footer navbar-inverse">
              <img src="../img/ComicDLogo-04.svg" vspace="10" hspace="10"
              class="img-responsive text-center" width="207" height="26"/>
              <button type="submit" class="btn btn-success" >Iniciar Sesión</button>
              <button type="button" class="btn btn-default" data-dismiss="modal" >Cancelar</button>
            </div>
            </form>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
      
      <div class="container tres">
        <div class="jumbotron">
          <img src="../img/Registro.svg" vspace="10" hspace="10"
               class="img-responsive text-center" />
          <div id="registroContainer" >
            <!--Formulario de Registro-->
          	<form role="form" id="registro">
              <div class="highlight">
              
              	<div class="form-group" id="formnombre">
                  	<label for="Registro">Nombre o apodo</label>
      				      <input type="text" class="form-control" id="nombre" placeholder="Ej. Bruce Wayne" name="usuario_nombre">
                </div>
                <div class="form-group" id="formemail">
                  	<label for="Registro">Dirección de e-mail</label>
      				      <input type="email" class="form-control" id="email_registro" placeholder="algo@aperture.com" name="usuario_email">
                </div>
                <div class="form-group" id="formpass">
                  	<label for="Registro">Password de mínimo 8 caracteres</label>
      				      <input type="password" class="form-control" id="password_registro" placeholder="1234 no es un buen password" name="usuario_password" autocomplete="off">
                </div>
                <div class="form-group" id="formpass2">
                  	<label for="Registro">Password otra vez</label>
      				      <input type="password" class="form-control" id="password2" placeholder="Va de nuéz tu password" name="password2" autocomplete="off">
                </div>
                <p></p>
                <p align="right">
                  <button type="submit" class="btn btn-lg btn-danger">Regístrame</button>
                </p>
              </div> 
            </form>
          </div>
        </div>
      </div>

      <div id="infos"></div>

      <div class="container tres">  
        <div class="jumbotron">
          <blockquote style="font-size:12pt">
            <p>"...do or do not, there is no try"</p>
            <small><cite title="The Empire Strikes Back">Master Yoda</cite></small>
          </blockquote>
        </div>
      </div>

      <div id="footer">
      </div>
      

          <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      
      <!-- Include all compiled plugins (below), or include individual  files as needed -->
    </div>
  </body>
</html>