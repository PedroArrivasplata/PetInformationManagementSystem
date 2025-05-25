<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Vice - Panel Veterinario</title>
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
                <li><a href="1_inicio.php" class="active"><i class="fas fa-home"></i> Inicio</a></li>
                <li><a href="2_agenda.php"><i class="fas fa-calendar-alt"></i> Agenda</a></li>
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
        
        <div class="vet-main-content scroll-sections">
            <div class="vet-header">
                <div>
                    <h1>Bienvenido, Dr. Veterinario</h1>
                    <p class="text-muted">Martes, 21 de abril de 2025</p>
                </div>
            </div>
            
            <div class="vet-cards">
                <div class="vet-card">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="m-0">Vacunaciones Pendientes</h3>
                        <div class="vet-card-icon">
                            <i class="fas fa-syringe"></i>
                        </div>
                    </div>
                    <div class="mb-3">
                        <p>Tienes <strong>3 mascotas</strong> con vacunas pendientes.</p>
                        <p>Próxima vacuna: <strong>mañana a las 10:30 AM</strong></p>
                    </div>
                    <div class="vet-card-footer">
                        <a href="#" class="vet-btn">Ver cartillas</a>
                    </div>
                </div>
                
                <div class="vet-card info">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="m-0">Exámenes Médicos</h3>
                        <div class="vet-card-icon">
                            <i class="fas fa-microscope"></i>
                        </div>
                    </div>
                    <div class="mb-3">
                        <p><strong>4 resultados</strong> pendientes de revisión.</p>
                        <p>2 análisis de laboratorio, 2 radiografías</p>
                    </div>
                    <div class="vet-card-footer">
                        <a href="#" class="vet-btn">Revisar</a>
                    </div>
                </div>
                
                <div class="vet-card warning">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="m-0">Consultas Programadas</h3>
                        <div class="vet-card-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                    </div>
                    <div class="mb-3">
                        <p>Tienes <strong>5 citas</strong> programadas para hoy.</p>
                        <p><strong>3 consultas</strong> y <strong>2 vacunaciones</strong></p>
                    </div>
                    <div class="vet-card-footer">
                        <a href="#" class="vet-btn">Ver agenda</a>
                    </div>
                </div>
                
                <div class="vet-card alert">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="m-0">Historial Médico</h3>
                        <div class="vet-card-icon">
                            <i class="fas fa-file-medical"></i>
                        </div>
                    </div>
                    <div class="mb-3">
                        <p><strong>2 pacientes</strong> requieren actualización de historial.</p>
                        <p>Última actualización: <strong>hace 3 días</strong></p>
                    </div>
                    <div class="vet-card-footer">
                        <a href="#" class="vet-btn">Actualizar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>