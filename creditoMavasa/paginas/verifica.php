<?php
session_start();
require_once "conexion.php";
$obj= new conectar();
$conexion = $obj->conexion();
$username= $_SESSION['username'];
$idcredito= $_SESSION['idcredito'];
$sql="select * from usuarios where nombre='$username'";
$result= mysqli_query($conexion,$sql);
if(empty($_SESSION['idcredito'])){
if($f2=mysqli_fetch_assoc($result)){
		if($f2['nivel_usuario']==1){
			$_SESSION['id']=$f2['id_usuario'];
			$_SESSION['usuario']=$f2['nombre'];
			$_SESSION['rol']=$f2['nivel_usuario'];
			echo "<script>location.href='acceso.php'</script>";
		}else if($f2['nivel_usuario']==2){
      $_SESSION['id']=$f2['id_usuario'];
      $_SESSION['usuario']=$f2['nombre'];
      $_SESSION['rol']=$f2['nivel_usuario'];
			echo "<script>location.href='acceso.php'</script>";
        }
	}
}else{
	if($f2=mysqli_fetch_assoc($result)){
		if($f2['nivel_usuario']==1){
			$_SESSION['id']=$f2['id_usuario'];
			$_SESSION['usuario']=$f2['nombre'];
			$_SESSION['rol']=$f2['nivel_usuario'];
			$_SESSION['idcredit'] = $idcredito;
			echo "<script>location.href='http://creditomavasamatisa.mavasa.com.mx/creditoMavasa/paginas/acceso.php?p=creditos'</script>";
		}else{
		echo "<script text='text/javascript'>
		alert('Tienes que ser administrador, para editar creditos');
		window.location = '../index.php';
		</script>";
	}
	}

}
?>
