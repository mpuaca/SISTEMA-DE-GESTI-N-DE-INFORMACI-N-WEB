<?php
session_start();
if ($_SESSION['rol'] != 1 && $_SESSION['rol'] != 2) {
    header("location: ../");
}
include "../conexion.php";

?>

<!DOCTYPE html>
<html lang="es">

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
    <link href="DataTables/DataTables-1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="DataTables/Buttons-2.4.2/css/buttons.bootstrap5.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="js/eliminar.js"></script>

</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <?php include "include/navbar.php" ?>
        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <?php include "include/header.php" ?>
            <div class="container-fluid  pt-4 px-4">
                <div class="catecumenos h-100 p-4">
                    <h4 class="mb-4">Catecumenos</h4>
                    <a href="agregar_catecumeno.php" class="btn btn-primary me-md-2 btn-agregar ">Agregar </a>
                    <div class="table-responsive">
                        <table class="table" id="example">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Edad</th>
                                    <th>Telefono</th>
                                    <th>Certificado</th>
                                    <th>Padrinos</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <?php

                            $query = mysqli_query($conection, "SELECT id, nombre, edad, telefono, certificado,padrino FROM estudiantes   ORDER BY id ");

                            mysqli_close($conection);

                            $result = mysqli_num_rows($query);
                            if ($result > 0) {

                                while ($data = mysqli_fetch_array($query)) {

                            ?>
                                    <tr>
                                        <td><?php echo $data["id"]; ?></td>
                                        <td class="nombre"><?php echo $data["nombre"]; ?></td>
                                        <td><?php echo $data["edad"]; ?></td>
                                        <td><?php echo $data['telefono'] ?></td>
                                        <td>
                                            <?php
                                            if ($data['certificado'] == 1) {
                                                // Muestra la imagen si el certificado es igual a 1
                                                echo '<i class="fas fa-check fa-lg" style="color: #083602;">';
                                            } else {
                                                // Muestra un texto o imagen alternativa si no es igual a 1
                                                echo '<i class="fas fa-times fa-lg" style="color: #cf2020;">';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($data['padrino'] == 1) {
                                                // Muestra la imagen si el certificado es igual a 1
                                                echo '<i class="fas fa-check fa-lg" style="color: #083602;"></i>';
                                            } else {
                                                // Muestra un texto o imagen alternativa si no es igual a 1
                                                echo '<i class="fas fa-times fa-lg" style="color: #cf2020;"></i>';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <a class="link_edit" href="editar_catecumeno.php?id=<?php echo $data["id"]; ?>"><i class="fas fa-edit"></i></a>

                                            <a class="link_delete" onclick="eliminar_catecumeno(<?php echo $data['id']; ?>)"><i class="fas fa-trash-alt" style="color: #dd0303;"></i></a>


                                        </td>
                                    </tr>

                            <?php
                                }
                            }
                            ?>
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

        <script src="DataTables/JSZip-3.10.1/jszip.min.js"></script>
        <script src="DataTables/pdfmake-0.2.7/pdfmake.min.js"></script>
        <script src="DataTables/pdfmake-0.2.7/vfs_fonts.js"></script>
        <script src="DataTables/DataTables-1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="DataTables/DataTables-1.13.6/js/dataTables.bootstrap5.min.js"></script>
        <script src="DataTables/Buttons-2.4.2/js/dataTables.buttons.min.js"></script>
        <script src="DataTables/Buttons-2.4.2/js/buttons.bootstrap5.min.js"></script>
        <script src="DataTables/Buttons-2.4.2/js/buttons.colVis.min.js"></script>
        <script src="DataTables/Buttons-2.4.2/js/buttons.html5.min.js"></script>
        <script src="DataTables/Buttons-2.4.2/js/buttons.print.min.js"></script>
        <script src="js/table_catecumenos.js"></script>

</body>

</html>