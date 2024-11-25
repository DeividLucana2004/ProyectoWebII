<?php
// Conexión a la base de datos
$host = 'localhost';
$usuario = 'root'; // Cambia si tienes otro usuario
$contrasena = ''; // Cambia si tienes una contraseña
$base_datos = 'sistema_reservas';

$conn = new mysqli($host, $usuario, $contrasena, $base_datos);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Recibir los datos del formulario
$nombre = $_POST['nombre'];
$telefono = $_POST['telefono'];
$personas = $_POST['personas'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];
$mensaje = $_POST['mensaje'];

// Insertar los datos en la tabla
$sql = "INSERT INTO reservas (nombre, telefono, personas, fecha, hora, mensaje) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssisss", $nombre, $telefono, $personas, $fecha, $hora, $mensaje);

if ($stmt->execute()) {
    echo "Reserva registrada con éxito. <a href='reservar.html'>Volver</a>";
} else {
    echo "Error al registrar la reserva: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
