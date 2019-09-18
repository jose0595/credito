<?php 
 	require_once "../clases/conexion.php";
	require_once "../clases/crud.php";
	$obj= new crud();

	$datosC=array(
		$_POST['rfcU'],
        $_POST['razonU'],
        $_POST['nombreU'],
        $_POST['apellidoU'],
        $_POST['direccionU'],
        $_POST['telefonoU'], 
        $_POST['ciudadesU'],
        $_POST['estadosU'],
        $_POST['categoriasU'],
          $_POST['idclientes']
				);

	echo $obj->actualizarC($datosC);



?>