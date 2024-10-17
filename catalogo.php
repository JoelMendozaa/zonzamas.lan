<?php
include "peliculas.php";

$generoSeleccionado = isset($_GET['genero']) ? $_GET['genero']: '';

?>

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
    
    <form action="catalogo.php" method="get">
        <label for="genero">Filtrar:</label>
        <select name="genero" id="genero">
            <option value="">Todos</option>
            <option value="Fantasía">Fantasía</option>
            <option value="Comedia">Comedia</option>
            <option value="Accion">Accion</option>
            <option value="Terror">Terror</option>
            <option value="Ciencia Ficción">Ciencia Ficción</option>
            <option value="Ficción Criminal">Ficción Criminal</option>
        </select>
        <input type="submit" value="Filtrar">
    </form>

    <?php

        if(empty($generoSeleccionado)){
            echo "<h2>Mostrando todas las películas</h2>";
            foreach ($peliculas as $pelicula){
                if (empty($generoSeleccionado) || $pelicula['genero'] === $generoSeleccionado){
                    echo '<div class ="pelicula">';
                    echo '<h2>' . $pelicula['titulo'] . '</h2>';
                    echo '<p>Director: ' . $pelicula['director'] . '</p>';
                    echo '<p>Año: ' . $pelicula['anio'] . '</p>';
                    echo '<p>Género: ' . $pelicula['genero'] . '</p>';
                    echo '</div>';
                }
            } 
        } else {
            echo "<h2>Mostrando películas del género: $generoSeleccionado</h2>";
            foreach ($peliculas as $pelicula){
                if (empty($generoSeleccionado) || $pelicula['genero'] === $generoSeleccionado){
                    echo '<div class ="pelicula">';
                    echo '<h2>' . $pelicula['titulo'] . '</h2>';
                    echo '<p>Director: ' . $pelicula['director'] . '</p>';
                    echo '<p>Año: ' . $pelicula['anio'] . '</p>';
                    echo '<p>Género: ' . $pelicula['genero'] . '</p>';
                    echo '</div>';
                }
        }
        if (count($peliculasFiltradas) === 0) {
            echo "<h2 class='error'>No se encontraron películas de ese género.</h2>";
        }
    }

    ?>

</body>
</html>