<?php

session_start();

$respuestaJSON = NULL;
$json = new stdClass();

ini_set('display_errors', 1);
error_reporting(E_ALL);

if (isset($_SESSION['usuario_email']) && isset($_SESSION['usuario_nombre'])) {
    //echo "ha iniciado sesion ". $_SESSION['usuario_email'];
    $respuestaJSON = array(
        'usuario_email' => $_SESSION['usuario_email'],
        'usuario_nombre' => $_SESSION['usuario_nombre'],
        'usuario_id' => $_SESSION['usuario_id'],
        'usuario_max_pedidos' => $_SESSION['usuario_max_pedidos'],
        'usuario_pro' => $_SESSION['usuario_pro'],
        'estado' => true
    );
} else {
    $respuestaJSON = array(
        'estado' => false
    );
}

$json->ver_sesion = $respuestaJSON;

echo json_encode($json);
