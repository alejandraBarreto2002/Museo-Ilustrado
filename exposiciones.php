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

 <main class="contenedor-exposiciones">
        <div class="izquierdaEx">
            <h2>Nuestras Exposiciones</h2>
            <h3>Historia del Arte</h3>
            <p>Un recorrido por las grandes obras de la historia.</p>

            <h3>Arte Contemporáneo</h3>
            <p>Las tendencias más innovadoras del arte actual.</p>

            <h3>Escultura y Fotografía</h3>
            <p>Explorando la tridimensionalidad y la captura del instante.</p>
        </div>

        <div class="derechaEx">
            <h2>Recorrido Virtual</h2>
            <div class="recorrido-container">
                <iframe 
                    title="Recorrido Virtual Galeón de Manila" 
                    class="recorrido-virtual"
                    src="https://s6i3rkxswzzvjtgx9bcsha.on.drv.tw/Videos%20360/www.galeondemanilav1.com/" 
                    allowfullscreen>
                </iframe>
            </div>
        </div>
    </main>

    <footer id="footer">
        <p>&copy; 2025 Museo Virtual. Todos los derechos reservados.</p>
    </footer>

</body>
</html>