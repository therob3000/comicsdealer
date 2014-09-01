$(document).ready(function(){
	$("#entrega_df").hide();
	$("#entrega_republica").hide();
	$("#zipcode").hide();
	verificaSesion();
	eliminaComic();
	formaPago();
	finalizarCompra_rep();
	finalizarCompra_df();
	$("#cerrarModal").click(function(){
		window.location.href = "/html/Catalogo.php";
	});
});

function cargarComicsCompra(){
	$.ajaxSetup({async:false});
	$.get("/php/cargarComicsCompra.php",
		function(data){
			var totalComics = 0;
			$.each(data.compras, function(i,val){
				totalComics += Number(val.inventario_precio_salida);
				$.get("/html/layouts/compra_final_layout.html", function(data2){
					$("#compras").append(data2);
					$("#compras").find("#compra_comic").attr("id", val.cat_comic_unique_id);
					$("#"+val.cat_comic_unique_id).find("#imagen").attr("src", val.cat_comic_imagen_url);
                                        $("#"+val.cat_comic_unique_id).find("#inventario_id").attr("id", val.inventario_id);
					$("#"+val.cat_comic_unique_id).find("#catal").text(val.cat_comic_descripcion);
                                        //alert(val.inventario_paquete);
                                        if(val.inventario_paquete !== null){
                                            titulo = val.cat_comic_titulo + " PAQUETE";
                                        }
                                        else{
                                            titulo = val.cat_comic_titulo;
                                        }
					$("#"+val.cat_comic_unique_id).find("#titulo").text(titulo);
					$("#"+val.cat_comic_unique_id).find("#precio").text("$"+val.inventario_precio_salida+" MXN");
					$("#"+val.cat_comic_unique_id).find(".eliminaComic").attr("id", val.cat_comic_unique_id);
				});
			});
			$('#totalComics').html('<h2>Total: $'+totalComics+'</h2>');
		},
		'json');
}

function verificaSesion(){
	$.ajaxSetup({async:false});
	$.post("../php/verifica_sesion.php",
		function(data){
			verifica = data.ver_sesion.estado;
                        nombre = data.ver_sesion.usuario_nombre;
			if(verifica == true){
			if(data.ver_sesion.usuario_pro != 1){
					$("#nav_bar").find("#nav_pedido").remove();
				}
                                $("#nav_bar").find("#botonMenUsuario").append("<span class='glyphicon glyphicon-list-alt'></span> "+nombre);
				$("#nav_bar").find("#botonFinalizarCompra").html("<button class='btn btn-success' type='button'><span class='glyphicon glyphicon-shopping-cart'></span> Finalizar Compra <span class='badge' id='compraTotal'></span></button>");
                                botonComprarInit();
                                cargarComicsCompra();
			}
			else{
				alert("No ha iniciado sesion");
				window.location.href = "../index.html";
			}
		},
		'json');
	$.ajaxSetup({async:true});
}

function botonComprarInit(){
	$.post("/php/elementosComprados.php", function(data){
			$("#nav_bar").find("#compraTotal").text(data.totalCompra);
		}, 'json');
}

function eliminaComic(){
	$(".eliminaComic").on("click", function(){
		id = $(this).attr("id");
		cadena = "cat_comic_unique_id="+$(this).attr('id');
                alert(cadena);
		$.post("/php/eliminarCompra.php",cadena);
		//$("#"+id).remove();
		location.reload(true);
	});
}

function finalizarCompra_rep(){
	$("#formasPago").submit(function(e){
		//$('#myModal').modal('show');
		cadena = $(this).serialize();
		cadena = cadena + "&codigo_postal="+$("#zipcode").val();
		$.ajaxSetup({async:false});
		$.post("/php/insertarCompra_Tran.php",
			cadena, function(data){
				if(data.exito){
					//alert(data.exito);
					$("#inicial").text("Gracias por tu compra "+data.usuario_nombre);
					$("#correo").text(data.usuario_correo);
				}
				else{
					alert("Ocurrio un error en tu compra, probablemente alguien te gano algun comic :(");
				}
			}, 'json');
		$.ajaxSetup({async:true});
		$('#myModal').modal('show');
		e.preventDefault();
	});
}

function finalizarCompra_df(){
	$("#finalizarCompra_df").click(function(e){
		//$('#myModal').modal('show');
		cadena = "forma_pago_id=4&codigo_postal=NULL"
		$.ajaxSetup({async:false});
		$.post("/php/insertarCompra_Tran.php",
			cadena, function(data){
				if(data.exito){
					//alert(data.exito);
					$("#inicial").text("Gracias por tu compra "+data.usuario_nombre);
					$("#correo").text(data.usuario_correo);
				}
				else{
					alert("Ocurrio un error en tu compra, probablemente alguien te gano algun comic :(");
				}
			}, 'json');
		$.ajaxSetup({async:true});
		$('#myModal').modal('show');
		e.preventDefault();
	});
}

function formaPago(){

	$( "input#entrega" ).on( "click", function() {
		//alert($( "input:checked" ).val());
		entrega = $( "input:checked" ).val();
		if(entrega == 'df'){
			$("#entrega_df").show();
			$("#entrega_republica").hide();
			$("#zipcode").hide();
		}
		else{
			$("#entrega_df").hide();
			$("#entrega_republica").show();
			$("#zipcode").show();
		}
	});

}



