<?php

//"Do you think that flattery will keep you alive?" - Smaug

if (isset($_POST['inventario'])) {
  session_start();
  obtenerInventario();
}

function cargarCatalogo($arrayComics, $rowid, $layout) {
  $inventarioArray = array();

  $campos = array("inventario_id",
      "cat_comic_titulo",
      "cat_comic_descripcion",
      "cat_comic_personaje",
      "cat_comic_numero_ejemplar",
      "cat_comic_imagen_url",
      "inventario_precio_salida",
      "cat_comic_idioma",
      "inventario_paquete"
  );

  echo "<div class='row' id='$rowid'>";

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

    if ($comic_idioma == "ing") {
      $comic_idioma = "Inglés";
    } else {
      $comic_idioma = "Español";
    }
    $inventarioArray[] = $inventario_id;
    
    if(is_null($inventario_paquete)){
        $hrefDetalle = "/html/Detalle.php?comic_id=$inventario_id";
        
    }
    else{
        $hrefDetalle = "/html/Detalle.php?comic_id=$inventario_id&paquete_id=$inventario_paquete";
    }
    
    //AQUI INICIA EL HTML DE CADA ELEMENTO DEL CATALOGO

    if ($layout == 0) {

            //LA VARIABLE $layout determina el HTML que se cargara para mostrar los elementos en
            //AQUI INICIA LO NUEVO PARA CARGAR LOS COMICS LEL
            $codigohtml = "<div align='center' class='cuadro col-xs-12 col-sm-6 col-md-3 col-lg-3' id='$inventario_id'>
                           <a target='blank' href='$hrefDetalle' id='cat_detalle'>"
                            . "<div class='image'>"
                                . "<img id='cat_imagen' src=$comic_imagen style='max-width: 100%;max-height: 100%' class='img-rounded img-responsive'>";

            if (is_null($inventario_paquete)) {
                $codigohtml = $codigohtml . "<h5 class='textoimg col-xs-12'>" . $comic_personaje . "<br><titulo>" . $comic_titulo . " " . "#" . $comic_numero . "</titulo><br><idioma>" . $comic_idioma . "</idioma><br><precio>" . $comic_precio . "<small> MXN</small></precio></h5></div></a>";
            } 
            else { //HTML para PAQUETES
                //FUNCION QUE OBTIENE EL NOMBRE DEL PAQUETE
                $nombrePaquete = obtenerNombrePaquete($inventario_paquete);
                $codigohtml = $codigohtml . "<h5 class='paquete col-xs-12'>PAQUETE<br><titulo>$nombrePaquete</titulo><br><idioma>$comic_idioma</idioma><br><precio>" . $comic_precio . "<small> MXN</small></precio></h5></div></a>";
            }

            if (isset($_SESSION['usuario_email']) && isset($_SESSION['usuario_nombre'])) {
                $codigohtml = $codigohtml . "<div id='boton_comprar'></div>
                                             <div id='boton_eliminar'></div>
                                            </div>";
            } else {
                $codigohtml = $codigohtml . "<div id='boton_comprar'>
                    <button class='btn btn-success btn-comprar btn-sm btn-block' role='button'>
                        AGREGAR <span class='glyphicon glyphicon-shopping-cart'></span>
                    </button>
                  </div>
                </div>";
            }
            echo $codigohtml;
        } 
    else {
            $codigohtml = "<div align='center' class='cuadro col-xs-12 col-sm-6 col-md-3 col-lg-3' id='$inventario_id'>
                           <a target='blank' href='$hrefDetalle' id='cat_detalle'>"
                            ."<div class='image'>"
                                . "<img id='cat_imagen' src=$comic_imagen style='max-width: 100%;max-height: 100%' class='img-rounded img-responsive'>";
            if (is_null($inventario_paquete)) {
                $codigohtml = $codigohtml . "<h5 class='textoimg col-xs-12'>" . $comic_personaje . "<br><titulo>" . $comic_titulo . " " . "#" . $comic_numero . "</titulo><br><idioma>" . $comic_idioma . "</idioma><br><precio>" . $comic_precio . "<small> MXN</small></precio></h5></div></a></div>";
            } 
            else { //HTML para PAQUETES
                $nombrePaquete = obtenerNombrePaquete($inventario_paquete);
                $codigohtml = $codigohtml . "<h5 class='paquete col-xs-12'>PAQUETE<br><titulo>$nombrePaquete</titulo><br><idioma>$comic_idioma</idioma><br><precio>" . $comic_precio . "<small> MXN</small></precio></h5></div></a></div>";
            }
            echo $codigohtml;
        }
}
  echo "</div>";
  return $inventarioArray;
  
}

function consulta_catalogo($camposArray, $salto, $rango, $compania_id, $idioma, $personaje_id) {
//FUNCION QUE GENERA LA CONSULTA EN LA BASE PARA LLENAR EL CATALOGO
//Parametros:
//$camposArray = Arreglo de strings con los nombres de los campos que queremos obtener
//$salto = Registro a partir del cual se obtendran los resultados
//$rango = Numero de resultados regresados

  $catalogoArray = array();
  $rowArray = array();

  $queryCatalogoComics = generaQueryGeneral();

  if ($idioma == 0 && $compania_id == 0 && $personaje_id == 0) {
    $queryCatalogoComicsCondicion = "
            WHERE
                cat_comic_activo = 1 AND cat_comic_copias > 0 AND inventario_existente = 1 AND inventario_activo = 1 ORDER BY inventario_fecha_entrada DESC
            LIMIT $salto, $rango";
  } else {
    $queryCatalogoComicsCondicion = generaQueryPorIdioma($idioma, $compania_id, $salto, $rango, $personaje_id);
  }

  //echo $queryCatalogoComics . $queryCatalogoComicsCondicion;

  $queryResultado = mysql_query($queryCatalogoComics . $queryCatalogoComicsCondicion);

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

function consulta_especifica($busqueda, $parametro_busqueda, $camposArray, $salto, $rango) {
  //$queryGeneral = generaQueryGeneral2();
    $queryGeneral = generaQueryGeneral();

  switch ($busqueda) {
    //Personaje
    case 1:
      //$query = $queryGeneral . " WHERE cat_comic_personaje LIKE '%" . $parametro_busqueda . "%' LIMIT $salto, $rango;";
      $query = $queryGeneral . " WHERE personaje_nombre LIKE '%" . $parametro_busqueda . "%' LIMIT $salto, $rango;";
      $queryResultado = mysql_query($query);

      //echo $query;
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
      break;
      
    case 2:
      $query = $queryGeneral . " WHERE datos_comic_titulo LIKE '%" . $parametro_busqueda . "%' LIMIT $salto, $rango;";
      $queryResultado = mysql_query($query);

      //echo $query;
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

      break;
    case 3:
      $query = $queryGeneral . " WHERE datos_comic_descripcion LIKE '%" . $parametro_busqueda . "%' LIMIT $salto, $rango;";
      $queryResultado = mysql_query($query);

      //echo $query;
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

      break;

    default:
      break;
  }
}

function generaQueryGeneral() {

    $queryCatalogoComics = "SELECT 
        inventario_id,
        (SELECT datos_comic_titulo FROM datos_comics WHERE datos_comic_id = cat_comic_descripcion_id) as cat_comic_titulo,
        (SELECT datos_comic_descripcion FROM datos_comics WHERE datos_comic_id = cat_comic_descripcion_id) as cat_comic_descripcion,
        (SELECT personaje_nombre FROM personajes WHERE personaje_id = cat_comic_personaje_id) as cat_comic_personaje,
        cat_comic_numero_ejemplar,
        cat_comic_imagen_url,
        inventario_precio_salida,
        cat_comic_idioma,
        inventario_paquete
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
            HAVING INV.inventario_paquete != 0) AS LEL";

    return $queryCatalogoComics;
}

function generaQueryPorIdioma($idioma, $compania_id, $salto, $rango, $personaje_id) {
  switch ($idioma) {
    //1 PARA INGLES
    case 1:
      $query = "
                WHERE
                    cat_comic_activo = 1 
                    AND cat_comic_copias > 0 
                    AND inventario_existente = 1 
                    AND inventario_activo = 1
                    AND cat_comic_idioma = 'ing'";
      if ($compania_id == 0) {
        if ($personaje_id == 0) {
          $queryCatalogoComicsCondicion = $query . " ORDER BY inventario_fecha_entrada DESC LIMIT $salto, $rango";
        } else {
          $queryCatalogoComicsCondicion = $query .
                  " AND cat_comic_personaje_id = $personaje_id ORDER BY inventario_fecha_entrada DESC
                    LIMIT $salto, $rango";
        }
      } else {
        if ($personaje_id == 0) {
          $queryCatalogoComicsCondicion = $query .
                  " AND personaje_compania_id = $compania_id ORDER BY inventario_fecha_entrada DESC
                    LIMIT $salto, $rango";
        } else {
          $queryCatalogoComicsCondicion = $query .
                  " AND cat_comic_personaje_id = $personaje_id AND personaje_compania_id = $compania_id ORDER BY inventario_fecha_entrada DESC
                    LIMIT $salto, $rango";
        }
      }
      break;
    //2 PARA ESPAÑOL LATINO DE SANGRE CALIENTE
    case 2:
      $query = "
                WHERE
                    cat_comic_activo = 1 
                    AND cat_comic_copias > 0 
                    AND inventario_existente = 1 
                    AND inventario_activo = 1
                    AND cat_comic_idioma = 'esp'";
      if ($compania_id == 0) {
        if ($personaje_id == 0) {
          $queryCatalogoComicsCondicion = $query . " ORDER BY inventario_fecha_entrada DESC LIMIT $salto, $rango";
        } else {
          $queryCatalogoComicsCondicion = $query .
                  " AND cat_comic_personaje_id = $personaje_id ORDER BY inventario_fecha_entrada DESC
                    LIMIT $salto, $rango";
        }
      } else {
        if ($personaje_id == 0) {
          $queryCatalogoComicsCondicion = $query .
                  " AND personaje_compania_id = $compania_id ORDER BY inventario_fecha_entrada DESC
                    LIMIT $salto, $rango";
        } else {
          $queryCatalogoComicsCondicion = $query .
                  " AND cat_comic_personaje_id = $personaje_id AND personaje_compania_id = $compania_id ORDER BY inventario_fecha_entrada DESC
                    LIMIT $salto, $rango";
        }
      }
      break;
    default:
      $query = "
                WHERE
                    cat_comic_activo = 1 
                    AND cat_comic_copias > 0 
                    AND inventario_existente = 1 
                    AND inventario_activo = 1";
      if ($compania_id == 0) {
        if ($personaje_id == 0) {
          $queryCatalogoComicsCondicion = $query . " ORDER BY inventario_fecha_entrada DESC LIMIT $salto, $rango";
        } else {
          $queryCatalogoComicsCondicion = $query .
                  " AND cat_comic_personaje_id = $personaje_id ORDER BY inventario_fecha_entrada DESC
                    LIMIT $salto, $rango";
        }
      } else {
        if ($personaje_id == 0) {
          $queryCatalogoComicsCondicion = $query .
                  " AND personaje_compania_id = $compania_id ORDER BY inventario_fecha_entrada DESC
                    LIMIT $salto, $rango";
        } else {
          $queryCatalogoComicsCondicion = $query .
                  " AND cat_comic_personaje_id = $personaje_id AND personaje_compania_id = $compania_id ORDER BY inventario_fecha_entrada DESC
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
    if ($pagina_paginacion + 16 <= obtenerTotalComicsPaginacion($compania_id, $idioma, $personaje_id)) {
      $siguiente = $pagina_paginacion + 16;
      echo "<ul class='pager'>
                    <li id='siguiente'><a href='./Catalogo.php?pagina=$siguiente&compania_id=$compania_id&idioma=$idioma&personaje_id=$personaje_id'>Siguiente</a></li>
                  </ul>";
    }
  } else {
    if ($pagina_paginacion + 16 >= obtenerTotalComicsPaginacion($compania_id, $idioma, $personaje_id)) {
      $anterior = $pagina_paginacion - 16;
      echo "<ul class='pager'>
                    <li id='anterior'><a href='./Catalogo.php?pagina=$anterior&compania_id=$compania_id&idioma=$idioma&personaje_id=$personaje_id'>Anterior</a></li>
                  </ul>";
    } else {
      $siguiente = $pagina_paginacion + 16;
      $anterior = $pagina_paginacion - 16;
      echo "<ul class='pager'>
                    <li id='anterior'><a href='./Catalogo.php?pagina=$anterior&compania_id=$compania_id&idioma=$idioma&personaje_id=$personaje_id'>Anterior</a>
                    <li id='siguiente'><a href='./Catalogo.php?pagina=$siguiente&compania_id=$compania_id&idioma=$idioma&personaje_id=$personaje_id'>Siguiente</a></li>
                 </ul>";
    }
  }
}

function paginacionBusqueda($pagina_paginacion, $busqueda, $parametro_busqueda) {
  if ($pagina_paginacion == 0) {
    if ($pagina_paginacion + 16 <= obtenerTotalComicsBusqueda($busqueda, $parametro_busqueda)) {
      $siguiente = $pagina_paginacion + 16;
      echo "<ul class='pager'>
                    <li id='siguiente'><a href='./Catalogo.php?pagina=$siguiente&busqueda=$busqueda&parametro_busqueda=$parametro_busqueda'>Siguiente</a></li>
                  </ul>";
    }
  } else {
    if ($pagina_paginacion + 16 >= obtenerTotalComicsBusqueda($busqueda, $parametro_busqueda)) {
      $anterior = $pagina_paginacion - 16;
      echo "<ul class='pager'>
                    <li id='anterior'><a href='./Catalogo.php?pagina=$anterior&busqueda=$busqueda&parametro_busqueda=$parametro_busqueda'>Anterior</a></li>
                  </ul>";
    } else {
      $siguiente = $pagina_paginacion + 16;
      $anterior = $pagina_paginacion - 16;
      echo "<ul class='pager'>
                    <li id='anterior'><a href='./Catalogo.php?pagina=$anterior&busqueda=$busqueda&parametro_busqueda=$parametro_busqueda'>Anterior</a>
                    <li id='siguiente'><a href='./Catalogo.php?pagina=$siguiente&busqueda=$busqueda&parametro_busqueda=$parametro_busqueda'>Siguiente</a></li>
                 </ul>";
    }
  }
}

function obtenerTotalComicsBusqueda($busqueda, $parametro_busqueda) {
  $queryGeneral = generaQueryGeneral();

  switch ($busqueda) {
    //Personaje
    case 1:
      $query = $queryGeneral . " WHERE personaje_nombre LIKE '%" . $parametro_busqueda . "%'";
      $queryResultado = mysql_query($query);
      //echo $query;
      $num = mysql_num_rows($queryResultado);
      return $num;
      break;
    case 2:
      $query = $queryGeneral . " WHERE datos_comic_titulo LIKE '%" . $parametro_busqueda . "%'";
      $queryResultado = mysql_query($query);
      //echo $query;
      $num = mysql_num_rows($queryResultado);
      return $num;
      break;
    case 3:
      $query = $queryGeneral . " WHERE datos_comic_descripcion LIKE '%" . $parametro_busqueda . "%'";
      $queryResultado = mysql_query($query);
      //echo $query;
      $num = mysql_num_rows($queryResultado);
      return $num;
      break;

    default:
      break;
  }
}

function obtenerTotalComicsPaginacion($compania_id, $idioma, $personaje_id) {
  $queryCatalogoComics = "
        SELECT INV.inventario_id FROM inventario AS INV
            INNER JOIN cat_comics AS CAT ON CAT.cat_comic_unique_id = INV.inventario_cat_comic_unique_id
            INNER JOIN datos_comics AS DAT ON CAT.cat_comic_personaje_id = DAT.datos_comic_personaje_id
            INNER JOIN personajes AS PERS ON PERS.personaje_id = DAT.datos_comic_personaje_id
            INNER JOIN companias AS COM ON PERS.personaje_compania_id = COM.compania_id";
  if ($idioma == 0 && $compania_id == 0 && $personaje_id == 0) {
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
          if ($personaje_id == 0) {
            $queryCatalogoComicsCondicion = $query . " GROUP BY inventario_id";
          } else {
            $queryCatalogoComicsCondicion = $query . " AND PERS.personaje_id = $personaje_id GROUP BY inventario_id";
          }
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
          if ($personaje_id == 0) {
            $queryCatalogoComicsCondicion = $query . " GROUP BY inventario_id";
          } else {
            $queryCatalogoComicsCondicion = $query . " AND PERS.personaje_id = $personaje_id GROUP BY inventario_id";
          }
        } else {
          $queryCatalogoComicsCondicion = $query . " AND PERS.personaje_compania_id = $compania_id GROUP BY inventario_id";
        }
        break;
      default:
        $query = "
                WHERE
                    CAT.cat_comic_activo = 1 
                    AND CAT.cat_comic_copias > 0 
                    AND INV.inventario_existente = 1 
                    AND INV.inventario_activo = 1";
        if ($compania_id == 0) {
          if ($personaje_id == 0) {
            $queryCatalogoComicsCondicion = $query . " GROUP BY inventario_id";
          } else {
            $queryCatalogoComicsCondicion = $query . " AND PERS.personaje_id = $personaje_id GROUP BY inventario_id";
          }
        } else {
          if ($personaje_id == 0) {
            $queryCatalogoComicsCondicion = $query . " AND PERS.personaje_compania_id = $compania_id GROUP BY inventario_id";
          } else {
            $queryCatalogoComicsCondicion = $query . " AND PERS.personaje_id = $personaje_id AND PERS.personaje_compania_id = $compania_id  GROUP BY inventario_id";
          }
        }
        break;
    }
  }

  //echo "$queryCatalogoComics" . "$queryCatalogoComicsCondicion";

  $queryResultado = mysql_query("$queryCatalogoComics" . "$queryCatalogoComicsCondicion");

  $num = mysql_num_rows($queryResultado);
  if ($num >= 0) {
    $total = $num;
  }
  return $total;
}

function generaCategorias($idioma, $compania_id) {
  if ($compania_id == 0) {
    $queryCompanias = "SELECT * FROM companias WHERE compania_activo=1";
    $queryResultado = mysql_query($queryCompanias);
    $num = mysql_num_rows($queryResultado);
    for ($i = 0; $i < $num; $i++) {
      $compania_id_categoria = mysql_result($queryResultado, $i, "compania_id");
      $compania_nombre_categoria = mysql_result($queryResultado, $i, "compania_nombre");
      //echo "COMPAÑIA: ".$compania_nombre_categoria;
      echo "<div class='sidebar-module'>
                  <h4>$compania_nombre_categoria</h4>
                  <ol class='list-unstyled' id='$compania_nombre_categoria'>";
      $categorias = cargarCategorias($idioma, $compania_id_categoria);
      for ($j = 0; $j < count($categorias); $j++) {
        //echo $categorias[$j];
        $cat = $categorias[$j];
        echo "
                    <li><a href='./Catalogo.php?idioma=$idioma&compania_id=$compania_id&personaje_id=$cat[personaje_id]'>$cat[personaje_nombre]</a></li>";
      }
      echo "</ol>
                </div>";
    }
  } else {
    $queryCompanias = "SELECT * FROM companias WHERE compania_activo=1 AND compania_id=$compania_id";
    $queryResultado = mysql_query($queryCompanias);
    $num = mysql_num_rows($queryResultado);
    for ($i = 0; $i < $num; $i++) {
      $compania_id_categoria = mysql_result($queryResultado, $i, "compania_id");
      $compania_nombre_categoria = mysql_result($queryResultado, $i, "compania_nombre");
      //echo "COMPAÑIA: ".$compania_nombre_categoria;
      echo "<div class='sidebar-module'>
                  <h4>$compania_nombre_categoria</h4>
                  <ol class='list-unstyled' id='$compania_nombre_categoria'>";
      $categorias = cargarCategorias($idioma, $compania_id_categoria);
      for ($j = 0; $j < count($categorias); $j++) {
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

function cargarCategorias($idioma, $compania_id) {
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
          $queryCategoriasCondicion = $query . " GROUP BY PERS.personaje_id";
        } else {
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
        if ($compania_id == 0 && $personaje_id == 0) {
          $queryCategoriasCondicion = $query . " GROUP BY PERS.personaje_id";
        } else {
          $queryCategoriasCondicion = $query .
                  " AND PERS.personaje_compania_id = $compania_id GROUP BY PERS.personaje_id";
        }
        break;
    }
  }
  $queryResultado = mysql_query($queryCategorias . $queryCategoriasCondicion);

  //echo $queryCategorias.$queryCategoriasCondicion." ORDER BY 1";
  $num = mysql_num_rows($queryResultado);

  if ($num > 0) {
    for ($i = 0; $i < $num; $i++) {
      $categoria[] = array("personaje_nombre" => obtenerResultado2("personaje_nombre", $i, $queryResultado),
          "personaje_id" => obtenerResultado2("personaje_id", $i, $queryResultado)
      );
    }
  }

  return $categoria;
}

function obtenerNombrePaquete($paquete_id){
    $query = "SELECT cat_paquete_descripcion FROM cat_paquetes WHERE cat_paquete_id = $paquete_id";
    $queryResultado = mysql_query($query);
    
    return mysql_result($queryResultado, 0, "cat_paquete_descripcion");
}
