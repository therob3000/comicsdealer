<?php
        include 'conexion.php';
        $con = conexion();
        
        ini_set('display_errors',1); 
	error_reporting(E_ALL);
        
        $usuario_facebook_id = $_REQUEST['usuario_facebook_id'];
        $json = new stdClass();
        
        $queryFacebook = "SELECT * FROM usuarios WHERE usuario_facebook_id = $usuario_facebook_id";
        
        $queryResultado = mysql_query($queryFacebook);
        $num = mysql_num_rows($queryResultado);
        
        if($num > 0){
            $json->usuario_existe = TRUE;
        }
        else{
            $json->usuario_existe = FALSE;
        }
        
        echo json_encode($json);

