function cargarPromocionFinDeSemana(paginaOrigen){
	$.get("../php/cargarPromocionFin.php", function(data){
		if(data.promocion == true){
			$('#layout').load("../html/layouts/promocion_fin_semana_layout.html" , function(){
				$("#imagen_promocion").attr("src", data.promocion_imagen);
				$("#formato").html("<strong>"+data.descripcion_formato+"</strong>");
				$("#titulo").html("<h4>"+data.descripcion_titulo+"</h4>");
				//$("#descuento").text("-"+data.porcentaje+"%");
				texto = data.descripcion_historia;
				$("#descripcion").text(texto.substr(0, 130)+" ...");
			
				if(data.precio_portada != 0){
					$("#campos_promocion").html("<strike style='color: grey; font-weight: 400;'>$"+data.precio_portada+"</strike><strong style='font-weight: 400;'>  $"+data.precio_oferta+"</strong> <span class='label label-descuento'>-"+data.porcentaje+"%</span>");
					//$("#campos_promocion").append("<li id='precio_portada'><strike><strong>Precio de portada: $"+data.precio_portada+"</strong></strike></li>");
					//$("#campos_promocion").append("<li id='precio_promocion'><strong>Precio de promocion: $"+data.precio_oferta+"</strong></li>");
				}
				
			});
		}
		else{
			if(paginaOrigen == 'index')
				$('#layout').load("../html/layouts/principal_layout.html");
			else
				$('#promocion').remove();
		}
	},
	'json');
}