<?php

function cargarCatalogo($pagina_catalogo) {
    $campos = array("inventario_id",
        "cat_comic_titulo",
        "cat_comic_descripcion",
        "cat_comic_personaje",
        "cat_comic_numero_ejemplar",
        "cat_comic_imagen_url",
        "inventario_precio_salida",
        "cat_comic_idioma"
    );


    $salto_catalogo = $pagina_catalogo;
    $contador = $pagina_catalogo;

    for ($i = 0; $i < 4; $i++) {
        $arrayComics = lel2($campos, $contador, 4);

        echo "<div class='row' id='$i'>";
        for ($j = 0; $j < count($arrayComics); $j++) {
            $arrayComic2 = $arrayComics[$j];

            $inventario_id = $arrayComic2[$campos[0]];
            $comic_titulo = $arrayComic2[$campos[1]];
            $comic_descripcion = substr($arrayComic2[$campos[2]], 0, 180);
            $comic_personaje = $arrayComic2[$campos[3]];
            $comic_numero = $arrayComic2[$campos[4]];
            $comic_imagen = $arrayComic2[$campos[5]];
            $comic_precio = $arrayComic2[$campos[6]];
            $comic_idioma = $arrayComic2[$campos[7]];

            echo "<div align='center' class='col-xs-12 col-sm-6 col-md-6 col-lg-3' id='$inventario_id'>
                                        <a href='/html/Detalle.php?comic_id=$inventario_id' id='cat_detalle'>
                                            <img id='cat_imagen' src=$comic_imagen style='height: 180px; max-width: 150px;' class='img-rounded img-responsive' alt='$comic_titulo'>
                                        </a>
                                        <h4 id='cat_personaje'>$comic_personaje</h4>
                                        <a id='cat_detalle2' href='/html/Detalle.php?comic_id=$inventario_id'><h5><span id='cat_titulo' class='label label-primary'>" . $comic_titulo . " #" . $comic_numero . "</span></h5></a>
                                        <p id='cat_descripcion' class='catal' style='font-size: 10pt'>" . $comic_descripcion . " ...</p>
                                        <h4 id='cat_precio_venta'>$comic_precio</h4>
                                        <p></p>";

            if (isset($_SESSION['usuario_email']) && isset($_SESSION['usuario_nombre'])) {
                echo "<div id='boton_comprar'></div>
                                        <div id='boton_eliminar'></div>
                                        <p></p>
                                    </div>";
            } else {
                echo "<div id='boton_comprar'><button class='btn btn-success btn-comprar' role='button'>Comprar</button></div>
                                        
                                        <p></p>
                                    </div>";
            }
        }
        echo "</div>";
        $contador+=4;
    }
}

function lel2($camposArray, $salto, $rango) {
    $catalogoArray = array();
    $rowArray = array();

    $queryCatalogoComics = "SELECT 
    INV.inventario_id,
    (SELECT datos_comic_titulo FROM datos_comics WHERE datos_comic_id = CATALOGO.cat_comic_descripcion_id) as cat_comic_titulo,
    (SELECT datos_comic_descripcion FROM datos_comics WHERE datos_comic_id = CATALOGO.cat_comic_descripcion_id) as cat_comic_descripcion,
    (SELECT 
            personaje_nombre
        FROM
            personajes
        WHERE
            personaje_id = CATALOGO.cat_comic_personaje_id) as cat_comic_personaje,
    CATALOGO.cat_comic_numero_ejemplar,
	CATALOGO.cat_comic_imagen_url,
    INV.inventario_precio_salida,
    CATALOGO.cat_comic_idioma
	FROM
    cat_comics as CATALOGO
        INNER JOIN
    (SELECT 
        inventario_id,
		max(inventario_precio_entrada) as inventario_max_precio_entrada,
		inventario_precio_salida,
		inventario_cat_comic_unique_id,
		inventario_existente,
		inventario_fecha_entrada,
		inventario_activo
    FROM
        inventario
    GROUP BY inventario_cat_comic_unique_id ORDER BY inventario_fecha_entrada DESC) AS INV ON INV.inventario_cat_comic_unique_id = CATALOGO.cat_comic_unique_id
	WHERE
    	CATALOGO.cat_comic_activo = 1 AND CATALOGO.cat_comic_copias > 0 AND INV.inventario_existente = 1 AND INV.inventario_activo = 1
    LIMIT $salto, $rango";

    //echo $queryCatalogoComics;

    $queryResultado = mysql_query($queryCatalogoComics);

    $num = mysql_num_rows($queryResultado);
    if ($num > 0) {
        for ($i = 0; $i < $num; $i++) {
            $rowArray = array();
            for ($j = 0; $j < count($camposArray); $j++) {
                $rowArray[$camposArray[$j]] = obtenerResultado($camposArray[$j], $i, $queryResultado);
            }
            $catalogoArray[] = $rowArray;
        }
    } else {
        $catalogoArray = array();
    }

    return $catalogoArray;
}

function obtenerResultado($nombreColumna, $indice, $queryRes) {
    return mysql_result($queryRes, $indice, "$nombreColumna");
}

function obtenerTotalComics() {
    $queryTotal = "SELECT COUNT(*) AS total FROM inventario WHERE inventario_activo = 1 AND inventario_existente > 0";
    $queryResultado = mysql_query($queryTotal);
    return mysql_result($queryResultado, 0, "total");
}

function paginacion($pagina_paginacion) {
    if ($pagina_paginacion == 0) {
        $siguiente = $pagina_paginacion + 16;
        echo "<ul class='pager'>
                                    <li id='siguiente'><a href='./Catalogo.php?pagina=$siguiente'>Siguiente</a></li>
                                </ul>";
    } else {
        if ($pagina_paginacion + 16 >= obtenerTotalComics()) {
            $anterior = $pagina_paginacion - 16;
            echo "<ul class='pager'>
                                    <li id='anterior'><a href='./Catalogo.php?pagina=$anterior'>Anterior</a></li>
                                </ul>";
        } else {
            $siguiente = $pagina_paginacion + 16;
            $anterior = $pagina_paginacion - 16;
            echo "<ul class='pager'>
                                    <li id='anterior'><a href='./Catalogo.php?pagina=$anterior'>Anterior</a>
                                    <li id='siguiente'><a href='./Catalogo.php?pagina=$siguiente'>Siguiente</a></li>
                                </ul>";
        }
    }
}

?>