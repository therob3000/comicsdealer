$(document).ready(function(){
	verificaSesion();
	modalIniciarSesion();
        modalRegistrar();
        registroFacebook();
        registroCorreo();
        finalizarCompra();
	cargarArticulo(articulo_id);
	cargarArticulosArchivo();
	//cargarCatalogoComics2(0,4, "../html/layouts/catalogo_layout_index.html");
	botonComprarNologin();
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
				$("#articulo_resumen").html(data.articulo_resumen);
				$("#articulo_cita").text(data.articulo_cita);
				$("#articulo_cita_autor").text(data.articulo_cita_autor);
				$("#articulo_subtitulo").text(data.articulo_subtitulo);
				$("#articulo_principal").html(data.articulo_principal);
				$("#articulo_segundo_subtitulo").html(data.articulo_segundo_subtitulo);
				$("#articulo_secundario").html(data.articulo_secundario);
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
				$("#siguiente").hide();
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

function verificaSesion(){
	$.ajaxSetup({async:false});
	$.post("../php/verifica_sesion.php",
		function(data){
			verifica = data.ver_sesion.estado;
                        nombre = data.ver_sesion.usuario_nombre;
                        //SI EL USUARIO YA INICIO SESION
			if(verifica == true){
                            if(data.ver_sesion.usuario_pro != 1){
				$("#nav_bar").find("#nav_pedido").remove();
                            }
                                $("#nav_bar").find("#botonMenUsuario").append("<span class='glyphicon glyphicon-list-alt'></span> "+nombre);
				$("#nav_bar").find("#botonFinalizarCompra").html("<button class='btn btn-success' type='button'><span class='glyphicon glyphicon-shopping-cart'></span> Finalizar Compra <span class='badge' id='compraTotal'></span></button>");
                                botonComprarInit();
			}
		},
		'json');
	$.ajaxSetup({async:true});
}

function modalIniciarSesion(){
	$("#nav_bar").on("click", "#loginButton", function(e){
		$('#myModal').modal('show');
	});
}

function botonComprarNologin(){
	$(".btn-comprar").on("click", function(){
		$('#myModal').modal('show');
	})
}

function botonComprarInit(){
	$.post("/php/elementosComprados.php", function(data){
			$("#nav_bar").find("#compraTotal").text(data.totalCompra);
		}, 'json');
}