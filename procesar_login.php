<?php
session_start();

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "museo");

// Verificar conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Obtener los datos del formulario
$correo = $_POST['correo'] ?? '';
$contrasena = $_POST['contrasena'] ?? '';

// Buscar el usuario en la base de datos
$sql = "SELECT * FROM Usuario WHERE Correo = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $correo);
$stmt->execute();
$resultado = $stmt->get_result();

// Validar usuario
if ($resultado->num_rows > 0) {
    $usuario = $resultado->fetch_assoc();

    // Verificar la contraseña
    if (password_verify($contrasena, $usuario['Contrasena'])) {
        // Contraseña correcta -> crear sesión
        $_SESSION['usuario_id'] = $usuario['ID_Usuario']; // Asegúrate de que el campo 'ID' tiene un valor válido
        $_SESSION['usuario_nombre'] = $usuario['Nombre'];

        // Verifica si las variables de sesión están correctamente asignadas
        var_dump($_SESSION);  // Esto te permitirá verificar el contenido de la sesión

        // Redirigir al inicio con mensaje de éxito
        header("Location: index.php?mensaje=login_exitoso");
        exit();
    } else {
        // Contraseña incorrecta
        header("Location: sesion.php?mensaje=error_credenciales");
        exit();
    }
} else {
    // Correo no encontrado
    header("Location: sesion.php?mensaje=error_credenciales");
    exit();
}

$conexion->close();
?>
