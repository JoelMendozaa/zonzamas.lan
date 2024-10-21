<?php

spl_autoload_register(function($nombre){
    var_dump($nombre);

    $nombre_minuscula =strtolower($nombre);

    require_once "lib/{$nombre_minuscula}/{$nombre_minuscula}.php";

    switch($nombre){
        case 'BBDD':
            require_once "lib/bbdd/bbdd.php";
        break;
    }


});