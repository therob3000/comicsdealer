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
            
            session_start();
            session_destroy();
            
            session_start();
            
            $usuario_activado = mysql_result($queryResultado, 0, "usuario_activado");
            $usuario_nombre = mysql_result($queryResultado, 0, "usuario_nombre");
            $usuario_id = mysql_result($queryResultado, 0, "usuario_id");
            $usuario_max_pedidos = mysql_result($queryResultado, 0, "usuario_max_pedidos");
            $usuario_pro = mysql_result($queryResultado, 0, "usuario_pro");
            
            $_SESSION['usuario_email'] 		= $usuario_email;
            $_SESSION['usuario_nombre']		= $usuario_nombre;
            $_SESSION['usuario_id']		= $usuario_id;
            $_SESSION['usuario_max_pedidos']	= $usuario_max_pedidos;
            $_SESSION['usuario_pro']            = $usuario_pro;
            $_SESSION['usuario_comics']		= $comicsArray;
            
            $json->usuario_existe = TRUE;
            
            if($usuario_pro == 1){
                $json->usuario_pro=TRUE;
            }
            else{
                $json->usuario_pro=FALSE;
            }
}
        else{
            $json->usuario_existe = FALSE;
        }
        
        echo json_encode($json);

