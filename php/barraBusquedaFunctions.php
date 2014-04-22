<?php

function cargarBarraBusqueda(){
    
  echo "<nav class='navbar navbar-default' style='margin-bottom: auto;'>
  <div class='row'>
    <div class='col-md-12'>
      <form role='search'>
        <div class='input-group'>
          <input type='search' class='form-control input-sm' placeholder='Busqueda específica'>
          <div class='input-group-btn'>
            <button type='button' class='btn btn-default dropdown-toggle btn-sm' data-toggle='dropdown'>Buscar <span class='caret'></span></button>
            <ul class='dropdown-menu pull-right' role='menu'>
              <li><a href='#'>Personaje</a></li>
              <li><a href='#'>Título</a></li>
              <li><a href='#'>Descripción</a></li>
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
      <ul class='nav navbar-nav'>
        <li class='dropdown'>
          <a href='#' class='dropdown-toggle' data-toggle='dropdown'>DC <b class='caret'></b></a>
          <ul class='dropdown-menu' role='menu'>
            <li><a href='#'>Inglés</a></li>
            <li><a href='#'>Español</a></li>
            <li class='divider'></li>
            <li><a href='#'>Todos</a></li>
          </ul>
        </li>
        <li class='dropdown'>
          <a href='#' class='dropdown-toggle' data-toggle='dropdown'>Marvel <b class='caret'></b></a>
          <ul class='dropdown-menu' role='menu'>
            <li><a href='#'>Inglés</a></li>
            <li><a href='#'>Español</a></li>
            <li class='divider'></li>
            <li><a href='#'>Todos</a></li>
          </ul>
        </li>
        <li class='dropdown'>
          <a href='#' class='dropdown-toggle' data-toggle='dropdown'>Image <b class='caret'></b></a>
          <ul class='dropdown-menu' role='menu'>
            <li><a href='#'>Inglés</a></li>
            <li><a href='#'>Español</a></li>
            <li class='divider'></li>
            <li><a href='#'>Todos</a></li>
          </ul>
        </li>
        <li class='dropdown'>
          <a href='#' class='dropdown-toggle' data-toggle='dropdown'>Dark Horse <b class='caret'></b></a>
          <ul class='dropdown-menu' role='menu'>
            <li><a href='#'>Inglés</a></li>
            <li><a href='#'>Español</a></li>
            <li class='divider'></li>
            <li><a href='#'>Todos</a></li>
          </ul>
        </li>
        <li class='dropdown'>
          <a href='#' class='dropdown-toggle' data-toggle='dropdown'>Kamite <b class='caret'></b></a>
          <ul class='dropdown-menu' role='menu'>
            <li><a href='#'>Inglés</a></li>
            <li><a href='#'>Español</a></li>
            <li class='divider'></li>
            <li><a href='#'>Todos</a></li>
          </ul>
        </li>
        <li class='dropdown'>
          <a href='#' class='dropdown-toggle' data-toggle='dropdown'>Vertigo <b class='caret'></b></a>
          <ul class='dropdown-menu' role='menu'>
            <li><a href='#'>Inglés</a></li>
            <li><a href='#'>Español</a></li>
            <li class='divider'></li>
            <li><a href='#'>Todos</a></li>
          </ul>
        </li>
        <li class='dropdown'>
          <a href='#' class='dropdown-toggle' data-toggle='dropdown'>Otras <b class='caret'></b></a>
          <ul class='dropdown-menu' role='menu'>
            <li><a href='#'>Bruguera</a></li>
            <li><a href='#'>IWD</a></li>
          </ul>
        </li>
        <li class='dropdown'>
          <a href='#' class='dropdown-toggle' data-toggle='dropdown'>Idioma <b class='caret'></b></a>
          <ul class='dropdown-menu' role='menu'>
            <li><a href='#'>Inglés</a></li>
            <li><a href='#'>Español</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div>
</nav>";
}

