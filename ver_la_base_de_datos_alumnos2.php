<?php
session_start();
error_reporting(0);
$usuario = $_SESSION["usuario"];
if($_GET['action'] == 'exit'){
	$accion="fin de seccion";	
	$fecha= date("Y-m-d H:i:s");
	require "php/a_mantenet_laconexion_a_mysq.php";
	mysql_query("INSERT INTO historial (profesores_ID,usuario,tipo_de_usuario,accion,fecha) VALUES ('$ID','$ID','$usuario','$accion','$fecha')");	

	session_destroy();
	define("User", false);
	echo '<meta http-equiv="Refresh" content="0;URL=./" />';
}
$ID = $_SESSION["ID"];

echo "el id es $ID";
if (2==$ID) {

	}else{

		define("User", false);
		session_destroy();
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
	$identificador = $_GET['id_alum'];
	echo "El identificador de este cliente es: $identificador</br>";
	$_SESSION['identificador']=$identificador;
	$_SESSION['asigrepo']=$identificador;
	$alumnos_padre=$identificador;

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
			<li><a href="administrador.php">Home</a></li>
			<li><a href="pabre2.php">alumnos</a></li>
			<li><a href="reportes2.php?<?php echo "id_alum=$identificador";?>">Reportes de los profesores</a></li>
			
			<li><a href="contactos.php">Contactos</a></li>
			<li><a href="Mi Cuentap.php">Mi Cuenta</a></li>
			</ul>
		</div>




		
		<div id="centro">
			<h3>ver el historial base de datos alumnos</h3>
			<table border="1";>
				<tr><th> ID</th><th> Usuario</th><th> usuario</th>
					<th> accion</th><th> id de los alumnos</th><th> elimina</th>

			<?php
			require "php/a_mantenet_laconexion_a_mysq.php";

			$GetUser4 = mysql_query("SELECT * FROM  historial_alu");
			$sumadecampo4=mysql_num_rows($GetUser4);
			for ($deri=0; $deri<$sumadecampo4; $deri++) {
			$ID=mysql_result($GetUser4, $deri,"id");
			$nombre=mysql_result($GetUser4, $deri,"fecha");
			$apellido=mysql_result($GetUser4, $deri,"usuario");
			//$nivel_del_curso=mysql_result($GetUser4, $deri,"nivel_del_curso");
			
			$correo=mysql_result($GetUser4, $deri,"accion");
			$ciudad=mysql_result($GetUser4, $deri,"alumnos_ID");
			
			echo "<tr><td>$ID</td><td>$nombre</td><td>$apellido</td><td>$correo</td><td>$ciudad</td>";
			echo "<td><a href='php/eliminaadmdo.php?id=$ID'> Elimina</a></td></tr>";
			
			
			


			


			
			//echo "<div id='report'><a href='ver_reportes.php?id=$codigo'> $descricion $nom_asignatura __ $fecha  </a></div>";
			

			//echo "</td></tr>";
		}	
		
			?>
		</table>
		</div>
</div><!--fin de centro-->
</div><!--fin de agrupar-->
<div id="pie">Derecho de Autor &copy; Marcos Alberto Saavedra Sanadria y Diego Beltran</div>
</body>
</html>