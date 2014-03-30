$(document).ready(function(){
	verificaSesion(comic_id);
	botonComprar();
	botonEliminar();
	finalizarCompra();
	botonComprarNologin();
});

function verificaSesion(comic_id){
	$.ajaxSetup({async:false});
	$.post("../php/verifica_sesion.php",
		function(data){
			verifica = data.ver_sesion.estado;
			if(verifica == true){
				$("#nav_bar").load("../html/layouts/navbar_login_layout.html");
				$("#nav_bar").find("#botonFinalizarCompra").html("<button class='btn btn-success' type='button'>Finalizar Compra<span class='badge' id='compraTotal'></span></button>");
				botonComprarInit();
				cargarComic2(comic_id);
			}
			else{
				$("#nav_bar").load("../html/layouts/navbar_nologin_layout.html");
				cargarComic(comic_id);
			}
		},
		'json');
	$.ajaxSetup({async:true});
}

//Cargar el comic cuando el usuario NO HA INICIADO SESION
function cargarComic(comic_id){
	cadena = "comic_id="+comic_id;

	$.get("../php/cargarComicDetalle.php",
		cadena,
		function(data){
			if(data.comic_estado == true){
				$('#comic_img').attr('src',data.comic.cat_comic_imagen_url);
				$('#comic_titulo').text(data.comic.cat_comic_titulo);
				$('#comic_personaje').text(data.comic.cat_comic_personaje);
				$('#comic_descripcion').text(data.comic.cat_comic_descripcion);
				$('#comic_precio').text("$"+data.comic.inventario_precio_salida+" MXN");
				$('#boton_eliminar').hide();
				$('#boton_comprar').hide();
			}
		},
		'json');
}

//Cargar el comic cuando el usuario HA INICIADO SESION
function cargarComic2(comic_id){
	cadena = "comic_id="+comic_id;

	$.get("../php/cargarComicDetalle2.php",
		cadena,
		function(data){
			if(data.comic_estado == true){
				$('#comic_img').attr('src',data.comic.cat_comic_imagen_url);
				$('#comic_titulo').text(data.comic.cat_comic_titulo);
				$('#comic_personaje').text(data.comic.cat_comic_personaje);
				$('#comic_descripcion').text(data.comic.cat_comic_descripcion);
				$('#comic_precio').text("$"+data.comic.inventario_precio_salida+" MXN");
				
				if($.inArray(data.comic.inventario_id, data.agregados) != -1){
					$('#boton_comprar_nologin').hide();					
					$('#boton_comprar').hide();
					$('.btn-eliminar').attr("id", data.comic.inventario_id);
					$('.btn-comprar').attr("id", data.comic.inventario_id);
				}
				else{
					$('#boton_comprar_nologin').hide();
					$('#boton_eliminar').hide();
					$('.btn-comprar').attr("id", data.comic.inventario_id);
					$('.btn-eliminar').attr("id", data.comic.inventario_id);
				}

			}
		},
		'json');
}

function botonComprar(){
	$(".btn-comprar").on("click", function(){
		cadena = "cat_comic_inventario_id="+$(this).attr('id');
		$.post("/php/agregarCompra.php",cadena,function(data){
			$("#nav_bar").find("#compraTotal").text(data.totalCompra);
		}, 'json');
		$("#boton_comprar").hide();
		$("#boton_eliminar").show();
	});
}

function botonEliminar(){
	$(".btn-eliminar").on("click", function(){
		cadena = "cat_comic_inventario_id="+$(this).attr('id');
		$.post("/php/eliminarCompra.php",cadena);
		$("#boton_eliminar").hide();
		$("#boton_comprar").show();
	});
}

function botonComprarNologin(){
	$(".btn-comprar-nologin").on("click", function(){
		$('#myModal').modal('show');
	})
}

function botonComprarInit(){
	$.post("/php/elementosComprados.php", function(data){
			$("#nav_bar").find("#compraTotal").text(data.totalCompra);
		}, 'json');
}

function finalizarCompra(){
	$('#botonFinalizarCompra').on("click", function(){
		window.location.href = "/html/Compra.php";
	});
}