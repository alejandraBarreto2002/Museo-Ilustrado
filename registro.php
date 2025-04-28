<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "museo");

// Verificar conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Variables de mensaje
$mensaje = "";
$tipo_mensaje = "";  // 'success' o 'error'

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    // Encriptar la contraseña
    $contrasena_segura = password_hash($contrasena, PASSWORD_DEFAULT);

    // Usar una consulta preparada para evitar inyecciones SQL
    $stmt = $conexion->prepare("INSERT INTO Usuario (Nombre, Correo, Contrasena) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nombre, $correo, $contrasena_segura);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        // Redirigir con mensaje de éxito en la URL
        header("Location: index.php?mensaje=registro_exitoso");
        exit;
    } else {
        // Redirigir con mensaje de error en la URL
        header("Location: index.php?mensaje=error_registro");
        exit;
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
    $conexion->close();
}

?>
