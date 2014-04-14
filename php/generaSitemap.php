<?php
	include '../php/conexion.php';
	$con = conexion();

	ini_set('display_errors',1); 
	error_reporting(E_ALL);

	

	echo "<?xml version='1.0' encoding='UTF-8'?>";
		echo "<urlset xmlns='http://www.sitemaps.org/schemas/sitemap/0.9' xmlns:image='http://www.google.com/schemas/sitemap-image/1.1'>";
		echo "<url>
				<loc>http://www.comicsdealer.com/html/ArticulosIndex.php</loc>
				<changefreq>weekly</changefreq>
			  </url>
			  <url>
			  	<loc>http://www.comicsdealer.com/html/Catalogo.php</loc>
			  	<changefreq>weekly</changefreq>
			  </url>
			  <url>
			  	<loc>http://www.comicsdealer.com/html/Como%20Funciona.html</loc>
			  	<changefreq>never</changefreq>
			  </url>
			  <url>
			  	<loc>http://www.comicsdealer.com/html/Como%20Pago.html</loc>
			  	<changefreq>never</changefreq>
			  </url>
			  <url>
			  	<loc>http://www.comicsdealer.com/html/Formas%20Entrega.html</loc>
			  	<changefreq>never</changefreq>
			  </url>
			  <url>
			  	<loc>http://www.comicsdealer.com/html/preRegistro.html</loc>
			  	<changefreq>never</changefreq>
			  </url>
			  ";

	$queryDetalles = "SELECT inventario_id FROM inventario";
	$queryResultado = mysql_query($queryDetalles);
	$num = mysql_num_rows($queryResultado);
	if($num > 0){
		
		for ($i=0; $i < $num ; $i++) { 
			echo "<url>
					<loc>http://www.comicsdealer.com/html/Detalle.php?comic_id=".mysql_result($queryResultado, $i, "inventario_id")."</loc>
					<changefreq>weekly</changefreq>
				  </url>";
		}

		
	}

	$queryArticulos = "Select articulo_id from articulos";
	$queryResultado2 = mysql_query($queryArticulos);
	$num = mysql_num_rows($queryResultado2);
	if($num > 0){
		for ($i=0; $i < $num ; $i++) { 
			echo "<url>
					<loc>http://www.comicsdealer.com/html/Articulos.php?articulo_id=".mysql_result($queryResultado2, $i, "articulo_id")."</loc>
					<changefreq>weekly</changefreq>
				  </url>";
		}
	}

	echo "</urlset>";
