<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Consulta - Medical Vice</title>
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
                <li><a href="4_0_consulta_medica.php"  class="active"><i class="fas fa-stethoscope"></i> Consulta Médica</a></li>
                <li><a href="5_0_examenes_medicos.php"><i class="fas fa-microscope"></i> Exámenes Médicos</a></li>
                <li><a href="6_historial_medico.php"><i class="fas fa-file-medical"></i> Historial Médico</a></li>
            </ul>
            <a href="../pages/login.php" class="vet-logout"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a>
        </div>

        <!-- Contenido principal -->
        <div class="vet-main-content">
            <div class="vet-header">
                <h1>Iniciar Consulta</h1>
                <p class="text-muted">Registra los detalles clínicos de la atención</p>
            </div>

            <div class="consulta-form">
                <form>
                    <div class="full-width">
                        <label for="motivo">Motivo de la Atención:</label>
                        <input type="text" id="motivo" name="motivo">
                    </div>

                    <div class="full-width">
                        <label for="sintomas">Síntomas:</label>
                        <textarea id="sintomas" name="sintomas"></textarea>
                    </div>

                    <div class="full-width">
                        <label for="observaciones">Observaciones:</label>
                        <textarea id="observaciones" name="observaciones"></textarea>
                    </div>

                    <div class="full-width">
                        <label for="diagnostico">Diagnóstico:</label>
                        <textarea id="diagnostico" name="diagnostico"></textarea>
                    </div>

                    <div class="full-width">
                        <label for="tratamiento">Tratamiento:</label>
                        <textarea id="tratamiento" name="tratamiento"></textarea>
                    </div>

                    <div>
                        <label for="vacunas">Vacunas Aplicadas:</label>
                        <input type="text" id="vacunas" name="vacunas" placeholder="Dejar en blanco si no se aplicó ninguna">
                    </div>

                    <div>
                        <label for="tipo">Tipo de Consulta:</label>
                        <select id="tipo" name="tipo">
                            <option value="">Seleccione</option>
                            <option>Consulta General</option>
                            <option>Emergencia</option>
                            <option>Vacunación</option>
                            <option>Revisión Postoperatoria</option>
                            <option>Otro</option>
                        </select>
                    </div>

                    <div>
                        <label for="veterinario">Nombre del Veterinario:</label>
                        <select id="veterinario" name="veterinario" required>
                            <option value="" selected disabled>Seleccione un nombre</option>
                            <option value="Eduardo">Eduardo</option>
                            <option value="Joao">Joao</option>
                        </select>
                    </div>

                    <div>
                        <label for="fecha">Fecha de Atención:</label>
                        <input type="date" id="fecha" name="fecha">
                    </div>

                    <button type="submit">Registrar Consulta</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>