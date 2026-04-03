<?php
$host = "localhost";     
$usuario = "root";       
$clave = "1MG32025";           
$base = "euskopizza";      

$conn = new mysqli($host, $usuario, $clave, $base);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

?>