<?php
session_start();
if ($_SESSION['rol'] != 1 && $_SESSION['rol'] != 2) {
    header("location: ../");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Congregacion</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta content="" name="keywords">
    <meta content="" name="description">
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js'></script>
    <link href="img/favicon.ico" rel="icon">
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <?php include "include/navbar.php" ?>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <?php include "include/header.php" ?>
            <div class="container-fluid pt-4 px-4">
                <div id="calendar" class="calendario" style="width: 75%; margin: 0 auto; height: 600px;"></div>
            </div>
        </div>
    </div>
    </div>

    <?php
    include "../conexion.php";
    $fetch_event = mysqli_query($conection, "SELECT * FROM agenda");
    ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                timeZone: 'America/Guatemala',
                locale: 'es',
                initialView: 'dayGridMonth',
                selectable: true,
                selectMirror: true,
                buttonText: {
                    today: 'Hoy',
                },
                events: 'obtener_eventos.php', // Reemplaza con la URL correcta a tu archivo PHP que obtiene los eventos

                dateClick: function(info) {
                    // Abre el modal para agregar un nuevo evento cuando se hace clic en una fecha
                    $('#addEventModal').modal('show');

                    // Captura la fecha seleccionada y configúrala en el campo "Fecha de Inicio"
                    $('#eventStart').val(info.date.toISOString().slice(0, 16));
                },
                eventClick: function(info) {
                    // Abre el modal de edición cuando se hace clic en un evento
                    $('#editEventModal').modal('show');
                    // Llena los campos del modal con los datos del evento
                    $('#editEventId').val(info.event.id);
                    $('#editEventTitle').val(info.event.title);
                    $('#editEventDescription').val(info.event.extendedProps.description);
                    $('#editEventStart').val(info.event.start.toISOString().slice(0, 16));
                    $('#editEventEnd').val(info.event.end.toISOString().slice(0, 16));
                }
            });

            // Maneja el evento de guardar evento
            $('#saveEvent').on('click', function() {
                var title = $('#eventTitle').val();
                var description = $('#eventDescription').val();
                var start = $('#eventStart').val();
                var end = $('#eventEnd').val();
            });
            // Maneja el evento de guardar evento
            $('#saveEvent').on('click', function() {
                var title = $('#eventTitle').val();
                var description = $('#eventDescription').val();
                var start = $('#eventStart').val();
                var end = $('#eventEnd').val();

                // Realiza una solicitud AJAX para guardar el evento
                $.ajax({
                    type: 'POST',
                    url: 'guardar_evento.php', // Asegúrate de que esta URL sea correcta
                    data: {
                        title: title,
                        description: description,
                        start: start,
                        end: end
                    },
                    success: function(response) {
                        // Puedes manejar la respuesta del servidor aquí, por ejemplo, mostrar un mensaje de éxito
                        alert(response);
                        // Recargar la página para mostrar el evento agregado
                        location.reload();
                    },

                    error: function() {
                        // Manejar errores si la solicitud AJAX falla
                        alert('Error al guardar el evento.');
                    }
                });
                $('#addEventModal').modal('hide'); // Cierra el modal después de guardar
            });
            $('#saveEditEvent').on('click', function() {
                var eventId = $('#editEventId').val();
                var title = $('#editEventTitle').val();
                var description = $('#editEventDescription').val();
                var start = $('#editEventStart').val();
                var end = $('#editEventEnd').val();

                // Realiza una solicitud AJAX para actualizar el evento
                $.ajax({
                    type: 'POST',
                    url: 'actualizar_evento.php', // Ruta al archivo PHP que maneja la actualización
                    data: {
                        id: eventId,
                        title: title,
                        description: description,
                        start: start,
                        end: end
                    },
                    success: function(response) {
                        if (response === "Éxito") {
                            alert("Evento actualizado con éxito");
                            cargarEventosEnCalendario(); // Llama a la función para recargar los eventos
                        } else {
                            alert("Error al actualizar el evento: " + response);
                        }
                    }

                });
                $('#editEventModal').modal('hide');
            });
            // Controlador para eliminar un evento
            $('#deleteEvent').on('click', function() {
                var eventId = $('#editEventId').val();

                // Realiza una solicitud AJAX para eliminar el evento
                $.ajax({
                    type: 'POST',
                    url: 'eliminar_evento.php', // Asegúrate de que esta URL sea correcta
                    data: {
                        id: eventId
                    },
                    success: function(response) {
                        if (response === "Éxito") {
                            alert("Evento eliminado con éxito");
                            cargarEventosEnCalendario(); // Llama a la función para recargar los eventos
                        } else {
                            alert("Error al eliminar el evento: " + response);
                        }
                    },
                    error: function() {
                        alert('Error al eliminar el evento.');
                    }
                });

                $('#editEventModal').modal('hide');
            });

            function cargarEventosEnCalendario() {
                calendar.refetchEvents(); // Recarga los eventos en el calendario
            }

            calendar.render();
        });
    </script>

    <div class="modal fade" id="addEventModal" tabindex="-1" aria-labelledby="addEventModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEventModalLabel">Agregar Evento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addEventForm">
                        <div class="mb-3">
                            <label for="eventTitle" class="form-label">Título</label>
                            <input type="text" class="form-control" id="eventTitle" required>
                        </div>
                        <div class="mb-3">
                            <label for="eventDescription" class="form-label">Descripción</label>
                            <textarea class="form-control" id="eventDescription" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="eventStart" class="form-label">Fecha de Inicio</label>
                            <input type="datetime-local" class="form-control" id="eventStart" required>
                        </div>
                        <div class="mb-3">
                            <label for="eventEnd" class="form-label">Fecha de Finalización</label>
                            <input type="datetime-local" class="form-control" id="eventEnd" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="saveEvent">Guardar Evento</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="editEventModal" tabindex="-1" aria-labelledby="addEventModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Evento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="editEventId"> <!-- Este campo debe ser único en este modal -->
                    <div class="mb-3">
                        <label for="editEventTitle" class="form-label">Título</label>
                        <input type="text" class="form-control" id="editEventTitle" required>
                    </div>
                    <div class="mb-3">
                        <label for="editEventDescription" class="form-label">Descripción</label>
                        <textarea class="form-control" id="editEventDescription" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="editEventStart" class="form-label">Fecha de Inicio</label>
                        <input type="datetime-local" class="form-control" id="editEventStart" required>
                    </div>
                    <div class="mb-3">
                        <label for="editEventEnd" class="form-label">Fecha de Finalización</label>
                        <input type="datetime-local" class="form-control" id="editEventEnd" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="saveEditEvent">Guardar Cambios</button>
                    <button type="button" class="btn btn-danger" id="deleteEvent">Eliminar Evento</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>


    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/dayjs@1.10.7/dayjs.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

</body>

</html>