<?php
	include 'conexion.php';
	$con = conexion();

	ini_set('display_errors',1); 
	error_reporting(E_ALL);

	$comic_id = $_GET['comic_id'];
	$json = new stdClass();

	$camposArray = array("inventario_id",
						"cat_comic_titulo",
						"cat_comic_descripcion",
						"cat_comic_personaje",
						"cat_comic_numero_ejemplar",
						"cat_comic_imagen_url",
						"inventario_precio_salida",
						"cat_comic_copias",
						"cat_comic_idioma"

	);

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
    CATALOGO.cat_comic_idioma
	FROM
    cat_comics as CATALOGO
        INNER JOIN
    (SELECT 
        inventario_id,
		max(inventario_precio_entrada) as inventario_max_precio_entrada,
		inventario_precio_salida,
		inventario_cat_comic_unique_id,
		inventario_existente
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
	$json->comic_estado = TRUE;
	for($i = 0; $i < count($camposArray); $i++){
		$rowArray[$camposArray[$i]] = obtenerResultado($camposArray[$i], 0);
	}
}
else{
	$json->comic_estado = FALSE;
}

$json->comic = $rowArray;

echo json_encode($json);

function obtenerResultado($nombreColumna, $indice){
	global $queryResultado;
	return mysql_result($queryResultado, $indice, "$nombreColumna");
}