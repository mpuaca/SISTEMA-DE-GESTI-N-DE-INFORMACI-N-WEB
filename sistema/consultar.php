<?php
// Tu código de conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selectedDate'])) {
    $selectedDate = $_POST['selectedDate'];

    // Consulta para obtener asistencias para la fecha seleccionada
    $sql = "SELECT e.id, e.nombre, a.asistio
            FROM estudiantes e
            LEFT JOIN asistencia a ON e.id = a.id_estudiante AND DATE_FORMAT(a.fecha, '%d/%m/%Y') = ?
            ORDER BY e.id";

    $stmt = $conection->prepare($sql);
    $stmt->bind_param("s", $selectedDate);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);

    echo json_encode($data);
    exit;
}
?>
