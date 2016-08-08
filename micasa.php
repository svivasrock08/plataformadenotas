<?php
session_start();
error_reporting(0);
$usuario = $_SESSION["usuario"];
$ID = $_SESSION["ID"];
$IDalumno= $_SESSION["IDalumno"];
if($_GET['action'] == 'exit'){
			date_default_timezone_set("America/lima"); 
			$fecha=date("Y-m-d H:i:s",time());
			$accion="fin de seccion";	
			require "php/a_mantenet_laconexion_a_mysq.php";
			mysql_query("INSERT INTO historial_alu (alumnos_ID,usuario,accion,fecha) VALUES ('$IDalumno','$usuario','$accion','$fecha')");	

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
	date_default_timezone_set("America/lima"); 
			$fecha=date("Y-m-d H:i:s",time());


	$identificador = $_GET['id'];
//	echo "El identificador de este cliente es: $identificador</br>";
			$usuario = $_SESSION["usuario"];
			$ID = $_SESSION["ID"];
			$IDalumno= $_SESSION["IDalumno"];
			
			$accion="consulto la asignatura $identificador";	

			mysql_query("INSERT INTO historial_alu (alumnos_ID,usuario,accion,fecha) VALUES ('$IDalumno','$usuario','$accion','$fecha')");	

	echo"<script type='text/javascript'> alert(' $IDalumno,$usuario,$accion,$fecha')</script>";
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
			<li><a href="alumnos.php">Home</a></li>
			
			
			<li><a href="Mi_cuentaa.php">Mi Cuenta</a></li>
			<li><a href="#">Contact</a></li>
			</ul>
		</div>




		<div id="centro">
			<?php
			require 'php/resulfin2.php';
			?>
	</div>
</div><!--fin de centro-->
</div><!--fin de agrupar-->
<div id="pie">Derecho de Autor &copy; Marcos Alberto Saavedra Sanadria y Diego Beltran </div>
</body>
</html>