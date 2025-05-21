<?php
session_start();
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    $conexion = new mysqli("localhost", "root", "", "museo");
    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    $stmt = $conexion->prepare("SELECT ID_Admin, Nombre, Contrasena FROM Administrador WHERE Correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($fila = $resultado->fetch_assoc()) {
        if (password_verify($contrasena, $fila['Contrasena'])) {
            $_SESSION['admin_id'] = $fila['ID_Admin'];
            $_SESSION['admin_nombre'] = $fila['Nombre'];
            header("Location: reportes.php");
            exit();
        } else {
            $mensaje = "Contraseña incorrecta.";
        }
    } else {
        $mensaje = "Correo no encontrado o no eres administrador.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login Administrador - Museo Virtual</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Inicio de sesión para administradores</h2>
    <form method="POST" action="admin_login.php" class="formulario-registro">
        <div class="campo-formulario">
            <label for="correo">Correo del administrador:</label>
            <input type="email" name="correo" id="correo" required>
        </div>

        <div class="campo-formulario">
            <label for="contrasena">Contraseña:</label>
            <input type="password" name="contrasena" id="contrasena" required>
        </div>

        <div class="campo-formulario">
            <button type="submit" class="boton-bonito">Iniciar sesión</button>
        </div>

        <?php if (!empty($mensaje)): ?>
            <p style="color: red;"><?php echo htmlspecialchars($mensaje); ?></p>
        <?php endif; ?>
    </form>
</body>
</html>
