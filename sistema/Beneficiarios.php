<?php
session_start();
if ($_SESSION['rol'] != 1 && $_SESSION['rol'] != 2) {
    header("location: ../");
}
include "../conexion.php";

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


    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />


    <!-- Template Stylesheet -->
    <!-- Hojas de estilo de la plantilla -->
    <link href="css/style.css" rel="stylesheet">
    <link href="DataTables/DataTables-1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="DataTables/Buttons-2.4.2/css/buttons.bootstrap5.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Alerta -->
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
            <?php include "include/header.php" ?>
            <div class="container-fluid pt-4 px-4">
                <h4>Lista de Beneficiarios de Alimentos</h4>
             
                <div class="rounded-beneficiarios h-100 p-4">
                    <div class="table-responsive">
                        <table class="table" id="example">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre Completo</th>
                                    <th>Dpi</th>
                                    <th>Telefono</th>
                                    <th>Observaciones</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <?php
                            $query = mysqli_query($conection, "SELECT BeneficiarioID, nombre, telefono, dpi, observaciones, propósito FROM beneficiarios WHERE propósito = 'Alimentos'OR propósito = 'ambos' ORDER BY BeneficiarioID");

                            mysqli_close($conection);

                            $result = mysqli_num_rows($query);
                            if ($result > 0) {
                                while ($data = mysqli_fetch_array($query)) {
                            ?>
                                    <tr>
                                        <td><?php echo $data["BeneficiarioID"]; ?></td>
                                        <td  class="nombre"><?php echo $data["nombre"]; ?></td>
                                        <td><?php echo $data['dpi'] ?></td>
                                        <td><?php echo $data["telefono"]; ?></td>
                                        <td><?php echo nl2br($data['observaciones']); ?></td>
                                        <td>
                                            <a class="link_edit" href="editar_beneficiarios.php?id=<?php echo $data["BeneficiarioID"]; ?>"><i class="fas fa-edit fa-lg" style="color: #1c5e87;"></i></a>
                                            <?php if ($data["BeneficiarioID"]) { ?>
                                                <a class="link_delete" onclick="eliminar_beneficiario(<?php echo $data['BeneficiarioID']; ?>)"><i class="fas fa-trash-alt fa-lg" style="color: #c91313;"></i></a>
                                            <?php } ?>
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
        <script src="js/table_beneficiarios.js"></script>

</body>

</html>