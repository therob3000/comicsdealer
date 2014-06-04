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
  <div id="fb-root"></div>
<script>

  window.fbAsyncInit = function() {
    FB.init({
      appId: '655150577891800',
      status: true, // check login status
      cookie: true, // enable cookies to allow the server to access the session
      xfbml: true, // parse XFBML
      oauth: true
    });

  };

  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id))
      return;
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1&appId=655150577891800";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>

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
                    $campos = array("inventario_id",
                                            "cat_comic_titulo",
                                            "cat_comic_descripcion",
                                            "cat_comic_personaje",
                                            "cat_comic_numero_ejemplar",
                                            "cat_comic_imagen_url",
                                            "inventario_precio_salida",
                                            "cat_comic_idioma"
                            );
              
                    $contador = 0;

                    for ($i = 0; $i < 2; $i++) {
                        $arrayComics = consulta_catalogo($campos, $contador, 4, 0, 0, 0);
                        cargarCatalogo($arrayComics, $i, 1);
                        $contador+=4;
                    }
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