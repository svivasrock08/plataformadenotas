<?php
session_start();
error_reporting(0);

date_default_timezone_set("America/lima"); 
$fecha=date("Y-m-d H:i:s",time());
echo "$fecha<br>";

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
	
	$GetUser = mysql_query("SELECT * FROM profesores WHERE usuario = '$U' AND contra = '".md5($P)."'");
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
	
	$getUser = mysql_query("SELECT * FROM profesores WHERE usuario = '$SU' AND contra = '".md5($SP)."'");
	
	if(mysql_num_rows($GetUser) > 0){
		
		$lml = mysql_fetch_assoc($getUser);

		
		
		//$lml=mysql_result("consulta");
		define("User", true);
	}
	$getUser = mysql_query("SELECT * FROM profesores WHERE usuario = '$SU' AND contra = '".md5($SP)."'");	
	while ($dato = mysql_fetch_array($getUser)){
			$ID="$dato[ID]";
			$usuario="$dato[usuario]";
			$nombre="$dato[nombre]";		 	
		 	$apellido="$dato[apellido]";
		 	$fechanac="$dato[fechanac]";
		 	$ciudad="$dato[ciudad]";
		 	$correo="$dato[correo]";
		 	$cargo="$dato[cargo]";
		 	
		 	$_SESSION['ID']=$ID;
		 	$_SESSION['usuario']=$usuario;
		 	$_SESSION['nombre']=$nombre;
		 	$_SESSION['apellido']=$apellido;
		 	$_SESSION['fechanac']=$fechanac;
		 	$_SESSION['ciudad']=$ciudad;
		 	$_SESSION['correo']=$correo;
		 	$_SESSION['cargo']=$cargo;
		 	if ($ID==2) {
		 		echo "eres el adminstrador";
		 		echo '<meta http-equiv="Refresh" content="0;URL=administrador.php" />';
		 	}

		 	//controlador del historial
			$accion="inicio de seccion";
			//date_default_timezone_set('America/Bogota'); 	
			//$fecha= date("Y-m-d H:i:s");
			mysql_query("INSERT INTO historial (profesores_ID,usuario,tipo_de_usuario,accion,fecha) VALUES ('$ID','$ID','$usuario','$accion','$fecha')");	

		 	
		 	


		 	
		 
		}

} else {
	define("User", false);
}
echo " evita $docealu";
if(isset($_POST['RUsername']) && isset($_POST['ROPassword']) && isset($_POST['RTPassword']) && isset($_POST['docealu']) && isset($_POST['correo']) && isset($_POST['apellido']) && isset($_POST['ciudad'])&& isset($_POST['ano'])&& isset($_POST['nombre']))
{
	$RU = $_POST['RUsername'];
	$ROP = $_POST['ROPassword'];
	$RTP = $_POST['RTPassword'];
	$correo = $_POST['correo'];
	$docealu = $_POST['docealu'];
	$apellido = $_POST['apellido'];
	$nombre = $_POST['nombre'];
	$ciudad = $_POST['ciudad'];
	$ano = $_POST['ano'];
	$mes = $_POST['mes'];
	$dia = $_POST['dia'];
	$fecha="$ano"-"$mes"-"$dia";


	
	$Fail = false;
	
	$GetUser = mysql_query("SELECT * FROM profesores WHERE usuario = '$RU'");
	if(mysql_num_rows($GetUser) > 0)
	{
		$regis= "El usuario $RU ya existe, por favor elige otro<br>";
		$Fail = true;
	}
	elseif(empty($RU) || empty($ROP) || empty($RTP) || empty($docealu)|| empty($correo) || empty($apellido) || empty($ciudad) || empty($ano) || empty($mes)|| empty($dia)|| empty($fecha) )
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
	{echo " guarda la base de datos $docealu - $RU - $ROP - $nombre - $apellido - $ciudad - $correo ";
		mysql_select_db("sistema_de_notas");
		mysql_query("INSERT INTO profesores (usuario,contra,nombre,apellido,ciudad,correo,cargo,fechanac) VALUES ('$RU', '".md5($ROP)."','$nombre','$apellido','$ciudad','$correo','$docealu','$ano-$mes-$dia')");
		$mesa1= 'Tu usuario ha sido registrado<br><meta http-equiv="Refresh" content="20;URL=./" />';
		echo "$RU - $nombre - $apellido - $ciudad - $correo";
	}
}

if($_GET['action'] == 'exit')

{
			$accion="fin de seccion";
			//date_default_timezone_set('America/Bogota'); 	
	
			//$fecha= date("Y-m-d H:i:s");
			mysql_query("INSERT INTO historial (profesores_ID,usuario,tipo_de_usuario,accion,fecha) VALUES ('$ID','$ID','$usuario','$accion','$fecha')");	



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
		cargo que ejercer:<br>
		<select name="docealu" id="usuario2">
								<option></option>
								
								 
								<option>Docente</option>;
								<option>Alumno</option>;
								<option>Rector</option>;	
								
								
								
								</select>
		<br>						
		Correo:<br>
		<input type="text" name="correo" placeholder="Mi Correo@gmail.com" id="usuario2" /><br>
		Nombre:<br>
		<input type="text" name="nombre" placeholder="Mi Nombre" id="usuario2" /><br>
		Apellido:<br>
		<input type="text" name="apellido" placeholder="Mi Apellido" id="usuario2" /><br>
		Ciudad:<br>
		<input type="text" name="ciudad" placeholder="Ciudad" id="usuario2" /><br>
		fecha de nacimientos:<br>
		<input type="text" name="nacimiento" placeholder="Fecha de Nacimiento" id="usuario2" /><br>
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
			<li><a href="docente.php">Home</a></li>
			<li><a href="registro.php">Nuevo Registro</a></li>
			<li><a href="Mi_asignatuta.php">Mi asignatura</a></li>
			<li><a href="Mi_cuenta.php">Mi Cuenta</a></li>
			<li><a href="#">Contact</a></li>
			</ul>
		</div>

	<div id="principal">
		


			<div id="segundo">
				<?php
				echo "hola mundo $cargo";
				?>
				<form action="" method="POST">
				crear una nueva asignatura:<br>

				<a href="registro.php">crear una nueva asignatura</a>
				<p>asignatura que altualmente tiene</p>
				<?php

				if (Alumno==$cargo) {
					echo "nivel de seguridad Alumno</br>";
					echo '<a href="asignatura.php">ver materia</a></br>';
					
					//me muestra la asignatura que tiene
					require 'php/base1.php';
						
				


				}
				if (Docente==$cargo) {
					echo "nivel de seguridad Docente";


				}
				if (Rector==$cargo) {
					echo "nivel de seguridad Rector";


				}
				?>
				



				

<!--$getUser = mysql_query("SELECT * FROM profesores WHERE usuario = '$SU' AND contra = '".md5($SP)."'");
	
	if(mysql_num_rows($GetUser) > 0){
-->

				</form> 

			</div><!--fin de segundo-->
			<div id="trecero">
				<div id = "tabla" >


					<table border ="1" class = "table table-hover" >
						<caption>
							<h5>Resultado de la busqueda</h5>
						</caption>
						<thead>
							<tr>
								<th witch=100>materia</th>
								<th>n_1</th>
								<th>n_2</th>
								<th>n_3</th>
								<th>n_4</th>
							</tr>
							<?php
							
 

							
							
								echo "$ID<br>";
		 						echo "$usuario<br>";
		 						echo "$nombre<br>";
		 						echo "$apellido<br>";
							 	echo "$fechanac<br>";
							 	echo "$ciudad<br>";
								echo "$correo<br>";
								echo "$cargo<br>";

								echo "hola\r mundo";
					
								
							?>
						</thead>
						
					</table>
				</div>



			</div>

		<?php } 

		?>	
		


		</div><!--fin de pricipal-->
	</div><!--fin de agrupar-->
	<div id="pie">Derecho de Autor &copy; Marcos Alberto Saavedra Sanadria y Diego Alexander Beltran Hernandez </div>
</body>
</html>