<?php
    session_start();
    require_once "clases/conexion.php";
    $obj= new conectar();
    $conexion = $obj->conexion();
    
    $status= $_SESSION['id'];

    $sql="select clientes.RFC, clientes.nombre, clientes.apellidos, credito.id_credito, credito.cantidadsolicitada,  credito.fechasolicitud, estado_credito.estatus, credito.cantidadaprobada, credito.fechaaprobado, usuarios.nombre from clientes inner join credito on credito.id_cliente = clientes.id_cliente inner join usuarios on credito.id_usuario = usuarios.id_usuario inner join estado_credito on credito.id_status = estado_credito.id_status where credito.id_status='$status'";
    $result=mysqli_query($conexion,$sql);
?>
<table cellspacing="0" style="width: 100%;">
        <tr>

            <td style="width: 25%; color: #444444;">
                <img style="width: 100%;" src="assets/img/mavasa.png" alt="Logo"><br>
            </td>
            <td style="width: 50%; color: #34495e;font-size:12px;text-align:center">
                <span style="color: #34495e;font-size:14px;font-weight:bold">Materiales y Triturados Valladolid</span>
                <br>Calle. 38 #182 entre calle 35 y calle 37
                    Colonia Centro Valladolid, Yucatán.<br> 
                Teléfono: 985-85-6-38-11<br>
                Email: contacto@mavasa.com.mx
            </td>
            <td style="width: 25%;text-align:right">
            
            </td>
            
        </tr>
    </table>
    <br><br><br>
    <table cellspacing="0" style="width: 100%;">
        <tr>
            <td style="width: 100%; color: #34495e;font-size:12px;text-align:center">
                <span style="color: #34495e;font-size:25px;font-weight:bold">Reporte de credito por estado de credito</span>
            </td>
        </tr>
    </table>
 <br><br><br>
<div class="table-responsive">
    <table class="table table-hover table-responsive" style="width:100%" id="iddatable">
        <thead>
            <tr style="background-color: #EC3609; color: white; font-weight: bold;">
                 <td>RFC</td>
                 <td>Nombre</td>
                 <td>Monto Solicitado</td>
                 <td>Fecha solicitud</td>
                 <td>Status</td>
                 <td>Monto Aprobado</td>
                 <td>Fecha Aprobado</td>
                 <td>Usuario</td>
            </tr>
        </thead>
        <tbody>
            <?php while ($mostrar=mysqli_fetch_row($result)){?>
            <tr>
                <td> <?php echo $mostrar[0]?></td>
                <td><?php echo $mostrar[1]; echo "<br>"; echo $mostrar[2];?></td>
                <td><?php echo number_format($mostrar[4],2);?></td>
                <td><?php echo date('d-m-Y', strtotime(@$mostrar[5]));?></td>
                <td><?php echo $mostrar[6]?></td>
                <td><?php echo number_format($mostrar[7],2);?></td>
                 <td><?php echo $mostrar[8]?></td>
                 <td><?php echo $mostrar[9]?></td>
            </tr>
            <?php }?>
        </tbody>
    </table>
</div>