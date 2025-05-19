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
//-- FUNCIONES PARA EL CASO DE USO --//
//-- FUNCION DE GESTIONAR CONSULTA --//
    function insertConsulta($diagnostico, $sintomas, $observaciones, $tratamiento, $Consultacol, $tipo_consulta_idtipo_consulta, $Cita_idCita) {
        $pdo = conectar();
        $sql = "INSERT INTO Consulta (diagnostico, sintomas, observaciones, tratamiento, Consultacol, tipo_consulta_idtipo_consulta, Cita_idCita)
                VALUES (:diagnostico, :sintomas, :observaciones, :tratamiento, :Consultacol, :tipo_consulta_idtipo_consulta, :Cita_idCita)";
        
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":diagnostico", $diagnostico, PDO::PARAM_STR);
        $stmt->bindValue(":sintomas", $sintomas, PDO::PARAM_STR);
        $stmt->bindValue(":observaciones", $observaciones, PDO::PARAM_STR);
        $stmt->bindValue(":tratamiento", $tratamiento, PDO::PARAM_STR);
        $stmt->bindValue(":Consultacol", $Consultacol, PDO::PARAM_STR);
        $stmt->bindValue(":tipo_consulta_idtipo_consulta", $tipo_consulta_idtipo_consulta, PDO::PARAM_INT);
        $stmt->bindValue(":Cita_idCita", $Cita_idCita, PDO::PARAM_INT);
        
        $stmt->execute();
        return $pdo->lastInsertId();
    }
//--MODIFICAR CONSULTA --//
    function updateConsulta($idConsulta, $diagnostico, $sintomas, $observaciones, $tratamiento, $tipo_consulta_idtipo_consulta) {
        $pdo = conectar();
        $sql = "UPDATE Consulta SET 
                diagnostico = :diagnostico,
                sintomas = :sintomas,
                observaciones = :observaciones,
                tratamiento = :tratamiento,
                tipo_consulta_idtipo_consulta = :tipo_consulta_idtipo_consulta
                WHERE idConsulta = :idConsulta";
        
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":diagnostico", $diagnostico, PDO::PARAM_STR);
        $stmt->bindValue(":sintomas", $sintomas, PDO::PARAM_STR);
        $stmt->bindValue(":observaciones", $observaciones, PDO::PARAM_STR);
        $stmt->bindValue(":tratamiento", $tratamiento, PDO::PARAM_STR);
        $stmt->bindValue(":tipo_consulta_idtipo_consulta", $tipo_consulta_idtipo_consulta, PDO::PARAM_INT);
        $stmt->bindValue(":idConsulta", $idConsulta, PDO::PARAM_INT);
        
        return $stmt->execute();
    }
//-- ELIMINAR CONSULTA --//
    function deleteConsulta($idConsulta) {
        $pdo = conectar();
        $sql = "DELETE FROM Consulta WHERE idConsulta = :idConsulta";
        
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":idConsulta", $idConsulta, PDO::PARAM_INT);
        
        return $stmt->execute();
    }
//-- GESTIONAR DETALLE DE LOS EXAMENES --//
// INSERTAR  DetalleExamen
    function insertDetalleExamen($examen_generado, $formato, $fecha, $tipo_examen_medico_idtipo_examen_medico, $Consulta_idConsulta) {
        $pdo = conectar();
        $sql = "INSERT INTO detalle_examen_consulta (examen_generado, formato, fecha, tipo_examen_medico_idtipo_examen_medico, Consulta_idConsulta)
                VALUES (:examen_generado, :formato, :fecha, :tipo_examen_medico_idtipo_examen_medico, :Consulta_idConsulta)";
        
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":examen_generado", $examen_generado, PDO::PARAM_STR);
        $stmt->bindValue(":formato", $formato, PDO::PARAM_STR);
        $stmt->bindValue(":fecha", $fecha);
        $stmt->bindValue(":tipo_examen_medico_idtipo_examen_medico", $tipo_examen_medico_idtipo_examen_medico, PDO::PARAM_INT);
        $stmt->bindValue(":Consulta_idConsulta", $Consulta_idConsulta, PDO::PARAM_INT);
        
        return $stmt->execute();
    }

// MODIFICAR DetalleExamen
    function updateDetalleExamen($iddetalle_examen_consulta, $examen_generado, $formato) {
        $pdo = conectar();
        $sql = "UPDATE detalle_examen_consulta SET 
                examen_generado = :examen_generado,
                formato = :formato
                WHERE iddetalle_examen_consulta = :iddetalle_examen_consulta";
        
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":examen_generado", $examen_generado, PDO::PARAM_STR);
        $stmt->bindValue(":formato", $formato, PDO::PARAM_STR);
        $stmt->bindValue(":iddetalle_examen_consulta", $iddetalle_examen_consulta, PDO::PARAM_INT);
        
        return $stmt->execute();
    }

// ELIMINAR DetalleExamen
    function deleteDetalleExamen($iddetalle_examen_consulta) {
        $pdo = conectar();
        $sql = "DELETE FROM detalle_examen_consulta WHERE iddetalle_examen_consulta = :iddetalle_examen_consulta";
        
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":iddetalle_examen_consulta", $iddetalle_examen_consulta, PDO::PARAM_INT);
        
        return $stmt->execute();
    }
//-- COMSULTAR HISTORIAL MEDICO DE LA MASCOTA --//
    function getHistorialMedicoCompleto($filtros = []) {
        $pdo = conectar();
        
        // Consulta base
        $sql = "SELECT 
                m.idMascota, m.Nombre as nombre_mascota,
                p.DNI as dni_propietario, CONCAT(p.nombre, ' ', p.Apellido) as nombre_propietario,
                c.fecha_cita, 
                co.idConsulta, co.diagnostico, co.sintomas, co.observaciones, co.tratamiento,
                tc.tipoc_onsulta as tipo_consulta,
                CONCAT(u.Nombres, ' ', u.Apellidos) as nombre_veterinario,
                cv.idCartilla_vacunacion,
                GROUP_CONCAT(DISTINCT v.Nombre_comercial SEPARATOR ', ') as vacunas_aplicadas,
                GROUP_CONCAT(DISTINCT tem.categoria_examen SEPARATOR ', ') as examenes_realizados
                FROM Mascota m
                JOIN propietario_mascota p ON m.ID_propietario = p.ID_propietario
                JOIN Cita c ON m.idMascota = c.Mascota_idMascota
                JOIN Consulta co ON c.idCita = co.Cita_idCita
                JOIN tipo_consulta tc ON co.tipo_consulta_idtipo_consulta = tc.idtipo_consulta
                JOIN Usuario u ON c.Usuario_Dni = u.DNI
                JOIN Cartilla_vacunacion cv ON m.Cartilla_vacunacion_idCartilla_vacunacion = cv.idCartilla_vacunacion
                LEFT JOIN Registro_Vacuna rv ON cv.idCartilla_vacunacion = rv.Cartilla_vacunacion_idCartilla_vacunacion
                LEFT JOIN Vacunas v ON rv.Vacunas_idVacunas = v.idVacunas
                LEFT JOIN detalle_examen_consulta dec ON co.idConsulta = dec.Consulta_idConsulta
                LEFT JOIN tipo_examen_medico tem ON dec.tipo_examen_medico_idtipo_examen_medico = tem.idtipo_examen_medico
                WHERE 1=1";
        
        // Aplicar filtros
        $params = [];
        
        if (!empty($filtros['nombre_mascota'])) {
            $sql .= " AND m.Nombre LIKE :nombre_mascota";
            $params[':nombre_mascota'] = '%' . $filtros['nombre_mascota'] . '%';
        }
        
        if (!empty($filtros['dni_propietario'])) {
            $sql .= " AND p.DNI = :dni_propietario";
            $params[':dni_propietario'] = $filtros['dni_propietario'];
        }
        
        if (!empty($filtros['fecha_desde'])) {
            $sql .= " AND c.fecha_cita >= :fecha_desde";
            $params[':fecha_desde'] = $filtros['fecha_desde'];
        }
        
        if (!empty($filtros['fecha_hasta'])) {
            $sql .= " AND c.fecha_cita <= :fecha_hasta";
            $params[':fecha_hasta'] = $filtros['fecha_hasta'];
        }
        
        if (!empty($filtros['tipo_consulta'])) {
            $sql .= " AND tc.idtipo_consulta = :tipo_consulta";
            $params[':tipo_consulta'] = $filtros['tipo_consulta'];
        }
        
        if (!empty($filtros['idMascota'])) {
            $sql .= " AND m.idMascota = :idMascota";
            $params[':idMascota'] = $filtros['idMascota'];
        }
        
        $sql .= " GROUP BY co.idConsulta ORDER BY c.fecha_cita DESC";
        
        $stmt = $pdo->prepare($sql);
        
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
?>