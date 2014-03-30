<?php

include 'conexion.php';
$con = conexion();

/*ini_set('display_errors',1); 
error_reporting(E_ALL);*/

$usuario_correo = $_POST['usuario_email'];

$respuestaJSON	= NULL;

$json 			= new stdClass();

$queryCorreo 			= "SELECT * FROM usuarios WHERE usuario_email LIKE '$usuario_correo'";
//echo $queryCorreo;
$queryResultado 		= mysql_query($queryCorreo, $con);
$num					= mysql_num_rows($queryResultado);
//echo "$num";
if($num > 0){
	$respuestaJSON 	= true;
}
else{
	$respuestaJSON = false;
}

$json->correo = $respuestaJSON;

echo json_encode($json);

mysql_close();


?>