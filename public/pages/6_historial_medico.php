<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Vice - Historial Médico</title>
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
                <li><a href="4_0_consulta_medica.php"><i class="fas fa-stethoscope"></i> Consulta Médica</a></li>
                <li><a href="5_0_examenes_medicos.php"><i class="fas fa-microscope"></i> Exámenes Médicos</a></li>
                <li><a href="6_historial_medico.php" class="active"><i class="fas fa-file-medical"></i> Historial Médico</a></li>
            </ul>
            <a href="../pages/login.php" class="vet-logout">
                <i class="fas fa-sign-out-alt"></i>
                Cerrar sesión
            </a>
        </div>
        
        <div class="vet-main-content scroll-sections">
            <div class="vet-header">
                <div>
                    <h1>Historial Médico</h1>
                    <p class="text-muted">Consulta integral del historial clínico de tus pacientes</p>
                </div>
            </div>
            
            <!-- Filtros de búsqueda -->
            <div class="vet-card">
                <div class="vet-card-header">
                    <h3><i class="fas fa-filter"></i> Filtros de Búsqueda</h3>
                </div>
                <div class="vet-form-row">
                    <div class="vet-form-group">
                        <label for="filtro-nombre">Nombre de la Mascota</label>
                        <input type="text" id="filtro-nombre" class="vet-form-control" placeholder="Ej: Max">
                    </div>
                    <div class="vet-form-group">
                        <label for="filtro-dni">DNI del Propietario</label>
                        <input type="text" id="filtro-dni" class="vet-form-control" placeholder="Ej: 12345678">
                    </div>
                    <div class="vet-form-group" style="align-self: flex-end;">
                        <button class="vet-btn">
                            <i class="fas fa-search"></i> Buscar
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Resultados de búsqueda -->
            <div class="vet-card" style="margin-top: 20px;">
                <div class="vet-card-header">
                    <h3><i class="fas fa-search"></i> Resultados</h3>
                </div>
                <div class="vet-pets-list">
                    <div class="vet-pet-item">
                        <label>
                            <input type="radio" name="paciente" checked>
                            <div class="d-flex align-items-center">
                                <img src="../images/dog_avatar.jpg" alt="Max" class="vet-pet-avatar">
                                <div>
                                    <h4>Max</h4>
                                    <p class="text-muted">Labrador Retriever - 3 años</p>
                                    <p><strong>Propietario:</strong> Juan Pérez (DNI: 12345678)</p>
                                    <p><strong>ID Mascota:</strong> MV-001</p>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>
            </div>
            
            <!-- Pestañas de historial -->
            <div class="vet-card" style="margin-top: 20px;">
                <div class="vet-tabs" style="display: flex; border-bottom: 1px solid #eee;">
                    <button class="vet-tab active" data-tab="vacunacion">Vacunación</button>
                    <button class="vet-tab" data-tab="consultas">Consultas Médicas</button>
                    <button class="vet-tab" data-tab="examenes">Exámenes Médicos</button>
                </div>
                
                <!-- Contenido de pestañas -->
                <div class="vet-tab-content" id="vacunacion" style="display: block;">
                    <div class="vet-card-section">
                        <div class="vet-vaccine-grid">
                            <div class="vet-vaccine-category">
                                <h4>Vacunas Obligatorias</h4>
                                <div class="vet-vaccine-item">
                                    <div class="vet-checkbox">
                                        <input type="checkbox" checked disabled>
                                        <span class="vet-checkmark"></span>
                                        <span>Rabia</span>
                                    </div>
                                    <div class="vet-vaccine-details">
                                        <span>10/03/2024</span>
                                        <span>Próxima: 10/03/2025</span>
                                    </div>
                                </div>
                                <div class="vet-vaccine-item">
                                    <div class="vet-checkbox">
                                        <input type="checkbox" checked disabled>
                                        <span class="vet-checkmark"></span>
                                        <span>Moquillo</span>
                                    </div>
                                    <div class="vet-vaccine-details">
                                        <span>15/01/2025</span>
                                        <span>Próxima: 15/01/2026</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="vet-vaccine-category">
                                <h4>Vacunas Opcionales</h4>
                                <div class="vet-vaccine-item">
                                    <div class="vet-checkbox">
                                        <input type="checkbox" checked disabled>
                                        <span class="vet-checkmark"></span>
                                        <span>Leptospirosis</span>
                                    </div>
                                    <div class="vet-vaccine-details">
                                        <span>15/01/2025</span>
                                        <span>Próxima: 15/07/2025</span>
                                    </div>
                                </div>
                                <div class="vet-vaccine-item">
                                    <div class="vet-checkbox">
                                        <input type="checkbox">
                                        <span class="vet-checkmark"></span>
                                        <span>Bordetella</span>
                                    </div>
                                    <div class="vet-vaccine-details">
                                        <span class="vet-missing">Pendiente</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="vet-tab-content" id="consultas" style="display: none;">
                    <div class="vet-card-section">
                        <div class="vet-consultas-list">
                            <!-- Consulta 1 -->
                            <div class="vet-card" style="padding: 15px; margin-bottom: 15px;">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5>Consulta de rutina</h5>
                                        <p class="text-muted">15/04/2025 - Dr. Veterinario</p>
                                    </div>
                                    <button class="vet-btn-icon">
                                        <i class="fas fa-chevron-down"></i>
                                    </button>
                                </div>
                                <div class="consulta-detalle" style="margin-top: 10px; display: none;">
                                    <p><strong>Síntomas:</strong> Ninguno reportado (control preventivo)</p>
                                    <p><strong>Diagnóstico:</strong> Saludable, peso ideal</p>
                                    <p><strong>Tratamiento:</strong> Continuar con dieta actual</p>
                                    <p><strong>Exámenes solicitados:</strong> Hematología completa</p>
                                    <p><strong>Observaciones:</strong> Se recomienda ejercicio diario de 30 minutos</p>
                                </div>
                            </div>
                            
                            <!-- Consulta 2 -->
                            <div class="vet-card" style="padding: 15px;">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5>Revisión post-vacunación</h5>
                                        <p class="text-muted">10/03/2025 - Dr. Veterinario</p>
                                    </div>
                                    <button class="vet-btn-icon">
                                        <i class="fas fa-chevron-down"></i>
                                    </button>
                                </div>
                                <div class="consulta-detalle" style="margin-top: 10px; display: none;">
                                    <p><strong>Síntomas:</strong> Ligera inflamación en zona de inyección</p>
                                    <p><strong>Diagnóstico:</strong> Reacción normal a vacuna</p>
                                    <p><strong>Tratamiento:</strong> Aplicación de compresa fría</p>
                                    <p><strong>Exámenes solicitados:</strong> Ninguno</p>
                                    <p><strong>Observaciones:</strong> Reacción desapareció en 24 horas</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="vet-tab-content" id="examenes" style="display: none;">
                    <div class="vet-card-section">
                        <div class="vet-examenes-list">
                            <!-- Examen 1 -->
                            <div class="vet-card" style="padding: 15px; margin-bottom: 15px;">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5>Hematología completa</h5>
                                        <p class="text-muted">15/04/2025 - Asociado a Consulta #001</p>
                                    </div>
                                    <div>
                                        <a href="#" class="vet-btn-icon" title="Ver resultado">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="#" class="vet-btn-icon" title="Descargar">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    </div>
                                </div>
                                <div style="margin-top: 10px;">
                                    <p><strong>Resultados:</strong> Valores dentro de parámetros normales</p>
                                    <p><strong>Observaciones:</strong> Ligera elevación en glóbulos blancos, posiblemente por estrés</p>
                                </div>
                            </div>
                            
                            <!-- Examen 2 -->
                            <div class="vet-card" style="padding: 15px;">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5>Radiografía torácica</h5>
                                        <p class="text-muted">10/03/2024 - Asociado a Consulta #002</p>
                                    </div>
                                    <div>
                                        <a href="#" class="vet-btn-icon" title="Ver resultado">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="#" class="vet-btn-icon" title="Descargar">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    </div>
                                </div>
                                <div style="margin-top: 10px;">
                                    <p><strong>Resultados:</strong> No se observan anomalías</p>
                                    <p><strong>Observaciones:</strong> Estructura ósea y pulmonar normal</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Funcionalidad de pestañas
        const tabs = document.querySelectorAll('.vet-tab');
        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                // Remover clase active de todas las pestañas
                tabs.forEach(t => t.classList.remove('active'));
                // Añadir clase active a la pestaña clickeada
                tab.classList.add('active');
                
                // Ocultar todos los contenidos
                document.querySelectorAll('.vet-tab-content').forEach(content => {
                    content.style.display = 'none';
                });
                
                // Mostrar el contenido correspondiente
                const tabId = tab.getAttribute('data-tab');
                document.getElementById(tabId).style.display = 'block';
            });
        });
        
        // Funcionalidad para expandir detalles de consultas
        const toggleButtons = document.querySelectorAll('.vet-consultas-list .vet-btn-icon');
        toggleButtons.forEach(button => {
            button.addEventListener('click', () => {
                const detalle = button.closest('.vet-card').querySelector('.consulta-detalle');
                const icon = button.querySelector('i');
                
                if (detalle.style.display === 'none') {
                    detalle.style.display = 'block';
                    icon.classList.remove('fa-chevron-down');
                    icon.classList.add('fa-chevron-up');
                } else {
                    detalle.style.display = 'none';
                    icon.classList.remove('fa-chevron-up');
                    icon.classList.add('fa-chevron-down');
                }
            });
        });
    </script>
</body>
</html>