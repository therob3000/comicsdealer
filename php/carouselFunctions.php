<?php

function cargarCarousel($arrayComics, $rowid) {
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

    echo "<div class='thumbnail hidden-xs hidden-sm'>
            <div id='carousel-comics-dealer' class='carousel slide' data-ride='carousel'>
              <ol class='carousel-indicators'>
                <li data-target='#carousel-comics-dealer' data-slide-to='0' class='active'></li>
                <li data-target='#carousel-comics-dealer' data-slide-to='1' class=''></li>
                <li data-target='#carousel-comics-dealer' data-slide-to='2' class=''></li>
              </ol>
              <div class='carousel-inner carousels'>";

    $contador = 3;

    for ($j = 0; $j < count($arrayComics); $j++) {

        $arrayComic2 = $arrayComics[$j];
        $codigohtml = "";

        $inventario_id = $arrayComic2[$campos[0]];
        $comic_titulo = $arrayComic2[$campos[1]];
        $comic_descripcion = substr($arrayComic2[$campos[2]], 0, 90);
        $comic_personaje = $arrayComic2[$campos[3]];
        $comic_numero = $arrayComic2[$campos[4]];
        $comic_imagen = $arrayComic2[$campos[5]];
        $comic_precio = $arrayComic2[$campos[6]];
        $comic_idioma = $arrayComic2[$campos[7]];
        $inventario_paquete = $arrayComic2[$campos[8]];
        $cat_comic_imagen_mini = $arrayComic2[$campos[9]];
        $cat_comic_unique_id = $arrayComic2{$campos{10}};
        $cat_comic_numero_visitas = $arrayComic2[$campos[11]];

        if ($comic_idioma == "ing") {
            $comic_idioma = "Inglés";
        } else {
            $comic_idioma = "Español";
        }
        
        if (is_null($inventario_paquete)) {
            $hrefDetalle = "/html/Detalle.php?comic_id=$cat_comic_unique_id";
        } else {
            $hrefDetalle = "/html/Detalle.php?comic_id=$cat_comic_unique_id&paquete_id=$inventario_paquete";
        }

        if ($j == 0 && $contador == 3) {
            $codigohtml = "<div class='item active'>"
                        . "<img>"
                            . "<div class='carousel-caption'>"
                            . "<div class='row renglon'>"
                            . "<div class='row' id='carousel_comics'>"
                                . "<div align='center' class='cuadro3 col-xs-12 col-sm-6 col-md-3 col-lg-3' id='$cat_comic_unique_id'>"
                                    . "<a href='$hrefDetalle' id='cat_detalle'>"
                                    . "<div class='image'>"
                                        . "<img id='cat_imagen' src=$cat_comic_imagen_mini style='max-width: 100%;max-height: 100%' class='img-rounded img-responsive'>";
        } else {
            if ($j > 0 && $contador == 3) {
                $codigohtml = "<div class='item'>"
                        . "<img>"
                            . "<div class='carousel-caption'>"
                            . "<div class='row renglon'>"
                            . "<div class='row' id='carousel_comics'>"
                                . "<div align='center' class='cuadro3 col-xs-12 col-sm-6 col-md-3 col-lg-3' id='$cat_comic_unique_id'>"
                                    . "<a href='$hrefDetalle' id='cat_detalle'>"
                                    . "<div class='image'>"
                                        . "<img id='cat_imagen' src=$cat_comic_imagen_mini style='max-width: 100%;max-height: 100%' class='img-rounded img-responsive'>";
                                    
                                    
            }
            else{
                $codigohtml = "<div align='center' class='cuadro3 col-xs-12 col-sm-6 col-md-3 col-lg-3' id='$cat_comic_unique_id'>"
                                . "<a href='$hrefDetalle' id='cat_detalle'>"
                                . "<div class='image'>"
                                    . "<img id='cat_imagen' src=$cat_comic_imagen_mini style='max-width: 100%;max-height: 100%' class='img-rounded img-responsive'>";
                                
            }
        }

        if (is_null($inventario_paquete)) {
            $codigohtml = $codigohtml ."<h5 class='textoimg col-xs-12'>" . $comic_personaje . "<br>"
                                            . "<titulo>" . $comic_titulo . " " . "#" . $comic_numero . "</titulo><br>"
                                            . "<idioma>" . $comic_idioma . "</idioma><br>"
                                            . "<precio>$$comic_precio<small> MXN</small></precio>"
                                      ."</h5>"
                                    . "</div>"
                                . "</a>"
                            . "</div>";
        } else { //HTML para PAQUETES
            //FUNCION QUE OBTIENE EL NOMBRE DEL PAQUETE
            $nombrePaquete = obtenerNombrePaquete($inventario_paquete);
            $precio_paquete = obtenerPrecioPaquete($inventario_paquete);
            $codigohtml = $codigohtml . "<h5 class='paquete col-xs-12'>PAQUETE<br><titulo>$nombrePaquete</titulo><br><idioma>$comic_idioma</idioma><br><precio>$$precio_paquete<small> MXN</small></precio></h5></div></a></div>";
        }
        echo $codigohtml;

        if ($contador <= 0) {
            echo "</div></div></div></div>";
            $contador = 3;
        } else {
            $contador--;
        }
    }//TERMINA FOR     


    echo "
           </div>
              <a class='left carousel-control' href='#carousel-comics-dealer' data-slide='prev'>
                <span class='glyphicon glyphicon-chevron-left'></span>
              </a>
              <a class='right carousel-control' href='#carousel-comics-dealer' data-slide='next'>
                <span class='glyphicon glyphicon-chevron-right'></span>
              </a>
            </div>  
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
            WHERE inventario_activo = 1
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
