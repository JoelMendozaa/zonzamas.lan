<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Formulario</title>
</head>
<body>
    <form action="" method="post" class="">
        Nombre: <input type="text" name="nombre" placeholder="Nombre">
        Telefono: <input type="number" name="telefono" placeholder="Telefono">
        Correo: <input type="email" name="correo" placeholder="Correo">
        <button name="button" type="submit" class="button">Enviar</button>
    </form>

    <?php
        $nombre = $telefono = $correo = $url = "";
        $esValido = true;

        // Validar el nombre de usuario
        if (isset($_POST["nombre"])) {
            $nombre = $_POST["nombre"];
            if (strlen($nombre) < 5 || strlen($nombre) > 20 || !preg_match('/^[a-zA-Z][a-zA-Z0-9_]*$/', $nombre)) {
                echo "<p style='color:red;'>El nombre de usuario debe tener entre 5 y 20 caracteres y comenzar con una letra. Solo se permiten letras, números y guiones bajos.</p>";
                $esValido = false; // Marcar como no válido
            }
        }

        // Validar el número de teléfono
        if (isset($_POST["telefono"])) {
            $telefono = $_POST["telefono"];
            if (!preg_match('/^\d{9,15}$/', $telefono)) {
                echo "<p style='color:red;'>El número de teléfono debe contener entre 9 y 15 dígitos y no debe contener caracteres no numéricos.</p>";
                $esValido = false; // Marcar como no válido
            }
        }

        // Validar el correo electrónico
        if (isset($_POST["correo"])) {
            $correo = $_POST["correo"];
            if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                echo "<p style='color:red;'>El correo electrónico no tiene un formato válido.</p>";
                $esValido = false; // Marcar como no válido
            }
        }

        // Validar la URL (opcional)
        if (isset($_POST["url"]) && !empty($_POST["url"])) {
            $url = $_POST["url"];
            if (!preg_match('/^https?:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,}(\/\S*)?$/', $url)) {
                echo "<p style='color:red;'>La URL no tiene un formato válido o no empieza con http:// o https://.</p>";
                $esValido = false; // Marcar como no válido
            }
        }

        // Mostrar los datos si son válidos
        if ($esValido) {
            echo "<p>Datos validados correctamente:</p>";
            echo "<p><strong>Nombre de Usuario:</strong> $nombre</p>";
            echo "<p><strong>Teléfono:</strong> $telefono</p>";
            echo "<p><strong>Correo Electrónico:</strong> $correo</p>";
            if ($url) {
                echo "<p><strong>URL:</strong> $url</p>";
            }
        }

    ?>

</body>
</html>