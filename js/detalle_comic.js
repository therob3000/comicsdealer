$(document).ready(function(){
	
	verificaSesion(comic_id);
});

function verificaSesion(comic_id){
	$.ajaxSetup({async:false});
	$.post("../php/verifica_sesion.php",
		function(data){
			verifica = data.ver_sesion.estado;
			if(verifica == true){
				$("#nav_bar").load("../html/layouts/navbar_login_layout.html");
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
				$('#boton_comprar').html("<a class='btn btn-success' href='#' role='button'>Comprar »</a>");
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
					
					$('#boton_comprar').hide();
					$('.btn-eliminar').attr("id", data.comic.inventario_id);
					$('.btn-comprar').attr("id", data.comic.inventario_id);
				}
				else{
					
					$('#boton_eliminar').hide();
					$('.btn-comprar').attr("id", data.comic.inventario_id);
					$('.btn-comprar').attr("id", data.comic.inventario_id);
				}

			}
		},
		'json');
}