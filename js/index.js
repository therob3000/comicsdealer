var nombre;
$(document).ready(function(){
	cargarNavBar();
	cargarPromocionFinDeSemana('index');
	modalIniciarSesion();
	modalRegistrar();
	cargarCatalogoComics2(0,12, "../html/layouts/catalogo_layout_index.html");
	botonComprarNologin();
	//facebookRegistro();
});

function modalIniciarSesion(){
	$("#nav_bar").on("click", "#loginButton", function(e){
		$('#myModal').modal('show');
	});
}

function modalRegistrar(){
	$("#nav_bar").on("click", "#registroButton", function(e){
		$('#myModal2').modal('show');
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



