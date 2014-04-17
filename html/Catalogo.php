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
      background: url(../img/AVXM31.jpg) no-repeat center center fixed;
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
              <!--Aqui se inserta el logo Principal-->
              <div class="col-sm-9">
                <img style="height: 150px;" src="/img/ComicDLogo-09.svg" class="img-responsive" />
              </div>
              <div class="col-sm-3">
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
                      <a class="btn btn-md btn-danger" href="html/preRegistro.html">Regístrate ya!</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <br><br>
            <div id="searchnav"> 
            </div><br>
            
            <div class="row">
              <div class="col-md-2 blog-sidebar">
                <!--<div class="sidebar-module sidebar-module-inset">
                  <h4>Categorías</h4>
                </div>-->
                <h4>Categorías</h4>
                <hr>
                <div class="sidebar-module">
                  <h4>DC</h4>
                  <ol class="list-unstyled" id="marvel">
                    <li><a href="#">Batman</a></li>
                    <li><a href="#">Catwoman</a></li>
                    <li><a href="#">Flash</a></li>
                    <li><a href="#">Green Lantern</a></li>
                  </ol>
                </div>
                <div class="sidebar-module">
                  <h4>Marvel</h4>
                  <ol class="list-unstyled" id="marvel">
                    <li><a href="#">Avengers</a></li>
                    <li><a href="#">Captain America</a></li>
                    <li><a href="#">Daredevil</a></li>
                    <li><a href="#">Spiderman</a></li>
                  </ol>
                </div>
              </div>
              <div class="col-md-10">
                <div class="row">
                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-lg-12">
                        <h2  style="margin-bottom: 0px;">Catálogo Privado de <strong>Dr. Death</strong>
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
            </div>


          </div>

          <!--</div> /.Catalogo -->

          <div id="infos"></div>

          <div class="container tres">  
            <div class="jumbotron">
              <blockquote style="font-size:12pt">
                <p>"We didn't mean it! We never mean it! But what good does that do..."</p>
                <small><cite title="Amazing Spider-Man, Vol. 2, #38">Vietnam veteran Flash Thompson, Amazing Spider-Man, 1st series, #109</cite></small>
              </blockquote>
            </div>
          </div>

          <div id="footer"></div>


          <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

          <!-- Include all compiled plugins (below), or include individual  files as needed -->
        </div> 
      </body>
      </html>