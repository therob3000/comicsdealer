$(document).ready(function(){
	cargarArticulos(0, 5);
});

function cargarArticulos(salto, rango){
	cadena = "salto="+salto+"&rango="+rango;
	$.ajaxSetup({async:false});
	$.get("../php/cargarArticulos.php",
		cadena,
		function(data){
			$.each(data, function(i, val){
				$.get("../html/layouts/articulos_index_layout.html", function(data){
					$("#articulos").append(data);
					$("#articulos").find("#articulo").attr("id", val.articulo_id);
					$("#"+val.articulo_id).find("#articulo_imagen").attr("src", val.articulo_imagen);
					$("#"+val.articulo_id).find("#articulo_titulo").text(val.articulo_titulo);
					$("#"+val.articulo_id).find("#articulo_fecha_autor").text(val.articulo_fecha+" por "+val.articulo_autor);
					$("#"+val.articulo_id).find("#articulo_resumen").text(val.articulo_resumen);
					$("#"+val.articulo_id).find("#articulo_boton").attr("href", "/html/Articulos.php?articulo_id="+val.articulo_id);
				});
			});
		},
		'json');
	$.ajaxSetup({async:true});
}