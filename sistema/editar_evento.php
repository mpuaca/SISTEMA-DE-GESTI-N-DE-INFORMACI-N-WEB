<?php
include "../conexion.php"; // Incluye el archivo de conexión a la base de datos

// Verifica si se ha enviado un ID de evento y datos de edición
if (isset($_POST['eventId']) && isset($_POST['title']) && isset($_POST['description']) && isset($_POST['start']) && isset($_POST['end'])) {
    $eventId = $_POST['eventId'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $start = $_POST['start'];
    $end = $_POST['end'];

    // Realiza la actualización en la base de datos
    $query = "UPDATE agenda SET title = '$title', description = '$description', start_datetime = '$start', end_datetime = '$end' WHERE id = $eventId";
    $result = mysqli_query($conection, $query);

    if ($result) {
        echo "Evento editado correctamente";
    } else {
        echo "Error al editar el evento";
    }
} else {
    echo "Faltan datos necesarios para editar el evento";
}
?>
