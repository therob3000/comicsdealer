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
	$codigo_postal = $_REQUEST['codigo_postal'];
	$inventario_id_compra = $_SESSION['usuario_comics'];
	$usuario_id = $_SESSION['usuario_id'];
	$usuario_nombre = $_SESSION['usuario_nombre'];
	$usuario_correo = $_SESSION['usuario_email'];

	$json = new stdClass();
        
        $inventario_ids = implode(",", $inventario_id_compra);
        
        $queryPaquetes =    "select inventario_id from inventario 
                            where inventario_paquete in 
                                (select inventario_paquete from inventario
                                where inventario_id in ($inventario_ids)
                                and inventario_paquete is not null)
                            union
                            select inventario_id from inventario 
                            where inventario_id in ($inventario_ids)
                            and inventario_paquete is null;";
        
        $queryResultadoIds = mysql_query($queryPaquetes);
        $num = mysql_num_rows($queryResultadoIds);
        
        if($num >=0 ){
            for($i = 0; $i < $num; $i++){
		$inventario_id[] = mysql_result($queryResultadoIds, $i, "inventario_id");
            }
        }

        for ($i=0; $i < count($inventario_id) ; $i++) { 
		//Actualizamos el inventario del comic poniendo existente en 0 
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
			//Actualizamos el catalogo de comics restando una unidad al numero de copias
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
			$queryCompra = "INSERT INTO compras VALUES('',$usuario_id, 0, CURDATE(), $forma_pago_id, $codigo_postal)";
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

		$comicsNombre = obtenerComics();
		$comicsImplode = implode($comicsNombre);

		//print_r($comicsNombre);
		//echo "IMPLODE: $comicsImplode :TERMINA";

		$mail = new SendGrid\Mail();
		$mail->
	 	addTo($usuario_correo)->
	 	setFrom('comics.dealer@gmail.com')->
	 	setSubject('Comics Dealer: Resumen de tu compra.')->
	 	setHtml('Gracias por tu compra <strong>'.$usuario_nombre.'</strong>, estos son los comics que compraste: <strong>'.$comicsImplode.'</strong> en breve nos pondremos en contacto contigo, Gracias!. <p>(Este correo se genera automaticamente, no hay necesidad de responderlo)</p>');
  		$sendgrid->smtp->send($mail);

		$mail = new SendGrid\Mail();
		$mail->
		addTo('comics.dealer@gmail.com')->
		setFrom('comics.dealer@gmail.com')->
		setSubject('Compra del usuario: ' . $usuario_nombre)->
		setHtml('El usuario: ' . $usuario_nombre . ' ha hecho una nueva compra: <strong>'.$comicsImplode.'</strong><p>Correo de contacto: '.$usuario_correo.'</p>');
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

	function obtenerComics(){

		$comicsIds = implode(",", $_SESSION['usuario_comics']);
		$camposArray = array(
						"cat_comic_titulo",
						"cat_comic_numero_ejemplar",
						"inventario_precio_salida"
		);

		$queryCatalogoComics = "SELECT 
	    (SELECT datos_comic_titulo FROM datos_comics WHERE datos_comic_id = CATALOGO.cat_comic_descripcion_id) as cat_comic_titulo,
	    CATALOGO.cat_comic_numero_ejemplar,
	    INV.inventario_precio_salida
		FROM
	    cat_comics as CATALOGO
	        INNER JOIN
	    (SELECT 
	        inventario_id,
			inventario_precio_salida,
			inventario_cat_comic_unique_id
	    FROM
	        inventario
	    GROUP BY inventario_cat_comic_unique_id) AS INV ON INV.inventario_cat_comic_unique_id = CATALOGO.cat_comic_unique_id
		WHERE
	    	CATALOGO.cat_comic_activo = 1 AND INV.inventario_id IN ($comicsIds)";

	    //echo $queryCatalogoComics;

	    $queryResultado = mysql_query($queryCatalogoComics);
		$num = mysql_num_rows($queryResultado);

		if($num>0){
			for($i = 0; $i < $num; $i++){
				$compraCadena = "";
				for ($j=0; $j < count($camposArray); $j++) {
					$resultadoMil = mysql_result($queryResultado, $i, $camposArray[$j]);
					//echo mysql_result($queryResultado, $i, $camposArray[$j]);
					if($j == 2){
						$compraCadena = $compraCadena . " \$$resultadoMil";
					}
					if($j == 1){
						$compraCadena = $compraCadena . " #$resultadoMil";
					}
					if($j == 0){
						$compraCadena = $compraCadena . " $resultadoMil";
					}	
				}
				$rowArray[] = "<p>$compraCadena</p>";
			}
		}

		return $rowArray;

	}

?>








