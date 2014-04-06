<?php
$comic_id = $_GET['comic_id'];
?>

<!DOCTYPE html>
<html>
  <head>
    <title id="comic_title"></title><!-- Nombre del comic-->
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap -->
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link rel="shortcut icon" href="../img/ComicDico-01.png">
    <link href="/bootstrap/css/navbar.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/bootstrap/css/comicsD.css">
    <script>
      var comic_id = <?php echo json_encode($comic_id); ?>;
    </script>
    <script src="../bootstrap/assets/js/jquery.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../js/detalle_comic.js"></script>
    <script src="../js/login.js"></script>

    <style>
      .container {
        background: url(../img/avengers.jpg) no-repeat center center fixed;
        background-size: cover;
      }
    </style>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../../assets/js/html5shiv.js"></script>
      <script src="../../assets/js/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    
    <div id="nav_bar"></div>
    <div class="container">
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Bienvenido, haz login!</h4>
              </div>
              <form role="form" id="login">
                <div class="modal-body">
                  <form role="form">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Correo Electrónico</label>
                      <input type="email" class="form-control" id="email" placeholder="Correo electrónico" name="usuario_email">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="password" class="form-control" id="password" placeholder="Password" name="usuario_password">
                    </div>
                    <a href="html/PerdidaPass.html">¿Olvidaste tu Password?</a>
                  </div>
                  <div class="modal-footer navbar-inverse">
                    <img src="../img/ComicDLogo-04.svg" vspace="10" hspace="10"
                    class="img-responsive text-center" width="207" height="26"/>
                    <button type="submit" class="btn btn-success" >Iniciar Sesión</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal" >Cancelar</button>
                  </div>
                </form>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->
      <div class="container tres">

        <div class="catalogo">
          <div class="row">
            <div class="col-md-3">
              <a target="_blank" id="comic_href" href="">
                <img src="" class="img-responsive img-rounded" id="comic_img">
              </a>
            </div>
            <div class="col-md-9">
              <h1 class="blog-title" id="comic_personaje"></h1>
              <h1><small><span class="label label-primary" id="comic_titulo"></span></strong></small><small id="comic_idioma"></small></h1>
            
              <hr></hr>
              <div class="row">
                <div class="col-md-3" id="comic_copias" align="left">
                  </div>
                  <div class="col-md-3" id="comic_integridad" align="left">
                  </div>
              </div>
              <p align="justify" style="font-size: 12pt" id="comic_descripcion"></p>
              <!--<div class="row" align="center">
                <div class="col-md-4"><h4>Estado: <small>Nuevo</small></h4></div>
                <div class="col-md-4"><h4>Año: <small>1989</small></h4></div>
                <div class="col-md-4"><h4>Copias: <small>3</small></h4></div>
              </div>-->
            </div>
            <div class="row" align="right">
              <div class="col-md-9 col-md-offset-3">
                <div class="row">
                  <div class="col-md-6 col-md-offset-3">
                    <h4 class="panel-title price" id="comic_precio"></h4>
                  </div>
                  <div class="col-md-3">
                    <div id="boton_comprar"><button class="btn btn-success btn-comprar" role="button">Comprar »</button></div>
                    <div id="boton_eliminar"><button class="btn btn-danger btn-eliminar" role="button">Eliminar »</button></div>
                    <div id="boton_comprar_nologin"><button class="btn btn-success btn-comprar-nologin" role="button">Comprar »</button></div>
                  </div>
                </div>
              </div>
            </div>
            <hr></hr>
            <div class="col-lg-4"> 
              <p style="font-size: 14pt" align="center"><a href="/html/Catalogo.php"><strong>«</strong> Regresar al catálogo</a></p>
            </div>
          </div>
        </div>
      </div>

      <div id="infos"></div>

      <div class="container tres">  
        <div class="jumbotron">
          <blockquote style="font-size:12pt">
            <p>"May God protect us -- from guys who do the right thing."</p>
            <small><cite title="Amazing Spider-Man, Vol. 2, #38">Hulk, A Titan Stalks the Tenements!, The Hulk, 2nd series, #131</cite></small>
          </blockquote>
        </div>
      </div>

      <div id="footer"></div>
      

          <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      
      <!-- Include all compiled plugins (below), or include individual  files as needed -->
    </div> 
  </body>
</html>