<?php

//funcion para la conexion en heroku
/*function conexion(){

	$url=parse_url(getenv("CLEARDB_DATABASE_URL"));

    $server = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $db = substr($url["path"],1);

	//Definimos los parametros de conexion, host, usuario, password
	$con = mysql_connect($server, $username, $password);

	//Si no se puede conectar manda el siguiente mensaje
	if (!$con){
		die('Error no se pudo conectar: ' . mysql_error());
	}
	//Seleccionamos la base de datos a usar
	else{
		//echo "Funciona la pinche conexion";
		mysql_select_db($db);
		return($con);
	}
}*/

//funcion para la conexion local MAMP
/*function conexion(){
	//Definimos los parametros de conexion, host, usuario, password
	$con = mysql_connect("localhost","root","root");

	//Si no se puede conectar manda el siguiente mensaje
	if (!$con){
		die('Error no se pudo conectar: ' . mysql_error());
	}
	//Seleccionamos la base de datos a usar
	else{
		mysql_select_db("heroku_ee0f158613570e0", $con);
		return($con);
	}
}*/

//funcion para la conexion local WAMP
function conexion(){
	//Definimos los parametros de conexion, host, usuario, password
	$con = mysql_connect("localhost","root","");

	//Si no se puede conectar manda el siguiente mensaje
	if (!$con){
		die('Error no se pudo conectar: ' . mysql_error());
	}
	//Seleccionamos la base de datos a usar
	else{
		mysql_select_db("heroku_ee0f158613570e0", $con);
		return($con);
	}
}

?>