<?php
include "../conexion.php";

// Verifica si los datos del evento fueron enviados por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $start = $_POST['start'];
    $end = $_POST['end'];

    // Inserta los datos en la tabla de eventos
    $insert_query = "INSERT INTO agenda (title, description, start_datetime, end_datetime) VALUES (?, ?, ?, ?)";
    $stmt = $conection->prepare($insert_query);
    $stmt->bind_param("ssss", $title, $description, $start, $end);

    if ($stmt->execute()) {
        echo "Evento guardado con éxito.";

    } else {
        echo "Error al guardar el evento: " . $stmt->error;
    }
}
?>
