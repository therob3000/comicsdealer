<?php
$articulo_id = $_GET['articulo_id'];
?>

<!DOCTYPE html>
<html>
<head>
  <title>Artículos</title>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap -->
  <link href="../bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
  <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link rel="shortcut icon" href="../img/ComicDico-01.png">
  <link href="../bootstrap/css/navbar.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../bootstrap/css/comicsD.css">
  <!-- Estilo css para blog -->
  <link href="blog.css" rel="stylesheet">
  <script>
    var articulo_id = <?php echo json_encode($articulo_id); ?>;
  </script>
  <script src="../bootstrap/assets/js/jquery.js"></script>
  <script src="../bootstrap/js/bootstrap.min.js"></script>
  <script src="../js/login.js"></script>
  <script src="../js/articulos.js"></script>

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
    <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
      <div class="container">
         <div id="nav_bar"></div>
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
            <div class="highlight">

              <div class="row">
                <div class="col-sm-offset-1 col-sm-10 blog-main">
                  <h1 class="blog-title">Los Reviews de Yunrock y Dr. Death</h1>
                  <p class="lead blog-description">Todo lo que debes saber para convertirte un lector serio.</p>
                </div>
              </div>

              <div class="row">

                <div class="col-sm-offset-1 col-sm-7 blog-main" id="main">

                  <div class="blog-post">
                   

                    <div class="row">
                    <div class="col-sm-8">
                      <div class="row">
                        <div >
                          <h2 id="articulo_titulo" class="blog-post-title"></h2>
                          <p id="articulo_fecha_autor"></p>
                          <hr>
                        </div>
                      </div>
                    
                      <div class="row">
                        <div class="col-sm-8">
                          <h4>Resumen</h4>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-4" align="center">
                      <img id="articulo_imagen"  src="" style="width: 120px; height: 180px;" class="img-rounded" data-src="holder.js/140x140" alt="140x140">
                    </div>
                  </div>

                    <p id="articulo_resumen" align="justify"></p>
                    <blockquote>
                      <p id="articulo_cita"></p>
                      <cite><small>Quién lo dijo</small></cite>
                    </blockquote>

                    <h3 id="articulo_subtitulo"></h3>
                    <div id="articulo_principal" align="justify"></div>

                    <h4 id="articulo_segundo_subtitulo"></h4>
                    <div id="articulo_secundario" align="justify"></div>


                  </div><!-- /.Aquí termina lo que hay que poner para cada artículo -->

                  <div class="row" id="social">
                    <div class="col-sm-4" style="margin-top: 2%">
                      <div class="fb-share-button" data-href="" data-type="button_count"></div>
                    </div>
                    <div class="col-sm-4" style="margin-top: 2%">
                      <a href="https://twitter.com/ComicsDealer" class="twitter-follow-button" data-show-count="false" data-lang="es">Seguir a @ComicsDealer</a>
                      <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
                    </div>
                    <div class="col-sm-4" style="margin-top: 2%">
                      <a href="https://twitter.com/share" class="twitter-share-button" data-url="" data-text="" data-via="ComicsDealer" data-lang="es">Twittear</a>
                      <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
                    </div>
                  </div>

                  <ul class="pager">
                    <li id="anterior"></li>
                    <li id="siguiente"></li>
                  </ul>

                </div><!-- /.blog-main -->

                <div class="col-sm-3 blog-sidebar">
                  <div class="sidebar-module sidebar-module-inset">
                    <h4>Acerca</h4>
                    <p align="justify">Esta sección de <em>artículos</em> la hemos creado para darte una introducción a nuevos personajes, o bien una guía a sagas importantes. "Es lo que debes saber".</p>
                  </div>
                  <div class="sidebar-module">
                    <h4>Archivo</h4>
                    <ol class="list-unstyled" id="archivo">

                    </ol>
                  </div>
                  <div class="sidebar-module">
                    <h4>También debes ver</h4>
                    <ol class="list-unstyled">
                      <li><a href="http://es.marvel.wikia.com/wiki/Portada" target="_blank">Marvel Wiki</a></li>
                      <li><a href="http://es.dc.wikia.com/wiki/Wiki_DC_Comics" target="_blank">Dc Wiki</a></li>
                      <li><a href="http://starwars.wikia.com/wiki/Main_Page" target="_blank">Star Wars Wiki</a></li>
                    </ol>
                  </div>
                </div><!-- /.blog-sidebar -->

              </div><!-- /.row -->

            </div>
          </div><!-- /.Catalogo -->

          <div id="infos"></div>

          <div class="container tres">  
            <div class="jumbotron">
              <blockquote style="font-size:12pt">
                <p>"Wars are never won, regardless of who might be the victor. The very act of war is itself a horrible defeat."</p>
                <small><cite title="Amazing Spider-Man, Vol. 2, #38"> Guardian of the Universe. Green Lantern, 1st Silver Age series, #127</cite></small>
              </blockquote>
            </div>
          </div>

          <div id="footer"></div>


          <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

          <!-- Include all compiled plugins (below), or include individual  files as needed -->
        </div> 
      </body>
      </html>