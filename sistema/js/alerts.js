// alerts.js
function showSuccessAlert() {
    Swal.fire({
        icon: "success",
        title: "Éxito",
        text: "Datos guardados exitosamente",
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href="usuarios.php"; // Redirecciona a index.php
        }
    });
}
function showSuccessAlertCar() {
    Swal.fire({
        icon: "success",
        title: "Éxito",
        text: "Datos guardados exitosamente",
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href="catecumenos.php"; // Redirecciona a index.php
        }
    });
}
function showSuccessAlertDonacion() {
    Swal.fire({
        icon: "success",
        title: "Éxito",
        text: "Datos guardados exitosamente",
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href="donaciones.php"; // Redirecciona a index.php
        }
    });
}
function showSuccessAlertCombo() {
    Swal.fire({
        icon: "success",
        title: "Éxito",
        text: "Datos guardados exitosamente",
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href="combo_alimentos.php"; // Redirecciona a index.php
        }
    });
}

function showSuccessAlertBeneficiarios() {
    Swal.fire({
        icon: "success",
        title: "Éxito",
        text: "Datos guardados exitosamente",
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href="Beneficiarios.php"; // Redirecciona a index.php
        }
    });
}
function showErrorAlert() {
    Swal.fire({
        icon: "error",
        title: "Error",
        text: "Error al crear el usuario",
    });
}

function showSuccessAlert_edit_catecumeno() {
    Swal.fire({
        icon: "success",
        title: "Éxito",
        text: "Datos actualizados exitosamente",
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href="catecumenos.php"; // Redirecciona a index.php
        }
    });
}

function showSuccessAlert_edit_benefactores() {
    Swal.fire({
        icon: "success",
        title: "Éxito",
        text: "Datos actualizados exitosamente",
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href="lista_benefactores.php"; // Redirecciona a index.php
        }
    });
}
function showErrorAlert_edit_catecumeno() {
    Swal.fire({
        icon: "error",
        title: "Error",
        text: "Error al actualiza el informacion de catecumenos",
    });
}
function showSuccessAlert_edit_beneficiario() {
    Swal.fire({
        icon: "success",
        title: "Éxito",
        text: "Datos actualizados exitosamente",
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href="Beneficiarios.php"; // Redirecciona a index.php
        }
    });
}
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