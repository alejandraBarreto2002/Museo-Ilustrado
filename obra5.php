<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: sesion.php?mensaje=debes_loguearte");
    exit();
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
    
    <section id="obra1">

        <div class="contenedorGal">
        <div class="imagenGal">
            <img src="https://upload.wikimedia.org/wikipedia/commons/b/b3/Psycheabduct.jpg" width="394.5" height="708.75" alt="Obra 1">
        </div>
        <div class="textoGal">
                <h2>El rapto de Psique</h2>
                <h3>William-Adolphe Bouguereau</h3>
                <p><strong>Año:</strong> 1895</p>
                <p><strong>Técnica:</strong> Óleo sobre lienzo</p>
                <p><strong>Dimensiones:</strong> 259 × 184 cm</p>
                <p><strong>Ubicación:</strong> Colección privada</p>

                <h3>Información de la pintura</h3>
                <p>
                    Esta obra representa el momento en que Cupido (Eros) rapta a Psique, una escena inspirada en la mitología clásica que simboliza la unión del alma y el amor. Bouguereau destaca por su técnica académica impecable y su realismo idealizado, mostrando figuras humanas con un gran detalle anatómico y suavidad en las texturas.
                </p>
                <p>
                    La composición está llena de dinamismo y sensualidad, con un uso magistral de la luz para resaltar la pureza y belleza de las figuras, mientras que los detalles en los rostros y las posturas transmiten ternura y emoción. Es un ejemplo representativo del academicismo francés del siglo XIX.
                </p>
            </div>
        </div>
    </section>
    
<section id="footer">

        <footer>
            <p>&copy; 2025 Museo Virtual. Todos los derechos reservados.</p>
        </footer>
    </section>


<script>
let startTime = Date.now();

window.addEventListener('beforeunload', function () {
    let tiempoVisualizacion = Math.floor((Date.now() - startTime) / 1000); // en segundos
    let datos = new FormData();
    datos.append('tiempo', tiempoVisualizacion);
    datos.append('id_exhibicion', 5); // ← Asegúrate de poner el ID real de esta obra en tu base de datos

    navigator.sendBeacon('guardar_visita.php', datos);
});
</script>

</body>






</html>