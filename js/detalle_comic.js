$(document).ready(function(){
	cargarComic(comic_id);
	verificaSesion();
});

function verificaSesion(){
	$.ajaxSetup({async:false});
	$.post("../php/verifica_sesion.php",
		function(data){
			verifica = data.ver_sesion.estado;
			if(verifica == true){
				$("#nav_bar").load("../html/layouts/navbar_login_layout.html");
			}
			else{
				$("#nav_bar").load("../html/layouts/navbar_nologin_layout.html");
			}
		},
		'json');
	$.ajaxSetup({async:true});
}

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

			}
		},
		'json');
}