<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Vice - Agenda</title>
    <link rel="stylesheet" href="styles_local.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/main.min.css' rel='stylesheet' />
    <style>
      .vet-dashboard {
        display: flex;
        min-height: 100vh;
      }
      #calendar {
        flex-grow: 1;
        padding: 20px;
        max-width: 900px;
        margin: 0 auto;
      }
        /* Botones de navegación (prev, next, today) */
        .fc-button-primary {
            background-color: #207cca !important;
            border-color: #207cca !important;
        }
        
        /* Botones de vista (mes, semana, día) */
        .fc-button-group .fc-button-primary {
            background-color: #207cca !important;
            border-color: #207cca !important;
        }
        
        /* Efecto hover */
        .fc-button-primary:hover {
            background-color: #1a6bb3 !important;
            border-color: #1a6bb3 !important;
        }
        
        /* Botón activo (vista seleccionada) */
        .fc-button-primary:not(:disabled).fc-button-active {
            background-color: #145a92 !important;
            border-color: #145a92 !important;
        }
    </style>
</head>
<body>
    <div class="vet-dashboard">
        <div class="vet-sidebar">
            <div class="vet-sidebar-header">
                <img src="../images/happy_dog.png" alt="Medical Vice Logo">
                <h3>Medical Vice</h3>
                <p>Panel Veterinario</p>
            </div>
            <ul class="vet-sidebar-nav">
                <li><a href="1_inicio.php"><i class="fas fa-home"></i> Inicio</a></li>
                <li><a href="2_agenda.php" class="active"><i class="fas fa-calendar-alt"></i> Agenda</a></li>
                <li><a href="3_0_cartilla_vacunacion.php"><i class="fas fa-syringe"></i> Cartilla de Vacunación</a></li>
                <li><a href="4_0_consulta_medica.php"><i class="fas fa-stethoscope"></i> Consulta Médica</a></li>
                <li><a href="5_0_examenes_medicos.php"><i class="fas fa-microscope"></i> Exámenes Médicos</a></li>
                <li><a href="6_historial_medico.php"><i class="fas fa-file-medical"></i> Historial Médico</a></li>
            </ul>
            <a href="../pages/login.php" class="vet-logout">
                <i class="fas fa-sign-out-alt"></i>
                Cerrar sesión
            </a>
        </div>
        
        <div id='calendar'></div>
    </div>

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/index.global.min.js'></script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
          },
          locale: 'es',
          buttonText: {
            today: 'Hoy',
            month: 'Mes',
            week: 'Semana',
            day: 'Día'
          }
        });
        calendar.render();
      });
    </script>
</body>
</html>