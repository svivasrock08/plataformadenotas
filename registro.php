<?php
session_start(); //esta linea tiene que ir antes de cualquier cosa, incluso de espacios 
error_reporting(0);
$ID = $_SESSION["ID"];
$usuario = $_SESSION["usuario"];
$nombre = $_SESSION["nombre"];
$apellido = $_SESSION["apellido"];
$fechanac = $_SESSION["fechanac"];
$ciudad = $_SESSION["ciudad"];
$correo = $_SESSION["correo"]; 
//echo $_SESSION['usuario']; 

require "php/a_mantenet_laconexion_a_mysq.php";
//
function ProtectVars($str){
	$str = addslashes($str);
	$str = mysql_real_escape_string($str);
	$str = htmlspecialchars($str);
	return $str;
}

//$_SESSION['resultado']=$r; 

foreach($_POST as $param => $value)
{
	$_POST[$param] = ProtectVars($value);
}
foreach($GET as $param => $value)
{
	$_GET[$param] = ProtectVars($value);
}
if(isset($_SESSION['Username']) && isset($_SESSION['Password']))
{
	{
		$lml = mysql_fetch_assoc($GetUser);
		define("User", true);
	}
} else {
	define("User", false);
}


if(isset($_POST['nombreasi'])){
	$www = $_POST['nombreasi'];
if(empty($www) || empty($www)){
	echo "salio";
	}else{
		echo "nio salio";

	}
}





if($_GET['action'] == 'exit'){
	$accion="fin de seccion";	
	date_default_timezone_set("America/lima"); 
	$fecha=date("Y-m-d H:i:s",time());
	mysql_query("INSERT INTO historial (profesores_ID,usuario,tipo_de_usuario,accion,fecha) VALUES ('$ID','$ID','$usuario','$accion','$fecha')");	

	session_destroy();
	define("User", false);
	echo '<meta http-equiv="Refresh" content="0;URL=./" />';
}
?>

<html>
<head>
	
	<title><?php echo User == true ? $usuario : 'A&uacute;n sin entrar'; ?></title>
	<style type="text/css">body{font-family:Segoe UI;}</style>
	<link rel="stylesheet" href="CSS/estilosCSS.css" type="text/css" />
</head>
<body>
	<div id="traduc" style="font-size: 30px; font-family: Segoe UI;">Bienvenido SIONO   "1a5" "SISTEMA ONLINE DE NOTAS" </div>
	<div id="agrupar">
		<div id="centro">
		<?php if(User == false) { ?>
		echo '<meta http-equiv="Refresh" content="0;URL=./" />';
	
		<?php } if(User == true) { ?>
		<label style="font-size: 30px; font-family: Segoe UI;">Bienvenido</label><br>
		<b>Hola, <?php echo $usuario; ?></b><br>
		<a href="?action=exit">Salir</a>
		</div><!--fin de centro-->

		<div id="container">
		<ul>
			<li><a href="docente.php">Home</a></li>
			<li><a href="registro.php">Nuevo Registro</a></li>
			<li><a href="Mi_asignatuta.php">Mi asignatura</a></li>
			<li><a href="Mi_cuenta.php">Mi Cuenta</a></li>
			<li><a href="#">Contact</a></li>
			</ul>
		</div>
		<div id="principal">
		<?php } ?>
		<div id="segundo">
			<?php
			echo "<br>$ID";
		 	echo "<br>$usuario";
		 	echo "<br>$nombre";
		 	echo "<br>$apellido";
		 	echo "<br>$fechanac";
		 	echo "<br>$ciudad";
		 	echo "<br>$correo";
		 	?>
		 	<h4>asignatura para eliminar</h4>
		 	<form action="php/eliminaasignatura.php" method="POST">
				<input type="text" name="id_elimina" placeholder="ID asignatura" id="usuario2" /><br>
				<input type="submit" value="elimina" id="usuario2">
			</form>
		 	
		 	
		 	
		 	
		</div>
		<div id="segundo">
			Crear nueva asignatura<br>
			Nombre de la Nueva Asignatura:<br>

			<?php
			
			//$mesa1 = $_SESSION["mesa1"];
			//echo "$mesa1";
			//$getUser = mysql_query("SELECT * FROM profesores WHERE usuario = '$SU' AND contra = '".md5($SP)."'");
			?>
			<form action="php/nuevaasignatura.php" method="POST">
				<input type="text" name="nombreasi" placeholder="asignatura" id="usuario2" /><br>
				<input type="submit" value="crear" id="usuario2">
			</form>
			<h4>asignatura que actualmente usted tiene<h4>

				<?php
					//me muestra la asignatura que tiene
					require 'php/base1.php';
						
				?>


				


		


		</div>
		
		</div>
	</div><!--fin de agrupar-->
	<div id="pie">Derecho de Autor &copy; Marcos Alberto Saavedra Sanadria y Diego Alexander Beltran Hernandez</div>
</body>
</html>