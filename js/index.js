$(document).ready(function(){
	cargarNavBar();
	cargarCarousels();
	cargarPromocionFinDeSemana('index');
	modalIniciarSesion();
	cargarCarouselNologin(0);
	cargarCatalogoComics2(0,12, "../html/layouts/catalogo_layout_index.html");
	botonComprarNologin();
});

function modalIniciarSesion(){
	$("#nav_bar").on("click", "#loginButton", function(e){
		$('#myModal').modal('show');
	});
}


function cargarNavBar(){
	$("#nav_bar").load("html/layouts/navbar_nologin_layout.html");
}

function botonComprarNologin(){
	$(".btn-comprar").on("click", function(){
		$('#myModal').modal('show');
	})
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
