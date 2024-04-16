<?php
include 'conexionDB.php'; 

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error); 
}

if (isset($_POST['nCheque'])) {
    $numeroCheque = $_POST['nCheque']; 
    $sql = "SELECT * FROM cheques WHERE numero_cheque = '$numeroCheque'";
    $result = $conn->query($sql); 

    if ($result && $result->num_rows > 0) { 
        $row = $result->fetch_assoc(); 
        if ($row['fecha_anulado'] !== NULL && $row['fecha_anulado'] !== '0000-00-00') {
            echo 'anulado';
        } else if ($row['fecha_circulacion'] !== NULL && $row['fecha_circulacion'] !== '0000-00-00') {
            echo 'fueraDeCirculacion';
        } else {
            include 'rellenarCampos.php'; // Incluir el archivo con la función
            rellenarCamposFormulario($numeroCheque); 
            echo '* noAnulado';
        }
              
    } else {
        echo 'no_existe'; 
    }
} else {
    echo 'no_recibido'; 
}


$conn->close(); 
?>
