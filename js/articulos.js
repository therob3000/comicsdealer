$(document).ready(function(){
	//alert(articulo_id);
	cargarArticulo(articulo_id);
});

function cargarArticulo(articulo_id){
	cadena = "articulo_id="+articulo_id;
	$.get("../php/cargarArticulo.php",
		cadena,
		function(data){
			if(data.articulo == true){
				$("#articulo_titulo").text(data.articulo_titulo);
				$("#articulo_autor").text(data.articulo_autor);
				$("#articulo_resumen").text(data.articulo_resumen);
				$("#articulo_cita").text(data.articulo_cita);
				$("#articulo_subtitulo").text(data.articulo_subtitulo);
				$("#articulo_principal").text(data.articulo_principal);
				$("#articulo_segundo_subtitulo").text(data.articulo_segundo_subtitulo);
				$("#articulo_secundario").text(data.articulo_secundario);
			}
		},
		'json');
}