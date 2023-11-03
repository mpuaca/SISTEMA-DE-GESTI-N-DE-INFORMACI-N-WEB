<?php
session_start();
if ($_SESSION['rol'] != 1 && $_SESSION['rol'] != 2) {
    header("location: ../");
}
include '../conexion.php';

// Conexión a la base de datos (debes configurar tu propia conexión)
if ($conection->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener todas las fechas únicas de asistencia en un formato más legible
$sql = "SELECT DISTINCT DATE_FORMAT(FechaEntrega, '%d/%m/%Y') AS FechaEntrega FROM entregas_utiles";
$fechas = $conection->query($sql);
$fechasEncabezado = array(); // Almacena las fechas únicas

while ($rowFecha = $fechas->fetch_assoc()) {
    $fechasEncabezado[] = $rowFecha['FechaEntrega'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Congregacion</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <!-- Fuentes web de Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Hojas de estilo de iconos -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Hojas de estilo de bibliotecas -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet">

    <!-- Hojas de estilo de la plantilla -->
    <link href="css/style.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/fixedcolumns/4.3.0/css/fixedColumns.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/rowgroup/1.4.1/css/rowGroup.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/select/1.7.0/css/select.bootstrap5.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="js/eliminar.js"></script>

</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Sidebar Start -->
        <?php include "include/navbar.php" ?>
        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <?php include "include/header.php" ?>
            <div class="container-fluid pt-4 px-4">
                <ul class="nav justify-content-center">
                    <li class="nav-item">
                        <a class="me-md-2" aria-current="page" href="entregas_util.php">Entregas</a>
                    </li>
                    <li class="nav-item">
                        <a class="me-md-2 active1" href="ver_entregas_utiles.php">Ver Reporte</a>
                    </li>
                </ul>
                <div class="h-100 p-4">
                    <h1>Asistencias Registradas</h1>
                    <table class="table table-bordered" id="example">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <?php
                                foreach ($fechasEncabezado as $fecha) {
                                    echo "<th>$fecha</th>";
                                }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Aquí van los datos de la tabla -->
                            <?php
                            // Obtener la lista de estudiantes
                            $sqlEstudiantes = "SELECT BeneficiarioID, nombre FROM beneficiarios WHERE propósito = 'útiles_escolares'  OR propósito = 'ambos'";
                            $resultadoEstudiantes = $conection->query($sqlEstudiantes);

                            while ($filaEstudiante = $resultadoEstudiantes->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>{$filaEstudiante['BeneficiarioID']}</td>";
                                echo "<td>{$filaEstudiante['nombre']}</td>";

                                // Inicializar las asistencias en "X" por defecto
                                $asistencias = array_fill(0, count($fechasEncabezado), "");

                                // Obtener las asistencias del estudiante
                                $sqlAsistencias = "SELECT DATE_FORMAT(FechaEntrega, '%d/%m/%Y') AS FechaEntrega, asistio FROM entregas_utiles WHERE BeneficiarioID = {$filaEstudiante['BeneficiarioID']}";
                                $resultadoAsistencias = $conection->query($sqlAsistencias);

                                // Actualizar las asistencias en las fechas correspondientes
                                while ($filaAsistencia = $resultadoAsistencias->fetch_assoc()) {
                                    $index = array_search($filaAsistencia['FechaEntrega'], $fechasEncabezado);
                                    if ($index !== false) {
                                        $asistencias[$index] = $filaAsistencia['asistio'] == 1 ? "✔" : "X";
                                    }
                                }

                                foreach ($asistencias as $asistencia) {
                                    echo "<td>$asistencia</td>";
                                }

                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Template Javascript -->
    <!-- jQuery y Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <script src="js/main.js"></script>
    <!-- Agrega el siguiente código JavaScript al final de tu página antes de cerrar el cuerpo </body> -->

    <!-- Template Javascript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/fixedcolumns/4.3.0/js/dataTables.fixedColumns.min.js"></script>
    <script src="https://cdn.datatables.net/rowgroup/1.4.1/js/dataTables.rowGroup.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "dom": 'Bfrtip',
                "buttons": ['excel'],
                
            });
        });
    </script>

</body>

</html>