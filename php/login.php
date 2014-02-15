<?php
	include 'conexion.php';
	$con = conexion();


	ini_set('display_errors',1); 
	error_reporting(E_ALL);

	$usuario_email 		= $_REQUEST['usuario_email'];
	$usuario_password 	= $_REQUEST['usuario_password'];

	$respuestaJSON		= NULL;
	$json 				= new stdClass();

	$queryLogin 	= "SELECT * FROM usuarios WHERE usuario_email = '$usuario_email'";

	$queryResultado			= mysql_query($queryLogin, $con);
	$num					= mysql_num_rows($queryResultado);

	if($num > 0){

		$dbpasswd 				= mysql_result($queryResultado, 0, "usuario_password");
		$usuario_activado		= mysql_result($queryResultado, 0, "usuario_activado");
		$usuario_nombre			= mysql_result($queryResultado, 0, "usuario_nombre");
		$usuario_id 			= mysql_result($queryResultado, 0, "usuario_id");
		$usuario_max_pedidos 	= mysql_result($queryResultado, 0, "usuario_max_pedidos");

		if($usuario_activado == 1){
			if(crypt($usuario_password, $dbpasswd) == $dbpasswd){
				session_start();
				session_destroy(); 
		
				session_start();
				//Generar una variable de Sesion
				$_SESSION['usuario_email'] 			= $usuario_email;
				$_SESSION['usuario_nombre']			= $usuario_nombre;
				$_SESSION['usuario_id']				= $usuario_id;
				$_SESSION['usuario_max_pedidos']	= $usuario_max_pedidos;
				
				//$respuestaJSON = true;

				$json->usuario_existe = true;
				$json->usuario_pass = true;
				$json->usuario_activado = true;

			}
			else{
				//echo "La contraseña es incorrecta";
				//$respuestaJSON = false;
				$json->usuario_pass = false;
			}
		}
		else{
			//echo "El usuario esta desactivado";
			//$respuestaJSON = false;
			$json->usuario_activado = false;
		}		
	}
	else{
		//echo "El usuario no existe";
		//$respuestaJSON = false;
		$json->usuario_existe = false;
	}

	//$json->login = $respuestaJSON;

	echo json_encode($json);

	//usuario_email=carlos.mejia.rueda&usuario_password=g-mNIR&z

?>
