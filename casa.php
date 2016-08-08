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
	$identificador = $_GET['id'];
	
	$_SESSION['identificador']=$identificador;
	?> 

	<div id="titulo">
		<div id="traduc" style="font-size: 30px; font-family: Segoe UI; he">Bienvenido  SIONO   "1a5" "SISTEMA ONLINE DE NOTAS" 
		</div>
	</div>
	<div id="agrupar">
		<?php if(User == false) { ?>
		echo '<meta http-equiv="Refresh" content="0;URL=./" />';
		<?php } ?>
		<div id="centro">	

			
	

	<label style="font-size: 30px; font-family: Segoe UI;">Bienvenido </label> <br>
	<b>Hola, <?php echo $usuario; ?></b><br>
	<a href="?action=exit">Cerrar Sesion</a>


	
	</div><!--centro-->
	<div id="container">
		<ul>
			<li><a href="docente.php">Home</a></li>
			<li><a href="registro.php">Nuevo Registro</a></li>
			<li><a href="Mi_asignatuta.php">Mi asignatura</a></li>
			<li><?php echo"<a href='reportes.php?id=$identificador'>realizar reporte</a>" ?></li>
			<li><a href="Mi_cuenta.php">Mi Cuenta</a></li>
			<li><a href="#">Contact</a></li>
			</ul>
		</div>




		<div id="centro">
			<div id="span3">
				<div id="area">
						
					</div>
<!--
					<h3>Buscar por nombre</h3>

					
					<input type = "text" id="coincidencia" disable="disable" value=<?php echo $identificador; ?> />
				-->
				</div>
					<div id="span3">
					<h4>Categoria</h4>										
					<select id = "categoriaB" >						
						<option  value = '<?php echo $identificador;?>' ><?php echo $identificador;?> </option>
					</select>
				
				</div><!--fin de span3-->

	
	<div class = "container" >
			<div class = "row" >
				
		
			<div id= "gruponota">


				<h3>modifica la nota del estudiantes</h3>
				
				
				
				<table borber="1">
					<tr>
						<th>
							nota &nbsp;1
							<input type = "text" id ="n_1"  class = "input-block-level" maxlength = "300" />
						</th>
						<th>
							nota  &nbsp;2
							<input type = "text" id ="n_2" class = "input-block-level" maxlength = "300" />
						</th>
						<th>			
							nota &nbsp;3
							<input type = "text" id = "n_3" class = "input-block-level" maxlength = "300" />
						</th>
						<th>
							nota &nbsp;4
							<input type = "text" id = "n_4" class = "input-block-level" maxlength = "300" />
						</th>
						<th>
							nota &nbsp;5
							<input type = "text" id = "n_5" class = "input-block-level" maxlength = "300" />
						</th>
					</tr><tr>
						<th>
							nota &nbsp;6
							<input type = "text" id ="n_6"  class = "input-block-level" maxlength = "300" />
						</th>
						<th>
							nota &nbsp;7
							<input type = "text" id ="n_7" class = "input-block-level" maxlength = "300" />
						</th>
						<th>
							nota &nbsp;8
							<input type = "text" id = "n_8" class = "input-block-level" maxlength = "300" />
						</th>
						<th>
							nota &nbsp;9
							<input type = "text" id = "n_9" class = "input-block-level" maxlength = "300" />
						</th>
						<th>
							nota 10
							<input type = "text" id = "n_10" class = "input-block-level" maxlength = "300" />
						</th>
					</tr><tr>
						<th>
							nota 11
							<input type = "text" id ="n_11"  class = "input-block-level" maxlength = "300" />
						</th>
						<th>
							nota 12
							<input type = "text" id ="n_12" class = "input-block-level" maxlength = "300" />
						</th>
						<th>
							nota 13
							<input type = "text" id = "n_13" class = "input-block-level" maxlength = "300" />
						</th>
						<th>
							nota 14
							<input type = "text" id = "n_14" class = "input-block-level" maxlength = "300" />
						</th>
						<th>
							nota 15
							<input type = "text" id = "n_15" class = "input-block-level" maxlength = "300" />
						</th>
						
						</tr><tr>
						<th colspan="5">
							<button class = 'btn btn-info' id = 'actualizar' disabled >Actualizar</button>
						</th>
						</tr>
						</table>
				</div>
				<div id = "tabla" >
					<table border ="1" class = "table table-hover" >
						<h3>El ID de la asignatura es:  <?php echo $identificador?></h3>
						<caption>
							<h5>Resultado de la busqueda</h5>
						</caption>
						<thead>
							<tr>
								<th>ID</th>
								<th>Alumnos_ID</th>
								<th>Nombre de estudiantes</th>
								<th>ID asig</th>
								<th>ID profe</th>								
								<th>N 1</th>
								<th>N 2</th>
								<th>N 3</th>
								<th>N 4</th>
								<th>N 5</th>
								<th>N 6</th>
								<th>N 7</th>
								<th>N 8</th>
								<th>N 9</th>
								<th>N 10</th>
								<th>N 11</th>
								<th>N 12</th>
								<th>N 13</th>
								<th>N 14</th>
								<th>N 15</th>
								
								
								

								<th>Edita notas</th>
						</thead>


						<tbody id = "cuerpo" >
						</tbody>
					</table>
					<br>
					<br>
					<?php
					//echo "$identificador ";
					$_SESSION['identificador']=$identificador;

					echo"<div id='report'><a href='NAvanzado.php?id=$identificador'>notas avanzada</a></div>";
					echo"<div id='report'><a href='calificaciones.php?id=$identificador'>ver calificaciones finales</a></div>";
					?>
					
					<br>
					<br>
				</div>
			</div>
		</div>
	</div>
</div><!--fin de centro-->
</div><!--fin de agrupar-->
<div id="pie">Derecho de Autor &copy; Marcos Alberto Saavedra Sanadria y Diego Alexander Beltran Hernandez </div>
</body>
</html>