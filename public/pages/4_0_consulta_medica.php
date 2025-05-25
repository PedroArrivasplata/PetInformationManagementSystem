<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Vice - Consulta Médica</title>
    <link rel="stylesheet" href="../styles_css/styles_local.css">
    <link rel="stylesheet" href="../styles_css/iconos.css">
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
                <li><a href="2_agenda.php"><i class="fas fa-calendar-alt"></i> Agenda</a></li>
                <li><a href="3_0_cartilla_vacunacion.php"><i class="fas fa-syringe"></i> Cartilla de Vacunación</a></li>
                <li><a href="4_0_consulta_medica.php" class="active"><i class="fas fa-stethoscope"></i> Consulta Médica</a></li>
                <li><a href="5_0_examenes_medicos.php"><i class="fas fa-microscope"></i> Exámenes Médicos</a></li>
                <li><a href="6_historial_medico.php"><i class="fas fa-file-medical"></i> Historial Médico</a></li>
            </ul>
            <a href="../pages/login.php" class="vet-logout">
                <i class="fas fa-sign-out-alt"></i>
                Cerrar sesión
            </a>
        </div>

        <div class="vet-main-content">
            <div class="vet-header">
                <h1>Consulta Médica</h1>
                <p class="text-muted">Gestiona tus consultas veterinarias</p>
            </div>

            <div class="consulta-container">
                <div class="consulta-box">
                    <i class="fas fa-plus-circle"></i>
                    <h2>Nueva consulta</h2>
                    <a href="4_1_nuevo_registro.php">Iniciar Consulta</a>
                </div>
                <div class="consulta-box">
                    <i class="fas fa-edit"></i>
                    <h2>Editar consulta anterior</h2>
                    <a href="4_2_modificar.php">Modificar consulta</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>