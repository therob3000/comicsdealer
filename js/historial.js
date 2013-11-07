$(document).ready(function(){
	cargarPedidos();
});

function cargarPedidos(){
	$.post("../php/historial.php",
		function(data){
			console.log(data);
			console.log(data.pedidos.length);
			$.each(data.pedidos, function(i, val){
				console.log(i);
				console.log(val.compania_nombre);

				//$.ajaxSetup({async:false});
				$.get("../html/layouts/historial_layout", 
					function(data) {
						$('#historial').append(data);
						$('#historial').find('#rowid').attr('id', i);
						$('#'+i+".pedido").find('.pedidoid').attr('id', val.pedido_id);
						$('#'+i+".pedido").find('.pedidoid').text(i+1);

						$('#'+i+".pedido").find('.compania').attr('id', val.compania_id);
						$('#'+i+".pedido").find('.compania').text(val.compania_nombre);

						$('#'+i+".pedido").find('.personaje').attr('id', val.personaje_id);
						$('#'+i+".pedido").find('.personaje').text(val.personaje_nombre);

						$('#'+i+".pedido").find('.textolibre').text(val.texto_libre);

						$('#'+i+".pedido").find('.estado').attr('id', val.pedido_estado);

						switch(val.pedido_estado){
							case "0": 
								$('#'+i+".pedido").find('.estado').append('<span class="label label-warning">En proceso</span>')
								break;
							case "1": 
								$('#'+i+".pedido").find('.estado').append('<span class="label label-success">Encontrado :)</span>')
								break;
							case "2": 
								$('#'+i+".pedido").find('.estado').append('<span class="label label-default">Cancelado :(</span>')
								break;	
						}
				});
				//$.ajaxSetup({async:true});
			});
		},
		'json');		
}