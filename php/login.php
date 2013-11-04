<?php
	include 'conexion.php';
	$con = conexion();


	ini_set('display_errors',1); 
	error_reporting(E_ALL);

	$usuario_email 		= $_POST['usuario_email'];
	$usuario_password 	= $_POST['usuario_password'];

	$respuestaJSON		= NULL;
	$json 				= new stdClass();

	$queryLogin 	= "SELECT * FROM Usuarios WHERE usuario_email = '$usuario_email'";

	$queryResultado			= mysql_query($queryLogin, $con);
	$num					= mysql_num_rows($queryResultado);

	if($num > 0){

		$dbpasswd 				= mysql_result($queryResultado, 0, "usuario_password");
		$activo					= mysql_result($queryResultado, 0, "usuario_activado");
		$usuario_nombre			= mysql_result($queryResultado, 0, "usuario_nombre");
		$usuario_id 			= mysql_result($queryResultado, 0, "usuario_id");
		$usuario_max_pedidos 	= mysql_result($queryResultado, 0, "usuario_max_pedidos");

		if($activo == 1){
			if(crypt($usuario_password, $dbpasswd) == $dbpasswd){
				session_start();
				session_destroy(); 
		
				session_start();
				//Generar una variable de Sesion
				$_SESSION['usuario_email'] 			= $usuario_email;
				$_SESSION['usuario_nombre']			= $usuario_nombre;
				$_SESSION['usuario_id']				= $usuario_id;
				$_SESSION['usuario_max_pedidos']	= $usuario_max_pedidos;
				
				$respuestaJSON = true;
			}
			else{
				//echo "La contraseña es incorrecta";
				$respuestaJSON = false;
			}
		}
		else{
			//echo "El usuario esta desactivado";
			$respuestaJSON = false;
		}		
	}
	else{
		//echo "El usuario no existe";
		$respuestaJSON = false;
	}

	$json->login = $respuestaJSON;

	echo json_encode($json);

	//usuario_email=carlos.mejia.rueda&usuario_password=g-mNIR&z

?>
