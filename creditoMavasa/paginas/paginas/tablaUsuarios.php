<?php
    require_once "clases/conexion.php";
    $obj= new conectar();
    $conexion = $obj->conexion();

    $sql="select * from usuarios";
    $result=mysqli_query($conexion,$sql);
?>
<div class="table-responsive">
    <table class="table table-hover table-condensed" id="iddatable">
        <thead style="background-color: #EC3609; color: white; font-weight: bold;">
            <tr>
                <td>Nombre</td>
                <td>Nivel</td>
                <td>Editar</td>
                <td>Eliminar</td>
            </tr>
        </thead>
        <tbody>
            <?php while ($mostrar=mysqli_fetch_row($result)){?>
            <tr>
                <td> <?php echo $mostrar[1]?></td>
                <td><?php echo $mostrar[3]?></td>
                <td style="text-align: center;">
                    <span class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEditar" onclick="agregaFrmActualizar('<?php echo $mostrar[0]?>')">
                        <span><i class="fas fa-user-edit"></i></span>
                    </span>
                </td>
                <td style="text-align: center;">
                    <span class="btn btn-danger btn-sm" onclick="eliminarDatos('<?php echo $mostrar[0]?>')">
                        <span><i class="fas fa-user-minus"></i></span>
                    </span>
                </td>
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
