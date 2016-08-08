<?php
session_start(); //esta linea tiene que ir antes de cualquier cosa, incluso de espacios 
error_reporting(0);


//echo $_SESSION['usuario']; 

require "php/a_mantenet_laconexion_a_mysq.php";
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
	<div id="traduc" style="font-size: 30px; font-family: Segoe UI;">Bienvenido a SONIA o SIONO   "1a5" "SISTEMA ONLINE DE NOTAS" </div>
	<div id="agrupar">
		<div id="centro">
		<?php if(User == false) { ?>
		echo '<meta http-equiv="Refresh" content="0;URL=./" />';
	
		<?php } if(User == true) { ?>
		<label style="font-size: 30px; font-family: Segoe UI;">Bienvenido</label><br>
		<b>Hola, <?php echo $usuario; ?></b><br>
		<a href="?action=exit">Salir</a>
		</div><!--fin de centro-->
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

		 	$_SESSION['ID']=$ID;
		 	?>
		</div>
		<div id="segundo">
			

			<?php
			echo "$mesa1";
			//$getUser = mysql_query("SELECT * FROM profesores WHERE usuario = '$SU' AND contra = '".md5($SP)."'");
			?>
			
			<h4>asignatura que actualmente usted tiene<h4>

				<?php
					//me muestra la asignatura que tiene
					require 'base1.php';
						
				?>

				<form action="materia.php" method="POST">
				<input type="text" name="nombreasi" placeholder="Codigo de la materia" id="usuario2" /><br>
				<input type="submit" value="añair materia" id="usuario2">
				</form>



				<?php
				/*
				$vector=array("a"=>"hola","b"=>"mundo34");
				foreach ($vector as $key=>$value) {
					echo $key."=>".$value;
					# code...
				}
				*/
				$fru=array(
					"mora"=>array("mora","leche","azucar","agua"),
					"lulo"=>array("lulo","leche","azucar","agua","tarito","rojo"),
					

					);
				

				$canti=0;	
				foreach ($fru as $key=>$ingredientes) {
					echo $key."\n=>";
					$cantic++;
					foreach ($ingredientes as $key=>$value) {
					echo $value."\n";
					$canti++;
					if ($canti>$max) {

						$max=$canti;
					}
					
					}
					
					
					echo "</br> $canti";
				    $canti=0; 
				}

				?>











				


		


		</div>
		
		</div>
	</div><!--fin de agrupar-->
	<div id="pie">Derecho de Autor &copy; Marcos Alberto Saavedra Sanadria y Diego Beltran </div>
</body>

