<?php
session_start(); 
include 'conexion.php';

$nombre = $_POST['usuario_o_email'];
$rol = $_POST['rol'];

$buscar = "SELECT * FROM Usuario WHERE Usuario = '$nombre' OR mail = '$nombre'";
$resultado = mysqli_query($conexion, $buscar);

if ($resultado) {
    $filas = mysqli_num_rows($resultado);
    if ($filas > 0) {
        $row = mysqli_fetch_assoc($resultado);

        $insertar_integrante = "INSERT INTO Integrantes (id_Usuario, id_Proyecto, rol) 
                                VALUES ('{$row['id']}', '{$_SESSION['DatoP']}', '$rol')";
        if ($conexion->query($insertar_integrante) === TRUE) {
            header('location: Trabajo.php');
            exit;
        } else {
            echo "Error al insertar integrante: " . $conexion->error;
        }
    } else {
        echo "No se encontró un usuario con el nombre o correo proporcionado.";
    }
} else {
    echo "Error en la consulta: " . mysqli_error($conexion);
}

$conexion->close();
?>
