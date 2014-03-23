$(document).ready(function(){
	verificaSesion();
});

function cargarComicsCompra(){
	$.ajaxSetup({async:false});
	$.get("/php/cargarComicsCompra.php",
		function(data){
			$.each(data.compras, function(i,val){
				$.get("/html/layouts/compra_final_layout.html", function(data2){
					$("#compras").append(data2);
					$("#compras").find("#compra_comic").attr("id", val.inventario_id);
					$("#"+val.inventario_id).find("#imagen").attr("src", val.cat_comic_imagen_url);
					$("#"+val.inventario_id).find("#catal").text(val.cat_comic_descripcion);
					$("#"+val.inventario_id).find("#titulo").text(val.cat_comic_titulo);
					$("#"+val.inventario_id).find("#precio").text(val.inventario_precio_salida+" MXN");
				});
			});
		},
		'json');
}

function verificaSesion(pagina){
	$.ajaxSetup({async:false});
	$.post("../php/verifica_sesion.php",
		function(data){
			verifica = data.ver_sesion.estado;
			if(verifica == true){
				$("#nav_bar").load("../html/layouts/navbar_login_layout.html");
				cargarComicsCompra();
			
				//botonEliminar();
			}
			else{
				alert("No ha iniciado sesion");
				window.location.href = "../index.html";
			}
		},
		'json');
	$.ajaxSetup({async:true});
}