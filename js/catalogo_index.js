var total;

$(document).ready(function(){
	verificaSesion();
	cargarComics(pagina);
	botonComprar();
	botonEliminar();
});


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


