<?php
include 'conexionDB.php'; 

function rellenarCamposFormulario($numeroCheque){
    global $conn;

    // Consulta SQL para obtener los datos del cheque
    $sql = "SELECT * FROM cheques WHERE numero_cheque = '$numeroCheque'";
    $result = $conn->query($sql); 

    if ($result && $result->num_rows > 0) { 
        $row = $result->fetch_assoc(); 
        $fecha = $row['fecha'];
        $monto = $row['monto'];
        $descripcion = $row['descripcion'];
        $codigoProveedor = $row['beneficiario'];//almaceno el codigo    del proveedor
        //Consulta para obtener el nombre y no codigo xd
        $sqlProveedor = "SELECT nombre FROM proveedores WHERE codigo = '$codigoProveedor'";
        $resultProveedor = $conn->query($sqlProveedor); 
        if ($resultProveedor && $resultProveedor->num_rows > 0) { 
            $rowP = $resultProveedor->fetch_assoc(); 
            //le asigno el nombre al proveedor
            $beneficiario = $rowP['nombre'];
            //el * es el identificador para separar los datos
            $cheque = $fecha . '*' . $beneficiario . '*'.$monto. '*'.$descripcion;
            echo $cheque;
        } else {
            echo 'error';
        }
    }
}

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
