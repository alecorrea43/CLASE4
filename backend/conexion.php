<?php
//conexion a la base de datos
$server_db = "localhost";
$usuario_db = "root";
$password_db = "";
$base_db = "diariodb";


try {
    $dsn = "mysql:host=$server_db;dbname=$base_db";
    $conexion = new PDO($dsn, $usuario_db, $password_db);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>