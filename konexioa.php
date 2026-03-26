<?php
$host = "localhost";     
$usuario = "root";       
$clave = "1MG32025";           
$base = "erronka3";      

$conexion = new mysqli($host, $usuario, $clave, $base);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

?>
