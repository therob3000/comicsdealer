<?php

function conexion(){
	//Definimos los parametros de conexion, host, usuario, password
	$con = mysql_connect("localhost","root","rufo666");

	//Si no se puede conectar manda el siguiente mensaje
	if (!$con){
		die('Error no se pudo conectar: ' . mysql_error());
	}
	//Seleccionamos la base de datos a usar
	else{
		mysql_select_db("comicsdealer", $con);
		return($con);
	}
}

?>