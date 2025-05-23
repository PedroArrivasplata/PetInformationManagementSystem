<?php
require 'funcionesconsultor.php';
$mascotas = [];
// En producción usarías: $mascotas = getMascotasConCartillas();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Vice - Gestión de Cartillas</title>
    <link rel="stylesheet" href="styles_local.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .vacuna-item {
            border-left: 3px solid var(--primary);
            padding-left: 10px;
            margin-bottom: 10px;
        }
        .vacuna-item.alert {
            border-left-color: var(--accent);
        }
        .vacuna-fecha {
            font-weight: bold;
            color: var(--primary);
        }
    </style>
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
                <li><a href="citas_consultor.php"><i class="fas fa-calendar-alt"></i> Citas</a></li>
                <li><a href="cartillas_consultor.php" class="active"><i class="fas fa-syringe"></i> Cartillas</a></li>
            </ul>
            <a href="#" class="vet-logout">
                <i class="fas fa-sign-out-alt"></i>
                Cerrar sesión
            </a>
        </div>
        <div class="vet-main-content scroll-sections">
            <div class="vet-header">
                <div>
                    <h1>Cartillas de Vacunación</h1>
                    <p class="text-muted">Control de inmunización</p>
                </div>
                <div class="vet-user-menu">
                    <input type="text" id="buscar-mascota" placeholder="Buscar mascota..." class="vet-search">
                    <button class="vet-btn" id="btn-nueva-cartilla">
                        <i class="fas fa-plus"></i> Nueva Cartilla
                    </button>
                </div>
            </div>
            <div class="vet-section">
                <h3 class="vet-section-title"><i class="fas fa-syringe"></i> Cartillas Registradas</h3>
                
                <?php foreach ($mascotas as $mascota): 
                    $cartilla = consultarCartilla($mascota['idMascota']);
                    if (!$cartilla['success']) continue;
                ?>
                <div class="vet-card">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h3 class="m-0"><?= $cartilla['cartilla']['nombre_mascota'] ?></h3>
                            <p class="text-muted">Propietario: <?= $cartilla['cartilla']['propietario'] ?></p>
                        </div>
                        <div class="vet-card-icon">
                            <i class="fas fa-paw"></i>
                        </div>
                    </div>
                    
                    <div class="vet-card-content">
                        <h4>Vacunas aplicadas:</h4>
                        <?php if (empty($cartilla['vacunas'])): ?>
                            <p>No hay vacunas registradas</p>
                        <?php else: ?>
                            <?php foreach ($cartilla['vacunas'] as $vacuna): ?>
                            <div class="vacuna-item">
                                <p class="vacuna-fecha">
                                    <?= date('d/m/Y', strtotime($vacuna['fecha_administracion'])) ?>
                                    - <?= $vacuna['nombre_comercial'] ?>
                                </p>
                                <p>Próxima dosis: <?= date('d/m/Y', strtotime($vacuna['fecha_proxima_dosis'])) ?></p>
                                <p>Aplicada por: <?= $vacuna['aplicado_por'] ?></p>
                            </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    
                    <div class="vet-card-footer">
                        <a href="#" class="vet-btn vet-btn-outline">
                            <i class="fas fa-print"></i> Imprimir
                        </a>
                        <a href="editar_cartilla.php?id=<?= $mascota['idMascota'] ?>" class="vet-btn">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div id="modal-nueva-cartilla" class="vet-modal">
        <div class="vet-modal-content">
            <span class="vet-modal-close">&times;</span>
            <h3><i class="fas fa-plus-circle"></i> Crear Nueva Cartilla</h3>
            <div class="vet-modal-body">
                <form id="form-nueva-cartilla">
                    <div class="vet-form-group">
                        <label>Seleccionar Mascota:</label>
                        <select class="vet-select" name="id_mascota" required>
                            <option value="">-- Seleccione --</option>
                        </select>
                    </div>
                    <button type="submit" class="vet-btn">Crear Cartilla</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('btn-nueva-cartilla').addEventListener('click', function() {
            document.getElementById('modal-nueva-cartilla').style.display = 'block';
        });
        
        document.querySelector('.vet-modal-close').addEventListener('click', function() {
            document.getElementById('modal-nueva-cartilla').style.display = 'none';
        });
        document.getElementById('buscar-mascota').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            document.querySelectorAll('.vet-card').forEach(card => {
                const text = card.textContent.toLowerCase();
                card.style.display = text.includes(searchTerm) ? 'block' : 'none';
            });
        });
    </script>
</body>
</html>