
function cargarCatalogoComics (salto, rango) {
	cadena = "salto="+salto+"&rango="+rango;
	$.ajaxSetup({async:false});
	$.get("../php/cargarCatalogo.php",
		cadena,
		function(data){
			total = data.total;
			$.each(data.catalogo, function(i, val){
				$.get("../html/layouts/catalogo_layout.html", function(data){
					$("#catalogo_comics").append(data);
					$("#catalogo_comics").find("#catalogo_comic").attr("id", val.cat_comic_id);
					$("#"+val.cat_comic_id).find("#cat_imagen").attr("src", val.cat_comic_imagen_url);
					$("#"+val.cat_comic_id).find("#cat_personaje").text(val.cat_comic_personaje)
					$("#"+val.cat_comic_id).find("#cat_titulo").text(val.cat_comic_titulo+" #"+val.cat_comic_numero_ejemplar);
					//$("#"+val.cat_comic_id).find("#cat_descripcion").text(val.cat_comic_descripcion);
					$("#"+val.cat_comic_id).find("#cat_precio_venta").text("$"+val.cat_comic_precio_salida+" MXN");
				});
			});
			
		},
		'json');
	$.ajaxSetup({async:true});

}