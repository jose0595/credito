<?php
 	require_once "../clases/conexion.php";
	require_once "../clases/crud.php";
	$obj= new crud();

 $form_pass = $_POST['passwordU'];
 $hash = password_hash($form_pass, PASSWORD_BCRYPT);

	$datos=array(
		$_POST['nombreU'],
		$hash,
		$_POST['nivelU'],
    $_POST['idusuario']
				);

	echo $obj->actualizar($datos);

?>
