<?php
	include 'conexion.php';
	include 'fecha.php';
	$con = conexion();

	require_once 'unirest-php-master/lib/Unirest.php';
	require_once 'sendgrid-php-master/lib/SendGrid.php';
	require_once 'Swift-5.0.1/lib/swift_required.php';

	SendGrid::register_autoloader();

	$sendgrid = new SendGrid('app19174783@heroku.com', 'entimovj');

	/*ini_set('display_errors',1); 
	error_reporting(E_ALL);*/

	/*$usuario_id					= $_POST['usuario_id'];
	$compania_id				= $_POST['compania_id'];
	$personaje_id				= $_POST['personaje_id'];
	$texto_libre				= $_POST['texto_libre'];
	$pedido_forma_pago_id		= $_POST['pedido_forma_pago_id'];
	$pedido_lugar_entrega		= $_POST['lugar_entrega'];*/

	$usuario_id					= $_REQUEST['usuario_id'];
	$compania_id				= $_REQUEST['compania_id'];
	$personaje_id				= $_REQUEST['personaje_id'];
	$texto_libre				= $_REQUEST['texto_libre'];
	$pedido_forma_pago_id		= $_REQUEST['pedido_forma_pago_id'];
	$pedido_lugar_entrega		= $_REQUEST['lugar_entrega'];
	

	$respuestaJSON 	= NULL;
	$json 			= new stdClass();

	$queryInsertPedido = "INSERT INTO pedidos VALUES ('', '$usuario_id', '$compania_id', '$personaje_id', '$texto_libre', '$pedido_lugar_entrega', '$pedido_forma_pago_id', CURDATE(), NULL, NULL, 0)";
	//echo $queryInsertPedido;

	$exito = mysql_query($queryInsertPedido, $con);

	if($exito == true){
		//echo "Se inserto correctamente el pedido";
		session_start();
		$usuario_nombre	= $_SESSION['usuario_nombre'];
		$usuario_email 	= $_SESSION['usuario_email'];
		$_SESSION['usuario_max_pedidos']++;
		//echo $_SESSION['usuario_max_pedidos'];
		$respuestaJSON 	= true;
		$queryUsuario 	= "UPDATE usuarios SET usuario_max_pedidos = usuario_max_pedidos + 1 WHERE usuario_id = $usuario_id";

		mysql_query($queryUsuario);
		$proximoSabado = obtenerProximoSabado();

		$mail = new SendGrid\Mail();
		$mail->
		addTo($usuario_email)->
		setFrom('comics.dealer@gmail.com')->
		setSubject('Pedido Comics Dealer')->
		setHtml('<div><p>Estimado <strong>'. $usuario_nombre . '</strong> hemos recibido tu pedido, la busqueda de tu(s) comics ha comenzado.</p></div><div><p>Tendras noticias sobre tu pedido el proximo: <strong>' . $proximoSabado . '</strong></p></div><div><p>Gracias y recuerda que toda la comunicacion sera por este correo electronico.</p></div>')->
		addCategory("ConfirmacionPedido");
		$sendgrid->smtp->send($mail);

		$mail = new SendGrid\Mail();
		$mail->
		addTo('comics.dealer@gmail.com')->
		setFrom('comics.dealer@gmail.com')->
		setSubject('El usuario: ' . $usuario_nombre . ' ha hecho un nuevo pedido')->
		setHtml('<div><p>Pedido: ' . $texto_libre . '</p></div><div><p>Correo del Usuario: ' . $usuario_email . '</div></p><div><p>Fecha noticias de pedido: '. $proximoSabado . '</div></p>' );
		$sendgrid->smtp->send($mail);

		$mail = new SendGrid\Mail();
		$mail->
		addTo('carlos.mejia.rueda@gmail.com')->
		setFrom('comics.dealer@gmail.com')->
		setSubject('El usuario: ' . $usuario_nombre . ' ha hecho un nuevo pedido')->
		setHtml('<div><p>Pedido: ' . $texto_libre . '</p></div><div><p>Correo del Usuario: ' . $usuario_email . '</div></p><div><p>Fecha noticias de pedido: '. $proximoSabado . '</div></p>' );
		$sendgrid->smtp->send($mail);

		/*$mail = new SendGrid\Mail();
		$mail->
		addTo('vladimir.1416@gmail.com')->
		setFrom('comics.dealer@gmail.com')->
		setSubject('El usuario: ' . $usuario_nombre . ' ha hecho un nuevo pedido')->
		setHtml('<div><p>Pedido: ' . $texto_libre . '</p></div><div><p>Correo del Usuario: ' . $usuario_email . '</div></p><div><p>Fecha noticias de pedido: '. $proximoSabado . '</div></p>' );
		$sendgrid->smtp->send($mail);*/

	}

	else{
		//echo "Algo horrendo paso";
		$respuestaJSON = false;
	}

	$json->pedido = $respuestaJSON;

	echo json_encode($json);

	//compania_id=1&personaje_id=1&texto_libre=dsadasd+dasd+sa+da+dsa+dsa&metro=Balderas&pedido_forma_pago_id=2&usuario_id=5
	//usuario_id=132&compania_id=1&personaje_id=21&texto_libre=Promocion+Fin&pedido_forma_pago_id=1&lugar_entrega=No+definido
?>

