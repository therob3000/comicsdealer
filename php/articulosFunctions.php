<?php
    include 'fecha.php';
   
    ini_set('display_errors',1); 
    error_reporting(E_ALL);

function cargarArticuloReciente(){
    $queryArticulos = "SELECT * FROM articulos ORDER BY 3 DESC LIMIT 1";
    $queryResultado = mysql_query($queryArticulos);
    $num = mysql_num_rows($queryResultado);
    
    $articulo_id        = mysql_result($queryResultado, 0, "articulo_id");
    $articulo_autor     = mysql_result($queryResultado, 0, "articulo_autor");
    $articulo_resumen   = mysql_result($queryResultado, 0, "articulo_resumen");
    $articulo_imagen    = mysql_result($queryResultado, 0, "articulo_imagen");
    $articulo_titulo    = mysql_result($queryResultado, 0, "articulo_titulo");
    $articulo_fecha     = obtenerCadenaFecha(mysql_result($queryResultado, 0, "articulo_fecha"));
    
    echo "<div class='panel panel-default'>
        <div class='panel-body'>
          <li class='media'>
            <a id='img_href' class='pull-left' href='/html/Articulos.php?articulo_id=$articulo_id'>
              <img id='articulo_imagen' class='media-object' style='width: 100px; height: 150px;' src='$articulo_imagen' alt='...'>
            </a>
            <div class='media-body'>
              <h2 id='articulo_titulo' class='media-heading'>$articulo_titulo</h2>
              <p id='articulo_fecha_autor'>$articulo_fecha por $articulo_autor</p>
              <p id='articulo_resumen' align='justify'>$articulo_resumen</p>
              <div class='row'>
                <div class='col-md-3 col-md-offset-9' align='right'>
                  <a id='articulo_boton' type='button' href='/html/Articulos.php?articulo_id=$articulo_id' class='btn btn-primary btn-sm'>Seguir Leyendo <span class='glyphicon glyphicon-forward'></span></a>
                </div>
              </div>

            </div>
          </li>
        </div>
      </div>";
}
