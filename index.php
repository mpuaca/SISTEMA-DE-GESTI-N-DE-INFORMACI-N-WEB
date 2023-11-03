<?php
$alert = '';
session_start();

if (!empty($_SESSION['active'])) {
    header('location: sistema/');
} else {
    if (!empty($_POST)) {
        if (empty($_POST['usuario']) || empty($_POST['clave'])) {
            $_SESSION['alert'] = 'Ingrese su usuario y su clave';
        } else {
            require_once "conexion.php";

            $user = mysqli_real_escape_string($conection, $_POST['usuario']);
            $pass = md5(mysqli_real_escape_string($conection, $_POST['clave']));
            $query = mysqli_query($conection, "SELECT * FROM usuarios WHERE correo = '$user' AND clave = '$pass'");
            $result = mysqli_num_rows($query);

            if ($result > 0) {
                $data = mysqli_fetch_array($query);
            
                if (!empty($data['pregunta_seguridad_llena'])) {
                    // Los campos de pregunta de seguridad están llenos, procede con el inicio de sesión
                    $_SESSION['active'] = true;
                    $_SESSION['idUser'] = $data['id'];
                    $_SESSION['nombre'] = $data['nombre'];
                    $_SESSION['apellido'] = $data['apellido'];
                    $_SESSION['email'] = $data['email'];
                    $_SESSION['rol'] = $data['rol'];
            
                    header('location: sistema/');
                    exit;
                } else {
                    // Los campos de pregunta de seguridad no están llenos, redirige al usuario a un formulario
                    $_SESSION['idUser'] = $data['id']; // Asegúrate de configurar el ID de usuario antes de la redirección
                    header('location: pregunta_seguridad.php?id=' . $_SESSION['idUser']);
                    exit;
                }
            }
             else {
                $alert = 'El usuario o la clave son incorrectos';
                session_destroy();
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/login.css">
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
                            <form action="" method="POST" class="signin-form" class="signin-form">
                                <div class="form-group mb-3">
                                    <label class="label" for="name">Correo electrónico</label>
                                    <input type="text" class="form-control" required name="usuario">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label" for="password">Contraseña</label>
                                    <input type="password" class="form-control" required name="clave">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-primary rounded submit px-3">Iniciar sesion</button>
                                </div>
                                <div class="form-group d-md-flex">
                                    <div class="w-50 text-left">
                                        <a href="recuperado/index.php">¿Has olvidado la contraseña?</a>
                                    </div>
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
</html> 