<?php
session_start();


	$fecha= date("Y-m-d H:i:s");
	require "php/a_mantenet_laconexion_a_mysq.php";
mysql_query("INSERT INTO historial (usuario,tipo_de_usuario,accion,fecha) VALUES ('$ID','$usuario','$accion','$fecha')");
	

	echo "$accion $ID $usuario $fecha";
	echo "$usuario";
?>