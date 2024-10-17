<?php
// Configuración de la conexión
$servername = "localhost";
$username = "joel";
$password = "Jomedama2024!"; // Coloca aquí tu contraseña de MySQL si la has configurado
$dbname = "prueba_php_mysql";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("La conexión ha fallado: " . $conn->connect_error);
}
echo "Conexión exitosa a la base de datos";

// Consulta para obtener datos
$sql = "SELECT id, nombre, edad FROM alumnos";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Mostrar los datos de cada fila
    while($row = $result->fetch_assoc()) {
        echo "<p>ID: " . $row["id"]. " - Nombre: " . $row["nombre"]. " - Edad: " . $row["edad"]. "</p>";
    }
} else {
    echo "No hay resultados";
}

// Cerrar la conexión
$conn->close();
?>
