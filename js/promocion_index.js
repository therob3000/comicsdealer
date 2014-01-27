function cargarPromocionFinDeSemana(paginaOrigen){
	$.get("../php/cargarPromocionFin.php", function(data){
		if(data.promocion == true){
			$('#layout').load("../html/layouts/promocion_fin_semana_layout.html" , function(){
				$("#imagen_promocion").attr("src", data.promocion_imagen);
				$("#formato").html("<strong>"+data.descripcion_formato+"</strong>");
				$("#titulo").html("<strong>"+data.descripcion_titulo+"</strong>");
				$("#descripcion").text(data.descripcion_historia);
			
				if(data.precio_portada != 0){
					$("#campos_promocion").append("<li id='precio_portada'><strike><strong>Precio de portada: "+data.precio_portada+"</strong></strike></li>");
					$("#campos_promocion").append("<li id='precio_promocion'><strong>Precio de promocion: "+data.precio_oferta+"</strong></li>");
				}
				
			});
		}
		else{
			if(paginaOrigen == 'index')
				$('#layout').load("../html/layouts/principal_layout.html");
			else
				$('#promocion').hide();
		}
	},
	'json');
}