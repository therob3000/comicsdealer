<?php

//Conexion a la BD
include 'conexion.php';
$con = conexion();

require_once 'unirest-php-master/lib/Unirest.php';
require_once 'sendgrid-php-master/lib/SendGrid.php';
require_once 'Swift-5.0.1/lib/swift_required.php';

SendGrid::register_autoloader();

$sendgrid = new SendGrid('app19174783@heroku.com', 'entimovj');

/*ini_set('display_errors',1); 
error_reporting(E_ALL);*/

//Variables que recibe este archivo para hacer INSERT en la base de datos

$usuario_email		= $_POST['usuario_email'];
$usuario_password 	= $_POST['usuario_password'];
$usuario_nombre		= $_POST['usuario_nombre'];

$respuestaJSON		= NULL;

$json				= new stdClass();

//Verificamos que las variables tengan algun valor, si es asi hace INSERT
if(!$usuario_email || !$usuario_password || !$usuario_nombre ){
	$respuestaJSON = false;
}
else{
	//Encriptamos la contraseña
	if (CRYPT_STD_DES == 1) {
    	$passwd 		= crypt($usuario_password, 'rl');
	}
	$cadena_confirmacion = md5(uniqid(rand(), true));
	//Generamos el INSERT
	$queryRegistro	= "INSERT INTO usuarios VALUES (NULL, '$usuario_email', '$passwd', '$usuario_nombre','$cadena_confirmacion',0,0)";
	//echo $queryRegistro;
	//Pasamos el INSERT utilizando la conexion $con
	mysql_query($queryRegistro, $con);

	$usuario_id = mysql_insert_id();
	//echo $usuario_id;

	$cadena_activacion_completa = "www.comicsdealer.com/php/activacion.php?fier=$usuario_id&codigo=$cadena_confirmacion";

	$mail = new SendGrid\Mail();
	$mail->
	 	addTo($usuario_email)->
	 	setFrom('comics.dealer@gmail.com')->
	 	setSubject('Bienvenido a Comics Dealer')->
	 	setHtml('<strong>Gracias por tu registro, el ultimo paso es confirmar tu correo haciendo clic en </strong><a href="'  . $cadena_activacion_completa . '><strong>ESTE ENLACE</strong></a>')->
	 	addCategory("Registro");
  	$sendgrid->smtp->send($mail);

	$mail = new SendGrid\Mail();
	$mail->
		addTo('comics.dealer@gmail.com')->
		setFrom('comics.dealer@gmail.com')->
		setSubject('Usuario nuevo registrado: ' . $usuario_nombre)->
		setText('El usuario: ' . $usuario_nombre . 'se ha registrado, en espera de confirmacion de su correo.');
	$sendgrid->smtp->send($mail);

	$mail = new SendGrid\Mail();
	$mail->
		addTo('carlos.mejia.rueda@gmail.com')->
		setFrom('comics.dealer@gmail.com')->
		setSubject('Usuario nuevo registrado: ' . $usuario_nombre)->
		setText('El usuario: ' . $usuario_nombre . ' se ha registrado, en espera de confirmacion de su correo.');
	$sendgrid->smtp->send($mail);

	$respuestaJSON	= true;
}

$json->registro = $respuestaJSON;

//Regresamos la respuesta en formato JSON
echo json_encode($json);


?>

