<div class="sidebar pe-4 pb-3">
    <nav class="navbar nav1 navbar-light d-flex align-items-center">
        <div class="d-flex align-items-center ms-4 mb-4 ">
            <div class="ms-3">
                <img src="../../imagen/logo.png" width="100" height="auto" class="logo">
            </div>
        </div>
        <div class="navbar-nav w-100 ">
            <a href="index.php" class="nav-item nav-link "><i class="fa fa-tachometer-alt me-2 icon"></i>Dashboard</a>
            <a href="agenda.php" class="nav-item nav-link "><i class="far fa-calendar icon"></i>Agenda</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fas fa-praying-hands icon"></i>Catecumenos</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="catecumenos.php" class="dropdown-item">Lista de catecumenos</a>
                    <a href="asistencia_catecumenos.php" class="dropdown-item">Asistencia</a>
                </div>
            </div>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fas fa-users icon"></i>Beneficiarios</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="agregar_beneficiarios.php" class="dropdown-item">Nuevo Beneficiario</a>
                    <a href="beneficiarios.php" class="dropdown-item">Beneficiario de Alimentos</a>
                    <a href="beneficiarios_util.php" class="dropdown-item">Utiles Escolares</a>
                </div>
            </div>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fas fa-heart icon"></i>Donaciones</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="donaciones.php" class="dropdown-item">Registro de Donaciones</a>
                    <a href="lista_benefactores.php" class="dropdown-item">Lista de Benefactores</a>
                </div>
            </div>
            <a href="inventario.php" class="nav-item nav-link"><i class="fas fa-box icon"></i>Inventario</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fas fa-hands-helping icon"></i>Entregas</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="entegras_donaciones.php" class="dropdown-item">Alimentos</a>
                    <a href="entregas_util.php" class="dropdown-item">Utiles escolares</a>
                </div>
            </div>
            <?php
            if ($_SESSION['rol'] == 1) {
            ?>
                <a href="usuarios.php" class="nav-item nav-link"><i class="fas fa-user icon"></i>Usuarios</a>
            <?php } ?>
        </div>
    </nav>
</div>
