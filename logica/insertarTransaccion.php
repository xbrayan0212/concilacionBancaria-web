<?php
include 'conexionDB.php';

// Inicializa el array de respuesta
$response = array();
// Recibe los datos del formulario si la solicitud es POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fechaT = $_POST['fechaT'];
    $montoT = $_POST['montoT'];
    $transaccion = $_POST['transaccion'];

    if (empty($fechaT || empty($montoT))){
        // Devuelve un mensaje de error si algún campo está vacío
        $response['success'] = false;
        $response['mensaje'] = "Por favor, complete todos los campos.";
    } else {
        // Inserta los datos en la tabla 'cheques'
        $sql = "INSERT INTO otros (transaccion, fecha, monto) VALUES ('$transaccion', '$fechaT', '$montoT')";
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
