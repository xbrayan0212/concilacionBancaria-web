<?php
// Incluye el archivo de conexión a la base de datos si es necesario
include 'conexionDB.php';

// Inicializa el array de respuesta
$response = array();

// Recibe los datos del formulario si la solicitud es POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nCheque = $_POST['nCheque'];
    $fecha = $_POST['fecha'];
    $orden = $_POST['ordenCheque'];
    $suma = $_POST['suma'];
    $detalles = $_POST['detalles'];
    $objeto = $_POST['objeto'];
    $monto = $_POST['montoCheque'];

    // Verifica si alguno de los campos requeridos está vacío
    if (empty($nCheque) || empty($fecha) || empty($orden) || empty($suma) || empty($objeto) || empty($monto)) {
        // Devuelve un mensaje de error si algún campo está vacío
        $response['success'] = false;
        $response['mensaje'] = "Por favor, complete todos los campos.";
    } else {
        // Inserta los datos en la tabla 'cheques'
        $sql = "INSERT INTO cheques (numero_cheque, fecha, beneficiario, monto, descripcion, codigo_objeto1, monto_objeto1)
                VALUES ('$nCheque', '$fecha', '$orden', '$suma', '$detalles', '$objeto', '$monto')";

        if ($conn->query($sql) === TRUE) {
            // Devuelve un mensaje de éxito
            $response['success'] = true;
            $response['mensaje'] = "Los datos se han guardado exitosamente.";
        } else {
            // Devuelve un mensaje de error si hay un problema con la inserción de datos
            $response['success'] = false;
            $response['mensaje'] = "Error al insertar datos: " . $conn->error;
        }
    }
}


// Devuelve la respuesta como JSON
echo json_encode($response);
?>

<?php
// Función para obtener opciones de proveedores
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

// Función para obtener opciones de objetos
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
?>
