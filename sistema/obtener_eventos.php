<?php
// Incluye el archivo de conexión a la base de datos
include "../conexion.php";

// Realiza la consulta SQL para obtener eventos
$sql = "SELECT id, title, description, start_datetime, end_datetime FROM agenda";
$resultado = mysqli_query($conection, $sql);

// Prepara un arreglo para almacenar los eventos
$eventos = array();

// Recorre los resultados y agrega eventos al arreglo
while ($fila = mysqli_fetch_assoc($resultado)) {
    $eventos[] = array(
        "id" => $fila['id'],
        "title" => $fila['title'],
        "description" => $fila['description'],
        "start" => $fila['start_datetime'],
        "end" => $fila['end_datetime']
    );
}

// Convierte los eventos a formato JSON
$eventos_json = json_encode($eventos);

echo $eventos_json;
?>
