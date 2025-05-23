<?php
$mensaje = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = $_POST['username'] ?? '';
    $clave = $_POST['password'] ?? '';

    if (!empty($correo) && !empty($clave)) {
        $ch = curl_init('http://localhost/repo_Oficial/PetInformationManagementSystem/app/controllers/api_login.php'); // Ajusta esta URL según tu entorno
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['correo' => $correo, 'clave' => $clave]));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode === 200) {
            $usuario = json_decode($response, true);
            $usuario= $usuario["usuario"];
            // Redirección según tipo de usuario
            if ($usuario['tipo_usuario'] === 'recepcionista') {
                header('Location: ../pages/oficial.html');
                exit;
            } elseif ($usuario['tipo_usuario'] === 'veterinario') {
                header('Location: ../pages/1_inicio.php');
                exit;
            } else {
                header('Location: ../pages/oficial.php');
                exit;
            }
        } else {
            $resp = json_decode($response, true);
            $mensaje = $resp['error'] ?? 'usuario o contraseña incorrectos';
        }
    } else {
        $mensaje = 'Debe ingresar usuario y contraseña.';
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Iniciar Sesión - Medical Vice</title>
  
  <img rel="icon" href="../images/user_icon.png" />
  
  <!-- Bootstrap CSS -->
  <link href="../styles_css/bootstrap.min.css" rel="stylesheet" />
  
  <!-- Bootstrap Icons-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet"> 
  
  <!-- Animate.css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/> 
  
  <!-- Custom Styles -->
  <link rel="stylesheet" href="../styles_css/styles.css" />
</head>

<body class="login-body">
  <?php if (!empty($mensaje)): ?>
  <div class="container mt-4">
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <?php echo htmlspecialchars($mensaje); ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
    </div>
  </div>
<?php endif; ?>
  <!-- Video de fondo -->
  <video autoplay muted loop id="background-video">
    <source src="../images/happy_dog.png" type="img">
  </video>

  <div class="login-wrapper d-flex justify-content-center align-items-center">
    <!-- Imagen izquierda (solo en pantallas medianas y grandes) -->
    <div class="d-none d-md-block">
      <img src="../images/happy_dog.png" alt="perrito" class="mascota-img-side" />
    </div>

    <!-- Formulario de inicio de sesión -->
    <main class="login-container animate__animated animate__fadeInDown mx-3">
      <div class="text-center mb-3">
        <i class="bi bi-person-circle login-icon"></i>
      </div>
      <h1 class="text-center fs-2 fw-bold mb-2">Bienvenidos</h1>
      <h2 class="text-center fs-4 fw-bold mb-4 text-primary">a Medical Vice</h2>
      
      <form method="post" action="">
        <!-- Campo de usuario --> 
        <div class="input-group mb-3">
          <span class="input-group-text login-input-icon">
            <i class="bi bi-person-fill"></i>
          </span>
          <input type="text" class="form-control" placeholder="Ingresa tu usuario" name="username" required />
        </div>

        <!-- Campo de contraseña -->
        <div class="input-group mb-3">
          <span class="input-group-text login-input-icon">
            <i class="bi bi-lock-fill"></i>
          </span>
          <input type="password" class="form-control" placeholder="Ingresa tu contraseña" name="password" required />
        </div>

        <!-- Botón de inicio de sesión -->
        <button type="submit" class="btn login-btn w-100 fw-semibold shadow-sm mb-3">Iniciar Sesión</button>
      </form>
      <p class="text-center">
        ¿No tienes cuenta? <a href="../pages/registrar_nuevo_usuario.php" class="text-primary">Regístrate aquí</a>

    </main>

    <!-- Imagen derecha (solo en pantallas medianas y grandes) -->
    <div class="d-none d-md-block">
      <img src="../images/happy_cat.png" alt="gatito" class="mascota-img-side" />
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>
