<?php
session_start();
extract($_REQUEST);
require("conexion.php");


if (isset($_GET['id'])) {
    $id_noticia = $_GET['id'];


    $instruccion = "
        SELECT noticias.*, CONCAT(usuarios.nombre, ' ', usuarios.apellido) AS autor 
        FROM noticias
        INNER JOIN usuarios ON noticias.id_usuario = usuarios.id_usuario
        WHERE id_noticia='$id_noticia' 
    ";

    
    $resultado = $conexion->query($instruccion);

    if ($resultado) {
        if ($resultado->rowCount() > 0) {
            $noticia = $resultado->fetch(PDO::FETCH_ASSOC);
            $_SESSION['ver_noticia'] = $noticia;
            header("location:../noticias/noticia.php?id=" . $noticia['id_noticia']);
        } else {
            echo "No se encontró la noticia.";
        }
    } else {
        echo "Error en la consulta: " . $conexion->errorInfo()[2];
    }
} else {
    echo "No se encontró la noticia.";
}
$conexion = null;
?>