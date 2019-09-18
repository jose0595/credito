<?php
 /*Inicia una sesion*/
require_once "scripts.php";
require_once "conexion.php"; /*Hace uso del archivo conexion para establecer la conexion a la base de datos*/
$obj= new conectar();
$conexion=$obj->conexion();

?>
<div class="container col-lg-11">
      
	     <div class="card-deck ">
  <div class="card" style="width: 18rem;">
    <img class="card-img-top" src="paginas/assets/img/equipo.png" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">Usuarios</h5>
      <p class="card-text">Este es el total de usuarios registrados.
         <?php
               $sql= "select * from usuarios";

               $result = mysqli_query($conexion,$sql);

               $cantidad = mysqli_num_rows($result);
             ?>
        </p>
        <h5 class="card-title">Total: <?php echo $cantidad ?></h5>
    </div>
    <div class="card-footer">
      <small class="text-muted">Usuarios registrados</small>
    </div>
  </div>
  <div class="card">
    <img class="card-img-top" src="paginas/assets/img/monedero.png" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">Creditos pendientes</h5>
      <p class="card-text">Total de creditos pendientes de aprobacion
        <?php
               $sql= "select * from credito where id_status=1";
                $sql1= "select * from credito";

               $result = mysqli_query($conexion,$sql);

               $cantidad = mysqli_num_rows($result);
            
                $result1 = mysqli_query($conexion,$sql1);

               $cantidad1 = mysqli_num_rows($result1);
             ?>
        </p>
         <h5 class="card-title">Total de creditos: <?php echo $cantidad1 ?></h5>
        <h5 class="card-title">Pendientes: <?php echo $cantidad ?></h5>
        <h5 class="card-title">Reportes:</h5>
         <form id="formreporte">
      <div class="form-check">
      <label class="form-check-label">
      <input type="radio" class="form-check-input" name="opcion" value="0">Por fecha
      </label>
      </div>
      <label style="display: none;" id="fecha">
       Fecha
      <input type="date" class="form-control input-sm" id="dia" name="fecha">
      </label>
<div class="form-check">
  <label class="form-check-label">
    <input type="radio" class="form-check-input" name="opcion" value="1">Por Status
  </label>
</div>
<label style="display: none;" id="eleccion">
       Status
      <select class="form-control" id="idstatus" name="idstatus">
                                <option value="0">Selecciona status</option>
                                <option value="1">Pendiente</option>
                                <option value="2">Aprobado</option>
                                <option value="3">No aprobado</option>
      </select> 
      </label>
</form>
       <p class="card-text"><a class="btn btn-secondary fas fa-download" id="btnReporte"> Descargar<span></span></a></p>
    </div>
    <div class="card-footer">
      <small class="text-muted">Creditos pendientes de aceptación</small>
    </div>
  </div>
  <div class="card">
    <img class="card-img-top" src="paginas/assets/img/cliente.png" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">Clientes registrados</h5>
      <p class="card-text">Total de clientes registrados
         <?php
               $sql= "select * from clientes";

               $result = mysqli_query($conexion,$sql);

               $cantidad = mysqli_num_rows($result);
             ?>
        </p>
          <h5 class="card-title">Total: <?php echo $cantidad ?></h5>
    </div>
    <div class="card-footer">
      <small class="text-muted">Clientes registrados</small>
    </div>
  </div>
</div>
      
    </div>

<script type="text/javascript">
  $(document).ready(function(){
    $('#formreporte input').on('change', function() {
     var opcion = $('input[name=opcion]:checked', '#formreporte').val();
     if(opcion==0){
        document.getElementById("idstatus").selectedIndex = "0";
      document.getElementById("idstatus").style.display = "none";
      document.getElementById("fecha").style.display = "block";
      }else if(opcion==1){
         $('#dia').val("");
        document.getElementById("fecha").style.display = "none";
        document.getElementById("eleccion").style.display = "block";
        document.getElementById("idstatus").style.display = "block";
      }

  });
    });
</script>
<script type="text/javascript">
   $(document).ready(function(){
        $('#btnReporte').click(function(){
        var dia = $('#dia').val();
        var status= $('#idstatus').val();
        if(dia==""){
          window.location='paginas/reportePdfCreditoS.php?status='+status;
        }else {
          window.location='paginas/reportePdfCredito.php?fecha='+dia;
        }
        
      });
    });
</script>