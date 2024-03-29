<?php
include 'php/conexion.php';
$con = conexion();
include 'php/barraBusquedaFunctions.php';
include 'php/catalogoFunctions.php';
include 'php/articulosFunctions.php';
include 'php/carouselFunctions.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
?>

<!DOCTYPE html>

<head>
  <title>Comics Dealer</title>

  <link href="/img/ComicDminiFB.jpg" rel="image_src" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="keywords" content="comics, cómics, tienda de comics en mexico, tienda online de comics, bootstrap, marvel, dc, televisa, vid, méxico, bootstrap">
  <meta name="description" content="Comics Dealer es una pagina hecha por desarrolladores mexicanos que se especializa en buscar y encontrar cómics en México, que cuenta con un catalogo de cómics tanto en ingles como en español. ¡Los buscamos por ti!">

  <!-- Bootstrap -->
  <link href="bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link rel="shortcut icon" href="img/ComicDico-01.png">
  <link href="bootstrap/css/navbar.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="bootstrap/css/comicsD.css">
  <script src="/bootstrap/assets/js/jquery.js"></script>
  <script src="/bootstrap/js/bootstrap.min.js"></script>
<!--  <script src="/js/catalogo.js"></script>-->
  <script src="/js/promocion_index.js"></script>
  <script src="/js/index.js"></script>
  <script src="/js/login.js"></script>
  <script src="/js/registro_login.js"></script>
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
  }(document, 'script', 'facebook-jssdk'));
</script>

<style>
body { 
  background: url(../../img/marvelbg1.jpg) no-repeat center center fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
</style>

<?php
if (isset($_SESSION['usuario_email']) && isset($_SESSION['usuario_nombre'])) {
  $html = file_get_contents("html/layouts/navbar_login_layout.html");
} else {
  $html = file_get_contents("html/layouts/navbar_nologin_layout.html");
}


$doc = new DOMDocument();
$doc->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
?>

<div id="nav_bar"><?php echo $doc->saveHTML(); ?></div>
<div class="container">
  <?php
  //SIMILAR AL NAV BAR, CARGAMOS DINAMICAMENTE LOS LAYOUTS PARA LAS VENTANAS MODALES
  //CARGAR VENTANA MODAL PARA INICIO DE SESION
  $modal_sesion_html = file_get_contents("html/layouts/modal_login_layout.html");
  $modal_sesion = new DOMDocument();
  $modal_sesion->loadHTML(mb_convert_encoding($modal_sesion_html, 'HTML-ENTITIES', 'UTF-8'));
  echo $modal_sesion->saveHTML();

  //CARGAR VENTANA MODAL PARA REGISTRO CON FACEBOOK Y CORREO
  $modal_registro_html = file_get_contents("html/layouts/modal_registro_layout.html");
  $modal_registro = new DOMDocument();
  $modal_registro->loadHTML(mb_convert_encoding($modal_registro_html, 'HTML-ENTITIES', 'UTF-8'));
  echo $modal_registro->saveHTML();
  ?>

  <!--Aqui empieza el jumbotron Principal y de Fin de semana -->
  <div class="container tres" >
    <!--<div class="jumbotron">-->
    <div class="catalogo">
      <div class="row">
        <div class="col-sm-6">
          <div id="carousel-logo" class="carousel slide logo" data-ride="carousel" data-interval="7000">
            <ol class="carousel-indicators">
              <li data-target="#carousel-logo" data-slide-to="0" class="active"></li>
              <li data-target="#carousel-logo" data-slide-to="1" class=""></li>
              <li data-target="#carousel-logo" data-slide-to="2" class=""></li>
            </ol>
            <div class="carousel-inner">
              <div class="item active">
                <img style="height: 130px;" src="img/Carousel-Logo-1.svg" class="img-responsive" />
              </div>
              <div class="item">
                <img style="height: 130px;" src="img/Carousel-Logo-2.svg" class="img-responsive" />
              </div>
              <div class="item">
                <img style="height: 130px;" src="img/Carousel-Logo-3.svg" class="img-responsive" />
              </div>
            </div>
          </div>
        </div>
        <!--Aqui se inserta el contenido Principal-->
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
                            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-12" style="margin-bottom: 3%; margin-top: 3%">
                            <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://www.comicsdealer.com" data-text="Es la neta" data-via="ComicsDealer" data-lang="es">Twittear</a>
                            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
                          </div>
                        </div>
<!--                        <div class="row">
                          <div class="col-sm-12" style="margin-top: 3%">
                            <a class="btn btn-xs btn-danger" href="html/preRegistro.html">Regístrate ahora!</a>
                          </div>
                        </div>-->
                      </div>
                    </div>

      </div>

      <br>
      <div id="searchnav">
        <?php
        //Esta funcion se encuentra en el archivo barraBusquedaFunctions.php
        cargarBarraBusqueda();
        ?>
      </div>

      <div class="row">
        <div class="col-sm-12">
          <h3 style="margin-bottom: 0px;">Novedades en el Catálogo Privado de <strong>Dr. Death</strong>
            <br><small>La pura novedad en Comics Dealer</small></h3>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-9">
<!--          <div class="thumbnail hidden-xs hidden-sm">
            <div id="carousel-comics-dealer" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <li data-target="#carousel-comics-dealer" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-comics-dealer" data-slide-to="1" class=""></li>
                <li data-target="#carousel-comics-dealer" data-slide-to="2" class=""></li>
              </ol>
              <div class="carousel-inner carousels">

              </div>
              <a class="left carousel-control" href="#carousel-comics-dealer" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
              </a>
              <a class="right carousel-control" href="#carousel-comics-dealer" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
              </a>
            </div>  
          </div>-->
        <?php
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
                $arrayCarousel = consulta_catalogo_carousel($campos);
                cargarCarousel($arrayCarousel, 1);
       ?>
            
        </div>
        <div class="col-sm-3 hidden-sm" style="width: 23%" >
            <img src="img/anuncio_sm_01.jpg" alt=""/>
        </div>
      </div>

      <!-- Aquí va lo del artículo más reciente -->
      <!-- EL ARTICULO ESTA ESTATICO ¿SE CARGARA DINAMICAMENTE?-->
      <div class="row">
        <div class="col-lg-12" >
          <h3 style="margin-bottom: 0px;">Articulos y noticias de <strong>La liga de la Maldad</strong>
            <br><small>Reviews, noticias y mas.</small></h3>
        </div>  
      </div>
      <?php
      cargarArticuloReciente();
      ?>


      <!--Esta parte sustituye a carousels_index-->
      <!--LOS MAS VENDIDOS, REGLA AUN POR DEFINIR-->
      <div class="row">
        <div class="col-lg-12" >
          <h3 style="margin-bottom: 0px;">Lo más vendido de las reservas de <strong>Dr. Death</strong>
            <br><small>La pura nata concentrada de los cómics</small></h3>
        </div>  
      </div>
      <div class="row">

        <div class="col-md-9">

          <div>
            <?php
            //cargarCatalogo(0, 2, 0, 0, 4, 0,1);
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

            $contador = 0;

            for ($i = 0; $i < 2; $i++) {
              $arrayComics = consulta_catalogo($campos, $contador, 4, 0, 0, 0, 2);
              cargarCatalogo($arrayComics, $i, 1);
              $contador+=4;
            }
            ?>
          </div>
          <div class="row">             
            <div class="col-lg-4 col-lg-offset-8"> 
              <p style="font-size: 14pt" align="right"><a href="html/Catalogo.php" class="btn btn-primary btn-sm"><strong>Ver el catálogo completo </strong> <span class="glyphicon glyphicon-forward"></span></a></p>
            </div> 
          </div>

        </div>
        <div class="col-sm-3 hidden-sm" style="width: 23%">
            <img src="img/anuncio_lg_01.jpg" alt=""/>
        </div>

      </div>



      <!--LOS MAS BUSCADOS-->
      <!--LOS MAS VENDIDOS, REGLA AUN POR DEFINIR-->
      <div class="row">
        <div class="col-lg-12" >
          <h3 style="margin-bottom: 0px;">Lo más <strong>buscado</strong> por los verdaderos 
            <br><small>COLECCIONISTAS</small></h3>
        </div>  
      </div>
      <div class="row">

        <div class="col-md-9">

          <div>
            <?php
            //cargarCatalogo(0, 2, 0, 0, 4, 0,1);
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

            $contador = 0;

            for ($i = 0; $i < 2; $i++) {
              $arrayComics = consulta_catalogo($campos, $contador, 4, 0, 0, 0, 1);
              cargarCatalogo($arrayComics, $i, 1);
              $contador+=4;
            }
            ?>
          </div>
          <div class="row">             
            <div class="col-lg-4 col-lg-offset-8"> 
              <p style="font-size: 14pt" align="right"><a href="html/Catalogo.php" class="btn btn-primary btn-sm"><strong>Ver el catálogo completo </strong> <span class="glyphicon glyphicon-forward"></span></a></p>
            </div> 
          </div>

        </div>
        <div class="col-sm-3 hidden-sm" style="width: 23%">
            <img src="img/anuncio_lg_02.jpg" alt=""/>
        </div>

      </div>


      <br />

      <div class="row hidden-md hidden-lg" id="catalogo_comics">
        <?php
        //cargarCatalogo(0, 2, 0, 0, 4, 0,1);
        $campos = array("inventario_id",
            "cat_comic_titulo",
            "cat_comic_descripcion",
            "cat_comic_personaje",
            "cat_comic_numero_ejemplar",
            "cat_comic_imagen_url",
            "inventario_precio_salida",
            "cat_comic_idioma",
            "inventario_paquete"
        );

        $contador = 0;

        for ($i = 0; $i < 2; $i++) {
          $arrayComics = consulta_catalogo($campos, $contador, 4, 0, 0, 0);
          cargarCatalogo($arrayComics, $i, 1);
          $contador+=4;
        }
        ?>
      </div><!-- /.row1 -->

<!--      <div class="row">             
        <div class="col-lg-4 col-lg-offset-8"> 
          <p style="font-size: 14pt" align="center"><a href="html/Catalogo.php"><strong>Ver el catálogo completo »</strong></a></p>
        </div> 
      </div>-->
      <hr></hr>
    </div>
  </div><!-- /.Catalogo Muestra-->

  <div class="container tres">
    <div class="jumbotron">
      <h4>¿Quiénes somos?</h4>
      <p style="font-size: 12pt" align="justify">Somos un grupo amante de los cómics, comprometido a conseguir los mejores precios para nuestros usuarios, pero también nos dedicamos a buscar y encontrar cómics que te hagan falta, de <strong>cualquier editorial</strong>, en <strong>cualquier idioma</strong> (inglés, alemán, zapoteco), o bien de <strong>cualquier país</strong> (Japón, Yugoslavia, <a href="http://es.wikipedia.org/wiki/Islas_Cook">Islas Cook</a>, etc). Con nuestra ayuda podrás tener en la puerta de tu casa todos los ejemplares que faltan en tu colección, sólo tienes que seguir estos tres simples pasos: 
      </p>
      <p class="text-default" align="center">
        <span class="label label-info">Regístrate »</span>
        <span class="label label-primary">Buscamos tus cómics »</span>
        <span class="label label-success">Los pagas y te los entregamos \o/</span></p>
      <p style="font-size: 12pt" align="justify">Ahora, si eres un Jedi usa la fuerza pra pedirnos cómics, si no, no temas y...</p>        
      <p align="right">
          <button class="btn btn-lg btn-danger" id="registroButtonBanner">Registrate!</button>
      </p>
      <p align="right" class="text-muted" style="font-size: 11pt">Este servicio es para toda la Republica Mexicana.</p>
    </div>
  </div> 

  <div id="infos"></div>

  <div class="container tres">  
    <div class="jumbotron">
      <blockquote style="font-size:12pt">
        <p>"...with great power there must also come -- great responsibility!"</p>
        <small><cite title="Amazing Spider-Man2, #3Parker"></cite></small>
      </blockquote>
    </div>

  </div>

  <div id="footer"></div>
</div>
</body>
</html>