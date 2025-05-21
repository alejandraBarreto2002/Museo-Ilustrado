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
    
    <section id="obra3">
        <div class="contenedorGal">
        <div class="imagenGal">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/74/GOYA_-_El_aquelarre_%28Museo_L%C3%A1zaro_Galdiano%2C_Madrid%2C_1797-98%29.jpg/640px-GOYA_-_El_aquelarre_%28Museo_L%C3%A1zaro_Galdiano%2C_Madrid%2C_1797-98%29.jpg" alt="Obra 1">
        </div>
        <div class="textoGal">
       <h2>El aquelarre</h2>
                <h3>Francisco de Goya</h3>
                <p><strong>Año:</strong> 1797–1798</p>
                <p><strong>Técnica:</strong> Óleo sobre lienzo</p>
                <p><strong>Dimensiones:</strong> 43 × 30 cm</p>
                <p><strong>Ubicación:</strong> Museo Lázaro Galdiano, Madrid, España</p>

                <h3>Información de la pintura</h3>
                <p>
                    Esta obra representa una escena de brujería, donde una figura demoníaca, el Macho Cabrío, preside un aquelarre rodeado de brujas y figuras grotescas. Es una de las más conocidas de la serie de seis cuadros que Goya pintó con temática de supersticiones y brujería por encargo del Duque de Osuna.
                    Goya utiliza aquí la sátira para criticar las creencias irracionales y la ignorancia popular, especialmente en una España marcada por la Inquisición. El estilo oscuro y las expresiones deformadas subrayan el carácter perturbador y simbólico de la escena.
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
    datos.append('id_exhibicion', 3); // ← Asegúrate de poner el ID real de esta obra en tu base de datos

    navigator.sendBeacon('guardar_visita.php', datos);
});
</script>


</body>






</html>