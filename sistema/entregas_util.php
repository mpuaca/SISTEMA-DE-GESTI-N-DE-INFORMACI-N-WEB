<?php
session_start();
if ($_SESSION['rol'] != 1 && $_SESSION['rol'] != 2) {
    header("location: ../");
}
include "../conexion.php";

if ($conection->connect_error) {
    die("Error de conexión a la base de datos: " . $conection->connect_error);
}

if (isset($_POST["guardar_entrega"])) {
    $beneficiario_id = mysqli_real_escape_string($conection, $_POST["beneficiario"]);
    $estado_entrega = 1; // Supongo que 1 significa "entregado". Ajusta según tus necesidades.
    $fecha_entrega = mysqli_real_escape_string($conection, $_POST["fecha_entrega"]);

    // Inserta la entrega en la tabla de entregas_utiles
    $insert_entrega_query = "INSERT INTO entregas_utiles (BeneficiarioID, FechaEntrega, asistio) VALUES ('$beneficiario_id', '$fecha_entrega', '$estado_entrega')";

    if ($conection->query($insert_entrega_query) === TRUE) {
        $entrega_id = $conection->insert_id;
        echo "Entrega registrada con éxito. ID de entrega: $entrega_id";

        // Ahora, necesitas procesar los productos entregados
        $productos_seleccionados = $_POST["productos_seleccionados"];
        $cantidades = $_POST["cantidades"];

        // Recorre los productos y cantidades para asociarlos a la entrega
        for ($i = 0; $i < count($productos_seleccionados); $i++) {
            $producto_id = mysqli_real_escape_string($conection, $productos_seleccionados[$i]);
            $cantidad = mysqli_real_escape_string($conection, $cantidades[$i]);

            // Verifica si la cantidad entregada es menor o igual a la cantidad disponible en el inventario
            $query_inventario = "SELECT Cantidad FROM inventario WHERE ProductoID = '$producto_id'";
            $result_inventario = $conection->query($query_inventario);
            $row_inventario = $result_inventario->fetch_assoc();
            $cantidad_disponible = $row_inventario['Cantidad'];

            if ($cantidad <= $cantidad_disponible) {
                // Inserta el producto entregado en la tabla de productosentregados
                $insert_producto_entregado_query = "INSERT INTO productosentregadosutiles (EntregaID, ProductoID, Cantidad) VALUES ('$entrega_id', '$producto_id', '$cantidad')";
                $conection->query($insert_producto_entregado_query);
                echo "Producto asociado a la entrega con éxito.";

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
    <link href="DataTables/DataTables-1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="DataTables/Buttons-2.4.2/css/buttons.bootstrap5.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="js/eliminar.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />


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
                        <a class="me-md-2 active1" aria-current="page" href="entregas_util.php">Entregas</a>
                    </li>
                    <li class="nav-item">
                        <a class="me-md-2" href="ver_entregas_utiles.php">Ver Reporte</a>
                    </li>
                </ul>
                <div class="h-100 p-4">
                    <h6 class="mb-4">Entregas Utiles</h6>
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="fecha">Fecha de Entrega:</label>
                            <input type="date" name="fecha_entrega" id="fecha_entrega" required>
                        </div>

                        <div class="mb-3">
                            <label for="beneficiario">Selecciona un beneficiario:</label>
                            <select class="form-select" name="beneficiario" id="beneficiario">
                                <?php
                                // Consulta para obtener la lista de beneficiarios desde la base de datos
                                $query = "SELECT BeneficiarioID, nombre FROM beneficiarios WHERE propósito = 'útiles_escolares' OR propósito = 'ambos'";
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
                            <label class="fw-bold">Productos Disponibles (Categoría: Alimentos):</label>
                            <ul class="list-unstyled">
                                <?php
                                // Consulta para obtener la lista de productos de la categoría "alimentos" desde la tabla de inventario
                                $query = "SELECT ProductoID, NombreProducto, Cantidad FROM inventario WHERE Categoria = 'útiles' AND Cantidad > 0";
                                $result = $conection->query($query);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<li class='mb-4'>
                                        <div class='d-flex justify-content-between align-items-center'>
                                            <label class='form-check mb-0'>
                                                <input type='checkbox' class='form-check-input' name='productos_seleccionados[]' value='" . $row['ProductoID'] . "'> " . $row['NombreProducto'] . " (Disponibles: " . $row['Cantidad'] . ")
                                            </label>
                                            <div class='d-flex align-items-center'>
                                                Cantidad: <input type='number' class='form-control form-control-sm' name='cantidades[]' min='1' max='" . $row['Cantidad'] . "' value='1'>
                                            </div>
                                        </div>
                                    </li>";
                                    }
                                } else {
                                    echo "No hay productos disponibles en la categoría 'alimentos' en el inventario.";
                                }
                                ?>
                            </ul>
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