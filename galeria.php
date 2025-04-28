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
    <title>Galería - Museo Virtual</title>
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
    
    <section id="galeria">
        <h2>Nuestra Galería</h2>
        <div class="gallery">
            <li><a href="obra1.php"> <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/bf/Lady_with_an_Ermine_-_Leonardo_da_Vinci_%28adjusted_levels%29.jpg/1200px-Lady_with_an_Ermine_-_Leonardo_da_Vinci_%28adjusted_levels%29.jpg" alt="obra1"></a></li>
            <li><a href="obra2.php"> <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/45/Goya.hund.jpg/245px-Goya.hund.jpg" alt="Obra 2"></a></li>
            <li><a href="obra3.php"> <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/74/GOYA_-_El_aquelarre_%28Museo_L%C3%A1zaro_Galdiano%2C_Madrid%2C_1797-98%29.jpg/640px-GOYA_-_El_aquelarre_%28Museo_L%C3%A1zaro_Galdiano%2C_Madrid%2C_1797-98%29.jpg" alt="Obra 3"></a></li>
            <li><a href="obra4.php"> <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/eb/Fragonard%2C_The_Swing.jpg/1200px-Fragonard%2C_The_Swing.jpg" alt="Obra 4"></a></li>
            <li><a href="obra5.php"> <img src="https://upload.wikimedia.org/wikipedia/commons/b/b3/Psycheabduct.jpg" alt="Obra 5"></a></li>
            
        </div>
    </section>
    
    <section id="footer">

        <footer>
            <p>&copy; 2025 Museo Virtual. Todos los derechos reservados.</p>
        </footer>
    </section>
</body>
</html>
