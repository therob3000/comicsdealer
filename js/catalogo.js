
function cargarCatalogoComics (salto, rango) {
	cadena = "salto="+salto+"&rango="+rango;
	$.ajaxSetup({async:false});
	$.get("../php/cargarCatalogo.php",
		cadena,
		function(data){
			total = data.total;
			$.each(data.catalogo, function(i, val){
				$.get("../html/layouts/catalogo_layout.html", function(data2){
					$("#catalogo_comics").append(data2);
					$("#catalogo_comics").find("#catalogo_comic").attr("id", val.inventario_id);
					if($.inArray(val.inventario_id, data.agregados) != -1){
						$("#"+val.inventario_id).find('#boton_comprar').hide();
						$("#"+val.inventario_id).find('#boton_comprar').attr("id","boton_comprar"+val.inventario_id);
						$("#"+val.inventario_id).find('#boton_eliminar').attr("id","boton_eliminar"+val.inventario_id);
						$("#"+val.inventario_id).find('#boton_comprar'+val.inventario_id).html("<button class='btn btn-success btn-comprar' role='button' id="+val.inventario_id+">Agregar</button>");
						$("#"+val.inventario_id).find('#boton_eliminar'+val.inventario_id).html("<button class='btn btn-danger btn-eliminar' href='#' role='button' id="+val.inventario_id+">Eliminar</button>");
					}
					else{
						$("#"+val.inventario_id).find('#boton_eliminar').hide();
						$("#"+val.inventario_id).find('#boton_comprar').attr("id","boton_comprar"+val.inventario_id);
						$("#"+val.inventario_id).find('#boton_eliminar').attr("id","boton_eliminar"+val.inventario_id);
						$("#"+val.inventario_id).find('#boton_eliminar'+val.inventario_id).html("<button class='btn btn-danger btn-eliminar' href='#' role='button' id="+val.inventario_id+">Eliminar</button>");
						$("#"+val.inventario_id).find('#boton_comprar'+val.inventario_id).html("<button class='btn btn-success btn-comprar' href='#' role='button' id="+val.inventario_id+">Agregar</button>");
					}
					$("#"+val.inventario_id).find('#cat_detalle').attr('href', "/html/Detalle.php?comic_id="+val.inventario_id);
					$("#"+val.inventario_id).find("#cat_imagen").attr("src", val.cat_comic_imagen_url);
					$("#"+val.inventario_id).find("#cat_personaje").text(val.cat_comic_personaje);
					$("#"+val.inventario_id).find("#cat_titulo").text(val.cat_comic_titulo+" #"+val.cat_comic_numero_ejemplar);
					$("#"+val.inventario_id).find("#cat_idioma").text(val.cat_comic_idioma);
					texto = val.cat_comic_descripcion;
					//$("#"+val.inventario_id).find("#cat_descripcion").text(val.cat_comic_descripcion);
					$("#"+val.inventario_id).find("#cat_descripcion").text(texto.substr(0, 180)+" ...");
					$("#"+val.inventario_id).find("#cat_precio_venta").text("$"+val.inventario_precio_salida+" MXN");
				});
				
		
			});
			
		},
		'json');
	$.ajaxSetup({async:true});

}

function cargarCatalogoComics2(salto, rango) {
	cadena = "salto="+salto+"&rango="+rango;
	$.ajaxSetup({async:false});
	$.get("../php/cargarCatalogo2.php",
		cadena,
		function(data){
			total = data.total;
			$.each(data.catalogo, function(i, val){
				$.get("../html/layouts/catalogo_layout.html", function(data2){
					$("#catalogo_comics").append(data2);
					$("#catalogo_comics").find("#catalogo_comic").attr("id", val.inventario_id);
					$("#"+val.inventario_id).find('#boton_comprar').html("<button class='btn btn-success btn-comprar' role='button'>Comprar</button>");
					$("#"+val.inventario_id).find('#cat_detalle').attr('href', "/html/Detalle.php?comic_id="+val.inventario_id);
					$("#"+val.inventario_id).find("#cat_imagen").attr("src", val.cat_comic_imagen_url);
					/*$("#"+val.inventario_id).find("#cat_idioma").html("<small> "+val.cat_comic_idioma+"</small>");*/
					if(val.cat_comic_idioma == "ing"){
						$("#"+val.inventario_id).find("#cat_personaje").html(val.cat_comic_personaje+"<small> Inglés</small>");
					}else if(val.cat_comic_idioma == "esp"){
						$("#"+val.inventario_id).find("#cat_personaje").html(val.cat_comic_personaje+"<small> Español</small>");
					}
					$("#"+val.inventario_id).find("#cat_detalle2").attr("href","/html/Detalle.php?comic_id="+val.inventario_id);
					$("#"+val.inventario_id).find("#cat_titulo").text(val.cat_comic_titulo+" #"+val.cat_comic_numero_ejemplar);
					texto = val.cat_comic_descripcion;
					$("#"+val.inventario_id).find("#cat_descripcion").text(texto.substr(0, 180)+" ...");
					$("#"+val.inventario_id).find("#cat_precio_venta").text("$"+val.inventario_precio_salida+" MXN");
				});
				
		
			});
			
		},
		'json');
	$.ajaxSetup({async:true});
}
