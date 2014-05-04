<?php


function cargarBarraBusqueda(){
  
  $queryCompanias = "SELECT * FROM companias WHERE compania_activo=1";
  $queryResultado = mysql_query($queryCompanias);
  $num = mysql_num_rows($queryResultado);
  
  if($num > 0 ){
      cargarCodigoInicialBarra();
      for ($i = 0; $i < $num; $i++){
          $compania_id = mysql_result($queryResultado, $i, "compania_id");
          $compania_nombre = mysql_result($queryResultado, $i, "compania_nombre");
          
          echo "<li class='dropdown'>
                    <a href='#' class='dropdown-toggle' data-toggle='dropdown'>$compania_nombre <b class='caret'></b></a>
                    <ul class='dropdown-menu' role='menu'>
                        <li><a href='../html/Catalogo.php?compania_id=$compania_id&idioma=1'>Inglés</a></li>
                        <li><a href='../html/Catalogo.php?compania_id=$compania_id&idioma=2'>Español</a></li>
                        <li class='divider'></li>
                        <li><a href='../html/Catalogo.php?compania_id=$compania_id'>Todos</a></li>
                    </ul>
                </li>";
      }
      echo "</ul>
         </div><!-- /.navbar-collapse -->
        </div>
       </nav>";
  }
    
 
  
    
}

function cargarCodigoInicialBarra(){
    echo "<nav class='navbar navbar-default' style='margin-bottom: auto;background-color: #d2322d;border-color: #ac2925;'>
  <div class='row'>
    <div class='col-md-12'>
      <form role='search'>
        <div class='input-group'>
          <input type='search' class='form-control input-sm' placeholder='Busqueda específica' id='txtBusqueda'>
          <div class='input-group-btn'>
            <button type='button' class='btn btn-default dropdown-toggle btn-sm' data-toggle='dropdown'>Buscar <span class='caret'></span></button>
            <ul class='dropdown-menu pull-right' role='menu'>
              <li id='busqueda_personaje'><a>Personaje</a></li>
              <li id='busqueda_titulo'><a>Título</a></li>
              <li id='busqueda_descripcion'><a>Descripción</a></li>
              <li><a href='#'>Con el texto</a></li>
            </ul>
          </div>
        </div>
      </form>
    </div>
  </div>
  <!-- We use the fluid option here to avoid overriding the fixed width of a normal container within the narrow content columns. -->
  <div class='container-fluid'>
    <div class='navbar-header'>
      <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='#busqueda'>
        <span class='sr-only'>Toggle navigation</span>
        <span class='icon-bar'></span>
        <span class='icon-bar'></span>
        <span class='icon-bar'></span>
      </button>
      
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class='collapse navbar-collapse' id='busqueda'>
      <ul class='nav navbar-nav'>";
}
   
