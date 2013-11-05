<?php
	
	include 'conexion.php';
	$con = conexion();

	session_start();
	$usuario_id = $_SESSION['usuario_id'];

	echo $usuario_id;

?>

	