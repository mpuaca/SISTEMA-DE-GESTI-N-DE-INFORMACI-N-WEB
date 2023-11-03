<?php
include "../conexion.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $eventId = $_POST['id'];

    // Realiza la eliminación del evento en la base de datos
    $sql = "DELETE FROM agenda WHERE id = ?";
    $stmt = $conection->prepare($sql);
    $stmt->bind_param("i", $eventId);

    if ($stmt->execute()) {
        echo "Éxito"; // Devuelve una respuesta de éxito
    } else {
        echo "Error al eliminar el evento: " . $stmt->error; // Devuelve un mensaje de error con detalles
    }
}
?>
