<?php
	ini_set('display_errors',1); 
	error_reporting(E_ALL);
	session_start();

	$comic_inventario_id = $_REQUEST['cat_comic_unique_id'];
	$arrayExistente = $_SESSION['usuario_comics'];
      
	$arrayNuevo = array();

	$json = new stdClass();
	foreach ($arrayExistente as $key => $value) {
		if($comic_inventario_id != $arrayExistente[$key]){
			$arrayNuevo[] = $arrayExistente[$key];
		}
	}

	$_SESSION['usuario_comics'] = $arrayNuevo;
        
        $json->totalCompra = count($arrayNuevo);
        echo json_encode($json);
?>