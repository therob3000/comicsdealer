<?php

ini_set('display_errors',1); 
error_reporting(E_ALL);
//Conexion a la BD
include 'conexion_mysqli.php';
//$con = conexion();
$con = conexion_mysqli();

require_once 'unirest-php-master/lib/Unirest.php';
require_once 'sendgrid-php-master/lib/SendGrid.php';
require_once 'Swift-5.0.1/lib/swift_required.php';

SendGrid::register_autoloader();

$sendgrid = new SendGrid('app19174783@heroku.com', 'entimovj');

//Variables que recibe este archivo para hacer INSERT en la base de datos

$usuario_email		= $_REQUEST['usuario_email'];
$usuario_password 	= $_REQUEST['usuario_password'];
$usuario_nombre		= $_REQUEST['usuario_nombre'];
$usuario_pro 		= $_REQUEST['tipo_registro'];
$usuario_facebook_id    = $_REQUEST['usuario_facebook_id'];

$respuestaJSON		= NULL;
$json                   = new stdClass();

//Verificamos que las variables tengan algun valor, si es asi hace INSERT
if(!$usuario_email || !$usuario_password || !$usuario_nombre ){
	$respuestaJSON = false;
}
else{
	//Encriptamos la contraseña
	if (CRYPT_STD_DES == 1) {
    	$passwd 		= crypt($usuario_password, 'rl');
	}
        
	$cadena_confirmacion = md5(uniqid(rand(), true));
	//Generamos el INSERT
	//$queryRegistro	= "INSERT INTO usuarios VALUES (NULL, '$usuario_email', '$passwd', '$usuario_nombre','$cadena_confirmacion',0,0, CURDATE(), '$usuario_pro', $usuario_facebook_id)";
	//echo $queryRegistro;
        $insert_id = insertUsuario($con, $usuario_email, $passwd, $usuario_nombre, $cadena_confirmacion, $usuario_pro, $usuario_facebook_id);
	//Pasamos el INSERT utilizando la conexion $con
	//mysql_query($queryRegistro, $con);

	if($insert_id != 0){
            echo $insert_id;
            echo $usuario_email;
            echo $usuario_password;
            echo $usuario_nombre;
            echo $usuario_pro;
            echo $usuario_facebook_id;
            
            $cadena_activacion_completa = "www.comicsdealer.com/php/activacion.php?fier=$insert_id&codigo=$cadena_confirmacion";
            //echo $usuario_email;
            $mail1 = new SendGrid\Mail();
            $mail1->
                    addTo($usuario_email)->
                    setFrom('comics.dealer@gmail.com')->
                    setSubject('Bienvenido a Comics Dealer')->
                    setHtml('<strong>Gracias por tu registro, el ultimo paso es confirmar tu correo haciendo clic en </strong><a href="'  . $cadena_activacion_completa . '"><strong>ESTE ENLACE</strong></a>')->
                    addCategory("Registro");
            $sendgrid->smtp->send($mail1);
            
            $mail2 = new SendGrid\Mail();
            $mail2->
                    addTo('comics.dealer@gmail.com')->
                    setFrom('comics.dealer@gmail.com')->
                    setSubject('Usuario nuevo registrado: ' . $usuario_nombre)->
                    setText('El usuario: ' . $usuario_nombre . 'se ha registrado, en espera de confirmacion de su correo.');
            $sendgrid->smtp->send($mail2);

            /*$mail = new SendGrid\Mail();
            $mail->
                    addTo('carlos.mejia.rueda@gmail.com')->
                    setFrom('comics.dealer@gmail.com')->
                    setSubject('Usuario nuevo registrado: ' . $usuario_nombre)->
                    setText('El usuario: ' . $usuario_nombre . ' se ha registrado, en espera de confirmacion de su correo.');
            $sendgrid->smtp->send($mail);*/

            $respuestaJSON	= true;
        }
        else{
            
            echo $usuario_email;
            echo $usuario_password;
            echo $usuario_nombre;
            echo $usuario_pro;
            echo $usuario_facebook_id;
            $respuestaJSON	= false;
        }
}

$json->registro = $respuestaJSON;

//Regresamos la respuesta en formato JSON
echo json_encode($json);

function insertUsuario($con,$usuario_email,$passwd, $usuario_nombre, $cadena_confirmacion,$usuario_pro, $usuario_facebook_id){
    
    $queryInsertUsuario = "INSERT INTO usuarios VALUES (NULL, '$usuario_email', '$passwd', '$usuario_nombre','$cadena_confirmacion',0,0, CURDATE(),$usuario_pro,$usuario_facebook_id)";
    //echo $queryInsertUsuario;
    try {
      /* switch autocommit status to FALSE. Actually, it starts transaction */
      $con->autocommit(FALSE);

      $res = $con->query($queryInsertUsuario);
      if($res === false) {
        throw new Exception('Wrong SQL: ' . $queryInsertUsuario . ' Error: ' . $con->error);
      }
      
      $id_insert = $con->insert_id;
      $con->commit();
      //echo 'Transaction completed successfully!';

    } 
    catch (Exception $e) {
      //echo 'Transaction failed: ' . $e->getMessage();
      $id_insert = 0;
      $con->rollback();
    }

    /* switch back autocommit status */
    $con->autocommit(TRUE);
    
    return $id_insert;
}

