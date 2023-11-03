<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once "conexion.php"; // Incluye tu archivo de conexión a la base de datos
    $respuesta = mysqli_real_escape_string($conection, $_POST['respuesta']);

    // Recuperar el ID del usuario de la sesión actual, asegúrate de ajustarlo según tu estructura de datos
    $usuario_id = $_SESSION['idUser'];

    // Insertar la pregunta de seguridad en la tabla preguntas_seguridad
    $sql = "INSERT INTO preguntas_seguridad (usuario_id, pregunta, respuesta) VALUES ('$usuario_id', '¿Cuál es tu color favorito?', '$respuesta')";

    if (mysqli_query($conection, $sql)) {
        // Actualiza la columna pregunta_seguridad_llena en la tabla de usuarios
        $updateSql = "UPDATE usuarios SET pregunta_seguridad_llena = 1 WHERE id = $usuario_id";
        if (mysqli_query($conection, $updateSql)) {
            // Redirige al usuario a la página "index" dentro de la carpeta "sistema"
            header("location: sistema/");
        } else {
            echo "Error al actualizar la información del usuario: " . mysqli_error($conection);
        }
    } else {
        echo "Error al guardar la pregunta de seguridad: " . mysqli_error($conection);
    }
    
}

?>