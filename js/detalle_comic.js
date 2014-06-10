$(document).ready(function(){
	verificaSesion(comic_id);
	modalIniciarSesion();
	botonComprar();
	botonEliminar();
	finalizarCompra();
	botonComprarNologin();
	//cargarCatalogoComics2(0,4, "../html/layouts/catalogo_layout_index.html");
        $('#coin-slider').coinslider({hoverPause: true});
        $('#banner_slideshow').coinslider({
    width: 220, // width of slider panel
    //height: 350, // height of slider panel
});

// Resize picture.
$('.cs-banner_slideshow').css('background-size', '220px');
       
});

function verificaSesion(comic_id){
	$.ajaxSetup({async:false});
	$.post("../php/verifica_sesion.php",
		function(data){
			verifica = data.ver_sesion.estado;
                        nombre = data.ver_sesion.usuario_nombre;
			if(verifica == true){
				//$("#nav_bar").load("../html/layouts/navbar_login_layout.html");
				if(data.ver_sesion.usuario_pro != 1){
					$("#nav_bar").find("#nav_pedido").remove();
				}
                                $("#nav_bar").find("#botonMenUsuario").append("<span class='glyphicon glyphicon-list-alt'></span> "+nombre);
				$("#nav_bar").find("#botonFinalizarCompra").html("<button class='btn btn-success' type='button'><span class='glyphicon glyphicon-shopping-cart'></span> Finalizar Compra <span class='badge' id='compraTotal'></span></button>");
				botonComprarInit();
				cargarComic2(comic_id);
			}
			else{
				//$("#nav_bar").load("../html/layouts/navbar_nologin_layout.html");
				cargarComic(comic_id);
			}
		},
		'json');
	$.ajaxSetup({async:true});
}

//Cargar el comic cuando el usuario NO HA INICIADO SESION
function cargarComic(comic_id){
	$(".fb-share-button").attr("data-href", "http://www.comicsdealer.com/html/Detalle.php?comic_id="+comic_id);

	$('#boton_eliminar').hide();
	$('#boton_comprar').hide();
}

//Cargar el comic cuando el usuario HA INICIADO SESION
function cargarComic2(comic_id){
	$(".fb-share-button").attr("data-href", "http://www.comicsdealer.com/html/Detalle.php?comic_id="+comic_id);
	cadena = "comic_id="+comic_id;

	$.get("../php/cargarComicDetalle2.php",
		cadena,
		function(data){
			if($.inArray(data.comic.cat_comic_unique_id, data.agregados) != -1){
					//$('#boton_comprar_nologin').hide();					
					$('#boton_comprar').hide();
					$('.btn-eliminar').attr("id", data.comic.cat_comic_unique_id);
					$('.btn-comprar').attr("id", data.comic.cat_comic_unique_id);
				}
				else{
					//$('#boton_comprar_nologin').hide();
					$('#boton_eliminar').hide();
					$('.btn-comprar').attr("id", data.comic.cat_comic_unique_id);
					$('.btn-eliminar').attr("id", data.comic.cat_comic_unique_id);
				}
		},
		'json');
}

function botonComprar(){
	$(".btn-comprar").on("click", function(){
		cadena = "cat_comic_unique_id="+$(this).attr('id');
		$.post("/php/agregarCompra.php",cadena,function(data){
			$("#nav_bar").find("#compraTotal").text(data.totalCompra);
		}, 'json');
		$("#boton_comprar").hide();
		$("#boton_eliminar").show();
	});
}

function botonEliminar(){
	$(".btn-eliminar").on("click", function(){
		cadena = "cat_comic_unique_id="+$(this).attr('id');
		$.post("/php/eliminarCompra.php",cadena);
		$("#boton_eliminar").hide();
		$("#boton_comprar").show();
                botonComprarInit();
	});
}

function botonComprarNologin(){
	$(".btn-comprar-nologin").on("click", function(){
		$('#myModal').modal('show');
	})
}

function botonComprarInit(){
	$.post("/php/elementosComprados.php", function(data){
			$("#nav_bar").find("#compraTotal").text(data.totalCompra);
		}, 'json');
}

function finalizarCompra(){
	$('#botonFinalizarCompra').on("click", function(){
		window.location.href = "/html/Compra.php";
	});
}

function modalIniciarSesion(){
	$("#nav_bar").on("click", "#loginButton", function(e){
		$('#myModal').modal('show');
	});
}