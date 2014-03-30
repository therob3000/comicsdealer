<?php
	ini_set('display_errors',1); 
	error_reporting(E_ALL);
	session_start();

	$comicsArray = $_SESSION['usuario_comics'];
	

	$json = new stdClass();
	$json->totalCompra = count($comicsArray);

	echo json_encode($json);

?>