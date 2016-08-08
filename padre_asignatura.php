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
$alumnos_padre = $_GET['id'];
require "php/historialpadre3.php";
$_SESSION['$alumnos_padre']=$alumnos_padre;
echo "$ID";
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
	
	
require "php/historialpadre2.php";

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

		<div id="container">
		<ul>
			<li><a href="padre.php">Home</a></li>
			<li><a href="pabre2.php">alumnos</a></li>
			<li><a href="reportes2.php?<?php echo "id_alum=$alumnos_padre";?>">Reportes de los profesores</a></li>
			
			<li><a href="contactos.php">Contactos</a></li>
			<li><a href="Mi Cuentap.php">Mi Cuenta</a></li>
			
			</ul>
		</div>
		
		<?php } ?>
	 	
		 	
		
		<div id="segundo2">
			
			
			

			
			
			<h4>asignatura que actualmente tiene<h4>

				<?php
					mysql_connect("localhost", "root", "root");
	mysql_select_db("sistema_de_notas");
	//$ID = $_SESSION["ID"];
	$alumnoas = $_GET['id'];	
	$GetUser = mysql_query("SELECT * FROM notas where alumnos_ID='$alumnoas'");
	$sumadecampo=mysql_num_rows($GetUser);

	$tab1= '<table border="1" cellpadding="2" cellspacing="0">';
		for ($i=0; $i<$sumadecampo; $i++) {
			$codigo=mysql_result($GetUser, $i,"ID");
			$descricion=mysql_result($GetUser, $i,"asignatura_ID");
			$nom_asignatura=mysql_result($GetUser, $i,"nom_asignatura");


			
			echo'<tr><td>';
			echo "<a href='micasa_alu.php?id=$descricion'> $descricion $nom_asignatura  </a><br>";
			

			echo "</td></tr>";
			
		}
	echo "</table>";

				?>


				


		


		</div>
		
		
	</div><!--fin de agrupar-->
	<div id="pie">Derecho de Autor &copy; Marcos Alberto Saavedra Sanadria y Diego Beltran</div>
</body>
</html>