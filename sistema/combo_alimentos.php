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
    <script src="js/alerts.js"></script>

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
            <div class="container-fluid pt-4 px-4"><a href="inventario.php">Regresar</a>
                <div class="h-100 p-4">

                    <form action="" method="post">
                        <!-- Formulario para agregar un nuevo combo -->
                        <h4>Agregar Nuevo Combo</h4>
                        <div class="mb-3">
                            <label for="descripcion_combo">Nombre del Combo:</label>
                            <input class="form-control" type="text" name="descripcion_combo" id="descripcion_combo">
                        </div>
                        <div class="mb-3">
                            <label class="fw-bold">Productos Disponibles (Categoría: Alimentos):</label>
                            <ul class="list-unstyled">
                                <?php
                                // Consulta para obtener la lista de productos de la categoría "alimentos" desde la tabla de inventario
                                $query = "SELECT ProductoID, NombreProducto, Cantidad FROM inventario WHERE Categoria = 'alimentos' AND Cantidad > 0";
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
                                    echo "No hay productos disponibles en el inventario.";
                                }
                                ?>
                            </ul>
                        </div>

                        <input type="submit" class="btn btn-success" name="guardar_combo" value="Guardar Combo">
                    </form>

                    <h4>Combos Existentes</h4>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID Combo</th>
                                <th>Descripción del Combo</th>
                                <th>Productos del Combo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Consulta para obtener la lista de combos desde la tabla de combos
                            $combo_query = "SELECT ComboID, DescripcionCombo FROM combos";
                            $combo_result = $conection->query($combo_query);

                            if ($combo_result->num_rows > 0) {
                                while ($combo_row = $combo_result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $combo_row['ComboID'] . "</td>";
                                    echo "<td>" . $combo_row['DescripcionCombo'] . "</td>";

                                    // Consulta para obtener los productos asociados al combo
                                    $productos_combo_query = "SELECT p.NombreProducto, pc.Cantidad FROM productos_combos pc
                            INNER JOIN inventario p ON pc.ProductoID = p.ProductoID
                            WHERE pc.ComboID = " . $combo_row['ComboID'];
                                    $productos_combo_result = $conection->query($productos_combo_query);

                                    echo "<td>";
                                    if ($productos_combo_result->num_rows > 0) {
                                        while ($producto_combo_row = $productos_combo_result->fetch_assoc()) {
                                            echo $producto_combo_row['NombreProducto'] . " (" . $producto_combo_row['Cantidad'] . " unidades)<br>";
                                        }
                                    } else {
                                        echo "No hay productos asociados a este combo.";
                                    }
                                    echo "</td>";
                                    echo "<td>
    <a href='editar_combo.php?id=" . $combo_row['ComboID'] . "' class='btn btn-primary'>Editar</a>
    <a href='javascript:void(0);' class='btn btn-danger' onclick='eliminarCombo(" . $combo_row['ComboID'] . ")'>Eliminar</a>
    </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='3'>No hay combos registrados.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
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
            <script src="js/tabla_alimentos.js"></script>
            

</body>

</html>
<?php
if ($conection->connect_error) {
    die("Error de conexión a la base de datos: " . $conection->connect_error);
}

if (isset($_POST["guardar_combo"])) {
    // Obtiene la descripción del combo
    $descripcion_combo = mysqli_real_escape_string($conection, $_POST["descripcion_combo"]);

    // Inserta el nuevo combo en la tabla de combos
    $insert_combo_query = "INSERT INTO combos (DescripcionCombo) VALUES ('$descripcion_combo')";

    if ($conection->query($insert_combo_query) === TRUE) {
        $combo_id = $conection->insert_id;

        echo '<script>showSuccessAlertCombo();</script>';

        // Obtener los productos del combo y sus cantidades
        $productos_seleccionados = $_POST["productos_seleccionados"];
        $cantidades = $_POST["cantidades"];

        // Recorre los productos y cantidades para asociar al combo
        for ($i = 0; $i < count($productos_seleccionados); $i++) {
            $producto_id = mysqli_real_escape_string($conection, $productos_seleccionados[$i]);
            $cantidad = mysqli_real_escape_string($conection, $cantidades[$i]);

            // Verifica la cantidad disponible en el inventario
            $query_inventario = "SELECT Cantidad FROM inventario WHERE ProductoID = '$producto_id'";
            $result_inventario = $conection->query($query_inventario);
            $row_inventario = $result_inventario->fetch_assoc();
            $cantidad_disponible = $row_inventario['Cantidad'];

            if ($cantidad <= $cantidad_disponible) {
                // Inserta el producto en la tabla de productos_combos
                $insert_producto_combo_query = "INSERT INTO productos_combos (ComboID, ProductoID, Cantidad) VALUES ('$combo_id', '$producto_id', '$cantidad')";
                $conection->query($insert_producto_combo_query);
                echo "Producto asociado al combo con éxito.";
            } else {
                echo "Error: La cantidad seleccionada supera la cantidad disponible en el inventario para el producto seleccionado.";
            }
        }
    } else {
        echo "Error al registrar el combo: " . $conection->error;
    }
}

?>