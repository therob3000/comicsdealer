<?php

include '../php/conexion.php';
$con = conexion();

ini_set('display_errors',1); 
error_reporting(E_ALL);
session_start();

if (empty($_GET['pagina'])){
  $pagina = 0; 
}
else{
  $pagina = $_GET['pagina'];
}

$campos = array("inventario_id",
						"cat_comic_titulo",
						"cat_comic_descripcion",
						"cat_comic_personaje",
						"cat_comic_numero_ejemplar",
						"cat_comic_imagen_url",
						"inventario_precio_salida",
						"cat_comic_idioma"
	);
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
      <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1";
        fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
      </script>
      
      <?php  
        if (isset($_SESSION['usuario_email']) && isset($_SESSION['usuario_nombre'])) {
           $html = file_get_contents("layouts/navbar_login_layout.html"); 
        }
        else{
            $html = file_get_contents("layouts/navbar_nologin_layout.html");
        }
        
        
        $nav_bar = new DOMDocument();
        $nav_bar->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
      ?>

      <div id="nav_bar"><?php echo $nav_bar->saveHTML(); ?></div>


      <div class="container">
      
          <?php 
            $modal_sesion_html = file_get_contents("layouts/modal_login_layout.html");
            $modal_sesion = new DOMDocument();
            $modal_sesion->loadHTML(mb_convert_encoding($modal_sesion_html, 'HTML-ENTITIES', 'UTF-8'));
            echo $modal_sesion->saveHTML();
            
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
<!--                <div align="right">
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
                </div>-->
              </div>
            </div>

            <br><br>
            <div id="searchnav"> 
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
                        <?php
                        $salto_catalogo = $pagina;
                        $catalogo_html = file_get_contents("layouts/catalogo_layout.html");
                        $contador = $pagina;
                        for ($i = 0; $i < 4; $i++) {
                            $arrayComics = lel2($campos, $contador, 4);
                            echo "<div class='row' id='catalogo_comics'>";
                            for ($j = 0; $j < 4; $j++) {
                                $arrayComic2 = $arrayComics[$j];
                                $catalogo_layout = new DOMDocument();
                                $catalogo_layout->loadHTML(mb_convert_encoding($catalogo_html, 'HTML-ENTITIES', 'UTF-8'));
                                $personaje = $catalogo_layout->createTextNode($arrayComic2[$campos[3]]);
                                $titulo = $catalogo_layout->createTextNode($arrayComic2[$campos[1]].$arrayComic2[$campos[4]]);
                                $catalogo_layout->getElementById("cat_detalle")->setAttribute("href", "/html/Detalle.php?comic_id=".$arrayComic2[$campos[0]]);
                                $catalogo_layout->getElementById("cat_imagen")->setAttribute("src", $arrayComic2[$campos[5]]);
                                $catalogo_layout->getElementById("catalogo_comic")->setAttribute("id", $arrayComic2[$campos[0]]);
                                $catalogo_layout->getElementById("cat_personaje")->appendChild($personaje);
                                $catalogo_layout->getElementById("cat_titulo")->appendChild($titulo);
                                
                                echo $catalogo_layout->saveHTML();
                            }
                            echo "</div>";
                            $contador+=4;
                        }
                        ?>
                    </div>
                  
                    <ul class="pager">
                      <li id="anterior"></li>
                      <li id="siguiente"></li>
                    </ul>
                    
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
          <script>
    var pagina = <?php echo json_encode($pagina); ?>;
  </script>

  <script src="../bootstrap/assets/js/jquery.js"></script>
  <script src="../bootstrap/js/bootstrap.min.js"></script>
  <script src="../js/login.js"></script>
  <script src="../js/catalogo.js"></script>
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

          <!-- Include all compiled plugins (below), or include individual  files as needed -->
        </div> 
      </body>
      </html>
      
      <?php
        
        function lel2($camposArray, $salto, $rango){
            $catalogoArray = array();
	$rowArray = array();

	$queryCatalogoComics = "SELECT 
    INV.inventario_id,
    (SELECT datos_comic_titulo FROM datos_comics WHERE datos_comic_id = CATALOGO.cat_comic_descripcion_id) as cat_comic_titulo,
    (SELECT datos_comic_descripcion FROM datos_comics WHERE datos_comic_id = CATALOGO.cat_comic_descripcion_id) as cat_comic_descripcion,
    (SELECT 
            personaje_nombre
        FROM
            personajes
        WHERE
            personaje_id = CATALOGO.cat_comic_personaje_id) as cat_comic_personaje,
    CATALOGO.cat_comic_numero_ejemplar,
	CATALOGO.cat_comic_imagen_url,
    INV.inventario_precio_salida,
    CATALOGO.cat_comic_idioma
	FROM
    cat_comics as CATALOGO
        INNER JOIN
    (SELECT 
        inventario_id,
		max(inventario_precio_entrada) as inventario_max_precio_entrada,
		inventario_precio_salida,
		inventario_cat_comic_unique_id,
		inventario_existente,
		inventario_fecha_entrada,
		inventario_activo
    FROM
        inventario
    GROUP BY inventario_cat_comic_unique_id ORDER BY inventario_fecha_entrada DESC) AS INV ON INV.inventario_cat_comic_unique_id = CATALOGO.cat_comic_unique_id
	WHERE
    	CATALOGO.cat_comic_activo = 1 AND CATALOGO.cat_comic_copias > 0 AND INV.inventario_existente = 1 AND INV.inventario_activo = 1
    LIMIT $salto, $rango";

    //echo $queryCatalogoComics;

	$queryResultado = mysql_query($queryCatalogoComics);
    
	$num = mysql_num_rows($queryResultado);
	if($num>0){
		for($i = 0; $i < $num; $i++){
			$rowArray = array();
			for ($j=0; $j < count($camposArray); $j++) {
				$rowArray[$camposArray[$j]] = obtenerResultado($camposArray[$j], $i, $queryResultado);
			}
			$catalogoArray[] = $rowArray;
		}
	}
	else{
		$catalogoArray = array();
	}
    
    return $catalogoArray;
        }
        
        function obtenerResultado($nombreColumna, $indice, $queryRes){
		return mysql_result($queryRes, $indice, "$nombreColumna");
	}

	function obtenerTotalComics(){
		$queryTotal = "SELECT COUNT(*) AS total FROM cat_comics WHERE cat_comic_copias > 0";
		$queryResultado = mysql_query($queryTotal);
		return mysql_result($queryResultado, 0, "total");
	}
      ?>