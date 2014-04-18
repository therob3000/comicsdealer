<!DOCTYPE html>
<html>
<head>
  <title>Comics Dealer</title>

  <link href="/img/ComicDminiFB.jpg" rel="image_src" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="keywords" content="comics, cómics, bootstrap, marvel, dc, televisa, vid, méxico, bootstrap">
  <meta name="description" content="Comics Dealer es una pagina hecha por desarrolladores mexicanos que se especializa en buscar y encontrar cómics en México, que cuenta con un catalogo de cómics tanto en ingles como en español. ¡Los buscamos por ti!">

  <!-- Bootstrap -->
  <link href="bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link rel="shortcut icon" href="img/ComicDico-01.png">
  <link href="bootstrap/css/navbar.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="bootstrap/css/comicsD.css">
  <script src="/bootstrap/assets/js/jquery.js"></script>
  <script src="/bootstrap/js/bootstrap.min.js"></script>
  <script src="/js/catalogo.js"></script>
  <script src="/js/promocion_index.js"></script>
  <script src="/js/index.js"></script>
  <script src="/js/login.js"></script>
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
      background: url(img/bg1.jpg) no-repeat center center fixed;
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
<script>

window.fbAsyncInit = function() {
  FB.init({
    appId      : '655150577891800',
    status     : true, // check login status
    cookie     : true, // enable cookies to allow the server to access the session
    xfbml      : true,  // parse XFBML
    oauth      : true
  });

  // Here we subscribe to the auth.authResponseChange JavaScript event. This event is fired
  // for any authentication related change, such as login, logout or session refresh. This means that
  // whenever someone who was previously logged out tries to log in again, the correct case below 
  // will be handled. 
  FB.Event.subscribe('auth.authResponseChange', function(response) {
    // Here we specify what we do with the response anytime this event occurs. 
    if (response.status === 'connected') {
      // The response object is returned with a status field that lets the app know the current
      // login status of the person. In this case, we're handling the situation where they 
      // have logged in to the app.
      window.location.href = "/html/Catalogo.php";
    } else if (response.status === 'not_authorized') {
      // In this case, the person is logged into Facebook, but not into the app, so we call
      // FB.login() to prompt them to do so. 
      // In real-life usage, you wouldn't want to immediately prompt someone to login 
      // like this, for two reasons:
      // (1) JavaScript created popup windows are blocked by most browsers unless they 
      // result from direct interaction from people using the app (such as a mouse click)
      // (2) it is a bad experience to be continually prompted to login upon page load.
      window.location.href = "/index.php";
    } else {
      // In this case, the person is not logged into Facebook, so we call the login() 
      // function to prompt them to do so. Note that at this stage there is no indication
      // of whether they are logged into the app. If they aren't then they'll see the Login
      // dialog right after they log in to Facebook. 
      // The same caveats as above apply to the FB.login() call here.
      window.location.href = "/index.php";
    }
  });
};

function facebookRegistro(){
  
  $("#registro_facebook").click(function(e){
    FB.login(function(response) {
           if (response.authResponse){
              FB.api('/me', function(response){
                console.log(response.name);
                
                });
              //window.location.href = "/html/Registro.php?usuario="+nombre;
 
            } 
            else{
             console.log('Authorization failed.');
            }
         },{scope: 'email'});
  });
  
}
  

(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1&appId=655150577891800";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

      <!--<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1";
        fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
      </script>-->
    <div id="nav_bar"></div>
    <div class="container">

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

      <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel2">Bienvenido, haz login!</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6">
                  <button type="button" class="btn btn-success" id="registro_facebook">Facebook</button>
                </div>
                <div class="col-md-6">
                </div>
              </div>
            </div>
            <div class="modal-footer navbar-inverse">
              <img src="../img/ComicDLogo-04.svg" vspace="10" hspace="10"
              class="img-responsive text-center" width="207" height="26"/>
            </div>
            
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
      
      <!--Aqui empieza el jumbotron Principal y de Fin de semana -->
      <div class="container tres" >
        <!--<div class="jumbotron">-->
        <div class="catalogo">
          <div class="row">

            <!--Aqui se inserta el contenido Principal-->
            <div id="layout"></div>

            <div class="col-sm-3 hidden-xs">
              <div class="row" align="right">
                <div class="row">
                  <div class="col-sm-12" style="margin-bottom: 4%; margin-top: 6%">
                    <div class="fb-like" data-href="https://www.facebook.com/ComicsDealer" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12" style="margin-bottom: 3%; margin-top: 3%">
                    <a href="https://twitter.com/ComicsDealer" class="twitter-follow-button" data-show-count="false" data-lang="es">Seguir a @ComicsDealer</a>
                    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12" style="margin-bottom: 3%; margin-top: 3%">
                    <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://www.comicsdealer.com" data-text="Es la neta" data-via="ComicsDealer" data-lang="es">Twittear</a>
                    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12" style="margin-top: 3%">
                    <a class="btn btn-xs btn-danger" href="html/preRegistro.html">Regístrate ahora!</a>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <br><br>
          <div id="searchnav"> 
          </div>

          <div class="row">
            <div class="col-lg-12" >
              <h3 style="margin-bottom: 0px;">Novedades en el Catálogo Privado de <strong>Dr. Death</strong>
              <br><small>La pura nata concentrada de los cómics</small></h3>
            </div>  
          </div>
          
          <hr></hr>
          <div class="row" id="catalogo_comics">
            
          </div><!-- /.row1 -->
          <div class="row">             
            <div class="col-lg-4 col-lg-offset-8"> 
              <p style="font-size: 14pt" align="center"><a href="html/Catalogo.php"><strong>Ver el catálogo completo »</strong></a></p>
            </div> 
          </div>
          <hr></hr>
        </div>
      </div><!-- /.Catalogo Muestra-->

      <div class="container tres">
        <div class="jumbotron">
          <h4>¿Quiénes somos?</h4>
          <p style="font-size: 12pt" align="justify">Somos un grupo amante de los cómics, comprometido a conseguir los mejores precios para nuestros usuarios, pero también nos dedicamos a buscar y encontrar cómics que te hagan falta, de <strong>cualquier editorial</strong>, en <strong>cualquier idioma</strong> (inglés, alemán, zapoteco), o bien de <strong>cualquier país</strong> (Japón, Yugoslavia, <a href="http://es.wikipedia.org/wiki/Islas_Cook">Islas Cook</a>, etc). Con nuestra ayuda podrás tener en la puerta de tu casa todos los ejemplares que faltan en tu colección, sólo tienes que seguir estos tres simples pasos: 
          </p>
          <p class="text-default" align="center">
            <span class="label label-info">Regístrate »</span>
            <span class="label label-primary">Buscamos tus cómics »</span>
            <span class="label label-success">Los pagas y te los entregamos \o/</span></p>
            <p style="font-size: 12pt" align="justify">Ahora, si eres un Jedi usa la fuerza pra pedirnos cómics, si no, no temas y...</p>        
            <p align="right">
              <a class="btn btn-lg btn-danger" href="html/preRegistro.html">Regístrate ya!</a>
            </p>
            <p align="right" class="text-muted" style="font-size: 11pt">Este servicio es para toda la Republica Mexicana.</p>
          </div>
        </div> 

        <div id="infos"></div>

        <div class="container tres">  
          <div class="jumbotron">
            <blockquote style="font-size:12pt">
              <p>"...with great power there must also come -- great responsibility!"</p>
              <small><cite title="Amazing Spider-Man, Vol. 2, #38">Ben Parker</cite></small>
            </blockquote>
          </div>
        </div>

        <div id="footer"></div>
      </div>
    </body>
    </html>