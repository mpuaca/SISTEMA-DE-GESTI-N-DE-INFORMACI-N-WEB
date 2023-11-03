<?php
// Include el archivo de conexión a la base de datos
include '../conexion.php';

if (isset($_POST["nombreDonante"])) {
    $nombreDonante = $_POST["nombreDonante"];

    // Realiza una consulta para buscar el donante por nombre
    $queryBuscarDonante = "SELECT * FROM donantes WHERE Nombre = ?";
    $stmtBuscarDonante = $conection->prepare($queryBuscarDonante);
    $stmtBuscarDonante->bind_param("s", $nombreDonante);
    $stmtBuscarDonante->execute();
    $resultDonante = $stmtBuscarDonante->get_result();

    if ($resultDonante->num_rows > 0) {
        // Donante encontrado, obtén los datos del donante
        $donante = $resultDonante->fetch_assoc();

        // Devuelve los datos del donante en formato JSON
        echo json_encode($donante);
    } else {
        // Donante no encontrado, devuelve una respuesta vacía
        echo "";
    }
}
?>
