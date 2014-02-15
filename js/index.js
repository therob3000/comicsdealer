$(document).ready(function(){
	cargarPromocionFinDeSemana('index');
	modalIniciarSesion();
});

function modalIniciarSesion(){
	$('#loginButton').click(function(e){
		$('#myModal').modal('show');
	});
}