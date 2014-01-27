<?php
	include 'conexion.php';
	include 'fecha.php';
	$con = conexion();

	ini_set('display_errors',1); 
	error_reporting(E_ALL);

	$finDeSemana = determinaFindeSemana();
	$json = new stdClass();

	if($finDeSemana){
		
		$queryPromocion = "SELECT * FROM promociones WHERE promocion_activa = 1";
		$queryResultado	= mysql_query($queryPromocion);
		$num 			= mysql_num_rows($queryResultado);

		if($num > 0){
			$descripcion_formato 	= mysql_result($queryResultado, 0, "descripcion_formato");
			$descripcion_titulo 	= mysql_result($queryResultado, 0, "descripcion_titulo");
			$descripcion_historia	= mysql_result($queryResultado, 0, "descripcion_historia");
			$precio_portada			= mysql_result($queryResultado, 0, "precio_portada");
			$precio_oferta			= mysql_result($queryResultado, 0, "precio_oferta");
			$promocion_imagen		= mysql_result($queryResultado, 0, "promocion_imagen");

			$json->descripcion_formato 	= $descripcion_formato;
			$json->descripcion_titulo 	= $descripcion_titulo;
			$json->descripcion_historia = $descripcion_historia;
			$json->precio_portada 		= $precio_portada;
			$json->precio_oferta		= $precio_oferta;
			$json->promocion_imagen     = $promocion_imagen;
			$json->promocion = TRUE;
		}
	}
	else{
		$json->promocion = FALSE;
	}

	echo json_encode($json);

?>