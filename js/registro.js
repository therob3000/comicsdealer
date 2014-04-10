var existe_email = false;
var ver_correo;

$(document).ready(function(){
	cargarNavBar();
	modalIniciarSesion();
	$.ajaxSetup({async:false});
	$.post("../php/cierra_sesion.php");
	$.ajaxSetup({async:true});
	$('#registro').submit(function(e){
		password 	= $('#password').val();
		password2 	= $('#password2').val();
		chars1		= password.length;
		chars2		= password2.length;
		email		= $('#email_registro').val().toLowerCase();
		nombre		= $('#nombre').val();
		var passwords = false;
		alert(existe_email);
		alert(nombre);
		alert(email);
		$('.alert').remove();

		if(!nombre){
			$('#formnombre').append('<div class="alert alert-danger"><strong>Este campo es obligatorio</strong> vuelve a intentarlo.</div>');
			$('#password').val('');
			$('#password2').val('');	
		}
		
		if(!email){
			$('#formemail').append('<div class="alert alert-danger"><strong>Este campo es obligatorio</strong> vuelve a intentarlo.</div>');
			$('#password').val('');
			$('#password2').val('');
		}
		else{
			$.ajaxSetup({async:false});
			$.post("../php/verifica_correo.php",
			$('#email').serialize(),
			function(data){
				existe_email = data.correo;
				//alert(existe_email);
				if(existe_email == true){
					$('#formemail').append('<div class="alert alert-danger"><strong>Este correo ya está registrado</strong> vuelve a intentarlo.</div>');
					$('#email').val('');
					$('#password').val('');
					$('#password2').val('');
					ver_correo = true;
				}
				else
					ver_correo = false;
			},
			'json');
			$.ajaxSetup({async:true});
			
		}

		if(chars1 < 8){
			$('#formpass').append('<div class="alert alert-danger"><strong>La contraseña es menor a 8 caracteres</strong> vuelve a intentarlo.</div>');
			$('#password').val('');
			$('#password2').val('');
		}

		if(password != password2){
			$('#formpass2').append('<div class="alert alert-danger"><strong>Las contraseñas no son iguales</strong> vuelve a intentarlo.</div>');
			$('#password').val('');
			$('#password2').val('');
			passwords = false;
		}
		else{
			passwords = true;
		}

		if(nombre && ver_correo == false && passwords == true){
			//Cadena a pasar al archivo php
			cadena = $('input[name!=usuario_email]', this).serialize();
			//alert(cadena);
			correo = $('#email').val().toLowerCase();
			//alert(correo);
			cadena = cadena + '&usuario_email=' + correo;
			//alert(cadena);
			cadena = cadena + '&tipo_registro=' + tipo_registro;
			//console.log(cadena);

			//Hacemos INSERT en la base de datos
			$.post("../php/registro.php",
				cadena,
				function(data){
					exito = data.registro;
					//alert(exito);
				},
				'json');

			//Ocultamos el formulario de registro para mostrar un mensaje de exito
			$('#registro').hide();
			$('#info').hide();
			$('#registroContainer').append('<div class="alert alert-success"><strong>Tus datos han sido registrados</strong> te hemos enviado un correo de confirmación, revisa tu bandeja de entrada, te estamos redirigiendo a la página inicial.</div>');

			var delay = 5000; //Your delay in milliseconds
	        setTimeout(function(){ window.location.href = "../index.html"; }, delay);
		}

		e.preventDefault();
	});	
	
	
});

function cargarNavBar(){
	$("#nav_bar").load("../html/layouts/navbar_nologin_layout.html");
}

function modalIniciarSesion(){
	$("#nav_bar").on("click", "#loginButton", function(e){
		$('#myModal').modal('show');
	});
}
