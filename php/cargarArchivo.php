<?php
	include 'conexion.php';
	
	$con = conexion();

	$articulosArray = array();
	$json = new stdClass();

	ini_set('display_errors',1); 
	error_reporting(E_ALL);

	$queryArticulos = "SELECT articulo_id, articulo_titulo FROM articulos";
	$queryResultado = mysql_query($queryArticulos);
	$num = mysql_num_rows($queryResultado);

	if($num > 0){
		for ($i=0; $i <$num ; $i++) { 
			$articulo_id = mysql_result($queryResultado, $i, "articulo_id");
			$articulo_titulo = mysql_result($queryResultado, $i, "articulo_titulo");
			$articulosArray[] = array("articulo_id" => $articulo_id,
										"articulo_titulo" => $articulo_titulo
			);
		}
	}
	else{
		$articulosArray = array();
	}

	echo json_encode($articulosArray);

?>