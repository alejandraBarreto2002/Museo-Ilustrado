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
    
    <section id="obra2">
        <div class="contenedorGal">
       
        <div class="imagenGal">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/45/Goya.hund.jpg/245px-Goya.hund.jpg" height="631.5" width="367.5" alt="Obra 1">
        </div>
        <div class="textoGal">
         <h2>El perro semihundido</h2>
                <h3>Francisco de Goya</h3>
                <p><strong>Año:</strong> ca. 1819–1823</p>
                <p><strong>Técnica:</strong> Óleo mural trasladado a lienzo</p>
                <p><strong>Dimensiones:</strong> 131 × 79 cm</p>
                <p><strong>Ubicación:</strong> Museo del Prado, Madrid, España</p>

                <h3>Información de la pintura</h3>
                <p>
                    Esta obra forma parte de las llamadas “Pinturas negras” que Goya pintó directamente sobre los muros de su casa, la Quinta del Sordo. La imagen muestra a un perro parcialmente sumido en un fondo terroso y vacío, con una expresión de aparente desesperanza. 
                    Su composición radical y la ambigüedad de la escena han sido objeto de múltiples interpretaciones, desde una metáfora de la soledad y el sufrimiento humano, hasta una crítica existencial al destino del ser. 
                    Es considerada una de las obras más enigmáticas y modernas de Goya.
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
    datos.append('id_exhibicion', 2); // ← Asegúrate de poner el ID real de esta obra en tu base de datos

    navigator.sendBeacon('guardar_visita.php', datos);
});
</script>

</body>






</html>