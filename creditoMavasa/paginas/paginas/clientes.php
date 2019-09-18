	<?php
    require_once "scripts.php";
    require_once "clases/conexion.php";
    $obj= new conectar();
    $conexion = $obj->conexion();

    $sql= "select * from ciudades";
    $sql1= "select * from estados";
    $sql2= "select * from categorias_empresa";
    $result= mysqli_query($conexion,$sql);

    if(mysqli_num_rows($result)>0){
        $ciudad ="";
        while($row=mysqli_fetch_row($result)){
            $ciudad .= " <option value=\"{$row[0]}\">{$row[1]}</option>";
        }
    }else{

        echo "no se encontraron registros";
    }

     $result1= mysqli_query($conexion,$sql1);

    if(mysqli_num_rows($result1)>0){
        $estado ="";
        while($row=mysqli_fetch_row($result1)){
            $estado .= " <option value=\"{$row[0]}\">{$row[1]}</option>";
        }
    }else{

        echo "no se encontraron registros";
    }

     $result2= mysqli_query($conexion,$sql2);

    if(mysqli_num_rows($result2)>0){
        $empresas ="";
        while($row=mysqli_fetch_row($result2)){
            $empresas .= " <option value=\"{$row[0]}\">{$row[1]}</option>";
        }
    }else{

        echo "no se encontraron registros";
    }

    ?>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="card text-left">
					<div class="card-header">
						<h4 class="fas fa-table"><strong> Clientes</strong></h4>
					</div>
					<div class="card-body">
						<span class="btn btn-secondary" data-toggle="modal" data-target="#agregarnuevosdatosmodal">
							Nuevo Cliente <span class="fa fa-plus-circle"></span>
						</span>
						<span class="btn btn-info" data-toggle="modal" data-target="#agregarCiudad">
							Nueva Ciudad <span class="fa fa-plus-circle"></span>
						</span>
						<span class="btn btn-info" data-toggle="modal" data-target="#agregarEstado">
							Nuevo Estado <span class="fa fa-plus-circle"></span>
						</span>
						<hr>
						<div id="tablaDatatable"></div>
					</div>
					<div class="card-footer text-muted">
						Construrama sistema de creditos.
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="agregarnuevosdatosmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Nuevo cliente</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="frmnuevo">
                        <label>RFC</label>
						<input type="text" class="form-control input-sm" id="rfc" name="rfc">
                        <label>Razon social</label>
						<input type="text" class="form-control input-sm" id="razon" name="razon">
						<label>Nombre</label>
						<input type="text" class="form-control input-sm" id="nombre" name="nombre">
                        <label>Apellidos</label>
						<input type="text" class="form-control input-sm" id="apellido" name="apellido">
						<label>Direccion</label>
						<input type="text" class="form-control input-sm" id="direccion" name="direccion">
                        <label>Telefono</label>
						<input type="text" class="form-control input-sm" id="telefono" name="telefono">
                        <label for="ciudades">Ciudad</label>
                        <select class="form-control" id="ciudades" name="ciudades">
                                <option value="0">Selecciona una ciudad</option>
                                <?php
                               		echo $ciudad;
                                ?>
                              </select>
                        <label for="estados">Estado</label>
                        <select class="form-control" id="estados" name="estados">
                                <option value="0">Selecciona un estado</option>
                                <?php
                               echo $estado;
                                ?>
                              </select>
                        <label for="categorias">Tipo de empresa</label>
                        <select class="form-control" id="categorias" name="categorias">
                                <option value="0">Selecciona tipo de empresa</option>
                                 <?php
                               echo $empresas;
                                ?>
                              </select>

					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					<button type="button" id="btnAgregarnuevo" class="btn btn-primary">Agregar nuevo</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="agregarCiudad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Nueva ciudad</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="frmnuevaCiudad" autocomplete="off">
                        <label>Nombre</label>
						<input type="text" class="form-control input-sm" id="ciudad" name="ciudad">
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					<button type="button" id="btnAgregarnuevaCiudad" class="btn btn-primary">Agregar nuevo</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="agregarEstado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Nuevo Estado</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="frmnuevoEstado" autocomplete="off">
                        <label>Nombre</label>
						<input type="text" class="form-control input-sm" id="estado" name="estado">
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					<button type="button" id="btnAgregarnuevoEstado" class="btn btn-primary">Agregar nuevo</button>
				</div>
			</div>
		</div>
	</div>



	<!-- Modal -->
	<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Actualizar datos del cliente</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="frmnuevoU">
						<input type="text" hidden="" id="idclientes" name="idclientes">
						<label>RFC</label>
						<input type="text" class="form-control input-sm" id="rfcU" name="rfcU">
                        <label>Razon social</label>
						<input type="text" class="form-control input-sm" id="razonU" name="razonU">
						<label>Nombre</label>
						<input type="text" class="form-control input-sm" id="nombreU" name="nombreU">
                        <label>Apellidos</label>
						<input type="text" class="form-control input-sm" id="apellidoU" name="apellidoU">
						<label>Direccion</label>
						<input type="text" class="form-control input-sm" id="direccionU" name="direccionU">
                        <label>Telefono</label>
						<input type="text" class="form-control input-sm" id="telefonoU" name="telefonoU">
                        <label for="ciudadesU">Ciudad</label>
                        <select class="form-control" id="ciudadesU" name="ciudadesU">
                                <option value="0">Selecciona una ciudad</option>
                                <?php
                               echo $ciudad;
                                ?>
                              </select>
                        <label for="estadosU">Estado</label>
                        <select class="form-control" id="estadosU" name="estadosU">
                                <option value="0">Selecciona un estado</option>
                                <?php
                               echo $estado;
                                ?>
                              </select>
                        <label for="categoriasU">Tipo de empresa</label>
                        <select class="form-control" id="categoriasU" name="categoriasU">
                                <option value="0">Selecciona tipo de empresa</option>
                                 <?php
                               echo $empresas;
                                ?>
                              </select>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					<button type="button" class="btn btn-warning" id="btnActualizar">Actualizar</button>
				</div>
			</div>
		</div>
	</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('#btnAgregarnuevo').click(function(){
			datosC=$('#frmnuevo').serialize();
			$.ajax({
				type:"POST",
				data:datosC,
				url:"paginas/procesos/agregarC.php",
				success:function(r){
					if(r==1){
						$('#frmnuevo')[0].reset();
						$('#tablaDatatable').load('paginas/tablaClientes.php');
						alertify.success("agregado con exito");
					}else{
						alertify.error("Fallo al agregar");
					}
				}
			});
		});

		$('#btnAgregarnuevaCiudad').click(function(){
			datosCiudad=$('#frmnuevaCiudad').serialize();
			$.ajax({
				type:"POST",
				data:datosCiudad,
				url:"paginas/procesos/agregarCiudad.php",
				success:function(r){
					if(r==1){
						$('#frmnuevaCiudad')[0].reset();
						$('#tablaDatatable').load('paginas/tablaClientes.php');
						alertify.success("agregado con exito");
						setInterval(location.reload(),120000);
					}else{
						alertify.error("Fallo al agregar");
					}
				}
			});
		});

		$('#btnAgregarnuevoEstado').click(function(){
			datosEstados=$('#frmnuevoEstado').serialize();
			$.ajax({
				type:"POST",
				data:datosEstados,
				url:"paginas/procesos/agregarEstado.php",
				success:function(r){
					if(r==1){
						$('#frmnuevoEstado')[0].reset();
						$('#tablaDatatable').load('paginas/tablaClientes.php');
						alertify.success("agregado con exito");
						setInterval(location.reload(),120000);
					}else{
						alertify.error("Fallo al agregar");
					}
				}
			});
		});

		$('#btnActualizar').click(function(){
			datos=$('#frmnuevoU').serialize();

			$.ajax({
				type:"POST",
				data:datos,
				url:"paginas/procesos/actualizarC.php",
				success:function(r){
					if(r==1){
						$('#tablaDatatable').load('paginas/tablaClientes.php');
						alertify.success("Actualizado con exito");
					}else{
						alertify.error("Fallo al actualizar");
					}
				}
			});
		});
	});
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#tablaDatatable').load('paginas/tablaClientes.php');
	});
</script>

<script type="text/javascript">
	function agregaFrmActualizar(idclientes){
		$.ajax({
			type:"POST",
			data:"idclientes=" + idclientes,
			url:"paginas/procesos/obtenDatosC.php",
			success:function(r){
				datos=jQuery.parseJSON(r);
				$('#idclientes').val(datos['id_cliente']);
				$('#rfcU').val(datos['rfc']);
				$('#razonU').val(datos['razon_social']);
				$('#nombreU').val(datos['nombre']);
                $('#apellidoU').val(datos['apellidos']);
                $('#direccionU').val(datos['direccion']);
                $('#telefonoU').val(datos['telefono']);
                $('#ciudadesU').val(datos['ciudad']);
                $('#estadosU').val(datos['estado']);
                $('#categoriasU').val(datos['categoria']);
			}
		});
	}

	function eliminarDatos(idcliente){
		alertify.confirm('Eliminar un cliente', '¿Seguro de eliminar este cliente :(?', function(){

			$.ajax({
				type:"POST",
				data:"idclientes=" + idcliente,
				url:"paginas/procesos/eliminarC.php",
				success:function(r){
					if(r==1){
						$('#tablaDatatable').load('paginas/tablaClientes.php');
						alertify.success("Eliminado con exito !");
					}else{
						alertify.error("No se pudo eliminar...");
					}
				}
			});

		}
		, function(){

		});
	}
</script>
