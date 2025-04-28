<?php
session_start(); // Iniciar la sesión

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "museo");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Recibir datos del formulario
$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];

// Buscar usuario por correo
$sql = "SELECT * FROM Usuario WHERE Correo = '$correo'";
$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    $usuario = $resultado->fetch_assoc();
    
    // Verificar contraseña
    if (password_verify($contrasena, $usuario['Contrasena'])) {
        // Guardar información en la sesión
        $_SESSION['usuario_id'] = $usuario['ID']; // o el campo que uses de ID
        $_SESSION['nombre_usuario'] = $usuario['Nombre'];

        // Redirigir al inicio
        header("Location: index.php?mensaje=bienvenido");
        exit();
    } else {
        // Contraseña incorrecta
        header("Location: sesion.php?mensaje=error_contrasena");
        exit();
    }
} else {
    // Usuario no encontrado
    header("Location: sesion.php?mensaje=error_usuario");
    exit();
}

$conexion->close();
?>
