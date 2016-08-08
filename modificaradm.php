<?php
session_start();
error_reporting(0);
$usuario = $_SESSION["usuario"];
if($_GET['action'] == 'exit'){
	require "php/a_mantenet_laconexion_a_mysq.php";
	$accion="fin de seccion";	
	$fecha= date("Y-m-d H:i:s");
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
	$id_alum = $_GET['id'];
	//echo "El identificador de este cliente es: $identificador</br>";
	$_SESSION['identificador']=$identificador;
	$_SESSION['asigrepo']=$identificador;
	$alumnos_padre=$identificador;
	$_SESSION['id_alum']=$id_alum;

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
	




		
		<div id="centro">
			<h3>modificar la cuenta de alumno </h3>
			<?php
			require "php/a_mantenet_laconexion_a_mysq.php";
			$GetUser = mysql_query("SELECT * FROM alumnos where ID='$id_alum'");
			$sumadecampo=mysql_num_rows($GetUser);

	//$tab1= '<table border="1" cellpadding="2" cellspacing="0">';
			for ($i=0; $i<$sumadecampo; $i++) {
			//$codigo=mysql_result($GetUser, $i,"ID");
			$nombre=mysql_result($GetUser, $i,"nombre");
			$apellido=mysql_result($GetUser, $i,"apellido");
			$niver_del_curso=mysql_result($GetUser, $i,"niver_del_curso");
			$institucion=mysql_result($GetUser, $i,"institucion");
			$ciudad=mysql_result($GetUser, $i,"ciudad");
			$correo=mysql_result($GetUser, $i,"correo");
	//		echo'<tr><td>';
			//echo "<div id='cuerpoa'><a href='casa.php?id=$codigo' title='$codigo $descricion' >$codigo $descricion </a></div><br>";
			

	//		echo "</td></tr>";
			
		}

?>


		<form action="php/modificaalumnoadm.php" method="POST">
		Nombre:<br>
		<input type="text" name="nombre" placeholder="Mi Nombre" id="usuario2" value="<?php echo $nombre?>" /><br>
		Correo:<br>
		<input type="text" name="correo" placeholder="Mi Correo@gmail.com" id="usuario2"value="<?php echo $correo?>" /><br>
		Apellido:<br>
		<input type="text" name="apellido" placeholder="Mi Apellido" id="usuario2" value="<?php echo $apellido?>"/><br>
		Ciudad:<br>
		<input type="text" name="ciudad" placeholder="Ciudad" id="usuario2" value="<?php echo $ciudad?>"/><br>
		

		<input type="submit" value="modificar" id="usuario2"/>
		<!--<input type="submit" value="Entrar" id="usuario2" />
	-->
	</form>
			
			
			


			


			
			
		</div>
</div><!--fin de centro-->
</div><!--fin de agrupar-->
<div id="pie">Derecho de Autor &copy; Marcos Alberto Saavedra Sanadria y Diego Beltran</div>
</body>
</html>