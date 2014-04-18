var existe_email = false;
var ver_correo;

$(document).ready(function(){
	if(nombre != ""){
		$("#nombre").val(nombre);
		$("#nombre").attr("disabled", "disabled");
	}

	if(correo != ""){
		$("#email_registro").val(correo);
		$("#email_registro").attr("disabled", "disabled");
	}

	cargarNavBar();
	modalIniciarSesion();
	$.ajaxSetup({async:false});
	$.post("../php/cierra_sesion.php");
	$.ajaxSetup({async:true});
	$('#registro').submit(function(e){
		password 	= $('#password_registro').val();
		password2 	= $('#password2').val();
		chars1		= password.length;
		chars2		= password2.length;
		email		= $('#email_registro').val().toLowerCase();
		nombre		= $('#nombre').val();
		var passwords = false;
		
		$('.alert').remove();

		if(!nombre){
			$('#formnombre').append('<div class="alert alert-danger"><strong>Este campo es obligatorio</strong> vuelve a intentarlo.</div>');
			$('#password_registro').val('');
			$('#password2').val('');	
		}
		
		if(!email){
			$('#formemail').append('<div class="alert alert-danger"><strong>Este campo es obligatorio</strong> vuelve a intentarlo.</div>');
			$('#password_registro').val('');
			$('#password2').val('');
		}
		else{
			cadena = "usuario_email="+$('#email_registro').val().toLowerCase();
			$.ajaxSetup({async:false});
			$.post("/php/verifica_correo.php",
			cadena,
			function(data){
				existe_email = data.correo;
				alert(existe_email);
				if(existe_email == true){
					alert(existe_email);
					$('#formemail').append('<div class="alert alert-danger"><strong>Este correo ya está registrado</strong> vuelve a intentarlo.</div>');
					$('#email_registro').val('');
					$('#password_registro').val('');
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
			$('#password_registro').val('');
			$('#password2').val('');
		}

		if(password != password2){
			$('#formpass2').append('<div class="alert alert-danger"><strong>Las contraseñas no son iguales</strong> vuelve a intentarlo.</div>');
			$('#password_registro').val('');
			$('#password2').val('');
			passwords = false;
		}
		else{
			passwords = true;
		}

		if(nombre && ver_correo == false && passwords == true){
			pass = $('#password2').val();
			//Cadena a pasar al archivo php
			nombre = $('#nombre').val();
			//alert(cadena);
			correo = $('#email_registro').val().toLowerCase();
			//alert(correo);
			cadena = 'usuario_nombre='+nombre+ '&usuario_email=' + correo+'&usuario_password='+pass+'&usuario_facebook_id='+usuario_facebook_id;
			//alert(cadena);
			cadena = cadena + '&tipo_registro=0';
			//console.log(cadena);
			alert(cadena);

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
	        setTimeout(function(){ window.location.href = "../index.php"; }, delay);
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
