$(document).ready(function(){
	login();
	cerrar_sesion();
	
});

function login (argument) {
	$('#login').submit(function(e){
		//alert($(this).serialize());
		//console.log($(this).serialize());
		$.post("../php/login.php",
			$(this).serialize(),
			function(data){
				alert("funciona");
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