<?php
session_start(); /*Inicia una sesion*/
require_once "conexion.php"; /*Hace uso del archivo conexion para establecer la conexion a la base de datos*/
?>
<?php
$obj= new conectar();
$conexion=$obj->conexion();
if(is_null($conexion)){
    $username = $_POST['usuario'];
$password = $_POST['password'];
$idcredito= $_POST['idcredito'];
$sql = "SELECT * FROM usuarios WHERE nombre = '$username'";
$result = mysqli_query($conexion,$sql);
if ($result->num_rows > 0) {
 }
 $row = $result->fetch_array(MYSQLI_ASSOC);
 if (password_verify($password, $row['password'])) {
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $username;
    $_SESSION['start'] = time();
    $_SESSION['idcredito']= $idcredito;
    echo "<script text='text/javascript'>
        window.location = 'verifica.php';
        </script>";
 } else {
   echo "<script text='text/javascript'>
        alert('El usuario y el password no coinciden');
        window.location = '../index.php';
        </script>";
 }
 mysqli_close($conexion);
}else{
    header('location: ../index.php');
    exit();
}

 ?>