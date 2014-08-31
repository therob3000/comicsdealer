<?php

include 'conexion_mysqli.php';
$con = conexion_mysqli();

require_once 'unirest-php-master/lib/Unirest.php';
require_once 'sendgrid-php-master/lib/SendGrid.php';
require_once 'Swift-5.0.1/lib/swift_required.php';

SendGrid::register_autoloader();

$sendgrid = new SendGrid('app19174783@heroku.com', 'entimovj');

ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

$forma_pago_id = $_REQUEST['forma_pago_id'];
$codigo_postal = $_REQUEST['codigo_postal'];

$inventario_id_compra   = $_SESSION['usuario_comics'];
$usuario_id             = $_SESSION['usuario_id'];
$usuario_nombre         = $_SESSION['usuario_nombre'];
$usuario_correo         = $_SESSION['usuario_email'];

$json = new stdClass();

//OBTENEMOS LOS ID'S DE LOS ELEMENTOS COMPRADOS
$inventario_ids = implode(",", $inventario_id_compra);

$queryObtenerIds = "
        SELECT inventario_id, NULL
        FROM inventario as INV 
            WHERE INV.inventario_paquete IN (select inventario_paquete from inventario where inventario_cat_comic_unique_id in ($inventario_ids) and inventario_paquete is not null) 
        UNION 
        SELECT inventario_id, max(inventario_precio_entrada) as inv_max 
        FROM inventario as INV 
        INNER JOIN cat_comics as CAT ON INV.inventario_cat_comic_unique_id = CAT.cat_comic_unique_id 
        INNER JOIN personajes as PERS ON CAT.cat_comic_personaje_id = PERS.personaje_id 
        INNER JOIN datos_comics as DAT ON CAT.cat_comic_descripcion_id = DAT.datos_comic_id 
            WHERE INV.inventario_paquete IS NULL 
            AND inventario_cat_comic_unique_id IN ($inventario_ids)";
//echo $queryObtenerIds;
//GENERAMOS QUERY PARA OBTENER ID'S DE LOS COMICS EN PAQUETE COMO INDIVIDUALES
$res = $con->query($queryObtenerIds);

$num = $res->num_rows;

if ($num >= 0) {
    while($row = $res->fetch_assoc()) {
        $inventario_id[] = $row['inventario_id'];
    }
}

$exitoFinal = compra($con, $inventario_id, $inventario_ids, $usuario_id, $forma_pago_id, $codigo_postal);

if ($exitoFinal) {

    $comicsNombre = obtenerComics($inventario_id,$con);
    $comicsImplode = implode($comicsNombre);

    //print_r($comicsNombre);
    //echo "IMPLODE: $comicsImplode :TERMINA";

    $mail = new SendGrid\Mail();
    $mail->
            addTo($usuario_correo)->
            setFrom('comics.dealer@gmail.com')->
            setSubject('Comics Dealer: Resumen de tu compra.')->
            setHtml('Gracias por tu compra <strong>' . $usuario_nombre . '</strong>, estos son los comics que compraste: <strong>' . $comicsImplode . '</strong> en breve nos pondremos en contacto contigo, Gracias!. <p>(Este correo se genera automaticamente, no hay necesidad de responderlo)</p>');
    $sendgrid->smtp->send($mail);

    $mail = new SendGrid\Mail();
    $mail->
            addTo('comics.dealer@gmail.com')->
            setFrom('comics.dealer@gmail.com')->
            setSubject('Compra del usuario: ' . $usuario_nombre)->
            setHtml('El usuario: ' . $usuario_nombre . ' ha hecho una nueva compra: <strong>' . $comicsImplode . '</strong><p>Correo de contacto: ' . $usuario_correo . '</p>');
    $sendgrid->smtp->send($mail);

    $json->usuario_nombre = $usuario_nombre;
    $json->usuario_correo = $usuario_correo;
    $json->exito = $exitoFinal;

    $_SESSION['usuario_comics'] = array();
} else {
    $json->exito = $exitoFinal;
}

echo json_encode($json);

function obtenerComics($inventario_id, $con) {

    $comicsIds = implode(",", $inventario_id);
    
    $camposArray = array(
        "cat_comic_titulo",
        "cat_comic_numero_ejemplar",
        "inventario_precio_salida"
    );

    $queryCatalogoComics = "
            SELECT
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
    
    $res = $con->query($queryCatalogoComics);
    
//    $queryResultado = mysql_query($queryCatalogoComics);
//    $num = mysql_num_rows($queryResultado);
    
    $num = $res->num_rows;
    
    if ($num > 0) {
        while($row = $res->fetch_assoc()) {
            $compraCadena = "";
            for ($j = 0; $j < count($camposArray); $j++) {
                $resultadoMil = $row[$camposArray[$j]];
                
                if ($j == 2) {
                    $compraCadena = $compraCadena . " \$$resultadoMil";
                }
                if ($j == 1) {
                    $compraCadena = $compraCadena . " #$resultadoMil";
                }
                if ($j == 0) {
                    $compraCadena = $compraCadena . " $resultadoMil";
                }
            }
            $rowArray[] = "<p>$compraCadena</p>";
        }
    }

    return $rowArray;
}

function compra($con, $inventario_id, $inventario_unique_id, $usuario_id, $forma_pago_id, $codigo_postal){
    
    $inventario = implode(",", $inventario_id);
    
    $queryActInventario = "UPDATE inventario SET inventario_existente = 0 WHERE inventario_existente = 1 AND inventario_id IN ($inventario)";
    //echo $queryActInventario;
    $queryComics = "UPDATE cat_comics SET cat_comic_copias = cat_comic_copias - 1, cat_comic_numero_compras = cat_comic_numero_compras + 1 WHERE cat_comic_copias NOT IN (0) AND cat_comic_unique_id IN ($inventario_unique_id)";
    $queryCompra = "INSERT INTO compras VALUES('',$usuario_id, 0, CURDATE(), $forma_pago_id, $codigo_postal)";
    
    try {
      /* switch autocommit status to FALSE. Actually, it starts transaction */
    $con->autocommit(FALSE);
    $resultadoInsertaInventario = $con->query($queryActInventario);
      
    if($resultadoInsertaInventario == false) {
        throw new Exception($con->error);
    }
    else {
        $resultadoActualizaComics = $con->query($queryComics);
        if($resultadoActualizaComics == false){
            throw new Exception($con->error);
        }
        else{
            $resultadoCompra = $con->query($queryCompra);
            if($resultadoCompra == false){
                throw new Exception($con->error);
            }
            else{
                $ultimo_id = $con->insert_id;
                for ($i = 0; $i < count($inventario_id); $i++) {
                    $queryCompraInventario = "INSERT INTO compra_inventario VALUES('', $ultimo_id, $inventario_id[$i])";
                    $con->query($queryCompraInventario);
                }   
            }
        }
    } 
    $con->commit();
    //echo 'Transaction completed successfully!';
    } 
    catch (Exception $e) {
      //echo 'Transaction failed: ' . $e->getMessage();
      $con->rollback();
      return FALSE;
    }
    
    return TRUE;
}









