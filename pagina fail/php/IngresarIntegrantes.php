<?php
session_start();
include 'conexion.php';

$DatoP = $_SESSION['DatoP'];

// Verificar si el usuario tiene una sesión activa
if (isset($_SESSION['miDato'])) {
    $miDato = $_SESSION['miDato'];

    // Obtener el ID del proyecto
    $id_proyecto_query = "SELECT id FROM Proyecto WHERE nombre = '$DatoP'";
    $id_proyecto_resultado = $conexion->query($id_proyecto_query);

    if ($id_proyecto_resultado) {
        $fila_proyecto = $id_proyecto_resultado->fetch_assoc();
        $id_proyecto = $fila_proyecto['id'];

        // Obtener el ID del usuario actual
        $id_usuario_query = "SELECT id FROM Usuario WHERE Usuario = '$miDato'";
        $id_usuario_resultado = $conexion->query($id_usuario_query);

        if ($id_usuario_resultado) {
            $fila_usuario = $id_usuario_resultado->fetch_assoc();
            $id_usuario = $fila_usuario['id'];

            // Insertar el integrante en la base de datos
            $insertar_integrante = "INSERT INTO Integrantes (id_Usuario, id_Proyecto, rol) VALUES ('$id_usuario', '$id_proyecto', 'Fundador')";

            if ($conexion->query($insertar_integrante) === TRUE) {
                header('location: bandejaTraba.php');
            } else {
                echo "Error al agregar el integrante: " . $conexion->error;
            }
        } else {
            echo "Error al obtener el ID del usuario: " . $conexion->error;
        }
    } else {
        echo "Error al obtener el ID del proyecto: " . $conexion->error;
    }
} else {
    echo "Usuario no autenticado.";
}

$conexion->close();
?>
