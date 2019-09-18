<?php
header('Content-Type:text/html;charset=utf-8');
require_once "scripts.php";
require_once "conexion.php"; /*Hace uso del archivo conexion para establecer la conexion a la base de datos*/
$obj= new conectar();
$conexion=$obj->conexion();

?>
<?php if($_SESSION['rol']==1){ ?>
<div class="container col-lg-3">
<div class="card center" style="width:280px; text-align: center;">
  <img class="card-img-top" style="border-radius:150px;" src="paginas/assets/img/admin.png" alt="Card image">
  <div class="card-body">
    <h4 class="card-title"><?php echo $_SESSION['usuario'];?></h4>
    <p class="card-text">Administrador del sistema.</p>
    <a href="#" class="btn btn-primary" id="editar" data-toggle="modal" data-target="#exampleModalCenter">Editar mi perfil</a>
  </div>
</div>
</div>
<?php }else if($_SESSION['rol']==2){ ?>

<div class="container col-lg-3">
<div class="card center" style="width:280px; text-align: center;">
  <img class="card-img-top" style="border-radius:150px;" src="../images/ingeniero.png" alt="Card image">
  <div class="card-body">
    <h4 class="card-title"><?php echo $_SESSION['usuario'];?></h4>
    <p class="card-text">Usuario del sistema.</p>
    <a href="#" class="btn btn-primary" id="editar" data-toggle="modal" data-target="#exampleModalCenter">Editar mi perfil</a>
  </div>
</div>
</div>
<?php } ?>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Editar mi perfil</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frmnuevoU" class="needs-validation" novalidate>
          <input type="text" hidden="" id="idusuario" name="idusuario" value="<?php echo $_SESSION['id'];?>">
          <label>Nombre</label>
          <input type="text" readonly="" class="form-control input-sm" id="nombreU" name="nombreU" value="<?php echo $_SESSION['usuario'];?>">
          <label>Pasword</label>
          <input type="password" class="form-control input-sm" id="passwordU" name="passwordU" required>
          <input type="text" hidden="" class="form-control input-sm" id="nivelU" name="nivelU" value="<?php echo $_SESSION['rol'];?>">
        </form>
        <br>
        <div class="form-group">
          <button type="button" id="btnActualizar" class="btn btn-primary">Cambiar</button>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function(){
    $('#btnActualizar').click(function(){
      datos=$('#frmnuevoU').serialize();
      $.ajax({
        type:"POST",
        data:datos,
        url:"paginas/procesos/actualizar.php",
        success:function(r){
          if(r==1){
            alertify.success("Contrase&ntilde;a actualizada con exito");
                    }else{
            alertify.error("No se pudo actualizar");
          }
        }
      });
    });
  });

</script>