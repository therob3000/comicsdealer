var total;

$(document).ready(function(){
	verificaSesion();
	cargarComics(pagina);
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

