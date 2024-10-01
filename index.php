<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Index</title>
</head>
<body>
    <h1 class="estilo">
        Ingresa tu nombre
    </h1>
    <form action="" method="post" class="usuario">
        Nombre: <input type="text" name="nombre" placeholder="Tu nombre" class="input">
        <input type="submit" class="button">
    </form>
    
    <?php

    if(isset($_POST["nombre"])){    // isset($_POST["nombre"]) verifica si el nombre es enviado a través del formulario  
        $nombre = $_POST["nombre"];

        if(strlen($nombre) < 5){        // Indica un minimo de caracteres
            echo "Debe tener minimo 5 caracteres";
        } else {
            echo "¡Hola, $nombre!";
        }
    }
    ?>

</body>
</html>