<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "d52024"; 
$password = "12345"; 
$database = "conciliacion"; 

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>