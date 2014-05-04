<?php
include '../php/conexion.php';
$con = conexion();

include '../php/catalogoFunctions.php';

ini_set('display_errors',1); 
error_reporting(E_ALL);
session_start();

if (empty($_GET['pagina'])){
  $pagina = 0; 
}
else{
  $pagina = $_GET['pagina'];
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Artículos</title>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap -->
  <link href="../bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
  <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link rel="shortcut icon" href="../img/ComicDico-01.png">
  <link href="../bootstrap/css/navbar.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../bootstrap/css/comicsD.css">
  <!-- Estilo css para blog -->
  <link href="blog.css" rel="stylesheet">
  <script>
    var pagina = <?php echo json_encode($pagina); ?>;
  </script>
  <script src="../bootstrap/assets/js/jquery.js"></script>
  <script src="../bootstrap/js/bootstrap.min.js"></script>
  <script src="../js/catalogo.js"></script>
  <script src="../js/login.js"></script>
  <script src="../js/registro_login.js"></script>
  <script src="../js/articulos_index.js"></script>
  <script type="text/javascript">

    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-45620115-1']);
    _gaq.push(['_setDomainName', 'comicsdealer.com']);
    _gaq.push(['_trackPageview']);

    (function() {
      var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
      ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';
      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();

  </script>
  <style>
    .container {
      background: url(../img/avengers1.jpg) no-repeat center center fixed;
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
      <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1";
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));</script>
      
      <?php
      if (isset($_SESSION['usuario_email']) && isset($_SESSION['usuario_nombre'])) {
          $html = file_get_contents("layouts/navbar_login_layout.html");
      } else {
          $html = file_get_contents("layouts/navbar_nologin_layout.html");
      }


      $doc = new DOMDocument();
      $doc->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
      ?>

      <div id="nav_bar"><?php echo $doc->saveHTML(); ?></div>
      <div class="container">
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
            <div class="highlight">

              <div class="row">
                <div class="col-sm-offset-1 col-sm-10 blog-main">
                  <h1 class="blog-title">Los Reviews de la Liga de la Maldad.</h1>
                  <p class="lead blog-description">Todo lo que debes saber para convertirte un lector serio.</p>
                </div>
              </div>

              <div class="row">

                <div class="col-sm-offset-1 col-sm-10 blog-main">
                  <div class="sidebar-module sidebar-module-inset">
                    <h4>Acerca</h4>
                    <p align="justify">Esta sección de <em>artículos</em> la hemos creado para darte una introducción a nuevos personajes, o bien una guía a sagas importantes. "Es lo que debes saber".</p>
                  </div>

                  <div class="blog-post" id="articulos">

                  </div><!-- /.Aquí termina lo que hay que poner para cada artículo -->

                  

                  <ul class="pager">
                    <li id="anterior"></li>
                    <li id="siguiente"></li>
                  </ul>

                </div><!-- /.blog-main -->

              </div><!-- /.row -->

            </div>
          </div><!-- /.Articulos -->

          <div class="container tres">
            <div class="catalogo">
              <div class="row">
                <div class="col-lg-12" >
                  <h2 style="margin-bottom: 0px;">Tambien puedes revisar nuestro <strong>Catálogo</strong>
                  <br><small>La pura nata concentrada de los cómics</small></h2>
                </div>  
              </div>
              
              <hr></hr>
              <?php
                cargarCatalogo(0,1,1,0,3,0);
                cargarCatalogo(0,1,2,0,3,0);
              ?>
              <div class="row">             
                <div class="col-lg-4 col-lg-offset-8"> 
                  <p style="font-size: 14pt" align="center"><a href="Catalogo.php"><strong>Ver el catálogo completo »</strong></a></p>
                </div> 
              </div>
              <hr></hr>
            </div>
          </div><!-- /.Catalogo Muestra-->

          <div id="infos"></div>

          <div class="container tres">  
            <div class="jumbotron">
              <blockquote style="font-size:12pt">
                <p>"No good has ever come of a Holy War, and never will!"</p>
                <small><cite title="Amazing Spider-Man, Vol. 2, #38">Superman. The War for Peace, Action Comics #517</cite></small>
              </blockquote>
            </div>
          </div>

          <div id="footer"></div>


          <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

          <!-- Include all compiled plugins (below), or include individual  files as needed -->
        </div> 
      </body>
      </html>