<?php
session_start();
if (!isset($_SESSION['visita'])) {
    $_SESSION['visita'] = 1;
} else {
    $_SESSION['visita']++;
}
// Verifica el contenido de la sesión
//var_dump($_SESSION); // Esto mostrará el contenido de la sesión
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Museo Virtual</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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


<main class="container">

    <section class="hero">
        <h2>Bienvenidos al Museo Virtual</h2>
        <p>Explora nuestras colecciones desde cualquier lugar del mundo.</p>
    </section>

    <!-- Carrusel manual -->
    <div class="carousel">
        <img src="https://images.adsttc.com/media/images/5127/2693/b3fc/4b11/a700/0efb/medium_jpg/664532140_h17.jpg?1414349057" class="active" alt="Exposición 1">
        <img src="https://img.lalr.co/cms/2022/03/31124833/COLP_EXT_106936_553dc-1.jpg?size=xl" alt="Exposición 2">
        <img src="https://hips.hearstapps.com/hmg-prod/images/galerias-arte-paris-1662025511.jpg" alt="Exposición 3">
    </div>

    <script>
        const slides = document.querySelectorAll('.carousel img');
        let currentSlide = 0;

        setInterval(() => {
            slides[currentSlide].classList.remove('active');
            currentSlide = (currentSlide + 1) % slides.length;
            slides[currentSlide].classList.add('active');
        }, 3000);
    </script>

    <!-- Contador de visitas -->
    <div class="contador">
        👁️ Visitas esta sesión: <?php echo $_SESSION['visita']; ?>
    </div>

    <!-- Frases -->
    <section class="frases">
        <p>"El arte no reproduce lo visible. Lo hace visible." – Paul Klee</p>
        <p>"Todo niño es un artista. El problema es cómo seguir siéndolo al crecer." – Pablo Picasso</p>
    </section>

    <!-- Calendario simple -->
    <section class="calendario">
        <h3>📅 Próximos eventos</h3>
        <ul>
            <li>🖼️ 20 Mayo - Nueva exposición: "Colores del alma"</li>
            <li>🎨 25 Mayo - Taller de pintura digital en vivo</li>
            <li>🗣️ 30 Mayo - Conversatorio con artistas invitados</li>
        </ul>
    </section>

</main>

            <script type="text/javascript">
     function mostrarAlerta() {
         const urlParams = new URLSearchParams(window.location.search);
         const mensaje = urlParams.get('mensaje');

         if (mensaje === 'registro_exitoso') {
             Swal.fire({
                 icon: 'success',
                 title: '¡Registro exitoso!',
                 text: 'Tu cuenta fue creada correctamente.',
                 confirmButtonText: 'Aceptar'
             });
         } else if (mensaje === 'error_registro') {
             Swal.fire({
                 icon: 'error',
                 title: '¡Error!',
                 text: 'Hubo un problema al registrar. Intenta de nuevo.',
                 confirmButtonText: 'Aceptar'
             });
         } else if (mensaje === 'sesion_cerrada') {
             Swal.fire({
                 icon: 'info',
                 title: '¡Hasta pronto!',
                 text: 'Sesión cerrada correctamente.',
                 confirmButtonText: 'Aceptar'
             });
         } else if (mensaje === 'login_exitoso') {
             Swal.fire({
                 icon: 'success',
                 title: 'Bienvenido',
                 text: 'Has iniciado sesión correctamente.',
                 confirmButtonText: 'Aceptar'
             });
         }

         // Limpiar la URL después de mostrar la alerta
         window.history.replaceState({}, document.title, window.location.pathname);
     }

     mostrarAlerta();
</script>

        </section>
    </div>

    <section id="footer">
        <footer>
            <p>&copy; 2025 Museo Virtual. Todos los derechos reservados.</p>
        </footer>
    </section>

</body>
</html>
