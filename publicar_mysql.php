<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

// Detalles de conexión a la base de datos
$servername = "localhost";
$username = "joel";
$password = "Jomedama2024!";
$dbname = "bbdd_joel";

// Inicializar array de respuesta
$respuesta = [];

try {
    // Crear conexión a la base de datos
    $conexion = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conexion->connect_error) {
        throw new Exception("Error de conexión a la base de datos: " . $conexion->connect_error);
    }

    // Verificar si todos los campos requeridos están presentes
    $campos_requeridos = ['dni', 'nombre', 'apellidos', 'fechaNacimiento', 'codigoPostal', 'email', 'telFijo', 'telMovil', 'iban', 'tarjetaCredito', 'password'];
    foreach ($campos_requeridos as $campo) {
        if (!isset($_POST[$campo]) || empty($_POST[$campo])) {
            throw new Exception("El campo '$campo' es obligatorio y no puede estar vacío");
        }
    }

    // Sanitizar todas las entradas
    $entrada_sanitizada = array_map('sanitizar_entrada', $_POST);

    // Preparar la declaración SQL para insertar los datos
    $sql = "INSERT INTO usuarios (dni, nombre, apellidos, fechaNacimiento, cp, email, telFijo, telMovil, tarjeta, iban, contrasena) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        throw new Exception("Error al preparar la consulta: " . $conexion->error);
    }

    $stmt->bind_param("sssssssssss",    // Las "s" significa que es de tipo string cada campo
        $entrada_sanitizada['dni'], 
        $entrada_sanitizada['nombre'], 
        $entrada_sanitizada['apellidos'], 
        $entrada_sanitizada['fechaNacimiento'], 
        $entrada_sanitizada['codigoPostal'], 
        $entrada_sanitizada['email'], 
        $entrada_sanitizada['telFijo'], 
        $entrada_sanitizada['telMovil'], 
        $entrada_sanitizada['tarjetaCredito'], 
        $entrada_sanitizada['iban'], 
        $entrada_sanitizada['password']
    );

    if (!$stmt->execute()) {
        throw new Exception("Error al ejecutar la consulta: " . $stmt->error);
    }

    $respuesta["mensaje"] = "Los datos se han guardado correctamente en la base de datos";

} catch (Exception $e) {
    $respuesta["error"] = $e->getMessage();
} finally {
    // Cerrar la declaración y la conexión si existen
    if (isset($stmt) && $stmt instanceof mysqli_stmt) {
        $stmt->close();
    }
    if (isset($conexion) && $conexion instanceof mysqli) {
        $conexion->close();
    }

    // Enviar respuesta JSON
    echo json_encode($respuesta);
}

function sanitizar_entrada($entrada) {
    // Sanitiza las entradas para evitar inyecciones SQL
    return htmlspecialchars(trim($entrada));
}
