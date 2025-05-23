<?php
require 'funcionesconsultor.php';
$citas = getCitasProgramadas(); 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Vice - Gestión de Citas</title>
    <link rel="stylesheet" href="styles_local.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="vet-dashboard">
        <div class="vet-sidebar">
            <div class="vet-sidebar-header">
                <img src="happy_dog.png" alt="Medical Vice Logo">
                <h3>Medical Vice</h3>
                <p>Panel Consultor</p>
            </div>
            <ul class="vet-sidebar-nav">
                <li><a href="Inicio.html"><i class="fas fa-home"></i> Inicio</a></li>
                <li><a href="citas_consultor.php" class="active"><i class="fas fa-calendar-alt"></i> Citas</a></li>
                <li><a href="cartillas_consultor.php"><i class="fas fa-syringe"></i> Cartillas</a></li>
            </ul>
            <a href="#" class="vet-logout">
                <i class="fas fa-sign-out-alt"></i>
                Cerrar sesión
            </a>
        </div>
        <div class="vet-main-content scroll-sections">
            <div class="vet-header">
                <div>
                    <h1>Gestión de Citas</h1>
                    <p class="text-muted"><?= date('d/m/Y') ?></p>
                </div>
                <div class="vet-user-menu">
                    <button class="vet-btn" id="btn-filtrar">
                        <i class="fas fa-filter"></i> Filtrar
                    </button>
                </div>
            </div>
            <div class="vet-section" id="filtros-section" style="display:none;">
                <h3 class="vet-section-title"><i class="fas fa-filter"></i> Filtros Avanzados</h3>
                <form method="GET" action="citas_consultor.php">
                    <div class="vet-filters">
                        <input type="date" name="fecha" class="vet-select">
                        <input type="text" name="nombre_mascota" placeholder="Nombre mascota" class="vet-select">
                        <input type="text" name="dni_propietario" placeholder="DNI propietario" class="vet-select">
                        <button type="submit" class="vet-btn">Aplicar</button>
                    </div>
                </form>
            </div>
            <div class="vet-section">
                <h3 class="vet-section-title"><i class="fas fa-list"></i> Citas Programadas</h3>
                <div class="vet-appointments">
                    <?php foreach ($citas as $cita): ?>
                    <div class="vet-appointment <?= strtolower($cita['estado_cita']) ?>">
                        <div class="vet-appointment-time">
                            <?= date('H:i', strtotime($cita['hora_cita'])) ?>
                        </div>
                        <div>
                            <span class="vet-appointment-pet"><?= $cita['nombre_mascota'] ?></span>
                            <span class="vet-appointment-owner"><?= $cita['nombre_propietario'] ?></span>
                        </div>
                        <div>
                            <span class="vet-appointment-type"><?= $cita['motivo'] ?></span>
                        </div>
                        <div class="vet-appointment-actions">
                            <a href="#" class="vet-btn vet-btn-sm">Ver</a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('btn-filtrar').addEventListener('click', function() {
            const filtros = document.getElementById('filtros-section');
            filtros.style.display = filtros.style.display === 'none' ? 'block' : 'none';
        });
    </script>
</body>
</html>