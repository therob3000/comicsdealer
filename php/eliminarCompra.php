<?php
	ini_set('display_errors',1); 
	error_reporting(E_ALL);
	session_start();

	$comic_inventario_id = $_REQUEST['cat_comic_inventario_id'];
	$arrayExistente = $_SESSION['usuario_comics'];
	$arrayNuevo = array();
	foreach ($arrayExistente as $key => $value) {
		if($comic_inventario_id != $arrayExistente[$key]){
			$arrayNuevo[] = $arrayExistente[$key];
		}
	}

	print_r($arrayNuevo);

	$_SESSION['usuario_comics'] = $arrayNuevo;

?>