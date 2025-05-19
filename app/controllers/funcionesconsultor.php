<?php
  function conectar(){
        $dsn = "mysql:host=localhost;dbname=veterinariabd;charset=utf8";
        $usuario = "root";
        $clave = "";
        try {
            $pdo= new PDO($dsn, $usuario, $clave);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        }catch(PDOException $e) {
            die("Error al conectar :".$e->getMessage());
        }
    }

//-- CONSULTAR CITAS PROGRAMADAS --//
    // Consultar todas las citas programadas (para el consultor)
    function getCitasProgramadas() {
        $pdo = conectar();
        $sql = "SELECT c.idCita, c.fecha_cita, c.hora_cita, c.motivo, 
                m.Nombre as nombre_mascota, 
                CONCAT(p.nombre, ' ', p.Apellido) as nombre_propietario,
                ec.estado_cita
                FROM Cita c
                JOIN Mascota m ON c.Mascota_idMascota = m.idMascota
                JOIN propietario_mascota p ON m.ID_propietario = p.ID_propietario
                JOIN Estado_cita ec ON c.Estado_cita_idEstado_cita = ec.idEstado_cita
                ORDER BY c.fecha_cita DESC, c.hora_cita DESC";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Consultar citas con filtros
    function getCitasFiltradas($filtros = []) {
        $pdo = conectar();
        $sql = "SELECT c.idCita, c.fecha_cita, c.hora_cita, c.motivo, 
                m.Nombre as nombre_mascota, 
                CONCAT(p.nombre, ' ', p.Apellido) as nombre_propietario,
                ec.estado_cita
                FROM Cita c
                JOIN Mascota m ON c.Mascota_idMascota = m.idMascota
                JOIN propietario_mascota p ON m.ID_propietario = p.ID_propietario
                JOIN Estado_cita ec ON c.Estado_cita_idEstado_cita = ec.idEstado_cita
                WHERE 1=1";
        
        $params = [];
        
        // Filtro por fecha
        if (!empty($filtros['fecha'])) {
            $sql .= " AND c.fecha_cita = :fecha";
            $params[':fecha'] = $filtros['fecha'];
        }
        
        // Filtro por nombre de mascota
        if (!empty($filtros['nombre_mascota'])) {
            $sql .= " AND m.Nombre LIKE :nombre_mascota";
            $params[':nombre_mascota'] = '%' . $filtros['nombre_mascota'] . '%';
        }
        
        // Filtro por DNI del propietario
        if (!empty($filtros['dni_propietario'])) {
            $sql .= " AND p.DNI = :dni_propietario";
            $params[':dni_propietario'] = $filtros['dni_propietario'];
        }
        
        $sql .= " ORDER BY c.fecha_cita DESC, c.hora_cita DESC";
        
        $stmt = $pdo->prepare($sql);
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
// Obtener cartilla de vacunación por mascota
    function getCartillaVacunacion($idMascota) {
        $pdo = conectar();
        $sql = "SELECT v.idVacunas, v.Nombre_comercial, 
                rv.Fecha_administración, rv.fecha_proxima_dosis,
                CONCAT(u.Nombres, ' ', u.Apellidos) as nombre_veterinario
                FROM Registro_Vacuna rv
                JOIN Vacunas v ON rv.Vacunas_idVacunas = v.idVacunas
                JOIN Usuario u ON rv.Usuario_idUsuario = u.DNI
                WHERE rv.Cartilla_vacunacion_idCartilla_vacunacion = 
                (SELECT Cartilla_vacunacion_idCartilla_vacunacion FROM Mascota WHERE idMascota = :idMascota)
                ORDER BY rv.Fecha_administración DESC";
        
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":idMascota", $idMascota, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

// Obtener mascotas por propietario (para filtros)
    function getMascotasPorPropietario($dniPropietario) {
        $pdo = conectar();
        $sql = "SELECT m.idMascota, m.Nombre 
                FROM Mascota m
                JOIN propietario_mascota p ON m.ID_propietario = p.ID_propietario
                WHERE p.DNI = :dniPropietario";
        
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":dniPropietario", $dniPropietario, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

// CREAR NUEVA CARTILLA
    function crearCartilla($idMascota, $idConsultor) {
        $pdo = conectar();
        
        try {
            $pdo->beginTransaction();
            
            // 1. Verificar si la mascota ya tiene cartilla
            $sqlCheck = "SELECT Cartilla_vacunacion_idCartilla_vacunacion 
                        FROM Mascota 
                        WHERE idMascota = :id_mascota";
            $stmtCheck = $pdo->prepare($sqlCheck);
            $stmtCheck->bindValue(":id_mascota", $idMascota, PDO::PARAM_INT);
            $stmtCheck->execute();
            
            if ($stmtCheck->fetch()) {
                throw new Exception("La mascota ya tiene una cartilla asignada");
            }
            
            // 2. Crear la cartilla
            $sqlInsert = "INSERT INTO Cartilla_vacunacion (fecha_creacion) 
                        VALUES (NOW())";
            $stmtInsert = $pdo->prepare($sqlInsert);
            
            if (!$stmtInsert->execute()) {
                throw new Exception("Error al crear cartilla");
            }
            
            $idCartilla = $pdo->lastInsertId();
            
            // 3. Asignar a la mascota
            $sqlUpdate = "UPDATE Mascota 
                        SET Cartilla_vacunacion_idCartilla_vacunacion = :id_cartilla 
                        WHERE idMascota = :id_mascota";
            $stmtUpdate = $pdo->prepare($sqlUpdate);
            $stmtUpdate->bindValue(":id_cartilla", $idCartilla, PDO::PARAM_INT);
            $stmtUpdate->bindValue(":id_mascota", $idMascota, PDO::PARAM_INT);
            
            if (!$stmtUpdate->execute()) {
                throw new Exception("Error al asignar cartilla a mascota");
            }
        } catch (Exception $e) {
            $pdo->rollBack();
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    // CONSULTAR CARTILLA COMPLETA (CON VACUNAS)
    function consultarCartilla($idMascota) {
        $pdo = conectar();
        
        try {
            // 1. Obtener información básica de la cartilla
            $sqlCartilla = "SELECT cv.idCartilla_vacunacion, cv.fecha_creacion,
                        m.Nombre as nombre_mascota, 
                        CONCAT(p.nombre, ' ', p.Apellido) as propietario
                        FROM Cartilla_vacunacion cv
                        JOIN Mascota m ON cv.idCartilla_vacunacion = m.Cartilla_vacunacion_idCartilla_vacunacion
                        JOIN propietario_mascota p ON m.ID_propietario = p.ID_propietario
                        WHERE m.idMascota = :id_mascota";
            
            $stmtCartilla = $pdo->prepare($sqlCartilla);
            $stmtCartilla->bindValue(":id_mascota", $idMascota, PDO::PARAM_INT);
            $stmtCartilla->execute();
            
            $cartilla = $stmtCartilla->fetch(PDO::FETCH_ASSOC);
            
            if (!$cartilla) {
                return [
                    'success' => false,
                    'message' => 'No se encontró cartilla para esta mascota'
                ];
            }
            
            // 2. Obtener todas las vacunas asociadas
            $sqlVacunas = "SELECT rv.idRegistro_Vacuna, v.Nombre_comercial, 
                        rv.Fecha_administración, rv.fecha_proxima_dosis,
                        CONCAT(u.Nombres, ' ', u.Apellidos) as aplicado_por
                        FROM Registro_Vacuna rv
                        JOIN Vacunas v ON rv.Vacunas_idVacunas = v.idVacunas
                        JOIN Usuario u ON rv.Usuario_idUsuario = u.DNI
                        WHERE rv.Cartilla_vacunacion_idCartilla_vacunacion = :id_cartilla
                        ORDER BY rv.Fecha_administración DESC";
            
            $stmtVacunas = $pdo->prepare($sqlVacunas);
            $stmtVacunas->bindValue(":id_cartilla", $cartilla['idCartilla_vacunacion'], PDO::PARAM_INT);
            $stmtVacunas->execute();
            
            $vacunas = $stmtVacunas->fetchAll(PDO::FETCH_ASSOC);
            
            return [
                'success' => true,
                'cartilla' => $cartilla,
                'vacunas' => $vacunas
            ];
            
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    // ELIMINAR CARTILLA (Y SUS REGISTROS DE VACUNAS)
    function eliminarCartilla($idCartilla) {
        $pdo = conectar();
        
        try {
            $pdo->beginTransaction();
            
            // 1. Verificar que no esté asignada a una mascota
            $sqlCheck = "SELECT idMascota FROM Mascota 
                        WHERE Cartilla_vacunacion_idCartilla_vacunacion = :id_cartilla";
            $stmtCheck = $pdo->prepare($sqlCheck);
            $stmtCheck->bindValue(":id_cartilla", $idCartilla, PDO::PARAM_INT);
            $stmtCheck->execute();
            
            if ($stmtCheck->rowCount() > 0) {
                throw new Exception("No se puede eliminar: la cartilla está asignada a una mascota");
            }
            
            // 2. Eliminar registros de vacunas primero
            $sqlDeleteVacunas = "DELETE FROM Registro_Vacuna 
                                WHERE Cartilla_vacunacion_idCartilla_vacunacion = :id_cartilla";
            $stmtDeleteVacunas = $pdo->prepare($sqlDeleteVacunas);
            $stmtDeleteVacunas->bindValue(":id_cartilla", $idCartilla, PDO::PARAM_INT);
            
            if (!$stmtDeleteVacunas->execute()) {
                throw new Exception("Error al eliminar registros de vacunas");
            }
            
            // 3. Eliminar la cartilla
            $sqlDeleteCartilla = "DELETE FROM Cartilla_vacunacion 
                                WHERE idCartilla_vacunacion = :id_cartilla";
            $stmtDeleteCartilla = $pdo->prepare($sqlDeleteCartilla);
            $stmtDeleteCartilla->bindValue(":id_cartilla", $idCartilla, PDO::PARAM_INT);
            
            if (!$stmtDeleteCartilla->execute()) {
                throw new Exception("Error al eliminar cartilla");
            }
            
            $pdo->commit();
            return [
                'success' => true,
                'message' => 'Cartilla y registros asociados eliminados correctamente'
            ];
            
        } catch (Exception $e) {
            $pdo->rollBack();
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }
?>