<?php
	include('../../src/dbconnect.php'); 
	$id = $_GET["id"]; 
	$consulta = "DELETE FROM usuario WHERE usuario_id = '{$id}'"; 
	mysql_query($consulta, $connect);
	header("location: profesor_lista.php?success=1");
 ?>