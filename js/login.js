$(document).ready(function(){
	login();
	cerrar_sesion();
	$('#original').hide();
	//$('#oferta').hide();
});

function login (argument) {
	$('#login').submit(function(e){
		//alert($(this).serialize());
		//console.log($(this).serialize());
		correo 		= $('#email').val().toLowerCase();
		password 	= $('#password').serialize();
		cadena		= 'usuario_email=' + correo + '&' + password;
		//alert(cadena);
		$.post("../php/login.php",
			cadena,
			function(data){
				login = data.login;
				if(login == true){
					window.location.href = "/html/Pedido.html";
				}
				else{
					alert("Datos erroneos");
				}
			},
			'json');
		e.preventDefault();
	});
}

function cerrar_sesion () {
	$('#cerrar_sesion').click(function(e){
		$.ajaxSetup({async:false});
		$.post("../php/cierra_sesion.php");
		var delay = 1000; //Your delay in milliseconds
	    setTimeout(function(){ window.location.href = "../index.html"; }, delay);
	    e.preventDefault();
	    $.ajaxSetup({async:true});
	});
}