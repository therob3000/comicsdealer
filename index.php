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
  <script src="../js/promocion_index.js"></script>
  <script src="../js/index.js"></script>
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
            </div>
          <div class="collapse navbar-collapse navbar-ex1-collapse">
            <div class="nav navbar-nav navbar-right">
              <li><a href="html/Articulos.html">Artículos</a></li>
              <li><a href="html/Catalogo.html">Catálogo</a></li>
              <div class="navbar-form navbar-left">
                <button id="loginButton" type="submit" class="btn btn-success">Haz Login!</button>
              </div>
              <!--<li class="dropdown">
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
                  </form>/.Fin del Form
                </ul>
              </li>-->
            </div>
          </div><!--/.nav-collapse -->
        </div>
      </div>

      <!-- Inicia ventana modal -->
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
      
      <!--Aqui empieza el jumbotron Principal y de Fin de semana -->
      <div class="container tres" >
        <div class="jumbotron">
          <!--Aqui se inserta el contenido Principal-->
          <div id="layout"></div>
          <div class="row"><p align="right">
            <strong>Haz Login o </strong>
            <a class="btn btn-lg btn-danger" href="html/Registro.html">Regístrate ya!</a></p>
          </div>
          <div class="row">
            <div class="col-lg-3">
              <div class="fb-like" data-href="https://www.facebook.com/ComicsDealer" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
            </div>
            <div class="col-lg-3" style="margin-top: 2%">
              <a href="https://twitter.com/ComicsDealer" class="twitter-follow-button" data-show-count="false" data-lang="es">Seguir a @ComicsDealer</a>
              <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
            </div>
            <div class="col-lg-2" style="margin-top: 2%">
              <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://www.comicsdealer.com" data-text="Es la neta" data-via="ComicsDealer" data-lang="es">Twittear</a>
              <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
            </div>
          </div>
        </div>
      </div>
      <!--Aqui termina el jumbotron Principal y de Fin de semana -->

      <div class="container tres">
        <div class="jumbotron">
          <div class="highlight">
            <div class="row">
              <div class="col-lg-12" align="center">
                <h2>Un Poco del Catálogo Privado de <strong>Dr. Death.</strong></h2>
                <p>La pura nata consentrada de los cómics</p>
              </div>  
              <!-- <div class="col-lg-4"></div>  
              <div class="col-lg-4"></div> -->
            </div>
            
            <hr></hr>
            <div class="row">
              <div align="center" class="col-lg-4">
                <img src="http://upload.wikimedia.org/wikipedia/en/f/f8/Batman_Death_In_The_Family_TPB_cover.jpg" style="width: 100px; height: 150px;" class="img-rounded" data-src="holder.js/140x140" alt="140x140">
                <h4>Batman</h4>
                <h5><span class="label label-primary">A Death in the Family</span></h5>
                <p  style="font-size: 10pt">It's a new paperback edition of the classic Batman tale that sealed the fate of the second Robin, Jason Todd, collected from BATMAN #426-429 and 440-442 and THE NEW TITANS #60-61! 272 pg</p>
                <h5>$300 MXN</h5>
                <p><a class="btn btn-success" href="#" role="button">Comprar »</a></p>
              </div><!-- /.col-lg-4 -->

              <div align="center" class="col-lg-4">                
                <img src="http://img20.imageshack.us/img20/8263/4oum.jpg" style="width: 100px; height: 150px;" class="img-rounded" data-src="holder.js/140x140" alt="140x140">
                <h4>Batman</h4>
                <h5><span class="label label-primary">A Death in the Family</span></h5>
                <p  style="font-size: 10pt">It's a new paperback edition of the classic Batman tale that sealed the fate of the second Robin, Jason Todd, collected from BATMAN #426-429 and 440-442 and THE NEW TITANS #60-61! 272 pg</p>
                <h5>$300 MXN</h5>
                <p><a class="btn btn-success" href="#" role="button">Comprar »</a></p>
              </div><!-- /.col-lg-4 -->

              <div align="center" class="col-lg-4">
                <img src="http://i2.cdnds.net/12/41/618x822/comics_marvel_now_superior_spiderman.jpg" style="width: 100px; height: 150px;" class="img-rounded" data-src="holder.js/140x140" alt="140x140">
                <h4>Batman</h4>
                <h5><span class="label label-primary">A Death in the Family</span></h5>
                <p  style="font-size: 10pt">It's a new paperback edition of the classic Batman tale that sealed the fate of the second Robin, Jason Todd, collected from BATMAN #426-429 and 440-442 and THE NEW TITANS #60-61! 272 pg</p>
                <h5>$300 MXN</h5>
                <p><a class="btn btn-success" href="#" role="button">Comprar »</a></p>
              </div><!-- /.col-lg-4 -->
            </div><!-- /.row1 -->
            <hr></hr>
            <div class="row">
              <div align="center" class="col-lg-4">
                <img src="http://upload.wikimedia.org/wikipedia/en/f/f8/Batman_Death_In_The_Family_TPB_cover.jpg" style="width: 100px; height: 150px;" class="img-rounded" data-src="holder.js/140x140" alt="140x140">
                <h4>Batman</h4>
                <h5><span class="label label-primary">A Death in the Family</span></h5>
                <p  style="font-size: 10pt">It's a new paperback edition of the classic Batman tale that sealed the fate of the second Robin, Jason Todd, collected from BATMAN #426-429 and 440-442 and THE NEW TITANS #60-61! 272 pg</p>
                <h5>$300 MXN</h5>
                <p><a class="btn btn-success" href="#" role="button">Comprar »</a></p>
              </div><!-- /.col-lg-4 -->

              <div align="center" class="col-lg-4">
                <img src="http://img20.imageshack.us/img20/8263/4oum.jpg" style="width: 100px; height: 150px;" class="img-rounded" data-src="holder.js/140x140" alt="140x140">
                <h4>Batman</h4>
                <h5><span class="label label-primary">A Death in the Family</span></h5>
                <p  style="font-size: 10pt">It's a new paperback edition of the classic Batman tale that sealed the fate of the second Robin, Jason Todd, collected from BATMAN #426-429 and 440-442 and THE NEW TITANS #60-61! 272 pg</p>
                <h5>$300 MXN</h5>
                <p><a class="btn btn-success" href="#" role="button">Comprar »</a></p>
              </div><!-- /.col-lg-4 -->

              <div align="center" class="col-lg-4">
                <img src="http://i2.cdnds.net/12/41/618x822/comics_marvel_now_superior_spiderman.jpg" style="width: 100px; height: 150px;" class="img-rounded" data-src="holder.js/140x140" alt="140x140">
                <h4>Batman</h4>
                <h5><span class="label label-primary">A Death in the Family</span></h5>
                <p  style="font-size: 10pt">It's a new paperback edition of the classic Batman tale that sealed the fate of the second Robin, Jason Todd, collected from BATMAN #426-429 and 440-442 and THE NEW TITANS #60-61! 272 pg</p>
                <h5>$300 MXN</h5>
                <p><a class="btn btn-success" href="#" role="button">Comprar »</a></p>
              </div><!-- /.col-lg-4 -->
            </div><!-- /.row2 -->
            <hr></hr>
            <div class="row">
              <div class="col-lg-4"></div>  
              <div class="col-lg-4"></div>  
              <div class="col-lg-4"> 
                <p style="font-size: 14pt" align="center"><a href="html/Catalogo.html">Ver el catálogo completo <strong>»</strong></a></p>
              </div> 
            </div>
          </div>

        </div>
      </div><!-- /.Catalogo -->

      <div class="container tres">
        <div class="jumbotron">
          <h4>¿Quiénes somos?</h4>
          <p style="font-size: 12pt" align="justify">Somos un grupo dedicado a buscar y encontrar cómics, cómics de <strong>cualquier editorial</strong>, por ejemplo, de Editorial Televisa o Editorial Vid, en <strong>cualquier idioma</strong> (inglés, alemán, zapoteco), o bien de <strong>cualquier país</strong> (Japón, Yugoslavia, <a href="http://es.wikipedia.org/wiki/Islas_Cook">Islas Cook</a>, etc). Con nuestra ayuda puedes tener todos los ejemplares que faltan en tu colección, sólo tienes que seguir estos tres simples pasos: 
          </p>
          <p class="text-default" align="center">
            <span class="label label-info">Nos preguntas por tomos »</span>
            <span class="label label-primary">Buscamos hasta encontrarlos »</span>
            <span class="label label-success">Los pagas y te los entregamos \o/</span></p>
            <p style="font-size: 12pt" align="justify">Ahora, si eres un Jedi usa la fuerza y pídenos cómics, si no, no temas y...</p>        
            <p align="right">
              <a class="btn btn-lg btn-danger" href="html/Registro.html">Regístrate ya!</a>
            </p>
            <p align="right" class="text-muted" style="font-size: 11pt">Este servicio es para toda la Republica Mexicana.</p>
          </div>
        </div> 

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
          <p align="center" class="text-info"><strong>© Comics Dealer 2013 | Todas las imágenes aquí mostradas no nos pertenecen y no son usadas con fin de lucro | <a href="html/Sitemap.html"> Mapa de Sitio</a></string></p>
        </footer>
      </div>
    </body>
    </html>