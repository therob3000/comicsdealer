var nombre;
$(document).ready(function(){
        verificaSesion();
	//cargarCarousels();
	cargarPromocionFinDeSemana('index');
	modalIniciarSesion();               //Del archivo registro_login.js
	//cargarCarouselNologin(0);
	modalRegistrar();                   //Del archivo registro_login.js
	//botonComprarNologin();
        modalRegistrar2();                  //Del archivo registro_login.js
	registroFacebook();
        registroCorreo();
        busquedaporPersonaje();
        busquedaporTitulo();
        busquedaporDescripcion();
});

function modalRegistrar2(){
    $("#registroButtonBanner").click(function(e){
        $('#myModal2').modal('show');
    });
}


function botonComprarNologin(){
	$(".btn-comprar").on("click", function(){
		$('#myModal').modal('show');
	});
}

function cargarCarousels(){
	$("#carousels_index").load("html/layouts/carousels_index_layout.html");
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

function busquedaporPersonaje(){
    $('#busqueda_personaje').on("click",function(){
        parametro = $('#txtBusqueda').val();
        window.location.href = "/html/Catalogo.php?busqueda=1&parametro_busqueda="+parametro;
    });
}

function busquedaporTitulo(){
    $('#busqueda_titulo').on("click", function(){
        parametro = $('#txtBusqueda').val();
        window.location.href = "/html/Catalogo.php?busqueda=2&parametro_busqueda="+parametro;
    });
}

function busquedaporDescripcion(){
    $('#busqueda_descripcion').on("click", function(){
        parametro = $('#txtBusqueda').val();
        window.location.href = "/html/Catalogo.php?busqueda=3&parametro_busqueda="+parametro;
    });
}