<?php
	include 'conexion.php';
	include 'fecha.php';
	$con = conexion();

	ini_set('display_errors',1); 
	error_reporting(E_ALL);

	$articulosArray = array();
	$json = new stdClass();

	$salto = $_GET['salto'];
	$rango = $_GET['rango'];

	$queryArticulos = "SELECT articulo_id, articulo_titulo, articulo_fecha, articulo_autor, articulo_resumen, articulo_imagen FROM articulos LIMIT $salto, $rango";
	$queryResultado = mysql_query($queryArticulos);
	$num = mysql_num_rows($queryResultado);

	if($num > 0){
		for ($i=0; $i <$num ; $i++) { 
				$articulo_id 		= obtenerResultado("articulo_id", $i);
				$articulo_titulo 	= obtenerResultado("articulo_titulo", $i);
				$articulo_fecha 	= obtenerCadenaFecha(obtenerResultado("articulo_fecha", $i));
				$articulo_autor 	= obtenerResultado("articulo_autor", $i);
				$articulo_resumen 	= obtenerResultado("articulo_resumen", $i);
				$articulo_imagen	= obtenerResultado("articulo_imagen", $i);

				$articulosArray[] = array('articulo_id' => $articulo_id,
										  'articulo_titulo'	=> $articulo_titulo,
										  'articulo_fecha' => $articulo_fecha,
										  'articulo_autor'=> $articulo_autor,
										  'articulo_resumen' => $articulo_resumen,
										  'articulo_imagen' => $articulo_imagen
				);
		}
	}
	else{
		$articulosArray = array();
	}

	echo json_encode($articulosArray);

	function obtenerResultado($nombreColumna, $indice){
		global $queryResultado;
		return mysql_result($queryResultado, $indice, "$nombreColumna");
	}

?>