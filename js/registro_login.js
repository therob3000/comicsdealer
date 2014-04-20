function modalIniciarSesion(){
	$("#nav_bar").on("click", "#loginButton", function(e){
		$('#myModal').modal('show');
	});
}

function modalRegistrar(){
	$("#nav_bar").on("click", "#registroButton", function(e){
		$('#myModal2').modal('show');
	});
}

function registroFacebook(){
  $("#registro_facebook").click(function(e){
    FB.login(function(response) {
           if (response.authResponse){
              FB.api('/me', function(response){
                nombre = response.name;
                correo = response.email;
                usuarioid = response.id;
                //console.log(nombre);
                window.location.href = "/html/Registro.php?usuario="+nombre+"&correo="+correo+"&fb_id="+usuarioid;
                });
            } 
            else{
             console.log('Authorization failed.');
            }
         },{scope: 'email'});
  });
}

function registroCorreo(){
    $("#registro_correo").click(function(e){
        window.location.href = "/html/Registro.php";
    });
}

function finalizarCompra(){
	$('#botonFinalizarCompra').on("click", function(){
		window.location.href = "/html/Compra.php";
	});
}


