<?php
session_start();
error_reporting(0);

$usuario = $_SESSION["usuario"];

if($_GET['action'] == 'exit'){

			$usuario = $_SESSION["usuario"];
			$ID = $_SESSION["ID"];
			date_default_timezone_set("America/lima"); 
			$fecha=date("Y-m-d H:i:s",time());
			require "php/a_mantenet_laconexion_a_mysq.php";
			$accion="fin de seccion";
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
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Nota Final</title>
	
	<script src = "bootstrap/js/bootstrap.js" ></script>
	<script src = "js/index.js" ></script>
	<link rel = "stylesheet" href = "bootstrap/css/bootstrap.css" />
	<link rel = "stylesheet" href = "css/index.css" />
	<link rel = "stylesheet" href = "CSS/estilosCSS.css" />
</head>
<body>
	<?php 
	$identificador = $_GET['id'];

	$identificador = $_SESSION["identificador"];
	//echo "El identificador de este cliente es: $identificador</br>";

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
			<li><a href="Mi_asignatuta.php">Mi Asignatura</a></li>
			<li><a href="Mi_cuenta.php">Mi Cuenta</a></li>
			<li><a href="#">Contact</a></li>
			</ul>
		</div>

		<div id="notafin">
			
			<h3>Asignar los valores para sacar el reporte finas</h3>
			<form action="php/grupofinal.php" method="POST" >
				<div id="divisin">
			<h4>numero de nota</h4>
			
			
					<select name="grupo3t"  id="usuario2" >
						<option  value =''></option>						
						<option  value ='n_1'>n_1</option>
						<option  value ='n_2'>n_2</option>
						<option  value ='n_3'>n_3</option>
						<option  value ='n_4'>n_4</option>
						<option  value ='n_5'>n_5</option>
						<option  value ='n_6'>n_6</option>
						<option  value ='n_7'>n_7</option>
						<option  value ='n_8'>n_8</option>
						<option  value ='n_9'>n_9</option>
						<option  value ='n_10'>n_10</option>
						<option  value ='n_11'>n_11</option>
						<option  value ='n_12'>n_12</option>
						<option  value ='n_13'>n_13</option>
						<option  value ='n_14'>n_14</option>
						<option  value ='n_15'>n_15</option>
					</select>
					</div>
					<div id="divisin">
					<?php
					require 'php/grupotrabajo_3.php';
					?>
				</div>
				
				<div id="divisin">
					<h4>nombre de la actividad</h4>
					<input type="text" name="actividadtraba" placeholder="actividad" id="usuario2" /><br>
					</div>
					<div id="divisin">
					<h4>Ingresa la division</h4>				
					<input type="submit" value="A&ntilde;air tipo de trabajo" id="usuario2"/><br>
				</div>	
			</form>
		</div>
			
				
				

			
			
			
			

			<div id="divisiondenota">
				<div id="tipodetrabajo">
				
				
				<form action="php/guardatipodetrabajo.php" method="POST">
					<p>A&ntilde;air una nueva division de notas</p>
					
					<?php //echo $traba;?>
					
					nombre<br>
					<input type="text" name="nombretra" placeholder="Ciudad" id="nombretra" />
					<br>
					<br>
					procentaje<br>
					<input type="text" name="porcentajetra" placeholder="Ciudad" id="porcentaje" />
					<input type="submit" value="Registra tipo de trabajo" id="usuario2"/>
				</form>
			

			</div><!--fin de tipodetrabajo-->
			<div id="tipodetrabajo">

				<?php
				require 'php/grupotrabajo.php';
				echo"<br><br>";
				
				?>
				<form action="php/elimina2.php" method="POST">
					<input type="text" name="eliminatrabajo2" placeholder="ID elimina" id="usuario2" /><br>
					<input type="submit" value="Elimina" id="usuario2"/>
				</form>
				


			</div><!--fin de tipo de trabajo-->

			</div><!--fin de divisionde notA-->
			<div id="informe">
				<?php
				require 'php/resultado_final1.php';
				echo"<br><br>";
				
				?>

				<form action="php/elimina.php" method="POST">
					<input type="text" name="eliminatrabajo" placeholder="ID elimina" id="usuario2" /><br>
					<input type="submit" value="Elimina" id="usuario2"/>
				</form>





			</div>
			
			
			
			
		
			
		</div><!--fin de agrupar-->
		
	<div id="pie">Derecho de Autor &copy; Marcos Alberto Saavedra Sanadria y Diego Beltran </div>
</boby>
</html>