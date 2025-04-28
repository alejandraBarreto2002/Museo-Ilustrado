<?php
session_start();
// Verifica el contenido de la sesión
var_dump($_SESSION); // Esto mostrará el contenido de la sesión
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

    <div class="textoIndex">
        <section id="inicio">
            <h2>Bienvenidos al Museo Virtual</h2>

            <div class="centrarBoton">
                <!-- Ya no necesitas los botones aquí, están en el menú -->
            </div>

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
