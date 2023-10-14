<?php

require('conexion.php'); 


$nombreUsuario = $_POST['nombreUsuario'];


$consulta = $conexion->prepare("SELECT usuario FROM usuarios WHERE usuario = :nombreUsuario");
$consulta->bindParam(':nombreUsuario', $nombreUsuario, PDO::PARAM_STR);
$consulta->execute();


$resultado = $consulta->rowCount();


if ($resultado > 0) {
    echo 'ocupado';
} else {
    echo 'disponible';
}
?>