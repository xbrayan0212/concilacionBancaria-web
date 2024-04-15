<?php
include 'conexionDB.php';

function obtenerOpcionesProveedores($conn) {
    $sql = "SELECT codigo, nombre FROM proveedores";
    $resultado = $conn->query($sql);
    if ($resultado && $resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            echo '<option value="' . $fila['codigo'] . '">' . $fila['nombre'] . '</option>';
        }
    } else {
        echo '<option value="">No se encontraron proveedores</option>';
    }
}

function obtenerOpcionesObjetos($conn) {

    $sql = "SELECT objeto, codigo, detalle FROM objeto_gasto ORDER BY objeto, codigo";
    $resultado = $conn->query($sql);
    $objeto_actual = null;
    if ($resultado && $resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            if ($fila['objeto'] != $objeto_actual) {
                if ($objeto_actual !== null) {
                    echo '</optgroup>';
                }
                echo '<optgroup label="' . $fila['detalle'] . '">';
                $objeto_actual = $fila['objeto'];
            }
            echo '<option value="' . $fila['codigo'] . '">' . $fila['codigo'] . ' - ' . $fila['detalle'] . '</option>';
        }
        echo '</optgroup>';
    } else {
        echo '<option value="">No se encontraron objetos</option>';
    }
}

// Función para verificar si el número de cheque ya existe en la base de datos
function verificarCheque($conn, $numeroCheque) {
    $sql = "SELECT * FROM cheques WHERE numero_cheque = '$numeroCheque'";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        return true; // El número de cheque ya existe en la base de datos
    } else {
        return false; // El número de cheque no existe en la base de datos
    }
}


?>
