<?php
session_start();

include 'conexion.php';

$contenido = $_POST['contenido'];
$fecha = $_POST['fecha'];
$id_integrante = $_POST['integrante']; // Corregí 'id' a 'integrante'

// Aquí necesitas obtener el id del proyecto, asumo que lo obtienes de la sesión
$id_proyecto = $_SESSION['DatoP'];

$ingresar_query = "INSERT INTO Actividade (tipo, contenido, fecha, id_intgrante, id_Proyecto) VALUES ('Por hacer', '$contenido', '$fecha', '$id_integrante', '$id_proyecto')";

if ($conexion->query($ingresar_query) === TRUE) {
    header('location: Trabajo.php');
} else {
    echo "Error: " . $ingresar_query . "<br>" . $conexion->error;
}

$conexion->close();
?>
