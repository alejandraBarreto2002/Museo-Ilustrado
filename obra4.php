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
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/eb/Fragonard%2C_The_Swing.jpg/1200px-Fragonard%2C_The_Swing.jpg" width="564" height="708.75" alt="Obra 1">
        </div>
        <div class="textoGal">
                <h2>El columpio</h2>
                <h3>Jean-Honoré Fragonard</h3>
                <p><strong>Año:</strong> 1767</p>
                <p><strong>Técnica:</strong> Óleo sobre lienzo</p>
                <p><strong>Dimensiones:</strong> 81 × 64 cm</p>
                <p><strong>Ubicación:</strong> Wallace Collection, Londres, Reino Unido</p>

                <h3>Información de la pintura</h3>
                <p>
                    "El columpio" es una obra emblemática del rococó francés que captura la frivolidad y la elegancia de la aristocracia del siglo XVIII. Representa a una joven noble en un columpio, impulsada por un hombre mayor mientras otro hombre, escondido en la maleza, la observa con admiración. La escena es un juego de seducción y coquetería, rodeada de un jardín exuberante y detalles ornamentales.
                </p>
                <p>
                    Fragonard utiliza una paleta luminosa y pinceladas sueltas para transmitir la ligereza y el dinamismo de la escena. Esta pintura es un ejemplo clásico del arte rococó, con su énfasis en el placer, la naturaleza y el desenfado.
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
    datos.append('id_exhibicion', 4); // ← Asegúrate de poner el ID real de esta obra en tu base de datos

    navigator.sendBeacon('guardar_visita.php', datos);
});
</script>

</body>






</html>