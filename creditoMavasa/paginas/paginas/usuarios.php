	<?php
	require_once "scripts.php";

	?>
	<div class="container" style="width:600px; text-align: center;">
		<div class="row">
			<div class="col-sm-12">
				<div class="card text-left">
					<div class="card-header">
						<h4 class="fas fa-table"><strong> Usuarios</strong></h4> 
					</div>
					<div class="card-body">
						<span class="btn btn-secondary" data-toggle="modal" data-target="#agregarnuevosdatosmodal">
							Nuevo usuario <span class="fas fa-user-plus"></span>
						</span>
						<hr>
						<div id="tablaDatatable"></div>
					</div>
					<div class="card-footer text-muted">
						Sistema de credito construrama
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
					<h5 class="modal-title" id="exampleModalLabel">Agrega nuevos usuarios</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="frmnuevo">
						<label>Nombre</label>
						<input type="text" class="form-control input-sm" id="nombre" name="nombre" required>
						<label>Password</label>
						<input type="text" class="form-control input-sm" id="password" name="password" required>
						<label>Nivel de usuario</label>
						<input type="text" class="form-control input-sm" id="nivel" name="nivel" required>
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
	<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Actualizar datos de usuario</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="frmnuevoU">
						<input type="text" hidden="" id="idusuario" name="idusuario">
						<label>Nombre</label>
						<input type="text" class="form-control input-sm" id="nombreU" name="nombreU">
						<label>Pasword</label>
						<input type="text" class="form-control input-sm" id="passwordU" name="passwordU">
						<label>Nivel</label>
						<input type="text" class="form-control input-sm" id="nivelU" name="nivelU">
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
			datos=$('#frmnuevo').serialize();
            
            if(datos.length==null){
                alert("debes llenar todo los campos");
            }else{
                
               		$.ajax({
				type:"POST",
				data:datos,
				url:"paginas/procesos/agregar.php",
				success:function(r){
					if(r==1){
						$('#frmnuevo')[0].reset();
						$('#tablaDatatable').load('paginas/tablaUsuarios.php');
						alertify.success("agregado con exito :D");
					}else{
						alertify.error("Fallo al agregar :(");
					}
				}
			}); 
            }

	
		});

		$('#btnActualizar').click(function(){
			datos=$('#frmnuevoU').serialize();

			$.ajax({
				type:"POST",
				data:datos,
				url:"paginas/procesos/actualizar.php",
				success:function(r){
					if(r==1){
						$('#tablaDatatable').load('paginas/tablaUsuarios.php');
						alertify.success("Actualizado con exito :D");
					}else{
						alertify.error("Fallo al actualizar :(");
					}
				}
			});
		});
	});
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#tablaDatatable').load('paginas/tablaUsuarios.php');
	});
</script>

<script type="text/javascript">
	function agregaFrmActualizar(idusuario){
		$.ajax({
			type:"POST",
			data:"idusuario=" + idusuario,
			url:"paginas/procesos/obtenDatos.php",
			success:function(r){
				datos=jQuery.parseJSON(r);
				$('#idusuario').val(datos['id_usuario']);
				$('#nombreU').val(datos['nombre']);

				$('#nivelU').val(datos['nivel_usuario']);
			}
		});
	}

	function eliminarDatos(idusuario){
		alertify.confirm('Eliminar un usuario', '¿Seguro de eliminar este usuario?', function(){

			$.ajax({
				type:"POST",
				data:"idusuario=" + idusuario,
				url:"paginas/procesos/eliminar.php",
				success:function(r){
					if(r==1){
						$('#tablaDatatable').load('paginas/tablaUsuarios.php');
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
