$(document).ready(function(){
	cargarNavBar();
	cargarPromocionFinDeSemana('index');
	modalIniciarSesion();
<<<<<<< HEAD
	/*myFunction();*/
=======
	cargarCatalogoComics(0,3);
	
>>>>>>> 14d3ea84d765ab4cf945006048831d58834a7f82
});

function modalIniciarSesion(){
	$("#nav_bar").on("click", "#loginButton", function(e){
		$('#myModal').modal('show');
	});
}

<<<<<<< HEAD
/*function myFunction()
{
var m = (window.outerWidth-1024)/2;
var l = "0 "+m+"px 0 " +m+"px";
document.getElementById("fixNav").style.width = 1024px;
document.getElementById("fixNav").style.margin = l;
}*/
=======
function cargarNavBar(){
	$("#nav_bar").load("html/layouts/navbar_nologin_layout.html");
}
>>>>>>> 14d3ea84d765ab4cf945006048831d58834a7f82
