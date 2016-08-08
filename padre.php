<?php
session_start();
error_reporting(0);

require "php/a_mantenet_laconexion_a_mysq.php";
//
function ProtectVars($str){
	$str = addslashes($str);
	$str = mysql_real_escape_string($str);
	$str = htmlspecialchars($str);
	return $str;
}

foreach($_POST as $param => $value)
{
	$_POST[$param] = ProtectVars($value);
}
foreach($GET as $param => $value)
{
	$_GET[$param] = ProtectVars($value);
}




//$regis="";
//$mcontra="";
if(isset($_POST['Username']) && isset($_POST['Password'])){
	$U = $_POST['Username'];
	$P = $_POST['Password'];
	$Fail = false;
	$eee=md5($P);
	echo "$U Y $P $eee ";
	$GetUser = mysql_query("SELECT * FROM padre WHERE usuario = '$U' AND contra = '".md5($P)."'");
	if(empty($U) || empty($P))
	{
		$mesa1 ='Los datos estan vacios';
	}
	elseif(mysql_num_rows($GetUser) == 0)
	{
		$mesa2 = 'El usuario no existe o la contrase&ntilde;a es incorrecta';
		$Fail = true;
	}
	if($Fail == false)
	{
		if(mysql_num_rows($GetUser) > 0)
		{
			$_SESSION['Username'] = $U;
			$_SESSION['Password'] = $P;
		}
	}
}

if(isset($_SESSION['Username']) && isset($_SESSION['Password']))
{
	$SU = $_SESSION['Username'];
	$SP = $_SESSION['Password'];
	
	$getUser = mysql_query("SELECT * FROM padre WHERE usuario = '$SU' AND contra = '".md5($SP)."'");
	
	if(mysql_num_rows($GetUser) > 0){
		
		$lml = mysql_fetch_assoc($getUser);

		
		
		//$lml=mysql_result("consulta");
		define("User", true);
	}
	$getUser = mysql_query("SELECT * FROM padre WHERE usuario = '$SU' AND contra = '".md5($SP)."'");	
	while ($dato = mysql_fetch_array($getUser)){
			//$ID="$dato[ID]";
			$ID="$dato[ID]";
			//$id="$dato[id]";
			//echo "$id oret $ID";
			$usuario="$dato[asignatura]";
			$nombre="$dato[nombre]";		 	
		 	$apellido="$dato[apellido]";
		 	$nivel_del_curso="$dato[nivel_del_curso]";
		 	$institucion="$dato[institucion]";
		 	$usuario="$dato[usuario]";
		 	
		 	
		 	$_SESSION['ID']=$ID;
		 	$_SESSION['usuario']=$usuario;
		 	$_SESSION['nombre']=$nombre;
		 	$_SESSION['apellido']=$apellido;
		 	$_SESSION['fechanac']=$nivel_del_curso;
		 	$_SESSION['ciudad']=$institucion;
		 	
			require "php/historialpadre.php";		 	
/*
		 	echo "el id $ID";
		 	//$ID = $_SESSION["ID"];
$usuario = $_SESSION["usuario"];
$ID = $_SESSION["ID"];
	$accion="inicio de seccion";
	date_default_timezone_set('America/Bogota'); 	
	$fecha= date("Y-m-d H:i:s");
	mysql_query("INSERT INTO historial_padre (id,usuario,accion,fecha,padre_ID) VALUES ('$ID','$usuario','$accion','$fecha','$ID')");
	//mysql_query("INSERT INTO  `sistema_de_notas`.`historial_padre` (`id` ,`fecha` ,`usuario` ,`accion`,`padre_ID`) VALUES ('',	




		 	echo "$ID<br>";
		 	echo "$usuario<br>";
		 	echo "$nombre<br>";
		 	echo "$apellido<br>";
		 	echo "$fechanac<br>";
		 	echo "$ciudad<br>";
			echo "$correo<br>";
			echo "$cargo<br>";
*/		 
		}

} else {
	define("User", false);
}
//echo " evita $docealu";
if(isset($_POST['RUsername']) && isset($_POST['ROPassword']) && isset($_POST['RTPassword'])  && isset($_POST['correo'])  && isset($_POST['apellido']) && isset($_POST['ciudad'])&& isset($_POST['ano'])&& isset($_POST['nombre']))
{
	$RU = $_POST['RUsername'];
	$ROP = $_POST['ROPassword'];
	$RTP = $_POST['RTPassword'];
	$correo = $_POST['correo'];
	$nivel_del_curso = $_POST['nivel_curso'];
	
	$apellido = $_POST['apellido'];
	$nombre = $_POST['nombre'];
	$ciudad = $_POST['ciudad'];
	$ano = $_POST['ano'];
	$mes = $_POST['mes'];
	$dia = $_POST['dia'];
	$fecha="$ano"-"$mes"-"$dia";


	
	$Fail = false;
	
	$GetUser = mysql_query("SELECT * FROM padre WHERE usuario = '$RU'");
	if(mysql_num_rows($GetUser) > 0)
	{
		$regis= "El usuario $RU ya existe, por favor elige otro<br>";
		$Fail = true;
	}
	elseif(empty($RU) || empty($ROP) || empty($RTP) || empty($correo) || empty($apellido) || empty($ciudad) || empty($ano) || empty($mes)|| empty($dia)|| empty($fecha) )
	{
		$mdatos= 'Algun dato esta vacio a&uacute;n<br>';
		$Fail = true;
	}
	elseif($RTP !== $ROP)
	{
		$mcontra= 'Las dos contrase&ntilde;as no son iguales<br>';
		$Fail = true;

	}
	if($Fail == false)



//guarda la base de datos - papa - aaa123 - alberto - saavedra - girardot - once.marcos papa - alberto - saavedra - girardot - once.marcos


	{echo " guarda la base de datos $docealu - $RU - $ROP - $nombre - $apellido - $ciudad - $correo ";
		mysql_select_db("sistema_de_notas");
		echo"<script type='text/javascript'> alert('$docealu - $RU - $ROP - $nombre - $apellido - $ciudad - $correo -$ano-$mes-$dia')</script>";
		mysql_query("INSERT INTO padre (usuario,contra,nombre,apellido,ciudad,correo,fechanac) VALUES ('$RU', '".md5($ROP)."','$nombre','$apellido','$ciudad','$correo','$ano-$mes-$dia')");
		$mesa1= 'Tu usuario ha sido registrado<br><meta http-equiv="Refresh" content="20;URL=padre.php" />';
		echo "$RU - $nombre - $apellido - $ciudad - $correo";
	}
}

if($_GET['action'] == 'exit')

{
			require "php/historialpadre2.php";

	session_destroy();
	echo '<meta http-equiv="Refresh" content="0;URL=./" />';
}
?>
<!DOCTYPE HTML>
<html>
<head>
	
	<title><?php echo User == true ? "$usuario" : 'A&uacute;n sin entrar'; ?></title>
	<style type="text/css">body{font-family:Segoe UI;}</style>
	<link rel="stylesheet" href="CSS/estilosCSS.css" type="text/css" />
	<script src = "js/jquery.js" ></script>
	<script src = "bootstrap/js/bootstrap.js" ></script>
	<script src = "js/index.js" ></script>
	<link rel = "stylesheet" href = "bootstrap/css/bootstrap.css" />
	<link rel = "stylesheet" href = "css/index.css" />
</head>
<body>
	<div id="traduc" style="font-size: 30px; font-family: Segoe UI;">Bienvenido SIONO   "1a5" "SISTEMA ONLINE DE NOTAS" </div>
	<div id="agrupar">


	<?php if(User == false) { ?>
	<div id="centro">
	<label style="font-size: 30px; font-family: Segoe UI;">Ingresar</label><br>
	<?php echo "<h3> $mesa1</h3>"?>
	<?php echo "<h3> $mesa2</h3>"?>
	<form action="" method="POST">
		Nombre de usuario:<br>
		<input type="text" name="Username" placeholder="Nombre de usuario" id="usuario2"/><br>
		Contraseña:<br>
		<input type="password" name="Password" placeholder="********" id="usuario2" /><br>
		<input type="submit" value="Entrar" id="usuario2" />
	</form>
	<label style="font-size: 30px; font-family: Segoe UI;">¿Sin cuenta?, Registro</label><br>
	<form action="" method="POST">
		<?php echo "<h3> $mdatos</h3>"?>
		<?php echo "<h3> $regis</h3>"?>
		<?php echo "<h3> $mcontra</h3>"?>
	
		Nombre de usuario:<br>
		<input type="text" name="RUsername" placeholder="Nombre de usuario" id="usuario2" /><br>
		Contraseña:<br>
		<input type="password" name="ROPassword" placeholder="*********" id="usuario2"/><br>
		Verificar contraseña:<br>
		<input type="password" name="RTPassword" placeholder="*********" id="usuario2"/><br>
		
								
		Correo:<br>
		<input type="text" name="correo" placeholder="Mi Correo@gmail.com" id="usuario2" /><br>
		Nombre:<br>
		<input type="text" name="nombre" placeholder="Mi Nombre" id="usuario2" /><br>
		Apellido:<br>
		<input type="text" name="apellido" placeholder="Mi Apellido" id="usuario2" /><br>
		Ciudad:<br>
		<input type="text" name="ciudad" placeholder="Ciudad" id="usuario2" /><br>
		Años:
		

		<select name="ano" id="usuario2">
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






		<input type="submit" value="Registrarme" id="usuario2"/>
		<!--<input type="submit" value="Entrar" id="usuario2" />
	-->
	</form>
	</div><!--centro-->


	<?php } if(User == true){ 

	# code...
			
	

		?>
	<div id="centro">	
	<label style="font-size: 30px; font-family: Segoe UI;">Bienvenido</label><br>
	<b>Hola, <?php echo $usuario; ?></b><br>
	<a href="?action=exit">Cerrar Sesion</a>


	
	</div><!--centro-->
	<div id="container">
		<ul>
			<li><a href="padre.php">Home</a></li>
			<li><a href="pabre2.php">alumnos</a></li>
			<li><a href="Mi Cuentap.php">Mi Cuenta</a></li>

			<li><a href="contactos.php">Contactos</a></li>
			</ul>
		</div>

	<div id="principal">
			
			<div id="principalalumnos">
				
				
				




				<div id = "tabla" >

					
				</div><!--fin de tabla-->



			</div><!--fin de principaalumnos-->


		<?php } 

		?>	
		


		</div><!--fin de pricipal-->
	</div><!--fin de agrupar-->
	<div id="pie">Derecho de Autor &copy; Marcos Alberto Saavedra Sanadria y Diego Alexander Beltran Hernandez </div>
</body>
</html>