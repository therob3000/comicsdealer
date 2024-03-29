<?php
include '../php/conexion.php';
$con = conexion();
include '../php/barraBusquedaFunctions.php';
//ARCHIVO QUE INCLUYE LAS FUNCIONES NECESARIAS PARA CARGAR LOS ELEMENTOS DEL CATALOGO
include '../php/catalogoFunctions.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

if (empty($_GET['pagina'])) {
  $pagina = 0;
} else {
  $pagina = $_GET['pagina'];
}
if (empty($_GET['compania_id'])) {
  $compania_id = 0;
} else {
  $compania_id = $_GET['compania_id'];
}
if (empty($_GET['idioma'])) {
  $idioma = 0;
} else {
  $idioma = $_GET['idioma'];
}
if (empty($_GET['personaje_id'])) {
  $personaje_id = 0;
} else {
  $personaje_id = $_GET['personaje_id'];
}
if (empty($_GET['busqueda'])) {
  $busqueda = 0;
} else {
  $busqueda = $_GET['busqueda'];
}

if (empty($_GET['parametro_busqueda'])) {
  $parametro_busqueda = "0";
} else {
  $parametro_busqueda = $_GET['parametro_busqueda'];
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
      var compania_id = <?php echo json_encode($compania_id); ?>;
      var idioma = <?php echo json_encode($idioma); ?>;
    </script>

    <script src="../bootstrap/assets/js/jquery.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../js/login.js"></script>
    <script src="../js/catalogo.js"></script>
    <script src="../js/registro_login.js"></script>
    <script src="../js/catalogo_index.js"></script>
    <script src="../js/promocion_index.js"></script>

    <script type="text/javascript">

      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-45620115-1']);
      _gaq.push(['_setDomainName', 'comicsdealer.com']);
      _gaq.push(['_trackPageview']);

      (function() {
        var ga = document.createElement('script');
        ga.type = 'text/javascript';
        ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
      })();

    </script>
    <style>
        body { 
  background: url('../../img/marvelbg1.jpg') no-repeat center center fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
};
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


    <?php
//CODIGO PARA CARGAR DINAMICAMENTE EL NAV BAR
//COMPROBAMOS QUE EXISTAN LAS VARIABLES DE USUARIO 'usuario_email' y 'usuario_nombre'
//SI EXISTEN OBTENEMOS EL LAYOUT 'layouts/navbar_login_layout.html'
    if (isset($_SESSION['usuario_email']) && isset($_SESSION['usuario_nombre'])) {
      $html = file_get_contents("layouts/navbar_login_layout.html");
    }
//SI NO EXISTEN OBTENEMOS EL LAYOUT 'layouts/navbar_nologin_layout.html'
    else {
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
            <div class="col-sm-6">
              <img style="height: 150px;" src="/img/ComicDLogo-09.svg" class="img-responsive" />
            </div>
            <div id="layout">
            
        </div>
            <div class="col-sm-6 col-md-6 col-lg-6 hidden-xs" id="redessociales">
              <div align="right">
                <div class="row">
                  <div class="col-sm-12" style="margin-bottom: 4%; margin-top: 6%">
                    <div class="fb-like" data-href="https://www.facebook.com/ComicsDealer" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12" style="margin-bottom: 3%; margin-top: 3%">
                    <a href="https://twitter.com/ComicsDealer" class="twitter-follow-button" data-show-count="false" data-lang="es">Seguir a @ComicsDealer</a>
                    <script>!function(d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
                        if (!d.getElementById(id)) {
                          js = d.createElement(s);
                          js.id = id;
                          js.src = p + '://platform.twitter.com/widgets.js';
                          fjs.parentNode.insertBefore(js, fjs);
                        }
                      }(document, 'script', 'twitter-wjs');</script>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12" style="margin-bottom: 3%; margin-top: 3%">
                     <a href="https://twitter.com/share" class="twitter-share-button" data-text="Hey! Revisa el Catalogo de Comics Dealer! :)" data-via="comicsdealer">Tweet</a>
                    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
                  </div>
                </div>
<!--                <div class="row">
                  <div class="col-sm-12" style="margin-top: 3%">
                    <a class="btn btn-xs btn-danger" href="/html/preRegistro.html">Regístrate ahora!</a>
                  </div>
                </div>-->
              </div>
            </div>
          </div>

          <br><br>
          <div id="searchnav">
            <?php
                //SE CARGA EN barraBusquedaFunctions.php
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
              <?php
              generaCategorias($idioma, $compania_id);
              ?>

            </div>
            <div class="col-sm-12 col-md-10">
              <div class="row">
                <div class="col-xs-12">
                  <div class="row">
                    <div class="col-xs-12">
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
                    //MODIFICACION DEL 6/05/2014
                    /* Se modifico la forma en que se carga el catalago para evitar repetir codigo en el archivo
                     * catalogoFunctions
                     */

                    $campos = array("inventario_id",
                        "cat_comic_titulo",
                        "cat_comic_descripcion",
                        "cat_comic_personaje",
                        "cat_comic_numero_ejemplar",
                        "cat_comic_imagen_url",
                        "inventario_precio_salida",
                        "cat_comic_idioma",
                        "inventario_paquete",
                        "cat_comic_imagen_mini",
                        "cat_comic_unique_id",
                        "cat_comic_numero_visitas"
                    );
                    $contador = $pagina;
                    $inventario = array();
                    if ($busqueda != 0) {
                      //$i = 4 por que queremos desplegar 4 renglones en el catalogo
                      //CONSULTA ESPECIFICA DE CATALOGO
                      for ($i = 0; $i < 4; $i++) {
                        $arrayComics = consulta_especifica($busqueda, $parametro_busqueda, $campos, $contador, 4);
                        $inventarioArray = cargarCatalogo($arrayComics, $i, 0);
                        $contador+=4;
                        if($inventarioArray != 0){
                            for ($j = 0; $j < count($inventarioArray); $j++) {
                                $inventario[] = $inventarioArray[$j];
                            }
                        }
                        
                        
                      }
                      if(count($inventario) == 0){
                        echo "<div class='alert alert-warning alert-dismissible' role='alert'>
                            <button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>
                            <strong>Lo sentimos</strong> No encontramos ningun cómic con esos criterios, tal vez no somos tan geniales despues de todo u__u.
                            </div>";
                      }
                      else{
                          $_SESSION['inventario'] = $inventario;
                      }
                      
                    } 
                    //CONSULTA GENERAL DE CATALOGO
                    else {
                      for ($i = 0; $i < 4; $i++) {
                        $arrayComics = consulta_catalogo($campos, $contador, 4, $compania_id, $idioma, $personaje_id, 0);
                        $inventarioArray = cargarCatalogo($arrayComics, $i, 0);
                        $contador+=4;
                        for ($j = 0; $j < count($inventarioArray); $j++) {
                          $inventario[] = $inventarioArray[$j];
                        }
                      }
                      $_SESSION['inventario'] = $inventario;
                    }

                    //CUALQUER MODIFICACION AL HTML DE LOS ELEMENTOS DEL CATALOGO SE HACE EN ESTA FUNCION
                    ?>
                  </div>
                  <!--PAGINACION-->
<?php
//FUNCION QUE CARGA LA PAGINACION PARA EL CATALOGO SE ENCUENTRA EN: /php/catalogoFunctions.php
//Parametros: 
//$pagina = Registro en la base a partir del cual queremos que empiece el catalogo
if ($busqueda != 0) {
  paginacionBusqueda($pagina, $busqueda, $parametro_busqueda);
} else {
  paginacion($pagina, $compania_id, $idioma, $personaje_id);
}
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
