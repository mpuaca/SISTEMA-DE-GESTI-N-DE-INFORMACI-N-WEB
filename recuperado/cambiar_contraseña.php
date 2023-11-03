<?php
session_start();
$usuario_id = $_SESSION['usuario_id'];
include '../conexion.php';

if (isset($_POST['nueva_contrasena']) && isset($_POST['confirmar_contrasena'])) {
    $nueva_contrasena = mysqli_real_escape_string($conection, $_POST['nueva_contrasena']);
    $confirmar_contrasena = mysqli_real_escape_string($conection, $_POST['confirmar_contrasena']);

    if ($nueva_contrasena !== $confirmar_contrasena) {
        echo "Las contraseñas no coinciden. Inténtalo de nuevo.";
    } else {
        // Conexión a la base de datos
        $conection = mysqli_connect("localhost", "root", "", "sistemamater");

        // Verificar si la conexión fue exitosa
        if (!$conection) {
            die("La conexión a la base de datos falló: " . mysqli_connect_error());
        }

        // Hashear la nueva contraseña antes de almacenarla
        $nueva_contrasena_hash = md5($nueva_contrasena);

        // Actualiza la contraseña en la base de datos
        $actualizar_contrasena = "UPDATE usuarios SET clave = '$nueva_contrasena_hash' WHERE id = $usuario_id";
        if (mysqli_query($conection, $actualizar_contrasena)) {
            echo "La contraseña se ha cambiado con éxito.";
        } else {
            echo "Hubo un error al cambiar la contraseña.";
        }

        // Cierra la sesión y redirige al usuario a la página de inicio de sesión
        session_destroy();
        header("location: ../");
    }
} else {
    echo "Por favor, completa ambos campos de contraseña.";
}
?>
