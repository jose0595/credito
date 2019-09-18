<?php 
 	require_once "../clases/conexion.php";
	require_once "../clases/crud.php";
	$obj= new crud();

 $form_pass = $_POST['password'];
 $hash = password_hash($form_pass, PASSWORD_BCRYPT);

	$datos=array(
		$_POST['nombre'],
		$hash,
		$_POST['nivel']
				);

	echo $obj->agregar($datos);



?>