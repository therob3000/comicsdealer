<?php
	include 'conexion.php';
	$con = conexion();

	require_once 'unirest-php-master/lib/Unirest.php';
	require_once 'sendgrid-php-master/lib/SendGrid.php';
	require_once 'Swift-5.0.1/lib/swift_required.php';

	SendGrid::register_autoloader();

	$sendgrid = new SendGrid('app19174783@heroku.com', 'entimovj');

	ini_set('display_errors',1); 
	error_reporting(E_ALL);

	session_start();

	$forma_pago_id = $_REQUEST['forma_pago_id'];
	$inventario_id = $_SESSION['usuario_comics'];
	$usuario_id = $_SESSION['usuario_id'];
	$usuario_nombre = $_SESSION['usuario_nombre'];
	$usuario_correo = $_SESSION['usuario_email'];

	$json = new stdClass();

	for ($i=0; $i < count($inventario_id) ; $i++) { 
		$queryActInventario = "UPDATE inventario SET inventario_existente = 0 WHERE inventario_existente = 1 AND inventario_id = $inventario_id[$i]";
		$resultados[] = mysql_query($queryActInventario);	
	}

	foreach ($resultados as $resultado) {
		if(!$resultado){
			$exito = false;
		}
		else{
			$exito = true;
		}
	}

	if($exito){
		for ($i=0; $i < count($inventario_id); $i++) { 
			$queryComics = "UPDATE cat_comics SET cat_comic_copias = cat_comic_copias - 1 WHERE cat_comic_copias NOT IN (0) AND cat_comic_unique_id = (SELECT inventario_cat_comic_unique_id FROM inventario WHERE inventario_id = $inventario_id[$i])";
			$resultados2[] = mysql_query($queryComics);
		}
		foreach ($resultados2 as $resultado2) {
			if(!$resultado2){
				$exito2 = false;
			}
			else{
				$exito2 = true;
			}
		}
		if($exito2){
			$queryCompra = "INSERT INTO compras VALUES('',$usuario_id, 0, CURDATE(), $forma_pago_id)";
			$queryExito = mysql_query($queryCompra);

			$ultimo_id = mysql_insert_id();

			for ($i=0; $i < count($inventario_id); $i++) { 
				$queryCompraInventario = "INSERT INTO compra_inventario VALUES('', $ultimo_id, $inventario_id[$i])";
				$resultados3[] = mysql_query($queryCompraInventario);
			}
			foreach ($resultados3 as $resultado3) {
				if(!$resultado3){
					$exitoFinal = false;
				}
				else{
					$exitoFinal = true;
				}
			}

		}
		else{
			$exitoFinal = false;
		}
	}


	else{
		$exitoFinal = false;
	}

	if($exitoFinal){

		$mail = new SendGrid\Mail();
		$mail->
	 	addTo($usuario_correo)->
	 	setFrom('comics.dealer@gmail.com')->
	 	setSubject('Bienvenido a Comics Dealer')->
	 	setHtml('<strong>Gracias por tu compra, lel</strong>');
  		$sendgrid->smtp->send($mail);

		$mail = new SendGrid\Mail();
		$mail->
		addTo('comics.dealer@gmail.com')->
		setFrom('comics.dealer@gmail.com')->
		setSubject('Compra del usuario: ' . $usuario_nombre)->
		setText('El usuario: ' . $usuario_nombre . 'ha hecho una nueva compra lel.	');
		$sendgrid->smtp->send($mail);

		$json->usuario_nombre = $usuario_nombre;
		$json->usuario_correo = $usuario_correo;
		$json->exito = $exitoFinal;

		$_SESSION['usuario_comics'] = array();
	}
	else{
		$json->exito = $exitoFinal;
	}
	

	echo json_encode($json);

?>








