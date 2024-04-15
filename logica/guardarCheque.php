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

// Cierra la conexión a la base de datos si es necesario
$conn->close();

// Devuelve la respuesta como JSON
echo json_encode($response);
?>


