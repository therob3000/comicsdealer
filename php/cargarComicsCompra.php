<?php
	include 'conexion.php';
	$con = conexion();

	ini_set('display_errors',1); 
	error_reporting(E_ALL);

	session_start();

	$inventario_comics_array = $_SESSION['usuario_comics'];
	$cadenaInventarioId = "";

	$json = new stdClass();

        $camposArray = array(
                            "inventario_id",
                            "cat_comic_titulo",
                            "cat_comic_descripcion",
                            "cat_comic_personaje",
                            "cat_comic_numero_ejemplar",
                            "cat_comic_imagen_url",
                            "inventario_precio_salida",
                            "inventario_paquete",
                            "cat_comic_unique_id"
        );

        $catalogoArray = array();
        $rowArray = array();

	$cadenaInventarioId = implode(",", $inventario_comics_array);

    
    $queryComics = "SELECT 
        inventario_id,
        (SELECT datos_comic_titulo FROM datos_comics WHERE datos_comic_id = cat_comic_descripcion_id) as cat_comic_titulo,
        (SELECT datos_comic_descripcion FROM datos_comics WHERE datos_comic_id = cat_comic_descripcion_id) as cat_comic_descripcion,
        (SELECT personaje_nombre FROM personajes WHERE personaje_id = cat_comic_personaje_id) as cat_comic_personaje,
        cat_comic_numero_ejemplar,
        cat_comic_imagen_url,
        inventario_precio_salida,
        cat_comic_idioma,
        inventario_paquete,
        cat_comic_unique_id
        FROM 
        (SELECT *, max(inventario_precio_entrada) as inv_max FROM inventario as INV
            INNER JOIN cat_comics as CAT ON INV.inventario_cat_comic_unique_id = CAT.cat_comic_unique_id
            INNER JOIN personajes as PERS ON CAT.cat_comic_personaje_id = PERS.personaje_id
            INNER JOIN datos_comics as DAT ON CAT.cat_comic_descripcion_id = DAT.datos_comic_id
            WHERE INV.inventario_paquete IS NULL
			GROUP BY INV.inventario_cat_comic_unique_id
			HAVING INV.inventario_precio_entrada = inv_max

            UNION
            SELECT *, max(inventario_precio_entrada) as inv_max FROM inventario AS INV
            INNER JOIN cat_comics as CAT ON INV.inventario_cat_comic_unique_id = CAT.cat_comic_unique_id
            INNER JOIN personajes as PERS ON CAT.cat_comic_personaje_id = PERS.personaje_id
            INNER JOIN datos_comics as DAT ON CAT.cat_comic_descripcion_id = DAT.datos_comic_id
            GROUP BY INV.inventario_paquete
            HAVING INV.inventario_paquete != 0) AS LEL
            WHERE cat_comic_unique_id IN ($cadenaInventarioId)";

    //echo $queryComics;
    
    $queryResultado = mysql_query($queryComics);
    $num = mysql_num_rows($queryResultado);
    if($num>0){
        for($i = 0; $i < $num; $i++){
            $rowArray = array();
            for ($j=0; $j < count($camposArray); $j++) {
                $rowArray[$camposArray[$j]] = obtenerResultado($camposArray[$j], $i);
                
            }
            if($rowArray['inventario_paquete'] != 0){
                $rowArray['inventario_precio_salida'] = obtenerPrecioPaquete($rowArray['inventario_paquete']);
            }
            $inventario_id_array[] = $rowArray['inventario_id'];
            $catalogoArray[] = $rowArray;
        }
    }
    else{
        $inventario_id_array[] = $rowArray['inventario_id'];
        $catalogoArray = array();
    }

    $json->compras = $catalogoArray;

    echo json_encode($json);

    function obtenerResultado($nombreColumna, $indice){
        global $queryResultado;
        return mysql_result($queryResultado, $indice, "$nombreColumna");
    }
    
    function obtenerPrecioPaquete($inventario_paquete){
        $queryPrecioPaquete = "SELECT SUM(inventario_precio_salida) as precio_salida FROM inventario WHERE inventario_paquete = $inventario_paquete";
        //echo $queryPrecioPaquete;
        $queryPrecio = mysql_query($queryPrecioPaquete);
        return mysql_result($queryPrecio, 0, "precio_salida");
    }

?>