<?php 
 	require_once "../clases/conexion.php";
	require_once "../clases/crud.php";
	$obj= new crud();

 	$datosC=array(
		$_POST['rfc'],
        $_POST['razon'],
        $_POST['nombre'],
        $_POST['apellido'],
        $_POST['direccion'],
        $_POST['telefono'], 
        $_POST['ciudades'],
        $_POST['estados'],
        $_POST['categorias']
				);

	echo $obj->agregarCliente($datosC);
    
 

?>