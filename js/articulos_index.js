$(document).ready(function(){
	cargarArticulos(pagina, 5);
	verificaSesion();
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
					$("#articulos").find("#articulo").attr("id", val.articulo_id);
					$("#"+val.articulo_id).find("#articulo_imagen").attr("src", val.articulo_imagen);
					$("#"+val.articulo_id).find("#articulo_titulo").text(val.articulo_titulo);
					$("#"+val.articulo_id).find("#articulo_fecha_autor").text(val.articulo_fecha+" por "+val.articulo_autor);
					$("#"+val.articulo_id).find("#articulo_resumen").text(val.articulo_resumen);
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
			if(verifica == true){
				$("#nav_bar").load("../html/layouts/navbar_login_layout.html");
				if(data.ver_sesion.usuario_pro != 1){
					$("#nav_bar").find("#nav_pedido").remove();
				}
			}
			else{
				$("#nav_bar").load("../html/layouts/navbar_nologin_layout.html");
			}
		},
		'json');
	$.ajaxSetup({async:true});
}

