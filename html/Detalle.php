<?php
//ini_set('display_errors',1); 
//error_reporting(E_ALL);
session_start();
include '../php/conexion.php';
include '../php/cargarDetalleDinamico.php';
include '../php/barraBusquedaFunctions.php';
include '../php/catalogoFunctions.php';
$con = conexion();
$comic_id = $_GET['comic_id'];

obtenerDatos($comic_id);

$comic_img_query = "select cat.cat_comic_imagen_url, dat.datos_comic_titulo, SUBSTRING(dat.datos_comic_descripcion,1,180) as descripcion from inventario as inv
inner join cat_comics as cat on inv.inventario_cat_comic_unique_id = cat.cat_comic_unique_id
inner join datos_comics as dat on cat.cat_comic_descripcion_id = dat.datos_comic_id
where inv.inventario_id = $comic_id";

$queryResultado = mysql_query($comic_img_query);
$comic_img = mysql_result($queryResultado, 0, "cat_comic_imagen_url");
$comic_titulo = mysql_result($queryResultado, 0, "datos_comic_titulo");
$comic_descripcion = mysql_result($queryResultado, 0, "descripcion");
$comic_descripcion = htmlspecialchars($comic_descripcion, ENT_QUOTES);
?>

<!DOCTYPE html>
<html>
  <head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
    <title id="comic_title"><?php echo obtenerTitulo(); ?></title><!-- Nombre del comic-->

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta property="fb:app_id" content="655150577891800" /> 
    <meta property="og:type"   content="article" /> 

    <?php echo "<meta property='og:url' content='http://www.comicsdealer.com/html/Detalle.php?comic_id=$comic_id'/>"; ?>
    <?php echo "<meta property='og:image'  content='$comic_img' />"; ?>
    <?php echo "<meta property='og:title'  content='$comic_titulo' />"; ?>
    <?php echo "<meta property='og:description'  content='$comic_descripcion'/>"; ?>


    <!-- Bootstrap -->
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link rel="shortcut icon" href="../img/ComicDico-01.png">
    <link href="/bootstrap/css/navbar.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/bootstrap/css/comicsD.css">
    <script>
      var comic_id = <?php echo json_encode($comic_id); ?>;
    </script>
    <script src="../bootstrap/assets/js/jquery.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../js/catalogo.js"></script>
    <script src="../js/detalle_comic.js"></script>
    <script src="../js/login.js"></script>

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

      $(document).ready(function() {
        $(".tip-top").tooltip({placement: 'top'});
        $(".tip-right").tooltip({placement: 'right'});
        $(".tip-bottom").tooltip({placement: 'bottom'});
        $(".tip-left").tooltip({placement: 'left'});
      });
    </script>

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
        if (d.getElementById(id))
          return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1&appId=655150577891800";
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

        <div class="catalogo" itemscope itemtype="http://schema.org/Product">

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
                    <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://www.comicsdealer.com" data-text="Es la neta" data-via="ComicsDealer" data-lang="es">Twittear</a>
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
          <br>

          <div class="row">
            <div class="col-sm-4 col-md-3">
              <?php
              $imagen = obtenerImagen();
              echo "<a target='_blank' id='comic_href' href=$imagen>
                          <img itemprop='image' src=$imagen class='img-responsive img-rounded' id='comic_img'>
                        </a>";
              ?>
              <h5 align="center"><small>Da click en la imagen para ampliar <span class="glyphicon glyphicon-zoom-in"></span></small></h5>
            </div>
            <div class="col-sm-8 col-md-9">
              <h1 class="blog-title" id="comic_personaje"><?php echo obtenerPersonaje(); ?></h1>

              <h1 style="margin-top: 5px">
                <strong>
                  <small>
                    <span class="label label-primary tip-top" id="comic_titulo" data-toggle="tooltip" data-placement="top" title="La serie y el número"><span itemprop="name"><?php echo obtenerTitulo() . " #" . obtenerNumero(); ?></span></span>
                  </small>
                  <small>
                    <!--Este se debe generar desde el class, pues es uno diferente para cada caso, y aparte la palabra es diferente y el title lel-->
                    <span class="label label-comun tip-top" data-toggle="tooltip" data-placement="top" title="Es normal">Común</span>
                  </small>
                </strong>
                <small id="comic_idioma" class="tip-right" data-toggle="tooltip" data-placement="right" title="Idioma del cómic"><?php echo obtenerIdioma(); ?></small>
              </h1>

              <hr style="margin-bottom: 0px"></hr>
              <div class="row">
                <div class="col-md-3 tip-bottom" id="comic_copias" align="left" data-toggle="tooltip" data-placement="bottom" title="Todos los que tenemos en este momento"><h4>Existencias: <small><span itemprop="availability"><?php echo obtenerCopias(); ?></span></small></h4></div>
                <div class="col-md-3 tip-bottom" id="comic_integridad" align="left" data-toggle="tooltip" data-placement="bottom" title="10 si está nuevo, y 0 si está 'pal boiler"><h4>Integridad: <small><?php echo obtenerIntegridad() . "/10"; ?></small></h4></div>
                <div class="col-md-6" id="comic_fecha" align="left"><h4>Fecha de Publicación: <small>11/9/2001</small></h4></div>
              </div>
              <p align="justify" style="font-size: 12pt" id="comic_descripcion"><span itemprop="description"><?php echo obtenerDescripcion(); ?></span></p>
              <table style="margin-bottom: 2px" class="table table-condensed">
                <thead>
                  <tr>
                    <td class="text-primary tip-bottom" data-toggle="tooltip" data-placement="bottom" title="Precio del cómic cuando fue publicado, puede ser en Pesos o en Dólares"><strong>Precio de Portada</strong><p class="precio" align="right">$40.00 MXN  </p></td>
                    <td class="text-danger tip-bottom" data-toggle="tooltip" data-placement="bottom" title="En este precio lo tienen en otras tiendas"><strong>Precio en Tiendas</strong><p class="precio" align="right">$60.00 MXN  </p></td>
                    <td class="tip-top" data-toggle="tooltip" data-placement="top" title="Sí, nos volvimos locos!"><strong>Precio Comics Dealer</strong><p class="precio" align="right">$30.00 MXN  </p></td>
                    <td class="tip-top" data-toggle="tooltip" data-placement="top" title="Ahorro total con respecto a las otras tiendas"><strong>Ahorro</strong><p style="margin-top: 6px" align="right"><span class="label label-descuento label-lg">-50%</span>  </p></td>
                  </tr>
                </thead>
              </table>
              <div class="row" align="right">
                <div style="margin-top: 1%" class="col-sm-6 col-sm-offset-6 col-md-5 col-md-offset-7">
                  <div id="boton_comprar"><button class="btn btn-success btn-comprar btn-block" role="button">AGREGAR AL <span class="glyphicon glyphicon-shopping-cart"></span></button></div>
                  <div id="boton_eliminar"><button class="btn btn-danger btn-eliminar btn-block" role="button">ELIMINAR DEL <span class="glyphicon glyphicon-shopping-cart"></span></button></div>
                  <div id="boton_comprar_nologin"><button class="btn btn-success btn-comprar-nologin btn-block">AGREGAR AL <span class="glyphicon glyphicon-shopping-cart"></span></button></div>  
                </div>
              </div>

            </div>
          </div>
          <hr></hr>
          <div class="row">
            <div class="col-sm-4"> 
              <p style="font-size: 14pt"><a style="font: 300 20px helvetica, sans-serif;" href="/html/Catalogo.php"><span class="glyphicon glyphicon-circle-arrow-left"></span> Regresar al catálogo</a></p>
            </div>
            <div class="col-sm-2 col-sm-offset-4" align="right" style="vertical-align: middle">
              <a href="https://twitter.com/share" class="twitter-share-button" data-url="" data-text="" data-via="ComicsDealer" data-lang="es">Twittear</a>
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
            <div class="col-sm-2" align="right" style="vertical-align: middle">
              <div class="fb-share-button" data-href="" data-type="button_count"></div>
            </div>
          </div>  
          <!-- detalle-->

        </div>

      </div>

      <div class="container tres">
        <div class="catalogo">
          <div class="row">
            <div class="col-lg-12" >
              <h2 style="margin-bottom: 0px;">Tambien puedes revisar el resto de nuestro <strong>Catálogo</strong>
                <br><small>La pura nata concentrada de los cómics</small></h2>
            </div>  
          </div>

          <hr></hr>
          <div class="row" id="catalogo_comics">

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
              $arrayComics = consulta_catalogo($campos, $contador, 4, obtenerCompania(), 0, 0);
              cargarCatalogo($arrayComics, $i, 1);
              $contador+=4;
            }
            ?>


          </div><!-- /.row1 -->
          <div class="row">             
            <div class="col-lg-4 col-lg-offset-8"> 
              <p style="font-size: 14pt" align="center"><a href="html/Catalogo.php"><strong>Ver el catálogo completo »</strong></a></p>
            </div> 
          </div>
          <hr></hr>
        </div>
      </div><!-- /.Catalogo Muestra-->

      <div id="infos"></div>

      <div class="container tres">  
        <div class="jumbotron">
          <blockquote style="font-size:12pt">
            <p>"May God protect us -- from guys who do the right thing."</p>
            <small><cite title="Amazing Spider-Man, Vol. 2, #38">Hulk, A Titan Stalks the Tenements!, The Hulk, 2nd series, #131</cite></small>
          </blockquote>
        </div>
      </div>

      <div id="footer"></div>


      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

      <!-- Include all compiled plugins (below), or include individual  files as needed -->
    </div> 
  </body>
</html>