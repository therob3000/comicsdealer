$(document).ready(function(){
	cargarPromocionFinDeSemana('index');
	modalIniciarSesion();
	/*myFunction();*/
});

function modalIniciarSesion(){
	$('#loginButton').click(function(e){
		$('#myModal').modal('show');
	});
}

/*function myFunction()
{
var m = (window.outerWidth-1024)/2;
var l = "0 "+m+"px 0 " +m+"px";
document.getElementById("fixNav").style.width = 1024px;
document.getElementById("fixNav").style.margin = l;
}*/