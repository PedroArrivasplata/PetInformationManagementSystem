<?php
require_once '../../app/helpers/tipo_usuario.php'; 
$tipos_usuario = obtenerTiposDeUsuario();
$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dni = $_POST['dni'] ?? '';
    $nombres = $_POST['nombres'] ?? '';
    $apellidos = $_POST['apellidos'] ?? '';
    $correo = $_POST['correo'] ?? '';
    $clave = $_POST['clave'] ?? '';
    $tipo_usuario_id = $_POST['tipo_usuario'] ?? '';
    $estado_logico_id = 1; // Suponemos siempre activo

    if ($dni && $nombres && $apellidos && $correo && $clave && $tipo_usuario_id) {
        $data = [
            'dni' => $dni,
            'nombres' => $nombres,
            'apellidos' => $apellidos,
            'correo' => $correo,
            'clave' => $clave,
            'tipo_usuario_id' => $tipo_usuario_id,
            'estado_logico_id' => $estado_logico_id
        ];

        $ch = curl_init('http://localhost/repo_Oficial/PetInformationManagementSystem/app/controllers/api_usuarios.php');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $respuesta = json_decode($response, true);

        if ($httpCode === 201) {
            $mensaje = '<div class="alert alert-success">Registro exitoso. Ya puedes <a href="login.php" class="alert-link">iniciar sesión</a>.</div>';
        } else {
            $mensaje = '<div class="alert alert-danger">Error: ' . htmlspecialchars($respuesta['error'] ?? 'Error desconocido') . '</div>';
        }
    } else {
        $mensaje = '<div class="alert alert-warning">Todos los campos son obligatorios.</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro de Usuario - Medical Vice</title>
  <link href="../styles_css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet">
  <link href="../styles_css/styles.css" rel="stylesheet" />
</head>
<body class="login-body">

  <div class="login-wrapper d-flex justify-content-center align-items-center">
    <main class="login-container animate__animated animate__fadeInDown mx-3">
      <div class="text-center mb-3">
        <i class="bi bi-person-plus-fill login-icon"></i>
      </div>
      <h1 class="text-center fs-2 fw-bold mb-2">Crear cuenta</h1>
      <h2 class="text-center fs-5 fw-semibold text-primary mb-4">Medical Vice</h2>

      <?php echo $mensaje; ?>

      <form method="post" class="mb-3">

        <!-- DNI -->
        <div class="input-group mb-3">
          <span class="input-group-text"><i class="bi bi-credit-card-2-front"></i></span>
          <input type="text" class="form-control" name="dni" placeholder="DNI" required />
        </div>

        <!-- Nombres -->
        <div class="input-group mb-3">
          <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
          <input type="text" class="form-control" name="nombres" placeholder="Nombres" required />
        </div>

        <!-- Apellidos -->
        <div class="input-group mb-3">
          <span class="input-group-text"><i class="bi bi-person-lines-fill"></i></span>
          <input type="text" class="form-control" name="apellidos" placeholder="Apellidos" required />
        </div>

        <!-- Correo -->
        <div class="input-group mb-3">
          <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
          <input type="email" class="form-control" name="correo" placeholder="Correo electrónico" required />
        </div>

        <!-- Contraseña -->
        <div class="input-group mb-3">
          <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
          <input type="password" class="form-control" name="clave" placeholder="Contraseña" required />
        </div>

        <!-- Tipo de Usuario (Desplegable) -->
        <div class="input-group mb-4">
          <span class="input-group-text"><i class="bi bi-person-badge-fill"></i></span>
          <select class="form-select" name="tipo_usuario" required>
            <option value="" disabled selected>Selecciona tipo de usuario</option>
            <?php foreach ($tipos_usuario as $tipo): ?>
              <option value="<?php echo htmlspecialchars($tipo['id_tipo_usuario']); ?>">
                <?php echo htmlspecialchars($tipo['nombre_usuario']); ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <!-- Botón registrar -->
        <button type="submit" class="btn login-btn w-100 fw-semibold shadow-sm mb-3">
          Registrar
        </button>
      </form>

      <!-- Enlace a login -->
      <div class="text-center">
        <span>¿Ya tienes cuenta?</span>
        <a href="login.php" class="text-decoration-none login-link fw-semibold">Inicia sesión</a>
      </div>
    </main>
  </div>

  <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>
