<?php 
 	require_once "../clases/conexion.php";
	require_once "../clases/crud.php";
	$obj= new crud();

    $fechaS= date('Y-m-d', strtotime($_POST['fechaSU'])); 
    $fechaA= date('Y-m-d', strtotime($_POST['fechaAU'])); 

	$datosCr=array(
        $_POST['montoSU'],
        $fechaS,
        $_POST['statusU'],
        $_POST['montoAU'],
        $fechaA,
        $_POST['idusuarioU'],
        $_POST['idcreditos']
				);

	echo $obj->actualizarCr($datosCr);



?>