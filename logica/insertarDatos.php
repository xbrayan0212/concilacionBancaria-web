<?php
include 'conexionDB.php';

// Inicializa el array de respuesta
$response = array();

// Recibe los datos del formulario si la solicitud es POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Operaciones de Ingreso de Transacciones
    if (isset($_POST['fechaT']) && isset($_POST['montoT']) && isset($_POST['transaccion'])) {
        $fechaT = $_POST['fechaT'];
        $montoT = $_POST['montoT'];
        $transaccion = $_POST['transaccion'];

        if (empty($fechaT) || empty($montoT)) {
            // Devuelve un mensaje de error si algún campo está vacío
            $response['success'] = false;
            $response['mensaje'] = "Por favor, complete todos los campos.";
        } else {
            // Inserta los datos en la tabla 'otros'
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
    
    // Operaciones de Sacar Cheque de Circulación
    if (isset($_POST['fechaSacarCirculacion']) && isset($_POST['NumerochequeS'])) {
        $fechaS = $_POST['fechaSacarCirculacion'];
        $nChequeS = $_POST['NumerochequeS'];

        if (empty($fechaS)) {
            // Devuelve un mensaje de error si algún campo está vacío
            $response['success'] = false;
            $response['mensaje'] = "Por favor, complete todos los campos.";
        } else {
            // Inserta los datos en la tabla 'cheques'
            $sql = "UPDATE cheques SET fecha_circulacion = '$fechaS' WHERE numero_cheque = '$nChequeS'";
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

    // Operaciones de Anulación de Cheque
    if (isset($_POST['fechaAnulacion']) && isset($_POST['detalleAnulacion']) && isset($_POST['Numerocheque'])) {
        $fechaA = $_POST['fechaAnulacion'];
        $detalleA = $_POST['detalleAnulacion'];
        $nCheque = $_POST['Numerocheque'];

        if (empty($fechaA) || empty($detalleA)) {
            // Devuelve un mensaje de error si algún campo está vacío
            $response['success'] = false;
            $response['mensaje'] = "Por favor, complete todos los campos.";
        } else {
            // Inserta los datos en la tabla 'cheques'
            $sql = "UPDATE cheques SET fecha_anulado = '$fechaA', detalle_anulado = '$detalleA' WHERE numero_cheque = '$nCheque'";
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
}

// Verifica si se reciben los datos esperados del formulario
if (isset($_FILES['archivo'])) {
    // Manejar el archivo subido
    $ruta = $_FILES['archivo']['tmp_name'];
    $file = fopen($ruta, "r");

    if ($file) {
        while (($line = fgets($file)) !== false) {
            // Dividir la línea en columnas
            $data = preg_split("/[\t]+/", $line);

            // Verificar si hay suficientes columnas
            if (count($data) >= 6) {
                $codigo = trim($data[0]);
                
                // Verificar si la fecha y la hora están juntas sin tabulaciones
                if (strpos($data[1], ' ') !== false) {
                    // Si están juntas, separar la fecha y la hora
                    list($fecha, $hora) = explode(' ', $data[1], 2);
                } else {
                    // Si no están juntas, usar los valores por separado
                    $fecha = trim($data[1]);
                    $hora = trim($data[2]);
                }

                $filler1 = trim($data[2]);
                $filler2 = trim($data[3]);
                $filler3 = trim($data[4]);
                $filler4 = trim($data[5]);
    
                // Consulta preparada para la inserción de datos
                $stmt = $conn->prepare("INSERT INTO datos (codigo, fecha, hora, filler1, filler2, filler3, filler4) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sssssss", $codigo, $fecha, $hora, $filler1, $filler2, $filler3, $filler4);
                if ($stmt->execute()) {
                    $response['success'] = true;
                    $response['mensaje'] = "Los datos se han guardado exitosamente.";
                } else {
                    // Error en la inserción de datos
                    $response['success'] = false;
                    $response['mensaje'] = "Error al insertar datos: " . $conn->error;
                }
            } else {
                // No hay suficientes columnas en la línea
                $response['success'] = false;
                $response['mensaje'] = "Error: El formato de la línea no es válido. Línea: $line";
            
            }
        }
        // Cerrar el archivo después de terminar de procesarlo
        fclose($file);
    } else {
        // Error al abrir el archivo
        $response['success'] = false;
        $response['mensaje'] = "Error: No se pudo abrir el archivo.";
    }
}


// Cierra la conexión a la base de datos si es necesario
$conn->close();

// Devuelve la respuesta como JSON
echo json_encode($response);
?>
