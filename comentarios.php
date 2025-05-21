
<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: sesion.php?mensaje=debes_loguearte");
    exit();
}
// Conexión a base de datos
$conexion = new mysqli("localhost", "root", "", "museo"); // Ajusta tus credenciales si es necesario
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Procesar el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario_id = $_SESSION['usuario_id'];
    $nombre = $_POST['nombre'];
    $valoracion = intval($_POST['rango']);
    $mensaje = $_POST['mensaje'];
    $exhibicion_id = intval($_POST['exhibicion']);
    $fecha = date("Y-m-d H:i:s");

    // Insertar comentario
    $stmt = $conexion->prepare("INSERT INTO Comentario (Texto, Valoracion, Fecha, ID_Usuario, ID_Exhibicion) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sisii", $mensaje, $valoracion, $fecha, $usuario_id, $exhibicion_id);
    $stmt->execute();
    $stmt->close();

    $mensaje_exito = "Comentario enviado correctamente.";
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Exposiciones - Museo Virtual</title>
        <link rel="stylesheet" href="styles.css">
    </head>

<body>
    <header>
        <h1>Museo Virtual</h1>
        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="exposiciones.php">Exposiciones</a></li>
                <li><a href="galeria.php">Galería</a></li>
                <li><a href="contacto.php">Contacto</a></li>
                <li><a href="comentarios.php">Comentarios</a></li>
                <li><a href="reportes.php">Reportes</a></li>
                <?php if (isset($_SESSION['usuario_nombre'])): ?>
                    <li><a href="#">Hola, <?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?> 👋</a></li>
                    <li><a href="logout.php">Cerrar sesión</a></li>
                <?php else: ?>
                    <li><a href="sesion.php">Inicio de sesión</a></li>
                    <li><a href="registro1.php">Registro de usuario</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <section id="comentarios">
   <section id="comentarios">
    <h1>Comentarios de la exposición</h1>

    <?php if (isset($mensaje_exito)): ?>
        <p class="mensaje-exito"><?php echo $mensaje_exito; ?></p>
    <?php endif; ?>

    <form action="comentarios.php" method="post">
        <h2>Escribe tu comentario</h2>

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?>" readonly>

        <label for="exhibicion">Selecciona una exposición:</label>
        <select id="exhibicion" name="exhibicion" required>
            <?php
            $resultado = $conexion->query("SELECT ID_Exhibicion, Titulo FROM Exhibicion");
            while ($fila = $resultado->fetch_assoc()) {
                echo "<option value='{$fila['ID_Exhibicion']}'>" . htmlspecialchars($fila['Titulo']) . "</option>";
            }
            ?>
        </select>

        <h3>Calificación de la obra:</h3>
<div class="estrellas">
    <input type="radio" id="estrella5" name="rango" value="5" required>
    <label for="estrella5" title="5 estrellas">&#9733;</label>
    <input type="radio" id="estrella4" name="rango" value="4">
    <label for="estrella4" title="4 estrellas">&#9733;</label>
    <input type="radio" id="estrella3" name="rango" value="3">
    <label for="estrella3" title="3 estrellas">&#9733;</label>
    <input type="radio" id="estrella2" name="rango" value="2">
    <label for="estrella2" title="2 estrellas">&#9733;</label>
    <input type="radio" id="estrella1" name="rango" value="1">
    <label for="estrella1" title="1 estrella">&#9733;</label>
</div>
        <label for="mensaje">Mensaje:</label>
        <textarea id="mensaje" name="mensaje" rows="5" placeholder="Escribe tu comentario aquí..." required></textarea>

        <div class="checkbox-group">
            <input type="checkbox" id="terminos" name="terminos" required>
            <label for="terminos">Acepto los términos y condiciones</label>
        </div>

        <button type="submit">Enviar</button>
        <button type="reset">Limpiar</button>
    </form>
</section>
<h2>Comentarios anteriores</h2>

<?php
$consulta = "
    SELECT c.Texto, c.Valoracion, c.Fecha, u.Nombre AS Usuario, e.Titulo AS Exhibicion
    FROM Comentario c
    JOIN Usuario u ON c.ID_Usuario = u.ID_Usuario
    JOIN Exhibicion e ON c.ID_Exhibicion = e.ID_Exhibicion
    ORDER BY c.Fecha DESC
";

$resultadoComentarios = $conexion->query($consulta);

if ($resultadoComentarios->num_rows > 0):
    while ($comentario = $resultadoComentarios->fetch_assoc()):
?>
    <div class="comentario">
        <h3><?php echo htmlspecialchars($comentario['Exhibicion']); ?></h3>
        <p><strong><?php echo htmlspecialchars($comentario['Usuario']); ?></strong> comentó el <?php echo date("d/m/Y H:i", strtotime($comentario['Fecha'])); ?>:</p>
        <div class="estrellas-mostradas">
            <?php
                $valoracion = intval($comentario['Valoracion']);
                for ($i = 1; $i <= 5; $i++) {
                    echo $i <= $valoracion ? '★' : '☆';
                }
            ?>
        </div>
        <p><?php echo nl2br(htmlspecialchars($comentario['Texto'])); ?></p>
        <hr>
    </div>
<?php
    endwhile;
else:
    echo "<p>No hay comentarios aún. ¡Sé el primero en dejar uno!</p>";
endif;
?>
<section id="footer">
    <footer>
        <p>&copy; 2025 Museo Virtual. Todos los derechos reservados.</p>
    </footer>
</section>
</body>
</html>