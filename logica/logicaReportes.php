<?php
include 'conexionDB.php'; 

// Procesar las fechas
if (isset($_POST['desdeF']) && isset($_POST['hastaF']) && isset($_POST['nombre'])) {
    $desdeF = $_POST['desdeF'];
    $hastaF = $_POST['hastaF'];
    $nombre = $_POST['nombre'];

    // Asegúrate de que las fechas sean válidas
    if (strtotime($desdeF) && strtotime($hastaF)) {

        $sql = "SELECT fecha, 
                       CONCAT(UCASE(LEFT(DATE_FORMAT(fecha, '%a'), 1)), LCASE(SUBSTRING(DATE_FORMAT(fecha, '%a'), 2)), '.') as dia, 
                       MIN(hora) as min_hora, 
                       MAX(hora) as max_hora 
                FROM datos 
                WHERE codigo = $nombre
                AND fecha BETWEEN ? AND ?
                GROUP BY fecha";
        
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ss", $desdeF, $hastaF);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo "<div id='resultados'><table>";
                echo "<tr><th>Fecha</th><th>Día</th><th>Entrada</th><th>Salida</th></tr>";
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["fecha"] . "</td>";
                    echo "<td>" . $row["dia"] . "</td>";
                    echo "<td>" . $row["min_hora"] . "</td>";
                    echo "<td>" . $row["max_hora"] . "</td>";
                    echo "</tr>";
                }
                echo "</table></div>";
            } else {
                echo "<div id='resultados'>No se encontraron resultados entre las fechas especificadas.</div>";
            }
            
            $stmt->close();
        } else {
            echo "Error en la preparación de la consulta: " . $conn->error;
        }
    } else {
        echo "Fechas no válidas.";
    }
} else {
    echo "Faltan datos necesarios en el formulario.";
}



function obtenerOpcionesNombresReportes($conn) {
    $sql = "SELECT codigo_marcacion, nombre1, apellido1 , apellido2 FROM rrhh";
    $resultado = $conn->query($sql);
    if ($resultado && $resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            echo '<option value="' . $fila['codigo_marcacion'] . '">' . $fila['nombre1'] . ' ' . $fila['apellido1'] . ' ' . $fila['apellido2'] .  '</option>';
        }
    } else {
        echo '<option value="">No se encontraron proveedores</option>';
    }
}
