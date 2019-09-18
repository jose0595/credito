<?php
session_start();
    require_once "clases/conexion.php";
    $obj= new conectar();
    $conexion = $obj->conexion();

    if($_SESSION['rol']==1){
         $sql="select clientes.RFC, clientes.nombre, clientes.apellidos, credito.id_credito, credito.cantidadsolicitada,  credito.fechasolicitud, estado_credito.estatus, credito.cantidadaprobada, credito.fechaaprobado, usuarios.nombre from clientes inner join credito on credito.id_cliente = clientes.id_cliente inner join usuarios on credito.id_usuario = usuarios.id_usuario inner join estado_credito on credito.id_status = estado_credito.id_status";
    $result=mysqli_query($conexion,$sql);
        
    }else if($_SESSION['rol']==2){

        $sql="select clientes.RFC, clientes.nombre, clientes.apellidos, credito.id_credito, credito.cantidadsolicitada,  credito.fechasolicitud, estado_credito.estatus, credito.cantidadaprobada, credito.fechaaprobado, usuarios.nombre from clientes inner join credito on credito.id_cliente = clientes.id_cliente inner join usuarios on credito.id_usuario = usuarios.id_usuario inner join estado_credito on credito.id_status = estado_credito.id_status where credito.id_status !=1";
    $result=mysqli_query($conexion,$sql);

    }

   
?>
<div class="table-responsive">
    <table class="table table-hover table-responsive" style="width:100%" id="iddatable">
        <thead style="background-color: #EC3609; color: white; font-weight: bold;">
            <tr>
                 <td>RFC</td>
                 <td>Nombre</td>
                <td>Monto Solicitado</td>
                <td>Fecha solicitud</td>
                <td>Status</td>
                <td>Monto Aprobado</td>
                <td>Fecha Aprobado</td>
                <td>Usuario</td>
		<?php if($_SESSION['rol']==1): ?>
                <td>Modificar</td>
                <td>Eliminar</td>
            <?php endif; ?>
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
	<?php if($_SESSION['rol']==1): ?>
                <td style="text-align: center;">
                    <span class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEditar" onclick="agregaFrmActualizar('<?php echo $mostrar[3]; ?>')">
                        <span><i class="far fa-edit"></i></span>
                    </span>
                </td>
                <td style="text-align: center;">
                    <span class="btn btn-danger btn-sm" onclick="eliminarDatos('<?php echo $mostrar[3]; ?>')">
                        <span><i class="fas fa-trash-alt"></i></span>
                    </span>
                </td>
                <?php endif; ?>
            </tr>
            <?php }?>
        </tbody>
    </table>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('#iddatable').DataTable();
} );
</script>
