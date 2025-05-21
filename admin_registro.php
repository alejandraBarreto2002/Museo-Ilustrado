<?php
session_start();
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);

    $conexion = new mysqli("localhost", "root", "", "museo");

    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    $stmt = $conexion->prepare("INSERT INTO Administrador (Nombre, Correo, Contrasena) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nombre, $correo, $contrasena);

    if ($stmt->execute()) {
        $mensaje = "Administrador registrado correctamente. <a href='admin_login.php'>Iniciar sesión</a>";
    } else {
        $mensaje = "Error al registrar: " . $conexion->error;
    }

    $stmt->close();
    $conexion->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Administrador - Museo Virtual</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Registro de nuevo administrador</h2>
    <?php if ($mensaje) echo "<p>$mensaje</p>"; ?>
    <form method="POST" action="admin_registro.php">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required>

        <label for="correo">Correo:</label>
        <input type="email" name="correo" required>

        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contrasena" required>

        <button type="submit">Registrar</button>
    </form>
</body>
</html>
