var nombre;
var email;
var usuario_id;

$(document).ready(function(){
	verificaSesion();
	//cargarNavBar();
	cargarPromocionFinDeSemana('pedidos');
	cargarCompanias();
	cargarPersonajes();
	realizarPedido();
	realizarPedidoFinde();
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
				usuario_max_pedidos	= data.ver_sesion.usuario_max_pedidos;
				usuario_pro 		= data.ver_sesion.usuario_pro;
				//$("#nav_bar").load("../html/layouts/navbar_login_layout.html");
				$("#nav_bar").find("#botonMenUsuario").append("<span class='glyphicon glyphicon-list-alt'></span> "+nombre);
				$("#nav_bar").find("#botonFinalizarCompra").html("<button class='btn btn-success' type='button'><span class='glyphicon glyphicon-shopping-cart'></span> Finalizar Compra <span class='badge' id='compraTotal'></span></button>");
                                botonComprarInit();
				

				$('#usuario').text(nombre);
				if(usuario_max_pedidos == 3){
					$('#pedido').hide();
					$('#pedido_form').append('<div class="alert alert-danger"><strong>Lo sentimos :(</strong> por el momento solo podemos manejar 3 peticiones por usuario.</div>');
				}
			}
			else{
				alert("No ha iniciado sesion o no eres usuario PRO amiguito");
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
	var exito = false;
	$('#pedido').submit(function(e){
		personaje = $(this).find("#personaje option:selected").html();
		texto = $(this).find("#textolibre").val();
		lugar = $(this).find("#lugarEntrega option:selected").html();

		formulario_pedido = $(this).serialize();
		cadena = formulario_pedido+"&usuario_id="+usuario_id;
		
		$.post("../php/pedido.php",
			cadena,
			function(data){
				
				if(data.pedido == true){
					$('#myModal').find("#personajeModal").html("<strong>Personaje: </strong>"+personaje);
					$('#myModal').find("#textoModal").html("<strong>Descripcion: </strong>"+texto);
					$('#myModal').find("#lugarEntregaModal").html("<strong>Lugar de Entrega: </strong>"+lugar);
					$('#myModal').find("#correo").html("<strong>"+usuario_correo+"</strong>");

					$('#myModal').modal('show');
					aceptarCompra();
					
				}
				else{
					alert("No se ha podido generar el pedido. Contactanos en comics.dealer@gmail.com para mas informacion.");
				}
			},
			'json');
		
		e.preventDefault();
	});
}

function realizarPedidoFinde(){
	$('#pedidofinde').click(function(){
		cadena = "usuario_id="+usuario_id+"&compania_id=1&personaje_id=21&texto_libre=Promocion+Fin&pedido_forma_pago_id=1&lugar_entrega=No+definido";
		console.log(cadena);

		$.post("../php/pedido.php",
			cadena,
			function(data){
				//alert(data.pedido);
				if(data.pedido == true){
					$('#myModal').find("#inicial").hide();
					$('#myModal').find("#personajeModal").hide();
					$('#myModal').find("#textoModal").html("<strong>Gracias por comprar en la Promocion de Fin de Semana</strong>");
					$('#myModal').find("#lugarEntregaModal").hide();
					$('#myModal').find("#correo").html("<strong>"+usuario_correo+"</strong>");
					$('#myModal').find("#mensaje").text("Revisa tu correo para acordar la fecha y forma de pago. ")

					$('#myModal').modal('show');
					aceptarCompra();
					
				}
				else{
					alert("No se ha podido generar el pedido. Contactanos en comics.dealer@gmail.com para mas informacion.");
				}
			},
			'json');
	});
}

function aceptarCompra(){
	$('#cerrarModal').click(function(){
		window.location.href = "/html/Pedido.html";
	});
}

function cargarNavBar(){
	$("#nav_bar").load("../html/layouts/navbar_login_layout.html");
}

function botonComprarInit(){
	$.post("/php/elementosComprados.php", function(data){
			$("#nav_bar").find("#compraTotal").text(data.totalCompra);
		}, 'json');
}
