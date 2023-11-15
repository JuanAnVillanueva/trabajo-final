<?php
session_start();
include 'conexion.php';

// Verificar si la sesión contiene la información del usuario
if (isset($_SESSION['miDato']) && is_scalar($_SESSION['miDato'])) {
    $miDato = $_SESSION['miDato'];

    // Verificar si se enviaron los datos del formulario
    if (isset($_POST['nombre']) && isset($_POST['contraseña'])) {
        $nuevoNombre = $_POST['nombre'];
        $nuevaContrasena = $_POST['contraseña'];

        // Actualizar los datos en la base de datos
        $sql = "UPDATE Usuario SET Usuario = '$nuevoNombre', contrasena = '$nuevaContrasena' WHERE usuario = '$miDato';";

        if ($conexion->query($sql) === TRUE) {
            header('location: ../paginas/login.html');
        } else {
            echo "Error al actualizar datos: " . $conexion->error;
        }
    } else {
        echo "Por favor, proporciona nombre y contraseña para actualizar.";
    }
} else {
    echo "No hay información de usuario en la sesión.";
}

$conexion->close();
?>





