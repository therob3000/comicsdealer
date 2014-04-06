$(document).ready(function(){
	verificaSesion();
	modalIniciarSesion();
});

function verificaSesion(){
	$.ajaxSetup({async:false});
	$.post("../php/verifica_sesion.php",
		function(data){
			verifica = data.ver_sesion.estado;
			if(verifica == true){
				$("#nav_bar").load("../html/layouts/navbar_login_layout.html");
				if(data.ver_sesion.usuario_pro != 1){
					$("#nav_bar").find("#nav_pedido").remove();
				}
				$("#inicia").text("Haz tu pedido!");
				$("#inicia").attr("href", "Catalogo.php");
			}
			else{
				$("#nav_bar").load("../html/layouts/navbar_nologin_layout.html");
			}
		},
		'json');
	$.ajaxSetup({async:true});
}

function modalIniciarSesion(){
	$("#nav_bar").on("click", "#loginButton", function(e){
		$('#myModal').modal('show');
	});
}