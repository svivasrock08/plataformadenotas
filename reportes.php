<?php
session_start();
error_reporting(0);

$usuario = $_SESSION["usuario"];
if($_GET['action'] == 'exit'){
	$accion="fin de seccion";	
	//$fecha= date("Y-m-d H:i:s");
	//mysql_query("INSERT INTO historial (profesores_ID,usuario,tipo_de_usuario,accion,fecha) VALUES ('$ID','$ID','$usuario','$accion','$fecha')");	
	require"php/historialpadre2.php";
	session_destroy();
	define("User", false);
	echo '<meta http-equiv="Refresh" content="0;URL=./" />';
}


?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv = "content-type" type = "text/html" charset = "ISO-8859-1" />
	<title>Casa de Notas</title>
	<script src = "js/jquery.js" ></script>
	<script src = "bootstrap/js/bootstrap.js" ></script>
	<script src = "js/index.js" ></script>
	<link rel = "stylesheet" href = "bootstrap/css/bootstrap.css" />
	<link rel = "stylesheet" href = "css/index.css" />
	<link rel = "stylesheet" href = "CSS/estilosCSS.css" />
</head>
<body>
	<?php 
	$identificador = $_GET['id'];
	echo "El identificador de este cliente es: $identificador</br>";
	$_SESSION['identificador']=$identificador;
	$_SESSION['asigrepo']=$identificador;

	?> 

	<div id="titulo">
		<div id="traduc" style="font-size: 30px; font-family: Segoe UI; he">Bienvenido SIONO   "1a5" "SISTEMA ONLINE DE NOTAS" 
		</div>
	</div>
	<div id="agrupar">
		<?php if(User == false) { ?>
		echo '<meta http-equiv="Refresh" content="0;URL=./" />';
		<?php } ?>
		<div id="centro">	

			
	

	<label style="font-size: 30px; font-family: Segoe UI;">Bienvenido</label><br>
	<b>Hola, <?php echo $usuario; ?></b><br>
	<a href="?action=exit">Cerrar Sesion</a>


	
	</div><!--centro-->
	<div id="container">
		<ul>
			<li><a href="docente.php">Home</a></li>
			<li><a href="registro.php">Nuevo Registro</a></li>
			<li><a href="Mi_asignatuta.php">Mi asignatura</a></li>
			<li><a href="Mi_cuenta.php">Mi Cuenta</a></li>
			<li><a href="#">Contact</a></li>
			</ul>
		</div>




		<div id="centro">
			<h3>selecciones un alumnos para realizar el reporte</h3>
			<?php

			require "php/veralumnoreporte.php";

			
			?>
		</div>
		<div id="centro">
			<h3>ver el historial de los diferentes reportes </h3>
			<?php
			require "php/veralumnoreporte5.php";
			?>
		</div>
</div><!--fin de centro-->
</div><!--fin de agrupar-->
<div id="pie">Derecho de Autor &copy; Marcos Alberto Saavedra Sanadria y Diego Alexander Beltran Hernandez</div>
</body>
</html>