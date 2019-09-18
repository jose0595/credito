<?php 

require_once "creditoMavasa/paginas/paginas/scripts.php";

 ?>

<!DOCTYPE html>

<html>

<head>

	<title>Inicio</title>

	<link rel="stylesheet" type="text/css" href="librerias/bootstrap/bootstrap.min.css">

<link rel="stylesheet" type="text/css" href="librerias/datatable/bootstrap.css">

<link rel="stylesheet" type="text/css" href="librerias/datatable/dataTables.bootstrap4.min.css">

<link rel="stylesheet" type="text/css" href="librerias/alertify/css/alertify.css">

<link rel="stylesheet" type="text/css" href="librerias/alertify/css/themes/bootstrap.css">

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">



<script src="librerias/jquery.min.js"></script>

<script src="librerias/bootstrap/popper.min.js"></script>

<script src="librerias/bootstrap/bootstrap.min.js"></script>

<script src="librerias/datatable/jquery.dataTables.min.js"></script>

<script src="librerias/datatable/dataTables.bootstrap4.min.js"></script>

<script src="librerias/alertify/alertify.js"></script>
<style type="text/css">
  body{
    background: url(librerias/mativasa.png); background-repeat: no-repeat;
  }
</style>
<link rel="icon" type="image/png" href="creditoMavasa/assets/img/iconn.png" style="/* cambia estos dos valores para definir el tamaño de tu círculo */
    height: 300px;
    width: 300px;
    /* los siguientes valores son independientes del tamaño del círculo */
    border-radius: 150px;" />
</head>

<body style="margin-top: 40px; margin-bottom: 80px;">


<div class="container col-lg-11" style="width:800px; margin-top: 198px">

<div class="card">

  <h5 class="card-header" style="color: orange; text-align: center;">BIENVENIDO AL SISTEMA</h5>

  <div class="card-body">

      <form id="frmSeleccion">

          <label for="seleccion">Selecciona</label>

          <select class="form-control" id="seleccion" name="seleccion">

          <option value="0">Selecciona una empresa</option>

          <option value="1">Mavasa</option>

          <option value="2">Matisa</option>

      </select>              

	   </form>  
     <div  style="text-align: center;">
    <button type="button" id="btnIr" class="btn btn-primary btn-m" style="width: 300px; text-align: center;">Entrar</button>
  </div>    
  </div>
  
</div>
</div>

</body>

</html>



<script type="text/javascript">

	$(document).ready(function(){

      $('#btnIr').click(function(){

      	var opcion = $('#seleccion').val();

      	if(opcion==1){

        $.ajax({

        url:"creditoMavasa/index.php",

        success:function(r){

          window.location= "creditoMavasa/index.php";

      }

    });



      	}else if(opcion==2){

        $.ajax({

        url:"creditoMatisa/index.php",

        success:function(r){

           window.location= "creditoMatisa/index.php";

      }

    });



      	}

        

       

        

      });

    });

</script>