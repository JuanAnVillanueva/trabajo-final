<?php
session_start();

include 'conexion.php';

$nombre = $_POST['usuario'];
$contra = $_POST['password'];
$mail = $_POST['email'];
$telefono = $_POST['telefono'];

$ingresar_query = "INSERT INTO Usuario (Usuario, contrasena, mail, telefono) VALUES ('$nombre', '$contra', '$mail', '$telefono')";

if ($conexion->query($ingresar_query) === TRUE) {
    $_SESSION['usuario'] = $nombre;
    header('location: ../paginas/login.html');
} else {
    echo "Error: " . $ingresar_query . "<br>" . $conexion->error;
}

$conexion->close();
?>
