<?php

function obtenerProximoSabado(){
	date_default_timezone_set('America/Mexico_City');
	$diaProximoSabado = date('j', strtotime('next Saturday'));
	$mesProximoSabado = date('n', strtotime('next Saturday'));

	switch ($mesProximoSabado) {
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
		case 'variable':
			$mesLiteral = "Diciembre";
			break;
		default:
			# code...
			break;
	}
	$fechaProximoSabado = "Sabado $diaProximoSabado de $mesLiteral";

	return $fechaProximoSabado;
}

function determinaFindeSemana(){
	date_default_timezone_set('America/Mexico_City');
	$diaActual = date('l', strtotime('now'));

	if($diaActual == 'Friday' || $diaActual == 'Saturday' || $diaActual == 'Sunday'){
		return TRUE;
	}
}

?>