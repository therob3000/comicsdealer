<?php
	include 'conexion.php';
	$con = conexion();

	ini_set('display_errors',1); 
	error_reporting(E_ALL);

	$salto = $_GET["salto"];
	$rango = $_GET["rango"];

	$camposArray = array("cat_comic_id",
						"cat_comic_titulo",
						"cat_comic_descripcion",
						"cat_comic_personaje",
						"cat_comic_numero_ejemplar",
						"cat_comic_activo",
						"cat_comic_imagen_url",
						"cat_comic_precio_salida"
	);

	$catalogoArray = array();
	$rowArray = array();
	

	$queryCatalogoComics = "SELECT 	cat_comic_id,
									cat_comic_titulo,
									cat_comic_descripcion,
									(SELECT personaje_nombre FROM personajes WHERE personaje_id = cat_comic_personaje_id) as cat_comic_personaje,
									cat_comic_numero_ejemplar,
									cat_comic_activo,
									cat_comic_imagen_url,
									cat_comic_precio_salida FROM cat_comics LIMIT $salto, $rango";

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

	echo json_encode($catalogoArray);

	function obtenerResultado($nombreColumna, $indice){
		global $queryResultado;
		return mysql_result($queryResultado, $indice, "$nombreColumna");
	}



