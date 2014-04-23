<?php

include '../php/conexion.php';
$con = conexion();
include '../php/barraBusquedaFunctions.php';
//ARCHIVO QUE INCLUYE LAS FUNCIONES NECESARIAS PARA CARGAR LOS ELEMENTOS DEL CATALOGO
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
if(empty($_GET['compania_id'])){
    $compania_id = 0;
}
else{
    $compania_id = $_GET['compania_id'];
}
if(empty($_GET['idioma'])){
    $idioma = 0;
}
 else {
    $idioma = $_GET['idioma'];
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Catálogo</title>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap -->
  <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link rel="shortcut icon" href="/img/ComicDico-01.png">
  <link href="/bootstrap/css/navbar.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../bootstrap/css/comicsD.css">
  
  <script>
    var pagina = <?php echo json_encode($pagina); ?>;
  </script>

  <script src="../bootstrap/assets/js/jquery.js"></script>
  <script src="../bootstrap/js/bootstrap.min.js"></script>
  <script src="../js/login.js"></script>
  <script src="../js/catalogo.js"></script>
  <script src="../js/registro_login.js"></script>
  <script src="../js/catalogo_index.js"></script>

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
      background: url(../img/AVXM31.jpg) no-repeat center center fixed;
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
    oauth      : true
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
        //CODIGO PARA CARGAR DINAMICAMENTE EL NAV BAR
      
        //COMPROBAMOS QUE EXISTAN LAS VARIABLES DE USUARIO 'usuario_email' y 'usuario_nombre'
        //SI EXISTEN OBTENEMOS EL LAYOUT 'layouts/navbar_login_layout.html'
        if (isset($_SESSION['usuario_email']) && isset($_SESSION['usuario_nombre'])) {
           $html = file_get_contents("layouts/navbar_login_layout.html"); 
        }
        //SI NO EXISTEN OBTENEMOS EL LAYOUT 'layouts/navbar_nologin_layout.html'
        else{
            $html = file_get_contents("layouts/navbar_nologin_layout.html");
        }
        
        //PARA CARGAR DINAMICAMENTE SEGMENTOS DE HTML EN PHP CREAMOS UN OBJETO DOMDocument()
        $nav_bar = new DOMDocument();
        //Y AGREGAMOS EL SEGMENTO QUE QUEREMOS CARGAR, EN ESTE CASO $html
        $nav_bar->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
      ?>
      
      <div id="nav_bar">
          
          <?php 
            //FINALMENTE CON ECHO IMPRIMIMOS LA CADENA DEL HTML CARGADO
            //EL FUNCIONAMIENTO DEL HTML SE LLEVA ACABO CON JQUERY
            echo $nav_bar->saveHTML(); 
          ?>
      </div>


      <div class="container">
         
          <?php 
            //SIMILAR AL NAV BAR, CARGAMOS DINAMICAMENTE LOS LAYOUTS PARA LAS VENTANAS MODALES
            
            //CARGAR VENTANA MODAL PARA INICIO DE SESION
            $modal_sesion_html = file_get_contents("layouts/modal_login_layout.html");
            $modal_sesion = new DOMDocument();
            $modal_sesion->loadHTML(mb_convert_encoding($modal_sesion_html, 'HTML-ENTITIES', 'UTF-8'));
            echo $modal_sesion->saveHTML();
            
            //CARGAR VENTANA MODAL PARA REGISTRO CON FACEBOOK Y CORREO
            $modal_registro_html = file_get_contents("layouts/modal_registro_layout.html");
            $modal_registro = new DOMDocument();
            $modal_registro->loadHTML(mb_convert_encoding($modal_registro_html, 'HTML-ENTITIES', 'UTF-8'));
            echo $modal_registro->saveHTML();
         ?>

        <div class="container tres">

          <div class="catalogo">
            <div class="row">
              <!--Aqui se inserta el logo Principal-->
              <div class="col-sm-9">
                <img style="height: 150px;" src="/img/ComicDLogo-09.svg" class="img-responsive" />
              </div>
              <div class="col-sm-3 hidden-xs">
                <div align="right">
                  <div class="row">
                    <div class="col-sm-12" style="margin-bottom: 4%; margin-top: 6%">
                      <div class="fb-like" data-href="https://www.facebook.com/ComicsDealer" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12" style="margin-bottom: 3%; margin-top: 3%">
                      <a href="https://twitter.com/ComicsDealer" class="twitter-follow-button" data-show-count="false" data-lang="es">Seguir a @ComicsDealer</a>
                      <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12" style="margin-bottom: 3%; margin-top: 3%">
                      <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://www.comicsdealer.com" data-text="Es la neta" data-via="ComicsDealer" data-lang="es">Twittear</a>
                      <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12" style="margin-top: 3%">
                      <a class="btn btn-xs btn-danger" href="/html/preRegistro.html">Regístrate ahora!</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <br><br>
            <div id="searchnav">
                <?php
                    cargarBarraBusqueda();
                ?>
            </div>
            
            <div class="row">
              <div class="col-md-2 blog-sidebar hidden-sm hidden-xs">
                <!--<div class="sidebar-module sidebar-module-inset">
                  <h4>Categorías</h4>
                </div>--><br>
                <h4>Categorías</h4>
                <hr>
                <div class="sidebar-module">
                  <h4>DC</h4>
                  <ol class="list-unstyled" id="marvel">
                    <li><a href="#">Batman</a></li>
                    <li><a href="#">Catwoman</a></li>
                    <li><a href="#">Flash</a></li>
                    <li><a href="#">Green Lantern</a></li>
                  </ol>
                </div>
                <div class="sidebar-module">
                  <h4>Marvel</h4>
                  <ol class="list-unstyled" id="marvel">
                    <li><a href="#">Avengers</a></li>
                    <li><a href="#">Captain America</a></li>
                    <li><a href="#">Daredevil</a></li>
                    <li><a href="#">Spiderman</a></li>
                  </ol>
                </div>
              </div>
              <div class="col-sm-12 col-md-10">
                <div class="row">
                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-lg-12">
                        <h3  style="margin-bottom: 0px;">Catálogo Privado de <strong>Dr. Death</strong>
                          <br><small>Sólo la crema condensada del mundo del cómic.</small></h3>
                      </div>
                    </div>
                    <hr></hr>

                    <div class="rows">
                    <!--ELEMENTOS DEL CATALOGO-->
                        <?php
                            //FUNCION QUE CARGA EL HTML PARA EL CATALOGO SE ENCUENTRA EN: /php/catalogoFunctions.php
                            //Parametros: 
                            //$pagina = Registro en la base a partir del cual queremos que empiece el catalogo
                            //$renglones = Numero de renglones que queremos mostrar por pagina, en este caso 4
                            cargarCatalogo($pagina,4,$compania_id,$idioma);
                            //CUALQUER MODIFICACION AL HTML DE LOS ELEMENTOS DEL CATALOGO SE HACE EN ESTA FUNCION
                        ?>
                    </div>
                    <!--PAGINACION-->
                    <?php
                        //FUNCION QUE CARGA LA PAGINACION PARA EL CATALOGO SE ENCUENTRA EN: /php/catalogoFunctions.php
                        //Parametros: 
                        //$pagina = Registro en la base a partir del cual queremos que empiece el catalogo
                        paginacion($pagina);
                    ?>
                    
                  </div>
                </div>
              </div>  
            </div>


          </div>

          <!--</div> /.Catalogo -->

          <div id="infos"></div>

          <div class="container tres">  
            <div class="jumbotron">
              <blockquote style="font-size:12pt">
                <p>"We didn't mean it! We never mean it! But what good does that do..."</p>
                <small><cite title="Amazing Spider-Man, Vol. 2, #38">Vietnam veteran Flash Thompson, Amazing Spider-Man, 1st series, #109</cite></small>
              </blockquote>
            </div>
          </div>

          <div id="footer"></div>


          <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
          

          <!-- Include all compiled plugins (below), or include individual  files as needed -->
        </div> 
      </body>
      </html>
      