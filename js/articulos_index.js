$(document).ready(function(){
	verificaSesion();
	modalIniciarSesion();
	cargarArticulos(pagina, 5);
	//cargarCatalogoComics2(0,4, "../html/layouts/catalogo_layout_index.html");
	botonComprarNologin();
        botonComprarInit();
});

function cargarArticulos(salto, rango){
	cadena = "salto="+salto+"&rango="+rango;
	$.ajaxSetup({async:false});
	$.get("../php/cargarArticulos.php",
		cadena,
		function(data){
			$.each(data.articulos, function(i, val){
				$.get("../html/layouts/articulos_index_layout.html", function(data){
					$("#articulos").append(data);
					$("#articulos").find("#articulo").attr("id", val.articulo_id)
					$("#"+val.articulo_id).find("#img_href").attr("href", "/html/Articulos.php?articulo_id="+val.articulo_id);
					$("#"+val.articulo_id).find("#articulo_imagen").attr("src", val.articulo_imagen);
					$("#"+val.articulo_id).find("#articulo_titulo").text(val.articulo_titulo);
					$("#"+val.articulo_id).find("#articulo_fecha_autor").text(val.articulo_fecha+" por "+val.articulo_autor);
					$("#"+val.articulo_id).find("#articulo_resumen").html(val.articulo_resumen);
					$("#"+val.articulo_id).find("#articulo_boton").attr("href", "/html/Articulos.php?articulo_id="+val.articulo_id);
				});
			});
			if(salto==0){
				$("#anterior").html("<a href='#'>Anterior</a>");
			}
			else{
				$("#anterior").html("<a href='./ArticulosIndex.php?pagina="+(+salto-rango)+"'>Anterior</a>");
			}
			if(+salto+rango >= data.total){
				$("#siguiente").toggle();
			}
			else{
				$("#siguiente").html("<a href='./ArticulosIndex.php?pagina="+(+salto+rango)+"'>Siguiente</a>");
			}
		},
		'json');
	$.ajaxSetup({async:true});
}

function verificaSesion(){
	$.ajaxSetup({async:false});
	$.post("../php/verifica_sesion.php",
		function(data){
			verifica = data.ver_sesion.estado;
                        nombre = data.ver_sesion.usuario_nombre;
                        //SI EL USUARIO INICIO SESION
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

function botonComprarInit(){
	$.post("/php/elementosComprados.php", function(data){
			$("#nav_bar").find("#compraTotal").text(data.totalCompra);
		}, 'json');
}

