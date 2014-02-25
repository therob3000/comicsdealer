function cargarCatalogoComics (salto, rango) {
	cadena = "salto="+salto+"&rango="+rango;
	$.ajaxSetup({async:false});
	$.get("../php/cargarCatalogo.php",
		cadena,
		function(data){
			$.each(data, function(i, val){
				$.get("../html/layouts/catalogo_layout.html", function(data){
					$("#catalogo_comics").append(data);
					$("#catalogo_comics").find("#catalogo_comic").attr("id", val.cat_comic_id);
					$("#"+val.cat_comic_id).find("#cat_titulo").text(val.cat_comic_titulo);
				});
			});
		},
		'json');
	$.ajaxSetup({async:true});
}