<?php 
 	require_once "../clases/conexion.php";
	require_once "../clases/crud.php";
	$obj= new crud();

    $fecha= date('Y-m-d', strtotime($_POST['fechaS']));
    $fechaA= date('Y-m-d', strtotime($_POST['fechaA'])); 
 	$datosCr=array(
        $_POST['montoS'],
        $fecha,
        $_POST['status'],
        $_POST['montoA'],
        $fechaA,
        $_POST['idcliente'],
        $_POST['idusuario']
				);

	echo $obj->agregarCredito($datosCr);
    
?>