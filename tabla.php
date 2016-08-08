<?php
$la_bd = "agenda";
$la_tabla="la_agenda";
$bd=myqsl_connect("localhost","un_usr","una_clave");
if (!db) 
	die("<h3> ERROR AL CONECTAR");


echo "CREADO BASE DE DATOS";
$sql= "creater database $la_tabla;";
if(!resul=mysql_query($sql,$db))
	die("<h3> error: al seleccionar bd $la_bd</h3>".mysql_error());

echo "creador la tabla $la_tabla";
$sql="creater table $la_tabla(
	nombre char(35) not null,
	correo char(35),
	tlf_fijo char(35),
	tlf_movi char(35),
	primary key(nombre)
	);";

if (!result=msql_query($sql,$db)
	die("<h3> error al ejercutar: '$sql' (".mysql_error()));

	$res=mysql_query("select * FROM $tabla"); 
	# code...











?>