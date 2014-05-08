var usuario_id;

$(document).ready(function(){
	//cargarNavBar();
	verificaSesion();
	validaNuevoPassword();
	cambiarCorreo();
});

function verificaSesion(){
	$.ajaxSetup({async:false});
	$.post("../php/verifica_sesion.php",
		function(data){
			verifica 	= data.ver_sesion.estado;
			pro 		= data.ver_sesion.usuario_pro;
			if(verifica == true && pro == true){
                                nombre 		= data.ver_sesion.usuario_nombre;
				usuario_correo 		= data.ver_sesion.usuario_email;
				usuario_id		= data.ver_sesion.usuario_id;
				usuario_pro 		= data.ver_sesion.usuario_pro;
				//$("#nav_bar").load("../html/layouts/navbar_login_layout.html");
				$("#nav_bar").find("#botonMenUsuario").append("<span class='glyphicon glyphicon-list-alt'></span> "+nombre);
				$("#nav_bar").find("#botonFinalizarCompra").html("<button class='btn btn-success' type='button'><span class='glyphicon glyphicon-shopping-cart'></span> Finalizar Compra <span class='badge' id='compraTotal'></span></button>");
                                botonComprarInit();
			}
			else{
				alert("No ha iniciado sesion o no eres usuario PRO amiguito");
				window.location.href = "../index.html";
			}
		},
		'json');
	$.ajaxSetup({async:true});
}

function validaNuevoPassword(){	
	$('#cambio_pass').submit(function(e){
		$('.alert').remove();
		password1 	= $('#password1').val();
		password2 	= $('#password2').val();
		chars1		= password1.length;
		chars2		= password2.length;

		var passwords = false;

		if(chars1 < 8){
			$('#formpass1').append('<div class="alert alert-danger"><strong>La contraseña es menor a 8 caracteres</strong> vuelve a intentarlo.</div>');
			$('#password1').val('');
			$('#password2').val('');
		}

		if(password1 != password2){
			$('#formpass2').append('<div class="alert alert-danger"><strong>Las contraseñas no son iguales</strong> vuelve a intentarlo.</div>');
			$('#password1').val('');
			$('#password2').val('');
			passwords = false;
		}
		else{
			passwords = true;
		}
		
		if(password && passwords == true){
			cadena = $('#password').serialize()+"&"+$('#password1').serialize()+"&usuario_id="+usuario_id;
			console.log(cadena);
			$.post("../php/cambioPass.php",
				cadena,
				function(data){
					cambio = data.cambio;
					if(cambio == true){
						//alert("Tu contraseña ha sido cambiada con exito");
						$('#cambio_pass').hide();
						$('#mensajepass').append('<div class="alert alert-success"><strong>La contraseña ha sido cambiada con éxito</strong></div>');

					}
					else{
						alert("Algo horrible paso :(");
					}
				},
				'json');
		}
		e.preventDefault();
	});
}

function cambiarCorreo(){
	$('#cambio_email').submit(function(e){
		//alert($(this).serialize());
		$.post("../php/cambioCorreo.php",
			$(this).serialize(),
			function(data){
				cambio_correo = data.correo;
				//alert(data.correo);
				if (cambio_correo){
					$('#cambio_email').hide();
					$('#mensajemail').append('<div class="alert alert-success"><strong>Tu correo ha sido cambiado con éxito</strong> te hemos enviado un correo, revisa tu bandeja de entrada y verificalo. Tu sesión se cerrara.</div>');
					var delay = 5000; //Your delay in milliseconds
	        		setTimeout(function(){ window.location.href = "../index.php"; }, delay);
				} 
				else{
					alert("Algo horrible paso :(");
				}
			},
			'json'
			);
		e.preventDefault();
	});

}

function cargarNavBar(){
	$("#nav_bar").load("../html/layouts/navbar_login_layout.html", function(){
		$("#nav_bar").find(".menu_opcion#2").html("<a href='Pedido.html'>Pide Comics!</a>");
	});
}

function botonComprarInit(){
	$.post("/php/elementosComprados.php", function(data){
			$("#nav_bar").find("#compraTotal").text(data.totalCompra);
		}, 'json');
}

