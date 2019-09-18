<?php 
require_once "../clases/conexion.php";
	require_once "../clases/crud.php";
	$obj= new crud();

	$datos= array(
				$_POST['ciudad']
				);

	echo $obj->agregarCiudad($datos);
?>