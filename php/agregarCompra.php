<?php
	ini_set('display_errors',1); 
	error_reporting(E_ALL);
	session_start();

	$comic_inventario_id = $_REQUEST['cat_comic_inventario_id'];
	$comicsArray = $_SESSION['usuario_comics'];
	$comicsArray[] = $comic_inventario_id;

	$_SESSION['usuario_comics'] = $comicsArray;

?>	
