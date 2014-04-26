<?php

if (isset($_POST['inventario'])) {
    session_start();
    obtenerInventario();
}

function cargarCatalogo($pagina_catalogo, $renglones_catalogo, $compania_id, $idioma, $numero_resultados,$personaje_id) {

//FUNCION QUE CARGA EL HTML PARA EL CATALOGO SE ENCUENTRA EN: /php/catalogoFunctions.php
//Parametros: 
//$pagina = Registro en la base a partir del cual queremos que empiece el catalogo
//$renglones = Numero de renglones que queremos mostrar por pagina, en este caso 4
    $inventarioArray = array();

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

    for ($i = 0; $i < $renglones_catalogo; $i++) {
        $arrayComics = consulta_catalogo($campos, $contador, $numero_resultados, $compania_id, $idioma, $personaje_id);

        echo "<div class='row' id='$i'>";
        for ($j = 0; $j < count($arrayComics); $j++) {
            $arrayComic2 = $arrayComics[$j];

            $inventario_id = $arrayComic2[$campos[0]];
            $comic_titulo = $arrayComic2[$campos[1]];
            $comic_descripcion = substr($arrayComic2[$campos[2]], 0, 90);
            $comic_personaje = $arrayComic2[$campos[3]];
            $comic_numero = $arrayComic2[$campos[4]];
            $comic_imagen = $arrayComic2[$campos[5]];
            $comic_precio = $arrayComic2[$campos[6]];
            $comic_idioma = $arrayComic2[$campos[7]];
            if ($comic_idioma == "ing") {
                $comic_idioma = "Inglés";
            } else {
                $comic_idioma = "Español";
            }

            $inventarioArray[] = $inventario_id;


            //AQUI INICIA EL HTML DE CADA ELEMENTO DEL CATALOGO

            echo "<div align='center' class='cuadro col-xs-12 col-sm-4 col-md-4 col-lg-4' id='$inventario_id'>

                                        <a href='/html/Detalle.php?comic_id=$inventario_id' id='cat_detalle'>
                                            <img id='cat_imagen' src=$comic_imagen style='max-width: 60%;' class='img-rounded img-responsive' alt='$comic_titulo'>
                                        </a>
                                        <h4 id='cat_personaje'>$comic_personaje<small> $comic_idioma</small></h4>
                                        <a id='cat_detalle2' href='/html/Detalle.php?comic_id=$inventario_id'><h5><span id='cat_titulo' class='label label-primary'>" . $comic_titulo . " #" . $comic_numero . "</span></h5></a>
                                        <p id='cat_descripcion' class='catal' style='font-size: 10pt'>" . $comic_descripcion . " ...</p>
                                        <div class='row'>
                                            <div class='col-sm-12 col-xs-12'>
                                                <h4 id='cat_precio_venta'>$ " . $comic_precio . "<small> MXN</small></h4>
                                            </div>";

            if (isset($_SESSION['usuario_email']) && isset($_SESSION['usuario_nombre'])) {
                echo "<div class='col-sm-12 col-xs-12' id='boton_comprar'></div>
                                        <div id='boton_eliminar'></div>
                                        <p></p>
                                    </div></div>";
            } else {
                echo "<div class='col-sm-12 col-xs-12' id='boton_comprar'><button class='btn btn-success btn-comprar' role='button'>Comprar</button></div>
                                        
                                        <p></p>
                                    </div></div>";
            }
        }
        echo "</div>";
        $contador+=3;
    }
    $_SESSION['inventario'] = $inventarioArray;
}

function consulta_catalogo($camposArray, $salto, $rango, $compania_id, $idioma, $personaje_id) {
//FUNCION QUE GENERA LA CONSULTA EN LA BASE PARA LLENAR EL CATALOGO
//Parametros:
//$camposArray = Arreglo de strings con los nombres de los campos que queremos obtener
//$salto = Registro a partir del cual se obtendran los resultados
//$rango = Numero de resultados regresados

    $catalogoArray = array();
    $rowArray = array();

    $queryCatalogoComics = "SELECT 
    INV.inventario_id,
    (SELECT datos_comic_titulo FROM datos_comics WHERE datos_comic_id = CATALOGO.cat_comic_descripcion_id) as cat_comic_titulo,
    (SELECT datos_comic_descripcion FROM datos_comics WHERE datos_comic_id = CATALOGO.cat_comic_descripcion_id) as cat_comic_descripcion,
    (SELECT personaje_nombre FROM personajes WHERE personaje_id = CATALOGO.cat_comic_personaje_id) as cat_comic_personaje,
    CATALOGO.cat_comic_numero_ejemplar,
    CATALOGO.cat_comic_imagen_url,
    INV.inventario_precio_salida,
    CATALOGO.cat_comic_idioma,
    PERS.personaje_compania_id
    FROM cat_comics as CATALOGO
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
    GROUP BY inventario_cat_comic_unique_id 
    ) AS INV ON INV.inventario_cat_comic_unique_id = CATALOGO.cat_comic_unique_id
    
    INNER JOIN personajes as PERS ON CATALOGO.cat_comic_personaje_id = PERS.personaje_id ";

    if ($idioma == 0 && $compania_id == 0 && $personaje_id == 0) {
        $queryCatalogoComicsCondicion = "
            WHERE
                CATALOGO.cat_comic_activo = 1 AND CATALOGO.cat_comic_copias > 0 AND INV.inventario_existente = 1 AND INV.inventario_activo = 1 ORDER BY INV.inventario_fecha_entrada DESC
            LIMIT $salto, $rango";
    } 
    else {
        $queryCatalogoComicsCondicion = generaQueryPorIdioma($idioma, $compania_id, $salto, $rango, $personaje_id);
    }

    //echo $queryCatalogoComics . $queryCatalogoComicsCondicion;

    $queryResultado = mysql_query($queryCatalogoComics.$queryCatalogoComicsCondicion);

    $num = mysql_num_rows($queryResultado);
    if ($num > 0) {
        for ($i = 0; $i < $num; $i++) {
            $rowArray = array();
            for ($j = 0; $j < count($camposArray); $j++) {
               
                $rowArray[$camposArray[$j]] = obtenerResultado2($camposArray[$j], $i, $queryResultado);
               
            }
            $catalogoArray[] = $rowArray;
        }
    } else {
        $catalogoArray = array();
    }
    return $catalogoArray;
}

function generaQueryPorIdioma($idioma, $compania_id, $salto, $rango, $personaje_id) {
    switch ($idioma) {
        //1 PARA INGLES
        case 1:
            $query = "
                WHERE
                    CATALOGO.cat_comic_activo = 1 
                    AND CATALOGO.cat_comic_copias > 0 
                    AND INV.inventario_existente = 1 
                    AND INV.inventario_activo = 1
                    AND CATALOGO.cat_comic_idioma = 'ing'";
            if ($compania_id == 0 ) {
                if($personaje_id == 0){
                    $queryCatalogoComicsCondicion = $query . " ORDER BY INV.inventario_fecha_entrada DESC LIMIT $salto, $rango";
                }
                else{
                    $queryCatalogoComicsCondicion = $query . 
                        " AND PERS.personaje_id = $personaje_id ORDER BY INV.inventario_fecha_entrada DESC
                    LIMIT $salto, $rango";
                }
            } 
            else {
                if($personaje_id == 0){
                    $queryCatalogoComicsCondicion = $query . 
                        " AND PERS.personaje_compania_id = $compania_id ORDER BY INV.inventario_fecha_entrada DESC
                    LIMIT $salto, $rango";
                }
                else{
                $queryCatalogoComicsCondicion = $query . 
                        " AND PERS.personaje_id = $personaje_id AND PERS.personaje_compania_id = $compania_id ORDER BY INV.inventario_fecha_entrada DESC
                    LIMIT $salto, $rango";
                }
            }
            break;
        //2 PARA ESPAÑOL LATINO DE SANGRE CALIENTE
        case 2:
            $query = "
                WHERE
                    CATALOGO.cat_comic_activo = 1 
                    AND CATALOGO.cat_comic_copias > 0 
                    AND INV.inventario_existente = 1 
                    AND INV.inventario_activo = 1
                    AND CATALOGO.cat_comic_idioma = 'esp'";
            if ($compania_id == 0 ) {
                if($personaje_id == 0){
                    $queryCatalogoComicsCondicion = $query . " ORDER BY INV.inventario_fecha_entrada DESC LIMIT $salto, $rango";
                }
                else{
                    $queryCatalogoComicsCondicion = $query . 
                        " AND PERS.personaje_id = $personaje_id ORDER BY INV.inventario_fecha_entrada DESC
                    LIMIT $salto, $rango";
                }
            } 
            else {
                if($personaje_id == 0){
                    $queryCatalogoComicsCondicion = $query . 
                        " AND PERS.personaje_compania_id = $compania_id ORDER BY INV.inventario_fecha_entrada DESC
                    LIMIT $salto, $rango";
                }
                else{
                $queryCatalogoComicsCondicion = $query . 
                        " AND PERS.personaje_id = $personaje_id AND PERS.personaje_compania_id = $compania_id ORDER BY INV.inventario_fecha_entrada DESC
                    LIMIT $salto, $rango";
                }
            }
            break;
        default:
            $query = "
                WHERE
                    CATALOGO.cat_comic_activo = 1 
                    AND CATALOGO.cat_comic_copias > 0 
                    AND INV.inventario_existente = 1 
                    AND INV.inventario_activo = 1";
            if ($compania_id == 0 ) {
                if($personaje_id == 0){
                    $queryCatalogoComicsCondicion = $query . " ORDER BY INV.inventario_fecha_entrada DESC LIMIT $salto, $rango";
                }
                else{
                    $queryCatalogoComicsCondicion = $query . 
                        " AND PERS.personaje_id = $personaje_id ORDER BY INV.inventario_fecha_entrada DESC
                    LIMIT $salto, $rango";
                }
            } 
            else {
                if($personaje_id == 0){
                    $queryCatalogoComicsCondicion = $query . 
                        " AND PERS.personaje_compania_id = $compania_id ORDER BY INV.inventario_fecha_entrada DESC
                    LIMIT $salto, $rango";
                }
                else{
                $queryCatalogoComicsCondicion = $query . 
                        " AND PERS.personaje_id = $personaje_id AND PERS.personaje_compania_id = $compania_id ORDER BY INV.inventario_fecha_entrada DESC
                    LIMIT $salto, $rango";
                }
            }
            break;
    }
    return $queryCatalogoComicsCondicion;
}

//FUNCION QUE OBTIENE UN RESULTADO A PARTIR DE UN QUERY
function obtenerResultado2($nombreColumna, $indice, $queryRes) {
    return mysql_result($queryRes, $indice, "$nombreColumna");
}

//FUNCION QUE OBTIENE EL TOTAL DE COMICS EN INVENTARIO ACTIVOS Y EXISTENTES
function obtenerTotalComics() {
    $queryTotal = "SELECT COUNT(*) AS total FROM inventario WHERE inventario_activo = 1 AND inventario_existente > 0";
    $queryResultado = mysql_query($queryTotal);
    return mysql_result($queryResultado, 0, "total");
}

//FUNCION QUE GENERA LOS ELEMENTOS DE PAGINACION
//Parametros:
//$pagina_paginacion = Valor a partir de cual se generara la paginacion

function obtenerInventario() {
    $json = new stdClass;
    $json->inventario = $_SESSION['inventario'];
    $json->agregados = $_SESSION['usuario_comics'];

    echo json_encode($json);
}

function paginacion($pagina_paginacion, $compania_id, $idioma, $personaje_id) {
    if ($pagina_paginacion == 0) {
        if ($pagina_paginacion + 12 <= obtenerTotalComicsPaginacion($compania_id, $idioma)) {
            $siguiente = $pagina_paginacion + 12;
            echo "<ul class='pager'>
                    <li id='siguiente'><a href='./Catalogo.php?pagina=$siguiente&compania_id=$compania_id&idioma=$idioma&personaje_id=$personaje_id'>Siguiente</a></li>
                  </ul>";
        }
    } else {
        if ($pagina_paginacion + 12 >= obtenerTotalComicsPaginacion($compania_id, $idioma)) {
            $anterior = $pagina_paginacion - 12;
            echo "<ul class='pager'>
                    <li id='anterior'><a href='./Catalogo.php?pagina=$anterior&compania_id=$compania_id&idioma=$idioma&personaje_id=$personaje_id'>Anterior</a></li>
                  </ul>";
        } else {
            $siguiente = $pagina_paginacion + 12;
            $anterior = $pagina_paginacion - 12;
            echo "<ul class='pager'>
                    <li id='anterior'><a href='./Catalogo.php?pagina=$anterior&compania_id=$compania_id&idioma=$idioma&personaje_id=$personaje_id'>Anterior</a>
                    <li id='siguiente'><a href='./Catalogo.php?pagina=$siguiente&compania_id=$compania_id&idioma=$idioma&personaje_id=$personaje_id'>Siguiente</a></li>
                 </ul>";
        }
    }
}

function obtenerTotalComicsPaginacion($compania_id, $idioma) {
    $queryCatalogoComics = "
        SELECT INV.inventario_id FROM inventario AS INV
            INNER JOIN cat_comics AS CAT ON CAT.cat_comic_unique_id = INV.inventario_cat_comic_unique_id
            INNER JOIN datos_comics AS DAT ON CAT.cat_comic_personaje_id = DAT.datos_comic_personaje_id
            INNER JOIN personajes AS PERS ON PERS.personaje_id = DAT.datos_comic_personaje_id
            INNER JOIN companias AS COM ON PERS.personaje_compania_id = COM.compania_id";
    if ($idioma == 0 && $compania_id == 0) {
        $queryCatalogoComicsCondicion = "
            WHERE
                CAT.cat_comic_activo = 1 
                AND CAT.cat_comic_copias > 0 
                AND INV.inventario_existente = 1 
                AND INV.inventario_activo = 1
            GROUP BY inventario_id";
    } else {
        switch ($idioma) {
            //1 PARA INGLES
            case 1:
                $query = "
                WHERE
                    CAT.cat_comic_activo = 1 
                    AND CAT.cat_comic_copias > 0 
                    AND INV.inventario_existente = 1 
                    AND INV.inventario_activo = 1
                    AND CAT.cat_comic_idioma = 'ing'";
                if ($compania_id == 0) {
                    $queryCatalogoComicsCondicion = $query . " GROUP BY inventario_id";
                } else {
                    $queryCatalogoComicsCondicion = $query . " AND PERS.personaje_compania_id = $compania_id
                    GROUP BY inventario_id";
                }
                break;
            case 2:
                $query = "
                WHERE
                    CAT.cat_comic_activo = 1 
                    AND CAT.cat_comic_copias > 0 
                    AND INV.inventario_existente = 1 
                    AND INV.inventario_activo = 1
                    AND CAT.cat_comic_idioma = 'esp'";
                if ($compania_id == 0) {
                    $queryCatalogoComicsCondicion = $query . " GROUP BY inventario_id";
                } else {
                    $queryCatalogoComicsCondicion = $query . " AND PERS.personaje_compania_id = $compania_id
                    GROUP BY inventario_id";
                }
                break;
            default:
                $queryCatalogoComicsCondicion = "
                WHERE
                    CAT.cat_comic_activo = 1 
                    AND CAT.cat_comic_copias > 0 
                    AND INV.inventario_existente = 1 
                    AND INV.inventario_activo = 1
                    AND PERS.personaje_compania_id = $compania_id
                GROUP BY inventario_id";
                break;
        }
    }
    
    //echo "$queryCatalogoComics" . "$queryCatalogoComicsCondicion";

    $queryResultado = mysql_query("$queryCatalogoComics" . "$queryCatalogoComicsCondicion");

    $num = mysql_num_rows($queryResultado);
    if ($num > 0) {
        $total = $num;
    }
    return $total;
}

function generaCategorias($idioma,$compania_id){
    if($compania_id == 0){
        $queryCompanias = "SELECT * FROM companias WHERE compania_activo=1";
        $queryResultado = mysql_query($queryCompanias);
        $num = mysql_num_rows($queryResultado);
        for($i = 0; $i<$num; $i++){
            $compania_id_categoria = mysql_result($queryResultado, $i, "compania_id");
            $compania_nombre_categoria = mysql_result($queryResultado, $i, "compania_nombre");
            //echo "COMPAÑIA: ".$compania_nombre_categoria;
            echo "<div class='sidebar-module'>
                  <h4>$compania_nombre_categoria</h4>
                  <ol class='list-unstyled' id='$compania_nombre_categoria'>";
            $categorias = cargarCategorias($idioma, $compania_id_categoria);
            for($j = 0; $j<count($categorias); $j++){
                //echo $categorias[$j];
                $cat = $categorias[$j];
                echo "
                    <li><a href='./Catalogo.php?idioma=$idioma&compania_id=$compania_id&personaje_id=$cat[personaje_id]'>$cat[personaje_nombre]</a></li>";   
            }
            echo "</ol>
                </div>";
        }
    }
    else{
        $queryCompanias = "SELECT * FROM companias WHERE compania_activo=1 AND compania_id=$compania_id";
        $queryResultado = mysql_query($queryCompanias);
        $num = mysql_num_rows($queryResultado);
        for($i = 0; $i<$num; $i++){
            $compania_id_categoria = mysql_result($queryResultado, $i, "compania_id");
            $compania_nombre_categoria = mysql_result($queryResultado, $i, "compania_nombre");
            //echo "COMPAÑIA: ".$compania_nombre_categoria;
            echo "<div class='sidebar-module'>
                  <h4>$compania_nombre_categoria</h4>
                  <ol class='list-unstyled' id='$compania_nombre_categoria'>";
            $categorias = cargarCategorias($idioma, $compania_id_categoria);
            for($j = 0; $j<count($categorias); $j++){
                //echo $categorias[$j];
                $cat = $categorias[$j];
                echo "
                    <li><a href='./Catalogo.php?idioma=$idioma&compania_id=$compania_id&personaje_id=$cat[personaje_id]'>$cat[personaje_nombre]</a></li>";   
            }
            echo "</ol>
                </div>";
        }
    }
}

function cargarCategorias($idioma,$compania_id){ 
    $queryCategorias = "
        select PERS.personaje_nombre, PERS.personaje_id from inventario as INV
        inner join cat_comics as CAT 
            ON CAT.cat_comic_unique_id = INV.inventario_cat_comic_unique_id
        inner join personajes as PERS
            ON CAT.cat_comic_personaje_id = PERS.personaje_id";
        
    if ($idioma == 0) {
        $queryCategoriasCondicion = " WHERE
                CAT.cat_comic_activo = 1 
                AND CAT.cat_comic_copias > 0 
                AND INV.inventario_existente = 1 
                AND INV.inventario_activo = 1
                AND PERS.personaje_compania_id = $compania_id GROUP BY PERS.personaje_id";
    }
    else{
        switch ($idioma) {
        //1 PARA INGLES
        case 1:
            $query = " 
                WHERE
                    CAT.cat_comic_activo = 1 
                    AND CAT.cat_comic_copias > 0 
                    AND INV.inventario_existente = 1 
                    AND INV.inventario_activo = 1
                    AND CAT.cat_comic_idioma = 'ing'";
            if ($compania_id == 0) {
                $queryCategoriasCondicion = $query." GROUP BY PERS.personaje_id";
            } 
            else {
                $queryCategoriasCondicion = $query . 
                    " AND PERS.personaje_compania_id = $compania_id GROUP BY PERS.personaje_id";
            }
            break;
        case 2:
                $query = " 
                WHERE
                    CAT.cat_comic_activo = 1 
                    AND CAT.cat_comic_copias > 0 
                    AND INV.inventario_existente = 1 
                    AND INV.inventario_activo = 1
                    AND CAT.cat_comic_idioma = 'esp'";
                if ($compania_id == 0 && $personaje_id ==0) {
                    $queryCategoriasCondicion = $query." GROUP BY PERS.personaje_id";
                } else {
                    $queryCategoriasCondicion = $query . 
                        " AND PERS.personaje_compania_id = $compania_id GROUP BY PERS.personaje_id";
                }
                break;
        }
    }
    $queryResultado = mysql_query($queryCategorias.$queryCategoriasCondicion);
    
    //echo $queryCategorias.$queryCategoriasCondicion." ORDER BY 1";
    $num = mysql_num_rows($queryResultado);
    
    if($num > 0){
        for ($i = 0; $i < $num; $i++) {
            $categoria[] = array( "personaje_nombre" => obtenerResultado2("personaje_nombre", $i, $queryResultado),
                                   "personaje_id" => obtenerResultado2("personaje_id", $i, $queryResultado)
                );
        }
    }
    
    return $categoria;
}