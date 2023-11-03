function showSuccessAlertBenefactores() {
    Swal.fire({
        icon: "success",
        title: "Éxito",
        text: "Datos guardados exitosamente",
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href="lista_benefactores.php"; // Redirecciona a index.php
        }
    });
}