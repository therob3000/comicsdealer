var total;

$(document).ready(function(){
	verificaSesion(pagina);
	modalIniciarSesion();
        //Funciones ubicadas en registro_login.js
        modalRegistrar();
        registroFacebook();
        registroCorreo();
	finalizarCompra();
        busquedaporPersonaje();
        busquedaporTitulo();
        busquedaporDescripcion();
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
				//cargarComics(pagina);
                                cargarCatalogoComics();
				botonComprar();
				botonEliminar();
			}
			else{
				
				botonComprarNologin();
				
			}
		},
		'json');
	$.ajaxSetup({async:true});
}

function cargarComics(salto){
	console.log(total);
	var sigSalto = salto;
	for (var i = 0; i < 4; i++) {
//		
		cargarCatalogoComics(sigSalto,4, "../html/layouts/catalogo_layout.html");
//		
		sigSalto = +sigSalto+4;
//		$(".rows").append("<hr></hr>");
	};
//	
}

function cargarCatalogoComics() {
	cadena = "inventario=1";
        //alert(cadena);
	$.ajaxSetup({async:false});
	$.post("/php/catalogoFunctions.php",
		cadena,
            function(data){
                //alert(data);
                $.each(data.inventario, function(i, val){
                    //alert(val);
                    if($.inArray(val, data.agregados) != -1){
                        $("#"+val).find('#boton_comprar').hide();
                        $("#"+val).find('#boton_comprar').attr("id","boton_comprar"+val);
                        $("#"+val).find('#boton_eliminar').attr("id","boton_eliminar"+val);
                        $("#"+val).find('#boton_comprar'+val).html("<button class='btn btn-success btn-comprar' role='button' id="+val+">Agregar</button>");
                        $("#"+val).find('#boton_eliminar'+val).html("<button class='btn btn-danger btn-eliminar' href='#' role='button' id="+val+">Eliminar</button>");
                    }
                    else{
                        $("#"+val).find('#boton_eliminar').hide();
                        $("#"+val).find('#boton_comprar').attr("id","boton_comprar"+val);
                        $("#"+val).find('#boton_eliminar').attr("id","boton_eliminar"+val);
                        $("#"+val).find('#boton_eliminar'+val).html("<button class='btn btn-danger btn-eliminar' href='#' role='button' id="+val+">Eliminar</button>");
                        $("#"+val).find('#boton_comprar'+val).html("<button class='btn btn-success btn-comprar' href='#' role='button' id="+val+">Agregar</button>");
                    }
                });
            }, 'json');
	$.ajaxSetup({async:true});
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