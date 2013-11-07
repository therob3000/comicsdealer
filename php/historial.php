<?php
	
	include 'conexion.php';
	$con = conexion();

	ini_set('display_errors',1); 
	error_reporting(E_ALL);

	$respuestaJSON 	= array();
	$json 			= new stdClass();

	session_start();
	$usuario_id = $_SESSION['usuario_id'];

	//echo $usuario_id;

	$queryHistorial 	= "SELECT * FROM pedidos WHERE pedido_usuario_id = $usuario_id";
	//echo $queryHistorial;

	$queryResultado		= mysql_query($queryHistorial, $con);
	$num				= mysql_num_rows($queryResultado);

	//echo "Numero de resultados: " . $num;

	if($num>0){
		for ($i=0; $i < $num; $i++) { 

			$pedido_compania_id		= mysql_result($queryResultado, $i, "pedido_compania_id");
			$pedido_personaje_id	= mysql_result($queryResultado, $i, "pedido_personaje_id");

			$texto_libre			= mysql_result($queryResultado, $i, "pedido_textolibre");
			$pedido_estado			= mysql_result($queryResultado, $i, "pedido_estado");
			$pedido_id 				= mysql_result($queryResultado, $i, "pedido_id");

			//echo "Id de compañia:" . $pedido_compania_id;
			//echo "Id de personaje:" . $pedido_personaje_id;

			$queryCompania				= "SELECT compania_nombre FROM companias WHERE compania_id = $pedido_compania_id";
			$queryPersonaje				= "SELECT personaje_nombre FROM personajes WHERE personaje_id = $pedido_personaje_id AND personaje_compania_id = $pedido_compania_id";

			$queryResultadoCompania		= mysql_query($queryCompania);
			$queryResultadoPersonaje	= mysql_query($queryPersonaje);

			$compania_nombre			= mysql_result($queryResultadoCompania, 0, "compania_nombre");
			$personaje_nombre			= mysql_result($queryResultadoPersonaje, 0, "personaje_nombre");

			//echo "Nombre de compañia" . $compania_nombre;
			//echo "Nombre de personaje" . $personaje_nombre;
			//echo "Texto" . $textoLibre;

			$respuestaJSON[$i] = array( 'pedido_id' => $pedido_id,
							 'compania_id' 		=> $pedido_compania_id,
							 'personaje_id'		=> $pedido_personaje_id,
							 'compania_nombre' 	=> $compania_nombre, 
							 'personaje_nombre'	=> $personaje_nombre,
							 'texto_libre'		=> $texto_libre,
							 'pedido_estado'	=> $pedido_estado
			);
		}
	}

	$json->pedidos = $respuestaJSON;

	echo json_encode($json);

?>

	