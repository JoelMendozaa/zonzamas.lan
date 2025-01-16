<?php
header('Content-Type: application/json');

// Detalles de conexión a la base de datos
$servername = "localhost";
$username = "joel";
$password = "Jomedama2024!";
$dbname = "bbdd_joel";

// Crear conexión a la base de datos
$conexion = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conexion->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Conexión fallida: ' . $conexion->connect_error]));
}

// Verificar si el parámetro 'dni' está presente en la URL
if (!isset($_GET['dni']) || empty($_GET['dni'])) {
    echo json_encode(['success' => false, 'message' => 'El parámetro dni es obligatorio']);
    exit;
}

$dni = $_GET['dni'];

// Preparar la consulta SQL
$sql = "SELECT * FROM usuarios WHERE dni = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $dni);
$stmt->execute();

// Obtener el resultado
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    // Si encontramos un usuario con el DNI proporcionado
    $row = $resultado->fetch_assoc();
    echo json_encode(['success' => true, 'data' => $row]);
} else {
    // Si no se encontró ningún usuario
    echo json_encode(['success' => false, 'message' => 'No se encontraron datos para el DNI especificado']);
}

// Cerrar la declaración y la conexión
$stmt->close();
$conexion->close();
