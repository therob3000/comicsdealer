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
    <script src="../js/registro.js"></script>
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
    <div class="container">
      <div class="container tres">
        <div class="navbar navbar-inverse">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a align="center" href="http://www.comicsdealer.com/">
              <img src="../img/ComicDLogo-04.svg" vspace="10" hspace="10"
               class="img-responsive text-center" width="207" height="26"/></a>
            <!--<a class="navbar-brand" href="http://www.google.com">ComicsDealer.com</a>-->
          </div>
          <div class="collapse navbar-collapse navbar-ex1-collapse">
            <div class="nav navbar-nav navbar-right">
              <li><a href="Articulos.html">Artículos</a></li>
              <li><a href="Catalogo.html">Catálogo</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="label label-success" style="font-size: 10pt">Sign in <span class="caret"></span></span></a>
                <ul class="dropdown-menu">
                  <form class="navbar-form navbar-right" id="login">
                    <li>
                      <div class="form-group">
                        <input id="email" type="email" placeholder="Email" class="form-control" name="usuario_email">
                      </div>
                    </li>
                    <li>
                      <div class="form-group">
                        <input id="password" type="password" placeholder="Password" class="form-control" name="usuario_password">
                      </div>
                    </li>
                    <li class="divider"></li>
                    <li>
                      <div align="right">
                        <button type="submit" class="btn btn-success">Sign in</button>
                      </div>
                    </li>
                  </form><!--/.Fin del Form -->
                </ul>
              </li>
            </div>
          </div><!--/.nav-collapse -->
        </div>
      </div>
      
      <div class="container tres">
        <div class="highlight">
          
            <div class="row">
              <div class="col-sm-offset-1 col-sm-10 blog-main">
                <h1 class="blog-title">Los Reviews de Yunrock y Dr. Death</h1>
                <p class="lead blog-description">Todo lo que debes saber para convertirte un lector serio.</p>
              </div>
            </div>

            <div class="row">

              <div class="col-sm-offset-1 col-sm-7 blog-main">

                <div class="blog-post">
                  <!--Titulo-->
                  <h2 id="articulo_titulo" class="blog-post-title"></h2>
                  <!--Fecha y Autor-->
                  <p id="articulo_fecha_autor"></p>
                  <hr>
                  <h4>Resumen</h4>
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

                <ul class="pager">
                  <li><a href="#">Anterior</a></li>
                  <li><a href="#">Siguiente</a></li>
                </ul>

              </div><!-- /.blog-main -->

              <div class="col-sm-3 blog-sidebar">
                <div class="sidebar-module sidebar-module-inset">
                  <h4>Acerca</h4>
                  <p align="justify">Esta sección de <em>artículos</em> la hemos creado para darte una introducción a nuevos personajes, o bien una guía a sagas importantes. "Es lo que debes saber".</p>
                </div>
                <div class="sidebar-module">
                  <h4>Archivo</h4>
                  <ol class="list-unstyled">
                    <li><a href="#">Civil War</a></li>
                    <li><a href="#">Kingdom Come</a></li>
                    <li><a href="#">Kick Ass</a></li>
                    <li><a href="#">Scott Pilgrim</a></li>
                    <li><a href="#">Deadpool</a></li>
                    <li><a href="#">El Batman de Frank Miller</a></li>
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

      <div class="container tres">
        <div class="jumbotron">
          <div class="row">
            <div class="col-lg-4">
              <h3>¿Cómo funciona?</h3>
              <p align="justify" style="font-size: 12pt">Muy fácil, te registras con tu nombre y tu email, luego nos pides que busquemos un cómic o cómics. Nosotros lo buscamos con nuestra amplia red de contactos, cuando lo encontramos <strong>(y siempre lo encontramos)</strong> te mandamos un email con el costo del cómic. Así de sencillo... </p>
              <p><a class="btn btn-primary" href="html/Como Funciona.html">Ver más detalles »</a></p>
            </div>
            <div class="col-lg-4">
              <h3>¿Cómo pago?</h3>
              <p align="justify" style="font-size: 12pt">Tenemos dos modos de pago, <a href="https://mx.dineromail.com/Index" target="_blank">©DineroMail</a> y <a href="https://www.paypal.com/mx" target="_blank">©Paypal</a>, cuando preguntes por cómics te pediremos que especifiques el modo de pago que prefieres, entonces, cuando te contestemos por email el costo de tu pedido, vendrá la información para que realices tu pago... </p>
              <p><a class="btn btn-primary" href="html/Como Pago.html">Averigua más »</a></p>
            </div>
            <div class="col-lg-4">
              <h3>Formas de entrega</h3>
              <p align="justify" style="font-size: 12pt">Para el <strong>Distrito Federal</strong> tenemos un sistema de entrega personal. Para ello tenemos una lista específica de estaciones del STC Metro, de donde podrás elegir cuál te queda más cerca.</p><p align="justify" style="font-size: 12pt">Para pedidos en el interior de la <strong>Republica Mexicana</strong> enviamos tus cómics por <a href="http://www.correosdemexico.com.mx/Mexpost/Paginas/Mexpost.aspx" target="_blank">Mexpost</a>.</p>
              <p><a class="btn btn-primary" href="html/Formas Entrega.html">Ver toda la info »</a></p>
            </div>
          </div>
        </div>
      </div>

      <div class="container tres">  
        <div class="jumbotron">
          <blockquote style="font-size:12pt">
            <p>"...with great power there must also come -- great responsibility!"</p>
            <small><cite title="Amazing Spider-Man, Vol. 2, #38">Ben Parker</cite></small>
          </blockquote>
        </div>
      </div>

      <footer>
      <p align="center" class="text-info"><strong>© Comics Dealer 2013 | Todas las imágenes aquí mostradas no nos pertenecen y no son usadas con fin de lucro | <a href="Sitemap.html"> Mapa de Sitio</a></string></p>
    </footer>
      

          <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      
      <!-- Include all compiled plugins (below), or include individual  files as needed -->
    </div> 
  </body>
</html>