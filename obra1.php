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
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/bf/Lady_with_an_Ermine_-_Leonardo_da_Vinci_%28adjusted_levels%29.jpg/1200px-Lady_with_an_Ermine_-_Leonardo_da_Vinci_%28adjusted_levels%29.jpg" width="400" alt="Obra 1">
            </div>
            <div class="textoGal">
                <h2>La dama del armiño</h2>
                <h3>Leonardo da Vinci</h3>
                <p><strong>Año:</strong> ca. 1489–1490</p>
                <p><strong>Técnica:</strong> Óleo sobre tabla</p>
                <p><strong>Dimensiones:</strong> 54 × 39 cm</p>
                <p><strong>Ubicación:</strong> Museo Czartoryski, Cracovia, Polonia</p>

                <h3>Descripción</h3>
                <p>
                    Esta obra es uno de los cuatro retratos femeninos pintados por Leonardo da Vinci. Representa a Cecilia Gallerani, una joven culta y poeta que fue amante de Ludovico Sforza, duque de Milán.
                    El armiño que sostiene en brazos simboliza la pureza y también hace referencia al emblema heráldico de Ludovico, conocido como “el Ermellino”. La pintura destaca por su innovación en la representación del movimiento y la psicología del personaje, algo revolucionario en su época.
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
    datos.append('id_exhibicion', 1); // ← Asegúrate de poner el ID real de esta obra en tu base de datos

    navigator.sendBeacon('guardar_visita.php', datos);
});
</script>
</body>






</html>