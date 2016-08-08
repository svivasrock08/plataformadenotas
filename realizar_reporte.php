<?php
session_start();
error_reporting(0);
$usuario = $_SESSION["usuario"];
if($_GET['action'] == 'exit'){
	$accion="fin de seccion";	
	require "php/a_mantenet_laconexion_a_mysq.php";
	$fecha= date("Y-m-d H:i:s");
	mysql_query("INSERT INTO historial (profesores_ID,usuario,tipo_de_usuario,accion,fecha) VALUES ('$ID','$ID','$usuario','$accion','$fecha')");	

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
	$identificadore = $_GET['id'];
	
	$idalum = $_GET['idalum'];
	$asignaturare = $_GET['asignatura_ID'];
	$nombrere = $_GET['nombre'];
	$apellidore = $_GET['apellido'];
	echo "El identificador de este cliente es: $identificador y $asignatura tre $nombre t $apellido</br>";
	$_SESSION['identificadore']=$identificadore;
	$_SESSION['asignaturare']=$asignaturare;
	$_SESSION['nombrere']=$nombrere;
	$_SESSION['apellidore']=$apellidore;
	$_SESSION['idalum']=$idalum;
	?> 

	<div id="titulo">
		<div id="traduc" style="font-size: 30px; font-family: Segoe UI; he">Bienvenido a SONIA o SIONO   "1a5" "SISTEMA ONLINE DE NOTAS" 
		</div>
	</div>
	<div id="agrupar">
		<?php if(User == false) { ?>
		echo '<meta http-equiv="Refresh" content="0;URL=./" />';
		<?php } ?>
		<div id="centro">	

			
	

	<label style="font-size: 30px; font-family: Segoe UI;">Bienvenido</label><br>
	<b>Hola, <?php echo $usuario; ?></b><br>
	<a href="?action=exit">Cerra Seccion</a>


	
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
			<h3>realizar reporte al estudiante: <br><?php echo " $nombrere $apellidore";?> </h3>

			<p title="Definicion del mensaje "> Definicion del mensaje</p>
			<form action="php/realizarreporte.php" method="POST">
			<input type="text" name="tema_dereporte" placeholder="Definir el reporte" id="usuario3" title="definir el reportes " /><br>
			<h3 title="colocar el reporte segun la regularidad que se vio">colocar el reporte segun la regularidad que fue puesto al  estudiantes</h3>
			<textarea name="mensaje_reporte" cols="50" rows="5" id="usuario3" placeholder="Ingresa un mensaje para el webmaster"></textarea>
			<br>
			<input type="submit" value="Registrarme" id="usuario2"/>
			</form>


			
	</div>
</div><!--fin de centro-->
</div><!--fin de agrupar-->
<div id="pie">Derecho de Autor &copy; Marcos Alberto Saavedra Sanadria y Diego Beltran</div>
</body>
</html>