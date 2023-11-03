<?php
// Incluye el archivo de conexión a la base de datos
include '../conexion.php';

// Realiza la eliminación de todas las fechas en la tabla 'registro_asistencia'
$queryEliminarTodasLasFechas = "DELETE FROM registro_asistencia";

if (mysqli_query($conection, $queryEliminarTodasLasFechas)) {
    // Éxito al eliminar todas las fechas, puedes mostrar un mensaje o realizar alguna acción adicional si es necesario
    echo 'success';
} else {
    // Maneja errores si la eliminación no fue exitosa
    echo 'error';
}

// Cierra la conexión a la base de datos
mysqli_close($conection);
?>
