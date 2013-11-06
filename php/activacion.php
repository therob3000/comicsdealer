<?php 
include 'conexion.php';
$con = conexion();

/*ini_set('display_errors',1); 
error_reporting(E_ALL);*/

$codigo_activacion 	= $_GET['codigo'];
$usuario_id			= $_GET['fier'];

if(!$codigo_activacion || !$usuario_id){
	$mensaje 					= "Error: Tu cadena de activacion es incorrecta";
}
else{
	$queryConsultaActivacion 	= "SELECT usuario_cadena FROM usuarios WHERE usuario_id = $usuario_id";
	$consulta					= mysql_query($queryConsultaActivacion, $con);
	$num						= mysql_num_rows($consulta);
	
	if($num > 0){
		$codigo_db 					= mysql_result($consulta, 0, "usuario_cadena");
		//echo "Cadena de activacion" . $codigo_db;
		if($codigo_db == $codigo_activacion){
			$queryActivacion 	= "UPDATE usuarios SET usuario_activado = 1 WHERE usuario_id = $usuario_id";
			$queryBorraCodigo	= "UPDATE usuarios SET usuario_cadena = NULL WHERE usuario_id = $usuario_id";
			$query1				= mysql_query($queryActivacion);
			$query2				= mysql_query($queryBorraCodigo);
			$mensaje			= "Tu cuenta está activada";						
		}
		else{
			$mensaje 			= "Tu codigo es incorrecto, o hubo un problema";
		}
	}
	else{
		$mensaje 				= "Error, algo horrendo ha pasado";
	}
	echo "
				<!DOCTYPE html>
				<html>
				  <head>
				    <title>Cuenta Activada!</title>
				    
				    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
				    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
				    
				    <!-- Bootstrap -->
				    <link href='../bootstrap/css/bootstrap.css' rel='stylesheet' media='screen'>
				    <link href='../bootstrap/css/bootstrap.min.css' rel='stylesheet' media='screen'>
				    <link rel='shortcut icon' href='../img/ComicDico-01.png'>
				    <link href='../bootstrap/css/navbar.css' rel='stylesheet'>
				    <link rel='stylesheet' type='text/css' href='../bootstrap/css/comicsD.css'>
				    <script src='../bootstrap/assets/js/jquery.js'></script>
				    <script src='../bootstrap/js/bootstrap.min.js'></script>
				    <script src='../js/login.js'></script>

				    <style>
				      .container {
				        
				      }
				      #mini{
				        max-width:530px;
				      }
				    </style>
				    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
				    <!--[if lt IE 9]>
				      <script src='../../assets/js/html5shiv.js'></script>
				      <script src='../../assets/js/respond.min.js'></script>
				    <![endif]-->
				  </head>
				  <body>
				    <div class='container tres'>
				      <div class='container tres' align='center'>
				        <div class='jumbotron' id='mini'>
				          <div class'container' >
				            <div class='' >".
				              $mensaje." Te estamos redirigiendo"."
				            </div>
				          </div>
				        </div>
				      </div>

				    </div>
				  </body>
				</html>
			";
			echo '<meta http-equiv="refresh" content="5; url=http://www.comicsdealer.com">';


}
