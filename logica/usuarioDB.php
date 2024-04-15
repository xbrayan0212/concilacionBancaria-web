<?php
session_start();

// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "d52024"; 
$password = "12345"; 
$database = "computo"; 

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
// Recuperar los datos del formulario
$cedula = $_POST['cedula'];
$password  = $_POST['contraseña'];

// Consulta SQL utilizando una sentencia preparada
$sql = "SELECT * FROM usuario WHERE cedula = ? AND password = ?";
$stmt = $conn->prepare($sql);

// Enlazar parámetros
$stmt->bind_param("ss", $cedula, $password );

// Ejecutar la consulta
$stmt->execute();

// Obtener el resultado
$result = $stmt->get_result();

// Verificar si se encontró una fila
if ($result->num_rows > 0) {
    // Usuario y contraseña son correctos, redirigir a la página inicial
    header("Location: ../paginas/paginaInicial.html");
} else {
    $_SESSION['mensajeError'] = "Credenciales incorrectas. Por favor, intente de nuevo.";
        header("location: ../index.php");
        exit;
}

$stmt->close();
$conn->close();
?>
