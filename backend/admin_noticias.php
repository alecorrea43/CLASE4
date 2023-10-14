<?php

extract($_REQUEST);

// Importaciones
require("conexion.php");

if (!isset($_SESSION['usuario_logueado']))
    header("location:../admin/form_login.php");

$id_usuario = $_SESSION['id_usuario'];

if (!isset($autor)) {

    $instruccion = "
    SELECT noticias.*, CONCAT(usuarios.nombre, ' ', usuarios.apellido) AS autor, usuarios.rol 
    FROM noticias 
    INNER JOIN usuarios ON noticias.id_usuario = usuarios.id_usuario
    ORDER BY noticias.fecha DESC
";
} else {
    $instruccion = "
    SELECT noticias.*, CONCAT(usuarios.nombre, ' ', usuarios.apellido) AS autor, usuarios.rol 
    FROM noticias
    INNER JOIN usuarios ON noticias.id_usuario = usuarios.id_usuario
    WHERE noticias.id_usuario = '$autor'
    ORDER BY noticias.fecha DESC
    ";
}

$instruccion_autores = "
    SELECT noticias.id_usuario, CONCAT(usuarios.nombre, ' ', usuarios.apellido) AS autor
    FROM noticias
    INNER JOIN usuarios ON noticias.id_usuario = usuarios.id_usuario
    GROUP BY usuarios.id_usuario
    ORDER BY CONCAT(usuarios.nombre, ' ', usuarios.apellido)
";

$todas_publicaciones = $conexion->query($instruccion);
$autores = $conexion->query($instruccion_autores);
$conexion = null;
?>