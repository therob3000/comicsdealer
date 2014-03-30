<?php
ini_set('display_errors',1); 
error_reporting(E_ALL);

if (empty($_GET['pagina'])){
  $pagina = 0; 
}
else{
  $pagina = $_GET['pagina'];
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Catálogo</title>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap -->
  <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link rel="shortcut icon" href="/img/ComicDico-01.png">
  <link href="/bootstrap/css/navbar.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../bootstrap/css/comicsD.css">
  <script>
    var pagina = <?php echo json_encode($pagina); ?>;
  </script>

  <script src="../bootstrap/assets/js/jquery.js"></script>
  <script src="../bootstrap/js/bootstrap.min.js"></script>
  <script src="../js/login.js"></script>
  <script src="../js/catalogo.js"></script>
  <script src="../js/catalogo_index.js"></script>

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
              <div class="col-md-12">
                <div class="row">
                  <div class="col-lg-12">
                    <h2 class="blog-title" style="margin-bottom: 0px;">Catálogo Privado de <strong>Dr. Death</strong>
                      <br><small>Sólo la crema condensada del mundo del cómic.</small></h2>
                    </div>
                  </div>
                  <hr></hr>

                  <div class="rows"></div>
                
                    <ul class="pager">
                    <li id="anterior"></li>
                    <li id="siguiente"></li>
                  </ul>
                
                </div>
              </div>
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