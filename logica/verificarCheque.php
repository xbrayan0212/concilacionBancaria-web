<?php
include 'conexionDB.php';

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se recibió un número de cheque
if (isset($_POST['nCheque'])) {
    $numeroCheque = $_POST['nCheque'];

    $sql = "SELECT * FROM cheques WHERE numero_cheque = '$numeroCheque'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        echo 'existe';
    } else {
        echo 'no_existe';
    }
} else {
    echo 'no_recibido'; // Si no se recibió el número de cheque en la solicitud
}

$conn->close();
?>