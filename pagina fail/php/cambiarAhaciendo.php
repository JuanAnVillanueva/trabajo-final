<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id_actividad'])) {
        $id_actividad = $_POST['id_actividad'];

        $actualizar_query = "UPDATE Actividade SET tipo = 'Haciendose' WHERE id = '$id_actividad'";

        if ($conexion->query($actualizar_query) === TRUE) {
            header('Location: Trabajo.php');
            exit();
        } else {
            echo "Error al actualizar la actividad: " . $conexion->error;
        }
    } else {
        echo "Error: No se proporcionó el ID de la actividad.";
    }
} else {
    echo "Error: Método de solicitud no válido.";
}

$conexion->close();
?>
