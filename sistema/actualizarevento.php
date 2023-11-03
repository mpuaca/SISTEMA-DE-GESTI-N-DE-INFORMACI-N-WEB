<?php
include '../conexion.php'; // Conecta a la base de datos (ajusta la ruta según tu configuración)

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['eventId'], $_POST['newDescription'], $_POST['newStart'], $_POST['newEnd'])) {
        $eventId = $_POST['eventId'];
        $newDescription = $_POST['newDescription'];
        $newStart = $_POST['newStart'];
        $newEnd = $_POST['newEnd'];

        // Asegúrate de escapar y validar los datos antes de guardarlos en la base de datos
        $newDescription = mysqli_real_escape_string($conection, $newDescription);
        $newStart = mysqli_real_escape_string($conection, $newStart);
        $newEnd = mysqli_real_escape_string($conection, $newEnd);

        // Construye la consulta SQL para actualizar el evento
        $query = "UPDATE agenda SET description = '$newDescription', start_datetime = '$newStart', end_datetime = '$newEnd' WHERE id = $eventId";

        // Ejecuta la consulta SQL y maneja los errores si ocurren
        if (mysqli_query($conection, $query)) {
            // Redirige al usuario a la página de agenda actualizada
            header("Location: agenda.php");
            exit;
        } else {
            echo "Error al guardar los cambios: " . mysqli_error($conection);
        }
    }
}
?>
