<?php
	include 'conexion.php';
	$con = conexion();

	ini_set('display_errors',1); 
	error_reporting(E_ALL);

	session_start();

	$usuario_id 			= $_SESSION['usuario_id'];
	$usuario_email_actual 	= $_REQUEST['usuario_email'];
	$usuario_password		= $_REQUEST['usuario_password'];
	$usuario_email_nuevo	= $_REQUEST['usuario_email_nuevo'];


	$respuestaJSON 	= NULL;
	$json 			= new stdClass();

	$queryPass		= "SELECT usuario_password, usuario_email FROM usuarios WHERE usuario_id = $usuario_id";
	//$queryCorreos	= "SELECT usuario_email FROM usuarios WHERE usuario_email = $usuario_email_nuevo";

	$queryResultado 	= mysql_query($queryPass, $con);
	$num 				= mysql_num_rows($queryResultado);

	if($num > 0){
		$dbpasswd = mysql_result($queryResultado, 0, "usuario_password");
		$dbemail  = mysql_result($queryResultado, 0, "usuario_email");

		if(crypt($usuario_old_pass, $dbpasswd) == $dbpasswd && $usuario_email_actual == $dbemail ){

			echo "Funciona";
		}
	}

	//usuario_email_actual='carlos.mejia.rueda@gmail.com'&usuario_password='Rufo_chato2'

?>
