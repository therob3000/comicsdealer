<?php
date_default_timezone_set('America/Mexico_City');
//$fecha = "2014-02-11";
//obtenerCadenaFecha($fecha);

function obtenerCadenaFecha($fecha){
	$diaNombre = obtenerDiaTraducido(date('D', strtotime($fecha)));
	$diaNumero = date('j', strtotime($fecha));
	$mesNombre = obtenerMesTraducido(date('n', strtotime($fecha)));
	$anioNumero = date('Y', strtotime($fecha));

	return $diaNombre." ".$diaNumero." de ".$mesNombre.", ".$anioNumero;
	
}

function obtenerProximoSabado(){
	$diaProximoSabado = date('j', strtotime('next Saturday'));
	$mesProximoSabado = date('n', strtotime('next Saturday'));
	$mesLiteral = obtenerMesTraducido($mesProximoSabado);
		
	$fechaProximoSabado = "Sabado $diaProximoSabado de $mesLiteral";

	return $fechaProximoSabado;
}

function determinaFindeSemana(){
	
	$diaActual = date('l', strtotime('now'));

	if($diaActual == 'Friday' || $diaActual == 'Saturday' || $diaActual == 'Sunday'){
		return TRUE;
	}
	else
		return FALSE;
}

function obtenerMesTraducido($mes){
	switch ($mes) {
		case '1':
			$mesLiteral = "Enero";
			break;
		case '2':
			$mesLiteral = "Febrero";
			break;
		case '3':
			$mesLiteral = "Marzo";
			break;
		case '4':
			$mesLiteral = "Abril";
			break;
		case '5':
			$mesLiteral = "Mayo";
			break;
		case '6':
			$mesLiteral = "Junio";
			break;
		case '7':
			$mesLiteral = "Julio";
			break;
		case '8':
			$mesLiteral = "Agosto";
			break;
		case '9':
			$mesLiteral = "Septiembre";
			break;
		case '10':
			$mesLiteral = "Octubre";
			break;
		case '11':
			$mesLiteral = "Noviembre";
			break;
		case '12':
			$mesLiteral = "Diciembre";
			break;
		default:
			# code...
			break;
	}

	return $mesLiteral;

}

function obtenerDiaTraducido($dia){
	switch ($dia) {
		case 'Sun':
			$diaLiteral = "Domingo";
			break;
		case 'Mon':
			$diaLiteral = "Lunes";
			break;
		case 'Tue':
			$diaLiteral = "Martes";
			break;
		case 'Wed':
			$diaLiteral = "Miercoles";
			break;
		case 'Thu':
			$diaLiteral = "Jueves";
			break;
		case 'Fri':
			$diaLiteral = "Viernes";
			break;
		case 'Sat':
			$diaLiteral = "Sabado";
			break;
		default:
			# code...
			break;
	}

	return $diaLiteral;
}

?>