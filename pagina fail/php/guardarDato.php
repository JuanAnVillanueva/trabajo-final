<?php
session_start();
include 'conexion.php';

$nombre = $_POST['nombre'];
$fecha_ini = $_POST['fecha_ini'];
$fecha_fin = $_POST['fecha_fin'];
$descripcion = $_POST['descripcion'];
$miDato = $_SESSION['miDato'];

// Obtener el id del fundador
$id_fundador_query = "SELECT id FROM Usuario WHERE Usuario = '$miDato'";
$resultado = $conexion->query($id_fundador_query);

// Verificar si se obtuvo el resultado
if ($resultado) {
    $fila = $resultado->fetch_assoc();
    $id_fundador = $fila['id'];

    // Insertar el proyecto
    $insertar_proyecto = "INSERT INTO Proyecto (id_creador, nombre, fecha_ini, fecha_fin, estado, descripcion) VALUES ('$id_fundador', '$nombre', '$fecha_ini', '$fecha_fin', 'trabajo.php','$descripcion')";

    if ($conexion->query($insertar_proyecto) === TRUE) {
        $_SESSION['DatoP'] = $nombre;
        header('location: IngresarIntegrantes.php');
    } else {
        echo "Error: " . $insertar_proyecto . "<br>" . $conexion->error;
    }
} else {
    echo "Error: " . $id_fundador_query . "<br>" . $conexion->error;
}

$conexion->close();
?>
