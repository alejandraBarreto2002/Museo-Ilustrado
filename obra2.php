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
    
    <section id="obra2">
        <div class="contenedorGal">
       
        <div class="imagenGal">
             
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/45/Goya.hund.jpg/245px-Goya.hund.jpg" height="631.5" width="367.5" alt="Obra 1">
        </div>
        <div class="textoGal">
            <h2>Nombre de la obra</h2>
            <h3>Nombre Autor</h3>
            <p>Año de publicacion</p>
        
        
            <h3>Informacion de la pintura</h3>
            <p>trasfondo</p>
        </div>

        </div>
    </section>

   


    <section id="footer">

        <footer>
            <p>&copy; 2025 Museo Virtual. Todos los derechos reservados.</p>
        </footer>
    </section>




</body>






</html>