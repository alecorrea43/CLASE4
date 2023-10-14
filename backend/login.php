<?php

session_start();

extract($_REQUEST);
require("conexion.php");

//login para usurio
$salt = substr($usuario, 0, 2);
$clave_crypt = crypt($password, $salt);

$sql = "SELECT * FROM usuarios WHERE usuario = :usuario AND password = :password";

try {
    
    $instruccion = $conexion->prepare($sql);
   
    $instruccion->bindParam(':usuario', $usuario, PDO::PARAM_STR);
    $instruccion->bindParam(':password', $clave_crypt, PDO::PARAM_STR);
    $instruccion->execute();

    $numero_filas = $instruccion->rowCount();

    
    if ($numero_filas > 0) {
        $resultado = $instruccion->fetch(PDO::FETCH_ASSOC);
        $_SESSION['nombre'] = $resultado['nombre'];
        $_SESSION['apellido'] = $resultado['apellido'];
        $_SESSION['id_usuario'] = $resultado['id_usuario'];
        $_SESSION['rol'] = $resultado['rol'];
        $_SESSION['usuario_logueado'] = "SI";
        header("location:../admin/index.php");

        
    } else {
        $_SESSION['mensaje'] = "Usuario y contraseña incorrecto";
        header("location:../admin/form_login.php?mensaje=Usuario y contraseña incorrecto");
    }

   
} catch (PDOException $e) {
    $_SESSION['mensaje'] = "Fallo en la consulta: " . $e->getMessage();
    header("location:../admin/form_login.php?mensaje=Fallo en la consulta".$e->getMessage());

    
} finally {
    $conexion = null;
}
?>