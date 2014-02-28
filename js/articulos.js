$(document).ready(function(){
	cargarArticulo(articulo_id);
	cargarArticulosArchivo();
});

function cargarArticulo(articulo_id){
	$(".fb-share-button").attr("data-href", "http://www.comicsdealer.com/html/Articulos.php?articulo_id="+articulo_id);
	
	cadena = "articulo_id="+articulo_id;
	$.get("../php/cargarArticulo.php",
		cadena,
		function(data){
			if(data.articulo == true){
				$("#articulo_titulo").text(data.articulo_titulo);
				$("#articulo_fecha_autor").text(data.articulo_fecha+" por "+data.articulo_autor);
				$("#articulo_resumen").text(data.articulo_resumen);
				$("#articulo_cita").text(data.articulo_cita);
				$("#articulo_subtitulo").text(data.articulo_subtitulo);
				$("#articulo_principal").text(data.articulo_principal);
				$("#articulo_segundo_subtitulo").text(data.articulo_segundo_subtitulo);
				$("#articulo_secundario").text(data.articulo_secundario);
				$("#articulo_imagen").attr("src", data.articulo_imagen);
				$(".twitter-share-button").attr("data-url", "http://www.comicsdealer.com/html/Articulos.php?articulo_id="+articulo_id);
				$(".twitter-share-button").attr("data-text", data.articulo_titulo);
			}
			else{
				$(".blog-post").hide();
				$("#social").hide();
				$("#siguiente").hide();
				$("#main").append("<h1>Epa! Ese articulo no existe campeon!</h1>");
			}
			if(articulo_id-1 == 0){
				$("#anterior").html("<a href='#'>Anterior</a>");
			}
			else{
				$("#anterior").html("<a href='./Articulos.php?articulo_id="+(+articulo_id-1)+"'>Anterior</a>");
			}
			if(articulo_id >= data.total){
				$("#siguiente").togglehide();
			}
			else{
				$("#siguiente").html("<a href='./Articulos.php?articulo_id="+(+articulo_id+1)+"'>Siguiente</a>");
			}
		},
		'json');


}

function cargarArticulosArchivo(){
	$.get("../php/cargarArchivo.php",
		function(data){
			$.each(data, function(i, val){
				//alert(val.articulo_id);
				$("#archivo").append("<li><a href='./Articulos.php?articulo_id="+val.articulo_id+"'>"+val.articulo_titulo+"</a></li>");
			});
		},
		'json');
}


