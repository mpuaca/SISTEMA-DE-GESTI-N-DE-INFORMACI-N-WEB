<?php
session_start();
if ($_SESSION['rol'] != 1 && $_SESSION['rol'] != 2) {
    header("location: ../");
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
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <!-- Alerta -->
    <!-- Alerta -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        <!-- Form Start -->
        <div class="content">
            <?php include "include/header.php" ?>
            <div class="container-fluid pt-4 px-4">
                <div class="rounded h-100 p-4">
                <h4>Nuevo Beneficiarios</h4>
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nombre Completo</label>
                                <input type="text" class="form-control" id="nombre" name="nombre">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Dpi</label>
                                        <input type="text" class="form-control" id="dpi" name="dpi">
                                        <div id="dpiLengthAlert" class="alert alert-danger" style="display: none; margin-top: 10px;">El DPI debe contener exactamente 13 números.</div>
                                        <div id="dpiNumberAlert" class="alert alert-danger" style="display: none;">El DPI solo debe contener números.</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Telefono</label>
                                        <input type="text" class="form-control" id="telefono" name="telefono">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="propósito" class="form-label">Propósito</label>
                                <select class="form-select" id="propósito" name="propósito">
                                    <option value="alimentos">Alimentos</option>
                                    <option value="útiles_escolares">Útiles Escolares</option>
                                    <option value="ambos">Ambos</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Observaciones</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" id="observaciones" name="observaciones"></textarea>
                            </div>
                            <div class="botones">
                            <button type="submit" class="btn btn-primary" name="save-event">Guardar</button>
                            <a href="Beneficiarios.php" class="btn btn-secondary">Cancelar</a>
                            </div>
                        </form>
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
        <script>
            const dpiInput = document.getElementById("dpi");
            const dpiLengthAlert = document.getElementById("dpiLengthAlert");
            const dpiNumberAlert = document.getElementById("dpiNumberAlert");

            dpiInput.addEventListener("input", function() {
                const dpiValue = this.value;

                // Utiliza una expresión regular para verificar si solo contiene números
                const isNumber = /^\d+$/.test(dpiValue);

                if (dpiValue.length !== 13) {
                    dpiLengthAlert.style.display = "block";
                } else {
                    dpiLengthAlert.style.display = "none";
                }

                if (!isNumber) {
                    dpiNumberAlert.style.display = "block";
                } else {
                    dpiNumberAlert.style.display = "none";
                }
            });
        </script>
</body>>

</html>
<?php
include "../conexion.php";
$alert = '';
if (isset($_POST['save-event'])) { // Verificar si se ha enviado el formulario

    // Recopila los valores del formulario
    $nombre = $_POST['nombre'];
    $dpi = $_POST['dpi'];
    $telefono = $_POST['telefono'];
    $observaciones = $_POST['observaciones'];
    $propósito = $_POST['propósito']; // Nuevo campo para el propósito

    if (empty($nombre)) {
        $alert = '<p class="msg_error">Nombre y apellido son campos obligatorios.</p>';
    } else {
        // Realiza la inserción en la base de datos
        $query_insert = mysqli_query($conection, "INSERT INTO beneficiarios (nombre, telefono, dpi, observaciones, propósito)
            VALUES ('$nombre', '$telefono', '$dpi', '$observaciones', '$propósito')");

        if ($query_insert) {
            echo '<script>showSuccessAlertBeneficiarios();</script>';
        } else {
            $alert = '<p class="msg_error">Error al crear el usuario: ' . mysqli_error($conection) . '</p>';
        }
    }
}

?>