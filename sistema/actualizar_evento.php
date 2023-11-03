<?php
include "../conexion.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $eventId = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $start = $_POST['start'];
    $end = $_POST['end'];

    // Realiza la actualización en la base de datos
    $sql = "UPDATE agenda SET title = ?, description = ?, start_datetime = ?, end_datetime = ? WHERE id = ?";
    $stmt = $conection->prepare($sql);
    $stmt->bind_param("ssssi", $title, $description, $start, $end, $eventId);

    if ($stmt->execute()) {
        echo "Éxito"; // Devuelve una respuesta de éxito
    } else {
        echo "Error al actualizar el evento: " . $stmt->error; // Devuelve un mensaje de error con detalles
    }
}   
?>
