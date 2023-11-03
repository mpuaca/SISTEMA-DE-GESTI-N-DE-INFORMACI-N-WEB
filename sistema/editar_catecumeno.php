<?php

session_start();
if ($_SESSION['rol'] != 1 && $_SESSION['rol'] != 2) {
    header("location: ./");
}

include "../conexion.php";

//Mostrar Datos
if (empty($_REQUEST['id'])) {
    header('Location: catecumenos.php');
    mysqli_close($conection);
}
$iduser = $_REQUEST['id'];

$sql = mysqli_query($conection, "SELECT id, nombre, edad, telefono, padrino, certificado from estudiantes WHERE id= $iduser ");
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
        $edad = $data['edad'];
        $telefono = $data['telefono'];
        $padrino  = $data['padrino'];
        $certificado = $data['certificado'];
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

</head>

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
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Nuevo Catecumeno</h6>
                            <form action=" " method="post">
                                <input type="hidden" name="idUsuario" value="<?php echo $iduser; ?>">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre; ?>">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Edad</label>
                                            <input type="text" class="form-control" id="edad" name="edad" value="<?php echo $edad; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="exampleInputPassword1" class="form-label">Telefono</label>
                                            <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $telefono; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="certificado" id="certificado" <?php echo ($certificado == 1) ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="inlineCheckbox1">Certificado</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="padrino" name="padrino" <?php echo ($padrino == 1) ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="inlineCheckbox1">Padrino</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary" name="save-event">Guardar</button>
                                <a href="catecumenos.php" class="btn btn-secondary">Cancelar</a>
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
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>>

</html>
<?php
include "../conexion.php";

if (!empty($_POST)) {
    $alert = '';
    if (empty($_POST['nombre']) || empty($_POST['telefono']) || empty($_POST['edad'])) {
        $alert = '<p class="msg_error">Todos los campos son obligatorios.</p>';
    } else {

        $idUsuario = $_POST['idUsuario'];
        $nombre = $_POST['nombre'];
        $edad   = $_POST['edad'];
        $telefono   = $_POST['telefono'];
        $certificado = isset($_POST['certificado']) ? 1 : 0;
        $padrino = isset($_POST['padrino']) ? 1 : 0;

        // Aquí debes modificar la consulta SQL según tu estructura de base de datos
        $query = mysqli_query($conection, "SELECT * FROM estudiantes
											WHERE (nombre = '$nombre' AND id != $idUsuario)");

        $result = mysqli_fetch_array($query);

        if ($result > 0) {
            $alert = '<p class="msg_error">El nombre ya existe.</p>';
        } else {

            // Actualiza los datos en la base de datos
            $sql_update = mysqli_query($conection, "UPDATE estudiantes
													SET nombre = '$nombre',edad='$edad', telefono='$telefono', certificado='$certificado', padrino='$padrino'
													WHERE id= $idUsuario ");

            if ($sql_update) {
                echo '<script>showSuccessAlert_edit_catecumeno();</script>';
            } else {
                echo '<script>showErrorAlert_edit_catecumeno()</script>';
            }
        }
    }
}
?>