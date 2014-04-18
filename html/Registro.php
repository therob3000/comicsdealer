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

  if(empty($_GET['fb_id'])){
    $usuario_facebook_id = 0;
  }
  else{
    $usuario_facebook_id = $_GET['fb_id'];
  }

  if(empty($_GET['correo'])){
    $correo = "";
  }
  else{
    $correo = $_GET['correo'];
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
      var nombre = <?php echo json_encode($usuario); ?>;
      var correo = <?php echo json_encode($correo); ?>;
      var usuario_facebook_id = <?php echo json_encode($usuario_facebook_id); ?>;
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
  <script>

window.fbAsyncInit = function() {
  FB.init({
    appId      : '655150577891800',
    status     : true, // check login status
    cookie     : true, // enable cookies to allow the server to access the session
    xfbml      : true,  // parse XFBML
    oauth      : true,
  });

  // Here we subscribe to the auth.authResponseChange JavaScript event. This event is fired
  // for any authentication related change, such as login, logout or session refresh. This means that
  // whenever someone who was previously logged out tries to log in again, the correct case below 
  // will be handled. 
  FB.Event.subscribe('auth.authResponseChange', function(response) {
    // Here we specify what we do with the response anytime this event occurs. 
    if (response.status === 'connected') {
      // The response object is returned with a status field that lets the app know the current
      // login status of the person. In this case, we're handling the situation where they 
      // have logged in to the app.
      //window.location.href = "/html/Catalogo.php";

    } else if (response.status === 'not_authorized') {
      // In this case, the person is logged into Facebook, but not into the app, so we call
      // FB.login() to prompt them to do so. 
      // In real-life usage, you wouldn't want to immediately prompt someone to login 
      // like this, for two reasons:
      // (1) JavaScript created popup windows are blocked by most browsers unless they 
      // result from direct interaction from people using the app (such as a mouse click)
      // (2) it is a bad experience to be continually prompted to login upon page load.
      window.location.href = "/index.php";
    } else {
      // In this case, the person is not logged into Facebook, so we call the login() 
      // function to prompt them to do so. Note that at this stage there is no indication
      // of whether they are logged into the app. If they aren't then they'll see the Login
      // dialog right after they log in to Facebook. 
      // The same caveats as above apply to the FB.login() call here.
      window.location.href = "/index.php";
    }
  });
};


  

(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1&appId=655150577891800";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
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