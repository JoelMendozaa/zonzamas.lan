<?php

    class BBDD{

        private $bbdd;
        private static $instance;

        // Datos de conexion
        private const SERVIDOR = 'localhost';
        private const USUARIO = 'joel';
        private const CONTRASENA = 'Jomedama2024!';
        private const BASE_DATOS = 'gestion_usuarios';
        function __construct(){
            $servidor   = self::SERVIDOR;
            $usuario    = self::USUARIO;
            $contrasena = self::CONTRASENA;
            $base_datos = self::BASE_DATOS;
        
            $this->conexion = new mysqli(self::SERVIDOR, self::USUARIO, self::CONTRASENA, self::BASE_DATOS);
        
            if ($conexion -> connect_error){
                die("Error de conexión: " . $this->conexion->connect_error);
            }
        }

        static public function getInstance(){
            if(empty(self::$instance)){
                self::$instance = new self();
            }
            return self::$instance;
        }

        function __destruct(){
            $this->conexion->close();
        }

        static public function query($query){
            return self::instance->conexion->query($query);
        }
    }

    $bbdd = BBDD::getInstance();

    echo$bbdd->conexion;

    $bbdd2 = new BBDD();

    $bbdd2->conexion;