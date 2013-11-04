<?php
	include 'conexion.php';
	$con = conexion();

	ini_set('display_errors',1); 
	error_reporting(E_ALL);

	$usuario_id 		= $_POST['usuario_id'];
	$usuario_old_pass	= $_POST['usuario_password'];
	$usuario_new_pass	= $_POST['password1'];

	$respuestaJSON		= NULL;
	$json 				= new stdClass();

	$queryPass			= "SELECT usuario_password FROM Usuarios WHERE usuario_id = $usuario_id";

	$queryResultado 	= mysql_query($queryPass, $con);
	$num 				= mysql_num_rows($queryResultado);

	if($num > 0){
		$dbpasswd = mysql_result($queryResultado, 0, "usuario_password");
		if(crypt($usuario_old_pass, $dbpasswd) == $dbpasswd){
			$passwd 			= crypt($usuario_new_pass, 'rl');
			$queryCambioPass 	= "UPDATE Usuarios SET usuario_password = '$passwd' WHERE usuario_id = $usuario_id";
			mysql_query($queryCambioPass, $con);

			$respuestaJSON = true;
		}
		else{
			$respuestaJSON = false;
		}
	}

	$json->cambio = $respuestaJSON;

	echo json_encode($json);

	//usuario_password=nirvana1&password1=12345678&usuario_id=5
	//usuario_password=12345678&password1=Rufo_chato2&usuario_id=5

?>