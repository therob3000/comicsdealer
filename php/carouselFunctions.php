<?php

function cargarCarousel($arrayComics){
    
    $campos = array("inventario_id",
        "cat_comic_titulo",
        "cat_comic_descripcion",
        "cat_comic_personaje",
        "cat_comic_numero_ejemplar",
        "cat_comic_imagen_url",
        "inventario_precio_salida",
        "cat_comic_idioma",
        "inventario_paquete",
        "cat_comic_imagen_mini",
        "cat_comic_unique_id",
        "cat_comic_numero_visitas"
    );
    
    echo "<div id='carousel-comics-dealer' class='carousel slide' data-ride='carousel'>
            <ol class='carousel-indicators'>
                <li data-target='#carousel-comics-dealer' data-slide-to='0' ></li>
                <li data-target='#carousel-comics-dealer' data-slide-to='1' ></li>
                <li data-target='#carousel-comics-dealer' data-slide-to='2' class='active'></li>
            </ol>
            <div class='carousel-inner carousels'>";
    $contador = 0;
   
    for ($j = 0; $j < count($arrayComics); $j++) {
        
        $arrayComic2 = $arrayComics[$j];
        $comic_titulo = $arrayComic2[$campos[1]];
        $comic_personaje = $arrayComic2[$campos[3]];
        $comic_numero = $arrayComic2[$campos[4]];
        $comic_precio = $arrayComic2[$campos[6]];
        $comic_idioma = $arrayComic2[$campos[7]];
        $inventario_paquete = $arrayComic2[$campos[8]];
        $cat_comic_imagen_mini = $arrayComic2[$campos[9]];
        $cat_comic_unique_id = $arrayComic2{$campos{10}};
        
        if($j == 0){
            $ItemActivo = "active";
        }
        else{
            $ItemActivo = "";
        }
        if(is_null($inventario_paquete)){
            $hrefDetalle = "/html/Detalle.php?comic_id=$cat_comic_unique_id";
            $h5Class = "textoimg";
            $h5Texto = $comic_personaje;
            $titulo = $comic_titulo . " " . "#" . $comic_numero;
            $precio = $comic_precio;
        }
        else{
            $hrefDetalle = "/html/Detalle.php?comic_id=$cat_comic_unique_id&paquete_id=$inventario_paquete";
            $h5Class = "paquete";
            $h5Texto = "PAQUETE";
            $titulo = obtenerNombrePaquete($inventario_paquete);
            $precio = obtenerPrecioPaquete($inventario_paquete);
        }
        
        
        if($contador == 0){
            echo "<div class='item $ItemActivo'>
                    <img>
                    <div class='carousel-caption'>
                        <div class='row renglon'>
                            <div class='row' id='carousel_comics'>
                                <div class='cuadro3 col-xs-12 col-sm-6 col-md-3 col-lg-3' id='$cat_comic_unique_id' align='center'>
                                    <a href='$hrefDetalle' id='cat_detalle'>
                                        <div class='image'>
                                           <img id='cat_imagen' src='$cat_comic_imagen_mini' style='max-width: 100%;max-height: 100%' class='img-rounded img-responsive'>
                                           <h5 class='$h5Class col-xs-12'>
                                               $h5Texto
                                              <br>
                                              <titulo>$titulo</titulo>
                                              <br>
                                              <idioma>$comic_idioma</idioma>
                                              <br>
                                              <precio>$$precio<small> MXN</small></precio>
                                           </h5>
                                        </div>
                                    </a>
                                </div>";
        }
        else{
            echo "<div class='cuadro3 col-xs-12 col-sm-6 col-md-3 col-lg-3' id='$cat_comic_unique_id' align='center'>
                                    <a href='$hrefDetalle' id='cat_detalle'>
                                        <div class='image'>
                                           <img id='cat_imagen' src='$cat_comic_imagen_mini' style='max-width: 100%;max-height: 100%' class='img-rounded img-responsive'>
                                           <h5 class='$h5Class col-xs-12'>
                                               $h5Texto
                                              <br>
                                              <titulo>$titulo</titulo>
                                              <br>
                                              <idioma>$comic_idioma</idioma>
                                              <br>
                                              <precio>$$precio<small> MXN</small></precio>
                                           </h5>
                                        </div>
                                    </a>
                                </div>";
        }
        
        if($contador >= 3){
            echo "</div></div></div></div>";
            $contador = 0;
        }
        else{
            $contador++;
        }
           
    }
   
    echo "</div>
          <a class='left carousel-control' href='#carousel-comics-dealer' data-slide='prev'>
          <span class='glyphicon glyphicon-chevron-left'></span>
          </a>
          <a class='right carousel-control' href='#carousel-comics-dealer' data-slide='next'>
          <span class='glyphicon glyphicon-chevron-right'></span>
          </a>
        </div>";
}

function consulta_catalogo_carousel($camposArray) {
    $queryCatalogoCarousel = "SELECT 
        inventario_id,
        (SELECT datos_comic_titulo FROM datos_comics WHERE datos_comic_id = cat_comic_descripcion_id) as cat_comic_titulo,
        (SELECT datos_comic_descripcion FROM datos_comics WHERE datos_comic_id = cat_comic_descripcion_id) as cat_comic_descripcion,
        (SELECT personaje_nombre FROM personajes WHERE personaje_id = cat_comic_personaje_id) as cat_comic_personaje,
        cat_comic_numero_ejemplar,
        cat_comic_imagen_url,
        inventario_precio_salida,
        cat_comic_idioma,
        inventario_paquete,
        cat_comic_imagen_mini,
        cat_comic_unique_id,
        cat_comic_numero_visitas,
        inventario_activo
        FROM 
        (SELECT * FROM inventario as INV
            INNER JOIN cat_comics as CAT ON INV.inventario_cat_comic_unique_id = CAT.cat_comic_unique_id
            INNER JOIN personajes as PERS ON CAT.cat_comic_personaje_id = PERS.personaje_id
            INNER JOIN datos_comics as DAT ON CAT.cat_comic_descripcion_id = DAT.datos_comic_id
            WHERE INV.inventario_paquete IS NULL
            UNION
            SELECT * FROM inventario AS INV
            INNER JOIN cat_comics as CAT ON INV.inventario_cat_comic_unique_id = CAT.cat_comic_unique_id
            INNER JOIN personajes as PERS ON CAT.cat_comic_personaje_id = PERS.personaje_id
            INNER JOIN datos_comics as DAT ON CAT.cat_comic_descripcion_id = DAT.datos_comic_id
            GROUP BY INV.inventario_paquete
            HAVING INV.inventario_paquete != 0
            ORDER BY inventario_fecha_entrada DESC) AS LEL
            WHERE
                    cat_comic_activo = 1 
                    AND cat_comic_copias > 0 
                    AND inventario_existente = 1 
                    AND inventario_activo = 1
            LIMIT 12";

    $queryResultado = mysql_query($queryCatalogoCarousel);
    $num = mysql_num_rows($queryResultado);

    if ($num > 0) {
        for ($i = 0; $i < $num; $i++) {
            $rowArray = array();
            for ($j = 0; $j < count($camposArray); $j++) {
                //echo obtenerResultado2($camposArray[$j], $i, $queryResultado);
                $rowArray[$camposArray[$j]] = obtenerResultado2($camposArray[$j], $i, $queryResultado);
            }
            $catalogoCarousel[] = $rowArray;
        }
    } else {
        $catalogoCarousel[] = array();
    }
    return $catalogoCarousel;
}
