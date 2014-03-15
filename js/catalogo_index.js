var total;

$(document).ready(function(){
	verificaSesion(pagina);
	modalIniciarSesion();
});

function verificaSesion(pagina){
	$.ajaxSetup({async:false});
	$.post("../php/verifica_sesion.php",
		function(data){
			verifica = data.ver_sesion.estado;
			if(verifica == true){
				$("#nav_bar").load("../html/layouts/navbar_login_layout.html");
				cargarComics(pagina);
				botonComprar();
				botonEliminar();
			}
			else{
				$("#nav_bar").load("../html/layouts/navbar_nologin_layout.html");
				cargarComicsNologin(pagina);
				botonComprarNologin();
			}
		},
		'json');
	$.ajaxSetup({async:true});
}

function cargarComics(salto){
	var sigSalto = salto;
	for (var i = 0; i < 4; i++) {
		$(".rows").append("<div class=row id=catalogo_comics></div>");
		cargarCatalogoComics(sigSalto,3);
		$("#catalogo_comics").attr("id", i);
		sigSalto = +sigSalto+3;
	};
	if(salto==0){
		$("#anterior").hide();
	}
	else{
		$("#anterior").html("<a href='./Catalogo.php?pagina="+(+salto-12)+"'>Anterior</a>");
	}
	if(+salto+12 > total){
		$("#siguiente").hide();
	}
	else{
		$("#siguiente").html("<a href='./Catalogo.php?pagina="+(+salto+12)+"'>Siguiente</a>");
	}
}

function cargarComicsNologin(salto){
	var sigSalto = salto;
	for (var i = 0; i < 4; i++) {
		$(".rows").append("<div class=row id=catalogo_comics></div>");
		cargarCatalogoComics2(sigSalto,3);
		$("#catalogo_comics").attr("id", i);
		sigSalto = +sigSalto+3;
	};
	if(salto==0){
		$("#anterior").hide();
	}
	else{
		$("#anterior").html("<a href='./Catalogo.php?pagina="+(+salto-12)+"'>Anterior</a>");
	}
	if(+salto+12 > total){
		$("#siguiente").hide();
	}
	else{
		$("#siguiente").html("<a href='./Catalogo.php?pagina="+(+salto+12)+"'>Siguiente</a>");
	}
}

function botonComprar(){
	$(".btn-comprar").on("click", function(){
		cadena = "cat_comic_inventario_id="+$(this).attr('id');
		$.post("/php/agregarCompra.php",cadena);
		$("#boton_comprar"+$(this).attr('id')).hide();
		$("#boton_eliminar"+$(this).attr('id')).show();
	});
}

function botonEliminar(){
	$(".btn-eliminar").on("click", function(){
		cadena = "cat_comic_inventario_id="+$(this).attr('id');
		$.post("/php/eliminarCompra.php",cadena);
		$("#boton_eliminar"+$(this).attr('id')).hide();
		$("#boton_comprar"+$(this).attr('id')).show();
	});
}

function botonComprarNologin(){
	$(".btn-comprar").on("click", function(){
		$('#myModal').modal('show');
	})
}

function modalIniciarSesion(){
	$("#nav_bar").on("click", "#loginButton", function(e){
		$('#myModal').modal('show');
	});
}




