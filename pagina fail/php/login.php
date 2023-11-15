<?php
session_start(); 
include 'conexion.php';

$nombre = $_POST['nombre'];
$contra = $_POST['contra'];

$ingresar = "SELECT * FROM Usuario WHERE Usuario = '$nombre' AND contrasena = '$contra'";
$resultado = mysqli_query($conexion, $ingresar);

if ($resultado) {
  $filas = mysqli_num_rows($resultado);
  if ($filas > 0) {
    $_SESSION['miDato'] = $nombre;
    header('location: bandejaTraba.php');
  } else {
    echo "Usuario o contraseña incorrectos.";
  }
} else {
  echo "Error en la consulta: " . mysqli_error($conexion);
}

$conexion->close();
?>
