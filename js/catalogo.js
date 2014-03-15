
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
					$("#"+val.inventario_id).find("#cat_personaje").text(val.cat_comic_personaje)
					$("#"+val.inventario_id).find("#cat_titulo").text(val.cat_comic_titulo+" #"+val.cat_comic_numero_ejemplar);
					$("#"+val.inventario_id).find("#cat_descripcion").text(val.cat_comic_descripcion);
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
					$("#"+val.inventario_id).find('#boton_comprar').html("<a class='btn btn-success btn-comprar' href='/html/Catalogo.php' role='button'>Comprar >></a>");
					$("#"+val.inventario_id).find('#cat_detalle').attr('href', "/html/Detalle.php?comic_id="+val.inventario_id);
					$("#"+val.inventario_id).find("#cat_imagen").attr("src", val.cat_comic_imagen_url);
					$("#"+val.inventario_id).find("#cat_personaje").text(val.cat_comic_personaje)
					$("#"+val.inventario_id).find("#cat_titulo").text(val.cat_comic_titulo+" #"+val.cat_comic_numero_ejemplar);
					$("#"+val.inventario_id).find("#cat_descripcion").text(val.cat_comic_descripcion);
					$("#"+val.inventario_id).find("#cat_precio_venta").text("$"+val.inventario_precio_salida+" MXN");
				});
				
		
			});
			
		},
		'json');
	$.ajaxSetup({async:true});

}



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