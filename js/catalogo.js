



function cargarCarouselComics(salto, rango, capa) {
	cadena = "salto="+salto+"&rango="+rango;
	$.ajaxSetup({async:false});
	$.get("../php/cargarCatalogo2.php",
		cadena,
		function(data){
			total = data.total;
			$.each(data.catalogo, function(i, val){
				$.get(capa, function(data2){
					$("#carousel_comics").append(data2);
					$("#carousel_comics").find("#catalogo_comic").attr("id", val.inventario_id);
					$("#"+val.inventario_id).find('#boton_comprar').html("<button class='btn btn-success btn-comprar' role='button'>Comprar</button>");
					$("#"+val.inventario_id).find('#cat_detalle').attr('href', "/html/Detalle.php?comic_id="+val.inventario_id);
					$("#"+val.inventario_id).find("#cat_imagen").attr("src", val.cat_comic_imagen_url);
					if(val.cat_comic_idioma == "ing"){
						$("#"+val.inventario_id).find("#cat_personaje").html(val.cat_comic_personaje+"<small> Inglés</small>");
					}else if(val.cat_comic_idioma == "esp"){
						$("#"+val.inventario_id).find("#cat_personaje").html(val.cat_comic_personaje+"<small> Español</small>");
					}
					$("#"+val.inventario_id).find("#cat_detalle2").attr("href","/html/Detalle.php?comic_id="+val.inventario_id);
					$("#"+val.inventario_id).find("#cat_titulo").text(val.cat_comic_titulo+" #"+val.cat_comic_numero_ejemplar);
					/*texto = val.cat_comic_descripcion;
					$("#"+val.inventario_id).find("#cat_descripcion").text(texto.substr(0, 180)+" ...");*/
					$("#"+val.inventario_id).find("#cat_precio_venta").text("$"+val.inventario_precio_salida+" MXN");
				});
				
		
			});
			
		},
		'json');
	$.ajaxSetup({async:true});
}
