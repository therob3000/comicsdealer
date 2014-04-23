<?php
	include 'conexion.php';
	$con = conexion();

	ini_set('display_errors',1); 
	error_reporting(E_ALL);

	$salto = $_GET["salto"];
	$rango = $_GET["rango"];
	$json = new stdClass();

	$camposArray = array("inventario_id",
						"cat_comic_titulo",
						"cat_comic_descripcion",
						"cat_comic_personaje",
						"cat_comic_numero_ejemplar",
						"cat_comic_imagen_url",
						"inventario_precio_salida",
						"cat_comic_idioma"
	);

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

	$queryResultado = mysql_query($queryCatalogoComics);
	$num = mysql_num_rows($queryResultado);
	if($num>0){
		for($i = 0; $i < $num; $i++){
			$rowArray = array();
			for ($j=0; $j < count($camposArray); $j++) {
				$rowArray[$camposArray[$j]] = obtenerResultado($camposArray[$j], $i);
			}
			$catalogoArray[] = $rowArray;
		}
	}
	else{
		$catalogoArray = array();
	}

	//session_start();

	$json->catalogo = $catalogoArray;
	$json->total = obtenerTotalComics();
	$json->agregados = $_SESSION['usuario_comics'];

	echo json_encode($json);

	function obtenerResultado($nombreColumna, $indice){
		global $queryResultado;
		return mysql_result($queryResultado, $indice, "$nombreColumna");
	}

	function obtenerTotalComics(){
		$queryTotal = "SELECT COUNT(*) AS total FROM cat_comics WHERE cat_comic_copias > 0";
		$queryResultado = mysql_query($queryTotal);
		return mysql_result($queryResultado, 0, "total");
	}



