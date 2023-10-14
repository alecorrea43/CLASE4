<?php

session_start();

extract($_REQUEST);

if (!isset($_SESSION['usuario_logueado']))
    header("location:../admin/form_login.php");

require("conexion.php");

// Datos del formulario
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$usuario = $_POST['usuario'];
$password = $_POST['password'];
$rol = $_POST['rol'];

// valoracion de datos
$salt = substr($usuario, 0, 2);
$clave_crypt = crypt($password, $salt);


$sql = "INSERT INTO usuarios (usuario, nombre, apellido, password, rol)
        VALUES (:usuario, :nombre, :apellido, :password, :rol)
";

$instruccion = $conexion->prepare($sql);


$instruccion->bindParam(':usuario', $usuario);
$instruccion->bindParam(':nombre', $nombre);
$instruccion->bindParam(':apellido', $apellido);
$instruccion->bindParam(':password', $clave_crypt);
$instruccion->bindParam(':rol', $rol);

// la consulta
if ($instruccion->execute()) {
    if($_SESSION['rol'] == "admin") {
        header("location:../admin/index.php?mensaje=Publicación exitosa");
    } else {
        header("location:login.php?usuario=$usuario&password=$password");
    }

} else {
    header("location:../admin/index.php?mensaje=Ha ocurrido un error");
}

$conexion = null; 
?>