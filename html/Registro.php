<?php
    include '../php/conexion.php';
    $con = conexion();
    include '../php/barraBusquedaFunctions.php';
    include '../php/catalogoFunctions.php';
    include '../php/articulosFunctions.php';
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    session_start();
  
  //TIPO DE REGISTRO
  if(empty($_GET['tipo_registro'])){
    $tipo_registro = 0;
  }
  else{
    $tipo_registro = $_GET['tipo_registro'];
  }
  
  //NOMBRE DE USUARIO
  if(empty($_GET['usuario'])){
    $usuario = "";
  }
  else{
    $usuario = $_GET['usuario'];
  }
  
  //ID DE FACEBOOK
  if(empty($_GET['fb_id'])){
    $usuario_facebook_id = 0;
  }
  else{
    $usuario_facebook_id = $_GET['fb_id'];
  }
  
  //CORREO DEL USUARIO
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
      body { 
  background: url(../img/spawn.jpg) no-repeat center center fixed;
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
  <div id="fb-root"></div>
  <script>

window.fbAsyncInit = function() {
  FB.init({
    appId      : '655150577891800',
    status     : true, // check login status
    cookie     : true, // enable cookies to allow the server to access the session
    xfbml      : true,  // parse XFBML
    oauth      : true,
  });
};
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1&appId=655150577891800";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
  
  
    <?php
if (isset($_SESSION['usuario_email']) && isset($_SESSION['usuario_nombre'])) {
  $html = file_get_contents("../html/layouts/navbar_login_layout.html");
} else {
  $html = file_get_contents("../html/layouts/navbar_nologin_layout.html");
}


$doc = new DOMDocument();
$doc->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
?>

<div id="nav_bar"><?php echo $doc->saveHTML(); ?></div>
    <div class="container">
      <?php
  //SIMILAR AL NAV BAR, CARGAMOS DINAMICAMENTE LOS LAYOUTS PARA LAS VENTANAS MODALES
  //CARGAR VENTANA MODAL PARA INICIO DE SESION
  $modal_sesion_html = file_get_contents("../html/layouts/modal_login_layout.html");
  $modal_sesion = new DOMDocument();
  $modal_sesion->loadHTML(mb_convert_encoding($modal_sesion_html, 'HTML-ENTITIES', 'UTF-8'));
  echo $modal_sesion->saveHTML();

  //CARGAR VENTANA MODAL PARA REGISTRO CON FACEBOOK Y CORREO
  $modal_registro_html = file_get_contents("../html/layouts/modal_registro_layout.html");
  $modal_registro = new DOMDocument();
  $modal_registro->loadHTML(mb_convert_encoding($modal_registro_html, 'HTML-ENTITIES', 'UTF-8'));
  echo $modal_registro->saveHTML();
  ?>
      
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