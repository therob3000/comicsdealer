<!DOCTYPE html>
<html>
  <head>
    <title>Comics Dealer</title>
    
    <link href="http://comicsdealer.zapto.org/img/ComicDminiFB.jpg" rel="image_src" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="comics, cómics, bootstrap, marvel, dc, televisa, vid, méxico, bootstrap">
  <meta name="description" content="Comics Dealer se especializa en buscar y encontrar cómics en México">
    
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link rel="shortcut icon" href="img/ComicDico-01.png">
    <link href="bootstrap/css/navbar.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/comicsD.css">
    <script src="../bootstrap/assets/js/jquery.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../js/login.js"></script>
    <script type="text/javascript">

      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-45620115-1']);
      _gaq.push(['_setDomainName', 'comicsdealer.com']);
      _gaq.push(['_trackPageview']);

      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();

    </script>

    <style>
      .container {
        background: url(img/bg.jpg) no-repeat center center fixed;
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
        }(document, 'script', 'facebook-jssdk'));
    </script>
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
              <img src="img/ComicDLogo-04.svg" vspace="10" hspace="10"
               class="img-responsive text-center" width="207" height="26"/></a>
            <!--<a class="navbar-brand" href="http://www.google.com">ComicsDealer.com</a>-->
          </div>
          <div class="navbar-collapse collapse">
            <form class="navbar-form navbar-right" id="login">
              <div class="form-group">
                <input id="email" type="email" placeholder="Email" class="form-control" name="usuario_email">
              </div>
              <div class="form-group">
                <input id="password" type="password" placeholder="Password" class="form-control" name="usuario_password">
              </div>
              <button type="submit" class="btn btn-success">Sign in</button>
            </form>
          </div><!--/.nav-collapse -->
        </div>
      </div>

      <div class="container tres" id="oferta"><!--ESto es lo NUEVO-->
        <div class="jumbotron">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6" align="center">
              <img class="img-responsive" style="width:100%; max-width: 300px; height:100%; max-height:600px"width="207" height="26" src="https://d1466nnw0ex81e.cloudfront.net/n_iv/600/1081009.jpg">
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
              <h2>¡OFERTA DE <strong>FIN DE SEMANA</strong>!</h2>
              <h3>Tenemos varias copias.</h3>
              <h4>¡No te quedes sin la tuya!</h4>
                <ul style="font-size: 11pt">
                  <li><strong>X Factor</strong></li><!--Esto CAMBIA hasta-->
                  <li>Fatal Attractions: Out of the light and into father's shadow.</li>
                  <li>Reedicion del evento X-men publicado originalmente en 1993 con motivo del 30 aniversario de los X-men. En esta saga, Magneto regresa para confrontar nuevamente a Charles Xavier y sus X-men, solo que esta vez las consecuencias seran importantes!.</li>
                  <li><strong>Precio $55.00</strong></li><!--Aquí según el comic-->
                </ul>
              <p align="right">
            <!--<a class="btn btn-lg btn-info">Más información</a>-->
            <strong>Haz sign in o </strong>
            <a class="btn btn-lg btn-danger" href="html/Registro.html">Regístrate ya!</a>
          </p>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-3">
              <div class="fb-like" data-href="https://www.facebook.com/ComicsDealer" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
            </div>
            <div class="col-lg-3">
              <a href="https://twitter.com/ComicsDealer" class="twitter-follow-button" data-show-count="false" data-lang="es">Seguir a @ComicsDealer</a>
              <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
            </div>
            <div class="col-lg-2">
              <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://www.comicsdealer.com" data-text="Es la neta" data-via="ComicsDealer" data-lang="es">Twittear</a>
              <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
            </div>
            <div class="col-lg-4">
              <p align="right" class="text-muted" style="font-size: 11pt"> 
            <a href="html/PerdidaPass.html"><strong>¿Olvidaste tu Password?</strong></a>
          </p>
            </div>
          </div>
        </div>
      </div><!--Aquí se acaba lo NUEVO-->
      
      <div class="container tres" id="original">
        <div class="jumbotron">
          <div class="">
            <p align="center">
              <img src="img/ComicDLogo-02.svg" class="img-responsive text-center" />
            </p>
          </div>
                  
          <p align="right">
            <!--<a class="btn btn-lg btn-info">Más información</a>-->
            <a class="btn btn-lg btn-danger" href="html/Registro.html">Regístrate ya!</a>
          </p>
          <div class="row">
            <div class="col-lg-3">
              <div class="fb-like" data-href="https://www.facebook.com/ComicsDealer" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
            </div>
            <div class="col-lg-3">
              <a href="https://twitter.com/ComicsDealer" class="twitter-follow-button" data-show-count="false" data-lang="es">Seguir a @ComicsDealer</a>
              <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
            </div>
            <div class="col-lg-2">
              <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://www.comicsdealer.com" data-text="Es la neta" data-via="ComicsDealer" data-lang="es">Twittear</a>
              <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
            </div>
            <div class="col-lg-4">
              <p align="right" class="text-muted" style="font-size: 11pt"> 
            <a href="html/PerdidaPass.html"><strong>¿Olvidaste tu Password?</strong></a>
          </p>
            </div>
          </div>
        </div>
      </div>

      <div class="container tres">
        <div class="jumbotron">
          <h4>¿Quiénes somos?</h4>
          <p style="font-size: 12pt" align="justify">Somos un grupo dedicado a buscar y encontrar cómics, cómics que se encuentren en México, por ejemplo, de editorial Televisa o editorial Vid, pero también podemos encontrar cómics greengos que ronden en nuestro país. Con nuestra ayuda puedes tener todos los ejemplares que faltan en tu colección. Y para obtener los tomos que te hacen llorar por las noches (hasta quedarte dormido), sólo tienes que seguir estos tres simples pasos: 
          </p>
          <p class="text-default" align="center">
            <span class="label label-info">Nos preguntas por tomos »</span>
            <span class="label label-primary">Buscamos hasta encontrarlos »</span>
            <span class="label label-success">los pagas y te los entregamos \o/</span></p>
          <p style="font-size: 12pt" align="justify">Ahora, si eres un Jedi usa la fuerza y pídenos cómics, si no, no temas y...</p>        
          <p align="right">
            <a class="btn btn-lg btn-danger" href="html/Registro.html">Regístrate ya!</a>
          </p>
          <p align="right" class="text-muted" style="font-size: 11pt">Por el momento este servicio es exclusivo para el D.F.</p>
        </div>
      </div>

      <div class="container tres">
        <div class="jumbotron">
          <div class="row">
            <div class="col-lg-4">
              <h3>¿Cómo funciona?</h3>
              <p align="justify" style="font-size: 12pt">Muy fácil, simplemente te registras con tu nombre y tu email, y luego nos pides que busquemos un cómic o cómics. Nosotros lo buscamos por ti en nuestra amplia red de contactos, cuando lo encontramos (siempre lo encontramos) te mandamos un email con el costo del cómic. Nos pagas y te lo damos... </p>
              <p><a class="btn btn-primary" href="html/Como Funciona.html">Ver más detalles »</a></p>
            </div>
            <div class="col-lg-4">
              <h3>¿Cómo pago?</h3>
              <p align="justify" style="font-size: 12pt">Tenemos dos modos de pago, ©DineroMail y ©Paypal, cuando preguntes por cómics te pediremos que especifiques el modo de pago que prefieres, entonces, cuando te contestemos por email el costo de tu pedido, vendrá la información para que realices tu pago... </p>
              <p><a class="btn btn-primary" href="html/Como Pago.html">Averigua más »</a></p>
            </div>
            <div class="col-lg-4">
              <h3>Formas de entrega</h3>
              <p align="justify" style="font-size: 12pt">Te entregamos tu pedido personalmente. Para ello tenemos una lista especifica de estaciones del Sistema de Transporte Colectivo - Metro donde podrás elegir cuál te queda más cerca...</p>
              <p><a class="btn btn-primary" href="html/Formas Entrega.html">Ver la lista »</a></p>
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
      <p align="center" class="text-info"><strong>© Comics Dealer 2013 | Todas las imágenes aquí mostradas no nos pertenecen y no son usadas con fin de lucro | <a href="html/Sitemap.html"> Mapa de Sitio</a></string></p>
    </footer>
    </div>
  </body>
</html>