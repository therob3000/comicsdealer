<?php
	
	include 'conexion.php';
	$con = conexion();

	$usuario_id = $_SESSION['usuario_id'];

	echo $usuario_id;

?>

	