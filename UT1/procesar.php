<?php



    if(isset($_POST['button'])){
        $nombre = $_POST['nombre'];
        $edad = $_POST['edad'];
        $correo = $_POST['correo'];
        
        if(empty($_POST['nombre']) || empty($_POST['edad']) || empty($_POST['correo'])){
            echo("NO puede estar vacio");
        } else {
            echo("¡Hola, $nombre! Tienes $edad años y tu correo electrónico es $correo");
        }
    }


?>