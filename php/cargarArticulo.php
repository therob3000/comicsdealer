<?php
	include 'conexion.php';
	$con = conexion();
	
	ini_set('display_errors',1); 
	error_reporting(E_ALL);

	$articulo_id = $_GET['articulo_id'];
	$json = new stdClass();

	$queryArticulo 	= "SELECT * FROM articulos WHERE articulo_id = $articulo_id";
	$queryResultado	= mysql_query($queryArticulo);
	$num = mysql_num_rows($queryResultado);

	if($num > 0){
		$json->articulo = TRUE;
		$json->articulo_titulo 	= obtenerResultado("articulo_titulo");
		$json->articulo_fecha		= obtenerResultado("articulo_fecha");
		$json->articulo_autor		= obtenerResultado("articulo_autor");
		$json->articulo_resumen	= obtenerResultado("articulo_resumen");
		$json->articulo_cita		= obtenerResultado("articulo_cita");
		$json->articulo_subtitulo = obtenerResultado("articulo_subtitulo");
		$json->articulo_principal = obtenerResultado("articulo_principal");
		$json->articulo_segundo_subtitulo = obtenerResultado("articulo_segundo_subtitulo");
		$json->articulo_secundario = obtenerResultado("articulo_secundario");
	}
	else{
		$json->articulo = FALSE;
	}

	echo json_encode($json);

	function obtenerResultado($nombreColumna){
		global $queryResultado;
		return mysql_result($queryResultado, 0, "$nombreColumna");
	}
?>



