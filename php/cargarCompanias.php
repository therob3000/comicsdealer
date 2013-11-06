<?php
	include 'conexion.php';
	$con = conexion();

	ini_set('display_errors',1); 
	error_reporting(E_ALL);

	$respuestaJSON 	= array();

	$queryDatos 	= "SELECT * FROM companias";

	$queryResultado = mysql_query($queryDatos); 
	$num			= mysql_num_rows($queryResultado);

	if($num > 0){
		for($i = 0; $i < $num; $i++){
			$compania 	= mysql_result($queryResultado, $i, "compania_nombre");
			$companiaid	= mysql_result($queryResultado, $i, "compania_id");

			$respuestaJSON[] = array( "compania" => $compania,
									  "compania_id" => $companiaid
			 );
		}
	}
	else{
		$respuestaJSON = array();
	}

	echo json_encode($respuestaJSON);

?>

