<?php
require_once '../clases/conexion.php';
$obj= new conectar();
$conexion = $obj->conexion();

$remitente = 'systemasweb@mavasa.com.mx';
$destinatario = $_POST['correo']; // en esta línea va el mail del destinatario.
$asunto = 'Solicitud de credito'; // acá se puede modificar el asunto del mail
if (!$_POST){
?>

<?php
}else{

    $idcredito= $_POST['idcredito'];		
    $idcliente= $_POST['idcliente'];
    $idstatus= $_POST['status'];
    $id= base64_encode($idcredito);		
    $link= 'http://creditomavasamatisa.mavasa.com.mx/creditoMavasa/index.php?id='.$id;

    $sql= "SELECT rfc, nombre, apellidos, ciudades.ciudad from clientes inner join ciudades on clientes.id_ciudad=ciudades.id_ciudad where id_cliente='$idcliente'";
    $result= mysqli_query($conexion,$sql);
    $c= mysqli_fetch_row($result);

    $nombre= $c[1]. " " . $c[2];
    $rNombre= "Sistemas web";

    $sql1= "SELECT estatus from estado_credito where id_status=' $idstatus'";
    $result1= mysqli_query($conexion,$sql1);
    $estatus= mysqli_fetch_row($result1)[0];


    $cuerpo = "Nombre del cliente: " . $nombre . "\r\n";
    $cuerpo .= "RFC cliente: " . $c[0] . "\r\n";
    $cuerpo .= "Monto solicitado: " . $_POST['montoS'] . "\r\n";
	$cuerpo .= "Fecha de solicitud: " . $_POST['fechaS'] . "\r\n";
    $cuerpo .= "Estado del credito: " . $estatus . "\r\n";
    $cuerpo .= "Lugar: " . $c[3] . "\r\n";
    $cuerpo .= "\r\n";
    $cuerpo .= "Favor de verificar los datos del credito siguiendo el siguiente enlace " . $link . "\r\n";
	//las líneas de arriba definen el contenido del mail. Las palabras que están dentro de $_POST[""] deben coincidir con el "name" de cada campo.
	// Si se agrega un campo al formulario, hay que agregarlo acá.

    $headers  = "MIME-Version: 1.0\n";
    $headers .= "Content-type: text/plain; charset=utf-8\n";
    $headers .= "X-Priority: 3\n";
    $headers .= "X-MSMail-Priority: Normal\n";
    $headers .= "X-Mailer: php\n";
    $headers .= "From: \"".$rNombre."\" <".$remitente.">\n";

    if ( mail($destinatario, $asunto, $cuerpo, $headers)) {
   
        echo 1;
   
    } else {
   
        echo 0;
    
    }
}


?>