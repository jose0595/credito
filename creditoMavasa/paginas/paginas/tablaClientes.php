<?php
session_start();
    require_once "clases/conexion.php";
    $obj= new conectar();
    $conexion = $obj->conexion();

        $sql="select clientes.id_cliente, clientes.rfc, clientes.nombre, clientes.apellidos, clientes.direccion, ciudades.ciudad, estados.estado, categorias_empresa.categoria, clientes.telefono from clientes inner join ciudades on clientes.id_ciudad = ciudades.id_ciudad inner join estados on clientes.id_estado = estados.id_estado inner join categorias_empresa on clientes.id_categoria = categorias_empresa.id_categoria";
    $result=mysqli_query($conexion,$sql);
?>
<div class="table-responsive">
    <table class="table table-hover table-responsive" id="iddatable">
        <thead style="background-color: #EC3609; color: white; font-weight: bold;">
            <tr>
                <td>RFC</td>
                 <td>Nombre</td>
                <td>Dirección</td>
 				<td>Ciudad</td>
 				<td>Estado</td>
                 <td>Tipo de empresa</td>
                <td>Telefono</td>
                <td>Modificar</td>
                <?php if($_SESSION['rol']==1): ?>
                <td>Eliminar</td>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php while ($mostrar=mysqli_fetch_row($result)){?>
            <tr>
                <td> <?php echo $mostrar[1]?></td>
                <td><?php echo $mostrar[2]; echo "<br>"; echo  $mostrar[3];?> </td>
                <td><?php echo $mostrar[4]?></td>
                <td><?php echo $mostrar[5]?></td>
                <td><?php echo $mostrar[6]?></td>
                <td><?php echo $mostrar[7]?></td>
                <td><?php echo $mostrar[8]?></td>
                <td style="text-align: center;">
                    <span class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEditar" onclick="agregaFrmActualizar('<?php echo $mostrar[0];?>')">
                        <span><i class="far fa-edit"></i></span>
                    </span>
                </td>
<?php if($_SESSION['rol']==1): ?>
                <td style="text-align: center;">
                    <span class="btn btn-danger btn-sm" onclick="eliminarDatos('<?php echo $mostrar[0];?>')">
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
