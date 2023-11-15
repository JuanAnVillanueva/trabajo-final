<?php
session_start();
include 'conexion.php';

// Verificar si la sesión contiene la información del usuario
if (isset($_SESSION['DatoP']) && is_scalar($_SESSION['DatoP'])) {
    $DatoP = $_SESSION['DatoP'];

    // Actualizar los datos en la base de datos
    $sql = "UPDATE proyecto SET estado = 'verTrabajo.php' WHERE id = '$DatoP';";

    if ($conexion->query($sql) === TRUE) {
        header('location: bandejaTraba.php');
    } else {
        echo "Error al actualizar datos: " . $conexion->error;
    }
} else {
    echo "";
}

$conexion->close();
?>
