var total;

$(document).ready(function(){
	//verificaSesion(pagina);
	modalIniciarSesion();
	finalizarCompra();
});

function verificaSesion(pagina){
	$.ajaxSetup({async:false});
	$.post("../php/verifica_sesion.php",
		function(data){
			verifica = data.ver_sesion.estado;
                        nombre = data.ver_sesion.usuario_nombre;
                        //SI EL USUARIO INICIO SESION
			if(verifica == true){
                                //CARGAMOS LAYOUT DE NAVBAR LOGIN
				//$("#nav_bar").load("../html/layouts/navbar_login_layout.html");
                                //SI NO ES USUARIO PRO REMOVEMOS EL BOTON DE PEDIDOS
				if(data.ver_sesion.usuario_pro != 1){
					$("#nav_bar").find("#nav_pedido").remove();
				}
      
                                $("#nav_bar").find("#botonMenUsuario").append("<span class='glyphicon glyphicon-list-alt'></span> "+nombre);
                                
				$("#nav_bar").find("#botonFinalizarCompra").html("<button class='btn btn-success' type='button'><span class='glyphicon glyphicon-shopping-cart'></span> Finalizar Compra <span class='badge' id='compraTotal'></span></button>");
				botonComprarInit();
				cargarComics(pagina);
				botonComprar();
				botonEliminar();
			}
			else{
				//$("#nav_bar").load("../html/layouts/navbar_nologin_layout.html");
				cargarComicsNologin(pagina);
				botonComprarNologin();
				//cargarCarouselNologin(pagina);
			}
		},
		'json');
	$.ajaxSetup({async:true});
}

function cargarComics(salto){
	console.log(total);
	var sigSalto = salto;
//	for (var i = 0; i < 4; i++) {
//		$(".rows").append("<div class=row id=catalogo_comics></div>");
//		cargarCatalogoComics(sigSalto,4, "../html/layouts/catalogo_layout.html");
//		$("#catalogo_comics").attr("id", i);
//		sigSalto = +sigSalto+4;
//		$(".rows").append("<hr></hr>");
//	};
	if(salto==0){
		$("#anterior").hide();
	}
	else{
		$("#anterior").html("<a href='./Catalogo.php?pagina="+(+salto-16)+"'>Anterior</a>");
	}
	if(+salto+16 > total){
		$("#siguiente").hide();
	}
	else{
		$("#siguiente").html("<a href='./Catalogo.php?pagina="+(+salto+16)+"'>Siguiente</a>");
	}
}

function cargarComicsNologin(salto){
	console.log(total);
	var sigSalto = salto;
//	for (var i = 0; i < 4; i++) {
//		$(".rows").append("<div class=row id=catalogo_comics></div>");
//		cargarCatalogoComics2(sigSalto,4, "../html/layouts/catalogo_layout.html");
//		$("#catalogo_comics").attr("id", i);
//		sigSalto = +sigSalto+4;
//		$(".rows").append("<hr></hr>");
//	};
	if(salto==0){
		$("#anterior").hide();
	}
	else{
		$("#anterior").html("<a href='./Catalogo.php?pagina="+(+salto-16)+"'>Anterior</a>");
	}
	if(+salto+16 >= total){
		$("#siguiente").hide();
	}
	else{
		$("#siguiente").html("<a href='./Catalogo.php?pagina="+(+salto+16)+"'>Siguiente</a>");
	}
}



function botonComprar(){
	$(".btn-comprar").on("click", function(){
		cadena = "cat_comic_inventario_id="+$(this).attr('id');
		$.post("/php/agregarCompra.php",cadena,function(data){
			$("#nav_bar").find("#compraTotal").text(data.totalCompra);
		}, 'json');
		$("#boton_comprar"+$(this).attr('id')).hide();
		$("#boton_eliminar"+$(this).attr('id')).show();
	});
}

function botonComprarInit(){
	$.post("/php/elementosComprados.php", function(data){
			$("#nav_bar").find("#compraTotal").text(data.totalCompra);
		}, 'json');
}

function botonEliminar(){
	$(".btn-eliminar").on("click", function(){

		cadena = "cat_comic_inventario_id="+$(this).attr('id');
		$.post("/php/eliminarCompra.php",cadena, function(data){
			
			$("#nav_bar").find("#compraTotal").text(data.totalCompra);
		}, 'json');
		$("#boton_eliminar"+$(this).attr('id')).hide();
		$("#boton_comprar"+$(this).attr('id')).show();
	});
}

function botonComprarNologin(){
	$(".btn-comprar").on("click", function(){
		$('#myModal').modal('show');
	});
}

function modalIniciarSesion(){
	$("#nav_bar").on("click", "#loginButton", function(e){
		$('#myModal').modal('show');
	});
}

function finalizarCompra(){
	$('#botonFinalizarCompra').on("click", function(){
		window.location.href = "/html/Compra.php";
	});
}





