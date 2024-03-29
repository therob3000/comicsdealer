<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    session_start();
   ?>

<!DOCTYPE html>
<html>
  <head>
    <title>Compra!</title>
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link rel="shortcut icon" href="../img/ComicDico-01.png">
    <link href="../bootstrap/css/navbar.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/comicsD.css">
    <script src="../bootstrap/assets/js/jquery.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../js/login.js"></script>
<!--    <script src="../js/pie_pagina.js"></script>-->
    <script src="/js/compra.js"></script>

    <style>
      .container {
        background: url(../img/spawn1.jpg) no-repeat center center fixed;
        background-size: cover;
      }       
      body { 
  background: url(../img/spawn.jpg) no-repeat center center fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
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
    <?php
if (isset($_SESSION['usuario_email']) && isset($_SESSION['usuario_nombre'])) {
  $html = file_get_contents("layouts/navbar_login_layout.html");
} else {
  $html = file_get_contents("layouts/navbar_nologin_layout.html");
}


$doc = new DOMDocument();
$doc->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
?>

<div id="nav_bar"><?php echo $doc->saveHTML(); ?></div>
    <div class="container">
      <!-- Inicia ventana modal -->
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel">Comics Dealer</h4>
            </div>
            <div class="modal-body">
              <p id="inicial"></p>
              <p>Te hemos enviado un correo a: </p>
              <p id="correo"></p>
              <p id="mensaje">En este correo te indicamos las instrucciones a seguir para la entrega de tus comics, <b>NO OLVIDES REVISARLO</b>.</p>
            </div>
            <div class="modal-footer navbar-inverse">
              <img src="../img/ComicDLogo-04.svg" vspace="10" hspace="10" class="img-responsive text-center" width="207" height="26"/>
              <button type="button" class="btn btn-default" data-dismiss="modal" id="cerrarModal">Hecho!</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->

      <div class="container tres">
        <div class="catalogo">
          <div class="row">
            <div class="col-lg-12" >
              <h2 style="margin-bottom: 0px;">Esta es la lista de lo que vas a <strong>comprar</strong>
              <br><small>Compra! Compra! Compra! </small></h2>
            </div>  
            <!-- <div class="col-lg-4"></div>  
            <div class="col-lg-4"></div> -->
          </div>
          <hr></hr>
          
          <div id="compras"></div>

          <div class="row">
            <div class="col-lg-4 col-lg-offset-8" align="right" id="totalComics">
              
            </div>
          </div>

          <div class="alert alert-info">
            <strong>Recuerda: </strong>al finalizar tu compra recibirás un correo electrónico con las intrucciones de pago!
          </div>

          <h5>Forma de Entrega:</h4>
          <div class="row">
            <div class="col-lg-4">
              <div class="radio">
                <label>
                  <input type="radio" name="forma_entrega" id="entrega" value="df" >Para recoger en algún metro del D.F.</input>
                </label>
              </div>
            </div>  
            <div class="col-lg-4" align="center">
              <div class="radio">
                <label>
                  <input type="radio" name="forma_entrega" id="entrega" value="rep">Para envío al interior de la República </input>
                  
                </label>
                <input type="text" class="form-control" placeholder="Codigo Postal de 5 digitos" id="zipcode" name="codigo_postal"></input>
              </div>
            </div>  
            <div class="col-lg-4">
            </div> 
          </div>

          <div class="row" id="entrega_df">
          <div class="col-lg-7">
            <div class="alert alert-info" >
              <strong>Si eres del DF </strong>el pago es a contraentrega
            </div>
          
          </div>
          <div class="col-lg-4"> 
              <button class="btn btn-success" id="finalizarCompra_df">Finalizar la compra <strong>»</strong></button>
              <img id="loading_gif" src="../img/ajax-loader.gif" alt=""/>
            </div> 
          </div>
          <div class="row" id="entrega_republica">
          <h5>Forma de Pago:</h5>
            <form id="formasPago">
            <div class="col-lg-4" align="center">
              <div class="radio">
                <label>
                  <input type="radio" name="forma_pago_id" id="pago" value="3" checked><img class="img-responsive" src="../img/logosBan.jpg" hspace="30" width="150" height="47">Depositanos en cualquier Oxxo de 8am a 8pm, sin costo.</input>
                </label>
              </div>
            </div>  
            <div class="col-lg-4" align="center">
              <div class="radio">
                <label>
                  <input type="radio" name="forma_pago_id" id="pago" value="1"> <img class="img-responsive" src="../img/paypal.png" hspace="30" width="150" height="47">Usa tu cuenta Paypal para realiar el pago.</input>
                </label>
              </div>
            </div>  
            <div class="col-lg-3 col-lg-offset-1">
           
              <button type="submit" class="btn btn-success" id="finalizarCompra_rep">Finalizar la compra <strong>»</strong></button>
              <img id="loading_gif_edos" src="../img/ajax-loader.gif" alt=""/>
            </div> 
            </form>
          </div>
          <hr></hr>
        </div>
      </div>
      
      
      
<!--      <div class="container tres" id="info">
        <div class="jumbotron">
          <div class="row">
            <div class="col-lg-4">
              <h3>¿Cómo funciona?</h3>
              <p align="justify" style="font-size: 12pt">Muy fácil, simplemente te registras con tu nombre y tu email, y luego nos pides que busquemos un cómic o cómics. Nosotros lo buscamos por ti en nuestra amplia red de contactos, cuando lo encontramos (siempre lo encontramos) te mandamos un email con el costo del cómic. Nos pagas y te lo damos... </p>
              <p><a class="btn btn-primary" href="Como Funciona.html">Ver más detalles »</a></p>
            </div>
            <div class="col-lg-4">
              <h3>¿Cómo pago?</h3>
              <p align="justify" style="font-size: 12pt">Tenemos dos modos de pago, ©DineroMail y ©Paypal, cuando preguntes por cómics te pediremos que especifiques el modo de pago que prefieres, entonces, cuando te contestemos por email el costo de tu pedido, vendrá la información para que realices tu pago... </p>
              <p><a class="btn btn-primary" href="Como Pago.html">Averigua más »</a></p>
            </div>
            <div class="col-lg-4">
              <h3>Formas de entrega</h3>
              <p align="justify" style="font-size: 12pt">Te entregamos tu pedido personalmente. Para ello tenemos una lista especifica de estaciones del Sistema de Transporte Colectivo - Metro donde podrás elegir cuál te queda más cerca...</p>
              <p><a class="btn btn-primary" href="Formas Entrega.html">Ver la lista »</a></p>
            </div>
          </div>
        </div>
      </div>-->
      
      <div id="infos"></div>

      <div class="container tres">  
        <div class="jumbotron">
          <blockquote style="font-size:12pt">
            <p>"...do or do not, there is no try"</p>
            <small><cite title="The Empire Strikes Back">Master Yoda</cite></small>
          </blockquote>
        </div>
      </div>

      <div id="footer">
      </div>
      

          <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      
      <!-- Include all compiled plugins (below), or include individual  files as needed -->
    </div>
  </body>
</html>