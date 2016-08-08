</head>
<body>
<?php


$conectado = @mysql_connect ("localhost","root","root");
	mysql_select_db("bd1",$conectado);
$consulta="SELECT nombre,marca,cantidad FROM productos;";
$hacerconsulta=mysql_query($consulta, $conectado);
$numeroderegistro=mysql_num_rows($haceconsulta);
?>
	
	<table border="2" cellpadding="2" cellspacing="0">
	<tr><th colspan="3"> relaci&oacute;n de productos de menos de 10;</th></tr>
	
						<tr><th>codigo</th>
						<th>descripcion</th>
						<th>compra</th></tr>
						<?php
						
						for($contador=0;$contador<$numeroderegistro;$contador++){
						$codigo=mysql_result($hacerconsulta, $contador,"nombre");
						$descricion=mysql_result($hacerconsulta,$contador, "marca");
						$preciodecompra=mysql_result($hacerconsulta, $contador,"cantidad");
						?>
						
						<tr><td><?php echo($codigo);?></td>
						<td><?php echo ($descricion);?></td>
						<td><?php echo ($preciodecompra);?></td></tr>
						<?php
						}
						
						?>
						</table>
						<?php
						echo "el codigo es de $codigo";
						echo "el codigo es de $codigo";
						echo "el codigo es de $codigo";
						echo "el codigo es de $codigo";
						?>
						</body>
						</html>


