<?php
date_default_timezone_set('America/Guatemala'); // Establece la zona horaria de Guatemala
// Obten la hora y fecha actual en Guatemala
$hora = date('H:i'); // Formato de hora y minutos (HH:mm)// Formato de hora
$fechaActual = date('j \de F \de Y'); // Formato de fecha
session_start();
if ($_SESSION['rol'] != 1 && $_SESSION['rol'] != 2) {
    header("location: ../");
}
include '../conexion.php';

$sql = "SELECT COUNT(*) as user_count FROM usuarios";
$result = mysqli_query($conection, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $userCount = $row['user_count'];
} else {
    echo "Error en la consulta: " . mysqli_error($conection);
}
$sql = "SELECT COUNT(*) as user_count_ber FROM Beneficiarios";
$result = mysqli_query($conection, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $userCount_ber = $row['user_count_ber'];
} else {
    echo "Error en la consulta: " . mysqli_error($conection);
}
$sql = "SELECT COUNT(*) as user_count_don FROM donantes";
$result = mysqli_query($conection, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $userCount_donante = $row['user_count_don'];
} else {
    echo "Error en la consulta: " . mysqli_error($conection);
}
$sql = "SELECT title, description, start_datetime, end_datetime FROM agenda";
$result = mysqli_query($conection, $sql);

$activities = array(); // Un arreglo para almacenar las actividades

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $activities[] = $row;
    }
} else {
    echo "Error en la consulta: " . mysqli_error($conection);
}
// Verifica si el nombre de usuario está en la sesión
if (isset($_SESSION['nombre'])) {
    $nombreUsuario = $_SESSION['nombre'];
} else {
    $nombreUsuario = 'Invitado'; // Define un valor predeterminado si no se ha iniciado sesión
}
date_default_timezone_set('America/Guatemala');
// Obten la hora actual
$horaActual = date('H');
// Definir el saludo según la hora del día
if ($horaActual >= 5 && $horaActual < 12) {
    $saludo = "Buenos días";
} elseif ($horaActual >= 12 && $horaActual < 18) {
    $saludo = "Buenas tardes";
} else {
    $saludo = "Buenas noches";
}

$sql = "SELECT COUNT(*) as user_count FROM usuarios";
$result = mysqli_query($conection, $sql);

?>

<!DOCTYPE html>
<html lang="en">

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
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
            <div class="container-fluid pt-4 px-4">
                <h2><?php echo $saludo . ', ' . $nombreUsuario; ?></h2>
                <p>Guatemala, <?php echo fechaC(); ?>&nbsp;&nbsp;|&nbsp;&nbsp;<?php echo $hora ?></p>
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3 tarjeta">
                            <i class="fa fa-users fa-3x text-primary icono1 "></i> <!-- Icono para Beneficiarios -->
                            <div class="ms-3">
                                <h4 class="mb-2 tar1">Beneficiarios</h4>
                                <h4 class="mb-0 s1"><?php echo $userCount_ber; ?></h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3 tarjeta">
                            <i class="fa fa-user fa-3x text-primary icono2"></i> <!-- Icono para Beneficiarios -->
                            <div class="ms-3">
                                <h4 class="mb-2 tar2">Benefactores</h4>
                                <h4 class="mb-0 s2"><?php echo $userCount_donante; ?></h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3 tarjeta">
                            <i class="fa fa-user fa-3x text-primary icono3"></i> <!-- Icono para Beneficiarios -->
                            <div class="ms-3">
                                <h4 class="mb-2 tar3">Usuarios</h4>
                                <h4 class="mb-0 s3"><?php echo $userCount; ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
                <h4 class="mb-4">Actividades por hacer</h4>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <?php
                        // Filtra las actividades que son para el día actual
                        $actividadesHoy = array_filter($activities, function ($activity) {
                            $fechaInicio = date('Y-m-d', strtotime($activity['start_datetime']));
                            $fechaActual = date('Y-m-d');

                            return $fechaInicio == $fechaActual;
                        });

                        if (count($actividadesHoy) > 0) {
                        ?>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Actividad</th>
                                        <th>Descripción</th>
                                        <th>Fecha de Inicio</th>
                                        <th>Fecha Final</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($actividadesHoy as $activity) : ?>
                                        <tr>
                                            <td class="nombre"><?php echo $activity['title']; ?></td>
                                            <td class="nombre"><?php echo $activity['description']; ?></td>
                                            <td class="nombre"><?php echo $activity['start_datetime']; ?></td>
                                            <td class="nombre"><?php echo $activity['end_datetime']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php
                        } else {
                            echo "<p>No tienes actividades programadas para hoy.</p>";
                        }
                        ?>
                    </table>
                </div>
                <div class="footer">
                    <img src="img/logo-removebg-preview.png ">
                    <p>Elaborado por: Miriam Marisol Puac Ajanel |</p>
                    <p>version 1.1</p>
                </div>
            </div>
        </div>
    </div>
    </div>
    <?php
    mysqli_close($conection);
    ?>
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

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>
<?php
date_default_timezone_set('America/Guatemala');

function fechaC()
{
    $mes = array(
        "", "Enero",
        "Febrero",
        "Marzo",
        "Abril",
        "Mayo",
        "Junio",
        "Julio",
        "Agosto",
        "Septiembre",
        "Octubre",
        "Noviembre",
        "Diciembre"
    );
    return date('d') . " de " . $mes[date('n')] . " de " . date('Y');
}


?>