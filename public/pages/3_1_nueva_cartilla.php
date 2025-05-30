<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Cartilla de vacunación - Medical Vice</title>
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
                <li><a href="3_0_cartilla_vacunacion.php" class="active"><i class="fas fa-syringe"></i> Cartilla de Vacunación</a></li>
                <li><a href="4_0_consulta_medica.php"><i class="fas fa-stethoscope"></i> Consulta Médica</a></li>
                <li><a href="5_0_examenes_medicos.php"><i class="fas fa-microscope"></i> Exámenes Médicos</a></li>
                <li><a href="6_historial_medico.php"><i class="fas fa-file-medical"></i> Historial Médico</a></li>
            </ul>
            <a href="../pages/login.php" class="vet-logout"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a>
      </div>
  <div class="dividir-pantalla">
    <!-- Sección izquierda: Buscar por DNI -->
    <div class="vet-search-section">
      <h3><i class="fas fa-search"></i> Buscar mascotas</h3>
      <label for="dni">DNI del Propietario:</label>
      <input type="text" id="dni" class="vet-form-control" placeholder="Ingrese DNI"/>
      <button onclick="buscarMascotas()" class="vet-btn"><i class="fas fa-search"></i> Buscar</button>

      <div id="lista-mascotas">
        <!-- Resultado dinámico de mascotas -->
      </div>
    </div>

    <!-- Sección derecha: Formulario de vacunación -->
    <div class="vet-vaccine-form-section">
      <h3><i class="fas fa-syringe"></i> Nueva cartilla de vacunación</h3>
      <form id="form-vacunas">
        <div id="lista-vacunas">
          <!-- Vacunas con checkboxes y campos de fecha -->
        </div>
        <button type="submit" class="vet-btn"><i class="fas fa-save"></i> Guardar</button>
      </form>
    </div>
  </div>
  <script>
    const vacunas = [
      { nombre: "Parvovirus"},
      { nombre: "Coronavirus"},
      { nombre: "Distemper (Moquillo)"},
      { nombre: "Hepatitis Canina"},
      { nombre: "Parainfluenza"},
      { nombre: "Leptospira"},
      { nombre: "Tos de las perreras"},
      { nombre: "Rabia"},
      { nombre: "Leucemia Felina"},
      { nombre: "Rinotraqueitis"},
      { nombre: "Calicivirus"},
      { nombre: "Panleucopenia"}
    ];

    function crearFormularioVacunas() {
      const contenedor = document.getElementById("lista-vacunas");
      contenedor.innerHTML = "";
      
      // Encabezado de la tabla de vacunas
      contenedor.innerHTML += `
        <div class="vaccine-row" style="font-weight: bold; border-bottom: 2px solid #3498db;">
          <div>Vacuna</div>
          <div>Fecha de aplicación</div>
          <div>Próxima dosis</div>
        </div>
      `;
      
      vacunas.forEach((vacuna, index) => {
        const id = `vacuna_${index}`;
        contenedor.innerHTML += `
          <div class="vaccine-row">
            <label>
              <input type="checkbox" id="${id}" onchange="toggleFechas('${id}')"/>
              ${vacuna.nombre}
            </label>
            <input type="date" id="${id}_fecha" placeholder="Fecha de aplicación" disabled>
            <input type="date" id="${id}_proxima" placeholder="Próxima dosis" disabled>
          </div>
        `;
      });
    }

    function toggleFechas(id) {
      const checked = document.getElementById(id).checked;
      document.getElementById(`${id}_fecha`).disabled = !checked;
      document.getElementById(`${id}_proxima`).disabled = !checked;
      
      // Si se marca, establecer la fecha actual como predeterminada
      if (checked) {
        const today = new Date().toISOString().split('T')[0];
        document.getElementById(`${id}_fecha`).value = today;
        
        // Calcular próxima dosis (1 año después por defecto)
        const nextYear = new Date();
        nextYear.setFullYear(nextYear.getFullYear() + 1);
        document.getElementById(`${id}_proxima`).value = nextYear.toISOString().split('T')[0];
      } else {
        document.getElementById(`${id}_fecha`).value = "";
        document.getElementById(`${id}_proxima`).value = "";
      }
    }

    function buscarMascotas() {
  const dni = document.getElementById("dni").value;
  const lista = document.getElementById("lista-mascotas");

  const resultados = getMascotasPorPropietario(dni);
  
  lista.innerHTML = resultados && resultados.length
    ? resultados.map(nombre => `<div class="mascota-card" onclick="seleccionarMascota('${nombre}')">${nombre}</div>`).join("")
    : "<p>No se encontraron mascotas.</p>";
}

    
    function seleccionarMascota(nombre) {
      // Resaltar la mascota seleccionada
      document.querySelectorAll('.mascota-card').forEach(card => {
        card.style.backgroundColor = card.textContent === nombre ? '#e3f2fd' : '#f8f9fa';
      });
      
      // Aquí podrías cargar el historial de vacunas de la mascota seleccionada
      console.log(`Mascota seleccionada: ${nombre}`);
    }

    // Inicializar el formulario de vacunas al cargar
    crearFormularioVacunas();
    
    // Manejar el envío del formulario
    document.getElementById('form-vacunas').addEventListener('submit', function(e) {
      e.preventDefault();
      alert('Cartilla de vacunación guardada correctamente');
      // Aquí iría la lógica para guardar los datos
    });
  </script>
  <script src="funcionesconsultor.php"></script>
</div>
</body>
</html>