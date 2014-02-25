$(document).ready(function(){
	modalIniciarSesion();
	cargarNavBar();
	$.ajaxSetup({async:false});
	$.post("../php/cierra_sesion.php");
	$.ajaxSetup({async:true});

	$('#cambio').submit(function(e){
		//alert($(this).serialize());
		$.post("../php/recuperar_contrasenia.php",
			$(this).serialize(),
			function(data){
				//alert(data.pass);
				if (data.pass == true) {
					$('#cambio').hide();
					$('#pass').append('<div class="alert alert-success"><strong>Tu password ha sido reestablecido</strong> te hemos enviado un correo.</div>');
				}
			},
			'json');
		e.preventDefault();
	});
});

function cargarNavBar(){
	$("#nav_bar").load("/html/layouts/navbar_nologin_layout.html");
}

function modalIniciarSesion(){
	$("#nav_bar").on("click", "#loginButton", function(e){
		$('#myModal').modal('show');
	});
}
