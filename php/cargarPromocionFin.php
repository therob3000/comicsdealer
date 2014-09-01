<?php
	include 'conexion.php';
	include 'fecha.php';
	$con = conexion();

	ini_set('display_errors',1); 
	error_reporting(E_ALL);

	$finDeSemana = determinaFindeSemana();
        
        $campos = array(
      "inventario_cat_comic_unique_id",
      "inventario_id",
      "cat_comic_titulo",
      "cat_comic_descripcion",
      "cat_comic_personaje",
      "cat_comic_numero_ejemplar",
      "cat_comic_imagen_url",
      "inventario_precio_salida",
      "cat_comic_idioma",
      "inventario_paquete"
  );
        
	
	$json = new stdClass();

	if($finDeSemana){
		
            $queryPromocion = "SELECT
                    INV.inventario_cat_comic_unique_id,
                    INV.inventario_id,
                    (SELECT datos_comic_titulo FROM datos_comics WHERE datos_comic_id = CATALOGO.cat_comic_descripcion_id) as cat_comic_titulo,
                    (SELECT datos_comic_descripcion FROM datos_comics WHERE datos_comic_id = CATALOGO.cat_comic_descripcion_id) as cat_comic_descripcion,
                    (SELECT personaje_nombre FROM personajes WHERE personaje_id = CATALOGO.cat_comic_personaje_id) as cat_comic_personaje,
                    (SELECT personaje_compania_id FROM personajes WHERE personaje_id = CATALOGO.cat_comic_personaje_id) as compania_id,
                    CATALOGO.cat_comic_numero_ejemplar,
                    CATALOGO.cat_comic_imagen_url,
                    INV.inventario_precio_salida,
                    CATALOGO.cat_comic_copias,
                    CATALOGO.cat_comic_idioma,
                    INV.inventario_integridad,
                    CATALOGO.cat_comic_precio_portada,
                    CATALOGO.cat_comic_precio_tienda
                FROM
                cat_comics as CATALOGO
                INNER JOIN
                (SELECT 
                        inventario_id,
                        max(inventario_precio_entrada) as inventario_max_precio_entrada,
                        inventario_precio_salida,
                        inventario_cat_comic_unique_id,
                        inventario_existente,
                        inventario_integridad,
                        inventario_promocion
                        FROM
                        inventario
                        GROUP BY inventario_cat_comic_unique_id) AS INV ON INV.inventario_cat_comic_unique_id = CATALOGO.cat_comic_unique_id
                WHERE
                CATALOGO.cat_comic_activo = 1 
                AND INV.inventario_existente = 1
                AND INV.inventario_promocion = 1";
            
                //echo $queryPromocion;
                
                $queryResultado = mysql_query($queryPromocion);
                $num = mysql_num_rows($queryResultado);
                
                if($num >= 0){
                    $inventario_cat_comic_unique_id = mysql_result($queryResultado, 0, "inventario_cat_comic_unique_id");
                    $inventario_id              = mysql_result($queryResultado, 0, "inventario_id");
                    $descripcion_titulo 	= mysql_result($queryResultado, 0, "cat_comic_titulo");
                    $descripcion_historia	= mysql_result($queryResultado, 0, "cat_comic_descripcion");
                    $precio_portada		= mysql_result($queryResultado, 0, "cat_comic_precio_portada");
                    $precio_oferta		= mysql_result($queryResultado, 0, "inventario_precio_salida");
                    $promocion_imagen		= mysql_result($queryResultado, 0, "cat_comic_imagen_url");
                    
                    //$json->descripcion_formato 	= $descripcion_formato;
                    $json->inventario_cat_comic_unique_id = $inventario_cat_comic_unique_id;
                    $json->inventario_id        = $inventario_id;
                    $json->descripcion_titulo 	= $descripcion_titulo;
                    $json->descripcion_historia = $descripcion_historia;
                    $json->precio_portada 	= $precio_portada;
                    $json->precio_oferta	= $precio_oferta;
                    $json->promocion_imagen     = $promocion_imagen;
                    $json->porcentaje		= round((100)-((($precio_oferta)*100)/$precio_portada));
                    $json->promocion = TRUE;
                }
//		$queryPromocion = "SELECT * FROM promociones WHERE promocion_activa = 1";
//		$queryResultado	= mysql_query($queryPromocion);
//		$num 			= mysql_num_rows($queryResultado);
//
//		if($num > 0){
//			$descripcion_formato 	= mysql_result($queryResultado, 0, "descripcion_formato");
//			$descripcion_titulo 	= mysql_result($queryResultado, 0, "descripcion_titulo");
//			$descripcion_historia	= mysql_result($queryResultado, 0, "descripcion_historia");
//			$precio_portada			= mysql_result($queryResultado, 0, "precio_portada");
//			$precio_oferta			= mysql_result($queryResultado, 0, "precio_oferta");
//			$promocion_imagen		= mysql_result($queryResultado, 0, "promocion_imagen");
//
//			$json->descripcion_formato 	= $descripcion_formato;
//			$json->descripcion_titulo 	= $descripcion_titulo;
//			$json->descripcion_historia = $descripcion_historia;
//			$json->precio_portada 		= $precio_portada;
//			$json->precio_oferta		= $precio_oferta;
//			$json->promocion_imagen     = $promocion_imagen;
//			$json->porcentaje			= round((100)-((($precio_oferta)*100)/$precio_portada));
//			$json->promocion = TRUE;
//		}
	}
	else{
		$json->promocion = FALSE;
	}

	echo json_encode($json);

?>