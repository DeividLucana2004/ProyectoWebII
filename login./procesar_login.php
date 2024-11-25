<?php
session_start(); 

// Verifica si el formulario fue enviado
if (isset($_POST['nombre_usuario']) && isset($_POST['contrasena'])) {
    // Conectar a la base de datos
    $servername = "localhost"; // servidor
    $username = "root"; // Usuario 
    $password = ""; // Contraseña d
    $dbname = "tu_base_de_datos"; // Nombre base de datos

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Escapar las entradas para evitar inyección SQL
    $nombre_usuario = $conn->real_escape_string($_POST['nombre_usuario']);
    $contrasena = $conn->real_escape_string($_POST['contrasena']);

    // Consultar si las credenciales coinciden
    $sql = "SELECT * FROM usuarios WHERE nombre_usuario = '$nombre_usuario' AND contrasena = '$contrasena'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Si las credenciales son correctas, iniciar sesión
        $_SESSION['nombre_usuario'] = $nombre_usuario;
        header("Location: dashboard.php"); 
        exit();
    } else {
        // Si las credenciales son incorrectas, redirigir con un mensaje de error
        header("Location: login.php?error=Credenciales incorrectas");
        exit();
    }

    // Cerrar la conexión
    $conn->close();
} else {
    header("Location: login.php?error=Por favor, ingresa tus credenciales");
    exit();
}