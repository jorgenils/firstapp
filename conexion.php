<?php

	//echo "database: ";
	$base = 'incautado1'; 
	//echo "<br>";


	$host = 'localhost'; 
	$usuario = 'root'; 
	$password = ''; 

	$link = @mysql_connect($host,$usuario,$password);
	  @mysql_select_db ($base) or die(mysql_error()); 

	if (!function_exists("connect")) {
		function connect() {
			//echo "conexion.connect--";
			$conn = mysql_connect("localhost", "root", "");
			mysql_select_db($base);
			return $conn;
		}
	}
//esto es una prueba para ver quien toquetea el codigo y como reacciona git con esto 
//git a creado un fork
?>
