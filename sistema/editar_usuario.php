<?php

session_start();
if ($_SESSION['rol'] != 1 && $_SESSION['rol'] != 2) {
    header("location: ../");
}
include "../conexion.php";
//Mostrar Datos
if (empty($_REQUEST['id'])) {
    header('Location: lista_usuarios.php');
    mysqli_close($conection);
}
$iduser = $_REQUEST['id'];

$sql = mysqli_query($conection, "SELECT u.id, u.nombre,u.correo, (u.rol) as idrol, (r.rol) as rol
									FROM usuarios u
									INNER JOIN roles r
									on u.rol = r.idrol
									WHERE id= $iduser ");
mysqli_close($conection);
$result_sql = mysqli_num_rows($sql);

if ($result_sql == 0) {
    header('Location: usuarios.php');
} else {
    $option = '';
    while ($data = mysqli_fetch_array($sql)) {
        # code...
        $iduser  = $data['id'];
        $nombre  = $data['nombre'];
        $correo = $data['correo'];
        $idrol   = $data['idrol'];
        $rol     = $data['rol'];


        if ($idrol == 1) {
            $option = '<option value="' . $idrol . '" select>' . $rol . '</option>';
        } else if ($idrol == 2) {
            $option = '<option value="' . $idrol . '" select>' . $rol . '</option>';
        } else if ($idrol == 3) {
            $option = '<option value="' . $idrol . '" select>' . $rol . '</option>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Congregacion</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />


    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <link href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Alerta -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="js/eliminar.js"></script>
    <script src="js/alerts.js"></script>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <?php include "include/navbar.php" ?>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <?php include "include/header.php" ?>
            <!-- Navbar End -->


            <!-- Form Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="h-100 p-4 editar">
                            <h6 class="mb-4">Nuevo Usuario</h6>
                            <form action=" " method="post">
                                <input type="hidden" name="idUsuario" value="<?php echo $iduser; ?>">

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre; ?>">
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Correo electronico</label>
                                    <input type="email" class="form-control" id="correo" name="correo" value="<?php echo $correo; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Rol</label>
                                    <?php
                                    include "../conexion.php";
                                    $query_rol = mysqli_query($conection, "SELECT * FROM roles");
                                    mysqli_close($conection);
                                    $result_rol = mysqli_num_rows($query_rol);

                                    ?>

                                    <select name="rol" id="rol" class="form-select">
                                        <?php
                                        echo $option;
                                        if ($result_rol > 0) {
                                            while ($rol = mysqli_fetch_array($query_rol)) {
                                        ?>
                                                <option value="<?php echo $rol["idrol"]; ?>"><?php echo $rol["rol"] ?></option>
                                        <?php
                                                # code...
                                            }
                                        }
                                        ?>
                                    </select>

                                </div>
                                <div class="botones">
                                <button type="submit" class="btn btn-primary" name="Actualizar usuario">Actualizar</button>
                                <a href="usuarios.php" class="btn btn-secondary">Cancelar</a>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
            <!-- Form End -->
        </div>
        <!-- Content End -->

    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>>

</html>

<?php
include "../conexion.php";
if (!empty($_POST)) {
    $alert = '';
    if (empty($_POST['nombre']) || empty($_POST['correo'])  || empty($_POST['rol'])) {
        $alert = '<p class="msg_error">Todos los campos son obligatorios.</p>';
    } else {

        $idUsuario = $_POST['idUsuario'];
        $nombre = $_POST['nombre'];
        $correo   = $_POST['correo'];
        $rol    = $_POST['rol'];


        $query = mysqli_query($conection, "SELECT * FROM usuarios
													   WHERE (correo = '$correo' AND id != $idUsuario)");

        $result = mysqli_fetch_array($query);

        if ($result > 0) {
            $alert = '<p class="msg_error">El correo o el usuario ya existe.</p>';
        } else {


                $sql_update = mysqli_query($conection, "UPDATE usuarios
															SET nombre = '$nombre',correo='$correo',rol='$rol'
															WHERE id= $idUsuario ");
            
            if ($sql_update) {
                echo '<script>showSuccessAlert();</script>';
            } else {
                echo '<script>showErrorAlert();</script>';
            }
        }
    }
}
