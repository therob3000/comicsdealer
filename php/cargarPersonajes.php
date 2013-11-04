<?php
	include 'conexion.php';
	$con = conexion();


	ini_set('display_errors',1); 
	error_reporting(E_ALL);

	$compania_id 		= $_GET['compania_id'];
	$respuestaJSON 		= array();

	$queryPersonajes 	= "SELECT * FROM personajes WHERE personaje_compania_id = $compania_id";
	$queryResultado		= mysql_query($queryPersonajes);
	$num				= mysql_num_rows($queryResultado);

	if ($num > 0) {
		for($i=0; $i < $num; $i++){
			$personaje 		= mysql_result($queryResultado, $i, "personaje_nombre");
			$personaje_id 	= mysql_result($queryResultado, $i, "personaje_id");

			$respuestaJSON[] = array( "personaje" => $personaje,
									  "personaje_id" => $personaje_id
				);
		}
	}
	else{
		$respuestaJSON = array();
	}

	echo json_encode($respuestaJSON);

?>

