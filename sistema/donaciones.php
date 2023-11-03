<?php
session_start();
if ($_SESSION['rol'] != 1 && $_SESSION['rol'] != 2) {
    header("location: ../");
}
include '../conexion.php';
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
            <div class="container-fluid pt-4 px-4">
                <div class="h-100 p-4">
                    <h6 class="mb-4">Donaciones</h6>
                    <form method="post" action="">

                        <h5>Datos del Benefactor</h5>
                        <div class="row" id="datosDonante">
                            <div class="col-md-4">
                                <div class="form-group">
                                <input type="hidden" id="donanteID" name="donanteID">
                                    <label for="nombre">Nombre:</label>
                                    <input type="text" class="form-control" id="nombreDonante" name="nombre" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tel">Telefono:</label>
                                    <input type="text" class="form-control" id="tel" name="tel" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="direcion">Direccion:</label>
                                    <input type="tel" class="form-control" id="direccion" name="direccion" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Fecha</label>
                                <input type="date" class="form-control" id="fecha" name="fecha">

                            </div>
                        </div>
                        <h5>Detalles de la donación</h5>
                        <div id="detallesDonacion">
                            <button type="button" id="agregarDetalle" class="btn btn-primary btn-agregar">Agregar Producto</button>
                            <div class="row detalle">
                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <label for="descripcion" class="form-label">Descripción</label>
                                        <input type="text" name="descripcion[]" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <label for="Cantidad" class="form-label">Cantidad</label>
                                        <input type="text" name="cantidad[]" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <label for="medida" class="form-label">Medida</label>
                                        <select name="medida[]" class="form-control">
                                            <option value="" disabled selected>Medida</option>
                                            <option value="libras">libras</option>
                                            <option value="unidades">unidades</option>
                                            <option value="bolsas">bolsas</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <label for="categoría" class="form-label">categoría</label>
                                        <select name="categoria[]" class="form-control">
                                            <option value="alimentos">Alimentos</option>
                                            <option value="útiles">Útiles Escolares</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-6">
                                        <br>
                                        <button type="button" class="btn btn-danger eliminarDetalle">Eliminar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="botones">
                            <button id="guardarBtn" class="btn btn-success" type="submit">Guardar Donación</button>
                        </div>
                    </form>
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

        <script>
            $(document).ready(function() {
                var contadorDetalles = 0;

                // Ocultar el botón "Eliminar" en el conjunto de campos original
                $("#detallesDonacion .detalle:first .eliminarDetalle").hide();

                // Manejador de clic para el botón "Agregar Detalle"
                $("#agregarDetalle").click(function() {
                    var $primerDetalle = $("#detallesDonacion .detalle:first");
                    var $nuevoDetalle = $primerDetalle.clone();

                    contadorDetalles++;
                    $nuevoDetalle.find('select, input').attr('name', function(i, val) {
                        return val.replace(/\[\d+\]/g, '[' + contadorDetalles + ']');
                    });

                    $nuevoDetalle.find('input').val('');

                    // Agregar un botón "Eliminar" al nuevo conjunto de campos
                    $nuevoDetalle.find('.eliminarDetalle').show();

                    // Manejador de clic para el botón "Eliminar" en el nuevo conjunto de campos
                    $nuevoDetalle.find('.eliminarDetalle').click(function() {
                        $(this).closest('.detalle').remove();
                    });

                    // Agregar el nuevo conjunto de campos al contenedor
                    $("#detallesDonacion").append($nuevoDetalle);
                });

                // Manejar el formulario al enviarlo
                $("form").submit(function(event) {
                    // Verificar si los campos necesarios están definidos
                    if (!isset($_POST["descripciones"]) || !isset($_POST["cantidades"]) || !isset($_POST["medida"]) || !isset($_POST["categoria"])) {
                        return; // No hacer nada si los campos no están definidos
                    }

                    var descripciones = $_POST["descripcion"];
                    var cantidades = $_POST["cantidad"];
                    var medidas = $_POST["medida"];
                    var categorias = $_POST["categoria"];

                    // Resto del código para procesar los detalles y guardar la categoría
                });

            });
        </script>
   


</body>

</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreDonante = $_POST["nombre"];
    $telefonoDonante = $_POST["tel"];
    $direccionDonante = $_POST["direccion"];

    // Comprobar si el donante ya existe en la base de datos
    $queryDonanteExistente = "SELECT DonanteID FROM donantes WHERE Nombre = ?";
    $stmtExistente = $conection->prepare($queryDonanteExistente);
    $stmtExistente->bind_param("s", $nombreDonante);
    $stmtExistente->execute();
    $resultExistente = $stmtExistente->get_result();

    if ($resultExistente->num_rows > 0) {
        // El donante ya existe, obtén su ID
        $donanteRow = $resultExistente->fetch_assoc();
        $donanteID = $donanteRow["DonanteID"];
    } else {
        // El donante no existe, inserta un nuevo registro de donante
        $queryInsertDonante = "INSERT INTO donantes (Nombre, Telefono, Direccion) VALUES (?, ?, ?)";
        $stmtInsertDonante = $conection->prepare($queryInsertDonante);
        $stmtInsertDonante->bind_param("sss", $nombreDonante, $telefonoDonante, $direccionDonante);
        $stmtInsertDonante->execute();

        // Obtiene el ID del donante recién insertado
        $donanteID = $stmtInsertDonante->insert_id;
    }

    $fecha = $_POST["fecha"];
    $descripciones = $_POST["descripcion"];
    $cantidades = $_POST["cantidad"];
    $medida = $_POST["medida"];
    $categorias = $_POST["categoria"];

    // Inserta los datos en la tabla "donacion" utilizando el ID del donante
    $sqlInsertDonacion = "INSERT INTO donaciones (DonanteID, Fecha) VALUES (?, ?)";
    $stmtDonacion = $conection->prepare($sqlInsertDonacion);
    $stmtDonacion->bind_param("is", $donanteID, $fecha);
    $stmtDonacion->execute();

    // Obtiene el ID de la donación recién insertada
    $donacionID = $stmtDonacion->insert_id;

    // Procesa los detalles de la donación y actualiza el inventario
    if (!empty($descripciones) && !empty($cantidades) && !empty($medida) && count($descripciones) === count($cantidades)) {
        for ($i = 0; $i < count($descripciones); $i++) {
            $descripcion = $descripciones[$i];
            $cantidad = $cantidades[$i];
            $unidadMedida = $medida[$i];
            $categoria = $categorias[$i];

            // Inserta el detalle de donación en la base de datos, incluyendo la categoría
            $sqlInsertDetalle = "INSERT INTO detalle_donaciones (DonacionID, Descripcion, Cantidad, medida, Categoria) 
                             VALUES (?, ?, ?, ?, ?)";
            $stmtDetalle = $conection->prepare($sqlInsertDetalle);
            $stmtDetalle->bind_param("isiss", $donacionID, $descripcion, $cantidad, $unidadMedida, $categoria);
            $stmtDetalle->execute();

            // Verifica si el producto ya existe en el inventario
            $queryInventario = "SELECT NombreProducto, Cantidad,medida FROM Inventario WHERE NombreProducto = ? AND Categoria = ?";
            $stmtInventario = $conection->prepare($queryInventario);
            $stmtInventario->bind_param("ss", $descripcion, $categoria);
            $stmtInventario->execute();
            $resultInventario = $stmtInventario->get_result();

            if ($resultInventario->num_rows > 0) {
                // El producto ya existe en el inventario, actualiza la cantidad
                $rowInventario = $resultInventario->fetch_assoc();
                $nueva_cantidad = $rowInventario["Cantidad"] + $cantidad;

                $sqlUpdateInventario = "UPDATE Inventario SET Cantidad = ? WHERE NombreProducto = ? AND Categoria = ?";
                $stmtUpdateInventario = $conection->prepare($sqlUpdateInventario);
                $stmtUpdateInventario->bind_param("iss", $nueva_cantidad, $descripcion, $categoria);
                $stmtUpdateInventario->execute();
            } else {
                // El producto no existe en el inventario, inserta un nuevo registro
                $sqlInsertInventario = "INSERT INTO Inventario (NombreProducto, Cantidad, Categoria,medida) 
                    VALUES (?, ?, ?,?)";
                $stmtInsertInventario = $conection->prepare($sqlInsertInventario);
                $stmtInsertInventario->bind_param("siss", $descripcion, $cantidad, $categoria, $unidadMedida);
                $stmtInsertInventario->execute();
            }
        }
    }

    // Mostrar un mensaje de éxito
    echo '<script>showSuccessAlertDonacion();</script>';
}
?>