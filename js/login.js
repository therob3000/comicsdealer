$(document).ready(function(){
	login();
	cerrar_sesion();
	cargar_info();
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
