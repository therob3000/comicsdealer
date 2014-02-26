$(document).ready(function(){
	cargarNavBar();
	cargarPromocionFinDeSemana('index');
	modalIniciarSesion();
	cargarCatalogoComics(0,3);
	
});

function modalIniciarSesion(){
	$("#nav_bar").on("click", "#loginButton", function(e){
		$('#myModal').modal('show');
	});
}


function cargarNavBar(){
	$("#nav_bar").load("html/layouts/navbar_nologin_layout.html");
}

