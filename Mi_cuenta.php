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
	$fecha= date("Y-m-d H:i:s");
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
		
		<?php } ?>
	 	
		 	
		
		<div id="segundo2">
			

			
			
			<h2>Mi Cuenta</h2>
			<?php
								echo "<table border='1'>";
								echo " <tr><td>ID</td><td> $ID</td></tr>";
								echo " <tr><td>Nombre de nick:</td><td> $usuario</td></tr>";

		 						echo " <tr><td>Nombre</td><td> $nombre</td></tr>";
		 						echo " <tr><td>apellido</td><td> $apellido</td></tr>";
		 						echo " <tr><td>fecha de nacimiento</td><td> $fechanac</td></tr>";
							 	echo " <tr><td>ciudad</td><td> $ciudad</td></tr>";
							 	echo " <tr><td>correo eletronico</td><td> $correo</td></tr>";
								echo " <tr><td>cargo</td><td> $cargo</td></tr></table>";
								



			?>		

		
		<h4>Nombre:</h4>
		<input type="text" name="nombre" placeholder="Mi Nombre" id="usuario2" value="<?php echo $nombre?>" /><br>
		<h4>Apellido:</h4>
		<input type="text" name="apellido" placeholder="Mi Apellido" id="usuario2" value="<?php echo $apellido?>" /><br>
		<h4>Ciudad:</h4>
		<input type="text" name="ciudad" placeholder="Ciudad" id="usuario2" value="<?php echo $ciudad?>" /><br>
		<h4>Correo:</h4>
		<input type="text" name="correo" placeholder="Mi Correo@gmail.com" id="usuario2" value="<?php echo $correo?>" /><br>

		
		<h4>Años:</h4>

		<select name="ano" id="usuario2"value="<?php echo $fechanac?>" >
								<option></option>
								<?php
								for ($ano=1900; $ano <2015 ; $ano++) { 
								echo "<option>$ano</option>";	
								}
								?>
								
								</select>
		Mes	:					
		<select name="mes" id="usuario2">
								<option></option>
								<?php
								for ($mes=1; $mes <=12 ; $mes++) { 
								echo "<option>$mes</option>";
								}
								?>
								</select>
		Dia:													
		<select name="dia" id="usuario2">
								<option></option>		
								<?php
								for ($dia=1; $dia <=31 ; $dia++) { 
								echo "<option>$dia</option>";	
								}
								?>
								
								</select><br>

								<input type="submit" value="Modificar" id="usuario2" title="modifica los datos del perfil"/>

				


		


		</div>
		<div id="segundo2">
			<form action="php/cambiacontra.php" method="POST" >
			<h2>cambia la contraseña</h2>
			<h4>escribir la vieja contraseña</h4>

		<input type="password" name="contralviejo" placeholder="********" id="usuario2" title="Escribir la contraseña actual" /><br>
			<h4>escribir la nueva contraseña</h4>
		<input type="password" name="contra" placeholder="********" id="usuario2" title="escribir la nueva contraseña" /><br>
		<h4>vuelva escribir la nueva contraseña</h4>
		<input type="password" name="contrarepe" placeholder="********" id="usuario2" title="vuelva escribir la nueva contraseña"/><br>
		<input type="submit" value="Cambia Contraseña" id="usuario2" title="cambia contraseña"/>
	</form>
		</div>
		
	</div><!--fin de agrupar-->
	<div id="pie">Derecho de Autor &copy; Marcos Alberto Saavedra Sanadria y Diego Alexander Beltran Hernandez </div>
</body>
</html>