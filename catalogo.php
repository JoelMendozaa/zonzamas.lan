<?php
include "peliculas.php";

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Catálogo</title>
</head>
<body>
    <h1>Catálogo de peliculas</h1>

    <?php
        foreach ($peliculas as $pelicula){
            echo '<div class ="pelicula">';
            echo '<h2>' $pelicula['titulo'] '</h2>';
            echo '<p>Director: ' . $pelicula['director'] . '</p>';
            echo '<p>Año: ' . $pelicula['anio'] . '</p>';
            echo '<p>Género: ' . $pelicula['genero'] . '</p>';
            echo '</div>';
        }
    ?>
</body>
</html>