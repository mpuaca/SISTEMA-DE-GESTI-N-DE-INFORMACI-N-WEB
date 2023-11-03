<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


<?php
session_start();
if ($_SESSION['rol'] != 1 && $_SESSION['rol'] != 2) {
    header("location: ../");
}
include "../conexion.php";
$eliminar = $_POST['id'];
$setencia = $conection->query("DELETE FROM estudiantes WHERE id= $eliminar")
?>