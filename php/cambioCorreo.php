<?php
	include 'conexion.php';
	$con = conexion();

	/*ini_set('display_errors',1); 
	error_reporting(E_ALL);*/

	require_once 'unirest-php-master/lib/Unirest.php';
	require_once 'sendgrid-php-master/lib/SendGrid.php';
	require_once 'Swift-5.0.1/lib/swift_required.php';

	SendGrid::register_autoloader();

	$sendgrid = new SendGrid('app19174783@heroku.com', 'entimovj');

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
			$resCorreos		= mysql_query($queryCorreos, $con);
			$num1			= mysql_num_rows($resCorreos);

			if ($num1 > 0) {
				//echo "Existe el correo";
				$respuestaJSON = false;	
			}
			else{
				//echo "No Existe el correo";
				$cadena_confirmacion = md5(uniqid(rand(), true));
				$queryCambio 	= "UPDATE usuarios SET usuario_email = '$usuario_email_nuevo', usuario_activado = 0, usuario_cadena = '$cadena_confirmacion' WHERE usuario_id = $usuario_id";
				//echo $queryCambio;
				mysql_query($queryCambio, $con);

				$cadena_activacion_completa = "www.comicsdealer.com/php/activacion.php?fier=$usuario_id&codigo=$cadena_confirmacion";

				$mail = new SendGrid\Mail();
				$mail->
				addTo($usuario_email_nuevo)->
				setFrom('comics.dealer@gmail.com')->
				setSubject('Cambio de correo: Comics Dealer')->
				setHtml('<strong>Tu correo ha sido cambiado, recuerda que ahora debes hacer login con este correo, termina el cambio verificandolo en </strong><a href="'  . $cadena_activacion_completa . '"><strong>ESTE ENLACE</strong></a>')->
				addCategory("CambioCorreo");
				$sendgrid->smtp->send($mail);

				$respuestaJSON	= true;
			}
		}
		else{
			//echo "No funciona";
			$respuestaJSON = false;
		}
	}
	else{
		$respuestaJSON = false;
	}

	$json->correo = $respuestaJSON;
	echo json_encode($json);

//usuario_email=carlos.mejia.rueda@gmail.com&usuario_password=Rufo_chato2&usuario_email_nuevo=lord_push@hotmail.com
?>


