var respuestaFacebook;
$(document).ready(function(){
	window.fbAsyncInit = function() {
        FB.init({
          appId      : '655150577891800',
          status     : true, // check login status
          cookie     : true, // enable cookies to allow the server to access the session
          xfbml      : true  // parse XFBML
        });
        
    };
    (function(d){
   var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
   if (d.getElementById(id)) {return;}
   js = d.createElement('script'); js.id = id; js.async = true;
   js.src = "//connect.facebook.net/en_US/all.js";
   ref.parentNode.insertBefore(js, ref);
  }(document));

  // Here we run a very simple test of the Graph API after login is successful. 
  // This testAPI() function is only called in those cases. 
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log('Good to see you, ' + response.name + '.');
    });
  }
	
	login();
	cerrar_sesion();
	cargar_info();
	registroFacebook();
});

function login () {
	$('#login').submit(function(e){
		correo 		= $('#email').val().toLowerCase();
		password 	= $('#password').serialize();
		cadena		= 'usuario_email=' + correo + '&' + password;
		$.post("/php/login.php",
			cadena,
			function(data){
				//LOGIN VIEJO - Se modifico 15/02/2014
				//login = data.login;
				/*if(login == true){
					window.location.href = "/html/Pedido.html";
				}
				else{
					alert("Datos erroneos");
				}*/
				//LOGIN NUEVO, verifica las tres condiciones
				if(data.usuario_existe && data.usuario_pass && data.usuario_activado){
					if(data.usuario_pro == true){
						window.location.href = "/html/Pedido.html";
					}
					else{
						window.location.href = "/html/Catalogo.php";
					}
					
				}
				else{
					alert("Datos erroneos");
				}
			},
			'json');
		e.preventDefault();
	});
}

/*function cerrar_sesion () {
	$('#cerrar_sesion').click(function(e){
		$.ajaxSetup({async:false});
		$.post("../php/cierra_sesion.php");
		var delay = 1000; //Your delay in milliseconds
	    setTimeout(function(){ window.location.href = "../index.html"; }, delay);
	    e.preventDefault();
	    $.ajaxSetup({async:true});
	});
}*/

function cerrar_sesion() {
	$('#nav_bar').on("click", "#cerrar_sesion", function(e){
		$.ajaxSetup({async:false});
		$.post("/php/cierra_sesion.php");
		var delay = 1000; //Your delay in milliseconds
	    setTimeout(function(){ window.location.href = "../index.php"; }, delay);
	    e.preventDefault();
	    $.ajaxSetup({async:true});
	});
}

function cargar_info() {
	$("#searchnav").load("../html/layouts/search_nav_layout.html");
	$("#infos").load("../html/layouts/infos.html");
	$("#footer").load("../html/layouts/pie_pagina.html");
}

function registroFacebook(){
	$("#registro_facebook").click(function(e){
		/*alert("lel");
          if (respuestaFacebook.status === 'connected') {
             window.location.href = "/html/Catalogo.php";
          } else if (respuestaFacebook.status === 'not_authorized') {
            FB.login();
        } else {
          FB.login();
        }*/
	    FB.Event.subscribe('auth.authResponseChange', function(response) {
	    	respuestaFacebook = response;
	    });
	    if (respuestaFacebook.status === 'connected') {
             window.location.href = "/html/Catalogo.php";
          } else if (respuestaFacebook.status === 'not_authorized') {
            FB.login();
        } else {
          FB.login();
        }
	     
	});
	
}
