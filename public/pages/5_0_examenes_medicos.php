<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Vice - Exámenes Médicos</title>
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
                <li><a href="5_0_examenes_medicos.php" class="active"><i class="fas fa-microscope"></i> Exámenes Médicos</a></li>
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
                    <h1>Exámenes Médicos</h1>
                    <p class="text-muted">Gestiona los exámenes médicos de tus pacientes</p>
                </div>

            </div>
            
            <!-- Sección de búsqueda de mascota -->
            <div class="vet-card">
                <div class="vet-card-header">
                    <h3><i class="fas fa-search"></i> Buscar Mascota</h3>
                </div>
                <div class="vet-form-group">
                    <label for="busqueda-mascota">Nombre o ID de la mascota:</label>
                    <div class="vet-input-group">
                        <input type="text" id="busqueda-mascota" class="vet-form-control" placeholder="Ej: Max o MV-001">
                        <button class="vet-btn">
                            <i class="fas fa-search"></i> Buscar
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Lista de mascotas recientes -->
            <div class="vet-card" style="margin-top: 20px;">
                <div class="vet-card-header">
                    <h3><i class="fas fa-paw"></i> Mascotas Recientes</h3>
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
                                    <p>ID: MV-001</p>
                                </div>
                            </div>
                        </label>
                    </div>
                    
                    <div class="vet-pet-item">
                        <label>
                            <input type="radio" name="paciente">
                            <div class="d-flex align-items-center">
                                <img src="../images/cat_avatar.jpg" alt="Luna" class="vet-pet-avatar">
                                <div>
                                    <h4>Luna</h4>
                                    <p class="text-muted">Siamés - 2 años</p>
                                    <p>ID: MV-002</p>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>
            </div>
            
            <!-- Formulario de gestión de exámenes médicos -->
            <div class="vet-card" style="margin-top: 20px;">
                <div class="vet-card-header">
                    <h3><i class="fas fa-microscope"></i> Gestión de Exámenes Médicos</h3>
                </div>
                
                <div class="vet-card-section">
                    <h4>Información del Examen</h4>
                    <form id="form-examen">
                        <div class="vet-form-row">
                            <div class="vet-form-group">
                                <label for="tipo-examen">Tipo de Examen *</label>
                                <select id="tipo-examen" class="vet-form-control" required>
                                    <option value="">Seleccione un tipo</option>
                                    <option value="hematologia">Hematología completa</option>
                                    <option value="bioquimico">Perfil bioquímico</option>
                                    <option value="orina">Análisis de orina</option>
                                    <option value="heces">Análisis de heces</option>
                                    <option value="radiografia">Radiografía</option>
                                    <option value="ecografia">Ecografía</option>
                                    <option value="otros">Otros</option>
                                </select>
                            </div>
                            <div class="vet-form-group">
                                <label for="fecha-examen">Fecha del Examen *</label>
                                <input type="date" id="fecha-examen" class="vet-form-control" required>
                            </div>
                        </div>
                        
                        <div class="vet-form-row">
                            <div class="vet-form-group">
                                <label for="consulta-relacionada">Consulta Relacionada</label>
                                <select id="consulta-relacionada" class="vet-form-control">
                                    <option value="">Seleccione una consulta</option>
                                    <option value="consulta-001">Consulta #001 - 15/04/2025 (Control rutinario)</option>
                                    <option value="consulta-002">Consulta #002 - 10/03/2025 (Vacunación anual)</option>
                                </select>
                            </div>
                            <div class="vet-form-group">
                                <label for="estado-examen">Estado del Examen</label>
                                <select id="estado-examen" class="vet-form-control">
                                    <option value="pendiente">Pendiente</option>
                                    <option value="completado" selected>Completado</option>
                                    <option value="cancelado">Cancelado</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="vet-form-group">
                            <label for="resultado-examen">Resultado del Examen (Archivo) *</label>
                            <input type="file" id="resultado-examen" class="vet-form-control" accept=".pdf,.jpg,.jpeg,.png" required>
                            <small class="text-muted">Formatos aceptados: PDF, JPG, PNG (Tamaño máximo: 5MB)</small>
                        </div>
                        
                        <div class="vet-form-group">
                            <label for="observaciones">Observaciones</label>
                            <textarea id="observaciones" class="vet-form-control" rows="3"></textarea>
                        </div>
                        
                        <div class="vet-form-actions">
                            <button type="button" class="vet-btn secondary">
                                <i class="fas fa-times"></i> Cancelar
                            </button>
                            <button type="submit" class="vet-btn">
                                <i class="fas fa-save"></i> Guardar Examen
                            </button>
                        </div>
                    </form>
                </div>
                
                <!-- Lista de exámenes existentes -->
                <div class="vet-card-section">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>Exámenes Registrados</h4>
                        <div class="vet-input-group" style="width: auto;">
                            <input type="text" class="vet-form-control" placeholder="Filtrar exámenes..." style="width: 200px;">
                            <button class="vet-btn">
                                <i class="fas fa-filter"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="vet-examenes-list" style="margin-top: 15px;">
                        <!-- Examen 1 -->
                        <div class="vet-card" style="padding: 15px; margin-bottom: 15px;">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5>Hematología completa</h5>
                                    <p class="text-muted">Realizado el 15/04/2025 - Consulta #001</p>
                                    <p><strong>Estado:</strong> <span class="vet-chip">Completado</span></p>
                                </div>
                                <div>
                                    <a href="#" class="vet-btn-icon" title="Ver resultado">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="#" class="vet-btn-icon" title="Descargar">
                                        <i class="fas fa-download"></i>
                                    </a>
                                    <a href="5_1_modificar.php" class="vet-btn-icon" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#" class="vet-btn-icon" style="color: #e74c3c;" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Examen 2 -->
                        <div class="vet-card" style="padding: 15px;">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5>Radiografía torácica</h5>
                                    <p class="text-muted">Realizado el 10/03/2025 - Consulta #002</p>
                                    <p><strong>Estado:</strong> <span class="vet-chip">Completado</span></p>
                                </div>
                                <div>
                                    <a href="#" class="vet-btn-icon" title="Ver resultado">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="#" class="vet-btn-icon" title="Descargar">
                                        <i class="fas fa-download"></i>
                                    </a>
                                    <a href="5_1_modificar.php" class="vet-btn-icon" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#" class="vet-btn-icon" style="color: #e74c3c;" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>