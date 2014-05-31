<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Bienvenido</title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link rel="shortcut icon" href="../img/ComicDico-01.png">
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/comicsD.css">
    <script src="../bootstrap/assets/js/jquery.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../js/promocion_index.js"></script>
    <script src="../js/pedido.js"></script>
    <script src="../js/login.js"></script>
    <script type="text/javascript">

      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-45620115-1']);
      _gaq.push(['_setDomainName', 'comicsdealer.com']);
      _gaq.push(['_trackPageview']);

      (function() {
        var ga = document.createElement('script');
        ga.type = 'text/javascript';
        ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
      })();

    </script>
    <style>
      .container {
        background: url(../img/spiderman1.jpg) no-repeat center center fixed;
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
        $html = file_get_contents("layouts/navbar_login_layout.html");
        $doc = new DOMDocument();
        
        $doc->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
      ?>
    <div id="nav_bar"><?php echo $doc->saveHTML(); ?></div>

  </div>
  <div id="fb-root"></div>
  <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id))
        return;
      js = d.createElement(s);
      js.id = id;
      js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
  </script>
  <div class="container">
    <div class="container tres">


      <div class="container tres" id="promocion"><!--ESto es lo NUEVO-->
        <div class="jumbotron">
          <div id="layout"></div> <!--Aqui se carga la promocion de fin de semana
          <div class="row"><p align="right">
              <!--<a class="btn btn-lg btn-info">Más información</a>-->
              <!--<a class="btn btn-lg btn-success" id="pedidofinde">Comprar!</a>-->
            
          <div class="row">
            <div class="col-lg-3">
              <div class="fb-like" data-href="https://www.facebook.com/ComicsDealer" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
            </div>

            <div class="col-lg-3">
              <a href="https://twitter.com/ComicsDealer" class="twitter-follow-button" data-show-count="false" data-lang="es">Seguir a @ComicsDealer</a>
              <script>
                !function(d, s, id) {
                  var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
                  if (!d.getElementById(id)) {
                    js = d.createElement(s);
                    js.id = id;
                    js.src = p + '://platform.twitter.com/widgets.js';
                    fjs.parentNode.insertBefore(js, fjs);
                  }
                }(document, 'script', 'twitter-wjs');
              </script>
            </div>

            <div class="col-lg-2">
              <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://www.comicsdealer.com" data-text="¡Oferta de fin de semana!" data-via="ComicsDealer" data-lang="es">Twittear</a>
              <script>!function(d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
                    if (!d.getElementById(id)) {
                      js = d.createElement(s);
                      js.id = id;
                      js.src = p + '://platform.twitter.com/widgets.js';
                      fjs.parentNode.insertBefore(js, fjs);
                    }
                  }(document, 'script', 'twitter-wjs');</script>
            </div>

          </div>

        </div>
      </div>
      <!--Aquí se acaba lo NUEVO-->

      <div class="container tres">
        <div class="jumbotron" id="pedido_form">
          <img src="../img/Bienvenido.svg" vspace="10" hspace="10"
               class="img-responsive text-center" />
          <h2 id="usuario"></h2>
          Listo para pedir cómics?

          <form role="form" id="pedido">
            <div class="highlight">
              <div class="form-group">
                <label for="Pedido">Paso 1: Selecciona la compañía</label>
                <select class="form-control" name="compania_id" id="compania">

                </select>
              </div>
              <div class="form-group">
                <label for="Pedido">Paso 2: Selecciona el personaje</label>
                <select class="form-control" name="personaje_id" id="personaje">
                  <option selected>Primero selecciona una compañia</option>            
                </select>
              </div>
              <div class="form-group">
                <label for="Pedido">Paso 3: Ahora dinos qué serie y qué tomos estás buscando</label>
                <div>
                  <textarea id="textolibre" class="form-control" rows="3" name="texto_libre" placeholder="Un par de buenos ejemplos serían: ''Monster Edition: The Avengers Versus The x-Men'', o bien ''Ultimate Comics: #11'' TRATA DE SER LO MAS ESPECIFICO POSIBLE."></textarea>
                </div>
              </div> 
            </div>
            <div class="highlight">
              <p></p>
              <div class="form-group">
                <label for="Pedido">Selecciona una forma de pago</label>
                <!--<select class="form-control" name="lugar_entrega" id="lugarEntrega" >
                  <option selected>Elige un lugar de entrega</option>
                  <option>18 de Marzo</option>
                  <option>Balderas</option>
                  <option>Bellas Artes</option>
                  <option>Centro Médico</option>
                  <option>Chabacano</option>
                  <option>Ermita</option>
                  <option>Guerrero</option>
                  <option>Hidalgo</option>
                  <option>La Raza</option>
                  <option>Pino Suarez</option>
                  <option>Santa Anita</option>
                  <option>Tacuba</option>
                  <option>Envio a Estado de la Republica</option>
                  <option>Envio Local (Distrito Federal)</option>
                </select>-->
              </div>
              <div class="row">
                <div class="form-group"><label for="Pedido"></label>
                  <div class="col-sm-6">
                    <p align="justify" style="font-size: 12pt">Recuerda que no pagas hasta que te mandemos un correo confirmando que encontramos tu pedido y cuánto te costará.</p>
                  </div>
                  <div class="col-sm-2">
                    <div class="radio">
                      <label>
                        <input type="radio" name="pedido_forma_pago_id" id="pago1" value="1" checked="">
                        <img src="../img/paypal.png" class="img-responsive text-center" width="100" height="31">
                      </label>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="radio" id="f">
                      <label>
                        <input type="radio" name="pedido_forma_pago_id" id="pago2" value="2">
                        <img class="img-responsive text-center" src="../img/logosBan.jpg" width="150" height="47">
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3 col-md-offset-9">
                  <button type="submit" class="btn btn-lg btn-success">Realizar pedido</button>
                </div>
              </div>

            </div>
            <div class="highlight">
              <div class=" alert alert-info">
                <p align="justify" style="font-size: 12pt" >
                  <strong>Nota: </strong>Al hacer tu pedido recibiras un <strong>CORREO ELECTRONICO</strong> en la direccion que hayas registrado. En este <strong>CORREO ELECTRONICO</strong> te daremos la fecha en la que recibiras noticias sobre tu <strong>PEDIDO.</strong> Una vez que decidas si te conviene o no el costo del pedido, tienes un maximo de <strong>5 dias</strong> para contestar, de lo contrario <strong>daremos por cancelado tu pedido</strong>. Gracias!.
                </p>
              </div>
            </div>
          </form>  
        </div>
      </div>

      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel">Comics Dealer</h4>
            </div>
            <div class="modal-body">

              <p id="inicial">Gracias por tu pedido! La busqueda de tu(s) comics ha iniciado!</p>
              <p id="personajeModal"></p>
              <p id="textoModal"></p>
              <p id="lugarEntregaModal"></p>
              <p>Te hemos enviado un correo a: </p>
              <p id="correo"></p>
              <p id="mensaje">En este correo te indicamos la fecha en que tendremos informes sobre tu pedido, por favor revisa tu correo en esa fecha.</p>
            </div>
            <div class="modal-footer navbar-inverse">
              <img src="../img/ComicDLogo-04.svg" vspace="10" hspace="10"
                   class="img-responsive text-center" width="207" height="26"/>
              <button type="button" class="btn btn-default" data-dismiss="modal" id="cerrarModal">Close</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->

      <div id="infos"></div>

      <div class="container tres">  
        <div class="jumbotron">
          <blockquote style="font-size:12pt">
            <p>"The paths are less clear now, for a man whose chief pleasure -- is shattering mirrors!"</p>
            <small><cite title="The Empire Strikes Back">Dr. Doom, Superman and Spider-Man, their second teaming from Marvel Treasury Edition #28</cite></small>
          </blockquote>
        </div>
      </div>

      <div id="footer"></div>
    </div>  

</body>
</html>
