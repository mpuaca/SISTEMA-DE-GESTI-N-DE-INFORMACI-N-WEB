
<?php
// Conexión a la base de datos
include '../conexion.php';

// Verificar si la conexión fue exitosa
if (!$conection) {
    die("La conexión a la base de datos falló: " . mysqli_connect_error());
}

// Obtener el correo electrónico ingresado
$correo = mysqli_real_escape_string($conection, $_POST['correo']);

// Verificar si el correo electrónico existe en la tabla de usuarios
$query = "SELECT id FROM usuarios WHERE correo = '$correo'";
$resultado = mysqli_query($conection, $query);

if (mysqli_num_rows($resultado) == 1) {
    // El correo existe, mostrar preguntas de seguridad
    $usuario_id = mysqli_fetch_assoc($resultado)['id'];
    $preguntas = "SELECT pregunta FROM preguntas_seguridad WHERE usuario_id = $usuario_id";
    $resultado_preguntas = mysqli_query($conection, $preguntas);
    
    if (mysqli_num_rows($resultado_preguntas) == 1) {
        $pregunta = mysqli_fetch_assoc($resultado_preguntas);
        session_start();
        $_SESSION['usuario_id'] = $usuario_id;
        mysqli_close($conection);
        // Mostrar la pregunta de seguridad y un formulario para la respuesta
        // También, crea una variable de sesión para rastrear los intentos.
    } else {
        mysqli_close($conection);
        echo "No se encontraron preguntas de seguridad asociadas a este usuario.";
    }
} else {
    mysqli_close($conection);
    echo "El correo electrónico ingresado no existe en nuestra base de datos.";
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="../css/login.css">
</head>

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10">
                    <div class="wrap d-md-flex">
                        <div class="img" style="background-image: url(/imagen/maria.jpg);">
                        </div>
                        <div class="login-wrap p-4 p-md-5">
                            <div class="d-flex">
                                <div class="w-100 centered-container">
                                    <img src="/imagen/logo.png">
                                    <p>"Todo lo que hiciereis a uno de estos mis hermanos más pequeños a mí me lo hicisteis.” (Mt. 25, 40)</p>
                                </div>
                            </div>
                            <form action="procesar_respuesta.php" method="POST" class="signin-form" class="signin-form">
                                <div class="form-group mb-3">
                                <label><?php echo $pregunta['pregunta']; ?></label>
                                    <input type="text" class="form-control" required name="respuesta">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-primary rounded submit px-3" value="Verificar">Enviar</button>
                                </div>
                                <?php
                                if (!empty($alert)) {
                                    echo '<div class="alert alert-danger mt-3">' . $alert . '</div>';
                                }
                            ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
