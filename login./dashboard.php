<?php
session_start(); 

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['nombre_usuario'])) {
    header("Location: login.php"); // Redirigir al login si no hay sesión activa
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Bienvenido, <?php echo $_SESSION['nombre_usuario']; ?>!</h1>
    <a href="logout.php">Cerrar Sesión</a>
</body>
</html>