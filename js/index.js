var nombre;
$(document).ready(function(){
        verificaSesion();
	//cargarCarousels();
	//cargarPromocionFinDeSemana('index');
	modalIniciarSesion();
	cargarCarouselNologin(0);
	modalRegistrar();
	//botonComprarNologin();
	registroFacebook();
        registroCorreo();
});



function botonComprarNologin(){
	$(".btn-comprar").on("click", function(){
		$('#myModal').modal('show');
	});
}

function cargarCarousels(){
	$("#carousels_index").load("html/layouts/carousels_index_layout.html");
}

function cargarCarouselNologin(salto){
	/*console.log(total);*/
	var sigSalto = salto;
	for (var i = 0; i < 3; i++) {
		if(i==0){
			$(".carousels").append("<div class='item active'><img><div class='carousel-caption'><div class='row renglon'><div class='row' id='carousel_comics'></div></div></div></div>");
		}
		else{
			$(".carousels").append("<div class='item'><img><div class='carousel-caption'><div class='row renglon'><div class='row' id='carousel_comics'></div></div></div></div>");
		}
		/*$(".rows").append("<div class=row id=catalogo_comics></div>");*/
		/*cargarCarouselComics está en catalogo.js*/
		cargarCarouselComics(sigSalto,4, "/html/layouts/catalogo_layout_index.html");
		$("#carousel_comics").attr("id", i);
		sigSalto = +sigSalto+4;
	};
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

function botonComprarInit(){
	$.post("/php/elementosComprados.php", function(data){
			$("#nav_bar").find("#compraTotal").text(data.totalCompra);
		}, 'json');
}

