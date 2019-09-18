<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php
	
    require_once "scripts.php";
    require_once "clases/conexion.php";

    $obj= new conectar();
    $conexion = $obj->conexion();

    $sql= "select * from clientes";
    $result= mysqli_query($conexion,$sql);
    if(mysqli_num_rows($result)>0){
        $RFC ="";
        while($row=mysqli_fetch_row($result)){
            $RFC .= " <option value=\"{$row[0]}\">{$row[1]}</option>";
        }
    }else{

        echo "no se encontraron registros";
    }

    if($_SESSION['rol']==1){
    	  $sql1= "select * from estado_credito";
    $result1= mysqli_query($conexion,$sql1);
    
    if(mysqli_num_rows($result1)>0){
        $status="";
        while($row=mysqli_fetch_row($result1)){
            $status .= "<option value=\"{$row[0]}\">{$row[1]}</option>";
        }
    	}
    }else if($_SESSION['rol']==2){
    	$sql1= "select * from estado_credito where id_status !=2 && id_status !=3";
    $result1= mysqli_query($conexion,$sql1);
    
    if(mysqli_num_rows($result1)>0){
        $status="";
        while($row=mysqli_fetch_row($result1)){
            $status .= "<option value=\"{$row[0]}\">{$row[1]}</option>";
        }
    	}
    }

        $sql2="SELECT id_credito from credito group by id_credito desc";
        $valor=0;
        $result2=mysqli_query($conexion,$sql2);
        $id=mysqli_fetch_row($result2)[0];

        if($id=="" or $id==null or $id==0){
           $valor= 1;
        }else{
            $valor= $id + 1;
        }    
   

    $idusuario=  $_SESSION['id'];
    /*echo "<script>
      $(document).ready(function()
      {	

         $('#modalEditar').modal('show');
      });
    </script>"*/

    ?>

	 <script>
      $(document).ready(function()
      {	
      	var idcredito= <?php echo $_SESSION['idcredit']; ?>;
      	if(idcredito==null){

      	}else{
      		alertify.confirm('Credito pendiente', 'Actualizar credito', function(){
      		agregaFrmActualizar(idcredito);
         	$("#modalEditar").modal("show");
		}
		, function(){

		});
      	}  
      });
    </script>
</head>
<body>
	<div class="container" style="z-index: 0;">
		<div class="row">
			<div class="col-sm-12">
				<div class="card text-left">
					<div class="card-header font-weight-bold">
						<h4 class="fas fa-table"><strong> Creditos</strong></h4>
					</div>
					<div class="card-body">
						
						<span class="btn btn-secondary" data-toggle="modal" id="nuevoCredito" data-target="#agregarnuevosdatosmodal">
							Nuevo credito <span class="fa fa-plus-circle"></span>
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
					<h5 class="modal-title" id="exampleModalLabel">Solicitud de credito</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="frmnuevo">
                        <label>Monto Solicitado</label>
						<input type="number" class="form-control input-sm" id="montoS" name="montoS" required autofocus>
                        <label>Fecha de Solicitud</label>
						<input type="date" class="form-control input-sm" id="fechaS" name="fechaS">
                         <label for="status">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="0">selecciona una opcion</option>
                            <?php 
                             echo $status;
                            ?>
                              </select>
                         <?php if($_SESSION['rol']==1): ?>     
                        <label>Monto aprobado</label>
						<input type="number" class="form-control input-sm" id="montoA" name="montoA">
                         <label>Fecha de aprobación</label>
						<input type="date" class="form-control input-sm" id="fechaA" name="fechaA">
					<?php endif; ?>
                           <label for="idcliente">RFC</label>
                        <select class="form-control" id="idcliente" name="idcliente">
                                <option value="0">Selecciona un RFC</option>
                                <?php
                                echo $RFC;
                                ?>
                              </select>
 <label for="nombreCli">Nombre</label>
                         <input type="text" class="form-control input-sm" id="nombreCli", name="nombreCli"> 
                        <input type="text" class="form-control input-sm" hidden="" id="idusuario", name="idusuario" value="<?php echo $idusuario; ?>">
                        <input type="text" hidden="" class="form-control input-sm" id="idcredito" name="idcredito" value="<?php echo $valor; ?>">
                        <label for="correo">Enviar a</label>
                        <select class="form-control" id="correo" name="correo">
                                <option value="0">Selecciona un destinatario</option>
                                <option value="jepatron@matisa.com.mx">Jose Eduardo Patron</option>
                                <option value="gerencia@mavasa.com.mx">Francisco Patron</option>
                                <option value="admin@admin.com.mx">Jorge Vales Traconis</option>
                                <option value="pedro_canul@hotmail.com">Pedro Canul</option>
                                <option value="sistemas@matisa.com.mx">Orlando Valenzuela</option>
                                <option value="jamartinvales@hotmail.com">Jorge Alonso Martin Vales</option>
                                <option value="gilmermandujano@hotmail.com">Administrador del sistema</option>
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
	<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Actualizar datos de credito</h5>
				</div>
				<div class="modal-body">
					<form id="frmnuevoU">
						<input type="text" hidden="" id="idcreditos" name="idcreditos">
                         <label>RFC</label>
						<input type="text" readonly="" class="form-control input-sm" id="idclienteU" name="idclienteU">
				        <label>Monto Solicitado</label>
						<input type="number" readonly="" class="form-control input-sm" id="montoSU" name="montoSU">
                        <label>Fecha de Solicitud</label>
						<input type="date" readonly="" class="form-control input-sm" id="fechaSU" name="fechaSU">
                         <label for="statusU">Status</label>
                        <select class="form-control" id="statusU" name="statusU">
                            <option value="0">selecciona una opcion</option>
                            <?php 
                             echo $status;
                            ?>
                              </select>
                        <label>Monto aprobado</label>
						<input type="number" class="form-control input-sm" id="montoAU" name="montoAU">
                         <label>Fecha de aprobación</label>
						<input type="date" class="form-control input-sm" id="fechaAU" name="fechaAU">
                        <input type="text" class="form-control input-sm" hidden="" id="idusuarioU" name="idusuarioU" value="<?php echo $idusuario; ?>">
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					<button type="button" class="btn btn-warning" id="btnActualizar">Actualizar</button>
				</div>
			</div>
		</div>
	</div>


</body>
</html>


<script type="text/javascript">
	$(document).ready(function(){
		$('#btnAgregarnuevo').click(function(){
			datosCr=$('#frmnuevo').serialize();
			$.ajax({
				type:"POST",
				data:datosCr,
				url:"paginas/procesos/agregarCr.php",
				success:function(r){
					if(r==1){
						$('#frmnuevo')[0].reset();
						$('#tablaDatatable').load('paginas/tablaCreditos.php');
						alertify.success("agregado con exito");
					}else{
						alertify.error("Fallo al agregar");
					}
				}
			});
		});

		function actualizar(){
			location.reload();
		}

		$('#btnActualizar').click(function(){
			datosCr=$('#frmnuevoU').serialize();
			$.ajax({
				type:"POST",
				data:datosCr,
				url:"paginas/procesos/actualizarCr.php",
				success:function(r){
					if(r==1){
						$('#tablaDatatable').load('paginas/tablaCreditos.php');
						alertify.success("Actualizado con exito");
						<?php unset($_SESSION['idcredit']); ?>;
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
		$('#tablaDatatable').load('paginas/tablaCreditos.php');
	});
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#btnAgregarnuevo').click(function(){
			datosCr=$('#frmnuevo').serialize();

			$.ajax({
				type:"POST",
				data:datosCr,
				url:"paginas/procesos/enviarCorreo.php",
				success:function(r){
					if(r==1){
					      alertify.success("correo enviado");
					       setInterval(location.reload(),120000);
					}else{
						alertify.error("No se pudo enviar");
					}
				}
			});
		});
	});
</script>

<script type="text/javascript">
	function agregaFrmActualizar(idcreditos){
		$.ajax({
			type:"POST",
			data:"id_credito=" + idcreditos,
			url:"paginas/procesos/obtenDatosCr.php",
			success:function(r){
				datos=jQuery.parseJSON(r);
				$('#idcreditos').val(datos['id_credito']);
                $('#idclienteU').val(datos['rfc']);
                $('#montoSU').val(datos['cantidad']);
                $('#fechaSU').val(datos['fecha']);
                $('#statusU').val(datos['estatus']);
			}
		});
	}

	function eliminarDatos(idcredito){
		alertify.confirm('Eliminar un credito', '¿Seguro de eliminar datos del credito?', function(){

			$.ajax({
				type:"POST",
				data:"idcredito=" + idcredito,
				url:"paginas/procesos/eliminarCr.php",
				success:function(r){
					if(r==1){
						$('#tablaDatatable').load('paginas/tablaCreditos.php');
						alertify.success("Eliminado con exito");
						setInterval(location.reload(),120000);
					}else{
						alertify.error("No se pudo eliminar");
					}
				}
			});

		}
		, function(){

		});
	}
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#idcliente').change(function() {
    	var idclientes= $('#idcliente').val();
		$.ajax({
			type:"POST",
			data:"idclientes=" + idclientes,
			url:"paginas/procesos/obtenDatosC.php",
			success:function(r){
				datos=jQuery.parseJSON(r);
				$('#nombreCli').val(datos['nombre'] + datos['apellidos']);
			}
      });
	});
} );
</script>

