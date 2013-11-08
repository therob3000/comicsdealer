<?php
	include 'conexion.php';
	$con = conexion();

	ini_set('display_errors',1); 
	error_reporting(E_ALL);

	session_start();

	$usuario_id 			= $_SESSION['usuario_id'];
	$usuario_email 			= $_REQUEST['usuario_email'];
	$usuario_password		= $_REQUEST['usuario_password'];
	$usuario_email_nuevo	= $_REQUEST['usuario_email_nuevo'];


	$respuestaJSON 	= NULL;
	$json 			= new stdClass();

	$queryPassMail		= "SELECT usuario_password, usuario_email FROM usuarios WHERE usuario_id = $usuario_id";
	$queryResultado 	= mysql_query($queryPassMail, $con);
	$num				= mysql_num_rows($queryResultado);

	if($num > 0){
		$dbpasswd = mysql_result($queryResultado, 0, "usuario_password");
		$dbemail  = mysql_result($queryResultado, 0, "usuario_email");

		if(crypt($usuario_password, $dbpasswd) == $dbpasswd && $usuario_email == $dbemail ){
			$queryCorreos	= "SELECT usuario_email FROM usuarios WHERE usuario_email = '$usuario_email_nuevo'";
			echo $queryCorreos;
			$resCorreos		= mysql_query($queryCorreos, $con);
			if ($resCorreos == FALSE) {
				echo "No Existe el correo";
			} 
			else 
			{
				echo "Existe el correo";
			}
		}
		else{
			echo "No funciona";
		}
	}

	//usuario_email=carlos.mejia.rueda@gmail.com&usuario_password=Rufo_chato2&usuario_email_nuevo=lord_push@hotmail.com

?>
