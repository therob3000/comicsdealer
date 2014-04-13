<?php
	/*ini_set('display_errors',1); 
	error_reporting(E_ALL);*/

	//$comic_id = $_GET['comic_id'];

	$camposArray = array("inventario_id",
						"cat_comic_titulo",
						"cat_comic_descripcion",
						"cat_comic_personaje",
						"cat_comic_numero_ejemplar",
						"cat_comic_imagen_url",
						"inventario_precio_salida",
						"cat_comic_copias",
						"cat_comic_idioma",
						"inventario_integridad",
						"existe"

	);

	$rowArray = array();

	//obtenerDatos($comic_id);
	//echo obtenerPersonaje();

/*-----------------------------------------------------------------------------------------------------------------------------------*/

function obtenerDatos($comic_id){
	global $rowArray;
	global $camposArray;

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
CATALOGO.cat_comic_numero_ejemplar,
CATALOGO.cat_comic_imagen_url,
INV.inventario_precio_salida,
CATALOGO.cat_comic_copias,
CATALOGO.cat_comic_idioma,
INV.inventario_integridad
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
AND INV.inventario_id = $comic_id";

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