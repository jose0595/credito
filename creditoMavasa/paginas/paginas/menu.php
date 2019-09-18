 <?php
    session_start();
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

    require_once "scripts.php";

    ?>
<!DOCTYPE html>
<html lang="es">

<head>
<meta charset="utf-8"> 
   
    <title > CPanel</title>
    <link rel="shortcut icon" type="image/x-icon" href="paginas/assets/img/iconn.png" />
    <style type="text/css">
      .navbar-custom {
    background-color: #616A6B;
    font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
}
.navbar-custom .navbar-nav .nav-link {
color: orange;
}
.navbar-custom .navbar-brand{
color: orange;
}
    </style>
</head>

<body style="padding-top: 120px; padding-bottom: 0px;">

<nav class="navbar navbar-expand-sm navbar-custom navbar-dark fixed-top">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div>
    <a class="navbar-brand" style="text-align: center; width: 60px;" href="#"><span class="site-desc"><img src="../assets/img/mavasa.png" width="70" height="50"></span><span class="site-name btn btn-default" data-toggle="modal" data-target="#exampleModal" style="display: inline;"> Construrama creditos</span>
      </a>

  </div>

  <div class="collapse navbar-collapse ml-auto" id="navbarTogglerDemo03">
    <ul class="navbar-nav mt-2 mt-lg-0 ml-auto">
      <li class="nav-item <?php echo $pagina == 'inicio' ? 'active' : ''; ?>">
        <span><a class="nav-link" href="?p=inicio"> Home</a></span>
      </li>
      <?php if($_SESSION['rol']==1): ?>
      <li class="nav-item <?php echo $pagina == 'usuarios' ? 'active' : ''; ?>">
        <a class="nav-link" href="?p=usuarios"> Usuarios</a>
      </li>
    <?php endif; ?>
      <li class="nav-item <?php echo $pagina == 'creditos' ? 'active' : ''; ?>">
        <a class="nav-link" href="?p=creditos"> Creditos</a>
      </li>
        <li class="nav-item <?php echo $pagina == 'clientes' ? 'active' : ''; ?>">
        <a class="nav-link " href="?p=clientes"> Clientes</a>
      </li>
          <li class="nav-item dropdown <?php echo $pagina == 'configuracion' ? 'active' : ''; ?>">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Bienvenido <?php  echo $_SESSION['usuario'];?></a>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item fas fa-sign-out-alt text-danger" href="?p=cerrar"> Cerrar sesion</a>
          <?php if($_SESSION['rol']==1 or $_SESSION['rol']==2){ ?>
          <a class="dropdown-item fas fa-cogs text-warning" href="?p=configuracion"> Configuracion</a>
        <?php } ?>
        </div>
      </li>
    </ul>
  </div>
</nav>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title far fa-copyright" id="exampleModalLabel"> Acerca de</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="text-align: center;">
        <h4><strong>Sistema de creditos</strong></h4>
        <img style="border-radius:0.5px;" src="../assets/img/mavasa.png" width="100" height="90">
        <br>
        <a class="text-warning "> 2018 Copyright todos los derechos reservados
          </a>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php } else {
        echo "<script text='text/javascript'>
        alert('No se puede acceder al menu, registrate');
        window.location = '../index.php';
        </script>";

    exit;
    } ?>
