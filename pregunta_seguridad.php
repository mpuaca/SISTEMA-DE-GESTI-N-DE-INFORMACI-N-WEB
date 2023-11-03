<?php
session_start();
if (isset($_GET['id'])) {
    $userId = $_GET['id'];
    // Ahora puedes usar $userId en tu código para identificar al usuario.
} else {
    // Si el ID no está presente en la URL, maneja el caso apropiado (por ejemplo, muestra un mensaje de error).
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Formulario de Pregunta de Seguridad</title>
    <!-- Agregar enlaces a las hojas de estilo de Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f0f0f0; /* Color de fondo gris claro */
        }
        .form-container {
            background-color: #c4e3f3; /* Fondo blanco para el formulario */
            border-radius: 20px; /* Bordes redondeados */
            padding: 20px; /* Espaciado interno */
            margin-top: 20px; /* Margen superior para centrar en la página */
            /* Centra horizontalmente en la pantalla */
            margin-left: auto;
            margin-right: auto;
            max-width: 400px; /* Ancho máximo del contenedor */
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="col-md-6 form-container">
            <h1 class="text-center">Pregunta de Seguridad</h1>

            <form action="guardar_pregunta_seguridad.php" method="post" class="mt-4">
                <!-- Pregunta 1 -->
                <div class="form-group">
                    <labl for="colorFavorito">¿Cuál es tu color favorito?</label>
                    <input type="text" name="respuesta" id="respuesta" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>
    </div>

    <!-- Agregar el enlace al archivo JavaScript de Bootstrap y a jQuery si no está presente -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
</body>

</html>
