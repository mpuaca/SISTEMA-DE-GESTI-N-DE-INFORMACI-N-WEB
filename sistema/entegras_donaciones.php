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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script>
        Intl.DateTimeFormat().resolvedOptions().timeZone = "America/Guatemala";
    </script>

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
            <div class="container-fluid pt-4 px-4">
                <ul class="nav justify-content-center">
                    <li class="nav-item">
                        <a class="me-md-2 active1" aria-current="page" href="entegras_donaciones.php">Entregas</a>
                    </li>
                    <li class="nav-item">
                        <a class="me-md-2" href="ver_entregas.php">Ver Reporte</a>
                    </li>
                </ul>
                <div class="h-100 p-4">
                    <h6 class="mb-4">Entregas</h6>
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="fecha" style="font-weight: bold;">Fecha de Entrega:</label>
                            <?php date_default_timezone_set('America/Guatemala'); echo date('d-m-Y'); ?>
                        </div>
                        <div class="mb-3">
                            <label for="beneficiario">Selecciona un beneficiario:</label>
                            <select class="form-select" name="beneficiario" id="beneficiario">
                                <?php
                                // Consulta para obtener la lista de beneficiarios desde la base de datos
                                $query = "SELECT BeneficiarioID, nombre FROM beneficiarios WHERE propósito = 'alimentos'OR propósito = 'ambos'";
                                $result = $conection->query($query);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value='" . $row['BeneficiarioID'] . "'>" . $row['nombre'] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="combo">Selecciona un combo:</label>
                            <select class="form-select" name="combo" id="combo">
                                <?php
                                // Consulta para obtener la lista de combos desde la base de datos
                                $query = "SELECT ComboID, DescripcionCombo FROM combos";
                                $result = $conection->query($query);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value='" . $row['ComboID'] . "'>" . $row['DescripcionCombo'] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <input type="submit" name="guardar_entrega" class="btn btn-primary me-md-2 btn-agregar" value="Entregar">
                    </form>
                </div>
            </div>

        </div>
        <!-- Template Javascript -->
        <!-- jQuery y Bootstrap -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

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
        <script>
            $(document).ready(function() {
                $('#selectBeneficiario').select2();
            });
        </script>

        <script>
            $(document).ready(function() {
                // Inicializa select2 en el elemento con id "beneficiario"
                $('#beneficiario').select2();

                // Luego, agrega el evento de cambio (después de inicializar select2)
                var select = document.getElementById("beneficiario");

                select.addEventListener("change", function() {
                    var selectedOption = select.options[select.selectedIndex];
                    var selectedValue = selectedOption.value;
                    var selectedText = selectedOption.text;

                    // Aquí puedes hacer lo que necesites con el valor y el texto seleccionados
                    console.log("Valor seleccionado: " + selectedValue);
                    console.log("Texto seleccionado: " + selectedText);
                });
            });
        </script>

</body>

</html>

<?php

if ($conection->connect_error) {
    die("Error de conexión a la base de datos: " . $conection->connect_error);
}

if (isset($_POST["guardar_entrega"])) {
    $beneficiario_id = mysqli_real_escape_string($conection, $_POST["beneficiario"]);
    $combo_id = mysqli_real_escape_string($conection, $_POST["combo"]);

    $estado_entrega = 1;
    date_default_timezone_set('America/Guatemala');
    $fecha_entrega = date('Y-m-d');

    // Consulta para obtener los productos asociados al combo seleccionado
    $select_productos_combos = "SELECT ProductoID, Cantidad FROM productos_combos WHERE ComboID = '$combo_id'";
    $result_productos_combos = $conection->query($select_productos_combos);

    if ($result_productos_combos) {
        // Insertar la entrega en la tabla de entregas
        $insert_entrega_query = "INSERT INTO entregas (BeneficiarioID, ComboID, FechaEntrega, asistio) VALUES ('$beneficiario_id', '$combo_id', '$fecha_entrega', '$estado_entrega')";

        if ($conection->query($insert_entrega_query) === TRUE) {
            $entrega_id = $conection->insert_id;
            while ($row = $result_productos_combos->fetch_assoc()) {
                $producto_id = $row['ProductoID'];
                $cantidad = $row['Cantidad'];

                // Verifica si la cantidad entregada es menor o igual a la cantidad disponible en el inventario
                $query_inventario = "SELECT Cantidad FROM inventario WHERE ProductoID = '$producto_id'";
                $result_inventario = $conection->query($query_inventario);
                $row_inventario = $result_inventario->fetch_assoc();
                $cantidad_disponible = $row_inventario['Cantidad'];

                if ($cantidad <= $cantidad_disponible) {
                    // Insertar el producto entregado en la tabla de productosentregados
                    $insert_producto_entregado_query = "INSERT INTO productosentregados (EntregaID, ProductoID, Cantidad) VALUES ('$entrega_id', '$producto_id', '$cantidad')";
                    $conection->query($insert_producto_entregado_query);

                    // Actualiza el inventario restando la cantidad entregada
                    $update_inventario_query = "UPDATE inventario SET Cantidad = Cantidad - '$cantidad' WHERE ProductoID = '$producto_id'";
                    $conection->query($update_inventario_query);
                } else {
                    echo "Error: La cantidad seleccionada supera la cantidad disponible en el inventario para el producto seleccionado.";
                }
            }
        } else {
            echo "Error al registrar la entrega: " . $conection->error;
        }
    } else {
        echo "Error al obtener los productos del combo: " . $conection->error;
    }
}
?>
