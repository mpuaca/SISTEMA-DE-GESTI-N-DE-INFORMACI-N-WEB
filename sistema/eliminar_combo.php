<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


<?php
session_start();
include "../conexion.php";

if (isset($_POST['id'])) {
    $eliminar = $_POST['id'];
    
    // Primero, eliminamos los registros de productos_combos relacionados al ComboID
    $sentenciaProductosCombos = $conection->prepare("DELETE FROM productos_combos WHERE ComboID = ?");
    $sentenciaProductosCombos->bind_param("i", $eliminar);
    $sentenciaProductosCombos->execute();
    
    // Luego, eliminamos el combo de la tabla combos
    $sentenciaCombo = $conection->prepare("DELETE FROM combos WHERE ComboID = ?");
    $sentenciaCombo->bind_param("i", $eliminar);
    
    if ($sentenciaCombo->execute()) {
        // Éxito, puedes mostrar un mensaje o redirigir a una página
    } else {
        // Error al eliminar el combo
    }
}
?>