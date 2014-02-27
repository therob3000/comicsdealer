$(document).ready(function(){
	cargarComics(0);
});


function cargarComics(salto){
	var sigSalto = salto;
	for (var i = 0; i < 4; i++) {
		$(".rows").append("<div class=row id=catalogo_comics></div>");
		cargarCatalogoComics(sigSalto,3);
		$("#catalogo_comics").attr("id", i);
		sigSalto = sigSalto+3;
	};
}