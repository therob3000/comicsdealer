<?php
	/*ini_set('display_errors',1); 
	error_reporting(E_ALL);*/

	//$comic_id = $_GET['comic_id'];

$camposArray = array("inventario_id",
    "cat_comic_titulo",
    "cat_comic_descripcion",
    "cat_comic_personaje",
    "compania_id",
    "cat_comic_numero_ejemplar",
    "cat_comic_imagen_url",
    "inventario_precio_salida",
    "cat_comic_copias",
    "cat_comic_idioma",
    "inventario_integridad",
    "cat_comic_precio_portada",
    "cat_comic_precio_tienda",
    "cat_comic_imagen_mini",
    "cat_comic_unique_id",
    "cat_comic_rareza"
    //"existe"
);

$rowArray = array();

	//obtenerDatos($comic_id);
	//echo obtenerPersonaje();

/*-----------------------------------------------------------------------------------------------------------------------------------*/

function obtenerComicsPaquete($paquete_id){
    $queryComicsPaquete = "SELECT inventario_cat_comic_unique_id FROM inventario WHERE inventario_paquete = $paquete_id";
    $queryResultado = mysql_query($queryComicsPaquete);
    $num = mysql_num_rows($queryResultado);
    
    $arrayComics = array();
    
    if($num>=0){
        for ($i = 0; $i < $num; $i++) {
            $arrayComics[] = obtenerResultado($queryResultado, $i, "inventario_cat_comic_unique_id");
        }
    }
    else{
        $arrayComics = array();
    }
    
    return $arrayComics;
}

function obtenerDatos($comic_id){
	global $rowArray;
	global $camposArray;
        
        $rowArray = array();
        
	$queryComic = "SELECT 
	INV.inventario_id,
	(SELECT datos_comic_titulo FROM datos_comics WHERE datos_comic_id = CATALOGO.cat_comic_descripcion_id) as cat_comic_titulo,
	(SELECT datos_comic_descripcion FROM datos_comics WHERE datos_comic_id = CATALOGO.cat_comic_descripcion_id) as cat_comic_descripcion,
	(SELECT 
		personaje_nombre
		FROM
		personajes
		WHERE
		personaje_id = CATALOGO.cat_comic_personaje_id) as cat_comic_personaje,
    (SELECT 
		personaje_compania_id
		FROM
		personajes
		WHERE
		personaje_id = CATALOGO.cat_comic_personaje_id) as compania_id,
CATALOGO.cat_comic_numero_ejemplar,
CATALOGO.cat_comic_imagen_url,
INV.inventario_precio_salida,
CATALOGO.cat_comic_copias,
CATALOGO.cat_comic_idioma,
INV.inventario_integridad,
CATALOGO.cat_comic_precio_portada,
CATALOGO.cat_comic_precio_tienda,
CATALOGO.cat_comic_imagen_mini,
CATALOGO.cat_comic_unique_id,
CATALOGO.cat_comic_rareza,
CATALOGO.cat_comic_fecha
FROM
cat_comics as CATALOGO
INNER JOIN
(SELECT 
	inventario_id,
	max(inventario_precio_entrada) as inventario_max_precio_entrada,
	inventario_precio_salida,
	inventario_cat_comic_unique_id,
	inventario_existente,
	inventario_integridad
	FROM
	inventario
	GROUP BY inventario_cat_comic_unique_id) AS INV ON INV.inventario_cat_comic_unique_id = CATALOGO.cat_comic_unique_id
WHERE
CATALOGO.cat_comic_activo = 1 
AND INV.inventario_existente = 1
AND CATALOGO.cat_comic_unique_id = $comic_id";
//AND INV.inventario_id = $comic_id";
        
//echo $queryComic;

$queryResultado = mysql_query($queryComic);
$num = mysql_num_rows($queryResultado);

	if($num>=0){
		$rowArray["existe"] = true;
		for($i = 0; $i < count($camposArray); $i++){
			$rowArray[$camposArray[$i]] = obtenerResultado($queryResultado,0,$camposArray[$i]);
		}
	}
	else{
		$rowArray["existe"] = false;
	}
}

function obtenerResultado($query, $indice, $nombreColumna){
	return mysql_result($query, $indice, "$nombreColumna");
}

function obtenerPersonaje(){
	global $rowArray;
	return $rowArray["cat_comic_personaje"];
}

function obtenerTitulo(){
	global $rowArray;
	return $rowArray["cat_comic_titulo"];
}

function obtenerImagen(){
	global $rowArray;
	return $rowArray["cat_comic_imagen_url"];
}

function obtenerImagenMini(){
    global $rowArray;
    return $rowArray["cat_comic_imagen_mini"];
}

function obtenerIdioma(){
	global $rowArray;
	$idioma = $rowArray["cat_comic_idioma"];
	if ($idioma == "ing") {
		return "Ingles";
	}
	else{
		return "Español";
	}
}

function obtenerCopias(){
	global $rowArray;
	return $rowArray["cat_comic_copias"];
}

function obtenerDescripcion(){
	global $rowArray;
	return $rowArray["cat_comic_descripcion"];
}

function obtenerIntegridad(){
	global $rowArray;
	return $rowArray["inventario_integridad"];
}

function obtenerPrecio(){
	global $rowArray;
	return $rowArray["inventario_precio_salida"];
}

function obtenerNumero(){
	global $rowArray;
	return $rowArray["cat_comic_numero_ejemplar"];
}

function obtenerCompania(){
    global $rowArray;
    return $rowArray["compania_id"];
}

function obtenerPrecioTienda(){
    global $rowArray;
    return $rowArray["cat_comic_precio_tienda"];
}

function obtenerPrecioPortada(){
    global $rowArray;
    return $rowArray["cat_comic_precio_portada"];
}

function obtenerRarezaComic(){
    global $rowArray;
    return $rowArray["cat_comic_rareza"];
}

function obtenerFechaPublicacion(){
    global $rowArray;
    return $rowArray["cat_comic_fecha"];
}

function generarHTMLComicIndividual($comic_id){
    
    obtenerDatos($comic_id);
    
    $imagen = obtenerImagen();
    $personaje = obtenerPersonaje();
    $titulo = obtenerTitulo();
    $numero = obtenerNumero();
    $idioma = obtenerIdioma();
    $numero_copias = obtenerCopias();
    $integridad = obtenerIntegridad();
    $descripcion = obtenerDescripcion();
    $precio_salida = obtenerPrecio();
    $precio_portada = obtenerPrecioPortada();
    $precio_tiendas = obtenerPrecioTienda();
    
    $rareza = obtenerRarezaComic();
    $fecha_publicacion = obtenerFechaPublicacion();
    
    //CONDICION PARA PRECIO EN OTRAS TIENDAS
    if($precio_tiendas != NULL){
        $descuento = (($precio_salida * 100) / $precio_tiendas) - 100;
        //CONDICIONAMOS EL DESCUENTO
        if($descuento >= 0 ){
            $etiquetaDescuento = "";
        }
        else{
            $etiquetaDescuento = "<td class='tip-top' data-toggle='tooltip' data-placement='top' title='Ahorro total con respecto a las otras tiendas'><strong>Ahorro</strong><p style='margin-top: 6px' align='right'><span class='label label-descuento label-lg'>$descuento%</span>  </p></td>";
        }
        $etiquetaPrecioTiendas = "<td class='text-danger tip-bottom' data-toggle='tooltip' data-placement='bottom' title='En este precio lo tienen en otras tiendas'><strong>Precio en Tiendas</strong><p class='precio' align='right'>$$precio_tiendas</p></td>";
    }
    else{
        $etiquetaPrecioTiendas = "";
    }
    
    //CONDICION PARA LA INTEGRIDAD
    if($integridad |= 0){
        $etiquetaIntegridad = "<div class='col-md-3 tip-bottom' id='comic_integridad' align='left' data-toggle='tooltip' data-placement='bottom' title='10 si está nuevo, y 0 si está¡ 'pal boiler'><h4>Integridad: <small>$integridad/10</small></h4></div>";
    }
    else{
        $etiquetaIntegridad = "";
    }
    
    
    //CONDICION PARA RAREZA
    if($rareza != NULL){
        switch ($rareza){
            case 'comun':
                $etiquetaRareza = "label-comun";
                $titleRareza = "Es normal";
                $textoRareza = "Común";
                break;
            case 'incomun':
                $etiquetaRareza = "label-incomun";
                $titleRareza = "Es incomun";
                $textoRareza = "Incomun";
                break;
            case 'raro':
                $etiquetaRareza = "label-raro";
                $titleRareza = "Es RARO!";
                $textoRareza = "RARO";
                break;
        }
        
        
        $rarezaHTML = "<small>
                    <!--Este se debe generar desde el class, pues es uno diferente para cada caso, y aparte la palabra es diferente y el title lel-->
                    <span class='label $etiquetaRareza tip-top' data-toggle='tooltip' data-placement='top' title='$titleRareza'>$textoRareza</span>
                  </small>";
    }
    else{
        $rarezaHTML ="";
    }
    
    //CONDICION PARA FECHA DE PUBLICACION
    if($fecha_publicacion != NULL){
        $fechaPublicacionHTML = "<div class='col-md-6' id='comic_fecha' align='left'><h4>Fecha de Publicación: <small>11/9/2001</small></h4></div>";
    }
    else{
        $fecha_publicacion = "";
    }
    
    echo "<div class='row'>
            <div class='col-sm-4 col-md-3'>
              
              
              <a target='_blank' id='comic_href' href=$imagen>
                          <img itemprop='image' src=$imagen class='img-responsive img-rounded' id='comic_img'>
                        </a>
              <h5 align='center'><small>Da click en la imagen para ampliar <span class='glyphicon glyphicon-zoom-in'></span></small></h5>
            </div>
            <div class='col-sm-8 col-md-9'>
              <h1 class='blog-title' id='comic_personaje'>$personaje</h1>

              <h1 style='margin-top: 5px'>
                <strong>
                  <small>
                    <span class='label label-primary tip-top' id='comic_titulo' data-toggle='tooltip' data-placement='top' title='La serie y el número'><span itemprop='name'>$titulo #$numero</span></span>
                  </small>
                  $rarezaHTML
                </strong>
                <small id='comic_idioma' class='tip-right' data-toggle='tooltip' data-placement='right' title='Idioma del cómic'>$idioma</small>
              </h1>

              <hr style='margin-bottom: 0px'></hr>
              <div class='row'>
                <div class='col-md-3 tip-bottom' id='comic_copias' align='left' data-toggle='tooltip' data-placement='bottom' title='Todos los que tenemos en este momento'><h4>Existencias: <small><span itemprop='availability'>$numero_copias</span></small></h4></div>
                $etiquetaIntegridad
                $fechaPublicacionHTML
              </div>
              <p align='justify' style='font-size: 12pt' id='comic_descripcion'><span itemprop='description'>$descripcion</span></p>
              <table style='margin-bottom: 2px' class='table table-condensed'>
                <thead>
                  <tr>
                    <td class='text-primary tip-bottom' data-toggle='tooltip' data-placement='bottom' title='Precio del cómic cuando fue publicado, puede ser en Pesos o en DÃ³lares'><strong>Precio de Portada</strong><p class='precio' align='right'>$$precio_portada</p></td>
                    $etiquetaPrecioTiendas
                    <td class='tip-top' data-toggle='tooltip' data-placement='top' title='Sí, nos volvimos locos!'><strong>Precio Comics Dealer</strong><p class='precio' align='right'>$$precio_salida</p></td>
                    $etiquetaDescuento
                  </tr>
                </thead>
              </table>
              <div class='row' align='right'>
                <div style='margin-top: 1%' class='col-sm-6 col-sm-offset-6 col-md-5 col-md-offset-7'>";
    if (isset($_SESSION['usuario_email']) && isset($_SESSION['usuario_nombre'])) {
        echo "<div id='boton_comprar'><button class='btn btn-success btn-comprar btn-block' role='button'>AGREGAR AL <span class='glyphicon glyphicon-shopping-cart'></span></button></div>
                  <div id='boton_eliminar'><button class='btn btn-danger btn-eliminar btn-block' role='button'>ELIMINAR DEL <span class='glyphicon glyphicon-shopping-cart'></span></button></div>
                </div>
              </div>
            </div>
          </div>";
    }
    else{
        echo "<div id='boton_comprar_nologin'><button class='btn btn-success btn-comprar-nologin btn-block'>AGREGAR AL <span class='glyphicon glyphicon-shopping-cart'></span></button></div>
                </div>
              </div>
            </div>
          </div>";
    }              
}

function generarHTMLComicsPaquete($paquete_id){
    //OBTENEMOS LOS COMICS PERTENECIENTES A UN PAQUETE
    $arrayComics = obtenerComicsPaquete($paquete_id);
    $suma_precio_portada = 0;
    $suma_precio_salida = 0;
    $suma_precio_tienda = 0;
    
    $visor = "<div id='slider'>";
    for($i = 0; $i < count($arrayComics); $i++){
        obtenerDatos($arrayComics[$i]);
        
        //Estas variables nos permiten obtener los datos de cada comic
       $imagen = obtenerImagen();
       $personaje = obtenerPersonaje();
 
        //echo $imagen;
        $visor = $visor .
        "
            <a href='#' target='_blank'>
            <img src='$imagen'>
            <span>
                $personaje
            </span>
        </a>";
        
        $suma_precio_portada += obtenerPrecioPortada();
        $suma_precio_salida += obtenerPrecio();
        $suma_precio_tienda += obtenerPrecioTienda();
    }
    
       $titulo = obtenerTitulo();
       //$numero = obtenerNumero();
       $idioma = obtenerIdioma();
       $numero_copias = obtenerCopias();
       $integridad = obtenerIntegridad();
       $descripcion = obtenerDescripcion();
       $nombre_paquete = obtenerNombrePaquete($paquete_id);
       $precio_salida = $suma_precio_salida;
       $precio_portada = $suma_precio_portada;
       $precio_tiendas = $suma_precio_tienda;
       
       $descuento = (($precio_salida * 100) / $precio_tiendas) - 100;
    
        //CONDICIONAMOS EL DESCUENTO
        if($descuento >= 0 ){
            $etiquetaDescuento = "";
        }
        else{

            $etiquetaDescuento = "<td class='tip-top' data-toggle='tooltip' data-placement='top' title='Ahorro total con respecto a las otras tiendas'><strong>Ahorro</strong><p style='margin-top: 6px' align='right'><span class='label label-descuento label-lg'>$descuento%</span>  </p></td>";
        }
       
       if($idioma == "EspaÃ±ol"){
           $moneda = "MXN";
       }
       else{
           $moneda = "USD";
       }
    
    $visor = $visor . " </div>";
    
    echo "<div class='row'>
            <div class='col-sm-4 col-md-3'>
              $visor
              <h5 align='center'><small>Da click en la imagen para ampliar <span class='glyphicon glyphicon-zoom-in'></span></small></h5>
            </div>
            <div class='col-sm-8 col-md-9'>
              <h1 class='blog-title' id='comic_personaje'>$personaje</h1>

              <h1 style='margin-top: 5px'>
                <strong>
                  <small>
                    <span class='label label-primary tip-top' id='comic_titulo' data-toggle='tooltip' data-placement='top' title='La serie y el nÃºmero'><span itemprop='name'>$nombre_paquete</span></span>
                  </small>
                  <small>
                    <!--Este se debe generar desde el class, pues es uno diferente para cada caso, y aparte la palabra es diferente y el title lel-->
                    <span class='label label-comun tip-top' data-toggle='tooltip' data-placement='top' title='Es normal'>ComÃºn</span>
                  </small>
                </strong>
                <small id='comic_idioma' class='tip-right' data-toggle='tooltip' data-placement='right' title='Idioma del cÃ³mic'>$idioma</small>
              </h1>

              <hr style='margin-bottom: 0px'></hr>
              <div class='row'>
                <div class='col-md-3 tip-bottom' id='comic_copias' align='left' data-toggle='tooltip' data-placement='bottom' title='Todos los que tenemos en este momento'><h4>Existencias: <small><span itemprop='availability'>$numero_copias</span></small></h4></div>
                <div class='col-md-3 tip-bottom' id='comic_integridad' align='left' data-toggle='tooltip' data-placement='bottom' title='10 si estÃ¡ nuevo, y 0 si estÃ¡ 'pal boiler'><h4>Integridad: <small>$integridad/10</small></h4></div>
                <div class='col-md-6' id='comic_fecha' align='left'><h4>Fecha de PublicaciÃ³n: <small>11/9/2001</small></h4></div>
              </div>
              <p align='justify' style='font-size: 12pt' id='comic_descripcion'><span itemprop='description'>$descripcion</span></p>
              <table style='margin-bottom: 2px' class='table table-condensed'>
                <thead>
                  <tr>
                    <td class='text-primary tip-bottom' data-toggle='tooltip' data-placement='bottom' title='Precio del cÃ³mic cuando fue publicado, puede ser en Pesos o en DÃ³lares'><strong>Precio de Portada</strong><p class='precio' align='right'>$$precio_portada $moneda</p></td>
                    <td class='text-danger tip-bottom' data-toggle='tooltip' data-placement='bottom' title='En este precio lo tienen en otras tiendas'><strong>Precio en Tiendas</strong><p class='precio' align='right'>$$precio_tiendas MXN</p></td>
                    <td class='tip-top' data-toggle='tooltip' data-placement='top' title='SÃ­, nos volvimos locos!'><strong>Precio Comics Dealer</strong><p class='precio' align='right'>$$precio_salida MXN</p></td>
                    $etiquetaDescuento
                  </tr>
                </thead>
              </table>
              <div class='row' align='right'>
                <div style='margin-top: 1%' class='col-sm-6 col-sm-offset-6 col-md-5 col-md-offset-7'>";
    if (isset($_SESSION['usuario_email']) && isset($_SESSION['usuario_nombre'])) {
        echo "<div id='boton_comprar'><button class='btn btn-success btn-comprar btn-block' role='button'>AGREGAR AL <span class='glyphicon glyphicon-shopping-cart'></span></button></div>
                  <div id='boton_eliminar'><button class='btn btn-danger btn-eliminar btn-block' role='button'>ELIMINAR DEL <span class='glyphicon glyphicon-shopping-cart'></span></button></div>
                </div>
              </div>
            </div>
          </div>";
    }
    else{
        echo "<div id='boton_comprar_nologin'><button class='btn btn-success btn-comprar-nologin btn-block'>AGREGAR AL <span class='glyphicon glyphicon-shopping-cart'></span></button></div>
                </div>
              </div>
            </div>
          </div>";
    }
}

function insertarVisita($comic_id){
    $queryVisita = "UPDATE cat_comics SET cat_comic_numero_visitas = cat_comic_numero_visitas + 1 WHERE cat_comic_unique_id = $comic_id";
    mysql_query($queryVisita);
}

