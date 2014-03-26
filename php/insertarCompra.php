<?php
	include 'conexion.php';
	$con = conexion();

	ini_set('display_errors',1); 
	error_reporting(E_ALL);

	session_start();

	$forma_pago_id = $_REQUEST['forma_pago_id'];
	$inventario_id = $_SESSION['usuario_comics'];
	$usuario_id = $_SESSION['usuario_id'];
	$usuario_nombre = $_SESSION['usuario_nombre'];
	$usuario_correo = $_SESSION['usuario_email'];

	$json = new stdClass();

	$queryCompra = "INSERT INTO compras VALUES('',$usuario_id, 0, CURDATE(), $forma_pago_id)";
	$queryExito = mysql_query($queryCompra);

	$ultimo_id = mysql_insert_id();

	for ($i=0; $i < count($inventario_id) ; $i++) { 
		$queryCompraInventario = "INSERT INTO compra_inventario VALUES('', $ultimo_id, $inventario_id[$i])";
		$queryExito2 = mysql_query($queryCompraInventario);
		if ($queryExito2) {
			$queryActInventario = "UPDATE inventario SET inventario_existente = 0 WHERE inventario_id = $inventario_id[$i]";
			$queryComics = "UPDATE cat_comics SET cat_comic_copias = cat_comic_copias - 1 WHERE cat_comic_unique_id = (SELECT inventario_cat_comic_unique_id FROM inventario WHERE inventario_id = $inventario_id[$i])";
			$queryInventario = mysql_query($queryActInventario);
			$queryComics = mysql_query($queryComics);
			
			$json->exito = true;
		}
		else{
			$json->exito = false;
		}
	}

	
			$json->usuario_nombre = $usuario_nombre;
			$json->usuario_correo = $usuario_correo;

			$_SESSION['usuario_comics'] = array();

	echo json_encode($json);

?>




