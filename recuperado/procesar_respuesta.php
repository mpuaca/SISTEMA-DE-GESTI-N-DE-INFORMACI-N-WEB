<?php
session_start();
$usuario_id = $_SESSION['usuario_id'];
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
                          <?php
        if (isset($_POST['respuesta'])) {
            $conexion = mysqli_connect("localhost", "root", "", "sistemamater");
            if (!$conexion) {
                die("La conexión a la base de datos falló: " . mysqli_connect_error());
            }

            $respuesta = mysqli_real_escape_string($conexion, $_POST['respuesta']);
            $preguntas = "SELECT respuesta FROM preguntas_seguridad WHERE usuario_id = $usuario_id";
            $resultado_preguntas = mysqli_query($conexion, $preguntas);

            if (mysqli_num_rows($resultado_preguntas) == 1) {
                $respuesta_correcta = mysqli_fetch_assoc($resultado_preguntas)['respuesta'];

                if ($respuesta === $respuesta_correcta) {
                    // Respuesta correcta, mostrar el formulario de cambio de contraseña
                    echo "Ingresa tu nueva contraseña";
                    echo "<form method='POST' action='cambiar_contraseña.php'>";
                    echo "Nueva Contraseña: <input class='form-control' type='password' name='nueva_contrasena'><br>";
                    echo "Confirmar Contraseña: <input class='form-control' type='password' name='confirmar_contrasena'><br>";
                    echo "<input type='submit' class='form-control btn btn-primary rounded submit px-3' value='Cambiar Contraseña'>";
                    echo "</form>";
                } else {
                    // Respuesta incorrecta
                    if (!isset($_SESSION['intentos_fallidos'])) {
                        $_SESSION['intentos_fallidos'] = 1;
                    } else {
                        $_SESSION['intentos_fallidos']++;
                    }

                    if ($_SESSION['intentos_fallidos'] < 3) {
                        // Mostrar la pregunta nuevamente para el siguiente intento
                        $preguntas = "SELECT pregunta FROM preguntas_seguridad WHERE usuario_id = $usuario_id";
                        $resultado_preguntas = mysqli_query($conexion, $preguntas);
                        $pregunta = mysqli_fetch_assoc($resultado_preguntas)['pregunta'];

                        echo "Respuesta incorrecta. Tienes " . (3 - $_SESSION['intentos_fallidos']) . " intentos restantes. Inténtalo nuevamente.";
                        // Muestra el formulario de respuesta a la pregunta nuevamente
                        echo "Pregunta de seguridad: $pregunta";
                        echo "<form method='POST' action='procesar_respuesta.php'>";
                        echo "Respuesta: <input class='form-control' type='text' name='respuesta'><br>";
                        echo "<input type='submit' class='form-control btn btn-primary rounded submit px-3' value='Enviar respuesta'>";
                        echo "</form>";
                    } else {
                        // Límite de intentos alcanzado, redirige al usuario al formulario de recuperación.
                        session_destroy(); // Limpia la sesión para reiniciar intentos fallidos
                        header("Location: ../index.php");
                    }
                }
            } else {
                echo "No se encontraron respuestas de seguridad asociadas a este usuario.";
            }

            mysqli_close($conexion);
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

</html>