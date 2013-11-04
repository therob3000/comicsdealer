<?php
	include 'conexion.php';
	$con = conexion();


	/*ini_set('display_errors',1); 
	error_reporting(E_ALL);*/

	$usuario_id					= $_POST['usuario_id'];
	$compania_id				= $_POST['compania_id'];
	$personaje_id				= $_POST['personaje_id'];
	$texto_libre				= $_POST['texto_libre'];
	$pedido_forma_pago_id		= $_POST['pedido_forma_pago_id'];
	$pedido_lugar_entrega		= $_POST['lugar_entrega'];

	$respuestaJSON 	= NULL;
	$json 			= new stdClass();

	$queryInsertPedido = "INSERT INTO Pedidos VALUES ('', '$usuario_id', '$compania_id', '$personaje_id', '$texto_libre', '$pedido_lugar_entrega', '$pedido_forma_pago_id')";
	//echo $queryInsertPedido;

	$exito = mysql_query($queryInsertPedido, $con);

	if($exito == true){
		//echo "Se inserto correctamente el pedido";
		session_start();
		$_SESSION['usuario_max_pedidos']++;
		//echo $_SESSION['usuario_max_pedidos'];
		$respuestaJSON 	= true;
		$queryUsuario 	= "UPDATE Usuarios SET usuario_max_pedidos = usuario_max_pedidos + 1 WHERE usuario_id = $usuario_id";

		mysql_query($queryUsuario);
	}

	else{
		//echo "Algo horrendo paso";
		$respuestaJSON = false;
	}

	$json->pedido = $respuestaJSON;

	echo json_encode($json);

	
	//compania_id=2&personaje_id=2&mensaje_web=Probando+los+espacios+en+el+textfield&pedido_forma_pago_id=1&usuario_id=5
	//compania_id=1&personaje_id=1&texto_libre=dsadasd+dasd+sa+da+dsa+dsa&metro=Balderas&pedido_forma_pago_id=2&usuario_id=5
?>

