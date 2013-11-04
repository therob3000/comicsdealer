var nombre;
var email;

$(document).ready(function(){
	verificaSesion();
	cargarCompanias();
	cargarPersonajes();
	realizarPedido();
	
});

function verificaSesion(){
	$.ajaxSetup({async:false});
	$.post("../php/verifica_sesion.php",
		function(data){
			verifica = data.ver_sesion.estado;
			if(verifica == true){
				usuario_nombre 		= data.ver_sesion.usuario_nombre;
				usuario_correo 		= data.ver_sesion.usuario_email;
				usuario_id			= data.ver_sesion.usuario_id;
				usuario_max_pedidos	= data.ver_sesion.usuario_max_pedidos;

				$('#usuario').text(usuario_nombre);
				if(usuario_max_pedidos == 3){
					$('#pedido').hide();
					$('#pedido_form').append('<div class="alert alert-danger"><strong>Lo sentimos :(</strong> por el momento solo podemos manejar 3 peticiones por usuario.</div>');
				}
			}
			else{
				alert("No ha iniciado sesion");
				window.location.href = "../index.html";
			}
		},
		'json');
	$.ajaxSetup({async:true});
}

function cargarCompanias(){
	$.get("../php/cargarCompanias.php",
		function(data){
			//alert(data);
			$('#compania').append('<option selected>Selecciona una compañia</option>');
			$.each(data, function(i, val){
				$('#compania').append('<option value='+val.compania_id+'>'+val.compania+'</option>');
			});

		},
		'json');
}

function cargarPersonajes(){
	$('#compania').change(function() {
		$('#personaje').empty();
		$.get("../php/cargarPersonajes.php",
			$('#compania').serialize(),
			function(data){
				$('#personaje').append('<option selected>Selecciona un personaje</option>');
				$.each(data, function(i, val){
					$('#personaje').append('<option value='+val.personaje_id+'>'+val.personaje+'</option>');
				});
			},
			'json');
	});
}

function realizarPedido(){
	$('#pedido').submit(function(e){
		formulario_pedido = $(this).serialize();
		//alert(formulario_pedido);
		cadena = formulario_pedido+"&usuario_id="+usuario_id;
		console.log(cadena);
		
		$.post("../php/pedido.php",
			cadena,
			function(data){
				//alert(data.pedido);
				if(data.pedido == true){
					$('#pedido').hide();
					$('#pedido_form').append('<div class="alert alert-success"><strong>Tus pedido ha sido registrado!</strong> la busqueda de tus cómics ha comenzado, en los próximos días recibiras un correo con el costo y la forma de pago que hayas seleccionado.</div>');
				}
				else{
					alert("Algo horrendo pasó :(");
				}
			},
			'json');
		var delay = 3000; //Your delay in milliseconds
	    setTimeout(function(){ window.location.href = "/html/Pedido.html"; }, delay);
		e.preventDefault();
	});

}

