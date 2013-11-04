<?php 
	
include 'conexion.php';
$con = conexion();

/*ini_set('display_errors',1); 
error_reporting(E_ALL);*/

$usuario_email 	= $_POST['usuario_email'];
$respuestaJSON 	= NULL;
$json 			= new stdClass();

$cadena = random_password(8);

if (CRYPT_STD_DES == 1) {
	$passwd 		= crypt($cadena, 'rl');
}
$queryUsuario	= "SELECT * FROM usuarios WHERE usuario_email = '$usuario_email'";
//echo $queryUsuario;
$queryResultado	= mysql_query($queryUsuario, $con);
$num			= mysql_num_rows($queryResultado);

if($num > 0){
	$usuario_id 	= mysql_result($queryResultado, 0, "usuario_id");
	$queryPass	   	= "UPDATE usuarios SET usuario_password = '$passwd' WHERE usuario_id = $usuario_id";
	$exito			= mysql_query($queryPass);
	//echo $exito;
	if ($exito == true) {
		$para      = $usuario_email;
		$titulo = 'Recuperacion de contraseña en Comics Dealer';
		$mensaje = "Tu nuevo password es: " . $cadena . " te recomendamos que ingreses a tu perfil y lo cambies por alguno que puedas recordar. Gracias!";
		$cabeceras = 'From: webmaster@example.com' . "\r\n" .
		'Reply-To: comics.dealer@gmail.com' . "\r\n" .
		'X-Mailer: PHP/' . phpversion();

		mail($para, $titulo, $mensaje, $cabeceras);
		$respuestaJSON = true;
	} else {
		$respuestaJSON = false;
	}
	
}
else{
	$respuestaJSON = false;
}

$json->pass = $respuestaJSON;

echo json_encode($json);


function random_password( $length ) {
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!&-.?";
	$password = substr( str_shuffle( $chars ), 0, $length );
	return $password;
}

?>