$(document).ready(function(){
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