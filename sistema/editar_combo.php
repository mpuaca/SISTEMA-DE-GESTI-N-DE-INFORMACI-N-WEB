<?php
session_start();

include "../conexion.php";

// Verificar si se ha proporcionado un ID de combo
if (isset($_GET['id'])) {
    $comboID = $_GET['id'];

    // Consulta para obtener los detalles del combo
    $query = "SELECT DescripcionCombo FROM combos WHERE ComboID = " . $comboID;
    $result = $conection->query($query);

    if ($result->num_rows > 0) {
        $combo = $result->fetch_assoc();
    } else {
        // Manejar el caso en el que no se encontró el combo con el ID proporcionado
        echo "Combo no encontrado.";
        exit;
    }
} else {
    // Manejar el caso en el que no se proporcionó un ID de combo
    echo "ID de combo no proporcionado.";
    exit;
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
                <div class="h-100 p-4">

                    <form action="" method="post">
                        <!-- Formulario para agregar un nuevo combo -->
                        <h4>Agregar Nuevo Combo</h4>
                        <div class="mb-3">
                            <label for="descripcion_combo">Nombre del Combo:</label>
                            <input type="hidden" name="combo_id" value="<?php echo $comboID; ?>"> <!-- Agregar el campo oculto para combo_id -->
                            <input class="form-control" type="text" name="descripcion_combo" id="descripcion_combo" value="<?php echo $combo['DescripcionCombo']; ?>">
                        </div>
                        <div class="mb-3">
                            <h4>Productos Disponibles (Categoría: Alimentos):</h4>
                            <ul class="list-unstyled">
                                <?php
                                // Consulta para obtener la lista de productos de la categoría "alimentos" desde la tabla de inventario
                                $query = "SELECT ProductoID, NombreProducto, Cantidad FROM inventario WHERE Categoria = 'alimentos' AND Cantidad > 0";
                                $result = $conection->query($query);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $isChecked = false;
                                        $cantidadAsignada = 0;

                                        // Consulta para verificar si el producto está asignado a este combo y obtener la cantidad asignada
                                        $comboProductoQuery = "SELECT ProductoID, Cantidad FROM productos_combos WHERE ComboID = " . $comboID . " AND ProductoID = " . $row['ProductoID'];
                                        $comboProductoResult = $conection->query($comboProductoQuery);

                                        if ($comboProductoResult->num_rows > 0) {
                                            $comboProducto = $comboProductoResult->fetch_assoc();
                                            $isChecked = true;
                                            $cantidadAsignada = $comboProducto['Cantidad'];
                                        }

                                        echo "<li class='mb-4'>
                    <div class='d-flex justify-content-between align-items-center'>
                        <label class='form-check mb-0'>
                            <input type='checkbox' class='form-check-input' name='productos_seleccionados[]' value='" . $row['ProductoID'] . "' " . ($isChecked ? 'checked' : '') . "> " . $row['NombreProducto'] . " (Disponibles: " . $row['Cantidad'] . ")
                        </label>
                        <div class='d-flex align-items-center'>
                            Cantidad: <input type='number' class='form-control form-control-sm' name='cantidades[]' min='1' max='" . $row['Cantidad'] . "' value='" . $cantidadAsignada . "'>
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
                        <input type="submit" class="btn btn-success" name="actualizar_combo" value="Actualizar">

                    </form>
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
    <script>
        function editProduct(comboProductoID, cantidad) {
            // Completa el formulario de edición con los detalles del producto
            document.getElementById('cantidad_producto').value = cantidad;
            document.getElementById('editProductID').value = comboProductoID;

            // Muestra el formulario de edición
            document.getElementById('editProductForm').style.display = 'block';
        }
    </script>
</body>

</html>
<?php

if (isset($_POST["actualizar_combo"])) {
    // Obtener el ID del combo que se va a actualizar
    $combo_id = mysqli_real_escape_string($conection, $_POST["combo_id"]);

    // Obtener la nueva descripción del combo
    $descripcion_combo = mysqli_real_escape_string($conection, $_POST["descripcion_combo"]);

    // Actualizar la descripción del combo en la tabla de combos
    $update_combo_query = "UPDATE combos SET DescripcionCombo = '$descripcion_combo' WHERE ComboID = '$combo_id'";

    if ($conection->query($update_combo_query) === TRUE) {
        echo '<script>showSuccessAlertCombo();</script>';

        // Obtener los productos del combo y sus cantidades
        $productos_seleccionados = $_POST["productos_seleccionados"];
        $cantidades = $_POST["cantidades"];

        // Recorrer los productos y cantidades para actualizar la tabla de productos_combos
        for ($i = 0; $i < count($productos_seleccionados); $i++) {
            $producto_id = mysqli_real_escape_string($conection, $productos_seleccionados[$i]);
            $cantidad = mysqli_real_escape_string($conection, $cantidades[$i]);

            // Verificar la cantidad disponible en el inventario
            $query_inventario = "SELECT Cantidad FROM inventario WHERE ProductoID = '$producto_id'";
            $result_inventario = $conection->query($query_inventario);
            $row_inventario = $result_inventario->fetch_assoc();
            $cantidad_disponible = $row_inventario['Cantidad'];

            if ($cantidad <= $cantidad_disponible) {
                // Verificar si el producto ya está asociado al combo
                $query_existencia = "SELECT ProductoComboID FROM productos_combos WHERE ComboID = '$combo_id' AND ProductoID = '$producto_id'";
                $result_existencia = $conection->query($query_existencia);

                if ($result_existencia->num_rows > 0) {
                    // El producto ya está asociado, así que actualiza la cantidad
                    $update_producto_combo_query = "UPDATE productos_combos SET Cantidad = '$cantidad' WHERE ComboID = '$combo_id' AND ProductoID = '$producto_id'";
                    $conection->query($update_producto_combo_query);
                    echo "Cantidad actualizada para el producto con ID $producto_id.";
                } else {
                    // El producto no está asociado, así que inserta un nuevo registro
                    $insert_producto_combo_query = "INSERT INTO productos_combos (ComboID, ProductoID, Cantidad) VALUES ('$combo_id', '$producto_id', '$cantidad')";
                    $conection->query($insert_producto_combo_query);
                    echo "Producto asociado al combo con éxito.";
                }
            } else {
                echo "Error: La cantidad seleccionada supera la cantidad disponible en el inventario para el producto seleccionado.";
            }
        }
    } else {
        echo "Error al actualizar el combo: " . $conection->error;
    }
}


?>
