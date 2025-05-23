<?php
require 'funcionesbasicas.php';
function obtenerUsuarioPorCorreoYClave($correo, $clave) {
    $pdo = conectar();
    $sql = "SELECT u.nombres, u.apellidos, u.dni, u.celular, t.nombre_usuario, u.password
            FROM usuario u
            INNER JOIN tipo_usuario t ON u.tipo_usuario_id_tipo_usuario = t.id_tipo_usuario
            WHERE u.correo_electronico = :correo
            limit 1";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':correo', $correo);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$usuario) {
        // No se encontró el correo
        return ['estado' => 'correo_no_encontrado'];
    }

    // Verificamos contraseña (se asume en texto plano)
    if ($clave === ($usuario['password'] ?? '')) {
        // Eliminamos la contraseña antes de devolver
        unset($usuario['password']);
        $usuario['tipo_usuario'] = $usuario['nombre_usuario'];
        unset($usuario['nombre_usuario']);
        return ['estado' => 'ok', 'usuario' => $usuario];
    } else {
        return ['estado' => 'clave_incorrecta'];
    }
}




?>
