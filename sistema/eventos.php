<?php
session_start();
if ($_SESSION['rol'] != 1 && $_SESSION['rol'] != 2) {
    header("location: ../");
}
include "../conexion.php";

// Si se solicita cargar eventos
$eventos = array();
$sql = "SELECT * FROM agenda";
$resultado = $conection->query($sql);

if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $eventos[] = array(
            "id" => $row["id"],
            "title" => $row["title"],
            "description" => $row["description"],
            "start_datetime" => $row["start"],
            "end_datetime" => $row["end"]
        );
    }
}

echo json_encode($eventos);
?>
