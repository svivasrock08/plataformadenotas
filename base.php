<?php
require "php/a_mantenet_laconexion_a_mysq.php";
$GetUser = mysql_query("SELECT * FROM asignatura");
$sumadecampo=mysql_num_fields($GetUser);
//echo "la tabla<b>$la_tabla</b>tiene $sumadecampo:<br>";
//echo "<table border=1>"
//echo "<tr bgcolor='lighgray'><th> nombre<th>tipo<th>tamaño<th><opciones>tre</tr>"\n";
for ($i=0; $i <$sumadecampo ; $i++) {
	$nombre = mysql_field_name($GetUser, $i);
	$tipo = mysql_field_type($GetUser, $i);
	$tam = mysql_field_len($GetUser, $i);
	$flags = mysql_field_flags($GetUser, $i);
	$busca = mysql_field_table($GetUser, $i);
	

	echo "$nombre $tipo $tam $flags $busca $resul <br>";
//	for($contador=0;$contador<$sumadecampo;$contador++){
						$codigo=mysql_result($GetUser, $contador,"nombre");
						$descricion=mysql_result($GetUser,$contador, "profesores_ID");
						$preciodecompra=mysql_result($GetUser, $contador,"fecha");
						echo "$codigo $descricion $preciodecompra";
//					}


}


?>