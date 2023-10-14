<?php

extract($_REQUEST);


require("conexion.php");

if (!isset($_SESSION['usuario_logueado']))
    header("location:../admin/form_login.php");

$id_usuario=$_SESSION['id_usuario'];

$instruccion = "
    SELECT noticias.*, CONCAT(usuarios.nombre, ' ', usuarios.apellido) AS autor, usuarios.rol 
    FROM noticias
    INNER JOIN usuarios ON noticias.id_usuario = usuarios.id_usuario
    WHERE noticias.id_usuario = '$id_usuario'
";

if (!isset($categoria)) {

    $instruccion = "
    SELECT noticias.*, CONCAT(usuarios.nombre, ' ', usuarios.apellido) AS autor, usuarios.rol 
    FROM noticias
    INNER JOIN usuarios ON noticias.id_usuario = usuarios.id_usuario
    WHERE noticias.id_usuario = '$id_usuario'
";
} else {
    $instruccion = "
        SELECT noticias.*, CONCAT(usuarios.nombre, ' ', usuarios.apellido) AS autor, usuarios.rol 
        FROM noticias
        INNER JOIN usuarios ON noticias.id_usuario = usuarios.id_usuario
        WHERE noticias.id_usuario = '$id_usuario'
        AND noticias.categoria = '$categoria'
        ORDER BY noticias.fecha DESC
    ";
}



$mis_noticias = $conexion->query($instruccion);
$conexion = null;
?>