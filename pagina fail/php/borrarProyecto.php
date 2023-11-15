<?php
session_start();
include 'conexion.php';

$DatoP = $_SESSION['DatoP'];
echo "ID del proyecto a eliminar: $DatoP"; 

// 1. Eliminar las actividades asociadas al proyecto
$eliminar_actividades_query = "DELETE FROM Actividade WHERE id_Proyecto = '$DatoP';";
$resultado_actividades = mysqli_query($conexion, $eliminar_actividades_query);

if (!$resultado_actividades) {
    echo "Error al eliminar actividades: " . mysqli_error($conexion);
} else {
    // 2. Eliminar los integrantes asociados al proyecto
    $eliminar_integrantes_query = "DELETE FROM Integrantes WHERE id_Proyecto = '$DatoP';";
    $resultado_integrantes = mysqli_query($conexion, $eliminar_integrantes_query);

    if (!$resultado_integrantes) {
        echo "Error al eliminar integrantes: " . mysqli_error($conexion);
    } else {
        // 3. Eliminar el proyecto
        $eliminar_proyecto_query = "DELETE FROM proyecto WHERE id = '$DatoP';";
        $resultado_proyecto = mysqli_query($conexion, $eliminar_proyecto_query);

        if ($resultado_proyecto) {
            header('location: bandejaTraba.php');
        } else {
            echo "Error al eliminar el proyecto: " . mysqli_error($conexion);
        }
    }
}

$conexion->close();
?>
