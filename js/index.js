$(document).ready(function(){
	cargarNavBar();
	cargarPromocionFinDeSemana('index');
	modalIniciarSesion();
	cargarCatalogoComics2(0,3);
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

