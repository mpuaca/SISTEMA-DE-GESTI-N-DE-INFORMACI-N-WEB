<?php
session_start();
if ($_SESSION['rol'] != 1 && $_SESSION['rol'] != 2) {
    header("location: ../");
}
include "../conexion.php";

if (isset($_POST['guardar_asistencia'])) {
    $fecha_asistencia = $_POST['fecha_asistencia'];
    $asistencias = $_POST['asistencia'];

    foreach ($asistencias as $estudiante_id => $asistencia) {
        // $estudiante_id es el ID del estudiante, $asistencia es "asistio" o "ausente"

        // Guarda la asistencia en la base de datos o realiza la acción deseada
        $query = "INSERT INTO registro_asistencia (id_estudiante , fecha, asistencia) VALUES ('$estudiante_id', '$fecha_asistencia', '$asistencia')";
        $result = mysqli_query($conection, $query);
        if (!$result) {
            // Manejar errores aquí si la inserción falla
        }
    }

    // Redirige a la página de asistencia o realiza alguna otra acción
    header("location: ver_asistencia_catecumenos.php");
}

?>