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
                            <form action="procesar_recuperacion.php" method="POST" class="signin-form" class="signin-form">
                                <div class="form-group mb-3">
                                    <label class="label" for="name">Correo electrónico</label>
                                    <input type="text" class="form-control" required name="correo">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-primary rounded submit px-3">Iniciar sesion</button>
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