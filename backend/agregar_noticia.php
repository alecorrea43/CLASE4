<?php

session_start();

extract($_REQUEST);

if (!isset($_SESSION['usuario_logueado']))
    header("location:../admin/form_login.php");

require("conexion.php");

// fecha 
$fecha = date("Y-m-d"); 

$id_usuario = $_SESSION['id_usuario'];

// imagenes 
$copiarArchivo = false;
if (is_uploaded_file($_FILES['imagen']['tmp_name'])) {
    $nombreDirectorio = "../imagenes/subidas/";
    $idUnico = time();
    $nombrefichero = $idUnico . "-" . $_FILES['imagen']['name'];
    $copiarArchivo = true;
} else
    $nombrefichero = "";

if ($copiarArchivo)
    move_uploaded_file($_FILES['imagen']['tmp_name'], $nombreDirectorio . $nombrefichero);


$sql = "INSERT INTO noticias (titulo, copete, cuerpo, imagen, categoria, id_usuario, fecha)
        VALUES (:titulo, :copete, :cuerpo, :imagen, :categoria, :id_usuario, :fecha)";


$instruccion = $conexion->prepare($sql);


$instruccion->bindParam(':titulo', $titulo);
$instruccion->bindParam(':copete', $copete);
$instruccion->bindParam(':cuerpo', $cuerpo);
$instruccion->bindParam(':imagen', $nombrefichero);
$instruccion->bindParam(':categoria', $categoria);
$instruccion->bindParam(':id_usuario', $id_usuario);
$instruccion->bindParam(':fecha', $fecha);


if ($instruccion->execute()) {
    header("location:../admin/mis_publicaciones.php?mensaje=Publicación exitosa");
} else {
    header("location:../admin/mis_publicaciones.php?mensaje=Ha ocurrido un error");
}

$conexion = null; 
?>