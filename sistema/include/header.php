<?php
if ($_SESSION['rol'] != 1 && $_SESSION['rol'] != 2) {
    header("location: ../");
}

?>
<nav class="navbar navbar-expand sticky-top px-4 py-0 nav encabezado">
  <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
    <h2 class="text-primary mb-0"><i class=""></i></h2>
  </a>
  <a class="sidebar-toggler flex-shrink-0" style="text-decoration: none;">
    <i class="fa fa-bars"></i>
  </a>
  <div class="navbar-nav align-items-center ms-auto">
    <div class="nav-item dropdown">
      <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
      <img class="rounded-circle me-lg-2" src="img/avatar.png" alt="" style="width: 40px; height: 40px;">
      </a>
      <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
        <a href="salir.php" class="dropdown-item">Cerrar sesión</a>
      </div>
    </div>
  </div>
</nav>