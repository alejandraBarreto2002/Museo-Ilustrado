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
    
    <section id="contacto">
        <h2>Autores</h2>
        <div class="contacto">
            <h3>Alejandra Barreto</h3>
            <p>Correo A.</p>
        </div>
        <div class="contacto">
            <h3>Dylan Robles</h3>
            <p>Correo B.</p>
        </div>
        <div class="contacto">
            <h3>Lina Velasco</h3>
            <p>Correo C.</p>
        </div>
    </section>
    
    <section id="footer">

        <footer>
            <p>&copy; 2025 Museo Virtual. Todos los derechos reservados.</p>
        </footer>
    </section>




</body>





</html>